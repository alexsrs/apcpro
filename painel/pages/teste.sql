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


CREATE TABLE tb_treino_serie (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    aula_numero INT NOT NULL,
    metodo VARCHAR(255) NOT NULL,
    treino_exercicio_id INT NOT NULL,
    tempo_recuperacao float,
    macrociclo VARCHAR(255),
    mesociclo VARCHAR(255), -- introdutório, condicionante, competitivo, recuperativo
    microciclo VARCHAR(255),  -- 1 a 6 semanas
    fase VARCHAR(255), -- as semanas do microciclo
    sessão VARCHAR(255), -- 1 a 3 sessões por semana
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE tb_treino_exercicio (
    id INT AUTO_INCREMENT PRIMARY KEY,
    exercicio_id INT NOT NULL,
    --- array de cargas ---
    carga_serie1 float,
    carga_serie2 float,
    carga_serie3 float,
    --- array de repeticoes ---
    repeticoes_serie1 INT,
    repeticoes_serie2 INT,
    repeticoes_serie3 INT,
    -- 1 a 10 sec -- 
    pausa INT,
    concentrica INT,
    excentrica INT,
    recuperacao_entre_series int,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)


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