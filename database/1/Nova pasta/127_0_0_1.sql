-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 18-Jul-2021 às 13:17
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
-- Extraindo dados da tabela `fabricante`
--

INSERT INTO `fabricante` (`idFabricante`, `NomeFabricante`, `TelefoneFabricante`, `EmailFabricante`, `EnderecoFabricante`, `Fabricante_ativo`, `Usuario_idUser`) VALUES
(1, 'Refriango', '94446667', 'refri@ango.com', 'Viana, Zango2', '1', 1);

-- --------------------------------------------------------

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
-- Extraindo dados da tabela `itens`
--

INSERT INTO `itens` (`idItem`, `Produto_idProduto`, `QuantItens`, `QuantItensVendido`, `QItemEstoque`, `ValorCompraItem`, `ValorVendaItem`, `DataCompraItem`, `DataVencimentoItem`, `itens_ativo`, `Usuario_idUser`) VALUES
(1, 3, 10, 9, 1, '12300', '13300', '2021-07-06', '2025-07-06', 1, 1),
(2, 2, 7, 5, 2, '18000', '20000', '2021-07-08', '2025-07-08', 1, 1),
(3, 4, 10, 10, 0, '1000', '1200', '2021-07-08', '2027-07-08', 1, 1);

-- --------------------------------------------------------

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
-- Extraindo dados da tabela `marca`
--

INSERT INTO `marca` (`idMarca`, `NomeMarca`, `pro_idProduto`, `fabri_idFabricante`) VALUES
(1, 'Dima', 3, 1),
(4, 'Ok', 2, 1),
(5, 'Laranja', 4, 1);

-- --------------------------------------------------------

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
-- Extraindo dados da tabela `produto`
--

INSERT INTO `produto` (`idProduto`, `NomeProduto`, `Descricao`, `Pro_ativo`, `Usuario_idUser`, `ImagemProduto`) VALUES
(1, 'd', 'd', '0', 0, NULL),
(2, 'Oleo', 'Oleo de 20l', '1', 1, NULL),
(3, 'Arroz', 'Arroz Castanho', '1', 1, NULL),
(4, 'Planeta', 'Planeta cola', '1', 1, NULL);

-- --------------------------------------------------------

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

INSERT INTO `usuario` (`idUsuario`, `NomeUsuario`, `TelefoneUsuario`, `Sexo`, `Nascimento`, `Login`, `password`, `tipoPerminssao`, `User_ativo`, `ImagemUsuario`) VALUES
(1, 'Mbala Sadraque', '935378674         ', 'Masculino', '2000-06-18', '935378674', 'b964053fd716674ed5d16cb820bcbbd9b5536358', '1', '1', NULL),
(2, 'Mariana', '942494250 ', 'Femenino', '1996-10-30', '942494250', '79838340cb8d752d85d378a5ebf37f4fac1daeae', '3', '1', NULL);

-- --------------------------------------------------------

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
-- Extraindo dados da tabela `venda`
--

INSERT INTO `venda` (`idVenda`, `IdItem`, `QuanItem`, `Preco`, `NomeCliente`, `cart`, `DataVenda`, `User_idUser`) VALUES
(1, 1, 1, 12300, 'Mbala', 'c1f76339b542806703f45dcec68a07f0', '2021-07-08 15:29:24', 2),
(2, 1, 1, 12300, 'Mbala', 'fa9df42c54e3f347419819b15457cce0', '2021-07-08 15:30:07', 2),
(3, 1, 1, 12300, 'SEBA', '87bf5771ec864a906f6dd984e3fd07ab', '2021-07-08 16:19:04', 2),
(4, 2, 1, 18000, 'Mariana', 'b5b6ba1fbb2e5226909abd6a217b56e0', '2021-07-08 16:38:10', 2),
(5, 3, 1, 1000, 'Luiz', 'a83182c440e71e0cfc8666be442596f0', '2021-07-08 16:44:09', 2),
(6, 3, 1, 1000, 'Isaac', '1460f35034460775535e680775ac306a', '2021-07-08 16:47:30', 2),
(7, 2, 1, 18000, 'Isaac', '1460f35034460775535e680775ac306a', '2021-07-08 16:47:30', 2),
(8, 1, 1, 13300, 'noe', '26820bd3760af57d89ea0ee96e3ebe02', '2021-07-09 23:18:22', 2),
(9, 3, 1, 12000, 'noe', '26820bd3760af57d89ea0ee96e3ebe02', '2021-07-09 23:18:23', 2),
(10, 3, 1, 1200, 'Mendes ', '9152cdb93d76817b403d9081a9c36b92', '2021-07-15 14:02:56', 2),
(11, 3, 1, 1200, 'Valentina', 'a02e4dd306bda799a89137e8246fca51', '2021-07-15 14:08:49', 2),
(12, 3, 1, 1200, 'Manilson', 'dbd55ced1e32869fe0f7db26ecb20e13', '2021-07-17 13:13:57', 2),
(13, 3, 1, 1200, 'Mbala', '0a2cd51e7f029c9a70711735e2e3d2f5', '2021-07-17 13:16:09', 2),
(14, 3, 1, 1200, 'Mbala', '01c25b72989438dc529e361464020534', '2021-07-17 13:16:49', 2),
(15, 3, 2, 1200, 'Gilmeira manata', '574838085ef7da83ef7227357a2450ca', '2021-07-17 21:08:00', 2),
(16, 2, 1, 20000, 'Zizela', '324ac15ae2b73c3dd69da44e23319d4d', '2021-07-17 22:49:17', 2),
(17, 1, 1, 13300, 'Makimona', 'a64bbdc01d54ffa411f9b4df238749d9', '2021-07-17 23:47:02', 2),
(18, 1, 1, 13300, 'Melania', 'bb77d2c23071e98e45745cbf8c6db55f', '2021-07-17 23:52:17', 2),
(19, 1, 1, 13300, 'Fania', 'ee5450442349db1165ede7098a7b3c09', '2021-07-17 23:53:55', 2),
(20, 2, 1, 20000, 'Gabriel', '863b4f545f2e31ab62a8253347bc2be7', '2021-07-17 23:57:02', 2),
(21, 1, 2, 13300, 'K', 'b1d493a7ef2942320879364f0e9c8a56', '2021-07-18 00:04:27', 2),
(22, 1, 1, 13300, 'HELO MOCE', '2445b7e20790d2aceb60062ae334f899', '2021-07-18 00:12:44', 2),
(23, 2, 1, 20000, 'HELO MOCE', '2445b7e20790d2aceb60062ae334f899', '2021-07-18 00:12:44', 2);

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
  MODIFY `idFabricante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `itens`
--
ALTER TABLE `itens`
  MODIFY `idItem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `marca`
--
ALTER TABLE `marca`
  MODIFY `idMarca` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `produto`
--
ALTER TABLE `produto`
  MODIFY `idProduto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `usuario`
--
ALTER TABLE `usuario`
  MODIFY `idUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `venda`
--
ALTER TABLE `venda`
  MODIFY `idVenda` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

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
