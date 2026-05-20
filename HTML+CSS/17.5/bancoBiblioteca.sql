DROP DATABASE IF EXISTS bancobiblioteca;
CREATE DATABASE bancobiblioteca;
USE bancobiblioteca;

-- ==========================
-- USUÁRIOS
-- ==========================
CREATE TABLE usuarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    cpf VARCHAR(11) NOT NULL UNIQUE,
    email VARCHAR(255) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL,
    tipo ENUM('aluno', 'admin') NOT NULL
);

-- ==========================
-- LIVROS
-- ==========================
CREATE TABLE livros (
    id INT AUTO_INCREMENT PRIMARY KEY,
    titulo VARCHAR(255) NOT NULL,
    autor VARCHAR(255) NOT NULL,
    ano_publicacao YEAR NOT NULL,
    descricao VARCHAR(255) NOT NULL,
    imagem VARCHAR(255) NOT NULL,
    disponivel BOOLEAN DEFAULT TRUE
);

-- ==========================
-- ALUGUÉIS (CORRETO)
-- ==========================
CREATE TABLE alugueis (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_livro INT NOT NULL,
    cpf_aluno VARCHAR(11) NOT NULL,
    data_pedido TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (id_livro) REFERENCES livros(id)
    ON DELETE CASCADE
);