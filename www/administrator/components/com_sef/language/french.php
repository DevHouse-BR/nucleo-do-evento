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
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );


// admin interface
DEFINE('_COM_SEF_CONFIG','sh404SEF<br/>Configuration');
DEFINE('_COM_SEF_CONFIG_DESC','Configurer sh404SEF');
DEFINE('_COM_SEF_HELP','Support<br/>sh404SEF');
DEFINE('_COM_SEF_HELPDESC','Aide sur sh404SEF?');
DEFINE('_COM_SEF_INFO','Documentation<br/>sh404SEF');
DEFINE('_COM_SEF_INFODESC','Voir le descriptif du projet sh404SEF et sa documentation');
DEFINE('_COM_SEF_VIEWURL','URLs<br/>optimis�es');
DEFINE('_COM_SEF_VIEWURLDESC','Voir/modifier les URLs optimis�es');
DEFINE('_COM_SEF_VIEW404','Journal des<br/>erreurs 404');
DEFINE('_COM_SEF_VIEW404DESC','Voir/modifier le journal d\'erreur 404');
DEFINE('_COM_SEF_VIEWCUSTOM','redirections<br/>personnalis�es');
DEFINE('_COM_SEF_VIEWCUSTOMDESC','Voir/modifier les redirections personnalis�es ');
DEFINE('_COM_SEF_SUPPORT','Site<br/>support');
DEFINE('_COM_SEF_SUPPORTDESC','Allez sur le site de support de sh404SEF');
DEFINE('_COM_SEF_BACK','Retour au panneau de contr�le de sh404SEF');
DEFINE('_COM_SEF_PURGEURL','Effacer<br/>les URLs');
DEFINE('_COM_SEF_PURGEURLDESC','Purge la liste des URLs optimis�es');
DEFINE('_COM_SEF_PURGE404','Effacer<br/>les erreurs 404');
DEFINE('_COM_SEF_PURGE404DESC','Vide le journal de suivi des erreurs 404');
DEFINE('_COM_SEF_PURGECUSTOM','Effacer<br/>redirections personnalis�es');
DEFINE('_COM_SEF_PURGECUSTOMDESC','Efface les redirections personnalis�es');
DEFINE('_COM_SEF_WARNDELETE','ATTENTION!!!<br/>Vous allez effacer ');
DEFINE('_COM_SEF_RECORD',' enregistrement');
DEFINE('_COM_SEF_RECORDS',' enregistrements');
DEFINE('_COM_SEF_NORECORDS','Aucun enregistrement trouv�.');
DEFINE('_COM_SEF_PROCEED',' Valider ');
DEFINE('_COM_SEF_OK',' OK ');
DEFINE('_COM_SEF_SUCCESSPURGE','Enregistrements effac�s.');
DEFINE('_PREVIEW_CLOSE','Fermer cette fen�tre');
DEFINE('_COM_SEF_EMPTYURL','Vous devez indiquer une URL vers laquelle rediriger.');
DEFINE('_COM_SEF_NOLEADSLASH','La nouvelle URL (optimis�e) ne DOIT PAS COMMENCER par un /');
DEFINE('_COM_SEF_BADURL','L\'ancienne URL (non optimis�e) doit commencer par index.php');
DEFINE('_COM_SEF_URLEXIST','Cette URL existe d�j� dans la base de donn�es!');
DEFINE('_COM_SEF_SHOW0','Montrer les URLs optimis�es');
DEFINE('_COM_SEF_SHOW1','Montrer le journal d\'erreurs 404');
DEFINE('_COM_SEF_SHOW2','Montrer les redirections personnalis�es');
DEFINE('_COM_SEF_INVALID_URL','URL non valide: ce lien requiert un Itemid valide, mais aucun n\'a pu �tre trouv�.<br/>SOLUTION: Cr�ez un �l�ment de menu qui pointe vers cet �l�ment. Vous n\'avez pas besoin de le publier, il sffit qu\'il existe.');
DEFINE('_COM_SEF_DEF_404_MSG','<h1>Erreur 404: Non disponible</h1><h4>La page que vous avez demand�e n\'existe pas sur ce serveur, ou n\'est pas disponible</h4>');
DEFINE('_COM_SEF_SELECT_DELETE','Choisissez un �l�ment � effacer');
DEFINE('_COM_SEF_ASC',' (asc) ');
DEFINE('_COM_SEF_DESC',' (desc) ');
DEFINE('_COM_SEF_WRITEABLE',' <b><font color="green">Modifiable</font></b>');
DEFINE('_COM_SEF_UNWRITEABLE',' <b><font color="red">Non modifiable</font></b>');
DEFINE('_COM_SEF_USING_DEFAULT',' <b><font color="red">Utilisation des valeurs par d�faut</font></b>');
DEFINE('_COM_SEF_DISABLED',"<p class='error'>NOTE: l\'optimisation pour les moteurs de recherche (SEO) est actuellement d�sactiv�e dans les r�glages de Joomla. Pour cr�er des URLs optimis�es, merci d\'activer en premier lieu le syst�me SEO int�gr� � Joomla : <a href='".
	$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Configuration globale</a> SEO.</p>");
DEFINE('_COM_SEF_TITLE_CONFIG',' Configuration de sh404SEF');
DEFINE('_COM_SEF_TITLE_BASIC','Configuration de base');
DEFINE('_COM_SEF_ENABLED','Activ�');
DEFINE('_COM_SEF_TT_ENABLED','Si d�sactiv�, le syst�me SEO int�gr� � Joomla sera utilis�');
DEFINE('_COM_SEF_DEF_404_PAGE','Page 404 par d�faut');
DEFINE('_COM_SEF_REPLACE_CHAR','Caract�re de remplacement');
DEFINE('_COM_SEF_TT_REPLACE_CHAR','Caract�re � utiliser pour remplacer les caract�res inconnus dans une URL');
DEFINE('_COM_SEF_PAGEREP_CHAR','S�parateur de No de page');
DEFINE('_COM_SEF_TT_PAGEREP_CHAR','Caract�re pour s�parer le num�ro de page du reste des URLs');
DEFINE('_COM_SEF_STRIP_CHAR','Caract�res � effacer');
DEFINE('_COM_SEF_TT_STRIP_CHAR','Caract�res qui doivent �tre effac�s des URLS, s�par�s par des | (Alt-Gr + touche 6)');
DEFINE('_COM_SEF_FRIENDTRIM_CHAR','Caract�res � supprimer d�but/fin');
DEFINE('_COM_SEF_TT_FRIENDTRIM_CHAR','Caract�res � supprimer au d�but et � la fin des URLS, s�par�s par des | (Alt-Gr + touche 6)');
DEFINE('_COM_SEF_USE_ALIAS','Utiliser alias de titre');
DEFINE('_COM_SEF_TT_USE_ALIAS','Si activ�, le champ Alias de titre des articles sera utilis� � la place du titre pour construire les URLs');
DEFINE('_COM_SEF_SUFFIX','Suffixe URL');
DEFINE('_COM_SEF_TT_SUFFIX','Extension ajout�es aux URLS. Laissez blanc pour ne rien ajouter. La plupart du temps, on utilise html');
DEFINE('_COM_SEF_ADDFILE','Fichier index par d�faut.');
DEFINE('_COM_SEF_TT_ADDFILE','Nom de fichier � ajouter apr�s une URL vide, sans aucun nom de fichier.  Utile pour certain robots qui parcourent votre site � la recherche de fichier particulier, mais qui renvoient une erreur 404 au cas o� ils ne le trouvent pas.');
DEFINE('_COM_SEF_PAGETEXT','Texte pages multiples');
DEFINE('_COM_SEF_TT_PAGETEXT','Texte � ajouter aux URLs dans le cas de pages multiples. Utilisez %s pour ajouter le n� de page. Par d�faut, il sera ajout� � la fin. Si un suffixe a �t� d�fini ci-dessus, il sera ajout� � la fin de ce texte pour pages multiples.');
DEFINE('_COM_SEF_LOWER','Tout en minuscules');
DEFINE('_COM_SEF_TT_LOWER','Convertit les URLs en minuscules');
DEFINE('_COM_SEF_SHOW_SECT','Inclure la section');
DEFINE('_COM_SEF_TT_SHOW_SECT','Si activ�, la SECTION � laquelle appartient un article sera utilis�e pour construire son URL');
DEFINE('_COM_SEF_HIDE_CAT','Masquer la cat�gorie');
DEFINE('_COM_SEF_TT_SHOW_CAT','Si activ�, la cat�gorie � laquelle appartient un article sera utilis�e pour construire son URL');
DEFINE('_COM_SEF_404PAGE','Page erreur 404');
DEFINE('_COM_SEF_TT_404PAGE','Article de contenu statique � utiliser quand une erreur 404 se produit (Page indisponible). Que cet article soit publi� ou non est sans importance');
DEFINE('_COM_SEF_TITLE_ADV','Configuration avanc�e');
DEFINE('_COM_SEF_TT_ADV','<b>traitement normal</b><br/>Traite normalement les URLs. Si un fichier extension SEO avanc�e est pr�sent, il sera utilis� en lieu et place. <br/><b>sans cache</b><br/>ne pas stocker les URLs dans la base de donn�es, et cr�er les URLs classiques de Joomla<br/><b>passer</b><br/>ne pas construire les URLs pour ce composant<br/>');
DEFINE('_COM_SEF_TT_ADV4','Options avanc�es');
DEFINE('_COM_SEF_TITLE_MANAGER','sh404SEF');
DEFINE('_COM_SEF_VIEWMODE','Mode:');
DEFINE('_COM_SEF_SORTBY','Classer par:');
DEFINE('_COM_SEF_HITS','Hits');
DEFINE('_COM_SEF_DATEADD','Date cr�ation');
DEFINE('_COM_SEF_SEFURL','URL optimis�e');
DEFINE('_COM_SEF_URL','UURL');
DEFINE('_COM_SEF_REALURL','URL r�elle');
DEFINE('_COM_SEF_EDIT','Modifier');
DEFINE('_COM_SEF_ADD','Ajouter');
DEFINE('_COM_SEF_NEWURL','Nouvelle URL optimis�e');
DEFINE('_COM_SEF_TT_NEWURL','Vous ne pouvez faire que des redirections relatives depuis la racine du dossier Joomla <b>sans</b> le / du d�but');
DEFINE('_COM_SEF_OLDURL','Ancienne URL, non optimis�e');
DEFINE('_COM_SEF_TT_OLDURL','Cett URL doit commencer par index.php');
DEFINE('_COM_SEF_SAVEAS','Enregistrer comme redirection personnalis�e');
DEFINE('_COM_SEF_TITLE_SUPPORT','Support sh404SEF');
DEFINE('_COM_SEF_HELPVIA','<b>L\'aide est disponible au travers des forums :</b>');
DEFINE('_COM_SEF_OFFICIAL','Forum du projet');
DEFINE('_COM_SEF_MAMBERS','Forum JoomlaFrance (forum.joomlafacile.com)');
DEFINE('_COM_SEF_TITLE_PURGE','Vider la base de donn�es des URLs sh404SEF');
DEFINE('_COM_SEF_USE_DEFAULT','(traitement normal)');
DEFINE('_COM_SEF_NOCACHE','sans cache');
DEFINE('_COM_SEF_SKIP','passer');
DEFINE('_COM_SEF_INSTALLED_VERS','Version install�e:');
DEFINE('_COM_SEF_COPYRIGHT','Copyright');
DEFINE('_COM_SEF_LICENSE','Licence');
DEFINE('_COM_SEF_SUPPORT_404SEF','');
DEFINE('_COM_SEF_CONFIG_UPDATED','Configuration mise � jour');
DEFINE('_COM_SEF_WRITE_ERROR','Erreur lors de la sauvegarde de la configuration');
DEFINE('_COM_SEF_NOACCESS','Acc�s impossible');
DEFINE('_COM_SEF_FATAL_ERROR_HEADERS','ERREUR FATALE: HEADER d�j� envoy�');
DEFINE('_COM_SEF_UPLOAD_OK','Le fichier a �t� envoy� avec succ�s');
DEFINE('_COM_SEF_ERROR_IMPORT','Erreur lors de l\'importation:');
DEFINE('_COM_SEF_INVALID_SQL','Instructions SQL invalide dans le fichier:');
DEFINE('_COM_SEF_NO_UNLINK','Impossible de supprimer le fichier envoy� dans le dossier media');
DEFINE('_COM_SEF_IMPORT_OK','Les URL personnalis�es ont �t� import�es correctement !');
DEFINE('_COM_SEF_WRITE_FAILED','Impossible de sauver le fichier envoy� dans le dossier media');
DEFINE('_COM_SEF_EXPORT_FAILED','Echec de l\'exportation!!!');
DEFINE('_COM_SEF_IMPORT_EXPORT','Importer/Exporter<br />redirections');
DEFINE('_COM_SEF_SELECT_FILE','Merci de commencer par choisir un fichier');
DEFINE('_COM_SEF_IMPORT','Importer des redirections personnalis�es');
DEFINE('_COM_SEF_EXPORT','Sauvegarder vos redirections personnalis�es');

// component interface
DEFINE('_COM_SEF_NOREAD','ERREUR FATALE: impossible de lire le fichier ');
DEFINE('_COM_SEF_CHK_PERMS','Merci de v�rifier les permissions d\'acc�s aux fichier, et de contr�ler que ce fichier peut �tre lu.');
DEFINE('_COM_SEF_DEBUG_DATA_DUMP','DUMP des donn�es de DEBUG termin�: chargement de la page termin�');
DEFINE('_COM_SEF_STRANGE','Quelque chose de bizarre vient de se produire, et cela n\'aurait pas du arriver<br />');

//Added by Leon
define('_FULL_TITLE', 'Titre complet');
define('_TITLE_ALIAS', 'Alias de titre');
define('_COM_SEF_SHOW_CAT', 'Inclure la cat�gorie');

// added by shumisha

// General params
define('_COM_SEF_SH_REPLACEMENTS', 'Liste de remplacements');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Les caract�res non valides dans des URLs, comme les caract�res accentu�s par exemple, peuvent �tre remplac�s suivant la table saisie ici. <br />Le format est xxx | yyy pour chaque r�gle de remplacement. xxx est le caract�re � remplacer, et yyy est le caract�re � employer � la place. <br />Il peut y avoir plusiers r�gles, s�par�es par des virgules (,). Entre l`ancien et le nouveau caract�re, placez un | (touche AltGr + touche 6 en haut du clavier. <br />Notez que xxx et yyy peuvent �tre des caract�res multiples, comme dans �|oe ');

define('_COM_SEF_SH_CACHE_TITLE', 'Gestion du cache');
define('_COM_SEF_SH_USE_URL_CACHE', 'Activation du cache URL');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'Si activ�, les URLs r�-�crites sont charg�es dans un cache en m�moire, ce qui acc�l�re beaucoup le temps de cr�ation des pages. Par contre, cela consomme de la m�moire!');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'Taille du cache');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'Lorsque la mise en cache des URLs est activ�e, ce param�tre limite sa taille. Entrez le nombre d URLs � mettre en cache au maximum (les URLs au del� de cette limite seront toujours trait�es, mais pas mises en cache, et le temps de chargement sera plus �lev�). En premi�re approche, chaque URL p�se � peu pr�s 200 octets (100 pour l URL SEF, et 100 pour l URL non SEF. Donc, par exemple, 5000 URLs occuperont environ 1 Mo.');

// URL translation
define('_COM_SEF_SH_TRANSLATION_TITLE', 'Gestion des traductions');
define('_COM_SEF_SH_TRANSLATE_URL', 'Traduire les URLs');
define('_COM_SEF_TT_SH_TRANSLATE_URL', 'Si activ�, et que votre site est multilingue, les �l�ments constitutifs des URLs seront traduits dans la langue du visiteur, tel que permis par Joomfish. Sinon, les URLs seront enti�rement dans la langue par d�faut du site. Sans effet si votre site n`est pas multilingue.');
// itemid control
define('_COM_SEF_SH_ITEMID_TITLE', 'Gestion de l`Itemid');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Ins�rer l`Itemid du menu si aucun');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Si aucun Itemid n`est pr�sent dans l`URL non-SEF avant sa transformation en URL sef, et que vous activez cette option, l`Itemid de l`�l�ment de menu courant sera ajout� � cette URL non-sef. De cette mani�re, si l`on clique sur ce lien, on restera sur la m�me page, c`est � dire que les m�mes modules par exemple seront affich�s.)');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'Ins�rer le titre de menu si pas d`Itemid');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'Si aucun Itemid n`est pr�sent dans l`URL non-SEF avant sa transformation en URL sef, et que vous activez cette option, le titre de l`�l�ment actif de menu sera ins�r� dans l`URL sef. Ce param�tre devrait �tre activ� si le pr�c�dent l`est, car cela devrait emp�cher la formation d`URLs se terminant par -2, -3, -... quand un m�me article est vu sur plusieurs pages, sans pour autant �tre accessible directement depuis un lien dans un menu, ou bien une table de cat�gories ou de section.');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'Toujours ins�rer un titre');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'Si activ�, le titre de l`�l�ment de menu d�sign� par l`Itemid figurant dans l`URL non-sef, ou celui de l`�l�ment de menu actif � d�faut, sera ins�r� dans l`URL SEF.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Toujours ajouter l`Itemid � l`URL SEF');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'Si activ�, l`Itemid de l`URL non-sef (ou l`Itemid de  l`�l�ment courant du menu si aucun ne figure dans l`URL non-sef) sera ajout� � la fin de l`URL sef. A utiliser � la place de Toujours ins�rer un titre si vous avez plusieurs �l�ments de menu qui portent le m�me titre (par exemple un dans le menu principal et un autre dans le menu sup�rieur).');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Titre par d�faut');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'Quand le param�tre ci-dessus est activ�, vous pouvez saisir un titre ici, qui sera alors employ� � la place des titres de menus. Notez bien qu`alors ce titre est invariant, et en particulier qu`il ne sera pas traduit.');
// Virtuemart params
define('_COM_SEF_SH_VM_TITLE', 'Configuration Virtuemart');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Ins�rer le nom de la boutique');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'Si activ�, le nom de la boutique (c`est � dire le titre de l`�l�ment de menu qui y conduit), sera syst�matiquement ajout� au d�but des URL sef.');
define('_COM_SEF_SH_SHOP_NAME', 'Nom boutique par d�faut');
define('_COM_SEF_TT_SH_SHOP_NAME', 'Quand le param�tre ci-dessus est activ�, vous pouvez saisir un nom ici, qui sera alors employ� � la place des titres de menus. Notez bien qu`alors ce nom est invariant, et en particulier qu`il ne sera pas traduit.');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'Ins�rer identifiant produit');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'Si activ�, le nom d`un produit dans une URL sera toujours pr�c�d� de l`identifiant interne de ce produit<br />Par exemple, monsite.com/3-mon-tres-beau-produit.html.<br />C`est utile en particulier si vous n`utilisez pas tous les noms de cat�gories, car des produits dans des cat�gories diff�rentes peuvent porter le m�me nom. Notez bien que l`on parle ici de l`identifiant interne du produit, qui est toujours unique, et non du code produit (SKU) que vous entrez pour chaque produit.');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'Code produit � la place du nom');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'Si activ�, le code produit (aussi appel� SKU par Virtuemart) sera utilis� en lieu et place du nom complet du produit.');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'Ins�rer le nom du fabricant');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'Si activ�, le nom du fabricant, s`il y en a un pour ce produit, est ins�r� dans l`URL sef pour toutes les liens menant � l`affichage d`un produit.<br />Par exemple : monsite.com/nom-du-fabricant/nom-du-produit.html');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Ins�rer identifiant fabricant');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'Si activ�, le nom d`un fabricant dans une URL sera toujours pr�c�d� de l`identifiant interne de ce fabricant<br />par exemple : monsite.com/6-nom-du-fabricant/mon-tres-beau-produit.html.');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Ins�rer nom cat�gories');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'Si r�gl� sur <strong>Aucune</strong>, aucun nom de cat�gorie ne sera ins�r� dans les URL sef menant � une page produit, par exemple : <br /> monsite.com/joomla-cms.html<br />Si r�gl� sur <strong>La derni�re seulement</strong>, le nom de la cat�gorie � laquelle appartient le produit sera ins�r� dans l`URL sef, par exemple: <br /> monsite.com/php-mysql/joomla-cms.html<br />Si r�gl� sur <strong>Toutes les cat�gories imbriqu�es</strong>, le nom de toute la succession de cat�gories auxquelles appartient le produit sera ins�r�, par exemple : <br /> monsite.com/logiciels/cms/php-mysql/joomla-cms.html');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'Aucune');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'La derni�re seulement');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'Toutes les cat�gories imbriqu�es');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'Ins�rer identifiant cat�gorie');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', 'Si activ�, le nom d`une cat�gorie sera toujours pr�c�d� dans les URL sef menant � une page produit d`un identifiant unique, par exemple : <br /> monsite.com/2-logiciels/6-cms/2-php-mysql/joomla-cms.html');

