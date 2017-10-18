drop table if exists Funcionario;

create table Funcionario (
    id INT,
    nome VARCHAR(50),
    valor_hora DECIMAL(5,2),
    dependentes INT
);

insert into Funcionario (id, nome, valor_hora, dependentes) values (1, 'Archibaldo', 100.32, null);
insert into Funcionario (id, nome, valor_hora, dependentes) values (2, 'Adelina', 105.73, 0);
insert into Funcionario (id, nome, valor_hora, dependentes) values (3, 'Branden', 20.74, 2);
insert into Funcionario (id, nome, valor_hora, dependentes) values (4, 'Ham', 29.76, 5);
insert into Funcionario (id, nome, valor_hora, dependentes) values (5, 'Leif', 93.93, null);
insert into Funcionario (id, nome, valor_hora, dependentes) values (6, 'Ardis', 45.65, 4);
insert into Funcionario (id, nome, valor_hora, dependentes) values (7, 'Genvieve', 65.82, 1);
insert into Funcionario (id, nome, valor_hora, dependentes) values (8, 'Arni', 69.0, 0);
insert into Funcionario (id, nome, valor_hora, dependentes) values (9, 'Kimbell', 57.28, null);
insert into Funcionario (id, nome, valor_hora, dependentes) values (10, 'Ciro', 73.4, 3);
insert into Funcionario (id, nome, valor_hora, dependentes) values (11, 'Alastair', 114.05, 3);
insert into Funcionario (id, nome, valor_hora, dependentes) values (12, 'Alyssa', 76.34, 2);
insert into Funcionario (id, nome, valor_hora, dependentes) values (13, 'Ruttger', 61.45, 1);
insert into Funcionario (id, nome, valor_hora, dependentes) values (14, 'Levi', 111.13, null);
insert into Funcionario (id, nome, valor_hora, dependentes) values (15, 'Rachel', 67.27, 3);
insert into Funcionario (id, nome, valor_hora, dependentes) values (16, 'Erina', 100.39, null);
insert into Funcionario (id, nome, valor_hora, dependentes) values (17, 'Giulia', 59.32, 1);
insert into Funcionario (id, nome, valor_hora, dependentes) values (18, 'Gertruda', 93.83, 3);
insert into Funcionario (id, nome, valor_hora, dependentes) values (19, 'Alina', 44.92, null);
insert into Funcionario (id, nome, valor_hora, dependentes) values (20, 'Jeanne', 102.6, 1);