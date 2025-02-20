<?php
// Contador de visitas totais
    $id = $_SESSION['id'];
    $totalAtletas = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE `professor_id` = $id");
    $totalAtletas->execute();
    $totalAtletas = $totalAtletas->rowCount();
?>
<div class="box-content left w100">
    <h2><i class="fa fa-home"></i> Dashboard - <?php echo NOME_EMPRESA ?></h2>

    <div class="box-metricas">
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h1>PROFESSORES</h1>
                <h1><?php echo $totalAtletas ?></h1>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h1>TOTAL DE USUARIOS</h1>
                <h1><?php echo "0" ?></h1>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h1>TOTAL DE ALUNOS</h1>
                <h1><?php echo "13"; ?></h1>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="clear"></div><!--clear -->
    </div><!-- box-metricas -->

    <form method="post" enctype="multipart/form-data">
    <div class="form-group flex-container">
        <div class="select-container">
            <label>Grupo</label>
            <select name="grupo">
                <option value="0">-- Selecione para adicionar a um grupo --</option>
                <?php 
                foreach ($grupos as $grupo) {
                    echo '<option value="'.$grupo['id'].'">'.$grupo['grupo'].'</option>';
                }
                ?>
            </select>
        </div><!-- select-container -->
        <div class="button-container">
            <button type="button" onclick="document.getElementById('modalGrupo').style.display='flex'">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </div><!-- button-container -->
    </div><!-- form-group -->
    <div class="form-group w33">
        <label>Cadastre o atleta</label>
        <input type="text" name="telefone" data-mask="(00) 00000-0000" required/>
        <input type="submit" name="acao" value="Gerar convite"/>
         
        </div><!-- form-group -->
        </form>

<!-- Exibir link do WhatsApp após o envio do formulário -->
<?php
if ($linkWhatsApp) {
    echo "<div class='whatsapp-container'>";
    echo "<div class='whatsapp-button'>$linkWhatsApp</div>";
    echo "<div id='qrcode'></div>";
    echo "</div>";
    echo "
    <script src='https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js'></script>
    <script type='text/javascript'>
        new QRCode(document.getElementById('qrcode'), 'https://apcpro.com.br/cadastro-online.php?professor_id=" . $professor_id . "&cargo=" . $cargo . "&grupo=" . $grupo_id . "');
    </script>";
}
?>
</div><!-- box-content -->

<div class="clear"></div><!-- clear -->

<?php include_once('pages/listar-usuarios.php'); ?>