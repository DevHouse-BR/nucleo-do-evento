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

defined( '_VALID_MOS' ) or die( 'A közvetlen hozzáférés ehhez a helyhez nem engedélyezett.');

// admin interface

DEFINE('_COM_SEF_CONFIG', 'sh404SEF<br/>beállításai');
DEFINE('_COM_SEF_CONFIG_DESC','Az sh404SEF funkcióinak konfigurálása');
DEFINE('_COM_SEF_HELP', 'sh404SEF<br/>támogatás');
DEFINE('_COM_SEF_HELPDESC','Segítségre van szüksége az sh404SEF használatához?');
DEFINE('_COM_SEF_INFO', 'sh404SEF<br/>dokumentáció');
DEFINE('_COM_SEF_INFODESC','Az sh404SEF projekt összegzésének és dokumentációjának megtekintése');
DEFINE('_COM_SEF_VIEWURL','Keresõbarát URL-ek<br/>megtekintése/szerkesztése');
DEFINE('_COM_SEF_VIEWURLDESC','A keresõbarát URL-ek megtekintése/szerkesztése');
DEFINE('_COM_SEF_VIEW404','404 napló<br/>megtekintése/módosítása');
DEFINE('_COM_SEF_VIEW404DESC','A 404 napló megtekintése/módosítása');
DEFINE('_COM_SEF_VIEWCUSTOM','Egyéni átirányítások<br/>megtekintése/módosítása');
DEFINE('_COM_SEF_VIEWCUSTOMDESC','Az egyéni átirányítások megtekintése/módosítása');
DEFINE('_COM_SEF_SUPPORT','Támogató<br/>webhely');
DEFINE('_COM_SEF_SUPPORTDESC','Kapcsolódás az sh404SEF webhelyéhez (új ablakban)');
DEFINE('_COM_SEF_BACK','Vissza az sh404SEF vezérlõpulthoz');
DEFINE('_COM_SEF_PURGEURL','Keresõbarát URL-ek<br/>kiürítése');
DEFINE('_COM_SEF_PURGEURLDESC','A keresõbarát URL-ek kiürítése');
DEFINE('_COM_SEF_PURGE404','404 napló<br/>kiürítése');
DEFINE('_COM_SEF_PURGE404DESC','A 404 napló kiürítése');
DEFINE('_COM_SEF_PURGECUSTOM','Egyéni átirányítások<br/>kiürítése');
DEFINE('_COM_SEF_PURGECUSTOMDESC','Az egyéni átirányítások kiürítése');
DEFINE('_COM_SEF_WARNDELETE','FIGYELEM!!!<br/>Ön ');
DEFINE('_COM_SEF_RECORD',' rekord törlésére készül');
DEFINE('_COM_SEF_RECORDS',' rekord törlésére készül');
DEFINE('_COM_SEF_NORECORDS','Nem található egy rekord sem.');
DEFINE('_COM_SEF_PROCEED',' Folytatja ');
DEFINE('_COM_SEF_OK',' OK ');
DEFINE('_COM_SEF_SUCCESSPURGE','A rekordok kiürítése sikerült');
DEFINE('_PREVIEW_CLOSE','Ablak bezárása');
DEFINE('_COM_SEF_EMPTYURL','Kérjük, hogy adja meg az átirányítás URL-jét.');
DEFINE('_COM_SEF_NOLEADSLASH','NE KEZDÕDJÖN PERJELLEL az új keresõbarát URL');
DEFINE('_COM_SEF_BADURL','A régi nem keresõbarát URL-nek index.php-val kell kezdõdnie');
DEFINE('_COM_SEF_URLEXIST','Már megtalálható ez az URL az adatbázisban!');
DEFINE('_COM_SEF_SHOW0','Keresõbarát URL-ek');
DEFINE('_COM_SEF_SHOW1','404 napló');
DEFINE('_COM_SEF_SHOW2','Egyéni átirányítások');
DEFINE('_COM_SEF_INVALID_URL','ÉRVÉNYTELEN URL: ehhez a hivatkozáshoz érvényes elemazonosítóra van szükség, de nem található egy sem.<br/>MEGOLDÁS: Készítse el ennek az elemnek a menüpontját. Nem kell közzétennie, csak létre kell hoznia.');
DEFINE('_COM_SEF_DEF_404_MSG','<h1>404: Nem található</h1><h4>Sajnos az Ön által kért tartalmi elemet nem találjuk</h4>');
DEFINE('_COM_SEF_SELECT_DELETE','Jelölje ki a törlendõ elemet');
DEFINE('_COM_SEF_ASC',' (növ) ');
DEFINE('_COM_SEF_DESC',' (csökk) ');
DEFINE('_COM_SEF_WRITEABLE',' <b><font color="green">írható</font></b>');
DEFINE('_COM_SEF_UNWRITEABLE',' <b><font color="red">írásvédett</font></b>');
DEFINE('_COM_SEF_USING_DEFAULT',' <b><font color="red">Alapértelmezett értékek használata</font></b>');
DEFINE('_COM_SEF_DISABLED',"<p class='error'>MEGJEGYZÉS: A Joomla/Mambo keresõbarát támogatása jelenleg letiltott. Ha használni kívánja a keresõbarát webcímeket, akkor engedélyezze az <a href='"
.$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Általános beállítások</a> SEO lapján.</p>");
DEFINE('_COM_SEF_TITLE_CONFIG','A sh404SEF konfigurációs fájl');
DEFINE('_COM_SEF_TITLE_BASIC','Alapbeállítások');
DEFINE('_COM_SEF_ENABLED','Engedélyezett');
DEFINE('_COM_SEF_TT_ENABLED','A Nem választása esetén a Joomla/Mambo alapértelmezett keresõbarát funkcióját fogja használni a rendszer');
DEFINE('_COM_SEF_DEF_404_PAGE','Alapértelmezett 404 oldal');
DEFINE('_COM_SEF_REPLACE_CHAR','Karakterhelyettesítés');
DEFINE('_COM_SEF_TT_REPLACE_CHAR','Az URL-ben elõforduló ismeretlen karaktereket behelyettesítõ karakter');
DEFINE('_COM_SEF_PAGEREP_CHAR','Oldalelválasztó karakter');
DEFINE('_COM_SEF_TT_PAGEREP_CHAR','Az oldalszámokat az URL többi részétõl történõ elválasztásra használandó karakter');
DEFINE('_COM_SEF_STRIP_CHAR','Eltávolítandó karakterek');
DEFINE('_COM_SEF_TT_STRIP_CHAR','Az URL-bõl eltávolítandó karakterek, | szimbólummal elválasztva');
DEFINE('_COM_SEF_FRIENDTRIM_CHAR','Barátságos karakterek levágása');
DEFINE('_COM_SEF_TT_FRIENDTRIM_CHAR','Az URL-ben lévõ levágandó karakterek, | szimbólummal elválasztva');
DEFINE('_COM_SEF_USE_ALIAS','Cím aliasnevének használata');
DEFINE('_COM_SEF_TT_USE_ALIAS','A Cím aliasneve választása esetén a cím aliasneve kerül felhasználásra az URL-ben a cím helyett');
DEFINE('_COM_SEF_SUFFIX','Fájl utótag');
DEFINE('_COM_SEF_TT_SUFFIX','A \\\'fájlok\\\' esetén használandó kiterjesztés. Hagyja üresen, ha le akarja tiltani. Gyakori bejegyzés a \\\'html\\\'.');
DEFINE('_COM_SEF_ADDFILE','Alapértelmezett indexfájl.');
DEFINE('_COM_SEF_TT_ADDFILE','Üres URL után teendõ fájlnév / ha egy fájl sem létezik.  Az Ön weblapját indexelõ robotok esetén hasznos, melyek egy bizonyos fájlt keresnek azon a helyen, viszont 404-es hibát ad vissza, mert nincs ott.');
DEFINE('_COM_SEF_PAGETEXT','Az oldal szövege');
DEFINE('_COM_SEF_TT_PAGETEXT','Több oldal URL-jéhez hozzáfûzendõ szöveg. A %s használatával szúrhatja be az oldalszámot, alapértelmezésként a végére kerül. Ha meghatároz egy elõtagot, akkor hozzáfûzi ennek a karakterláncnak a végéhez.');
DEFINE('_COM_SEF_LOWER','Mind kisbetûs');
DEFINE('_COM_SEF_TT_LOWER','Az URL-ben lévõ összes karaktert kisbetûssé alakítja', 'Mind kisbetûs');
DEFINE('_COM_SEF_SHOW_SECT','Szekció belevétele');
DEFINE('_COM_SEF_TT_SHOW_SECT','Az Igen választása esetén az URL tartalmazza a szekciónevet');
DEFINE('_COM_SEF_HIDE_CAT','Kategória elrejtése');
DEFINE('_COM_SEF_TT_SHOW_CAT','Az Igen választása esetén a kategórianév kizárásra kerül az URL-bõl');
DEFINE('_COM_SEF_404PAGE','404-es oldal');
DEFINE('_COM_SEF_TT_404PAGE','Statikus tartalmi oldal használata a 404 Nem található hibák esetén (a közzétett állapot nem számít)');
DEFINE('_COM_SEF_TITLE_ADV','Speciális komponens beállítások');
DEFINE('_COM_SEF_TT_ADV','<b>alapértelmezett kezelõ használata</b><br/>a feldolgozás normál módon történik, ha létezik speciális keresõbarát kiegészítés, akkor az kerül helyette felhasználásra. <br/><b>nincs tárazás</b><br/>nem tárolja az adatbázisban, és régi stílusú keresõbarát URL-eket generál.<br/><b>kihagyás</b><br/>nem készít keresõbarát URL-eket ehhez a komponenshez<br/>');
DEFINE('_COM_SEF_TT_ADV4','Speciális beállítások: ');
DEFINE('_COM_SEF_TITLE_MANAGER','sh404SEF URL-kezelõ');
DEFINE('_COM_SEF_VIEWMODE','NézetMód:');
DEFINE('_COM_SEF_SORTBY','Rendezési mód:');
DEFINE('_COM_SEF_HITS','Találatok');
DEFINE('_COM_SEF_DATEADD','Hozzáadva');
DEFINE('_COM_SEF_SEFURL','Keresõbarát URL');
DEFINE('_COM_SEF_URL','URL');
DEFINE('_COM_SEF_REALURL','Valódi URL');
DEFINE('_COM_SEF_EDIT','Szerkesztés :');
DEFINE('_COM_SEF_ADD','Hozzáadás :');
DEFINE('_COM_SEF_NEWURL','Új keresõbarát URL');
DEFINE('_COM_SEF_TT_NEWURL','Csak relatív átirányítás a Joomla/Mambo gyökérbõl, az elején / jel <i>nélkül</i>');
DEFINE('_COM_SEF_OLDURL','Régi, nem keresõbarát URL');
DEFINE('_COM_SEF_TT_OLDURL','Ennek az URL-nek index.php-val kell kezdõdnie');
DEFINE('_COM_SEF_SAVEAS','Mentés egyéni átirányításként');
DEFINE('_COM_SEF_TITLE_SUPPORT','sh404SEF támogatás');
DEFINE('_COM_SEF_HELPVIA','<b>Segítséget az alábbi fórumokban kaphat:</b>');
DEFINE('_COM_SEF_OFFICIAL','Projekt hivatalos fóruma');
DEFINE('_COM_SEF_MAMBERS','Mambers fórum');
DEFINE('_COM_SEF_TITLE_PURGE','sh404SEF adatbázis kiürítése');
DEFINE('_COM_SEF_USE_DEFAULT','(alapértelmezett kezelõ használata)');
DEFINE('_COM_SEF_NOCACHE','nincs tárazás');
DEFINE('_COM_SEF_SKIP','kihagyás');
DEFINE('_COM_SEF_INSTALLED_VERS','Telepített verzió:');
DEFINE('_COM_SEF_COPYRIGHT','Copyright');
DEFINE('_COM_SEF_LICENSE','Licenc');
DEFINE('_COM_SEF_SUPPORT_404SEF','Támogatás');
DEFINE('_COM_SEF_CONFIG_UPDATED','A beállítások módosítása kész');
DEFINE('_COM_SEF_WRITE_ERROR','Hiba történt a konfigurációs fájl írásakor');
DEFINE('_COM_SEF_NOACCESS','Nem lehet hozzáférni a következõ táblához: ');
DEFINE('_COM_SEF_FATAL_ERROR_HEADERS','VÉGZETES HIBA: A FEJLÉC ELKÜLDÉSE MÁR MEGTÖRTÉNT');
DEFINE('_COM_SEF_UPLOAD_OK','A fájl feltöltése sikerült');
DEFINE('_COM_SEF_ERROR_IMPORT','Az importálás közben hiba történt:');
DEFINE('_COM_SEF_INVALID_SQL','ÉRVÉNYTELEN ADATOKAT TARTALMAZ AZ SQL FÁJL :');
DEFINE('_COM_SEF_NO_UNLINK','Nem távolítható el a feltöltött fájl a media könyvtárból');
DEFINE('_COM_SEF_IMPORT_OK','Az egyéni URL-ek importálása sikerült!');
DEFINE('_COM_SEF_WRITE_FAILED','Nem írható a media könyvtárba feltöltött fájl');
DEFINE('_COM_SEF_EXPORT_FAILED','AZ EXPORTÁLÁS NEM SIKERÜLT!!!');
DEFINE('_COM_SEF_IMPORT_EXPORT','Egyéni URL-ek importálása/exportálása');
DEFINE('_COM_SEF_SELECT_FILE','Kérjük, hogy elõbb válassza ki a fájlt');
DEFINE('_COM_SEF_IMPORT','Egyéni URL-ek importálása');
DEFINE('_COM_SEF_EXPORT','Egyéni URL-ek biztonsági mentése');

// component interface

DEFINE('_COM_SEF_NOREAD','VÉGZETES HIBA: Nem olvasható be a fájl ');
DEFINE('_COM_SEF_CHK_PERMS','Kérjük, hogy ellenõrizze a fájlengedélyeket, és biztosítsa, hogy ez a fájl olvasható legyen.');
DEFINE('_COM_SEF_DEBUG_DATA_DUMP','A HIBAKERESÉSI ADATOK KIÍRATÁSA BEFEJEZÕDÖTT: Az oldalbetöltés leállt');
DEFINE('_COM_SEF_STRANGE','Valami különös történt. Ennek nem szabadna elõfordulnia<br />');

//Added by Leon

define('_FULL_TITLE','Teljes cím');
define('_TITLE_ALIAS','Cím aliasneve');
define('_COM_SEF_SHOW_CAT','Kategória megjelenítése');

// added by shumisha
// hungarian translation by Jozsef Tamas Herczeg 2007-04-09
// General params
define('_COM_SEF_SH_REPLACEMENTS', 'Karaktercserék listája');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Az URL-ben nem elfogadott karakterek, mint a nem-latin vagy ékezetes betûk, lecserélhetõk e behelyettesítõ táblázat alapján. <br />A behelyettesítési szabály formátuma xxx | yyy. Az xxx a lecserélendõ karakter, az yyy pedig az új karakter. <br />Sok ilyen vesszõvel (,) elválasztott szabály lehet. A régi és az új karakter között használja a | karaktert. <br />Az xxx vagy az yyy több karakter is lehet, mint például Œ|oe ');

// cache params
define('_COM_SEF_SH_CACHE_TITLE', 'Gyorsítótár-kezelés');
define('_COM_SEF_SH_USE_URL_CACHE', 'Az URL gyorsítótárazás aktiválása');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'Aktiválás esetén a keresõbarát URL a memóriában lévõ gyorsítótárba kerül beírásra, ami jelentõsen meg fogja növelni az oldal betöltõdésének idejét. Ez azonban fel fogja használni a memóriát!');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'A gyorsítótár mérete');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'Az URL gyorsítótárazás aktiválása esetén ez a paraméter állítja be a legnagyobb méretet. Írja be a gyorsítótárban tárolható URL-ek számát (további URL kerül feldolgozásra, de nem kerül be a gyorsítótárba, ezért a betöltés ideje hosszabb lesz). Általánosságban szólva, mindegyik URL körülbelül 200 bájtot tesz ki (100 a keresõbarát URL, és 100 a nem keresõbarát URL). Tehát, például  5000 URL kb. 1 MB memóriát fog felhasználni.');
// URL translation
define('_COM_SEF_SH_TRANSLATION_TITLE', 'Fordítás kezelése');
define('_COM_SEF_SH_TRANSLATE_URL', 'Az URL lefordítása');
define('_COM_SEF_TT_SH_TRANSLATE_URL', 'Ha aktiválja, és a webhely többnyelvû, akkor a keresõbarát URL elemei a Joomfish döntése alapján lefordításra kerülnek a látogató nyelvére. Ha nem aktiválja, akkor az URL mindig a webhely alapértelmezett nyelvén lesz. Nem kerül felhasználásra, ha a webhely nem többnyelvû.');
// itemid control
define('_COM_SEF_SH_ITEMID_TITLE', 'Elemazonosító-kezelés');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'A menü-elemazonosító beszúrása, ha nincs');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Ha nincs megadva elemazonosító a nem keresõbarát URL-ben a keresõbaráttá alakítás elõtt, Ön pedig ezt a lehetõséget igazra állította, akkor a jelenlegi menüpont elemazonosítója hozzáadásra kerül. Ez fogja biztosítani azt, hogy kattintáskor a hivatkozás ugyanazon az oldalon fog maradni (pl: ugyanazok a modulok láthatók)');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'A menücím beszúrása, ha nincs elemazonosító');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'Ha nincs megadva elemazonosító a nem keresõbarát URL-ben a keresõbaráttá alakítás elõtt, Ön pedig ezt a lehetõséget igazra állította, akkor a jelenlegi menüpont címe beszúrásra kerül a keresõbarát URL-be. Akkor állítsa ezt igazra, ha a fenti paramétert is igazra állította, ugyanis ez megakadályozza a -2, -3, -... hozzáfûzését a keresõbarát URL-hez, ha valamelyik cikket több helyrõl nézik.');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'A menücím beszúrása minden alkalommal');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'Az igen választása esetén az elemazonosítónak megfelelõ menüpont címe kerül beszúrásra a nem keresõbarát URL-be, vagy ha nincs megadva egy elemazonosító sem, a jelenlegi menüpont címe beszúrásra kerül a keresõbarát URL-be.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Az elemazonosító hozzáfûzése a SEF URL-hez minden alkalommal');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'Az Igen választása esetén a nem keresõbarát elemazonosító (vagy a jelenlegi menüpont elemazonosítója, ha egyik sincs megadva a nem keresõbarát URL-ben) hozzáfûzésre kerül a keresõbarát URL-hez. Ezt kell használni A menücím beszúrása minden alkalommal paraméter helyett, ha több azonos címû menüpontja van (például ha van egy a fõmenüben, egy pedig a felsõ menüben)');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'menüazonosító');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Alapértelmezett menücím');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'A fenti paraméter Igenre állításával itt felülbírálhatja a keresõbarát URL-be beszúrt szöveget. Ez a szöveg változatlan lesz, és nem kerül például lefordításra.');
// Virtuemart params
define('_COM_SEF_SH_VM_TITLE', 'VirtueMart beállításai');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Az üzlet nevének beszúrása az URL-be');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'Az Igen választása esetén az üzlet neve (az üzlet menüpontjának címében meghatározottak alapján) mindig hozzáfûzésre kerül a keresõbarát URL elejéhez');
define('_COM_SEF_SH_SHOP_NAME', 'Alapértelmezett üzletnév');
define('_COM_SEF_TT_SH_SHOP_NAME', 'A fenti paraméter Igenre állításával itt felülbírálhatja a keresõbarát URL-be beszúrt szöveget. Ez a szöveg változatlan lesz, és nem kerül lefordításra például.');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'A termékazonosító beszúrása az URL-be');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'Az Igen választása esetén a termékazonosító hozzáfûzésre kerül a keresõbarát URL-ben a termék nevéhez<br />Például : enlapom.hu/3-az-en-nagyon-szep-termekem.html.<br />Ez akkor hasznos, ha nem akarja az összes kategórianevet beszúrni az URL-be, ugyanis különféle kategóriákban több terméknek ugyanaz lehet a neve. Ez nem a termék cikkszáma, hanem a belsõ termékazonosító, ami mindig egyedi.');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'A termék cikkszámának használata névként');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'Az Igen választása esetén a cikkszám, az Ön által minden termékhez beírt termékkód kerül felhasználásra a termék teljes neve helyett.');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'A gyártó nevének beszúrása az URL-be');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'Az Igen választása esetén, ha meg van adva a gyártó neve, hozzáfûzésre kerül a termékre mutató keresõbarát URL-hez.<br />Például : enlapome.hu/gyarto-neve/termek-neve.html');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Gyártó azonosítójának beszúrása');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'Az Igen választása esetén a gyártó azonosítója hozzáfûzésre kerül a keresõbarát URL-ben a gyártó nevéhez az elején<br />Például : enlapom.hu/6-gyarto-neve/3-az-en-nagyon-szep-termekem.html.');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Beszúrandó kategóriák');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'A <strong>Nincs</strong> választása esetén egy kategória sem kerül beszúrásra a megtekintendõ termékhez vezetõ URL-be, például : <br /> enlapom.hu/joomla-cms.html<br />A <strong>Csak az utolsó</strong> választása esetén annak a kategóriának a neve kerül beszúrásra a keresõbarát URL-be, amelyikbe a termék tartozik, például : <br /> enlapom.hu/joomla/joomla-cms.html<br /><strong>Az összes beágyazott kategória</strong> választása esetén az összes olyan kategóriának a neve hozzáadásra kerül, amelyikbe a termék tartozik, például : <br /> enlapom.hu/szoftver/cms/joomla/joomla-cms.html');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'Nincs');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'Csak az utolsó');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'Az összes beágyazott kategória');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'A kategóriaazonosító beszúrása az URL-ben');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', 'Az Igen választása esetén a kategóriaazonosító hozzáfûzésre kerül a termékhez vezetõ URL-ben a kategórianév elejéhez, mint itt : <br /> enlapom.hu/1-szoftver/4-cms/1-joomla/joomla-cms.html');

