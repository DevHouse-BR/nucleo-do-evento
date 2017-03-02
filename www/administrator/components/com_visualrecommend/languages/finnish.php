<?php
/*********************************************
* VisualRecommend - Component                *
* Copyright (C) 2007 by Bernard Gilly        *
* --------- All Rights Reserved ------------ *      
* Homepage   : www.visualclinic.fr           *
* Version    : 1.1.0                         *
* License    : Creative Commons              *
* Finnish language file, dated 30.3.2007     *
* Author: Sami Haaranen                      *
* Homepage: http://www.joomlaportal.fi       *
*********************************************/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// CPANEL
DEFINE("_VRECOMMEND_CPL_CONFIG","Asetukset");
DEFINE("_VRECOMMEND_CPL_TRACKING","Seuranta");
DEFINE("_VRECOMMEND_CPL_EXPORTALL","Tuo Kaikki Sähköpostiosoitteet");
DEFINE("_VRECOMMEND_CPL_EXPORTREPLY","Tuo Luetut Sähköpostiosoitteet ");
DEFINE("_VRECOMMEND_CPL_STATS","Statistiikka");
DEFINE("_VRECOMMEND_CPL_PURGE","Poista kaikki");
DEFINE("_VRECOMMEND_CPL_ABOUT","Tietoja");

// ADMIN
DEFINE("_VRECOMMEND_NOTWRITING","Config tiedosto ei ole kirjoitettavissa!");
DEFINE("_VRECOMMEND_SAVESETTINGS","Asetukset tallennettu");
DEFINE("_VRECOMMEND_SETTINGS","Asetukset");
DEFINE("_VRECOMMEND_TRACKINGDELETED","seuranta poistettu");
DEFINE("_VRECOMMEND_NODATAFOREXPORT","Ei dataa vientiin.");
DEFINE("_VRECOMMEND_CSVNOTWRITING","CSV ei ole kirjoitettavissa!");
DEFINE("_VRECOMMEND_EXPORTEMAILSTOCSV","Vie sähköpostiosoitteet CSV tiedostoon");
DEFINE("_VRECOMMEND_EXPORTCSV","Vie CSV");

// ADMIN TAB SETTINGS
DEFINE("_VRECOMMEND_GENERALSETTING","Perus asetukset");
DEFINE("_VRECOMMEND_GENERAL","Yleinen");
DEFINE("_VRECOMMEND_REGISTEREDONLY","Rekisteröityneet käyttäjät");
DEFINE("_VRECOMMEND_ALLOWREGISTERED","Salli vain rekisteröityneiden käyttäjien suositella artikkelia ?");
DEFINE("_VRECOMMEND_LINK_TO_CB","Linkki Community Builderin käyttäjän profiiliin");
DEFINE("_VRECOMMEND_LINK_TO_CB_DETAIL","Vain rekisteröityneille käyttäjille, lisää linkki Community Builder profiiliin suosituksessa.");
DEFINE("_VRECOMMEND_MAXRECOMMENDSENDING","Maximi määrä suosituksia kerralla");
DEFINE("_VRECOMMEND_MAXDAILYRECOMMEND","Maximi määrä päivässä suosituksia/käyttäjä");
DEFINE("_VRECOMMEND_UNLIMITED","Rajoittamaton");
DEFINE("_VRECOMMEND_USERCUSTOMMESSAGE","Käyttäjän viesti");
DEFINE("_VRECOMMEND_SHOWFORM","Näytä lomake");
DEFINE("_VRECOMMEND_NORMAL","normaali");
DEFINE("_VRECOMMEND_POPUP","popup-ikkuna");
DEFINE("_VRECOMMEND_CUSTOMYOURPOPUP","Muokkaa popup:ia");
DEFINE("_VRECOMMEND_WIDTH","Leveys");
DEFINE("_VRECOMMEND_HEIGHT","Korkeus");
DEFINE("_VRECOMMEND_ACTIVATEADSENSE","Näytä Google Adsense");
DEFINE("_VRECOMMEND_SETTINGADSENSEDESCRIPTION","Google Adsense:n asetukset viimeisessä sarkaimessa.");
DEFINE("_VRECOMMEND_POSITIONADSENSE","Sijainti");
DEFINE("_VRECOMMEND_TOP","Ylin");
DEFINE("_VRECOMMEND_BOTTOM","Alin");
DEFINE("_VRECOMMEND_BOTH","Molemmat");
DEFINE("_VRECOMMEND_AD_FORMAT","Koko");

