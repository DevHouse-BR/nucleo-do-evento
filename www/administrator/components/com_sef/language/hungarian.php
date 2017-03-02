<?php

//
// Copyright (C) 2004 W.H.Welch
// All rights reserved.
//
// This source file is part of the 404SEF Component, a Mambo 4.5.1
// custom Component By W.H.Welch - http://sef404.sourceforge.net/
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// Please note that the GPL states that any headers in files and
// Copyright notices as well as credits in headers, source files
// and output (screens, prints, etc.) can not be removed.
// You can extend them with your own credits, though...
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with this program; if not, write to the Free Software
// Foundation, Inc., 59 Temple Place - Suite 330, Boston, MA  02111-1307, USA.
//
// The "GNU General Public License" (GPL) is available at
// http://www.gnu.org/copyleft/gpl.html.
//
// Dont allow direct linking

defined( '_VALID_MOS' ) or die( 'A k�zvetlen hozz�f�r�s ehhez a helyhez nem enged�lyezett.');

// admin interface

DEFINE('_COM_SEF_CONFIG', 'sh404SEF<br/>be�ll�t�sai');
DEFINE('_COM_SEF_CONFIG_DESC','Az sh404SEF funkci�inak konfigur�l�sa');
DEFINE('_COM_SEF_HELP', 'sh404SEF<br/>t�mogat�s');
DEFINE('_COM_SEF_HELPDESC','Seg�ts�gre van sz�ks�ge az sh404SEF haszn�lat�hoz?');
DEFINE('_COM_SEF_INFO', 'sh404SEF<br/>dokument�ci�');
DEFINE('_COM_SEF_INFODESC','Az sh404SEF projekt �sszegz�s�nek �s dokument�ci�j�nak megtekint�se');
DEFINE('_COM_SEF_VIEWURL','Keres�bar�t URL-ek<br/>megtekint�se/szerkeszt�se');
DEFINE('_COM_SEF_VIEWURLDESC','A keres�bar�t URL-ek megtekint�se/szerkeszt�se');
DEFINE('_COM_SEF_VIEW404','404 napl�<br/>megtekint�se/m�dos�t�sa');
DEFINE('_COM_SEF_VIEW404DESC','A 404 napl� megtekint�se/m�dos�t�sa');
DEFINE('_COM_SEF_VIEWCUSTOM','Egy�ni �tir�ny�t�sok<br/>megtekint�se/m�dos�t�sa');
DEFINE('_COM_SEF_VIEWCUSTOMDESC','Az egy�ni �tir�ny�t�sok megtekint�se/m�dos�t�sa');
DEFINE('_COM_SEF_SUPPORT','T�mogat�<br/>webhely');
DEFINE('_COM_SEF_SUPPORTDESC','Kapcsol�d�s az sh404SEF webhely�hez (�j ablakban)');
DEFINE('_COM_SEF_BACK','Vissza az sh404SEF vez�rl�pulthoz');
DEFINE('_COM_SEF_PURGEURL','Keres�bar�t URL-ek<br/>ki�r�t�se');
DEFINE('_COM_SEF_PURGEURLDESC','A keres�bar�t URL-ek ki�r�t�se');
DEFINE('_COM_SEF_PURGE404','404 napl�<br/>ki�r�t�se');
DEFINE('_COM_SEF_PURGE404DESC','A 404 napl� ki�r�t�se');
DEFINE('_COM_SEF_PURGECUSTOM','Egy�ni �tir�ny�t�sok<br/>ki�r�t�se');
DEFINE('_COM_SEF_PURGECUSTOMDESC','Az egy�ni �tir�ny�t�sok ki�r�t�se');
DEFINE('_COM_SEF_WARNDELETE','FIGYELEM!!!<br/>�n ');
DEFINE('_COM_SEF_RECORD',' rekord t�rl�s�re k�sz�l');
DEFINE('_COM_SEF_RECORDS',' rekord t�rl�s�re k�sz�l');
DEFINE('_COM_SEF_NORECORDS','Nem tal�lhat� egy rekord sem.');
DEFINE('_COM_SEF_PROCEED',' Folytatja ');
DEFINE('_COM_SEF_OK',' OK ');
DEFINE('_COM_SEF_SUCCESSPURGE','A rekordok ki�r�t�se siker�lt');
DEFINE('_PREVIEW_CLOSE','Ablak bez�r�sa');
DEFINE('_COM_SEF_EMPTYURL','K�rj�k, hogy adja meg az �tir�ny�t�s URL-j�t.');
DEFINE('_COM_SEF_NOLEADSLASH','NE KEZD�DJ�N PERJELLEL az �j keres�bar�t URL');
DEFINE('_COM_SEF_BADURL','A r�gi nem keres�bar�t URL-nek index.php-val kell kezd�dnie');
DEFINE('_COM_SEF_URLEXIST','M�r megtal�lhat� ez az URL az adatb�zisban!');
DEFINE('_COM_SEF_SHOW0','Keres�bar�t URL-ek');
DEFINE('_COM_SEF_SHOW1','404 napl�');
DEFINE('_COM_SEF_SHOW2','Egy�ni �tir�ny�t�sok');
DEFINE('_COM_SEF_INVALID_URL','�RV�NYTELEN URL: ehhez a hivatkoz�shoz �rv�nyes elemazonos�t�ra van sz�ks�g, de nem tal�lhat� egy sem.<br/>MEGOLD�S: K�sz�tse el ennek az elemnek a men�pontj�t. Nem kell k�zz�tennie, csak l�tre kell hoznia.');
DEFINE('_COM_SEF_DEF_404_MSG','<h1>404: Nem tal�lhat�</h1><h4>Sajnos az �n �ltal k�rt tartalmi elemet nem tal�ljuk</h4>');
DEFINE('_COM_SEF_SELECT_DELETE','Jel�lje ki a t�rlend� elemet');
DEFINE('_COM_SEF_ASC',' (n�v) ');
DEFINE('_COM_SEF_DESC',' (cs�kk) ');
DEFINE('_COM_SEF_WRITEABLE',' <b><font color="green">�rhat�</font></b>');
DEFINE('_COM_SEF_UNWRITEABLE',' <b><font color="red">�r�sv�dett</font></b>');
DEFINE('_COM_SEF_USING_DEFAULT',' <b><font color="red">Alap�rtelmezett �rt�kek haszn�lata</font></b>');
DEFINE('_COM_SEF_DISABLED',"<p class='error'>MEGJEGYZ�S: A Joomla/Mambo keres�bar�t t�mogat�sa jelenleg letiltott. Ha haszn�lni k�v�nja a keres�bar�t webc�meket, akkor enged�lyezze az <a href='"
.$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>�ltal�nos be�ll�t�sok</a> SEO lapj�n.</p>");
DEFINE('_COM_SEF_TITLE_CONFIG','A sh404SEF konfigur�ci�s f�jl');
DEFINE('_COM_SEF_TITLE_BASIC','Alapbe�ll�t�sok');
DEFINE('_COM_SEF_ENABLED','Enged�lyezett');
DEFINE('_COM_SEF_TT_ENABLED','A Nem v�laszt�sa eset�n a Joomla/Mambo alap�rtelmezett keres�bar�t funkci�j�t fogja haszn�lni a rendszer');
DEFINE('_COM_SEF_DEF_404_PAGE','Alap�rtelmezett 404 oldal');
DEFINE('_COM_SEF_REPLACE_CHAR','Karakterhelyettes�t�s');
DEFINE('_COM_SEF_TT_REPLACE_CHAR','Az URL-ben el�fordul� ismeretlen karaktereket behelyettes�t� karakter');
DEFINE('_COM_SEF_PAGEREP_CHAR','Oldalelv�laszt� karakter');
DEFINE('_COM_SEF_TT_PAGEREP_CHAR','Az oldalsz�mokat az URL t�bbi r�sz�t�l t�rt�n� elv�laszt�sra haszn�land� karakter');
DEFINE('_COM_SEF_STRIP_CHAR','Elt�vol�tand� karakterek');
DEFINE('_COM_SEF_TT_STRIP_CHAR','Az URL-b�l elt�vol�tand� karakterek, | szimb�lummal elv�lasztva');
DEFINE('_COM_SEF_FRIENDTRIM_CHAR','Bar�ts�gos karakterek lev�g�sa');
DEFINE('_COM_SEF_TT_FRIENDTRIM_CHAR','Az URL-ben l�v� lev�gand� karakterek, | szimb�lummal elv�lasztva');
DEFINE('_COM_SEF_USE_ALIAS','C�m aliasnev�nek haszn�lata');
DEFINE('_COM_SEF_TT_USE_ALIAS','A C�m aliasneve v�laszt�sa eset�n a c�m aliasneve ker�l felhaszn�l�sra az URL-ben a c�m helyett');
DEFINE('_COM_SEF_SUFFIX','F�jl ut�tag');
DEFINE('_COM_SEF_TT_SUFFIX','A \\\'f�jlok\\\' eset�n haszn�land� kiterjeszt�s. Hagyja �resen, ha le akarja tiltani. Gyakori bejegyz�s a \\\'html\\\'.');
DEFINE('_COM_SEF_ADDFILE','Alap�rtelmezett indexf�jl.');
DEFINE('_COM_SEF_TT_ADDFILE','�res URL ut�n teend� f�jln�v / ha egy f�jl sem l�tezik.  Az �n weblapj�t indexel� robotok eset�n hasznos, melyek egy bizonyos f�jlt keresnek azon a helyen, viszont 404-es hib�t ad vissza, mert nincs ott.');
DEFINE('_COM_SEF_PAGETEXT','Az oldal sz�vege');
DEFINE('_COM_SEF_TT_PAGETEXT','T�bb oldal URL-j�hez hozz�f�zend� sz�veg. A %s haszn�lat�val sz�rhatja be az oldalsz�mot, alap�rtelmez�sk�nt a v�g�re ker�l. Ha meghat�roz egy el�tagot, akkor hozz�f�zi ennek a karakterl�ncnak a v�g�hez.');
DEFINE('_COM_SEF_LOWER','Mind kisbet�s');
DEFINE('_COM_SEF_TT_LOWER','Az URL-ben l�v� �sszes karaktert kisbet�ss� alak�tja', 'Mind kisbet�s');
DEFINE('_COM_SEF_SHOW_SECT','Szekci� belev�tele');
DEFINE('_COM_SEF_TT_SHOW_SECT','Az Igen v�laszt�sa eset�n az URL tartalmazza a szekci�nevet');
DEFINE('_COM_SEF_HIDE_CAT','Kateg�ria elrejt�se');
DEFINE('_COM_SEF_TT_SHOW_CAT','Az Igen v�laszt�sa eset�n a kateg�rian�v kiz�r�sra ker�l az URL-b�l');
DEFINE('_COM_SEF_404PAGE','404-es oldal');
DEFINE('_COM_SEF_TT_404PAGE','Statikus tartalmi oldal haszn�lata a 404 Nem tal�lhat� hib�k eset�n (a k�zz�tett �llapot nem sz�m�t)');
DEFINE('_COM_SEF_TITLE_ADV','Speci�lis komponens be�ll�t�sok');
DEFINE('_COM_SEF_TT_ADV','<b>alap�rtelmezett kezel� haszn�lata</b><br/>a feldolgoz�s norm�l m�don t�rt�nik, ha l�tezik speci�lis keres�bar�t kieg�sz�t�s, akkor az ker�l helyette felhaszn�l�sra. <br/><b>nincs t�raz�s</b><br/>nem t�rolja az adatb�zisban, �s r�gi st�lus� keres�bar�t URL-eket gener�l.<br/><b>kihagy�s</b><br/>nem k�sz�t keres�bar�t URL-eket ehhez a komponenshez<br/>');
DEFINE('_COM_SEF_TT_ADV4','Speci�lis be�ll�t�sok: ');
DEFINE('_COM_SEF_TITLE_MANAGER','sh404SEF URL-kezel�');
DEFINE('_COM_SEF_VIEWMODE','N�zetM�d:');
DEFINE('_COM_SEF_SORTBY','Rendez�si m�d:');
DEFINE('_COM_SEF_HITS','Tal�latok');
DEFINE('_COM_SEF_DATEADD','Hozz�adva');
DEFINE('_COM_SEF_SEFURL','Keres�bar�t URL');
DEFINE('_COM_SEF_URL','URL');
DEFINE('_COM_SEF_REALURL','Val�di URL');
DEFINE('_COM_SEF_EDIT','Szerkeszt�s :');
DEFINE('_COM_SEF_ADD','Hozz�ad�s :');
DEFINE('_COM_SEF_NEWURL','�j keres�bar�t URL');
DEFINE('_COM_SEF_TT_NEWURL','Csak relat�v �tir�ny�t�s a Joomla/Mambo gy�k�rb�l, az elej�n / jel <i>n�lk�l</i>');
DEFINE('_COM_SEF_OLDURL','R�gi, nem keres�bar�t URL');
DEFINE('_COM_SEF_TT_OLDURL','Ennek az URL-nek index.php-val kell kezd�dnie');
DEFINE('_COM_SEF_SAVEAS','Ment�s egy�ni �tir�ny�t�sk�nt');
DEFINE('_COM_SEF_TITLE_SUPPORT','sh404SEF t�mogat�s');
DEFINE('_COM_SEF_HELPVIA','<b>Seg�ts�get az al�bbi f�rumokban kaphat:</b>');
DEFINE('_COM_SEF_OFFICIAL','Projekt hivatalos f�ruma');
DEFINE('_COM_SEF_MAMBERS','Mambers f�rum');
DEFINE('_COM_SEF_TITLE_PURGE','sh404SEF adatb�zis ki�r�t�se');
DEFINE('_COM_SEF_USE_DEFAULT','(alap�rtelmezett kezel� haszn�lata)');
DEFINE('_COM_SEF_NOCACHE','nincs t�raz�s');
DEFINE('_COM_SEF_SKIP','kihagy�s');
DEFINE('_COM_SEF_INSTALLED_VERS','Telep�tett verzi�:');
DEFINE('_COM_SEF_COPYRIGHT','Copyright');
DEFINE('_COM_SEF_LICENSE','Licenc');
DEFINE('_COM_SEF_SUPPORT_404SEF','T�mogat�s');
DEFINE('_COM_SEF_CONFIG_UPDATED','A be�ll�t�sok m�dos�t�sa k�sz');
DEFINE('_COM_SEF_WRITE_ERROR','Hiba t�rt�nt a konfigur�ci�s f�jl �r�sakor');
DEFINE('_COM_SEF_NOACCESS','Nem lehet hozz�f�rni a k�vetkez� t�bl�hoz: ');
DEFINE('_COM_SEF_FATAL_ERROR_HEADERS','V�GZETES HIBA: A FEJL�C ELK�LD�SE M�R MEGT�RT�NT');
DEFINE('_COM_SEF_UPLOAD_OK','A f�jl felt�lt�se siker�lt');
DEFINE('_COM_SEF_ERROR_IMPORT','Az import�l�s k�zben hiba t�rt�nt:');
DEFINE('_COM_SEF_INVALID_SQL','�RV�NYTELEN ADATOKAT TARTALMAZ AZ SQL F�JL :');
DEFINE('_COM_SEF_NO_UNLINK','Nem t�vol�that� el a felt�lt�tt f�jl a media k�nyvt�rb�l');
DEFINE('_COM_SEF_IMPORT_OK','Az egy�ni URL-ek import�l�sa siker�lt!');
DEFINE('_COM_SEF_WRITE_FAILED','Nem �rhat� a media k�nyvt�rba felt�lt�tt f�jl');
DEFINE('_COM_SEF_EXPORT_FAILED','AZ EXPORT�L�S NEM SIKER�LT!!!');
DEFINE('_COM_SEF_IMPORT_EXPORT','Egy�ni URL-ek import�l�sa/export�l�sa');
DEFINE('_COM_SEF_SELECT_FILE','K�rj�k, hogy el�bb v�lassza ki a f�jlt');
DEFINE('_COM_SEF_IMPORT','Egy�ni URL-ek import�l�sa');
DEFINE('_COM_SEF_EXPORT','Egy�ni URL-ek biztons�gi ment�se');

// component interface

DEFINE('_COM_SEF_NOREAD','V�GZETES HIBA: Nem olvashat� be a f�jl ');
DEFINE('_COM_SEF_CHK_PERMS','K�rj�k, hogy ellen�rizze a f�jlenged�lyeket, �s biztos�tsa, hogy ez a f�jl olvashat� legyen.');
DEFINE('_COM_SEF_DEBUG_DATA_DUMP','A HIBAKERES�SI ADATOK KI�RAT�SA BEFEJEZ�D�TT: Az oldalbet�lt�s le�llt');
DEFINE('_COM_SEF_STRANGE','Valami k�l�n�s t�rt�nt. Ennek nem szabadna el�fordulnia<br />');

//Added by Leon

define('_FULL_TITLE','Teljes c�m');
define('_TITLE_ALIAS','C�m aliasneve');
define('_COM_SEF_SHOW_CAT','Kateg�ria megjelen�t�se');

// added by shumisha
// hungarian translation by Jozsef Tamas Herczeg 2007-04-09
// General params
define('_COM_SEF_SH_REPLACEMENTS', 'Karaktercser�k list�ja');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Az URL-ben nem elfogadott karakterek, mint a nem-latin vagy �kezetes bet�k, lecser�lhet�k e behelyettes�t� t�bl�zat alapj�n. <br />A behelyettes�t�si szab�ly form�tuma xxx | yyy. Az xxx a lecser�lend� karakter, az yyy pedig az �j karakter. <br />Sok ilyen vessz�vel (,) elv�lasztott szab�ly lehet. A r�gi �s az �j karakter k�z�tt haszn�lja a | karaktert. <br />Az xxx vagy az yyy t�bb karakter is lehet, mint p�ld�ul �|oe ');

// cache params
define('_COM_SEF_SH_CACHE_TITLE', 'Gyors�t�t�r-kezel�s');
define('_COM_SEF_SH_USE_URL_CACHE', 'Az URL gyors�t�t�raz�s aktiv�l�sa');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'Aktiv�l�s eset�n a keres�bar�t URL a mem�ri�ban l�v� gyors�t�t�rba ker�l be�r�sra, ami jelent�sen meg fogja n�velni az oldal bet�lt�d�s�nek idej�t. Ez azonban fel fogja haszn�lni a mem�ri�t!');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'A gyors�t�t�r m�rete');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'Az URL gyors�t�t�raz�s aktiv�l�sa eset�n ez a param�ter �ll�tja be a legnagyobb m�retet. �rja be a gyors�t�t�rban t�rolhat� URL-ek sz�m�t (tov�bbi URL ker�l feldolgoz�sra, de nem ker�l be a gyors�t�t�rba, ez�rt a bet�lt�s ideje hosszabb lesz). �ltal�noss�gban sz�lva, mindegyik URL k�r�lbel�l 200 b�jtot tesz ki (100 a keres�bar�t URL, �s 100 a nem keres�bar�t URL). Teh�t, p�ld�ul  5000 URL kb. 1 MB mem�ri�t fog felhaszn�lni.');
// URL translation
define('_COM_SEF_SH_TRANSLATION_TITLE', 'Ford�t�s kezel�se');
define('_COM_SEF_SH_TRANSLATE_URL', 'Az URL leford�t�sa');
define('_COM_SEF_TT_SH_TRANSLATE_URL', 'Ha aktiv�lja, �s a webhely t�bbnyelv�, akkor a keres�bar�t URL elemei a Joomfish d�nt�se alapj�n leford�t�sra ker�lnek a l�togat� nyelv�re. Ha nem aktiv�lja, akkor az URL mindig a webhely alap�rtelmezett nyelv�n lesz. Nem ker�l felhaszn�l�sra, ha a webhely nem t�bbnyelv�.');
// itemid control
define('_COM_SEF_SH_ITEMID_TITLE', 'Elemazonos�t�-kezel�s');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'A men�-elemazonos�t� besz�r�sa, ha nincs');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Ha nincs megadva elemazonos�t� a nem keres�bar�t URL-ben a keres�bar�tt� alak�t�s el�tt, �n pedig ezt a lehet�s�get igazra �ll�totta, akkor a jelenlegi men�pont elemazonos�t�ja hozz�ad�sra ker�l. Ez fogja biztos�tani azt, hogy kattint�skor a hivatkoz�s ugyanazon az oldalon fog maradni (pl: ugyanazok a modulok l�that�k)');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'A men�c�m besz�r�sa, ha nincs elemazonos�t�');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'Ha nincs megadva elemazonos�t� a nem keres�bar�t URL-ben a keres�bar�tt� alak�t�s el�tt, �n pedig ezt a lehet�s�get igazra �ll�totta, akkor a jelenlegi men�pont c�me besz�r�sra ker�l a keres�bar�t URL-be. Akkor �ll�tsa ezt igazra, ha a fenti param�tert is igazra �ll�totta, ugyanis ez megakad�lyozza a -2, -3, -... hozz�f�z�s�t a keres�bar�t URL-hez, ha valamelyik cikket t�bb helyr�l n�zik.');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'A men�c�m besz�r�sa minden alkalommal');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'Az igen v�laszt�sa eset�n az elemazonos�t�nak megfelel� men�pont c�me ker�l besz�r�sra a nem keres�bar�t URL-be, vagy ha nincs megadva egy elemazonos�t� sem, a jelenlegi men�pont c�me besz�r�sra ker�l a keres�bar�t URL-be.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Az elemazonos�t� hozz�f�z�se a SEF URL-hez minden alkalommal');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'Az Igen v�laszt�sa eset�n a nem keres�bar�t elemazonos�t� (vagy a jelenlegi men�pont elemazonos�t�ja, ha egyik sincs megadva a nem keres�bar�t URL-ben) hozz�f�z�sre ker�l a keres�bar�t URL-hez. Ezt kell haszn�lni A men�c�m besz�r�sa minden alkalommal param�ter helyett, ha t�bb azonos c�m� men�pontja van (p�ld�ul ha van egy a f�men�ben, egy pedig a fels� men�ben)');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'men�azonos�t�');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Alap�rtelmezett men�c�m');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'A fenti param�ter Igenre �ll�t�s�val itt fel�lb�r�lhatja a keres�bar�t URL-be besz�rt sz�veget. Ez a sz�veg v�ltozatlan lesz, �s nem ker�l p�ld�ul leford�t�sra.');
// Virtuemart params
define('_COM_SEF_SH_VM_TITLE', 'VirtueMart be�ll�t�sai');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Az �zlet nev�nek besz�r�sa az URL-be');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'Az Igen v�laszt�sa eset�n az �zlet neve (az �zlet men�pontj�nak c�m�ben meghat�rozottak alapj�n) mindig hozz�f�z�sre ker�l a keres�bar�t URL elej�hez');
define('_COM_SEF_SH_SHOP_NAME', 'Alap�rtelmezett �zletn�v');
define('_COM_SEF_TT_SH_SHOP_NAME', 'A fenti param�ter Igenre �ll�t�s�val itt fel�lb�r�lhatja a keres�bar�t URL-be besz�rt sz�veget. Ez a sz�veg v�ltozatlan lesz, �s nem ker�l leford�t�sra p�ld�ul.');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'A term�kazonos�t� besz�r�sa az URL-be');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'Az Igen v�laszt�sa eset�n a term�kazonos�t� hozz�f�z�sre ker�l a keres�bar�t URL-ben a term�k nev�hez<br />P�ld�ul : enlapom.hu/3-az-en-nagyon-szep-termekem.html.<br />Ez akkor hasznos, ha nem akarja az �sszes kateg�rianevet besz�rni az URL-be, ugyanis k�l�nf�le kateg�ri�kban t�bb term�knek ugyanaz lehet a neve. Ez nem a term�k cikksz�ma, hanem a bels� term�kazonos�t�, ami mindig egyedi.');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'A term�k cikksz�m�nak haszn�lata n�vk�nt');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'Az Igen v�laszt�sa eset�n a cikksz�m, az �n �ltal minden term�khez be�rt term�kk�d ker�l felhaszn�l�sra a term�k teljes neve helyett.');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'A gy�rt� nev�nek besz�r�sa az URL-be');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'Az Igen v�laszt�sa eset�n, ha meg van adva a gy�rt� neve, hozz�f�z�sre ker�l a term�kre mutat� keres�bar�t URL-hez.<br />P�ld�ul : enlapome.hu/gyarto-neve/termek-neve.html');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Gy�rt� azonos�t�j�nak besz�r�sa');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'Az Igen v�laszt�sa eset�n a gy�rt� azonos�t�ja hozz�f�z�sre ker�l a keres�bar�t URL-ben a gy�rt� nev�hez az elej�n<br />P�ld�ul : enlapom.hu/6-gyarto-neve/3-az-en-nagyon-szep-termekem.html.');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Besz�rand� kateg�ri�k');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'A <strong>Nincs</strong> v�laszt�sa eset�n egy kateg�ria sem ker�l besz�r�sra a megtekintend� term�khez vezet� URL-be, p�ld�ul : <br /> enlapom.hu/joomla-cms.html<br />A <strong>Csak az utols�</strong> v�laszt�sa eset�n annak a kateg�ri�nak a neve ker�l besz�r�sra a keres�bar�t URL-be, amelyikbe a term�k tartozik, p�ld�ul : <br /> enlapom.hu/joomla/joomla-cms.html<br /><strong>Az �sszes be�gyazott kateg�ria</strong> v�laszt�sa eset�n az �sszes olyan kateg�ri�nak a neve hozz�ad�sra ker�l, amelyikbe a term�k tartozik, p�ld�ul : <br /> enlapom.hu/szoftver/cms/joomla/joomla-cms.html');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'Nincs');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'Csak az utols�');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'Az �sszes be�gyazott kateg�ria');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'A kateg�riaazonos�t� besz�r�sa az URL-ben');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', 'Az Igen v�laszt�sa eset�n a kateg�riaazonos�t� hozz�f�z�sre ker�l a term�khez vezet� URL-ben a kateg�rian�v elej�hez, mint itt : <br /> enlapom.hu/1-szoftver/4-cms/1-joomla/joomla-cms.html');

