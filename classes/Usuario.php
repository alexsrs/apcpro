<?php 
    class Usuario{

        public function atualizarUsuario($nome, $password, $imagem, $email, $telefone, $data_nascimento, $data_inicio, $sexo, $cpf){
            $sql = MySql::conectar()->prepare("UPDATE `tb_admin.usuarios` SET nome = ?, password = ?, img = ?, email = ?, telefone = ?, data_nascimento = ?, data_inicio = ?, sexo = ?, cpf=? WHERE user = ?");
            if($sql->execute(array($nome,$password,$imagem,$email, $telefone, $data_nascimento, $data_inicio, $sexo, $cpf, $_SESSION['user']))){
                return true;
            } else {
                return false;
            }
        }

        public static function userExists($user){
            $sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE user=?");
            $sql->execute(array($user));
            if($sql->rowCount() == 1)
                return true;
            else 
                return false;
        }

        public static function cadastrarUsuario($user,$password,$img,$nome,$cargo,$email,$telefone,$data_nascimento,$data_inicio,$sexo, $cpf, $professor_id, $grupo){
            $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $sql->execute(array($user,$password,$img,$nome,$cargo,$email,$telefone, $data_nascimento,$data_inicio,$sexo,$cpf, $professor_id, $grupo));
        }
    }
?>