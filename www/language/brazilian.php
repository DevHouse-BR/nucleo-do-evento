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
* Tradução para portugues do Brasil
* Geraldo Sales
* www.geraldosales.com.br
*
* Baseado na versão de
* Fabio Sabino, Fabricio Elias Costa e Fernando Machado para http://www.mambobrasil.org
*/

// no direct access
defined( '_VALID_MOS' ) or die( 'Acesso Restrito' );

// Site page note found
define( '_404', 'Lamentamos mas a página solicitada não foi encontrada.' );
define( '_404_RTS', 'Voltando para o site' );

define( '_SYSERR1', 'O banco de dados não está disponível' );
define( '_SYSERR2', 'Não foi possível conectar ao servidor do banco de dados' );
define( '_SYSERR3', 'Não foi possível conectar ao banco de dados' );

// common
DEFINE('_LANGUAGE','pt_br');
DEFINE('_NOT_AUTH','Você não tem permissão para acessar esta área do site.');
DEFINE('_DO_LOGIN','Você precisa efetuar o login.');
DEFINE('_VALID_AZ09',"Por favor, digite um %s válido. Sem espaços, com mais de %d caracteres e usando apenas 0-9,a-z,A-Z");
DEFINE('_VALID_AZ09_USER',"Por favor, digite um %s válido. Com mais de %d caracteres e usando apenas 0-9,a-z,A-Z");
DEFINE('_CMN_YES','Sim');
DEFINE('_CMN_NO','Não');
DEFINE('_CMN_SHOW','Exibir');
DEFINE('_CMN_HIDE','Ocultar');

DEFINE('_CMN_NAME','Nome');
DEFINE('_CMN_DESCRIPTION','Descrição');
DEFINE('_CMN_SAVE','Salvar');
DEFINE('_CMN_APPLY','Confirmar');
DEFINE('_CMN_CANCEL','Cancelar');
DEFINE('_CMN_PRINT','Imprimir');
DEFINE('_CMN_PDF','PDF');
DEFINE('_CMN_EMAIL','E-mail');
DEFINE('_ICON_SEP','|');
DEFINE('_CMN_PARENT','Superior');
DEFINE('_CMN_ORDERING','Ordem');
DEFINE('_CMN_ACCESS','Nível de Acesso');
DEFINE('_CMN_SELECT','Selecione');

DEFINE('_CMN_NEXT','Próximo');
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
DEFINE('_CMN_UNPUBLISHED','Não Publicado');

DEFINE('_CMN_EDIT_HTML','Editar HTML');
DEFINE('_CMN_EDIT_CSS','Editar CSS');

DEFINE('_CMN_DELETE','Deletar');

DEFINE('_CMN_FOLDER','Pasta');
DEFINE('_CMN_SUBFOLDER','Sub-pasta');
DEFINE('_CMN_OPTIONAL','Opcional');
DEFINE('_CMN_REQUIRED','Obrigatório');

DEFINE('_CMN_CONTINUE','Continuar');

DEFINE('_STATIC_CONTENT','Conteúdo Estatíco');

DEFINE('_CMN_NEW_ITEM_LAST','Novos itens adicionados por padrão ao final. Ordenação pode ser alterada após este item ser salvo.');
DEFINE('_CMN_NEW_ITEM_FIRST','Novos itens adicionados por padrão ao início. Ordenação pode ser alterada após este item ser salvo.');
DEFINE('_LOGIN_INCOMPLETE','Por favor, informe os campos de Nome de Usuário e Senha.');
DEFINE('_LOGIN_BLOCKED','Seu acesso foi bloqueado. Por favor, entre em contato com o administrador.');
DEFINE('_LOGIN_INCORRECT','Nome de Usuário ou Senha incorretos. Tente novamente.');
DEFINE('_LOGIN_NOADMINS','Você não pode efetuar login. Não há administradores configurados.');
DEFINE('_CMN_JAVASCRIPT','!AVISO! Javascript deve estar habilitado para uma execução adequada.');

DEFINE('_NEW_MESSAGE','Chegou uma nova mensagem privada.');
DEFINE('_MESSAGE_FAILED','O usuário bloqueou a caixa de mensagem dele. Mensagem não enviada.');