// V 1.2.4.h
// insert numerical id params
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', 'Egyedi ID');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', 'Numerikus azonos�t� besz�r�sa az URL-be');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', 'Az <strong>Igen</strong> v�laszt�sa eset�n egy numerikus azonos�t� ker�l hozz�ad�sra az URL-hez, ami el�seg�ti az olyan szolg�ltat�sokba t�rt�n� bev�telt, mint a Google news. Az azonos�t� form�tuma a k�vetkez� : 2007041100000, ahol 20070411 a l�trehoz�s d�tuma, a 00000 pedig a tartalmi elem bels� egyedi azonos�t�ja. V�g�l is csak akkor kell megadnia a l�trehoz�s d�tum�t, amikor a tartalmi elem k�zz�t�telre k�sz. �gyeljen arra, hogy ut�na m�r ne v�ltoztassa meg.');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', 'Minden kateg�ria');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Mely kateg�ri�kra alkalmazand�');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'A numerikus azonos�t� csak az ebben a list�ban tal�lhat� tartalmi elemek URL-jeibe ker�l besz�r�sra. A CTRL billenty� le�t�s�vel �s lenyomva tart�s�val v�laszthat ki t�bb kateg�ri�t a kateg�rian�vre kattint�ssal.');

// V 1.2.4.j
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', '301 �tir�ny�t�s nem keres�bar�t URL-r�l keres�bar�tra');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', 'Az <strong>Igen</strong> v�laszt�sa eset�n az adatb�zisban m�r megtal�lhat� nem keres�bar�t URL egy 301 - V�gleg �thelyezve �tir�ny�t�ssal ker�l �tir�ny�t�sra a keres�bar�t v�ltozatra. Ha a keres�bar�t URL nem l�tezik, akkor l�trehoz�sra ker�l, kiv�ve, ha van n�h�ny tov�bb�tott POST adat az oldal k�r�s�ben.');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'SSL biztons�gos URL');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', '�ll�tsa ezt <strong>SSL m�dban a webhely teljes alap URL-j�re</strong>.<br />Csak https hozz�f�r�s haszn�lata eset�n kell. Ha nem adja meg, akkor a httpS://normalwebhelyURL lesz az alap�rtelmezett<br />K�rj�k, hogy a teljes URL-t �rja be, z�r� perjel n�lk�l. P�ld�ul : <strong>https://www.weblapom.hu</strong> vagy <strong>https://megosztottsslkiszolgalo.hu/fiokom</strong>.');

