<?php
class ComposicaoCorporal {
    private $db;

    public function __construct() {
        $this->db = MySql::conectar();
    }

    public function gravarComposicao($usuario_id, $dadosComposicao, $dataAvaliacao) {
        $sql = $this->db->prepare("INSERT INTO tb_composicao_corporal 
            (usuario_id, data_avaliacao, percentual_gordura, massa_gordura, massa_magra) 
            VALUES 
            (:usuario_id, :data_avaliacao, :percentual_gordura, :massa_gordura, :massa_magra)");

        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->bindParam(':data_avaliacao', $dataAvaliacao);
        $sql->bindParam(':percentual_gordura', $dadosComposicao['percentual_gordura']);
        $sql->bindParam(':massa_gordura', $dadosComposicao['massa_gordura']);
        $sql->bindParam(':massa_magra', $dadosComposicao['massa_magra']);

        try {
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao gravar composição corporal: " . $e->getMessage());
            return false;
        }
    }
}
?>