// V 1.2.4.h
// insert numerical id params
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', 'Identificateur unique');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', 'Ins�rer un identifiant unique dans l`URL');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', 'Si <strong>Activ�</strong>, un identificateur num�rique sera ins�r� dans l`URL, pour faciliter son inclusion dans des services de nouvelles comme Google news. L`identifiant aura le format suivant : 2007041100000, avec 20070411 la date de cr�ation de l`article et 00000 l`identifiant unique interne � Joomla de l`article. Pensez � mettre � jour la date de cr�ation de votre article lorsque vous le publiez une fois termin�. Par contre, vous ne devrez plus changer cette date de cr�ation une fois l`article publi�.');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', 'Toutes les cat�gories');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Appliquer � quelles cat�gories');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'L`identifiant num�rique sera seulement ins�r� dans les URL des articles des cat�gories que vous s�lectionnez ici. Vous pouvez s�lectionner plusieurs cat�gories en apuuyant et maintenant la touche Ctrl avant de cliquer sur le nom d`une cat�gorie.');

// V 1.2.4.j
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', 'Redirection 301 de non-SEF vers SEF');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', 'Si r�gl� sur <strong>Oui</strong>, les URL non-sef seront automatiquement redirig�e (redirection 301) vers leur �quivalent SEF s``il existe d�j� dans la base de donn�es. S``il n`existe pas, il est cr��, sauf si la page comporte des donn�es transmises par POST, auquel cas rien n``est fait.');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'URL en mode SSL');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', '<strong>Indiquez ici l`URl � utiliser lors du passage en mode SSL (https)</strong>.<br />N�cessaire seulement si vous utilisez un acc�s de type https. Si vous laissez vide, et que vous utilisez https, sh404SEF emploiera l`adresse http<strong>S</strong>://URLNormaleDuSite.<br />Entrez une adresse compl�te, sans / � la fin. Exemple : <strong>https://www.monsite.com</strong> ou <strong>https://serveurSSLpartage.fr/moncompte</strong>.');