// V 1.2.4.k
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'iJoomla Magazine be�ll�t�sai');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', 'Az iJoomla Magazine aktiv�l�sa a tartalomban');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', 'Az <strong>Igen</strong> v�laszt�sa eset�n a kiad�s param�tere ha tov�bb�t�sra ker�l a com_content komponensnek, akkor az iJoomla magazin kiad�s azonos�t�jak�nt ker�l �rtelmez�sre.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'A sz�m azonos�t�j�nak besz�r�sa az URL-be');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Az <strong>Igen</strong> v�laszt�sa eset�n a sz�m egyedi bels� azonos�t�ja hozz�f�z�sra ker�l mindegyik sz�m nev�hez, hogy biztos�tsa egyedis�g�t.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', 'A magazin nev�nek besz�r�sa az URL-be');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', 'Az <strong>igen<strong> v�laszt�sa eset�n a magazin neve (a magazin men�pontj�nak c�m�ben meghat�rozottak alapj�n) mindig hozz�f�z�sre ker�l a keres�bar�t URL-hez');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', 'Alap�rtelmezett magazin neve');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', 'Ha az el�z� param�tern�l az Igent v�lasztotta, akkor itt fel�lb�r�lhatja a keres�bar�t URL-be besz�rt sz�veget. Ez a sz�veg v�ltozatlan marad, nem ker�l leford�t�sra p�ld�ul');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'A magazin azonos�t�j�nak besz�r�sa az URL-be');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Az <strong>Igen</strong> v�laszt�sa eset�n a magazin azonos�t�ja hozz�f�z�sra ker�l mindegyik magain nev�hez az URL-ben, mint ebben : <br /> enweblapom.hu/<strong>4</strong>-Joomla-magazine/Jo-cikk-cim.html');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Cikkazonos�t� besz�r�sa az URL-be');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Az <strong>Igen</strong> v�laszt�sa eset�n a cikk azonos�t�ja hozz�f�z�sre ker�l az URL-be besz�rt mindegyik cikkc�mhez, mint itt : <br /> enweblapom.hu/Joomla-magazine/<strong>56</strong>-Jo-cikk-cime.html');