DEFINE('_CMN_IFRAMES', 'Esta opção não irá funcionar corretamente. Infelizmente, seu navegador não suporta frames inline');

DEFINE('_INSTALL_3PD_WARN','ATENÇÃO: A Instalação de extensões de terceiros pode comprometer a segurança do servidor. Atualizando sua instalação do Joomla! não atualizará estas extensões de terceiros.<br />Para maiores informações sobre como manter a segurança em seu site, por favor visite <a href="http://forum.joomla.org/index.php/board,267.0.html" target="_blank" style="color: blue; text-decoration: underline;">Joomla! Security Forum</a>.');
DEFINE('_INSTALL_WARN','Para sua segurança favor remover completamente o diretório installation incluindo todos os arquivos e sub-pastas e depois atualize a página');
DEFINE('_TEMPLATE_WARN','<font color=\"red\"><b>Arquivo de Tema Não Encontrado! Procurando por tema:</b></font>');
DEFINE('_NO_PARAMS','Não há parâmetros para este item');
DEFINE('_HANDLER','Manipulador não definido para o tipo');

/** mambots */
DEFINE('_TOC_JUMPTO','Índice de Artigos');

/**  content */
DEFINE('_READ_MORE','Leia mais...');
DEFINE('_READ_MORE_REGISTER','Cadastre-se para ler mais...');
DEFINE('_MORE','Mais...');
DEFINE('_ON_NEW_CONTENT', "Um novo conteúdo foi enviado por [ %s ]  com o título [ %s ]  na seção [ %s ]  e categoria  [ %s ]" );
DEFINE('_SEL_CATEGORY','- Selecione a Categoria -');
DEFINE('_SEL_SECTION','- Selecione a Seção -');
DEFINE('_SEL_AUTHOR','- Selecione o Autor -');
DEFINE('_SEL_POSITION','- Selecione a Posição -');
DEFINE('_SEL_TYPE','- Selecione o Tipo -');
DEFINE('_EMPTY_CATEGORY','Esta Categoria está atualmente vazia');
DEFINE('_EMPTY_BLOG','Não há itens a exibir');
DEFINE('_NOT_EXIST','A página que você está tentando acessar não existe. <br />Por favor, selecione uma página a partir do Menu Principal.');
DEFINE('_SUBMIT_BUTTON','Enviar');

/** classes/html/modules.php */
DEFINE('_BUTTON_VOTE','Votar');
DEFINE('_BUTTON_RESULTS','Resultados');
DEFINE('_USERNAME','Nome de Usuário');
DEFINE('_LOST_PASSWORD','Perdeu sua Senha?');
DEFINE('_PASSWORD','Senha');
DEFINE('_BUTTON_LOGIN','Login');
DEFINE('_BUTTON_LOGOUT','Sair');
DEFINE('_NO_ACCOUNT','Não se cadastrou?');
DEFINE('_CREATE_ACCOUNT','Cadastre-se já !');
DEFINE('_VOTE_POOR','Pior');
DEFINE('_VOTE_BEST','Melhor');
DEFINE('_USER_RATING','Avaliação dos Usuários');
DEFINE('_RATE_BUTTON','Avaliar');
DEFINE('_REMEMBER_ME','Lembrar-me');

/** contact.php */
DEFINE('_ENQUIRY','Contato');
DEFINE('_ENQUIRY_TEXT','Este é um e-mail de contato via %s de:');
DEFINE('_COPY_TEXT','Esta é uma cópia da seguinte mensagem enviada por você para %s via %s ');
DEFINE('_COPY_SUBJECT','Cópia de: ');
DEFINE('_THANK_MESSAGE','Agradecemos seu e-mail');
DEFINE('_CLOAKING','Este endereço de e-mail está sendo protegido de spam, você precisa de Javascript habilitado para vê-lo');
DEFINE('_CONTACT_HEADER_NAME','Nome');
DEFINE('_CONTACT_HEADER_POS','Profissão');
DEFINE('_CONTACT_HEADER_EMAIL','Email');
DEFINE('_CONTACT_HEADER_PHONE','Telefone');
DEFINE('_CONTACT_HEADER_FAX','Fax');
DEFINE('_CONTACTS_DESC','Lista de Contatos para este Site.');
DEFINE('_CONTACT_MORE_THAN','Você não pode informar mais de um endereço de e-mail');

