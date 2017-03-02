<?php
/*********************************************
* VisualRecommend - Component                *
* Copyright (C) 2007 by Bernard Gilly        *
* --------- All Rights Reserved ------------ *      
* Homepage   : www.visualclinic.fr           *
* Version    : 1.1.0                         *
* License    : Creative Commons              *
*********************************************/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// CPANEL
DEFINE("_VRECOMMEND_CPL_CONFIG","Settings");
DEFINE("_VRECOMMEND_CPL_TRACKING","Tracking");
DEFINE("_VRECOMMEND_CPL_EXPORTALL","Export All Mails");
DEFINE("_VRECOMMEND_CPL_EXPORTREPLY","Export Reply Mails");
DEFINE("_VRECOMMEND_CPL_STATS","Stats");
DEFINE("_VRECOMMEND_CPL_PURGE","Purge all");
DEFINE("_VRECOMMEND_CPL_ABOUT","About");

// ADMIN
DEFINE("_VRECOMMEND_NOTWRITING","Config file not writeable!");
DEFINE("_VRECOMMEND_SAVESETTINGS","Settings saved");
DEFINE("_VRECOMMEND_SETTINGS","Settings");
DEFINE("_VRECOMMEND_TRACKINGDELETED","tracking deleted");
DEFINE("_VRECOMMEND_NODATAFOREXPORT","No data to export.");
DEFINE("_VRECOMMEND_CSVNOTWRITING","CSV file not writeable!");
DEFINE("_VRECOMMEND_EXPORTEMAILSTOCSV","Export emails to CSV file");
DEFINE("_VRECOMMEND_EXPORTCSV","Export CSV");

// ADMIN TAB SETTINGS
DEFINE("_VRECOMMEND_GENERALSETTING","General settings");
DEFINE("_VRECOMMEND_GENERAL","General");
DEFINE("_VRECOMMEND_REGISTEREDONLY","Registered users");
DEFINE("_VRECOMMEND_ALLOWREGISTERED","Allow only registered users to recommend an article ?");
DEFINE("_VRECOMMEND_LINK_TO_CB","Link to Community Builder profile user");
DEFINE("_VRECOMMEND_LINK_TO_CB_DETAIL","On registered user only, add a link to Community Builder profile in the recommend.");
DEFINE("_VRECOMMEND_MAXRECOMMENDSENDING","Max sending recommends");
DEFINE("_VRECOMMEND_MAXDAILYRECOMMEND","Max daily recommends/user");
DEFINE("_VRECOMMEND_UNLIMITED","Unlimited");
DEFINE("_VRECOMMEND_USERCUSTOMMESSAGE","User custom message");
DEFINE("_VRECOMMEND_SHOWFORM","Show form");
DEFINE("_VRECOMMEND_NORMAL","normal");
DEFINE("_VRECOMMEND_POPUP","popup");
DEFINE("_VRECOMMEND_CUSTOMYOURPOPUP","Custom your popup");
DEFINE("_VRECOMMEND_WIDTH","Width");
DEFINE("_VRECOMMEND_HEIGHT","Height");
DEFINE("_VRECOMMEND_ACTIVATEADSENSE","Show Google Adsense");
DEFINE("_VRECOMMEND_SETTINGADSENSEDESCRIPTION","Settings Google Adsense on last tab.");
DEFINE("_VRECOMMEND_POSITIONADSENSE","Position");
DEFINE("_VRECOMMEND_TOP","Top");
DEFINE("_VRECOMMEND_BOTTOM","Bottom");
DEFINE("_VRECOMMEND_BOTH","Both");
DEFINE("_VRECOMMEND_AD_FORMAT","Format");

// ADMIN TAB PLUGIN
DEFINE("_VRECOMMEND_PLUGIN","Plugin");
DEFINE("_VRECOMMEND_CHOOSEMODEOPERATING","Choose Main Operating Mode");
DEFINE("_VRECOMMEND_MODEOPERATING","Main Operating Mode");
DEFINE("_VRECOMMEND_INDIVIDUALCOMMANDBOT","Manual : use individual bot command");
DEFINE("_VRECOMMEND_CHOOSEFROMSECTIONBELOW","Automatic : choose from sections below");
DEFINE("_VRECOMMEND_DEF_MODEOPERATING","With individual plugin command {visualrecommend} you can choose wether to allow recommends or not for every content item individually. Using second option for manual tag AND turn on/off for complete sections. Using the third option allows you to turn recommends on/off for complete sections.");
DEFINE("_VRECOMMEND_SECTIONSAVAILABLE","Sections available");
DEFINE("_VRECOMMEND_DEF_SECTIONSAVAILABLE","If you use second or third operating mode, you can choose here which sections should use recommend system. Multiple selections are possible.");
DEFINE("_VRECOMMEND_ONLYONFULLTEXT","Show only on Full Text");
DEFINE("_VRECOMMEND_BOTH_INDIVIDUALTAG_AND_SECTIONBELOW","Semi-automatic : individual bot and sections below");
DEFINE("_VRECOMMEND_STATICCONTENTS","Static contents");
DEFINE("_VRECOMMEND_STYLECSS","class CSS");
DEFINE("_VRECOMMEND_STYLECSSDESCRIPTION","Optional: define the CSS class name used by the link (example readon or small...)");

