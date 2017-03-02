<?php
/**
* @version $Id: english.php 4004 2006-06-12 17:44:14Z stingrey $
* @package Joomla
* @copyright Copyright (C) 2005 Open Source Matters. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* Joomla! is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See COPYRIGHT.php for copyright notices and details.
*/

/*
* Tradu��o para portugues do Brasil
* Geraldo Sales
* www.geraldosales.com.br
*
* Baseado na vers�o de
* Fabio Sabino, Fabricio Elias Costa e Fernando Machado para http://www.mambobrasil.org
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Acesso Restrito' );

// Site page note found
define( '_404', 'Lamentamos mas a p�gina solicitada n�o foi encontrada.' );
define( '_404_RTS', 'Voltando para o site' );

define( '_SYSERR1', 'O banco de dados n�o est� dispon�vel' );
define( '_SYSERR2', 'N�o foi poss�vel conectar ao servidor do banco de dados' );
define( '_SYSERR3', 'N�o foi poss�vel conectar ao banco de dados' );

// common
DEFINE('_LANGUAGE','pt_br');
DEFINE('_NOT_AUTH','Voc� n�o tem permiss�o para acessar esta �rea do site.');
DEFINE('_DO_LOGIN','Voc� precisa efetuar o login.');
DEFINE('_VALID_AZ09',"Por favor, digite um %s v�lido. Sem espa�os, com mais de %d caracteres e usando apenas 0-9,a-z,A-Z");
DEFINE('_VALID_AZ09_USER',"Por favor, digite um %s v�lido. Com mais de %d caracteres e usando apenas 0-9,a-z,A-Z");
DEFINE('_CMN_YES','Sim');
DEFINE('_CMN_NO','N�o');
DEFINE('_CMN_SHOW','Exibir');
DEFINE('_CMN_HIDE','Ocultar');

DEFINE('_CMN_NAME','Nome');
DEFINE('_CMN_DESCRIPTION','Descri��o');
DEFINE('_CMN_SAVE','Salvar');
DEFINE('_CMN_APPLY','Confirmar');
DEFINE('_CMN_CANCEL','Cancelar');
DEFINE('_CMN_PRINT','Imprimir');
DEFINE('_CMN_PDF','PDF');
DEFINE('_CMN_EMAIL','E-mail');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','Superior');
DEFINE('_CMN_ORDERING','Ordem');
DEFINE('_CMN_ACCESS','N�vel de Acesso');
DEFINE('_CMN_SELECT','Selecione');

DEFINE('_CMN_NEXT','Pr�ximo');
DEFINE('_CMN_NEXT_ARROW'," &gt;&gt;");
DEFINE('_CMN_PREV','Anterior');
DEFINE('_CMN_PREV_ARROW',"&lt;&lt; ");

DEFINE('_CMN_SORT_NONE','Sem ordem');
DEFINE('_CMN_SORT_ASC','Ascendente');
DEFINE('_CMN_SORT_DESC','Descendente');

DEFINE('_CMN_NEW','Novo');
DEFINE('_CMN_NONE','Nenhum');
DEFINE('_CMN_LEFT','Esquerda');
DEFINE('_CMN_RIGHT','Direita');
DEFINE('_CMN_CENTER','Centro');
DEFINE('_CMN_ARCHIVE','Arquivar');
DEFINE('_CMN_UNARCHIVE','Desarquivar');
DEFINE('_CMN_TOP','Cima');
DEFINE('_CMN_BOTTOM','Baixo');

DEFINE('_CMN_PUBLISHED','Publicado');
DEFINE('_CMN_UNPUBLISHED','N�o Publicado');

DEFINE('_CMN_EDIT_HTML','Editar HTML');
DEFINE('_CMN_EDIT_CSS','Editar CSS');

DEFINE('_CMN_DELETE','Deletar');

DEFINE('_CMN_FOLDER','Pasta');
DEFINE('_CMN_SUBFOLDER','Sub-pasta');
DEFINE('_CMN_OPTIONAL','Opcional');
DEFINE('_CMN_REQUIRED','Obrigat�rio');

DEFINE('_CMN_CONTINUE','Continuar');

DEFINE('_STATIC_CONTENT','Conte�do Estat�co');

DEFINE('_CMN_NEW_ITEM_LAST','Novos itens adicionados por padr�o ao final. Ordena��o pode ser alterada ap�s este item ser salvo.');
DEFINE('_CMN_NEW_ITEM_FIRST','Novos itens adicionados por padr�o ao in�cio. Ordena��o pode ser alterada ap�s este item ser salvo.');
DEFINE('_LOGIN_INCOMPLETE','Por favor, informe os campos de Nome de Usu�rio e Senha.');
DEFINE('_LOGIN_BLOCKED','Seu acesso foi bloqueado. Por favor, entre em contato com o administrador.');
DEFINE('_LOGIN_INCORRECT','Nome de Usu�rio ou Senha incorretos. Tente novamente.');
DEFINE('_LOGIN_NOADMINS','Voc� n�o pode efetuar login. N�o h� administradores configurados.');
DEFINE('_CMN_JAVASCRIPT','!AVISO! Javascript deve estar habilitado para uma execu��o adequada.');

DEFINE('_NEW_MESSAGE','Chegou uma nova mensagem privada.');
DEFINE('_MESSAGE_FAILED','O usu�rio bloqueou a caixa de mensagem dele. Mensagem n�o enviada.');

DEFINE('_CMN_IFRAMES', 'Esta op��o n�o ir� funcionar corretamente. Infelizmente, seu navegador n�o suporta frames inline');

DEFINE('_INSTALL_3PD_WARN','ATEN��O: A Instala��o de extens�es de terceiros pode comprometer a seguran�a do servidor. Atualizando sua instala��o do Joomla! n�o atualizar� estas extens�es de terceiros.<br />Para maiores informa��es sobre como manter a seguran�a em seu site, por favor visite <a href="http://forum.joomla.org/index.php/board,267.0.html" target="_blank" style="color: blue; text-decoration: underline;">Joomla! Security Forum</a>.');
DEFINE('_INSTALL_WARN','Para sua seguran�a favor remover completamente o diret�rio installation incluindo todos os arquivos e sub-pastas e depois atualize a p�gina');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>Arquivo de Tema N�o Encontrado! Procurando por tema:</b></font>');
DEFINE('_NO_PARAMS','N�o h� par�metros para este item');
DEFINE('_HANDLER','Manipulador n�o definido para o tipo');

/** mambots */
DEFINE('_TOC_JUMPTO','�ndice de Artigos');

