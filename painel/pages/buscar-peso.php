<?php 

// Conectar ao banco de dados
verificaPermissaoPagina(0);

// Verifica se o ID foi passado
if (isset($_GET['id'])) {
    $usuario_id = (int)$_GET['id'];

    // Faz a consulta para buscar o peso do usuário
    $sql = MySql::conectar()->prepare("SELECT peso FROM `tb_perfis_usuarios` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
    $sql->execute([$usuario_id]);

    if ($sql->rowCount() > 0) {
        $peso = $sql->fetch()['peso'];
        // Retorna o peso como JSON
        echo $peso;
    } else {
        // Retorna uma resposta de erro caso o usuário não seja encontrado
        echo json_encode(['erro' => 'Usuário não encontrado']);
    }
} else {
    // Retorna uma resposta de erro caso o ID não seja passado
    echo json_encode(['erro' => 'ID não fornecido']);
}
?>