define('_COM_SEF_SH_CB_TITLE', 'Community Builder be�ll�t�sai ');
define('_COM_SEF_SH_CB_INSERT_NAME', 'A Community Builder nev�nek besz�r�sa');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', 'Az <strong>Igen</strong> v�laszt�sa eset�n a Community Builder f�oldal�hoz vezet� men�pont c�me hozz�f�z�sra ker�l az �sszes CB keres�bar�t URL-hez');
define('_COM_SEF_SH_CB_NAME', 'Alap�rtelmezett CB n�v');
define('_COM_SEF_TT_SH_CB_NAME', 'Az el�z� param�ter Igenre �ll�t�sakor itt b�r�lhatja fel�l a keres�bar�t URL-be besz�rt sz�veget. Ez a sz�veg v�ltozatlan marad, nem ker�l leford�t�sra p�ld�ul.');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', 'Felhaszn�l�n�v besz�r�sa');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', 'Az <strong>Igen</strong> v�laszt�sa eset�n a felhaszn�l�n�v besz�r�sra ker�l a keres�bar�t URL-ekbe. <strong>FIGYELMEZTET�S</strong>: ez az adatb�zis m�ret�nek jelent�s megn�veked�s�hez vezethet, �s lelass�thatja a webhelyet, ha sok a regisztr�lt felhaszn�l�. A Nem v�laszt�sa eset�n a felhaszn�l� azonos�t�ja ker�l helyette felhaszn�l�sra a hagyom�nyos form�tumban : ..../email-kuldese-a-felhasznalonak.html?user=245');
define('_COM_SEF_SH_CB_INSERT_USER_ID', 'A felhaszn�l� azonos�t�j�nak besz�r�sa');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', 'Az <strong>Igen</strong> v�laszt�sa eset�n a felhaszn�l� azonos�t�ja ker�l hozz�f�z�sra a nev�hez, <strong>ha az el�z� lehet�s�get is Igenre �ll�totta</strong>, csak abban az esetben, ha k�t felhaszn�l�nak ugyanaz a neve.');

