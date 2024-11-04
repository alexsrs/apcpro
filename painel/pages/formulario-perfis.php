<?php 
    verificaPermissaoPagina(0);
    include_once('pages/funcoes.php');
    

    // Obtém o usuario_id da sessão ou pela URL (para admins ou edições externas)
    if (isset($_GET['id'])) {
        $usuario_id = (int)$_GET['id']; // ID passado pela URL
    } else {
        $usuario_id = $_SESSION['id']; // ID do usuário logado
    }

    // Verifica se o ID existe no banco de dados
    $sql = MySql::conectar()->prepare("SELECT sexo FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$usuario_id]);
    $result = $sql->fetch();
    
    // Caso o usuário não exista
    if (!$result) {
        echo "Usuário não encontrado!";
        exit();
    }

    // Inicializa a etapa na sessão, se ainda não estiver definida
    if (!isset($_SESSION['etapa'])) {
        $_SESSION['etapa'] = 1;
    }

    // Consulta ao banco de dados para obter o sexo do usuário
    $sexo = $result['sexo'];
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
<h2><i class="fa fa-pencil" aria-hidden="true"></i> Informe as condições de saúde atuais:</h2>
    <form method="post">   
        <?php
            if (isset($_POST['acao'])) {
                // Obtém os dados do formulário
                $data_avaliacao = (new DateTime())->format('Y-m-d H:i:s');
                $peso = $_POST['peso'];
                $altura = $_POST['altura'];
                $obesidade = isset($_POST['obesidade']) ? 1 : 0;
                $diabetes = isset($_POST['diabetes']) ? 1 : 0;
                $hipertensao = isset($_POST['hipertensao']) ? 1 : 0;
                $depressao = isset($_POST['depressao']) ? 1 : 0;
                $pos_covid = isset($_POST['pos_covid']) ? 1 : 0;

                // Busca a data de nascimento no banco de dados
                $sql = MySql::conectar()->prepare("SELECT data_nascimento FROM `tb_admin.usuarios` WHERE id = ?");
                $sql->execute([$usuario_id]);
                $data_nascimento_result = $sql->fetch();

                if ($data_nascimento_result) {
                    $dataNascimento = new DateTime($data_nascimento_result['data_nascimento']);
                    $idade = (new DateTime())->diff($dataNascimento)->y;
                    $idoso = $idade >= 65 ? 1 : 0;
                } else {
                    $idoso = 0; 
                }

                $gestante = isset($_POST['gestante']) ? 1 : 0;
                $posparto = isset($_POST['posparto']) ? 1 : 0;
                $emagrecer = isset($_POST['emagrecer']) ? 1 : 0;
                $objetivo = $_POST['objetivo'];

                // Salva o perfil do usuário
                $perfil = new Perfil();
                $perfil->cadastrarPerfil($usuario_id, $data_avaliacao, $peso, $altura, $obesidade, $diabetes, $hipertensao, $depressao, $pos_covid, $idoso, $gestante, $posparto, $emagrecer, $objetivo);

                Painel::alert('sucesso', 'Pré-avaliação cadastrada com sucesso!');
                $_SESSION['etapa'] = 2;
                
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
                            window.location.href='" . INCLUDE_PATH_PAINEL . obterLinkAnamnese($usuario_id) . "?id=" . $usuario_id . "';
                        }
                    }, 1000);
                </script>";
                exit();
            }

            if (isset($_POST['novo_objetivo'])) {
                $novo_objetivo = $_POST['novo_objetivo_texto'];
                if (!empty($novo_objetivo)) {
                    $sql = MySql::conectar()->prepare("INSERT INTO tb_objetivos_treinamento (objetivo) VALUES (?)");
                    $sql->execute([$novo_objetivo]);
                    Painel::alert('sucesso', 'Novo objetivo adicionado com sucesso!');
                }
            }
        ?>
        <!-- Formulário de saúde -->
        <div class="form-group flex-container">
    <div class="select-container">
        <label>Objetivo do treinamento</label>
        <select name="objetivo">
            <?php 
                // Conectar ao banco de dados
                $sql = MySql::conectar()->prepare("SELECT id, objetivo FROM tb_objetivos_treinamento");
                $sql->execute();
                $objetivos = $sql->fetchAll();

                // Exibir uma opção padrão
                echo '<option value="0">-- Selecione o objetivo --</option>';

                // Preencher o select com os dados do banco de dados
                foreach ($objetivos as $objetivo) {
                    echo '<option value="'.$objetivo['id'].'">'.$objetivo['objetivo'].'</option>';
                }
            ?>
        </select>
    </div><!-- select-container -->
    
    <!-- Botão ao lado do select -->
    <div class="button-container">
        
        <button type="button" onclick="document.getElementById('modalObjetivo').style.display='flex'"><i class="fa fa-plus" aria-hidden="true"></i></button>
    </div><!-- button-container -->
