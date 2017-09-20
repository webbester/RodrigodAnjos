create table funcionarios
(
	id			integer auto_increment primary key,
	nome		varchar(50),
	cargo		varchar(20),
	salario		decimal(5,2)
);

DELIMITER //

-- procedure cadastar
create procedure cadastar_funcionario
(
	in nome			varchar(50),
	in cargo		varchar(20),
	in salario		decimal(5,2),
)
begin
	insert into funcionarios values(null, nome, cargo, salario);
end //