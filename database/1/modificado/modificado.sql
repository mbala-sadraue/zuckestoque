-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Jul-2021 às 12:17
-- Versão do servidor: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `control_estoque`
--
CREATE DATABASE IF NOT EXISTS `control_estoque` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `control_estoque`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `estoque`
--

CREATE TABLE `estoque` (
  `idEstoque` int(11) NOT NULL,
  `NomeEstoque` varchar(150) NOT NULL,
  `Usuario_idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `fabricante`
--

CREATE TABLE `fabricante` (
  `idFabricante` int(11) NOT NULL,
  `NomeFabricante` varchar(200) DEFAULT NULL,
  `TelefoneFabricante` varchar(150) DEFAULT NULL,
  `EmailFabricante` varchar(150) DEFAULT NULL,
  `EnderecoFabricante` varchar(200) DEFAULT NULL,
  `Fabricante_ativo` enum('0','1') DEFAULT NULL,
  `Usuario_idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Estrutura da tabela `itens`
--

CREATE TABLE `itens` (
  `idItem` int(11) NOT NULL,
  `Produto_idProduto` int(11) NOT NULL,
  `QuantItens` int(11) NOT NULL,
  `QuantItensVendido` int(11) NOT NULL,
  `QItemEstoque` int(11) NOT NULL,
  `ValorCompraItem` decimal(10,0) NOT NULL,
  `ValorVendaItem` decimal(10,0) NOT NULL,
  `DataCompraItem` date DEFAULT NULL,
  `DataVencimentoItem` date DEFAULT NULL,
  `itens_ativo` int(11) NOT NULL DEFAULT '1',
  `Usuario_idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estrutura da tabela `marca`
--

CREATE TABLE `marca` (
  `idMarca` int(11) NOT NULL,
  `NomeMarca` varchar(175) NOT NULL,
  `pro_idProduto` int(11) NOT NULL,
  `fabri_idFabricante` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estrutura da tabela `produto`
--

CREATE TABLE `produto` (
  `idProduto` int(11) NOT NULL,
  `NomeProduto` varchar(200) DEFAULT NULL,
  `Descricao` varchar(200) NOT NULL,
  `Pro_ativo` enum('1','0') NOT NULL DEFAULT '1',
  `Usuario_idUser` int(11) NOT NULL,
  `ImagemProduto` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;



--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL,
  `NomeUsuario` varchar(200) NOT NULL,
  `TelefoneUsuario` varchar(150) DEFAULT NULL,
  `Sexo` enum('Masculino','Femenino') DEFAULT NULL,
  `Nascimento` date NOT NULL,
  `Login` varchar(200) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `tipoPerminssao` enum('1','2','3') DEFAULT NULL,
  `User_ativo` enum('1','0') NOT NULL DEFAULT '1',
  `ImagemUsuario` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--


--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `idVenda` int(11) NOT NULL,
  `IdItem` int(11) NOT NULL,
  `QuanItem` int(11) NOT NULL,
  `Preco` int(11) NOT NULL,
  `NomeCliente` varchar(200) NOT NULL,
  `cart` varchar(200) NOT NULL,
  `DataVenda` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `User_idUser` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


--
-- Indexes for dumped tables
--

--
-- Indexes for table `estoque`
--
ALTER TABLE `estoque`
  ADD PRIMARY KEY (`idEstoque`);

--
-- Indexes for table `fabricante`
--
ALTER TABLE `fabricante`
  ADD PRIMARY KEY (`idFabricante`);

--
-- Indexes for table `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`idItem`),
  ADD KEY `Produto_idProduto` (`Produto_idProduto`);

--
-- Indexes for table `marca`
--
ALTER TABLE `marca`
  ADD PRIMARY KEY (`idMarca`),
  ADD KEY `pro_idProduto` (`pro_idProduto`),
  ADD KEY `fabri_idFabricante` (`fabri_idFabricante`);

--
-- Indexes for table `produto`
--
ALTER TABLE `produto`
  ADD PRIMARY KEY (`idProduto`);

--
-- Indexes for table `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`idUsuario`);

--
-- Indexes for table `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`idVenda`),
  ADD KEY `IdItem` (`IdItem`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `estoque`
--
ALTER TABLE `estoque`
  MODIFY `idEstoque` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `fabricante`
--
ALTER TABLE `fabricante`
  MODIFY `idFabricante` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `itens`
--
ALTER TABLE `itens`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `idVenda` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `itens_ibfk_1` FOREIGN KEY (`Produto_idProduto`) REFERENCES `produto` (`idProduto`);

--
-- Limitadores para a tabela `marca`
--
ALTER TABLE `marca`
  ADD CONSTRAINT `marca_ibfk_1` FOREIGN KEY (`pro_idProduto`) REFERENCES `produto` (`idProduto`),
  ADD CONSTRAINT `marca_ibfk_2` FOREIGN KEY (`fabri_idFabricante`) REFERENCES `fabricante` (`idFabricante`);

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `venda_ibfk_1` FOREIGN KEY (`IdItem`) REFERENCES `itens` (`idItem`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
