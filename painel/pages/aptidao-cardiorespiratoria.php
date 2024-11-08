<?php 
    verificaPermissaoPagina(0);
    include_once('pages/funcoes.php');

    if (isset($_GET['id'])) {
        $usuario_id = (int)$_GET['id']; 
    } else {
        $usuario_id = $_SESSION['id']; 
    }
    if (!isset($_SESSION['etapa'])) {
        $_SESSION['etapa'] = 4;
    }

// Consulta as medidas corporais na tabela de medidas
$sql = MySql::conectar()->prepare("SELECT percentual_gordura FROM `tb_composicao_corporal` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
$sql->execute([$usuario_id]);
$result = $sql->fetch();

if ($result) {
    $percentual_gordura = $result['percentual_gordura'];
} else {
    // Defina um valor padrão ou exiba uma mensagem caso o percentual de gordura não seja encontrado
    $percentual_gordura = null; // ou qualquer valor padrão, como 0
    // Opcionalmente, exiba uma mensagem informativa
    Painel::alert('erro', 'Percentual de gordura não encontrado!');
}



// Consulta o sexo do usuário
$sql = MySql::conectar()->prepare("SELECT sexo FROM `tb_admin.usuarios` WHERE id = ?");
$sql->execute([$usuario_id]);
$sexo = $sql->fetch();

// Calcula a idade do usuário
$sql = MySql::conectar()->prepare("SELECT data_nascimento FROM `tb_admin.usuarios` WHERE id = ?");
$sql->execute([$usuario_id]);
$dataNascimentoArray = $sql->fetch();
$dataNascimento = new DateTime($dataNascimentoArray['data_nascimento']); // Converte a string em um objeto DateTime
$idade = (new DateTime())->diff($dataNascimento)->y; // Calcula a diferença de idade em anos

// Calcula o VO2 máximo e os METs
if ($sexo['sexo'] == 'M') {
    $vo2_maximo = 98.42 - (0.12 * $percentual_gordura) - (0.14 * $idade);
} else {
    $vo2_maximo = 74.99 - (0.14 * $percentual_gordura) - (0.15 * $idade);
}

$mets = $vo2_maximo / 3.5;



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$aptidao = new AptidaoModel();
        
        $dataAvaliacao = (new DateTime())->format('Y-m-d H:i:s');
    
    $dadosAptidao = [
        'vo2_maximo' => $vo2_maximo,
        'mets' => $mets
    ];
    if ($aptidao->gravarAptidao($usuario_id, $dadosAptidao, $dataAvaliacao)) {
        Painel::alert('sucesso', 'Dados gravados com sucesso!');
        $_SESSION['etapa'] = 5;

    $sql = MySql::conectar()->prepare("INSERT INTO tb_equacao_aptidao 
		(usuario_id, data_avaliacao, vo2_maximo, mets) 
		VALUES 
		(:usuario_id, :data_avaliacao, :vo2_maximo, :mets)");

	$sql->bindParam(':usuario_id', $usuario_id);
	$sql->bindParam(':data_avaliacao', $dataAvaliacao);
	$sql->bindParam(':vo2_maximo', $dadosAptidao['vo2_maximo']);
	$sql->bindParam(':mets', $dadosAptidao['mets']);


		$sql->execute();
	



	
    
            // Defina o tempo de contagem regressiva
            $tempoContagem = 5; // Tempo em segundos
    
            // Exibir a mensagem de contagem
            echo "<div id='contador' style='text-align:center; color:#007bff; padding-top:20px;'>Redirecionando em <span id='tempo'>$tempoContagem</span> segundos...</div>";
    
            echo "<script>
                // Defina o tempo de contagem
                var tempo = $tempoContagem;
                
                // Atualiza a contagem a cada segundo
                var intervalo = setInterval(function() {
                    tempo--;
                    document.getElementById('tempo').innerText = tempo;
    
                    // Quando o tempo acabar, redirecione
                    if (tempo <= 0) {
                        clearInterval(intervalo);
                        window.location.href='" . INCLUDE_PATH_PAINEL . 'teste-fisico' . "?id=" . $usuario_id . "';
                    }
                }, 1000);
            </script>";
            exit();
        } else {
            Painel::alert('erro', 'Erro ao gravar dados.');
            echo "";
        }
    }
?>

<div class="step-indicator">
    <!-- Indicador de etapas, permanece igual -->
</div>
<?php ?>
<div class="box-content">
    <h2 id="user-choice"><i class="fa fa-pencil" aria-hidden="true"></i>Aptidão cardiorespiratória</h2>
    <div class="form-group center">       
        <fieldset style="border: none;">
            <div class="center" style="text-align:center; max-width: 70%;">
                <p style="text-align: justify;">A aptidão cardiorrespiratória é a capacidade do coração, dos pulmões e dos vasos sanguíneos de fornecer oxigênio aos músculos durante atividades físicas prolongadas e intensas. Ela é um indicador importante de saúde geral e está associada a uma série de benefícios, incluindo menor risco de doenças cardiovasculares, melhor controle de peso, maior disposição e uma recuperação mais rápida após o exercício.</p>
				<p style="text-align: justify;">Para medir a aptidão cardiorrespiratória, frequentemente se utiliza o consumo máximo de oxigênio (VO₂ máx), que representa a quantidade máxima de oxigênio que uma pessoa consegue utilizar por minuto durante o exercício intenso. </p>
                <p>Escolha o método para definir a aptidão cardiorespiratória:</p>
                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="Equação" onclick="atualizarEscolha('equacao')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/equacao.svg" alt="Ícone equação">
                        </span><br>
                        <span class="checkbox-label">Equação</span>
                    </span>
                    </label> 
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="Teste de Cooper" onclick="atualizarEscolha('cooper')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/cooper.svg" alt="Ícone Teste de Cooper">
                        </span><br>
                        <span class="checkbox-label">Cooper</span>
                    </span>
                    </label> 
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="Exame" onclick="atualizarEscolha('exame')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/exame.svg" alt="Ícone Exame">
                        </span><br>
                        <span class="checkbox-label">Exame</span>
                    </span>
                    </label> 
                </div>
            </div>
        </fieldset>
    </div><!-- form-group -->    
    <div class="clear"></div>
</div><!-- box-content -->

<div class="box-content" id="formulario-selecionado">
     <form method="post">   
    <!-- Formulário Equação -->
        <div class="form-group" id="form-equacao" style="display: none;">
            <h2>Aptidão cardiorespiratória por equação</h2>
            <div class="form-group">
                <p>Essas fórmulas fornecem uma estimativa e são válidas principalmente para adultos saudáveis.</p>
                <p>O valor de MET é uma unidade relativa ao consumo de oxigênio em repouso, que é aproximadamente 3,5 mL/kg/min para um adulto médio.</p>
                <?php if (is_numeric($percentual_gordura)) { ?>
                    <div class="form-group">
                        <label>Percentual de Gordura estimado:</label>
                        <input type="text" name="percentual_gordura" value="<?php echo number_format($percentual_gordura, 2); ?>%"/>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Vo² Máximo</label>
                        <input type="text" name="vo2_maximo" value="<?php echo number_format($vo2_maximo, 2); ?> mL/kg/min"/>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>METs</label>
                        <input type="text" name="mets" value="<?php echo number_format($mets, 2); ?>"/>
                    </div><!-- form-group -->
                <?php } else { ?>
                    <p><strong><?php echo $percentual_gordura; ?></strong></p>
                <?php } ?>
            </div>
            <div class="form-group">
            <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>

    <!-- Formulário Teste de Cooper -->
    <div id="form-cooper" style="display: none;">
        <h2>Formulário para Teste de Cooper</h2>
        <form>
            <!-- Campos específicos para Teste de Cooper -->
            <label for="input3">Campo 3:</label>
            <input type="text" id="input3" name="input3"><br>
            <label for="input4">Campo 4:</label>
            <input type="text" id="input4" name="input4"><br>
        </form>
    </div>

    <!-- Formulário Exame -->
    <div id="form-exame" style="display: none;">
        <h2>Formulário para Exame</h2>
        <form>
            <!-- Campos específicos para Exame -->
            <label for="input5">Campo 5:</label>
            <input type="text" id="input5" name="input5"><br>
            <label for="input6">Campo 6:</label>
            <input type="text" id="input6" name="input6"><br>
        </form>
    </div>
</div>

<script>
function atualizarEscolha(metodo) {
    // Oculta todos os formulários
    document.getElementById('form-equacao').style.display = 'none';
    document.getElementById('form-cooper').style.display = 'none';
    document.getElementById('form-exame').style.display = 'none';

    // Exibe o formulário correspondente
    if (metodo === 'equacao') {
        document.getElementById('form-equacao').style.display = 'block';
    } else if (metodo === 'cooper') {
        document.getElementById('form-cooper').style.display = 'block';
    } else if (metodo === 'exame') {
        document.getElementById('form-exame').style.display = 'block';
    }
}
</script>