/** classes/html/contact.php */
DEFINE('_CONTACT_TITLE','Contato');
DEFINE('_EMAIL_DESCRIPTION','Enviar um e-mail para este contato:');
DEFINE('_NAME_PROMPT',' Informe seu nome:');
DEFINE('_EMAIL_PROMPT',' Endereço de E-mail:');
DEFINE('_MESSAGE_PROMPT',' Digite sua mensagem:');
DEFINE('_SEND_BUTTON','Enviar');
DEFINE('_CONTACT_FORM_NC','Por favor, certifique-se que o formulário está preenchido de forma correta.');
DEFINE('_CONTACT_TELEPHONE','Telefone: ');
DEFINE('_CONTACT_MOBILE','Celular: ');
DEFINE('_CONTACT_FAX','Fax: ');
DEFINE('_CONTACT_EMAIL','E-mail: ');
DEFINE('_CONTACT_NAME','Nome: ');
DEFINE('_CONTACT_POSITION','Profissão: ');
DEFINE('_CONTACT_ADDRESS','Endereço: ');
DEFINE('_CONTACT_MISC','Informações: ');
DEFINE('_CONTACT_SEL','Selecione o Contato:');
DEFINE('_CONTACT_NONE','Não há informações detelhadas do contato.');
DEFINE('_CONTACT_ONE_EMAIL','Você não pode informar mais de um endereço de e-mail.');
DEFINE('_EMAIL_A_COPY','Enviar uma cópia desta mensagem para o seu e-mail');
DEFINE('_CONTACT_DOWNLOAD_AS','Download das informações como um');
DEFINE('_VCARD','VCard');

