<?php
verificaPermissaoPagina(1);
include_once('pages/funcoes.php');

// Obtém o usuario_id da sessão ou pela URL (para admins ou edições externas)
if (isset($_GET['id'])) {
    $usuario_id = (int)$_GET['id']; // ID passado pela URL
} else {
    $usuario_id = $_SESSION['id']; // ID do usuário logado
}

// Verifica se o ID existe no banco de dados
$sql = MySql::conectar()->prepare("SELECT sexo FROM `tb_admin.usuarios` WHERE id = ?");
$sql->execute([$usuario_id]);
$result = $sql->fetch();

// Caso o usuário não exista
if (!$result) {
    echo "Usuário não encontrado!";
    exit();
}

// Instância da classe Exercicio
$exercicioObj = new Exercicio();
$exercicios = $exercicioObj->buscarExercicios();

if (isset($_POST['acao'])) {
    $treinoSerie = new TreinoSerie();
    $_POST['usuario_id'] = $usuario_id; // Adiciona o usuario_id ao array de dados
    $serieId = $treinoSerie->salvar($_POST);

    if ($serieId) {
        $treinoExercicio = new TreinoExercicio();

        foreach ($_POST['series'] as $serie) {
            foreach ($serie['exercicios'] as $exercicio) {
                $exercicio['treino_serie_id'] = $serieId; // Usa o ID da série recém-criada
                $exercicio['cargas'] = $exercicio['cargas'];
                $exercicio['repeticoes'] = $exercicio['repeticoes'];
                $treinoExercicio->salvar($exercicio);
            }
        }
        Painel::alert('sucesso', 'Treino com séries de exercícios adicionados com sucesso!');
    } else {
        Painel::alert('erro', 'Erro ao adicionar treino.');
    }
}
?>

