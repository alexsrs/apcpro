<?php 
//session_start();
verificaPermissaoPagina(1); // Verifica se o usuário tem permissão para acessar a página

// Conexão com o banco de dados
require_once('../config.php');

// Busca o ID do professor logado
$professorID = $_SESSION['id'];

// Defina o número de itens por página
$itens_por_pagina = 10;

// Captura o número da página atual
$pagina_atual = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$inicio = ($pagina_atual - 1) * $itens_por_pagina;

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

$sql .= " LIMIT ?, ?";
$filters[] = $inicio;
$filters[] = $itens_por_pagina;

// Prepara e executa a consulta
$sql = MySql::conectar()->prepare($sql);
for ($i = 1; $i <= count($filters); $i++) {
    $sql->bindValue($i, $filters[$i - 1], is_int($filters[$i - 1]) ? PDO::PARAM_INT : PDO::PARAM_STR);
}
$sql->execute();
$usuarios = $sql->fetchAll();

// Contar total de usuários com filtros
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

// Calcula o total de páginas
$total_paginas = ceil($total_usuarios / $itens_por_pagina);

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
</div><!--box-content-->

<div class="box-content">
    <h2><i class="fa fa-users" aria-hidden="true"></i> Lista de <?php echo ($_SESSION['cargo'] == 2) ? 'professores' : 'alunos'; ?></h2>
    <div class="wraper-table">
        <table>
            <tr>
                <td>Nome</td>
                <td>Gênero</td>
                <td>Idade</td>
                <td>Início do treinamento</td>
                <td>Grupo</td>
                <td>Ações</td>
            </tr>
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
                            <a class="btn edit" href="editar_usuario.php?id=<?php echo $usuario['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
                            <a class="btn delete" href=""><i class="fa fa-times"></i> Excluir</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">Nenhum usuário encontrado.</td>
                </tr>
            <?php endif; ?>
        </table>
    </div><!--wraper-table-->
    <div class="paginacao">
        <?php for($i = 1; $i <= $total_paginas; $i++): ?>
            <a class="<?php echo ($i == $pagina_atual) ? 'page-selected' : ''; ?>" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
        <?php endfor; ?>
    </div><!--paginacao-->
</div><!-- box-content -->
