<?php

class AptidaoModel {
    public static function gravarAptidao($usuario_id, $dadosAptidao, $dataAvaliacao) {
        $sql = MySql::conectar()->prepare("INSERT INTO tb_usuarios_aptidao 
            (usuario_id, data_avaliacao, vo2_maximo, mets, metodo) 
            VALUES (:usuario_id, :data_avaliacao, :vo2_maximo, :mets, :metodo)");

        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->bindParam(':data_avaliacao', $dataAvaliacao);
        $sql->bindParam(':vo2_maximo', $dadosAptidao['vo2_maximo']);
        $sql->bindParam(':mets', $dadosAptidao['mets']);
        $sql->bindParam(':metodo', $dadosAptidao['metodo']);

        return $sql->execute(); // Retorna true se a operação for bem-sucedida
    }
}
?>
