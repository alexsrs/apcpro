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
<script>
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