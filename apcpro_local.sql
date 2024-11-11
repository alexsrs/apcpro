-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 28/10/2024 às 22:55
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
) ENGINE=MyISAM AUTO_INCREMENT=136 DEFAULT CHARSET=utf8mb3;

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
  `grupo_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `professor_id` (`professor_id`),
  KEY `grupo_id` (`grupo_id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_admin.usuarios`
--

INSERT INTO `tb_admin.usuarios` (`id`, `user`, `password`, `img`, `nome`, `cargo`, `email`, `telefone`, `data_nascimento`, `data_inicio`, `sexo`, `cpf`, `professor_id`, `grupo_id`) VALUES
(1, 'admin', 'admin', '655387240a70f.jpg', 'Alex Sandro', 2, 'alexsrs@gmail.com', '(21) 98989-0615', '1981-01-04', '2024-09-30', 'M', '086.899.137-69', 0, 0),
(4, 'prof', 'prof', '65538e7ea62a1.jpg', 'Professor baitola', 1, 'prof@prof.com', '(21) 98989-0615', '2014-09-02', '2024-09-25', 'M', '086899137-69', 1, 0),
(7, 'teste', 'teste', '66f2c68510739.jpg', 'Testando ', 0, 'teste@aluno.net', '(21) 98989-0615', '2024-09-05', '2024-09-11', 'F', '086899137-69', 1, 0),
(15, 'joao', 'joao', '66f42cc21846d.jpg', 'Joao', 0, 'alexsrs@gmail.com', '(21) 98989-0615', '1981-01-04', '1982-02-05', 'M', '086899137-69', 4, 0),
(16, 'prof2', 'prof2', '66f42d0c0dea8.jpg', 'professor 2', 1, 'cootidr@seap.rj.gov.br', '(21) 98989-0615', '1973-01-06', '2024-12-26', 'F', '086899137-69', 1, 0),
(17, 'jkerbin ', '1234', '66f4a3ad8411e.jpeg', 'Jebediah Kerbin', 0, 'jkerbin@terra.com.br', '(21) 96787-0567', '1992-11-06', '2024-10-12', 'M', '121232343-79', 4, 0),
(18, 'zuka', '1234', '66f5a7e46eace.png', 'Zuka da Silva sauro', 1, 'zuka@dell.com', '(21) 95499-1323', '1967-09-01', '2025-01-12', 'F', '111.222.333-44', 1, 0),
(19, 'teste0', 'teste0', '66ff3eb0994ea.jpeg', 'Teste 0', 1, 'cootidr@seap.rj.gov.br', '(21) 32346-260', '1937-10-03', '2024-11-06', 'M', '111.111.111-11', 1, 0),
(20, 'fernanda', 'fernanda', '', 'Fernanda', 1, 'alexsrs@gmail.com', '(21) 98487-0182', '1985-07-05', '2024-11-08', 'F', '111.111.111-11', 1, 0),
(21, 'sofia', 'sofia', '6711118ee2354.jpeg', 'sofia', 1, 'sofia@teste.com', '(11) 11111-1111', '2007-02-07', '2024-11-04', 'F', '111.111.111-11', 1, 0),
(22, 'Joselia', 'joselia', '', 'Joselia', 1, 'joselia@test.com', '(21) 22222-2222', '1963-09-05', '2024-11-01', 'F', '122.222.222-22', 1, 2),
(23, 'Josias', 'josias', '', 'Josias da silva', 1, 'alexsrs@gmail.com', '(21) 98487-0182', '1986-11-08', '2024-11-01', 'M', '000.000.000-00', 1, 1),
(24, 'natalia', 'natalia', '', 'Natalia xupa q e de uva', 1, 'alexsrs@gmail.com', '(11) 11111-1111', '1991-05-24', '2024-10-31', 'F', '122.222.222-22', 1, 31),
(25, 'louro', 'louro', '', 'Louro José', 1, 'aaaaa@jjjjjjjj.clm', '(22) 22222-2222', '1976-12-09', '2024-11-08', 'M', '333.333.333-33', 1, 31),
(26, 'joselito', 'joselito', '', 'Alex Sandro Ribeiro de Souza', 1, 'alexsrs@seap.rj.gov.br', '(21) 32346-260', '1994-03-18', '2024-11-09', 'M', '111.111.111-11', 1, 32);

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
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

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
(26, '::1', '2024-10-28');

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
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_grupos_usuarios`
--