/**  content */
DEFINE('_READ_MORE','Leia mais...');
DEFINE('_READ_MORE_REGISTER','Cadastre-se para ler mais...');
DEFINE('_MORE','Mais...');
DEFINE('_ON_NEW_CONTENT', "Um novo conte�do foi enviado por [ %s ]  com o t�tulo [ %s ]  na se��o [ %s ]  e categoria  [ %s ]" );
DEFINE('_SEL_CATEGORY','- Selecione a Categoria -');
DEFINE('_SEL_SECTION','- Selecione a Se��o -');
DEFINE('_SEL_AUTHOR','- Selecione o Autor -');
DEFINE('_SEL_POSITION','- Selecione a Posi��o -');
DEFINE('_SEL_TYPE','- Selecione o Tipo -');
DEFINE('_EMPTY_CATEGORY','Esta Categoria est� atualmente vazia');
DEFINE('_EMPTY_BLOG','N�o h� itens a exibir');
DEFINE('_NOT_EXIST','A p�gina que voc� est� tentando acessar n�o existe. <br />Por favor, selecione uma p�gina a partir do Menu Principal.');
DEFINE('_SUBMIT_BUTTON','Enviar');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','Votar');
DEFINE('_BUTTON_RESULTS','Resultados');
DEFINE('_USERNAME','Nome de Usu�rio');
DEFINE('_LOST_PASSWORD','Perdeu sua Senha?');
DEFINE('_PASSWORD','Senha');
DEFINE('_BUTTON_LOGIN','Login');
DEFINE('_BUTTON_LOGOUT','Sair');
DEFINE('_NO_ACCOUNT','N�o se cadastrou?');
DEFINE('_CREATE_ACCOUNT','Cadastre-se j� !');
DEFINE('_VOTE_POOR','Pior');
DEFINE('_VOTE_BEST','Melhor');
DEFINE('_USER_RATING','Avalia��o dos Usu�rios');
DEFINE('_RATE_BUTTON','Avaliar');
DEFINE('_REMEMBER_ME','Lembrar-me');

