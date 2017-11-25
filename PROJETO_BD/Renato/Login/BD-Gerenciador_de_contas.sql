CREATE TABLE `Usuario` (
	`Id` int NOT NULL AUTO_INCREMENT,
	`Nome` varchar(255) NOT NULL,
	`Login` varchar(255) NOT NULL,
	`Senha` varchar(255) NOT NULL,
	`Ativo` bit NOT NULL DEFAULT 1,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Tipo_usuario` (
	`Id` int NOT NULL AUTO_INCREMENT,
	`Nome` varchar(100) NOT NULL,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Transacao` (
	`Id` int NOT NULL AUTO_INCREMENT,
	`Usuario_id` int NOT NULL,
	`Tipo_transacao_id` int NOT NULL,
	`Banco_origem_id` int NOT NULL,
	`Banco_destino_id` int NOT NULL,
	`Forma_pagamento_id` int NOT NULL,
	`Tipo_moeda` int NOT NULL,
	`Valor` DECIMAL(8,2) NOT NULL,
	`Data` DATETIME NOT NULL,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Tipo_transacao` (
	`Id` int NOT NULL AUTO_INCREMENT,
	`Nome` varchar(200) NOT NULL,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Forma_pagamento` (
	`Id` int NOT NULL AUTO_INCREMENT,
	`Nome` varchar(200) NOT NULL,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Log` (
	`id` int NOT NULL AUTO_INCREMENT,
	`Usuario_id` int NOT NULL,
	`Data` DATETIME NOT NULL,
	`Operacao_id` int NOT NULL,
	`Tabela` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
);

CREATE TABLE `Tipo_moeda` (
	`Id` int NOT NULL AUTO_INCREMENT,
	`Nome` varchar(200) NOT NULL,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Banco` (
	`Id` int NOT NULL AUTO_INCREMENT,
	`Nome` varchar(200) NOT NULL,
	PRIMARY KEY (`Id`)
);

CREATE TABLE `Tipo_usuario_usuario` (
	`Tipo_usuario_id` int NOT NULL,
	`Usuario_id` int NOT NULL,
	PRIMARY KEY (`Tipo_usuario_id`,`Usuario_id`)
);

CREATE TABLE `Operacao` (
	`Id` int NOT NULL AUTO_INCREMENT,
	`Nome` varchar(100) NOT NULL,
	PRIMARY KEY (`Id`)
);

ALTER TABLE `Transacao` ADD CONSTRAINT `Transacao_fk0` FOREIGN KEY (`Usuario_id`) REFERENCES `Usuario`(`Id`);

ALTER TABLE `Transacao` ADD CONSTRAINT `Transacao_fk1` FOREIGN KEY (`Tipo_transacao_id`) REFERENCES `Tipo_transacao`(`Id`);

ALTER TABLE `Transacao` ADD CONSTRAINT `Transacao_fk2` FOREIGN KEY (`Banco_origem_id`) REFERENCES `Banco`(`Id`);

ALTER TABLE `Transacao` ADD CONSTRAINT `Transacao_fk3` FOREIGN KEY (`Banco_destino_id`) REFERENCES `Banco`(`Id`);

ALTER TABLE `Transacao` ADD CONSTRAINT `Transacao_fk4` FOREIGN KEY (`Forma_pagamento_id`) REFERENCES `Forma_pagamento`(`Id`);

ALTER TABLE `Transacao` ADD CONSTRAINT `Transacao_fk5` FOREIGN KEY (`Tipo_moeda`) REFERENCES `Tipo_moeda`(`Id`);

ALTER TABLE `Log` ADD CONSTRAINT `Log_fk0` FOREIGN KEY (`Usuario_id`) REFERENCES `Usuario`(`Id`);

ALTER TABLE `Log` ADD CONSTRAINT `Log_fk1` FOREIGN KEY (`Operacao_id`) REFERENCES `Operacao`(`Id`);

ALTER TABLE `Tipo_usuario_usuario` ADD CONSTRAINT `Tipo_usuario_usuario_fk0` FOREIGN KEY (`Tipo_usuario_id`) REFERENCES `Tipo_usuario`(`Id`);

ALTER TABLE `Tipo_usuario_usuario` ADD CONSTRAINT `Tipo_usuario_usuario_fk1` FOREIGN KEY (`Usuario_id`) REFERENCES `Usuario`(`Id`);

#Iserindo tipos de usuarios
insert into tipo_usuario (nome) values ('Administrator');
insert into tipo_usuario (nome) values ('Prime');
insert into tipo_usuario (nome) values ('Premium');
insert into tipo_usuario (nome) values ('Standard');

#Inserir os tipos de moedas
insert into tipo_moeda (nome) values ('Real');

#Inserir os tipos de formas de pagamento
insert into Forma_pagamento (nome) values ('Dinheiro');
insert into Forma_pagamento (nome) values ('Cartão');
insert into Forma_pagamento (nome) values ('Cheque');
insert into Forma_pagamento (nome) values ('TED');
insert into Forma_pagamento (nome) values ('DOC');

#Inserir os Bancos
insert into Banco (nome) values ('Santander');
insert into Banco (nome) values ('Bradesco/HSBC');
insert into Banco (nome) values ('Itau/Unibanco');
insert into Banco (nome) values ('BB');
insert into Banco (nome) values ('CEF');

#Inserir os Tipo_transacao
insert into Tipo_transacao (nome) values ('Débito');
insert into Tipo_transacao (nome) values ('Crédito');
insert into Tipo_transacao (nome) values ('Transferência');

#Inserir os Operacao
insert into Operacao (nome) values ('Insert');
insert into Operacao (nome) values ('Update');
insert into Operacao (nome) values ('Delete');



#Adicionando usuários padrões
insert into usuario (nome,login,senha,ativo) values ('Samantha','samy','abc123',1);
insert into usuario (nome,login,senha,ativo) values ('Alan','alan','abc123',1);
insert into usuario (nome,login,senha,ativo) values ('admin','admin','abc123',1);
insert into usuario (nome,login,senha,ativo) values ('Joao','joao','abc123',1);

#Samantha será Administradora e Prime
insert into tipo_usuario_usuario (Tipo_usuario_id,usuario_id) values (2,1);
insert into tipo_usuario_usuario (Tipo_usuario_id,usuario_id) values (1,1);

#Alan será Premium
insert into tipo_usuario_usuario (Tipo_usuario_id,usuario_id) values (3,2);

#Admin será prime
insert into tipo_usuario_usuario (Tipo_usuario_id,usuario_id) values (1,3);

#Joao será Standard
insert into tipo_usuario_usuario (Tipo_usuario_id,usuario_id) values (4,4);

DELIMITER //

DROP PROCEDURE IF EXISTS CriarUsuario//

CREATE PROCEDURE CriarUsuario(_nome VARCHAR(255), _login VARCHAR(255), _senha VARCHAR(255))
BEGIN
	IF ((_nome != '') && (_login != '') && (_senha != '')) THEN
	
		IF(EXISTS(select login from usuario where login = _login)) THEN
      		SELECT 'Login existente, por favor escolha outro!' AS Msg;
        ELSE	
            INSERT INTO usuario (nome,login,senha,ativo) 
            values (_nome,_login,_senha,1);
						
			INSERT INTO log (data,operacao_id,tabela,usuario_id) 
			values (now(),1,'usuario',(SELECT LAST_INSERT_ID()));
            
            SELECT 'Cadastro concluído com sucesso!' AS Msg;
            
         END IF; 
	ELSE
      	SELECT 'Nome, login e senha devem ser fornecidos para o cadastro!' AS Msg;
    END IF;
	
END;//

#Update Usuario

DROP PROCEDURE IF EXISTS AtualizarUsuario//

CREATE PROCEDURE AtualizarUsuario(IdUsuario int, _nome VARCHAR(255), _senha VARCHAR(255), _ativo bit, IdUsuarioLogado int)
BEGIN
IF ((IdUsuario != '') &&(_nome != '') &&(_senha != '') &&(_ativo != '') &&(IdUsuarioLogado != '')) THEN

IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1)) 
   OR (IdUsuario = IdUsuarioLogado)) THEN

