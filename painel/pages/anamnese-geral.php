<?php 
    verificaPermissaoPagina(0);
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

    // Inicializa a próxima etapa, se necessário
    if (!isset($_SESSION['etapa'])) {
        $_SESSION['etapa'] = 2;
    }
?>

<div class="step-indicator">
    <div class="step <?php echo ($_SESSION['etapa'] >= 1) ? 'completed' : ''; ?>">
        <div class="step-number">1</div>
        <div class="step-label">Perfil</div>
    </div>
    <div class="step <?php echo ($_SESSION['etapa'] >= 2) ? 'completed' : ''; ?>">
        <div class="step-number">2</div>
        <div class="step-label">Anamnese</div>
    </div>
    <div class="step <?php echo ($_SESSION['etapa'] >= 3) ? 'completed' : ''; ?>">
        <div class="step-number">3</div>
        <div class="step-label">Medida corporal</div>
    </div>
    <div class="step <?php echo ($_SESSION['etapa'] >= 4) ? 'completed' : ''; ?>">
        <div class="step-number">4</div>
        <div class="step-label">Teste Físico</div>
    </div>
</div>

<div class="box-content">
    <h2><i class="fa fa-pencil" aria-hidden="true"></i>ANAMNESE INTELIGENTE PARA HOMENS E MULHERES [ADULTOS]</h2>
    <form method="post">   
        <?php
            if (isset($_POST['acao'])) {  
                // Verificar se o usuário aceitou os termos
                if (!isset($_POST['aceito'])) {
                    Painel::alert('erro', 'Você deve aceitar os termos para prosseguir.');
                } else {
                    // Instanciar a classe Anamnese
                    $anamnese = new Anamnese();

                    // Preparar os dados para enviar com validação e sanitização
                    $dados = [
                        'usuario_id' => $usuario_id,
                        'data_avaliacao' => (new DateTime())->format('Y-m-d H:i:s'),
                        // Disponibilidade de Treino
                        'domingo' => isset($_POST['domingo']) ? 1 : 0,
                        'segunda' => isset($_POST['segunda']) ? 1 : 0,
                        'terca' => isset($_POST['terca']) ? 1 : 0,
                        'quarta' => isset($_POST['quarta']) ? 1 : 0,
                        'quinta' => isset($_POST['quinta']) ? 1 : 0,
                        'sexta' => isset($_POST['sexta']) ? 1 : 0,
                        'sabado' => isset($_POST['sabado']) ? 1 : 0,
                        'minutos_dia' => isset($_POST['nome']) && is_numeric($_POST['nome']) ? intval($_POST['nome']) : null, // Verifique se 'nome' é o campo correto
                        
                        // Atividade Física
                        'exercicios' => isset($_POST['exercicios']) ? json_encode($_POST['exercicios']) : null,
                        'outros_exercicios' => !empty($_POST['outros_exercicios']) ? htmlspecialchars(trim($_POST['outros_exercicios'])) : null,                        
                        
                        'nao_gosta' => isset($_POST['nao-gosta']) ? 1 : 0,
                        'nao_gosta_exercicios' => !empty($_POST['nao-gosta-exercicios']) ? htmlspecialchars(trim($_POST['nao-gosta-exercicios'])) : null,
                        'atividade_recente' => isset($_POST['atividade-recente']) ? 1 : 0,
                        'nome_atividade_recente' => !empty($_POST['nome-atividade-recente']) ? htmlspecialchars(trim($_POST['nome-atividade-recente'])) : null,
                        'tipo_exercicio_recente' => !empty($_POST['tipo_exercicio_recente']) ? htmlspecialchars(trim($_POST['tipo_exercicio_recente'])) : null, // Verifique o nome correto
                        'dias_semana_recente' => isset($_POST['dias-semana']) && is_numeric($_POST['dias-semana']) ? intval($_POST['dias-semana']) : null,
                        'horas_dia_recente' => isset($_POST['horas-dia']) && is_numeric($_POST['horas-dia']) ? floatval($_POST['horas-dia']) : null,
                        'intensidade' => !empty($_POST['intensidade']) ? htmlspecialchars(trim($_POST['intensidade'])) : null,
                        
                        // Dados Médicos
                        'doencas' => isset($_POST['doencas']) ? 1 : 0,
                        'doencas_nome' => !empty($_POST['doencas-nome']) ? htmlspecialchars(trim($_POST['doencas-nome'])) : null,
                        'remedios' => !empty($_POST['remedios']) ? htmlspecialchars(trim($_POST['remedios'])) : null,
                        'cirurgias' => isset($_POST['cirurgias']) ? 1 : 0,
                        'regiao_cirurgia' => !empty($_POST['regiao-cirurgia']) ? htmlspecialchars(trim($_POST['regiao-cirurgia'])) : null,
                        'dor_muscular' => isset($_POST['dor-muscular']) ? 1 : 0,
                        'regioes_dor' => null, // Será preenchido abaixo
                        'dor_peito' => isset($_POST['dor-peito']) ? 1 : 0,
                        'tontura' => isset($_POST['tontura']) ? 1 : 0,
                        'movimento_diario' => isset($_POST['movimento-diario']) ? 1 : 0,
                        'movimentos_dia' => !empty($_POST['movimentos-dia']) ? htmlspecialchars(trim($_POST['movimentos-dia'])) : null,
                        'parente_cardiaco' => isset($_POST['parente-cardiaco']) ? 1 : 0,
                        'num_parente_cardiaco' => isset($_POST['num-parente-cardiaco']) && is_numeric($_POST['num-parente-cardiaco']) ? intval($_POST['num-parente-cardiaco']) : null,
                        'fumante' => isset($_POST['fumante']) ? 1 : 0,
                        'info_pertinente' => !empty($_POST['info-pertinente']) ? htmlspecialchars(trim($_POST['info-pertinente'])) : null,
                        'aceito' => isset($_POST['aceito']) ? 1 : 0
                    ];

                    // Processar as regiões de dor, notas e dificuldades
                    if(isset($_POST['regiao']) && is_array($_POST['regiao'])) {
                        $regioes = [];
                        // Garantir que os arrays de regiao, nota e dificuldade têm o mesmo número de elementos
                        $count = count($_POST['regiao']);
                        for($i = 0; $i < $count; $i++) {
                            $regiao = htmlspecialchars(trim($_POST['regiao'][$i]));
                            $nota = isset($_POST['nota'][$i]) && is_numeric($_POST['nota'][$i]) ? intval($_POST['nota'][$i]) : null;
                            $dificuldade = !empty($_POST['dificuldade'][$i]) ? htmlspecialchars(trim($_POST['dificuldade'][$i])) : null;

                            if($regiao !== '' && $nota !== null) { // Garantir que regiao e nota estão preenchidos
                                $regioes[] = [
                                    'regiao' => $regiao,
                                    'nota' => $nota,
                                    'dificuldade' => $dificuldade
                                ];
                            }
                        }
                        $dados['regioes_dor'] = json_encode($regioes);
                    }

                    // Chamar o método para cadastrar a anamnese
                    if ($anamnese->cadastrarAnamnese($dados)) {
                        Painel::alert('sucesso', 'Anamnese cadastrada com sucesso!');
                        // Redirecionar ou limpar o formulário conforme necessidade
                        $_SESSION['etapa'] = 3;

                        // Defina o tempo de contagem regressiva
                        $tempoContagem = 5; // Tempo em segundos

                        // Exibir a mensagem de contagem
                        echo "<div id='contador' style='text-align:center; color:#007bff; padding-top:20px;'>Redirecionando em <span id='tempo'>$tempoContagem</span> segundos...</div>";

                        echo "<script>
                            // Defina o tempo de contagem
                            var tempo = $tempoContagem;
                            
                            // Atualiza a contagem a cada segundo
                            var intervalo = setInterval(function() {
                                tempo--;
                                document.getElementById('tempo').innerText = tempo;

                                // Quando o tempo acabar, redirecione
                                if (tempo <= 0) {
                                    clearInterval(intervalo);
                                    window.location.href='" . INCLUDE_PATH_PAINEL . 'medida-corporal' . "?id=" . $usuario_id . "';
                                }
                            }, 1000);
                        </script>";
                        exit();
                    } else {
                        Painel::alert('erro', 'Ocorreu um erro ao cadastrar a anamnese. Por favor, tente novamente.');
                    }
                }
            }
        ?>
        <!-- Perguntas adicionais -->
        <p>Responda as perguntas para aplicação da ANAMNESE INTELIGENTE de forma mais
