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
defined( '_VALID_MOS' ) or die( 'A közvetlen hozzáférés ehhez a helyhez nem engedélyezett.' );

// CPANEL
DEFINE("_VRECOMMEND_CPL_CONFIG","Beállítások");
DEFINE("_VRECOMMEND_CPL_TRACKING","Követés");
DEFINE("_VRECOMMEND_CPL_EXPORTALL","Az összes levél exportálása");
DEFINE("_VRECOMMEND_CPL_EXPORTREPLY","A válaszok exportálása");
DEFINE("_VRECOMMEND_CPL_STATS","Statisztika");
DEFINE("_VRECOMMEND_CPL_PURGE","Az összes kiürítése");
DEFINE("_VRECOMMEND_CPL_ABOUT","Névjegy");

// ADMIN
DEFINE("_VRECOMMEND_NOTWRITING","Nem írható a konfigurációs fájl!");
DEFINE("_VRECOMMEND_SAVESETTINGS","A beállítások mentése kész");
DEFINE("_VRECOMMEND_SETTINGS","Beállítások");
DEFINE("_VRECOMMEND_TRACKINGDELETED","követés törlésre került");
DEFINE("_VRECOMMEND_NODATAFOREXPORT","Nincs exportálandó adat.");
DEFINE("_VRECOMMEND_CSVNOTWRITING","Nem írható a CSV fájl!");
DEFINE("_VRECOMMEND_EXPORTEMAILSTOCSV","Az emailek exportálása CSV fájlba");
DEFINE("_VRECOMMEND_EXPORTCSV","Exportálás CSV formátumba");

// ADMIN TAB SETTINGS
DEFINE("_VRECOMMEND_GENERALSETTING","Általános beállítások");
DEFINE("_VRECOMMEND_GENERAL","Általános");
DEFINE("_VRECOMMEND_REGISTEREDONLY","Regisztrált felhasználók");
DEFINE("_VRECOMMEND_ALLOWREGISTERED","Csak a regisztrált felhasználók számára engedélyezed a cikkajánlást?");
DEFINE("_VRECOMMEND_LINK_TO_CB","Hivatkozás a felhasználó Community Builder profiljára");
DEFINE("_VRECOMMEND_LINK_TO_CB_DETAIL","Csak a regisztrált felhasználóknál szúrja be az ajánlásba a Community Builder profilra mutató hivatkozást.");
DEFINE("_VRECOMMEND_MAXRECOMMENDSENDING","A küldhetõ ajánlások száma");
DEFINE("_VRECOMMEND_MAXDAILYRECOMMEND","A napi ajánlások száma felhasználónként");
DEFINE("_VRECOMMEND_UNLIMITED","Korlátlan");
DEFINE("_VRECOMMEND_USERCUSTOMMESSAGE","A felhasználó saját üzenete");
DEFINE("_VRECOMMEND_SHOWFORM","Az ûrlap megjelenítése");
DEFINE("_VRECOMMEND_NORMAL","szokásos módon");
DEFINE("_VRECOMMEND_POPUP","elõugró ablakban");
DEFINE("_VRECOMMEND_CUSTOMYOURPOPUP","Az elõugró ablak testreszabása");
DEFINE("_VRECOMMEND_WIDTH","Szélesség");
DEFINE("_VRECOMMEND_HEIGHT","Magasság");
DEFINE("_VRECOMMEND_ACTIVATEADSENSE","A Google AdSense hirdetések megjelenítése");
DEFINE("_VRECOMMEND_SETTINGADSENSEDESCRIPTION","A Google AdSense beállítása az utolsó fülön.");
DEFINE("_VRECOMMEND_POSITIONADSENSE","Elhelyezés");
DEFINE("_VRECOMMEND_TOP","Fent");
DEFINE("_VRECOMMEND_BOTTOM","Lent");
DEFINE("_VRECOMMEND_BOTH","Mindkettõ");
DEFINE("_VRECOMMEND_AD_FORMAT","Formátum");

