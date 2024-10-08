-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 08/10/2024 às 09:15
-- Versão do servidor: 8.3.0
-- Versão do PHP: 8.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `apcpro`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.online`
--

DROP TABLE IF EXISTS `tb_admin.online`;
CREATE TABLE IF NOT EXISTS `tb_admin.online` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `ultima_acao`, `token`) VALUES
(90, '::1', '2024-10-07 13:29:36', '6703ffd2d5dc5');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.usuarios`
--

DROP TABLE IF EXISTS `tb_admin.usuarios`;
CREATE TABLE IF NOT EXISTS `tb_admin.usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int NOT NULL,
  `email` varchar(90) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_inicio` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `cpf` varchar(30) NOT NULL,
  `professor_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `professor_id` (`professor_id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`, `email`, `telefone`, `data_nascimento`, `data_inicio`, `sexo`, `cpf`, `professor_id`) VALUES
(1, 'admin', 'admin', '655387240a70f.jpg', 'Alex Sandro', 2, 'alexsrs@gmail.com', '(21) 98989-0615', '1981-01-04', '2024-09-30', 'M', '086.899.137-69', 0),
(4, 'prof', 'prof', '65538e7ea62a1.jpg', 'Professor baitola', 1, 'prof@prof.com', '(21) 98989-0615', '2014-09-02', '2024-09-25', 'M', '086899137-69', 1),
(7, 'teste', 'teste', '66f2c68510739.jpg', 'Testando ', 0, 'teste@aluno.net', '(21) 98989-0615', '2024-09-05', '2024-09-11', 'F', '086899137-69', 1),
(15, 'joao', 'joao', '66f42cc21846d.jpg', 'Joao', 0, 'alexsrs@gmail.com', '(21) 98989-0615', '1981-01-04', '1982-02-05', 'M', '086899137-69', 4),
(16, 'prof2', 'prof2', '66f42d0c0dea8.jpg', 'professor 2', 1, 'cootidr@seap.rj.gov.br', '(21) 98989-0615', '1973-01-06', '2024-12-26', 'F', '086899137-69', 1),
(17, 'jkerbin ', '1234', '66f4a3ad8411e.jpeg', 'Jebediah Kerbin', 0, 'jkerbin@terra.com.br', '(21) 96787-0567', '1992-11-06', '2024-10-12', 'M', '121232343-79', 4),
(18, 'zuka', '1234', '66f5a7e46eace.png', 'Zuka da Silva sauro', 1, 'zuka@dell.com', '(21) 95499-1323', '1967-09-01', '2025-01-12', 'F', '111.222.333-44', 1),
(19, 'teste0', 'teste0', '66ff3eb0994ea.jpeg', 'Teste 0', 1, 'cootidr@seap.rj.gov.br', '(21) 32346-260', '1937-10-03', '2024-11-06', ' ', '111.111.111-11', 1),
(20, 'fernanda', 'fernanda', '', 'Fernanda', 1, 'alexsrs@gmail.com', '(21) 98487-0182', '1985-07-05', '2024-11-08', 'F', '111.111.111-11', 1),
(21, 'sofia', 'sofia', '', 'sofia', 1, 'sofia@teste.com', '(11) 11111-1111', '2007-02-07', '2024-11-04', 'F', '111.111.111-11', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.visitas`
--

DROP TABLE IF EXISTS `tb_admin.visitas`;
CREATE TABLE IF NOT EXISTS `tb_admin.visitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=24 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_admin.visitas`
--

INSERT INTO `tb_admin.visitas` (`id`, `ip`, `dia`) VALUES
(1, '::1', '2023-04-04'),
(2, '::1', '2023-04-04'),
(3, '::1', '2023-04-04'),
(4, '::1', '2023-04-04'),
(5, '::1', '2023-04-05'),
(6, '::1', '2023-04-05'),
(7, '::1', '2023-04-12'),
(8, '::1', '2023-07-05'),
(9, '::1', '2023-07-26'),
(10, '::1', '2023-11-08'),
(11, '192.168.0.101', '2023-11-14'),
(12, '::1', '2023-11-21'),
(13, '::1', '2023-11-29'),
(14, '::1', '2024-09-24'),
(15, '::1', '2024-09-24'),
(16, '::1', '2024-09-24'),
(17, '::1', '2024-09-24'),
(18, '::1', '2024-10-05'),
(19, '::1', '2024-10-05'),
(20, '::1', '2024-10-05'),
(21, '::1', '2024-10-05'),
(22, '::1', '2024-10-05'),
(23, '::1', '2024-10-05');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_objetivos_treinamento`
--

DROP TABLE IF EXISTS `tb_objetivos_treinamento`;
CREATE TABLE IF NOT EXISTS `tb_objetivos_treinamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `objetivo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_objetivos_treinamento`
--

