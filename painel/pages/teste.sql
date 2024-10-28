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
