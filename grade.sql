-- DROP DATABASE GestaoHorario;
-- CREATE DATABASE GestaoHorario;

-- USE GestaoHorario;

-- DROP
-- DROP TABLE IF EXISTS tblDisciplinas;
-- DROP TABLE IF EXISTS tblHorarioTurma;
-- DROP TABLE IF EXISTS tblHorasHorarios;
-- DROP TABLE IF EXISTS tblDisciplinasTurmas;
-- DROP TABLE IF EXISTS tblHorarios;
-- DROP TABLE IF EXISTS tblTurmas;
-- DROP TABLE IF EXISTS tblEscola;
-- DROP TABLE IF EXISTS

-- CREATE
CREATE TABLE IF NOT EXISTS tblEscolas
(
    idEscola INT PRIMARY KEY AUTO_INCREMENT ,
    nomeEscola VARCHAR(200) NOT NULL,
    registroInep VARCHAR(20) NOT NULL,
    logradouro VARCHAR(200) NULL,
	numero INT,
    complemento VARCHAR(200) NULL,
    bairro VARCHAR(200) NULL,
    cidade VARCHAR(200) NULL,
    estado VARCHAR(2) NULL,
    cep VARCHAR(9) NULL,
    telefone varchar(11) NULL
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



CREATE TABLE IF NOT EXISTS tblUsuarios
(
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    nomeUsuario VARCHAR(200) NOT NULL,
    senha varchar(80) not null,
    tipoAcesso int not null,
    txtEmail VARCHAR(200) not NULL
    fkEscola INT
);

CREATE TABLE IF NOT EXISTS tblTurmas
(
    idTurma INT PRIMARY KEY AUTO_INCREMENT,
    nomeTurma VARCHAR(100),
    maximoAulasMateriaDia int,
    fkHorario INT,
    tipoEnsino int,
    fkEscola INT,
    anoTurma int,
   	criadoEm DATETIME DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (fkEscola) REFERENCES tblEscolas(idEscola),
    FOREIGN KEY (fKHorario) REFERENCES tblHorarios(idHorario)
);


CREATE TABLE IF NOT EXISTS tblUsuarios
(
    idUsuario INT PRIMARY KEY AUTO_INCREMENT,
    nomeUsuario VARCHAR(200) NOT NULL,
    senha varchar(80) not null,
    tipoAcesso int not null,
    txtEmail VARCHAR(200) not NULL
    fkEscola INT
);


CREATE TABLE IF NOT EXISTS tblProfessores
(
    idProfessor INT PRIMARY KEY AUTO_INCREMENT,
    matricula VARCHAR(200) NULL,
    nomeProfessor VARCHAR(200) NOT NULL,
    txtEmail VARCHAR(200) NULL,
	fkEscola INT,
	FOREIGN KEY (fkEscola) REFERENCES tblEscolas(idEscola)
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
    fkProfessor INT,
    fkTurma INT,
    FOREIGN KEY (fkDisciplina) REFERENCES tblDisciplinas(idDisciplina),
    FOREIGN KEY (fkProfessor) REFERENCES tblProfessorES(idProfessor),
    FOREIGN KEY (fkTurma) REFERENCES tblTurmas(idTurma)
);
-- CREATE TABLE IF NOT EXISTS
  
-- Procedures
DELIMITER //


CREATE PROCEDURE sp_usuarios_insert (
    in p_idUsuario INT,
    in p_nomeUsuario VARCHAR(200),
    in p_senha varchar(80),
    in p_tipoAcesso int,
    in p_txtEmail VARCHAR(200),
    in p_fkEscola INT
)
BEGIN
    IF EXISTS (SELECT 1 FROM tblUsuarios WHERE idUsuario = p_idUsuario) THEN
        UPDATE tblUsuarios
        SET nomeUsuario = p_nomeUsuario,
            txtEMail = p_txtEmail,
            senha = p_senha,
            tipoAcesso = p_tipoAcesso,
            fkEscola = p_fkEscola
        WHERE idUsuario = p_idUsuario;
    ELSE
        INSERT INTO tblUsuarios (nomeUsuario, txtEmail, senha, tipoAcesso, fkEscola)
        VALUES (p_nomeUsuario, p_txtEmail, p_senha, p_tipoAcesso, p_fkEscola);
    END IF;
END //

CREATE PROCEDURE sp_insert_update_tblEscolas (
    IN p_idEscola INT,
    IN p_nomeEscola VARCHAR(200),
    IN p_registroInep VARCHAR(20),
    IN p_logradouro VARCHAR(200),
    IN p_numero INT,
    IN p_complemento VARCHAR(200),
    IN p_bairro VARCHAR(200),
    IN p_cidade VARCHAR(200),
    IN p_estado VARCHAR(2),
    IN p_cep VARCHAR(9),
    IN p_telefone VARCHAR(11)
)
BEGIN
    IF EXISTS (SELECT 1 FROM tblEscolas WHERE idEscola = p_idEscola) THEN
        UPDATE tblEscolas
        SET nomeEscola = p_nomeEscola,
            registroInep = p_registroInep,
            logradouro = p_logradouro,
            numero = p_numero,
            complemento = p_complemento,
            bairro = p_bairro,
            cidade = p_cidade,
            estado = p_estado,
            cep = p_cep,
            telefone = p_telefone
        WHERE idEscola = p_idEscola;
    ELSE
        INSERT INTO tblEscolas (nomeEscola, registroInep, logradouro, numero, complemento, bairro, cidade, estado, cep, telefone)
        VALUES (p_nomeEscola, p_registroInep, p_logradouro, p_numero, p_complemento, p_bairro, p_cidade, p_estado, p_cep, p_telefone);
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_insert_update_tblHorarios (
    IN p_idHorario INT,
    IN p_fkEscola INT,
    IN p_nomeHorario VARCHAR(50)
)
BEGIN
    IF EXISTS (SELECT 1 FROM tblHorarios WHERE idHorario = p_idHorario) THEN
        UPDATE tblHorarios
        SET fkEscola = p_fkEscola,
            nomeHorario = p_nomeHorario
        WHERE idHorario = p_idHorario;
    ELSE
        INSERT INTO tblHorarios (fkEscola, nomeHorario)
        VALUES (p_fkEscola, p_nomeHorario);
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_insert_update_tblHorasHorarios (
    IN p_idHora INT,
    IN p_horaFim TIME,
    IN p_horaInicio TIME,
    IN p_fkHorario INT
)
BEGIN
    IF EXISTS (SELECT 1 FROM tblHorasHorarios WHERE idHora = p_idHora) THEN
        UPDATE tblHorasHorarios
        SET horaFim = p_horaFim,
            horaInicio = p_horaInicio,
            fkHorario = p_fkHorario
        WHERE idHora = p_idHora;
    ELSE
        INSERT INTO tblHorasHorarios (horaFim, horaInicio, fkHorario)
        VALUES (p_horaFim, p_horaInicio, p_fkHorario);
    END IF;
END //

DELIMITER ;

DELIMITER //


CREATE PROCEDURE sp_insert_update_tblTurmas (
    IN p_idTurma INT,
    IN p_nomeTurma VARCHAR(100),
    IN p_fkHorario INT,
    IN p_fkEscola INT,
    in p_anoTurma varchar(50)
)
BEGIN
    IF EXISTS (SELECT 1 FROM tblTurmas WHERE idTurma = p_idTurma) THEN
        UPDATE tblTurmas
        SET nomeTurma = p_nomeTurma,
            fkHorario = p_fkHorario,
            anoTurma = p_anoTurma,
            fkEscola = p_fkEscola
        WHERE idTurma = p_idTurma;
    ELSE
        INSERT INTO tblTurmas (nomeTurma, fkHorario,
         anoTurma , fkEscola, criadoEm)
        VALUES (p_nomeTurma, p_fkHorario,
        p_anoTurma, p_fkEscola, CURRENT_DATE);
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_insert_update_tblHorarioTurma (
    IN p_idHorarioTurma INT,
    IN p_fkHorario INT,
    IN p_fkTurma INT
)
BEGIN
    IF EXISTS (SELECT 1 FROM tblHorarioTurma WHERE idHorarioTurma = p_idHorarioTurma) THEN
        UPDATE tblHorarioTurma
        SET fkHorario = p_fkHorario,
            fkTurma = p_fkTurma
        WHERE idHorarioTurma = p_idHorarioTurma;
    ELSE
        INSERT INTO tblHorarioTurma (fkHorario, fkTurma)
        VALUES (p_fkHorario, p_fkTurma);
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_insert_update_tblProfessores (
    IN p_idProfessor INT,
    IN p_matricul VARCHAR(200),
    IN p_nomeProfessor VARCHAR(200),
    IN p_txtEmail VARCHAR(200),
    IN p_fkEscola INT
)
BEGIN
    IF EXISTS (SELECT 1 FROM tblProfessores WHERE idProfessor = p_idProfessor) THEN
        UPDATE tblProfessores
        SET matricul = p_matricul,
            nomeProfessor = p_nomeProfessor,
            txtEmail = p_txtEmail,
            fkEscola = p_fkEscola
        WHERE idProfessor = p_idProfessor;
    ELSE
        INSERT INTO tblProfessores (matricul, nomeProfessor, txtEmail, fkEscola)
        VALUES (p_matricul, p_nomeProfessor, p_txtEmail, p_fkEscola);
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_insert_update_tblDisciplinas (
    IN p_idDisciplina INT,
    IN p_sigla VARCHAR(5),
    IN p_codigoDisciplina VARCHAR(50),
    IN p_nomeDisciplina VARCHAR(100)
)
BEGIN
    IF EXISTS (SELECT 1 FROM tblDisciplinas WHERE idDisciplina = p_idDisciplina) THEN
        UPDATE tblDisciplinas
        SET sigla = p_sigla,
            codigoDisciplina = p_codigoDisciplina,
            nomeDisciplina = p_nomeDisciplina
        WHERE idDisciplina = p_idDisciplina;
    ELSE
        INSERT INTO tblDisciplinas (sigla, codigoDisciplina, nomeDisciplina)
        VALUES (p_sigla, p_codigoDisciplina, p_nomeDisciplina);
    END IF;
END //

DELIMITER ;

DELIMITER //

CREATE PROCEDURE sp_insert_update_tblDisciplinasTurma (
    IN p_idDisciplinaTurma INT,
    IN p_quantidadeAulasSemana INT,
    IN p_fkDisciplina INT,
    IN p_fkProfessor INT,
    IN p_fkTurma INT
)
BEGIN
    IF EXISTS (SELECT 1 FROM tblDisciplinasTurma WHERE idDisciplinaTurma = p_idDisciplinaTurma) THEN
        UPDATE tblDisciplinasTurma
        SET quantidadeAulasSemana = p_quantidadeAulasSemana,
            fkDisciplina = p_fkDisciplina,
            fkProfessor = p_fkProfessor,
            fkTurma = p_fkTurma
        WHERE idDisciplinaTurma = p_idDisciplinaTurma;
    ELSE
        INSERT INTO tblDisciplinasTurma (quantidadeAulasSemana, fkDisciplina, fkProfessor, fkTurma)
        VALUES (p_quantidadeAulasSemana, p_fkDisciplina, p_fkProfessor, p_fkTurma);
    END IF;
END //

DELIMITER ;

-- Dados para tblEscolas:
CALL sp_insert_update_tblEscolas(NULL, 'Escola Estadual de Capitólio', '1234567890', 'Rua Principal', 100, 'Próximo à praça', 'Centro', 'Capitólio', 'MG', '37930000', '3534567890');
CALL sp_insert_update_tblEscolas(NULL, 'Escola Municipal de Capitólio', '0987654321', 'Avenida Secundária', 200, 'Em frente ao mercado', 'Bairro Novo', 'Capitólio', 'MG', '37930001', '3534567891');

-- Dados para tblHorarios:
CALL sp_insert_update_tblHorarios(NULL, 1, 'Horário Matutino');
CALL sp_insert_update_tblHorarios(NULL, 2, 'Horário Vespertino');

-- Dados para tblHorasHorarios:
CALL sp_insert_update_tblHorasHorarios(NULL, '08:00:00', '07:00:00', 1);
CALL sp_insert_update_tblHorasHorarios(NULL, '12:00:00', '11:00:00', 1);
CALL sp_insert_update_tblHorasHorarios(NULL, '14:00:00', '13:00:00', 2);
CALL sp_insert_update_tblHorasHorarios(NULL, '18:00:00', '17:00:00', 2);

-- Dados para tblTurmas:
CALL sp_insert_update_tblTurmas(NULL, 'Turma 1A', 1, TRUE, 1);
CALL sp_insert_update_tblTurmas(NULL, 'Turma 2B', 2, FALSE, 2);
-- Dados para tblHorarioTurma:
CALL sp_insert_update_tblHorarioTurma(NULL, 1, 1);
CALL sp_insert_update_tblHorarioTurma(NULL, 2, 2);

-- Dados para tblProfessores:
CALL sp_insert_update_tblProfessores(NULL, 'MAT123', 'Professor A', 'prof.a@escola.com', 1);
CALL sp_insert_update_tblProfessores(NULL, 'POR456', 'Professor B', 'prof.b@escola.com', 2);

-- Dados para tblDisciplinas:
CALL sp_insert_update_tblDisciplinas(NULL, 'MAT', 'MAT101', 'Matemática');
CALL sp_insert_update_tblDisciplinas(NULL, 'POR', 'POR102', 'Português');
-- Dados para tblDisciplinasTurma:
CALL sp_insert_update_tblDisciplinasTurma(NULL, 5, 1, 1, 1);
CALL sp_insert_update_tblDisciplinasTurma(NULL, 4, 2, 2, 2);



