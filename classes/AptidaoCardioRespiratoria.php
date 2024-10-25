<?php
class AptidaoCardioRespiratoria {
    private $db;

    public function __construct() {
        $this->db = MySql::conectar();
    }

    public function salvar($data) {
        // Verifica se 'usuario_id' existe no array $data
        if (!isset($data['usuario_id'])) {
            throw new Exception('Usuário não especificado.');
        }

        $usuario_id = $data['usuario_id'];
        $data_avaliacao = $data['data_avaliacao'];

        // Dados do teste de Conconi
        $fcT1 = $data['fc-t1'] ?? null;
        $fcT2 = $data['fc-t2'] ?? null;
        $fcT3 = $data['fc-t3'] ?? null;
        $fcT4 = $data['fc-t4'] ?? null;
        $fcT5 = $data['fc-t5'] ?? null;
        $fcT6 = $data['fc-t6'] ?? null;
        $fcT7 = $data['fc-t7'] ?? null;
        $fcT8 = $data['fc-t8'] ?? null;
        $fcT9 = $data['fc-t9'] ?? null;
        $fcT10 = $data['fc-t10'] ?? null;
        $fcT11 = $data['fc-t11'] ?? null;
        $fcT12 = $data['fc-t12'] ?? null;
        $fcT13 = $data['fc-t13'] ?? null;
        $fcT14 = $data['fc-t14'] ?? null;
        $fcT15 = $data['fc-t15'] ?? null;
        $fcT16 = $data['fc-t16'] ?? null;
        $pseT1 = $data['pse-t1'] ?? null;
        $pseT2 = $data['pse-t2'] ?? null;
        $pseT3 = $data['pse-t3'] ?? null;
        $pseT4 = $data['pse-t4'] ?? null;
        $pseT5 = $data['pse-t5'] ?? null;
        $pseT6 = $data['pse-t6'] ?? null;
        $pseT7 = $data['pse-t7'] ?? null;
        $pseT8 = $data['pse-t8'] ?? null;
        $pseT9 = $data['pse-t9'] ?? null;
        $pseT10 = $data['pse-t10'] ?? null;
        $pseT11 = $data['pse-t11'] ?? null;
        $pseT12 = $data['pse-t12'] ?? null;
        $pseT13 = $data['pse-t13'] ?? null;
        $pseT14 = $data['pse-t14'] ?? null;
        $pseT15 = $data['pse-t15'] ?? null;
        $pseT16 = $data['pse-t16'] ?? null;
        
        // Resultados
        $fcRepouso = $data['fc-repouso'] ?? null;
        $fcMaxima = $data['fc-max'] ?? null;
        $velocidadeMaxima = $data['velocidade-max'] ?? null;
        $pseMaxima = $data['pse-max'] ?? null;
        $indiceFC = $data['indice-fc'] ?? null;
        $mets = $data['mets'] ?? null;
        $vo2MaxMl = $data['vo2-max-ml'] ?? null;
        $vo2MaxL = $data['vo2-max-l'] ?? null;
        $limiar1 = $data['limiar1'] ?? null;
        $fc_l1_percent = $data['fc_l1_percent'] ?? null;
        $limiar2 = $data['limiar2'] ?? null;
        $fc_l2_percent = $data['fc_l2_percent'] ?? null;
        $ivo2_x_kmh_30 = $data['ivo2_x_kmh_30'] ?? null;
        $ivo2_x_kmh_35 = $data['ivo2_x_kmh_35'] ?? null;
        $ivo2_x_kmh_40 = $data['ivo2_x_kmh_40'] ?? null;
        $ivo2_x_kmh_45 = $data['ivo2_x_kmh_45'] ?? null;
        $ivo2_x_kmh_50 = $data['ivo2_x_kmh_50'] ?? null;
        $ivo2_x_kmh_55 = $data['ivo2_x_kmh_55'] ?? null;
        $ivo2_x_kmh_60 = $data['ivo2_x_kmh_60'] ?? null;
        $ivo2_x_kmh_65 = $data['ivo2_x_kmh_65'] ?? null;
        $ivo2_x_kmh_70 = $data['ivo2_x_kmh_70'] ?? null;
        $ivo2_x_kmh_75 = $data['ivo2_x_kmh_75'] ?? null;
        $ivo2_x_kmh_80 = $data['ivo2_x_kmh_80'] ?? null;
        $ivo2_x_kmh_85 = $data['ivo2_x_kmh_85'] ?? null;
        $ivo2_x_kmh_90 = $data['ivo2_x_kmh_90'] ?? null;
        $ivo2_x_kmh_95 = $data['ivo2_x_kmh_95'] ?? null;
        $ivo2_x_kmh_100 = $data['ivo2_x_kmh_100'] ?? null;
        $ivo2_x_kmh_105 = $data['ivo2_x_kmh_105'] ?? null;
        $ivo2_x_kmh_110 = $data['ivo2_x_kmh_110'] ?? null;
        $ivo2_x_kmh_115 = $data['ivo2_x_kmh_115'] ?? null;
        $ivo2_x_kmh_120 = $data['ivo2_x_kmh_120'] ?? null;
        $ivo2_x_kmh_125 = $data['ivo2_x_kmh_125'] ?? null;
        $ivo2_x_kmh_130 = $data['ivo2_x_kmh_130'] ?? null;
        $ivo2_x_kmh_135 = $data['ivo2_x_kmh_135'] ?? null;
        $ivo2_x_kmh_140 = $data['ivo2_x_kmh_140'] ?? null;
        $ivo2_x_kmh_145 = $data['ivo2_x_kmh_145'] ?? null;
        $ivo2_x_kmh_150 = $data['ivo2_x_kmh_150'] ?? null;
        $ivo2_x_kmh_155 = $data['ivo2_x_kmh_155'] ?? null;
        $ivo2_x_kmh_160 = $data['ivo2_x_kmh_160'] ?? null;
        $ivo2_x_kmh_165 = $data['ivo2_x_kmh_165'] ?? null;
        $ivo2_x_kmh_170 = $data['ivo2_x_kmh_170'] ?? null;

        // Prepara a consulta SQL
        $sql = "INSERT INTO tb_aptidao_cardiorespiratoria (usuario_id, data_avaliacao, 
                fc_t1, fc_t2, fc_t3, fc_t4, fc_t5, fc_t6, fc_t7, fc_t8, 
                fc_t9, fc_t10, fc_t11, fc_t12, fc_t13, fc_t14, fc_t15, fc_t16,
                pse_t1, pse_t2, pse_t3, pse_t4, pse_t5, pse_t6, pse_t7, pse_t8,
                pse_t9, pse_t10, pse_t11, pse_t12, pse_t13, pse_t14, pse_t15, pse_t16, 
                fc_repouso, fc_max, velocidade_max, pse_max, indice_fc, mets, 
                vo2_max_ml, vo2_max_l, limiar1, fc_l1_percent, limiar2, fc_l2_percent, 
                ivo2_x_kmh_30, ivo2_x_kmh_35, ivo2_x_kmh_40, ivo2_x_kmh_45, ivo2_x_kmh_50, 
                ivo2_x_kmh_55, ivo2_x_kmh_60, ivo2_x_kmh_65, ivo2_x_kmh_70, ivo2_x_kmh_75, 
                ivo2_x_kmh_80, ivo2_x_kmh_85, ivo2_x_kmh_90, ivo2_x_kmh_95, ivo2_x_kmh_100, 
                ivo2_x_kmh_105, ivo2_x_kmh_110, ivo2_x_kmh_115, ivo2_x_kmh_120, ivo2_x_kmh_125, 
                ivo2_x_kmh_130, ivo2_x_kmh_135, ivo2_x_kmh_140, ivo2_x_kmh_145, ivo2_x_kmh_150, 
                ivo2_x_kmh_155, ivo2_x_kmh_160, ivo2_x_kmh_165, ivo2_x_kmh_170
            ) VALUES (
                :usuario_id, :data_avaliacao, 
                :fc_t1, :fc_t2, :fc_t3, :fc_t4, :fc_t5, :fc_t6, :fc_t7, :fc_t8, 
                :fc_t9, :fc_t10, :fc_t11, :fc_t12, :fc_t13, :fc_t14, :fc_t15, :fc_t16,
                :pse_t1, :pse_t2, :pse_t3, :pse_t4, :pse_t5, :pse_t6, :pse_t7, :pse_t8,
                :pse_t9, :pse_t10, :pse_t11, :pse_t12, :pse_t13, :pse_t14, :pse_t15, :pse_t16,
                :fc_repouso, :fc_max, :velocidade_max, :pse_max, :indice_fc, :mets, 
                :vo2_max_ml, :vo2_max_l, :limiar1, :fc_l1_percent, :limiar2, :fc_l2_percent, 
                :ivo2_x_kmh_30, :ivo2_x_kmh_35, :ivo2_x_kmh_40, :ivo2_x_kmh_45, :ivo2_x_kmh_50, 
                :ivo2_x_kmh_55, :ivo2_x_kmh_60, :ivo2_x_kmh_65, :ivo2_x_kmh_70, :ivo2_x_kmh_75, 
                :ivo2_x_kmh_80, :ivo2_x_kmh_85, :ivo2_x_kmh_90, :ivo2_x_kmh_95, :ivo2_x_kmh_100, 
                :ivo2_x_kmh_105, :ivo2_x_kmh_110, :ivo2_x_kmh_115, :ivo2_x_kmh_120, :ivo2_x_kmh_125, 
                :ivo2_x_kmh_130, :ivo2_x_kmh_135, :ivo2_x_kmh_140, :ivo2_x_kmh_145, :ivo2_x_kmh_150, 
                :ivo2_x_kmh_155, :ivo2_x_kmh_160, :ivo2_x_kmh_165, :ivo2_x_kmh_170
            )";

