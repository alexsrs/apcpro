<?php 
    verificaPermissaoPagina(0);
    include_once('pages/funcoes.php');

    if (isset($_GET['id'])) {
        $usuario_id = (int)$_GET['id']; 
    } else {
        $usuario_id = $_SESSION['id']; 
    }

    $sql = MySql::conectar()->prepare("SELECT sexo FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$usuario_id]);
    $result = $sql->fetch();
    $sexo = $result['sexo'];

    if (!$result) {
        echo "Usuário não encontrado!";
        exit();
    }

    if (!isset($_SESSION['etapa'])) {
        $_SESSION['etapa'] = 3;
    }

    // Consulta a altura e o peso na tabela de perfis de usuários
    $sql = MySql::conectar()->prepare("SELECT altura, peso FROM `tb_perfis_usuarios` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
    $sql->execute([$usuario_id]);
    $perfil = $sql->fetch();

    if (!$perfil) {
        echo "Perfil de usuário não encontrado!";
        exit();
    }

    $altura = $perfil['altura'] * 100; // Altura em cm
    $peso = $perfil['peso']; // Peso em kg

    // Consulta as medidas corporais na tabela de medidas
    $sql = MySql::conectar()->prepare("SELECT cintura, quadril, pescoco FROM `tb_medidas_corporais` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
    $sql->execute([$usuario_id]);
    $medidas = $sql->fetch();

    if (!$medidas) {
        echo "Medidas corporais não encontradas!";
        exit();
    }

    $cintura = $medidas['cintura'];
    $quadril = $medidas['quadril'];
    $pescoco = $medidas['pescoco'];

    function calcularPercentualGordura($sexo, $altura, $cintura, $quadril, $pescoco) {
        if ($sexo == 'M') {
            if ($cintura > $pescoco) {
                // Fórmula para homens
                return 86.010 * log10($cintura - $pescoco) - 70.041 * log10($altura) + 30.30;
            } else {
                return "Erro: a medida da cintura deve ser maior que a do pescoço para um cálculo válido.";
            }
        } else {
            if (($cintura + $quadril) > $pescoco) {
                // Fórmula para mulheres
                return 163.205 * log10($cintura + $quadril - $pescoco) - 97.684 * log10($altura) - 104.912;
            } else {
                return "Erro: a soma da cintura e do quadril deve ser maior que o pescoço para um cálculo válido.";
            }
        }
    }
    // Cálculo do percentual de gordura corporal
    $percentualGordura = calcularPercentualGordura($sexo, $altura, $cintura, $quadril, $pescoco);

    if (is_numeric($percentualGordura)) {
        // Cálculo da massa de gordura e massa magra
        $massaGordura = ($percentualGordura / 100) * $peso;
        $massaMagra = $peso - $massaGordura;
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $composicao = new ComposicaoCorporal();
        $dadosComposicao = [
            'percentual_gordura' => $_POST['percentual_gordura'],
            'massa_gordura' => $_POST['massa_gordura'],
            'massa_magra' => $_POST['massa_magra']
        ];
    
        $dataAvaliacao = (new DateTime())->format('Y-m-d H:i:s');
    
        if ($composicao->gravarComposicao($usuario_id, $dadosComposicao, $dataAvaliacao)) {
            Painel::alert('sucesso', 'Dados gravados com sucesso!');
            $_SESSION['etapa'] = 4;
    
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
                        window.location.href='" . INCLUDE_PATH_PAINEL . 'aptidao-cardiorespiratoria' . "?id=" . $usuario_id . "';
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
    <div class="step <?php echo ($_SESSION['etapa'] >= 1) ? 'completed' : ''; ?>">
        <div class="step-number">1</div>
        <div class="step-label">Perfil</div>
    </div>
    <div class="step <?php echo ($_SESSION['etapa'] >= 2) ? 'completed' : ''; ?>">
        <div class="step-number">2</div>
        <div class="step-label">Anamnese</div>
    </div>
    <div class="step <?php echo ($_SESSION['etapa'] >= 3) ? 'completed' : ''; ?>">
        <div class="step-number">3</div>
        <div class="step-label">Medida corporal</div>
    </div>
    <div class="step <?php echo ($_SESSION['etapa'] >= 4) ? 'completed' : ''; ?>">
        <div class="step-number">4</div>
        <div class="step-label">Aptidão Cardiorespiratória</div>
    </div>
    <div class="step <?php echo ($_SESSION['etapa'] >= 5) ? 'completed' : ''; ?>">
        <div class="step-number">5</div>
        <div class="step-label">Teste Físico</div>
    </div>
</div>
<div class="box-content">
    <h2 id="user-choice"><i class="fa fa-pencil" aria-hidden="true"></i>Composição corporal</h2>
    <div class="form-group center">       
        <fieldset style="border: none;">
            <div class="center" style="text-align:center; max-width: 70%;">
                <p style="text-align: justify;">O percentual de gordura corporal é uma medida que indica a quantidade de gordura no corpo em relação ao peso total. Essa métrica é importante para avaliar a composição corporal e entender melhor a proporção de massa magra (músculos, ossos, órgãos) em relação à massa gorda (gordura).</p>
                <p>Escolha o método para estimar o percentual de gordura corporal:</p>
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
                    <input type="radio" class="checkbox-input" name="metodo" value="Balança" onclick="atualizarEscolha('balanca')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/balanca.svg" alt="Ícone Balança">
                        </span><br>
                        <span class="checkbox-label">Balança</span>
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
            <h2>Percentual de gordura corporal por equação</h2>
            <div class="form-group">
                <p>Fórmula da Marinha Americana utilizada para estimar o percentual de gordura corporal usando medidas corporais. Essa fórmula usa a circunferência de determinadas áreas do corpo, além da altura.</p>
                <p>Essas fórmulas são úteis para uma estimativa do percentual de gordura corporal, e são usadas por militares dos EUA para avaliar a composição corporal sem a necessidade de equipamentos sofisticados.</p>
                <?php if (is_numeric($percentualGordura)) { ?>
                    <div class="form-group">
                        <label>Percentual de Gordura estimado:</label>
                        <input type="text" name="percentual_gordura" value="<?php echo number_format($percentualGordura, 2); ?>%"/>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Massa de Gordura</label>
                        <input type="text" name="massa_gordura" value="<?php echo number_format($massaGordura, 2); ?> kg"/>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Massa Magra</label>
                        <input type="text" name="massa_magra" value="<?php echo number_format($massaMagra, 2); ?> kg"/>
                    </div><!-- form-group -->
                
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>../images/tabela-percentual-gordura.jpg" alt="Tabela percentrual de gordura" style="max-width: 100%; margin-top: 20px;">
                    <p>É importante ressaltar que, apesar de úteis, essas fórmulas fornecem apenas uma estimativa e podem não ser tão precisas quanto métodos mais avançados, como a balança de bioimpedância ou exames realizados por profissionais capacitados.</p>
                <?php } else { ?>
                    <p><strong><?php echo $percentualGordura; ?></strong></p>
                <?php } ?>
            </div>
            <div class="form-group">
            <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>

    <!-- Formulário Balança -->
    <div id="form-balanca" style="display: none;">
        <h2>Formulário para Balança</h2>
        <form>
            <!-- Campos específicos para Balança -->
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
    document.getElementById('form-balanca').style.display = 'none';
    document.getElementById('form-exame').style.display = 'none';

    // Exibe o formulário correspondente
    if (metodo === 'equacao') {
        document.getElementById('form-equacao').style.display = 'block';
    } else if (metodo === 'balanca') {
        document.getElementById('form-balanca').style.display = 'block';
    } else if (metodo === 'exame') {
        document.getElementById('form-exame').style.display = 'block';
    }
}
</script>