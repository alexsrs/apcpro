<?php 
//session_start();
verificaPermissaoPagina(1); // Verifica se o usuário tem permissão para acessar a página

// Conexão com o banco de dados
require_once('../config.php');

// Busca todos os usuários associados ao professor logado
$professorID = $_SESSION['id'];
$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE professor_id = ?");
$sql->execute(array($professorID));
$usuarios = $sql->fetchAll();
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Alunos</title>
    <link href="<?php echo INCLUDE_PATH; ?>css/style.css" rel="stylesheet"/>
</head>
<body>
    <div class="box-content">
        <h2><i class="fa fa-users" aria-hidden="true"></i> Lista de Alunos</h2>

        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Data de Nascimento</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php if(count($usuarios) > 0): ?>
                    <?php foreach($usuarios as $usuario): ?>
                        <tr>
                            <td><?php echo $usuario['id']; ?></td>
                            <td><?php echo $usuario['nome']; ?></td>
                            <td><?php echo $usuario['email']; ?></td>
                            <td><?php echo $usuario['data_nascimento']; ?></td>
                            <td>
                                <a href="editar_usuario.php?id=<?php echo $usuario['id']; ?>">Editar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">Nenhum aluno cadastrado.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div><!-- box-content -->
</body>
</html>
