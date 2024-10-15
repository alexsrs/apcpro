<?php 
// Início da sessão e verificação de permissão
verificaPermissaoPagina(1); // Verifica se o usuário tem permissão para acessar a página

require_once('../config.php');

if (isset($_GET['id'])) {
    $usuarioID = (int)$_GET['id'];

    // Busca os dados do usuário pelo ID
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$usuarioID]);
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);

    // Verifica se o usuário existe
    if (!$usuario) {
        echo "Usuário não encontrado!";
        exit;
    }
} else {
    echo "ID do usuário não especificado.";
    exit;
}
?>


<div class="box-content">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> Visualizar Perfil</h2>

    <div class="perfil-info">

    <?php
        if($usuario['img'] == ''){
            ?>
            <div class="avatar-usuario">
                <i class="fa fa-user"></i>
            </div><!-- avatar-usuario -->
            <?php } else { ?>
            <div class="imagem-usuario">
                <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $usuario['img']; ?>" alt="Foto do Usuário" class="perfil-img">
            </div><!-- imagem-usuario -->
        <?php } 
    ?> <!-- fechando o IF lá de cima -->    
        <p><strong>Nome:</strong> <?php echo htmlspecialchars($usuario['nome']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($usuario['email']); ?></p>
        <p><strong>Telefone:</strong> <?php echo htmlspecialchars($usuario['telefone']); ?></p>
        <p><strong>Data de Nascimento:</strong> <?php echo htmlspecialchars(date('d/m/Y', strtotime($usuario['data_nascimento']))); ?></p>
        <p><strong>Data de Início:</strong> <?php echo htmlspecialchars(date('d/m/Y', strtotime($usuario['data_inicio']))); ?></p>
        <p><strong>Gênero:</strong> <?php echo htmlspecialchars($usuario['sexo'] == 'm' ? 'Masculino' : 'Feminino'); ?></p>
        <p><strong>CPF:</strong> <?php echo htmlspecialchars($usuario['cpf']); ?></p>
    </div>

    <a href="<?php echo INCLUDE_PATH_PAINEL . 'listar-usuarios'; ?>" class="btn voltar">Voltar para a lista de usuários</a>
</div><!-- box-content -->


