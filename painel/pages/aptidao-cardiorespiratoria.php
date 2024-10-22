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
                <p>O Teste de Conconi é uma ferramenta utilizada por atletas e profissionais de educação física para avaliar a capacidade aeróbica de um indivíduo. Esse teste foi desenvolvido pelo fisiologista italiano Francesco Conconi e consiste em uma avaliação progressiva da frequência cardíaca em relação à intensidade do exercício.</p>
                
            </div><!-- form-group -->
            <div class="form-group">
                <p>Para realizar o Teste de Conconi, o atleta é submetido a um protocolo de exercício em esteira ou bicicleta ergométrica, no qual a intensidade do esforço é aumentada a cada estágio. Durante o teste, a frequência cardíaca do atleta é monitorada continuamente, geralmente por meio de um monitor cardíaco, para que se possa avaliar a relação entre a intensidade do exercício e a resposta do coração.</p>
            </div><!-- form-group -->
        </div>
        <div class="form-group w50 right">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/WcIOGgW6y9E?si=nA2j7oXxDptY9x63" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
		<div class="clear"></div><!-- clear -->
		
		<div class="form-group w50 left">
					<div class="form-group-antropometria">
                        <label style="text-align: right;">FC de repouso: </label>
                        <input type="text" name="fc-repouso"/>
                    </div><!-- form-group -->
			<div class="form-group-antropometria">
				<table id="conconiTable" class="display dt-responsive">
					<tr>
						<td><b>ESTÁGIO</b></td>
						<td><b>TEMPO</b></td>
						<td><b>VELOCIDADE (KM/H)</b></td>
						<td><b>FC (BPM)</b></td>
						<td><b>PSE</b></td>
					</tr>
					<tr>
						<td rowspan=3 height="auto" align="center" valign=middle><b>AQUECIMENTO</b></td>
						<td align="center" valign=bottom><b>1</b></td>
						<td align="center" valign=bottom><b>5</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t1"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t1"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>2</b></td>
						<td align="center" valign=bottom><b>5</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t2"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t2"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>3</b></td>
						<td align="center" valign=bottom><b>5</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t3"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t3"/></td>
					</tr>
					<tr>
						<td rowspan=13 height="auto" align="center" valign=middle><b>ESFORÇO</b></td>
						<td align="center" valign=bottom><b>4</b></td>
						<td align="center" valign=bottom><b>6</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t4"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t4"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>5</b></td>
						<td align="center" valign=bottom><b>7</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t5"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t5"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>6</b></td>
						<td align="center" valign=bottom><b>8</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t6"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t6"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>7</b></td>
						<td align="center" valign=bottom><b>9</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t7"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t7"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>8</b></td>
						<td align="center" valign=bottom><b>10</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t8"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t8"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>9</b></td>
						<td align="center" valign=bottom><b>11</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t9"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t9"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>10</b></td>
						<td align="center" valign=bottom><b>12</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t10"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t10"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>11</b></td>
						<td align="center" valign=bottom><b>13</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t11"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t11"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>12</b></td>
						<td align="center" valign=bottom><b>14</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t12"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t12"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>13</b></td>
						<td align="center" valign=bottom><b>15</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t13"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t13"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>14</b></td>
						<td align="center" valign=bottom><b>16</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t14"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t14"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>15</b></td>
						<td align="center" valign=bottom><b>17</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t15"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t15"/></td>
					</tr>
					<tr>
						<td align="center" valign=bottom><b>16</b></td>
						<td align="center" valign=bottom><b>18</b></td>
						<td align="center" valign=bottom><br><input type="text" name="fc-t16"/></td>
						<td align="center" valign=bottom><br><input type="text" name="pse-t16"/></td>
					</tr>
				</table>
			</div>
		</div>

		<div class="form-group-antropometria w50 right">
		<table class="table-corconi" cellspacing="0" border="0">
	<colgroup width="252"></colgroup>
	<colgroup width="154"></colgroup>
	<colgroup width="28"></colgroup>
	<colgroup span="2" width="107"></colgroup>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;FCmáx do teste&quot;}"><b><font face="Calibri" size=3 color="#000000">FCmáx do teste</font></b></td>
		<td align="center" valign=bottom bgcolor="#C3D69B" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;%iVO2máx&quot;}"><b><font face="Calibri" color="#000000">%iVO2máx</font></b></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;KM\/H&quot;}"><b><font face="Calibri" color="#000000">KM/H</font></b></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;Velocidade máxima do teste&quot;}"><b><font face="Calibri" size=3 color="#000000">Velocidade máxima do teste</font></b></td>
		<td align="center" valign=bottom bgcolor="#C3D69B" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="30" sdnum="1046;">30</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;PSE máxima do teste&quot;}"><b><font face="Calibri" size=3 color="#000000">PSE máxima do teste</font></b></td>
		<td align="center" valign=bottom bgcolor="#C3D69B" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="35" sdnum="1046;">35</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;iVO2máx&quot;}"><b><font face="Calibri" size=3 color="#000000">iVO2máx</font></b></td>
		<td align="center" valign=bottom bgcolor="#C3D69B" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="40" sdnum="1046;">40</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;FC repouso&quot;}"><b><font face="Calibri" size=3 color="#000000">FC repouso</font></b></td>
		<td align="center" valign=bottom bgcolor="#C3D69B" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="45" sdnum="1046;">45</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;Índice de FC&quot;}"><b><font face="Calibri" size=3 color="#000000">Índice de FC</font></b></td>
		<td align="center" valign=bottom bgcolor="#FF3300" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><font face="Calibri"><br></font></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="50" sdnum="1046;">50</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;METs&quot;}"><b><font face="Calibri" size=3 color="#000000">METs</font></b></td>
		<td align="center" valign=bottom bgcolor="#FF3300" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="55" sdnum="1046;">55</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;VO2máx (ml.kg.min)&quot;}"><b><font face="Calibri" size=3 color="#000000">VO2máx (ml.kg.min)</font></b></td>
		<td align="center" valign=bottom bgcolor="#FF3300" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="60" sdnum="1046;">60</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;VO2máx (L.min)&quot;}"><b><font face="Calibri" size=3 color="#000000">VO2máx (L.min)</font></b></td>
		<td align="center" valign=bottom bgcolor="#FF3300" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="65" sdnum="1046;">65</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;FC L1&quot;}"><b><font face="Calibri" size=3 color="#000000">FC L1</font></b></td>
		<td align="center" valign=bottom bgcolor="#C3D69B" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="70" sdnum="1046;">70</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;FC L1 (% FC máx do teste)&quot;}"><b><font face="Calibri" size=3 color="#000000">FC L1 (% FC máx do teste)</font></b></td>
		<td align="center" valign=bottom bgcolor="#FF3300" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="75" sdnum="1046;">75</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;FC L2&quot;}"><b><font face="Calibri" size=3 color="#000000">FC L2</font></b></td>
		<td align="center" valign=bottom bgcolor="#C3D69B" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="80" sdnum="1046;">80</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="25" align="center" valign=bottom bgcolor="#95B3D7" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;FC L2 (% FC máx do teste)&quot;}"><b><font face="Calibri" size=3 color="#000000">FC L2 (% FC máx do teste)</font></b></td>
		<td align="center" valign=bottom bgcolor="#FF3300" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="85" sdnum="1046;">85</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="90" sdnum="1046;">90</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="95" sdnum="1046;">95</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdnum="1046;0;0,00" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FF0000" sdval="100" sdnum="1046;">100</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#C3D69B" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="105" sdnum="1046;">105</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="110" sdnum="1046;">110</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="115" sdnum="1046;">115</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="120" sdnum="1046;">120</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="125" sdnum="1046;">125</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="130" sdnum="1046;">130</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="135" sdnum="1046;">135</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="140" sdnum="1046;">140</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="145" sdnum="1046;">145</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="150" sdnum="1046;">150</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="155" sdnum="1046;">155</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="160" sdnum="1046;">160</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="165" sdnum="1046;">165</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
	<tr>
		<td height="21" align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td align="left" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" sdval="170" sdnum="1046;">170</td>
		<td style="border-top: 1px solid #000000; border-bottom: 1px solid #000000; border-left: 1px solid #000000; border-right: 1px solid #000000" align="center" valign=bottom bgcolor="#FFFFFF" data-sheets-value="{ &quot;1&quot;: 2, &quot;2&quot;: &quot;&quot;}"><br></td>
	</tr>
</table>	

		</div>


    </fieldset>
</div><!-- form-group-->
</form>


</div><!--box-content-->