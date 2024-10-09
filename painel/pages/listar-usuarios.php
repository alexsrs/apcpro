<?php 
//session_start();
verificaPermissaoPagina(1); // Verifica se o usuário tem permissão para acessar a página

// Conexão com o banco de dados
require_once('../config.php');

// Busca todos os usuários associados ao professor logado
$professorID = $_SESSION['id'];
$sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE professor_id = ?");
$sql->execute(array($professorID));
$usuarios = $sql->fetchAll();
?>

    <div class="box-content">
    <h2><i class="fa fa-search mr-2"></i> Filtros</h2>
        
        <form>
            
            
            <div class="form-group left w100">
                <label for="GrupoFiltro">Grupo</label>
                <select name="GrupoFiltro" id="GrupoFiltro" class="form-control"><option value="">Selecione um grupo</option>
                    <option value="null">Atletas sem grupo</option>
                    <option value="1278">VOLEIBOL FEMININO - SUPERLIGA 2024</option>
                </select>
            </div>
            <div class="clear"></div><!-- clear -->
                <div class="linha">
            <div class="form-group w33">
                <label for="NomeFiltro">Nome</label>
                <input type="text" name="NomeFiltro" id="NomeFiltro" placeholder="Nome do atleta" class="form-control default-focus">
            </div>
            <div class="form-group w33">
                <label for="IdadeFiltro">Idade</label>
                <input type="number" name="IdadeFiltro" id="IdadeFiltro" placeholder="Idade do atleta" class="form-control">
            </div>
            <div class="form-group w33">
                <label for="GeneroFiltro">Gênero</label>
                <select id="GeneroFiltro" name="GeneroFiltro" class="form-control">
                    <option selected="" value="">Selecione um gênero</option>
                    <option value="m">Masculino</option>
                    <option value="f">Feminino</option>
                </select>
            </div>
</div>
            <div class="clear"></div><!-- clear -->
            <div class="form-group">
                <button type="submit" name="filtrar"><a><i class="fa fa-search mr-2"></i>Pesquisar</a></button>
            </div>

        </form>
    </div><!--box-content-->

    <div class="box-content">
    <h2><i class="fa fa-users" aria-hidden="true"></i> Lista de <?php if($_SESSION['cargo'] == 2) { echo 'professores'; } else { echo 'alunos'; } ?></h2>
        <div class="wraper-table">
            <table>
                            <tr>
                                <td>Nome</td>
                                <td>CPF</td>
                                <td>E-mail</td>
                                <td>telefone</td>
                                <td>Gênero</td>
                                <td>Idade</td>
                                <td>Inicio do treinamento</td>
                                <td>Ações</td>
                            </tr>
                    <?php if(count($usuarios) > 0): ?>
                        <?php foreach($usuarios as $usuario): ?>
                            <tr>
                                <td><?php echo $usuario['nome']; ?></td>
                                <td><?php echo $usuario['cpf']; ?></td>
                                <td><?php echo $usuario['email']; ?></td>
                                <td><?php echo $usuario['telefone']; ?></td>
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
                                <td>
                                    <a class="btn edit" href="editar_usuario.php?id=<?php echo $usuario['id']; ?>"><i class="fa fa-pencil"></i> Editar</a>
                                    <a class="btn delete" href=""><i class="fa fa-times"></i> Excluir</a></td>
                            
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">Nenhum aluno cadastrado.</td>
                        </tr>
                    <?php endif; ?>
                
            </table>
        </div><!--wraper-table-->

        <div class="paginacao">
            <a class="page-selected" href="">1</a>
            <a href="">2</a>
            <a href="">3</a>
        </div><!--paginacao-->
    </div><!-- box-content -->

