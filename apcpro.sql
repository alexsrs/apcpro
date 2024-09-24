-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 24-Set-2024 às 16:41
-- Versão do servidor: 8.0.31
-- versão do PHP: 7.4.33

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
-- Estrutura da tabela `tb_admin.online`
--

DROP TABLE IF EXISTS `tb_admin.online`;
CREATE TABLE IF NOT EXISTS `tb_admin.online` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `ultima_acao` datetime NOT NULL,
  `token` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.usuarios`
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
  `data_nascimento` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`, `email`, `data_nascimento`, `sexo`) VALUES
(1, 'admin', 'admin', '655387240a70f.jpg', 'Alex Sandro', 2, 'teste@folao.com', '2024-09-04', 'M'),
(6, 'alexsrs', 'crea1234', '6553aa2217cfe.jpg', 'Alex Sandro', 0, 'teste@teste.net', '2024-09-18', 'F'),
(3, 'jose', 'jose', '65538e3e42833.jpg', 'Jose aluno', 0, 'cade@cade.com', '2024-09-02', 'O'),
(4, 'prof', 'prof', '65538e7ea62a1.jpg', 'Professor baitola', 1, '', '0000-00-00', ''),
(7, 'teste', 'teste', '66f2c68510739.jpg', 'Testando ', 0, '', '0000-00-00', ''),
(8, 'aluno1', 'aluno1', '66f2e45aba9d5.jpg', 'Aluno 1 ', 0, 'cootidr@seap.rj.gov.br', '1981-01-04', 'O'),
(9, 'teste2', 'teste2', '66f2e871137a0.jpg', 'teste 2', 1, 'alexsrs@seap.rj.gov.br', '2015-06-16', 'M');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_admin.visitas`
--

DROP TABLE IF EXISTS `tb_admin.visitas`;
CREATE TABLE IF NOT EXISTS `tb_admin.visitas` (
  `id` int NOT NULL AUTO_INCREMENT,
  `ip` varchar(255) NOT NULL,
  `dia` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `tb_admin.visitas`
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
(16, '::1', '2024-09-24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_site.depoimentos`
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
-- Extraindo dados da tabela `tb_site.depoimentos`
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
