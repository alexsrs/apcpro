<?php
include_once('pages/funcoes.php');

// Verifica a permissão da página
verificaPermissaoPagina(0);

// Obtém o ID do usuário da URL ou da sessão
$id = isset($_GET['id']) ? intval($_GET['id']) : $_SESSION['id'];

$aptidaoCardioRespiratoria = new AptidaoCardioRespiratoria();
$dadosAptidao = $aptidaoCardioRespiratoria->buscarAptidaoCardioRespiratoriaPorId($id);

// Verifica se os dados foram encontrados
if (!$dadosAptidao) {
    echo "Dados de aptidão cardiorespiratória não encontrados.";
    exit;
}
?>

<div class="box-content">
    <h2>Detalhes da Aptidão Cardiorespiratória</h2>

    <p><strong>ID:</strong> <?php echo htmlspecialchars($dadosAptidao['id']); ?></p>
    <p><strong>Data da Avaliação:</strong> <?php echo htmlspecialchars($dadosAptidao['data_avaliacao']); ?></p>

    <h3>Resultados do Teste de Conconi</h3>
    <p><strong>FC de Repouso:</strong> <?php echo htmlspecialchars($dadosAptidao['fc_repouso'] ?? 'N/A'); ?></p>
    <p><strong>FC Máxima:</strong> <?php echo htmlspecialchars($dadosAptidao['fc_max'] ?? 'N/A'); ?></p>
    <p><strong>Velocidade Máxima:</strong> <?php echo htmlspecialchars($dadosAptidao['velocidade_max'] ?? 'N/A'); ?></p>
    <p><strong>PSE Máxima:</strong> <?php echo htmlspecialchars($dadosAptidao['pse_max'] ?? 'N/A'); ?></p>
    <p><strong>Índice de FC:</strong> <?php echo htmlspecialchars($dadosAptidao['indice_fc'] ?? 'N/A'); ?></p>
    <p><strong>METs:</strong> <?php echo htmlspecialchars($dadosAptidao['mets'] ?? 'N/A'); ?></p>
    <p><strong>VO² Máxima (ml/kg/min):</strong> <?php echo htmlspecialchars($dadosAptidao['vo2_max_ml'] ?? 'N/A'); ?></p>
    <p><strong>VO² Máxima (L/min):</strong> <?php echo htmlspecialchars($dadosAptidao['vo2_max_l'] ?? 'N/A'); ?></p>

    <h3>Limiar de Frequência Cardíaca</h3>
    <p><strong>FC L1:</strong> <?php echo htmlspecialchars($dadosAptidao['limiar1'] ?? 'N/A'); ?></p>
    <p><strong>FC L1 (% FC Máxima):</strong> <?php echo htmlspecialchars($dadosAptidao['fc_l1_percent'] ?? 'N/A'); ?></p>
    <p><strong>FC L2:</strong> <?php echo htmlspecialchars($dadosAptidao['limiar2'] ?? 'N/A'); ?></p>
    <p><strong>FC L2 (% FC Máxima):</strong> <?php echo htmlspecialchars($dadosAptidao['fc_l2_percent'] ?? 'N/A'); ?></p>

    <h3>Percentuais de VO² Máxima</h3>
    <?php
    $percentuais = [30, 35, 40, 45, 50, 55, 60, 65, 70, 75, 80, 85, 90, 95, 100, 105, 110, 115, 120, 125, 130, 135, 140, 145, 150, 155, 160, 165, 170];
    foreach ($percentuais as $percentual) {
        echo "<p><strong>{$percentual}% iVO² Máxima:</strong> " . htmlspecialchars($dadosAptidao["ivo2_x_kmh_{$percentual}"] ?? 'N/A') . "</p>";
    }
    ?>

    <a href="listar-usuarios">Voltar para a lista</a>
</div>