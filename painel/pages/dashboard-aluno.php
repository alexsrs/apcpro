<?php

    if (isset($_GET['id'])) {
        $usuario_id = (int)$_GET['id']; // ID passado pela URL
    } else {
        $usuario_id = $_SESSION['id']; // ID do usuário logado
    }

    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$usuario_id]);
    $usuario = $sql->fetch(PDO::FETCH_ASSOC);
    $dataNascimento = new DateTime($usuario['data_nascimento']);
    $idade = (new DateTime())->diff($dataNascimento)->y;
    $anamnese = new Anamnese();
    $dados_anamnese = $anamnese->buscarUltimaAnamnesePorUsuarioId($usuario_id);
    $perfil = new Perfil();
    $perfil = $perfil->buscarUltimoPerfilPorUsuarioId($usuario_id);
    $objetivo = $perfil['objetivo_id'];
    $sql_objetivo = MySql::conectar()->prepare("SELECT objetivo FROM tb_objetivos_treinamento WHERE id = ?");
                $sql_objetivo->execute([$objetivo]);
                $objetivo = $sql_objetivo->fetch(PDO::FETCH_ASSOC);
           

   


  

?>

<div class="box-content left w100">

    <div class="box-dashboard w33 left">
        <div class="dashboard-wrapper">
            <p>Nome:</p>
            <h2><?php echo htmlspecialchars($usuario['nome']);?></h2>
        </div><!--w50 left-->
        
    </div><!--w33 left-->

    <div class="box-dashboard w33 left">
    <div class="dashboard-wrapper w33 left">
            <p>Idade:</p>
            <h3><?php echo htmlspecialchars($idade); ?></h3>
        </div><!--w50 right-->
        <div class="dashboard-wrapper w33 left">
            <p>Nível:</p>
            <h3><?php echo isset($dados_anamnese['nivel_treinamento']) ? htmlspecialchars($dados_anamnese['nivel_treinamento']) : 'N/A'; ?></h3>
        </div><!--w33 left-->
        <div class="dashboard-wrapper w33 left">
    </div><!--w50 left-->
        



    </div><!--w33 left-->
    <div class="box-dashboard w33 right">
    </div><!--w33 left-->


</div><!-- box-content -->
<p>Objetivo:</p>
            <h3><?php echo isset($objetivo['objetivo']) ? htmlspecialchars($objetivo['objetivo']) : 'N/A'; ?></h3>
<div class="clear"></div><!-- clear -->


   

