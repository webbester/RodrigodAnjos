DELIMITER //

DROP PROCEDURE IF EXISTS Atualizarbanco//


CREATE PROCEDURE Atualizarbanco(_nome VARCHAR(255), banco_id int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update banco set Nome = _nome where Id = banco_id;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do banco e do usuario deve ser fornecido para a atualização!' AS Msg;
END IF; 
END;//

DROP PROCEDURE IF EXISTS Deletarbanco//

CREATE PROCEDURE Deletarbanco(Idbanco int, IdUsuarioLogado int)
BEGIN
IF ((Idbanco != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
delete from banco where id = Idbanco;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do banco e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//



DROP PROCEDURE IF EXISTS CriarFormaPagamento//

CREATE PROCEDURE CriarFormaPagamento(_nome VARCHAR(255), IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
INSERT INTO forma_pagamento (nome) 
values (_nome);

INSERT INTO log (data,operacao_id,tabela,usuario_id) 
values (now(),1,concat('forma_pagamento' ,LAST_INSERT_ID()),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'Nome e usuario ser fornecidos para o cadastro do forma pagamento!' AS Msg;
END IF; 
END;//

#Update forma_pagamento


DROP PROCEDURE IF EXISTS AtualizarFormaPagamento//

CREATE PROCEDURE AtualizarFormaPagamento(_nome VARCHAR(255), Idforma_pagamento int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update forma_pagamento set nome = _nome where id = Idforma_pagamento;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do banco e do usuario deve ser fornecido para a atualização!' AS Msg;
END IF; 
END;//

#Deleta forma_pagamento


DROP PROCEDURE IF EXISTS DeletarFormaPagamento//

CREATE PROCEDURE DeletarFormaPagamento(Idforma_pagamento int, IdUsuarioLogado int)
BEGIN
IF ((Idforma_pagamento != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
delete from forma_pagamento where id = Idforma_pagamento;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do forma pagamento e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//

#atualizar operacao

DROP PROCEDURE IF EXISTS AtualizarOperacao//

CREATE PROCEDURE AtualizarOperacao(_nome VARCHAR(255), Idoperacao int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update operacao set nome = _nome where id = Idoperacao;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do banco e do usuario deve ser fornecido para a atualização!' AS Msg;
END IF; 
END;//

#Deleta operacao


DROP PROCEDURE IF EXISTS DeletarOperacao//

CREATE PROCEDURE DeletarOperacao(Idoperacao int, IdUsuarioLogado int)
BEGIN
IF ((Idoperacao != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
delete from operacao where id = Idoperacao;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do forma pagamento e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//

DELIMITER //
#Update tipo_moeda


DROP PROCEDURE IF EXISTS AtualizarTipoMoeda//

CREATE PROCEDURE AtualizarTipoMoeda(_nome VARCHAR(255), Idtipo_moeda int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update tipo_moeda set nome = _nome where id = Idtipo_moeda;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do banco e do usuario deve ser fornecido para a atualização!' AS Msg;
END IF; 
END;//

#Deleta tipo_moeda


DROP PROCEDURE IF EXISTS DeletarTipoMoeda//

CREATE PROCEDURE DeletarTipoMoeda(Idtipo_moeda int, IdUsuarioLogado int)
BEGIN
IF ((Idtipo_moeda != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
delete from tipo_moeda where id = Idtipo_moeda;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do tipo_moeda e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//


DROP PROCEDURE IF EXISTS AtualizarTipoTransacao//

CREATE PROCEDURE AtualizarTipoTransacao(_nome VARCHAR(255), Idtipo_transacao int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update tipo_transacao set nome = _nome where id = Idtipo_transacao;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do tipo_transacao e do usuario deve ser fornecido para a atualização!' AS Msg;
END IF; 
END;//


#Deleta tipo_transacao


DROP PROCEDURE IF EXISTS DeletarTipoTransacao//

CREATE PROCEDURE DeletarTipoTransacao(Idtipo_transacao int, IdUsuarioLogado int)
BEGIN
IF ((Idtipo_transacao != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
delete from tipo_transacao where id = Idtipo_transacao;

INSERT INTO log (data,operacao_id,tabela,Usuario_id) 
values (now(),2,concat('Usuario_id:', Usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do tipo_transacao e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//

DELIMITER //

DELIMITER $$
CREATE DEFINER=`root`@`localhost` PROCEDURE `Retorna_ID_User`(user varchar(255))
BEGIN
select id 
from usuario
where Login = user;
END$$
DELIMITER ;


CREATE PROCEDURE ListarBanco

