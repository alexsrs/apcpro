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
                <h1>TOTAL DE ATLETAS</h1>
                <h1><?php echo $totalAtletas ?></h1>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h1>EM RISCO DE LESÃO</h1>
                <h1><?php echo "0" ?></h1>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h1>TREINOS HOJE</h1>
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
        <input type="text" name="telefone" placeholder="DDD + Telefone "  data-mask="(00) 00000-0000" required/>
    </div><!-- form-group -->
    <div class="form-group w33">
        <label>Acompanhamento:</label>
        <input type="radio" id="online" name="acompanhamento" value="0" checked>
        <label for="online">Online</label>
        <input type="radio" id="presencial" name="acompanhamento" value="1">
        <label for="presencial">Presencial</label><br>
    
        <input type="submit" name="acao" value="Convite"/>
    </div><!-- form-group -->
    <div class="clear"></div><!-- clear -->
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
        new QRCode(document.getElementById('qrcode'), 'https://apcpro.com.br/cadastro-online.php?professor_id=" . $professor_id . "&cargo=" . $cargo . "&grupo=" . $grupo_id . "&acompanhamento=" . $acompanhamento . "');
    </script>";
}
?>
</div><!-- box-content -->
<div class="clear"></div><!-- clear -->
<div class="box-content left w50">
    <h4>Avaliações realizadas nos últimos 7 dias (<?php echo calcularPeriodoUltimos7Dias();?>) </h4>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>IP</span>
            </div><!-- col -->
            <div class="col">
                <span>Última ação</span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->

        <div class="row">
            <div class="col">
                <span><?php echo "teste" ?></span>
            </div><!-- col -->
            <div class="col">
                <span><?php echo "teste" ?></span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->
    
    </div><!-- table-responsive -->

</div><!-- box-content -->
    
<div class="box-content right w50">
    <h4>Treinos realizados nos últimos 7 dias (<?php echo calcularPeriodoUltimos7Dias();?>) </h4>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>User</span>
            </div><!-- col -->
            <div class="col">
                <span>Nome</span>
            </div><!-- col -->
            <div class="col">
                <span>Cargo</span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->

        <div class="row">
            <div class="col">
                <span><?php echo "1" ?></span>
            </div><!-- col -->
            <div class="col">
                <span><?php echo "1" ?></span>
            </div><!-- col -->
            <div class="col">
                <span><?php echo "1" ?></span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->
    </div><!-- table-responsive -->
</div><!-- box-content -->
<div class="clear"></div><!-- clear -->
<?php include_once('pages/listar-usuarios.php'); ?>