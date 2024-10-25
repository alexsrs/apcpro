<?php 

verificaPermissaoPagina(1);
include_once('pages/funcoes.php');

if (isset($_GET['id'])) {
    $usuario_id = (int)$_GET['id']; // ID passado pela URL
} else {
    $usuario_id = $_SESSION['id']; // ID do usuário logado
}

if (isset($_GET['id'])) {
    $id_aluno = intval($_GET['id']); // Certificar que o valor recebido é um número inteiro
    // Verifica se o ID existe no banco de dados e seleciona o telefone
    $sql = MySql::conectar()->prepare("SELECT telefone, nome, img, sexo, data_nascimento FROM `tb_admin.usuarios` WHERE id = ?");
    $sql->execute([$id_aluno]);
    $result = $sql->fetch();

    if (!$result) {
        echo "Usuário não encontrado.";
        exit();
    } else {
        $telefone = $result['telefone']; // Atribui o telefone à variável $telefone
        $nome = $result['nome'];
        $img = $result['img'];
        // Consulta ao banco de dados para obter o sexo do usuário
        $sexo = $result['sexo'];
        $dataNascimento = new DateTime($result['data_nascimento']); // Converte a string em um objeto DateTime
        $idade = (new DateTime())->diff($dataNascimento)->y; // Calcula a diferença de idade em anos
    }
} else {
    echo "ID do aluno não fornecido.";
    exit();
}

// Instancia a classe Anamnese
$anamnese = new Anamnese();
// Busca as anamneses relacionadas ao usuário
$anamneses = $anamnese->buscarAnamnesePorUsuarioId($id_aluno);

$perfil = new Perfil();
$perfis = $perfil->buscarPerfilPorUsuarioId($id_aluno);

$medidaCorporal = new MedidaCorporal();
$medidasCorporais = $medidaCorporal->buscarMedidaCorporalPorUsuarioId($id_aluno);

$aptidaoCardioRespiratoria = new AptidaoCardioRespiratoria();
$aptidoes = $aptidaoCardioRespiratoria->buscarAptidaoCardioRespiratoriaPorUsuarioId($id_aluno);


?>
<div class="box-content">
        <div class="box-usuario left">
        <?php
                if($img == ''){
            ?>
                <div class="avatar-usuario left">
                    <i class="fa fa-user"></i>
                </div><!-- avatar-usuario -->
            <?php } else { ?>
                <div class="imagem-usuario left">
                <img src="<?php echo INCLUDE_PATH_PAINEL ?>uploads/<?php echo $img; ?>" />
                </div><!-- imagem-usuario -->
            <?php } ?> <!-- fechando o IF lá de cima -->
            <div class="clear"></div><!-- clear -->
            <div class="nome-usuario black">
                <h2>Nome: <?php echo $nome; ?></h2>      
                <p>Sexo: <?php echo $sexo; ?></p>
                <p>Idade: <?php echo $idade; ?></p>
            </div><!-- nome-usuario -->
        </div><!-- imagem-usuario -->
        <div class="clear"></div><!-- clear -->
    <div class="acoes-button">
        <body>
        <a class="whatsapp-link" href="https://web.whatsapp.com/send?phone=55<?php echo $telefone ?>&text=Ol%C3%A1%2C%20para%20dar%20continuidade%20ao%20seu%20processo%20de%20acompanhamento%2C%20pedimos%20que%20voc%C3%AA%20preencha%20sua%20*Avalia%C3%A7%C3%A3o%20F%C3%ADsica*.%20Isso%20nos%20ajudar%C3%A1%20a%20criar%20um%20plano%20personalizado%20para%20suas%20necessidades.%0A%0A%20Clique%20no%20link%20abaixo%20para%20preencher%20sua%20avalia%C3%A7%C3%A3o%3A%0A%0Ahttps%3A%2F%2Fwww.apcpro.com.br%2Fpainel%2Fformulario-perfis%3Fid%3D<?php echo urlencode($usuario_id); ?>%0A%0ASe%20precisar%20de%20ajuda%2C%20estamos%20%C3%A0%20disposi%C3%A7%C3%A3o.%20%F0%9F%98%8A" target="_blank">
            <i class="fa fa-whatsapp"></i> Solicitar avaliação</a>
        </body>
        <body>
            <a class="afa-link" href="<?php echo INCLUDE_PATH_PAINEL . 'formulario-perfis?id=' . $usuario_id; ?>">
            <i class="fa fa-link"></i> Realizar avaliação</a>
        </body>
    </div>
</div><!-- box-content -->

<div class="clear"></div><!-- clear -->
<!-- Listagem de perfil de saúde -->
<div class="box-content">
    <h2>Avaliação</h2>
    <table id="perfilTable" class="display dt-responsive" width="100%">
        <thead>
            <tr>
                <th>Data da Avaliação</th>
                <th>Peso</th>
                <th>Altura</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($perfis as $perfil): ?>
                <tr>
                    <td><?php echo (new DateTime($perfil['data_avaliacao']))->format('d/m/Y H:i'); ?></td>
                
                    <td><?php echo htmlspecialchars($perfil['peso']); ?> Kg</td>
                    <td><?php echo htmlspecialchars($perfil['altura']); ?> m</td>
                    <td>
                    <a class="btn view" href="<?php echo INCLUDE_PATH_PAINEL . 'ver-avaliacao?id=' . $perfil['id']; ?>">Visualizar</a>
                       
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<!-- Listagem de anameneses-->
<div class="box-content">
    <h2>Anamneses</h2>
    <table id="anamnesesTable" class="display dt-responsive" width="50%">
        <thead class="text-center">
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
                    <a class="btn view" href="<?php echo INCLUDE_PATH_PAINEL . 'ver-anamnese?id=' . $anamnese['id']; ?>">Visualizar</a>
                       <!-- <a href="<?php echo INCLUDE_PATH_PAINEL . $anamnese['id']; ?>">Ver</a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="box-content">
    <h2>Medida Corporal</h2>
    <table id="medidaCorporalTable" class="display dt-responsive" width="100%">
        <thead>
            <tr>
                <th>Data da Avaliação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($medidasCorporais as $medidaCorporal): ?>
                <tr>
                    <td><?php echo (new DateTime($medidaCorporal['data_avaliacao']))->format('d/m/Y H:i'); ?></td>
                
                    
                    <td>
                    <a class="btn view" href="<?php echo INCLUDE_PATH_PAINEL . 'ver-medida-corporal?id=' . $medidaCorporal['id']; ?>">Visualizar</a>
                       <!-- <a href="<?php echo INCLUDE_PATH_PAINEL . $medidaCorporal['id']; ?>">Ver</a> -->
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<div class="box-content">
    <h2>Aptidão Cardiorespiratória</h2>
    <table id="aptidaoCardioRespiratoriaTable" class="display dt-responsive" width="100%">
        <thead>
            <tr>
                <th>Data da Avaliação</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($aptidoes as $aptidaoCardioRespiratoria): ?>
                <tr>
                    <td><?php echo (new DateTime($aptidaoCardioRespiratoria['data_avaliacao']))->format('d/m/Y H:i'); ?></td>
                
                    
                    <td>
                    <a class="btn view" href="<?php echo INCLUDE_PATH_PAINEL . 'ver-aptidao-cardiorespiratoria?id=' . $aptidaoCardioRespiratoria['id']; ?>">Visualizar</a>
                       
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>