// V 1.2.4.k
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'Configuration iJoomla Magazine');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', 'Activer gestion iJoomla magazine dans les articles');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', 'Si <strong>Activ�</strong>, et qu`un param�tre appell� `ed` est pass� dans l`URL d`affichage d`un article, il sera interpr�t� comme l`identifiant d`un num�ro de magazine IJoomla.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Ins�rer identifiant num�ro');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Si <strong>Activ�</strong>, l`identifiant interne unique du num�ro sera ins�r� avant le titre, afin d`�tre sur qu`il soit unique.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', 'Ins�rer le nom du magazine dans les URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', 'Si <strong>Activ�</strong>, le nom du magazine (c`est � dire le titre de l`�l�ment de menu qui y conduit), sera syst�matiquement ajout� au d�but des URL sef');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', 'Nom magazine par d�faut');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', 'Quand le param�tre ci-dessus est activ�, vous pouvez saisir un nom, qui sera alors employ� � la place du titre de l`�l�ment de menu. Notez bien qu`alors ce nom est invariant, et en particulier qu`il ne sera pas traduit.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Ins�rer identifiant magazine');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Si <strong>activ�</strong>, le titre du magazine dans une URL sera toujours pr�c�d� de l`identifiant interne de ce magazine<br />par exemple : monsite.com/<strong>6</strong>-nom du magazine/titre-de-mon-article.html.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Ins�rer identifiant article');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Si <strong>activ�</strong>, le titre d`un article dans une URL sera toujours pr�c�d� de l`identifiant interne de cet article. Par exemple: <br /> monsite.com/Joomla-magazine/<strong>56</strong>-titre-de-super-article.html');