rápida, prática e com maior possibilidade de prescrição de um programa de treinamento individualizado.</p>
        <div class="form-group" >       
            <fieldset>
                <legend>Disponibilidade de treino</legend>
                <label class="switch-label" for="domingo" style="display: inline-block; margin-right: 70px;">
                    <input type="checkbox" id="domingo" name="domingo" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Dom</span>
                </label>
                <label class="switch-label" for="segunda" style="display: inline-block; margin-right: 70px;">
                    <input type="checkbox" id="segunda" name="segunda" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Seg</span>
                </label>
                <label class="switch-label" for="terca" style="display: inline-block; margin-right: 70px;">
                    <input type="checkbox" id="terca" name="terca" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Ter</span>
                </label>
                <label class="switch-label" for="quarta" style="display: inline-block; margin-right: 70px;">
                    <input type="checkbox" id="quarta" name="quarta" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Qua</span>
                </label>
                <label class="switch-label" for="quinta" style="display: inline-block; margin-right: 70px;">
                    <input type="checkbox" id="quinta" name="quinta" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Qui</span>
                </label>
                <label class="switch-label" for="sexta" style="display: inline-block; margin-right: 70px;">
                    <input type="checkbox" id="sexta" name="sexta" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Sex</span>
                </label>
                <label class="switch-label" for="sabado" style="display: inline-block; margin-right: 70px;">
                    <input type="checkbox" id="sabado" name="sabado" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Sab</span>
                </label>
                <div class="form-group">
        <label>Quantos minutos por dia</label>
        <input type="text" name="nome">
    </div><!-- form-group -->
            </fieldset>
        </div><!-- form-group -->
        <div class="form-group">
            <fieldset>
                <legend>Atividade Física</legend>
                    <div class="form-group">
                        <label for="exercicios">Quais são os tipos de exercícios físicos que você gosta?</label>
                        <label class="switch-label" for="musculacao">
                            <input type="checkbox" id="musculacao" name="exercicios[]" value="musculacao">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Musculação</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="peso_corpo">
                            <input type="checkbox" id="peso_corpo" name="exercicios[]" value="peso_corpo">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Treino com peso do corpo</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="esteira">
                            <input type="checkbox" id="esteira" name="exercicios[]" value="esteira">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Esteira</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="bike">
                            <input type="checkbox" id="bike" name="exercicios[]" value="bike">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Bike</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="natacao">
                            <input type="checkbox" id="natacao" name="exercicios[]" value="natacao">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Natação</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="lutas">
                            <input type="checkbox" id="lutas" name="exercicios[]" value="lutas">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Lutas</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="combolas">
                            <input type="checkbox" id="combolas" name="exercicios[]" value="combolas">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Esportes com bolas</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="outros">
                            <input type="checkbox" id="outros" name="exercicios[]" value="outros">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Outros</span>
                        </label>
                        <input type="text" name="outros_exercicios" placeholder="Descreva se houver outros" style="flex-grow: 1;">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <br><br>
                        <label>Existe alguma coisa que você NÃO GOSTA de fazer durante a prática
                        do exercício?</label>
                        <label class="switch-label" for="nao-gosta">
                            <input type="checkbox" id="nao-gosta" name="nao-gosta" value="1">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Sim</span>
                        </label>
                        <input type="text" name="nao-gosta-exercicios" placeholder="Descreva os exercícios que não gosta" style="flex-grow: 1;">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <br><br>
                        <label>Nos últimos 3 meses, você estava praticando algum tipo de exercício
                        físico?</label>
                        <label class="switch-label" for="atividade-recente">
                            <input type="checkbox" id="atividade-recente" name="atividade-recente" value="1">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Sim</span>
                        </label>
                        <input type="text" name="nome-atividade-recente" placeholder="Descreva o tipo de exercício que estava praticando" style="flex-grow: 1;">
                    </div><!-- form-group -->
                    <div class="form-group left w50">
                        <label>Quantas vezes por semana estava praticando?</label>
                        <input type="text" name="dias-semana" style="flex-grow: 1;">
                        <label>Quantas horas por dia estava praticando?</label>
                        <input type="text" name="horas-dia" style="flex-grow: 1;">
                    </div><!-- form-group -->
                    <div class="form-group right w50">
                        <label>Intensidade:</label>
                        <select name="intensidade">
                            <?php 
                                foreach (Painel::$intensidade as $key => $value){
                                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                            ?>
                        </select>
                    </div><!-- form-group -->
            </fieldset>
        </div><!--form-group w100-->
        <div class="clear"></div><!-- clear -->                       
        <div class="form-group">
            <fieldset>
                <legend>Dados médicos</legend>
                    <div class="form-group right w100">
                    <label>Apresenta alguma doença que foi diagnosticada pelo médico?</label>
                        <label class="switch-label" for="doencas">
                            <input type="checkbox" id="doencas" name="doencas" value="1">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Sim</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group left w50">  
                        <label>Quais doenças ?</label>
                        <input type="text" name="doencas-nome" style="flex-grow: 1;">
                    </div><!-- form-group -->
                    <div class="form-group right w50">
                        <label>Caso a sua resposta tenha sido SIM, por favor, informe o nome dos remédios que está tomando:</label>
                            <input type="text" name="remedios" style="flex-grow: 1;">
                            <br><br>
                    </div><!-- form-group -->
                    <div class="clear"></div><!-- clear -->
                    <div class="form-group">
                    <label>Você fez alguma cirurgia?</label>
                        <label class="switch-label" for="cirurgias">
                            <input type="checkbox" id="cirurgias" name="cirurgias" value="1">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Sim</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">  
                        <label>Se a sua resposta foi SIM, por favor, indique a região do corpo onde foi realizado a cirurgia:</label>
                        <input type="text" name="regiao-cirurgia" style="flex-grow: 1;">
                    </div><!-- form-group -->
                    <br><br>
                    <!-- Pergunta sobre dor muscular -->
                <label>Atualmente você sente algum tipo de dor ou desconforto muscular?</label>
                <label class="switch-label" for="dor-muscular">
                    <input type="checkbox" id="dor-muscular" name="dor-muscular" value="1">
                    <span class="slider-switch round"></span>
                    <span class="slider-text">Sim</span>
                </label><br>
                <label for="regiao">Qual(is) região(ões):</label><br>
                <!-- Instruções da escala de dor -->
                <label>Para cada região que sentir dor, por favor, usando a escala abaixo, atribua uma nota de dor e, se houver dificuldades em movimentos, descreva ao lado:</label>
                <div class="img-escala">
                    <img src="<?php echo INCLUDE_PATH ?>images/escala-dor.jpg"/>
                </div>
                <!-- Container para as regiões dinâmicas -->
                <div id="regioes-container">
            <!-- Região 1 -->
                    <div class="regiao-container">
                        <label for="regiao1">Região:</label>
                        <input type="text" id="regiao1" name="regiao[]"><br>
                        <label for="nota1">Nota:</label>
                        <input type="number" id="nota1" name="nota[]" min="0" max="10" placeholder="0-10"><br>
                        <label for="dificuldade1">Dificuldade:</label>
                        <input type="text" id="dificuldade1" name="dificuldade[]">
                        <button type="button" class="remove-regiao" onclick="removerRegiao(this)">Remover</button><br>
                    </div><!--regiao-container-->
                </div><!--regioes-container-->                        
                <button type="button" id="adicionar-regiao">Adicionar Região</button><br><br>
                <br><br>
                <label>Você sente dor no peito quando realiza exercício físico?</label>
                    <label class="switch-label" for="dor-peito">
                        <input type="checkbox" id="dor-peito" name="dor-peito" value="1">
                        <span class="slider-switch round"></span>
                        <span class="slider-text">Sim</span>
                    </label>
                <br><br>
                <label>Você já perdeu o equilíbrio por causa de tontura ou alguma vez perdeu a consciência?</label>
                    <label class="switch-label" for="tontura">
                        <input type="checkbox" id="tontura" name="tontura" value="1">
                        <span class="slider-switch round"></span>
                        <span class="slider-text">Sim</span>
                    </label>
                <br><br>
                    <div class="form-group">
                    <label>Imagine movimentos que você realizada em seu dia a dia (na sua casa, no trabalho, subir e descer escadas, caminhar, correr), você sente algum tipo de desconforto ao realizar essas atividades?</label>
                        <label class="switch-label" for="movimento-diario">
                            <input type="checkbox" id="movimento-diario" name="movimento-diario" value="1">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Sim</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">  
                        <label>Se a sua resposta foi SIM, por favor, descreva abaixo quais são os tipos de atividades e a dificuldade que sente:</label>
                        <input type="text" name="movimentos-dia" style="flex-grow: 1;">
                    </div><!-- form-group -->
                    <br><br>
                    <div class="form-group">

                    <label>Algum parente seu de primeiro grau tem problemas cardíacos?</label>
                        <label class="switch-label" for="parente-cardiaco">
                            <input type="checkbox" id="parente-cardiaco" name="parente-cardiaco" value="1">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Sim</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">  
                        <label>Se a sua resposta foi SIM, por favor informe o número de parentes de primeiro grau que tem problemas cardíacas:_</label>
                        <input type="text" name="num-parente-cardiaco" style="flex-grow: 1;">
                    </div><!-- form-group -->
                    <br><br>
                <label>Você Fuma?</label>
                    <label class="switch-label" for="fumante">
                        <input type="checkbox" id="fumante" name="fumante" value="1">
                        <span class="slider-switch round"></span>
                        <span class="slider-text">Sim</span>
                    </label>
                <br><br>
                <label> Se tiver outras informações que julgar ser relevante para elaboração do seu programa de treinamento, por favor, descreva abaixo:</label>
                <textarea id="info-pertinente" name="info-pertinente" rows="3" cols="50"></textarea>
                <br><br><br>
                <div class="form-group">
                    <input type="checkbox" id="aceito" name="aceito" value="1">
                    <label for="aceito"> Atesto para os devidos fins que recebi todas as orientações necessárias para responder o questionário, li e entendi todas as perguntas e respondi com a verdade.</label>
                </div>
            </fieldset>
        </div><!--form-group w100-->
    <div class="clear"></div><!-- clear -->
    <div class="form-group">
        <input type="submit" name="acao" value="Enviar"/>
    </div><!-- form-group -->
    </form>
</div><!-- box-content -->