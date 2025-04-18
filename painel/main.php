<?php 
    if(isset($_GET['logout'])){
        Painel::logout();
    }

    // Utilize include_once para evitar múltiplas inclusões
    include_once('../config.php');
    include_once('pages/funcoes.php'); // Inclua o arquivo com a função separada

    // Verifique se o usuário está logado e se 'id' está definido
    if (!isset($_SESSION['id'])) {
        echo "Usuário não está logado.";
        exit;
    }

    $usuario_id = $_SESSION['id'];
    $anamneseLink = obterLinkAnamnese($usuario_id);
    
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css">
    <link href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css" rel="stylesheet"/>
    <title>APC PRO</title>
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
                <p><?php echo pegaCargo($_SESSION['cargo']); ?></p><br>

                <button><a href="<?php echo INCLUDE_PATH_PAINEL . 'editar-perfil?id=' . $usuario_id; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar perfil</a></button>

            
            </div><!-- nome-usuario -->
        </div><!-- box-usuario -->
        <div class="items-menu">
            <h2 <?php verificaPermissaoMenu(1); ?>id="menu-usuarios" class="ativo"><i class="fa fa-id-card-o" aria-hidden="true"></i> Cadastro de <?php if($_SESSION['cargo'] == 2) { echo 'professores'; } else { echo 'alunos'; } ?></h2>
            <a <?php selecionadoMenu('listar-usuarios'); ?> href="<?php echo INCLUDE_PATH_PAINEL ?>listar-usuarios">Listar <?php if($_SESSION['cargo'] == 2) { echo 'professores'; } else { echo 'alunos'; } ?></a>

            <h2 <?php verificaPermissaoMenu(2); ?>id="menu-analise"><i class="fa fa-line-chart" aria-hidden="true"></i> Análise física avançada</h2>
            <a <?php selecionadoMenu('formulario-perfis'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>formulario-perfis">Avaliação</a>
            <a <?php selecionadoMenu($anamneseLink); ?> href="<?php echo INCLUDE_PATH_PAINEL . $anamneseLink;?>">Anamnese Inteligente</a>
            <a <?php selecionadoMenu('medida-corporal'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>medida-corporal">Medida Corporal</a>
            <a <?php selecionadoMenu('composicao-corporal'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>composicao-corporal">Composição Corporal</a>
            <a <?php selecionadoMenu('aptidao-cardiorespiratoria'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>aptidao-cardiorespiratoria">Aptidão Cardiorespiratória</a>
            <a <?php selecionadoMenu('teste-fisico'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>teste-fisico">Testes Físico</a>
            
            <h2 <?php verificaPermissaoMenuExata(0); ?>id="menu-analisealuno"><i class="fa fa-line-chart" aria-hidden="true"></i> Análise física avançada</h2>
            <a <?php selecionadoMenu('formulario-perfis'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>formulario-perfis">Avaliação</a>
            <a <?php selecionadoMenu($anamneseLink); ?> href="<?php echo INCLUDE_PATH_PAINEL . $anamneseLink;?>">Anamnese Inteligente</a>
            <a <?php selecionadoMenu('medida-corporal'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>medida-corporal">Medida Corporal</a>
            <a <?php selecionadoMenu('composicao-corporal'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>composicao-corporal">Composição Corporal</a>
            <a <?php selecionadoMenu('aptidao-cardiorespiratoria'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>aptidao-cardiorespiratoria">Aptidão Cardiorespiratória</a>
            <a <?php selecionadoMenu('teste-fisico'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>teste-fisico">Testes Físico</a>


       
            <h2 <?php verificaPermissaoMenu(1); ?>id="menu-biblioteca"><i class="fa fa-book" aria-hidden="true"></i> Biblioteca de exercícios</h2>
            <a <?php selecionadoMenu('adicionar-exercicio'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>adicionar-exercicio">Adicionar exercicio</a>
            <a <?php selecionadoMenu('listar-exercicios'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>listar-exercicios">Listar exercícios</a>


            <h2 <?php verificaPermissaoMenuExata(0); ?>id="menu-bibliotecaaluno"><i class="fa fa-book" aria-hidden="true"></i> Biblioteca de exercícios</h2>
            <a <?php selecionadoMenu('listar-exercicios'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>listar-exercicios">Listar exercícios</a>
            
            <h2 <?php verificaPermissaoMenu(1); ?>id="menu-planejamento"><i class="fa fa-calendar" aria-hidden="true"></i> Planejamento de treino</h2>
            <a <?php selecionadoMenu('criar-treino'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>criar-treino">Criar treino</a>
            <a <?php selecionadoMenu('editar-site'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>teste-fisico">Editar Site</a>
            
            
            <h2 <?php verificaPermissaoMenu(1); ?>id="menu-planejamento"><i class="fa fa-calendar" aria-hidden="true"></i> Controlre de treino</h2>
            <a <?php selecionadoMenu('editar-site'); ?>href=""<?php echo INCLUDE_PATH_PAINEL ?>teste-fisico"">Editar Site</a>
            <a <?php selecionadoMenu('editar-site'); ?>href=""<?php echo INCLUDE_PATH_PAINEL ?>teste-fisico">Editar Site</a>
            
            
            <h2 id="menu-monitoramento"><i class="fa fa-bar-chart" aria-hidden="true"></i> Monitoramento e feedback</h2>
            <a <?php selecionadoMenu('editar-site'); ?>href="">Editar Site</a>
            <a <?php selecionadoMenu('editar-site'); ?>href="">Editar Site</a>
            
            
            <h2 id="menu-relatorio"><i class="fa fa-file-text-o" aria-hidden="true"></i> Dados e relatórios</h2>
            <a <?php selecionadoMenu('editar-site'); ?>href="">Editar Site</a>
            <a <?php selecionadoMenu('editar-site'); ?>href="">Editar Site</a>

            <h2 <?php verificaPermissaoMenu(2); ?>id="menu-configuracao"><i class="fa fa-cogs" aria-hidden="true"></i> Configurações do site</h2>
            <a <?php selecionadoMenu('cadastrar-depoimento'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>cadastrar-depoimento">Cadastrar depoimento</a>
            <a <?php selecionadoMenu('listar-depoimentos'); ?>href="<?php echo INCLUDE_PATH_PAINEL ?>listar-depoimentos">Listar depoimentos</a>
            <a <?php selecionadoMenu('cadastrar-funcionalidade'); ?>href="">Cadastrar funcionalidade</a>
            <a <?php selecionadoMenu('listar-funcionalidades'); ?>href="">Listar Funcionalidades</a>
            <a <?php selecionadoMenu('cadastrar-slider'); ?>href="">Cadastrar slider</a>
            <a <?php selecionadoMenu('listar-slides'); ?>href="">Listar slides</a>
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
    <div id="qrcode1"></div> <!-- Added element with id "qrcode1" -->
</div><!-- content -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>


</body>
</html>