update usuario set nome = _nome, senha =_senha, ativo = _ativo where id = IdUsuario;

INSERT INTO log (data,operacao_id,tabela,usuario_id) 
values (now(),2,concat('usuarioId:', IdUsuario) ,IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'Nome, login e senha devem ser fornecidos para a atualização!' AS Msg;
END IF; 
END;//

#Deleta Usuario


DROP PROCEDURE IF EXISTS DeletarUsuario//

CREATE PROCEDURE DeletarUsuario(IdUsuario int, IdUsuarioLogado int)
BEGIN
IF (IdUsuario != '') THEN

IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1)) 
   OR (IdUsuario = IdUsuarioLogado)) THEN

delete from usuario where id = IdUsuario;

INSERT INTO log (data,operacao_id,tabela,usuario_id) 
values (now(),3,concat('usuarioId:', IdUsuario) ,IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do usuário deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//


DROP PROCEDURE IF EXISTS VerificaLoginESenha//
CREATE PROCEDURE VerificaLoginESenha(_login VARCHAR(255))
BEGIN
	SELECT login, senha FROM usuario
		WHERE login = _login;
	
  -- IF ((_login != '')) THEN
    -- IF(EXISTS(select 1 from usuario where login = _login) THEN
      -- SELECT  senha AS Msg;
    -- ELSE
      -- SELECT 'Usuario e senha não coincidem' AS Msg;
    -- END IF;
  -- ELSE
    -- SELECT 'Insira um login e senha válidos!' AS Msg;
  -- END IF;
END;//
#call VerificaLoginESenha('samy','asd')


DROP PROCEDURE IF EXISTS Criarbanco//

CREATE PROCEDURE Criarbanco(_nome VARCHAR(255), IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN

IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN

INSERT INTO banco (nome) 
values (_nome);

INSERT INTO log (data,operacao_id,tabela,usuario_id) 
values (now(),1,concat('banco' ,LAST_INSERT_ID()),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'Nome e usuario ser fornecidos para o cadastro do banco!' AS Msg;
END IF; 
END;//

#Update banco


DROP PROCEDURE IF EXISTS Atualizarbanco//

CREATE PROCEDURE Atualizarbanco(_nome VARCHAR(255), banco_id int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update banco set nome = _nome where id = Idbanco;

INSERT INTO log (data,operacao_id,tabela,banco_id) 
values (now(),2,concat('banco_id:', banco_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do banco e do usuario deve ser fornecido para a atualização!' AS Msg;
END IF; 
END;//

#Deleta banco


DROP PROCEDURE IF EXISTS Deletarbanco//

CREATE PROCEDURE Deletarbanco(Idbanco int, IdUsuarioLogado int)
BEGIN
IF ((Idbanco != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
delete from banco where id = Idbanco;

INSERT INTO log (data,operacao_id,tabela,banco_id) 
values (now(),3,concat('Idbanco:', Idbanco),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do banco e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//



DROP PROCEDURE IF EXISTS Criarforma_pagamento//

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


DROP PROCEDURE IF EXISTS Atualizarforma_pagamento//

CREATE PROCEDURE AtualizarFormaPagamento(_nome VARCHAR(255), Idforma_pagamento int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update forma_pagamento set nome = _nome where id = Idforma_pagamento;

INSERT INTO log (data,operacao_id,tabela,forma_pagamento_id) 
values (now(),2,concat('forma_pagamento_id:', forma_pagamento_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do banco e do usuario deve ser fornecido para a atualização!' AS Msg;
END IF; 
END;//

#Deleta forma_pagamento


DROP PROCEDURE IF EXISTS Deletarforma_pagamento//

CREATE PROCEDURE DeletarFormaPagamento(Idforma_pagamento int, IdUsuarioLogado int)
BEGIN
IF ((Idforma_pagamento != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
delete from forma_pagamento where id = Idforma_pagamento;

INSERT INTO log (data,operacao_id,tabela,forma_pagamento_id) 
values (now(),3,concat('Idforma_pagamento:', Idforma_pagamento),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do forma pagamento e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//




DROP PROCEDURE IF EXISTS CriarOperacao//

CREATE PROCEDURE CriarOperacao(_nome VARCHAR(255), IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
INSERT INTO operacao (nome) 
values (_nome);

INSERT INTO log (data,operacao_id,tabela,usuario_id) 
values (now(),1,concat('operacao' ,LAST_INSERT_ID()),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'Nome e usuario ser fornecidos para o cadastro do forma pagamento!' AS Msg;
END IF; 
END;//

#Update operacao


DROP PROCEDURE IF EXISTS AtualizarOperacao//

CREATE PROCEDURE AtualizarOperacao(_nome VARCHAR(255), Idoperacao int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update operacao set nome = _nome where id = Idoperacao;

INSERT INTO log (data,operacao_id,tabela,operacao_id) 
values (now(),2,concat('operacao_id:', operacao_id),IdUsuarioLogado);

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

INSERT INTO log (data,operacao_id,tabela,operacao_id) 
values (now(),3,concat('Idoperacao:', Idoperacao),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do forma pagamento e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//




DROP PROCEDURE IF EXISTS Criartipo_moeda//

CREATE PROCEDURE CriarTipoMoeda(_nome VARCHAR(255), IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
INSERT INTO tipo_moeda (nome) 
values (_nome);

INSERT INTO log (data,operacao_id,tabela,usuario_id) 
values (now(),1,concat('tipo_moeda' ,LAST_INSERT_ID()),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'Nome e usuario ser fornecidos para o cadastro do tipo_moeda!' AS Msg;
END IF; 
END;//

#Update tipo_moeda


DROP PROCEDURE IF EXISTS Atualizartipo_moeda//

CREATE PROCEDURE AtualizarTipoMoeda(_nome VARCHAR(255), Idtipo_moeda int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update tipo_moeda set nome = _nome where id = Idtipo_moeda;

INSERT INTO log (data,operacao_id,tabela,tipo_moeda_id) 
values (now(),2,concat('tipo_moeda_id:', tipo_moeda_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do banco e do usuario deve ser fornecido para a atualização!' AS Msg;
END IF; 
END;//

#Deleta tipo_moeda


DROP PROCEDURE IF EXISTS Deletartipo_moeda//

CREATE PROCEDURE DeletarTipoMoeda(Idtipo_moeda int, IdUsuarioLogado int)
BEGIN
IF ((Idtipo_moeda != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
delete from tipo_moeda where id = Idtipo_moeda;

INSERT INTO log (data,operacao_id,tabela,tipo_moeda_id) 
values (now(),3,concat('Idtipo_moeda:', Idtipo_moeda),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do tipo_moeda e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//




DROP PROCEDURE IF EXISTS CriarTipoTransacao//

CREATE PROCEDURE CriarTipoTransacao(_nome VARCHAR(255), IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
INSERT INTO tipo_transacao (nome) 
values (_nome);

INSERT INTO log (data,operacao_id,tabela,usuario_id) 
values (now(),1,concat('tipo_transacao' ,LAST_INSERT_ID()),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'Nome e usuario ser fornecidos para o cadastro do tipo_transacao!' AS Msg;
END IF; 
END;//

#Update tipo_transacao


DROP PROCEDURE IF EXISTS AtualizarTipoTransacao//

CREATE PROCEDURE AtualizarTipoTransacao(_nome VARCHAR(255), Idtipo_transacao int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update tipo_transacao set nome = _nome where id = Idtipo_transacao;

INSERT INTO log (data,operacao_id,tabela,tipo_transacao_id) 
values (now(),2,concat('tipo_transacao_id:', tipo_transacao_id),IdUsuarioLogado);

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

INSERT INTO log (data,operacao_id,tabela,tipo_transacao_id) 
values (now(),3,concat('Idtipo_transacao:', Idtipo_transacao),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do tipo_transacao e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//



DROP PROCEDURE IF EXISTS CriarTipoUsuario//

CREATE PROCEDURE CriarTipoUsuario(_nome VARCHAR(255), IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
INSERT INTO tipo_usuario (nome) 
values (_nome);

INSERT INTO log (data,operacao_id,tabela,usuario_id) 
values (now(),1,concat('tipo_usuario' ,LAST_INSERT_ID()),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'Nome e usuario ser fornecidos para o cadastro do tipo_usuario!' AS Msg;
END IF; 
END;//

#Update tipo_usuario


DROP PROCEDURE IF EXISTS AtualizarTipoUsuario//

CREATE PROCEDURE AtualizarTipoUsuario(_nome VARCHAR(255), Idtipo_usuario int, IdUsuarioLogado int)
BEGIN
IF ((_nome != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
update tipo_usuario set nome = _nome where id = Idtipo_usuario;

INSERT INTO log (data,operacao_id,tabela,tipo_usuario_id) 
values (now(),2,concat('TipoUsuarioId:', Idtipo_usuario),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do tipo_usuario e do usuario deve ser fornecido para a atualização!' AS Msg;
END IF; 
END;//

#Deleta tipo_usuario


DROP PROCEDURE IF EXISTS DeletarTipoUsuario//

CREATE PROCEDURE DeletarTipoUsuario(Idtipo_usuario int, IdUsuarioLogado int)
BEGIN
IF ((Idtipo_usuario != '') && (IdUsuarioLogado != '')) THEN
IF((EXISTS(select 1 from tipo_usuario_usuario where Usuario_id = IdUsuarioLogado AND tipo_usuario_id = 1))) THEN
delete from tipo_usuario where id = Idtipo_usuario;

INSERT INTO log (data,operacao_id,tabela,tipo_usuario_id) 
values (now(),3,concat('tipo_usuario_id:', tipo_usuario_id),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id do tipo_usuario e do usuario deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//




DROP PROCEDURE IF EXISTS CriarTransacao//

CREATE PROCEDURE CriarTransacao(_usuario_id Int, _tipo_transacao_id int, _banco_origem_id int, _banco_destino_id int, _forma_pagamento_id int, _tipo_moeda int, _valor DECIMAL(8,2), IdUsuarioLogado int)
BEGIN
#verificar se todos os parametros foram passados
IF ((_usuario_id != '') && (_tipo_transacao_id != '') && (_banco_origem_id != '') && (_banco_destino_id != '') && (_forma_pagamento_id != '') && (_tipo_moeda != '') && (_valor != '') && (IdUsuarioLogado != '')) THEN
	#verificar se o usuario que quer adicionar é o mesmo que está "logado"
	IF(IdUsuarioLogado = _usuario_id) THEN
		#Pegar o tipo do usuario, importando apenas o mais "forte"
		SELECT  @TipoUsuario :=  Tipo_usuario_id FROM tipo_usuario_usuario where Usuario_id = _usuario_id order by tipo_usuario_id limit 1;
		
		#Pegar a quantidade de transaçõs nos ultimos 30 dias
		SELECT @QuantidadeTransacoesNoUltimoMes := COUNT(*) FROM transacao where transacao.Usuario_id = _usuario_id AND transacao.Data >= NOW() - INTERVAL 30 DAY;
		
		#se for admin pode tudo, se for Prime até 10 transações, se for Premium até 6 transações e se for Standard até 3 transações
		IF ((@TipoUsuario = 1) || 
			(@TipoUsuario = 2 && @QuantidadeTransacoesNoUltimoMes < 10) || 
			(@TipoUsuario = 3 && @QuantidadeTransacoesNoUltimoMes < 6) || 
			(@TipoUsuario = 4 && @QuantidadeTransacoesNoUltimoMes < 3))THEN
			INSERT INTO Transacao (Usuario_id,Tipo_transacao_id,Banco_origem_id,Banco_destino_id,Forma_pagamento_id,Tipo_moeda,Valor,Data) 
			values (_usuario_id,_tipo_transacao_id,_banco_origem_id,_banco_destino_id,_forma_pagamento_id,_tipo_moeda,_valor,(NOW()));

			INSERT INTO log (data,operacao_id,tabela,usuario_id) 
			values (now(),1,concat('Transacao - ID:' ,LAST_INSERT_ID()),IdUsuarioLogado);
		ELSE
			SELECT 'Você não pode mais realizar transações, mude de plano para continuar usando normalmente' AS Msg;
		END IF;

	ELSE
		SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
	END IF;
ELSE
SELECT 'Todos os campos devem ser fornecidos para o cadastro!' AS Msg;
END IF; 
END;//


#Deleta Transacao


DROP PROCEDURE IF EXISTS DeletarTransacao//

CREATE PROCEDURE DeletarTransacao(IdTransacao int, IdUsuarioLogado int)
BEGIN
IF (IdTransacao != '' && IdUsuarioLogado != '') THEN
IF(EXISTS(select 1 from Transacao where Usuario_id = IdUsuarioLogado AND id = IdTransacao)) THEN
	#passo 1: deletar a transação
	delete from Transacao where id = IdTransacao;

	#passo2: Gerar log	
	INSERT INTO log (data,operacao_id,tabela,Transacao_id) 
	values (now(),3,concat('Transacao_id:', IdTransacao),IdUsuarioLogado);

ELSE
	SELECT 'Usuário não tem permissão para realizar a opereção' AS Msg;
END IF;

ELSE
SELECT 'O Id da transação e o Id do usuário deve ser fornecido para a exclusão!' AS Msg;
END IF; 
END;//


#saldo do usuario por banco
DROP PROCEDURE IF EXISTS SaldoBancoPorUsuario//
CREATE PROCEDURE SaldoBancoPorUsuario(IdUsuario int, IdBanco int)
BEGIN
IF (IdUsuario != '' || IdBanco != '') THEN
select SUM(valor) from transacao
where transacao.Usuario_id = IdUsuario AND transacao.Banco_destino_id = IdBanco
GROUP by Usuario_id;

ELSE
SELECT 'O Id do usuário e banco deve ser fornecido para a verificar o saldo!' AS Msg;
END IF; 
END;//

#saldo total do usuario no sistema
DROP PROCEDURE IF EXISTS SaldoTotalUsuario//
CREATE PROCEDURE SaldoTotalUsuario(IdUsuario int)
BEGIN
IF (IdUsuario != '') THEN
select SUM(valor) from transacao
where transacao.Usuario_id = IdUsuario
GROUP by Usuario_id;

ELSE
SELECT 'O Id do usuário deve ser fornecido para a verificar o saldo total!' AS Msg;
END IF; 
END;//


#Transações realizadas pelo usuário no periodo passado 
DROP PROCEDURE IF EXISTS TransacoesUsuarioPorPeriodo//
CREATE PROCEDURE TransacoesUsuarioPorPeriodo(IdUsuario int, dataInicial DATETIME, dataFinal DATETIME)
BEGIN
IF (IdUsuario != '' && dataInicial != '' && dataFinal != '') THEN
select * from transacao
where transacao.Usuario_id = IdUsuario
AND transacao.Data >= dataInicial and transacao.Data <= dataFinal;

ELSE
SELECT 'O Id do usuário, data inicial e data final devem ser fornecidas para a verificar o saldo total!' AS Msg;
END IF; 
END;//



#Transações realizadas pelo usuário no periodo passado filtrando por banco
DROP PROCEDURE IF EXISTS TransacoesUsuarioPorPeriodoPorBanco//
CREATE PROCEDURE TransacoesUsuarioPorPeriodoPorBanco(IdUsuario int, IdBanco int, dataInicial DATETIME, dataFinal DATETIME)
BEGIN
	IF (IdUsuario != '' && dataInicial != '' && dataFinal != '' && IdBanco != '') THEN
		select * from transacao
		where transacao.Usuario_id = IdUsuario
		AND transacao.Banco_destino_id = IdBanco
		AND transacao.Data >= dataInicial 
		and transacao.Data <= dataFinal;

	ELSE
		SELECT 'O Id do usuário, id do Banco, data inicial e data final devem ser fornecidas para a verificar o saldo total!' AS Msg;
	END IF; 
END;//