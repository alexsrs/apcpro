<?php
class Anamnese {
    
    private $db;

    public function __construct() {
        // Assumindo que há uma classe MySql para conexão
        $this->db = MySql::conectar();
    }

    public function cadastrarAnamnese($dados) {
        // Preparar os dados para inserção
        $usuario_id = $dados['usuario_id'];
        $data_avaliacao = $dados['data_avaliacao'];

        // Disponibilidade de Treino
        $domingo = $dados['domingo'];
        $segunda = $dados['segunda'];
        $terca = $dados['terca'];
        $quarta = $dados['quarta'];
        $quinta = $dados['quinta'];
        $sexta = $dados['sexta'];
        $sabado = $dados['sabado'];
        $minutos_dia = $dados['minutos_dia'];

        // Atividade Física
        $exercicios = $dados['exercicios']; // JSON
        $outros_exercicios = $dados['outros_exercicios'];
        $nao_gosta = $dados['nao_gosta']; 
        $nao_gosta_exercicios = $dados['nao_gosta_exercicios'];
        $atividade_recente = $dados['atividade_recente'];
        $nome_atividade_recente = $dados['nome_atividade_recente'];
        $dias_semana_recente = $dados['dias_semana_recente'];
        $horas_dia_recente = $dados['horas_dia_recente'];
        $intensidade = $dados['intensidade'];

        // Dados Médicos
        $doencas = $dados['doencas'];
        $doencas_nome = $dados['doencas_nome'];
        $remedios = $dados['remedios'];
        $cirurgias = $dados['cirurgias'];
        $regiao_cirurgia = $dados['regiao_cirurgia'];
        $dor_muscular = $dados['dor_muscular'];
        $regioes_dor = $dados['regioes_dor']; // JSON
        $dor_peito = $dados['dor_peito'];
        $tontura = $dados['tontura'];
        $movimento_diario = $dados['movimento_diario'];
        $movimentos_dia = $dados['movimentos_dia'];
        $parente_cardiaco = $dados['parente_cardiaco'];
        $num_parente_cardiaco = $dados['num_parente_cardiaco'];
        $fumante = $dados['fumante'];
        $info_pertinente = $dados['info_pertinente'];
        $aceito = $dados['aceito'];

        // Preparar a query de inserção
        $sql = $this->db->prepare("INSERT INTO tb_usuarios_anamnese 
            (usuario_id, data_avaliacao, domingo, segunda, terca, quarta, quinta, sexta, sabado, minutos_dia,
            exercicios, outros_exercicios,nao_gosta, nao_gosta_exercicios, atividade_recente, nome_atividade_recente, 
            dias_semana_recente, horas_dia_recente, intensidade, doencas, doencas_nome, remedios, 
            cirurgias, regiao_cirurgia, dor_muscular, regioes_dor, dor_peito, tontura, movimento_diario, 
            movimentos_dia, parente_cardiaco, num_parente_cardiaco, fumante, info_pertinente, aceito)
            VALUES 
            (:usuario_id, :data_avaliacao, :domingo, :segunda, :terca, :quarta, :quinta, :sexta, :sabado, :minutos_dia,
            :exercicios, :outros_exercicios, :nao_gosta, :nao_gosta_exercicios, :atividade_recente, :nome_atividade_recente, 
            :dias_semana_recente, :horas_dia_recente, :intensidade, :doencas, :doencas_nome, :remedios, 
            :cirurgias, :regiao_cirurgia, :dor_muscular, :regioes_dor, :dor_peito, :tontura, :movimento_diario, 
            :movimentos_dia, :parente_cardiaco, :num_parente_cardiaco, :fumante, :info_pertinente, :aceito)");

        // Bind dos parâmetros
        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->bindParam(':data_avaliacao', $data_avaliacao);
        $sql->bindParam(':domingo', $domingo);
        $sql->bindParam(':segunda', $segunda);
        $sql->bindParam(':terca', $terca);
        $sql->bindParam(':quarta', $quarta);
        $sql->bindParam(':quinta', $quinta);
        $sql->bindParam(':sexta', $sexta);
        $sql->bindParam(':sabado', $sabado);
        $sql->bindParam(':minutos_dia', $minutos_dia);
        $sql->bindParam(':exercicios', $exercicios);
        $sql->bindParam(':outros_exercicios', $outros_exercicios);
        $sql->bindParam(':nao_gosta', $nao_gosta);
        $sql->bindParam(':nao_gosta_exercicios', $nao_gosta_exercicios);
        $sql->bindParam(':atividade_recente', $atividade_recente);
        $sql->bindParam(':nome_atividade_recente', $nome_atividade_recente);
        $sql->bindParam(':dias_semana_recente', $dias_semana_recente);
        $sql->bindParam(':horas_dia_recente', $horas_dia_recente);
        $sql->bindParam(':intensidade', $intensidade);
        $sql->bindParam(':doencas', $doencas);
        $sql->bindParam(':doencas_nome', $doencas_nome);
        $sql->bindParam(':remedios', $remedios);
        $sql->bindParam(':cirurgias', $cirurgias);
        $sql->bindParam(':regiao_cirurgia', $regiao_cirurgia);
        $sql->bindParam(':dor_muscular', $dor_muscular);
        $sql->bindParam(':regioes_dor', $regioes_dor);
        $sql->bindParam(':dor_peito', $dor_peito);
        $sql->bindParam(':tontura', $tontura);
        $sql->bindParam(':movimento_diario', $movimento_diario);
        $sql->bindParam(':movimentos_dia', $movimentos_dia);
        $sql->bindParam(':parente_cardiaco', $parente_cardiaco);
        $sql->bindParam(':num_parente_cardiaco', $num_parente_cardiaco);
        $sql->bindParam(':fumante', $fumante);
        $sql->bindParam(':info_pertinente', $info_pertinente);
        $sql->bindParam(':aceito', $aceito);

        // Executar a query
        try {
            $sql->execute();
            return true;
        } catch (PDOException $e) {
            // Log de erro ou tratamento adicional
            error_log("Erro ao cadastrar anamnese: " . $e->getMessage() . " Dados: " . json_encode($dados));
            return false;
        }
    }

    public function listarAnamneses() {
        try {
            $sql = $this->db->prepare("
                SELECT a.*, u.nome 
                FROM tb_usuarios_anamnese a 
                JOIN `tb_admin.usuarios` u ON a.usuario_id = u.id 
                ORDER BY a.data_avaliacao DESC
            ");
            $sql->execute();
            
            // Verifique se há resultados
            $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $resultados ?: []; // Retorna um array vazio se não houver resultados
        } catch (PDOException $e) {
            // Log de erro detalhado
            error_log("Erro ao listar anamneses: " . $e->getMessage());
            return false; // Retorna false em caso de erro
        }
    }

    public function buscarAnamnesePorId($id) {
        $sql = $this->db->prepare("SELECT * FROM tb_usuarios_anamnese WHERE id = :id");
        $sql->bindParam(':id', $id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC);
    }
}
?>
