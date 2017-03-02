-- 
-- Estrutura da tabela `bancos`
-- 

CREATE TABLE `bancos` (
  `bnid` smallint(3) unsigned NOT NULL auto_increment,
  `layout` varchar(40) NOT NULL default '',
  `nome` varchar(20) NOT NULL default '',
  `codigo` int(4) unsigned NOT NULL default '0',
  `uso_do_banco` varchar(50) NOT NULL default '',
  PRIMARY KEY  (`bnid`),
  UNIQUE KEY `nome` (`nome`),
  KEY `bnid` (`bnid`)
) ENGINE=MyISAM AUTO_INCREMENT=6 ;

-- 
-- Extraindo dados da tabela `bancos`
-- 

INSERT INTO `bancos` (`bnid`, `layout`, `nome`, `codigo`, `uso_do_banco`) VALUES (1, 'class.banco.bradesco.php', 'Bradesco', 237, '');
INSERT INTO `bancos` (`bnid`, `layout`, `nome`, `codigo`, `uso_do_banco`) VALUES (2, 'class.banco.santander.php', 'Santander', 353, '');
INSERT INTO `bancos` (`bnid`, `layout`, `nome`, `codigo`, `uso_do_banco`) VALUES (3, 'class.banco.cef.php', 'Caixa Econ. Federal', 104, '');
INSERT INTO `bancos` (`bnid`, `layout`, `nome`, `codigo`, `uso_do_banco`) VALUES (4, 'class.banco.bancodobrasil.php', 'Banco do Brasil', 1, '');
INSERT INTO `bancos` (`bnid`, `layout`, `nome`, `codigo`, `uso_do_banco`) VALUES (5, 'class.banco.itau.php', 'Banco Itaú S.A.', 341, '');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `boletos`
-- 

CREATE TABLE `boletos` (
  `bid` int(4) unsigned NOT NULL auto_increment,
  `bnid` int(4) unsigned NOT NULL default '0',
  `cid` int(4) unsigned NOT NULL default '0',
  `titulo` varchar(30) NOT NULL default '',
  `agencia` varchar(10) NOT NULL default '',
  `agencia_dig` char(2) default NULL,
  `cedente` varchar(255) NOT NULL default '',
  `conta_cedente` varchar(20) NOT NULL default '',
  `conta_cedente_dig` char(2) default NULL,
  `especie_documento` varchar(10) NOT NULL default '',
  `codigo` varchar(40) NOT NULL default '',
  `local_pagamento` varchar(255) NOT NULL default '',
  `carteira` varchar(30) NOT NULL default '',
  `instrucoes_linha1` varchar(100) NOT NULL default '',
  `instrucoes_linha2` varchar(100) NOT NULL default '',
  `instrucoes_linha3` varchar(100) NOT NULL default '',
  `instrucoes_linha4` varchar(100) NOT NULL default '',
  `instrucoes_linha5` varchar(100) NOT NULL default '',
  `demons1` varchar(100) default NULL,
  `demons2` varchar(100) default NULL,
  `demons3` varchar(100) default NULL,
  `demons4` varchar(100) default NULL,
  `convenio` varchar(15) default NULL,
  PRIMARY KEY  (`bid`),
  UNIQUE KEY `titulo` (`titulo`),
  KEY `cid` (`cid`)
) ENGINE=MyISAM AUTO_INCREMENT=8 ;

-- 
-- Extraindo dados da tabela `boletos`
-- 

