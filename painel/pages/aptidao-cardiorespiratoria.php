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

    // Inicializa a etapa na sessão, se ainda não estiver definida
    if (!isset($_SESSION['etapa'])) {
        $_SESSION['etapa'] = 4;
    }

	$sql = MySql::conectar()->prepare("SELECT peso FROM `tb_perfis_usuarios` WHERE usuario_id = ? ORDER BY data_avaliacao DESC LIMIT 1");
    $sql->execute([$usuario_id]);

    if ($sql->rowCount() > 0) {
        $peso = $sql->fetch()['peso'];
        // Retorna o peso como JSON
		echo "<script>console.log(" . json_encode($peso) . ");</script>";
        //echo $peso;
    } else {
        // Retorna uma resposta de erro caso o usuário não seja encontrado
        echo json_encode(['erro' => 'Usuário não encontrado']);
    }

	// Exibir o usuario_id para uso no JavaScript
    echo "<script>var usuario_id = " . json_encode($usuario_id) . ";</script>";
	echo "<script>var peso = " . $peso . ";</script>";
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
<h2><i class="fa fa-pencil" aria-hidden="true"></i>Aptidão Cardiorespiratória</h2>
<form method="post">  
<div class="form-group">
    <fieldset>
        <legend>Teste de Conconi</legend>
        <div class="form-group w50 left">
            <div class="form-group">
                <p class="conconi">O Teste de Conconi é uma ferramenta utilizada por atletas e profissionais de educação física para avaliar a capacidade aeróbica de um indivíduo. Esse teste foi desenvolvido pelo fisiologista italiano Francesco Conconi e consiste em uma avaliação progressiva da frequência cardíaca em relação à intensidade do exercício.</p>
                
            </div><!-- form-group -->
            <div class="form-group ">
                <p class="conconi">Para realizar o Teste de Conconi, o atleta é submetido a um protocolo de exercício em esteira ou bicicleta ergométrica, no qual a intensidade do esforço é aumentada a cada estágio. Durante o teste, a frequência cardíaca do atleta é monitorada continuamente, geralmente por meio de um monitor cardíaco, para que se possa avaliar a relação entre a intensidade do exercício e a resposta do coração.</p>
            </div><!-- form-group -->
        </div>
        <div class="form-group w50 right conconi-video">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/WcIOGgW6y9E?si=nA2j7oXxDptY9x63" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
		<div class="clear"></div><!-- clear -->
		
		<div class="form-group left w33">
			<div class="conconi-table" >
				<table>
				<thead>
					<tr align="center">
						<td><b>ESTÁGIO</b></td>
						<td><b>TEMPO</b></td>
						<td><b>VELOCIDADE</b></td>
						<td><b>FC (BPM)</b></td>
						<td><b>PSE</b></td>
					</tr>
				</thead>
					<tbody>
						<tr>
							<td rowspan=3 height="auto" align="center" valign=middle><b>AQUECIMENTO</b></td>
							<td align="center" valign=middle><b>1</b></td>
							<td align="center" valign=middle><b id="">5 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t1"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t1"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>2</b></td>
							<td align="center" valign=middle><b>5 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t2"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t2"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>3</b></td>
							<td align="center" valign=middle><b>5 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t3"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t3"/></td>
						</tr>
						<tr>
							<td rowspan=13 height="auto" align="center" valign=middle><b>ESFORÇO</b></td>
							<td align="center" valign=middle><b>4</b></td>
							<td align="center" valign=middle><b>6 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t4"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t4"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>5</b></td>
							<td align="center" valign=middle><b>7 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t5"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t5"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>6</b></td>
							<td align="center" valign=middle><b>8 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t6"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t6"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>7</b></td>
							<td align="center" valign=middle><b>9 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t7"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t7"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>8</b></td>
							<td align="center" valign=middle><b>10 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t8"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t8"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>9</b></td>
							<td align="center" valign=middle><b>11 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t9"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t9"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>10</b></td>
							<td align="center" valign=middle><b>12 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t10"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t10"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>11</b></td>
							<td align="center" valign=middle><b>13 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t11"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t11"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>12</b></td>
							<td align="center" valign=middle><b>14 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t12"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t12"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>13</b></td>
							<td align="center" valign=middle><b>15 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t13"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t13"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>14</b></td>
							<td align="center" valign=middle><b>16 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t14"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t14"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>15</b></td>
							<td align="center" valign=middle><b>17 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t15"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t15"/></td>
						</tr>
						<tr>
							<td align="center" valign=middle><b>16</b></td>
							<td align="center" valign=middle><b>18 KM/H</b></td>
							<td align="center" valign=middle><input type="text" name="fc-t16"/></td>
							<td align="center" valign=middle><input type="text" name="pse-t16"/></td>
						</tr>
					</tbody>
				</table>
			</div><!--form-group-->
		</div><!--form-group-->

		<div class="form-group left w33" style="padding: 0 0 0 80px; max-width: 45%;">	
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
						<td align="center" valign=middle><input type="text" name="fc-max" id="fc-max" readonly/></td>
					</tr>
					<tr>
                		<td align="center" valign=middle><b>Velocidade máxima:</b></td>
                		<td align="center" valign=middle><input type="text" name="velocidade-max" id="velocidade-max" readonly/></td>
            		</tr>
					<tr>
						<td align="center" valign=middle><b>PSE máxima:</b></td>
						<td align="center" valign=middle><input type="text" name="pse-max" id="pse-max" readonly/></td>
					</tr>
					<tr>
                		<td align="center" valign=middle><b>Índice de FC:</b></td>
                		<td align="center" valign=middle><input type="text" name="indice-fc" id="indice-fc" readonly/></td>
            		</tr>
					<tr>
						<td align="center" valign=middle><b>METs:</b></td>
						<td align="center" valign=middle><input type="text" name="mets" id="mets" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>VO² máxima (ml. kg. min):</b></td>
						<td align="center" valign=middle><input type="text" name="vo2-max-ml" id="vo2-max-ml" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>VO² máxima (L. min):</b></td>
						<td align="center" valign=middle><input type="text" name="vo2-max-l" id="vo2-max-l" readonly/></td>
					</tr>

					<tr>
						<td align="center" valign=middle><b>FC L1:</b></td>
						
						<td align="center" valign=middle><input type="text" name="limiar1" id="limiar1" placeholder="Limiar 1" readonly></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L1 (% FC máxima)</b></td>
						<td align="center" valign=middle><input type="text" name="fc-l1-percent" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L2:</b></td>
						<td align="center" valign=middle><input type="text" name="limiar2" id="limiar2" placeholder="Limiar 2" readonly></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L2 (% FC máxima)</b></td>
						<td align="center" valign=middle><input type="text" name="fc-l2-percent" readonly/></td>
					</tr>
				</tbody>
			</table>
            </div><!-- form-group -->
		</div><!--form-group-->

		<div class="form-group center w33" style="padding: 0 80px 0 80px; max-width: 45%;">	
			<div class="conconi-table">
			<table>
				<thead>
					<tr align="center">
						<td><b>% iVO² máxima</b></td>
						<td><b>KM/H</b></td>
					</tr>
				</thead>
				<tbody>
                	<tr>
						<td align="center" valign=middle><b>30</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_30" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>35</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_35" readonly/></td>
					<tr>
						<td align="center" valign=middle><b>40</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_40" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>45</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_45" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>50</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_50" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>55</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_44" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>60</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_60" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>65</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_65" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>70</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_70" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>75</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_75" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>80</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_80" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>85</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_85" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>90</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_90" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>95</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_95" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle style="background-color: red; color:white"><b>100</b></td>
						<td align="center" valign=middle style="background-color: red; color:white"><input type="text" name="ivo2_x_kmh_100" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>105</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_105" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>110</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_110" readonly/></td>
					</tr><tr>
						<td align="center" valign=middle><b>115</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_115" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>120</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_120" readonly/></td>
					</tr><tr>
						<td align="center" valign=middle><b>125</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_125"  readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>130</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_130" readonly/></td>
					</tr><tr>
						<td align="center" valign=middle><b>135</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_135" readonly/></td>
					</tr><tr>
						<td align="center" valign=middle><b>140</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_140" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>145</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_145" readonly/></td>
					</tr><tr>
						<td align="center" valign=middle><b>150</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_150" readonly/></td>
					</tr><tr>
						<td align="center" valign=middle><b>155</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_155" readonly/></td>
					</tr><tr>
						<td align="center" valign=middle><b>160</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_160" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>165</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_165" readonly/></td>
					</tr><tr>
						<td align="center" valign=middle><b>170</b></td>
						<td align="center" valign=middle><input type="text" name="ivo2_x_kmh_170" readonly/></td>
					</tr>
				</tbody>
			</table>
            </div><!-- form-group -->
		</div><!--form-group-->
    </fieldset>
