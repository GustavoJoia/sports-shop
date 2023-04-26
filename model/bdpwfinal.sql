-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Nov-2022 às 12:25
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdpwfinal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcategoria`
--

CREATE TABLE `tbcategoria` (
  `codCategoria` int(11) NOT NULL,
  `nomeCategoria` varchar(50) NOT NULL,
  `descCategoria` varchar(300) NOT NULL,
  `fotoCategoria` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbcliente`
--

CREATE TABLE `tbcliente` (
  `codCliente` int(11) NOT NULL,
  `nivelAcesso` int(11) NOT NULL,
  `nomeCliente` varchar(80) NOT NULL,
  `cpfCliente` varchar(14) NOT NULL,
  `emailCliente` varchar(90) NOT NULL,
  `senhaCliente` varchar(30) NOT NULL,
  `logradouroCliente` varchar(120) NOT NULL,
  `numLogCliente` int(11) NOT NULL,
  `complCliente` varchar(60) DEFAULT NULL,
  `bairroCliente` varchar(60) NOT NULL,
  `cidadeCliente` varchar(50) NOT NULL,
  `ufCliente` varchar(5) NOT NULL,
  `cepCliente` varchar(10) NOT NULL,
  `ultimoLoginCliente` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbitemvenda`
--

CREATE TABLE `tbitemvenda` (
  `codItemVenda` int(11) NOT NULL,
  `codVenda` int(11) NOT NULL,
  `codProduto` int(11) NOT NULL,
  `qtdeItemVenda` int(11) NOT NULL,
  `subTotalItemVenda` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbproduto`
--

CREATE TABLE `tbproduto` (
  `codProduto` int(11) NOT NULL,
  `nomeProduto` varchar(50) NOT NULL,
  `estoqueProduto` int(11) NOT NULL,
  `marcaProduto` varchar(50) DEFAULT NULL,
  `precoProduto` double NOT NULL,
  `fotoProduto` varchar(300) DEFAULT NULL,
  `codCategoria` int(11) NOT NULL,
  `codSubCategoria` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbsubcategoria`
--

CREATE TABLE `tbsubcategoria` (
  `codSubCategoria` int(11) NOT NULL,
  `nomeSubCategoria` varchar(50) NOT NULL,
  `descSubCategoria` varchar(300) NOT NULL,
  `fotoSubCategoria` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tbvenda`
--

CREATE TABLE `tbvenda` (
  `codVenda` int(11) NOT NULL,
  `dataVenda` datetime NOT NULL,
  `valorTotalVenda` double NOT NULL,
  `statusVenda` int(11) NOT NULL,
  `codCliente` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  ADD PRIMARY KEY (`codCategoria`);

--
-- Índices para tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  ADD PRIMARY KEY (`codCliente`);

--
-- Índices para tabela `tbitemvenda`
--
ALTER TABLE `tbitemvenda`
  ADD PRIMARY KEY (`codItemVenda`),
  ADD KEY `fk_codVenda` (`codVenda`),
  ADD KEY `fk_codProduto` (`codProduto`);

--
-- Índices para tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD PRIMARY KEY (`codProduto`),
  ADD KEY `fk_categoria_subcategoria` (`codCategoria`,`codSubCategoria`),
  ADD KEY `codSubCategoria` (`codSubCategoria`);

--
-- Índices para tabela `tbsubcategoria`
--
ALTER TABLE `tbsubcategoria`
  ADD PRIMARY KEY (`codSubCategoria`);

--
-- Índices para tabela `tbvenda`
--
ALTER TABLE `tbvenda`
  ADD PRIMARY KEY (`codVenda`),
  ADD KEY `fk_codCliente` (`codCliente`) USING BTREE;

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `tbcategoria`
--
ALTER TABLE `tbcategoria`
  MODIFY `codCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT de tabela `tbcliente`
--
ALTER TABLE `tbcliente`
  MODIFY `codCliente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbitemvenda`
--
ALTER TABLE `tbitemvenda`
  MODIFY `codItemVenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  MODIFY `codProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `tbsubcategoria`
--
ALTER TABLE `tbsubcategoria`
  MODIFY `codSubCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `tbvenda`
--
ALTER TABLE `tbvenda`
  MODIFY `codVenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `tbitemvenda`
--
ALTER TABLE `tbitemvenda`
  ADD CONSTRAINT `tbitemvenda_ibfk_1` FOREIGN KEY (`codVenda`) REFERENCES `tbvenda` (`codVenda`),
  ADD CONSTRAINT `tbitemvenda_ibfk_2` FOREIGN KEY (`codProduto`) REFERENCES `tbproduto` (`codProduto`);

--
-- Limitadores para a tabela `tbproduto`
--
ALTER TABLE `tbproduto`
  ADD CONSTRAINT `tbproduto_ibfk_1` FOREIGN KEY (`codCategoria`) REFERENCES `tbcategoria` (`codCategoria`),
  ADD CONSTRAINT `tbproduto_ibfk_2` FOREIGN KEY (`codSubCategoria`) REFERENCES `tbsubcategoria` (`codSubCategoria`);

--
-- Limitadores para a tabela `tbvenda`
--
ALTER TABLE `tbvenda`
  ADD CONSTRAINT `tbvenda_ibfk_1` FOREIGN KEY (`codCliente`) REFERENCES `tbcliente` (`codCliente`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
