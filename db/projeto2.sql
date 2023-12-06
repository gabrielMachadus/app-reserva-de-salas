-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 05-Dez-2018 às 19:58
-- Versão do servidor: 10.1.36-MariaDB
-- versão do PHP: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projeto2`
--
CREATE DATABASE IF NOT EXISTS `projeto2` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `projeto2`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `colaborador`
--
-- Criação: 14-Nov-2018 às 09:11
--

DROP TABLE IF EXISTS `colaborador`;
CREATE TABLE IF NOT EXISTS `colaborador` (
  `id_colaborador` int(11) NOT NULL AUTO_INCREMENT,
  `nome_completo` varchar(45) NOT NULL,
  `id_funcao` int(11) NOT NULL,
  `telefone` varchar(16) NOT NULL DEFAULT '(51)00000-0000',
  `id_empresa` int(11) NOT NULL DEFAULT '1',
  `email` varchar(45) NOT NULL DEFAULT 'teste@teste.com.br',
  PRIMARY KEY (`id_colaborador`),
  KEY `fk_empresa` (`id_empresa`),
  KEY `fk_funcao` (`id_funcao`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `colaborador`:
--   `id_empresa`
--       `empresa` -> `id_empresa`
--   `id_funcao`
--       `funcao` -> `id_funcao`
--

--
-- Truncate table before insert `colaborador`
--

TRUNCATE TABLE `colaborador`;
--
-- Extraindo dados da tabela `colaborador`
--

INSERT INTO `colaborador` (`id_colaborador`, `nome_completo`, `id_funcao`, `telefone`, `id_empresa`, `email`) VALUES
(1, 'GABRIEL MACHADO DA SILVA', 1, '(51)9927-0734', 1, 'gabrielmachadodasilva97@gmail.com'),
(2, 'JOAO MARCOS GODOI', 2, '(51)3471-2892', 1, 'jm.godoi@empresa.com.br'),
(5, 'MARIANA TEIXEIRA', 2, '(51)92894-4065', 1, 'mariana.teixeira@teste.com'),
(11, 'CARLOS JOAO MACHADO', 2, '(51)5192-0651', 1, 'carlos.machado@empresa.com.br'),
(12, 'JOSE MACHADO DA SILVA', 4, '(11)5616-5651', 1, 'gabrielgamerlive@gmail.com'),
(17, 'JAIR MESSIAS BOLSONARO', 4, '(23)4234-2342', 1, 'joao@maul.com'),
(18, 'MARILDA SOARES DA ROSA', 4, '(32)4234-2323', 1, 'marilda.rosa@yahoo.com'),
(19, 'MARCIO RAMIRES GONÇALVES', 2, '(51)51551-5661', 1, 'marcio_goncalves@mail.com'),
(20, 'MARIA INÊS SOUZA', 1, '(55)15615-1566', 1, 'maria.ines@empresa.com'),
(25, 'ROGERIO OLIVEIRA', 6, '(51)98490-1833', 5, 'rogerio@baduchi.com.br'),
(26, 'JAIR BOLSONARO DA SILVA', 1, '(51)33039-991', 5, 'capitao@baduchi.com.br'),
(27, 'JOÃO CARLOS DA SILVEIRA', 2, '(51)94133-2656', 4, 'joao.silveira@umemail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--
-- Criação: 14-Nov-2018 às 09:11
--

DROP TABLE IF EXISTS `empresa`;
CREATE TABLE IF NOT EXISTS `empresa` (
  `id_empresa` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(35) NOT NULL,
  `cnpj` varchar(30) NOT NULL,
  `fone` varchar(15) NOT NULL,
  `endereco` text NOT NULL,
  PRIMARY KEY (`id_empresa`),
  UNIQUE KEY `nome_unique` (`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `empresa`:
--

--
-- Truncate table before insert `empresa`
--