INSERT INTO `boletos` (`bid`, `bnid`, `cid`, `titulo`, `agencia`, `agencia_dig`, `cedente`, `conta_cedente`, `conta_cedente_dig`, `especie_documento`, `codigo`, `local_pagamento`, `carteira`, `instrucoes_linha1`, `instrucoes_linha2`, `instrucoes_linha3`, `instrucoes_linha4`, `instrucoes_linha5`, `demons1`, `demons2`, `demons3`, `demons4`, `convenio`) VALUES (3, 1, 1, 'Boleto Bradesco', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', '0', 'R$', '1', 'Preferencialmente no Banco Bradesco', '12', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456');
INSERT INTO `boletos` (`bid`, `bnid`, `cid`, `titulo`, `agencia`, `agencia_dig`, `cedente`, `conta_cedente`, `conta_cedente_dig`, `especie_documento`, `codigo`, `local_pagamento`, `carteira`, `instrucoes_linha1`, `instrucoes_linha2`, `instrucoes_linha3`, `instrucoes_linha4`, `instrucoes_linha5`, `demons1`, `demons2`, `demons3`, `demons4`, `convenio`) VALUES (4, 2, 1, 'Boleto Santander', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', '0', 'R$', '1', 'Preferencialmente no Banco Santander', '12', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456');
INSERT INTO `boletos` (`bid`, `bnid`, `cid`, `titulo`, `agencia`, `agencia_dig`, `cedente`, `conta_cedente`, `conta_cedente_dig`, `especie_documento`, `codigo`, `local_pagamento`, `carteira`, `instrucoes_linha1`, `instrucoes_linha2`, `instrucoes_linha3`, `instrucoes_linha4`, `instrucoes_linha5`, `demons1`, `demons2`, `demons3`, `demons4`, `convenio`) VALUES (5, 3, 1, 'Boleto CEF', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', '0', 'R$', '1', 'Preferencialmente na Caixa Economica Federal', 'AB', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456');
INSERT INTO `boletos` (`bid`, `bnid`, `cid`, `titulo`, `agencia`, `agencia_dig`, `cedente`, `conta_cedente`, `conta_cedente_dig`, `especie_documento`, `codigo`, `local_pagamento`, `carteira`, `instrucoes_linha1`, `instrucoes_linha2`, `instrucoes_linha3`, `instrucoes_linha4`, `instrucoes_linha5`, `demons1`, `demons2`, `demons3`, `demons4`, `convenio`) VALUES (6, 4, 1, 'Boleto BB', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', 'x', 'R$', '1', 'Preferencialmente no Banco do Brasil', '12', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456');
INSERT INTO `boletos` (`bid`, `bnid`, `cid`, `titulo`, `agencia`, `agencia_dig`, `cedente`, `conta_cedente`, `conta_cedente_dig`, `especie_documento`, `codigo`, `local_pagamento`, `carteira`, `instrucoes_linha1`, `instrucoes_linha2`, `instrucoes_linha3`, `instrucoes_linha4`, `instrucoes_linha5`, `demons1`, `demons2`, `demons3`, `demons4`, `convenio`) VALUES (7, 5, 1, 'Boleto Itaú', '1234', '1', 'NOME DE SUA EMPRESA', '12345678', '6', 'R$', '1', 'Preferencialmente no Banco Itaú', '123', 'O PAGAMENTO PODE SER EFETUADO EM QUALQUER AGÊNCIA DA REDE BANCÁRIA OU LOTÉRICA ATÉ O VENCIMENTO.', '', '', '', '', 'Seu pedido será encaminhado após a confirmação de pagamento deste Boleto Bancário.', '', 'Consulte seu pedido em http://www.seusite.com.br', '', '123456');

-- --------------------------------------------------------

-- 
-- Estrutura da tabela `config`
-- 

CREATE TABLE `config` (
  `cid` smallint(3) unsigned NOT NULL auto_increment,
  `titulo` varchar(30) NOT NULL default '',
  `enviar_email` tinyint(1) unsigned NOT NULL default '0',
  `remetente` varchar(50) NOT NULL default '',
  `remetente_email` varchar(255) NOT NULL default '',
  `assunto` varchar(50) NOT NULL default '',
  `servidor_smtp` varchar(80) NOT NULL default '',
  `servidor_http` varchar(80) NOT NULL default '',
  `imagem_tipo` varchar(4) NOT NULL default '',
  `usar_truetype` tinyint(1) unsigned NOT NULL default '1',
  `enviar_pdf` tinyint(1) unsigned NOT NULL default '0',
  `mensagem_texto` longtext NOT NULL,
  `mensagem_html` longtext NOT NULL,
  PRIMARY KEY  (`cid`),
  UNIQUE KEY `titulo` (`titulo`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT ;

-- 
-- Extraindo dados da tabela `config`
-- 

INSERT INTO `config` (`cid`, `titulo`, `enviar_email`, `remetente`, `remetente_email`, `assunto`, `servidor_smtp`, `servidor_http`, `imagem_tipo`, `usar_truetype`, `enviar_pdf`, `mensagem_texto`, `mensagem_html`) VALUES (1, 'default', 0, 'Nome de sua loja', 'seu@email.com.br', 'Boleto Bancário do seu Pedido', '', 'www.seusite.com.br', 'jpg', 1, 0, 'Boleto bancário referente a seu pedido efetuado em http://www.seusite.com.br.', 'Boleto bancário referente a seu pedido efetuado em http://www.seusite.com.br.');

-- --------------------------------------------------------