define('_COM_SEF_SH_LOG_404_ERRORS', '404-es hib�k napl�z�sa');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', 'Az <strong>Igen</strong> v�laszt�sa eset�n a 404-es hib�k az adatb�zisba ker�lnek napl�z�sra. Ez seg�thet a webhely�nek hivatkoz�saiban l�v� hib�k megkeres�s�ben. A sz�ks�gesn�l t�bb adatb�zishelyre van hozz� sz�ks�g, ez�rt a webhely alapos letesztel�se ut�n tal�n le is tilthatja.');

define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', 'Kieg�sz�t� sz�veg');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', 'Az <strong>Igen</strong> v�laszt�sa eset�n kieg�sz�t� sz�veg ker�l hozz�f�z�sre a tall�zand� kateg�ri�k URL-jeihez. P�ld�ul : ..../kategoria-A/Az-osszes-termek-megtekintse.html VS ..../kategoria-A/ .');

// V 1.2.4.m
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', '301-es �tir�ny�t�s a JOOMLA SEF-r�l az sh404SEF-re');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Az <strong>Igen</strong> v�laszt�sa eset�n a hagyom�nyos JOOMLA SEF URL-ek az sh404SEF megfelel�ikre ker�lnek 301-es �tir�ny�t�sra, ha megtal�lhat�ak az adatb�zisban. Ha nincs, akkor r�pt�ben l�trehoz�sra ker�lnek, ha nincs valamilyen POST adat, amikor is nem t�rt�nik semmi.');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Term�klap nev�nek besz�r�sa');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'Az Igen v�laszt�sa eset�n a term�klap neve besz�r�sra ker�l a term�kadatokhoz vezet� URL-be. Letilthatja, ha csak egy term�klapot haszn�l.');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Letterman be�ll�t�sai ');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'A Letterman oldal alap�rtelmezett elemazonos�t�ja');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', '�rja be a Letterman hivatkoz�saiba besz�rand� elemazonos�t�t (lemond�s, �zenetek meger�s�t�se, ...');
define('_COM_SEF_SH_FB_TITLE', 'Fireboard be�ll�t�sai ');
define('_COM_SEF_SH_FB_INSERT_NAME', 'A Fireboard nev�nek besz�r�sa');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', 'Az <strong>Igen</strong> v�laszt�sa eset�n a Fireboard f�oldal�hoz vezet� men�pont c�me hozz�f�z�sre ker�l a Fireboard �sszes keres�bar�t URL-j�hez');
define('_COM_SEF_SH_FB_NAME', 'A Fireboard alap�rtelmezett neve');
define('_COM_SEF_TT_SH_FB_NAME', 'Az <strong>Igen<strong> v�laszt�sa eset�n a Fireboard neve (a Fireboard men�pontban meghat�rozottak szerint) mindig hozz�f�z�sre ker�l a keres�bar�t URL-hez.');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', 'Kateg�rian�v besz�r�sa');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', 'Az Igen v�laszt�sa eset�n a kateg�rian�v besz�r�sra ker�l az �sszes hozz�sz�l�s vagy kateg�ria keres�bar�t hivatkoz�s�ba');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', 'Kateg�ria-azonos�t� besz�r�sa');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', 'Az <strong>Igen</strong> v�laszt�sa eset�n a kateg�ria-azonos�t� hozz�f�z�sre ker�l a nev�hez, <strong>ha az el�z� lehet�s�gn�l is az Igent v�lasztotta</strong>, csak ebben az esetben k�t kateg�ri�nak lesz ugyanaz a neve.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', 'A hozz�sz�l�s t�rgy�nak besz�r�sa');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', 'Az <strong>Igen</strong> v�laszt�sa eset�n minden egyes hozz�sz�l�s t�rgya besz�r�sra ker�l a hozz�sz�l�shoz vezet� keres�bar�t URL-be ');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', 'A hozz�sz�l�s azoos�t�j�nak besz�r�sa');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', 'Az <strong>Igen</strong> v�laszt�sa eset�n a hozz�sz�l�s azonos�t�sz�ma hozz�f�z�sre ker�l a t�rgyhoz, <strong>ha az el�z� lehet�s�gn�l is az Igent v�lasztotta</strong>, csak ebben az esetben k�t hozz�sz�l�snak lesz ugyanaz a t�rgya.');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', 'A nyelvk�d besz�r�sa az URL-be');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE', 'Az <strong>Igen</strong> v�laszt�sa eset�n az oldal nyelv�nek ISO-k�dja besz�r�sra ker�l a keres�bar�t URL-be, kiv�ve, ha a nyelv a webhely alap�rtelmezett nyelve.');
DEFINE('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','Nincs leford�t�s');
DEFINE('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','Nincs k�dbesz�r�s');
define('_COM_SEF_SH_ADV_MANAGE_URL', 'URL feldolgoz�s');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', 'Mindegyik telep�tett komponens eset�n:<br /><b>az alap�rtelmezett kezel� haszn�lata</b><br/>feldolgoz�s norm�l m�don, ha van SEF Advanced kiterjeszt�s, akkor az ker�l felhaszn�l�sra helyette. <br/><b>nincs gyors�t�t�raz�s</b><br/>nincs t�rol�s az adatb�zisban, �s r�gi st�lus� keres�bar�t URL-ek l�trehoz�sa<br/><b>kihagy�s</b><br/>nincs keres�bar�t URL-k�sz�t�s ehhez a komponenshez<br/>');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', 'Az URL leford�t�sa');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', 'V�lassza ki mindegyik telep�tett komponens sz�m�ra, hogy le kell-e ford�tani az URL-t. Nem �rv�nyes, ha a webhely egynyelv�.');
define('_COM_SEF_SH_ADV_INSERT_ISO', 'A nyelvk�d besz�r�sa');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', 'Mindegyik telep�tett komponenshez, �s ha a webhely t�bbnyelv�, v�lassza ki, hogy be kell-e sz�rni a c�lnyelv ISO-k�dj�t a keres�bar�t URL-be. P�ld�ul : www.weblapom.hu/<b>fr</b>/introduction.html. Az fr jelent�sse francia. Ez a k�d nem ker�l besz�r�sra az alap�rtelmezett nyelv URL-j�be.');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'A felhaszn�l�n�v besz�r�sa');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', 'Az <strong>Igen</strong> v�laszt�sa eset�n a felhaszn�l�n�v ker�l besz�r�sra a keres�bar�t URL-be a val�di n�v helyett, ha aktiv�lta a fenti tulajdons�got.');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', 'A saj�t SEF kiterjeszt�s hat�lytalan�t�sa');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', 'Nincs SEF kiterjeszt�s fel�lb�r�l�s');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', 'Egyes komponensekhez adnak ki SEF kiterjeszt�sf�jlt (sef_ext), ami haszn�lhat� az OpenSEF-hez vagy a SEF Advance-hoz. Az sh404SEF fel tudja �ket haszn�lni. Ha ennek a param�ternek A saj�t SEF kiterjeszt�s hat�lytalan�t�sa a be�ll�t�sa, akkor az then sh404SEF a saj�t kiterjeszt�s�t fogja felhaszn�lni (ha van hozz�!), mint a komponenshez kiadottat. A Nincs SEF kiterjeszt�s fel�lb�r�l�s v�laszt�sa eset�n a komponenshez adott SEF kiterjeszt�s ker�l felhaszn�l�sra.');
//V 1.2.4.q
define('_COM_SEF_SH_CONF_TAB_MAIN', 'Main');
define('_COM_SEF_SH_CONF_TAB_PLUGINS', 'Plugins');
define('_COM_SEF_SH_CONF_TAB_ADVANCED', 'Advanced');
define('_COM_SEF_SH_CONF_TAB_BY_COMPONENT', 'By component');

