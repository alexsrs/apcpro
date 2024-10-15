<?php 
verificaPermissaoPagina(0);
include_once('pages/funcoes.php');

$anamnese = new Anamnese();
$anamneses = $anamnese->listarAnamneses();

// Verifica se ocorreu um erro
if ($anamneses === false) {
    echo "<p>Ocorreu um erro ao buscar as anamneses.</p>";
    exit; // Para a execução se houver erro
}
?>
<div class="box-content">
    <h2>Lista de Anamneses</h2>
    <table id="anamnesesTable" class="display">
        <thead>
            <tr>
                <th>Data da Avaliação</th>
                <th>Dom</th>
                <th>Seg</th>
                <th>Ter</th>
                <th>Qua</th>
                <th>Qui</th>
                <th>Sex</th>
                <th>Sáb</th>
                <th>Minutos por Dia</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($anamneses as $anamnese): ?>
                <tr>
                    <td><?php echo htmlspecialchars($anamnese['data_avaliacao']); ?></td>
                    <td>
                        <?php if ($anamnese['domingo'] == 1): ?>
                            <i class="fa fa-check" style="color: green;"></i>
                            <?php else: ?>
                            <i class="fa fa-times" style="color: red;" aria-hidden="true"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($anamnese['segunda'] == 1): ?>
                            <i class="fa fa-check" style="color: green;"></i>
                            <?php else: ?>
                            <i class="fa fa-times" style="color: red;" aria-hidden="true"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($anamnese['terca'] == 1): ?>
                            <i class="fa fa-check" style="color: green;"></i>
                            <?php else: ?>
                            <i class="fa fa-times" style="color: red;" aria-hidden="true"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($anamnese['quarta'] == 1): ?>
                            <i class="fa fa-check" style="color: green;"></i>
                            <?php else: ?>
                            <i class="fa fa-times" style="color: red;" aria-hidden="true"></i>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($anamnese['quinta'] == 1): ?>
                            <i class="fa fa-check" style="color: green;"></i>
                            <?php else: ?>
                            <i class="fa fa-times" style="color: red;" aria-hidden="true"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($anamnese['sexta'] == 1): ?>
                            <i class="fa fa-check" style="color: green;"></i>
                            <?php else: ?>
                            <i class="fa fa-times" style="color: red;" aria-hidden="true"></i>
                        <?php endif; ?>
                    </td>
                    <td>
                        <?php if ($anamnese['sabado'] == 1): ?>
                            <i class="fa fa-check" style="color: green;"></i>
                            <?php else: ?>
                            <i class="fa fa-times" style="color: red;" aria-hidden="true"></i>
                        <?php endif; ?>
                    </td>
                    <td><?php echo htmlspecialchars($anamnese['minutos_dia'] ?? 'N/A'); ?></td>
                    <td>
                        <a href="<?php echo INCLUDE_PATH_PAINEL . $anamnese['id']; ?>">Ver</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script>
    $(document).ready(function() {
        $('#anamnesesTable').DataTable();
    });
</script>

