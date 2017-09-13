-- Remove as procedures
DROP PROCEDURE IF EXISTS cadastrar_aluno;
DROP PROCEDURE IF EXISTS cadastrar_disciplina;
DROP PROCEDURE IF EXISTS cadastrar_nota;
DROP TABLE IF EXISTS disciplina;
DROP TABLE IF EXISTS nota;
DROP TABLE IF EXISTS aluno;

-- Cria as tabelas

CREATE TABLE aluno(
	id 		        INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome		    VARCHAR(50),
	data_nasc	    DATE,
	curso		    VARCHAR(50)
);

CREATE TABLE disciplina(
	id 		        INTEGER AUTO_INCREMENT PRIMARY KEY,
	nome		    VARCHAR(50)
);	


CREATE TABLE nota( 
	id 		        INTEGER AUTO_INCREMENT PRIMARY KEY,
	id_aluno	    INTEGER,
	id_disciplina	INTEGER,
	nota		    DECIMAL(5, 2)
    -- FOREIGN KEY (id_aluno)
    --    REFERENCES aluno(id)
    --    ON DELETE CASCADE,
    -- FOREIGN KEY (id_disciplina)
    --    REFERENCES disciplina(id)
    --    ON DELETE CASCADE
);


DELIMITER //

-- --------------------------------------------------------
-- PROCEDURE: cadastrar aluno
-- --------------------------------------------------------
CREATE PROCEDURE cadastrar_aluno(IN nome        VARCHAR(50),
                                 IN aniversario DATE,
                                 IN curso       VARCHAR(50))
BEGIN
    INSERT INTO aluno VALUES (NULL, nome, aniversario, curso);
END //

-- --------------------------------------------------------
-- PROCEDURE: cadastrar disciplina
-- --------------------------------------------------------
CREATE PROCEDURE cadastrar_disciplina(IN nome VARCHAR(50))
BEGIN
    INSERT INTO disciplina VALUES (NULL, nome);
END //

-- --------------------------------------------------------
-- PROCEDURE: cadastrar nota
-- --------------------------------------------------------
CREATE PROCEDURE cadastrar_nota(IN id_aluno      INTEGER, 
                                IN id_disciplina INTEGER,
                                IN nota          DECIMAL(5,2))
BEGIN
    IF nota >= 0 AND nota <= 100 THEN
        INSERT INTO nota VALUES (NULL, id_aluno, id_disciplina, nota);
    END IF;
END //


DELIMITER ;

-- --------------------------------------------------------
-- --------------------------------------------------------
-- --------------------------------------------------------

-- Cadastra alguns dados no BD
CALL cadastrar_aluno('Joao das Neves',   19901010, 'Culinaria');
CALL cadastrar_aluno('Pedro Pedreira',   19910120, 'Culinaria');
CALL cadastrar_aluno('Augusto Gustavo',  19921201, 'Culinaria');
CALL cadastrar_aluno('Anna Banana',      20011212, 'Corte & Costura');
CALL cadastrar_aluno('Coronel Mostarda', '1990-08-08', 'Corte & Costura');

CALL cadastrar_disciplina('Feijoada Basica');
CALL cadastrar_disciplina('Feijoada Avancada');
CALL cadastrar_disciplina('Teoria de Remendos');

CALL cadastrar_nota(1, 1, 20);
CALL cadastrar_nota(1, 1, 70);
CALL cadastrar_nota(1, 1, 100);

CALL cadastrar_nota(2, 1, 30);
CALL cadastrar_nota(2, 1, 30);
CALL cadastrar_nota(2, 1, 30);

CALL cadastrar_nota(3, 1, 45);
CALL cadastrar_nota(3, 1, 25);
CALL cadastrar_nota(3, 1, 99);

CALL cadastrar_nota(4, 1, 972);
CALL cadastrar_nota(4, 1, 198);

CALL cadastrar_nota(4, 1, -42);
CALL cadastrar_nota(4, 1, 89);

-- Exemplo de select + case
SELECT CASE 
          WHEN nota >= 70 THEN 'aprovado'  
          WHEN nota < 40 THEN 'reprovado'
          ELSE 'FINAL' 
        END AS status, 
        nota  
FROM nota;

