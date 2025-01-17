DROP DATABASE GestaoHorario;
CREATE DATABASE GestaoHorario;

USE GestaoHorario;

-- DROP
DROP TABLE IF EXISTS tblDisciplinas;
DROP TABLE IF EXISTS tblHorarioTurma;
DROP TABLE IF EXISTS tblHorasHorarios;
DROP TABLE IF EXISTS tblDisciplinasTurmas;
DROP TABLE IF EXISTS tblHorarios;
DROP TABLE IF EXISTS tblTurmas;
DROP TABLE IF EXISTS tblEscola;
-- DROP TABLE IF EXISTS

-- CREATE
CREATE TABLE IF NOT EXISTS tblEscolas
(
    idEscola INT PRIMARY KEY AUTO_INCREMENT ,
    nomeEscola VARCHAR(200) not NULL,
    registroInep VARCHAR(20) not null,
    logradouro VARCHAR(200) null,
	numero INT,
    complemento VARCHAR(200) null,
    bairro VARCHAR(200) null,
    cidade VARCHAR(200) null,
    estado VARCHAR(2) null,
    cep VARCHAR(9) null,
    telefone varchar(11) null
);

CREATE TABLE IF NOT EXISTS tblHorarios
(
    idHorario INT PRIMARY KEY AUTO_INCREMENT,
    fkEscola INT,
    nomeHorario VARCHAR(50),
    FOREIGN KEY (fkEscola) REFERENCES tblEscolas(idEscola)
);

CREATE TABLE IF NOT EXISTS tblHorasHorarios
(
    idHora INT PRIMARY KEY AUTO_INCREMENT,
    horaFim TIME,
    horaInicio TIME,
    fkHorario INT,
    FOREIGN KEY (fkHorario) REFERENCES tblHorarios(idHorario)
);

CREATE TABLE IF NOT EXISTS tblTurmas
(
    idTurma INT PRIMARY KEY AUTO_INCREMENT,
    nomeTurma VARCHAR(100),
    turno INT,   -- Manhã 1 // Tarde 2 // Noturno 3 // Integral 4
    podeRepetirAula BOOLEAN,
    fkEscola INT,
    -- fkAno INT,
    FOREIGN KEY (fkEscola) REFERENCES tblEscolas(idEscola),
    -- FOREIGN KEY (fkAno) REFERENCES tblAnos(idAno),
	criadoEm DATE DEFAULT CURRENT_DATE
);

CREATE TABLE IF NOT EXISTS tblHorarioTurma
(
    idHorarioTurma INT PRIMARY KEY AUTO_INCREMENT,
    fkHorario INT,
    fkTurma INT,
    FOREIGN KEY (fkHorario) REFERENCES tblHorarios(idHorario),
    FOREIGN key (fkTurma) REFERENCES tblTurmas(idTurma)
);

CREATE TABLE IF NOT EXISTS tblDisciplinas
(
    idDisciplina INT PRIMARY KEY AUTO_INCREMENT,
    sigla VARCHAR(5),
    codigoDisciplina VARCHAR(50),
    nomeDisciplina VARCHAR(100) 
);

CREATE TABLE IF NOT EXISTS tblDisciplinasTurma
(
    idDisciplinaTurma INT PRIMARY KEY AUTO_INCREMENT,
    quantidadeAulasSemana INT,
    fkDisciplina INT,
    -- fkProfessor INT,
    fkTurma INT,
    FOREIGN KEY (fkDisciplina) REFERENCES tblDisciplinas(idDisciplina),
    -- FOREIGN KEY (fkProfessor) REFERENCES tblProfessor(idProfessor),
    FOREIGN KEY (fkTurma) REFERENCES tblTurmas(idTurma)
);
-- CREATE TABLE IF NOT EXISTS


-- Inserindo dados na tabela tblEscolas
INSERT INTO tblEscolas (nomeEscola, registroInep, logradouro, numero, complemento, bairro, cidade, estado, cep, telefone)
VALUES 
('Escola Estadual de Capitólio', '1234567890', 'Rua Principal', 100, 'Próximo à praça', 'Centro', 'Capitólio', 'MG', '37930000', '3534567890'),
('Escola Municipal de Capitólio', '0987654321', 'Avenida Secundária', 200, 'Em frente ao mercado', 'Bairro Novo', 'Capitólio', 'MG', '37930001', '3534567891');

-- Inserindo dados na tabela tblHorarios
INSERT INTO tblHorarios (fkEscola, nomeHorario)
VALUES 
(1, 'Horário Matutino'),
(2, 'Horário Vespertino');

-- Inserindo dados na tabela tblHorasHorarios
INSERT INTO tblHorasHorarios (horaFim, horaInicio, fkHorario)
VALUES 
('08:00:00', '07:00:00', 1),
('12:00:00', '11:00:00', 1),
('14:00:00', '13:00:00', 2),
('18:00:00', '17:00:00', 2);

-- Inserindo dados na tabela tblTurmas
INSERT INTO tblTurmas (nomeTurma, turno, podeRepetirAula, fkEscola, criadoEm)
VALUES 
('Turma 1A', 1, TRUE, 1, CURRENT_DATE),
('Turma 2B', 2, FALSE, 2, CURRENT_DATE);

-- Inserindo dados na tabela tblHorarioTurma
INSERT INTO tblHorarioTurma (fkHorario, fkTurma)
VALUES 
(1, 1),
(2, 2);

-- Inserindo dados na tabela tblDisciplinas
INSERT INTO tblDisciplinas (sigla, codigoDisciplina, nomeDisciplina)
VALUES 
('MAT', 'MAT101', 'Matemática'),
('POR', 'POR102', 'Português');

-- Inserindo dados na tabela tblDisciplinasTurma
INSERT INTO tblDisciplinasTurma (quantidadeAulasSemana, fkDisciplina, fkTurma)
VALUES 
(5, 1, 1),
(4, 2, 2);