TRUNCATE TABLE `empresa`;
--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id_empresa`, `nome`, `cnpj`, `fone`, `endereco`) VALUES
(1, 'SENAI', '12.312.312/3123-11', '(51)27123-2122', 'Av. Assis Brasil, 8787 - Porto Alegre - RS'),
(2, 'FATEC', '12.312.312/3123-12', '(51)23153-2122', 'Porto Alegre - RS'),
(3, 'FIERGS', '12.312.312/3123-13', '(51)23123-2122', 'Av. Assis Brasil, 8787 - Porto Alegre - RS'),
(4, 'NENHUMA', '00.000.000/0000-00', '(00)00000-0000', 'N/C'),
(5, 'BADUCHI - PORTO ALEGRE', '12.312.312/3123-12', '(51)99336-0197', 'av. torquato severo, 111, anchieta, porto alegre - rs'),
(6, 'COCA COLA DO BRASIL', '91.722.116/0001-90', '(51)33039-991', 'av. ceara, 1987');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcao`
--
-- Criação: 14-Nov-2018 às 09:11
--

DROP TABLE IF EXISTS `funcao`;
CREATE TABLE IF NOT EXISTS `funcao` (
  `id_funcao` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) NOT NULL,
  PRIMARY KEY (`id_funcao`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `funcao`:
--

--
-- Truncate table before insert `funcao`
--

TRUNCATE TABLE `funcao`;
--
-- Extraindo dados da tabela `funcao`
--

INSERT INTO `funcao` (`id_funcao`, `nome`) VALUES
(1, 'Administrador'),
(2, 'Professor'),
(3, 'Auxiliar de Limpeza'),
(4, 'Coordenador'),
(5, 'Auxiliar de TI'),
(6, 'Gerente de TI'),
(7, 'Diretor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `reserva`
--
-- Criação: 14-Nov-2018 às 09:11
--

DROP TABLE IF EXISTS `reserva`;
CREATE TABLE IF NOT EXISTS `reserva` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_colaborador` int(11) NOT NULL,
  `id_sala` int(11) NOT NULL,
  `id_turno` int(11) NOT NULL DEFAULT '3',
  `data_hora_registro` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `hora_entrada` time DEFAULT NULL,
  `hora_saida` time DEFAULT NULL,
  `data_reserva` date NOT NULL,
  `ativo` tinyint(4) NOT NULL,
  PRIMARY KEY (`id_reserva`),
  UNIQUE KEY `nao_duplica` (`id_colaborador`,`id_sala`,`id_turno`,`hora_entrada`,`hora_saida`,`data_reserva`),
  KEY `fk_id_sala_reserva` (`id_sala`),
  KEY `fk_id_turno_reserva` (`id_turno`),
  KEY `fk_id_colaborador` (`id_colaborador`)
) ENGINE=InnoDB AUTO_INCREMENT=54 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `reserva`:
--   `id_colaborador`
--       `colaborador` -> `id_colaborador`
--   `id_sala`
--       `sala` -> `id_sala`
--   `id_turno`
--       `turno` -> `id_turno`
--

--
-- Truncate table before insert `reserva`
--

TRUNCATE TABLE `reserva`;
--
-- Extraindo dados da tabela `reserva`
--

INSERT INTO `reserva` (`id_reserva`, `id_colaborador`, `id_sala`, `id_turno`, `data_hora_registro`, `hora_entrada`, `hora_saida`, `data_reserva`, `ativo`) VALUES
(7, 12, 3, 1, '2018-10-17 00:15:00', '08:25:00', '12:30:00', '2018-10-17', 0),
(32, 17, 12, 3, '2018-11-14 00:13:00', '21:00:00', '22:30:00', '2018-11-14', 1),
(33, 2, 12, 3, '2018-11-14 00:13:00', '18:00:00', '20:30:00', '2018-11-14', 1),
(34, 5, 12, 3, '2018-11-14 00:14:00', '20:35:00', '20:50:00', '2018-11-14', 1),
(35, 2, 12, 2, '2018-11-14 00:15:00', '16:00:00', '18:50:00', '2018-11-14', 1),
(36, 11, 5, 2, '2018-11-19 16:39:00', '13:00:00', '17:50:00', '2018-11-14', 1),
(37, 17, 10, 2, '2018-11-26 10:30:00', '13:00:00', '17:50:00', '2018-11-26', 1),
(38, 26, 6, 3, '2018-11-26 10:30:00', '19:00:00', '22:30:00', '2018-11-26', 1),
(39, 11, 5, 3, '2018-11-26 10:30:00', '19:00:00', '22:30:00', '2018-11-26', 0),
(40, 19, 15, 3, '2018-11-26 10:30:00', '19:00:00', '22:30:00', '2018-11-26', 1),
(41, 11, 5, 3, '2018-11-26 10:31:00', '19:00:00', '22:30:00', '2018-11-27', 0),
(42, 11, 5, 1, '2018-11-26 10:31:00', '07:00:00', '12:00:00', '2018-11-26', 0),
(43, 18, 13, 2, '2018-11-26 10:31:00', '13:00:00', '17:50:00', '2018-11-26', 1),
(44, 25, 5, 3, '2018-11-26 10:31:00', '19:00:00', '22:30:00', '2018-11-30', 1),
(45, 1, 5, 3, '2018-11-26 11:18:00', '19:00:00', '22:30:00', '2018-11-26', 1),
(46, 11, 14, 2, '2018-12-03 14:06:00', '15:00:00', '17:50:00', '2018-12-03', 1),
(47, 17, 16, 3, '2018-12-05 08:59:00', '19:00:00', '22:30:00', '2018-12-05', 1),
(48, 27, 16, 2, '2018-12-05 09:00:00', '13:00:00', '14:00:00', '2018-12-05', 1),
(49, 26, 16, 2, '2018-12-05 09:00:00', '14:10:00', '17:50:00', '2018-12-05', 1),
(50, 2, 16, 3, '2018-12-05 09:00:00', '17:55:00', '18:45:00', '2018-12-05', 1),
(51, 27, 4, 1, '2018-12-05 11:53:00', '10:00:00', '12:00:00', '2018-12-05', 1),
(52, 27, 8, 1, '2018-12-05 11:53:00', '07:00:00', '12:00:00', '2018-12-05', 1),
(53, 18, 21, 1, '2018-12-05 11:54:00', '07:00:00', '12:00:00', '2018-12-05', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sala`
--
-- Criação: 14-Nov-2018 às 09:11
--

DROP TABLE IF EXISTS `sala`;
CREATE TABLE IF NOT EXISTS `sala` (
  `id_sala` int(11) NOT NULL AUTO_INCREMENT,
  `n_sala` int(11) NOT NULL,
  `andar` int(11) DEFAULT NULL,
  `id_tipo` int(11) NOT NULL,
  `computadores` int(11) NOT NULL DEFAULT '1',
  `lugares` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_sala`),
  UNIQUE KEY `n_sala` (`n_sala`),
  KEY `fk_tipo_sala` (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `sala`:
--   `id_tipo`
--       `tipo_sala` -> `id_tipo`
--

--
-- Truncate table before insert `sala`
--

TRUNCATE TABLE `sala`;
--
-- Extraindo dados da tabela `sala`
--

INSERT INTO `sala` (`id_sala`, `n_sala`, `andar`, `id_tipo`, `computadores`, `lugares`) VALUES
(3, 210, 2, 1, 1, 10),
(4, 300, 3, 2, 30, 30),
(5, 32, 0, 1, 20, 30),
(6, 110, 1, 3, 0, 20),
(8, 220, 2, 3, 0, 10),
(9, 230, 2, 2, 25, 25),
(10, 240, 2, 1, 1, 50),
(11, 330, 3, 3, 1, 15),
(12, 200, 2, 4, 1, 500),
(13, 350, 3, 2, 20, 30),
(14, 310, 3, 2, 15, 15),
(15, 320, 3, 1, 1, 35),
(16, 130, 1, 2, 20, 40),
(17, 120, 1, 2, 20, 40),
(18, 340, 3, 2, 10, 25),
(21, 140, 1, 1, 1, 50);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_sala`
--
-- Criação: 14-Nov-2018 às 09:11
--

DROP TABLE IF EXISTS `tipo_sala`;
CREATE TABLE IF NOT EXISTS `tipo_sala` (
  `id_tipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id_tipo`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `tipo_sala`:
--

--
-- Truncate table before insert `tipo_sala`
--

TRUNCATE TABLE `tipo_sala`;
--
-- Extraindo dados da tabela `tipo_sala`
--

INSERT INTO `tipo_sala` (`id_tipo`, `nome`) VALUES
(1, 'Sala de Aula'),
(2, 'Laboratório'),
(3, 'Sala de Reuniões'),
(4, 'Auditório');

-- --------------------------------------------------------

--
-- Estrutura da tabela `turno`
--
-- Criação: 14-Nov-2018 às 09:11
--

DROP TABLE IF EXISTS `turno`;
CREATE TABLE IF NOT EXISTS `turno` (
  `id_turno` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `hora_inicio` time DEFAULT NULL,
  `hora_fim` time DEFAULT NULL,
  PRIMARY KEY (`id_turno`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `turno`:
--

--
-- Truncate table before insert `turno`
--

TRUNCATE TABLE `turno`;
--
-- Extraindo dados da tabela `turno`
--

INSERT INTO `turno` (`id_turno`, `nome`, `hora_inicio`, `hora_fim`) VALUES
(1, 'Manhã', '08:00:00', '12:00:00'),
(2, 'Tarde', '13:00:00', '17:30:00'),
(3, 'Noite', '19:00:00', '22:30:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--
-- Criação: 14-Nov-2018 às 09:11
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(20) NOT NULL,
  `senha` varchar(20) NOT NULL DEFAULT 'QWas12@#',
  `id_colaborador` int(11) NOT NULL,
  `nivel_acesso` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `id_usuario_nome_UNIQUE` (`id_usuario`,`nome`,`id_colaborador`),
  UNIQUE KEY `id_colaborador_username_UNIQUE` (`id_colaborador`,`nome`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- RELATIONSHIPS FOR TABLE `usuario`:
--   `id_colaborador`
--       `colaborador` -> `id_colaborador`
--

--
-- Truncate table before insert `usuario`
--

TRUNCATE TABLE `usuario`;
--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome`, `senha`, `id_colaborador`, `nivel_acesso`) VALUES
(1, 'admin', 'QWas12@#', 1, 1),
(2, '2roliv', '1234', 25, 2),
(9, 'goku', '123qwe', 5, 2),
(17, 'MITO', 'brasil2019', 17, 1);

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `colaborador`
--
ALTER TABLE `colaborador`
  ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`),
  ADD CONSTRAINT `fk_funcao` FOREIGN KEY (`id_funcao`) REFERENCES `funcao` (`id_funcao`);

--
-- Limitadores para a tabela `reserva`
--
ALTER TABLE `reserva`
  ADD CONSTRAINT `fk_id_colaborador_reserva` FOREIGN KEY (`id_colaborador`) REFERENCES `colaborador` (`id_colaborador`),
  ADD CONSTRAINT `fk_id_sala_reserva` FOREIGN KEY (`id_sala`) REFERENCES `sala` (`id_sala`),
  ADD CONSTRAINT `fk_id_turno_reserva` FOREIGN KEY (`id_turno`) REFERENCES `turno` (`id_turno`);

--
-- Limitadores para a tabela `sala`
--
ALTER TABLE `sala`
  ADD CONSTRAINT `fk_tipo_sala` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_sala` (`id_tipo`);

--
-- Limitadores para a tabela `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `fk_pessoa` FOREIGN KEY (`id_colaborador`) REFERENCES `colaborador` (`id_colaborador`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
