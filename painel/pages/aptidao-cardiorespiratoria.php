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
                <p>O valor de MET é uma unidade relativa ao consumo de oxigênio em repouso, que é aproximadamente 3,5 mL/kg/min para um adulto médio.</p>
                <!-- Campo oculto para armazenar o método selecionado -->
                <input type="text" id="metodo-equacao" name="metodo" value="" >
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
        <input type="text" id="metodo-cooper" name="metodo" value="">

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
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>
    <?php } ?>
    
    <?php $metodo = 'bike'; 
        if ($metodo == 'bike') { ?>
    <!-- Formulário Teste de Bike -->
    <div class="form-group" id="form-bike" style="display: none;">
        <h2>Teste máximo da ACSM (Cicloergômetro)</h2>
        <?php echo $metodo; ?>
        <!-- Campo oculto para armazenar o método selecionado -->
        <p>Ajustar o banco do cicloergômetro para que o joelho do participante fique levemente flexionado quando o pedal estiver no ponto mais baixo. Configurar o cicloergômetro para a resistência inicial</p>
        <p>Pedalar até o avaliado atingir exaustão a uma cadência constante de 60 rotações por minuto (rpm).</p>
        <p>A cada 2 minutos, realizar o incremento de carga e registrar a FC e a PSE na tabela abaixo.</p> 
        <form method="post" id="metodoForm"> 
        <!-- Campo oculto para armazenar o metodo selecionado -->
        <input type="text" id="metodo-bike" name="metodo" value="">
		<div class="form-group left w50">
			<div class="conconi-table">
				<table>
                    <thead>
                        <tr align="center">
                            <td><b>TEMPO</b></td>
                            <td><b>CARGA</b></td>
                            <td><b>FC (BPM)</b></td>
                            <td><b>PSE</b></td>
                        </tr>
                    </thead>
					<tbody>
						<tr>
							<td align="center" valign=middle><b>2</b></td>
                            <td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '0,5 Kp';} else {echo '1,0 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t2"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t2"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>4</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '1,0 Kp';} else {echo '1,5 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t4"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t4"/></td> 
						</tr>
						<tr>
							<td align="center" valign=middle><b>6</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '1,5 Kp';} else {echo '2,0 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t6"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t6"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>8</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '2,0 Kp';} else {echo '2,5 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t4"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t4"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>10</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '2,5 Kp';} else {echo '3,0 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t10"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t10"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>12</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '3,0 Kp';} else {echo '3,5 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t12"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t12"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>14</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '3,5 Kp';} else {echo '4,0 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t14"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t14"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>16</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '4,0 Kp';} else {echo '4,5 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t16"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t16"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>18</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '4,5 Kp';} else {echo '5,0 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t18"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t18"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>20</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '5,0 Kp';} else {echo '5,5 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t20"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t20"/></td>
						</tr>
                        <tr>
							<td align="center" valign=middle><b>22</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '5,5 Kp';} else {echo '6,0 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t22"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t22"/></td>
						</tr>
                        <tr>
							<td align="center" valign=middle><b>24</b></td>
							<td align="center" valign=middle><b><?php if ($nivel_treinamento['nivel_treinamento'] == 'Iniciante') {echo '6,0 Kp';} else {echo '6,5 Kp';} ?></b></td>
							<td align="center" valign=middle><input type="text" name="fc-t24"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t24"/></td>
						</tr>
					</tbody>
				</table>
			</div><!--conconi-table-->
		</div><!--form-group-->
		<div class="form-group right w50">	
			<div class="conconi-table" >
			<table>
				<thead>
					<tr align="center">
						<td colspan="2"><b>RESULTADOS</b></td>
					</tr>
				</thead>
				<tbody>
					<tr>
                		<td align="center" valign=middle><b>FC de repouso:</b></td>
                		<td align="center" valign=middle><input type="text" name="fc-repouso" id="fc-repouso" /></td>
            		</tr>
					<tr>
						<td align="center" valign=middle><b>FC máxima:</b></td>
						<td align="center" valign=middle><input type="text" name="fc-max" id="fc-max" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
                		<td align="center" valign=middle><b>Carga máxima:</b></td>
                		<td align="center" valign=middle><input type="text" name="carga-max" id="carga-max" style="background-color: #EBE7E1;" readonly/></td>
            		</tr>
					<tr>
						<td align="center" valign=middle><b>PSE máxima:</b></td>
						<td align="center" valign=middle><input type="text" name="pse-max" id="pse-max" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
                		<td align="center" valign=middle><b>Índice de FC:</b></td>
                		<td align="center" valign=middle><input type="text" name="indice-fc" id="indice-fc" style="background-color: #EBE7E1;" readonly/></td>
            		</tr>
					<tr>
						<td align="center" valign=middle><b>METs:</b></td>
						<td align="center" valign=middle><input type="text" name="mets" id="mets" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>VO² máxima (ml. kg. min):</b></td>
						<td align="center" valign=middle><input type="text" name="vo2-max-ml" id="vo2-max-ml" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>VO² máxima (L. min):</b></td>
						<td align="center" valign=middle><input type="text" name="vo2-max-l" id="vo2-max-l" style="background-color: #EBE7E1;" readonly/></td>
					</tr>

					<tr>
						<td align="center" valign=middle><b>FC L1:</b></td>
						
						<td align="center" valign=middle><input type="text" name="limiar1" id="limiar1" style="background-color: #EBE7E1;" readonly></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L1 (% FC máxima)</b></td>
						<td align="center" valign=middle><input type="text" name="fc_l1_percent" id="fc-l1-percent" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L2:</b></td>
						<td align="center" valign=middle><input type="text" name="limiar2" id="limiar2" style="background-color: #EBE7E1;" readonly></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L2 (% FC máxima)</b></td>
						<td align="center" valign=middle><input type="text" name="fc_l2_percent" id="fc_l2_percent" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
				</tbody>
			</table>
            </div><!-- conconi-table -->
		</div><!--form-group-->

		<div class="clear"></div><!-- clear -->           
		<div class="form-group">
			<input type="submit" name="acao" value="Enviar"/>
		</div><!-- form-group -->
        </form>
    </div>
    <?php } ?>

    <?php $metodo = 'esteira'; 
        if ($metodo == 'esteira') { ?>

    <!-- Formulário Teste de Esteira -->
    <div class="form-group" id="form-esteira" style="display: none;">
        <h2>Formulário para Teste de Esteira</h2>
        <form method="post" id="metodoForm">
        <input type="text" id="metodo-esteira" name="metodo" value="">
            <!-- Campos específicos para Teste de Esteira -->
            <label for="input7">Campo 7:</label>
            <input type="text" id="input7" name="input7"><br>
            <label for="input8">Campo 8:</label>
            <input type="text" id="input8" name="input8"><br>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
            </div><!-- form-group -->
        </form>
    </div>
    <?php } ?>

    <?php $metodo = 'exame'; 
        if ($metodo == 'exame') { ?>

    <!-- Formulário Exame -->
    <div class="form-group" id="form-exame" style="display: none;">
        <h2>Formulário para Exame</h2>
        <form method="post" id="metodoForm"> 
        <input type="text" id="metodo-exame" name="metodo" value="">
        <?php $metodo = 'exame'; echo $metodo;?>
            <!-- Campos específicos para Exame -->
            <label for="input5">Campo 5:</label>
            <input type="text" id="input5" name="input5"><br>
            <label for="input6">Campo 6:</label>
            <input type="text" id="input6" name="input6"><br>
            <div class="form-group">
                <input type="submit" name="acao" value="Enviar"/>
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

document.addEventListener("DOMContentLoaded", function() {

    // Função para calcular a FC máxima e retornar o valor
    function calcularFCMaxima() {
        let fcMax = 0;
        // Loop por todos os campos de FC
        document.querySelectorAll("input[name^='fc-t']").forEach(function(input) {
            let valor = parseFloat(input.value);

            if (!isNaN(valor) && valor > fcMax) {
                fcMax = valor;
            }
        });
        document.querySelector("input[name='fc-max']").value = fcMax || '';
        
        return fcMax; // Agora retorna o valor da FC máxima
    }

    // Função para calcular a PSE máxima
    function calcularPSEMaxima() {
        let pseMax = 0;
        document.querySelectorAll("input[name^='pse-t']").forEach(function(input) {
            let valor = parseFloat(input.value);
            if (!isNaN(valor) && valor > pseMax) {
                pseMax = valor;
            }
        });
        document.querySelector("input[name='pse-max']").value = pseMax || '';
    }

    // Função para calcular os percentuais dos limiares
    function calcularPercentuaisLimiar(fcMax, limiar1, limiar2) {
        if (!isNaN(fcMax) && fcMax > 0) {
            let percentualL1 = (limiar1 / fcMax) * 100;
            let percentualL2 = (limiar2 / fcMax) * 100;

            document.getElementById('fc-l1-percent').value = percentualL1.toFixed(2) + '%';
            document.getElementById('fc_l2_percent').value = percentualL2.toFixed(2) + '%';
        } else {
            document.getElementById('fc-l1-percent').value = '';
            document.getElementById('fc_l2_percent').value = '';
        }
    }

    // Função para calcular a carga máxima
    function calcularCargaMaxima() {
        let cargas = {1: (nivelTreinamento == 'Iniciante') ? 0.5 : 1.0, 2: (nivelTreinamento == 'Iniciante') ? 1.0 : 1.5, 3: (nivelTreinamento == 'Iniciante') ? 1.5 : 2.0, 4: (nivelTreinamento == 'Iniciante') ? 2.0 : 2.5, 5: (nivelTreinamento == 'Iniciante') ? 2.5 : 3.0, 6: (nivelTreinamento == 'Iniciante') ? 3.0 : 3.5, 7: (nivelTreinamento == 'Iniciante') ? 3.5 : 4.0, 8: (nivelTreinamento == 'Iniciante') ? 4.0 : 4.5, 9: (nivelTreinamento == 'Iniciante') ? 4.5 : 5.0, 10: (nivelTreinamento == 'Iniciante') ? 5.0 : 5.5, 11: (nivelTreinamento == 'Iniciante') ? 5.5 : 6.0, 12: (nivelTreinamento == 'Iniciante') ? 6.0 : 6.5};

        // Inicializa a variável cargaMax
        var cargaMax = 0;

        // Loop por todos os campos de FC e calcula a carga correspondente
        document.querySelectorAll("input[name^='fc-t']").forEach(function(input, index) {
            let valor = parseFloat(input.value);
            let estagio = index + 1;
            if (!isNaN(valor) && cargas[estagio] && cargas[estagio] > cargaMax) {
                cargaMax = cargas[estagio];
            }
        });

        document.querySelector("input[name='carga-max']").value = cargaMax || '';
    // document.querySelector("input[name='ivo2_x_kmh_100']").value = cargaMax || '';
    // atualizarValoresVO2(); // Chama a função para atualizar os demais inputs
    }

    function calcularLimiar() {
        let cargas = [];
        let frequencias = [];
        document.querySelectorAll("input[name^='fc-t']").forEach(function(input, index) {
            let carga = 5 + index; // Exemplo: carga em função do índice
            let valorFC = parseFloat(input.value);
            if (!isNaN(valorFC)) {
                cargas.push(carga);
                frequencias.push(valorFC);
            }
        });
        // Lógica simplificada para encontrar os limiares
        let limiar1 = encontrarLimiar1(cargas, frequencias);
        let limiar2 = encontrarLimiar2(cargas, frequencias);
        // Atualiza os campos de limiar
        document.getElementById('limiar1').value = limiar1;
        document.getElementById('limiar2').value = limiar2;
        // Chama calcularPercentuaisLimiar com o valor retornado por calcularFCMaxima
        let fcMax = calcularFCMaxima(); // Agora, captura o valor da FC máxima corretamente
        calcularPercentuaisLimiar(fcMax, limiar1, limiar2);
    }

    function calcularRegressaoLinear(cargas, frequencias) {
        const n = cargas.length;
        const somaX = cargas.reduce((a, b) => a + b, 0);
        const somaY = frequencias.reduce((a, b) => a + b, 0);
        const somaXY = cargas.reduce((sum, x, i) => sum + x * frequencias[i], 0);
        const somaX2 = cargas.reduce((sum, x) => sum + x * x, 0);
        // Cálculo da inclinação (a)
        const a = (n * somaXY - somaX * somaY) / (n * somaX2 - somaX * somaX);
        // Cálculo da interseção (b)
        const b = (somaY - a * somaX) / n;
        return { a, b };
    }



    function encontrarLimiar1(cargas, frequencias) {
        const { a } = calcularRegressaoLinear(cargas, frequencias);
        let limiar1 = 0;
        // Verifica a mudança na inclinação
        for (let i = 1; i < frequencias.length; i++) {
            const inclinaçãoAtual = (frequencias[i] - frequencias[i - 1]) / (cargas[i] - cargas[i - 1]);
            if (inclinaçãoAtual > a * 1.2) { // Exemplo de um critério
                limiar1 = frequencias[i];
                break;
            }
        }
        return limiar1;
    }

    function encontrarLimiar2(cargas, frequencias) {
        const { a } = calcularRegressaoLinear(cargas, frequencias);
        let limiar2 = 0;
        // Verifica a mudança na inclinação
        for (let i = 1; i < frequencias.length; i++) {
            const inclinaçãoAtual = (frequencias[i] - frequencias[i - 1]) / (cargas[i] - cargas[i - 1]);
            if (inclinaçãoAtual > a * 0.6) { // Exemplo de um critério mais alto
                limiar2 = frequencias[i];
                break;
            }
        }
        return limiar2;
    }

    // Função para recalcular todos os resultados
    function recalcularResultados() {
        calcularFCMaxima();
        calcularPSEMaxima();
        calcularCargaMaxima();
        calcularLimiar(); // Chama a função para calcular os limiares
        calculaMets();
        calculaVo2MaxL(peso); 
    }

    // Atribui a função de recalcular resultados sempre que o usuário preencher um campo de FC ou PSE
    document.querySelectorAll("input[name^='fc-t'], input[name^='pse-t']").forEach(function(input) {
        input.addEventListener("input", recalcularResultados);
    });

    // Função para calcular o índice de FC
    function calculaIndiceFC() {
        var fcRepouso = parseFloat(document.getElementById('fc-repouso').value);
        var fcMax = parseFloat(document.getElementById('fc-max').value);

        if (!isNaN(fcRepouso) && !isNaN(fcMax) && fcRepouso > 0) {
            var indiceFC = fcMax / fcRepouso;
            document.getElementById('indice-fc').value = indiceFC.toFixed(2);
        } else {
            document.getElementById('indice-fc').value = '';
        }
    }

    // Função para calcular os METs
    function calculaMets() {
        var vo2Max = parseFloat(document.getElementById('vo2-max-ml').value);
        if (!isNaN(vo2Max)) {
            var mets = vo2Max / 3.5;
            document.getElementById('mets').value = mets.toFixed(2);
        } else {
            document.getElementById('mets').value = '';
        }
    }

    // Função geral para calcular
    function calcula() {
        calculaIndiceFC();
        calculaMets();
        calcularVO2Max(cargaMax);
    }

    // Monitora as mudanças nos campos de entrada
    var camposParaMonitorar = ['fc-repouso', 'fc-max'];
    camposParaMonitorar.forEach(function(id) {
        document.getElementById(id).addEventListener('input', calcula);
    });
});

    // Supondo que a variável peso está sendo passada do PHP
var peso = <?php echo json_encode($peso); ?>;

    // Função para calcular o VO² máximo
function calcularVO2Max(cargaMax) {
    if (!isNaN(cargaMax) && cargaMax > 0) {

        var CargaTrabalho = cargaMax * 6 * 60;
        var vo2max = (1.8 * CargaTrabalho / peso) + 7;
        return vo2max.toFixed(2); // Retorna o valor com duas casas decimais
    } else {
        console.error("Peso inválido.");
        return '';
    }
}

// Função para calcular o índice FC
function calcularIndiceFC(fcRepouso, fcMax) {
    if (fcRepouso && fcMax && !isNaN(fcRepouso) && !isNaN(fcMax) && fcRepouso > 0) {
        var indiceFC = (fcMax / fcRepouso).toFixed(2);
        return indiceFC;
    } else {
        console.error("Valores de FC inválidos.");
        return '';
    }
}

function calculaVo2MaxL(peso) {
    var vo2MaxMl = parseFloat(document.getElementById('vo2-max-ml').value);
    if (!isNaN(vo2MaxMl) && !isNaN(peso) && peso > 0) {
        var vo2MaxL = (vo2MaxMl * peso) / 1000;
        document.getElementById('vo2-max-l').value = vo2MaxL.toFixed(2);
    } else {
        document.getElementById('vo2-max-l').value = '';
    }
}

    // Função para recalcular os resultados
function recalcularResultados() {
        // Supondo que você tem um campo de input para kpm
    var cargaMax = parseFloat(document.getElementById('carga-max').value);
    if (!isNaN(cargaMax) && cargaMax > 0) {
        var vo2max = calcularVO2Max(cargaMax);
        document.getElementById('vo2-max-ml').value = vo2max;
    } else {
        document.getElementById('vo2-max-ml').value = '';
    }

        // Calcular e atualizar o índice FC
    var fcRepouso = parseFloat(document.getElementById('fc-repouso').value);
    var fcMax = parseFloat(document.getElementById('fc-max').value);
    var indiceFC = calcularIndiceFC(fcRepouso, fcMax);
    document.getElementById('indice-fc').value = indiceFC;
}

    // Adicione o listener de evento para o input
document.addEventListener("input", recalcularResultados);
</script>
