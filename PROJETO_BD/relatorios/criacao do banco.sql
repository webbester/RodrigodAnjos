-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 26-Nov-2017 às 17:16
-- Versão do servidor: 10.1.10-MariaDB
-- PHP Version: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transacoes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `transacao`
--

CREATE TABLE `transacao` (
  `Id` int(11) NOT NULL,
  `Usuario_id` int(11) NOT NULL,
  `Tipo_transacao_id` int(11) NOT NULL,
  `Banco_origem_id` int(11) NOT NULL,
  `Banco_destino_id` int(11) NOT NULL,
  `Forma_pagamento_id` int(11) NOT NULL,
  `Tipo_moeda_id` int(11) NOT NULL,
  `Valor` decimal(8,2) NOT NULL,
  `Data` datetime NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `categoria_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `transacao`
--

INSERT INTO `transacao` (`Id`, `Usuario_id`, `Tipo_transacao_id`, `Banco_origem_id`, `Banco_destino_id`, `Forma_pagamento_id`, `Tipo_moeda_id`, `Valor`, `Data`, `descricao`, `categoria_id`) VALUES
(1, 1, 1, 1, 1, 2, 1, '10.00', '2017-09-24 18:48:40', '', 1),
(2, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:48:49', '', 1),
(3, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:50:40', '', 1),
(4, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:52:25', '', 1),
(5, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:52:37', '', 1),
(6, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:52:42', '', 1),
(7, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:52:44', '', 1),
(8, 1, 1, 1, 1, 1, 2, '10.00', '2017-09-24 18:53:04', '', 1),
(9, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:53:08', '', 2),
(10, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:53:11', '', 1),
(11, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:53:14', '', 4),
(12, 1, 1, 1, 3, 1, 1, '10.00', '2017-09-24 18:53:16', '', 1),
(13, 1, 3, 2, 1, 1, 1, '10.00', '2017-09-24 18:53:19', '', 1),
(14, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:53:21', '', 1),
(15, 1, 2, 1, 1, 1, 1, '10.00', '2017-09-24 18:53:28', '', 1),
(16, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:53:30', '', 1),
(17, 1, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:53:33', '', 3),
(18, 2, 1, 1, 1, 2, 1, '10.00', '2017-09-24 18:54:00', '', 1),
(19, 2, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:54:03', '', 1),
(20, 2, 1, 1, 1, 1, 2, '10.00', '2017-09-24 18:54:06', '', 1),
(21, 2, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:54:08', '', 1),
(22, 2, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:54:11', '', 1),
(23, 2, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:54:13', '', 1),
(24, 2, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:58:11', '', 1),
(25, 2, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:58:17', '', 1),
(26, 2, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:58:24', '', 1),
(27, 2, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:58:31', '', 1),
(28, 4, 1, 1, 1, 1, 1, '10.00', '2017-09-24 18:59:58', '', 1),
(29, 4, 1, 1, 1, 1, 1, '10.00', '2017-09-24 19:00:03', '', 1),
(30, 4, 1, 1, 1, 1, 1, '10.00', '2017-09-24 19:00:06', '', 1),
(31, 1, 1, 1, 1, 1, 1, '20.00', '2017-09-24 19:32:28', '', 1),
(32, 1, 3, 1, 1, 1, 1, '20.00', '2017-09-24 19:33:48', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transacao`
--
ALTER TABLE `transacao`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Transacao_fk0` (`Usuario_id`),
  ADD KEY `Transacao_fk1` (`Tipo_transacao_id`),
  ADD KEY `Transacao_fk2` (`Banco_origem_id`),
  ADD KEY `Transacao_fk3` (`Banco_destino_id`),
  ADD KEY `Transacao_fk4` (`Forma_pagamento_id`),
  ADD KEY `Transacao_fk5` (`Tipo_moeda_id`),
  ADD KEY `Transacao_Categoria` (`categoria_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transacao`
--
ALTER TABLE `transacao`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `transacao`
--
ALTER TABLE `transacao`
  ADD CONSTRAINT `Transacao_Categoria` FOREIGN KEY (`categoria_id`) REFERENCES `categoria` (`Id`),
  ADD CONSTRAINT `Transacao_fk0` FOREIGN KEY (`Usuario_id`) REFERENCES `usuario` (`Id`),
  ADD CONSTRAINT `Transacao_fk1` FOREIGN KEY (`Tipo_transacao_id`) REFERENCES `tipo_transacao` (`Id`),
  ADD CONSTRAINT `Transacao_fk2` FOREIGN KEY (`Banco_origem_id`) REFERENCES `banco` (`Id`),
  ADD CONSTRAINT `Transacao_fk3` FOREIGN KEY (`Banco_destino_id`) REFERENCES `banco` (`Id`),
  ADD CONSTRAINT `Transacao_fk4` FOREIGN KEY (`Forma_pagamento_id`) REFERENCES `forma_pagamento` (`Id`),
  ADD CONSTRAINT `Transacao_fk5` FOREIGN KEY (`Tipo_moeda_id`) REFERENCES `tipo_moeda` (`Id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
