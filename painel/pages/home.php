<?php 

    // contador usuarios online
    $usuariosOnline = Painel::listarUsuariosOnline();

    // Contador de visitas totais
    $pegarVisitasTotais = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas`");
    $pegarVisitasTotais->execute();
    $pegarVisitasTotais = $pegarVisitasTotais->rowCount();

    // contador de visitas hoje
    $pegarVisitasHoje = MySql::conectar()->prepare("SELECT * FROM `tb_admin.visitas` WHERE dia =?");
    $pegarVisitasHoje->execute(array(date('Y-m-d')));
    $pegarVisitasHoje = $pegarVisitasHoje->rowCount();


?>
<div class="box-content left w100">
    <h2><i class="fa fa-home"></i> Painel de controle - <?php echo NOME_EMPRESA ?></h2>
    <div class="box-metricas">
    <div class="box-metrica-single">
        <div class="box-metrica-wraper">
            <h2>Usuários  online</h2>
                <p><?php echo count($usuariosOnline); ?></p>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Total de visitas</h2>
                <p><?php echo $pegarVisitasTotais; ?></p>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h2>Visitas hoje</h2>
                <p><?php echo $pegarVisitasHoje; ?></p>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="clear"></div><!--clear -->
    </div><!-- box-metricas -->
</div><!-- box-content -->
   



<div class="box-content left w100">
    <h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuários online no site</h2>
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

    <?php 
        foreach ($usuariosOnline as $key => $value) {

    ?>
        <div class="row">
            <div class="col">
                <span><?php echo $value['ip'] ?></span>
            </div><!-- col -->
            <div class="col">
                <span><?php echo date('d/m/Y H:i:s',strtotime($value['ultima_acao'])) ?></span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->
    <?php } ?>
    </div><!-- table-responsive -->

</div><!-- box-content -->
     
<div class="box-content left w100">
    <h2><i class="fa fa-rocket" aria-hidden="true"></i> Usuários no painel</h2>
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

    <?php
        $usuariosPainel = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios`");
        $usuariosPainel->execute();
        $usuariosPainel = $usuariosPainel->fetchAll();
        foreach ($usuariosPainel as $key => $value) {

    ?>
        <div class="row">
            <div class="col">
                <span><?php echo $value['user'] ?></span>
            </div><!-- col -->
            <div class="col">
                <span><?php echo $value['nome'] ?></span>
            </div><!-- col -->
            <div class="col">
                <span><?php echo pegaCargo($value['cargo']); ?></span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->
    <?php } ?>
    </div><!-- table-responsive -->

</div><!-- box-content -->


    <div class="box-content left w50">
        
    </div><!-- box-content -->




    <div class="box-content right w50">
        
    </div><!-- box-content -->