INSERT INTO `tb_objetivos_treinamento` (`id`, `objetivo`) VALUES
(1, 'Melhora do condicionamento físico'),
(2, 'Perda de peso'),
(3, 'Fortalecimento muscular'),
(4, 'Definição muscular'),
(5, 'Ganho de massa muscular'),
(6, 'Diminuição do risco de doenças cardiovasculares e metabólicas'),
(7, 'Melhora do aspecto físico e social'),
(8, 'Melhorar a sua qualidade de vida'),
(9, 'Alto rendimento físico-esportivo'),
(10, 'superliga voley');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_perfis_usuarios`
--

DROP TABLE IF EXISTS `tb_perfis_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_perfis_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `data_avaliacao` datetime NOT NULL,
  `peso` float NOT NULL,
  `altura` float NOT NULL,
  `obesidade` tinyint(1) NOT NULL,
  `diabetes` tinyint(1) NOT NULL,
  `hipertensao` tinyint(1) NOT NULL,
  `depressao` tinyint(1) NOT NULL,
  `pos_covid` tinyint(1) NOT NULL,
  `idoso` tinyint(1) NOT NULL,
  `gestante` tinyint(1) NOT NULL,
  `posparto` tinyint(1) NOT NULL,
  `emagrecer` tinyint(1) NOT NULL,
  `objetivo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`),
  KEY `objetivo_id` (`objetivo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_perfis_usuarios`
--

INSERT INTO `tb_perfis_usuarios` (`id`, `usuario_id`, `data_avaliacao`, `peso`, `altura`, `obesidade`, `diabetes`, `hipertensao`, `depressao`, `pos_covid`, `idoso`, `gestante`, `posparto`, `emagrecer`, `objetivo_id`) VALUES
(1, 1, '0000-00-00 00:00:00', 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0, 0),
(2, 17, '0000-00-00 00:00:00', 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(3, 1, '0000-00-00 00:00:00', 69, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0),
(4, 17, '2024-09-26 00:00:00', 69, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 1, '2024-09-26 00:00:00', 115, 1.73, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0),
(6, 1, '2024-09-26 00:00:00', 89.3, 1.79, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(7, 1, '2024-09-26 00:00:00', 65.2, 1.78, 0, 0, 0, 1, 0, 0, 0, 0, 0, 9),
(8, 17, '2024-09-26 00:00:00', 795, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(9, 17, '2024-09-26 18:08:17', 89.2, 2.01, 1, 1, 0, 0, 1, 0, 0, 0, 1, 9),
(10, 1, '2024-09-26 00:00:00', 12, 1.1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5),
(11, 1, '2024-09-26 20:03:38', 90, 1.91, 0, 0, 1, 0, 0, 0, 0, 0, 0, 9),
(12, 1, '2024-10-02 10:27:07', 40, 1.47, 1, 1, 1, 1, 1, 0, 1, 1, 1, 6),
(13, 1, '2024-10-02 10:31:44', 299.9, 1.2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9),
(14, 1, '2024-10-05 21:40:58', 50, 1.5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 8),
(15, 1, '2024-10-05 21:43:21', 50, 1.5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 9),
(16, 1, '2024-10-05 21:49:47', 50, 1.5, 0, 0, 0, 0, 0, 0, 1, 0, 0, 4),
(17, 1, '2024-10-05 22:02:30', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 1, 0, 8),
(18, 1, '2024-10-05 22:04:54', 50, 1.5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 8),
(19, 1, '2024-10-05 22:05:36', 50, 1.5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 8),
(20, 1, '2024-10-05 22:06:45', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 1, 8),
(21, 1, '2024-10-05 22:16:02', 88, 1.85, 0, 0, 0, 1, 0, 0, 0, 0, 0, 7),
(22, 1, '2024-10-05 22:16:12', 50, 1.5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10),
(23, 1, '2024-10-07 10:13:16', 50, 1.5, 1, 1, 0, 0, 0, 0, 0, 0, 0, 9),
(24, 1, '2024-10-07 10:16:35', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5),
(25, 1, '2024-10-07 10:19:28', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 9),
(26, 1, '2024-10-07 10:24:15', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7),
(27, 1, '2024-10-07 10:25:31', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7),
(28, 1, '2024-10-07 10:26:30', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8),
(29, 1, '2024-10-07 10:39:36', 50, 1.5, 0, 0, 0, 0, 0, 1, 0, 0, 0, 9),
(30, 1, '2024-10-07 10:40:42', 50, 1.5, 0, 0, 0, 0, 0, 1, 0, 0, 0, 8),
(31, 1, '2024-10-07 10:48:04', 50, 1.5, 0, 0, 0, 0, 0, 1, 0, 0, 0, 4),
(32, 1, '2024-10-07 10:49:02', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8),
(33, 1, '2024-10-07 10:51:30', 50, 1.5, 0, 0, 0, 0, 0, 1, 0, 0, 0, 7),
(34, 1, '2024-10-07 10:54:18', 50, 1.5, 0, 0, 0, 0, 0, 1, 0, 0, 0, 2),
(35, 1, '2024-10-07 10:54:46', 160.1, 2.37, 0, 0, 0, 0, 0, 1, 0, 0, 0, 8),
(36, 1, '2024-10-07 11:06:43', 50, 1.5, 1, 0, 0, 0, 0, 1, 0, 0, 0, 8),
(37, 1, '2024-10-07 11:06:50', 50, 1.5, 1, 0, 1, 0, 0, 1, 0, 0, 0, 8),
(38, 1, '2024-10-07 11:17:45', 50, 1.5, 0, 1, 0, 0, 1, 0, 0, 0, 0, 3),
(39, 1, '2024-10-07 11:18:20', 163.4, 2.15, 0, 0, 0, 0, 0, 0, 0, 1, 0, 10),
(40, 1, '2024-10-07 11:18:44', 50, 1.5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 10),
(41, 1, '2024-10-07 11:18:56', 50, 1.5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 5),
(42, 1, '2024-10-07 11:19:44', 166.7, 2, 1, 1, 0, 0, 0, 0, 0, 0, 0, 1),
(43, 1, '2024-10-07 11:19:58', 50, 1.5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 6),
(44, 1, '2024-10-07 11:23:40', 50, 1.5, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(45, 1, '2024-10-07 11:24:03', 50, 1.5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 2),
(46, 1, '2024-10-07 11:28:51', 50, 1.5, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(47, 1, '2024-10-07 11:28:56', 50, 1.5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(48, 1, '2024-10-07 11:29:01', 50, 1.5, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(49, 1, '2024-10-07 11:29:05', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(50, 1, '2024-10-07 11:29:10', 50, 1.5, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(51, 1, '2024-10-07 11:29:24', 50, 1.5, 1, 1, 0, 0, 0, 0, 0, 0, 0, 4),
(52, 1, '2024-10-07 11:32:14', 50, 1.5, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(53, 1, '2024-10-07 11:32:32', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0),
(54, 1, '2024-10-07 11:35:16', 50, 1.5, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(55, 1, '2024-10-07 11:36:57', 50, 1.5, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(56, 1, '2024-10-07 11:37:21', 50, 1.5, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0),
(57, 1, '2024-10-07 11:38:09', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0),
(58, 1, '2024-10-07 11:44:50', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0),
(59, 1, '2024-10-07 12:30:14', 50, 1.5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 9),
(60, 1, '2024-10-07 12:32:54', 50, 1.5, 0, 0, 0, 0, 1, 0, 0, 0, 0, 5),
(61, 1, '2024-10-07 13:29:45', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_site.depoimentos`
--

DROP TABLE IF EXISTS `tb_site.depoimentos`;
CREATE TABLE IF NOT EXISTS `tb_site.depoimentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `depoimento` text NOT NULL,
  `data` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_site.depoimentos`
--

INSERT INTO `tb_site.depoimentos` (`id`, `nome`, `depoimento`, `data`) VALUES
(1, 'alex', 'testando inserção de depoimentos', ''),
(2, 'jose', 'testando com data', '05/04/2023'),
(3, 'Testonildo', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '29/11/2023'),
(4, 'Alex Sandro Ribeiro de souza', 'deixa pra lá', '27/11/2023');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
