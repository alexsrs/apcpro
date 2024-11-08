<?php
class AptidaoModel {
    private $db;

    public function __construct() {
        $this->db = MySql::conectar();
    }

    public function gravarAptidao($usuario_id, $dadosAptidao, $dataAvaliacao) {
        $sql = $this->db->prepare("INSERT INTO tb_equacao_aptidao 
            (usuario_id, data_avaliacao, vo2_maximo, mets) 
            VALUES 
            (:usuario_id, :data_avaliacao, :vo2_maximo, :mets)");

        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->bindParam(':data_avaliacao', $dataAvaliacao);
        $sql->bindParam(':vo2_maximo', $dadosAptidao['vo2_maximo']);
        $sql->bindParam(':mets', $dadosAptidao['mets']);

        try {
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            error_log("Erro ao gravar aptidão cardiorespiratória: " . $e->getMessage());
            return false;
        }
    }
}
?>