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
	<style>
		
	</style>
</head>
<header>
		<div class="center">
			<div class="logo left"><img src="<?php echo INCLUDE_PATH ?>images/logomarca-h.png"/></div><!-- logo -->
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
<body>
<?php if (!empty($response['mensagem'])) { echo "<div class='alert'>{$response['mensagem']}</div>"; } ?>


<?php

include('classes/Painel.php'); // Inclua o arquivo que contém a definição da classe Painel

$response = ['sucesso' => false]; // Inicializa a chave 'sucesso' como false

if (isset($_GET['professor_id']) && isset($_GET['cargo']) && isset($_GET['grupo'])) {
    $professor_id = (int)$_GET['professor_id']; // Professor passado pela URL
    $cargo_convite = (int)$_GET['cargo']; // Cargo passado pela URL
    $grupo = (int)$_GET['grupo']; // Grupo passado pela URL
  
}

//echo $professor_id;
//echo $cargo_convite;
//echo $grupo;


if(isset($_POST['acao'])){
    $user = $_POST['user'];
    $nome = $_POST['nome'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];
    $telefone = $_POST['telefone'];
    $data_nascimento = $_POST['data_nascimento'];
    $data_inicio = $_POST['data_inicio'];
    $sexo = $_POST['sexo'];
    $cpf = $_POST['cpf'];
    $imagem = $_FILES['imagem'];

    // Definindo o cargo do novo usuário baseado no cargo do convite
    if ($cargo_convite == 2) {
        $cargo = 1;
    } elseif ($cargo_convite == 1) {
        $cargo = 0;
    } else {
        Painel::alert('erro', 'Você não tem permissão para adicionar usuários.');
        exit;
    }

    // validar os campos antes de add
    if ($user == '') {
        //$response['mensagem'] = 'O login está vazio';
        Painel::alert('erro', 'O email está vazio');
    } else if ($nome == '') {
        //$response['mensagem'] = 'O nome está vazio';
        Painel::alert('erro', 'O nome está vazio');
    } else if ($password == '') {
        //$response['mensagem'] = 'A senha está vazia';
        Painel::alert('erro', 'A senha está vazia');
    } else if ($telefone == '') {
        //$response['mensagem'] = 'O telefone precisa ser informado';
        Painel::alert('erro', 'O telefone precisa ser informado');
    } else if ($data_nascimento == '') {
        //$response['mensagem'] = 'A data de nascimento precisa ser informada';
        Painel::alert('erro', 'A data de nascimento precisa ser informada');
    } else if ($data_inicio == '') {
        //$response['mensagem'] = 'A data de início de treinamento precisa ser informada';
        Painel::alert('erro', 'A data de início de treinamento precisa ser informada');
    } else if ($sexo == '') {
        //$response['mensagem'] = 'O gênero precisa ser informado';
        Painel::alert('erro', 'O gênero precisa ser informado');
    } else if ($cpf == '') {
        //$response['mensagem'] = 'O CPF precisa ser informado';
        Painel::alert('erro', 'O CPF precisa ser informado');
    } else if ($password !== $confirmPassword) {
        //$response['mensagem'] = 'As senhas não correspondem. Por favor, verifique.';
        Painel::alert('erro', 'As senhas não correspondem. Por favor, verifique.');
    } else {
        // podemos cadastrar !
        if ($cargo >= $cargo_convite) {
            //$response['mensagem'] = 'Você não pode cadastrar um usuário com permissões maiores que as suas';
            Painel::alert('erro', 'Você não pode cadastrar um usuário com permissões maiores que as suas');
        } else if (Usuario::userExists($user)) {
            //$response['mensagem'] = 'O login já está em uso, selecione outro';
            Painel::alert('erro', 'O login já está em uso, selecione outro');
        } else {
            // Apenas cadastrar no banco de dados 
            $usuario = new Usuario();
            $img = $imagem['name'] ? Painel::uploadImagem($imagem) : 'default.jpg'; // Define um valor padrão se a imagem não for enviada
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
            $usuario->cadastrarUsuario($user, $hashedPassword, $img, $nome, $cargo, $telefone, $data_nascimento, $data_inicio, $sexo, $cpf, $professor_id, $grupo);

            $response['sucesso'] = true;
            Painel::alert('sucesso', 'Cadastro realizado com sucesso!');
            session_destroy();
            // Redirecionamento PHP após o cadastro com sucesso
            echo '<script>
                alert("Cadastro realizado com sucesso!");
                window.location.href = "' . INCLUDE_PATH_PAINEL . 'index";
            </script>';
            exit();
            //header('Location: ' . INCLUDE_PATH_PAINEL . 'login.php');
        }   
    }
} 


