<?php 
//session_start();
verificaPermissaoPagina(1); // Verifica se o usuário tem permissão para acessar a página

// Conexão com o banco de dados
require_once('../config.php');

// Busca o ID do professor logado
$professorID = $_SESSION['id'];

// Captura os filtros
$grupoFiltro = isset($_GET['GrupoFiltro']) ? $_GET['GrupoFiltro'] : '';
$nomeFiltro = isset($_GET['NomeFiltro']) ? $_GET['NomeFiltro'] : '';
$idadeFiltro = isset($_GET['IdadeFiltro']) ? (int)$_GET['IdadeFiltro'] : '';
$generoFiltro = isset($_GET['GeneroFiltro']) ? $_GET['GeneroFiltro'] : '';

// Criação da consulta com filtros
$sql = "SELECT u.*, g.grupo AS grupo_nome FROM `tb_admin.usuarios` u
        LEFT JOIN `tb_grupos_usuarios` g ON u.grupo_id = g.id
        WHERE u.professor_id = ?";
$filters = [$professorID];

if ($grupoFiltro) {
    $sql .= " AND u.grupo_id = ?";
    $filters[] = $grupoFiltro;
}
if ($nomeFiltro) {
    $sql .= " AND u.nome LIKE ?";
    $filters[] = '%' . $nomeFiltro . '%';
}
if ($idadeFiltro) {
    $dataNascimentoFiltro = date('Y-m-d', strtotime('-' . $idadeFiltro . ' years'));
    $sql .= " AND u.data_nascimento <= ?";
    $filters[] = $dataNascimentoFiltro;
}

if ($generoFiltro) {
    $sql .= " AND u.sexo = ?";
    $filters[] = $generoFiltro;
}

if (isset($_POST['id_usuario'])) {
    $idUsuario = (int)$_POST['id_usuario'];
    
    // Chama o método excluirUsuario da classe Usuario
    if (Usuario::excluirUsuario($idUsuario)) {
        Painel::alert('sucesso', 'Usuário excluído com sucesso');
        //echo '<script>alert("Usuário excluído com sucesso!");</script>';
        // Opcionalmente, você pode redirecionar para a mesma página para limpar o POST
        //echo '<script>window.location.href="' . INCLUDE_PATH_PAINEL . 'listar-usuarios";</script>';
    } else {
        //echo '<script>alert("Erro ao excluir o usuário!");</script>';
        Painel::alert('Erro', 'Não foi possível excluir o usuário!');
    }
}

// Remova a cláusula LIMIT
// $sql .= " LIMIT ?, ?"; // Esta linha foi removida

// Prepara e executa a consulta
$sql = MySql::conectar()->prepare($sql);
for ($i = 1; $i <= count($filters); $i++) {
    $sql->bindValue($i, $filters[$i - 1], is_int($filters[$i - 1]) ? PDO::PARAM_INT : PDO::PARAM_STR);
}
$sql->execute();
$usuarios = $sql->fetchAll();

// Contar total de usuários com filtros (opcional se você não precisar do total)
$sqlTotal = "SELECT COUNT(*) FROM `tb_admin.usuarios` WHERE professor_id = ?";
$totalFilters = [$professorID];

if ($grupoFiltro) {
    $sqlTotal .= " AND grupo_id = ?";
    $totalFilters[] = $grupoFiltro;
}
if ($nomeFiltro) {
    $sqlTotal .= " AND nome LIKE ?";
    $totalFilters[] = '%' . $nomeFiltro . '%';
}
if ($idadeFiltro) {
    $dataNascimentoFiltro = date('Y-m-d', strtotime('-' . $idadeFiltro . ' years'));
    $sqlTotal .= " AND data_nascimento <= ?";
    $totalFilters[] = $dataNascimentoFiltro;
}
if ($generoFiltro) {
    $sqlTotal .= " AND sexo = ?";
    $totalFilters[] = $generoFiltro;
}

$sqlTotal = MySql::conectar()->prepare($sqlTotal);
$sqlTotal->execute($totalFilters);
$total_usuarios = $sqlTotal->fetchColumn();

// Busca os grupos associados ao professor
$sqlGrupos = MySql::conectar()->prepare("SELECT * FROM `tb_grupos_usuarios` WHERE professor_id = ?");
$sqlGrupos->bindValue(1, $professorID, PDO::PARAM_INT);
$sqlGrupos->execute();
$grupos = $sqlGrupos->fetchAll();

?>