// V 1.2.4.q
define('_COM_SEF_SH_ENCODE_URL', 'Encode URL');
define('_COM_SEF_TT_SH_ENCODE_URL', 'If set to Yes, URL will be encoded so as to be compatible with languages having non-latin characters. Encoded URL will look like : mysite.com/%34%56%E8%67%12.....');
define('_COM_SEF_SH_FILTER', 'Filtre');
define('_COM_SEF_CONFIRM_ERASE_CACHE', 'Do you want to clear the URL cache ? This is highly recommended after changing configuration. To generate again the cache, you should browse again your homepage, or better : generate a sitemap for your site.');;
define('_COM_SEF_SH_CAT_TABLE_SUFFIX', 'Table');
define('_COM_SEF_SH_REDIR_TOTAL', 'Total');
define('_COM_SEF_SH_REDIR_SEF', 'SEF');
define('_COM_SEF_SH_REDIR_404', '404');
define('_COM_SEF_SH_REDIR_CUSTOM', 'Custom');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'men�azonos�t�');
define('_COM_SEF_SH_FORCE_NON_SEF_HTTPS', 'Force non sef if HTTPS');
define('_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS', 'If set to Yes, URL will be forced to non sef after switching to SSL mode(HTTPS). This allows operation with some shared SSL servers causing problems otherwise.');
define('_COM_SEF_SH_GUESS_HOMEPAGE_ITEMID', 'Guess Itemid on homepage');
define('_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID', 'If set to yes, and on homepage only, Itemid of com_content URLs will be removed and replaced by the one sh404SEF guestimates. This is useful when some content elements can be viewed on the frontpage (in blog view for instance), and also on other pages on the site.');

?>