define('_COM_SEF_SH_CB_TITLE', 'Configuration Community Builder');
define('_COM_SEF_SH_CB_INSERT_NAME', 'Ins�rer nom Community Builder');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', 'Si <strong>Activ�</strong>, le titre de l`�l�ment de menu qui conduit � Community builder sera syst�matiquement ajout� au d�but des URL sef');
define('_COM_SEF_SH_CB_NAME', 'Nom CB par d�faut');
define('_COM_SEF_TT_SH_CB_NAME', 'Quand le param�tre pr�c�dent est activ�, vous pouvez saisir un nom, qui sera alors employ� � la place du titre de l`�l�ment de menu. Notez bien qu`alors ce nom est invariant, et en particulier qu`il ne sera pas traduit.');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', 'Ins�rer nom utilisateur');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', 'Si <strong>Activ�</strong>, le nom de l`utilisateur sera ins�r� dans les URLs. <strong>ATTENTION</strong>: ceci entra�ne une augmentation significative de la place occup�e dans la base de donn�es, et peut ralentir le chargement des pages si vous avez beaucoup d`utilisateurs inscrits. Si non activ�, l`identifiant de l`utilisateur continue � �tre pass�e au format habituel (....?user=245 par exemple)');
define('_COM_SEF_SH_CB_INSERT_USER_ID', 'Ins�rer identifiant utilisateur');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', 'Si <strong>Activ�</strong>, l`identifiant unique de chaque utilisateur sera ajout� avant son nom <strong>lorsque l`option pr�c�dente est activ�e</strong>, dans le cas o� deux utilisateurs auraient le m�me nom.');

