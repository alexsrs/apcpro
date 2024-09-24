<div class="box-content">
<h2><i class="fa fa-pencil" aria-hidden="true"></i> Editar usuário</h2>

<form method="post" enctype="multipart/form-data"> <!-- sem o atributo enctype nao envia a imagem -->

    <?php 
        if(isset($_POST['acao'])){
            // enviando o formulario 
            
            //$usuario = new Usuario();
            $nome = $_POST['nome'];
            $password = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $usuario = new Usuario();

            if($imagem['name'] != ''){
                // existe upload de nova imagem 

                
                if(Painel::imagemValida($imagem)){
                    Painel::deleteImagem($imagem_atual);
                    $imagem = Painel::uploadImagem($imagem);
                    if($usuario->atualizarUsuario($nome,$password,$imagem)){
                        $_SESSION['img'] = $imagem;
                        Painel::alert('sucesso','Usuário atualizado com sucesso');
                    } else {
                        Painel::alert('erro','Ocorreu um erro ao atualizar o usuário');
                    }

                } else {
                    Painel::alert('erro', 'O formato da imagem não é valido');
                }

            } else {
                $imagem = $imagem_atual;
                if($usuario->atualizarUsuario($nome,$password,$imagem)){
                    Painel::alert('sucesso','Usuário atualizado com sucesso');
                } else {
                    Painel::alert('erro','Ocorreu um erro ao atualizar o usuário');
                }
            }
        }

    ?>

    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome" required value="<?php echo $_SESSION['nome']; ?>"/>
    </div><!-- form-group -->

    <div class="form-group">
        <label>Senha:</label>
        <input type="password" name="password" required value="<?php echo $_SESSION['password']; ?>" />
    </div><!-- form-group -->

    <div class="form-group">
        <label>Imagem</label>
        <input type="file" name="imagem" />
        <input type="hidden" name="imagem_atual" value="<?php echo $_SESSION['img']; ?>" />
    </div><!-- form-group -->
    
    <div class="form-group">
        <input type="submit" name="acao" value="Atualizar"/>
    </div><!-- form-group -->
</form>

</div><!-- box-content -->