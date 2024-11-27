<?php
    class Perfil {

        private $db;

        public function __construct() {
        // Assumindo que há uma classe MySql para conexão
        $this->db = MySql::conectar();
        }

        // Método para cadastrar perfil
        public static function cadastrarPerfil($usuario_id, $data_avaliacao, $peso, $altura, $obesidade, $diabetes, $hipertensao, $depressao, $pos_covid, $idoso, $gestante, $pos_parto, $emagrecer, $objetivo){
            $sql = MySql::conectar()->prepare("INSERT INTO tb_perfis_usuarios VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $sql->execute(array($usuario_id, $data_avaliacao, $peso, $altura, $obesidade, $diabetes, $hipertensao, $depressao, $pos_covid, $idoso, $gestante, $pos_parto, $emagrecer, $objetivo));
        }
    
        // Método para atualizar perfil (caso queira editar os dados de um perfil já existente)
        public function atualizarPerfil($usuario_id, $data_avaliacao, $peso, $altura, $obesidade, $diabetes, $hipertensao, $depressao, $pos_covid, $idoso, $gestante, $posparto, $emagrecer, $objetivo) {
            $sql = MySql::conectar()->prepare("UPDATE tb_perfis_usuarios SET data_avaliacao = ?, peso = ?, altura = ?, obesidade = ?, diabetes = ?, hipertensao = ?, depressao = ?, pos_covid = ?, idoso = ?, gestante = ?, posparto = ?, emagrecer = ?, objetivo = ? WHERE usuario_id = ?");
            $sql->execute([$data_avaliacao, $peso, $altura, $obesidade, $diabetes, $hipertensao, $depressao, $pos_covid, $idoso, $gestante, $posparto, $emagrecer, $objetivo, $usuario_id]);
        }


        public function listarPerfil() {
            try {
                $sql = $this->db->prepare("
                    SELECT a.*, u.nome 
                    FROM tb_perfis_usuarios a 
                    JOIN `tb_admin.usuarios` u ON a.usuario_id = u.id 
                    ORDER BY a.data_avaliacao DESC
                ");
                $sql->execute();
                
                // Verifique se há resultados
                $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
                return $resultados ?: []; // Retorna um array vazio se não houver resultados
            } catch (PDOException $e) {
                // Log de erro detalhado
                error_log("Erro ao listar perfil: " . $e->getMessage());
                return false; // Retorna false em caso de erro
            }
        }
    
        public function buscarPerfilPorId($id) {
            //$sql = $this->db->prepare("SELECT * FROM tb_perfis_usuarios WHERE id = :id");
            $sql = $this->db->prepare("SELECT p.*, u.sexo FROM tb_perfis_usuarios p JOIN `tb_admin.usuarios` u ON p.usuario_id = u.id WHERE p.id = :id");
            $sql->bindParam(':id', $id);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC);
        }

    
        public function buscarPerfilPorUsuarioId($usuario_id) {
            $sql = $this->db->prepare("SELECT * FROM tb_perfis_usuarios WHERE usuario_id = :usuario_id ORDER BY data_avaliacao DESC");
            $sql->bindParam(':usuario_id', $usuario_id);
            $sql->execute();
            return $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna todas as anamneses do usuário
        }
        public function buscarUltimoPerfilPorUsuarioId($usuario_id) {
            $sql = $this->db->prepare("SELECT * FROM tb_perfis_usuarios WHERE usuario_id = :usuario_id ORDER BY data_avaliacao DESC LIMIT 1");
            $sql->bindParam(':usuario_id', $usuario_id);
            $sql->execute();
            return $sql->fetch(PDO::FETCH_ASSOC); // Retorna todas as anamneses do usuário
        }
    

        
    }
?>

