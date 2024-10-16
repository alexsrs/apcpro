<?php
    class Perfil {

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
    }
?>