        $stmt = $this->db->prepare($sql);

        // Vincula os parâmetros (certifique-se de vincular todos os campos mencionados na consulta)
        $stmt->bindParam(':usuario_id', $usuario_id);
        $stmt->bindParam(':data_avaliacao', $data_avaliacao);
        $stmt->bindParam(':fc_t1', $fcT1);
        $stmt->bindParam(':fc_t2', $fcT2);
        $stmt->bindParam(':fc_t3', $fcT3);
        $stmt->bindParam(':fc_t4', $fcT4);
        $stmt->bindParam(':fc_t5', $fcT5);
        $stmt->bindParam(':fc_t6', $fcT6);
        $stmt->bindParam(':fc_t7', $fcT7);
        $stmt->bindParam(':fc_t8', $fcT8);
        $stmt->bindParam(':fc_t9', $fcT9);
        $stmt->bindParam(':fc_t10', $fcT10);
        $stmt->bindParam(':fc_t11', $fcT11);
        $stmt->bindParam(':fc_t12', $fcT12);
        $stmt->bindParam(':fc_t13', $fcT13);
        $stmt->bindParam(':fc_t14', $fcT14);
        $stmt->bindParam(':fc_t15', $fcT15);
        $stmt->bindParam(':fc_t16', $fcT16);
        $stmt->bindParam(':pse_t1', $pseT1);
        $stmt->bindParam(':pse_t2', $pseT2);
        $stmt->bindParam(':pse_t3', $pseT3);
        $stmt->bindParam(':pse_t4', $pseT4);
        $stmt->bindParam(':pse_t5', $pseT5);
        $stmt->bindParam(':pse_t6', $pseT6);
        $stmt->bindParam(':pse_t7', $pseT7);
        $stmt->bindParam(':pse_t8', $pseT8);
        $stmt->bindParam(':pse_t9', $pseT9);
        $stmt->bindParam(':pse_t10', $pseT10);
        $stmt->bindParam(':pse_t11', $pseT11);
        $stmt->bindParam(':pse_t12', $pseT12);
        $stmt->bindParam(':pse_t13', $pseT13);
        $stmt->bindParam(':pse_t14', $pseT14);
        $stmt->bindParam(':pse_t15', $pseT15);
        $stmt->bindParam(':pse_t16', $pseT16);
        $stmt->bindParam(':fc_repouso', $fcRepouso);
        $stmt->bindParam(':fc_max', $fcMaxima);
        $stmt->bindParam(':velocidade_max', $velocidadeMaxima);
        $stmt->bindParam(':pse_max', $pseMaxima);
        $stmt->bindParam(':indice_fc', $indiceFC);
        $stmt->bindParam(':mets', $mets);
        $stmt->bindParam(':vo2_max_ml', $vo2MaxMl);
        $stmt->bindParam(':vo2_max_l', $vo2MaxL);
        $stmt->bindParam(':limiar1', $limiar1);
        $stmt->bindParam(':fc_l1_percent', $fc_l1_percent);
        $stmt->bindParam(':limiar2', $limiar2);
        $stmt->bindParam(':fc_l2_percent', $fc_l2_percent);
        $stmt->bindParam(':ivo2_x_kmh_30', $ivo2_x_kmh_30);
        $stmt->bindParam(':ivo2_x_kmh_35', $ivo2_x_kmh_35);
        $stmt->bindParam(':ivo2_x_kmh_40', $ivo2_x_kmh_40);
        $stmt->bindParam(':ivo2_x_kmh_45', $ivo2_x_kmh_45);
        $stmt->bindParam(':ivo2_x_kmh_50', $ivo2_x_kmh_50);
        $stmt->bindParam(':ivo2_x_kmh_55', $ivo2_x_kmh_55);
        $stmt->bindParam(':ivo2_x_kmh_60', $ivo2_x_kmh_60);
        $stmt->bindParam(':ivo2_x_kmh_65', $ivo2_x_kmh_65);
        $stmt->bindParam(':ivo2_x_kmh_70', $ivo2_x_kmh_70);
        $stmt->bindParam(':ivo2_x_kmh_75', $ivo2_x_kmh_75);
        $stmt->bindParam(':ivo2_x_kmh_80', $ivo2_x_kmh_80);
        $stmt->bindParam(':ivo2_x_kmh_85', $ivo2_x_kmh_85);
        $stmt->bindParam(':ivo2_x_kmh_90', $ivo2_x_kmh_90);
        $stmt->bindParam(':ivo2_x_kmh_95', $ivo2_x_kmh_95);
        $stmt->bindParam(':ivo2_x_kmh_100', $ivo2_x_kmh_100);
        $stmt->bindParam(':ivo2_x_kmh_105', $ivo2_x_kmh_105);
        $stmt->bindParam(':ivo2_x_kmh_110', $ivo2_x_kmh_110);
        $stmt->bindParam(':ivo2_x_kmh_115', $ivo2_x_kmh_115);
        $stmt->bindParam(':ivo2_x_kmh_120', $ivo2_x_kmh_120);
        $stmt->bindParam(':ivo2_x_kmh_125', $ivo2_x_kmh_125);
        $stmt->bindParam(':ivo2_x_kmh_130', $ivo2_x_kmh_130);
        $stmt->bindParam(':ivo2_x_kmh_135', $ivo2_x_kmh_135);
        $stmt->bindParam(':ivo2_x_kmh_140', $ivo2_x_kmh_140);
        $stmt->bindParam(':ivo2_x_kmh_145', $ivo2_x_kmh_145);
        $stmt->bindParam(':ivo2_x_kmh_150', $ivo2_x_kmh_150);
        $stmt->bindParam(':ivo2_x_kmh_155', $ivo2_x_kmh_155);
        $stmt->bindParam(':ivo2_x_kmh_160', $ivo2_x_kmh_160);
        $stmt->bindParam(':ivo2_x_kmh_165', $ivo2_x_kmh_165);
        $stmt->bindParam(':ivo2_x_kmh_170', $ivo2_x_kmh_170);