<div class="box-content">
    <h2><i class="fa fa-pencil" aria-hidden="true"></i> Adicionar Treino</h2>
    <form method="post">
        <fieldset>
        <!-- Campo oculto para usuario_id -->
        <input type="hidden" name="usuario_id" value="<?= $usuario_id ?>">

        <!-- Dados do Treino -->
        <legend>Dados do treino</legend>
        <div class="form-group w33">
            <label>Aula Número:</label>
            <input type="number" name="aula_numero" required>
        </div>
        <div class="form-group w33">
            <label>Macrociclo:</label>
            <input type="text" name="macrociclo" required>
        </div>
        <div class="form-group w33">
            <label>Mesociclo:</label>
            <input type="text" name="mesociclo" required>
        </div>
        <div class="form-group w33">
            <label>Microciclo:</label>
            <input type="text" name="microciclo" required>
        </div>
        <div class="form-group w33">
            <label>Fase:</label>
            <input type="text" name="fase" required>
        </div>
        <div class="form-group w33">
            <label>Sessão:</label>
            <input type="text" name="sessao" required>
        </div>

        <div class="form-group">
            <label>Descrição:</label>
            <input type="text" name="descricao" required>
        </div>
        <div class="form-group w33">
            <label>Zona Alvo:</label>
            <select name="zona_alvo">
                <?php 
                    foreach (TreinoSerie::$zonaAlvo as $key => $value){
                        echo '<option value="'.$value.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group w33">
            <label>Ativo:</label>
            <select name="ativo">
                <?php 
                    foreach (TreinoSerie::$ativo as $key => $value){
                        echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group w33">
            <label>Método:</label>
            <input type="text" name="metodo" required>
        </div>
        <div class="form-group left w50">
            <label>FC Máxima:</label>
            <input type="number" name="fc_maxima" required>
        </div> 
        <div class="form-group right w50">
            <label>FC Reposo:</label>
            <input type="number" name="fc_reposo" required>
        </div>
        <div class="form-group left w50">
            <label>Método exame VO2:</label>
            <select name="vo2_exame">
                <?php 
                    foreach (TreinoSerie::$vo2_exame as $key => $value){
                        echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="form-group right w50">
            <label>VO2 Máximo:</label>
            <input type="number" step="0.01" name="vo2_maximo" required>
        </div>
        <div class="form-group w33">
            <label>Tempo de Recuperação:</label>
            <input type="number" name="tempo_recuperacao" required>
        </div>
        <div class="form-group w33">
            <label>Incremento HIIT:</label>
            <input type="number" name="incremento_hiit" required>
        </div>
        <div class="form-group w33">
            <label>Incremento MIIT:</label>
            <input type="number" name="incremento_miit" required>
        </div>
        </fieldset>
        
        <fieldset><!-- Séries e Exercícios -->
        <legend>Monte a série</legend>
        <div id="series-container">
            <div class="serie" data-serie="1">
                <div class="exercicios">
                    <div class="exercicio" data-exercicio="1">
                        <table>
                                <tr style="background-color: #E1E1E1;">
                                    <td colspan="13">
                                        <h3>Exercício 1</h3>
                                        <select name="series[1][exercicios][1][exercicio_id]" required>
                                            <option value="">Selecione um exercício</option>
                                            <?php foreach ($exercicios as $exercicio): ?>
                                                <option value="<?= $exercicio['id'] ?>"><?= $exercicio['nome_exercicio'] ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </td>
                                </tr>
                            <tbody class="cargas-repeticoes">
                                <tr>
                                    <td><label>Carga:</label></td>
                                    <td><input type="number" step="0.01" name="series[1][exercicios][1][cargas][]" required></td>
                                    <td><label>Repetições:</label></td>
                                    <td><input type="number" name="series[1][exercicios][1][repeticoes][]" required></td>
                                    <td><label>Pausa:</label></td>
                                    <td> <input type="number" name="series[1][exercicios][1][pausa]" value="0" required></td>
                                    <td><label>Concentrica:</label></td>
                                    <td><input type="number" name="series[1][exercicios][1][concentrica]" value="1" required></td>
                                    <td><label>Excentrica:</label></td>
                                    <td><input type="number" name="series[1][exercicios][1][excentrica]" value="1"required></td>
                                    <td><label>Recuperação entre Séries:</label></td>
                                    <td><input type="number" name="series[1][exercicios][1][recuperacao_entre_series]" value="2" required></td>
                                    <td><button type="button" style="margin-top: 0;" onclick="removerCargaRepeticao(this)">Remover</button></td>
                                </tr>
                            </tbody>
                        </table>
                        <!-- Botão para adicionar mais cargas e repetições -->
                        <button type="button" onclick="adicionarCargaRepeticao(this)">Adicionar Carga/Repetição</button>
                        
                    
                    </div>
                </div>
            </div>
        </div>
        
        

        <!-- Botão Adicionar Exercício Reposicionado -->
        <button type="button" onclick="adicionarExercicio(this)">Adicionar Exercício</button>
        <button type="button" onclick="removerExercicio(this)">Remover Exercício</button>
        </fieldset>
        <div class="form-group">
            <input type="submit" name="acao" value="Cadastrar">
        </div>
    </form>
</div>

<script>
    let serieCount = 1;
    function adicionarExercicio(button) {
        const seriesContainer = document.getElementById('series-container');
        const serieDiv = seriesContainer.querySelector('.serie');
        const exerciciosDiv = serieDiv.querySelector('.exercicios');
        const exercicioCount = exerciciosDiv.children.length + 1;
        const exercicioDiv = document.createElement('div');
        exercicioDiv.classList.add('exercicio');
        exercicioDiv.setAttribute('data-exercicio', exercicioCount);
        exercicioDiv.innerHTML = `
            
            <table>
                    <tr style="background-color: #E1E1E1;">
                        <td colspan="13">
                            <h3>Exercício ${exercicioCount}</h3>
                            <select name="series[${serieCount}][exercicios][${exercicioCount}][exercicio_id]" required>
                                <option value="">Selecione um exercício</option>
                                <?php foreach ($exercicios as $exercicio): ?>
                                    <option value="<?= $exercicio['id'] ?>"><?= $exercicio['nome_exercicio'] ?></option>
                                <?php endforeach; ?>
                            </select>
                        </td>
                    </tr>
                
                <tbody class="cargas-repeticoes">
                    <tr>
                        <td><label>Carga:</label></td>
                        <td><input type="number" step="0.01" name="series[${serieCount}][exercicios][${exercicioCount}][cargas][]" required></td>
                        <td><label>Repetições:</label></td>
                        <td><input type="number" name="series[${serieCount}][exercicios][${exercicioCount}][repeticoes][]" required></td>
                        <td><label>Pausa:</label></td>
                        <td><input type="number" name="series[${serieCount}][exercicios][${exercicioCount}][pausa]" value="0" required></td>
                        <td><label>Concentrica:</label></td>
                        <td><input type="number" name="series[${serieCount}][exercicios][${exercicioCount}][concentrica]" value="1" required></td>
                        <td><label>Excentrica:</label></td>
                        <td><input type="number" name="series[${serieCount}][exercicios][${exercicioCount}][excentrica]" value="1" required></td>
                        <td><label>Recuperação entre Séries:</label></td>
                        <td><input type="number" name="series[${serieCount}][exercicios][${exercicioCount}][recuperacao_entre_series]" value="2" required></td>
                        <td><button type="button" style="margin-top: 0;" onclick="removerCargaRepeticao(this)">Remover</button></td>
                    </tr>
                </tbody>
            </table>
            <button type="button" onclick="adicionarCargaRepeticao(this)">Adicionar Carga/Repetição</button>
        `;
        exerciciosDiv.appendChild(exercicioDiv);
    }

    function adicionarCargaRepeticao(button) {
        const exercicioDiv = button.closest('.exercicio');
        const cargaRepDiv = document.createElement('tr');
        const serieNumber = exercicioDiv.closest('.serie').getAttribute('data-serie');
        const exercicioNumber = exercicioDiv.getAttribute('data-exercicio');
        cargaRepDiv.innerHTML = `
            <td><label>Carga:</label></td>
            <td><input type="number" step="0.01" name="series[${serieNumber}][exercicios][${exercicioNumber}][cargas][]" required></td>
            <td><label>Repetições:</label></td>
            <td><input type="number" name="series[${serieNumber}][exercicios][${exercicioNumber}][repeticoes][]" required></td>
            <td><label>Pausa:</label></td>
            <td><input type="number" name="series[${serieNumber}][exercicios][${exercicioNumber}][pausa]" value="0" required></td>
            <td><label>Concentrica:</label></td>
            <td><input type="number" name="series[${serieNumber}][exercicios][${exercicioNumber}][concentrica]" value="1" required></td>
            <td><label>Excentrica:</label></td>
            <td><input type="number" name="series[${serieNumber}][exercicios][${exercicioNumber}][excentrica]" value="2" required></td>
            <td><label>Recuperação entre Séries:</label></td>
            <td><input type="number" name="series[${serieNumber}][exercicios][${exercicioNumber}][recuperacao_entre_series]" value="2" required></td>
            <td><button type="button" style="margin-top: 0;" onclick="removerCargaRepeticao(this)">Remover</button></td>
        `;
        exercicioDiv.querySelector('.cargas-repeticoes').appendChild(cargaRepDiv);
    }

    function removerCargaRepeticao(button) {
        const tbody = button.closest('.exercicio').querySelector('.cargas-repeticoes');
        const rows = tbody.querySelectorAll('tr');
        if (rows.length > 1) {
                tbody.removeChild(rows[rows.length - 1]); // Remove a última linha
            } else {
                alert('Não é possível remover todas as cargas e repetições.');
        }
    }



</script>