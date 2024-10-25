<?php 
    verificaPermissaoPagina(1);
    $professor_ID = $_SESSION['id']; // Supondo que o ID do usuário logado está armazenado em $_SESSION['id']

    if (isset($_POST['categoria']) && isset($_POST['nova_categoria_nome'])) {
        $nova_categoria = $_POST['nova_categoria_nome'];
        if (!empty($nova_categoria)) {
            $sql = MySql::conectar()->prepare("INSERT INTO tb_categoria_exercicio (categoria) VALUES (?)");
            $sql->execute([$nova_categoria]);
            Painel::alert('sucesso', 'Nova categoria adicionada com sucesso!');
        }
    }

    $sql = MySql::conectar()->prepare("SELECT id, categoria FROM tb_categoria_exercicio");
    $sql->execute();
    $categorias = $sql->fetchAll();

    if(isset($_POST['acao'])){
		// Lista de chaves necessárias
	
		// Suponha que $pdo seja sua conexão PDO
		$exercicio = new Exercicio();
		
		// Adiciona a data da avaliação (pode ser a data atual ou uma data específica)
		$_POST['data_inclusao'] = date('Y-m-d H:i:s'); // Ou outra data conforme necessário
        $_POST['usuario_id'] = $professor_ID;
        $_POST['categoria_id'] = $_POST['categoria'];
		
		// Chama o método para salvar
		if ($exercicio->salvar($_POST)) {
			Painel::alert('sucesso', 'Dados gravados com sucesso!');
		} else {
			Painel::alert('erro', 'Erro ao gravar dados.');
		}
	}
?>

<div class="box-content">
    <h2><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar exercício</h2>
    <form method="post" enctype="multipart/form-data"> <!-- sem o atributo enctype nao envia a imagem -->

        <div class="form-group flex-container">
            <div class="select-container">
                <label>Categoria</label>
                <select name="categoria">
                    <?php 
                        // Exibir uma opção padrão
                        echo '<option value="0">-- Selecione para adicionar a categoria do exercício --</option>';

                        // Preencher o select com os dados
                        foreach ($categorias as $categoria) {
                            echo '<option value="'.$categoria['id'].'">'.$categoria['categoria'].'</option>';
                        }
                    ?>
                </select>
            </div><!-- select-container -->
            <!-- Botão ao lado do select -->
            <div class="button-container">
                <button type="button" onclick="document.getElementById('modalGrupo').style.display='flex'"><i class="fa fa-plus" aria-hidden="true"></i></button>
            </div><!-- button-container -->
        </div><!-- form-group -->
        <div class="clear"></div><!-- clear -->    

        <div class="form-group">
            <label>Nome do exercício</label>
            <input type="text" name="nome_exercicio" autocomplete="__away">
        </div><!-- form-group -->

        <div class="form-group left w50">
            <label>Articulacao</label>
            <select name="articulacao">
                <?php
                    echo '<option value="0">-- Selecione a articulação do exercício --</option>';
                    foreach (Exercicio::$articulacao as $key => $value){
                        echo '<option value="'.$value.'">'.$value.'</option>';
                    }
                ?>
                
            </select>
        </div><!-- form-group -->
        <div class="form-group right w50">
            <label>Membros</label>
            <select name="membro">
                <?php
                    echo '<option value="0">-- Selecione o grupo de membros do exercício --</option>';
                    foreach (Exercicio::$membro as $key => $value){
                        echo '<option value="'.$value.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div><!-- form-group -->
        <div class="form-group left w50">
            <label>Grupo muscular</label>
            <input type="text" name="grupo_muscular" autocomplete="__away">
        </div><!-- form-group -->

        <div class="form-group right w50">
            <label>Aplicação da força</label>
            <select name="aplicacao-forca">
                <?php
                    echo '<option value="0">-- Selecione a força em relação a gravidade --</option>';
                    foreach (Exercicio::$forca as $key => $value){
                        echo '<option value="'.$value.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div><!-- form-group -->
        <div class="clear"></div><!-- clear -->  
        
        <div class="form-group left w50">
            <label>Movimento</label>
            <select name="movimento">
                <?php
                    echo '<option value="0">-- Selecione o movimento a ser realizado --</option>';
                    foreach (Exercicio::$movimento as $key => $value){
                        echo '<option value="'.$value.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div><!-- form-group -->
        <div class="form-group right w50">
            <label>Video</label>
            <input type="text" name="video" autocomplete="__away">
        </div><!-- form-group -->

        <div class="form-group left w50">
            <label>Contra indicações</label>
            <input type="text" name="contra_indicacoes" autocomplete="__away">
        </div><!-- form-group -->
        <div class="form-group right w50">
            <label>Indicações</label>
            <input type="text" name="indicacoes" autocomplete="__away">
        </div><!-- form-group -->

        <div class="form-group left w50">
            <label>Gasto calórico - METs</label>
            <input type="number" name="gasto_calorico" autocomplete="__away">
        </div><!-- form-group -->
        
        <div class="form-group right w50">
            <label>Nível de dificuldade</label>
            <select name="nivel_dificuldade">
                <?php
                    echo '<option value="0">-- Selecione o nivel de dificuldade do exercício --</option>';
                    foreach (Exercicio::$dificuldade as $key => $value){
                        echo '<option value="'.$value.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div><!-- form-group -->
                    
        <div class="clear"></div><!-- clear -->    
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar"/>
        </div><!-- form-group -->
    </form>
</div> <!-- box-content -->

<!-- Modal -->
<div id="modalGrupo" style="display:none;">
    <div class="modal-content">
        <form method="post">
            <h3>Adicionar uma categoria</h3>
            <input type="text" name="nova_categoria_nome" placeholder="Digite a nova categoria" required>
            <input type="submit" name="categoria" value="Adicionar">
            <button type="button" onclick="document.getElementById('modalGrupo').style.display='none'">Fechar</button>
        </form>
    </div>
</div>