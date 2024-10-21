<?php
class MedidaCorporal {

    private $db;
    private $conexao;
    
    public function __construct() {
        $this->conexao = MySql::conectar();
        $this->db = MySql::conectar();
    }

    public function gravarMedidas($usuario_id, $dadosMedidas, $dataAvaliacao) {
        // Verifique se $dadosMedidas tem exatamente 34 elementos
        if (count($dadosMedidas) !== 35) {
            throw new Exception("O array \$dadosMedidas deve conter exatamente 35 valores.");
        }
        
        $sql = $this->conexao->prepare("
            INSERT INTO `tb_medidas_corporais` 
            (usuario_id, punho_direito, ante_braco_direito, braco_direito_relaxado, braco_direito_contraido, punho_esquerdo, ante_braco_esquerdo, braco_esquerdo_relaxado, braco_esquerdo_contraido, pescoco, torax, cintura, abdomen, quadril, coxa_medial_direita, coxa_medial_esquerda, panturrilha_direita, panturrilha_esquerda, tricipital, subescapular, suprailiaca, abdominal, supraespinhal, coxa_guedes, coxa_pollock, peitoral, axilar_media, biceps, somatorio, somatorio_pollock_3D, somatorio_pollock_7D, somatorio_guedes_3D, biestiloide, biepicondiliano, bicondiliano, bimaleolar, data_avaliacao)
            VALUES 
            (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $sql->execute(array_merge([$usuario_id], array_values($dadosMedidas), [$dataAvaliacao]));
    
        if ($sql->rowCount() > 0) {
            return true;
        } else {
            return false;
        }
    }

    public function listarMedidaCorporal() {
        try {
            $sql = $this->db->prepare("
                SELECT a.*, u.nome 
                FROM tb_medidas_corporais a 
                JOIN `tb_admin.usuarios` u ON a.usuario_id = u.id 
                ORDER BY a.data_avaliacao DESC
            ");
            $sql->execute();
            
            // Verifique se há resultados
            $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $resultados ?: []; // Retorna um array vazio se não houver resultados
        } catch (PDOException $e) {
            // Log de erro detalhado
            error_log("Erro ao listar Medidas corporais: " . $e->getMessage());
            return false; // Retorna false em caso de erro
        }
    }

    public function buscarMedidaCorporalPorId($id) {
        $sql = $this->db->prepare("SELECT * FROM tb_medidas_corporais WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarMedidaCorporalPorUsuarioId($usuario_id) {
        $sql = $this->db->prepare("SELECT * FROM tb_medidas_corporais WHERE usuario_id = :usuario_id ORDER BY data_avaliacao DESC");
        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna todas as medidas corporais do usuário
    }
}