/** contact.php */
DEFINE('_ENQUIRY','Contato');
DEFINE('_ENQUIRY_TEXT','Este � um e-mail de contato via %s de:');
DEFINE('_COPY_TEXT','Esta � uma c�pia da seguinte mensagem enviada por voc� para %s via %s ');
DEFINE('_COPY_SUBJECT','C�pia de: ');
DEFINE('_THANK_MESSAGE','Agradecemos seu e-mail');
DEFINE('_CLOAKING','Este endere�o de e-mail est� sendo protegido de spam, voc� precisa de Javascript habilitado para v�-lo');
DEFINE('_CONTACT_HEADER_NAME','Nome');
DEFINE('_CONTACT_HEADER_POS','Profiss�o');
DEFINE('_CONTACT_HEADER_EMAIL','Email');
DEFINE('_CONTACT_HEADER_PHONE','Telefone');
DEFINE('_CONTACT_HEADER_FAX','Fax');
DEFINE('_CONTACTS_DESC','Lista de Contatos para este Site.');
DEFINE('_CONTACT_MORE_THAN','Voc� n�o pode informar mais de um endere�o de e-mail');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','Contato');
DEFINE('_EMAIL_DESCRIPTION','Enviar um e-mail para este contato:');
DEFINE('_NAME_PROMPT',' Informe seu nome:');
DEFINE('_EMAIL_PROMPT',' Endere�o de E-mail:');
DEFINE('_MESSAGE_PROMPT',' Digite sua mensagem:');
DEFINE('_SEND_BUTTON','Enviar');
DEFINE('_CONTACT_FORM_NC','Por favor, certifique-se que o formul�rio est� preenchido de forma correta.');
DEFINE('_CONTACT_TELEPHONE','Telefone: ');
DEFINE('_CONTACT_MOBILE','Celular: ');
DEFINE('_CONTACT_FAX','Fax: ');
DEFINE('_CONTACT_EMAIL','E-mail: ');
DEFINE('_CONTACT_NAME','Nome: ');
DEFINE('_CONTACT_POSITION','Profiss�o: ');
DEFINE('_CONTACT_ADDRESS','Endere�o: ');
DEFINE('_CONTACT_MISC','Informa��es: ');
DEFINE('_CONTACT_SEL','Selecione o Contato:');
DEFINE('_CONTACT_NONE','N�o h� informa��es detelhadas do contato.');
DEFINE('_CONTACT_ONE_EMAIL','Voc� n�o pode informar mais de um endere�o de e-mail.');
DEFINE('_EMAIL_A_COPY','Enviar uma c�pia desta mensagem para o seu e-mail');
DEFINE('_CONTACT_DOWNLOAD_AS','Download das informa��es como um');
DEFINE('_VCARD','VCard');

/** pageNavigation */
DEFINE('_PN_LT','<img border="0" align="absmiddle" src="images/voltar.gif"/>');
DEFINE('_PN_RT','<img border="0" align="absmiddle" src="images/avancar.gif"/>');
DEFINE('_PN_PAGE','P�gina');
DEFINE('_PN_OF','de');
DEFINE('_PN_START','In�cio');
DEFINE('_PN_PREVIOUS','Anterior');
DEFINE('_PN_NEXT','Pr�xima');
DEFINE('_PN_END','Fim');
DEFINE('_PN_DISPLAY_NR','Exibir #');
DEFINE('_PN_RESULTS','Resultados');