// V 1.2.4.h
// insert numerical id params
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', 'Egyedi ID');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', 'Numerikus azonosító beszúrása az URL-be');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', 'Az <strong>Igen</strong> választása esetén egy numerikus azonosító kerül hozzáadásra az URL-hez, ami elõsegíti az olyan szolgáltatásokba történõ bevételt, mint a Google news. Az azonosító formátuma a következõ : 2007041100000, ahol 20070411 a létrehozás dátuma, a 00000 pedig a tartalmi elem belsõ egyedi azonosítója. Végül is csak akkor kell megadnia a létrehozás dátumát, amikor a tartalmi elem közzétételre kész. Ügyeljen arra, hogy utána már ne változtassa meg.');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', 'Minden kategória');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Mely kategóriákra alkalmazandó');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'A numerikus azonosító csak az ebben a listában található tartalmi elemek URL-jeibe kerül beszúrásra. A CTRL billentyû leütésével és lenyomva tartásával választhat ki több kategóriát a kategórianévre kattintással.');

// V 1.2.4.j
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', '301 átirányítás nem keresõbarát URL-rõl keresõbarátra');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', 'Az <strong>Igen</strong> választása esetén az adatbázisban már megtalálható nem keresõbarát URL egy 301 - Végleg áthelyezve átirányítással kerül átirányításra a keresõbarát változatra. Ha a keresõbarát URL nem létezik, akkor létrehozásra kerül, kivéve, ha van néhány továbbított POST adat az oldal kérésében.');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'SSL biztonságos URL');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', 'Állítsa ezt <strong>SSL módban a webhely teljes alap URL-jére</strong>.<br />Csak https hozzáférés használata esetén kell. Ha nem adja meg, akkor a httpS://normalwebhelyURL lesz az alapértelmezett<br />Kérjük, hogy a teljes URL-t írja be, záró perjel nélkül. Például : <strong>https://www.weblapom.hu</strong> vagy <strong>https://megosztottsslkiszolgalo.hu/fiokom</strong>.');