// ADMIN TAB PLUGIN
DEFINE("_VRECOMMEND_PLUGIN","Beépülõ modul");
DEFINE("_VRECOMMEND_CHOOSEMODEOPERATING","Válaszd ki a fõ mûködési módot");
DEFINE("_VRECOMMEND_MODEOPERATING","Fõ mûködési mód");
DEFINE("_VRECOMMEND_INDIVIDUALCOMMANDBOT","Kézi : egyedi botparancs használata");
DEFINE("_VRECOMMEND_CHOOSEFROMSECTIONBELOW","Automatikus : választás az alábbi szekciókból");
DEFINE("_VRECOMMEND_DEF_MODEOPERATING","A {visualrecommend} egyedi beépülõ modul paranccsal választhatod ki, hogy minden tartalmi elem egyenkénti ajánlását engedélyezed-e. A második lehetõséggel teljes szekciókban kapcsolhatod be/ki az ajánlást.");
DEFINE("_VRECOMMEND_SECTIONSAVAILABLE","Létezõ szekciók");
DEFINE("_VRECOMMEND_DEF_SECTIONSAVAILABLE","Ha a második mûködési módot használod, akkor itt választhatod ki, hogy melyik szekciókban használható az ajánlórendszer. Többszörös kijelölésre is mód van.");
DEFINE("_VRECOMMEND_ONLYONFULLTEXT","Csak a teljes cikknél látható");
DEFINE("_VRECOMMEND_BOTH_INDIVIDUALTAG_AND_SECTIONBELOW","Félautomata : alábbi egyedi bot és szekciók");
DEFINE("_VRECOMMEND_STATICCONTENTS","Statikus tartalom");
DEFINE("_VRECOMMEND_STYLECSS","CSS-osztály");
DEFINE("_VRECOMMEND_STYLECSSDESCRIPTION","Elhagyható: a hivatkozás által használt CSS-osztály nevét határozza meg (például readon vagy kicsi...)");

// ADMIN TAB MAIL
DEFINE("_VRECOMMEND_MAIL","Levél");
DEFINE("_VRECOMMEND_MAILSETTINGS","Levél beállításai");
DEFINE("_VRECOMMEND_MAILSUBJECT","Az üzenet tárgya");
DEFINE("_VRECOMMEND_MAILMESSAGEBODY","Az üzenet szövege");
DEFINE("_VRECOMMEND_AVAILABLE_TAGS","Felhasználható címkék:");

// ADMIN TAB MISCELLENAEOUS
DEFINE("_VRECOMMEND_MISCELLANEOUS","Egyebek");
DEFINE("_VRECOMMEND_AWARDS","Díjak (csak regisztrált felhasználók számára)");
DEFINE("_VRECOMMEND_POINTS_BY_SENT_MAIL","Elküldött levelek alapján szerzett pontok");
DEFINE("_VRECOMMEND_POINTS_ON_POSITIVE_RECOMMEND","Pontok pozitív ajánlásért");