// ADMIN TAB PLUGIN
DEFINE("_VRECOMMEND_PLUGIN","Plugini");
DEFINE("_VRECOMMEND_CHOOSEMODEOPERATING","Valitse pää toiminto muoto");
DEFINE("_VRECOMMEND_MODEOPERATING","Pää toiminto muodot");
DEFINE("_VRECOMMEND_INDIVIDUALCOMMANDBOT","Manuaalinen : käytä yksilöllistä bot komentoa");
DEFINE("_VRECOMMEND_CHOOSEFROMSECTIONBELOW","Automaattinen : valitse allaolevista aihepiireistä");
DEFINE("_VRECOMMEND_DEF_MODEOPERATING","Yksilöllisellä plugin komennolla {visualrecommend} voit valita minkä tahansa salliaksesi suositukset tai ei jokaiseen artikkeliin yksilöllisesti. Käytettäessä toista vaihtoehtoa voit sallia suositukset on/off valmiina olevista aihepiireistä.");
DEFINE("_VRECOMMEND_SECTIONSAVAILABLE","Käytettävissä olevat aihepiirit");
DEFINE("_VRECOMMEND_DEF_SECTIONSAVAILABLE","Jos käytät toista toiminto muotoa , voit valita tässä aihepiirit joita käytetään suositus toiminnoissa. Useiden aihepiirien valinta on mahdollista.");
DEFINE("_VRECOMMEND_ONLYONFULLTEXT","Näytä vain täydessä artikkelissa");
DEFINE("_VRECOMMEND_BOTH_INDIVIDUALTAG_AND_SECTIONBELOW","Semi-automaattinen : yksilöllinen botit ja aihepiirit alla");
DEFINE("_VRECOMMEND_STATICCONTENTS","Staattinen sisältö");
DEFINE("_VRECOMMEND_STYLECSS","CSS luokka");
DEFINE("_VRECOMMEND_STYLECSSDESCRIPTION","Valinnainen: määrittele CSS luokan nimi jota käytetään linkissä (esim. readon tai small...)");

// ADMIN TAB MAIL
DEFINE("_VRECOMMEND_MAIL","Sähköposti");
DEFINE("_VRECOMMEND_MAILSETTINGS","Sähköposti viestien asetukset");
DEFINE("_VRECOMMEND_MAILSUBJECT","Viestin aihe");
DEFINE("_VRECOMMEND_MAILMESSAGEBODY","Viestin teksti");
DEFINE("_VRECOMMEND_AVAILABLE_TAGS","Käytössä olevat tagit:");
// ADMIN TAB MISCELLENAEOUS
DEFINE("_VRECOMMEND_MISCELLANEOUS","Sekalaiset");
DEFINE("_VRECOMMEND_AWARDS","Pisteytys (vain rekisteröityneille käyttäjille)");
DEFINE("_VRECOMMEND_POINTS_BY_SENT_MAIL","Pisteet lähetettyä sähköpostia kohden");
DEFINE("_VRECOMMEND_POINTS_ON_POSITIVE_RECOMMEND","Pisteet luettua suositusta kohden");