define('_COM_SEF_SH_LOG_404_ERRORS', 'Enregistrer les erreurs 404');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', 'Si <strong>Activ�</strong>, les erreurs 404 se produisant seront enregistr�es dans la base de donn�es. Cela permet de d�tecter d`�ventuelles erreurs dans votre site. Cela peut aussi prendre de l`espace inutile, et vous pouvez donc probablement le d�sactiver une fois la phase de mise au point de votre site termin�e.');

define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', 'Ajouter texte additionel');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', 'Si <strong>Activ�</strong>, un texte additionnel sera ajout� aux URL, quand on parcourt les cat�gories. Par exemple : ..../categorie-A/voir-tous-les-produits.html � la place de ..../categorie-A/ .');

// V 1.2.4.m
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Redirection 301 du SEF JOOMLA vers SEF');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Si r�gl� sur <strong>Oui</strong>, les URL SEF standard de JOOMLA seront automatiquement redirig�e (redirection 301) vers leur �quivalent SEF s``il existe d�j� dans la base de donn�es. S``il n`existe pas, il est cr��, sauf si la page comporte des donn�es transmises par POST, auquel cas rien n``est fait.');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Ins�rer le nom de la flypage');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'Si activ�, le nom de la flypage sera ins�r� dans l`URL menant � un produit. Cela peut �tre d�sactiv� si vous n`utilisez qu`une seule flypage, et si vous n`utilisez pas le bouton PDF.');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Configuration Letterman  ');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'Itemid par d�faut pour la page Letterman');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', 'Entrez l`Itemid � ins�rer dans les liens g�n�r�s par Letterman : d�sinscription, messages de confirmation, ...');
define('_COM_SEF_SH_FB_TITLE', 'Configuration Fireboard  ');
define('_COM_SEF_SH_FB_INSERT_NAME', 'Ins�rer nom Fireboard');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', 'Si <strong>Activ�</strong>, le titre de l`�l�ment de menu qui conduit � Fireboard sera syst�matiquement ajout� au d�but des URL sef');
define('_COM_SEF_SH_FB_NAME', 'Nom Fireboard par d�faut');
define('_COM_SEF_TT_SH_FB_NAME', 'Quand le param�tre pr�c�dent est activ�, vous pouvez saisir un nom, qui sera alors employ� � la place du titre de l`�l�ment de menu. Notez bien qu`alors ce nom est invariant, et en particulier qu`il ne sera pas traduit.');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', 'Ins�rer le nom de la categorie');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', 'Si activ�, le nom de la categorie du forum est ins�r� dans l`URL sef pour tous les liens menant � l`affichage d`un post ou d`une cat�gorie');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', 'Ins�rer identifiant cat�gorie');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', 'Si activ�, le nom de cat�gorie dans une URL sera toujours pr�c�d� de l`identifiant interne de cette cat�gorie, ce qui est utile quand plusieurs cat�gories ont le m�me nom.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', 'Ins�rer sujet du message');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', 'Si activ�, le sujet d`un message sera ins�r� dans l`URL sef pour tous les liens menant � l`affichage de ce message');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', 'Ins�rer identifiant message');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', 'Si activ�, le sujet du message dans une URL sera toujours pr�c�d� de l`identifiant interne de ce sujet, ce qui est utile quand plusieurs sujets ont le m�me nom.');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', 'Ins�rer code langue dans les URL');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE', 'Si activ�, le code langue iso sera ins�r� dans les URL g�n�r�es, sauf pour celles dans la langue par d�faut du site.');
DEFINE('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','Ne pas traduire');
DEFINE('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','Ne pas ins�rer code');
define('_COM_SEF_SH_ADV_MANAGE_URL', 'Traitement des URL');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', 'Pour chaque composant install� :<br /><b>traitement normal</b><br/>Traite normalement les URLs. Si un fichier extension SEO avanc�e est pr�sent, il sera utilis� en lieu et place. <br/><b>sans cache</b><br/>ne pas stocker les URLs dans la base de donn�es, et cr�er les URLs classiques de Joomla<br/><b>passer</b><br/>ne pas construire les URLs pour ce composant<br/>');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', 'Traduction des URL');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', 'Pour chaque composant install�, choisissez si les URL doivent �tre traduites ou non. Sans effet si votre site ne comporte qu`une seule langue.');
define('_COM_SEF_SH_ADV_INSERT_ISO', 'Insertion du code ISO');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', 'Pour chaque composant install�, et si votre site est multi-lingue, indiquez si vous voulez ins�rer le code de langue dans les URL. Par exemple : www.monsite.com/<b>en</b>/introduction.html. Le code en indique l`anglais. Notez que le code ne sera jamais ins�r� pour la langue par d�faut du site.');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'Utiliser le pseudo');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', 'Si activ�, le pseudonyme de l`utilisateur sera employ� au lieu de son nom dans les URL lorsque vous avez activ� cette option (voir ci-dessus)');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', 'Remplacer extension SEF');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', 'Ne pas remplacer extension');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', 'Certains composants sont livr�s avec des fichiers d`extensions sef (sef_ext) destin�s aux logiciels OpenSEF ou SEF Advanced. Si ce param�tre est plac� sur Remplacer extension SEF, l`extension livr�e avec le composant ne sera pas utilis�e, mais remplac�e par celle de sh404SEF (si elle existe bien sur). Dans le cas contraire, c`est l`extension livr�e avec le composant qui sera mise en oeuvre.');
//V 1.2.4.q
define('_COM_SEF_SH_CONF_TAB_MAIN', 'Principaux');
define('_COM_SEF_SH_CONF_TAB_PLUGINS', 'Plugins');
define('_COM_SEF_SH_CONF_TAB_ADVANCED', 'Avanc�s');
define('_COM_SEF_SH_CONF_TAB_BY_COMPONENT', 'Par composant');