// ADMIN TAB ADSENSE
DEFINE("_VRECOMMEND_TAB_GOOGLEADSENSE","AdSense");
DEFINE("_VRECOMMEND_SETTINGSADSENSE","Google AdSense beállításai");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT","Hirdetések igazítása");
DEFINE("_VRECOMMEND_ADS_LEFT","Balra");
DEFINE("_VRECOMMEND_ADS_RIGHT","Jobbra");
DEFINE("_VRECOMMEND_ADS_CENTER","Középre");
DEFINE("_VRECOMMEND_ADS_NONE","Nincs");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT_DESC","Válaszd ki a hirdetések tetszés szerinti igazítását. Ha valamelyik választásod megtöri a sablon elrendezését, ne válaszd egyiket sem");
DEFINE("_VRECOMMEND_ADS_ID","Ügyfél azonosítószáma");
DEFINE("_VRECOMMEND_ADS_ID_DESC","Kérjük, hogy írd be a Google AdSense ügyfélazonosítódat. A szerzõk AdSense azonosítója kerül alapértelmezett azonosítóként felhasználásra.");
DEFINE("_VRECOMMEND_ADS_CHANNEL","Hirdetõcsatorna");
DEFINE("_VRECOMMEND_ADS_CHANNEL_DESC","Írd be azt a csatornaazonosítót, amit a Google AdSense adminisztrációjában megadtál. Tanácsos csatornát hozzárendelni, mert így jobban nyomon követheted, hogy mennyit kerestél.");
DEFINE("_VRECOMMEND_ADS_TYPE","Hirdetések típusa");
DEFINE("_VRECOMMEND_ADS_TYPE_DESC","Válaszd ki az oldaladon megjelenítendõ hirdetési típusokat. Ha csak a Képes hirdetések lehetõséget választod, akkor csak a következõ méreteket használd: 728x90 - Leaderboard, 468x60 - Reklámszalag, 300x250 - Közepes négyszög, 160x600 - Széles felhõarcoló és 120x600 - Felhõkarcoló.");
DEFINE("_VRECOMMEND_ADS_TYPE_DEFAULTACCOUNT","Az alapértelmezett fiókbeállításaim használata");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTONLY","Csak szöveg");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTANDIMAGE","Szöveg és kép");
DEFINE("_VRECOMMEND_ADS_TYPE_IMAGEONLY","Csak kép");
DEFINE("_VRECOMMEND_ADS_ALTERNATE","Helyettesítõ hirdetések URL-je");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_DESC","A helyettesítõ hirdetések URL-je más hirdetések megadásához, amikor nincs egy hirdetés sem. Vagy pedig beírhatod csak a http:// -t, ha nincsenek helyettesítõ hirdetések. De miért ne használnád a helyettesítõ hirdetéseket, ha van rá lehetõség?");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR","Helyettesítõ szín");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR_DESC","A helyettesítõ szín, ha nincs egy hirdetés sem, hexa értékben, # nélkül");
DEFINE("_VRECOMMEND_INHEXWHITOUT","Hexadecimális érték, # nélkül (pl.: FFFFFF)");
DEFINE("_VRECOMMEND_ADS_BORDER_COLOR","Szegély színe");
DEFINE("_VRECOMMEND_ADS_BACKGROUND_COLOR","Háttér színe");
DEFINE("_VRECOMMEND_ADS_LINK_COLOR","Hivatkozás színe");
DEFINE("_VRECOMMEND_ADS_URL_COLOR","URL színe");
DEFINE("_VRECOMMEND_ADS_TEXT_COLOR","Hivatkozás színe");

// ADMIN TRACKING
DEFINE("_VRECOMMEND_TRACKING","Követés");
DEFINE("_VRECOMMEND_TITLE","Cím");
DEFINE("_VRECOMMEND_ID","AZ");
DEFINE("_VRECOMMEND_RECOMMENDS_USERS","Ajánlások / Felhasználók");
DEFINE("_VRECOMMEND_LASTRECOMMEND","Utolsó ajánlás");
DEFINE("_VRECOMMEND_SENDINGS","küldés");
DEFINE("_VRECOMMEND_SHOWTRACKING","Követés megjelenítése");
DEFINE("_VRECOMMEND_STATISTICS", "{numvisitor} látogató {numfriend} ismerõsét hívta meg {numarticle} cikk elolvasásához");

// ADMIN SHOW DETAIL TRACKING
DEFINE("_VRECOMMEND_DATE","Dátum");
DEFINE("_VRECOMMEND_NAME","Név");
DEFINE("_VRECOMMEND_IP","IP");
DEFINE("_VRECOMMEND_MAILS","Üzenet(ek)");
DEFINE("_VRECOMMEND_REPLY","Válasz");
DEFINE("_VRECOMMEND_POSITIVES_MAILS","Pozitív level(ek)");

