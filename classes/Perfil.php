<?php
    class Perfil{
        
        public static function cadastrarPerfil($usuario_id, $data_avaliacao, $peso, $altura, $obesidade, $diabetes, $hipertensao, $depressao, $pos_covid, $idoso, $gestante, $pos_parto, $emagrecer){
            $sql = MySql::conectar()->prepare("INSERT INTO tb_perfis_usuarios VALUES (null,?,?,?,?,?,?,?,?,?,?,?,?,?)");
            $sql->execute(array($usuario_id, $data_avaliacao, $peso, $altura, $obesidade, $diabetes, $hipertensao, $depressao, $pos_covid, $idoso, $gestante, $pos_parto, $emagrecer));
        }
    }

?>