-- Remove as procedures
DROP PROCEDURE IF EXISTS cadastrar_usr;
DROP PROCEDURE IF EXISTS cadastrar_tp_usr;
DROP PROCEDURE IF EXISTS cadastrar_trs;
DROP PROCEDURE IF EXISTS cadastrar_tp_trs;
DROP PROCEDURE IF EXISTS cadastrar_form_pgto;
DROP PROCEDURE IF EXISTS cadastrar_tp_moeda;
DROP PROCEDURE IF EXISTS cadastrar_bnc;
DROP TABLE IF EXISTS usr;
DROP TABLE IF EXISTS tp_usr;
DROP TABLE IF EXISTS trs;
DROP TABLE IF EXISTS tp_trs;
DROP TABLE IF EXISTS form_pgto;
DROP TABLE IF EXISTS tp_moeda;
DROP TABLE IF EXISTS bnc;
DROP TABLE IF EXISTS log_geral;

-- criar tabelas

CREATE TABLE usr
(
	id			INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome		VARCHAR(50),
	banco		VARCHAR(15),
	agencia		INTEGER,
	conta		INTEGER,
	digito		INTEGER
);

CREATE TABLE tp_usr
(
	id			INTEGER AUTO_INCREMENT PRIMARY KEY,
	tipo		VARCHAR(10)
);

DELIMITER //

---------------------------------------------------
--		   PROCEDURE CADASTRAR USUARIO			 --
---------------------------------------------------

CREATE PROCEDURE cadastrar_usr
(
	IN nome			VARCHAR(50),
	IN banco		VARCHAR(15),
	IN agencia		INTEGER,
	IN conta		INTEGER,
	IN digito		INTEGER,
)
BEGIN
	IF agencia > 0 AND agencia <= 9999 THEN
		INSERT INTO usr VALUES (NULL, nome, banco, agencia, conta, digito);
	END IF;
END //

---------------------------------------------------
--		 PROCEDURE CADASTRAR TIPO USUARIO		 --
---------------------------------------------------

CREATE PROCEDURE cadastrar_tp_usr
(
	IN tipo			VARCHAR(10),
)
BEGIN
	INSERT INTO tp_usr VALUES (NULL, tipo);
END //

DELIMITER ;

-- Cadastrar usuarios nos BD
CALL cadastrar_usr('Antonio Marcos da Silva Pires', 'Santander', 4687, 53694, 4);
CALL cadastrar_usr('Renato Drozdek Jr', 'Bradesco', 1886, 18894, 3);
CALL cadastrar_usr('Rodrigo Ferreira dos Anjos', 'Itau', 0616, 91837, 1);
CALL cadastrar_usr('Samantha Soares Heil', 'Caixa', 1348, 91837, 1);

















/*
CREATE TABLE trs
(
	id			INTEGER AUTO_INCREMENT PRIMARY KEY,
	transacao	VARCHAR(20),
	
);

CREATE TABLE tp_trs
(
	
);

CREATE TABLE form_pgto
(
	
);

CREATE TABLE tp_moeda
(
	
);

CREATE TABLE bnc
(
	
);

CREATE TABLE log_geral
(
	
);
*/