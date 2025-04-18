<?php
include_once('pages/funcoes.php');

// Verifica a permissão da página
verificaPermissaoPagina(0);

// Obtém o ID da anamnese da URL

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$anamnese = new Anamnese();
$dados_anamnese = $anamnese->buscarAnamnesePorId($id);
$usuarioid = $dados_anamnese['usuario_id'];

// Verifica se a anamnese foi encontrada
if (!$dados_anamnese) {
    echo "Anamnese não encontrada.";
    exit;
}


?>

<div class="box-content">
    <h2>Detalhes da Anamnese</h2>
    
    <p><strong>ID:</strong> <?php echo htmlspecialchars($dados_anamnese['id']); ?></p>
    <p><strong>Data da Avaliação:</strong> <?php echo htmlspecialchars($dados_anamnese['data_avaliacao']); ?></p>
    
    <h3>Disponibilidade de Treino</h3>
    <ul>
        <li>Domingo: <i class="fa <?php echo $dados_anamnese['domingo'] == 1 ? 'fa-check' : 'fa-times'; ?>" style="color: <?php echo $dados_anamnese['domingo'] == 1 ? 'green' : 'red'; ?>;"></i></li>
        <li>Segunda: <i class="fa <?php echo $dados_anamnese['segunda'] == 1 ? 'fa-check' : 'fa-times'; ?>" style="color: <?php echo $dados_anamnese['segunda'] == 1 ? 'green' : 'red'; ?>;"></i></li>
        <li>Terça: <i class="fa <?php echo $dados_anamnese['terca'] == 1 ? 'fa-check' : 'fa-times'; ?>" style="color: <?php echo $dados_anamnese['terca'] == 1 ? 'green' : 'red'; ?>;"></i></li>
        <li>Quarta: <i class="fa <?php echo $dados_anamnese['quarta'] == 1 ? 'fa-check' : 'fa-times'; ?>" style="color: <?php echo $dados_anamnese['quarta'] == 1 ? 'green' : 'red'; ?>;"></i></li>
        <li>Quinta: <i class="fa <?php echo $dados_anamnese['quinta'] == 1 ? 'fa-check' : 'fa-times'; ?>" style="color: <?php echo $dados_anamnese['quinta'] == 1 ? 'green' : 'red'; ?>;"></i></li>
        <li>Sexta: <i class="fa <?php echo $dados_anamnese['sexta'] == 1 ? 'fa-check' : 'fa-times'; ?>" style="color: <?php echo $dados_anamnese['sexta'] == 1 ? 'green' : 'red'; ?>;"></i></li>
        <li>Sábado: <i class="fa <?php echo $dados_anamnese['sabado'] == 1 ? 'fa-check' : 'fa-times'; ?>" style="color: <?php echo $dados_anamnese['sabado'] == 1 ? 'green' : 'red'; ?>;"></i></li>
    </ul>

    <h3>Atividade Física</h3>
    <p><strong>Exercícios:</strong> <?php echo htmlspecialchars($dados_anamnese['exercicios'] ?? 'N/A'); ?></p>
    <p><strong>Outros Exercícios:</strong> <?php echo htmlspecialchars($dados_anamnese['outros_exercicios'] ?? 'N/A'); ?></p>
    <p><strong>Não Gosta:</strong> <?php echo htmlspecialchars($dados_anamnese['nao_gosta']); ?></p>
    <p><strong>Não Gosta Exercícios:</strong> <?php echo htmlspecialchars($dados_anamnese['nao_gosta_exercicios'] ?? 'N/A'); ?></p>
    <p><strong>Atividade Recente:</strong> <?php echo htmlspecialchars($dados_anamnese['atividade_recente']); ?></p>
    <p><strong>Tipo de Exercício Recente:</strong> <?php echo isset($dados_anamnese['tipo_exercicio_recente']) ? htmlspecialchars($dados_anamnese['tipo_exercicio_recente']) : 'N/A'; ?></p>
    <p><strong>Dias da Semana Recente:</strong> <?php echo htmlspecialchars($dados_anamnese['dias_semana_recente'] ?? 'N/A'); ?></p>
    <p><strong>Minutos por Dia Recente:</strong> <?php echo htmlspecialchars($dados_anamnese['minutos_dia_recente'] ?? 'N/A'); ?></p>
    <p><strong>Intensidade:</strong> <?php echo htmlspecialchars($dados_anamnese['intensidade']); ?></p>

    <h3>Dados Médicos</h3>
    <p><strong>Doenças:</strong> <?php echo htmlspecialchars($dados_anamnese['doencas']); ?></p>
    <p><strong>Nomes das Doenças:</strong> <?php echo htmlspecialchars($dados_anamnese['doencas_nome'] ?? 'N/A'); ?></p>
    <p><strong>Remédios:</strong> <?php echo htmlspecialchars($dados_anamnese['remedios'] ?? 'N/A'); ?></p>
    <p><strong>Cirurgias:</strong> <?php echo htmlspecialchars($dados_anamnese['cirurgias']); ?></p>
    <p><strong>Região da Cirurgia:</strong> <?php echo htmlspecialchars($dados_anamnese['regiao_cirurgia'] ?? 'N/A'); ?></p>
    <p><strong>Dor Muscular:</strong> <?php echo htmlspecialchars($dados_anamnese['dor_muscular']); ?></p>
    <p><strong>Regiões da Dor:</strong> <?php echo htmlspecialchars($dados_anamnese['regioes_dor'] ?? 'N/A'); ?></p>
    <p><strong>Dor no Peito:</strong> <?php echo htmlspecialchars($dados_anamnese['dor_peito']); ?></p>
    <p><strong>Tontura:</strong> <?php echo htmlspecialchars($dados_anamnese['tontura']); ?></p>
    <p><strong>Movimento Diário:</strong> <?php echo htmlspecialchars($dados_anamnese['movimento_diario']); ?></p>
    <p><strong>Movimentos por Dia:</strong> <?php echo htmlspecialchars($dados_anamnese['movimentos_dia'] ?? 'N/A'); ?></p>
    <p><strong>Parente Cardíaco:</strong> <?php echo htmlspecialchars($dados_anamnese['parente_cardiaco']); ?></p>
    <p><strong>Número de Parentes Cardíacos:</strong> <?php echo htmlspecialchars($dados_anamnese['num_parente_cardiaco'] ?? 'N/A'); ?></p>
    <p><strong>Fumante:</strong> <?php echo htmlspecialchars($dados_anamnese['fumante']); ?></p>
    <p><strong>Informações Pertinentes:</strong> <?php echo htmlspecialchars($dados_anamnese['info_pertinente'] ?? 'N/A'); ?></p>
    <p><strong>Aceito:</strong> <?php echo htmlspecialchars($dados_anamnese['aceito']); ?></p>

    
    <a href="<?php echo INCLUDE_PATH_PAINEL . 'listar-afa?id=' . $usuarioid ?>" class="btn voltar">Voltar para a lista de usuários</a>
</div>