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
							<td align="center" valign=middle><b>5 KM/H</b></td>
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

		<div class="form-group left w33" style="padding: 0 0 0 100px; max-width: 45%;">	
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
                		<td align="center" valign=middle><input type="text" name="fc-repouso" id="fc-repouso" oninput="calcula()"/></td>
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
						<td align="center" valign=middle><input type="text" name="vo2-max-ml" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>VO² máxima (L. min):</b></td>
						<td align="center" valign=middle><input type="text" name="vo2-max-l" readonly/></td>
					</tr>

					<tr>
						<td align="center" valign=middle><b>FC L1:</b></td>
						<td align="center" valign=middle><input type="text" name="fc-l1" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L1 (% FC máxima)</b></td>
						<td align="center" valign=middle><input type="text" name="fc-l1-percent" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L2:</b></td>
						<td align="center" valign=middle><input type="text" name="fc-l2" readonly/></td>
					</tr>
					<tr>
						<td align="center" valign=middle><b>FC L2 (% FC máxima)</b></td>
						<td align="center" valign=middle><input type="text" name="fc-l2-percent" readonly/></td>
					</tr>


					
				</tbody>
			</table>
            </div><!-- form-group -->
		</div><!--form-group-->

		<div class="form-group center w33" style="padding: 0 100px 0 100px; max-width: 45%;">	
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

		

        // Função para recalcular todos os resultados
        function recalcularResultados() {
            calcularFCMaxima();
            calcularPSEMaxima();
            calcularVelocidadeMaxima();
        }

        // Atribui a função de recalcular resultados sempre que o usuário preencher um campo de FC ou PSE
        document.querySelectorAll("input[name^='fc-t'], input[name^='pse-t']").forEach(function(input) {
            input.addEventListener("input", recalcularResultados);
        });
    });

	function calculaIndiceFC() {
			// Obter os valores dos campos de FC de repouso e velocidade máxima
			var fcRepouso = parseFloat(document.getElementById('fc-repouso').value);
			var fcMax = parseFloat(document.getElementById('fc-max').value);

			// Verifica se os valores são números válidos
			if (!isNaN(fcRepouso) && !isNaN(fcMax) && fcRepouso > 0) {
				// Calcula o índice de FC
				var indiceFC = fcMax / fcRepouso;
				
				// Atualiza o campo de índice de FC
				document.getElementById('indice-fc').value = indiceFC.toFixed(2);
			} else {
				// Limpa o campo se os valores não forem válidos
				document.getElementById('indice-fc').value = '';
			}
		}

		function calculaMets() {
			// Obter os valores dos campos de FC de repouso e velocidade máxima
			var indiceFc = parseFloat(document.getElementById('indice-fc').value);
			
			// Verifica se os valores são números válidos
			if (!isNaN(indiceFC) && fcRepouso > 0) {
				// Calcula o índice de FC
				var mets = (6 * indiceFc)-5;
				
				// Atualiza o campo de índice de FC
				document.getElementById('mets').value = mets.toFixed(2);
			} else {
				// Limpa o campo se os valores não forem válidos
				document.getElementById('mets').value = '';
			}
		}

		function calcula() {
			calculaIndiceFC();
			calculaMets();
		}
</script>