<?php 
    verificaPermissaoPagina(1);
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
            $email = $_POST['email'];
            $telefone= $_POST['telefone'];
            $data_nascimento = $_POST['data_nascimento'];
            $data_inicio = $_POST['data_inicio'];
            $sexo = $_POST['sexo'];
            $cpf = $_POST['cpf'];

            // Obter o ID do usuário logado
            $professor_ID = $_SESSION['id']; // Supondo que o ID do usuário logado está armazenado em $_SESSION['id']
            
            // Definindo o cargo do novo usuário baseado no cargo da sessão
            if ($_SESSION['cargo'] == 2) {
                $cargo = 1;
            } elseif ($_SESSION['cargo'] == 1) {
                $cargo = 0;
            } else {
                Painel::alert('erro', 'Você não tem permissão para adicionar usuários.');
                return;
            }

            // validar os campos antes de add
            if($user == ''){
                Painel::alert('erro', 'O login está vazio');
            } else if ($nome == ''){
                Painel::alert('erro', 'O nome está vazio');
            } else if ($password == ''){
                Painel::alert('erro', 'A senha está vazia');
            //} else if($imagem['name'] == ''){
            //   Painel::alert('erro', 'A imagem precisa estar selecionada');
            } else if($email == ''){
                Painel::alert('erro', 'O email precisa ser informado');
            } else if($telefone == ''){
                Painel::alert('erro', 'O telefone precisa ser informado');  
            } else if($data_nascimento == ''){
                Painel::alert('erro', 'A data de nascimento precisa ser informada');
            } else if($data_inicio == ''){
                Painel::alert('erro', 'A data de início de treinamento precisa ser informada');
            } else if($sexo == ''){
                Painel::alert('erro', 'O gênero precisa ser informado');
            } else if($cpf == ''){
                Painel::alert('erro', 'O CPF precisa ser informado');
            } else {
                // podemos cadastrar !
                if($cargo >= $_SESSION['cargo']){
                    Painel::alert('erro', 'Você não pode cadastrar um usuário com permissões maiores que as suas');
                //} else if(Painel::imagemValida($imagem) == false){
                //    Painel::alert('erro', 'O formato da imagem não é válido');
                } else if (Usuario::userExists($user)){
                    Painel::alert('erro', 'O login já está em uso, selecione outro');
                } else {
                    // Apenas cadastrar no banco de dados 
                    $usuario = new Usuario();
                    $img = Painel::uploadImagem($imagem);
                    // Passando o professor_ID ao cadastrar
                    $usuario->cadastrarUsuario($user, $password, $img, $nome, $cargo, $email, $telefone, $data_nascimento, $data_inicio, $sexo, $cpf, $professor_ID);
                    Painel::alert('sucesso', 'Usuário '.$user. ' cadastrado com sucesso');
                }
            }     
        }
    ?>

    <div class="form-group left w50">
        <label>Login:</label>
        <input type="text" name="user" autocomplete="__away">
    </div><!-- form-group -->

    <div class="form-group right w50">
        <label>Senha:</label>
        <input type="password" name="password" autocomplete="__away">
    </div><!-- form-group -->

    <div class="form-group">
        <label>Nome:</label>
        <input type="text" name="nome">
    </div><!-- form-group -->

    

    <div class="form-group">
        <label>Imagem:</label>
        <input type="file" name="imagem" />
        <input type="hidden" name="imagem_atual" />
    </div><!-- form-group -->

    <div class="form-group left w50">
        <label>E-mail:</label>
        <input type="email" name="email" />
    </div><!-- form-group -->

    <div class="form-group right w50">
        <label>Telefone:</label>
        <input type="text" name="telefone" data-mask="(00) 00000-0000" />
    </div><!-- form-group -->

    <div class="form-group left w50">
        <label>Gênero:</label>
        <select name="sexo">
            <?php 
                foreach (Painel::$sexos as $key => $value){
                    echo '<option value="'.$key.'">'.$value.'</option>';
                }
            ?>
        </select>
    </div><!-- form-group -->

    <div class="form-group right w50">
        <label>CPF:</label>
        <input type="text" name="cpf" data-mask="000.000.000-00" />
    </div><!-- form-group -->

    <div class="form-group left w50">
        <label>Data de nascimento:</label>
        <input type="date" name="data_nascimento" />
    </div><!-- form-group -->

    <div class="form-group right w50">
        <label>Início do treinamento:</label>
        <input type="date" name="data_inicio" />
    </div><!-- form-group -->
    <div class="clear"></div><!-- clear -->

    
    
    <div class="form-group">
        <input type="submit" name="acao" value="Cadastrar"/>
    </div><!-- form-group -->
</form>

</div><!-- box-content -->