// STATISTICS
DEFINE("_VRECOMMEND_TOP_10","A csúcs 10");
DEFINE("_VRECOMMEND_MOST_ACTIVE_REGISTERED_USERS","Legaktívabb regisztrált felhasználók");
DEFINE("_VRECOMMEND_BEST_POINTS","Legtöbb pont");
DEFINE("_VRECOMMEND_MOST_ITEM_RECOMMENDED","Legajánlottabb cikkek");
DEFINE("_VRECOMMEND_LAST_POSITIVE_REPLY","Utolsó pozitív válasz");
DEFINE("_VRECOMMEND_STATS_RECOMMEND","ajánlás(ok)");
DEFINE("_VRECOMMEND_CONFIRMED","jóváhagyott");


// COMMON
DEFINE("_VRECOMMEND_FILTER","Szûrõ");
DEFINE("_VRECOMMEND_CLOSE","Bezárás");
DEFINE("_VRECOMMEND_BACK","Vissza");
DEFINE("_VRECOMMEND_POINTS","Pontok");
DEFINE("_VRECOMMEND_REGISTERED","Regisztráltak");
DEFINE("_VRECOMMEND_GUEST","Vendég");

// ADMIN ABOUT
DEFINE("_VRECOMMEND_ABOUT","Névjegy");

// FRONT-END
DEFINE("_VRECOMMEND_RECOMMEND","Ajánld ismerõseidnek...");
DEFINE("_VRECOMMEND_RECOMMEND_FORM","Cikk ajánlása ismerõseidnek...");
DEFINE("_VRECOMMEND_YOURFRIENDNAME","Az ismerõsöd neve");
DEFINE("_VRECOMMEND_YOURFRIENDEMAILADRESS","Az ismerõsöd email címe");
DEFINE("_VRECOMMEND_YOURNAME","Neved (kötelezõ)");
DEFINE("_VRECOMMEND_YOUREMAILADDRESS","Email címed (kötelezõ)");
DEFINE("_VRECOMMEND_MESSAGEADDEDATYOURRECOMMEND","Az ajánlásodhoz hozzáfûzött üzenet (elhagyható):");
DEFINE("_VRECOMMEND_SUBMIT","Küldés");
DEFINE("_VRECOMMEND_ADDEMAIL","Cím(ek) hozzáadása");
DEFINE("_VRECOMMEND_REMOVEEMAIL","Cím(ek) eltávolítása");
DEFINE("_VRECOMMEND_FRIENDEMAILERROR","Hibás az ismerõsöd email címe");
DEFINE("_VRECOMMEND_FRIENDNAMEERROR","Hiba merült fel az ismerõsöd nevével kapcsolatban");
DEFINE("_VRECOMMEND_NAME_ERROR","Hiba merült fel a neveddel kapcsolatban");
DEFINE("_VRECOMMEND_ONLYREGISTERED","Csak a regisztrált felhasználók ajánlhatják a cikkeinket.<br />Kérjük, hogy jelentkezz be vagy regisztrálj.");
DEFINE("_VRECOMMEND_MAXDAILYEXCEEDED","Túllépted a naponta engedélyezett küldési mennyiséget, nem küldhetsz több üzenetet.");
DEFINE("_VRECOMMEND_SENDINGSRELEASED","üzenetet elküldtük. Köszönjük, hogy ajánlottál minket!");
DEFINE("_VRECOMMEND_NOSENDINGRELEASED","Nem küldtük el az üzenetedet. Ellenõrizd az ismerõse(i)d email címe(i)t.");
DEFINE("_VRECOMMEND_TO_REDUCE","Visszavonás");
DEFINE("_VRECOMMEND_GOTO_ARTICLE","Vissza a cikkhez");
DEFINE("_VRECOMMEND_GOTO_PROFILE","Ugrás a következõ felhasználó profiljához"); // use with Community Builder
DEFINE("_VRECOMMEND_ADD_LINK_PROFILE","hivatkozás hozzáadása a profilomhoz"); // use with Community Builder
?>