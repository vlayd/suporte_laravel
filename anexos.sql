-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/06/2025 às 05:38
-- Versão do servidor: 10.4.27-MariaDB
-- Versão do PHP: 8.1.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `suporte`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `anexos`
--

CREATE TABLE `anexos` (
  `id` int(11) NOT NULL,
  `arquivo` varchar(100) NOT NULL,
  `id_chamado` int(11) NOT NULL,
  `chat` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `anexos`
--

INSERT INTO `anexos` (`id`, `arquivo`, `id_chamado`, `chat`) VALUES
(1, 'Nubank_2024-07-03.pdf', 0, 0),
(2, '', 0, 0),
(3, '', 0, 0),
(4, '', 0, 0),
(5, 'faq.gif', 0, 0),
(6, '28 Planilha SEI - Suyane.xlsx', 0, 0),
(7, '29 Planilha SEI - Paulo Victor - NPATLOG.xlsx', 0, 0),
(8, 'Certidão - Jurado José Cleberson2.pdf', 0, 0),
(9, 'Vlayd (2).jpg', 0, 0),
(10, 'Imag005.jpg', 0, 0),
(11, 'Imagem0000.jpg', 16, 0),
(12, 'Imagem005.jpg', 17, 0),
(13, 'Imagem062.jpg', 18, 0),
(14, 'Imagem003.jpg', 19, 1),
(22, 'Imag015.jpg', 20, 1),
(23, 'OlhaEla2.jpg', 20, 1),
(24, 'Imagem003.jpg', 21, 1),
(25, 'Vlayd.jpg', 22, 1),
(26, 'Vlaydisson3.jpg', 22, 1),
(27, 'Vlaydisson3.jpg', 22, 0),
(28, 'Imag003.jpg', 23, 0),
(30, 'Imag005.jpg', 23, 4),
(31, 'Imagem0000.jpg', 23, 1),
(33, 'b2ap3_large_palacio.jpeg', 23, 11),
(34, 'AppSonhos.png', 23, 12),
(35, 'assinatura_neuma.jpg', 23, 17),
(36, 'AppSonhos.png', 23, 31),
(37, 'assinatura_neuma.jpg', 23, 33),
(39, 'Imag005.jpg', 24, 0),
(40, 'goku.jpg', 23, 43),
(41, 'b2ap3_large_palacio.jpeg', 34, 0),
(42, 'fabi.jpeg', 35, 0),
(43, 'AppSonhos.png', 48, 0),
(44, 'assinatura_neuma.jpg', 48, 0),
(46, 'fabi.jpeg', 49, 0),
(47, 'goku.jpg', 48, 0),
(48, 'goku.jpg', 49, 65),
(49, 'b2ap3_large_palacio.jpeg', 49, 66),
(50, 'erro.jpeg', 50, 0),
(51, 'acre.jpg', 51, 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `anexos`
--
ALTER TABLE `anexos`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `anexos`
--
ALTER TABLE `anexos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
