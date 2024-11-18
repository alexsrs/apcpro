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
    <h2><i class="fa fa-pencil" aria-hidden="true"></i>ANAMNESE INTELIGENTE PARA OS IDOSOS</h2>
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

                        // Idosos
                        'vestir' => isset($_POST['vestir']) ? htmlspecialchars(trim($_POST['vestir'])) : null,
                        'banho' => isset($_POST['banho']) ? htmlspecialchars(trim($_POST['banho'])) : null,
                        'caminhar' => isset($_POST['caminhar']) ? htmlspecialchars(trim($_POST['caminhar'])) : null,
                        'atividade_domestica_leve' => isset($_POST['atividade-domestica-leve']) ? htmlspecialchars(trim($_POST['atividade-domestica-leve'])) : null,
                        'subir_escada' => isset($_POST['subir-escada']) ? htmlspecialchars(trim($_POST['subir-escada'])) : null,
                        'fazer_compras' => isset($_POST['fazer-compras']) ? htmlspecialchars(trim($_POST['fazer-compras'])) : null,
                        'carregar_arroz' => isset($_POST['carregar-arroz']) ? htmlspecialchars(trim($_POST['carregar-arroz'])) : null,
                        'caminhar_moderado' => isset($_POST['caminhar-moderado']) ? htmlspecialchars(trim($_POST['caminhar-moderado'])) : null,
                        'caminhar_intenso' => isset($_POST['caminhar-intenso']) ? htmlspecialchars(trim($_POST['caminhar-intenso'])) : null,
                        'carregar_mala' => isset($_POST['carregar-mala']) ? htmlspecialchars(trim($_POST['carregar-mala'])) : null,
                        'atividade_domestica_pesada' => isset($_POST['atividade-domestica-pesada']) ? htmlspecialchars(trim($_POST['atividade-domestica-pesada'])) : null,
                        'atividade_vigorosa' => isset($_POST['atividade-vigorosa']) ? htmlspecialchars(trim($_POST['atividade-vigorosa'])) : null,
                        'nivel_funcional' => isset($_POST['nivel-funcional']) ? htmlspecialchars(trim($_POST['nivel-funcional'])) : null,
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
        <p>Responda as perguntas para aplicação da ANAMNESE INTELIGENTE de forma mais rápida, prática e com maior possibilidade de prescrição de um programa de treinamento individualizado.</p>
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
        <div class="form-group">
            <fieldset>
                <legend>Capacidade Funcional</legend>
                
                    <div class="form-group">
                        <label for="exercicios">Por favor, indique a sua habilidade para fazer cada uma das atividades que estão na lista. Sua resposta deve indicar se você PODE fazer essas atividades e não se você faz essas atividades atualmente.</label>
                        <table id="idosoTable" class="display dt-responsive" width="100%">
                            <thead>
                                <tr>
                                    <th>Atividades</th>
                                    <th>Faço</th>
                                    <th>Com dificuldade</th>
                                    <th>Não faço</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>Tomar conta da suas necessidades pessoais como vestir-se sozinho</td>
                                    
                                        <td><input type="radio" id="vestir-faco" name="vestir" value="faco"></td>
                                        <td><input type="radio" id="vestir-dificuldade" name="vestir" value="dificuldade"></td>
                                        <td><input type="radio" id="vestir-naofaco" name="vestir" value="naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Tomar banho sozinho</td>
                                    
                                        <td><input type="radio" id="banho-faco" name="banho" value="banho-faco"></td>
                                        <td><input type="radio" id="banho-dificuldade" name="banho" value="banho-dificuldade"></td>
                                        <td> <input type="radio" id="banho-naofaco" name="banho" value="banho-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Caminhar fora de casa (1 a 2 quarteirões)</td>
                                        <td><input type="radio" id="caminhar-faco" name="caminhar" value="caminhar-faco"></td>
                                        <td><input type="radio" id="caminhar-dificuldade" name="caminhar" value="caminhar-dificuldade"></td>
                                        <td> <input type="radio" id="caminhar-naofaco" name="caminhar" value="caminhar-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Fazer atividades domésticas leves como cozinhar, tirar pó, lavar pratos, varrer a casa</td>
                                        <td><input type="radio" id="atividade-domestica-leve-faco" name="atividade-domestica-leve" value="atividade-domestica-leve-faco"></td>
                                        <td><input type="radio" id="atividade-domestica-leve-dificuldade" name="atividade-domestica-leve" value="atividade-domestica-leve-dificuldade"></td>
                                        <td> <input type="radio" id="atividade-domestica-leve-naofaco" name="atividade-domestica-leve" value="atividade-domestica-leve-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Subir ou descer escadas</td>
                                        <td><input type="radio" id="subir-escada-faco" name="subir-escada" value="subir-escada-faco"></td>
                                        <td><input type="radio" id="subir-escada-dificuldade" name="subir-escada" value="subir-escada-dificuldade"></td>
                                        <td> <input type="radio" id="subir-escada-naofaco" name="subir-escada" value="subir-escada-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Fazer compras no supermercado ou shopping</td>
                                        <td><input type="radio" id="fazer-compras-faco" name="fazer-compras" value="fazer-compras-faco"></td>
                                        <td><input type="radio" id="fazer-compras-dificuldade" name="fazer-compras" value="fazer-compras-dificuldade"></td>
                                        <td> <input type="radio" id="fazer-compras-naofaco" name="fazer-compras" value="fazer-compras-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Levantar e carregar 5Kg (pacote de arroz)</td>
                                        <td><input type="radio" id="carregar-arroz-faco" name="carregar-arroz" value="carregar-arroz-faco"></td>
                                        <td><input type="radio" id="carregar-arroz-dificuldade" name="carregar-arroz" value="carregar-arroz-dificuldade"></td>
                                        <td> <input type="radio" id="carregar-arroz-naofaco" name="carregar-arroz" value="carregar-arroz-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Caminhar 6 a 7 quarteirões</td>
                                        <td><input type="radio" id="caminhar-moderado-faco" name="caminhar-moderado" value="caminhar-moderado-faco"></td>
                                        <td><input type="radio" id="caminhar-moderado-dificuldade" name="caminhar-moderado" value="caminhar-moderado-dificuldade"></td>
                                        <td> <input type="radio" id="caminhar-moderado-naofaco" name="caminhar-moderado" value="caminhar-moderado-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Caminhar 12 a 14 quarteirões</td>
                                        <td><input type="radio" id="caminhar-intenso-faco" name="caminhar-intenso" value="caminhar-intenso-faco"></td>
                                        <td><input type="radio" id="caminhar-intenso-dificuldade" name="caminhar-intenso" value="caminhar-intenso-dificuldade"></td>
                                        <td> <input type="radio" id="caminhar-intenso-naofaco" name="caminhar-intenso" value="caminhar-intenso-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Levantar e carregar 13Kg (mala média ou grande)</td>
                                        <td><input type="radio" id="carregar-mala-faco" name="carregar-mala" value="carregar-mala-faco"></td>
                                        <td><input type="radio" id="carregar-mala-dificuldade" name="carregar-mala" value="carregar-mala-dificuldade"></td>
                                        <td> <input type="radio" id="carregar-mala-naofaco" name="carregar-mala" value="carregar-mala-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Fazer atividades domésticas pesadas como aspirar ou esfregar o chão</td>
                                        <td><input type="radio" id="atividade-domestica-pesada-faco" name="atividade-domestica-pesada" value="atividade-domestica-pesada-faco"></td>
                                        <td><input type="radio" id="atividade-domestica-pesada-dificuldade" name="atividade-domestica-pesada" value="atividade-domestica-pesada-dificuldade"></td>
                                        <td><input type="radio" id="atividade-domestica-pesada-naofaco" name="atividade-domestica-pesada" value="atividade-domestica-pesada-naofaco"></td>
                                    </tr>
                                    <tr>
                                        <td>Fazer atividades vigorosas como caminhar grandes distâncias, mover objetos pesados, dançar</td>
                                        <td><input type="radio" id="atividade-vigorosa-faco" name="atividade-vigorosa" value="atividade-vigorosa-faco"></td>
                                        <td><input type="radio" id="atividade-vigorosa-dificuldade" name="atividade-vigorosa" value="atividade-vigorosa-dificuldade"></td>
                                        <td> <input type="radio" id="atividade-vigorosa-naofaco" name="atividade-vigorosa" value="atividade-vigorosa-naofaco"></td>
                                    </tr>
                            </tbody>
                            <tfoot><td colspan="4">Nível Funcional: <strong id="nivel-funcional"></strong></td></tfoot>
                        </table>                            
                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const atividades = [
                                'vestir', 'banho', 'caminhar', 'atividade-domestica-leve', 
                                'subir-escada', 'fazer-compras', 'carregar-arroz', 
                                'caminhar-moderado', 'caminhar-intenso', 'carregar-mala', 
                                'atividade-domestica-pesada', 'atividade-vigorosa'
                            ];

                            function calcularNivelFuncional() {
                                let semDificuldade = 0;
                                let inabil = 0;
                                let dificuldade = 0;
                                let todasRespondidas = true;

                                // Percorre todas as atividades
                                atividades.forEach(function(atividade) {
                                    const radios = document.getElementsByName(atividade);
                                    let algumaSelecionada = false;

                                    radios.forEach(function(radio) {
                                        if (radio.checked) {
                                            algumaSelecionada = true;
                                            switch (radio.value) {
                                                case 'faco':
                                                    semDificuldade++;
                                                    break;
                                                case 'naofaco':
                                                    inabil++;
                                                    break;
                                                case 'dificuldade':
                                                    dificuldade++;
                                                    break;
                                            }
                                        }
                                    });

                                    if (!algumaSelecionada) {
                                        todasRespondidas = false; // Marca como incompleto
                                    }
                                });

                                // Verifica se todas as perguntas foram respondidas
                                if (!todasRespondidas) {
                                    document.getElementById('nivel-funcional').innerText = 'Por favor, responda todas as perguntas.';
                                    return;
                                }

                                // Determina o nível funcional
                                let nivelFuncional;
                                if (semDificuldade === 12) {
                                    nivelFuncional = 'Avançado';
                                } else if (inabil >= 3) {
                                    nivelFuncional = 'Baixo';
                                } else {
                                    nivelFuncional = 'Moderado';
                                }

                                // Atualiza o nível funcional na página
                                document.getElementById('nivel-funcional').innerText = nivelFuncional;
                            }

                            // Adiciona o evento de mudança aos inputs de rádio
                            atividades.forEach(function(atividade) {
                                const radios = document.getElementsByName(atividade);
                                radios.forEach(function(radio) {
                                    radio.addEventListener('change', calcularNivelFuncional);
                                });
                            });

                            calcularNivelFuncional(); // Inicializa o cálculo no carregamento
                        });

                    </script>
                    </div><!--form-group-->          
                
            </fieldset>
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
            <legend>Hábitos e expectativas</legend>
            <div class="form-group">
                        <label for="beneficios">Imagine você daqui 3 meses. O que você mais quer como benefício do programa de treinamento?</label>
                        <label class="switch-label" for="dores-corpo">
                            <input type="checkbox" id="dores-corpo" name="beneficios[]" value="dores-corpo">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Não sentir dores no corpo</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="emagrecer">
                            <input type="checkbox" id="emagrecer" name="beneficios[]" value="emagrecer">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Emagrecer</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="cansado">
                            <input type="checkbox" id="cansado" name="beneficios[]" value="cansado">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Conseguir caminhar sem me sentir cansado(a)</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="remedios">
                            <input type="checkbox" id="remedios" name="beneficios[]" value="remedios">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">tomar menos remédios</span>
                        </label>
                    </div><!-- form-group --><br><br>


                    <div class="form-group">
                    <label for="beneficios">Qual dos itens abaixo vai te deixar mais feliz se você conseguir fazer se sentir dor, incômodos ou se sentir cansado(a)?</label>
                        <label class="switch-label" for="feliz-sem-dor">
                            <input type="checkbox" id="viajar" name="feliz-sem-dor[]" value="viajar">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Viajar</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="passear-shopping">
                            <input type="checkbox" id="passear-shopping" name="beneficios[]" value="passear-shopping">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Passear no shopping com a família ou amigos</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="dancar">
                            <input type="checkbox" id="dancar" name="beneficios[]" value="dancar">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Dançar</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="brincar">
                            <input type="checkbox" id="brincar" name="beneficios[]" value="brincar">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Brincar com os netos</span>
                        </label>
                    </div><!-- form-group -->

                    <div class="form-group">
                        <label class="switch-label" for="caminhar-ar-livre">
                            <input type="checkbox" id="caminhar-ar-livre" name="beneficios[]" value="caminhar-ar-livre">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Caminhar ao ar livre</span>
                        </label>
                    </div><!-- form-group -->

                    <div class="form-group">
                        <label class="switch-label" for="conhecer-pessoas">
                            <input type="checkbox" id="conhecer-pessoas" name="beneficios[]" value="conhecer-pessoas">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">conhecer novas pessoas</span>
                        </label>
                    </div><!-- form-group -->


                    <div class="form-group">
                        <label class="switch-label" for="outros-beneficios">
                            <input type="checkbox" id="outros-beneficios" name="beneficios[]" value="outros-beneficios">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Outros</span>
                        </label>
                        <input type="text" name="outros-beneficios" placeholder="Descreva se houver outros" style="flex-grow: 1;">
                    </div><!-- form-group --><br><br>

                    <div class="form-group">
                    <label for="beneficios">O que mais te incomoda HOJE?</label>
                        <label class="switch-label" for="mais-incomoda">
                            <input type="checkbox" id="dor-no-corpo" name="mais-incomoda[]" value="dor-no-corpo">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Dor no corpo</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="sempre-cansado">
                            <input type="checkbox" id="sempre-cansado" name="mais-incomoda[]" value="sempre-cansado">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Ficar sempre cansado(a)</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="nao-brinca">
                            <input type="checkbox" id="nao-brinca" name="mais-incomoda[]" value="nao-brinca">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Não conseguir brincar com meus netos</span>
                        </label>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label class="switch-label" for="brincar">
                            <input type="checkbox" id="brincar" name="mais-incomoda[]" value="brincar">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Brincar com os netos</span>
                        </label>
                    </div><!-- form-group -->

                    <div class="form-group">
                        <label class="switch-label" for="nao-dancar">
                            <input type="checkbox" id="nao-dancar" name="mais-incomoda[]" value="nao-dancar">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Não conseguir dançar</span>
                        </label>
                    </div><!-- form-group -->


                    <div class="form-group">
                        <label class="switch-label" for="parar-descansar">
                            <input type="checkbox" id="parar-descansar" name="mais-incomoda[]" value="parar-descansar">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Não conseguir caminhar vários minutos sem precisar parar pra descansar</span>
                        </label>
                    </div><!-- form-group -->

                    <div class="form-group">
                        <label class="switch-label" for="muitos-remedios">
                            <input type="checkbox" id="muitos-remedios" name="mais-incomoda[]" value="muitos-remedios">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Tomar muitos remédios todos os dias</span>
                        </label>
                    </div><!-- form-group -->

                    <div class="form-group">
                        <label class="switch-label" for="cuidar-casa">
                            <input type="checkbox" id="cuidar-casa" name="mais-incomoda[]" value="cuidar-casa">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Não conseguir cuidar da minha casa</span>
                        </label>
                    </div><!-- form-group -->

                    <div class="form-group">
                        <label class="switch-label" for="precisar-ajuda">
                            <input type="checkbox" id="precisar-ajuda" name="mais-incomoda[]" value="precisar-ajuda">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Precisar a ajuda de outras pessoas para fazer coisas simples</span>
                        </label>
                    </div><!-- form-group -->

                    <div class="form-group">
                        <label class="switch-label" for="outros-incomodos">
                            <input type="checkbox" id="outros-incomodos" name="mais-incomoda[]" value="outros-incomodos">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Outros</span>
                        </label>
                        <input type="text" name="outros-incomodos" placeholder="Descreva se houver outros" style="flex-grow: 1;">
                    </div><!-- form-group --><br><br>
            </fieldset>

        </div><!--form-group-->


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
                <br><br>
                <label> Se tiver outras informações que julgar ser relevante para elaboração do seu programa de treinamento, por favor, descreva abaixo:</label>
                <textarea id="info-pertinente" name="info-pertinente" rows="3" cols="50"></textarea>
                <br><br><br>
                <div class="form-group">
                    <input type="checkbox" id="aceito" name="aceito" value="1">
                    <label for="aceito"> Atesto para os devidos fins que recebi todas as orientações necessárias para responder o questionário, li e entendi todas as perguntas e respondi com a verdade.</label>
                </div>
            </fieldset>
        </div><!--form-group-->


        <div class="clear"></div><!-- clear -->
    <div class="form-group">
        <input type="submit" name="acao" value="Enviar"/>
    </div><!-- form-group -->
    </form>
</div><!-- box-content -->
   