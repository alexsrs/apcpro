<?php 
    class Usuario{

        public function atualizarUsuario($id, $nome, $password, $imagem, $telefone, $data_nascimento, $data_inicio, $sexo, $cpf){
            $sql = MySql::conectar()->prepare("UPDATE `tb_admin.usuarios` SET nome = ?, password = ?, img = ?, telefone = ?, data_nascimento = ?, data_inicio = ?, sexo = ?, cpf = ? WHERE id = ?");
            if($sql->execute(array($nome, $password, $imagem, $telefone, $data_nascimento, $data_inicio, $sexo, $cpf, $id))){
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

        public static function cadastrarUsuario($user,$password,$img,$nome,$cargo, $telefone, $data_nascimento, $data_inicio,$sexo, $cpf, $professor_id, $grupo){
            $sql = MySql::conectar()->prepare("INSERT INTO `tb_admin.usuarios` VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?)");
            $sql->execute(array($user,$password,$img,$nome,$cargo,$telefone, $data_nascimento,$data_inicio,$sexo,$cpf, $professor_id, $grupo));
        }

        public static function excluirUsuario($id) {
            // Verifica se o usuário existe antes de excluir
            $sql = MySql::conectar()->prepare("SELECT `id` FROM `tb_admin.usuarios` WHERE id = ?");
            $sql->execute([$id]);
            
            if ($sql->rowCount() == 1) {
                // Se o usuário existe, faz a exclusão
                $sql = MySql::conectar()->prepare("DELETE FROM `tb_admin.usuarios` WHERE id = ?");
                if ($sql->execute([$id])) {
                    return true;
                } else {
                    return false; // Erro ao tentar excluir
                }
            } else {
                return false; // Usuário não encontrado
            }
        }
    }
?>