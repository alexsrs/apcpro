<?php
include_once('pages/funcoes.php');

// Verifica a permissão da página
verificaPermissaoPagina(0);

// Obtém o ID da anamnese da URL
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

$perfil = new Perfil();
$perfis = $perfil->buscarPerfilPorId($id);

// Verifica se a anamnese foi encontrada
if (!$perfis) {
    echo "Anamnese não encontrada.";
    exit;
}

$sexo = $perfis['sexo']; // Pega o sexo do array

?>
<div class="box-content">
    <h2><i class="fa fa-eye" aria-hidden="true"></i> Dados da Avaliação</h2>

    <div class="form-group left w50">
        <label for="peso">Peso:</label>
        <p><?php echo htmlspecialchars($perfis['peso']); ?> Kg</p>
    </div>

    <div class="form-group right w50">
        <label for="altura">Altura:</label>
        <p><?php echo htmlspecialchars($perfis['altura']); ?> m</p>
    </div>
    
    <div class="clear"></div><!-- clear -->

    <div class="form-group left w50">
        <fieldset>
            <legend>Dados de Saúde</legend>
            <p><strong>Obesidade:</strong> <?php echo $perfis['obesidade'] ? 'Sim' : 'Não'; ?></p>
            <p><strong>Diabetes:</strong> <?php echo $perfis['diabetes'] ? 'Sim' : 'Não'; ?></p>
            <p><strong>Hipertensão:</strong> <?php echo $perfis['hipertensao'] ? 'Sim' : 'Não'; ?></p>
            <p><strong>Depressão:</strong> <?php echo $perfis['depressao'] ? 'Sim' : 'Não'; ?></p>
            <p><strong>Pós-Covid:</strong> <?php echo $perfis['pos_covid'] ? 'Sim' : 'Não'; ?></p>
        </fieldset>
    </div>

    <div class="form-group right w50">
        <fieldset>
            <legend>Dados Pessoais</legend>
            <?php if ($sexo != 'M'): ?>
                <p><strong>Gestante:</strong> <?php echo $perfis['gestante'] ? 'Sim' : 'Não'; ?></p>
                <p><strong>Pós-Parto:</strong> <?php echo $perfis['posparto'] ? 'Sim' : 'Não'; ?></p>
                <p><strong>Deseja Emagrecer:</strong> <?php echo $perfis['emagrecer'] ? 'Sim' : 'Não'; ?></p>
            <?php endif; ?>
        </fieldset>
    </div>

    <div class="clear"></div><!-- clear -->

    <div class="form-group"> 
        <label for="objetivo">Objetivo:</label>
        <?php
            // Use o objetivo_id para buscar o nome do objetivo na tabela tb_objetivos_treinamento
            if (isset($perfis['objetivo_id'])) { // Verifique se o objetivo_id está presente
                $objetivo_id = $perfis['objetivo_id']; // Pega o objetivo_id
                $sql_objetivo = MySql::conectar()->prepare("SELECT objetivo FROM tb_objetivos_treinamento WHERE id = ?");
                $sql_objetivo->execute([$objetivo_id]);
                $objetivo = $sql_objetivo->fetch(PDO::FETCH_ASSOC);
                
                // Exibe o objetivo se encontrado
                if ($objetivo) {
                    echo '<p>' . htmlspecialchars($objetivo['objetivo']) . '</p>';
                } else {
                    echo '<p>Objetivo não encontrado.</p>';
                }
            } else {
                echo '<p>Objetivo não definido.</p>'; // Mensagem se objetivo_id não existir
            }
        ?>
    </div>
    
    <div class="clear"></div><!-- clear -->
</div><!-- box-content -->
