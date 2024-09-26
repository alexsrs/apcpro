<div class="box-content">
<h2><i class="fa fa-pencil" aria-hidden="true"></i> Editar perfil</h2>

<form method="post" enctype="multipart/form-data"> <!-- sem o atributo enctype nao envia a imagem -->

    <?php 
        if(isset($_POST['acao'])){
            // enviando o formulario 
            
            $nome = $_POST['nome'];
            $password = $_POST['password'];
            $imagem = $_FILES['imagem'];
            $imagem_atual = $_POST['imagem_atual'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $data_nascimento = $_POST['data_nascimento'];
            $data_inicio = $_POST['data_inicio'];
            $sexo = $_POST['sexo'];
            $cpf = $_POST['cpf'];
            $usuario = new Usuario();

            if($imagem['name'] != ''){
                // existe upload de nova imagem 

                if(Painel::imagemValida($imagem)){
                    Painel::deleteImagem($imagem_atual);
                    $imagem = Painel::uploadImagem($imagem);
                    if($usuario->atualizarUsuario($nome, $password, $imagem, $email, $telefone, $data_nascimento, $data_inicio, $sexo, $cpf)){
                        $_SESSION['img'] = $imagem;
                        Painel::alert('sucesso', 'Usuário atualizado com sucesso');
                    } else {
                        Painel::alert('erro', 'Ocorreu um erro ao atualizar o usuário');
                    }

                } else {
                    Painel::alert('erro', 'O formato da imagem não é válido');
                }

            } else {
                $imagem = $imagem_atual;
                if($usuario->atualizarUsuario($nome, $password, $imagem, $email, $telefone, $data_nascimento, $data_inicio, $sexo, $cpf)){
                    Painel::alert('sucesso', 'Usuário atualizado com sucesso');
                } else {
                    Painel::alert('erro', 'Ocorreu um erro ao atualizar o usuário');
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

    <div class="form-group left w50">
        <label>E-mail:</label>
        <input type="email" name="email" value="<?php echo $_SESSION['email']; ?>" />
    </div><!-- form-group -->

    <div class="form-group right w50">
        <label>Telefone:</label>
        <input type="text" name="telefone" value="<?php echo $_SESSION['telefone']; ?>" />
    </div><!-- form-group -->

    <div class="form-group left w50">
        <label>Gênero:</label>
        <select name="sexo">
            <?php 
                foreach (Painel::$sexos as $key => $value){
                    $selected = ($_SESSION['sexo'] == $key) ? 'selected' : '';
                    echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
                }
            ?>
        </select>
    </div><!-- form-group -->
    <div class="form-group right w50">
        <label>CPF:</label>
        <input type="text" name="cpf" value="<?php echo $_SESSION['cpf']; ?>" />
    </div><!-- form-group -->

    <div class="form-group left w50">
        <label>Data de nascimento:</label>
        <input type="date" name="data_nascimento" value="<?php echo $_SESSION['data_nascimento']; ?>" />
    </div><!-- form-group -->

    <div class="form-group right w50">
        <label>Início do treinamento:</label>
        <input type="date" name="data_inicio" value="<?php echo $_SESSION['data_inicio']; ?>" />
    </div><!-- form-group -->
    <div class="clear"></div><!-- clear -->

   

    <div class="form-group">
        <input type="submit" name="acao" value="Atualizar"/>
    </div><!-- form-group -->
</form>

</div><!-- box-content -->