/** emailfriend */
DEFINE('_EMAIL_TITLE','Enviar a um amigo');
DEFINE('_EMAIL_FRIEND','Envie este por e-mail a um amigo.');
DEFINE('_EMAIL_FRIEND_ADDR',"E-mail do seu amigo:");
DEFINE('_EMAIL_YOUR_NAME','Seu Nome:');
DEFINE('_EMAIL_YOUR_MAIL','Seu E-mail:');
DEFINE('_SUBJECT_PROMPT',' Assunto da mensagem:');
DEFINE('_BUTTON_SUBMIT_MAIL','Enviar e-mail');
DEFINE('_BUTTON_CANCEL','Cancelar');
DEFINE('_EMAIL_ERR_NOINFO','Voc� precisa informar um endere�o de e-mail v�lido para o remetente e para o destinat�rio.');
DEFINE('_EMAIL_MSG','A seguinte p�gina do Site "%s" foi enviado a voc� por %s ( %s ).

Voc� pode acess�-la no seguinte endere�o:
%s');
DEFINE('_EMAIL_INFO','Enviado por');
DEFINE('_EMAIL_SENT','O e-mail est� sendo enviado para');
DEFINE('_PROMPT_CLOSE','Fechar janela');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' Autoria de');
DEFINE('_WRITTEN_BY', ' Escrito por');
DEFINE('_LAST_UPDATED', '�ltima Atualiza��o');
DEFINE('_BACK','[ Voltar ]');
DEFINE('_LEGEND','Legenda');
DEFINE('_DATE','Data');
DEFINE('_ORDER_DROPDOWN','Ordem');
DEFINE('_HEADER_TITLE','T�tulo');
DEFINE('_HEADER_AUTHOR','Autor');
DEFINE('_HEADER_SUBMITTED','Enviado');
DEFINE('_HEADER_HITS','Acessos');
DEFINE('_E_EDIT','Editar');
DEFINE('_E_ADD','Adicionar');
DEFINE('_E_WARNUSER','Por favor, escolha entre Cancelar ou Salvar as altera��es');
DEFINE('_E_WARNTITLE','Item de conte�do deve ter um T�tulo');
DEFINE('_E_WARNTEXT','Item de conte�do deve ter um texto de introdu��o');
DEFINE('_E_WARNCAT','Por favor, selecione uma Categoria');
DEFINE('_E_CONTENT','Conte�do');
DEFINE('_E_TITLE','T�tulo:');
DEFINE('_E_CATEGORY','Categoria:');
DEFINE('_E_INTRO','Texto de Introdu��o');
DEFINE('_E_MAIN','Texto Principal');
DEFINE('_E_MOSIMAGE','INSERIR {mosimage}');
DEFINE('_E_IMAGES','Imagens');
DEFINE('_E_GALLERY_IMAGES','Galeria de Imagens');
DEFINE('_E_CONTENT_IMAGES','Conte�do de Imagens');
DEFINE('_E_EDIT_IMAGE','Editar Imagem');
DEFINE('_E_NO_IMAGE','Sem Imagem');
DEFINE('_E_INSERT','Inserir');
DEFINE('_E_UP','Acima');
DEFINE('_E_DOWN','Abaixo');
DEFINE('_E_REMOVE','Remover');
DEFINE('_E_SOURCE','Fonte:');
DEFINE('_E_ALIGN','Alinhamento:');
DEFINE('_E_ALT','Texto Alt:');
DEFINE('_E_BORDER','Borda:');
DEFINE('_E_CAPTION','Legenda');
DEFINE('_E_CAPTION_POSITION','Posi��o da Legenda');
DEFINE('_E_CAPTION_ALIGN','Alinhamento da Legenda');
DEFINE('_E_CAPTION_WIDTH','Comprimento da Legenda');
DEFINE('_E_APPLY','Aplicar');
DEFINE('_E_PUBLISHING','Publica��o');
DEFINE('_E_STATE','Estado:');
DEFINE('_E_AUTHOR_ALIAS','Apelido do Autor:');
DEFINE('_E_ACCESS_LEVEL','N�vel de Acesso:');
DEFINE('_E_ORDERING','Ordenar:');
DEFINE('_E_START_PUB','In�cio da Publica��o:');
DEFINE('_E_FINISH_PUB','Final da Publica��o:');
DEFINE('_E_SHOW_FP','Exibir na P�gina Principal:');
DEFINE('_E_HIDE_TITLE','Ocultar T�tulo:');
DEFINE('_E_METADATA','Metadados');
DEFINE('_E_M_DESC','Descri��o:');
DEFINE('_E_M_KEY','Palavras Chaves:');
DEFINE('_E_SUBJECT','Assunto:');
DEFINE('_E_EXPIRES','Expira em:');
DEFINE('_E_VERSION','Vers�o:');
DEFINE('_E_ABOUT','Sobre');
DEFINE('_E_CREATED','Criado:');
DEFINE('_E_LAST_MOD','�ltima Modifica��o:');
DEFINE('_E_HITS','Acessos:');
DEFINE('_E_SAVE','Salvar');
DEFINE('_E_CANCEL','Cancelar');
DEFINE('_E_REGISTERED','Somente usu�rios cadastrados');
DEFINE('_E_ITEM_INFO','Informa��o do Item');
DEFINE('_E_ITEM_SAVED','Item salvo com sucesso.');
DEFINE('_ITEM_PREVIOUS','&lt; Anterior');
DEFINE('_ITEM_NEXT','Pr�ximo &gt;');
DEFINE('_KEY_NOT_FOUND','Chave n�o encontrda');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','Atualmente n�o h� entradas arquivadas nessa se��o. Por favor, volte mais tarde');
DEFINE('_CATEGORY_ARCHIVE_EMPTY','Atualmente n�o h� entradas arquivadas nessa categoria. Por favor, volte mais tarde');
DEFINE('_HEADER_SECTION_ARCHIVE','Arquivos da Se��o');
DEFINE('_HEADER_CATEGORY_ARCHIVE','Arquivos da Categoria');
DEFINE('_ARCHIVE_SEARCH_FAILURE','N�o h� entradas arquivadas para %s %s');	// values are month then year
DEFINE('_ARCHIVE_SEARCH_SUCCESS','H� entradas arquivadas para %s %s');	// values are month then year
DEFINE('_FILTER','Filtro');
DEFINE('_ORDER_DROPDOWN_DA','Data asc');
DEFINE('_ORDER_DROPDOWN_DD','Data desc');
DEFINE('_ORDER_DROPDOWN_TA','T�tulo asc');
DEFINE('_ORDER_DROPDOWN_TD','T�tulo desc');
DEFINE('_ORDER_DROPDOWN_HA','Acessos asc');
DEFINE('_ORDER_DROPDOWN_HD','Acessos desc');
DEFINE('_ORDER_DROPDOWN_AUA','Autor asc');
DEFINE('_ORDER_DROPDOWN_AUD','Autor desc');
DEFINE('_ORDER_DROPDOWN_O','Ordem');

