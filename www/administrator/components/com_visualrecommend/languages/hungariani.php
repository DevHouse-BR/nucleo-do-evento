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
defined( '_VALID_MOS' ) or die( 'A k�zvetlen hozz�f�r�s ehhez a helyhez nem enged�lyezett.' );

// CPANEL
DEFINE("_VRECOMMEND_CPL_CONFIG","Be�ll�t�sok");
DEFINE("_VRECOMMEND_CPL_TRACKING","K�vet�s");
DEFINE("_VRECOMMEND_CPL_EXPORTALL","Az �sszes lev�l export�l�sa");
DEFINE("_VRECOMMEND_CPL_EXPORTREPLY","A v�laszok export�l�sa");
DEFINE("_VRECOMMEND_CPL_STATS","Statisztika");
DEFINE("_VRECOMMEND_CPL_PURGE","Az �sszes ki�r�t�se");
DEFINE("_VRECOMMEND_CPL_ABOUT","N�vjegy");

// ADMIN
DEFINE("_VRECOMMEND_NOTWRITING","Nem �rhat� a konfigur�ci�s f�jl!");
DEFINE("_VRECOMMEND_SAVESETTINGS","A be�ll�t�sok ment�se k�sz");
DEFINE("_VRECOMMEND_SETTINGS","Be�ll�t�sok");
DEFINE("_VRECOMMEND_TRACKINGDELETED","k�vet�s t�rl�sre ker�lt");
DEFINE("_VRECOMMEND_NODATAFOREXPORT","Nincs export�land� adat.");
DEFINE("_VRECOMMEND_CSVNOTWRITING","Nem �rhat� a CSV f�jl!");
DEFINE("_VRECOMMEND_EXPORTEMAILSTOCSV","Az emailek export�l�sa CSV f�jlba");
DEFINE("_VRECOMMEND_EXPORTCSV","Export�l�s CSV form�tumba");

// ADMIN TAB SETTINGS
DEFINE("_VRECOMMEND_GENERALSETTING","�ltal�nos be�ll�t�sok");
DEFINE("_VRECOMMEND_GENERAL","�ltal�nos");
DEFINE("_VRECOMMEND_REGISTEREDONLY","Regisztr�lt felhaszn�l�k");
DEFINE("_VRECOMMEND_ALLOWREGISTERED","Csak a regisztr�lt felhaszn�l�k sz�m�ra enged�lyezed a cikkaj�nl�st?");
DEFINE("_VRECOMMEND_LINK_TO_CB","Hivatkoz�s a felhaszn�l� Community Builder profilj�ra");
DEFINE("_VRECOMMEND_LINK_TO_CB_DETAIL","Csak a regisztr�lt felhaszn�l�kn�l sz�rja be az aj�nl�sba a Community Builder profilra mutat� hivatkoz�st.");
DEFINE("_VRECOMMEND_MAXRECOMMENDSENDING","A k�ldhet� aj�nl�sok sz�ma");
DEFINE("_VRECOMMEND_MAXDAILYRECOMMEND","A napi aj�nl�sok sz�ma felhaszn�l�nk�nt");
DEFINE("_VRECOMMEND_UNLIMITED","Korl�tlan");
DEFINE("_VRECOMMEND_USERCUSTOMMESSAGE","A felhaszn�l� saj�t �zenete");
DEFINE("_VRECOMMEND_SHOWFORM","Az �rlap megjelen�t�se");
DEFINE("_VRECOMMEND_NORMAL","szok�sos m�don");
DEFINE("_VRECOMMEND_POPUP","el�ugr� ablakban");
DEFINE("_VRECOMMEND_CUSTOMYOURPOPUP","Az el�ugr� ablak testreszab�sa");
DEFINE("_VRECOMMEND_WIDTH","Sz�less�g");
DEFINE("_VRECOMMEND_HEIGHT","Magass�g");
DEFINE("_VRECOMMEND_ACTIVATEADSENSE","A Google AdSense hirdet�sek megjelen�t�se");
DEFINE("_VRECOMMEND_SETTINGADSENSEDESCRIPTION","A Google AdSense be�ll�t�sa az utols� f�l�n.");
DEFINE("_VRECOMMEND_POSITIONADSENSE","Elhelyez�s");
DEFINE("_VRECOMMEND_TOP","Fent");
DEFINE("_VRECOMMEND_BOTTOM","Lent");
DEFINE("_VRECOMMEND_BOTH","Mindkett�");
DEFINE("_VRECOMMEND_AD_FORMAT","Form�tum");

