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
$sql = MySql::conectar()->prepare("SELECT peso FROM `tb_perfis_usuarios` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
$sql->execute([$usuario_id]);
$result = $sql->fetch();

if ($result) {
    $peso = $result['peso'];
} else {
    
    $peso = null; // ou qualquer valor padrão, como 0
    // Opcionalmente, exiba uma mensagem informativa
    Painel::alert('erro', 'Peso não encontrado!');
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

// $metodo = isset($_POST['metodo']) ? $_POST['metodo'] : ''; // ou qualquer valor padrão, como 'equacao'
//echo $metodo;



// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Define a data de avaliação
    $dataAvaliacao = (new DateTime())->format('Y-m-d H:i:s');
    
    $vo2_maximo = isset($_POST['vo2_maximo']) ? $_POST['vo2_maximo'] : null;
    $mets = isset($_POST['mets']) ? $_POST['mets'] : null;
    $metodo = isset($_POST['metodo']) ? $_POST['metodo'] : null;
    
    // Dados a serem salvos na tabela
    $dadosAptidao = [
        'vo2_maximo' => $vo2_maximo,
        'mets' => $mets,
        'metodo' => $metodo
    ];

    // Chama o método para gravar os dados
    if (AptidaoModel::gravarAptidao($usuario_id, $dadosAptidao, $dataAvaliacao)) {
        Painel::alert('sucesso', 'Dados gravados com sucesso!');
        $_SESSION['etapa'] = 5;

        // Redirecionamento com contagem regressiva
        $tempoContagem = 5;
        echo "<div id='contador' style='text-align:center; color:#007bff; padding-top:20px;'>Redirecionando em <span id='tempo'>$tempoContagem</span> segundos...</div>";
        echo "<script>
            var tempo = $tempoContagem;
            var intervalo = setInterval(function() {
                tempo--;
                document.getElementById('tempo').innerText = tempo;
                if (tempo <= 0) {
                    clearInterval(intervalo);
                    window.location.href='" . INCLUDE_PATH_PAINEL . 'teste-fisico' . "?id=" . $usuario_id . "';
                }
            }, 1000);
        </script>";
        exit();
    } else {
        Painel::alert('erro', 'Erro ao gravar dados.');
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
            <div class="center" style="text-align:center; max-width: 90%;">
                <p style="text-align: justify;">A aptidão cardiorrespiratória é a capacidade do coração, dos pulmões e dos vasos sanguíneos de fornecer oxigênio aos músculos durante atividades físicas prolongadas e intensas. Ela é um indicador importante de saúde geral e está associada a uma série de benefícios, incluindo menor risco de doenças cardiovasculares, melhor controle de peso, maior disposição e uma recuperação mais rápida após o exercício.</p>
				<p style="text-align: justify;">Para medir a aptidão cardiorrespiratória, frequentemente se utiliza o consumo máximo de oxigênio (VO₂ máx), que representa a quantidade máxima de oxigênio que uma pessoa consegue utilizar por minuto durante o exercício intenso. </p>
                <p>Escolha o método para definir a aptidão cardiorespiratória:</p>
                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="Equacao" onclick="atualizarEscolha('equacao')" />
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
                    <input type="radio" class="checkbox-input" name="metodo" value="cooper" onclick="atualizarEscolha('cooper')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/cooper.svg" alt="Ícone Teste de Cooper">
                        </span><br>
                        <span class="checkbox-label">Pista</span>
                    </span>
                    </label> 
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="Teste de bike" onclick="atualizarEscolha('bike')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/bike.svg" alt="Ícone Teste de bike">
                        </span><br>
                        <span class="checkbox-label">Bike</span>
                    </span>
                    </label> 
                </div>
                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="Teste de esteira" onclick="atualizarEscolha('esteira')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/esteira.svg" alt="Ícone Teste de esteira">
                        </span><br>
                        <span class="checkbox-label">Esteira</span>
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
                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="outros" onclick="atualizarEscolha('outros')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/outros.svg" alt="Ícone outros">
                        </span><br>
                        <span class="checkbox-label">Outros</span>
                    </span>
                    </label> 
                </div>
            </div>
        </fieldset>
    </div><!-- form-group -->    
    <div class="clear"></div>
</div><!-- box-content -->



<div class="box-content" id="formulario-selecionado">

     <form method="post" id="metodoForm">   
     <!-- Formulário Equação -->
     <!-- Campo oculto para armazenar o método selecionado -->
        
            <!-- Outros campos do formulário -->
      

        <?php $metodo = 'equacao'; 
        if ($metodo == 'equacao') {
            // Calcula o VO2 máximo e os METs
            if ($sexo['sexo'] == 'M' || $sexo['sexo'] == 'm') {
                $vo2_maximo = 57.8 - (0.445 * $idade) + (0.0969 * $peso);
            } else {
                $vo2_maximo = 41.2 - (0.325 * $idade) + (0.0194 * $peso);
            }
            $mets = $vo2_maximo / 3.5;
        }
        ?>
        <div class="form-group" id="form-equacao" style="display: none;">
            <h2>Aptidão cardiorespiratória por equação</h2>
            <div class="form-group">
            
            <?php $metodo = 'equacao'; echo $metodo; ?>
            
                <p>Fórmula de Jackson e Pollock fornece uma estimativa e são válidas principalmente para adultos saudáveis.</p>
                <p>O valor de MET é uma unidade relativa ao consumo de oxigênio em repouso, que é aproximadamente 3,5 mL/kg/min para um adulto médio.</p>
                <input type="text" id="metodo" name="metodo" value="">
                <?php if (is_numeric($peso)) { ?>
                    <div class="form-group">
                        <label>Peso:</label>
                        <input type="text" name="peso" value="<?php echo number_format($peso, 2); ?> Kg"/>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Vo² Máximo</label>
                        <input type="text" name="vo2_maximo" value="<?php echo number_format($vo2_maximo, 2); ?> mL/kg/min"/>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>METs</label>
                        <input type="text" name="mets" value="<?php echo number_format($mets, 2); ?> Mets"/>
                    </div><!-- form-group -->
                <?php } else { ?>
                    <p><strong><?php echo $peso; ?></strong></p>
                <?php } ?>
            </div>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </div>
    </form>
    

    <!-- Formulário Teste de Cooper -->
    <div class="form-group" id="form-cooper" style="display: none;">
        <h2>Formulário para Teste de Pista</h2>
        <p>Para realizar o teste de Cooper, o avaliado deve percorrer a maior distância possível em 
            <?php 
                if ($idade < 65) { 
                    echo "12 minutos"; 
                } else { 
                    echo "6 minutos"; 
                } 
            ?>. Utilize um  relógio ou cronômetro para medir o tempo exato e uma forma de medir a distância percorrida (pode ser uma pista marcada ou aplicativos de GPS).</p>
        <p>A classificação do VO₂ máximo pode variar de acordo com a idade e o gênero, mas existem tabelas de referência que ajudam a entender se o nível de aptidão é considerado "excelente", "bom", "médio" ou "abaixo da média".</p>
        <form method="post" id="metodoForm"> 
        <input type="text" id="metodo" name="metodo" value="">  
        <?php $metodo = 'cooper'; echo $metodo;?>
    
        

            <!-- Campos específicos para Teste de Cooper -->
            <div class="form-group">
                <label for="distancia">Distancia percorrida:</label>
                <input type="text" id="distancia" name="distancia" oninput="calcularVO2MaxCooper()" value="" placeholder="Digite a distância em metros">
            </div><!-- form-group -->
            <div class="form-group">
                <label>Vo² Máximo</label>
                <input type="text" name="vo2_maximo" id="resultado-vo2max" />
                
             </div><!-- form-group -->
             <div class="form-group">
                <label>METs</label>
                <input type="text" name="mets" id="resultado-mets" />
            </div><!-- form-group -->
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>

    <!-- Formulário Teste de Bike -->
    <div class="form-group" id="form-bike" style="display: none;">
        <h2>Formulário para Teste de bike</h2>
        <form method="post">
        <?php $metodo = 'bike'; echo $metodo;?>
            <!-- Campos específicos para Teste de bike -->
            <label for="input1">Campo 1:</label>
            <input type="text" id="input1" name="input1"><br>
            <label for="input2">Campo 2:</label>
            <input type="text" id="input2" name="input2"><br>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>

    <!-- Formulário Teste de Esteira -->
    <div class="form-group" id="form-esteira" style="display: none;">
        <h2>Formulário para Teste de Esteira</h2>
        <form method="post">
        <?php $metodo = 'esteira'; echo $metodo;?>
            <!-- Campos específicos para Teste de Esteira -->
            <label for="input7">Campo 7:</label>
            <input type="text" id="input7" name="input7"><br>
            <label for="input8">Campo 8:</label>
            <input type="text" id="input8" name="input8"><br>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>

    <!-- Formulário Exame -->
    <div class="form-group" id="form-exame" style="display: none;">
        <h2>Formulário para Exame</h2>
        <form method="post">
        <?php $metodo = 'exame'; echo $metodo;?>
            <!-- Campos específicos para Exame -->
            <label for="input5">Campo 5:</label>
            <input type="text" id="input5" name="input5"><br>
            <label for="input6">Campo 6:</label>
            <input type="text" id="input6" name="input6"><br>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>

    <!-- Formulário Outros -->
    <div class="form-group" id="form-outros" style="display: none;">
        <h2>Formulário para Outros</h2>
        <form method="post">
        <?php $metodo = 'outros'; echo $metodo;?>
            <!-- Campos específicos para Outros -->
            <label for="input9">Campo 9:</label>
            <input type="text" id="input9" name="input9"><br>
            <label for="input10">Campo 10:</label>
            <input type="text" id="input10" name="input10"><br>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>
</div>



<script>
function atualizarEscolha(metodo) {
    // Atualiza o valor do campo oculto com o método selecionado
    document.getElementById('metodo').value = metodo;

    // Oculta todos os formulários
    document.getElementById('form-equacao').style.display = 'none';
    document.getElementById('form-cooper').style.display = 'none';
    document.getElementById('form-esteira').style.display = 'none';
    document.getElementById('form-bike').style.display = 'none';
    document.getElementById('form-exame').style.display = 'none';
    document.getElementById('form-outros').style.display = 'none';

    // Exibe o formulário correspondente ao método selecionado
    if (metodo === 'equacao') {
        document.getElementById('form-equacao').style.display = 'block';
    } else if (metodo === 'cooper') {
        document.getElementById('form-cooper').style.display = 'block';
    } else if (metodo === 'esteira') {
        document.getElementById('form-esteira').style.display = 'block';
    } else if (metodo === 'bike') {
        document.getElementById('form-bike').style.display = 'block';
    } else if (metodo === 'exame') {
        document.getElementById('form-exame').style.display = 'block';
    } else if (metodo === 'outros') {
        document.getElementById('form-outros').style.display = 'block';
    }
}

function calcularVO2MaxCooper() {
    var distancia = document.getElementById('distancia').value;

    var idade = <?php echo $idade; ?>;
    if (idade < 65) {
        // Fórmula para calcular o VO² Máximo no Teste de Cooper 12 minutos
        var vo2max = (distancia - 504.9) / 44.73;
    } else {
        // Fórmula para calcular o VO² Máximo no Teste de Cooper 6 minutos
        var vo2max = (distancia - 504.9) / 30.4;
    }
    if (distancia && !isNaN(distancia)) {
        // Fórmula para calcular o VO² Máximo no Teste de Cooper 12 minutos
        var mets = vo2max / 3.5;
        // Define o valor calculado no campo de input "resultado-vo2max"
        document.getElementById('resultado-vo2max').value = vo2max.toFixed(2) + " mL/kg/min";
        document.getElementById('resultado-mets').value = mets.toFixed(2) + " Mets";
        } else { 
        // Exibe uma mensagem de erro no campo caso o valor não seja numérico
        document.getElementById('resultado-vo2max').value = "";
        document.getElementById('resultado-mets').value = "";
        }
}
</script>