/** pageNavigation */
DEFINE('_PN_LT','<img border="0" align="absmiddle" src="images/voltar.gif"/>');
DEFINE('_PN_RT','<img border="0" align="absmiddle" src="images/avancar.gif"/>');
DEFINE('_PN_PAGE','Página');
DEFINE('_PN_OF','de');
DEFINE('_PN_START','Início');
DEFINE('_PN_PREVIOUS','Anterior');
DEFINE('_PN_NEXT','Próxima');
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
DEFINE('_EMAIL_ERR_NOINFO','Você precisa informar um endereço de e-mail válido para o remetente e para o destinatário.');
DEFINE('_EMAIL_MSG','A seguinte página do Site "%s" foi enviado a você por %s ( %s ).

Você pode acessá-la no seguinte endereço:
%s');
DEFINE('_EMAIL_INFO','Enviado por');
DEFINE('_EMAIL_SENT','O e-mail está sendo enviado para');
DEFINE('_PROMPT_CLOSE','Fechar janela');

/** classes/html/content.php */
DEFINE('_AUTHOR_BY', ' Autoria de');
DEFINE('_WRITTEN_BY', ' Escrito por');
DEFINE('_LAST_UPDATED', 'Última Atualização');
DEFINE('_BACK','[ Voltar ]');
DEFINE('_LEGEND','Legenda');
DEFINE('_DATE','Data');
DEFINE('_ORDER_DROPDOWN','Ordem');
DEFINE('_HEADER_TITLE','Título');
DEFINE('_HEADER_AUTHOR','Autor');
DEFINE('_HEADER_SUBMITTED','Enviado');
DEFINE('_HEADER_HITS','Acessos');
DEFINE('_E_EDIT','Editar');
DEFINE('_E_ADD','Adicionar');
DEFINE('_E_WARNUSER','Por favor, escolha entre Cancelar ou Salvar as alterações');
DEFINE('_E_WARNTITLE','Item de conteúdo deve ter um Título');
DEFINE('_E_WARNTEXT','Item de conteúdo deve ter um texto de introdução');
DEFINE('_E_WARNCAT','Por favor, selecione uma Categoria');
DEFINE('_E_CONTENT','Conteúdo');
DEFINE('_E_TITLE','Título:');
DEFINE('_E_CATEGORY','Categoria:');
DEFINE('_E_INTRO','Texto de Introdução');
DEFINE('_E_MAIN','Texto Principal');
DEFINE('_E_MOSIMAGE','INSERIR {mosimage}');
DEFINE('_E_IMAGES','Imagens');
DEFINE('_E_GALLERY_IMAGES','Galeria de Imagens');
DEFINE('_E_CONTENT_IMAGES','Conteúdo de Imagens');
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
DEFINE('_E_CAPTION_POSITION','Posição da Legenda');
DEFINE('_E_CAPTION_ALIGN','Alinhamento da Legenda');
DEFINE('_E_CAPTION_WIDTH','Comprimento da Legenda');
DEFINE('_E_APPLY','Aplicar');
DEFINE('_E_PUBLISHING','Publicação');
DEFINE('_E_STATE','Estado:');
DEFINE('_E_AUTHOR_ALIAS','Apelido do Autor:');
DEFINE('_E_ACCESS_LEVEL','Nível de Acesso:');
DEFINE('_E_ORDERING','Ordenar:');
DEFINE('_E_START_PUB','Início da Publicação:');
DEFINE('_E_FINISH_PUB','Final da Publicação:');
DEFINE('_E_SHOW_FP','Exibir na Página Principal:');
DEFINE('_E_HIDE_TITLE','Ocultar Título:');
DEFINE('_E_METADATA','Metadados');
DEFINE('_E_M_DESC','Descrição:');
DEFINE('_E_M_KEY','Palavras Chaves:');
DEFINE('_E_SUBJECT','Assunto:');
DEFINE('_E_EXPIRES','Expira em:');
DEFINE('_E_VERSION','Versão:');
DEFINE('_E_ABOUT','Sobre');
DEFINE('_E_CREATED','Criado:');
DEFINE('_E_LAST_MOD','Última Modificação:');
DEFINE('_E_HITS','Acessos:');
DEFINE('_E_SAVE','Salvar');
DEFINE('_E_CANCEL','Cancelar');
DEFINE('_E_REGISTERED','Somente usuários cadastrados');
DEFINE('_E_ITEM_INFO','Informação do Item');
DEFINE('_E_ITEM_SAVED','Item salvo com sucesso.');
DEFINE('_ITEM_PREVIOUS','&lt; Anterior');
DEFINE('_ITEM_NEXT','Próximo &gt;');
DEFINE('_KEY_NOT_FOUND','Chave não encontrda');


/** content.php */
DEFINE('_SECTION_ARCHIVE_EMPTY','Atualmente não há entradas arquivadas nessa seção. Por favor, volte mais tarde');
DEFINE('_CATEGORY_ARCHIVE_EMPTY','Atualmente não há entradas arquivadas nessa categoria. Por favor, volte mais tarde');
DEFINE('_HEADER_SECTION_ARCHIVE','Arquivos da Seção');
DEFINE('_HEADER_CATEGORY_ARCHIVE','Arquivos da Categoria');
DEFINE('_ARCHIVE_SEARCH_FAILURE','Não há entradas arquivadas para %s %s');	// values are month then year
DEFINE('_ARCHIVE_SEARCH_SUCCESS','Há entradas arquivadas para %s %s');	// values are month then year
DEFINE('_FILTER','Filtro');
DEFINE('_ORDER_DROPDOWN_DA','Data asc');
DEFINE('_ORDER_DROPDOWN_DD','Data desc');
DEFINE('_ORDER_DROPDOWN_TA','Título asc');
DEFINE('_ORDER_DROPDOWN_TD','Título desc');
DEFINE('_ORDER_DROPDOWN_HA','Acessos asc');
DEFINE('_ORDER_DROPDOWN_HD','Acessos desc');
DEFINE('_ORDER_DROPDOWN_AUA','Autor asc');
DEFINE('_ORDER_DROPDOWN_AUD','Autor desc');
DEFINE('_ORDER_DROPDOWN_O','Ordem');

/** poll.php */
DEFINE('_ALERT_ENABLED','Cookies devem esta habilitados!');
DEFINE('_ALREADY_VOTE','Você já votou nesta enquete hoje!');
DEFINE('_NO_SELECTION','Por favor, escolha uma das opções disponíveis e tente novamente');
DEFINE('_THANKS','Agradecemos seu voto');
DEFINE('_SELECT_POLL','Selecione uma enquete na lista');

/** classes/html/poll.php */
DEFINE('_JAN','Janeiro');
DEFINE('_FEB','Fevereiro');
DEFINE('_MAR','Março');
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
DEFINE('_SURVEY_TITLE','Título da Enquete:');
DEFINE('_NUM_VOTERS','Número de votos');
DEFINE('_FIRST_VOTE','Primeiro Voto');
DEFINE('_LAST_VOTE','Último Voto');
DEFINE('_SEL_POLL','Selecione a Enquete:');
DEFINE('_NO_RESULTS','Não há resultados para esta enquete.');

/** registration.php */
DEFINE('_ERROR_PASS','Sinto muito, não foi encontrado usuário correspondente');
DEFINE('_NEWPASS_MSG',' conta de usuário $checkusername tem este e-mail associado a ela.\n'
.'Um usuário de $mosConfig_live_site acabou de requerer que uma nova senha seja enviada.\n\n'
.' Sua Nova Senha é: $newpass\n\nSe você não a solicitou, não se preocupe.'
.' Somente você está recebendo esta mensagem, e caso a mesma tenha sido enviada por engano, basta efetuar o login com a'
.' nova Senha e alterá-la para uma de sua preferência.');
DEFINE('_NEWPASS_SUB','$_sitename :: Nova senha para - $checkusername');
DEFINE('_NEWPASS_SENT','Nova Senha criada e enviada!');
DEFINE('_REGWARN_NAME','Por favor, informe seu Nome.');
DEFINE('_REGWARN_UNAME','Por favor, informe seu Nome de Usuário.');
DEFINE('_REGWARN_MAIL','Por favor, informe um endereço de e-mail válido.');
DEFINE('_REGWARN_PASS','Por favor, informe uma senha válida. Sem espaços, com mais de 6 caracteres e contendo apenas 0-9,a-z,A-Z');
DEFINE('_REGWARN_VPASS1','Por favor, confirme a senha.');
DEFINE('_REGWARN_VPASS2','A senha e sua confirmação não coincidem. Por favor, tente novamente.');
DEFINE('_REGWARN_INUSE','Esse nome de usuário já está sendo usado por outra pessoa. Por favor, tente outro.');
DEFINE('_REGWARN_EMAIL_INUSE', 'Este e-mail já está cadastrado. Se você esqueceu a senha clique em "Perdeu sua senha?" e uma nova senha será enviada para você.');
DEFINE('_SEND_SUB','Detalhes da Conta para %s no %s');
DEFINE('_USEND_MSG_ACTIVATE', 'Olá %s,

Agradecemos por ter se cadastrado no site %s. Sua conta está criada e deve ser ativada antes que você possa usá-la.
Para ativar a conta clique no seguinte link ou copie-cole no seu navegador:
%s

Depois da ativação você pode efetuar login no %s utilizando os seguintes Nome de Usuário e Senha:

Nome de Usuário - %s
Senha - %s');
DEFINE('_USEND_MSG', "Olá %s,

Agradecemos por ter se cadastrado no site %s.

Você pode agora efetuar o login no %s utilizando o Nome de Usuário e Senha com as quais você se registrou.");
DEFINE('_USEND_MSG_NOPASS','Olá $name,\n\nVocê foi incluído como usuário do site $mosConfig_live_site.\n'
.'Você pode agora efetuar o login no $mosConfig_live_site utilizando o Nome de Usuário e Senha com as quais você se registrou.\n\n'
.'Por favor, não responda a esta mensagem pois a mesma foi gerada automaticamente pelo sistema apenas com caráter informativo\n');
DEFINE('_ASEND_MSG','Olá %s,

Um novo usuário se registrou no site %s.
Este e-mail contém os detalhes deste usuário:

Nome - %s
E-mail - %s
Nome de Usuário - %s

Por favor, não responda a esta mensagem pois a mesma foi gerada automaticamente pelo sistema apenas com caráter informativo');
DEFINE('_REG_COMPLETE_NOPASS','<div class="componentheading">Cadastro efetuado com sucesso!</div><br />&nbsp;&nbsp;'
.'Você pode agora efetuar o login.<br />&nbsp;&nbsp;');
DEFINE('_REG_COMPLETE', '<div class="componentheading">Cadastro efetuado com sucesso!</div><br />Você agora pode efetuar o  login.');
DEFINE('_REG_COMPLETE_ACTIVATE', '<div class="componentheading">Cadastro efetuado com sucesso!</div><br />Sua conta foi criada e um endereço para ativação foi enviado para o e-mail informado em seu cadastro. Você deve ativar sua conta clicando no link de ativação enviado no e-mail antes de poder efetuar o login no site.');
DEFINE('_REG_ACTIVATE_COMPLETE', '<div class="componentheading">Ativação efetuada com sucesso!</div><br />Sua conta foi ativada com sucesso. Você pode agora efetuar o login no site utilizando o Nome de Usuário e a Senha com os quais você se cadastrou.');
DEFINE('_REG_ACTIVATE_NOT_FOUND', '<div class="componentheading">Endereço de Ativação Inválido!</div><br />Não existe esta conta em nosso banco de dados ou a mesma já foi ativada.');
DEFINE('_REG_ACTIVATE_FAILURE', '<div class="componentheading">Falha na Ativação!</div><br />O sistema não pode ativar sau conta, por favor contacte o administrador do site.');

/** classes/html/registration.php */
DEFINE('_PROMPT_PASSWORD','Perdeu sua senha?');
DEFINE('_NEW_PASS_DESC','Por favor, informe seu Nome de Usuário e E-mail e clique no botão Enviar Senha.<br />'
.'Você receberá uma nova senha brevemente.  Utilize a nova senha para acessar o site.');
DEFINE('_PROMPT_UNAME','Nome de Usuário:');
DEFINE('_PROMPT_EMAIL','Endereço de E-mail:');
DEFINE('_BUTTON_SEND_PASS','Enviar Senha');
DEFINE('_REGISTER_TITLE','Cadastro');
DEFINE('_REGISTER_NAME','Nome:');
DEFINE('_REGISTER_UNAME','Nome de usuário:');
DEFINE('_REGISTER_EMAIL','E-mail:');
DEFINE('_REGISTER_PASS','Senha:');
DEFINE('_REGISTER_VPASS','Confirmação de senha:');
DEFINE('_REGISTER_REQUIRED','Os campos assinalados com asterisco (*) são obrigatórios.');
DEFINE('_BUTTON_SEND_REG','Enviar cadastro');
DEFINE('_SENDING_PASSWORD','Sua senha será enviada para o endereço de e-mail acima.<br />Uma vez você tenha recebido sua'
.' nova senha você poderá efetuar o login e alterá-la.');

/** classes/html/search.php */
DEFINE('_SEARCH_TITLE','Pesquisar');
DEFINE('_PROMPT_KEYWORD','Pesquisar palavra chave');
DEFINE('_SEARCH_MATCHES','retornou %d ocorrências');
DEFINE('_CONCLUSION','Foram encontrados $totalRows ocorrências.  Pesquisa por [ <b>$searchword</b> ] com');
DEFINE('_NOKEYWORD','Nenhum resultado encontrado');
DEFINE('_IGNOREKEYWORD','Uma ou mais palavras comuns foram ignoradas durante a pesquisa');
DEFINE('_SEARCH_ANYWORDS','Qualquer das palavras');
DEFINE('_SEARCH_ALLWORDS','Todas as palavras');
DEFINE('_SEARCH_PHRASE','Frase exata');
DEFINE('_SEARCH_NEWEST','Mais recentes primeiro');
DEFINE('_SEARCH_OLDEST','Mais antigos primeiro');
DEFINE('_SEARCH_POPULAR','Mais acessados');
DEFINE('_SEARCH_ALPHABETICAL','Alfabética');
DEFINE('_SEARCH_CATEGORY','Seção/Categoria');
DEFINE('_SEARCH_MESSAGE','Pesquisa deve ser feita por palavras de no mínimo 3 letras e máximo de 20 letras');
DEFINE('_SEARCH_ARCHIVED','Arquivado');
DEFINE('_SEARCH_CATBLOG','Blog Categoria');
DEFINE('_SEARCH_CATLIST','Lista de Categoria');
DEFINE('_SEARCH_NEWSFEEDS','Newsfeeds');
DEFINE('_SEARCH_SECLIST','Lista de Seção');
DEFINE('_SEARCH_SECBLOG','Blog de Seção');


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
DEFINE('_UMENU_TITLE','Menu do Usuário');
DEFINE('_HI','Oi, ');

/** user.php */
DEFINE('_SAVE_ERR','Por favor complete todos os campos.');
DEFINE('_THANK_SUB','Agradecemos sua colaboração. Um de nossos editores irá revisar seu texto e publicá-lo no site assim que possível.');
DEFINE('_THANK_SUB_PUB','Agradecemos sua colaboração.');
DEFINE('_UP_SIZE','Não é possível enviar arquivos com mais de 15kb.');
DEFINE('_UP_EXISTS','Já existe uma imagem chamada $userfile_name. Por favor, renomeie o arquivo e tente novamente.');
DEFINE('_UP_COPY_FAIL','Erro ao copiar');
DEFINE('_UP_TYPE_WARN','Você somente pode enviar imagens gif ou jpg.');
DEFINE('_MAIL_SUB','Sugestão de Usuário');
DEFINE('_MAIL_MSG','Olá $adminName,\n\n\n Foi enviado $type:\n [ $title ]\n pelo usuário:\n [ $author ]\n'
.' para o site $mosConfig_live_site.\n\n\n\n'
.'Por favor, vá ao endereço $mosConfig_live_site/administrator para ver e aprovar este $type.\n\n'
.'Por favor, não responda a esta mensagem pois a mesma foi gerada automaticamente pelo sistema apenas com caráter informativo\n');
DEFINE('_PASS_VERR1','Se estiver alterando sua senha, por favor, digite-a novamente para confirmação.');
DEFINE('_PASS_VERR2','Se estiver alterando sua senha, certifique-se de que a senha e sua confirmação sejam idênticas.');
DEFINE('_UNAME_INUSE','Este Nome de Usuário já está sendo utilizado.');
DEFINE('_UPDATE','Atualizar');
DEFINE('_USER_DETAILS_SAVE','Suas configurações foram salvas.');
DEFINE('_USER_LOGIN','Login do Usuário');

/** components/com_user */
DEFINE('_EDIT_TITLE','Alterar seu cadastro');
DEFINE('_YOUR_NAME','Seu Nome:');
DEFINE('_EMAIL','e-mail:');
DEFINE('_UNAME','Nome de Usuário:');
DEFINE('_PASS','Senha:');
DEFINE('_VPASS','Confirmação de senha:');
DEFINE('_SUBMIT_SUCCESS','Enviado com Sucesso!');
DEFINE('_SUBMIT_SUCCESS_DESC','Sua colaboração foi enviada para a administração do site e será revisada antes de ser publicada.');
DEFINE('_WELCOME','Bem-vindo!');
DEFINE('_WELCOME_DESC','Bem-vindo à seção do usuário de nosso site');
DEFINE('_CONF_CHECKED_IN','Itens marcados como Revisados têm agora o status Revisar');
DEFINE('_CHECK_TABLE','Verificando Tebela');
DEFINE('_CHECKED_IN','Revisar ');
DEFINE('_CHECKED_IN_ITEMS',' itens');
DEFINE('_PASS_MATCH','As senhas não coincidem');

/** components/com_banners */
DEFINE('_BNR_CLIENT_NAME','Você deve informar um nome para o cliente.');
DEFINE('_BNR_CONTACT','Você deve informar um contato para o cliente.');
DEFINE('_BNR_VALID_EMAIL','Você deve informar um e-mail válido para o cliente.');
DEFINE('_BNR_CLIENT','Você deve informar um cliente,');
DEFINE('_BNR_NAME','Você deve informar um nome para o banner.');
DEFINE('_BNR_IMAGE','Você deve informar uma imagem para o banner.');
DEFINE('_BNR_URL','Você deve informar um endereço e/ou um código personalizado (script) para o banner.');

/** components/com_login */
DEFINE('_ALREADY_LOGIN','Você já efetuou o login!');
DEFINE('_LOGOUT','Clique aqui para sair');
DEFINE('_LOGIN_TEXT','Utilize os campos Nome de Usuário e Senha ao lado para obter acesso total');
DEFINE('_LOGIN_SUCCESS','Você realizou o login com sucesso');
DEFINE('_LOGOUT_SUCCESS','Você saiu do sistema com sucesso');
DEFINE('_LOGIN_DESCRIPTION','Para poder acessar a área privativa deste site, por favor, efetue o login');
DEFINE('_LOGOUT_DESCRIPTION','Você está logado na área privativa deste site');


/** components/com_weblinks */
DEFINE('_WEBLINKS_TITLE','Links');
DEFINE('_WEBLINKS_DESC','Escolha uma das categorias de links abaixo, depois selecione uma URL para visitar o site.');
DEFINE('_HEADER_TITLE_WEBLINKS','Link');
DEFINE('_SECTION','Seção:');
DEFINE('_SUBMIT_LINK','Sugerir um link');
DEFINE('_URL','URL:');
DEFINE('_URL_DESC','Descrição:');
DEFINE('_NAME','Nome:');
DEFINE('_WEBLINK_EXIST','Já há um link com este título. Por favor, tente novamente.');
DEFINE('_WEBLINK_TITLE','O link deve conter um título.');

/** components/com_newfeeds */
DEFINE('_FEED_NAME','Nome da fonte');
DEFINE('_FEED_ARTICLES','# Artigos');
DEFINE('_FEED_LINK','Link da Fonte');

/** whos_online.php */
DEFINE('_WE_HAVE', 'Nós temos ');
DEFINE('_AND', ' e ');
DEFINE('_GUEST_COUNT','%s visitante');
DEFINE('_GUESTS_COUNT','%s visitantes');
DEFINE('_MEMBER_COUNT','%s membro');
DEFINE('_MEMBERS_COUNT','%s membros');
DEFINE('_ONLINE',' online');
DEFINE('_NONE','Nenhum usuário Online');

/** modules/mod_banners */
DEFINE('_BANNER_ALT','Publicidade');

/** modules/mod_random_image */
DEFINE('_NO_IMAGES','Sem Imagens');

/** modules/mod_stats.php */
DEFINE('_TIME_STAT','Hora');
DEFINE('_MEMBERS_STAT','Membros');
DEFINE('_HITS_STAT','Acessos');
DEFINE('_NEWS_STAT','Notícias');
DEFINE('_LINKS_STAT','Links');
DEFINE('_VISITORS','Visitantes');

/** /adminstrator/components/com_menus/admin.menus.html.php */
DEFINE('_MAINMENU_HOME','* O 1o. item publicado neste menu [menu principal] é por padrão o `Início` deste site *');
DEFINE('_MAINMENU_DEL','* Você não pode `deletar` este menu porque ele é necessário para a operação adequada do Joomla! *');
DEFINE('_MENU_GROUP','* Alguns `Tipo de Menu` aparecem em mais de um grupo *');


/** administrators/components/com_users */
DEFINE('_NEW_USER_MESSAGE_SUBJECT', 'Detalhes do Novo Usuário' );
DEFINE('_NEW_USER_MESSAGE', 'Olá %s,


Você foi adicionado como um usuário do site %s pelo seu Administrador.

Este e-mail contem seu Nome de Usuário e Senha para que você possa acessar %s:

Nome de Usuário - %s
Senha - %s


Por favor, não responda a esta mensagem pois a mesma foi gerada automaticamente pelo sistema apenas com caráter informativo');

/** administrators/components/com_massmail */
DEFINE('_MASSMAIL_MESSAGE', "Este é um e-mail de '%s'

Mensagem:
" );


/** includes/pdf.php */
DEFINE('_PDF_GENERATED','Gerado:');
DEFINE('_PDF_POWERED','Powered by Joomla!');
?>