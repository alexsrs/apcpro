<?php 

verificaPermissaoPagina(0);
include_once('pages/funcoes.php');


if (isset($_GET['id'])) {
    $usuario_id = (int)$_GET['id']; // ID passado pela URL
} else {
    $usuario_id = $_SESSION['id']; // ID do usuário logado
}

if (isset($_GET['id'])) {
    $id_aluno = intval($_GET['id']); // Certificar que o valor recebido é um número inteiro
    // Verifica se o ID existe no banco de dados
    $sql = MySql::conectar()->prepare("SELECT sexo FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$id_aluno]);
    $result = $sql->fetch();
    
    if (!$result) {
        echo "Usuário não encontrado.";
        exit();
    }
} else {
    echo "ID do aluno não fornecido.";
    exit();
}

// Instancia a classe Anamnese
$anamnese = new Anamnese();
// Busca as anamneses relacionadas ao usuário
$anamneses = $anamnese->buscarAnamnesePorUsuarioId($id_aluno);

// Verifica se ocorreu um erro ou se não há anamneses
if ($anamneses === false || empty($anamneses)) {
    echo "<p>Nenhuma anamnese encontrada para esse usuário.</p>";
    exit;
}


?>
<div class="box-content">

</div>
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
             
                    <td><?php echo (new DateTime($anamnese['data_avaliacao']))->format('d/m/Y H:i'); ?></td>
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
                    <a href="<?php echo INCLUDE_PATH_PAINEL . 'ver-anamnese?id=' . $anamnese['id']; ?>">Ver</a>
                       <!-- <a href="<?php echo INCLUDE_PATH_PAINEL . $anamnese['id']; ?>">Ver</a> -->
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