// ADMIN TAB ADSENSE
DEFINE("_VRECOMMEND_TAB_GOOGLEADSENSE","Adsense");
DEFINE("_VRECOMMEND_SETTINGSADSENSE","Google Adsense asetukset");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT","Mainoksen Tasaus");
DEFINE("_VRECOMMEND_ADS_LEFT","Vasen");
DEFINE("_VRECOMMEND_ADS_RIGHT","Oikea");
DEFINE("_VRECOMMEND_ADS_CENTER","Keskellä");
DEFINE("_VRECOMMEND_ADS_NONE","Ei mitään");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT_DESC","Valitse mainoksen tasaus jonka haluat. Jos jokin valinta hajoittaa sivupohjasi ulkoasua, valitse Ei mitään");
DEFINE("_VRECOMMEND_ADS_ID","Asiakas ID");
DEFINE("_VRECOMMEND_ADS_ID_DESC","Anna Google Adsense -ohjelman toimittama asiakastunnuksesi. Tekijöiden Adsense ID -tunnusta käytetään oletustunnuksena.");
DEFINE("_VRECOMMEND_ADS_CHANNEL","Mainoksen Kanava");
DEFINE("_VRECOMMEND_ADS_CHANNEL_DESC","Kirjoita kanava ID jonka olet asettanut Google AdSensen Ylläpito asetuksissa. On suositeltavaa sijoittaa kanaviin jotka tuottavat sinulle parhaiten.");
DEFINE("_VRECOMMEND_ADS_TYPE","Mainoksen Tyyli");
DEFINE("_VRECOMMEND_ADS_TYPE_DESC","Valitse mainoksen tyyli jonka haluat näyttää sivuillasi. Jos valitset Kuva Mainos vaihtoehdon, ole hyvä ja käytä vain näitä kokoja: 728X90 - Leaderboard, 468X60 - Banner, 300X250 - Medium Rectangle, 160X600 - Wide Skyscraper and 120X600 - Skyscraper.");
DEFINE("_VRECOMMEND_ADS_TYPE_DEFAULTACCOUNT","Käytä minun oletus tili asetuksia");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTONLY","Vain teksti");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTANDIMAGE","Teksti ja kuva");
DEFINE("_VRECOMMEND_ADS_TYPE_IMAGEONLY","Vain kuva");
DEFINE("_VRECOMMEND_ADS_ALTERNATE","Vaihtoehtoisen Mainoksen URL");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_DESC","Vaihtoehtoisen mainoksen URL kun määriteltyjä muita mainoksia ei ole saatavilla. Vaihtoehtoisesti, kirjoita vain http:// jolloin ei tule vaihtoehtoista mainosta. Mutta miksi et käyttäisi vaihtoehtoista mainosta kun tämä valinta on käytetävissä?");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR","Vaihtoehtoinen Väri");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR_DESC","Vaihtoehtoinen väri kun mainoksia ei ole saatavilla, hex:na, ilman #");
DEFINE("_VRECOMMEND_INHEXWHITOUT","Hex:inä, ilman # (esim. FFFFFF)");
DEFINE("_VRECOMMEND_ADS_BORDER_COLOR","Kehysten väri");
DEFINE("_VRECOMMEND_ADS_BACKGROUND_COLOR","Tausta väri");
DEFINE("_VRECOMMEND_ADS_LINK_COLOR","Linkin väri");
DEFINE("_VRECOMMEND_ADS_URL_COLOR","Url:n väri");
DEFINE("_VRECOMMEND_ADS_TEXT_COLOR","Linkin väri");

// ADMIN TRACKING
DEFINE("_VRECOMMEND_TRACKING","Seuranta");
DEFINE("_VRECOMMEND_TITLE","Artikkeli");
DEFINE("_VRECOMMEND_ID","ID");
DEFINE("_VRECOMMEND_RECOMMENDS_USERS","Suositukset / Käyttäjät");
DEFINE("_VRECOMMEND_LASTRECOMMEND","Viimeksi suositeltu");
DEFINE("_VRECOMMEND_SENDINGS","Lähetetty");
DEFINE("_VRECOMMEND_SHOWTRACKING","Näytä seuranta");
DEFINE("_VRECOMMEND_STATISTICS", "{numvisitor} käyttäjä(ä)on suositellut {numfriend} ystävää lukemaan {numarticle} artikkelia");

// ADMIN SHOW DETAIL TRACKING
DEFINE("_VRECOMMEND_DATE","Päivä");
DEFINE("_VRECOMMEND_NAME","Nimi");
DEFINE("_VRECOMMEND_IP","IP");
DEFINE("_VRECOMMEND_MAILS","Sähköpostiosoite(et)");
DEFINE("_VRECOMMEND_REPLY","Luettu");
DEFINE("_VRECOMMEND_POSITIVES_MAILS","Myönteinen sähköpostiosoite(et)");

