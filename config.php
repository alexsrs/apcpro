<?php
	
	/* 
	TODO:  Variável global com os cargos estamos usando 2 mais vamos otimizar e unificar
	*/




	//Carregar classes 	

	session_start();
	date_default_timezone_set('America/Sao_Paulo');

	$autoload = function($class){
		if($class =="Email"){
			require_once('classes/phpmailer/PHPMailerAutoload.php');
		}
			include('classes/'.$class.'.php');
		};

	spl_autoload_register($autoload);

	// site on line
	//define('INCLUDE_PATH','https://www.apcpro.com.br/');
	//define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
	//define('BASE_DIR_PAINEL',__DIR__.'/painel');
	//ConexÃ£o com Banco de dados
	//define('HOST','localhost');
	//define('USER','apcpro25');
	//define('PASSWORD','Sofi@171216');
	//define('DATABASE','apcpro25_apcpro');

	//Site local ambiente de teste 
	define('INCLUDE_PATH','http://localhost/apcpro/');
	define('INCLUDE_PATH_PAINEL',INCLUDE_PATH.'painel/');
	define('BASE_DIR_PAINEL',__DIR__.'/painel');

	//Conexão com Banco de dados
	define('HOST','localhost');
	define('USER','root');
	define('PASSWORD','');
	define('DATABASE','apcpro');

	//constantes para o painel de controle
	define('NOME_EMPRESA','APC Pro');

	// Funções
	function pegaCargo($indice){
		return Painel::$cargos[$indice];
	}

	// Funcão atualizada abaixo para versão atual do PHP
	
	// function selecionadoMenu($par){
	//	$url = explode('/',@$_GET['url'])[0];
	//		if($url == $par){
	//			echo 'class="menu-active"';
	//		}
	//	}

	function selecionadoMenu($par) {
		// Verifica se o parâmetro 'url' existe e captura o valor, senão define uma string vazia
		$url = isset($_GET['url']) ? explode('/', filter_var($_GET['url'], FILTER_SANITIZE_URL))[0] : '';
		// Compara a URL com o parâmetro passado e aplica a classe CSS se forem iguais
		if ($url === $par) {
			echo 'class="menu-active"';
		}
	}

	function verificaPermissaoMenu($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		} else {
			echo 'style="display:none;"';
		}
	}

	function verificaPermissaoMenuPreciso($permissao){
		if($_SESSION['cargo'] == $permissao){
			return;
		} else {
			echo 'style="display:none;"';
		}
	}

	function verificaPermissaoPagina($permissao){
		if($_SESSION['cargo'] >= $permissao){
			return;
		} else {
			include('painel/pages/permissao-negada.php');
			die();
		}
	}

	function verificaPermissaoPaginaPreciso($permissao){
		if($_SESSION['cargo'] == $permissao){
			return;
		} else {
			include('painel/pages/permissao-negada.php');
			die();
		}
	}
?>