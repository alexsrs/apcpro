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
    
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $medidas = new MedidaCorporal();
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
        'panturrilha_esquerda' => $_POST['panturrilha-esquerda']
    ];

    $dataAvaliacao = (new DateTime())->format('Y-m-d H:i:s');

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
                                    window.location.href='" . INCLUDE_PATH_PAINEL . 'composicao-corporal' . "?id=" . $usuario_id . "';
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
        </div>
        <div class="clear"></div><!-- clear -->          
    <div class="form-group">
        <input type="submit" name="acao" value="Enviar"/>
    </div><!-- form-group -->
    </form>
</div><!-- box-content -->