INSERT INTO `tb_grupos_usuarios` (`id`, `grupo`, `professor_id`) VALUES
(1, 'Time de volley Tijuca Tenis Clube', 1),
(2, 'Academia XYZ', 1),
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
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

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
(8, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, '2024-10-28 10:30:53');

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
) ENGINE=MyISAM AUTO_INCREMENT=86 DEFAULT CHARSET=utf8mb3;

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
(85, 1, '2024-10-22 19:49:11', 137.7, 1.89, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

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
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3;

--
-- Despejando dados para a tabela `tb_usuarios_anamnese`
--

INSERT INTO `tb_usuarios_anamnese` (`id`, `usuario_id`, `data_avaliacao`, `domingo`, `segunda`, `terca`, `quarta`, `quinta`, `sexta`, `sabado`, `minutos_dia`, `exercicios`, `outros_exercicios`, `nao_gosta`, `nao_gosta_exercicios`, `atividade_recente`, `nome_atividade_recente`, `dias_semana_recente`, `minutos_dia_recente`, `intensidade`, `doencas`, `doencas_nome`, `remedios`, `cirurgias`, `regiao_cirurgia`, `dor_muscular`, `regioes_dor`, `dor_peito`, `tontura`, `movimento_diario`, `movimentos_dia`, `parente_cardiaco`, `num_parente_cardiaco`, `fumante`, `info_pertinente`, `aceito`) VALUES
(1, 1, '2024-10-13 10:47:29', 0, 1, 1, 0, 0, 0, 0, NULL, '[\"musculacao\",\"esteira\",\"outros\"]', 'Capoeira', 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":4,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(2, 1, '2024-10-13 10:49:52', 0, 1, 0, 0, 1, 1, 0, NULL, '[\"esteira\",\"bike\",\"outros\"]', 'Capoeira', 0, 'Capoeira&#039;', 1, NULL, 2, 1, 'M', 1, 'cachaça, barrigao', 'nenhum', 1, 'no cerebro', 1, '[{\"regiao\":\"Ombro\",\"nota\":6,\"dificuldade\":\"Dores musculares\"},{\"regiao\":\"Pesco\\u00e7o\",\"nota\":1,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 1, 'correr', 1, NULL, 1, 'Vamos ver', 1),
(3, 1, '2024-10-14 09:51:32', 1, 1, 1, 1, 1, 0, 0, 50, '[\"musculacao\",\"esteira\",\"natacao\"]', NULL, 0, 'Capoeira', 1, NULL, NULL, NULL, 'L', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 1, 'correr', 1, NULL, 1, 'sou cansado', 1),
(4, 1, '2024-10-14 10:30:52', 1, 1, 1, 1, 1, 1, 1, 60, '[\"natacao\",\"outros\"]', 'Tênis', NULL, 'Capoeira', 1, NULL, NULL, 30, 'L', 0, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":5,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 1, 'correr', 1, NULL, 1, 'Nada a declarar', 1),
(5, 1, '2024-10-14 10:33:06', 1, 1, 1, 1, 1, 1, 1, 60, '[\"natacao\",\"outros\"]', 'Tênis', NULL, 'Capoeira', 1, NULL, NULL, 30, 'L', 0, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":5,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 1, 'correr', 1, NULL, 1, 'Nada a declarar', 1),
(6, 1, '2024-10-14 10:38:23', 1, 1, 1, 1, 1, 1, 1, 60, '[\"natacao\",\"outros\"]', 'Tênis', 1, 'Capoeira', 1, NULL, NULL, 30, 'L', 0, NULL, NULL, 0, NULL, 0, '[{\"regiao\":\"Ombro\",\"nota\":5,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 1, 'correr', 1, NULL, 1, 'Nada a declarar', 1),
(7, 1, '2024-10-14 10:39:05', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(8, 1, '2024-10-14 10:58:05', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(9, 1, '2024-10-14 10:59:33', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(10, 1, '2024-10-14 11:00:30', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(11, 1, '2024-10-14 11:04:17', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, 'Capoeira', 1, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(12, 1, '2024-10-14 11:12:03', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(13, 1, '2024-10-14 11:13:14', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(14, 1, '2024-10-14 11:15:27', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(15, 1, '2024-10-14 11:17:05', 1, 1, 1, 0, 0, 0, 0, 60, '[\"musculacao\",\"outros\"]', 'Tênis', 1, 'Capoeira', 1, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(16, 1, '2024-10-14 11:26:31', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, '', 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(17, 1, '2024-10-14 11:29:44', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(18, 1, '2024-10-14 11:40:38', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 1, 'beber', 1, 'capoeira', 2, 12, 'L', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(19, 1, '2024-10-15 19:58:22', 1, 1, 1, 1, 1, 1, 1, NULL, '[\"musculacao\",\"peso_corpo\",\"esteira\",\"bike\",\"natacao\",\"lutas\",\"combolas\"]', NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(20, 4, '2024-10-15 19:58:38', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(21, 1, '2024-10-15 23:23:28', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(22, 1, '2024-10-15 23:24:07', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(23, 1, '2024-10-15 23:26:49', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(24, 1, '2024-10-15 23:28:08', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, NULL, 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(25, 1, '2024-10-15 23:30:48', 1, 0, 1, 0, 1, 1, 1, NULL, '[\"natacao\",\"lutas\",\"outros\"]', 'Tênis', 1, 'Correr', 1, 'capoeira', 2, 1, 'L', 0, NULL, NULL, 0, NULL, 1, '[{\"regiao\":\"Ombro\",\"nota\":5,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 0, NULL, 0, NULL, 1, 'Sou mocorongo', 1),
(26, 17, '2024-10-17 10:37:31', 0, 1, 0, 1, 0, 1, 0, NULL, '[\"esteira\"]', NULL, 1, 'Correr', 1, 'Futebol', 1, 1, 'L', 0, NULL, NULL, 1, 'Lobotomia', 0, '[]', 1, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(27, 7, '2024-10-18 12:13:16', 0, 1, 0, 1, 0, 1, 0, 60, '[\"musculacao\",\"esteira\",\"bike\"]', NULL, 1, 'Futebol', 1, 'Bike', 2, 1, 'L', 0, NULL, NULL, 0, NULL, 1, '[{\"regiao\":\"Ombro\",\"nota\":4,\"dificuldade\":\"Dores musculares\"}]', 0, 0, 0, NULL, 1, NULL, 1, 'nada a declarar', 1),
(28, 20, '2024-10-21 07:51:57', 0, 1, 0, 1, 0, 1, 0, NULL, '[\"musculacao\",\"natacao\"]', NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1),
(29, 7, '2024-10-22 19:03:55', 0, 0, 0, 0, 0, 0, 0, NULL, NULL, NULL, 0, NULL, 0, NULL, NULL, NULL, '', 0, NULL, NULL, 0, NULL, 0, '[]', 0, 0, 0, NULL, 0, NULL, 0, NULL, 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