        // Executa a consulta
        if ($stmt->execute()) {
            return true;
        } else {
            throw new Exception("Erro ao salvar a avaliação.");
        }
    }

    public function listarAptidaoCardioRespiratoria() {
        try {
            $sql = $this->db->prepare("
                SELECT a.*, u.nome 
                FROM tb_aptidao_cardiorespiratoria a 
                JOIN `tb_admin.usuarios` u ON a.usuario_id = u.id 
                ORDER BY a.data_avaliacao DESC
            ");
            $sql->execute();
            
            // Verifique se há resultados
            $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $resultados ?: []; // Retorna um array vazio se não houver resultados
        } catch (PDOException $e) {
            // Log de erro detalhado
            error_log("Erro ao listar Aptidão Cardiorespiratória: " . $e->getMessage());
            return false; // Retorna false em caso de erro
        }
    }

    public function buscarAptidaoCardioRespiratoriaPorId($id) {
        $sql = $this->db->prepare("SELECT * FROM tb_aptidao_cardiorespiratoria WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarAptidaoCardioRespiratoriaPorUsuarioId($usuario_id) {
        $sql = $this->db->prepare("SELECT * FROM tb_aptidao_cardiorespiratoria WHERE usuario_id = :usuario_id ORDER BY data_avaliacao DESC");
        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna todas as medidas corporais do usuário
    }
}
?>