// V 1.2.4.k
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'iJoomla Magazine beállításai');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', 'Az iJoomla Magazine aktiválása a tartalomban');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', 'Az <strong>Igen</strong> választása esetén a kiadás paramétere ha továbbításra kerül a com_content komponensnek, akkor az iJoomla magazin kiadás azonosítójaként kerül értelmezésre.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'A szám azonosítójának beszúrása az URL-be');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Az <strong>Igen</strong> választása esetén a szám egyedi belsõ azonosítója hozzáfûzésra kerül mindegyik szám nevéhez, hogy biztosítsa egyediségét.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', 'A magazin nevének beszúrása az URL-be');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', 'Az <strong>igen<strong> választása esetén a magazin neve (a magazin menüpontjának címében meghatározottak alapján) mindig hozzáfûzésre kerül a keresõbarát URL-hez');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', 'Alapértelmezett magazin neve');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', 'Ha az elõzõ paraméternél az Igent választotta, akkor itt felülbírálhatja a keresõbarát URL-be beszúrt szöveget. Ez a szöveg változatlan marad, nem kerül lefordításra például');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'A magazin azonosítójának beszúrása az URL-be');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Az <strong>Igen</strong> választása esetén a magazin azonosítója hozzáfûzésra kerül mindegyik magain nevéhez az URL-ben, mint ebben : <br /> enweblapom.hu/<strong>4</strong>-Joomla-magazine/Jo-cikk-cim.html');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Cikkazonosító beszúrása az URL-be');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Az <strong>Igen</strong> választása esetén a cikk azonosítója hozzáfûzésre kerül az URL-be beszúrt mindegyik cikkcímhez, mint itt : <br /> enweblapom.hu/Joomla-magazine/<strong>56</strong>-Jo-cikk-cime.html');