// ADMIN TAB PLUGIN
DEFINE("_VRECOMMEND_PLUGIN","Be�p�l� modul");
DEFINE("_VRECOMMEND_CHOOSEMODEOPERATING","V�laszd ki a f� m�k�d�si m�dot");
DEFINE("_VRECOMMEND_MODEOPERATING","F� m�k�d�si m�d");
DEFINE("_VRECOMMEND_INDIVIDUALCOMMANDBOT","K�zi : egyedi botparancs haszn�lata");
DEFINE("_VRECOMMEND_CHOOSEFROMSECTIONBELOW","Automatikus : v�laszt�s az al�bbi szekci�kb�l");
DEFINE("_VRECOMMEND_DEF_MODEOPERATING","A {visualrecommend} egyedi be�p�l� modul paranccsal v�laszthatod ki, hogy minden tartalmi elem egyenk�nti aj�nl�s�t enged�lyezed-e. A m�sodik lehet�s�ggel teljes szekci�kban kapcsolhatod be/ki az aj�nl�st.");
DEFINE("_VRECOMMEND_SECTIONSAVAILABLE","L�tez� szekci�k");
DEFINE("_VRECOMMEND_DEF_SECTIONSAVAILABLE","Ha a m�sodik m�k�d�si m�dot haszn�lod, akkor itt v�laszthatod ki, hogy melyik szekci�kban haszn�lhat� az aj�nl�rendszer. T�bbsz�r�s kijel�l�sre is m�d van.");
DEFINE("_VRECOMMEND_ONLYONFULLTEXT","Csak a teljes cikkn�l l�that�");
DEFINE("_VRECOMMEND_BOTH_INDIVIDUALTAG_AND_SECTIONBELOW","F�lautomata : al�bbi egyedi bot �s szekci�k");
DEFINE("_VRECOMMEND_STATICCONTENTS","Statikus tartalom");
DEFINE("_VRECOMMEND_STYLECSS","CSS-oszt�ly");
DEFINE("_VRECOMMEND_STYLECSSDESCRIPTION","Elhagyhat�: a hivatkoz�s �ltal haszn�lt CSS-oszt�ly nev�t hat�rozza meg (p�ld�ul readon vagy kicsi...)");

// ADMIN TAB MAIL
DEFINE("_VRECOMMEND_MAIL","Lev�l");
DEFINE("_VRECOMMEND_MAILSETTINGS","Lev�l be�ll�t�sai");
DEFINE("_VRECOMMEND_MAILSUBJECT","Az �zenet t�rgya");
DEFINE("_VRECOMMEND_MAILMESSAGEBODY","Az �zenet sz�vege");
DEFINE("_VRECOMMEND_AVAILABLE_TAGS","Felhaszn�lhat� c�mk�k:");

// ADMIN TAB MISCELLENAEOUS
DEFINE("_VRECOMMEND_MISCELLANEOUS","Egyebek");
DEFINE("_VRECOMMEND_AWARDS","D�jak (csak regisztr�lt felhaszn�l�k sz�m�ra)");
DEFINE("_VRECOMMEND_POINTS_BY_SENT_MAIL","Elk�ld�tt levelek alapj�n szerzett pontok");
DEFINE("_VRECOMMEND_POINTS_ON_POSITIVE_RECOMMEND","Pontok pozit�v aj�nl�s�rt");

