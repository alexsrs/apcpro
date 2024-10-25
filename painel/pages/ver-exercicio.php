<?php 
// Início da sessão e verificação de permissão
verificaPermissaoPagina(0); // Verifica se o usuário tem permissão para acessar a página

require_once('../config.php');

if (isset($_GET['id'])) {
    $exercicioID = (int)$_GET['id'];

    // Instancia a classe Exercicio
    $exercicio = new Exercicio();

    // Busca os dados do exercício pelo ID
    $dadosExercicio = $exercicio->buscarExercicioPorId($exercicioID);

    // Verifica se o exercício existe
    if (!$dadosExercicio) {
        echo "Exercício não encontrado!";
        exit;
    }
} else {
    echo "ID do exercício não especificado.";
    exit;
}
?>

<div class="box-content">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> Visualizar Exercício</h2>

    <div class="exercicio-info">
        <p><strong>Nome do Exercício:</strong> <?php echo htmlspecialchars($dadosExercicio['nome_exercicio']); ?></p>
        <p><strong>Articulação:</strong> <?php echo htmlspecialchars($dadosExercicio['articulacao']); ?></p>
        <p><strong>Membro:</strong> <?php echo htmlspecialchars($dadosExercicio['membro']); ?></p>
        <p><strong>Grupo Muscular:</strong> <?php echo htmlspecialchars($dadosExercicio['grupo_muscular']); ?></p>
        <p><strong>Aplicação da Força:</strong> <?php echo htmlspecialchars($dadosExercicio['aplicacao_forca']); ?></p>
        <p><strong>Movimento:</strong> <?php echo htmlspecialchars($dadosExercicio['movimento']); ?></p>
        <p><strong>Vídeo:</strong> <a href="<?php echo htmlspecialchars($dadosExercicio['video']); ?>" target="_blank">Assistir</a></p>
        <p><strong>Contra Indicações:</strong> <?php echo htmlspecialchars($dadosExercicio['contra_indicacoes']); ?></p>
        <p><strong>Indicações:</strong> <?php echo htmlspecialchars($dadosExercicio['indicacoes']); ?></p>
        <p><strong>Gasto Calórico (METs):</strong> <?php echo htmlspecialchars($dadosExercicio['mets_consumo_energetico']); ?></p>
        <p><strong>Nível de Dificuldade:</strong> <?php echo htmlspecialchars($dadosExercicio['nivel_dificuldade']); ?></p>
        <p><strong>Data de Inclusão:</strong> <?php echo htmlspecialchars(date('d/m/Y H:i:s', strtotime($dadosExercicio['data_inclusao']))); ?></p>
    </div>
    <br>
    <a href="<?php echo INCLUDE_PATH_PAINEL . 'listar-exercicios'; ?>" class="btn voltar">Voltar para a lista de exercícios</a>
</div><!-- box-content -->