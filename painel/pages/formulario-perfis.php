<?php 
    verificaPermissaoPagina(0);
    include_once('pages/funcoes.php');
?>

<div class="box-content">
<h2><i class="fa fa-pencil" aria-hidden="true"></i> Informe as condições de saúde atuais:</h2>
    <form method="post">   
        <?php
            if (isset($_POST['acao'])) {
                // Obtém o usuario_id da sessão
                $usuario_id = $_SESSION['id'];
                $data_avaliacao = (new DateTime())->format('Y-m-d H:i:s');
                $peso = $_POST['peso'];
                $altura = $_POST['altura'];
                // Obtém os dados do formulário e define valor padrão 0 para não marcados
                $obesidade = isset($_POST['obesidade']) ? 1 : 0;
                $diabetes = isset($_POST['diabetes']) ? 1 : 0;
                $hipertensao = isset($_POST['hipertensao']) ? 1 : 0;
                $depressao = isset($_POST['depressao']) ? 1 : 0;
                $pos_covid = isset($_POST['pos_covid']) ? 1 : 0;

                // Verifica se a data de nascimento está definida na sessão
                if (isset($_SESSION['dataNascimento'])) {
                    $dataNascimento = new DateTime($_SESSION['dataNascimento']);
                    $idade = (new DateTime())->diff($dataNascimento)->y;
                    $idoso = $idade >= 65 ? 1 : 0;
                } else {
                    $idoso = 0; // Considera como não idoso caso a data de nascimento não esteja disponível
                }

                $gestante = isset($_POST['gestante']) ? 1 : 0;
                $posparto = isset($_POST['posparto']) ? 1 : 0;
                $emagrecer = isset($_POST['emagrecer']) ? 1 : 0;
                $objetivo = $_POST['objetivo'];

                // Salva o perfil do usuário
                $perfil = new Perfil();
                $perfil->cadastrarPerfil($usuario_id, $data_avaliacao, $peso, $altura, $obesidade, $diabetes, $hipertensao, $depressao, $pos_covid, $idoso, $gestante, $posparto, $emagrecer, $objetivo);

                Painel::alert('sucesso', 'Pré-avaliação cadastrado com sucesso');
                
                //session_write_close(); // Grava os dados da sessão no servidor
               //session_start(); // Reinicia a sessão para recarregar as variáveis
                $anamneseLink = obterLinkAnamnese($usuario_id); // Obtenha o link correto após salvar os dados
                echo "<script>window.location.href='" . INCLUDE_PATH_PAINEL . $anamneseLink . "'</script>";

                //header('Location: ' . INCLUDE_PATH_PAINEL . $anamneseLink);
                exit(); // Encerra o script imediatamente para evitar execução adicional

            }
            
            // Adiciona um novo objetivo
            if (isset($_POST['novo_objetivo'])) {
                $novo_objetivo = $_POST['novo_objetivo_texto'];
                if (!empty($novo_objetivo)) {
                    $sql = MySql::conectar()->prepare("INSERT INTO tb_objetivos_treinamento (objetivo) VALUES (?)");
                    $sql->execute([$novo_objetivo]);
                    Painel::alert('sucesso', 'Novo objetivo adicionado com sucesso!');
                }
            }
        ?>
        <!-- Perguntas adicionais -->
        <p>Responda as perguntas para aplicação da ANAMNESE INTELIGENTE de forma mais
rápida, prática e com maior possibilidade de prescrição de um programa de treinamento individualizado.</p>
        
        <div class="form-group left w50"> 
            <label for="peso">Peso: </label>
            <input type="range" id="peso" class="slider" name="peso" min="40.0" max="299.9" step="0.1" value="50.0" oninput="updatePeso(this.value)">
                </br>
            <input type="text" id="peso-valor" value="50.0 Kg"></input>
           <!-- <span id="peso-valor">50.0</span> kg -->
            <script>
                function updatePeso(value) {
                    document.getElementById('peso-valor').value = parseFloat(value).toFixed(1) + ' Kg';
                }
            </script>
        </div><!-- form-group -->

        <div class="form-group right w50"> 
            <label for="altura">Altura: </label>
            <input type="range" id="altura" class="slider" name="altura" min="1.20" max="2.51" step="0.01" value="1.50" oninput="updateAltura(this.value)">
                </br>
            <input type="text" id="altura-valor" value="1.50 m"></input>
            <!-- <span id="altura-valor">1.50</span> m -->
            <script>

                function updateAltura(value) {
                    document.getElementById('altura-valor').value = parseFloat(value).toFixed(2) + ' m';
                }
             
            </script>
        </div><!-- form-group -->
        <div class="clear"></div><!-- clear -->

        <div class="form-group left w50">       
            <fieldset>
                <legend>Dados de saúde</legend>

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
            </fieldset>
        </div><!-- form-group -->

        <div class="form-group right w50">
            <fieldset>
                <legend>Dados de Mulheres</legend>
                <label class="switch-label" for="gestante">
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
            </fieldset>
        </div><!-- form-group -->
        
        <div class="clear"></div><!-- clear -->

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


