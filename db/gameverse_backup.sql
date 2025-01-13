-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13/01/2025 às 04:41
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
) ENGINE=MyISAM AUTO_INCREMENT=71 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `favoritos`
--

INSERT INTO `favoritos` (`id`, `id_user`, `id_jogo`) VALUES
(7, 1, 1),
(12, 2, 1),
(70, 3, 1);

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
(1, 'Academic Adventure', 'Academic Adventure é um jogo de aventura...', 'assets/Academic Adventure.png'),
(2, 'Jogo 2', 'Descrição do Jogo 2', 'assets/adm.png'),
(3, 'Jogo 3', 'Descrição do Jogo 3', 'assets/security.png');

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
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Despejando dados para a tabela `user`
--

INSERT INTO `user` (`id_user`, `nome`, `email`, `senha`) VALUES
(1, 'teste', 'Teste@teste.com', '12345678'),
(2, 'Lucas', 'lucas@teste.com', '12345678'),
(3, 'João', 'joao@teste.com', '123456789');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
