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
// Italian Translation by Mac - http://www.simfly.it
//
// Dont allow direct linking
defined( '_VALID_MOS' ) or die( 'Un accesso diretto a questa locazione non è consentito.' );
// admin interface
DEFINE('_COM_SEF_CONFIG','Configurazione<br/> di sh404SEF');
DEFINE('_COM_SEF_CONFIG_DESC','Configura  tutte le funzionalità di sh404SEF');
DEFINE('_COM_SEF_HELP','Supporto <br/>di sh404SEF');
DEFINE('_COM_SEF_HELPDESC','Serve aiuto con sh404SEF?');
DEFINE('_COM_SEF_INFO','Documentazione<br/>di sh404SEF');
DEFINE('_COM_SEF_INFODESC','Vedi Sommario e Documentazione del progetto sh404SEF');
DEFINE('_COM_SEF_VIEWURL','Vedi/Modifica<br/>SEF Urls');
DEFINE('_COM_SEF_VIEWURLDESC','Vedi/Modifica SEF Urls');
DEFINE('_COM_SEF_VIEW404','Vedi/Modifica<br/>404 Logs');
DEFINE('_COM_SEF_VIEW404DESC','Vedi/Modifica 404 Logs');
DEFINE('_COM_SEF_VIEWCUSTOM','Vedi/Modifica<br/>Reindirizzamenti personalizzati');
DEFINE('_COM_SEF_VIEWCUSTOMDESC','Vedi/Modifica Reindirizzamenti personalizzati');
DEFINE('_COM_SEF_SUPPORT','Sito<br/>di supporto');
DEFINE('_COM_SEF_SUPPORTDESC','Apri il sito ufficiale di sh404SEF (in una nuova finestra)');
DEFINE('_COM_SEF_BACK','Torna al pannello di controllo di sh404SEF');
DEFINE('_COM_SEF_PURGEURL','Sfoltisci<br/>SEF Urls');
DEFINE('_COM_SEF_PURGEURLDESC','Sfoltisci SEF Urls');
DEFINE('_COM_SEF_PURGE404','Sfoltisci<br/>404 Logs');
DEFINE('_COM_SEF_PURGE404DESC','Sfoltisci 404 Logs');
DEFINE('_COM_SEF_PURGECUSTOM','Sfoltisci<br/>Reindirizzamenti personalizzati');
DEFINE('_COM_SEF_PURGECUSTOMDESC','Sfoltisci Reindirizzamenti personalizzati');
DEFINE('_COM_SEF_WARNDELETE','ATTENZIONE!!!<br/>stai per  cancellare ');
DEFINE('_COM_SEF_RECORD',' record');
DEFINE('_COM_SEF_RECORDS',' records');
DEFINE('_COM_SEF_NORECORDS','Nessun record trovato.');
DEFINE('_COM_SEF_PROCEED',' Procedi ');
DEFINE('_COM_SEF_OK',' OK ');
DEFINE('_COM_SEF_SUCCESSPURGE','I records sono stati sfoltiti');
DEFINE('_PREVIEW_CLOSE','Chiudi questa finestra');
DEFINE('_COM_SEF_EMPTYURL','Devi inserire una URL, per il reindirizzamento.');
DEFINE('_COM_SEF_NOLEADSLASH','La nuova SEF URL non deve avere la barra (slash) all\'inizio');
DEFINE('_COM_SEF_BADURL','La vecchia URL non-SEF deve iniziare con index.php');
DEFINE('_COM_SEF_URLEXIST','Questa URL è già esistente nel database!');
DEFINE('_COM_SEF_SHOW0','Mostra SEF Urls');
DEFINE('_COM_SEF_SHOW1','Mostra 404 Log');
DEFINE('_COM_SEF_SHOW2','Mostra Reindirizzamenti personalizzati');
DEFINE('_COM_SEF_INVALID_URL','URL NON VALIDA: questo link richiede un Itemid valido, ma non è stato trovato.<br/>SOLUZIONE: Crea un menu per questo articolo. Se non ce ne sono da pubblicare, basta crearlo.');
DEFINE('_COM_SEF_DEF_404_MSG','<h1>404: Non Trovato</h1><h4>Spiacente, ma il contenuto che stai cercando non è presente in questo server</h4>');
DEFINE('_COM_SEF_SELECT_DELETE','Seleziona un articolo da cancellare');
DEFINE('_COM_SEF_ASC',' (asc) ');
DEFINE('_COM_SEF_DESC',' (disc) ');
DEFINE('_COM_SEF_WRITEABLE',' <b><font color="green">Scrivibile</font></b>');
DEFINE('_COM_SEF_UNWRITEABLE',' <b><font color="red">Non scrivibile</font></b>');
DEFINE('_COM_SEF_USING_DEFAULT',' <b><font color="red">Usa i valori predefiniti</font></b>');
DEFINE('_COM_SEF_DISABLED',"<p class='error'>NOTA: Il supporto SEF in Joomla/Mambo è attualmente disabilitato. Per usare SEF, attivalo da <a href='".
	$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Configurazione Globale</a> pagina SEO.</p>");
DEFINE('_COM_SEF_TITLE_CONFIG',' Configurazione sh404SEF');
DEFINE('_COM_SEF_TITLE_BASIC','Configurazione base');
DEFINE('_COM_SEF_ENABLED','Attivato');
DEFINE('_COM_SEF_TT_ENABLED','Se settata su No sarà usato il SEF di Joomla/Mambo');
DEFINE('_COM_SEF_DEF_404_PAGE','<b>Pagina 404 standard</b><br>');
DEFINE('_COM_SEF_REPLACE_CHAR','Sostituzione carattere');
DEFINE('_COM_SEF_PAGEREP_CHAR','Page spacer character');
DEFINE('_COM_SEF_TT_PAGEREP_CHAR','Character to use to space page numbers away from the rest of the URL');
DEFINE('_COM_SEF_STRIP_CHAR','Strip characters');
DEFINE('_COM_SEF_TT_STRIP_CHAR','Characters to strip from the URL, separate with |');
DEFINE('_COM_SEF_FRIENDTRIM_CHAR','Trim friendly characters');
DEFINE('_COM_SEF_TT_FRIENDTRIM_CHAR','Characters to trim from around the URL, separate with |');
DEFINE('_COM_SEF_TT_REPLACE_CHAR','Carattere da usare per sostituire un carattere sconosciuto nella URL');
DEFINE('_COM_SEF_USE_ALIAS','Usa Alias del Titolo');
DEFINE('_COM_SEF_TT_USE_ALIAS','Setta su Sì per usare alias del titolo al posto del titolo nella URL');
DEFINE('_COM_SEF_SUFFIX','Suffisso del file');
DEFINE('_COM_SEF_TT_SUFFIX','Estensione da usare per \\\'files\\\'. Lascia in bianco  per disabilitare. Una scelta comune sarebbe \\\'html\\\'.');
DEFINE('_COM_SEF_ADDFILE','Default index file.');
DEFINE('_COM_SEF_TT_ADDFILE','File name to place after a blank url / when no file exists.  Useful for bots that crawl your site looking for a specific file in that place but returns a 404 because there is none there.');
DEFINE('_COM_SEF_PAGETEXT','Testo della pagina');
DEFINE('_COM_SEF_TT_PAGETEXT','Testo da aggiungere alla URL per pagine multiple. Usa %s per inserire un numero di pagina, per default sarà inserito alla fine. Se è definito un suffisso, sarà aggiunto alla fine della stringa.');
DEFINE('_COM_SEF_LOWER','Tutto minuscolo');
DEFINE('_COM_SEF_TT_LOWER','Converte in minuscolo tutti i caratteri della URL','Tutto minuscolo');
DEFINE('_COM_SEF_SHOW_SECT','Mostra sezione');
DEFINE('_COM_SEF_TT_SHOW_SECT','Setta Sì per includere il nome della sezione nella URL');
DEFINE('_COM_SEF_HIDE_CAT','Nascondi la Categoria');
DEFINE('_COM_SEF_TT_SHOW_CAT','Setta Sì per escludere il nome della categoria nella URL');
DEFINE('_COM_SEF_404PAGE','Pagina 404');
DEFINE('_COM_SEF_TT_404PAGE','Pagina di contenuto statico da usare come pagina 404 Errore Non Trovato (lo stato di pubblicazione non ha importanza)');
DEFINE('_COM_SEF_TITLE_ADV','Configurazione avanzata del componente');
DEFINE('_COM_SEF_TT_ADV','<b>Gestione normale</b><br/>elabora normalmente, se è presente una estensione avanzata, sarà usata quella. <br/><b>Non modificare</b><br/>non memorizzare nel DB e crea le URL SEF nel vecchio stile<br/><b>Salta</b><br/>non usare le URL SEF per questo componente<br/>');
DEFINE('_COM_SEF_TT_ADV4','Opzioni avanzate per ');
DEFINE('_COM_SEF_TITLE_MANAGER','404 SEF URL Manager');
DEFINE('_COM_SEF_VIEWMODE','Modo vista:');
DEFINE('_COM_SEF_SORTBY','Ordina per:');
DEFINE('_COM_SEF_HITS','Viste');
DEFINE('_COM_SEF_DATEADD','Data aggiunta');
DEFINE('_COM_SEF_SEFURL','Url SEF');
DEFINE('_COM_SEF_URL','Url');
DEFINE('_COM_SEF_REALURL','Url Reale');
DEFINE('_COM_SEF_EDIT','Modifica');
DEFINE('_COM_SEF_ADD','Aggiungi');
DEFINE('_COM_SEF_NEWURL','Nuova URL SEF');
DEFINE('_COM_SEF_TT_NEWURL','Solo reindirizzamenti relativi dalla root di Joomla/Mambo <i>senza</i> la barra (slash) iniziale');
DEFINE('_COM_SEF_OLDURL','Vecchia URL Non-SEF');
DEFINE('_COM_SEF_TT_OLDURL','Questa URL deve iniziare con index.php');
DEFINE('_COM_SEF_SAVEAS','Salva il reindirizzamento personalizzato');
DEFINE('_COM_SEF_TITLE_SUPPORT','Supporto 404 SEF');
DEFINE('_COM_SEF_HELPVIA','<b>L\'aiuto è disponibile nei seguenti forums:</b>');
DEFINE('_COM_SEF_OFFICIAL','Forum  del progetto ufficiale');
DEFINE('_COM_SEF_MAMBERS','Forum Mambers');
DEFINE('_COM_SEF_TITLE_PURGE','Sfoltisci il database di 404 SEF');
DEFINE('_COM_SEF_USE_DEFAULT','(Gestione normale)');
DEFINE('_COM_SEF_NOCACHE','Non modificare');
DEFINE('_COM_SEF_SKIP','Salta');
DEFINE('_COM_SEF_INSTALLED_VERS','Versione installata:');
DEFINE('_COM_SEF_COPYRIGHT','Copyright');
DEFINE('_COM_SEF_LICENSE','Licenza');
DEFINE('_COM_SEF_SUPPORT_404SEF','Supporto di 404SEF');
DEFINE('_COM_SEF_CONFIG_UPDATED','Configurazione aggiornata');
DEFINE('_COM_SEF_WRITE_ERROR','Errore scrivendo la configurazione');
// component interface
DEFINE('_COM_SEF_NOREAD','FATAL ERROR: impossibile leggere il file ');
DEFINE('_COM_SEF_CHK_PERMS','Per favore, controlla i permessi del file e assicurati che questo file sia leggibile.');
DEFINE('_COM_SEF_DEBUG_DATA_DUMP','DEBUG DATA DUMP COMPLETE: Caricamento pagina terminato');
DEFINE('_COM_SEF_STRANGE','Qualcosa di strano è successo. Questo non dovrebbe accadere<br />');
// added by shumisha
// General params
define('_COM_SEF_SH_REPLACEMENTS', 'Character replacements list');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Characters non accepted in URL, such as non-latin or accented, can be replaced as per this replacement table. <br />Format is xxx | yyy for each replacement rule. xxx is the character to be replaced, whereas yyy is the new character. <br />There can be many of this rules, separated by commas (,). Between the old character and the new one, use a | character. <br />Note also that xxx or yyy can be multiple characters, such as in å|oe ');
// cache params
define('_COM_SEF_SH_CACHE_TITLE', 'Cache management');
define('_COM_SEF_SH_USE_URL_CACHE', 'Activate URL cache');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'If activated, SEF URL will be written to an in-memory cache, which will increase page load time significantly. This will however use up memory!');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'Cache size');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'When URL cache is activated, this parameter sets its maximum size. Enter the maximum number of URL that can be stored in the cache (additional URL will be processed, but not stored in cache, so loading time will be higher). Roughly speaking, each URL is worth around 200 bytes (100 for the SEF URL and 100 for the non-sef URL). So, for instance,  5000 URLs will use about 1 Mb of memory.');
// URL translation
define('_COM_SEF_SH_TRANSLATION_TITLE', 'Translation management');
define('_COM_SEF_SH_TRANSLATE_URL', 'Translate URL');
define('_COM_SEF_TT_SH_TRANSLATE_URL', 'If activated, and site is multi-lingual, SEF URL elements will be translated to the visitor language, as decided by Joomfish. If de-activated, URL will always be in default language of site. Not used if site is not multi-lingual.');
// itemid control
define('_COM_SEF_SH_ITEMID_TITLE', 'Itemid management');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Insert menu Itemid if none');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'If no Itemid is set in the non-sef URL before it is turned into an SEF one, and you set this option to true, the curent menu item Itemid will be added to it. This will ensure that, if clicked, the link will stay on the same page (ie: same modules displayed)');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'Insert menu title if no Itemid');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'If no Itemid is set in the non-sef URL before it is turned into an SEF one, and you set this option to true, the current menu item title will be inserted in the SEF URL. This should be set to true if above parameter is also set to true, as this will prevent -2, -3, -... to be appended to the SEF URL if an article is viewed from different locations');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'Always insert menu title');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'If set to yes, the menu item title corresponding to the Itemid set up in the non-sef URL, or the current menu item title if no Itemid is set, will be inserted in the SEF URL.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Always append Itemid to SEF URL');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'If set to yes, the non-sef Itemid (or the current menu item Itemid if none is set in the non-sef URL) will be appended to the SEF URL. This should be used instead of Always insert menu title parameter, if you have several menu items with the same title (as if one in main menu and one in top menu for instance)');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'menu id');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Default menu title');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'When the above parameter is set to Yes, you can override the text inserted in the SEF URL here. Note that this text will be invariant, and will not be translated for instance');
// Virtuemart params
define('_COM_SEF_SH_VM_TITLE', 'Virtuemart configuration');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Insert shop name in URL');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'If set to yes, shop name (as defined by shop menu item title) will allways be prepended to SEF URL');
define('_COM_SEF_SH_SHOP_NAME', 'Default shop name');
define('_COM_SEF_TT_SH_SHOP_NAME', 'When the above parameter is set to Yes, you can override the text inserted in the SEF URL here. Note that this text will be invariant, and will not be translated for instance');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'Insert product ID in URL');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'If set to Yes, product ID will be prepended to product name in the SEF URL<br />For instance : mysite.com/3-my-very-nice-product.html.<br />This is useful if you do not insert all categories names in URL, as several products may have same name, in various categories. Please note that this is not the product SKU, but rather the internal product id, which is always unique.');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'Use product SKU for name');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'If set to Yes, product SKU, the product code you enter for each product, will be used instead of the product full name.');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'Insert manufacturer name in URL');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'If set to Yes, manufacturer name, if any, will be inserted in SEF URL leading to a product.<br />For instance : mysite.com/manufacturer-name/product-name.html');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Insert manufacturer ID');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'If set to Yes, manufacturer ID will be prepended to manufacturer name in the SEF URL<br />For instance : mysite.com/6-manufacturer-name/3-my-very-nice-product.html.');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Insert categories');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'If set to <strong>None</strong>, no category name will be inserted in a URL leading to a product display, as in : <br /> mysite.com/joomla-cms.html<br />If set to <strong>Only last one</strong>, the name of the category to which the product belongs will be inserted in the SEF URL, as in : <br /> mysite.com/joomla/joomla-cms.html<br />If set to <strong>All nested categories</strong>, the names of all categories to which the product belongs will be added, as in : <br /> mysite.com/software/cms/joomla/joomla-cms.html');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'None');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'Only last one');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'All nested categories');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'Insert category ID in URL');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', 'If set to Yes, category ID will be prepended to each category name inserted in an URL leading to a product, as in : <br /> mysite.com/1-software/4-cms/1-joomla/joomla-cms.html');
// V 1.2.4.h
// insert numerical id params
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', 'Unique ID');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', 'Insert numerical id in URL');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', 'If set to <strong>Yes</strong>, a numerical id will be added to the URL, in order to facilitate inclusion in services such as Google news. The id will follow this format : 2007041100000, where 20070411 is date of creation and 00000 is internal unique id of the content element. You should finally set the date of creation when your content is ready for publishing. Please be aware that you should not change it afterwards.');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', 'All categories');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Apply to which categories');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Numerical id will be inserted in sef URLs of content elements found in onl y those categories listed here. You can select multiple categories by pressing and holding the CTRL key before clicking on a category name.');
// V 1.2.4.j
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', '301 redirect from non-sef to sef URL');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', 'If set to <strong>Yes</strong>, non-sef URL already existing in the DB will be redirected to their SEF counterpart, using a 301 - Moved permanently redirection.');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'SSL secure URL');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', 'Set this to the <strong>full base URL of your site when in SSL mode</strong>.<br />Required only if you use https access. If not set, will default to httpS://normalSiteURL.<br />Please enter full url, without any trailing slash. Example : <strong>https://www.mysite.com</strong> or <strong>https://sharedsslserveur.com/myaccount</strong>.');
// V 1.2.4.k
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'iJoomla Magazine configuration');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', 'Activer iJoomla magazine in content');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', 'If set to <strong>Yes</strong>, the ed parameter if passed to the com_content component will be interpreted as the iJoomla magazine edition id.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Insert issue id in URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'If set to <strong>Yes</strong>, the issue unique internal id will be prepended to each issue name, to make sure it is unique.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', 'Insert magazine name in URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', 'If set to <strong>yes<strong>, magazine name (as defined by magazine menu item title) will allways be prepended to SEF URL');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', 'Default magazine name');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', 'When the previous parameter is set to Yes, you can override the text inserted in the SEF URL here. Note that this text will be invariant, and will not be translated for instance');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Insert magazine id in URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'If set to <strong>Yes</strong>, magazine ID will be prepended to each magzine name inserted in an URL, as in : <br /> mysite.com/<strong>4</strong>-Joomla-magazine/Good-article-title.html');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Insert article id in URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'If set to <strong>Yes</strong>, article ID will be prepended to each article title inserted in an URL, as in : <br /> mysite.com/Joomla-magazine/<strong>56</strong>-Good-article-title.html');
define('_COM_SEF_SH_CB_TITLE', 'Community Builder configuration ');
define('_COM_SEF_SH_CB_INSERT_NAME', 'Insert Community Builder name');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', 'If set to <strong>Yes</strong>, the menu element title leading to Community Builder main page will be prepended to all CB SEF URL');
define('_COM_SEF_SH_CB_NAME', 'Default CB name');
define('_COM_SEF_TT_SH_CB_NAME', 'When the previous parameter is set to Yes, you can override the text inserted in the SEF URL here. Note that this text will be invariant, and will not be translated for instance.');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', 'Insert user name');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', 'If set to <strong>Yes</strong>, user name will be inserted into SEF URLs. <strong>WARNING</strong>: this can lead to substantial increase in database size, and can slow down site, if you have many registered users. If set to No, the user id will be used instead, using regular format : ..../send-user-email.html?user=245');
define('_COM_SEF_SH_CB_INSERT_USER_ID', 'Insert user ID');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', 'If set to <strong>Yes</strong>, user ID will be prepended to its name <strong>whe previous option is also set to Yes</strong>, just in case two users have the same name.');
define('_COM_SEF_SH_LOG_404_ERRORS', 'Log 404 errors');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', 'If set to <strong>Yes</strong>, 404 errors will be logged to database. This may help you find errors within your site links. It may also use up uneeded database space, so you can probably disable i when your site has been well tested.');
define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', 'Additionnal text');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', 'If set to <strong>Yes</strong>, an additional text will be appended to browse categories URL. For instance : ..../category-A/View-all-products.html VS ..../category-A/ .');
// V 1.2.4.k
DEFINE('_COM_SEF_IMPORT_EXPORT','Import/Export URLS');
// V 1.2.4.m
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', '301 redirect from JOOMLA SEF to sh404SEF');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'If set to <strong>Yes</strong>, JOOMLA standard SEF url will be 301 redirected to their sh404SEF equivalent, if any in the database. If it does not exists, it will be created on the fly, unless there is some POST data, in which case nothing happens.');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Insert flypage name');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'If set to Yes, the flypage name will be inserted in the URL leading to a product details. Can be deactivated if you use only one flypage.');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Letterman configuration ');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'Default Itemid for Letterman page');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', 'Enter Itemid of page to be inserted in Letterman links (unsubscribe, confirmation messages, ...');
define('_COM_SEF_SH_FB_TITLE', 'Fireboard Configuration ');
define('_COM_SEF_SH_FB_INSERT_NAME', 'Insert Fireboard name');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', 'If set to <strong>Yes</strong>, the menu element title leading to Fireboard main page will be prepended to all Fireboard SEF URL');
define('_COM_SEF_SH_FB_NAME', 'Default Fireboard Name');
define('_COM_SEF_TT_SH_FB_NAME', 'If set to <strong>yes<strong>, Fireboard name (as defined by Fireboard menu item title) will allways be prepended to SEF URL.');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', 'Insert category name');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', 'If set to Yes, the name category will be inserted into all SEF links to a post or a category');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', 'Insert category ID');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', 'If set to <strong>Yes</strong>, category ID will be prepended to its name <strong>whe previous option is also set to Yes</strong>, just in case two categories have the same name.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', 'Insert post subject');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', 'If set to <strong>Yes</strong>, each post subject will be inserted in the SEF url leading to this post ');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', 'Insert post ID');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', 'If set to <strong>Yes</strong>, each post ID will be prepended to its subject <strong>whe previous option is also set to Yes</strong>, just in case two posts have the same subject.');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', 'Insert language code in URL');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE', 'If set to <strong>Yes</strong>, the ISO code of the page language will be inserted in the SEF URL, except if language is default site language.');
DEFINE('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','Do not translate');
DEFINE('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','Do not insert code');
define('_COM_SEF_SH_ADV_MANAGE_URL', 'URL procssing');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', 'For each component installed:<br /><b>use default handler</b><br/>process normally, if an SEF Advanced extension is present it will be used instead. <br/><b>nocache</b><br/>do not store in DB and create old style SEF URLs<br/><b>skip</b><br/>do not make SEF urls for this component<br/>');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', 'Translate URL');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', 'For each component installed, select if URL should be translated. No effect if site has only one language.');
define('_COM_SEF_SH_ADV_INSERT_ISO', 'Insert ISO code');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', 'For each component installed, and if your site is multi-lingual, choose to insert or not the target language ISO code in the SEF URL. For instance : www.monsite.com/<b>fr</b>/introduction.html. fr stands for french. This code will not be inserted in default language URL.');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'Insert user pseudo');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', 'If set to <strong>Yes</strong>, the user pseudo will be inserted in SEF URL, if you have activated this option above, instead of its actual name.');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', 'Override sef_ext file');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', 'Do not override sef_ext');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', 'Some components come with their own sef_ext files intended for use with OpenSEF or SEF Advanced. If this parameter is on (Override sef_ext), this extension file will not be used, and sh404SEF own plugin will be used instead (assuming there is one for that particular component). If not, then the component`s own sef_ext file will be used.');
//V 1.2.4.q
define('_COM_SEF_SH_CONF_TAB_MAIN', 'Main');
define('_COM_SEF_SH_CONF_TAB_PLUGINS', 'Plugins');
define('_COM_SEF_SH_CONF_TAB_ADVANCED', 'Advanced');
define('_COM_SEF_SH_CONF_TAB_BY_COMPONENT', 'By component');

// V 1.2.4.q
define('_COM_SEF_SH_ENCODE_URL', 'Encode URL');
define('_COM_SEF_TT_SH_ENCODE_URL', 'If set to Yes, URL will be encoded so as to be compatible with languages having non-latin characters. Encoded URL will look like : mysite.com/%34%56%E8%67%12.....');
define('_COM_SEF_SH_FILTER', 'Filter');
define('_COM_SEF_SH_FILTER', 'Filtre');
define('_COM_SEF_CONFIRM_ERASE_CACHE', 'Do you want to clear the URL cache ? This is highly recommended after changing configuration. To generate again the cache, you should browse again your homepage, or better : generate a sitemap for your site.');
define('_FULL_TITLE', 'Full title');
define('_TITLE_ALIAS', 'Title Alias');
define('_COM_SEF_SH_CAT_TABLE_SUFFIX', 'Table');
define('_COM_SEF_SH_REDIR_TOTAL', 'Total');
define('_COM_SEF_SH_REDIR_SEF', 'SEF');
define('_COM_SEF_SH_REDIR_404', '404');
define('_COM_SEF_SH_REDIR_CUSTOM', 'Custom');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'menu id');
define('_COM_SEF_SH_FORCE_NON_SEF_HTTPS', 'Force non sef if HTTPS');
define('_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS', 'If set to Yes, URL will be forced to non sef after switching to SSL mode(HTTPS). This allows operation with some shared SSL servers causing problems otherwise.');
define('_COM_SEF_SH_GUESS_HOMEPAGE_ITEMID', 'Guess Itemid on homepage');
define('_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID', 'If set to yes, and on homepage only, Itemid of com_content URLs will be removed and replaced by the one sh404SEF guestimates. This is useful when some content elements can be viewed on the frontpage (in blog view for instance), and also on other pages on the site.');
?>
