<?php
class Exercicio {

    private $db;

    public function __construct() {
        // Assumindo que há uma classe MySql para conexão
        $this->db = MySql::conectar();
    }

    public static $articulacao = [
        '1' => 'Multi articular',
        '2' => 'Uni articular',
        '3' => 'Integrado',
    ];

    public static $membro = [
        '1' => 'Superior',
        '2' => 'Inferior',
        '3' => 'Superior e Inferior'
    ];

    public static $forca = [
        '1' => 'Contra a gravidade',
        '2' => 'A favor da gravidade',
        '3' => 'Neutro',
        '4' => 'Integrado'
    ];

    public static $movimento = [
        '1' => 'De empurrar',
        '2' => 'De puxar',
        '3' => 'Integrado'
    ];

    public static $dificuldade = [
        '1' => 'Fácil',
        '2' => 'Moderado',
        '3' => 'Difícil'
    ];

    public function salvar($dados) {
        $sql = MySql::conectar()->prepare("INSERT INTO `tb_exercicios_lib` (usuario_id, categoria_id ,nome_exercicio, articulacao, membro, grupo_muscular, aplicacao_forca, movimento, video, contra_indicacoes, indicacoes, mets_consumo_energetico, nivel_dificuldade, data_inclusao) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
        return $sql->execute([
            $dados['usuario_id'],
            $dados['categoria_id'],
            $dados['nome_exercicio'],
            $dados['articulacao'],
            $dados['membro'],
            $dados['grupo_muscular'],
            $dados['aplicacao-forca'],
            $dados['movimento'],
            $dados['video'],
            $dados['contra_indicacoes'],
            $dados['indicacoes'],
            $dados['gasto_calorico'],
            $dados['nivel_dificuldade'],
            $dados['data_inclusao']
        ]);
    }

    public function buscarExercicios() {
        try {
            $sql = $this->db->prepare("SELECT * FROM `tb_exercicios_lib`;");
            $sql->execute();
            
            // Verifique se há resultados
            $resultados = $sql->fetchAll(PDO::FETCH_ASSOC);
            return $resultados ?: []; // Retorna um array vazio se não houver resultados
        } catch (PDOException $e) {
            // Log de erro detalhado
            error_log("Erro ao listar exercícios: " . $e->getMessage());
            return false; // Retorna false em caso de erro
        }
    }

    public function buscarExercicioPorId($id) {
        try {
            $sql = $this->db->prepare("SELECT * FROM `tb_exercicios_lib` WHERE id = ?");
            $sql->execute([$id]);
            return $sql->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            error_log("Erro ao buscar exercício: " . $e->getMessage());
            return false;
        }
    }
}
?>
