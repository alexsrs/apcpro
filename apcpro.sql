-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13/11/2024 às 08:56
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
) ENGINE=MyISAM AUTO_INCREMENT=189 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_admin.online`
--

INSERT INTO `tb_admin.online` (`id`, `ip`, `ultima_acao`, `token`) VALUES
(146, '::1', '2024-10-31 12:26:12', '67239f5a7236d'),
(145, '::1', '2024-10-31 12:16:39', '67239d3497ace'),
(144, '::1', '2024-10-31 12:07:29', '67239c4ec023e'),
(143, '::1', '2024-10-31 12:03:39', '67239be979786'),
(141, '::1', '2024-10-31 12:01:31', '67239bcb0ef33'),
(142, '::1', '2024-10-31 12:01:52', '67239bdfaa24c'),
(147, '::1', '2024-10-31 12:28:08', '6723a19802f3d'),
(148, '::1', '2024-10-31 12:29:32', '6723a20f50146'),
(149, '::1', '2024-10-31 12:30:43', '6723a25f5da06'),
(150, '::1', '2024-10-31 12:31:34', '6723a2a3ea543'),
(151, '::1', '2024-10-31 12:33:28', '6723a2d6b2955'),
(152, '::1', '2024-10-31 12:34:53', '6723a349e860f'),
(153, '::1', '2024-10-31 12:36:46', '6723a3a083ebb'),
(154, '::1', '2024-10-31 12:38:50', '6723a41007444'),
(155, '::1', '2024-10-31 15:16:55', '6723a58bedd2e'),
(156, '::1', '2024-10-31 15:21:57', '6723c99dc3f77'),
(157, '::1', '2024-10-31 15:27:29', '6723cac770c88'),
(158, '::1', '2024-10-31 15:32:38', '6723cc1a91615'),
(159, '::1', '2024-10-31 15:35:46', '6723cdeb389b3'),
(160, '::1', '2024-10-31 15:46:06', '6723ce3cb1873'),
(161, '::1', '2024-10-31 15:47:36', '6723d07dc2f28'),
(162, '::1', '2024-10-31 15:50:19', '6723d0c9ea9fe'),
(163, '::1', '2024-10-31 15:55:40', '6723d16d023b9'),
(164, '::1', '2024-10-31 16:18:14', '6723d2ad9828e'),
(165, '::1', '2024-10-31 16:34:50', '6723d7f8b7e1e'),
(166, '::1', '2024-10-31 17:09:13', '6723dda31c564'),
(167, '::1', '2024-11-01 19:03:40', '6723e6d95c469'),
(168, '::1', '2024-11-01 20:07:00', '67255edddce3e'),
(169, '::1', '2024-11-01 20:08:00', '67255f3be8b75'),
(170, '::1', '2024-11-01 20:08:08', '67255f538a904'),
(171, '::1', '2024-11-01 20:10:16', '67255fd068360'),
(172, '::1', '2024-11-01 20:13:19', '672560442c6bc'),
(173, '::1', '2024-11-01 20:14:49', '672560dae2aee'),
(174, '::1', '2024-11-01 20:15:27', '6725610308735'),
(175, '::1', '2024-11-01 20:15:51', '672561222a068'),
(176, '::1', '2024-11-01 20:38:59', '6725668cea63b'),
(177, '::1', '2024-11-01 20:39:24', '672566a064b71'),
(178, '::1', '2024-11-01 21:08:05', '67256d5fda5de'),
(179, '::1', '2024-11-04 10:03:11', '67256d93dc900'),
(180, '::1', '2024-11-04 10:03:51', '6728c62b8d99e'),
(181, '::1', '2024-11-04 10:06:56', '6728c6567278c'),
(182, '::1', '2024-11-04 10:07:07', '6728c6f4a6a25'),
(183, '::1', '2024-11-04 11:02:12', '6728c702eca0c'),
(184, '::1', '2024-11-04 12:22:32', '6728e6ae3a599'),
(185, '::1', '2024-11-04 12:24:58', '6728e73faafe9'),
(186, '::1', '2024-11-07 08:03:05', '672c9e5debc50'),
(187, '::1', '2024-11-08 12:49:12', '672d326e879dd'),
(188, '::1', '2024-11-12 07:48:13', '672e33dcdc103');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_admin.usuarios`
--

DROP TABLE IF EXISTS `tb_admin.usuarios`;
CREATE TABLE IF NOT EXISTS `tb_admin.usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `nome` varchar(255) NOT NULL,
  `cargo` int NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `data_nascimento` date NOT NULL,
  `data_inicio` date NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `cpf` varchar(30) NOT NULL,
  `professor_id` int NOT NULL,
  `grupo_id` int NOT NULL,
  `create_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `professor_id` (`professor_id`),
  KEY `grupo_id` (`grupo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`, `telefone`, `data_nascimento`, `data_inicio`, `sexo`, `cpf`, `professor_id`, `grupo_id`, `create_at`) VALUES
