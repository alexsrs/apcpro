<?php 
    verificaPermissaoPagina(0);
?>

<div class="box-content">
<h2><i class="fa fa-pencil" aria-hidden="true"></i> Informe as condições de saúde atuais:</h2>
    <form method="post">
        
        <?php

            if (isset($_POST['acao'])) {
                // Obtém o usuario_id da sessão
                $usuario_id = $_SESSION['id'];
                $data_avaliacao = (new DateTime())->format('Y-m-d');
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

                // Salva o perfil do usuário
                $perfil = new Perfil();
                $perfil->cadastrarPerfil($usuario_id, $data_avaliacao, $peso, $altura, $obesidade, $diabetes, $hipertensao, $depressao, $pos_covid, $idoso, $gestante, $posparto, $emagrecer);

                Painel::alert('sucesso', 'Perfil cadastrado com sucesso');
            }
        ?>
        <!-- Perguntas adicionais -->
        <p>Responda as perguntas para aplicação da ANAMNESE INTELIGENTE que é mais
rápida, prática e com maior possibilidade de aplicação pelo personal
trainer na prescrição do programa de treinamento individualizado.</p>
        
        <div class="form-group left w50">
            <label>Peso:</label>
            <input type="text" name="peso">
        </div><!-- form-group -->

        <div class="form-group right w50">
            <label>Altura:</label>
            <input type="text" name="altura">
        </div><!-- form-group -->
        <div class="clear"></div><!-- clear -->

        <fieldset class="left w50">
        <legend>Dados de saúde</legend>
            <label for="obesidade">
                <input type="checkbox" id="obesidade" name="obesidade" value="1"> Obesidade
            </label><br>
            
            <label for="diabetes">
                <input type="checkbox" id="diabetes" name="diabetes" value="1"> Com diabetes mellitus
            </label><br>

            <label for="hipertensao">
                <input type="checkbox" id="hipertensao" name="hipertensao" value="1"> Com hipertensão arterial
            </label><br>

            <label for="depressao">
                <input type="checkbox" id="depressao" name="depressao" value="1"> Com depressão
            </label><br>

            <label for="pos_covid">
                <input type="checkbox" id="pos_covid" name="pos_covid" value="1"> Fase pós-covid
            </label><br>
        </fieldset>
        
        <fieldset class="right w50">
        <legend>Dados de Mulheres</legend>
        <label for="gestante">
            <input type="checkbox" id="gestante" name="gestante" value="1"> Mulheres Gestantes
        </label><br>

        <label for="posparto">
            <input type="checkbox" id="posparto" name="posparto" value="1"> Mulheres no pós-parto
        </label><br>

        <label for="emagrecer">
            <input type="checkbox" id="emagrecer" name="emagrecer" value="1"> Mulheres que desejam emagrecer
        </label><br><br>

        </fieldset>
        
        <div class="clear"></div><!-- clear -->
        <div class="form-group">
            <input type="submit" name="acao" value="Enviar"/>
        </div><!-- form-group -->
    </form>
</div><!-- box-content -->