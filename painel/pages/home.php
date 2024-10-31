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
    
    // Construir a mensagem para WhatsApp com os parâmetros recebidos
    $mensagem = "Ol%C3%A1%2C%20para%20iniciar%20seu%20processo%20de%20acompanhamento%2C%20pedimos%20que%20voc%C3%AA%20realize%20seu%20cadastro%20no%20sistema.%0A%0AClique%20no%20link%20abaixo%20para%20acessar%20o%20formul%C3%A1rio%20de%20cadastro%3A%0A%0Ahttps%3A%2F%2Fapcpro.com.br%2Fcadastro-online.php%3Fprofessor_id%3D{$professor_id}%26cargo%3D{$cargo}%26grupo%3D{$grupo_id}%0A%0AEstamos%20%C3%A0%20disposi%C3%A7%C3%A3o%20para%20ajud%C3%A1-lo%21%20%F0%9F%98%8A";
    
    // Gerar link do WhatsApp
    $linkWhatsApp = "<a class='whatsapp-link' href='https://web.whatsapp.com/send?phone=55{$telefone}&text={$mensagem}' target='_blank'>Enviar Mensagem no WhatsApp</a>";
}

?>

<?php if ($_SESSION['cargo'] == 1) { 
    // Contador de visitas totais
    $id = $_SESSION['id'];
    $totalAtletas = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE `professor_id` = $id");
    $totalAtletas->execute();
    $totalAtletas = $totalAtletas->rowCount();
?>
<div class="box-content left w100">
    <h2><i class="fa fa-home"></i> Dashboard - <?php echo NOME_EMPRESA ?></h2>
    <div class="box-metricas">
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h1>TOTAL DE ATLETAS</h1>
                <h1><?php echo $totalAtletas ?></h1>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h1>EM RISCO DE LESÃO</h1>
                <h1><?php echo "0" ?></h1>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="box-metrica-single">
            <div class="box-metrica-wraper">
                <h1>TREINOS HOJE</h1>
                <h1><?php echo "13"; ?></h1>
            </div><!-- box-metrica-wraper -->
        </div><!-- box-metrica-single -->
        <div class="clear"></div><!--clear -->
    </div><!-- box-metricas -->

    <form method="post" enctype="multipart/form-data">
    <div class="form-group flex-container">
        <div class="select-container">
            <label>Grupo</label>
            <select name="grupo">
                <option value="0">-- Selecione para adicionar a um grupo --</option>
                <?php 
                foreach ($grupos as $grupo) {
                    echo '<option value="'.$grupo['id'].'">'.$grupo['grupo'].'</option>';
                }
                ?>
            </select>
        </div><!-- select-container -->
        <div class="button-container">
            <button type="button" onclick="document.getElementById('modalGrupo').style.display='flex'">
                <i class="fa fa-plus" aria-hidden="true"></i>
            </button>
        </div><!-- button-container -->
    </div><!-- form-group -->
    <div class="form-group w33">
        <label>Cadastre o atleta</label>
        <input type="text" name="telefone" data-mask="(00) 00000-0000" required/>
        <input type="submit" name="acao" value="Gerar convite"/>
    </div><!-- form-group -->
</form>

<!-- Exibir link do WhatsApp após o envio do formulário -->
<?php
if ($linkWhatsApp) {
    echo "<div class='whatsapp-button'>$linkWhatsApp</div>";
}
?>
</div><!-- box-content -->

<!-- Resto do seu código HTML -->

<!-- Modal para adicionar grupo -->
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



<div class="box-content left w50">
    <h3><i class="fa fa-rocket" aria-hidden="true"></i> Atletas com avaliações realizadas nos últimos 7 dias (<?php echo calcularPeriodoUltimos7Dias();?>) </h3>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>IP</span>
            </div><!-- col -->
            <div class="col">
                <span>Última ação</span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->

   
        <div class="row">
            <div class="col">
                <span><?php echo "teste" ?></span>
            </div><!-- col -->
            <div class="col">
                <span><?php echo "teste" ?></span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->
    
    </div><!-- table-responsive -->

</div><!-- box-content -->

     
<div class="box-content right w50">
    <h3><i class="fa fa-rocket" aria-hidden="true"></i> Atletas com treinos realizados nos últimos 7 dias (<?php echo calcularPeriodoUltimos7Dias();?>) </h3>
    <div class="table-responsive">
        <div class="row">
            <div class="col">
                <span>User</span>
            </div><!-- col -->
            <div class="col">
                <span>Nome</span>
            </div><!-- col -->
            <div class="col">
                <span>Cargo</span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->

        <div class="row">
            <div class="col">
                <span><?php echo "1" ?></span>
            </div><!-- col -->
            <div class="col">
                <span><?php echo "1" ?></span>
            </div><!-- col -->
            <div class="col">
                <span><?php echo "1" ?></span>
            </div><!-- col -->
            <div class="clear"></div><!-- clear -->
        </div><!-- row -->
    
    </div><!-- table-responsive -->

</div><!-- box-content -->
<?php } ?>  <!-- Fim do if($_SESSION['cargo'] == 1) -->


    <div class="box-content left w50">
        
    </div><!-- box-content -->




    <div class="box-content right w50">
        
    </div><!-- box-content -->

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