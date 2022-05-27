-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 27/05/2022 às 17:13
-- Versão do servidor: 5.7.24-0ubuntu0.18.04.1
-- Versão do PHP: 7.3.33-1+ubuntu18.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `Tejas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `extrato`
--

CREATE TABLE `extrato` (
  `id` int(11) NOT NULL,
  `tipo` varchar(255) NOT NULL,
  `data` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `descricao` varchar(255) NOT NULL,
  `valor` double NOT NULL,
  `destino` varchar(255) NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `extrato`
--

INSERT INTO `extrato` (`id`, `tipo`, `data`, `descricao`, `valor`, `destino`, `usuario`) VALUES
(1, 'Pix (recebido)', '2022-05-27 14:42:09', 'aaaa', 1000, 'zxc (74239531)', 55942293),
(2, 'Pix', '2022-05-27 14:42:09', 'aaaa', 1000, 'aa (55942293)', 74239531),
(3, 'Pix (recebido)', '2022-05-27 14:45:45', 'sadasoijdasodh', 1000, 'aa (55942293)', 74239531),
(4, 'Pix', '2022-05-27 14:45:45', 'sadasoijdasodh', 1000, 'zxc (74239531)', 55942293),
(5, 'Pix', '2022-05-27 14:47:25', 'asdasd', 2, 'asd', 55942293);

-- --------------------------------------------------------

--
-- Estrutura para tabela `poupanca`
--

CREATE TABLE `poupanca` (
  `id` int(11) NOT NULL,
  `valor` double NOT NULL,
  `usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `poupanca`
--

INSERT INTO `poupanca` (`id`, `valor`, `usuario`) VALUES
(1, 0, 55942293),
(2, 0, 84656684),
(7, 600.00201171875, 74239531);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` char(60) NOT NULL,
  `valor` double NOT NULL,
  `dataLogin` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dataLogout` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id`, `numero`, `nome`, `senha`, `valor`, `dataLogin`, `dataLogout`) VALUES
(2, 55942293, 'aa', '$2y$10$teaEAHaHf2pHUFC8bO7uweqxZ4DlYHkRYAkfnXlwOkSXZdBgQh8WS', 98, '2022-05-27 14:47:35', '2022-05-27 14:57:35'),
(3, 84656684, 'asd', '$2y$10$zzccZHpj98d.SO664FZN3uWjzXfXcDoEFEZjZAgh0sTXo2qLluWni', 100, '2022-05-27 14:39:59', '2022-05-27 14:49:59'),
(4, 74239531, 'zxc', '$2y$10$QBoEK8wS7BzhIuCjkmLyGe0mS2gTGGpPue.bovVNz.0frBNDlFyeG', 32.06, '2022-05-27 17:06:59', '2022-05-27 17:16:59');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `extrato`
--
ALTER TABLE `extrato`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `poupanca`
--
ALTER TABLE `poupanca`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

--
-- Índices de tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `numero` (`numero`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `extrato`
--
ALTER TABLE `extrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `poupanca`
--
ALTER TABLE `poupanca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `extrato`
--
ALTER TABLE `extrato`
  ADD CONSTRAINT `extrato_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`numero`);

--
-- Restrições para tabelas `poupanca`
--
ALTER TABLE `poupanca`
  ADD CONSTRAINT `poupanca_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`numero`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