(1, 'admin', '$2y$10$IJkR7pqep3GAaKCRpHlpE.f4VdBt2kkfYd8FFH8inTJmOXAqrpE4q', '655387240a70f.jpg', 'Alex Sandro', 2, '(21) 98989-0615', '1981-01-04', '2024-09-30', 'F', '086.899.137-69', 0, 0, '2024-10-31 14:29:35'),
(4, 'prof', '$2y$10$IJkR7pqep3GAaKCRpHlpE.f4VdBt2kkfYd8FFH8inTJmOXAqrpE4q', '65538e7ea62a1.jpg', 'Professor baitola', 1, '(21) 98989-0615', '2014-09-02', '2024-09-25', 'M', '086899137-69', 1, 0, '2024-10-31 14:29:35'),
(7, 'teste', 'teste', '66f2c68510739.jpg', 'Testando ', 0, '(21) 98989-0615', '2024-09-05', '2024-09-11', 'F', '086899137-69', 1, 0, '2024-10-31 14:29:35'),
(15, 'joao', 'joao', '66f42cc21846d.jpg', 'Joao', 0, '(21) 98989-0615', '1981-01-04', '1982-02-05', 'M', '086899137-69', 4, 0, '2024-10-31 14:29:35'),
(16, 'prof2', 'prof2', '66f42d0c0dea8.jpg', 'professor 2', 1, '(21) 98989-0615', '1973-01-06', '2024-12-26', 'F', '086899137-69', 1, 0, '2024-10-31 14:29:35'),
(17, 'jkerbin ', '1234', '66f4a3ad8411e.jpeg', 'Jebediah Kerbin', 0, '(21) 96787-0567', '1992-11-06', '2024-10-12', 'M', '121232343-79', 4, 0, '2024-10-31 14:29:35'),
(18, 'zuka', '1234', '66f5a7e46eace.png', 'Zuka da Silva sauro', 1, '(21) 95499-1323', '1967-09-01', '2025-01-12', 'F', '111.222.333-44', 1, 0, '2024-10-31 14:29:35'),
(19, 'teste0', 'teste0', '66ff3eb0994ea.jpeg', 'Teste 0', 1, '(21) 32346-260', '1937-10-03', '2024-11-06', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:29:35'),
(20, 'fernanda', 'fernanda', '', 'Fernanda', 1, '(21) 98487-0182', '1985-07-05', '2024-11-08', 'F', '111.111.111-11', 1, 0, '2024-10-31 14:29:35'),
(21, 'sofia', 'sofia', '6711118ee2354.jpeg', 'sofia', 1, '(11) 11111-1111', '2007-02-07', '2024-11-04', 'F', '111.111.111-11', 1, 0, '2024-10-31 14:29:35'),
(22, 'Joselia', 'joselia', '', 'Joselia', 1, '(21) 22222-2222', '1963-09-05', '2024-11-01', 'F', '122.222.222-22', 1, 2, '2024-10-31 14:29:35'),
(23, 'Josias', 'josias', '', 'Josias da silva', 1, '(21) 98487-0182', '1986-11-08', '2024-11-01', 'M', '000.000.000-00', 1, 1, '2024-10-31 14:29:35'),
(24, 'natalia', 'natalia', '', 'Natalia xupa q e de uva', 1, '(11) 11111-1111', '1991-05-24', '2024-10-31', 'F', '122.222.222-22', 1, 31, '2024-10-31 14:29:35'),
(25, 'louro', 'louro', '', 'Louro José', 1, '(22) 22222-2222', '1976-12-09', '2024-11-08', 'M', '333.333.333-33', 1, 31, '2024-10-31 14:29:35'),
(26, 'joselito', 'joselito', '', 'Alex Sandro Ribeiro de Souza', 1, '(21) 32346-260', '1994-03-18', '2024-11-09', 'M', '111.111.111-11', 1, 32, '2024-10-31 14:29:35'),
(27, 'alex@teste.com', '$2y$10$Knj/IbXTF/nqrKaGWtK/Jem7Zv6WlY.NGVixz7G87GYq4WBzSaR96', '67238b7ab3fcd.jpeg', 'Alex Sandro Ribeiro de Souza', 1, '(21) 98989-0615', '1981-01-04', '2025-10-10', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:29:35'),
(28, 'jurubeba@jutru.com', '$2y$10$Qxlb6rbS/PU.fm7zRzAJfu5it9dWLoBHSSLxVnRfASs7H6NZWx94a', '6723938771174.jpeg', 'Jurubeba', 1, '(21) 98989-0615', '1999-11-09', '2025-10-10', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:29:35'),
(29, 'novinho@novo.psd', '$2y$10$LfT8t1yR0wzJ9US4wOqg3OyRLqmogu9Dcq/W21pk9/XjTUResAlq6', '67239497892b6.jpeg', 'Novinho da silva', 1, '(21) 98989-0615', '1999-03-10', '2025-01-01', 'F', '111.111.111-11', 1, 0, '2024-10-31 14:30:47'),
(30, 'novinho@novo.psd', '$2y$10$LfT8t1yR0wzJ9US4wOqg3OyRLqmogu9Dcq/W21pk9/XjTUResAlq6', '67239497892b6.jpeg', 'Novinho da silva', 1, '(21) 98989-0615', '1999-03-10', '2025-01-01', 'F', '111.111.111-11', 1, 0, '2024-10-31 14:30:47'),
(31, 'gerente@socio.let', '$2y$10$pEkRYUDkAMRKKMvGnVY7ZOHiHmr8W3g/e.6KazX76gIONGSjThaNO', '6723978429f7c.jpeg', 'gerente de teste', 1, '(21) 98989-0615', '1997-06-19', '2025-01-01', 'M', '555.555.555-55', 1, 0, '2024-10-31 14:43:16'),
(32, 'gerente@socio.let', '$2y$10$pEkRYUDkAMRKKMvGnVY7ZOHiHmr8W3g/e.6KazX76gIONGSjThaNO', '6723978429f7c.jpeg', 'gerente de teste', 1, '(21) 98989-0615', '1997-06-19', '2025-01-01', 'M', '555.555.555-55', 1, 0, '2024-10-31 14:43:16'),
(33, 'assassino@confesso', '$2y$10$sCEFHw/eAxUsfeOdp9EMN.hrIiNAjmx/0VBMtql6oDwtFyjHtU1/.', '672398a9e90ea.jpeg', 'Assassino confesso', 1, '(11) 11111-1111', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:48:10'),
(34, 'assassino@confesso', '$2y$10$sCEFHw/eAxUsfeOdp9EMN.hrIiNAjmx/0VBMtql6oDwtFyjHtU1/.', '672398a9e90ea.jpeg', 'Assassino confesso', 1, '(11) 11111-1111', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:48:10'),
(35, 'alegacoes@jejej.ckdk', '$2y$10$PqFkLrxBjVS8toOL/tFV3.a9wAOMwGply3pID9zXEgkT9WvZc5YqG', '6723992963abe.png', 'Alegou', 1, '(21) 98989-0615', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:50:17'),
(36, 'alegacoes@jejej.ckdk', '$2y$10$PqFkLrxBjVS8toOL/tFV3.a9wAOMwGply3pID9zXEgkT9WvZc5YqG', '6723992963abe.png', 'Alegou', 1, '(21) 98989-0615', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:50:17'),
(37, 'alegacoes@gm', '$2y$10$gKfLCTM/RfAapBAwr4GQb.f/YZ/a36WcC7PC5uAFgMYGheKKlsYcu', '6723999f76b83.png', 'Alex Sandro Ribeiro de Souza', 1, '(21) 98989-0615', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:52:15'),
(38, 'alegacoes@gm', '$2y$10$gKfLCTM/RfAapBAwr4GQb.f/YZ/a36WcC7PC5uAFgMYGheKKlsYcu', '6723999f76b83.png', 'Alex Sandro Ribeiro de Souza', 1, '(21) 98989-0615', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:52:15'),
(39, 'bandido@band', '$2y$10$gkGHOncVm2U4bAOV6Fj1UOfuQ7aVb6rzDIzvcvLssxvFLBufzceEi', '672399e64cff9.png', 'Bandido', 1, '(21) 98989-0615', '2010-10-10', '2025-01-30', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:53:26'),
(40, 'bandido@band', '$2y$10$gkGHOncVm2U4bAOV6Fj1UOfuQ7aVb6rzDIzvcvLssxvFLBufzceEi', '672399e64cff9.png', 'Bandido', 1, '(21) 98989-0615', '2010-10-10', '2025-01-30', 'M', '111.111.111-11', 1, 0, '2024-10-31 14:53:26'),
(41, 'amor@amor', '$2y$10$G/XJtklhtqMASxbIc/D8Nu6VfwjJmh95S1SATnJClln1e3TvlH9/e', '67239a397130f.jpeg', 'Amor', 1, '(21) 98989-0615', '2022-02-02', '2026-02-02', 'F', '111.111.111-11', 1, 0, '2024-10-31 14:54:49'),
(42, 'amor@amor', '$2y$10$G/XJtklhtqMASxbIc/D8Nu6VfwjJmh95S1SATnJClln1e3TvlH9/e', '67239a397130f.jpeg', 'Amor', 1, '(21) 98989-0615', '2022-02-02', '2026-02-02', 'F', '111.111.111-11', 1, 0, '2024-10-31 14:54:49'),
(43, 'amor@amor', '$2y$10$x8qXWxwnVKAfE8rLJ1N2A.esxhKFlyd7gwLoVtX7I1It5FRzqi71u', '67239bcb10828.jpeg', 'Amor', 1, '(21) 98989-0615', '2022-02-02', '2026-02-02', 'F', '111.111.111-11', 1, 0, '2024-10-31 15:01:31'),
(44, 'amor@amor', '$2y$10$x8qXWxwnVKAfE8rLJ1N2A.esxhKFlyd7gwLoVtX7I1It5FRzqi71u', '67239bcb10828.jpeg', 'Amor', 1, '(21) 98989-0615', '2022-02-02', '2026-02-02', 'F', '111.111.111-11', 1, 0, '2024-10-31 15:01:31'),
(45, 'alegacoes@gm', '$2y$10$w6yi0KC3APi4O3y1wuLsTeLWOVgL1hz9vrTYGAERFg8FFnEZxwV1i', '67239c4b93ace.png', 'Alex Sandro Ribeiro de Souza', 1, '(21) 98989-0615', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 15:03:39'),
(46, 'alegacoes@gm', '$2y$10$w6yi0KC3APi4O3y1wuLsTeLWOVgL1hz9vrTYGAERFg8FFnEZxwV1i', '67239c4b93ace.png', 'Alex Sandro Ribeiro de Souza', 1, '(21) 98989-0615', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 15:03:39'),
(47, 'gaming@joe', '$2y$10$ehPI3EkflBJimwLaiG6YQe2cX39Co9oIwWZPhs3vqs8gF2L4WSYma', '67239d31633ea.png', 'Alex Sandro Ribeiro de Souza', 1, '(11) 11111-1111', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 15:07:29'),
(48, 'gaming@joe', '$2y$10$ehPI3EkflBJimwLaiG6YQe2cX39Co9oIwWZPhs3vqs8gF2L4WSYma', '67239d31633ea.png', 'Alex Sandro Ribeiro de Souza', 1, '(11) 11111-1111', '0000-00-00', '1111-11-11', 'M', '111.111.111-11', 1, 0, '2024-10-31 15:07:29'),
(49, 'josealdo@sooo', '$2y$10$hIf2avX/m8cHFjS1ewmWf.lpafeIHrTk6vlpdBGoIoaO8R7lA3pEa', '67239f574f378.jpeg', 'Jose Aldo', 1, '(21) 98989-0615', '1990-05-05', '2025-02-04', 'M', '555.555.555-55', 1, 0, '2024-10-31 15:16:39'),
(50, 'josealdo@sooo', '$2y$10$hIf2avX/m8cHFjS1ewmWf.lpafeIHrTk6vlpdBGoIoaO8R7lA3pEa', '67239f574f378.jpeg', 'Jose Aldo', 1, '(21) 98989-0615', '1990-05-05', '2025-02-04', 'M', '555.555.555-55', 1, 0, '2024-10-31 15:16:39'),
(51, 'lklaklk@lklkal', '$2y$10$9PaVNVoQG3HTE0dHDWTpP.1OatGh0zy0VeELPB63aDONG90w3/n4a', 'default.jpg', 'ksmmsmm', 1, '(11) 11111-1111', '1111-01-01', '1111-01-01', 'F', '111.111.111-11', 1, 0, '2024-10-31 15:26:12'),
(52, 'lklaklk@lklkal', '$2y$10$9PaVNVoQG3HTE0dHDWTpP.1OatGh0zy0VeELPB63aDONG90w3/n4a', 'default.jpg', 'ksmmsmm', 1, '(11) 11111-1111', '1111-01-01', '1111-01-01', 'F', '111.111.111-11', 1, 0, '2024-10-31 15:26:12'),
(53, 'jurados@juri', '$2y$10$Dkh8E79QswhyYvhPBM/cceP/x2zkLc5VafUlFpkGO4hJvJ5Kqg/9W', '6723a208dd1c1.png', 'Jurado', 1, '(21) 98989-0615', '2000-06-09', '2025-02-05', 'M', '111.111.111-11', 1, 0, '2024-10-31 15:28:08'),
(54, 'jurados@juri', '$2y$10$Dkh8E79QswhyYvhPBM/cceP/x2zkLc5VafUlFpkGO4hJvJ5Kqg/9W', '6723a208dd1c1.png', 'Jurado', 1, '(21) 98989-0615', '2000-06-09', '2025-02-05', 'M', '111.111.111-11', 1, 0, '2024-10-31 15:28:08'),
(55, 'jururu@okokok', '$2y$10$KQHbP71xw3arHph.Mv5pzuDATd5GETLa3dCzxwQ.V8Egpwh40FlMe', '6723a25c599ff.png', 'Jurado', 1, '(22) 22222-2222', '2000-06-09', '2025-02-05', 'M', '111.111.333-33', 1, 0, '2024-10-31 15:29:32'),
(56, 'jururu@okokok', '$2y$10$KQHbP71xw3arHph.Mv5pzuDATd5GETLa3dCzxwQ.V8Egpwh40FlMe', '6723a25c599ff.png', 'Jurado', 1, '(22) 22222-2222', '2000-06-09', '2025-02-05', 'M', '111.111.333-33', 1, 0, '2024-10-31 15:29:32'),
(57, 'debates@gggsg', '$2y$10$e4xYuQIPNHHRJGwIdWw1ruvbIAa9DsM5uyQVFdn0Jrdw89OCEiRei', '6723a2a3d2123.png', 'Debates', 1, '(11) 11111-1111', '2000-06-09', '2025-02-05', 'M', '111.111.111-11', 1, 0, '2024-10-31 15:30:43'),
(58, 'debates@gggsg', '$2y$10$e4xYuQIPNHHRJGwIdWw1ruvbIAa9DsM5uyQVFdn0Jrdw89OCEiRei', '6723a2a3d2123.png', 'Debates', 1, '(11) 11111-1111', '2000-06-09', '2025-02-05', 'M', '111.111.111-11', 1, 0, '2024-10-31 15:30:43'),
(59, 'yeeee@esquem', '$2y$10$VMLb7uAneA7mkYqB/NVhherC8s7uykAX.JMEl19VZBmTTpK22qNNe', '6723a2d69861c.jpeg', 'Esuema', 1, '(21) 98989-0615', '0000-00-00', '0000-00-00', 'M', '222.222.222-22', 1, 0, '2024-10-31 15:31:34'),
(60, 'yeeee@esquem', '$2y$10$VMLb7uAneA7mkYqB/NVhherC8s7uykAX.JMEl19VZBmTTpK22qNNe', '6723a2d69861c.jpeg', 'Esuema', 1, '(21) 98989-0615', '0000-00-00', '0000-00-00', 'M', '222.222.222-22', 1, 0, '2024-10-31 15:31:34'),
(61, 'emprestimo@12vezes', '$2y$10$IiBZedwNX/3YDnQQEfqtL.V1L5ipyhBGoCyTJ.33S.zbZKjwIi7vi', '6723a348292b1.jpeg', 'Emprestimo', 1, '(22) 22222-2222', '2002-02-22', '2025-02-22', 'F', '111.111.111-11', 1, 0, '2024-10-31 15:33:28'),
(62, 'emprestimo@12vezes', '$2y$10$IiBZedwNX/3YDnQQEfqtL.V1L5ipyhBGoCyTJ.33S.zbZKjwIi7vi', '6723a348292b1.jpeg', 'Emprestimo', 1, '(22) 22222-2222', '2002-02-22', '2025-02-22', 'F', '111.111.111-11', 1, 0, '2024-10-31 15:33:28'),
(63, 'onibus@onibus', '$2y$10$dCXFnDXQ4N42/zSDKhsabuNWMUx/ejimJaPj7og0jAJ4Geka7T3wu', '6723a39d9b9aa.jpeg', 'Onibus', 1, '(11) 11111-1111', '1981-01-04', '2026-01-01', 'F', '111.111.111-11', 1, 0, '2024-10-31 15:34:53'),
(64, 'onibus@onibus', '$2y$10$dCXFnDXQ4N42/zSDKhsabuNWMUx/ejimJaPj7og0jAJ4Geka7T3wu', '6723a39d9b9aa.jpeg', 'Onibus', 1, '(11) 11111-1111', '1981-01-04', '2026-01-01', 'F', '111.111.111-11', 1, 0, '2024-10-31 15:34:53'),
(65, 'transport@onibus', '$2y$10$V6B8u/.HVT9TBHfZA.J/nuvD3wsDn5UkpA87HT1SWkdkZRF.9l5AG', '6723a40e33d51.jpeg', 'Onibus', 1, '(11) 22222-2222', '1981-01-05', '2026-01-05', 'M', '245.666.666-66', 1, 0, '2024-10-31 15:36:46'),
(66, 'teste@teste.com', '123', '6723a834207a2.png', 'Jose', 0, '(21) 98989-0615', '2025-01-03', '2025-01-03', 'F', '111.111.111-11', 4, 35, '2024-10-31 15:54:28'),
(67, 'pegoa@spspsps', '$2y$10$IJkR7pqep3GAaKCRpHlpE.f4VdBt2kkfYd8FFH8inTJmOXAqrpE4q', 'default.jpg', 'Admin', 1, '(22) 22222-2222', '1091-01-01', '2010-10-20', 'M', '222.222.222-22', 1, 0, '2024-10-31 18:21:57'),
(68, 'novo@nuevo.com', '$2y$10$7aZkMia6T9meeujKtGMmQOdgtCAlSE5c53ESGKVNHc/MTB/mnVndS', 'default.jpg', 'novo ', 1, '(11) 11111-1111', '1978-09-03', '2025-01-05', 'F', '111.111.111-11', 1, 0, '2024-10-31 18:47:36'),
(69, 'teste@tette', '$2y$10$2cFxd9X4xE30GFMpFHTFHuwPs5AcQRFhU1lGmZKJ07g45NXEA.AdK', 'default.jpg', 'Fabiano', 1, '(11) 11111-1111', '1981-01-01', '2025-01-01', 'F', '111.111.111-11', 1, 0, '2024-10-31 18:50:19'),
(70, 'oi@paz', '$2y$10$LKO1ErwfGyQEPMBUNbThLeVj8wqVXkh2AFQIsaqWScAmyre6boQMq', 'default.jpg', 'caramujo', 1, '(11) 11111-1111', '2001-01-01', '2025-01-01', 'F', '111.111.111-11', 1, 0, '2024-10-31 18:55:40'),
(71, 'fernanda@nada', '$2y$10$HAqvdLV./AfUvRy.diF6GetysBquiko7PPIMXcm03BwYa8avgWIbO', 'default.jpg', 'fernanda', 1, '(11) 11111-1111', '1989-04-03', '2026-01-01', 'M', '111.111.111-11', 1, 0, '2024-10-31 19:18:14'),
(72, 'alexsrs@gmail.com', '$2y$10$XQgNVJ65o/j8EHpwtMZfMOHKJVTgulBL6ovJemkkID2QME3XEIHIq', '6728e66225182.jpeg', 'Alex Sandro o cara', 0, '(21) 98989-0615', '1981-01-04', '2025-01-01', 'F', '086.899.137-69', 4, 37, '2024-11-01 23:09:27');

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
) ENGINE=MyISAM AUTO_INCREMENT=29 DEFAULT CHARSET=utf8mb3;

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
(23, '::1', '2024-10-05'),
(24, '::1', '2024-10-13'),
(25, '::1', '2024-10-21'),
(26, '::1', '2024-10-28'),
(27, '::1', '2024-11-04'),
(28, '::1', '2024-11-11');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_aptidao_cardiorespiratoria`
--

DROP TABLE IF EXISTS `tb_aptidao_cardiorespiratoria`;
CREATE TABLE IF NOT EXISTS `tb_aptidao_cardiorespiratoria` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `data_avaliacao` datetime NOT NULL,
  `fc_t1` int DEFAULT NULL,
  `pse_t1` int DEFAULT NULL,
  `fc_t2` int DEFAULT NULL,
  `pse_t2` int DEFAULT NULL,
  `fc_t3` int DEFAULT NULL,
  `pse_t3` int DEFAULT NULL,
  `fc_t4` int DEFAULT NULL,
  `pse_t4` int DEFAULT NULL,
  `fc_t5` int DEFAULT NULL,
  `pse_t5` int DEFAULT NULL,
  `fc_t6` int DEFAULT NULL,
  `pse_t6` int DEFAULT NULL,
  `fc_t7` int DEFAULT NULL,
  `pse_t7` int DEFAULT NULL,
  `fc_t8` int DEFAULT NULL,
  `pse_t8` int DEFAULT NULL,
  `fc_t9` int DEFAULT NULL,
  `pse_t9` int DEFAULT NULL,
  `fc_t10` int DEFAULT NULL,
  `pse_t10` int DEFAULT NULL,
  `fc_t11` int DEFAULT NULL,
  `pse_t11` int DEFAULT NULL,
  `fc_t12` int DEFAULT NULL,
  `pse_t12` int DEFAULT NULL,
  `fc_t13` int DEFAULT NULL,
  `pse_t13` int DEFAULT NULL,
  `fc_t14` int DEFAULT NULL,
  `pse_t14` int DEFAULT NULL,
  `fc_t15` int DEFAULT NULL,
  `pse_t15` int DEFAULT NULL,
  `fc_t16` int DEFAULT NULL,
  `pse_t16` int DEFAULT NULL,
  `fc_repouso` int DEFAULT NULL,
  `fc_max` int DEFAULT NULL,
  `velocidade_max` float DEFAULT NULL,
  `pse_max` int DEFAULT NULL,
  `indice_fc` float DEFAULT NULL,
  `mets` float DEFAULT NULL,
  `vo2_max_ml` float DEFAULT NULL,
  `vo2_max_l` float DEFAULT NULL,
  `limiar1` float DEFAULT NULL,
  `fc_l1_percent` float DEFAULT NULL,
  `limiar2` float DEFAULT NULL,
  `fc_l2_percent` float DEFAULT NULL,
  `ivo2_x_kmh_30` float DEFAULT NULL,
  `ivo2_x_kmh_35` float DEFAULT NULL,
  `ivo2_x_kmh_40` float DEFAULT NULL,
  `ivo2_x_kmh_45` float DEFAULT NULL,
  `ivo2_x_kmh_50` float DEFAULT NULL,
  `ivo2_x_kmh_55` float DEFAULT NULL,
  `ivo2_x_kmh_60` float DEFAULT NULL,
  `ivo2_x_kmh_65` float DEFAULT NULL,
  `ivo2_x_kmh_70` float DEFAULT NULL,
  `ivo2_x_kmh_75` float DEFAULT NULL,
  `ivo2_x_kmh_80` float DEFAULT NULL,
  `ivo2_x_kmh_85` float DEFAULT NULL,
  `ivo2_x_kmh_90` float DEFAULT NULL,
  `ivo2_x_kmh_95` float DEFAULT NULL,
  `ivo2_x_kmh_100` float DEFAULT NULL,
  `ivo2_x_kmh_105` float DEFAULT NULL,
  `ivo2_x_kmh_110` float DEFAULT NULL,
  `ivo2_x_kmh_115` float DEFAULT NULL,
  `ivo2_x_kmh_120` float DEFAULT NULL,
  `ivo2_x_kmh_125` float DEFAULT NULL,
  `ivo2_x_kmh_130` float DEFAULT NULL,
  `ivo2_x_kmh_135` float DEFAULT NULL,
  `ivo2_x_kmh_140` float DEFAULT NULL,
  `ivo2_x_kmh_145` float DEFAULT NULL,
  `ivo2_x_kmh_150` float DEFAULT NULL,
  `ivo2_x_kmh_155` float DEFAULT NULL,
  `ivo2_x_kmh_160` float DEFAULT NULL,
  `ivo2_x_kmh_165` float DEFAULT NULL,
  `ivo2_x_kmh_170` float DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_aptidao_cardiorespiratoria`
--

INSERT INTO `tb_aptidao_cardiorespiratoria` (`id`, `usuario_id`, `data_avaliacao`, `fc_t1`, `pse_t1`, `fc_t2`, `pse_t2`, `fc_t3`, `pse_t3`, `fc_t4`, `pse_t4`, `fc_t5`, `pse_t5`, `fc_t6`, `pse_t6`, `fc_t7`, `pse_t7`, `fc_t8`, `pse_t8`, `fc_t9`, `pse_t9`, `fc_t10`, `pse_t10`, `fc_t11`, `pse_t11`, `fc_t12`, `pse_t12`, `fc_t13`, `pse_t13`, `fc_t14`, `pse_t14`, `fc_t15`, `pse_t15`, `fc_t16`, `pse_t16`, `fc_repouso`, `fc_max`, `velocidade_max`, `pse_max`, `indice_fc`, `mets`, `vo2_max_ml`, `vo2_max_l`, `limiar1`, `fc_l1_percent`, `limiar2`, `fc_l2_percent`, `ivo2_x_kmh_30`, `ivo2_x_kmh_35`, `ivo2_x_kmh_40`, `ivo2_x_kmh_45`, `ivo2_x_kmh_50`, `ivo2_x_kmh_55`, `ivo2_x_kmh_60`, `ivo2_x_kmh_65`, `ivo2_x_kmh_70`, `ivo2_x_kmh_75`, `ivo2_x_kmh_80`, `ivo2_x_kmh_85`, `ivo2_x_kmh_90`, `ivo2_x_kmh_95`, `ivo2_x_kmh_100`, `ivo2_x_kmh_105`, `ivo2_x_kmh_110`, `ivo2_x_kmh_115`, `ivo2_x_kmh_120`, `ivo2_x_kmh_125`, `ivo2_x_kmh_130`, `ivo2_x_kmh_135`, `ivo2_x_kmh_140`, `ivo2_x_kmh_145`, `ivo2_x_kmh_150`, `ivo2_x_kmh_155`, `ivo2_x_kmh_160`, `ivo2_x_kmh_165`, `ivo2_x_kmh_170`, `created_at`) VALUES
(11, 4, '2024-10-24 18:50:36', 75, 1, 75, 1, 78, 2, 85, 2, 85, 3, 110, 4, 135, 5, 139, 6, 156, 7, 189, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 75, 189, 12, 10, 2.52, 10.12, 35.42, 3.01, 110, 58.2, 110, 58.2, 3.6, 4.2, 4.8, 5.4, 6, 6.6, 7.2, 7.8, 8.4, 9, 9.6, 10.2, 10.8, 11.4, 12, 12.6, 13.2, 13.8, 14.4, 15, 15.6, 16.2, 16.8, 17.4, 18, 18.6, 19.2, 19.8, 20.4, '2024-10-24 21:50:36'),
(12, 4, '2024-10-24 18:54:04', 75, 1, 75, 1, 78, 2, 85, 2, 85, 3, 110, 4, 135, 5, 139, 6, 156, 7, 189, 10, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 75, 189, 12, 10, 2.52, 10.12, 35.42, 3.01, 110, 58.2, 110, 58.2, 3.6, 4.2, 4.8, 5.4, 6, 6.6, 7.2, 7.8, 8.4, 9, 9.6, 10.2, 10.8, 11.4, 12, 12.6, 13.2, 13.8, 14.4, 15, 15.6, 16.2, 16.8, 17.4, 18, 18.6, 19.2, 19.8, 20.4, '2024-10-24 21:54:04');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_categoria_exercicio`
--

DROP TABLE IF EXISTS `tb_categoria_exercicio`;
CREATE TABLE IF NOT EXISTS `tb_categoria_exercicio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `categoria` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_categoria_exercicio`
--

INSERT INTO `tb_categoria_exercicio` (`id`, `categoria`, `created_at`) VALUES
(1, 'Peitoral', '2024-10-25 12:18:40'),
(2, 'Dorsal', '2024-10-25 12:18:40'),
(6, 'Tríceps', '2024-10-25 16:37:31'),
(5, 'Bíceps', '2024-10-25 16:37:17'),
(7, 'Inferiores', '2024-10-25 16:38:09'),
(8, 'Ombros', '2024-10-25 16:38:16'),
(9, 'Abdômen', '2024-10-25 16:38:40'),
(10, 'Antebraço', '2024-10-25 16:38:51'),
(11, 'Aeróbico', '2024-10-25 16:39:16'),
(12, 'Funcional', '2024-10-25 16:39:23'),
(13, 'Alongamentos', '2024-10-25 16:39:37'),
(14, 'Em casa', '2024-10-25 16:39:44'),
(15, 'Mobilidade', '2024-10-25 16:39:59'),
(16, 'Elásticos', '2024-10-25 16:40:05'),
(17, 'MAT Pilates', '2024-10-25 16:40:35'),
(18, 'Laboral', '2024-10-25 16:40:41'),
(19, 'Combinados', '2024-10-25 16:42:12');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_composicao_corporal`
--

DROP TABLE IF EXISTS `tb_composicao_corporal`;
CREATE TABLE IF NOT EXISTS `tb_composicao_corporal` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `data_avaliacao` datetime NOT NULL,
  `percentual_gordura` float DEFAULT NULL,
  `massa_gordura` float DEFAULT NULL,
  `massa_magra` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_composicao_corporal`
--

INSERT INTO `tb_composicao_corporal` (`id`, `usuario_id`, `data_avaliacao`, `percentual_gordura`, `massa_gordura`, `massa_magra`) VALUES
(1, 1, '2024-11-08 13:23:52', NULL, NULL, NULL),
(2, 1, '2024-11-08 13:24:51', NULL, NULL, NULL),
(3, 1, '2024-11-08 13:25:02', NULL, NULL, NULL),
(4, 1, '2024-11-08 13:33:18', 29.06, 15.6, 38.1),
(5, 1, '2024-11-08 13:34:33', 29.06, 15.6, 38.1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_dobras_cutanea`
--

DROP TABLE IF EXISTS `tb_dobras_cutanea`;
CREATE TABLE IF NOT EXISTS `tb_dobras_cutanea` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `tricipital` float DEFAULT NULL,
  `subescapular` float DEFAULT NULL,
  `suprailiaca` float DEFAULT NULL,
  `abdominal` float DEFAULT NULL,
  `supraespinhal` float DEFAULT NULL,
  `coxa_guedes` float DEFAULT NULL,
  `coxa_pollock` float DEFAULT NULL,
  `peitoral` float DEFAULT NULL,
  `axilar_media` float DEFAULT NULL,
  `biceps` float DEFAULT NULL,
  `somatorio` float DEFAULT NULL,
  `somatorio_pollock_3D` float DEFAULT NULL,
  `somatorio_pollock_7D` float DEFAULT NULL,
  `somatorio_guedes_3D` float DEFAULT NULL,
  `biestiloide` float DEFAULT NULL,
  `biepicondiliano` float DEFAULT NULL,
  `bicondiliano` float DEFAULT NULL,
  `bimaleolar` float DEFAULT NULL,
  `data_avaliacao` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_dobras_cutanea`
--

INSERT INTO `tb_dobras_cutanea` (`id`, `usuario_id`, `tricipital`, `subescapular`, `suprailiaca`, `abdominal`, `supraespinhal`, `coxa_guedes`, `coxa_pollock`, `peitoral`, `axilar_media`, `biceps`, `somatorio`, `somatorio_pollock_3D`, `somatorio_pollock_7D`, `somatorio_guedes_3D`, `biestiloide`, `biepicondiliano`, `bicondiliano`, `bimaleolar`, `data_avaliacao`, `created_at`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0.67, 10.67, 3, 7, 3, 1, 1, 1, 1, '2024-10-28 10:34:33', '2024-10-28 13:34:33'),
(2, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-10-28 11:40:24', '2024-10-28 14:40:24');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_exercicios_lib`
--

DROP TABLE IF EXISTS `tb_exercicios_lib`;
CREATE TABLE IF NOT EXISTS `tb_exercicios_lib` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `categoria_id` int NOT NULL,
  `nome_exercicio` varchar(255) NOT NULL,
  `articulacao` varchar(255) NOT NULL,
  `membro` varchar(255) NOT NULL,
  `grupo_muscular` varchar(255) NOT NULL,
  `aplicacao_forca` varchar(255) NOT NULL,
  `movimento` varchar(255) NOT NULL,
  `video` varchar(255) NOT NULL,
  `contra_indicacoes` varchar(255) NOT NULL,
  `indicacoes` varchar(255) NOT NULL,
  `mets_consumo_energetico` float NOT NULL,
  `nivel_dificuldade` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `data_inclusao` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_exercicios_lib`
--

INSERT INTO `tb_exercicios_lib` (`id`, `usuario_id`, `categoria_id`, `nome_exercicio`, `articulacao`, `membro`, `grupo_muscular`, `aplicacao_forca`, `movimento`, `video`, `contra_indicacoes`, `indicacoes`, `mets_consumo_energetico`, `nivel_dificuldade`, `created_at`, `data_inclusao`) VALUES
(7, 1, 13, 'teste 100', 'Multi articular', 'Superior e Inferior', 'grupo de teste', 'Neutro', 'Combinado', 'https://www.youtube.com/watch?v=98eCqxrNBk8', 'nao tem ', 'pra todos', 5, 'Difícil', '2024-10-25 17:00:04', '2024-10-25 14:00:04'),
(8, 1, 5, 'Rosca direta', 'Uni articular', 'Superior', 'Flexores de cotovelo', 'Contra a gravidade', 'De puxar', 'https://www.youtube.com/watch?v=98eCqxrNBk8', '', '', 3, 'Fácil', '2024-10-27 22:57:48', '2024-10-27 19:57:48'),
(9, 1, 1, 'TESTE', 'Integrado', 'Superior e Inferior', 'Flexores de cotovelo', 'Integrado', 'De empurrar', 'https://www.youtube.com/watch?v=98eCqxrNBk8', 'nao tem ', 'pra todos', 2, 'Difícil', '2024-10-28 13:35:48', '2024-10-28 10:35:48'),
(10, 1, 8, 'teste 1001111', 'Multi articular', 'Superior', 'grupo de teste', 'Contra a gravidade', 'De empurrar', 'https://www.youtube.com/watch?v=98eCqxrNBk8', '', '', 2, 'Difícil', '2024-10-28 14:01:10', '2024-10-28 11:01:10'),
(11, 1, 17, 'se e louco cachoeira', 'Multi articular', 'Superior e Inferior', 'grupo de teste', 'Integrado', 'Integrado', 'https://www.youtube.com/watch?v=98eCqxrNBk8', 'nao tem ', 'pra todos', 2, 'Moderado', '2024-10-28 16:24:32', '2024-10-28 13:24:32');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_grupos_usuarios`
--

DROP TABLE IF EXISTS `tb_grupos_usuarios`;
CREATE TABLE IF NOT EXISTS `tb_grupos_usuarios` (
  `id` int NOT NULL AUTO_INCREMENT,
  `grupo` varchar(255) NOT NULL,
  `professor_id` int DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_grupos_usuarios`
--

INSERT INTO `tb_grupos_usuarios` (`id`, `grupo`, `professor_id`) VALUES
(1, 'Time de volley Tijuca Tenis Clube', 1),
(2, 'Academia XYZ', 1),
(37, 'tradicional', 4),
(36, 'louco', 4),
(35, 'Grupo novo', 4),
(34, 'todos 3', 1),
(33, 'todos 2', 1),
(32, 'todos', 1),
(31, 'As barrigudas', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_medidas_corporais`
--

DROP TABLE IF EXISTS `tb_medidas_corporais`;
CREATE TABLE IF NOT EXISTS `tb_medidas_corporais` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `punho_direito` float DEFAULT NULL,
  `ante_braco_direito` float DEFAULT NULL,
  `braco_direito_relaxado` float DEFAULT NULL,
  `braco_direito_contraido` float DEFAULT NULL,
  `punho_esquerdo` float DEFAULT NULL,
  `ante_braco_esquerdo` float DEFAULT NULL,
  `braco_esquerdo_relaxado` float DEFAULT NULL,
  `braco_esquerdo_contraido` float DEFAULT NULL,
  `pescoco` float DEFAULT NULL,
  `torax` float DEFAULT NULL,
  `cintura` float DEFAULT NULL,
  `abdomen` float DEFAULT NULL,
  `quadril` float DEFAULT NULL,
  `coxa_medial_direita` float DEFAULT NULL,
  `coxa_medial_esquerda` float DEFAULT NULL,
  `panturrilha_direita` float DEFAULT NULL,
  `panturrilha_esquerda` float DEFAULT NULL,
  `data_avaliacao` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_medidas_corporais`
--

INSERT INTO `tb_medidas_corporais` (`id`, `usuario_id`, `punho_direito`, `ante_braco_direito`, `braco_direito_relaxado`, `braco_direito_contraido`, `punho_esquerdo`, `ante_braco_esquerdo`, `braco_esquerdo_relaxado`, `braco_esquerdo_contraido`, `pescoco`, `torax`, `cintura`, `abdomen`, `quadril`, `coxa_medial_direita`, `coxa_medial_esquerda`, `panturrilha_direita`, `panturrilha_esquerda`, `data_avaliacao`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2024-10-17 00:00:00'),
(2, 4, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, 8, '2024-10-17 00:00:00'),
(3, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-10-17 00:00:00'),
(4, 7, 13, 23, 34, 36, 13, 22, 33, 35, 30, 67, 56, 59, 34, 45, 46, 29, 29, '2024-10-18 00:00:00'),
(5, 4, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, '2024-10-21 05:52:10'),
(6, 20, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-10-21 07:52:06'),
(7, 7, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, '2024-10-22 19:04:03'),
(8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2024-10-28 10:30:53'),
(9, 1, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, 10, '2024-11-07 09:38:35'),
(10, 1, 14, 26, 25, 26, 15, 26, 26, 27, 32, 89, 74, 77, 94, 51, 50, 33, 33, '2024-11-07 10:22:16');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_objetivos_treinamento`
--

DROP TABLE IF EXISTS `tb_objetivos_treinamento`;
CREATE TABLE IF NOT EXISTS `tb_objetivos_treinamento` (
  `id` int NOT NULL AUTO_INCREMENT,
  `objetivo` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

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
(10, 'superliga voley'),
(11, 'teste'),
(12, 'teste 2'),
(13, 'teste 3');

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
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8mb3;

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
(61, 1, '2024-10-07 13:29:45', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(62, 1, '2024-10-13 08:15:01', 50, 1.5, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(63, 1, '2024-10-13 09:29:15', 84.3, 1.84, 0, 0, 0, 0, 0, 0, 0, 0, 0, 7),
(64, 4, '2024-10-15 19:34:21', 148.4, 1.95, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(65, 1, '2024-10-15 19:35:10', 178.6, 2.07, 0, 0, 1, 0, 0, 0, 0, 0, 0, 10),
(66, 4, '2024-10-15 19:56:54', 153.7, 2.51, 1, 1, 1, 1, 1, 0, 0, 0, 0, 10),
(67, 1, '2024-10-15 19:57:31', 40, 1.2, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(68, 1, '2024-10-15 20:25:07', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(69, 4, '2024-10-15 20:58:43', 85, 2.06, 0, 0, 0, 0, 0, 0, 0, 0, 0, 4),
(70, 1, '2024-10-15 23:09:56', 50, 1.5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(71, 1, '2024-10-15 23:14:53', 50, 1.5, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0),
(72, 1, '2024-10-15 23:15:31', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(73, 1, '2024-10-15 23:16:39', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(74, 1, '2024-10-15 23:17:26', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(75, 1, '2024-10-15 23:18:31', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(76, 1, '2024-10-15 23:18:53', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(77, 1, '2024-10-15 23:29:04', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(78, 18, '2024-10-15 23:48:36', 93.6, 1.8, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(79, 1, '2024-10-17 10:35:55', 166, 1.76, 0, 0, 0, 0, 0, 0, 0, 0, 0, 8),
(80, 17, '2024-10-17 10:36:45', 156.6, 1.85, 0, 0, 0, 0, 0, 0, 0, 0, 0, 5),
(81, 7, '2024-10-18 12:11:59', 299.9, 2.51, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6),
(82, 7, '2024-10-19 12:52:32', 137.3, 1.81, 1, 0, 0, 0, 0, 0, 0, 0, 0, 9),
(83, 20, '2024-10-21 07:51:41', 89.5, 1.68, 0, 0, 0, 0, 0, 0, 0, 0, 0, 6),
(84, 7, '2024-10-22 19:03:42', 50, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(85, 1, '2024-10-22 19:49:11', 137.7, 1.89, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(86, 72, '2024-11-03 08:38:05', 155.9, 1.92, 1, 0, 0, 0, 0, 0, 0, 0, 0, 1),
(87, 72, '2024-11-03 09:10:47', 91, 1.5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(88, 72, '2024-11-03 09:34:52', 50, 1.5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0),
(89, 72, '2024-11-03 10:04:45', 50, 1.5, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(90, 72, '2024-11-03 10:05:03', 50, 1.5, 0, 1, 0, 0, 1, 0, 0, 0, 0, 0),
(91, 72, '2024-11-03 10:05:25', 50, 1.5, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0),
(92, 72, '2024-11-04 11:28:01', 60.8, 1.59, 0, 0, 0, 0, 0, 1, 1, 1, 1, 4),
(93, 72, '2024-11-04 11:57:44', 73.9, 1.54, 1, 1, 1, 1, 1, 1, 1, 1, 1, 2),
(94, 72, '2024-11-04 12:22:05', 160, 1.85, 0, 1, 0, 0, 0, 0, 0, 0, 0, 2),
(95, 72, '2024-11-04 13:10:38', 67.2, 1.52, 0, 0, 0, 0, 0, 0, 0, 0, 1, 2),
(96, 1, '2024-11-07 09:37:57', 80.6, 1.9, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(97, 1, '2024-11-07 10:14:18', 104.1, 1.73, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(98, 1, '2024-11-07 10:24:57', 53.7, 1.56, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(101, 1, '2024-11-11 20:27:55', 76.9, 1.49, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_treino_exercicio`
--

DROP TABLE IF EXISTS `tb_treino_exercicio`;
CREATE TABLE IF NOT EXISTS `tb_treino_exercicio` (
  `id` int NOT NULL AUTO_INCREMENT,
  `treino_serie_id` int NOT NULL,
  `exercicio_id` int NOT NULL,
  `cargas` json DEFAULT NULL,
  `repeticoes` json DEFAULT NULL,
  `pausa` int DEFAULT NULL,
  `concentrica` int DEFAULT NULL,
  `excentrica` int DEFAULT NULL,
  `recuperacao_entre_series` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_treino_exercicio`
--

INSERT INTO `tb_treino_exercicio` (`id`, `treino_serie_id`, `exercicio_id`, `cargas`, `repeticoes`, `pausa`, `concentrica`, `excentrica`, `recuperacao_entre_series`, `created_at`) VALUES
(1, 1, 8, '[\"1\"]', '[\"1\"]', 1, 1, 1, 1, '2024-10-28 20:10:35'),
(2, 1, 8, '[\"10\", \"12\"]', '[\"24\", \"23\"]', 0, 1, 1, 0, '2024-10-28 20:13:42'),
(3, 1, 11, '[\"12\", \"11\"]', '[\"21\", \"21\"]', 0, 1, 1, 0, '2024-10-28 20:13:42'),
(4, 3, 8, '[\"10\", \"12\"]', '[\"24\", \"23\"]', 0, 1, 1, 0, '2024-10-28 20:33:14'),
(5, 3, 11, '[\"12\", \"11\"]', '[\"21\", \"21\"]', 0, 1, 1, 0, '2024-10-28 20:33:14'),
(6, 4, 8, '[\"10\", \"9\", \"8\"]', '[\"10\", \"10\", \"10\"]', 0, 1, 2, 2, '2024-10-28 22:42:12'),
(7, 4, 7, '[\"9\", \"9\", \"9\"]', '[\"15\", \"13\", \"10\"]', 0, 1, 2, 2, '2024-10-28 22:42:12');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_treino_serie`
--

DROP TABLE IF EXISTS `tb_treino_serie`;
CREATE TABLE IF NOT EXISTS `tb_treino_serie` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `aula_numero` int NOT NULL,
  `descricao` varchar(255) DEFAULT NULL,
  `zona_alvo` varchar(255) DEFAULT NULL,
  `ativo` tinyint(1) DEFAULT NULL,
  `metodo` varchar(255) NOT NULL,
  `treino_exercicio_id` int NOT NULL,
  `fc_maxima` int DEFAULT NULL,
  `fc_reposo` int DEFAULT NULL,
  `vo2_exame` float DEFAULT NULL,
  `vo2_maximo` float DEFAULT NULL,
  `tempo_recuperacao` float DEFAULT NULL,
  `incremento_hiit` float DEFAULT NULL,
  `incremento_miit` float DEFAULT NULL,
  `macrociclo` varchar(255) DEFAULT NULL,
  `mesociclo` enum('introdutório','condicionante','competitivo','recuperativo') DEFAULT NULL,
  `microciclo` int DEFAULT NULL,
  `fase` int DEFAULT NULL,
  `sessao` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_treino_serie`
--

INSERT INTO `tb_treino_serie` (`id`, `usuario_id`, `aula_numero`, `descricao`, `zona_alvo`, `ativo`, `metodo`, `treino_exercicio_id`, `fc_maxima`, `fc_reposo`, `vo2_exame`, `vo2_maximo`, `tempo_recuperacao`, `incremento_hiit`, `incremento_miit`, `macrociclo`, `mesociclo`, `microciclo`, `fase`, `sessao`, `created_at`) VALUES
(1, 4, 1, 'TEste', 'Árdua (60% < 84% RVO²) Condicionamento cardiorespiratório', 0, 'de boa', 0, 189, 75, 1, 35, 1, 1, 1, 'introdutório', 'introdutório', 1, 1, 1, '2024-10-28 20:10:35'),
(2, 4, 2, 'TEste de novo', 'Máxima (100% RVO²) Esforço maximo', 1, 'de boa', 0, 187, 74, 3, 23, 1, 1, -2, 'introdutório', 'introdutório', 1, 1, 2, '2024-10-28 20:13:42'),
(3, 4, 2, 'TEste de novo', 'Máxima (100% RVO²) Esforço maximo', 1, 'de boa', 0, 187, 74, 3, 23, 1, 1, -2, 'introdutório', 'introdutório', 1, 1, 2, '2024-10-28 20:33:14'),
(4, 1, 1, 'vamos treinar', 'Muito leve (>20% RVO²) Reabilitação cardíaca', 0, 'devagar e sempre', 0, 179, 75, 1, 32, 2, 1, 1, 'introdutório', 'introdutório', 1, 1, 1, '2024-10-28 22:42:12');

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios_anamnese`
--

DROP TABLE IF EXISTS `tb_usuarios_anamnese`;
CREATE TABLE IF NOT EXISTS `tb_usuarios_anamnese` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `data_avaliacao` datetime NOT NULL,
  `domingo` tinyint(1) DEFAULT '0',
  `segunda` tinyint(1) DEFAULT '0',
  `terca` tinyint(1) DEFAULT '0',
  `quarta` tinyint(1) DEFAULT '0',
  `quinta` tinyint(1) DEFAULT '0',
  `sexta` tinyint(1) DEFAULT '0',
  `sabado` tinyint(1) DEFAULT '0',
  `minutos_dia` int DEFAULT NULL,
  `exercicios` text,
  `outros_exercicios` varchar(255) DEFAULT NULL,
  `nao_gosta` tinyint(1) DEFAULT '0',
  `nao_gosta_exercicios` varchar(255) DEFAULT NULL,
  `atividade_recente` tinyint(1) DEFAULT '0',
  `nome_atividade_recente` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci DEFAULT NULL,
  `dias_semana_recente` int DEFAULT NULL,
  `minutos_dia_recente` float DEFAULT NULL,
  `intensidade` varchar(50) DEFAULT NULL,
  `doencas` tinyint(1) DEFAULT '0',
  `doencas_nome` varchar(255) DEFAULT NULL,
  `remedios` varchar(255) DEFAULT NULL,
  `cirurgias` tinyint(1) DEFAULT '0',
  `regiao_cirurgia` varchar(255) DEFAULT NULL,
  `dor_muscular` tinyint(1) DEFAULT '0',
  `regioes_dor` text,
  `dor_peito` tinyint(1) DEFAULT '0',
  `tontura` tinyint(1) DEFAULT '0',
  `movimento_diario` tinyint(1) DEFAULT '0',
  `movimentos_dia` text,
  `parente_cardiaco` tinyint(1) DEFAULT '0',
  `num_parente_cardiaco` int DEFAULT NULL,
  `fumante` tinyint(1) DEFAULT '0',
  `info_pertinente` text,
  `aceito` tinyint(1) DEFAULT '0',
  `ciclo_menstrual` tinyint(1) DEFAULT NULL,
  `ciclo_menstrual_irregular` varchar(255) DEFAULT NULL,
  `sintomas_menstruais` json DEFAULT NULL,
  `uso_anticoncepcional` varchar(3) DEFAULT NULL,
  `fatores_impedem_treino` json DEFAULT NULL,
  `dificuldade_emagrecer` json DEFAULT NULL,
  `silhueta_real` int DEFAULT NULL,
  `silhueta_ideal` int DEFAULT NULL,
  `objetivos_6_meses` json DEFAULT NULL,
  `nome_remedios_emagrecer` varchar(255) DEFAULT NULL,
  `resultados_remedios` varchar(255) DEFAULT NULL,
  `dificuldade_emagrecer_outros` varchar(255) DEFAULT NULL,
  `remedios_emagrecer` tinyint(1) DEFAULT NULL,
  `autoestima` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_usuarios_anamnese`
--

INSERT INTO `tb_usuarios_anamnese` (`id`, `usuario_id`, `data_avaliacao`, `domingo`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `minutos_dia`, `exercicios`, `outros_exercicios`, `nao_gosta`, `nao_gosta_exercicios`, `atividade_recente`, `nome_atividade_recente`, `dias_semana_recente`, `minutos_dia_recente`, `intensidade`, `doencas`, `doencas_nome`, `remedios`, `cirurgias`, `regiao_cirurgia`, `dor_muscular`, `regioes_dor`, `dor_peito`, `tontura`, `movimento_diario`, `movimentos_dia`, `parente_cardiaco`, `num_parente_cardiaco`, `fumante`, `info_pertinente`, `aceito`, `ciclo_menstrual`, `ciclo_menstrual_irregular`, `sintomas_menstruais`, `uso_anticoncepcional`, `fatores_impedem_treino`, `dificuldade_emagrecer`, `silhueta_real`, `silhueta_ideal`, `objetivos_6_meses`, `nome_remedios_emagrecer`, `resultados_remedios`, `dificuldade_emagrecer_outros`, `remedios_emagrecer`, `autoestima`) VALUES
(1, 1, '2024-10-13 10:47:29', 0, 1, 1, 0, 0, 0, 0, NULL, '[\"musculacao\",\"esteira\",\"outros\"]', 'Capoeira', 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":4,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 1, '2024-10-13 10:49:52', 0, 1, 0, 0, 1, 1, 0, NULL, '[\"esteira\",\"bike\",\"outros\"]', 'Capoeira', 0, 'Capoeira&#039;', 1, NULL, 2, 1, 'M', 1, 'cachaça, barrigao', 'nenhum', 1, 'no cerebro', 1, '[{\"regiao\":\"Ombro\",\"nota\":6,\"dificuldade\":\"Dores musculares\"},{\"regiao\":\"Pesco\\u00e7o\",\"nota\":1,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 1, 'correr', 1, NULL, 1, 'Vamos ver', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 1, '2024-10-14 09:51:32', 1, 1, 1, 1, 1, 0, 0, 50, '[\"musculacao\",\"esteira\",\"natacao\"]', NULL, 0, 'Capoeira', 1, NULL, NULL, NULL, 'L', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 1, 'correr', 1, NULL, 1, 'sou cansado', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 1, '2024-10-14 10:30:52', 1, 1, 1, 1, 1, 1, 1, 60, '[\"natacao\",\"outros\"]', 'Tênis', NULL, 'Capoeira', 1, NULL, NULL, 30, 'L', 0, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":5,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 1, 'correr', 1, NULL, 1, 'Nada a declarar', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(5, 1, '2024-10-14 10:33:06', 1, 1, 1, 1, 1, 1, 1, 60, '[\"natacao\",\"outros\"]', 'Tênis', NULL, 'Capoeira', 1, NULL, NULL, 30, 'L', 0, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":5,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 1, 'correr', 1, NULL, 1, 'Nada a declarar', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 1, '2024-10-14 10:38:23', 1, 1, 1, 1, 1, 1, 1, 60, '[\"natacao\",\"outros\"]', 'Tênis', 1, 'Capoeira', 1, NULL, NULL, 30, 'L', 0, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":5,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 1, 'correr', 1, NULL, 1, 'Nada a declarar', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 1, '2024-10-14 10:39:05', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 1, '2024-10-14 10:58:05', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(9, 1, '2024-10-14 10:59:33', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(10, 1, '2024-10-14 11:00:30', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 1, '2024-10-14 11:04:17', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 'Capoeira', 1, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 1, '2024-10-14 11:12:03', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(13, 1, '2024-10-14 11:13:14', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(14, 1, '2024-10-14 11:15:27', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(15, 1, '2024-10-14 11:17:05', 1, 1, 1, 0, 0, 0, 0, 60, '[\"musculacao\",\"outros\"]', 'Tênis', 1, 'Capoeira', 1, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, 1, '2024-10-14 11:26:31', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(17, 1, '2024-10-14 11:29:44', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(18, 1, '2024-10-14 11:40:38', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'beber', 1, 'capoeira', 2, 12, 'L', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(19, 1, '2024-10-15 19:58:22', 1, 1, 1, 1, 1, 1, 1, NULL, '[\"musculacao\",\"peso_corpo\",\"esteira\",\"bike\",\"natacao\",\"lutas\",\"combolas\"]', NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(20, 4, '2024-10-15 19:58:38', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(21, 1, '2024-10-15 23:23:28', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(22, 1, '2024-10-15 23:24:07', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(23, 1, '2024-10-15 23:26:49', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(24, 1, '2024-10-15 23:28:08', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(25, 1, '2024-10-15 23:30:48', 1, 0, 1, 0, 1, 1, 1, NULL, '[\"natacao\",\"lutas\",\"outros\"]', 'Tênis', 1, 'Correr', 1, 'capoeira', 2, 1, 'L', 0, NULL, NULL, 0, NULL, 1, '[{\"regiao\":\"Ombro\",\"nota\":5,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 0, NULL, 0, NULL, 1, 'Sou mocorongo', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(26, 17, '2024-10-17 10:37:31', 0, 1, 0, 1, 0, 1, 0, NULL, '[\"esteira\"]', NULL, 1, 'Correr', 1, 'Futebol', 1, 1, 'L', 0, NULL, NULL, 1, 'Lobotomia', 0, '[]', 1, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(27, 7, '2024-10-18 12:13:16', 0, 1, 0, 1, 0, 1, 0, 60, '[\"musculacao\",\"esteira\",\"bike\"]', NULL, 1, 'Futebol', 1, 'Bike', 2, 1, 'L', 0, NULL, NULL, 0, NULL, 1, '[{\"regiao\":\"Ombro\",\"nota\":4,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 0, NULL, 1, NULL, 1, 'nada a declarar', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(28, 20, '2024-10-21 07:51:57', 0, 1, 0, 1, 0, 1, 0, NULL, '[\"musculacao\",\"natacao\"]', NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(29, 7, '2024-10-22 19:03:55', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(30, 72, '2024-11-04 14:53:15', 0, 1, 0, 1, 0, 1, 0, 60, '[\"bike\",\"natacao\",\"combolas\"]', NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(31, 72, '2024-11-04 14:53:58', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(32, 72, '2024-11-04 14:54:44', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(33, 72, '2024-11-04 14:58:25', 0, 1, 0, 1, 0, 1, 0, 90, '[\"musculacao\",\"natacao\"]', NULL, 1, 'Correr', 1, 'capoeira', 2, 1, 'L', 0, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":10,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 0, NULL, 1, NULL, 1, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(34, 72, '2024-11-04 15:16:53', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, 1, 'Ciclo menstrual irregular nos últimos 3 meses', '[\"visao_escurecida\", \"palpitacao\", \"outros\"]', 'SIM', '[\"dores_durante_exercicio\", \"nao_gosto_treinar_sozinha\"]', '[\"regularidade_dieta\", \"outros\"]', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(35, 72, '2024-11-04 15:55:20', 0, 1, 0, 1, 1, 0, 0, 90, '[\"bike\",\"natacao\"]', NULL, 0, NULL, 0, NULL, NULL, NULL, '', 1, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":6,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, 1, 'Ciclo menstrual irregular nos últimos 3 meses', '[\"moleza\", \"tristeza\", \"palpitacao\", \"outros\"]', 'SIM', '[\"falta_conhecimento\", \"nao_gosto_suar\", \"dores_apos_exercicio\"]', '[\"regularidade_dieta\", \"tristeza_falta_treinos\", \"outros\"]', 8, 5, '\"[\\\"emagrecer\\\",\\\"bem_consigo_mesma\\\",\\\"outros\\\"]\"', 'ozenpic', 'nenhum', 'Preguiça', 1, 'Alta'),
(36, 72, '2024-11-04 16:00:58', 0, 1, 0, 1, 0, 1, 0, 90, '[\"musculacao\",\"esteira\",\"natacao\"]', 'Capoeira', 1, 'correr', 1, 'Futebol', 1, 1, 'M', 1, 'cachaça, barrigao', 'nenhum', 1, 'no cerebro', 1, '[{\"regiao\":\"Ombro\",\"nota\":4,\"dificuldade\":\"Dores musculares\"}]', 1, 0, 1, 'correr', 1, NULL, 1, 'nada a declarar', 1, 1, 'Ciclo menstrual irregular nos últimos 4 a 6 meses', '[\"tontura\", \"dor_coluna_lombar\", \"dor_pernas\", \"palpitacao\", \"outros\"]', 'SIM', '[\"nao_gosto_suar\", \"experiencias_negativas\", \"nao_gosto_treinar_sozinha\"]', '[\"regularidade_exercicios\\\"\", \"tristeza_falta_treinos\", \"outros\"]', 7, 2, '[\"emagrecer\", \"ganho_massa_quadril_coxas\"]', 'ozenpic', 'nenhum', 'Preguiça', 1, 'Muito Alta'),
(37, 72, '2024-11-04 16:20:09', 0, 0, 0, 0, 0, 0, 0, NULL, '[\"outros\"]', 'Capoeira', 1, 'Correr', 1, 'Futebol', NULL, NULL, '', 1, NULL, NULL, 1, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, 1, 'Ciclo menstrual irregular somente no último mês', '[\"outros\", \"outros\"]', 'SIM', '[\"falta_energia\", \"falta_conhecimento\", \"medo_machucar\", \"nao_gosto_treinar_sozinha\"]', '[\"outros\"]', NULL, NULL, '[\"outros\"]', NULL, NULL, 'Preguiça', 1, ''),
(38, 1, '2024-11-07 09:38:09', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(39, 1, '2024-11-07 10:14:30', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL),
(40, 1, '2024-11-11 20:42:44', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, 60, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura para tabela `tb_usuarios_aptidao`
--

DROP TABLE IF EXISTS `tb_usuarios_aptidao`;
CREATE TABLE IF NOT EXISTS `tb_usuarios_aptidao` (
  `id` int NOT NULL AUTO_INCREMENT,
  `usuario_id` int NOT NULL,
  `data_avaliacao` datetime NOT NULL,
  `vo2_maximo` decimal(5,2) NOT NULL,
  `mets` decimal(5,2) NOT NULL,
  `metodo` varchar(50) CHARACTER SET utf8mb3 COLLATE utf8mb3_general_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `usuario_id` (`usuario_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_usuarios_aptidao`
--

INSERT INTO `tb_usuarios_aptidao` (`id`, `usuario_id`, `data_avaliacao`, `vo2_maximo`, `mets`, `metodo`) VALUES
(1, 1, '2024-11-08 19:02:28', 64.47, 18.42, ''),
(2, 1, '2024-11-08 19:03:27', 64.47, 18.42, ''),
(3, 1, '2024-11-08 19:03:27', 64.47, 18.42, ''),
(4, 1, '2024-11-08 19:05:47', 64.47, 18.42, ''),
(5, 1, '2024-11-08 19:05:47', 64.47, 18.42, ''),
(6, 1, '2024-11-12 10:25:27', 28.72, 8.20, 'equacao'),
(7, 1, '2024-11-12 10:41:22', 28.72, 8.20, 'equacao'),
(8, 1, '2024-11-12 10:47:14', 28.72, 8.20, 'equacao'),
(9, 1, '2024-11-12 10:50:32', 28.72, 8.20, 'equacao'),
(10, 1, '2024-11-12 10:50:39', 28.95, 8.27, 'equacao'),
(11, 1, '2024-11-12 10:58:20', 28.72, 8.20, 'equacao'),
(12, 1, '2024-11-12 11:16:24', 0.00, 0.00, 'cooper'),
(13, 1, '2024-11-12 11:19:31', 35.66, 10.19, 'cooper'),
(14, 1, '2024-11-12 12:47:08', 17.78, 5.08, 'cooper');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
