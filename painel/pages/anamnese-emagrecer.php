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
    $sql = MySql::conectar()->prepare("SELECT * FROM `tb_admin.usuarios` WHERE id = ?");
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
        <div class="step-label">Aptidão Cardiorespiratória</div>
    </div>
    <div class="step <?php echo ($_SESSION['etapa'] >= 5) ? 'completed' : ''; ?>">
        <div class="step-number">5</div>
        <div class="step-label">Teste Físico</div>
    </div>
</div>
<div class="box-content">
    <h2><i class="fa fa-pencil" aria-hidden="true"></i>Anamnese para Mulheres que desejam emagrecer</h2>

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
                        'nivel_treinamento' => !empty($_POST['nivel-treinamento']) ? htmlspecialchars(trim($_POST['nivel-treinamento'])) : null,
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
                        'minutos_dia_recente' => isset($_POST['minutos-dia']) && is_numeric($_POST['minutos-dia']) ? floatval($_POST['minutos-dia']) : null,
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
                        'aceito' => isset($_POST['aceito']) ? 1 : 0,

                        // Mulheres desejam emagrecer
                        'ciclo_menstrual' => isset($_POST['ciclo_menstrual']) ? 1 : 0,
                        'ciclo_menstrual_irregular' => !empty($_POST['ciclo_menstrual_irregular']) ? htmlspecialchars(trim($_POST['ciclo_menstrual_irregular'])) : null,
                        'sintomas_menstruais' => isset($_POST['sintomas_menstruais']) ? json_encode($_POST['sintomas_menstruais']) : null,
                        'uso_anticoncepcional' => !empty($_POST['uso_anticoncepcional']) ? htmlspecialchars(trim($_POST['uso_anticoncepcional'])) : null,
                        'fatores_impedem_treino' => isset($_POST['fatores_impedem_treino']) ? json_encode($_POST['fatores_impedem_treino']) : null,
                        'dificuldade_emagrecer' => isset($_POST['dificuldade_emagrecer']) ? json_encode($_POST['dificuldade_emagrecer']) : null,
                        'remedios_emagrecer' => isset($_POST['remedios_emagrecer']) ? 1 : 0,
                        'autoestima' => isset($_POST['autoestima']) ? htmlspecialchars(trim($_POST['autoestima'])) : null,
                        'silhueta_real' => isset($_POST['silhueta_real']) && is_numeric($_POST['silhueta_real']) ? intval($_POST['silhueta_real']) : null,
                        'silhueta_ideal' => isset($_POST['silhueta_ideal']) && is_numeric($_POST['silhueta_ideal']) ? intval($_POST['silhueta_ideal']) : null,
                        'objetivos_6_meses' => isset($_POST['objetivos_6_meses']) ? json_encode($_POST['objetivos_6_meses']) : null,
                        'nome_remedios_emagrecer' => !empty($_POST['nome_remedios_emagrecer']) ? htmlspecialchars(trim($_POST['nome_remedios_emagrecer'])) : null,
                        'resultados_remedios' => !empty($_POST['resultados_remedios']) ? htmlspecialchars(trim($_POST['resultados_remedios'])) : null,
                        'dificuldade_emagrecer_outros' => !empty($_POST['dificuldade_emagrecer_outros']) ? htmlspecialchars(trim($_POST['dificuldade_emagrecer_outros'])) : null,
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
<div class="form-group">
            <label>Nível de treinamento</label>
            <select name="nivel-treinamento">
                <?php 
                    foreach (Anamnese::$nivelTreinamento as $key => $value){
                    echo '<option value="'.$value.'">'.$value.'</option>';
                                }
                ?>
            </select>
        </div><!-- form-group -->
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
    <fieldset>
    <div class="form-group">
        <label>Como você classificaria sua autoestima hoje?</label>
            <select name="autoestima">
                <?php 
                    foreach (Painel::$auto_estima as $key => $value){
                    echo '<option value="'.$key.'">'.$value.'</option>';
                    }
                ?>
        </select>
    </div><!-- form-group -->
    <br><br>
    <div class="img-escala">
        <img src="<?php echo INCLUDE_PATH ?>images/escala_fisica.jpg" style="max-width: 300px !important;" />
    </div><!-- img-escala -->
    <div class="form-group w50 left">
        <label>Aponte o número de qual é a silhueta que melhor representa a sua aparência física atualmente?</label>
        <input type="number" name="silhueta_real">
    </div>
    <div class="form-group w50 right">
        <label>Aponte o número de qual é a silhueta que você gostaria de ter (silhueta ideal)?</label>
        <input type="number" name="silhueta_ideal">
    </div>
     
    <div class="clear"></div><!-- clear -->

    <br><br>
        <div class="form-group">
            <label for="objetivos_6_meses">Imagine daqui 6 meses. Quais dos seguintes objetivos conquistados, te deixaria mais feliz?</label>
            <div class="form-group">
            <label class="switch-label" for="emagrecer">
                <input type="checkbox" id="emagrecer" name="objetivos_6_meses[]" value="emagrecer">
                <span class="slider-switch round"></span>
                <span class="slider-text">Conseguir emagrecer</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="tonificar_musculatura">
            <input type="checkbox" id="tonificar_musculatura" name="objetivos_6_meses[]" value="tonificar_musculatura">
                <span class="slider-switch round"></span>
                <span class="slider-text">Conseguir tonificar a musculatura do corpo</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="ganho_massa_quadril_coxas">
            <input type="checkbox" id="ganho_massa_quadril_coxas" name="objetivos_6_meses[]" value="ganho_massa_quadril_coxas">
                <span class="slider-switch round"></span>
                <span class="slider-text">Ganhar massa muscular no quadril e coxas</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="mais_disposta">
                <input type="checkbox" id="mais_disposta" name="objetivos_6_meses[]" value="mais_disposta">
                <span class="slider-switch round"></span>
                <span class="slider-text">Me sentir mais disposta para o dia a dia</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="mais_energia">
                <input type="checkbox" id="mais_energia"="objetivos_6_meses[]" value="mais_energia">
                <span class="slider-switch round"></span>
                <span class="slider-text">Ter mais energia</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="bem_consigo_mesma">
                <input type="checkbox" id="bem_consigo_mesma" name="objetivos_6_meses[]" value="bem_consigo_mesma">
                <span class="slider-switch round"></span>
                <span class="slider-text">Se sentir bem consigo mesma</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="viver_sem_dor">
                <input type="checkbox" id="viver_sem_dor" name="objetivos_6_meses[]" value="viver_sem_dor"> 
                <span class="slider-switch round"></span>
                <span class="slider-text">Viver sem dor</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="outros_objetivos">
                <input type="checkbox" id="outros_objetivos" name="objetivos_6_meses[]" value="outros">
                <span class="slider-switch round"></span>
                <span class="slider-text">Outros</span>
            </label>
            <input type="text" name="outros_objetivos" placeholder="Descreva se houver outros" style="flex-grow: 1;">
        </div><!-- form-group --><br><br>


    <div class="form-group">
        <label>Você já fez uso de remédios para emagrecer?</label>
            <label class="switch-label" for="remedios_emagrecer">
            <input type="checkbox" id="remedios_emagrecer" name="remedios_emagrecer" value="1">
            <span class="slider-switch round"></span>
            <span class="slider-text">Sim</span>
        </label>
    </div><!-- form-group -->
    <div class="form-group">
        <label>Nome dos remédios:</label>
        <input type="text" name="nome_remedios_emagrecer">
    </div>
    <div class="form-group">
        <label>Resultados conquistados:</label>
        <input type="text" name="resultados_remedios">
    </div><br><br>
        
    <div class="form-group">
            <label for="dificuldade_emagrecer">Hoje, qual é a sua maior dificuldade para conseguir emagrecer?</label>
            <div class="form-group">
            <label class="switch-label" for="regularidade_exercicios">
                <input type="checkbox" id="regularidade_exercicios" name="dificuldade_emagrecer[]" value="regularidade_exercicios">
                <span class="slider-switch round"></span>
                <span class="slider-text">Manter a regularidade nos exercícios</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="regularidade_dieta">
            <input type="checkbox" name="" value=""> 
            <input type="checkbox" id="regularidade_dieta" name="dificuldade_emagrecer[]" value="regularidade_dieta">
                <span class="slider-switch round"></span>
                <span class="slider-text">Manter a regularidade na dieta</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="animo_exercicio">
            <input type="checkbox" id="animo_exercicio" name="dificuldade_emagrecer[]" value="animo_exercicio">
                <span class="slider-switch round"></span>
                <span class="slider-text">Manter o ânimo para fazer exercício</span>
            </label>
            </div><!-- form-group -->
            <div class="form-group">
            <label class="switch-label" for="tristeza_comida">
                <input type="checkbox" id="tristeza_comida" name="dificuldade_emagrecer[]" value="tristeza_comida">
                <span class="slider-switch round"></span>
                <span class="slider-text">Quando me sinto triste, desconto na comida</span>
            </label>
            </div><!-- form-group -->

            <div class="form-group">
            <label class="switch-label" for="tristeza_falta_treinos">
                <input type="checkbox" id="tristeza_falta_treinos" name="dificuldade_emagrecer[]" value="tristeza_falta_treinos">
                <span class="slider-switch round"></span>
                <span class="slider-text">Quando fico triste, falto aos treinos</span>
            </label>
            </div><!-- form-group -->

            <div class="form-group">
            <label class="switch-label" for="outros_emagrecer">
                <input type="checkbox" id="outros_emagrecer" name="dificuldade_emagrecer[]" value="outros">
                <span class="slider-switch round"></span>
                <span class="slider-text">Outros</span>
            </label>
            <input type="text" name="dificuldade_emagrecer_outros" placeholder="Descreva se houver outros" style="flex-grow: 1;">
        </div><!-- form-group --><br><br>

        <div class="form-group">
        <label>Nos últimos 6 meses, o ciclo menstrual esteve regulado?</label>
            <label class="switch-label" for="ciclo_menstrual">
            <input type="checkbox" id="ciclo_menstrual" name="ciclo_menstrual" value="1">
            <span class="slider-switch round"></span>
            <span class="slider-text">Sim</span>
        </label>
    </div><!-- form-group -->
    <div class="form-group">
        <label>Ciclo menstrual irregular</label>
            <select name="ciclo_menstrual_irregular">
                <?php 
                    foreach (Painel::$ciclo_menstrual as $key => $value){
                    echo '<option value="'.$value.'">'.$value.'</option>';
                    }
                ?>
        </select>
    </div><!-- form-group -->

    <div class="form-group">
        <label for="sintomas_menstruais">Durante o período menstrual (fluxo), quais dos sintomas abaixo comumente você sente?</label>
        <div class="form-group">
            <label class="switch-label" for="tontura">
                <input type="checkbox" id="tontura" name="sintomas_menstruais[]" value="tontura">
                <span class="slider-switch round"></span>
                <span class="slider-text">Tontura</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="moleza">
                <input type="checkbox" id="moleza" name="sintomas_menstruais[]" value="moleza">
                <span class="slider-switch round"></span>
                <span class="slider-text">Moleza</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="dor_abdominal">
                <input type="checkbox" id="dor_abdominal" name="sintomas_menstruais[]" value="dor_abdominal">
                <span class="slider-switch round"></span>
                <span class="slider-text">Dor abdominal</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="dor_coluna_lombar">
                <input type="checkbox" id="dor_coluna_lombar" name="sintomas_menstruais[]" value="dor_coluna_lombar">
                <span class="slider-switch round"></span>
                <span class="slider-text">Dor na coluna lombar</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="dor_pernas">
                <input type="checkbox" id="dor_pernas" name="sintomas_menstruais[]" value="dor_pernas">
                <span class="slider-switch round"></span>
                <span class="slider-text">Dor nas pernas</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="irritacao">
                <input type="checkbox" id="irritacao" name="sintomas_menstruais[]" value="irritacao">
                <span class="slider-switch round"></span>
                <span class="slider-text">Irritação</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="tristeza">
                <input type="checkbox" id="tristeza" name="sintomas_menstruais[]" value="tristeza">
                <span class="slider-switch round"></span>
                <span class="slider-text">Tristeza</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="queda_pressao">
                <input type="checkbox" id="queda_pressao" name="sintomas_menstruais[]" value="queda_pressao">
                <span class="slider-switch round"></span>
                <span class="slider-text">Queda de pressão</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="visao_escurecida">
                <input type="checkbox" id="visao_escurecida" name="sintomas_menstruais[]" value="visao_escurecida">
                <span class="slider-switch round"></span>
                <span class="slider-text">Visão escurecida</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="formigamento">
                <input type="checkbox" id="formigamento" name="sintomas_menstruais[]" value="formigamento">
                <span class="slider-switch round"></span>
                <span class="slider-text">Formigamento nos dedos das mãos e pés</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="palpitacao">
                <input type="checkbox" id="palpitacao" name="sintomas_menstruais[]" value="palpitacao">
                <span class="slider-switch round"></span>
                <span class="slider-text">Palpitação</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="sono_dia">
                <input type="checkbox" id="sono_dia" name="sintomas_menstruais[]" value="sono_dia">
                <span class="slider-switch round"></span>
                <span class="slider-text">Sono durante o dia</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="outros_sintomas_menstruais">
                <input type="checkbox" id="outros_sintomas_menstruais" name="sintomas_menstruais[]" value="outros">
                <span class="slider-switch round"></span>
                <span class="slider-text">Outros</span>
            </label>
            <input type="text" name="sintomas_menstruais_outros" placeholder="Descreva se houver outros" style="flex-grow: 1;">
        </div>
    </div><br><br>

    <div class="form-group">
    <label>Nos últimos 6 meses, você fez uso de anticoncepcional?</label>
        <label class="switch-label" for="anticoncepcional">
            <input type="checkbox" id="anticoncepcional" name="uso_anticoncepcional" value="1">
            <span class="slider-switch round"></span>
            <span class="slider-text">SIM</span>
        </label>
    </div><br><br>

    <div class="form-group">
        <label for="fatores_impedem_treino">Assinale os fatores abaixo que têm impedido você de manter a regularidade nos treinos semanais:</label>
        <div class="form-group">
            <label class="switch-label" for="falta_tempo">
                <input type="checkbox" id="falta_tempo" name="fatores_impedem_treino[]" value="falta_tempo">
                <span class="slider-switch round"></span>
                <span class="slider-text">Falta de tempo</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="falta_motivacao">
                <input type="checkbox" id="falta_motivacao" name="fatores_impedem_treino[]" value="falta_motivacao">
                <span class="slider-switch round"></span>
                <span class="slider-text">Falta de motivação</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="falta_energia">
                <input type="checkbox" id="falta_energia" name="fatores_impedem_treino[]" value="falta_energia">
                <span class="slider-switch round"></span>
                <span class="slider-text">Falta de energia</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="falta_conhecimento">
                <input type="checkbox" id="falta_conhecimento" name="fatores_impedem_treino[]" value="falta_conhecimento">
                <span class="slider-switch round"></span>
                <span class="slider-text">Falta de conhecimento em como se exercitar</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="nao_gosto_exercicios_vigorosos">
                <input type="checkbox" id="nao_gosto_exercicios_vigorosos" name="fatores_impedem_treino[]" value="nao_gosto_exercicios_vigorosos">
                <span class="slider-switch round"></span>
                <span class="slider-text">Não gosto de fazer exercícios vigorosos</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="nao_gosto_suar">
                <input type="checkbox" id="nao_gosto_suar" name="fatores_impedem_treino[]" value="nao_gosto_suar">
                <span class="slider-switch round"></span>
                <span class="slider-text">Não gosto de suar</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="dores_durante_exercicio">
                <input type="checkbox" id="dores_durante_exercicio" name="fatores_impedem_treino[]" value="dores_durante_exercicio">
                <span class="slider-switch round"></span>
                <span class="slider-text">Sinto dores no corpo durante o exercício</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="dores_apos_exercicio">
                <input type="checkbox" id="dores_apos_exercicio" name="fatores_impedem_treino[]" value="dores_apos_exercicio">
                <span class="slider-switch round"></span>
                <span class="slider-text">Sinto dores no corpo após o exercício</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="experiencias_negativas">
                <input type="checkbox" id="experiencias_negativas" name="fatores_impedem_treino[]" value="experiencias_negativas">
                <span class="slider-switch round"></span>
                <span class="slider-text">Tive experiências negativas com o exercício</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="medo_machucar">
                <input type="checkbox" id="medo_machucar" name="fatores_impedem_treino[]" value="medo_machucar">
                <span class="slider-switch round"></span>
                <span class="slider-text">Tenho medo de me machucar durante os treinos</span>
            </label>
        </div>
        <div class="form-group">
            <label class="switch-label" for="nao_gosto_treinar_sozinha">
                <input type="checkbox" id="nao_gosto_treinar_sozinha" name="fatores_impedem_treino[]" value="nao_gosto_treinar_sozinha">
                <span class="slider-switch round"></span>
                <span class="slider-text">Não gosto de treinar sozinha</span>
            </label>
        </div>
    </div>
    
        
    </fieldset>
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
                        <label>Quantos minutos por dia estava praticando?</label>
                        <input type="text" name="minutos-dia" style="flex-grow: 1;">
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
                <img src="<?php echo INCLUDE_PATH ?>images/escala-dor.jpg" style="max-width: 300px !important;" />
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
                    <label>Imagine movimentos que você realiza em seu dia a dia (na sua casa, no trabalho, subir e descer escadas, caminhar, correr), você sente algum tipo de desconforto ao realizar essas atividades?</label>
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