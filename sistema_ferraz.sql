-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 25-Jan-2021 às 18:00
-- Versão do servidor: 10.4.10-MariaDB
-- versão do PHP: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `sistema_ferraz`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm`
--

DROP TABLE IF EXISTS `adm`;
CREATE TABLE IF NOT EXISTS `adm` (
  `id_adm` int(11) NOT NULL AUTO_INCREMENT,
  `situacao` int(11) NOT NULL,
  `nome` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_adm`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adm`
--

INSERT INTO `adm` (`id_adm`, `situacao`, `nome`, `email`, `senha`, `telefone`) VALUES
(1, 1, 'Donizeti Torres', 'apdonizeti@yahoo.com.br', '$2y$10$Ra3U3HjUQcwK62veTrpIw.DB.M1sju0Ve2thdOcanc6ewAo/6y1fG', '(65) 99237-3675'),
(2, 2, 'Jonas Andrade', 'kenshydokan@gmail.com', '$2y$10$zaKoolyC0ihwt960aOXKFeEItwaL4IgoFtfg2tTRKD9RbVNm4lltS', '(65) 11111-1111'),
(3, 1, 'Fulano da Esquina', 'naosei@gmail.com', '$2y$10$mxwN6WcTYOVyGlxyjMG3u.cP5wd235Vm2HT4Hb1MF14ErQaL8GNrG', '(65) 66666-6666'),
(6, 1, 'Cicrano de Tal', 'cricrano@gmail.com', '$2y$10$NVT1J/EKHkSqOQiw.bcnUugU4Egu/I12MazOdTnqF1SDBGMRR3.3W', '(65) 99999-9999');

-- --------------------------------------------------------

--
-- Estrutura da tabela `adm_mestre`
--

DROP TABLE IF EXISTS `adm_mestre`;
CREATE TABLE IF NOT EXISTS `adm_mestre` (
  `id_mestre` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_mestre`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `adm_mestre`
--

INSERT INTO `adm_mestre` (`id_mestre`, `nome`, `email`, `senha`) VALUES
(1, 'Weslley Ferraz', 'weslleyhenrique800@gmail.com', '$2y$10$CNHNOCeH2h8him7b.WvRq.6CvNFb57GZ8F13aZT27WZSaRRgI7k.u');

-- --------------------------------------------------------

--
-- Estrutura da tabela `caixas`
--

