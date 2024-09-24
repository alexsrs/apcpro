<?php 
    if(isset($_GET['logout'])){
        Painel::logout();
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel de controle</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- <link href="<?php echo INCLUDE_PATH; ?>css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>css/fontawesome.css" rel="stylesheet">
 	<link href="<?php echo INCLUDE_PATH; ?>css/brands.min.css" rel="stylesheet">
	<link href="<?php echo INCLUDE_PATH; ?>css/solid.min.css" rel="stylesheet"> -->
    <link href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css" rel="stylesheet"/> 

</head>
<body>  
<div class="menu">
    <div class="menu-wraper">
        <div class="box-usuario">         
            <?php
                if($_SESSION['img'] == ''){
            ?>
                <div class="avatar-usuario">
                    <i class="fa fa-user"></i>
                </div><!-- avatar-usuario -->
            <?php } else { ?>
                <div class="imagem-usuario">
                    <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $_SESSION['img']; ?>" />
                    
                </div><!-- imagem-usuario -->
            <?php } ?> <!-- fechando o IF lá de cima -->

            <div class="nome-usuario">
                <p><?php echo $_SESSION['nome']; ?></p>
                <p><?php echo pegaCargo($_SESSION['cargo']); ?></p>
            </div><!-- nome-usuario -->
        </div><!-- box-usuario -->
        <div class="items-menu">
            <h2>Cadastro</h2>
            <a <?php selecionadoMenu('cadastrar-depoimento'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">Cadastrar depoimento</a>
            <a <?php selecionadoMenu('cadastrar-servico'); ?>href="">Cadastrar serviço</a>
            <a <?php selecionadoMenu('cadastrar-slider'); ?>href="">Cadastrar slider</a>
            <h2>Gestão</h2>
            <a <?php selecionadoMenu('listar-depoimentos'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar depoimentos</a>
            <a <?php selecionadoMenu('listar-serviços'); ?>href="">Listar serviços</a>
            <a <?php selecionadoMenu('listar-slides'); ?>href="">Listar slides</a>
            <h2>Administração</h2>
            <a <?php selecionadoMenu('editar-usuario'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>editar-usuario">Editar usuário</a>
            <a <?php selecionadoMenu('adicionar-usuario'); ?> <?php verificaPermissaoMenu(2); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-usuario">Adicionar usuário</a>
            <h2>Configuração</h2>
            <a <?php selecionadoMenu('editar-site'); ?>href="">Editar Site</a>
        </div><!-- items-menu -->

    </div><!-- menu-wraper -->
</div><!-- menu -->

    <header> 
        <div class="center">
            <div class="menu-btn">
                <i class="fa fa-bars"></i>
            </div><!-- menu-btn -->

            <div class="logout">
                <a <?php if(@$_GET['url'] == ''){ ?> style="background: #60727a; padding: 8px 15px;" <?php } ?> href="<?php echo INCLUDE_PATH_PAINEL ?>"><i class="fa fa-home"></i><span>Página inicial</span></a>
                <a href="<?php echo INCLUDE_PATH_PAINEL ?>?logout"><i class="fa fa-window-close"></i><span>Sair</span></a>
            </div><!-- logout -->
            <div class="clear"></div><!-- clear -->
        </div> <!-- center -->
    </header>

<div class="content">
    <?php Painel::loadPage(); ?>
    

</div><!-- content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
</body>
</html>





