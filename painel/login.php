<?php 

    // Verifica se existem cookies válidos
    if(isset($_COOKIE['lembrar'])){
        $user = $_COOKIE['user'];
        $password = $_COOKIE['password'];

        $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ?");
        $sql->execute([$user]);

        if($sql->rowCount() == 1){
            $info = $sql->fetch();
            if (password_verify($password, $info['password'])) {
                // Logamos com sucesso
                $_SESSION['id'] = $info['id'];
                $_SESSION['login'] = true;
                $_SESSION['user'] = $user;
                $_SESSION['cargo'] = $info['cargo'];
                $_SESSION['nome'] = $info['nome'];
                $_SESSION['img'] = $info['img'];
               // $_SESSION['email'] = $info['email'];
                $_SESSION['telefone'] = $info['telefone'];
                $_SESSION['data_nascimento'] = $info['data_nascimento'];
                $_SESSION['data_inicio'] = $info['data_inicio'];
                $_SESSION['sexo'] = $info['sexo'];
                $_SESSION['cpf'] = $info['cpf'];
                header('Location: painel.php');
                exit();
            } else {
                // Senha incorreta
                echo 'Senha incorreta';
            }
        } else {
            // Usuário não encontrado
            echo 'Usuário não encontrado';
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>APC PRO</title>
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300;400;700&display=swap" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>css/fontawesome.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>css/brands.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH; ?>css/solid.min.css" rel="stylesheet">
    <link href="<?php echo INCLUDE_PATH_PAINEL ?>css/style.css" rel="stylesheet"/>
</head>
<body>  
    <div class="box-login">
        <?php 
            if(isset($_POST['acao'])) {
                $user = $_POST['user'];
                $password = $_POST['password'];
                $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE user = ?");
                $sql->execute([$user]);

                if($sql->rowCount() == 1){
                    $info = $sql->fetch();

                    // Verificando a senha criptografada
                    if (password_verify($password, $info['password'])) {
                        // Logamos com sucesso
                        $_SESSION['login'] = true;
                        $_SESSION['id'] = $info['id'];
                        $_SESSION['user'] = $user;
                        $_SESSION['cargo'] = $info['cargo'];
                        $_SESSION['nome'] = $info['nome'];
                        $_SESSION['img'] = $info['img'];
                        //$_SESSION['email'] = $info['email'];
                        $_SESSION['telefone'] = $info['telefone'];
                        $_SESSION['data_nascimento'] = $info['data_nascimento'];
                        $_SESSION['data_inicio'] = $info['data_inicio'];
                        $_SESSION['sexo'] = $info['sexo'];
                        $_SESSION['cpf'] = $info['cpf'];

                        if(isset($_POST['lembrar'])){
                            setcookie('lembrar', true, time()+(60*60*24), '/');
                            setcookie('user', $user, time()+(60*60*24), '/');
                            setcookie('password', $password, time()+(60*60*24), '/');
                        }

                        echo "<script>window.location.href='" . INCLUDE_PATH_PAINEL . "';</script>";
                        die();
                    } else {
                        // Falhou
                        echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
                    }
                } else {
                    // Falhou
                    echo '<div class="erro-box"><i class="fa fa-times"></i> Usuário ou senha incorretos!</div>';
                }
            }
        ?>
        <div class="clear"><!--clear-->
        <div class="logo-login">
            <img decoding="async" src="<?php echo INCLUDE_PATH ?>images/logomarca-v.png" alt="A Descriptive Caption For The Image" title="My Image How To Add An Image Html">
        </div>
        <h2>Faça o login</h2>
        <form method="post">
            <input type="text" name="user" placeholder="Email..." required>
            <input type="password" name="password" placeholder="Senha..." required>
            <div class="form-group-login left">
                <input type="submit" name="acao" value="Entrar">
            </div><!--form-group-login-->
            <div class="form-group-login right">
                <label>Lembrar-me</label>
                <input type="checkbox" name="lembrar" />
            </div><!--form-group-login-->
            <div class="clear"><!--clear-->
        </form>
    </div><!--box-login-->
</body>
</html>