?>

<div class="box-content-cadastro">


<form method="post" enctype="multipart/form-data"> <!-- sem o atributo enctype nao envia a imagem -->

    <div class="form-group w50">
        <label>Email:</label>
        <input type="email" name="user" autocomplete="__away">
    </div><!-- form-group -->

    <div class="form-group w50 left">
        <label>Senha:</label>
        <div class="password-wrapper">
            <input type="password" id="password" name="password" required>
            <i class="fa fa-eye" id="togglePassword" style="cursor: pointer;"></i>
        </div>
    </div><!-- form-group -->

    <div class="form-group w50 right" >
        <label for="confirm_password">Confirme a Senha:</label>
        <div class="password-wrapper">
            <input type="password" id="confirm_password" name="confirm_password" required>
            <i class="fa fa-eye" id="toggleConfirmPassword" style="cursor: pointer;"></i>
        </div>
    </div><!-- form-group -->

    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome">
    </div><!-- form-group -->

    <div class="form-group">
        <label>Imagem:</label>
        <input type="file" name="imagem" />
        <input type="hidden" name="imagem_atual" />
    </div><!-- form-group --> 

    <div class="form-group">
        <label>Telefone:</label>
        <input type="text" name="telefone" data-mask="(00) 00000-0000" />
    </div><!-- form-group -->

    <div class="form-group">
        <label>Gênero:</label>
        <select name="sexo">
            <?php 
                foreach (Painel::$sexos as $key => $value){
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
            ?>
        </select>
    </div><!-- form-group -->

    <div class="form-group">
        <label>CPF:</label>
        <input type="text" name="cpf" data-mask="000.000.000-00" />
    </div><!-- form-group -->

    <div class="form-group">
        <label>Data de nascimento:</label>
        <input type="date" name="data_nascimento" />
    </div><!-- form-group -->

    <div class="form-group">
        <label>Início do treinamento:</label>
        <input type="date" name="data_inicio" />
    </div><!-- form-group -->
    <div class="clear"></div><!-- clear -->
    
    <div class="form-group">
        <input type="submit" name="acao" value="Cadastrar"/>
    </div><!-- form-group -->
</form>

</div><!-- box-content -->
<footer class="">
		<div class="center">
			<p>APC Pro - Todos os direitos reservados</p>
		</div><!-- center -->	
	</footer>
	<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
	<script src="<?php echo INCLUDE_PATH; ?>js/constant.js"></script>
    <script src="<?php echo INCLUDE_PATH_PAINEL ?>js/jquery.mask.js"></script>
<script src="<?php echo INCLUDE_PATH_PAINEL ?>js/main.js"></script>
<script>
document.getElementById('togglePassword').addEventListener('click', function() {
    var passwordField = document.getElementById('password');
    var type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

document.getElementById('toggleConfirmPassword').addEventListener('click', function() {
    var confirmPasswordField = document.getElementById('confirm_password');
    var type = confirmPasswordField.getAttribute('type') === 'password' ? 'text' : 'password';
    confirmPasswordField.setAttribute('type', type);
    this.classList.toggle('fa-eye-slash');
});

document.querySelector('form').addEventListener('submit', function(event) {
    var password = document.getElementById('password').value;
    var confirmPassword = document.getElementById('confirm_password').value;
    
    if (password !== confirmPassword) {
        event.preventDefault(); // Impede o envio do formulário
        alert('As senhas não correspondem. Por favor, verifique.');
    }
});
</script>
    </body>
</html>