/** poll.php */
DEFINE('_ALERT_ENABLED','Cookies devem esta habilitados!');
DEFINE('_ALREADY_VOTE','Voc� j� votou nesta enquete hoje!');
DEFINE('_NO_SELECTION','Por favor, escolha uma das op��es dispon�veis e tente novamente');
DEFINE('_THANKS','Agradecemos seu voto');
DEFINE('_SELECT_POLL','Selecione uma enquete na lista');

/** classes/html/poll.php */
DEFINE('_JAN','Janeiro');
DEFINE('_FEB','Fevereiro');
DEFINE('_MAR','Mar�o');
DEFINE('_APR','Abril');
DEFINE('_MAY','Maio');
DEFINE('_JUN','Junho');
DEFINE('_JUL','Julho');
DEFINE('_AUG','Agosto');
DEFINE('_SEP','Setembro');
DEFINE('_OCT','Outubro');
DEFINE('_NOV','Novembro');
DEFINE('_DEC','Dezembro');
DEFINE('_POLL_TITLE','Enquete - Resultados');
DEFINE('_SURVEY_TITLE','T�tulo da Enquete:');
DEFINE('_NUM_VOTERS','N�mero de votos');
DEFINE('_FIRST_VOTE','Primeiro Voto');
DEFINE('_LAST_VOTE','�ltimo Voto');
DEFINE('_SEL_POLL','Selecione a Enquete:');
DEFINE('_NO_RESULTS','N�o h� resultados para esta enquete.');

