<div class="box-content">
    <h2><i class="fa fa-pencil" aria-hidden="true"></i> Editar perfil</h2>

    <form method="post" enctype="multipart/form-data">

        <?php 
            // ID do usuário que está sendo editado, obtido pela URL
            $id = $_GET['id'];  
            
            // Instanciando a classe Usuário
            $usuario = new Usuario();

            // Buscando os dados do usuário no banco de dados
            $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE id = ?");
            $sql->execute([$id]);

            if ($sql->rowCount() > 0) {
                $dados = $sql->fetch(PDO::FETCH_ASSOC);

                // Atribuindo os valores do banco de dados às variáveis
                $nome = $dados['nome'];
                $password = ''; // Deixe o campo de senha vazio para não exibir a senha encriptada
                $imagem = $dados['img'];
                $user = $dados['user'];
                $telefone = $dados['telefone'];
                $data_nascimento = $dados['data_nascimento'];
                $data_inicio = $dados['data_inicio'];
                $sexo = $dados['sexo'];
                $cpf = $dados['cpf'];
            } else {
                Painel::alert('erro', 'Usuário não encontrado.');
                die(); // Interrompe a execução caso o usuário não seja encontrado
            }

            // Processando a atualização quando o formulário é enviado
            if(isset($_POST['acao'])){
                // Captura de dados do formulário
                $nome = $_POST['nome'];
                $password = $_POST['password'];
                $imagem = $_FILES['imagem'];
                $imagem_atual = $_POST['imagem_atual'];
                $user = $_POST['user'];
                $telefone = $_POST['telefone'];
                $data_nascimento = $_POST['data_nascimento'];
                $data_inicio = $_POST['data_inicio'];
                $sexo = $_POST['sexo'];
                $cpf = $_POST['cpf'];

                // Atualização dos dados do usuário
                if($imagem['name'] != ''){
                    if(Painel::imagemValida($imagem)){
                        Painel::deleteImagem($imagem_atual);
                        $imagem = Painel::uploadImagem($imagem);
                    } else {
                        Painel::alert('erro', 'O formato da imagem não é válido');
                        // Opcional: Adicione um `return` aqui se não quiser continuar a atualização
                    }
                } else {
                    $imagem = $imagem_atual;
                }

                // Verifica se a senha foi fornecida
                if(!empty($password)){
                    // Opcional: Adicione validações adicionais, como confirmação de senha
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                } else {
                    // Se a senha não for alterada, mantenha a senha atual
                    $sql = MySql::conectar()->prepare("SELECT password FROM `tb_admin.usuarios` WHERE id = ?");
                    $sql->execute([$id]);
                    $dados = $sql->fetch(PDO::FETCH_ASSOC);
                    $hashedPassword = $dados['password'];
                }

                // Atualiza o usuário com a senha adequada
                if($usuario->atualizarUsuario($id, $nome, $hashedPassword, $imagem, $user, $telefone, $data_nascimento, $data_inicio, $sexo, $cpf)){
                    Painel::alert('sucesso', 'Usuário atualizado com sucesso');
                } else {
                    Painel::alert('erro', 'Ocorreu um erro ao atualizar o usuário');
                }
            }
        ?>

        <!-- Preenchendo o formulário com os dados do banco de dados -->
        <div class="form-group">
            <label>Nome:</label>
            <input type="text" name="nome" required value="<?php echo htmlspecialchars($nome); ?>"/>
        </div><!-- form-group -->

        <div class="form-group">
            <label>Senha:</label>
            <input type="password" name="password" placeholder="Deixe em branco para manter a senha atual" />
        </div><!-- form-group -->

        <div class="form-group">
            <label>Imagem:</label>
            <input type="file" name="imagem" />
            <input type="hidden" name="imagem_atual" value="<?php echo htmlspecialchars($imagem); ?>" />
        </div><!-- form-group -->

        <div class="form-group left w50">
            <label>E-mail:</label>
            <input type="email" name="user" value="<?php echo htmlspecialchars($user); ?>" />
        </div><!-- form-group -->

        <div class="form-group right w50">
            <label>Telefone:</label>
            <input type="text" name="telefone" data-mask="(00) 00000-0000" value="<?php echo htmlspecialchars($telefone); ?>" />
        </div><!-- form-group -->

        <div class="form-group left w50">
            <label>Gênero:</label>
            <select name="sexo">
                <?php 
                    foreach (Painel::$sexos as $key => $value){
                        $selected = ($sexo == $key) ? 'selected' : '';
                        echo '<option value="'.htmlspecialchars($key).'" '.$selected.'>'.htmlspecialchars($value).'</option>';
                    }
                ?>
            </select>
        </div><!-- form-group -->

        <div class="form-group right w50">
            <label>CPF:</label>
            <input type="text" name="cpf" data-mask="000.000.000-00" value="<?php echo htmlspecialchars($cpf); ?>" />
        </div><!-- form-group -->

        <div class="form-group left w50">
            <label>Data de nascimento:</label>
            <input type="date" name="data_nascimento" value="<?php echo htmlspecialchars($data_nascimento); ?>" />
        </div><!-- form-group -->

        <div class="form-group right w50">
            <label>Início do treinamento:</label>
            <input type="date" name="data_inicio" value="<?php echo htmlspecialchars($data_inicio); ?>" />
        </div><!-- form-group -->

        <div class="form-group">
            <input type="submit" name="acao" value="Atualizar"/>
        </div><!-- form-group -->
    </form>

</div><!-- box-content -->