// ADMIN TAB MAIL
DEFINE("_VRECOMMEND_MAIL","Mail");
DEFINE("_VRECOMMEND_MAILSETTINGS","Mail settings");
DEFINE("_VRECOMMEND_MAILSUBJECT","Mail Subject");
DEFINE("_VRECOMMEND_MAILMESSAGEBODY","Mail Message Body");
DEFINE("_VRECOMMEND_AVAILABLE_TAGS","Available tags:");

// ADMIN TAB MISCELLENAEOUS
DEFINE("_VRECOMMEND_MISCELLANEOUS","Miscellaneous");
DEFINE("_VRECOMMEND_AWARDS","Awards (registered users only)");
DEFINE("_VRECOMMEND_POINTS_BY_SENT_MAIL","Points by sent mail");
DEFINE("_VRECOMMEND_POINTS_ON_POSITIVE_RECOMMEND","Points on positive recommend");

// ADMIN TAB ADSENSE
DEFINE("_VRECOMMEND_TAB_GOOGLEADSENSE","Adsense");
DEFINE("_VRECOMMEND_SETTINGSADSENSE","Settings Google Adsense");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT","Ads Alignment");
DEFINE("_VRECOMMEND_ADS_LEFT","Left");
DEFINE("_VRECOMMEND_ADS_RIGHT","Right");
DEFINE("_VRECOMMEND_ADS_CENTER","Center");
DEFINE("_VRECOMMEND_ADS_NONE","None");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT_DESC","Choose the ad alignment that you desire. If any choice disrupts your template orientation, choose none");
DEFINE("_VRECOMMEND_ADS_ID","Client ID");
DEFINE("_VRECOMMEND_ADS_ID_DESC","Please type your Client ID provided by Google AdSense. Authors AdSense ID is used as the default ID.");
DEFINE("_VRECOMMEND_ADS_CHANNEL","Ads Channel");
DEFINE("_VRECOMMEND_ADS_CHANNEL_DESC","Type the channel ID that you may have set in Google AdSense Admin options. It is advisable to assign a channel to track your earnings better.");
DEFINE("_VRECOMMEND_ADS_TYPE","Ads Type");
DEFINE("_VRECOMMEND_ADS_TYPE_DESC","Choose the ads types you would like to display on your page. If you are choosing Image Ads only option, plase use only these sizes: 728X90 - Leaderboard, 468X60 - Banner, 300X250 - Medium Rectangle, 160X600 - Wide Skyscraper and 120X600 - Skyscraper.");
DEFINE("_VRECOMMEND_ADS_TYPE_DEFAULTACCOUNT","Use my default account setting");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTONLY","Text only");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTANDIMAGE","Text and image");
DEFINE("_VRECOMMEND_ADS_TYPE_IMAGEONLY","Image only");
DEFINE("_VRECOMMEND_ADS_ALTERNATE","Alternate Ads URL");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_DESC","Alternate Ads URL to specify other ads when no ads are available. Alternatively, you may just type http:// for no alternate ads. But why not use alternate ads when you have that option?");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR","Alternate Color");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR_DESC","Alternate color when no ads are available, in hex, without #");
DEFINE("_VRECOMMEND_INHEXWHITOUT","In hex, without # (example FFFFFF)");
DEFINE("_VRECOMMEND_ADS_BORDER_COLOR","Border color");
DEFINE("_VRECOMMEND_ADS_BACKGROUND_COLOR","Background color");
DEFINE("_VRECOMMEND_ADS_LINK_COLOR","Link color");
DEFINE("_VRECOMMEND_ADS_URL_COLOR","Url color");
DEFINE("_VRECOMMEND_ADS_TEXT_COLOR","Link color");

