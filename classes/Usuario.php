<?php 
    class Usuario{

        public function atualizarUsuario($nome, $password, $imagem, $email, $data_nacimento, $data_inicio, $sexo){
            $sql = MySql::conectar()->prepare("UPDATE `tb_admin.usuarios` SET nome = ?, password = ?, img = ?, email = ?, data_nascimento = ?, data_inicio = ?, sexo = ?, WHERE user = ?");
            if($sql->execute(array($nome,$password,$imagem,$email, $data_nacimento, $data_inicio, $sexo, $_SESSION['user']))){
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

        public static function cadastrarUsuario($user,$password,$img,$nome,$cargo,$email,$data_nacimento,$data_inicio,$sexo, $professor_id){
            $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?,?,?,?,?,?)");
            $sql->execute(array($user,$password,$img,$nome,$cargo,$email,$data_nacimento,$data_inicio,$sexo, $professor_id));
        }
    }
?>