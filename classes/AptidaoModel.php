<?php

class AptidaoModel {

    public static $inclinação = [
        ' ' => '-- Selecione uma opção --',
        '1' => '1% - Iniciante',
        '2' => '2% - Intermediário',
        '3' => '3% - Avançado'
    ];
    
    public static function gravarAptidao($usuario_id, $dadosAptidao, $dataAvaliacao) {
        $sql = MySql::conectar()->prepare("INSERT INTO tb_usuarios_aptidao 
            (usuario_id, data_avaliacao, vo2_maximo, mets, metodo, fc_repouso, fc_max_pred) 
            VALUES (:usuario_id, :data_avaliacao, :vo2_maximo, :mets, :metodo, :fc_repouso, :fc_max_pred)");

        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->bindParam(':data_avaliacao', $dataAvaliacao);
        $sql->bindParam(':vo2_maximo', $dadosAptidao['vo2_maximo']);
        $sql->bindParam(':mets', $dadosAptidao['mets']);
        $sql->bindParam(':metodo', $dadosAptidao['metodo']);
        $sql->bindParam(':fc_repouso', $dadosAptidao['fc_repouso']);
        $sql->bindParam(':fc_max_pred', $dadosAptidao['fc_max_pred']);
        return $sql->execute(); // Retorna true se a operação for bem-sucedida
    }
}
?>
