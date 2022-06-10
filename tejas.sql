-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 10/06/2022 às 17:02
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
-- Banco de dados: `tejas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `auditoria`
--

CREATE TABLE `auditoria` (
  `id` int(11) NOT NULL,
  `usuario` int(11) NOT NULL,
  `data` datetime NOT NULL,
  `tipo` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Despejando dados para a tabela `auditoria`
--

INSERT INTO `auditoria` (`id`, `usuario`, `data`, `tipo`) VALUES
(1, 49973232, '2022-06-10 17:00:41', 'logout'),
(2, 49973232, '2022-06-10 17:00:55', 'login'),
(3, 49973232, '2022-06-10 17:01:06', 'logout'),
(4, 74239531, '2022-06-10 17:01:09', 'login'),
(5, 74239531, '2022-06-10 17:01:15', 'logout');

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
(5, 'Pix', '2022-05-27 14:47:25', 'asdasd', 2, 'asd', 55942293),
(6, 'Pix', '2022-06-10 16:01:01', 'aa', 21, '52293', 19907511),
(7, 'Pix', '2022-06-10 16:21:53', 'asd', 2, 'asd', 19907511),
(8, 'Pix', '2022-06-10 16:22:37', 'asd', 1, '123', 19907511),
(9, 'Pix', '2022-06-10 16:24:03', 'asd', 23, 'zxc (74239531)', 19907511),
(10, 'Pix (recebido)', '2022-06-10 16:24:03', 'asd', 23, 'aaa (19907511)', 74239531),
(11, 'Pix', '2022-06-10 16:44:32', 'asd', 12, '123 (49973232)', 49973232),
(12, 'Pix', '2022-06-10 16:44:41', 'asd', 22, '123 (49973232)', 49973232),
(13, 'Pix', '2022-06-10 16:44:54', 'a', 100, '123 (49973232)', 49973232),
(14, 'Boleto', '2022-06-10 16:45:53', 'asd', 500, '123 (49973232)', 49973232),
(15, 'Pix', '2022-06-10 16:46:25', 'AAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAAA', 1000, '123 (49973232)', 49973232),
(16, 'Pix', '2022-06-10 16:47:17', 'Qualquer coisa', 170, 'Garagem', 49973232),
(17, 'Pix', '2022-06-10 16:47:35', 'aa', 120, 'Luz', 49973232),
(18, 'Pix', '2022-06-10 16:48:23', ':)', 1000, 'Fulano de Tal (88636532)', 49973232),
(19, 'Pix (recebido)', '2022-06-10 16:48:23', ':)', 1000, '123 (49973232)', 88636532),
(20, 'Pix', '2022-06-10 16:48:53', 'aa', 44, 'zxc (74239531)', 49973232),
(21, 'Pix (recebido)', '2022-06-10 16:48:53', 'aa', 44, '123 (49973232)', 74239531),
(22, 'Pix', '2022-06-10 16:49:47', 'asd', 99, '123 (49973232)', 74239531),
(23, 'Pix (recebido)', '2022-06-10 16:49:47', 'asd', 99, 'zxc (74239531)', 49973232);

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
(7, 600.00201171875, 74239531),
(8, 0, 88636532),
(9, 0, 19907511),
(10, 100, 49973232);

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
(4, 74239531, 'zxc', '$2y$10$QBoEK8wS7BzhIuCjkmLyGe0mS2gTGGpPue.bovVNz.0frBNDlFyeG', 0.060000000000002, '2022-06-10 17:01:09', '2022-06-10 17:01:15'),
(5, 88636532, 'Fulano de Tal', '$2y$10$l4gbilyqClUJBzITMDFYR.0dCP8Rkh2YCE/lqYaoQ4aorjzppwIyi', 1100, '2022-06-10 15:03:31', '2022-06-10 15:13:31'),
(6, 19907511, 'aaa', '$2y$10$gZmIbCab3IIJjLNKx9yaBOZkxfub9YYFjgK/9OA5TWojEPDlBlW7C', 53, '2022-06-10 16:24:45', '2022-06-10 16:34:45'),
(7, 49973232, '123', '$2y$10$KzB5t9HeZC1toKjMgcRAl.0OSLWjO/qjvQH1xk1oSS8BUkOKjEpvC', 399, '2022-06-10 17:00:55', '2022-06-10 17:01:06');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `auditoria`
--
ALTER TABLE `auditoria`
  ADD PRIMARY KEY (`id`),
  ADD KEY `usuario` (`usuario`);

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
-- AUTO_INCREMENT de tabela `auditoria`
--
ALTER TABLE `auditoria`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `extrato`
--
ALTER TABLE `extrato`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT de tabela `poupanca`
--
ALTER TABLE `poupanca`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `auditoria`
--
ALTER TABLE `auditoria`
  ADD CONSTRAINT `auditoria_ibfk_1` FOREIGN KEY (`usuario`) REFERENCES `usuario` (`numero`);

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
