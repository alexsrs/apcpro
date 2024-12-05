<?php 
    verificaPermissaoPagina(0);
    include_once('pages/funcoes.php');

    if (isset($_GET['id'])) {
        $usuario_id = (int)$_GET['id']; 
    } else {
        $usuario_id = $_SESSION['id']; 
    }
    if (!isset($_SESSION['etapa'])) {
        $_SESSION['etapa'] = 4;
    }

 // Construir a mensagem para WhatsApp com os parâmetros recebidos
 $mensagem = "Ol%C3%A1%20Professor(a)%2C%20tudo%20bem%3F%0A%0APreciso%20agendar%20uma%20avalia%C3%A7%C3%A3o%20cardiorrespirat%C3%B3ria%20atrav%C3%A9s%20de%20exames%20realizados%20por%20profissionais%20de%20educa%C3%A7%C3%A3o%20f%C3%ADsica.%0AQuando%20seria%20poss%C3%ADvel%20realizar%20este%20agendamento%3F%0A%0AEstou%20%C3%A0%20disposi%C3%A7%C3%A3o%20para%20qualquer%20d%C3%BAvida%20ou%20ajuste.";

// Consulta as medidas corporais na tabela de medidas
$sql = MySql::conectar()->prepare("SELECT peso FROM `tb_perfis_usuarios` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
$sql->execute([$usuario_id]);
$result = $sql->fetch();


if ($result) {
    $peso = $result['peso'];
} else {
    $peso = null; // ou qualquer valor padrão, como 0
    // Opcionalmente, exiba uma mensagem informativa
    Painel::alert('erro', 'Peso não encontrado!');
}
// consulta o nível de treinamento do usuário
$sql = MySql::conectar()->prepare("SELECT nivel_treinamento FROM `tb_usuarios_anamnese` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
$sql->execute([$usuario_id]);
$nivel_treinamento = $sql->fetch();

// Consulta o sexo do usuário
$sql = MySql::conectar()->prepare("SELECT sexo FROM `tb_admin.usuarios` WHERE id = ?");
$sql->execute([$usuario_id]);
$sexo = $sql->fetch();

// Consulta o telefone do professor
$sql = MySql::conectar()->prepare("SELECT professor_id FROM `tb_admin.usuarios` WHERE id = ?");
$sql->execute([$usuario_id]);
$professor_id = $sql->fetch()['professor_id'];
$sql = MySql::conectar()->prepare("SELECT telefone FROM `tb_admin.usuarios` WHERE id = ?");
$sql->execute([$professor_id]);
$telefone = $sql->fetch()['telefone'];

// Calcula a idade do usuário
$sql = MySql::conectar()->prepare("SELECT data_nascimento FROM `tb_admin.usuarios` WHERE id = ?");
$sql->execute([$usuario_id]);
$dataNascimentoArray = $sql->fetch();
$dataNascimento = new DateTime($dataNascimentoArray['data_nascimento']); // Converte a string em um objeto DateTime
$idade = (new DateTime())->diff($dataNascimento)->y; // Calcula a diferença de idade em anos
$FcMaxPred = 220 - $idade;

$sql = MySql::conectar()->prepare("SELECT peso FROM `tb_perfis_usuarios` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
    $sql->execute([$usuario_id]);

    if ($sql->rowCount() > 0) {
        $peso = $sql->fetch()['peso'];
        // Retorna o peso como JSON
		//echo "<script>console.log(" . json_encode($peso) . ");</script>";
        //echo $peso;
    } else {
        // Retorna uma resposta de erro caso o usuário não seja encontrado
        echo json_encode(['erro' => 'Usuário não encontrado']);
    }

	// Exibir o usuario_id para uso no JavaScript

	echo "<script>var peso = " . $peso . ";</script>";



// Verifica se o formulário foi submetido
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Define a data de avaliação
    $dataAvaliacao = (new DateTime())->format('Y-m-d H:i:s');
    $vo2_maximo = isset($_POST['vo2_maximo']) ? $_POST['vo2_maximo'] : null;
    $mets = isset($_POST['mets']) ? $_POST['mets'] : null;
    $metodo = isset($_POST['metodo']) ? $_POST['metodo'] : null;
    $fc_repouso = isset($_POST['fc-repouso']) ? $_POST['fc-repouso'] : null;
    $fc_max_pred = isset($_POST['resultado-fc-max-pred']) ? $_POST['resultado-fc-max-pred'] : null;
    
    // Dados a serem salvos na tabela
    $dadosAptidao = [
        'vo2_maximo' => $vo2_maximo,
        'mets' => $mets,
        'metodo' => $metodo,
        'fc_repouso' => $fc_repouso,
        'fc_max_pred' => $fc_max_pred   
    ];

    // Chama o método para gravar os dados
    if (AptidaoModel::gravarAptidao($usuario_id, $dadosAptidao, $dataAvaliacao)) {
        Painel::alert('sucesso', 'Dados gravados com sucesso!');
        $_SESSION['etapa'] = 5;

        // Redirecionamento com contagem regressiva
        $tempoContagem = 5;
        echo "<div id='contador' style='text-align:center; color:#007bff; padding-top:20px;'>Redirecionando em <span id='tempo'>$tempoContagem</span> segundos...</div>";
        echo "<script>
            var tempo = $tempoContagem;
            var intervalo = setInterval(function() {
                tempo--;
                document.getElementById('tempo').innerText = tempo;
                if (tempo <= 0) {
                    clearInterval(intervalo);
                    window.location.href='" . INCLUDE_PATH_PAINEL . 'teste-fisico' . "?id=" . $usuario_id . "';
                }
            }, 1000);
        </script>";
        exit();
    } else {
        Painel::alert('erro', 'Erro ao gravar dados.');
    }
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
    <h2 id="user-choice"><i class="fa fa-pencil" aria-hidden="true"></i>Aptidão cardiorespiratória</h2>
    <div class="form-group center">       
        <fieldset style="border: none;">
            <div class="center" style="text-align:center; max-width: 90%;">
                <p style="text-align: justify;">A aptidão cardiorrespiratória é a capacidade do coração, dos pulmões e dos vasos sanguíneos de fornecer oxigênio aos músculos durante atividades físicas prolongadas e intensas. Ela é um indicador importante de saúde geral e está associada a uma série de benefícios, incluindo menor risco de doenças cardiovasculares, melhor controle de peso, maior disposição e uma recuperação mais rápida após o exercício.</p>
				<p style="text-align: justify;">Para medir a aptidão cardiorrespiratória, frequentemente se utiliza o consumo máximo de oxigênio (VO₂ máx), que representa a quantidade máxima de oxigênio que uma pessoa consegue utilizar por minuto durante o exercício intenso. </p>
                <p>Escolha o método para definir a aptidão cardiorespiratória:</p>
                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="equacao" onclick="atualizarEscolha('equacao')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/equacao.svg" alt="Ícone equação">
                        </span><br>
                        <span class="checkbox-label">Equação</span>
                    </span>
                    </label> 
                </div>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="cooper" onclick="atualizarEscolha('cooper')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/cooper.svg" alt="Ícone Teste de Cooper">
                        </span><br>
                        <span class="checkbox-label">Pista</span>
                    </span>
                    </label> 
                </div>
                <?php if ($_SESSION['cargo'] == 1) { ?>
                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="bike" onclick="atualizarEscolha('bike')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/bike.svg" alt="Ícone Teste de bike">
                        </span><br>
                        <span class="checkbox-label">Bike</span>
                    </span>
                    </label> 
                </div>
                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="esteira" onclick="atualizarEscolha('esteira')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/esteira.svg" alt="Ícone Teste de esteira">
                        </span><br>
                        <span class="checkbox-label">Esteira</span>
                    </span>
                    </label> 
                </div>
                <?php }; ?>

                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="exame" onclick="atualizarEscolha('exame')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/exame.svg" alt="Ícone Exame">
                        </span><br>
                        
                        <span class="checkbox-label">Exame</span>
                    </span>
                    </label> 
                </div>

                <?php if ($_SESSION['cargo'] == 1) { ?>
                <div class="checkbox-wrapper-16" style="display: inline-block; margin:15px">
                    <label class="checkbox-wrapper">
                    <input type="radio" class="checkbox-input" name="metodo" value="outros" onclick="atualizarEscolha('outros')" />
                    <span class="checkbox-tile">
                        <span class="checkbox-icon">
                            <img src="<?php echo INCLUDE_PATH_PAINEL ?>/svg/outros.svg" alt="Ícone outros">
                        </span><br>
                        <span class="checkbox-label">Outros</span>
                    </span>
                    </label> 
                </div>
                <?php }; ?>
            </div>
        </fieldset>
    </div><!-- form-group -->    
    <div class="clear"></div>
</div><!-- box-content -->

<div class="box-content" id="formulario-selecionado">

     <form method="post" id="metodoForm">   
     <!-- Formulário Equação -->
     
        
            <!-- Outros campos do formulário -->
    
        <?php $metodo = 'equacao'; 
        if ($metodo == 'equacao') {
            // Calcula o VO2 máximo e os METs
            if ($sexo['sexo'] == 'M' || $sexo['sexo'] == 'm') {
                $vo2_maximo = 57.8 - (0.445 * $idade) + (0.0969 * $peso);
            } else {
                $vo2_maximo = 41.2 - (0.325 * $idade) + (0.0194 * $peso);
            }
            $mets = $vo2_maximo / 3.5;
        
        ?>
        <div class="form-group" id="form-equacao" style="display: none;">
            <h2>Aptidão cardiorespiratória por equação</h2>
            <div class="form-group">
                     
                <p>Fórmula de Jackson e Pollock fornece uma estimativa e são válidas principalmente para adultos saudáveis.</p>
                <p>O valor de MET é uma unidade relativa ao consumo de oxigênio em repouso, que é aproximadamente 3,5 mL/kg/min para um adulto médio.</p><br>
                <!-- Campo oculto para armazenar o método selecionado -->
                <input type="hidden" id="metodo-equacao" name="metodo" value="" >
                <div class="form-group w50 left">
                    <div class="form-group">
                        <label for="fc-repouso">FC Repouso:</label>
                        <input type="text" id="fc-repouso" name="fc-repouso" value="" placeholder="Digite a frequência cárdiaca em repouso">
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>FC máxima preditiva</label>
                        <input type="text" name="resultado-fc-max-pred" id="resultado-fc-max-pred" value="<?php echo $FcMaxPred;?>" style="background-color: #EBE7E1;" readonly />
                    </div><!-- form-group -->
                <?php if (is_numeric($peso)) { ?>
                    <div class="form-group">
                        <label>Peso:</label>
                        <input type="text" name="peso" value="<?php echo number_format($peso, 2); ?> Kg" style="background-color: #EBE7E1;" readonly/>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>Vo² Máximo</label>
                        <input type="text" name="vo2_maximo" value="<?php echo number_format($vo2_maximo, 2); ?> mL/kg/min" style="background-color: #EBE7E1;" readonly/>
                    </div><!-- form-group -->
                    <div class="form-group">
                        <label>METs</label>
                        <input type="text" name="mets" value="<?php echo number_format($mets, 2); ?> Mets" style="background-color: #EBE7E1;" readonly/>
                    </div><!-- form-group -->
                <?php } else { ?>
                    <p><strong><?php echo $peso; ?></strong></p>
                <?php } ?>
            </div>

            <div class="form-group w50 right">
                    
                <p>A frequência cardíaca de repouso (FC de repouso) é uma métrica simples e importante para avaliar a saúde cardiovascular. Ela reflete a quantidade de vezes que o coração bate por minuto enquanto o corpo está em repouso. Medir corretamente essa frequência requer atenção a alguns detalhes. Aqui está um tutorial passo a passo:</p>

                <h4>Passo 1: Escolha o momento ideal</h4>
                <p>- Ao acordar: Meça a frequência cardíaca logo após acordar, antes de levantar da cama. Este é o momento mais indicado, pois o corpo está em completo repouso.</p>
                <p>- Evite influências externas: Não meça sua frequência cardíaca após atividades físicas, refeições, ingestão de cafeína ou situações estressantes.</p>
                <h4>Passo 2: Prepare-se para a medição</h4>
                <p>- Ambiente tranquilo: Certifique-se de estar em um lugar silencioso e confortável.</p>
                <p>- Posição adequada: Deite-se ou sente-se confortavelmente. Relaxe por pelo menos 5 minutos antes da medição.</p>
                <h4>Passo 3: Encontre o pulso</h4>
                <p>Locais comuns para medir o pulso:</p>
                <p>Pulso radial: Na parte interna do pulso, logo abaixo do polegar.</p>
                <p>Pulso carotídeo: Na lateral do pescoço, próximo à traqueia.</p>
                <p>Use os dedos corretos: Utilize o indicador e o dedo médio para sentir o pulso. Nunca use o polegar, pois ele possui seu próprio pulso e pode interferir na medição.</p>
                <h4>Passo 4: Faça a contagem</h4>
                <p>Cronometre 60 segundos: Use um cronômetro ou relógio com ponteiro de segundos.</p>
                <p>Conte as batidas: Durante 60 segundos, conte quantas vezes o coração bate. Se preferir, conte as batidas durante 15 segundos e multiplique por 4.</p>
                <p>Registre o valor: Anote o número obtido para acompanhar tendências ao longo do tempo.</p>
                <h4>Dicas adicionais</h4>
                <p>Meça a frequência cardíaca em dias consecutivos para obter uma média mais confiável.</p>
                <p>Utilize um monitor cardíaco, como smartwatches ou cintas torácicas, se preferir maior precisão.</p>
            </div>

            </div>
            <div class="clear"></div>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </div>
    </form>
    <?php } ?>
    
    <?php $metodo = 'cooper'; 
        if ($metodo == 'cooper') { ?>
    <!-- Formulário Teste de Cooper -->
    <div class="form-group" id="form-cooper" style="display: none;">
        <h2>Formulário para Teste de Pista</h2>
        <p>Para realizar o teste de Cooper, o avaliado deve percorrer a maior distância possível em 
            <?php 
                if ($idade < 65) { 
                    echo "12 minutos"; 
                } else { 
                    echo "6 minutos"; 
                } 
            ?>. Utilize um  relógio ou cronômetro para medir o tempo exato e uma forma de medir a distância percorrida (pode ser uma pista marcada ou aplicativos de GPS).</p>
        <p>A classificação do VO₂ máximo pode variar de acordo com a idade e o gênero, mas existem tabelas de referência que ajudam a entender se o nível de aptidão é considerado "excelente", "bom", "médio" ou "abaixo da média".</p>
        <form method="post" id="metodoForm"> 
        <!-- Campo oculto para armazenar o método selecionado -->
        <input type="hidden" id="metodo-cooper" name="metodo" value="">
        <div class="form-group w50 left">
            <div class="form-group">
                <label for="fc-repouso">FC Repouso:</label>
                <input type="text" id="fc-repouso" name="fc-repouso" value="" placeholder="Digite a frequência cárdiaca em repouso">
            </div><!-- form-group -->
            <div class="form-group">
                <label>FC máxima preditiva</label>
                <input type="text" name="resultado-fc-max-pred" id="resultado-fc-max-pred" value="<?php echo $FcMaxPred;?>" style="background-color: #EBE7E1;" readonly />
             </div><!-- form-group -->
            <!-- Campos específicos para Teste de Cooper -->
            <div class="form-group">
                <label for="distancia">Distancia percorrida:</label>
                <input type="text" id="distancia" name="distancia" oninput="calcularVO2MaxCooper()" value="" placeholder="Digite a distância percorrida em metros">
            </div><!-- form-group -->
            <div class="form-group">
                <label>Vo² Máximo</label>
                <input type="text" name="vo2_maximo" id="resultado-vo2max" style="background-color: #EBE7E1;" readonly/>
             </div><!-- form-group -->
             <div class="form-group">
                <label>METs</label>
                <input type="text" name="mets" id="resultado-mets" style="background-color: #EBE7E1;" readonly/>
            </div><!-- form-group -->
        </div>
        <div class="form-group w50 right">
                    
                <p>A frequência cardíaca de repouso (FC de repouso) é uma métrica simples e importante para avaliar a saúde cardiovascular. Ela reflete a quantidade de vezes que o coração bate por minuto enquanto o corpo está em repouso. Medir corretamente essa frequência requer atenção a alguns detalhes. Aqui está um tutorial passo a passo:</p>

                <h4>Passo 1: Escolha o momento ideal</h4>
                <p>- Ao acordar: Meça a frequência cardíaca logo após acordar, antes de levantar da cama. Este é o momento mais indicado, pois o corpo está em completo repouso.</p>
                <p>- Evite influências externas: Não meça sua frequência cardíaca após atividades físicas, refeições, ingestão de cafeína ou situações estressantes.</p>
                <h4>Passo 2: Prepare-se para a medição</h4>
                <p>- Ambiente tranquilo: Certifique-se de estar em um lugar silencioso e confortável.</p>
                <p>- Posição adequada: Deite-se ou sente-se confortavelmente. Relaxe por pelo menos 5 minutos antes da medição.</p>
                <h4>Passo 3: Encontre o pulso</h4>
                <p>Locais comuns para medir o pulso:</p>
                <p>Pulso radial: Na parte interna do pulso, logo abaixo do polegar.</p>
                <p>Pulso carotídeo: Na lateral do pescoço, próximo à traqueia.</p>
                <p>Use os dedos corretos: Utilize o indicador e o dedo médio para sentir o pulso. Nunca use o polegar, pois ele possui seu próprio pulso e pode interferir na medição.</p>
                <h4>Passo 4: Faça a contagem</h4>
                <p>Cronometre 60 segundos: Use um cronômetro ou relógio com ponteiro de segundos.</p>
                <p>Conte as batidas: Durante 60 segundos, conte quantas vezes o coração bate. Se preferir, conte as batidas durante 15 segundos e multiplique por 4.</p>
                <p>Registre o valor: Anote o número obtido para acompanhar tendências ao longo do tempo.</p>
                <h4>Dicas adicionais</h4>
                <p>Meça a frequência cardíaca em dias consecutivos para obter uma média mais confiável.</p>
                <p>Utilize um monitor cardíaco, como smartwatches ou cintas torácicas, se preferir maior precisão.</p>
            </div>

            <div class="clear"></div>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->

        </form>
    </div>
    <?php } ?>
    
    <?php $metodo = 'bike'; 
        if ($metodo == 'bike') { ?>
    <!-- Formulário Teste de Bike -->
    <?php include 'bike.php';?>
    <?php } ?>

    <?php $metodo = 'esteira'; 
        if ($metodo == 'esteira') { ?>
    <?php include 'esteira.php';?>
    
    <?php } ?>

    <?php $metodo = 'exame'; 
        if ($metodo == 'exame') { ?>

    <!-- Formulário Exame -->
    <div class="form-group" id="form-exame" style="display: none;">
        <form method="post" id="metodoForm"> 
        <input type="hidden" id="metodo-exame" name="metodo" value="">
        <?php $metodo = 'exame';?>
            <!-- Campos específicos para Exame -->
            <a class='whatsapp-link' href="https://web.whatsapp.com/send?phone=55<?php echo $telefone; ?>&text=<?php echo $mensagem; ?>" target='_blank'>Enviar Mensagem no WhatsApp</a>
            </div><!-- form-group -->
        </form>
    </div>
    <?php } ?>

    <?php $metodo = 'outros'; 
        if ($metodo == 'outros') { ?>

    <!-- Formulário Outros -->
    <div class="form-group" id="form-outros" style="display: none;">
        <h2>Formulário para Outros</h2>
        <form method="post" id="metodoForm"> 
        <input type="text" id="metodo-outros" name="metodo" value="">
        <?php $metodo = 'outros'; echo $metodo;?>
            <!-- Campos específicos para Outros -->
            <label for="input9">Campo 9:</label>
            <input type="text" id="input9" name="input9"><br>
            <label for="input10">Campo 10:</label>
            <input type="text" id="input10" name="input10"><br>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>
</div>
<?php } ?>


<script>
var nivelTreinamento = "<?php echo $nivel_treinamento['nivel_treinamento']; ?>";
var usuario_id = <?php echo json_encode($usuario_id); ?>;

function atualizarEscolha(metodo) {
    // Oculta todos os formulários
    document.getElementById('form-equacao').style.display = 'none';
    document.getElementById('form-cooper').style.display = 'none';
    document.getElementById('form-esteira').style.display = 'none';
    document.getElementById('form-bike').style.display = 'none';
    document.getElementById('form-exame').style.display = 'none';
    document.getElementById('form-outros').style.display = 'none';

    // Exibe o formulário correspondente ao método selecionado
    if (metodo == 'equacao') {
        document.getElementById('form-equacao').style.display = 'block';
        // Atualiza o valor do campo oculto com o método selecionado
        document.getElementById('metodo-' + metodo).value = metodo;
        //console.log(metodo);
    } else if (metodo == 'cooper') {
        document.getElementById('form-cooper').style.display = 'block';
        // Atualiza o valor do campo oculto com o método selecionado
        document.getElementById('metodo-' + metodo).value = metodo;
        //console.log(metodo);
    } else if (metodo == 'bike') {
        document.getElementById('form-bike').style.display = 'block';
        // Atualiza o valor do campo oculto com o método selecionado
        document.getElementById('metodo-' + metodo).value = metodo;
        //console.log(metodo);
    } else if (metodo == 'esteira') {
        document.getElementById('form-esteira').style.display = 'block';
        // Atualiza o valor do campo oculto com o método selecionado
        document.getElementById('metodo-' + metodo).value = metodo;
        //console.log(metodo);
    } else if (metodo == 'exame') {
        document.getElementById('form-exame').style.display = 'block';
        // Atualiza o valor do campo oculto com o método selecionado
        document.getElementById('metodo-' + metodo).value = metodo;
        //console.log(metodo);
    } else if (metodo == 'outros') {
        document.getElementById('form-outros').style.display = 'block';
        // Atualiza o valor do campo oculto com o método selecionado
        document.getElementById('metodo-' + metodo).value = metodo;
        //console.log(metodo);
    }
}

function calcularVO2MaxCooper() {
    var distancia = document.getElementById('distancia').value;

    var idade = <?php echo $idade; ?>;
    if (idade < 65) {
        // Fórmula para calcular o VO² Máximo no Teste de Cooper 12 minutos
        var vo2max = (distancia - 504.9) / 44.73;
    } else {
        // Fórmula para calcular o VO² Máximo no Teste de Cooper 6 minutos
        var vo2max = (distancia - 504.9) / 30.4;
    }
    if (distancia && !isNaN(distancia)) {
        // Fórmula para calcular o VO² Máximo no Teste de Cooper 12 minutos
        var mets = vo2max / 3.5;
        // Define o valor calculado no campo de input "resultado-vo2max"
        document.getElementById('resultado-vo2max').value = vo2max.toFixed(2) + " mL/kg/min";
        document.getElementById('resultado-mets').value = mets.toFixed(2) + " Mets";
        } else { 
        // Exibe uma mensagem de erro no campo caso o valor não seja numérico
        document.getElementById('resultado-vo2max').value = "";
        document.getElementById('resultado-mets').value = "";
        }
}
</script>
