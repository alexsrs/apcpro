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