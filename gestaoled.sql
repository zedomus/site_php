-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 06-Dez-2024 às 17:45
-- Versão do servidor: 8.3.0
-- versão do PHP: 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestaoled`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `equipamentos`
--

DROP TABLE IF EXISTS `equipamentos`;
CREATE TABLE IF NOT EXISTS `equipamentos` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `descricao` text,
  `quantidade` int NOT NULL,
  `data_registo` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `equipamentos`
--

INSERT INTO `equipamentos` (`id`, `nome`, `tipo`, `descricao`, `quantidade`, `data_registo`) VALUES
(1, 'Kit de Robótica', 'Robótica', 'Kit completo com sensores e motores', 11, '2024-12-03'),
(2, 'Máquina Fotográfica', 'Fotografia', 'Câmera DSLR Canon', 5, '2024-12-03'),
(3, 'Drone', 'Filmagem', 'Drone com câmara 4K', 3, '2024-12-03'),
(4, 'Kobra 3 - Impressora', 'Impressora 3D', '', 2, '2024-12-05'),
(5, 'Máquina Filmar Sony', 'Máquina de Filmar', '', 2, '2024-12-06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `requisicoes`
--

DROP TABLE IF EXISTS `requisicoes`;
CREATE TABLE IF NOT EXISTS `requisicoes` (
  `id` int NOT NULL AUTO_INCREMENT,
  `equipamento_id` int NOT NULL,
  `requisitante_id` int NOT NULL,
  `data_requisicao` date NOT NULL,
  `data_devolucao` date DEFAULT NULL,
  `estado` enum('pendente','devolvido') DEFAULT 'pendente',
  PRIMARY KEY (`id`),
  KEY `equipamento_id` (`equipamento_id`),
  KEY `requisitante_id` (`requisitante_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `requisicoes`
--

INSERT INTO `requisicoes` (`id`, `equipamento_id`, `requisitante_id`, `data_requisicao`, `data_devolucao`, `estado`) VALUES
(6, 2, 1, '2024-12-04', NULL, 'pendente'),
(2, 2, 2, '2024-12-03', '2024-12-03', 'devolvido'),
(3, 3, 1, '2024-12-03', '2024-12-03', 'devolvido'),
(4, 2, 1, '2024-12-03', NULL, 'pendente'),
(5, 3, 2, '2024-12-03', NULL, 'pendente'),
(7, 4, 1, '2024-12-05', '2024-12-05', 'devolvido'),
(8, 4, 1, '2024-12-05', NULL, 'pendente'),
(9, 4, 1, '2024-12-05', NULL, 'pendente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `email` varchar(191) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('professor','admin') DEFAULT 'professor',
  `data_registo` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `nome`, `email`, `password`, `role`, `data_registo`) VALUES
(1, 'Administrador', 'admin@led.com', 'admin123', 'admin', '2024-12-03 21:04:47'),
(2, 'Professor João', 'joao@led.com', 'joaopass123', 'professor', '2024-12-03 21:04:47');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