// ADMIN TAB ADSENSE
DEFINE("_VRECOMMEND_TAB_GOOGLEADSENSE","AdSense");
DEFINE("_VRECOMMEND_SETTINGSADSENSE","Google AdSense be�ll�t�sai");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT","Hirdet�sek igaz�t�sa");
DEFINE("_VRECOMMEND_ADS_LEFT","Balra");
DEFINE("_VRECOMMEND_ADS_RIGHT","Jobbra");
DEFINE("_VRECOMMEND_ADS_CENTER","K�z�pre");
DEFINE("_VRECOMMEND_ADS_NONE","Nincs");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT_DESC","V�laszd ki a hirdet�sek tetsz�s szerinti igaz�t�s�t. Ha valamelyik v�laszt�sod megt�ri a sablon elrendez�s�t, ne v�laszd egyiket sem");
DEFINE("_VRECOMMEND_ADS_ID","�gyf�l azonos�t�sz�ma");
DEFINE("_VRECOMMEND_ADS_ID_DESC","K�rj�k, hogy �rd be a Google AdSense �gyf�lazonos�t�dat. A szerz�k AdSense azonos�t�ja ker�l alap�rtelmezett azonos�t�k�nt felhaszn�l�sra.");
DEFINE("_VRECOMMEND_ADS_CHANNEL","Hirdet�csatorna");
DEFINE("_VRECOMMEND_ADS_CHANNEL_DESC","�rd be azt a csatornaazonos�t�t, amit a Google AdSense adminisztr�ci�j�ban megadt�l. Tan�csos csatorn�t hozz�rendelni, mert �gy jobban nyomon k�vetheted, hogy mennyit kerest�l.");
DEFINE("_VRECOMMEND_ADS_TYPE","Hirdet�sek t�pusa");
DEFINE("_VRECOMMEND_ADS_TYPE_DESC","V�laszd ki az oldaladon megjelen�tend� hirdet�si t�pusokat. Ha csak a K�pes hirdet�sek lehet�s�get v�lasztod, akkor csak a k�vetkez� m�reteket haszn�ld: 728x90 - Leaderboard, 468x60 - Rekl�mszalag, 300x250 - K�zepes n�gysz�g, 160x600 - Sz�les felh�arcol� �s 120x600 - Felh�karcol�.");
DEFINE("_VRECOMMEND_ADS_TYPE_DEFAULTACCOUNT","Az alap�rtelmezett fi�kbe�ll�t�saim haszn�lata");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTONLY","Csak sz�veg");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTANDIMAGE","Sz�veg �s k�p");
DEFINE("_VRECOMMEND_ADS_TYPE_IMAGEONLY","Csak k�p");
DEFINE("_VRECOMMEND_ADS_ALTERNATE","Helyettes�t� hirdet�sek URL-je");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_DESC","A helyettes�t� hirdet�sek URL-je m�s hirdet�sek megad�s�hoz, amikor nincs egy hirdet�s sem. Vagy pedig be�rhatod csak a http:// -t, ha nincsenek helyettes�t� hirdet�sek. De mi�rt ne haszn�ln�d a helyettes�t� hirdet�seket, ha van r� lehet�s�g?");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR","Helyettes�t� sz�n");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR_DESC","A helyettes�t� sz�n, ha nincs egy hirdet�s sem, hexa �rt�kben, # n�lk�l");
DEFINE("_VRECOMMEND_INHEXWHITOUT","Hexadecim�lis �rt�k, # n�lk�l (pl.: FFFFFF)");
DEFINE("_VRECOMMEND_ADS_BORDER_COLOR","Szeg�ly sz�ne");
DEFINE("_VRECOMMEND_ADS_BACKGROUND_COLOR","H�tt�r sz�ne");
DEFINE("_VRECOMMEND_ADS_LINK_COLOR","Hivatkoz�s sz�ne");
DEFINE("_VRECOMMEND_ADS_URL_COLOR","URL sz�ne");
DEFINE("_VRECOMMEND_ADS_TEXT_COLOR","Hivatkoz�s sz�ne");

// ADMIN TRACKING
DEFINE("_VRECOMMEND_TRACKING","K�vet�s");
DEFINE("_VRECOMMEND_TITLE","C�m");
DEFINE("_VRECOMMEND_ID","AZ");
DEFINE("_VRECOMMEND_RECOMMENDS_USERS","Aj�nl�sok / Felhaszn�l�k");
DEFINE("_VRECOMMEND_LASTRECOMMEND","Utols� aj�nl�s");
DEFINE("_VRECOMMEND_SENDINGS","k�ld�s");
DEFINE("_VRECOMMEND_SHOWTRACKING","K�vet�s megjelen�t�se");
DEFINE("_VRECOMMEND_STATISTICS", "{numvisitor} l�togat� {numfriend} ismer�s�t h�vta meg {numarticle} cikk elolvas�s�hoz");

// ADMIN SHOW DETAIL TRACKING
DEFINE("_VRECOMMEND_DATE","D�tum");
DEFINE("_VRECOMMEND_NAME","N�v");
DEFINE("_VRECOMMEND_IP","IP");
DEFINE("_VRECOMMEND_MAILS","�zenet(ek)");
DEFINE("_VRECOMMEND_REPLY","V�lasz");
DEFINE("_VRECOMMEND_POSITIVES_MAILS","Pozit�v level(ek)");