// ADMIN TRACKING
DEFINE("_VRECOMMEND_TRACKING","Tracking");
DEFINE("_VRECOMMEND_TITLE","titre");
DEFINE("_VRECOMMEND_ID","ID");
DEFINE("_VRECOMMEND_RECOMMENDS_USERS","Recommends / Users");
DEFINE("_VRECOMMEND_LASTRECOMMEND","Last recommend");
DEFINE("_VRECOMMEND_SENDINGS","sendings");
DEFINE("_VRECOMMEND_SHOWTRACKING","Show tracking");
DEFINE("_VRECOMMEND_STATISTICS", "{numvisitor} visitors invited {numfriend} friends to read {numarticle} articles");

// ADMIN SHOW DETAIL TRACKING
DEFINE("_VRECOMMEND_DATE","Date");
DEFINE("_VRECOMMEND_NAME","Name");
DEFINE("_VRECOMMEND_IP","IP");
DEFINE("_VRECOMMEND_MAILS","Mail(s)");
DEFINE("_VRECOMMEND_REPLY","Reply");
DEFINE("_VRECOMMEND_POSITIVES_MAILS","Positive(s) mail(s)");

// STATISTICS
DEFINE("_VRECOMMEND_TOP_10","Top 10");
DEFINE("_VRECOMMEND_MOST_ACTIVE_REGISTERED_USERS","Most active registered users");
DEFINE("_VRECOMMEND_BEST_POINTS","Best points");
DEFINE("_VRECOMMEND_MOST_ITEM_RECOMMENDED","Most item recommended");
DEFINE("_VRECOMMEND_LAST_POSITIVE_REPLY","Last positive reply");
DEFINE("_VRECOMMEND_STATS_RECOMMEND","recommend(s)");
DEFINE("_VRECOMMEND_CONFIRMED","confirmed");


// COMMON
DEFINE("_VRECOMMEND_FILTER","Filtro");
DEFINE("_VRECOMMEND_CLOSE","[Fechar]");
DEFINE("_VRECOMMEND_BACK","Voltar");
DEFINE("_VRECOMMEND_POINTS","Pontos");
DEFINE("_VRECOMMEND_REGISTERED","Registrado");
DEFINE("_VRECOMMEND_GUEST","Convidado");

// ADMIN ABOUT
DEFINE("_VRECOMMEND_ABOUT","About");

// FRONT-END
DEFINE("_VRECOMMEND_RECOMMEND","Recomende este artigo...");
DEFINE("_VRECOMMEND_RECOMMEND_FORM","Mande este artigo para seus amigos...");
DEFINE("_VRECOMMEND_YOURFRIENDNAME","Nome do(s) seu(s) amigo(s)");
DEFINE("_VRECOMMEND_YOURFRIENDEMAILADRESS","Email do(s) seu(s) amigo(s)");
DEFINE("_VRECOMMEND_YOURNAME","Seu nome(*)");
DEFINE("_VRECOMMEND_YOUREMAILADDRESS","Seu endereзo de email (*)");
DEFINE("_VRECOMMEND_MESSAGEADDEDATYOURRECOMMEND","Mensagem:");
DEFINE("_VRECOMMEND_SUBMIT","Enviar");
DEFINE("_VRECOMMEND_ADDEMAIL","Adicionar email(s)");
DEFINE("_VRECOMMEND_REMOVEEMAIL","Remover email(s)");
DEFINE("_VRECOMMEND_FRIENDEMAILERROR","Erro no email do amigo");
DEFINE("_VRECOMMEND_FRIENDNAMEERROR","Erro no nome do amigo");
DEFINE("_VRECOMMEND_NAME_ERROR","Erro no seu nome");
DEFINE("_VRECOMMEND_ONLYREGISTERED","Apenas usuбrios registrados podem recomendar um artigo.<br />Por favor faзa o login ou registre-se.");
DEFINE("_VRECOMMEND_MAXDAILYEXCEEDED","Vocк excedeu a quota maxima de envios por dia, vocк nгo pode mais enviar mensagens.");
DEFINE("_VRECOMMEND_SENDINGSRELEASED","envios(s) liberados. Obrigado por sua recomendaзгo.");
DEFINE("_VRECOMMEND_NOSENDINGRELEASED","Nгo foi enviado. Verifique os emails dos seus amigos.");
DEFINE("_VRECOMMEND_TO_REDUCE","Para reduzir");
DEFINE("_VRECOMMEND_GOTO_ARTICLE","Vб para o artigo");
DEFINE("_VRECOMMEND_GOTO_PROFILE","Vб para o perfil de"); // use with Community Builder
DEFINE("_VRECOMMEND_ADD_LINK_PROFILE","adicionar link ao perfil"); // use with Community Builder
?>