define('_COM_SEF_SH_CB_TITLE', 'Community Builder beállításai ');
define('_COM_SEF_SH_CB_INSERT_NAME', 'A Community Builder nevének beszúrása');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', 'Az <strong>Igen</strong> választása esetén a Community Builder fõoldalához vezetõ menüpont címe hozzáfûzésra kerül az összes CB keresõbarát URL-hez');
define('_COM_SEF_SH_CB_NAME', 'Alapértelmezett CB név');
define('_COM_SEF_TT_SH_CB_NAME', 'Az elõzõ paraméter Igenre állításakor itt bírálhatja felül a keresõbarát URL-be beszúrt szöveget. Ez a szöveg változatlan marad, nem kerül lefordításra például.');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', 'Felhasználónév beszúrása');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', 'Az <strong>Igen</strong> választása esetén a felhasználónév beszúrásra kerül a keresõbarát URL-ekbe. <strong>FIGYELMEZTETÉS</strong>: ez az adatbázis méretének jelentõs megnövekedéséhez vezethet, és lelassíthatja a webhelyet, ha sok a regisztrált felhasználó. A Nem választása esetén a felhasználó azonosítója kerül helyette felhasználásra a hagyományos formátumban : ..../email-kuldese-a-felhasznalonak.html?user=245');
define('_COM_SEF_SH_CB_INSERT_USER_ID', 'A felhasználó azonosítójának beszúrása');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', 'Az <strong>Igen</strong> választása esetén a felhasználó azonosítója kerül hozzáfûzésra a nevéhez, <strong>ha az elõzõ lehetõséget is Igenre állította</strong>, csak abban az esetben, ha két felhasználónak ugyanaz a neve.');

