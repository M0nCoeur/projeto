-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 27/01/2025 às 11:07
-- Versão do servidor: 9.1.0
-- Versão do PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gameverse`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `avaliacoes`
--

DROP TABLE IF EXISTS `avaliacoes`;
CREATE TABLE IF NOT EXISTS `avaliacoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_jogo` int NOT NULL,
  `nota` int NOT NULL,
  `comentario` text,
  `data_avaliacao` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_jogo` (`id_jogo`)
) ;

--
-- Despejando dados para a tabela `avaliacoes`
--

INSERT INTO `avaliacoes` (`id`, `id_user`, `id_jogo`, `nota`, `comentario`, `data_avaliacao`) VALUES
(1, 1, 1, 4, 'Ótimo jogo, adorei o mapa.', '2025-01-15 00:00:40'),
(2, 3, 1, 2, 'Jogo maravilhoso, adorei o estilo dos personagens e do mapa, lembra muito o Pokémon de Gameboy Advance.', '2025-01-15 00:01:07'),
(3, 4, 1, 5, 'Adorei o jogo. A ambientação é muito bacana. Parece Pokemon.', '2025-01-15 07:51:08'),
(4, 5, 1, 1, 'Ótimo jogo, gostei bastante.', '2025-01-15 08:06:54'),
(5, 6, 1, 5, 'Top de mais', '2025-01-15 08:18:30'),
(6, 7, 1, 5, 'Bom jogo, funcionando bem.', '2025-01-15 10:42:11'),
(7, 8, 1, 5, 'Muito bom! Adorei', '2025-01-16 10:53:21'),
(8, 9, 1, 5, 'Que jogo legal, adorei baixá-lo e jogar por várias horas. Obrigado Equipe do GameVerse.', '2025-01-17 09:11:21'),
(9, 10, 1, 5, 'Jogo legal de mais! Teste', '2025-01-17 10:46:21'),
(10, 11, 1, 5, 'Nice game!', '2025-01-19 16:41:43'),
(11, 12, 1, 3, 'Gostei do jogo, lembrou muito meus tempos de Senac.', '2025-01-19 17:07:52'),
(12, 13, 1, 3, 'Que legal! Bacana', '2025-01-20 08:10:35'),
(13, 14, 1, 3, 'Achei legal, mas existem pontos para serem melhorados, como a animação no caso.', '2025-01-26 20:04:38');

-- --------------------------------------------------------

--
-- Estrutura para tabela `favoritos`
--

DROP TABLE IF EXISTS `favoritos`;
CREATE TABLE IF NOT EXISTS `favoritos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `id_user` int NOT NULL,
  `id_jogo` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_user` (`id_user`),
  KEY `id_jogo` (`id_jogo`)
) ENGINE=MyISAM AUTO_INCREMENT=223 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `favoritos`
--

INSERT INTO `favoritos` (`id`, `id_user`, `id_jogo`) VALUES
(12, 2, 1),
(206, 9, 1),
(199, 7, 1),
(217, 6, 1),
(205, 3, 1),
(207, 10, 1),
(208, 11, 1),
(211, 12, 1),
(216, 3, 2),
(213, 3, 3),
(215, 13, 1),
(218, 14, 1),
(219, 14, 2),
(220, 14, 3),
(221, 1, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogos`
--

DROP TABLE IF EXISTS `jogos`;
CREATE TABLE IF NOT EXISTS `jogos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `descricao` text,
  `imagem` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `jogos`
--

INSERT INTO `jogos` (`id`, `nome`, `descricao`, `imagem`) VALUES
(1, 'Academic Adventure', 'Uma jornada educativa na área de TI, cheia de desafios e descobertas rumo ao diploma!', 'assets\\logo-sem-fundo.png'),
(2, 'Academic Administração', 'Uma jornada educativa na área de Administração, cheia de desafios e descobertas rumo ao diploma!', 'assets/adm.png'),
(3, 'Academic Security', 'Uma jornada educativa na área da Segurança, cheia de desafios e descobertas rumo ao diploma!', 'assets/Logo4.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `jogos_jogados`
--

DROP TABLE IF EXISTS `jogos_jogados`;
CREATE TABLE IF NOT EXISTS `jogos_jogados` (
  `id_user` int NOT NULL,
  `id_jogo` int NOT NULL,
  `avaliado` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id_user`,`id_jogo`),
  KEY `id_jogo` (`id_jogo`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `jogos_jogados`
--

INSERT INTO `jogos_jogados` (`id_user`, `id_jogo`, `avaliado`) VALUES
(3, 1, 1),
(1, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id_user` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `senha` varchar(20) NOT NULL,
  PRIMARY KEY (`id_user`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id_user`, `nome`, `email`, `senha`) VALUES
(1, 'teste', 'Teste@teste.com', '12345678'),
(2, 'Lucas', 'lucas@teste.com', '12345678'),
(3, 'Maria', 'maria@teste.com', '123456789'),
(4, 'Jorge', 'jorge@teste.com', '12345678'),
(5, 'Teste2', 'teste2@teste.com', '12345678'),
(6, 'QWERT', 'QWERT@QWERT.COM', '12345678'),
(7, 'Cleviton', 'cleviton@teste.com', '12345678'),
(8, 'Sergio', 'sergio@teste.com', '12345678'),
(9, 'Luan', 'luan@teste.com', '12345678'),
(10, 'Marcelão', 'marcelo@teste.com', '12345678'),
(11, 'Theo', 'th@teste.com', '12345678'),
(12, 'Celso', 'celso@teste.com', '12345678'),
(13, 'Ludmila', 'ludmila123@teste.com', '12345678'),
(14, 'yyScarlet', 'yyscarlet@teste.com', '12345678');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
