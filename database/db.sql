CREATE DATABASE clinica;
USE clinica;

CREATE TABLE funcionarios (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(255) NOT NULL
) 

CREATE TABLE medicos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    especialidade VARCHAR(100) NOT NULL
) 

CREATE TABLE pacientes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome VARCHAR(100) NOT NULL,
    telefone VARCHAR(20) NOT NULL
) 

CREATE TABLE consultas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    id_medico INT NOT NULL,
    id_paciente INT NOT NULL,
    FOREIGN KEY (id_medico) REFERENCES medicos(id),
    FOREIGN KEY (id_paciente) REFERENCES pacientes(id)
) 

INSERT INTO funcionarios (nome, email, senha)
VALUES ( 'Ana', 'ana@exemplo.com', 'ana123' );