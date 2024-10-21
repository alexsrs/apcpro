<?php
include_once('pages/funcoes.php');

// Verifica a permissão da página
verificaPermissaoPagina(0);

// Obtém o ID da anamnese da URL

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$medidaCorporal = new MedidaCorporal();
$medidasCorporais = $medidaCorporal->buscarMedidaCorporalPorId($id);

// Verifica se a anamnese foi encontrada
if (!$medidaCorporal) {
    echo "Medida corporal não encontrada.";
    exit;
}

?>

<div class="box-content">
    <h2>Detalhes das Medidas Corporais</h2>

    <p><strong>ID:</strong> <?php echo htmlspecialchars($medidasCorporais['id']); ?></p>
    <p><strong>Data da Avaliação:</strong> <?php echo htmlspecialchars($medidasCorporais['data_avaliacao']); ?></p>

    <h3>Medidas de Braço e Antebraço</h3>
    <p><strong>Punho Direito:</strong> <?php echo htmlspecialchars($medidasCorporais['punho_direito'] ?? 'N/A'); ?></p>
    <p><strong>Antebraço Direito:</strong> <?php echo htmlspecialchars($medidasCorporais['ante_braco_direito'] ?? 'N/A'); ?></p>
    <p><strong>Braço Direito Relaxado:</strong> <?php echo htmlspecialchars($medidasCorporais['braco_direito_relaxado'] ?? 'N/A'); ?></p>
    <p><strong>Braço Direito Contraído:</strong> <?php echo htmlspecialchars($medidasCorporais['braco_direito_contraido'] ?? 'N/A'); ?></p>

    <p><strong>Punho Esquerdo:</strong> <?php echo htmlspecialchars($medidasCorporais['punho_esquerdo'] ?? 'N/A'); ?></p>
    <p><strong>Antebraço Esquerdo:</strong> <?php echo htmlspecialchars($medidasCorporais['ante_braco_esquerdo'] ?? 'N/A'); ?></p>
    <p><strong>Braço Esquerdo Relaxado:</strong> <?php echo htmlspecialchars($medidasCorporais['braco_esquerdo_relaxado'] ?? 'N/A'); ?></p>
    <p><strong>Braço Esquerdo Contraído:</strong> <?php echo htmlspecialchars($medidasCorporais['braco_esquerdo_contraido'] ?? 'N/A'); ?></p>

    <h3>Outras Medidas</h3>
    <p><strong>Pescoço:</strong> <?php echo htmlspecialchars($medidasCorporais['pescoco'] ?? 'N/A'); ?></p>
    <p><strong>Tórax:</strong> <?php echo htmlspecialchars($medidasCorporais['torax'] ?? 'N/A'); ?></p>
    <p><strong>Cintura:</strong> <?php echo htmlspecialchars($medidasCorporais['cintura'] ?? 'N/A'); ?></p>
    <p><strong>Abdômen:</strong> <?php echo htmlspecialchars($medidasCorporais['abdomen'] ?? 'N/A'); ?></p>
    <p><strong>Quadril:</strong> <?php echo htmlspecialchars($medidasCorporais['quadril'] ?? 'N/A'); ?></p>

    <h3>Medidas de Coxas e Panturrilhas</h3>
    <p><strong>Coxa Medial Direita:</strong> <?php echo htmlspecialchars($medidasCorporais['coxa_medial_direita'] ?? 'N/A'); ?></p>
    <p><strong>Coxa Medial Esquerda:</strong> <?php echo htmlspecialchars($medidasCorporais['coxa_medial_esquerda'] ?? 'N/A'); ?></p>
    <p><strong>Panturrilha Direita:</strong> <?php echo htmlspecialchars($medidasCorporais['panturrilha_direita'] ?? 'N/A'); ?></p>
    <p><strong>Panturrilha Esquerda:</strong> <?php echo htmlspecialchars($medidasCorporais['panturrilha_esquerda'] ?? 'N/A'); ?></p>

    <h3>Dobras Cutâneas</h3>
    <p><strong>Tricipital:</strong> <?php echo htmlspecialchars($medidasCorporais['tricipital'] ?? 'N/A'); ?></p>
    <p><strong>Subescapular:</strong> <?php echo htmlspecialchars($medidasCorporais['subescapular'] ?? 'N/A'); ?></p>
    <p><strong>Supra-Ilíaca:</strong> <?php echo htmlspecialchars($medidasCorporais['suprailiaca'] ?? 'N/A'); ?></p>
    <p><strong>Abdominal:</strong> <?php echo htmlspecialchars($medidasCorporais['abdominal'] ?? 'N/A'); ?></p>
    <p><strong>Supraespinhal:</strong> <?php echo htmlspecialchars($medidasCorporais['supraespinhal'] ?? 'N/A'); ?></p>

    <h3>Outras Medições</h3>
    <p><strong>Bicondiliano:</strong> <?php echo htmlspecialchars($medidasCorporais['bicondiliano'] ?? 'N/A'); ?></p>
    <p><strong>Bimaleolar:</strong> <?php echo htmlspecialchars($medidasCorporais['bimaleolar'] ?? 'N/A'); ?></p>
    <p><strong>Biestiloide:</strong> <?php echo htmlspecialchars($medidasCorporais['biestiloide'] ?? 'N/A'); ?></p>

    <h3>Somatórios</h3>
    <p><strong>Somatório Pollock 3D:</strong> <?php echo htmlspecialchars($medidasCorporais['somatorio_pollock_3D'] ?? 'N/A'); ?></p>
    <p><strong>Somatório Pollock 7D:</strong> <?php echo htmlspecialchars($medidasCorporais['somatorio_pollock_7D'] ?? 'N/A'); ?></p>
    <p><strong>Somatório Guedes 3D:</strong> <?php echo htmlspecialchars($medidasCorporais['somatorio_guedes_3D'] ?? 'N/A'); ?></p>

    <a href="listar-usuarios">Voltar para a lista</a>
</div>