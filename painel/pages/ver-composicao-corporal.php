<?php
include_once('pages/funcoes.php');

// Verifica a permissão da página
verificaPermissaoPagina(0);

// Obtém o ID da composição corporal da URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$composicaoCorporal = new ComposicaoCorporal();
$composicao = $composicaoCorporal->buscarComposicaoCorporalPorId($id);
$usuarioid = $composicao['usuario_id'];

// Verifica se a composição corporal foi encontrada
if (!$composicao) {
    echo "Composição corporal não encontrada.";
    exit;
}

?>

<div class="box-content">
    <h2>Detalhes da Composição Corporal</h2>

    <p><strong>ID:</strong> <?php echo htmlspecialchars($composicao['id']); ?></p>
    <p><strong>Data da Avaliação:</strong> <?php echo htmlspecialchars($composicao['data_avaliacao']); ?></p>

    <h3>Dobras Cutâneas</h3>
    <p><strong>Tricipital:</strong> <?php echo htmlspecialchars($composicao['tricipital'] ?? 'N/A'); ?></p>
    <p><strong>Subescapular:</strong> <?php echo htmlspecialchars($composicao['subescapular'] ?? 'N/A'); ?></p>
    <p><strong>Supra-Ilíaca:</strong> <?php echo htmlspecialchars($composicao['suprailiaca'] ?? 'N/A'); ?></p>
    <p><strong>Abdominal:</strong> <?php echo htmlspecialchars($composicao['abdominal'] ?? 'N/A'); ?></p>
    <p><strong>Supraespinhal:</strong> <?php echo htmlspecialchars($composicao['supraespinhal'] ?? 'N/A'); ?></p>
    <p><strong>Coxa Guedes:</strong> <?php echo htmlspecialchars($composicao['coxa_guedes'] ?? 'N/A'); ?></p>
    <p><strong>Coxa Pollock:</strong> <?php echo htmlspecialchars($composicao['coxa_pollock'] ?? 'N/A'); ?></p>
    <p><strong>Peitoral:</strong> <?php echo htmlspecialchars($composicao['peitoral'] ?? 'N/A'); ?></p>
    <p><strong>Axilar Média:</strong> <?php echo htmlspecialchars($composicao['axilar_media'] ?? 'N/A'); ?></p>
    <p><strong>Bíceps:</strong> <?php echo htmlspecialchars($composicao['biceps'] ?? 'N/A'); ?></p>

    <h3>Somatórios</h3>
    <p><strong>Somatório:</strong> <?php echo htmlspecialchars($composicao['somatorio'] ?? 'N/A'); ?></p>
    <p><strong>Somatório Pollock 3D:</strong> <?php echo htmlspecialchars($composicao['somatorio_pollock_3D'] ?? 'N/A'); ?></p>
    <p><strong>Somatório Pollock 7D:</strong> <?php echo htmlspecialchars($composicao['somatorio_pollock_7D'] ?? 'N/A'); ?></p>
    <p><strong>Somatório Guedes 3D:</strong> <?php echo htmlspecialchars($composicao['somatorio_guedes_3D'] ?? 'N/A'); ?></p>

    <h3>Outras Medições</h3>
    <p><strong>Biestiloide:</strong> <?php echo htmlspecialchars($composicao['biestiloide'] ?? 'N/A'); ?></p>
    <p><strong>Biepicondiliano:</strong> <?php echo htmlspecialchars($composicao['biepicondiliano'] ?? 'N/A'); ?></p>
    <p><strong>Bicondiliano:</strong> <?php echo htmlspecialchars($composicao['bicondiliano'] ?? 'N/A'); ?></p>
    <p><strong>Bimaleolar:</strong> <?php echo htmlspecialchars($composicao['bimaleolar'] ?? 'N/A'); ?></p>

    <a href="<?php echo INCLUDE_PATH_PAINEL . 'listar-afa?id=' . $usuarioid ?>" class="btn voltar">Voltar para a lista de usuários</a>
</div>