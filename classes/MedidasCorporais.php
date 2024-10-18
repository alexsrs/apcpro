<?php
class MedidasCorporais {
    private $conexao;
    
    public function __construct() {
        $this->conexao = MySql::conectar();
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
}