// STATISTICS
DEFINE("_VRECOMMEND_TOP_10","Top 10");
DEFINE("_VRECOMMEND_MOST_ACTIVE_REGISTERED_USERS","Aktiivisinta rekisteröitynyttä käyttäjää");
DEFINE("_VRECOMMEND_BEST_POINTS","Parhaat pisteet");
DEFINE("_VRECOMMEND_MOST_ITEM_RECOMMENDED","Parhaiten suositeltua kohdetta");
DEFINE("_VRECOMMEND_LAST_POSITIVE_REPLY","Viimeisintä positiivista vastausta");
DEFINE("_VRECOMMEND_STATS_RECOMMEND","suositus(ta)");
DEFINE("_VRECOMMEND_CONFIRMED","vahvistettu");

// COMMON
DEFINE("_VRECOMMEND_FILTER","Filtteri");
DEFINE("_VRECOMMEND_CLOSE","Sulje");
DEFINE("_VRECOMMEND_BACK","Takaisin");
DEFINE("_VRECOMMEND_POINTS","Pisteet");
DEFINE("_VRECOMMEND_REGISTERED","Rekisteröitynyt");
DEFINE("_VRECOMMEND_GUEST","Vieras");

// ADMIN ABOUT
DEFINE("_VRECOMMEND_ABOUT","Tietoja");

// FRONT-END
DEFINE("_VRECOMMEND_RECOMMEND","Suosittele tätä artikkelia...");
DEFINE("_VRECOMMEND_RECOMMEND_FORM","Lähetä tämä artikkeli ystävällesi...");
DEFINE("_VRECOMMEND_YOURFRIENDNAME","Ystävän nimi/nimet");
DEFINE("_VRECOMMEND_YOURFRIENDEMAILADRESS","Ystävän/ystävien sähköpostiosoite(et)");
DEFINE("_VRECOMMEND_YOURNAME","Nimesi (pakollinen)");
DEFINE("_VRECOMMEND_YOUREMAILADDRESS","Sähköpostiosoitteesi (pakollinen)");
DEFINE("_VRECOMMEND_MESSAGEADDEDATYOURRECOMMEND","Lisää viesti suositukseesi (valinnainen):");
DEFINE("_VRECOMMEND_SUBMIT","Lähetä");
DEFINE("_VRECOMMEND_ADDEMAIL","Lisää sähköpostiosoite(et)");
DEFINE("_VRECOMMEND_REMOVEEMAIL","Poista sähköpostiosoite(et)");
DEFINE("_VRECOMMEND_FRIENDEMAILERROR","Virhe ystävän sähköpostiosoitteessa");
DEFINE("_VRECOMMEND_FRIENDNAMEERROR","Virhe ystävän nimessä");
DEFINE("_VRECOMMEND_NAME_ERROR","Virhe nimessäsi");
DEFINE("_VRECOMMEND_ONLYREGISTERED","Vain rekisteröityneet käyttäjät voivat suositella artikkelia.<br />Ole hyvä ja kirjaudu tai rekisteröidy.");
DEFINE("_VRECOMMEND_MAXDAILYEXCEEDED","Ylitit maximi määrän lähetyksissä per päivä, et voi lähettää uusia viestejä enään.");
DEFINE("_VRECOMMEND_SENDINGSRELEASED","Viesti(ä) lähetetty. Kiitos suosituksestasi");
DEFINE("_VRECOMMEND_NOSENDINGRELEASED","Viestiä(jä) ei voitu lähettää. Tarkista ystävän/ystävien sähköpostiosoite(et).");
DEFINE("_VRECOMMEND_TO_REDUCE","Karsi");
DEFINE("_VRECOMMEND_GOTO_ARTICLE","Takaisin artikkeliin");
DEFINE("_VRECOMMEND_GOTO_PROFILE","Mene profiiliin"); // use with Community Builder
DEFINE("_VRECOMMEND_ADD_LINK_PROFILE","lisää linkki profiiliini"); // use with Community Builder
?>