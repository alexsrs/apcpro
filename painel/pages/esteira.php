<!-- Formulário Teste de Esteira -->
<div class="form-group" id="form-esteira" style="display: none;">
    <h2>Protocolo de Corrida Progressiva</h2>
        <?php echo $metodo; ?>
        <!-- Campo oculto para armazenar o método selecionado -->
        <p>Escolha uma inclinação fixa (1%, 2% ou 3%) e ajuste a velocidade inicial em 7 km/h</p>
        <p>Correr até o avaliado atingir exaustão, a cada 2 minutos aumentar a velocidade em + 1 km/h..</p>
        <p>Registrar a FC e a PSE na tabela abaixo.</p>
        <form method="post" id="metodoForm"> 
        <!-- Campo oculto para armazenar o metodo selecionado -->
        <input type="text" id="metodo-esteira" name="metodo" value="">
        <div class="form-group">
            <label>Inclinação</label>
            <select name="nivel-treinamento">
                <?php 
                    foreach (AptidaoModel::$inclinação as $key => $value){
                    echo '<option value="'.$key.'">'.$value.'</option>';
                                }
                ?>
            </select>
        </div><!-- form-group -->
		<div class="form-group left w50">
			<div class="conconi-table">
				<table>
                    <thead>
                        <tr align="center">
                            <td><b>TEMPO</b></td>
                            <td><b>VELOCIDADE</b></td>
                            <td><b>FC (BPM)</b></td>
                            <td><b>PSE</b></td>
                        </tr>
                    </thead>
					<tbody>
						<tr>
							<td align="center" valign=middle><b>2</b></td>
                            <td align="center" valign=middle><b>7 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t2"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t2"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>4</b></td>
							<td align="center" valign=middle><b>8 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t4"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t4"/></td> 
						</tr>
						<tr>
							<td align="center" valign=middle><b>6</b></td>
							<td align="center" valign=middle><b>9 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t6"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t6"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>8</b></td>
							<td align="center" valign=middle><b>10 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t4"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t4"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>10</b></td>
							<td align="center" valign=middle><b>11 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t10"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t10"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>12</b></td>
							<td align="center" valign=middle><b>12 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t12"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t12"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>14</b></td>
							<td align="center" valign=middle><b>13 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t14"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t14"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>16</b></td>
							<td align="center" valign=middle><b>14 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t16"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t16"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>18</b></td>
							<td align="center" valign=middle><b>15 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t18"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t18"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>20</b></td>
							<td align="center" valign=middle><b>16 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t20"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t20"/></td>
						</tr>
                        <tr>
							<td align="center" valign=middle><b>22</b></td>
							<td align="center" valign=middle><b>17 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t22"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t22"/></td>
						</tr>
                        <tr>
							<td align="center" valign=middle><b>24</b></td>
							<td align="center" valign=middle><b>18 km</b></td>
							<td align="center" valign=middle><input type="text" name="esteira-fc-t24"/></td>
							<td align="center" valign=middle><input type="text" name="esteira-pse-t24"/></td>
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
                		<td align="center" valign=middle><input type="text" name="esteira-fc-repouso" id="esteira-fc-repouso" /></td>
            		</tr>
					<tr>
						<td align="center" valign=middle><b>FC máxima:</b></td>
						<td align="center" valign=middle><input type="text" name="esteira-fc-max" id="esteira-fc-max" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
                		<td align="center" valign=middle><b>Carga máxima:</b></td>
                		<td align="center" valign=middle><input type="text" name="esteira-carga-max" id="esteira-carga-max" style="background-color: #EBE7E1;" readonly/></td>
            		</tr>
					<tr>
						<td align="center" valign=middle><b>PSE máxima:</b></td>
						<td align="center" valign=middle><input type="text" name="esteira-pse-max" id="esteira-pse-max" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
                		<td align="center" valign=middle><b>Índice de FC:</b></td>
                		<td align="center" valign=middle><input type="text" name="esteira-indice-fc" id="esteira-indice-fc" style="background-color: #EBE7E1;" readonly/></td>
            		</tr>
					<tr>
						<td align="center" valign=middle><b>esteira-mets:</b></td>
						<td align="center" valign=middle><input type="text" name="esteira-mets" id="esteira-mets" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>VO² máxima (ml. kg. min):</b></td>
						<td align="center" valign=middle><input type="text" name="esteira-vo2-max-ml" id="esteira-vo2-max-ml" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>VO² máxima (L. min):</b></td>
						<td align="center" valign=middle><input type="text" name="esteira-vo2-max-l" id="esteira-vo2-max-l" style="background-color: #EBE7E1;" readonly/></td>
					</tr>

					<tr>
						<td align="center" valign=middle><b>FC L1:</b></td>
						
						<td align="center" valign=middle><input type="text" name="esteira-limiar1" id="esteira-limiar1" style="background-color: #EBE7E1;" readonly></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L1 (% FC máxima)</b></td>
						<td align="center" valign=middle><input type="text" name="esteira-fc_l1_percent" id="fc-l1-percent" style="background-color: #EBE7E1;" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L2:</b></td>
						<td align="center" valign=middle><input type="text" name="esteira-limiar2" id="esteira-limiar2" style="background-color: #EBE7E1;" readonly></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L2 (% FC máxima)</b></td>
						<td align="center" valign=middle><input type="text" name="esteira-fc_l2_percent" id="esteira-fc_l2_percent" style="background-color: #EBE7E1;" readonly/></td>
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
        document.querySelectorAll("input[name^='esteira-fc-t']").forEach(function(input) {
            let valor = parseFloat(input.value);

            if (!isNaN(valor) && valor > fcMax) {
                fcMax = valor;
            }
        });
        document.querySelector("input[name='esteira-fc-max']").value = fcMax || '';
        
        return fcMax; // Agora retorna o valor da FC máxima
    }

    // Função para calcular a PSE máxima
    function calcularPSEMaxima() {
        let pseMax = 0;
        document.querySelectorAll("input[name^='esteira-pse-t']").forEach(function(input) {
            let valor = parseFloat(input.value);
            if (!isNaN(valor) && valor > pseMax) {
                pseMax = valor;
            }
        });
        document.querySelector("input[name='esteira-pse-max']").value = pseMax || '';
    }

    // Função para calcular os percentuais dos limiares
    function calcularPercentuaisLimiar(fcMax, esteira_limiar1, esteira_limiar2) {
        if (!isNaN(fcMax) && fcMax > 0) {
            let percentualL1 = (esteira-limiar1 / fcMax) * 100;
            let percentualL2 = (esteira-limiar2 / fcMax) * 100;

            document.getElementById('fc-l1-percent').value = percentualL1.toFixed(2) + '%';
            document.getElementById('esteira-fc_l2_percent').value = percentualL2.toFixed(2) + '%';
        } else {
            document.getElementById('fc-l1-percent').value = '';
            document.getElementById('esteira-fc_l2_percent').value = '';
        }
    }

    // Função para calcular a carga máxima
    function calcularCargaMaxima() {
        let cargas = {1: (nivelTreinamento == 'Iniciante') ? 0.5 : 1.0, 2: (nivelTreinamento == 'Iniciante') ? 1.0 : 1.5, 3: (nivelTreinamento == 'Iniciante') ? 1.5 : 2.0, 4: (nivelTreinamento == 'Iniciante') ? 2.0 : 2.5, 5: (nivelTreinamento == 'Iniciante') ? 2.5 : 3.0, 6: (nivelTreinamento == 'Iniciante') ? 3.0 : 3.5, 7: (nivelTreinamento == 'Iniciante') ? 3.5 : 4.0, 8: (nivelTreinamento == 'Iniciante') ? 4.0 : 4.5, 9: (nivelTreinamento == 'Iniciante') ? 4.5 : 5.0, 10: (nivelTreinamento == 'Iniciante') ? 5.0 : 5.5, 11: (nivelTreinamento == 'Iniciante') ? 5.5 : 6.0, 12: (nivelTreinamento == 'Iniciante') ? 6.0 : 6.5};

        // Inicializa a variável cargaMax
        var cargaMax = 0;

        // Loop por todos os campos de FC e calcula a carga correspondente
        document.querySelectorAll("input[name^='esteira-fc-t']").forEach(function(input, index) {
            let valor = parseFloat(input.value);
            let estagio = index + 1;
            if (!isNaN(valor) && cargas[estagio] && cargas[estagio] > cargaMax) {
                cargaMax = cargas[estagio];
            }
        });

        document.querySelector("input[name='esteira-carga-max']").value = cargaMax || '';
    // document.querySelector("input[name='ivo2_x_kmh_100']").value = cargaMax || '';
    // atualizarValoresVO2(); // Chama a função para atualizar os demais inputs
    }

    function calcularLimiar() {
        let cargas = [];
        let frequencias = [];
        document.querySelectorAll("input[name^='esteira-fc-t']").forEach(function(input, index) {
            let carga = 5 + index; // Exemplo: carga em função do índice
            let valorFC = parseFloat(input.value);
            if (!isNaN(valorFC)) {
                cargas.push(carga);
                frequencias.push(valorFC);
            }
        });
        // Lógica simplificada para encontrar os limiares
        let esteira_limiar1 = encontrar_limiar1(cargas, frequencias);
        let esteira_limiar2 = encontrar_limiar2(cargas, frequencias);
        // Atualiza os campos de limiar
        document.getElementById('esteira-limiar1').value = esteira-limiar1;
        document.getElementById('esteira-limiar2').value = esteira-limiar2;
        // Chama calcularPercentuaisLimiar com o valor retornado por calcularFCMaxima
        let fcMax = calcularFCMaxima(); // Agora, captura o valor da FC máxima corretamente
        calcularPercentuaisLimiar(fcMax, esteira-limiar1, esteira-limiar2);
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



    function encontrar_limiar1(cargas, frequencias) {
        const { a } = calcularRegressaoLinear(cargas, frequencias);
        let esteira_limiar1 = 0;
        // Verifica a mudança na inclinação
        for (let i = 1; i < frequencias.length; i++) {
            const inclinaçãoAtual = (frequencias[i] - frequencias[i - 1]) / (cargas[i] - cargas[i - 1]);
            if (inclinaçãoAtual > a * 1.2) { // Exemplo de um critério
                esteira_limiar1 = frequencias[i];
                break;
            }
        }
        return esteira-limiar1;
    }

    function encontrar_limiar2(cargas, frequencias) {
        const { a } = calcularRegressaoLinear(cargas, frequencias);
        let esteira_limiar2 = 0;
        // Verifica a mudança na inclinação
        for (let i = 1; i < frequencias.length; i++) {
            const inclinaçãoAtual = (frequencias[i] - frequencias[i - 1]) / (cargas[i] - cargas[i - 1]);
            if (inclinaçãoAtual > a * 0.6) { // Exemplo de um critério mais alto
                esteira_limiar2 = frequencias[i];
                break;
            }
        }
        return esteira-limiar2;
    }

    // Função para recalcular todos os resultados
    function recalcularResultados() {
        calcularFCMaxima();
        calcularPSEMaxima();
        calcularCargaMaxima();
        calcularLimiar(); // Chama a função para calcular os limiares
        calculaesteira-mets();
        calculaVo2MaxL(peso); 
    }

    // Atribui a função de recalcular resultados sempre que o usuário preencher um campo de FC ou PSE
    document.querySelectorAll("input[name^='esteira-fc-t'], input[name^='esteira-pse-t']").forEach(function(input) {
        input.addEventListener("input", recalcularResultados);
    });

    // Função para calcular o índice de FC
    function calculaIndiceFC() {
        var fcRepouso = parseFloat(document.getElementById('esteira-fc-repouso').value);
        var fcMax = parseFloat(document.getElementById('esteira-fc-max').value);

        if (!isNaN(fcRepouso) && !isNaN(fcMax) && fcRepouso > 0) {
            var indiceFC = fcMax / fcRepouso;
            document.getElementById('esteira-indice-fc').value = indiceFC.toFixed(2);
        } else {
            document.getElementById('esteira-indice-fc').value = '';
        }
    }

    // Função para calcular os esteira-mets
    function calculaesteira_mets() {
        var vo2Max = parseFloat(document.getElementById('esteira-vo2-max-ml').value);
        if (!isNaN(vo2Max)) {
            var esteira_mets = vo2Max / 3.5;
            document.getElementById('esteira-mets').value = esteira-mets.toFixed(2);
        } else {
            document.getElementById('esteira-mets').value = '';
        }
    }

    // Função geral para calcular
    function calcula() {
        calculaIndiceFC();
        calculaesteira-mets();
        calcularVO2Max(cargaMax);
    }

    // Monitora as mudanças nos campos de entrada
    var camposParaMonitorar = ['esteira-fc-repouso', 'esteira-fc-max'];
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
    var vo2MaxMl = parseFloat(document.getElementById('esteira-vo2-max-ml').value);
    if (!isNaN(vo2MaxMl) && !isNaN(peso) && peso > 0) {
        var vo2MaxL = (vo2MaxMl * peso) / 1000;
        document.getElementById('esteira-vo2-max-l').value = vo2MaxL.toFixed(2);
    } else {
        document.getElementById('esteira-vo2-max-l').value = '';
    }
    }

    // Função para recalcular os resultados
    function recalcularResultados() {
        // Supondo que você tem um campo de input para kpm
    var cargaMax = parseFloat(document.getElementById('esteira-carga-max').value);
    if (!isNaN(cargaMax) && cargaMax > 0) {
        var vo2max = calcularVO2Max(cargaMax);
        document.getElementById('esteira-vo2-max-ml').value = vo2max;
    } else {
        document.getElementById('esteira-vo2-max-ml').value = '';
    }
        // Calcular e atualizar o índice FC
    var fcRepouso = parseFloat(document.getElementById('esteira-fc-repouso').value);
    var fcMax = parseFloat(document.getElementById('esteira-fc-max').value);
    var indiceFC = calcularIndiceFC(fcRepouso, fcMax);
    document.getElementById('esteira-indice-fc').value = indiceFC;
    }

// Adicione o listener de evento para o input
document.addEventListener("input", recalcularResultados);
</script>