<div class="box-content">
    <h2><i class="fa fa-search mr-2"></i> Filtros</h2>
    <form>
        <div class="form-group left w100">
            <label for="GrupoFiltro">Grupo</label>
            <select name="GrupoFiltro" id="GrupoFiltro" class="form-control">
                <option value="">Selecione um grupo</option>
                <?php foreach ($grupos as $grupo): ?>
                    <option value="<?php echo $grupo['id']; ?>" <?php echo ($grupo['id'] == $grupoFiltro) ? 'selected' : ''; ?>>
                        <?php echo $grupo['grupo']; ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </div>
        <div class="clear"></div><!-- clear -->
        <div class="linha">
            <div class="form-group w33">
                <label for="NomeFiltro">Nome</label>
                <input type="text" name="NomeFiltro" id="NomeFiltro" placeholder="Nome do atleta" class="form-control default-focus" value="<?php echo htmlspecialchars($nomeFiltro); ?>">
            </div>
            <div class="form-group w33">
                <label for="IdadeFiltro">Idade</label>
                <input type="number" name="IdadeFiltro" id="IdadeFiltro" placeholder="Idade do atleta" class="form-control" value="<?php echo htmlspecialchars($idadeFiltro); ?>">
            </div>
            <div class="form-group w33">
                <label for="GeneroFiltro">Gênero</label>
                <select id="GeneroFiltro" name="GeneroFiltro" class="form-control">
                    <option selected="" value="">Selecione um gênero</option>
                    <option value="m" <?php echo ($generoFiltro == 'm') ? 'selected' : ''; ?>>Masculino</option>
                    <option value="f" <?php echo ($generoFiltro == 'f') ? 'selected' : ''; ?>>Feminino</option>
                </select>
            </div>
        </div>
        <div class="clear"></div><!-- clear -->
        <div class="form-group">
            <button type="submit" name="filtrar"><a><i class="fa fa-search mr-2"></i>Filtrar</a></button>
        </div>
    </form>
    <h2><i class="fa fa-th-list" aria-hidden="true"></i> Listagem</h2>
<table id="lista-usuarios" class="display" style="width:100%" data-order='[[ 1, "asc" ]]'>
        <thead>
            <tr>
                <td>Nome</td>
                <td>Gênero</td>
                <td>Idade</td>
                <td>Início do treinamento</td>
                <td>Grupo</td>
                <td>Ações</td>
            </tr>
        </thead>
        <tbody>
        <?php if(count($usuarios) > 0): ?>
                <?php foreach($usuarios as $usuario): ?>
                    <tr>
                        <td><?php echo $usuario['nome']; ?></td>
                        <td><?php echo $usuario['sexo']; ?></td>
                        <td>
                            <?php 
                                $dataNascimento = new DateTime($usuario['data_nascimento']);
                                $hoje = new DateTime(); // Data atual
                                $idade = $hoje->diff($dataNascimento)->y; // Calcula a diferença de anos
                                echo $idade;
                            ?>
                        </td>
                        <td><?php echo (new DateTime($usuario['data_inicio']))->format('d/m/Y'); ?></td>
                        <td><?php echo isset($usuario['grupo_nome']) ? $usuario['grupo_nome'] : 'Sem grupo'; ?></td>
                        <td>
                            <a class="btn view" href="<?php echo INCLUDE_PATH_PAINEL . 'ver-perfil?id=' . $usuario['id']; ?>"><i class="fa fa-eye" aria-hidden="true"></i> Ver</a>
                            <a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL . 'editar-perfil?id=' . $usuario['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar</a>
                            <a class="btn delete open-modal" data-id="<?php echo $usuario['id']; ?>" href="#"><i class="fa fa-times"></i> Excluir</a>
                            <a class="btn edit" href="<?php echo INCLUDE_PATH_PAINEL . 'listar-afa?id=' . $usuario['id']; ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> AFA</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            
            <?php endif; ?>
            
        </tbody>
    </table>

</div>

<!-- Modal de Confirmação -->
<div id="excluirModal" class="modal-excluir" style="display: none;">
    <div class="modal-excluir-content">
        <h2>Atenção!</h2>
        <p>Tem certeza que deseja excluir este usuário? Esta ação não pode ser desfeita.</p>
        <form id="formExcluirUsuario" method="POST">
            <input type="hidden" name="id_usuario" id="id_usuario_excluir" value="">
            <div class="modal-excluir-actions">
                <button type="button" id="cancelarExcluir" class="btn">Cancelar</button>
                <button type="submit" class="btn delete">Confirmar</button>
            </div>
        </form>
    </div>
</div>

