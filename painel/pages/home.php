<?php 
function calcularPeriodoUltimos7Dias() {
    $dataAtual = new DateTime();
    $dataInicio = clone $dataAtual;
    $dataInicio->modify('-6 days');
    return $dataInicio->format('d/m/Y') . ' - ' . $dataAtual->format('d/m/Y');
}

// Obter o ID do usuário logado
$professor_ID = $_SESSION['id']; // Supondo que o ID do usuário logado está armazenado em $_SESSION['id']

if (isset($_POST['novo_grupo'])) {
    $novo_grupo = $_POST['novo_grupo_texto'];
    if (!empty($novo_grupo)) {
        $sql = MySql::conectar()->prepare("INSERT INTO tb_grupos_usuarios (grupo, professor_id) VALUES (?, ?)");
        $sql->execute([$novo_grupo, $professor_ID]);
        Painel::alert('sucesso', 'Novo grupo adicionado com sucesso!');
        // Recarregar a página sem reenviar o formulário
        echo "<script>window.location.href=window.location.href</script>";
        exit;
    }
}

include_once('pages/funcoes.php');

// Conectar ao banco de dados e selecionar os grupos criados pelo professor logado
$sql = MySql::conectar()->prepare("SELECT id, grupo FROM tb_grupos_usuarios WHERE professor_id = ?");
$sql->execute([$professor_ID]);
$grupos = $sql->fetchAll();


// Verificar se a ação de cadastro do atleta foi solicitada
$linkWhatsApp = ""; // Variável para armazenar o link do WhatsApp

// Processar o cadastro do atleta
if (isset($_POST['acao'])) {
    $telefone = $_POST['telefone'];
    $grupo_id = $_POST['grupo'];
    $cargo = $_SESSION['cargo'];
    $professor_id = $_SESSION['id'];
    $acompanhamento = isset($_POST['acompanhamento']) ? $_POST['acompanhamento'] : 'false';
    
    // Construir a mensagem para WhatsApp com os parâmetros recebidos
    $mensagem = "Ol%C3%A1%2C%20para%20iniciar%20seu%20processo%20de%20acompanhamento%2C%20pedimos%20que%20voc%C3%AA%20realize%20seu%20cadastro%20no%20sistema.%0A%0AClique%20no%20link%20abaixo%20para%20acessar%20o%20formul%C3%A1rio%20de%20cadastro%3A%0A%0Ahttps%3A%2F%2Fapcpro.com.br%2Fcadastro-online.php%3Fprofessor_id%3D{$professor_id}%26cargo%3D{$cargo}%26grupo%3D{$grupo_id}%26acompanhamento%3D{$acompanhamento}%0A%0AEstamos%20%C3%A0%20disposi%C3%A7%C3%A3o%20para%20ajud%C3%A1-lo%21%20%F0%9F%98%8A";
    
    // Gerar link do WhatsApp
    $linkWhatsApp = "<a class='whatsapp-link' href='https://web.whatsapp.com/send?phone=55{$telefone}&text={$mensagem}' target='_blank'>Enviar Mensagem no WhatsApp</a>";
} ?>

<?php if ($_SESSION['cargo'] == 1) { 

include_once('pages/dashboard-professor.php'); } ?>  <!-- Fim do if($_SESSION['cargo'] == 1) -->

<?php if ($_SESSION['cargo'] == 2) { 

include_once('pages/dashboard-admin.php'); } ?>  <!-- Fim do if($_SESSION['cargo'] == 2) -->

<?php if ($_SESSION['cargo'] == 0) { 

include_once('pages/dashboard-aluno.php'); } ?>  <!-- Fim do if($_SESSION['cargo'] == 0) -->

    <!-- Modal -->
<div id="modalGrupo" style="display:none;">
    <div class="modal-content">
        <form method="post">
            <h3>Adicionar um novo grupo</h3>
            <input type="text" name="novo_grupo_texto" placeholder="Digite o nome do novo grupo" required>
            <input type="submit" name="novo_grupo" value="Adicionar">
            <button type="button" onclick="document.getElementById('modalGrupo').style.display='none'">Fechar</button>
        </form>
    </div>
</div>







