create table Faturamento (
    id_projeto			INT,
    id_funcionario		INT,
    dia					DATE,
    horas				INT
);

create table Funcionario (
    id					INT,
    nome				VARCHAR(50),
    valor_hora			DECIMAL(5,2),
    dependentes			INT
);

create table Projeto (
    id					INT,
    nome 				VARCHAR(50)
);

insert into Projeto (id, nome) values (1, 'Stringtough');
insert into Projeto (id, nome) values (2, 'Biodex');
insert into Projeto (id, nome) values (3, 'Namfix');
insert into Projeto (id, nome) values (4, 'Hatity');
insert into Projeto (id, nome) values (5, 'Daltfresh');
insert into Projeto (id, nome) values (6, 'Transcof');
insert into Projeto (id, nome) values (7, 'Quo Lux');
insert into Projeto (id, nome) values (8, 'Bamity');
insert into Projeto (id, nome) values (9, 'Regrant');
insert into Projeto (id, nome) values (10, 'Tresom');
------------------------------------------------------------
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

----------------------------------------------------------------------------------------------------------------------------------------
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (2, 5, '2017-10-12', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (7, 65, '2017-08-16', 6);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (16, 23, '2016-03-03', 12);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (12, 66, '2016-05-07', 3);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (13, 77, '2016-02-21', 12);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (10, 73, '2016-06-08', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (12, 39, '2016-07-18', 10);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (17, 56, '2016-04-06', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (11, 96, '2017-06-07', 11);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (7, 22, '2016-10-03', 7);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (5, 10, '2015-12-20', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (20, 93, '2015-10-03', 9);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (4, 22, '2017-06-07', 1);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (10, 32, '2017-07-06', 7);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (3, 25, '2017-11-10', 9);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (2, 96, '2017-04-25', 1);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (10, 98, '2016-08-25', 1);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (13, 8, '2017-01-18', 1);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (18, 82, '2015-04-02', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (10, 80, '2017-09-21', 10);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (13, 30, '2015-05-26', 1);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (17, 21, '2016-10-06', 8);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (19, 79, '2017-11-29', 8);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (10, 84, '2016-03-11', 10);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (2, 33, '2017-03-17', 4);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (9, 58, '2015-04-15', 15);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (5, 10, '2015-07-03', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (20, 32, '2016-11-10', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (14, 74, '2016-05-13', 2);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (15, 42, '2016-05-02', 10);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (10, 90, '2017-09-26', 6);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (12, 74, '2017-10-22', 13);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (5, 59, '2016-03-22', 12);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (5, 96, '2017-06-03', 3);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (14, 26, '2016-05-26', 8);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (3, 41, '2015-02-17', 14);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (14, 50, '2015-08-04', 9);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (17, 6, '2016-05-20', 4);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (2, 42, '2016-05-15', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (13, 72, '2015-11-21', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (9, 23, '2016-03-12', 6);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (13, 9, '2016-06-04', null);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (6, 71, '2016-08-12', 3);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (16, 28, '2016-08-11', 9);
insert into Faturamento (id_projeto, id_funcionario, dia, horas) values (17, 22, '2016-05-16', 10);