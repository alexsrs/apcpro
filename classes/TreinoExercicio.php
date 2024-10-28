<?php
class TreinoExercicio {
    private $pdo;

    public function __construct() {
        $this->pdo = MySql::conectar();
    }

    public function salvar($dados) {
        $sql = $this->pdo->prepare("INSERT INTO tb_treino_exercicio (
            treino_serie_id, exercicio_id, cargas, repeticoes, pausa, concentrica, excentrica, recuperacao_entre_series
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

        return $sql->execute([
            $dados['treino_serie_id'],
            $dados['exercicio_id'],
            json_encode($dados['cargas']),       // Armazena as cargas como JSON
            json_encode($dados['repeticoes']),   // Armazena as repetições como JSON
            $dados['pausa'],
            $dados['concentrica'],
            $dados['excentrica'],
            $dados['recuperacao_entre_series']
        ]);
    }
}
?>
