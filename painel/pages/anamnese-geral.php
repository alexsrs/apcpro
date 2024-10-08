<div class="box-content">
<h2><i class="fa fa-pencil" aria-hidden="true"></i>ANAMNESE INTELIGENTE PARA HOMENS E MULHERES [ADULTOS]</h2>
<?php
     verificaPermissaoPagina(0);
     include_once('pages/funcoes.php');
     // Obtém o usuario_id da sessão
     $usuario_id = $_SESSION['id'];
?>

<form method="post">   
        <?php
            
            if (isset($_POST['acao'])) {
                
                
            }
        ?>
        <!-- Perguntas adicionais -->
        <p>Responda as perguntas para aplicação da ANAMNESE INTELIGENTE de forma mais
rápida, prática e com maior possibilidade de prescrição de um programa de treinamento individualizado.</p>

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
                <legend>Atividade Física</legend>
                    <label for="exercicios">Quais são os tipos de exercícios físicos que você gosta?</label>
                        <label class="switch-label" for="musculacao">
                            <input type="checkbox" id="musculacao" name="exercicios[]" value="musculacao">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Musculação</span>
                        </label>
                        <label class="switch-label" for="peso_corpo">
                            <input type="checkbox" id="peso_corpo" name="exercicios[]" value="peso_corpo">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Treino com peso do corpo</span>
                        </label>
                        <label class="switch-label" for="esteira">
                            <input type="checkbox" id="esteira" name="exercicios[]" value="esteira">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Esteira</span>
                        </label>
                        <label class="switch-label" for="bike">
                            <input type="checkbox" id="bike" name="exercicios[]" value="bike">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Bike</span>
                        </label>
                        <label class="switch-label" for="natacao">
                            <input type="checkbox" id="natacao" name="exercicios[]" value="natacao">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Natação</span>
                        </label>
                        <label class="switch-label" for="lutas">
                            <input type="checkbox" id="lutas" name="exercicios[]" value="lutas">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Lutas</span>
                        </label>
                        <label class="switch-label" for="combolas">
                            <input type="checkbox" id="combolas" name="exercicios[]" value="combolas">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Esportes com bolas</span>
                        </label>
                        <label class="switch-label" for="outros">
                            <input type="checkbox" id="outros" name="exercicios[]" value="outros">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Outros</span>
                        </label>
                        <input type="text" name="outros_exercicios" placeholder="Descreva se houver outros" style="flex-grow: 1;">
                        <br><br>
                        <label>Existe alguma coisa que você NÃO GOSTA de fazer durante a prática
                        do exercício?</label>
                        <label class="switch-label" for="nao-gosta">
                            <input type="checkbox" id="nao-gosta" name="nao-gosta" value="1">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Sim</span>
                        </label>
                        <input type="text" name="nao-gosta-exercicios" placeholder="Descreva os exercícios que não gosta" style="flex-grow: 1;">
                        <br><br>
                        <label>Nos últimos 3 meses, você estava praticando algum tipo de exercício
                        físico?</label>
                        <label class="switch-label" for="atividade-recente">
                            <input type="checkbox" id="atividade-recente" name="atividade-recente" value="1">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Sim</span>
                        </label>
                        <input type="text" name="nao-gosta-exercicios" placeholder="Descreva o tipo de exercício que estava praticando" style="flex-grow: 1;">
                        
                        <div class="form-group left w50">
                            <label>Quantas vezes por semana estava praticando?</label>
                            <input type="text" name="dias-semana" style="flex-grow: 1;">
                            <label>Quantas horas por dia estava praticando?</label>
                            <input type="text" name="horas-dia" style="flex-grow: 1;">
                        </div>
                        <div class="form-group right w50">
                            <label>Intensidade:</label>
                            <select name="intensidade">
                                <?php 
                                    foreach (Painel::$intensidade as $key => $value){
                                        echo '<option value="'.$key.'">'.$value.'</option>';
                                    }
                                ?>
                            </select>
                        </div><!-- form-group -->
            </fieldset>
        </div><!--form-group w100-->

        <div class="form-group">
            <fieldset>
                <legend>Dados médicos</legend>
                    
                        <label class="switch-label" for="peso_corpo">
                            <input type="checkbox" id="peso_corpo" name="exercicios[]" value="peso_corpo">
                            <span class="slider-switch round"></span>
                            <span class="slider-text">Treino com peso do corpo</span>
                        </label>
                        
            </fieldset>
        </div><!--form-group w100-->




    <div class="clear"></div><!-- clear -->
    
    

    <div class="form-group">
        <input type="submit" name="acao" value="Enviar"/>
    </div><!-- form-group -->
    </form>
</div><!-- box-content -->