</div><!-- form-group-->
</form>
</div><!--box-content-->

<script>
    document.addEventListener("DOMContentLoaded", function() {

        // Função para calcular a FC máxima
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

        // Função para calcular a velocidade máxima
        function calcularVelocidadeMaxima() {
            let velocidadeMax = 0;
            let velocidades = {
                4: 6, 5: 7, 6: 8, 7: 9, 8: 10,
                9: 11, 10: 12, 11: 13, 12: 14,
                13: 15, 14: 16, 15: 17, 16: 18
            };
            
            // Loop por todos os campos de FC e calcula a velocidade correspondente
            document.querySelectorAll("input[name^='fc-t']").forEach(function(input, index) {
                let valor = parseFloat(input.value);
                let estagio = index + 1;
                if (!isNaN(valor) && velocidades[estagio] && velocidades[estagio] > velocidadeMax) {
                    velocidadeMax = velocidades[estagio];
                }
            });

            document.querySelector("input[name='velocidade-max']").value = velocidadeMax || '';
        }

        // Função para calcular os limiares 1 e 2
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

			document.querySelectorAll("td[id='']").forEach(function(td, index) {
			let velocidade = td.innerText.trim(); // Captura o texto da célula
			if (velocidade.endsWith("KM/H")) {
				let valorVelocidade = parseFloat(velocidade); // Converte para número
				if (!isNaN(valorVelocidade)) {
					cargas.push(valorVelocidade); // Adiciona ao array de cargas
				}
			}
    		});

            // Lógica simplificada para encontrar os limiares
            let limiar1 = encontrarLimiar1(cargas, frequencias);
            let limiar2 = encontrarLimiar2(cargas, frequencias);

            // Atualiza os campos de limiar
            document.getElementById('limiar1').value = limiar1;
            document.getElementById('limiar2').value = limiar2;
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
            calcularVelocidadeMaxima();
            calcularLimiar(); // Chama a função para calcular os limiares
            buscaPesoUsuario(usuario_id); // Use usuario_id agora
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
            var indiceFC = parseFloat(document.getElementById('indice-fc').value);
            if (!isNaN(indiceFC)) {
                var mets = (6 * indiceFC) - 5;
                document.getElementById('mets').value = mets.toFixed(2);
            } else {
                document.getElementById('mets').value = '';
            }
        }

        // Função para calcular o VO2 máximo (ml/kg/min)
        function calculaVo2MaxMl() {
            var mets = parseFloat(document.getElementById('mets').value);
            if (!isNaN(mets)) {
                var vo2MaxMl = mets * 3.5;
                document.getElementById('vo2-max-ml').value = vo2MaxMl.toFixed(2);
            } else {
                document.getElementById('vo2-max-ml').value = '';
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

        // Função geral para calcular
        function calcula() {
            calculaIndiceFC();
            calculaMets();
            calculaVo2MaxMl();
            buscaPesoUsuario(usuario_id); // Use usuario_id agora
        }

        // Monitora as mudanças nos campos de entrada
        var camposParaMonitorar = ['fc-repouso', 'fc-max'];
        camposParaMonitorar.forEach(function(id) {
            document.getElementById(id).addEventListener('input', calcula);
        });

        function buscaPesoUsuario(usuario_id) {
            if (peso) { // Certifique-se de que a variável peso é acessível aqui
                calculaVo2MaxL(peso); // Chame sua função com o peso
            } else {
                console.error('Peso não encontrado ou inválido');
                document.getElementById('vo2-max-l').value = '';
            }
        }
    });
</script>
