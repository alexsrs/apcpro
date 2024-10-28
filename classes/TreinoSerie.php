<?php
class TreinoSerie {
    private $pdo;

    public static $zonaAlvo = [
        '1' => 'Muito leve (>20% RVO²) Reabilitação cardíaca',
        '2' => 'Leve (20% < 39% RVO²) Controle de peso',
        '3' => 'Moderada (40% < 59% RVO²) Queima de gordura',
        '4' => 'Árdua (60% < 84% RVO²) Condicionamento cardiorespiratório',
        '5' => 'Muito árdua (85% < 99% RVO²) Limiar anaeróbico',
        '6' => 'Máxima (100% RVO²) Esforço maximo'
    ];

    public static $ativo =[
        '0'  => 'Inativo',
        '1' => 'Ativo'
    ];

    public static $vo2_exame =[
        '1'  => 'Medido por exame',
        '2' => 'Medido por equação',
        '3' => 'Medido por teste de esforço'
    ];


    public function __construct() {
        $this->pdo = MySql::conectar();
    }

    public function salvar($dados) {
        $sql = $this->pdo->prepare("INSERT INTO tb_treino_serie (
            usuario_id, aula_numero, descricao, zona_alvo, ativo, metodo, 
            fc_maxima, fc_reposo, vo2_exame, vo2_maximo, tempo_recuperacao, 
            incremento_hiit, incremento_miit, macrociclo, mesociclo, microciclo, 
            fase, sessao
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $sql->execute([
            $dados['usuario_id'], $dados['aula_numero'], $dados['descricao'], 
            $dados['zona_alvo'], $dados['ativo'], $dados['metodo'], 
            $dados['fc_maxima'], $dados['fc_reposo'], $dados['vo2_exame'], 
            $dados['vo2_maximo'], $dados['tempo_recuperacao'], 
            $dados['incremento_hiit'], $dados['incremento_miit'], 
            $dados['macrociclo'], $dados['mesociclo'], $dados['microciclo'], 
            $dados['fase'], $dados['sessao']
        ]);

        return $this->pdo->lastInsertId(); // Retorna o ID da série recém-criada
    }
}
?>