</div><!-- form-group -->
        <div class="form-group left w50"> 
            <label for="peso">Peso: </label>
            <input type="range" id="peso" class="slider" name="peso" min="40.0" max="299.9" step="0.1" value="50.0" oninput="updatePeso(this.value)">
            <br>
            <input type="text" id="peso-valor" value="50.0 Kg"></input>
            <script>
                function updatePeso(value) {
                    document.getElementById('peso-valor').value = parseFloat(value).toFixed(1) + ' Kg';
                }
            </script>
        </div>

        <div class="form-group right w50"> 
            <label for="altura">Altura: </label>
            <input type="range" id="altura" class="slider" name="altura" min="1.20" max="2.51" step="0.01" value="1.50" oninput="updateAltura(this.value)">
            <br>
            <input type="text" id="altura-valor" value="1.50 m"></input>
            <script>
                function updateAltura(value) {
                    document.getElementById('altura-valor').value = parseFloat(value).toFixed(2) + ' m';
                }
            </script>
        </div>
        <div class="clear"></div><!-- clear -->

        <div class="form-group left w50">       
            <fieldset style="border: none;">
                <legend>Dados de saúde</legend>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:5px">
                    <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" id="obesidade" name="obesidade" value="1" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                        <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/fat.svg" alt="Ícone Obeso">
                        </span><br>
                        <span class="checkbox-label">Obesidade</span>
                    </span>
                    </label>
                    
                    
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:5px">
                    <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" id="diabetes" name="diabetes" value="1"/>
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                        <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/glicose.svg" alt="Ícone Gestante">
                        </span><br>
                        <span class="checkbox-label">Diabetes</span>
                    </span>
                    </label>
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:5px">
                    <label class="checkbox-wrapper">
                        <input type="checkbox" class="checkbox-input" id="hipertensao" name="hipertensao" value="1"/>
                        <span class="checkbox-tile">
                        <span class="checkbox-icon">
                        <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/hipertenso.svg" alt="Ícone Gestante">

                        </span><br>
                        <span class="checkbox-label">Hipertensão</span>
                        </span>
                    </label>
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:5px">
                <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" id="depressao" name="depressao" value="1"/>
                    <span class="checkbox-tile">
                    <span class="checkbox-icon">
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/depressao.svg" alt="Ícone Gestante">

                    </span><br>
                    <span class="checkbox-label">Depressão</span>
                    </span>
                </label>
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:5px">
                <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" id="pos_covid" name="pos_covid" value="1"/>
                    <span class="checkbox-tile">
                    <span class="checkbox-icon">
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/covid.svg" alt="Ícone Gestante">
                </span><br>
                    <span class="checkbox-label">Pós covid</span>
                    </span>
                </label>
                </div>

<!--
                <label class="switch-label" for="obesidade">
                    <input type="checkbox" id="obesidade" name="obesidade" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Obesidade</span>
                </label><br>



                <label class="switch-label" for="diabetes">
                    <input type="checkbox" id="diabetes" name="diabetes" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Diabetes</span>
                </label><br>


                <label class="switch-label" for="hipertensao">
                    <input type="checkbox" id="hipertensao" name="hipertensao" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Hipertensão</span>
                </label><br>

                <label class="switch-label" for="depressao">
                    <input type="checkbox" id="depressao" name="depressao" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Depresssão</span>
                </label><br>

                <label class="switch-label" for="pos_covid">
                    <input type="checkbox" id="pos_covid" name="pos_covid" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Pós-covid</span>
                </label><br>
-->

            </fieldset>
        </div><!-- form-group -->

        <div class="form-group right w50">

        <?php if ($sexo != 'M'): ?>
            <fieldset style="border: none;">
                <legend>Dados de Mulheres</legend>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:5px">
                <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" id="gestante" name="gestante" value="1"/>
                    <span class="checkbox-tile">
                    <span class="checkbox-icon">
                    
                    
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/gestante.svg" alt="Ícone Gestante">

                    </span><br>
                    <span class="checkbox-label">Gestante</span>
                    </span>
                </label>
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:5px">
                <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" id="posparto" name="posparto" value="1"/>
                    <span class="checkbox-tile">
                    <span class="checkbox-icon">
                    
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/posparto.svg" alt="Ícone Pós parto">

                    </span><br>
                    <span class="checkbox-label">Pós parto</span>
                    </span>
                </label>
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:5px">
                <label class="checkbox-wrapper">
                    <input type="checkbox" class="checkbox-input" id="emagrecer" name="emagrecer" value="1"/>
                    <span class="checkbox-tile">
                    <span class="checkbox-icon">
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/emagrecer.svg" alt="Ícone deseja emagrecer">


                    </span><br>
                    <span class="checkbox-label">Emagrecer</span>
                    </span>
                </label>
                </div>




                <!-- Campos específicos para mulheres 
                <label class="switch-label" for="deseja emagrecer">
                    <input type="checkbox" id="gestante" name="gestante" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Gestante</span>
                </label><br>


                <label class="switch-label" for="posparto">
                    <input type="checkbox" id="posparto" name="posparto" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Pós-parto</span>
                </label><br>

                <label class="switch-label" for="emagrecer">
                    <input type="checkbox" id="emagrecer" name="emagrecer" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Deseja emagrecer</span>
                </label><br>

                -->
            </fieldset>
        <?php endif; ?>
        </div>    
    
    <div class="clear"></div><!-- clear -->           
    <div class="form-group">
        <input type="submit" name="acao" value="Enviar"/>
    </div><!-- form-group -->
    </form>
</div><!-- box-content -->

<!-- Modal -->
<div id="modalObjetivo" style="display:none;">
    <div class="modal-content">
        <form method="post">
            <h3>Adicionar Novo Objetivo</h3>
            <input type="text" name="novo_objetivo_texto" placeholder="Digite o novo objetivo" required>
            <input type="submit" name="novo_objetivo" value="Adicionar">
            <button type="button" onclick="document.getElementById('modalObjetivo').style.display='none'">Fechar</button>
        </form>
    </div>
</div>


