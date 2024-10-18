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
        $_SESSION['etapa'] = 3;
    }
    echo "<script>
    // Função para calcular a média de um grupo de valores
function calcularMedia(grupo) {
    // Obtém os valores dos três inputs e converte para número (ou 0 se vazio)
    const valor1 = parseFloat(document.getElementById(grupo + '-1').value) || 0;
    const valor2 = parseFloat(document.getElementById(grupo + '-2').value) || 0;
    const valor3 = parseFloat(document.getElementById(grupo + '-3').value) || 0;
    // Calcula a média dos três valores
    const media = (valor1 + valor2 + valor3) / 3;
    // Atualiza o campo de média do grupo
    document.getElementById(grupo + '-m').value = media.toFixed(2);
    // Atualiza os somatórios
    calcularSomatorio();           // Somatório geral de todas as médias
    calcularSomatorioGuedes3d();   // Somatório específico para Guedes 3D
    calcularSomatorioPollock3d();  // Somatório específico para Pollock 3D
    calcularSomatorioPollock7d();  // Somatório específico para Pollock 3D
}
// Função para calcular o somatório de todas as médias
function calcularSomatorio() {
    const grupos = ['tricipital', 'subescapular', 'suprailiaca', 'abdominal', 'supraespinhal', 'coxa-guedes', 'coxa-pollock', 'panturrilha', 'peitoral', 'axilar-media', 'biceps'];
    let somatorio = 0;
    // Percorre cada grupo, soma as médias e atualiza o campo somatório geral
    grupos.forEach(grupo => {
        const media = parseFloat(document.getElementById(grupo + '-m').value) || 0;
        somatorio += media;
    });
    document.getElementById('somatorio').value = somatorio.toFixed(2);
}
// Função para calcular o somatório específico de Guedes 3D
function calcularSomatorioGuedes3d() {
    const gruposGuedes = ['subescapular', 'suprailiaca', 'coxa-guedes'];
    let somatorio = 0;
    // Soma as médias dos grupos Guedes e atualiza o campo somatório de Guedes 3D
    gruposGuedes.forEach(grupo => {
        const media = parseFloat(document.getElementById(grupo + '-m').value) || 0;
        somatorio += media;
    });
    document.getElementById('somatorio-guedes-3D').value = somatorio.toFixed(2);
}
// Função para calcular o somatório específico de Pollock 3D
function calcularSomatorioPollock3d() {
    const gruposPollock3d = ['abdominal', 'coxa-pollock', 'peitoral'];
    let somatorio = 0;
    // Soma as médias dos grupos Pollock 3D e atualiza o campo somatório
    gruposPollock3d.forEach(grupo => {
        const media = parseFloat(document.getElementById(grupo + '-m').value) || 0;
        somatorio += media;
    });
    document.getElementById('somatorio-pollock-3D').value = somatorio.toFixed(2);
}
// Função para calcular o somatório específico de Pollock 7D
function calcularSomatorioPollock7d() {
    const gruposPollock7d = ['tricipital', 'subescapular', 'suprailiaca', 'abdominal', 'coxa-pollock', 'peitoral', 'axilar-media'];
    let somatorio = 0;
    // Soma as médias dos grupos Pollock 7D e atualiza o campo somatório
    gruposPollock7d.forEach(grupo => {
        const media = parseFloat(document.getElementById(grupo + '-m').value) || 0;
        somatorio += media;
    });
    document.getElementById('somatorio-pollock-7D').value = somatorio.toFixed(2);
}
</script>";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medidas = new MedidasCorporais();
    $dadosMedidas = [
        'punho_direito' => $_POST['punho-direito'],
        'ante_braco_direito' => $_POST['ante-braco-direito'],
        'braco_direito_relaxado' => $_POST['braco-direito-relaxado'],
        'braco_direito_contraido' => $_POST['braco-direito-contraido'],
        'punho_esquerdo' => $_POST['punho-esquerdo'],
        'ante_braco_esquerdo' => $_POST['ante-braco-esquerdo'],
        'braco_esquerdo_relaxado' => $_POST['braco-esquerdo-relaxado'],
        'braco_esquerdo_contraido' => $_POST['braco-esquerdo-contraido'],
        'pescoco' => $_POST['pescoco'],
        'torax' => $_POST['torax'],
        'cintura' => $_POST['cintura'],
        'abdomen' => $_POST['abdome'],
        'quadril' => $_POST['quadril'],
        'coxa_medial_direita' => $_POST['coxa-medial-direita'],
        'coxa_medial_esquerda' => $_POST['coxa-medial-esquerda'],
        'panturrilha_direita' => $_POST['panturrilha-direita'],
        'panturrilha_esquerda' => $_POST['panturrilha-esquerda'],
        'tricipital' => $_POST['tricipital'],
        'subescapular' => $_POST['subescapular'],
        'suprailiaca' => $_POST['suprailiaca'],
        'abdominal' => $_POST['abdominal'],
        'supraespinhal' => $_POST['supraespinhal'],
        'coxa_guedes' => $_POST['coxa-guedes'],
        'coxa_pollock' => $_POST['coxa-pollock'],
        'peitoral' => $_POST['peitoral'],
        'axilar_media' => $_POST['axilar-media'],
        'biceps' => $_POST['biceps'],
        'somatorio' => $_POST['somatorio'],
        'somatorio_pollock_3D' => $_POST['somatorio-pollock-3D'],
        'somatorio_pollock_7D' => $_POST['somatorio-pollock-7D'],
        'somatorio_guedes_3D' => $_POST['somatorio-guedes-3D'],
        'biestiloide' => $_POST['biestiloide'],
        'biepicondiliano' => $_POST['biepicondiliano'],
        'bicondiliano' => $_POST['bicondiliano'],
        'bimaleolar' => $_POST['bimaleolar']
    ];

    $dataAvaliacao = date('Y-m-d'); // Data da avaliação atual

    if ($medidas->gravarMedidas($usuario_id, $dadosMedidas, $dataAvaliacao)) {
        Painel::alert('sucesso', 'Dados gravados com sucesso!');
        $_SESSION['etapa'] = 4;

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
                                    window.location.href='" . INCLUDE_PATH_PAINEL . 'aptidao-cardiorespiratoria' . "?id=" . $usuario_id . "';
                                }
                            }, 1000);
                        </script>";
                        exit();
    } else {
        Painel::alert('erro', 'Erro ao gravar dados.');
        echo "";
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
<h2><i class="fa fa-pencil" aria-hidden="true"></i>Medida corporal</h2>
    <form method="post">  
        <!-- Formulário de Antropometria -->
        <div class="form-group left w50">
            <fieldset>
                <legend>Antropometria</legend>
                    <div class="form-group-antropometria">
                        <label>Punho Direito</label>
                        <input type="text" name="punho-direito"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Ante-braço Direito</label>
                        <input type="text" name="ante-braco-direito"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Braço DIR relaxado</label>
                        <input type="text" name="braco-direito-relaxado"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Braço DIR Contraído</label>
                        <input type="text" name="braco-direito-contraido"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Punho Esquerdo</label>
                        <input type="text" name="punho-esquerdo"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Ante-braço Esquerdo</label>
                        <input type="text" name="ante-braco-esquerdo"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Braço ESQ relaxado</label>
                        <input type="text" name="braco-esquerdo-relaxado"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Braço ESQ Contraído</label>
                        <input type="text" name="braco-esquerdo-contraido"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Pescoço</label>
                        <input type="text" name="pescoco"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Tórax</label>
                        <input type="text" name="torax"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Cintura </label>
                        <input type="text" name="cintura"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Abdômen</label>
                        <input type="text" name="abdome"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Quadril</label>
                        <input type="text" name="quadril"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Coxa Medial Direita</label>
                        <input type="text" name="coxa-medial-direita"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Coxa Medial Esquerda</label>
                        <input type="text" name="coxa-medial-esquerda"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Panturrilha Direita</label>
                        <input type="text" name="panturrilha-direita"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Panturrilha Esquerda</label>
                        <input type="text" name="panturrilha-esquerda"/>
                    </div><!-- form-group -->
                </fieldset>
            </div><!-- form-group left w50 -->
        <div class="form-group w50 right center video-tutorial">
            <img src="<?php echo INCLUDE_PATH;?>images/avatar_medidas_pt.png?>" alt="Foto do Usuário" class="">
            <iframe width="560" height="315" src="https://www.youtube.com/embed/48lYW2DUo0I?si=TGwF67vqrxLGqpYd" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
            <iframe width="560" height="315" src="https://www.youtube.com/embed/Ef14WYaxTXQ?si=b_YJdeXv3OlzFHVy" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" allowfullscreen></iframe>
        </div>
        <div class="clear"></div><!-- clear -->  
        <div class="form-group">
            <fieldset>
                <legend>Composição corporal</legend>
                    <div class="form-group-antropometria">
                        <label>Tricipital</label>
                        <input type="text" name="tricipital" id="tricipital-m" placeholder="média" readonly />
                        <input type="number" id="tricipital-1" placeholder="valor 1" oninput="calcularMedia('tricipital')" />
                        <input type="number" id="tricipital-2" placeholder="valor 2" oninput="calcularMedia('tricipital')" />
                        <input type="number" id="tricipital-3" placeholder="valor 3" oninput="calcularMedia('tricipital')" />
                    </div>
                    <div class="form-group-antropometria">
                        <label>Subescapular</label>
                        <input type="number"  name="subescapular" id="subescapular-m" readonly/>
                        <input type="number" id="subescapular-1" oninput="calcularMedia('subescapular')"/>
                        <input type="number" id="subescapular-2" oninput="calcularMedia('subescapular')"/>
                        <input type="number" id="subescapular-3" oninput="calcularMedia('subescapular')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Suprailíaca</label>
                        <input type="number" name="suprailiaca" id="suprailiaca-m" readonly/>
                        <input type="number" id="suprailiaca-1" oninput="calcularMedia('suprailiaca')"/>
                        <input type="number" id="suprailiaca-2" oninput="calcularMedia('suprailiaca')"/>
                        <input type="number" id="suprailiaca-3" oninput="calcularMedia('suprailiaca')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Abdominal</label>
                        <input type="number" name="abdominal" id="abdominal-m" readonly/>
                        <input type="number" id="abdominal-1" oninput="calcularMedia('abdominal')"/>
                        <input type="number" id="abdominal-2" oninput="calcularMedia('abdominal')"/>
                        <input type="number" id="abdominal-3" oninput="calcularMedia('abdominal')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Supraespinhal</label>
                        <input type="number" name="supraespinhal" id="supraespinhal-m" readonly/>
                        <input type="number" id="supraespinhal-1" oninput="calcularMedia('supraespinhal')"/>
                        <input type="number" id="supraespinhal-2" oninput="calcularMedia('supraespinhal')"/>
                        <input type="number" id="supraespinhal-3" oninput="calcularMedia('supraespinhal')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Coxa Guedes</label>
                        <input type="number" name="coxa-guedes" id="coxa-guedes-m" readonly/>
                        <input type="number" id="coxa-guedes-1" oninput="calcularMedia('coxa-guedes')"/>
                        <input type="number" id="coxa-guedes-2" oninput="calcularMedia('coxa-guedes')"/>
                        <input type="number" id="coxa-guedes-3" oninput="calcularMedia('coxa-guedes')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Coxa Pollock</label>
                        <input type="number" name="coxa-pollock" id="coxa-pollock-m" readonly/>
                        <input type="number" id="coxa-pollock-1" oninput="calcularMedia('coxa-pollock')"/>
                        <input type="number" id="coxa-pollock-2" oninput="calcularMedia('coxa-pollock')"/>
                        <input type="number" id="coxa-pollock-3" oninput="calcularMedia('coxa-pollock')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Panturrilha</label>
                        <input type="number" name="panturrilha" id="panturrilha-m" readonly/>
                        <input type="number" id="panturrilha-1" oninput="calcularMedia('panturrilha')"/>
                        <input type="number" id="panturrilha-2" oninput="calcularMedia('panturrilha')"/>
                        <input type="number" id="panturrilha-3" oninput="calcularMedia('panturrilha')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Peitoral</label>
                        <input type="number" name="peitoral" id="peitoral-m" readonly/>
                        <input type="number" id="peitoral-1" oninput="calcularMedia('peitoral')"/>
                        <input type="number" id="peitoral-2" oninput="calcularMedia('peitoral')"/>
                        <input type="number" id="peitoral-3" oninput="calcularMedia('peitoral')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Axilar Média</label>
                        <input type="number" name="axilar-media" id="axilar-media-m" readonly/>
                        <input type="number" id="axilar-media-1" oninput="calcularMedia('axilar-media')"/>
                        <input type="number" id="axilar-media-2" oninput="calcularMedia('axilar-media')"/>
                        <input type="number" id="axilar-media-3" oninput="calcularMedia('axilar-media')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria">
                        <label>Biceps</label>
                        <input type="number" name="biceps" id="biceps-m" readonly/>
                        <input type="number" id="biceps-1" oninput="calcularMedia('biceps')"/>
                        <input type="number" id="biceps-2" oninput="calcularMedia('biceps')"/>
                        <input type="number" id="biceps-3" oninput="calcularMedia('biceps')"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria left w50">
                        <label>SOMATÓRIO</label>
                        <input type="number" name="somatorio" id="somatorio" readonly oninput="calcularSomatorio()"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria right w50">
                        <label>SOMATÓRIO Pollock 3D</label>
                        <input type="number" name="somatorio-pollock-3D" id="somatorio-pollock-3D" readonly readonly oninput="calcularSomatorioPollock3d()"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria left w50">
                        <label>SOMATÓRIO Pollock 7D</label>
                        <input type="number" name="somatorio-pollock-7D" id="somatorio-pollock-7D" readonly oninput="calcularSomatorioPollock7d()"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria right w50">
                        <label>SOMATÓRIO Guedes 3D</label>
                        <input type="number" name="somatorio-guedes-3D" id="somatorio-guedes-3D" readonly oninput="calcularSomatorioGuedes3d()"/>
                    </div><!-- form-group -->
                    <div class="clear"></div><!-- clear -->    
                    <div class="form-group-antropometria left w50">
                        <label>Biestilóide</label>
                        <input type="number" name="biestiloide"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria right w50">
                        <label>Biepicondiliano</label>
                        <input type="number" name="biepicondiliano"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria left w50">
                        <label>Bicondiliano</label>
                        <input type="number" name="bicondiliano"/>
                    </div><!-- form-group -->
                    <div class="form-group-antropometria right w50">
                        <label>Bimaleolar</label>
                        <input type="number" name="bimaleolar"/>
                    </div><!-- form-group -->
            </fieldset>
        </div><!-- form-group right w50 -->
    <div class="clear"></div><!-- clear -->           
    <div class="form-group">
        <input type="submit" name="acao" value="Enviar"/>
    </div><!-- form-group -->
    </form>
</div><!-- box-content -->


