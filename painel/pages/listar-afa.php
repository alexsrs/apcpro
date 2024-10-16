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
    // Verifica se o ID existe no banco de dados e seleciona o telefone
    $sql = MySql::conectar()->prepare("SELECT telefone FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$id_aluno]);
    $result = $sql->fetch();

    if (!$result) {
        echo "Usuário não encontrado.";
        exit();
    } else {
        $telefone = $result['telefone']; // Atribui o telefone à variável $telefone
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
// if ($anamneses === false || empty($anamneses)) {
    //echo "<p>Nenhuma anamnese encontrada para esse usuário.</p>";
   // exit;
//}

?>
<div class="box-content">
    <body>
        <a class="whatsapp-link" href="https://web.whatsapp.com/send?phone=55<?php echo $telefone ?>&text=Ol%C3%A1%2C%20para%20dar%20continuidade%20ao%20seu%20processo%20de%20acompanhamento%2C%20pedimos%20que%20voc%C3%AA%20preencha%20sua%20*Avalia%C3%A7%C3%A3o%20F%C3%ADsica*.%20Isso%20nos%20ajudar%C3%A1%20a%20criar%20um%20plano%20personalizado%20para%20suas%20necessidades.%0A%0A%20Clique%20no%20link%20abaixo%20para%20preencher%20sua%20avalia%C3%A7%C3%A3o%3A%0A%0Ahttps%3A%2F%2Flocalhost%2Fapcpro%2Fpainel%2Fformulario-perfis%3Fid%3D<?php echo urlencode($usuario_id); ?>%0A%0ASe%20precisar%20de%20ajuda%2C%20estamos%20%C3%A0%20disposi%C3%A7%C3%A3o.%20%F0%9F%98%8A" target="_blank">
        <i class="fa fa-whatsapp"></i> Solicitar avaliação</a>

    </body>
    <body>
        <a class="afa-link" href="<?php echo INCLUDE_PATH_PAINEL . 'formulario-perfis?id=' . $usuario_id; ?>">
        <i class="fa fa-link"></i> Realizar avaliação</a>
    </body>
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

