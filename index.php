<?php include_once('config.php'); ?>
<?php Site::updateUsuarioOnline(); ?>
<?php Site::contador(); ?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<title>APC Pro</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link rel="preconnect" href="https://fonts.gstatic.com">
	<link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="<?php echo INCLUDE_PATH; ?>estilo/style.css">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="keywords" content="palavras-chave,do,meu,site">
	<meta name="description" content="Descrição do meu website">
	<meta charset="utf-8" />
</head>
<body>
	<base base="<?php echo INCLUDE_PATH; ?>" />
	<?php 
		$url = isset($_GET['url']) ? $_GET['url'] : 'home';
		switch ($url) {
			case 'sobre':
				echo '<target target="sobre" />';
				# code...
				break;
			case 'funcionalidades':
				echo '<target target="funcionalidades" />';
				# code...
				break;		
		}
	?>
	<div class="sucesso">Formulário enviado com sucesso!</div>
	<div class="erro">Erro no envio do Formulário!</div>
	<div class="overlay-loading">
		<img src="<?php echo INCLUDE_PATH ?>images/ajax-loader.gif" />
	</div><!--overlay-loading-->
	
	<header>
		<div class="center">
			<div class="logo left"><a href="<?php echo INCLUDE_PATH; ?>">APC Pro</a></div><!-- logo -->
			<nav class="desktop right">
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>funcionalidades">Funcionalidades</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
					<li><a realtime="entrar" href="<?php echo INCLUDE_PATH_PAINEL; ?>"><span>Entrar</span></a></li>
				</ul>
			</nav>
			<nav class="mobile right">
				<div class="botao-menu-mobile"><i class="fa fa-bars"></i></div>
				<ul>
					<li><a href="<?php echo INCLUDE_PATH; ?>">Home</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>sobre">Sobre</a></li>
					<li><a href="<?php echo INCLUDE_PATH; ?>funcionalidades">Funcionalidades</a></li>
					<li><a realtime="contato" href="<?php echo INCLUDE_PATH; ?>contato">Contato</a></li>
					<li><a realtime="entrar" href="<?php echo INCLUDE_PATH_PAINEL; ?>"><span>Entrar</span></a></li>
				</ul>
			</nav>
			<div class="clear"></div><!-- clear -->
		</div><!-- center -->
	</header>

<div class="container-principal">	
<?php 
	if(file_exists('pages/'.$url.'.php')){
		include('pages/'.$url.'.php');
	} else {
		// podemos fazer o que quiser poir a pagina nao existe
		if ($url != 'sobre' && $url != 'funcionalidades') {
			$pagina404 = true;
			include('pages/404.php');
			# code...
		} else {
			include('pages/home.php');
		}
	}
?>
</div><!--container-principal-->
	<footer class="">
		<div class="center">
			<p>APC Pro - Todos os direitos reservados</p>
		</div><!-- center -->	
	</footer>
	<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constant.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&key=AIzaSyCnh9a-0dAbErxqWnQiJQqfL4DU_9YLEb8"></script>
	<script src="<?php echo INCLUDE_PATH;?>js/initMap.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/scripts.js"></script>
	<?php 
		if ($url == 'home' || $url =='') {
	?>
		<script src="<?php echo INCLUDE_PATH; ?>js/slider.js"></script>
	<?php } ?>
	<?php
		if($url == 'contato'){
	?>
<?php } ?>
	<script src="<?php echo INCLUDE_PATH; ?>js/formularios.js"></script>
</body>
</html>