DROP TABLE IF EXISTS `caixas`;
CREATE TABLE IF NOT EXISTS `caixas` (
  `id_caixa` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `situacao` int(11) NOT NULL,
  `dinheiro` double NOT NULL,
  `credito` double NOT NULL,
  `debito` double NOT NULL,
  `outros` double NOT NULL,
  `data_abertura` date NOT NULL,
  `hora_abertura` time NOT NULL,
  `data_fechamento` date DEFAULT NULL,
  `hora_fechamento` time DEFAULT NULL,
  PRIMARY KEY (`id_caixa`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `caixas`
--

INSERT INTO `caixas` (`id_caixa`, `id_adm`, `id_funcionario`, `situacao`, `dinheiro`, `credito`, `debito`, `outros`, `data_abertura`, `hora_abertura`, `data_fechamento`, `hora_fechamento`) VALUES
(5, 1, 1, 2, 0, 0, 0, 0, '2021-01-07', '16:26:12', '2021-01-11', '12:43:38'),
(6, 1, 1, 2, 100, 0, 0, 0, '2021-01-11', '12:51:11', '2021-01-12', '07:38:42'),
(7, 1, 1, 2, 100, 0, -180, 0, '2021-01-12', '07:38:47', '2021-01-12', '14:22:16'),
(8, 1, 1, 2, 0, 0, 0, 0, '2021-01-12', '14:22:25', '2021-01-15', '11:14:46'),
(9, 1, 1, 2, 0, 0, 0, 0, '2021-01-15', '11:14:53', '2021-01-18', '11:15:24'),
(10, 1, 1, 2, 5.98, 0, 2, 0, '2021-01-18', '11:16:55', '2021-01-25', '13:41:13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `id_categoria` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `categoria` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_categoria`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`id_categoria`, `id_adm`, `categoria`) VALUES
(13, 1, 'Gelados'),
(9, 1, 'Alimentos'),
(10, 1, 'Doces'),
(11, 1, 'Bebidas');

-- --------------------------------------------------------

--
-- Estrutura da tabela `dados_empresa`
--

DROP TABLE IF EXISTS `dados_empresa`;
CREATE TABLE IF NOT EXISTS `dados_empresa` (
  `id_dado` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `empresa` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cnpj` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id_dado`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `dados_empresa`
--

INSERT INTO `dados_empresa` (`id_dado`, `id_adm`, `empresa`, `cnpj`, `telefone`) VALUES
(1, 1, 'AÃ§ai e Cia', '11.111.111/1222-23', '(65) 99237-3675'),
(2, 2, NULL, NULL, NULL),
(3, 1, 'AÃ§ai e Cia', '11.111.111/1222-23', '(65) 99237-3675'),
(5, 6, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `forma_pagamento`
--

DROP TABLE IF EXISTS `forma_pagamento`;
CREATE TABLE IF NOT EXISTS `forma_pagamento` (
  `id_fp` int(11) NOT NULL AUTO_INCREMENT,
  `forma_pagamento` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_fp`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `forma_pagamento`
--

INSERT INTO `forma_pagamento` (`id_fp`, `forma_pagamento`) VALUES
(1, 'Dinheiro'),
(2, 'CartÃ£o DÃ©bito'),
(3, 'CartÃ£o CrÃ©dito'),
(4, 'DepÃ³sito Bancario');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

DROP TABLE IF EXISTS `funcionarios`;
CREATE TABLE IF NOT EXISTS `funcionarios` (
  `id_funcionario` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `situacao` int(11) NOT NULL,
  `nome` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `telefone` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `senha` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `data_registro` date NOT NULL,
  `presenca` int(11) DEFAULT NULL,
  `entrou` time DEFAULT NULL,
  `saiu` time DEFAULT NULL,
  PRIMARY KEY (`id_funcionario`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id_funcionario`, `id_adm`, `situacao`, `nome`, `email`, `telefone`, `senha`, `data_registro`, `presenca`, `entrou`, `saiu`) VALUES
(1, 1, 1, 'Fulado de Tal', 'weslleyhenrique800@gmail.com', NULL, '$2y$10$5Bh42shyMGFL4BBGS/IVkuykMkHdtyhxaGCWanmiSZI7XDCKbxSVm', '2021-01-01', 1, '12:28:01', '12:08:13'),
(2, 1, 1, 'Cricrano de Tal', 'naosei2@gmail.com', NULL, '$2y$10$q3LUAH56ZW5PBWCvflHO6OOi7roIBZusTkTkGq/1ru5dUTuft6JKW', '2021-01-05', 2, '15:59:08', '16:20:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `imagens`
--

DROP TABLE IF EXISTS `imagens`;
CREATE TABLE IF NOT EXISTS `imagens` (
  `id_imagem` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `caminho` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_imagem`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `imagens`
--

INSERT INTO `imagens` (`id_imagem`, `nome`, `caminho`) VALUES
(3, 'candy-2201931_640.jpg', '../imagens/candy-2201931_640.jpg'),
(6, 'Cascao2.png', '../imagens/Cascao2.png'),
(7, 'X-Burguer-PNG-1009x1024.png', '../imagens/X-Burguer-PNG-1009x1024.png');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pagamento`
--

DROP TABLE IF EXISTS `pagamento`;
CREATE TABLE IF NOT EXISTS `pagamento` (
  `id_pagamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_caixa` int(11) NOT NULL,
  `forma` int(11) NOT NULL,
  `valor` double NOT NULL,
  `data_pagamento` date NOT NULL,
  PRIMARY KEY (`id_pagamento`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `pagamento`
--

INSERT INTO `pagamento` (`id_pagamento`, `id_adm`, `id_funcionario`, `id_venda`, `id_caixa`, `forma`, `valor`, `data_pagamento`) VALUES
(7, 1, 1, 2, 0, 3, 5.96, '2021-01-02'),
(6, 1, 1, 2, 0, 2, 10, '2021-01-02'),
(9, 1, 1, 5, 0, 1, 30, '2021-01-02'),
(10, 1, 1, 6, 0, 1, 3.99, '2021-01-03'),
(11, 1, 1, 7, 0, 1, 100, '2021-01-03'),
(12, 1, 1, 8, 0, 3, 7.98, '2021-01-03'),
(13, 1, 1, 9, 0, 1, 30, '2021-01-03'),
(14, 1, 1, 10, 0, 1, 40, '2021-01-03'),
(15, 1, 1, 11, 0, 1, 10, '2021-01-03'),
(16, 1, 1, 12, 0, 1, 5, '2021-01-03'),
(17, 1, 1, 13, 0, 2, 3.99, '2021-01-03'),
(18, 1, 1, 14, 0, 4, 3.99, '2021-01-03'),
(19, 1, 1, 15, 0, 2, 2, '2021-01-03'),
(20, 1, 1, 15, 0, 1, 20, '2021-01-03'),
(21, 1, 1, 16, 0, 1, 20, '2021-01-03'),
(22, 1, 1, 17, 0, 3, 20.97, '2021-01-03'),
(23, 1, 1, 18, 0, 2, 16.98, '2021-01-03'),
(24, 1, 1, 19, 0, 2, 20.97, '2021-01-03'),
(25, 1, 1, 20, 0, 2, 20.97, '2021-01-03'),
(26, 1, 1, 21, 0, 1, 20.97, '2021-01-03'),
(27, 1, 1, 22, 0, 1, 3.99, '2021-01-03'),
(28, 1, 1, 23, 0, 1, 3.99, '2021-01-03'),
(29, 1, 1, 24, 0, 1, 20, '2021-01-04'),
(30, 1, 1, 25, 0, 1, 50, '2021-01-04'),
(31, 1, 1, 26, 0, 1, 50, '2021-01-05'),
(35, 1, 1, 27, 0, 1, 10, '2021-01-05'),
(34, 1, 1, 27, 0, 2, 10, '2021-01-05'),
(36, 1, 1, 28, 0, 4, 3.99, '2021-01-05'),
(38, 1, 1, 30, 0, 1, 10, '2021-01-06'),
(59, 1, 1, 33, 7, 1, 200, '2021-01-12'),
(61, 1, 1, 35, 8, 2, 2, '2021-01-12'),
(60, 1, 1, 34, 7, 1, 50, '2021-01-12'),
(62, 1, 1, 35, 8, 1, 10, '2021-01-12'),
(63, 1, 1, 36, 9, 1, 10, '2021-01-15'),
(64, 1, 1, 37, 10, 2, 2, '2021-01-25'),
(65, 1, 1, 37, 10, 1, 10, '2021-01-25');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id_produto` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `id_categoria` int(11) NOT NULL,
  `id_imagem` int(11) NOT NULL,
  `produto` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `descricao` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `codigo` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `preco` double NOT NULL,
  PRIMARY KEY (`id_produto`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id_produto`, `id_adm`, `id_categoria`, `id_imagem`, `produto`, `descricao`, `codigo`, `quantidade`, `preco`) VALUES
(3, 1, 10, 3, 'PÃ© de muleque', 'PÃ© de muleque', 1, 40, 3.99),
(4, 1, 13, 6, 'Sorvete CascÃ£o', 'Sorvete CascÃ£o', 2, 44, 3.99),
(6, 1, 9, 7, 'Hanburguer', 'Hanburguer', 4, 48, 12.99);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produto_venda`
--

DROP TABLE IF EXISTS `produto_venda`;
CREATE TABLE IF NOT EXISTS `produto_venda` (
  `id_pv` int(11) NOT NULL AUTO_INCREMENT,
  `id_caixa` int(11) NOT NULL,
  `id_venda` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `quantidade` int(11) NOT NULL,
  `valor` double NOT NULL,
  PRIMARY KEY (`id_pv`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `produto_venda`
--

INSERT INTO `produto_venda` (`id_pv`, `id_caixa`, `id_venda`, `id_produto`, `quantidade`, `valor`) VALUES
(4, 0, 5, 3, 2, 3.99),
(5, 0, 5, 4, 1, 3.99),
(6, 0, 5, 6, 1, 12.99),
(7, 0, 6, 3, 1, 3.99),
(8, 0, 7, 4, 2, 3.99),
(9, 0, 7, 6, 1, 12.99),
(10, 0, 8, 4, 2, 3.99),
(11, 0, 9, 6, 2, 12.99),
(12, 0, 10, 6, 3, 12.99),
(13, 0, 11, 4, 2, 3.99),
(14, 0, 12, 4, 1, 3.99),
(15, 0, 13, 4, 1, 3.99),
(16, 0, 14, 4, 1, 3.99),
(17, 0, 15, 4, 1, 3.99),
(19, 0, 16, 3, 1, 3.99),
(20, 0, 16, 6, 1, 12.99),
(21, 0, 17, 3, 1, 3.99),
(22, 0, 17, 4, 1, 3.99),
(23, 0, 17, 6, 1, 12.99),
(24, 0, 18, 6, 1, 12.99),
(25, 0, 18, 4, 1, 3.99),
(26, 0, 19, 3, 1, 3.99),
(27, 0, 19, 4, 1, 3.99),
(28, 0, 19, 6, 1, 12.99),
(29, 0, 20, 3, 1, 3.99),
(30, 0, 20, 4, 1, 3.99),
(31, 0, 20, 6, 1, 12.99),
(32, 0, 21, 3, 1, 3.99),
(33, 0, 21, 4, 1, 3.99),
(34, 0, 21, 6, 1, 12.99),
(35, 0, 22, 3, 1, 3.99),
(36, 0, 23, 3, 1, 3.99),
(37, 0, 24, 6, 1, 12.99),
(38, 0, 25, 3, 1, 3.99),
(39, 0, 25, 4, 1, 3.99),
(40, 0, 26, 6, 1, 12.99),
(41, 0, 27, 3, 3, 3.99),
(42, 0, 27, 4, 1, 3.99),
(44, 0, 28, 3, 1, 3.99),
(45, 0, 30, 4, 2, 3.99),
(47, 0, 32, 3, 4, 3.99),
(48, 0, 32, 4, 3, 3.99),
(49, 0, 32, 6, 3, 12.99),
(50, 0, 33, 4, 2, 3.99),
(51, 0, 33, 3, 1, 3.99),
(52, 0, 33, 6, 3, 12.99),
(53, 0, 34, 3, 1, 3.99),
(54, 0, 34, 4, 2, 3.99),
(55, 0, 35, 3, 3, 3.99),
(57, 0, 36, 4, 1, 3.99),
(59, 10, 37, 3, 2, 3.99);

-- --------------------------------------------------------

--
-- Estrutura da tabela `sangria`
--

DROP TABLE IF EXISTS `sangria`;
CREATE TABLE IF NOT EXISTS `sangria` (
  `id_sangria` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_caixa` int(11) NOT NULL,
  `descricao` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `valor` double NOT NULL,
  `data_sangria` date NOT NULL,
  `hora_sangria` time NOT NULL,
  PRIMARY KEY (`id_sangria`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `sangria`
--

INSERT INTO `sangria` (`id_sangria`, `id_adm`, `id_funcionario`, `id_caixa`, `descricao`, `valor`, `data_sangria`, `hora_sangria`) VALUES
(2, 1, 1, 9, 'aaaaaa', 2, '2021-01-15', '11:53:16'),
(3, 1, 1, 9, 'aaaaa', 1, '2021-01-15', '12:00:02');

-- --------------------------------------------------------

--
-- Estrutura da tabela `suprimentos`
--

DROP TABLE IF EXISTS `suprimentos`;
CREATE TABLE IF NOT EXISTS `suprimentos` (
  `id_suprimento` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_caixa` int(11) NOT NULL,
  `descricao` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `valor` double NOT NULL,
  `data_suprimento` date NOT NULL,
  `hora_suprimento` time NOT NULL,
  PRIMARY KEY (`id_suprimento`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `suprimentos`
--

INSERT INTO `suprimentos` (`id_suprimento`, `id_adm`, `id_funcionario`, `id_caixa`, `descricao`, `valor`, `data_suprimento`, `hora_suprimento`) VALUES
(1, 1, 1, 9, 'Teste 1', 30, '2021-01-15', '12:56:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendas`
--

DROP TABLE IF EXISTS `vendas`;
CREATE TABLE IF NOT EXISTS `vendas` (
  `id_venda` int(11) NOT NULL AUTO_INCREMENT,
  `id_adm` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `id_caixa` int(11) NOT NULL,
  `total` double DEFAULT NULL,
  `troco` double DEFAULT NULL,
  `valor_pago` double DEFAULT NULL,
  `situacao` int(11) DEFAULT NULL,
  `data_venda` date DEFAULT NULL,
  `hora_venda` time DEFAULT NULL,
  PRIMARY KEY (`id_venda`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `vendas`
--

INSERT INTO `vendas` (`id_venda`, `id_adm`, `id_funcionario`, `id_caixa`, `total`, `troco`, `valor_pago`, `situacao`, `data_venda`, `hora_venda`) VALUES
(5, 1, 1, 0, 24.96, 5.04, 30, 3, '2021-01-02', '10:00:00'),
(6, 1, 1, 0, 3.99, 0, 3.99, 1, '2021-01-02', '12:21:00'),
(7, 1, 1, 0, 20.97, 79.03, 100, 1, '2021-01-03', '15:24:06'),
(8, 1, 1, 0, 7.98, 0, 7.98, 1, '2021-01-03', '11:43:20'),
(9, 1, 1, 0, 25.98, 4.02, 30, 1, '2021-01-03', '11:44:40'),
(10, 1, 1, 0, 38.97, 1.03, 40, 1, '2021-01-03', '11:45:45'),
(11, 1, 1, 0, 7.98, 2.02, 10, 1, '2021-01-03', '11:47:06'),
(12, 1, 1, 0, 3.99, 1.01, 5, 1, '2021-01-03', '11:48:47'),
(13, 1, 1, 0, 3.99, 0, 3.99, 1, '2021-01-03', '11:50:06'),
(14, 1, 1, 0, 3.99, 0, 3.99, 1, '2021-01-03', '11:53:05'),
(15, 1, 1, 0, 3.99, 18.01, 22, 1, '2021-01-03', '12:38:22'),
(16, 1, 1, 0, 16.98, 3.02, 20, 1, '2021-01-03', '17:03:04'),
(17, 1, 1, 0, 20.97, 0, 20.97, 1, '2021-01-03', '17:04:24'),
(18, 1, 1, 0, 16.98, 0, 16.98, 1, '2021-01-03', '17:18:27'),
(19, 1, 1, 0, 20.97, 0, 20.97, 3, '2021-01-03', '17:28:58'),
(20, 1, 1, 0, 20.97, 0, 20.97, 3, '2021-01-03', '17:30:08'),
(21, 1, 1, 0, 20.97, 0, 20.97, 1, '2021-01-03', '17:31:36'),
(22, 1, 1, 0, 3.99, 0, 3.99, 1, '2021-01-03', '17:32:06'),
(23, 1, 1, 0, 3.99, 0, 3.99, 1, '2021-01-03', '17:34:49'),
(24, 1, 1, 0, 12.99, 7.01, 20, 1, '2021-01-04', '12:23:29'),
(25, 1, 1, 0, 7.98, 42.02, 50, 1, '2021-01-04', '12:27:54'),
(26, 1, 1, 0, 12.99, 37.01, 50, 1, '2021-01-05', '07:42:34'),
(27, 1, 1, 0, 15.96, 4.04, 20, 1, '2021-01-05', '13:22:19'),
(28, 1, 1, 0, 3.99, 0, 3.99, 1, '2021-01-05', '19:57:20'),
(29, 1, 2, 0, NULL, NULL, NULL, 2, NULL, NULL),
(30, 1, 1, 0, 7.98, 2.02, 10, 1, '2021-01-06', '13:26:20'),
(31, 1, 1, 0, 0, 0, 0, 1, '2021-01-07', '16:35:17'),
(32, 1, 1, 7, 66.9, 0, 66.9, 3, '2021-01-12', '11:07:20'),
(33, 1, 1, 7, 50.94, 149.06, 200, 1, '2021-01-12', '11:17:01'),
(34, 1, 1, 7, 11.97, 38.03, 50, 1, '2021-01-12', '11:21:15'),
(35, 1, 1, 8, 11.97, 0.029999999999999, 12, 1, '2021-01-12', '14:24:12'),
(36, 1, 1, 9, 3.99, 6.01, 10, 1, '2021-01-15', '11:42:33'),
(37, 1, 1, 10, 7.98, 4.02, 12, 1, '2021-01-25', '13:23:14'),
(38, 1, 1, 0, NULL, NULL, NULL, 2, NULL, NULL);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
