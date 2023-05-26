-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13-Maio-2023 às 22:08
-- Versão do servidor: 5.7.36
-- versão do PHP: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbpets`
--
-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_avaliacao`
--

DROP TABLE IF EXISTS `tb_avaliacao`;
CREATE TABLE IF NOT EXISTS `tb_avaliacao` (
  `ID_AVALIACAO` int(11) NOT NULL AUTO_INCREMENT,
  `NOME_AVALIACAO` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_AVALIACAO` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `ASSUNTO_AVALIACAO` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `STATUS_AVALIACAO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ESTRELA_AVALIACAO` int(2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_AVALIACAO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_boleto`
--

DROP TABLE IF EXISTS `tb_boleto`;
CREATE TABLE IF NOT EXISTS `tb_boleto` (
  `ID_BOLETO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PEDIDO_VENDA` int(11) NOT NULL,
  `DATA_BOLETO` date NOT NULL,
  `VALOR_BOLETO` decimal(7,2) NOT NULL,
  `NUMERO_BOLETO` varchar(255) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `STATUS_BOLETO` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_BOLETO`),
  KEY `FK_TB_BOLETO_TB_PEDIDO_VENDA` (`ID_PEDIDO_VENDA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cartao_cliente`
--

DROP TABLE IF EXISTS `tb_cartao_cliente`;
CREATE TABLE IF NOT EXISTS `tb_cartao_cliente` (
  `ID_CARTAO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL,
  `NUMERO_CARTAO` char(19) COLLATE utf8_unicode_ci NOT NULL,
  `NOME_CARTAO` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `VALIDADE_CARTAO` char(7) COLLATE utf8_unicode_ci NOT NULL,
  `CSV_CARTAO` int(11) DEFAULT NULL,
  `BANDEIRA_CARTAO` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_CARTAO`),
  KEY `FK_TB_CARTAO_CLIENTE_TB_CLIENTE` (`ID_CLIENTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_categoria`
--

DROP TABLE IF EXISTS `tb_categoria`;
CREATE TABLE IF NOT EXISTS `tb_categoria` (
  `ID_CATEGORIA` int(11) NOT NULL AUTO_INCREMENT,
  `DESCRICAO_CATEGORIA` varchar(40) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  PRIMARY KEY (`ID_CATEGORIA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cliente`
--

DROP TABLE IF EXISTS `tb_cliente`;
CREATE TABLE IF NOT EXISTS `tb_cliente` (
  `ID_CLIENTE` int(11) NOT NULL AUTO_INCREMENT,
  `NOME_CLIENTE` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `IDADE_CLIENTE` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `CPF_CLIENTE` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `FONE_CLIENTE` char(11) COLLATE utf8_unicode_ci NOT NULL,
  `FONE_CLIENTE2` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `EMAIL_CLIENTE` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SENHA_CLIENTE` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `TOKEN_CLIENTE` varchar(220) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ENTRADA_CONTRATO_CUIDADOR` date DEFAULT NULL,
  `SAIDA_CONTRATO_CUIDADOR` date DEFAULT NULL,
  PRIMARY KEY (`ID_CLIENTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_cuidador` 
--

DROP TABLE IF EXISTS `tb_cuidador`;
CREATE TABLE IF NOT EXISTS `tb_cuidador` (
  `ID_CUIDADOR` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL,
  `IMAGEM_CUIDADOR` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DESCRICAO_CUIDADOR` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `VALOR_CUIDADOR` decimal(6,2) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_CUIDADOR`),
  KEY `FK_TB_CUIDADOR_TB_CLIENTE` (`ID_CLIENTE`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_endereco_cliente`
--

DROP TABLE IF EXISTS `tb_endereco_cliente`;
CREATE TABLE IF NOT EXISTS `tb_endereco_cliente` (
  `ID_ENDERECO_CLIENTE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL,
  `RUA_ENDERECO_CLIENTE` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `CEP_ENDERECO_CLIENTE` char(9) COLLATE utf8_unicode_ci NOT NULL,
  `NUM_ENDERECO_CLIENTE` int(11) NOT NULL,
  `BAIRRO_ENDERECO_CLIENTE` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `CIDADE_ENDERECO_CLIENTE` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `UF_ENDERECO_CLIENTE` char(2) COLLATE utf8_unicode_ci NOT NULL,
  `COMP_ENDERECO_CLIENTE` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`ID_ENDERECO_CLIENTE`),
  KEY `FK_TB_ENDERECO_CLIENTE_TB_CLIENTE` (`ID_CLIENTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_faleconosco`
--

DROP TABLE IF EXISTS `tb_faleconosco`;
CREATE TABLE IF NOT EXISTS `tb_faleconosco` (
  `ID_CONTATO` int(11) NOT NULL AUTO_INCREMENT,
  `NOME_CONTATO` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_CONTATO` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  `ASSUNTO_CONTATO` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `STATUS_CONTATO` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_CONTATO`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_fornecedor`
--

DROP TABLE IF EXISTS `tb_fornecedor`;
CREATE TABLE IF NOT EXISTS `tb_fornecedor` (
  `ID_FORNECEDOR` int(11) NOT NULL AUTO_INCREMENT,
  `RAZAO_FORNECEDOR` varchar(60) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `NOME_FANTASIA_FORNECEDOR` varchar(60) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `CONTATO_FORNECEDOR` char(16) COLLATE utf8_unicode_ci NOT NULL,
  `ENDERECO_FORNECEDOR` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `EMAIL_FORNECEDOR` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `CNPJ_FORNECEDOR` char(18) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `STATUS_FORNECEDOR` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_FORNECEDOR`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_frete`
--

DROP TABLE IF EXISTS `tb_frete`;
CREATE TABLE IF NOT EXISTS `tb_frete` (
  `UF` char(2) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `VALOR_FRETE` decimal(5,2) NOT NULL DEFAULT '0.00',
  `EMPRESA_ENTREGA_VENDA` char(35) COLLATE utf8_unicode_ci NOT NULL,
  `TEMPO_ENTREGA_DIAS` int(11) NOT NULL,
  PRIMARY KEY (`UF`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_frete`
--

INSERT INTO `tb_frete` (`UF`, `VALOR_FRETE`, `EMPRESA_ENTREGA_VENDA`, `TEMPO_ENTREGA_DIAS`) VALUES
('SP', '20.00', 'Zooli transporte', 3),
('RJ', '25.00', 'Zooli transporte', 2),
('ES', '20.00', 'Zooli transporte', 3),
('RO', '50.00', 'Zooli transporte', 4),
('AC', '45.00', 'Zooli transporte', 5),
('BA', '35.00', 'Zooli transporte', 6),
('AM', '60.00', 'Zooli transporte', 7),
('RR', '55.00', 'Zooli transporte', 8),
('PA', '36.00', 'Zooli transporte', 9),
('AP', '40.00', 'Zooli transporte', 10),
('TO', '60.00', 'Zooli transporte', 11),
('MA', '80.00', 'Zooli transporte', 14),
('PI', '30.00', 'Zooli transporte', 15),
('CE', '40.00', 'Zooli transporte', 16),
('RN', '20.00', 'Zooli transporte', 17),
('PB', '21.00', 'Zooli transporte', 18),
('PE', '36.00', 'Zooli transporte', 19),
('AL', '36.00', 'Zooli transporte', 20),
('SE', '30.00', 'Zooli transporte', 21),
('MG', '25.00', 'Zooli transporte', 22),
('PR', '70.00', 'Zooli transporte', 23),
('SC', '75.00', 'Zooli transporte', 24),
('RS', '65.00', 'Zooli transporte', 25),
('MS', '45.00', 'Zooli transporte', 26),
('MT', '30.00', 'Zooli transporte', 27),
('GO', '27.00', 'Zooli transporte', 28),
('DF', '25.00', 'Zooli transporte', 29);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_item_servico`
--

DROP TABLE IF EXISTS `tb_item_servico`;
CREATE TABLE IF NOT EXISTS `tb_item_servico` (
  `ID_ITEM_SERVICO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL,
  `ID_PEDIDO_VENDA` int(11) NOT NULL,
  `N_ITEM_SERVICO` int(11) NOT NULL,
  `VALOR_ITEM_SERVICO` decimal(6,2) NOT NULL,
  PRIMARY KEY (`ID_ITEM_SERVICO`),
  KEY `FK_TB_ITEM_SERVICO_TB_CLIENTE` (`ID_CLIENTE`),
  KEY `FK_TB_ITEM_SERVICO_TB_PEDIDO_VENDA` (`ID_PEDIDO_VENDA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_item_venda`
--

DROP TABLE IF EXISTS `tb_item_venda`;
CREATE TABLE IF NOT EXISTS `tb_item_venda` (
  `ID_ITEM_VENDA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_PEDIDO_VENDA` int(11) NOT NULL,
  `ID_PROD` int(11) NOT NULL,
  `N_ITEM_PRODUTO` int(11) NOT NULL,
  `QTD_ITEM_PRODUTO` int(11) NOT NULL,
  `VALOR_ITEM_PRODUTO` decimal(6,2) NOT NULL,
  PRIMARY KEY (`ID_ITEM_VENDA`),
  KEY `FK_TB_ITEM_VENDA_TB_PEDIDO_VENDA` (`ID_PEDIDO_VENDA`),
  KEY `FK_TB_ITEM_VENDA_TB_PRODUTO` (`ID_PROD`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_pedido_venda`
--

DROP TABLE IF EXISTS `tb_pedido_venda`;
CREATE TABLE IF NOT EXISTS `tb_pedido_venda` (
  `ID_PEDIDO_VENDA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL,
  `DATA_VENDA` datetime NOT NULL,
  `ENDERECO_VENDA` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `PGTO_VENDA` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `CONDICAO_VENDA` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `CUPOM_VENDA` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DESCONTO_VENDA` decimal(6,2) DEFAULT '0.00',
  `STATUS_VENDA` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  `VALOR_VENDA` decimal(7,2) NOT NULL,
  `VALOR_FRETE_VENDA` decimal(5,2) NOT NULL,
  `EMPRESA_ENTREGA_VENDA` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_PEDIDO_VENDA`),
  KEY `FK_TB_PEDIDO_VENDA_TB_CLIENTE` (`ID_CLIENTE`),
  KEY `FK_TB_PEDIDO_VENDA_TB_FRETE` (`EMPRESA_ENTREGA_VENDA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_prod`
--

DROP TABLE IF EXISTS `tb_prod`;
CREATE TABLE IF NOT EXISTS `tb_prod` (
  `ID_PROD` int(11) NOT NULL AUTO_INCREMENT,
  `NOME_PROD` varchar(250) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `DESC_PROD` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `QNT_PROD` int(11) NOT NULL,
  `VALOR_PROD` float NOT NULL,
  `TAMANHO_PROD` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `ID_CATEGORIA` int(11) NOT NULL,
  `ID_FORNECEDOR` int(11) NOT NULL,
  `imagem` blob NOT NULL,
  `VALOR_PAGO_PRODUTO` decimal(7,2) NOT NULL,
  `CODIGO_BARRAS_PRODUTO` varchar(128) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `STATUS_PRODUTO` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_PROD`),
  KEY `FK_TB_PROD_TB_CATEGORIA` (`ID_CATEGORIA`),
  KEY `FK_TB_PROD_TB_FORNECEDOR` (`ID_FORNECEDOR`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_promocao`
--

DROP TABLE IF EXISTS `tb_promocao`;
CREATE TABLE IF NOT EXISTS `tb_promocao` (
  `ID_PROMOCAO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_USUARIO_ADM` int(11) NOT NULL,
  `ID_CATEGORIA` int(11) NOT NULL,
  `TOKEN_PROMOCAO` varchar(8) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `VALIDADE_PROMOCAO` date NOT NULL,
  `VALOR_PROMOCAO` decimal(6,2) NOT NULL,
  `STATUS_PROMOCAO` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_PROMOCAO`),
  KEY `FK_TB_PROMOCAO_TB_USUARIO_ADM` (`ID_USUARIO_ADM`),
  KEY `FK_TB_PROMOCAO_TB_CATEGORIA` (`ID_CATEGORIA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tutor`
--

DROP TABLE IF EXISTS `tb_tutor`;
CREATE TABLE IF NOT EXISTS `tb_tutor` (
  `ID_TUTORPET` int(11) NOT NULL AUTO_INCREMENT,
  `ID_CLIENTE` int(11) NOT NULL,
  `NOME_TUTORPET` varchar(35) COLLATE utf8_unicode_ci NOT NULL,
  `IMAGEM_TUTORPET` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IDADE_TUTORPET` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `RACA_TUTORPET` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `PESO_TUTORPET` decimal(10,0) NOT NULL,
  `DESCRICAO_TUTORPET` varchar(80) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_TUTORPET`),
  KEY `FK_TB_TUTOR_TB_CLIENTE` (`ID_CLIENTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------
--
-- Acionadores `tb_promocao`
--
DROP TRIGGER IF EXISTS `Tgr_cupom_ativar`;
DELIMITER $$
CREATE TRIGGER `Tgr_cupom_ativar` BEFORE INSERT ON `tb_promocao` FOR EACH ROW BEGIN
IF NEW.VALIDADE_PROMOCAO >= CURDATE() THEN
SET NEW.STATUS_PROMOCAO = 'disponivel';
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Tgr_cupom_atualizar`;
DELIMITER $$
CREATE TRIGGER `Tgr_cupom_atualizar` BEFORE UPDATE ON `tb_promocao` FOR EACH ROW BEGIN
IF NEW.VALIDADE_PROMOCAO < CURDATE() THEN
SET NEW.STATUS_PROMOCAO = 'Expirado';
END IF;
END
$$
DELIMITER ;
DROP TRIGGER IF EXISTS `Tgr_cupom_desativar`;
DELIMITER $$
CREATE TRIGGER `Tgr_cupom_desativar` BEFORE INSERT ON `tb_promocao` FOR EACH ROW BEGIN
IF NEW.VALIDADE_PROMOCAO < CURDATE() THEN
SET NEW.STATUS_PROMOCAO = 'Expirado';
END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_servico`
--

DROP TABLE IF EXISTS `tb_servico`;
CREATE TABLE IF NOT EXISTS `tb_servico` (
  `ID_SERVICO` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ITEM_SERVICO` int(11) NOT NULL,
  `ID_CLIENTE` int(11) NOT NULL,
  `DESCRICAO_SERVICO` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `VALOR_COMPRA_SERVICO` decimal(7,2) NOT NULL,
  `STATUS_SERVICO` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_SERVICO`),
  KEY `FK_SERVICO_ID_ITEM_SERVICO` (`ID_ITEM_SERVICO`),
  KEY `FK_SERVICO_TB_CLIENTE` (`ID_CLIENTE`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuario_adm`
--


DROP TABLE IF EXISTS `tb_usuario_adm`;
CREATE TABLE IF NOT EXISTS `tb_usuario_adm` (
  `ID_USUARIO_ADM` int(11) NOT NULL AUTO_INCREMENT,
  `EMAIL_USUARIO_ADM` varchar(60) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `SENHA_USUARIO_ADM` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
  `STATUS_USUARIO_ADM` varchar(40) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ID_USUARIO_ADM`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Extraindo dados da tabela `tb_usuario_adm`
--

INSERT INTO `tb_usuario_adm` (`ID_USUARIO_ADM`, `EMAIL_USUARIO_ADM`, `SENHA_USUARIO_ADM`, `STATUS_USUARIO_ADM`) VALUES
(1, 'usuario_adm@gmail.com', '12345', 'ativo');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

---funcao para o tb_produtos----------
DELIMITER //
CREATE TRIGGER tg_atualiza_quantidade AFTER INSERT ON tb_item_venda
FOR EACH ROW
BEGIN
  UPDATE tb_prod
  SET QNT_PROD = QNT_PROD - NEW.QTD_ITEM_PRODUTO,
      STATUS_PRODUTO = CASE
                         WHEN QNT_PROD - NEW.QTD_ITEM_PRODUTO = 0 THEN 'Indisponível'
                         ELSE 'Disponível'
                       END
  WHERE ID_PROD = NEW.ID_PROD;
END //
DELIMITER ;