// V 1.2.4.q
define('_COM_SEF_SH_ENCODE_URL', 'Encoder les URL');
define('_COM_SEF_TT_SH_ENCODE_URL', 'Si activ�, les URL produites par sh404SEF seront encod�es de mani�re � �tre compatibles avec les langues ayant des caract�res non latin. L`encodage ressemble � : monsite.com/%34%56%E8%67%12.....');
define('_COM_SEF_SH_FILTER', 'Filtre');
define('_COM_SEF_CONFIRM_ERASE_CACHE', 'Voulez-vous vider le cache URL ? Ceci est toujours recommand� apr�s une modification de la configuration. Pour r�g�nerer le cache, vous devez visiter de nouveau la page d`accueil de votre site, ou mieux : cr�er un sitemap.');
define('_COM_SEF_SH_CAT_TABLE_SUFFIX', 'Table');
define('_COM_SEF_SH_REDIR_TOTAL', 'Total');
define('_COM_SEF_SH_REDIR_SEF', 'SEF');
define('_COM_SEF_SH_REDIR_404', '404');
define('_COM_SEF_SH_REDIR_CUSTOM', 'Perso.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX','id menu');
define('_COM_SEF_SH_FORCE_NON_SEF_HTTPS', 'Forcer non sef si HTTPS');
define('_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS', 'Si activ�, toutes les URL resteront non sef en cas de passage au mode SSL (HTTPS). Cela permet de fonctionner avec certaines configuration de serveurs SSL partag�s');
define('_COM_SEF_SH_GUESS_HOMEPAGE_ITEMID', 'Deviner l`Itemid sur page d`accueil');
define('_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID', 'Si activ�, sur la page d`accueil, l`Itemid des URL menant � des articles (com_content) sera supprim� et remplac� par celui que sh404SEF recherchera. Cela permet d`�viter que les articles visibles � la fois sur la page d`accueil et sur une autre page ne puissent �tre vus que sur la page d`accueil.');

?>
