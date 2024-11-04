CREATE TABLE tb_exercicios_lib (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    data_avaliacao DATETIME NOT NULL,
    categoria_id INT NOT NULL,
    nome_exercicio VARCHAR(255) NOT NULL,
    articulacao VARCHAR(255) NOT NULL,
    membro VARCHAR(255) NOT NULL,
    grupo_muscular VARCHAR(255) NOT NULL,
    aplicacao_forca VARCHAR(255) NOT NULL,
    movimento VARCHAR(255) NOT NULL,
    video VARCHAR(255) NOT NULL,
    contra_indicacoes VARCHAR(255) NOT NULL,
    indicacoes VARCHAR(255) NOT NULL,
    mets_consumo_energetico float NOT NULL,
    nivel_dificuldade VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tb_categoria_exercicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    categoria VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tb_composicoes_corporais (
id INT AUTO_INCREMENT PRIMARY KEY,
usuario_id INT NOT NULL,
tricipital float,
subescapular float,
suprailiaca	float,
abdominal float,			
supraespinhal float,			
coxa_guedes	float,			
coxa_pollock float,			
peitoral float,				
axilar_media float,				
biceps float,
somatorio float,
somatorio_pollock_3D float,
somatorio_pollock_7D float,
somatorio_guedes_3D	float,
biestiloide	float,
biepicondiliano	float,
bicondiliano float,
bimaleolar float,
data_avaliacao DATETIME NOT NULL
created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE tb_treino_serie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    aula_numero INT NOT NULL,
    descricao VARCHAR(255),
    zona_alvo VARCHAR(255),
    ativo BOOLEAN,
    metodo VARCHAR(255) NOT NULL,
    treino_exercicio_id INT NOT NULL,
    fc_maxima INT,
    fc_reposo INT,
    vo2_exame FLOAT,
    vo2_maximo FLOAT,
    tempo_recuperacao FLOAT,
    incremento_hiit FLOAT,
    incremento_miit FLOAT,
    macrociclo VARCHAR(255),
    mesociclo ENUM('introdutório', 'condicionante', 'competitivo', 'recuperativo'),
    microciclo INT,  -- Representando em semanas (1 a 6)
    fase INT,  -- Número da semana dentro do microciclo
    sessao INT,  -- Sessões por semana (1 a 3)
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tb_treino_exercicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    treino_serie_id INT NOT NULL, -- Vincula o exercício a uma série específica
    exercicio_id INT NOT NULL,
    carga_serie1 FLOAT,
    carga_serie2 FLOAT,
    carga_serie3 FLOAT,
    repeticoes_serie1 INT,
    repeticoes_serie2 INT,
    repeticoes_serie3 INT,
    pausa INT,
    concentrica INT,
    excentrica INT,
    recuperacao_entre_series INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE tb_treino_exercicio_series (
    id INT AUTO_INCREMENT PRIMARY KEY,
    treino_exercicio_id INT NOT NULL,
    numero_serie INT,  -- Número da série
    carga FLOAT,  -- Carga para a série específica
    repeticoes INT,  -- Número de repetições para a série específica
    FOREIGN KEY (treino_exercicio_id) REFERENCES tb_treino_exercicio(id) ON DELETE CASCADE
);

ALTER TABLE tb_usuarios_anamnese
ADD COLUMN `ciclo_menstrual` TINYINT(1) DEFAULT NULL,
ADD COLUMN `ciclo_menstrual_irregular` VARCHAR(255) DEFAULT NULL,
ADD COLUMN `sintomas_menstruais` JSON DEFAULT NULL,
ADD COLUMN `uso_anticoncepcional` VARCHAR(3) DEFAULT NULL,
ADD COLUMN `fatores_impedem_treino` JSON DEFAULT NULL,
ADD COLUMN `dificuldade_emagrecer` JSON DEFAULT NULL,

ADD COLUMN `remedios_emagrecer` TINYINT(1) DEFAULT NULL,
ADD COLUMN `autoestima` VARCHAR(255) DEFAULT NULL;
ADD COLUMN `silhueta_real` INT DEFAULT NULL,
ADD COLUMN `silhueta_ideal` INT DEFAULT NULL,
ADD COLUMN `objetivos_6_meses` JSON DEFAULT NULL,
ADD COLUMN `nome_remedios_emagrecer` VARCHAR(255) DEFAULT NULL,
ADD COLUMN `resultados_remedios` VARCHAR(255) DEFAULT NULL,
ADD COLUMN `dificuldade_emagrecer_outros` VARCHAR(255) DEFAULT NULL;






<div class="checkbox-wrapper-11">
  <input id="02-11" type="checkbox" name="r" value="2">
  <label for="02-11">To-do</label>
</div>

<style>
  .checkbox-wrapper-11 {
    --text: #414856;
    --check: #4F29F0;
    --disabled: #C3C8DE;
    --border-radius: 10px;
    border-radius: var(--border-radius);
    position: relative;
    padding: 5px;
    display: grid;
    grid-template-columns: 30px auto;
    align-items: center;
  }
  .checkbox-wrapper-11 label {
    color: var(--text);
    position: relative;
    cursor: pointer;
    display: grid;
    align-items: center;
    width: -webkit-fit-content;
    width: -moz-fit-content;
    width: fit-content;
    transition: color 0.3s ease;
  }
  .checkbox-wrapper-11 label::before,
  .checkbox-wrapper-11 label::after {
    content: "";
    position: absolute;
  }
  .checkbox-wrapper-11 label::before {
    height: 2px;
    width: 8px;
    left: -27px;
    background: var(--check);
    border-radius: 2px;
    transition: background 0.3s ease;
  }
  .checkbox-wrapper-11 label:after {
    height: 4px;
    width: 4px;
    top: 8px;
    left: -25px;
    border-radius: 50%;
  }
  .checkbox-wrapper-11 input[type=checkbox] {
    -webkit-appearance: none;
    -moz-appearance: none;
    position: relative;
    height: 15px;
    width: 15px;
    outline: none;
    border: 0;
    margin: 0 15px 0 0;
    cursor: pointer;
    background: var(--background);
    display: grid;
    align-items: center;
  }
  .checkbox-wrapper-11 input[type=checkbox]::before, .checkbox-wrapper-11 input[type=checkbox]::after {
    content: "";
    position: absolute;
    height: 2px;
    top: auto;
    background: var(--check);
    border-radius: 2px;
  }
  .checkbox-wrapper-11 input[type=checkbox]::before {
    width: 0px;
    right: 60%;
    transform-origin: right bottom;
  }
  .checkbox-wrapper-11 input[type=checkbox]::after {
    width: 0px;
    left: 40%;
    transform-origin: left bottom;
  }
  .checkbox-wrapper-11 input[type=checkbox]:checked::before {
    -webkit-animation: check-01-11 0.4s ease forwards;
            animation: check-01-11 0.4s ease forwards;
  }
  .checkbox-wrapper-11 input[type=checkbox]:checked::after {
    -webkit-animation: check-02-11 0.4s ease forwards;
            animation: check-02-11 0.4s ease forwards;
  }
  .checkbox-wrapper-11 input[type=checkbox]:checked + label {
    color: var(--disabled);
    -webkit-animation: move-11 0.3s ease 0.1s forwards;
            animation: move-11 0.3s ease 0.1s forwards;
  }
  .checkbox-wrapper-11 input[type=checkbox]:checked + label::before {
    background: var(--disabled);
    -webkit-animation: slice-11 0.4s ease forwards;
            animation: slice-11 0.4s ease forwards;
  }
  .checkbox-wrapper-11 input[type=checkbox]:checked + label::after {
    -webkit-animation: firework-11 0.5s ease forwards 0.1s;
            animation: firework-11 0.5s ease forwards 0.1s;
  }

  @-webkit-keyframes move-11 {
    50% {
      padding-left: 8px;
      padding-right: 0px;
    }
    100% {
      padding-right: 4px;
    }
  }

  @keyframes move-11 {
    50% {
      padding-left: 8px;
      padding-right: 0px;
    }
    100% {
      padding-right: 4px;
    }
  }
  @-webkit-keyframes slice-11 {
    60% {
      width: 100%;
      left: 4px;
    }
    100% {
      width: 100%;
      left: -2px;
      padding-left: 0;
    }
  }
  @keyframes slice-11 {
    60% {
      width: 100%;
      left: 4px;
    }
    100% {
      width: 100%;
      left: -2px;
      padding-left: 0;
    }
  }
  @-webkit-keyframes check-01-11 {
    0% {
      width: 4px;
      top: auto;
      transform: rotate(0);
    }
    50% {
      width: 0px;
      top: auto;
      transform: rotate(0);
    }
    51% {
      width: 0px;
      top: 8px;
      transform: rotate(45deg);
    }
    100% {
      width: 5px;
      top: 8px;
      transform: rotate(45deg);
    }
  }
  @keyframes check-01-11 {
    0% {
      width: 4px;
      top: auto;
      transform: rotate(0);
    }
    50% {
      width: 0px;
      top: auto;
      transform: rotate(0);
    }
    51% {
      width: 0px;
      top: 8px;
      transform: rotate(45deg);
    }
    100% {
      width: 5px;
      top: 8px;
      transform: rotate(45deg);
    }
  }
  @-webkit-keyframes check-02-11 {
    0% {
      width: 4px;
      top: auto;
      transform: rotate(0);
    }
    50% {
      width: 0px;
      top: auto;
      transform: rotate(0);
    }
    51% {
      width: 0px;
      top: 8px;
      transform: rotate(-45deg);
    }
    100% {
      width: 10px;
      top: 8px;
      transform: rotate(-45deg);
    }
  }
  @keyframes check-02-11 {
    0% {
      width: 4px;
      top: auto;
      transform: rotate(0);
    }
    50% {
      width: 0px;
      top: auto;
      transform: rotate(0);
    }
    51% {
      width: 0px;
      top: 8px;
      transform: rotate(-45deg);
    }
    100% {
      width: 10px;
      top: 8px;
      transform: rotate(-45deg);
    }
  }
  @-webkit-keyframes firework-11 {
    0% {
      opacity: 1;
      box-shadow: 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0;
    }
    30% {
      opacity: 1;
    }
    100% {
      opacity: 0;
      box-shadow: 0 -15px 0 0px #4F29F0, 14px -8px 0 0px #4F29F0, 14px 8px 0 0px #4F29F0, 0 15px 0 0px #4F29F0, -14px 8px 0 0px #4F29F0, -14px -8px 0 0px #4F29F0;
    }
  }
  @keyframes firework-11 {
    0% {
      opacity: 1;
      box-shadow: 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0, 0 0 0 -2px #4F29F0;
    }
    30% {
      opacity: 1;
    }
    100% {
      opacity: 0;
      box-shadow: 0 -15px 0 0px #4F29F0, 14px -8px 0 0px #4F29F0, 14px 8px 0 0px #4F29F0, 0 15px 0 0px #4F29F0, -14px 8px 0 0px #4F29F0, -14px -8px 0 0px #4F29F0;
    }
  }
</style>

