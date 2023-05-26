<?php
if(isset($_REQUEST['boleto']) and ($_REQUEST['boleto'] == 'confirmado')){
    // obtém os dados enviados pelo JavaScript
    $data = json_decode(file_get_contents("php://input"), true);
    
    // manipulando os dados contidos no data
    $valortotal=$data['real'];
    $valorfrete=$data['valorfrete'];
    $cartid= $data['cartid'];
    $quantidade=$data['cartQt'];
    $imagem=$data['cartImages'];
    $Nomes=$data['cartNames'];
 //criando a conexao com o banco de dados 



  // envia a resposta para o JavaScript
    $response = array("message" => "Dados recebidos com sucesso!" );
    echo json_encode($response);


    /*Tabelas que iremos trabalhar na parte de boleto 
    
    
    DROP TABLE IF EXISTS `tb_pedido_venda`;
CREATE TABLE IF NOT EXISTS `tb_pedido_venda` (
  `ID_PEDIDO_VENDA` int(11) NOT NULL AUTO_INCREMENT,
  `ID_TUTOR` int(11) NOT NULL,
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
  KEY `FK_TB_PEDIDO_VENDA_TB_TUTOR` (`ID_TUTOR`),
  FOREIGN KEY (`EMPRESA_ENTREGA_VENDA`) REFERENCES `tb_frete` (`EMPRESA_ENTREGA_VENDA`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
    
    
    
    
    
    
    
    */ 
    
}


if(isset($_REQUEST['cartao']) and ($_REQUEST['cartao'] == 'confirmado')){

}
?>