// STATISTICS
DEFINE("_VRECOMMEND_TOP_10","A cs�cs 10");
DEFINE("_VRECOMMEND_MOST_ACTIVE_REGISTERED_USERS","Legakt�vabb regisztr�lt felhaszn�l�k");
DEFINE("_VRECOMMEND_BEST_POINTS","Legt�bb pont");
DEFINE("_VRECOMMEND_MOST_ITEM_RECOMMENDED","Legaj�nlottabb cikkek");
DEFINE("_VRECOMMEND_LAST_POSITIVE_REPLY","Utols� pozit�v v�lasz");
DEFINE("_VRECOMMEND_STATS_RECOMMEND","aj�nl�s(ok)");
DEFINE("_VRECOMMEND_CONFIRMED","j�v�hagyott");


// COMMON
DEFINE("_VRECOMMEND_FILTER","Sz�r�");
DEFINE("_VRECOMMEND_CLOSE","Bez�r�s");
DEFINE("_VRECOMMEND_BACK","Vissza");
DEFINE("_VRECOMMEND_POINTS","Pontok");
DEFINE("_VRECOMMEND_REGISTERED","Regisztr�ltak");
DEFINE("_VRECOMMEND_GUEST","Vend�g");

// ADMIN ABOUT
DEFINE("_VRECOMMEND_ABOUT","N�vjegy");

// FRONT-END
DEFINE("_VRECOMMEND_RECOMMEND","Aj�nld ismer�seidnek...");
DEFINE("_VRECOMMEND_RECOMMEND_FORM","Cikk aj�nl�sa ismer�seidnek...");
DEFINE("_VRECOMMEND_YOURFRIENDNAME","Az ismer�s�d neve");
DEFINE("_VRECOMMEND_YOURFRIENDEMAILADRESS","Az ismer�s�d email c�me");
DEFINE("_VRECOMMEND_YOURNAME","Neved (k�telez�)");
DEFINE("_VRECOMMEND_YOUREMAILADDRESS","Email c�med (k�telez�)");
DEFINE("_VRECOMMEND_MESSAGEADDEDATYOURRECOMMEND","Az aj�nl�sodhoz hozz�f�z�tt �zenet (elhagyhat�):");
DEFINE("_VRECOMMEND_SUBMIT","K�ld�s");
DEFINE("_VRECOMMEND_ADDEMAIL","C�m(ek) hozz�ad�sa");
DEFINE("_VRECOMMEND_REMOVEEMAIL","C�m(ek) elt�vol�t�sa");
DEFINE("_VRECOMMEND_FRIENDEMAILERROR","Hib�s az ismer�s�d email c�me");
DEFINE("_VRECOMMEND_FRIENDNAMEERROR","Hiba mer�lt fel az ismer�s�d nev�vel kapcsolatban");
DEFINE("_VRECOMMEND_NAME_ERROR","Hiba mer�lt fel a neveddel kapcsolatban");
DEFINE("_VRECOMMEND_ONLYREGISTERED","Csak a regisztr�lt felhaszn�l�k aj�nlhatj�k a cikkeinket.<br />K�rj�k, hogy jelentkezz be vagy regisztr�lj.");
DEFINE("_VRECOMMEND_MAXDAILYEXCEEDED","T�ll�pted a naponta enged�lyezett k�ld�si mennyis�get, nem k�ldhetsz t�bb �zenetet.");
DEFINE("_VRECOMMEND_SENDINGSRELEASED","�zenetet elk�ldt�k. K�sz�nj�k, hogy aj�nlott�l minket!");
DEFINE("_VRECOMMEND_NOSENDINGRELEASED","Nem k�ldt�k el az �zenetedet. Ellen�rizd az ismer�se(i)d email c�me(i)t.");
DEFINE("_VRECOMMEND_TO_REDUCE","Visszavon�s");
DEFINE("_VRECOMMEND_GOTO_ARTICLE","Vissza a cikkhez");
DEFINE("_VRECOMMEND_GOTO_PROFILE","Ugr�s a k�vetkez� felhaszn�l� profilj�hoz"); // use with Community Builder
DEFINE("_VRECOMMEND_ADD_LINK_PROFILE","hivatkoz�s hozz�ad�sa a profilomhoz"); // use with Community Builder
?>