-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 26/09/2024 às 17:33
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
) ENGINE=MyISAM AUTO_INCREMENT=49 DEFAULT CHARSET=utf8mb3;

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`, `email`, `telefone`, `data_nascimento`, `data_inicio`, `sexo`, `cpf`, `professor_id`) VALUES
(1, 'admin', 'admin', '655387240a70f.jpg', 'Alex Sandro', 2, 'alexsrs@gmail.com', '(21) 98989-0615', '1981-01-04', '2024-09-30', 'M', '086899137-69', 0),
(4, 'prof', 'prof', '65538e7ea62a1.jpg', 'Professor baitola', 1, 'prof@prof.com', '(21) 98989-0615', '2014-09-02', '2024-09-25', 'M', '086899137-69', 1),
(7, 'teste', 'teste', '66f2c68510739.jpg', 'Testando ', 0, 'teste@aluno.net', '(21) 98989-0615', '2024-09-05', '2024-09-11', 'F', '086899137-69', 1),
(15, 'joao', 'joao', '66f42cc21846d.jpg', 'Joao', 0, 'alexsrs@gmail.com', '(21) 98989-0615', '1981-01-04', '1982-02-05', 'M', '086899137-69', 4),
(16, 'prof2', 'prof2', '66f42d0c0dea8.jpg', 'professor 2', 1, 'cootidr@seap.rj.gov.br', '(21) 98989-0615', '1973-01-06', '2024-12-26', 'F', '086899137-69', 1),
(17, 'jkerbin ', '1234', '66f4a3ad8411e.jpeg', 'Jebediah Kerbin', 0, 'jkerbin@terra.com.br', '(21) 96787-0567', '1992-11-06', '2024-10-12', 'M', '121232343-79', 4);

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
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb3;

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
(17, '::1', '2024-09-24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_perfis_usuarios`
--

DROP TABLE IF EXISTS `tb_perfis_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_perfis_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `data_avaliacao` date NOT NULL,
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
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_perfis_usuarios`
--

INSERT INTO `tb_perfis_usuarios` (`id`, `usuario_id`, `data_avaliacao`, `peso`, `altura`, `obesidade`, `diabetes`, `hipertensao`, `depressao`, `pos_covid`, `idoso`, `gestante`, `posparto`, `emagrecer`) VALUES
(1, 1, '0000-00-00', 0, 0, 0, 0, 1, 1, 1, 0, 0, 0, 0),
(2, 17, '0000-00-00', 0, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0),
(3, 1, '0000-00-00', 69, 1, 0, 0, 1, 1, 0, 0, 0, 0, 0),
(4, 17, '2024-09-26', 69, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0);

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
