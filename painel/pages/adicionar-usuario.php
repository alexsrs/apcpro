<?php 
    verificaPermissaoPagina(2);
?>

<div class="box-content">
<h2><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar usuário</h2>

<form method="post" enctype="multipart/form-data"> <!-- sem o atributo enctype nao envia a imagem -->

    <?php 
        if(isset($_POST['acao'])){
            // enviando o formulario 
            $user = $_POST['user'];
            $nome = $_POST['nome'];
            $password = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $cargo = $_POST['cargo'];
            // validar os campos antes de add
            if($user ==''){
                Painel::alert('erro','O login esta vazio');
            } else if ($nome ==''){
                Painel::alert('erro','O nome esta vazio');
            } else if ($password ==''){
                Painel::alert('erro','A senha esta vazia');
            } else if ($cargo ==''){
                Painel::alert('erro','O cargo precisa ser selecionado');
            } else if($imagem['name'] == ''){
                Painel::alert('erro','A imagem precisa estar selecionada');
            
            } else {
                // podemos cadastrar !
                if($cargo >= $_SESSION['cargo']){
                    Painel::alert('erro','Você não pode cadastrar um usuario com permissões maiores que as suas');
                } else if(Painel::imagemValida($imagem) == false){
                    Painel::alert('erro','O formato da imagem não é valida');
                } else if (Usuario::userExists($user)){
                    Painel::alert('erro','O login ja esta em uso, selecione outro');
                } else {
                    //Apenas cadastrar no banco de dados 
                    $usuario = new Usuario();
                    $img = Painel::uploadImagem($imagem);
                    $usuario->cadastrarUsuario($user,$password,$img,$nome,$cargo);
                    Painel::alert('sucesso','Usuário '.$user. ' cadastrado com sucesso');
                }
            }     
        }
    ?>
    <div class="form-group">
        <label>Login:</label>
        <input type="text" name="user">
    </div><!-- form-group -->

    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome">
    </div><!-- form-group -->

    <div class="form-group">
        <label>Senha:</label>
        <input type="password" name="password">
    </div><!-- form-group -->
    
    <div class="form-group">
        <label>Cargo:</label>
        <select name="cargo">
            <?php 
                foreach (Painel::$cargos as $key => $value){
                    if($key < $_SESSION['cargo']) echo '<option value="'.$key.'">'.$value.'</option>';
                }
            ?>
        </select>
    </div><!-- form-group -->

    <div class="form-group">
        <label>Imagem</label>
        <input type="file" name="imagem" />
        <input type="hidden" name="imagem_atual"  />
    </div><!-- form-group -->
    
    <div class="form-group">
        <input type="submit" name="acao" value="Cadastrar"/>
    </div><!-- form-group -->
</form>

</div><!-- box-content -->