define('_COM_SEF_SH_LOG_404_ERRORS', '404-es hibák naplózása');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', 'Az <strong>Igen</strong> választása esetén a 404-es hibák az adatbázisba kerülnek naplózásra. Ez segíthet a webhelyének hivatkozásaiban lévõ hibák megkeresésében. A szükségesnél több adatbázishelyre van hozzá szükség, ezért a webhely alapos letesztelése után talán le is tilthatja.');

define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', 'Kiegészítõ szöveg');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', 'Az <strong>Igen</strong> választása esetén kiegészítõ szöveg kerül hozzáfûzésre a tallózandó kategóriák URL-jeihez. Például : ..../kategoria-A/Az-osszes-termek-megtekintse.html VS ..../kategoria-A/ .');

// V 1.2.4.m
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', '301-es átirányítás a JOOMLA SEF-rõl az sh404SEF-re');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Az <strong>Igen</strong> választása esetén a hagyományos JOOMLA SEF URL-ek az sh404SEF megfelelõikre kerülnek 301-es átirányításra, ha megtalálhatóak az adatbázisban. Ha nincs, akkor röptében létrehozásra kerülnek, ha nincs valamilyen POST adat, amikor is nem történik semmi.');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Terméklap nevének beszúrása');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'Az Igen választása esetén a terméklap neve beszúrásra kerül a termékadatokhoz vezetõ URL-be. Letilthatja, ha csak egy terméklapot használ.');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Letterman beállításai ');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'A Letterman oldal alapértelmezett elemazonosítója');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', 'Írja be a Letterman hivatkozásaiba beszúrandó elemazonosítót (lemondás, üzenetek megerõsítése, ...');
define('_COM_SEF_SH_FB_TITLE', 'Fireboard beállításai ');
define('_COM_SEF_SH_FB_INSERT_NAME', 'A Fireboard nevének beszúrása');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', 'Az <strong>Igen</strong> választása esetén a Fireboard fõoldalához vezetõ menüpont címe hozzáfûzésre kerül a Fireboard összes keresõbarát URL-jéhez');
define('_COM_SEF_SH_FB_NAME', 'A Fireboard alapértelmezett neve');
define('_COM_SEF_TT_SH_FB_NAME', 'Az <strong>Igen<strong> választása esetén a Fireboard neve (a Fireboard menüpontban meghatározottak szerint) mindig hozzáfûzésre kerül a keresõbarát URL-hez.');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', 'Kategórianév beszúrása');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', 'Az Igen választása esetén a kategórianév beszúrásra kerül az összes hozzászólás vagy kategória keresõbarát hivatkozásába');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', 'Kategória-azonosító beszúrása');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', 'Az <strong>Igen</strong> választása esetén a kategória-azonosító hozzáfûzésre kerül a nevéhez, <strong>ha az elõzõ lehetõségnél is az Igent választotta</strong>, csak ebben az esetben két kategóriának lesz ugyanaz a neve.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', 'A hozzászólás tárgyának beszúrása');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', 'Az <strong>Igen</strong> választása esetén minden egyes hozzászólás tárgya beszúrásra kerül a hozzászóláshoz vezetõ keresõbarát URL-be ');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', 'A hozzászólás azoosítójának beszúrása');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', 'Az <strong>Igen</strong> választása esetén a hozzászólás azonosítószáma hozzáfûzésre kerül a tárgyhoz, <strong>ha az elõzõ lehetõségnél is az Igent választotta</strong>, csak ebben az esetben két hozzászólásnak lesz ugyanaz a tárgya.');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', 'A nyelvkód beszúrása az URL-be');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE', 'Az <strong>Igen</strong> választása esetén az oldal nyelvének ISO-kódja beszúrásra kerül a keresõbarát URL-be, kivéve, ha a nyelv a webhely alapértelmezett nyelve.');
DEFINE('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','Nincs lefordítás');
DEFINE('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','Nincs kódbeszúrás');
define('_COM_SEF_SH_ADV_MANAGE_URL', 'URL feldolgozás');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', 'Mindegyik telepített komponens esetén:<br /><b>az alapértelmezett kezelõ használata</b><br/>feldolgozás normál módon, ha van SEF Advanced kiterjesztés, akkor az kerül felhasználásra helyette. <br/><b>nincs gyorsítótárazás</b><br/>nincs tárolás az adatbázisban, és régi stílusú keresõbarát URL-ek létrehozása<br/><b>kihagyás</b><br/>nincs keresõbarát URL-készítés ehhez a komponenshez<br/>');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', 'Az URL lefordítása');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', 'Válassza ki mindegyik telepített komponens számára, hogy le kell-e fordítani az URL-t. Nem érvényes, ha a webhely egynyelvû.');
define('_COM_SEF_SH_ADV_INSERT_ISO', 'A nyelvkód beszúrása');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', 'Mindegyik telepített komponenshez, és ha a webhely többnyelvû, válassza ki, hogy be kell-e szúrni a célnyelv ISO-kódját a keresõbarát URL-be. Például : www.weblapom.hu/<b>fr</b>/introduction.html. Az fr jelentésse francia. Ez a kód nem kerül beszúrásra az alapértelmezett nyelv URL-jébe.');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'A felhasználónév beszúrása');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', 'Az <strong>Igen</strong> választása esetén a felhasználónév kerül beszúrásra a keresõbarát URL-be a valódi név helyett, ha aktiválta a fenti tulajdonságot.');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', 'A saját SEF kiterjesztés hatálytalanítása');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', 'Nincs SEF kiterjesztés felülbírálás');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', 'Egyes komponensekhez adnak ki SEF kiterjesztésfájlt (sef_ext), ami használható az OpenSEF-hez vagy a SEF Advance-hoz. Az sh404SEF fel tudja õket használni. Ha ennek a paraméternek A saját SEF kiterjesztés hatálytalanítása a beállítása, akkor az then sh404SEF a saját kiterjesztését fogja felhasználni (ha van hozzá!), mint a komponenshez kiadottat. A Nincs SEF kiterjesztés felülbírálás választása esetén a komponenshez adott SEF kiterjesztés kerül felhasználásra.');
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
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'menüazonosító');
define('_COM_SEF_SH_FORCE_NON_SEF_HTTPS', 'Force non sef if HTTPS');
define('_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS', 'If set to Yes, URL will be forced to non sef after switching to SSL mode(HTTPS). This allows operation with some shared SSL servers causing problems otherwise.');
define('_COM_SEF_SH_GUESS_HOMEPAGE_ITEMID', 'Guess Itemid on homepage');
define('_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID', 'If set to yes, and on homepage only, Itemid of com_content URLs will be removed and replaced by the one sh404SEF guestimates. This is useful when some content elements can be viewed on the frontpage (in blog view for instance), and also on other pages on the site.');

?>