/** registration.php */
DEFINE('_ERROR_PASS','Sinto muito, n�o foi encontrado usu�rio correspondente');
DEFINE('_NEWPASS_MSG',' conta de usu�rio $checkusername tem este e-mail associado a ela.\n'
.'Um usu�rio de $mosConfig_live_site acabou de requerer que uma nova senha seja enviada.\n\n'
.' Sua Nova Senha �: $newpass\n\nSe voc� n�o a solicitou, n�o se preocupe.'
.' Somente voc� est� recebendo esta mensagem, e caso a mesma tenha sido enviada por engano, basta efetuar o login com a'
.' nova Senha e alter�-la para uma de sua prefer�ncia.');
DEFINE('_NEWPASS_SUB','$_sitename :: Nova senha para - $checkusername');
DEFINE('_NEWPASS_SENT','Nova Senha criada e enviada!');
DEFINE('_REGWARN_NAME','Por favor, informe seu Nome.');
DEFINE('_REGWARN_UNAME','Por favor, informe seu Nome de Usu�rio.');
DEFINE('_REGWARN_MAIL','Por favor, informe um endere�o de e-mail v�lido.');
DEFINE('_REGWARN_PASS','Por favor, informe uma senha v�lida. Sem espa�os, com mais de 6 caracteres e contendo apenas 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','Por favor, confirme a senha.');
DEFINE('_REGWARN_VPASS2','A senha e sua confirma��o n�o coincidem. Por favor, tente novamente.');
DEFINE('_REGWARN_INUSE','Esse nome de usu�rio j� est� sendo usado por outra pessoa. Por favor, tente outro.');
DEFINE('_REGWARN_EMAIL_INUSE', 'Este e-mail j� est� cadastrado. Se voc� esqueceu a senha clique em "Perdeu sua senha?" e uma nova senha ser� enviada para voc�.');
DEFINE('_SEND_SUB','Detalhes da Conta para %s no %s');
DEFINE('_USEND_MSG_ACTIVATE', 'Ol� %s,

Agradecemos por ter se cadastrado no site %s. Sua conta est� criada e deve ser ativada antes que voc� possa us�-la.
Para ativar a conta clique no seguinte link ou copie-cole no seu navegador:
%s

Depois da ativa��o voc� pode efetuar login no %s utilizando os seguintes Nome de Usu�rio e Senha:

Nome de Usu�rio - %s
Senha - %s');
DEFINE('_USEND_MSG', "Ol� %s,

Agradecemos por ter se cadastrado no site %s.

Voc� pode agora efetuar o login no %s utilizando o Nome de Usu�rio e Senha com as quais voc� se registrou.");
DEFINE('_USEND_MSG_NOPASS','Ol� $name,\n\nVoc� foi inclu�do como usu�rio do site $mosConfig_live_site.\n'
.'Voc� pode agora efetuar o login no $mosConfig_live_site utilizando o Nome de Usu�rio e Senha com as quais voc� se registrou.\n\n'
.'Por favor, n�o responda a esta mensagem pois a mesma foi gerada automaticamente pelo sistema apenas com car�ter informativo\n');
DEFINE('_ASEND_MSG','Ol� %s,

Um novo usu�rio se registrou no site %s.
Este e-mail cont�m os detalhes deste usu�rio:

Nome - %s
E-mail - %s
Nome de Usu�rio - %s

Por favor, n�o responda a esta mensagem pois a mesma foi gerada automaticamente pelo sistema apenas com car�ter informativo');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">Cadastro efetuado com sucesso!</div><br />&nbsp;&nbsp;'
.'Voc� pode agora efetuar o login.<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">Cadastro efetuado com sucesso!</div><br />Voc� agora pode efetuar o  login.');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">Cadastro efetuado com sucesso!</div><br />Sua conta foi criada e um endere�o para ativa��o foi enviado para o e-mail informado em seu cadastro. Voc� deve ativar sua conta clicando no link de ativa��o enviado no e-mail antes de poder efetuar o login no site.');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">Ativa��o efetuada com sucesso!</div><br />Sua conta foi ativada com sucesso. Voc� pode agora efetuar o login no site utilizando o Nome de Usu�rio e a Senha com os quais voc� se cadastrou.');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">Endere�o de Ativa��o Inv�lido!</div><br />N�o existe esta conta em nosso banco de dados ou a mesma j� foi ativada.');
DEFINE('_REG_ACTIVATE_FAILURE', '<div class="componentheading">Falha na Ativa��o!</div><br />O sistema n�o pode ativar sau conta, por favor contacte o administrador do site.');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','Perdeu sua senha?');
DEFINE('_NEW_PASS_DESC','Por favor, informe seu Nome de Usu�rio e E-mail e clique no bot�o Enviar Senha.<br />'
.'Voc� receber� uma nova senha brevemente.  Utilize a nova senha para acessar o site.');
DEFINE('_PROMPT_UNAME','Nome de Usu�rio:');
DEFINE('_PROMPT_EMAIL','Endere�o de E-mail:');
DEFINE('_BUTTON_SEND_PASS','Enviar Senha');
DEFINE('_REGISTER_TITLE','Cadastro');
DEFINE('_REGISTER_NAME','Nome:');
DEFINE('_REGISTER_UNAME','Nome de usu�rio:');
DEFINE('_REGISTER_EMAIL','E-mail:');
DEFINE('_REGISTER_PASS','Senha:');
DEFINE('_REGISTER_VPASS','Confirma��o de senha:');
DEFINE('_REGISTER_REQUIRED','Os campos assinalados com asterisco (*) s�o obrigat�rios.');
DEFINE('_BUTTON_SEND_REG','Enviar cadastro');
DEFINE('_SENDING_PASSWORD','Sua senha ser� enviada para o endere�o de e-mail acima.<br />Uma vez voc� tenha recebido sua'
.' nova senha voc� poder� efetuar o login e alter�-la.');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','Pesquisar');
DEFINE('_PROMPT_KEYWORD','Pesquisar palavra chave');
DEFINE('_SEARCH_MATCHES','retornou %d ocorr�ncias');
DEFINE('_CONCLUSION','Foram encontrados $totalRows ocorr�ncias.  Pesquisa por [ <b>$searchword</b> ] com');
DEFINE('_NOKEYWORD','Nenhum resultado encontrado');
DEFINE('_IGNOREKEYWORD','Uma ou mais palavras comuns foram ignoradas durante a pesquisa');
DEFINE('_SEARCH_ANYWORDS','Qualquer das palavras');
DEFINE('_SEARCH_ALLWORDS','Todas as palavras');
DEFINE('_SEARCH_PHRASE','Frase exata');
DEFINE('_SEARCH_NEWEST','Mais recentes primeiro');
DEFINE('_SEARCH_OLDEST','Mais antigos primeiro');
DEFINE('_SEARCH_POPULAR','Mais acessados');
DEFINE('_SEARCH_ALPHABETICAL','Alfab�tica');
DEFINE('_SEARCH_CATEGORY','Se��o/Categoria');
DEFINE('_SEARCH_MESSAGE','Pesquisa deve ser feita por palavras de no m�nimo 3 letras e m�ximo de 20 letras');
DEFINE('_SEARCH_ARCHIVED','Arquivado');
DEFINE('_SEARCH_CATBLOG','Blog Categoria');
DEFINE('_SEARCH_CATLIST','Lista de Categoria');
DEFINE('_SEARCH_NEWSFEEDS','Newsfeeds');
DEFINE('_SEARCH_SECLIST','Lista de Se��o');
DEFINE('_SEARCH_SECBLOG','Blog de Se��o');


/** templates/*.php */
DEFINE('_ISO','charset=iso-8859-1');
DEFINE('_DATE_FORMAT','l, d F Y');  //Uses PHP's DATE Command Format - Depreciated
/**
* Modify this line to reflect how you want the date to appear in your site
*
*e.g. DEFINE("_DATE_FORMAT_LC","%A, %d %B %Y %H:%M"); //Uses PHP's strftime Command Format
*/
DEFINE('_DATE_FORMAT_LC',"%A, %d de %B de %Y"); //Uses PHP's strftime Command Format
DEFINE('_DATE_FORMAT_LC2',"%A, %d de %B de %Y %H:%M");
DEFINE('_SEARCH_BOX','pesquisar...');
DEFINE('_NEWSFLASH_BOX','Destaques!');
DEFINE('_MAINMENU_BOX','Menu Principal');

/** classes/html/usermenu.php */
DEFINE('_UMENU_TITLE','Menu do Usu�rio');
DEFINE('_HI','Oi, ');

/** user.php */
DEFINE('_SAVE_ERR','Por favor complete todos os campos.');
DEFINE('_THANK_SUB','Agradecemos sua colabora��o. Um de nossos editores ir� revisar seu texto e public�-lo no site assim que poss�vel.');
DEFINE('_THANK_SUB_PUB','Agradecemos sua colabora��o.');
DEFINE('_UP_SIZE','N�o � poss�vel enviar arquivos com mais de 15kb.');
DEFINE('_UP_EXISTS','J� existe uma imagem chamada $userfile_name. Por favor, renomeie o arquivo e tente novamente.');
DEFINE('_UP_COPY_FAIL','Erro ao copiar');
DEFINE('_UP_TYPE_WARN','Voc� somente pode enviar imagens gif ou jpg.');
DEFINE('_MAIL_SUB','Sugest�o de Usu�rio');
DEFINE('_MAIL_MSG','Ol� $adminName,\n\n\n Foi enviado $type:\n [ $title ]\n pelo usu�rio:\n [ $author ]\n'
.' para o site $mosConfig_live_site.\n\n\n\n'
.'Por favor, v� ao endere�o $mosConfig_live_site/administrator para ver e aprovar este $type.\n\n'
.'Por favor, n�o responda a esta mensagem pois a mesma foi gerada automaticamente pelo sistema apenas com car�ter informativo\n');
DEFINE('_PASS_VERR1','Se estiver alterando sua senha, por favor, digite-a novamente para confirma��o.');
DEFINE('_PASS_VERR2','Se estiver alterando sua senha, certifique-se de que a senha e sua confirma��o sejam id�nticas.');
DEFINE('_UNAME_INUSE','Este Nome de Usu�rio j� est� sendo utilizado.');
DEFINE('_UPDATE','Atualizar');
DEFINE('_USER_DETAILS_SAVE','Suas configura��es foram salvas.');
DEFINE('_USER_LOGIN','Login do Usu�rio');

/** components/com_user */
DEFINE('_EDIT_TITLE','Alterar seu cadastro');
DEFINE('_YOUR_NAME','Seu Nome:');
DEFINE('_EMAIL','e-mail:');
DEFINE('_UNAME','Nome de Usu�rio:');
DEFINE('_PASS','Senha:');
DEFINE('_VPASS','Confirma��o de senha:');
DEFINE('_SUBMIT_SUCCESS','Enviado com Sucesso!');
DEFINE('_SUBMIT_SUCCESS_DESC','Sua colabora��o foi enviada para a administra��o do site e ser� revisada antes de ser publicada.');
DEFINE('_WELCOME','Bem-vindo!');
DEFINE('_WELCOME_DESC','Bem-vindo � se��o do usu�rio de nosso site');
DEFINE('_CONF_CHECKED_IN','Itens marcados como Revisados t�m agora o status Revisar');
DEFINE('_CHECK_TABLE','Verificando Tebela');
DEFINE('_CHECKED_IN','Revisar ');
DEFINE('_CHECKED_IN_ITEMS',' itens');
DEFINE('_PASS_MATCH','As senhas n�o coincidem');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','Voc� deve informar um nome para o cliente.');
DEFINE('_BNR_CONTACT','Voc� deve informar um contato para o cliente.');
DEFINE('_BNR_VALID_EMAIL','Voc� deve informar um e-mail v�lido para o cliente.');
DEFINE('_BNR_CLIENT','Voc� deve informar um cliente,');
DEFINE('_BNR_NAME','Voc� deve informar um nome para o banner.');
DEFINE('_BNR_IMAGE','Voc� deve informar uma imagem para o banner.');
DEFINE('_BNR_URL','Voc� deve informar um endere�o e/ou um c�digo personalizado (script) para o banner.');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','Voc� j� efetuou o login!');
DEFINE('_LOGOUT','Clique aqui para sair');
DEFINE('_LOGIN_TEXT','Utilize os campos Nome de Usu�rio e Senha ao lado para obter acesso total');
DEFINE('_LOGIN_SUCCESS','Voc� realizou o login com sucesso');
DEFINE('_LOGOUT_SUCCESS','Voc� saiu do sistema com sucesso');
DEFINE('_LOGIN_DESCRIPTION','Para poder acessar a �rea privativa deste site, por favor, efetue o login');
DEFINE('_LOGOUT_DESCRIPTION','Voc� est� logado na �rea privativa deste site');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','Links');
DEFINE('_WEBLINKS_DESC','Escolha uma das categorias de links abaixo, depois selecione uma URL para visitar o site.');
DEFINE('_HEADER_TITLE_WEBLINKS','Link');
DEFINE('_SECTION','Se��o:');
DEFINE('_SUBMIT_LINK','Sugerir um link');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','Descri��o:');
DEFINE('_NAME','Nome:');
DEFINE('_WEBLINK_EXIST','J� h� um link com este t�tulo. Por favor, tente novamente.');
DEFINE('_WEBLINK_TITLE','O link deve conter um t�tulo.');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','Nome da fonte');
DEFINE('_FEED_ARTICLES','# Artigos');
DEFINE('_FEED_LINK','Link da Fonte');

/** whos_online.php */
DEFINE('_WE_HAVE', 'N�s temos ');
DEFINE('_AND', ' e ');
DEFINE('_GUEST_COUNT','%s visitante');
DEFINE('_GUESTS_COUNT','%s visitantes');
DEFINE('_MEMBER_COUNT','%s membro');
DEFINE('_MEMBERS_COUNT','%s membros');
DEFINE('_ONLINE',' online');
DEFINE('_NONE','Nenhum usu�rio Online');

/** modules/mod_banners */
DEFINE('_BANNER_ALT','Publicidade');

/** modules/mod_random_image */
DEFINE('_NO_IMAGES','Sem Imagens');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','Hora');
DEFINE('_MEMBERS_STAT','Membros');
DEFINE('_HITS_STAT','Acessos');
DEFINE('_NEWS_STAT','Not�cias');
DEFINE('_LINKS_STAT','Links');
DEFINE('_VISITORS','Visitantes');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* O 1o. item publicado neste menu [menu principal] � por padr�o o `In�cio` deste site *');
DEFINE('_MAINMENU_DEL','* Voc� n�o pode `deletar` este menu porque ele � necess�rio para a opera��o adequada do Joomla! *');
DEFINE('_MENU_GROUP','* Alguns `Tipo de Menu` aparecem em mais de um grupo *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', 'Detalhes do Novo Usu�rio' );
DEFINE('_NEW_USER_MESSAGE', 'Ol� %s,


Voc� foi adicionado como um usu�rio do site %s pelo seu Administrador.

Este e-mail contem seu Nome de Usu�rio e Senha para que voc� possa acessar %s:

Nome de Usu�rio - %s
Senha - %s


Por favor, n�o responda a esta mensagem pois a mesma foi gerada automaticamente pelo sistema apenas com car�ter informativo');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "Este � um e-mail de '%s'

Mensagem:
" );


/** includes/pdf.php */
DEFINE('_PDF_GENERATED','Gerado:');
DEFINE('_PDF_POWERED','Powered by Joomla!');
?>