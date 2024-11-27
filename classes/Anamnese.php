<?php
class Anamnese {
    
    private $db;

    public function __construct() {
        // Assumindo que há uma classe MySql para conexão
        $this->db = MySql::conectar();
    }

    public static $nivelTreinamento = [
        ' ' => '-- Selecione uma opção --',
        '0' => 'Inativo',
        '1' => 'Ativo - Iniciante',
        '2' => 'Ativo - Intermediário',
        '3' => 'Ativo - Avançado'
    ];


    public function cadastrarAnamnese($dados) {
        // Preparar os dados para inserção
        $usuario_id = $dados['usuario_id'];
        $data_avaliacao = $dados['data_avaliacao'];
        $nivel_treinamento = $dados['nivel_treinamento'];

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
        $minutos_dia_recente = $dados['minutos_dia_recente'];
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

        //Desejam emagrecer
        $ciclo_menstrual = isset($dados['ciclo_menstrual']) ? $dados['ciclo_menstrual'] : null;
        $ciclo_menstrual_irregular = isset($dados['ciclo_menstrual_irregular']) ? $dados['ciclo_menstrual_irregular'] : null;
        $sintomas_menstruais = isset($dados['sintomas_menstruais']) ? $dados['sintomas_menstruais'] : null; // JSON
        $uso_anticoncepcional = isset($dados['uso_anticoncepcional']) ? $dados['uso_anticoncepcional'] : null;
        $fatores_impedem_treino = isset($dados['fatores_impedem_treino']) ? $dados['fatores_impedem_treino'] : null; // JSON
        $dificuldade_emagrecer = isset($dados['dificuldade_emagrecer']) ? $dados['dificuldade_emagrecer'] : null; // JSON
        $remedios_emagrecer =  isset($dados['remedios_emagrecer']) ? 1 : 0;
        $autoestima = isset($dados['autoestima']) ? htmlspecialchars(trim($dados['autoestima'])) : null;
        $silhueta_real = isset($dados['silhueta_real']) && is_numeric($dados['silhueta_real']) ? intval($dados['silhueta_real']) : null;
        $silhueta_ideal = isset($dados['silhueta_ideal']) && is_numeric($dados['silhueta_ideal']) ? intval($dados['silhueta_ideal']) : null;
        $objetivos_6_meses = isset($dados['objetivos_6_meses']) ? $dados['objetivos_6_meses'] : null; // JSON
        $nome_remedios_emagrecer = !empty($dados['nome_remedios_emagrecer']) ? htmlspecialchars(trim($dados['nome_remedios_emagrecer'])) : null;
        $resultados_remedios = !empty($dados['resultados_remedios']) ? htmlspecialchars(trim($dados['resultados_remedios'])) : null;
        $dificuldade_emagrecer_outros = !empty($dados['dificuldade_emagrecer_outros']) ? htmlspecialchars(trim($dados['dificuldade_emagrecer_outros'])) : null;

        // Idosos
        $vestir = isset($dados['vestir']) ? $dados['vestir'] : null;
        $banho = isset($dados['banho']) ? $dados['banho'] : null;
        $caminhar = isset($dados['caminhar']) ? $dados['caminhar'] : null;
        $atividade_domestica_leve = isset($dados['atividade_domestica_leve']) ? $dados['atividade_domestica_leve'] : null;
        $subir_escada = isset($dados['subir_escada']) ? $dados['subir_escada'] : null;
        $fazer_compras = isset($dados['fazer_compras']) ? $dados['fazer_compras'] : null;
        $carregar_arroz = isset($dados['carregar_arroz']) ? $dados['carregar_arroz'] : null;
        $caminhar_moderado = isset($dados['caminhar_moderado']) ? $dados['caminhar_moderado'] : null;
        $caminhar_intenso = isset($dados['caminhar_intenso']) ? $dados['caminhar_intenso'] : null;
        $carregar_mala = isset($dados['carregar_mala']) ? $dados['carregar_mala'] : null;
        $atividade_domestica_pesada = isset($dados['atividade_domestica_pesada']) ? $dados['atividade_domestica_pesada'] : null;
        $atividade_vigorosa = isset($dados['atividade_vigorosa']) ? $dados['atividade_vigorosa'] : null;
        $nivel_funcional = isset($dados['nivel_funcional']) ? $dados['nivel_funcional'] : null;

        

        // Preparar a query de inserção
        $sql = $this->db->prepare("INSERT INTO tb_usuarios_anamnese 
            (usuario_id, data_avaliacao, nivel_treinamento, domingo, segunda, terca, quarta, quinta, sexta, sabado, minutos_dia,
            exercicios, outros_exercicios,nao_gosta, nao_gosta_exercicios, atividade_recente, nome_atividade_recente, 
            dias_semana_recente, minutos_dia_recente, intensidade, doencas, doencas_nome, remedios, 
            cirurgias, regiao_cirurgia, dor_muscular, regioes_dor, dor_peito, tontura, movimento_diario, 
            movimentos_dia, parente_cardiaco, num_parente_cardiaco, fumante, info_pertinente, aceito,
            ciclo_menstrual, ciclo_menstrual_irregular, sintomas_menstruais, uso_anticoncepcional, 
            fatores_impedem_treino, dificuldade_emagrecer, remedios_emagrecer, autoestima, silhueta_real, silhueta_ideal, objetivos_6_meses, nome_remedios_emagrecer, resultados_remedios, dificuldade_emagrecer_outros, vestir, banho, caminhar, atividade_domestica_leve, subir_escada, fazer_compras, carregar_arroz, caminhar_moderado, caminhar_intenso, carregar_mala, atividade_domestica_pesada, atividade_vigorosa, nivel_funcional)
            VALUES 
            (:usuario_id, :data_avaliacao, :nivel_treinamento, :domingo, :segunda, :terca, :quarta, :quinta, :sexta, :sabado, :minutos_dia,
            :exercicios, :outros_exercicios, :nao_gosta, :nao_gosta_exercicios, :atividade_recente, :nome_atividade_recente, 
            :dias_semana_recente, :minutos_dia_recente, :intensidade, :doencas, :doencas_nome, :remedios, 
            :cirurgias, :regiao_cirurgia, :dor_muscular, :regioes_dor, :dor_peito, :tontura, :movimento_diario, 
            :movimentos_dia, :parente_cardiaco, :num_parente_cardiaco, :fumante, :info_pertinente, :aceito,
            :ciclo_menstrual, :ciclo_menstrual_irregular, :sintomas_menstruais, :uso_anticoncepcional, 
            :fatores_impedem_treino, :dificuldade_emagrecer, :remedios_emagrecer, :autoestima, :silhueta_real, :silhueta_ideal, :objetivos_6_meses, :nome_remedios_emagrecer, :resultados_remedios, :dificuldade_emagrecer_outros, :vestir, :banho, :caminhar, :atividade_domestica_leve, :subir_escada, :fazer_compras, :carregar_arroz, :caminhar_moderado, :caminhar_intenso, :carregar_mala, :atividade_domestica_pesada, :atividade_vigorosa, :nivel_funcional)");

        // Bind dos parâmetros
        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->bindParam(':data_avaliacao', $data_avaliacao);
        $sql->bindParam(':nivel_treinamento', $nivel_treinamento);
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
        $sql->bindParam(':minutos_dia_recente', $minutos_dia_recente);
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
        $sql->bindParam(':ciclo_menstrual', $ciclo_menstrual);
        $sql->bindParam(':ciclo_menstrual_irregular', $ciclo_menstrual_irregular);
        $sql->bindParam(':sintomas_menstruais', $sintomas_menstruais);
        $sql->bindParam(':uso_anticoncepcional', $uso_anticoncepcional);
        $sql->bindParam(':fatores_impedem_treino', $fatores_impedem_treino);
        $sql->bindParam(':dificuldade_emagrecer', $dificuldade_emagrecer);
        $sql->bindParam(':remedios_emagrecer', $remedios_emagrecer);
        $sql->bindParam(':autoestima', $autoestima);
        $sql->bindParam(':silhueta_real', $silhueta_real);
        $sql->bindParam(':silhueta_ideal', $silhueta_ideal);
        $sql->bindParam(':objetivos_6_meses', $objetivos_6_meses);
        $sql->bindParam(':nome_remedios_emagrecer', $nome_remedios_emagrecer);
        $sql->bindParam(':resultados_remedios', $resultados_remedios);
        $sql->bindParam(':dificuldade_emagrecer_outros', $dificuldade_emagrecer_outros);
        $sql->bindParam(':vestir', $vestir);
        $sql->bindParam(':banho', $banho);
        $sql->bindParam(':caminhar', $caminhar);
        $sql->bindParam(':atividade_domestica_leve', $atividade_domestica_leve);
        $sql->bindParam(':subir_escada', $subir_escada);
        $sql->bindParam(':fazer_compras', $fazer_compras);
        $sql->bindParam(':carregar_arroz', $carregar_arroz);
        $sql->bindParam(':caminhar_moderado', $caminhar_moderado);
        $sql->bindParam(':caminhar_intenso', $caminhar_intenso);
        $sql->bindParam(':carregar_mala', $carregar_mala);
        $sql->bindParam(':atividade_domestica_pesada', $atividade_domestica_pesada);
        $sql->bindParam(':atividade_vigorosa', $atividade_vigorosa);
        $sql->bindParam(':nivel_funcional', $nivel_funcional);



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

    public function buscarAnamnesePorUsuarioId($usuario_id) {
        $sql = $this->db->prepare("SELECT * FROM tb_usuarios_anamnese WHERE usuario_id = :usuario_id ORDER BY data_avaliacao DESC");
        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->execute();
        return $sql->fetchAll(PDO::FETCH_ASSOC); // Retorna todas as anamneses do usuário
    }

    public function buscarUltimaAnamnesePorUsuarioId($usuario_id) {
        $sql = $this->db->prepare("SELECT * FROM tb_usuarios_anamnese WHERE usuario_id = :usuario_id ORDER BY data_avaliacao DESC LIMIT 1");
        $sql->bindParam(':usuario_id', $usuario_id);
        $sql->execute();
        return $sql->fetch(PDO::FETCH_ASSOC); // Retorna apenas a última anamnese do usuário
    
    }


} 
?>
