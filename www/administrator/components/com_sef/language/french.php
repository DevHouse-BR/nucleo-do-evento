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
DEFINE('_COM_SEF_VIEWURL','URLs<br/>optimisées');
DEFINE('_COM_SEF_VIEWURLDESC','Voir/modifier les URLs optimisées');
DEFINE('_COM_SEF_VIEW404','Journal des<br/>erreurs 404');
DEFINE('_COM_SEF_VIEW404DESC','Voir/modifier le journal d\'erreur 404');
DEFINE('_COM_SEF_VIEWCUSTOM','redirections<br/>personnalisées');
DEFINE('_COM_SEF_VIEWCUSTOMDESC','Voir/modifier les redirections personnalisées ');
DEFINE('_COM_SEF_SUPPORT','Site<br/>support');
DEFINE('_COM_SEF_SUPPORTDESC','Allez sur le site de support de sh404SEF');
DEFINE('_COM_SEF_BACK','Retour au panneau de contrôle de sh404SEF');
DEFINE('_COM_SEF_PURGEURL','Effacer<br/>les URLs');
DEFINE('_COM_SEF_PURGEURLDESC','Purge la liste des URLs optimisées');
DEFINE('_COM_SEF_PURGE404','Effacer<br/>les erreurs 404');
DEFINE('_COM_SEF_PURGE404DESC','Vide le journal de suivi des erreurs 404');
DEFINE('_COM_SEF_PURGECUSTOM','Effacer<br/>redirections personnalisées');
DEFINE('_COM_SEF_PURGECUSTOMDESC','Efface les redirections personnalisées');
DEFINE('_COM_SEF_WARNDELETE','ATTENTION!!!<br/>Vous allez effacer ');
DEFINE('_COM_SEF_RECORD',' enregistrement');
DEFINE('_COM_SEF_RECORDS',' enregistrements');
DEFINE('_COM_SEF_NORECORDS','Aucun enregistrement trouvé.');
DEFINE('_COM_SEF_PROCEED',' Valider ');
DEFINE('_COM_SEF_OK',' OK ');
DEFINE('_COM_SEF_SUCCESSPURGE','Enregistrements effacés.');
DEFINE('_PREVIEW_CLOSE','Fermer cette fenêtre');
DEFINE('_COM_SEF_EMPTYURL','Vous devez indiquer une URL vers laquelle rediriger.');
DEFINE('_COM_SEF_NOLEADSLASH','La nouvelle URL (optimisée) ne DOIT PAS COMMENCER par un /');
DEFINE('_COM_SEF_BADURL','L\'ancienne URL (non optimisée) doit commencer par index.php');
DEFINE('_COM_SEF_URLEXIST','Cette URL existe déjà dans la base de données!');
DEFINE('_COM_SEF_SHOW0','Montrer les URLs optimisées');
DEFINE('_COM_SEF_SHOW1','Montrer le journal d\'erreurs 404');
DEFINE('_COM_SEF_SHOW2','Montrer les redirections personnalisées');
DEFINE('_COM_SEF_INVALID_URL','URL non valide: ce lien requiert un Itemid valide, mais aucun n\'a pu être trouvé.<br/>SOLUTION: Créez un élément de menu qui pointe vers cet élément. Vous n\'avez pas besoin de le publier, il sffit qu\'il existe.');
DEFINE('_COM_SEF_DEF_404_MSG','<h1>Erreur 404: Non disponible</h1><h4>La page que vous avez demandée n\'existe pas sur ce serveur, ou n\'est pas disponible</h4>');
DEFINE('_COM_SEF_SELECT_DELETE','Choisissez un élément à effacer');
DEFINE('_COM_SEF_ASC',' (asc) ');
DEFINE('_COM_SEF_DESC',' (desc) ');
DEFINE('_COM_SEF_WRITEABLE',' <b><font color="green">Modifiable</font></b>');
DEFINE('_COM_SEF_UNWRITEABLE',' <b><font color="red">Non modifiable</font></b>');
DEFINE('_COM_SEF_USING_DEFAULT',' <b><font color="red">Utilisation des valeurs par défaut</font></b>');
DEFINE('_COM_SEF_DISABLED',"<p class='error'>NOTE: l\'optimisation pour les moteurs de recherche (SEO) est actuellement désactivée dans les réglages de Joomla. Pour créer des URLs optimisées, merci d\'activer en premier lieu le système SEO intégré à Joomla : <a href='".
	$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Configuration globale</a> SEO.</p>");
DEFINE('_COM_SEF_TITLE_CONFIG',' Configuration de sh404SEF');
DEFINE('_COM_SEF_TITLE_BASIC','Configuration de base');
DEFINE('_COM_SEF_ENABLED','Activé');
DEFINE('_COM_SEF_TT_ENABLED','Si désactivé, le système SEO intégré à Joomla sera utilisé');
DEFINE('_COM_SEF_DEF_404_PAGE','Page 404 par défaut');
DEFINE('_COM_SEF_REPLACE_CHAR','Caractère de remplacement');
DEFINE('_COM_SEF_TT_REPLACE_CHAR','Caractère à utiliser pour remplacer les caractères inconnus dans une URL');
DEFINE('_COM_SEF_PAGEREP_CHAR','Séparateur de No de page');
DEFINE('_COM_SEF_TT_PAGEREP_CHAR','Caractère pour séparer le numéro de page du reste des URLs');
DEFINE('_COM_SEF_STRIP_CHAR','Caractères à effacer');
DEFINE('_COM_SEF_TT_STRIP_CHAR','Caractères qui doivent être effacés des URLS, séparés par des | (Alt-Gr + touche 6)');
DEFINE('_COM_SEF_FRIENDTRIM_CHAR','Caractères à supprimer début/fin');
DEFINE('_COM_SEF_TT_FRIENDTRIM_CHAR','Caractères à supprimer au début et à la fin des URLS, séparés par des | (Alt-Gr + touche 6)');
DEFINE('_COM_SEF_USE_ALIAS','Utiliser alias de titre');
DEFINE('_COM_SEF_TT_USE_ALIAS','Si activé, le champ Alias de titre des articles sera utilisé à la place du titre pour construire les URLs');
DEFINE('_COM_SEF_SUFFIX','Suffixe URL');
DEFINE('_COM_SEF_TT_SUFFIX','Extension ajoutées aux URLS. Laissez blanc pour ne rien ajouter. La plupart du temps, on utilise html');
DEFINE('_COM_SEF_ADDFILE','Fichier index par défaut.');
DEFINE('_COM_SEF_TT_ADDFILE','Nom de fichier à ajouter après une URL vide, sans aucun nom de fichier.  Utile pour certain robots qui parcourent votre site à la recherche de fichier particulier, mais qui renvoient une erreur 404 au cas où ils ne le trouvent pas.');
DEFINE('_COM_SEF_PAGETEXT','Texte pages multiples');
DEFINE('_COM_SEF_TT_PAGETEXT','Texte à ajouter aux URLs dans le cas de pages multiples. Utilisez %s pour ajouter le n° de page. Par défaut, il sera ajouté à la fin. Si un suffixe a été défini ci-dessus, il sera ajouté à la fin de ce texte pour pages multiples.');
DEFINE('_COM_SEF_LOWER','Tout en minuscules');
DEFINE('_COM_SEF_TT_LOWER','Convertit les URLs en minuscules');
DEFINE('_COM_SEF_SHOW_SECT','Inclure la section');
DEFINE('_COM_SEF_TT_SHOW_SECT','Si activé, la SECTION à laquelle appartient un article sera utilisée pour construire son URL');
DEFINE('_COM_SEF_HIDE_CAT','Masquer la catégorie');
DEFINE('_COM_SEF_TT_SHOW_CAT','Si activé, la catégorie à laquelle appartient un article sera utilisée pour construire son URL');
DEFINE('_COM_SEF_404PAGE','Page erreur 404');
DEFINE('_COM_SEF_TT_404PAGE','Article de contenu statique à utiliser quand une erreur 404 se produit (Page indisponible). Que cet article soit publié ou non est sans importance');
DEFINE('_COM_SEF_TITLE_ADV','Configuration avancée');
DEFINE('_COM_SEF_TT_ADV','<b>traitement normal</b><br/>Traite normalement les URLs. Si un fichier extension SEO avancée est présent, il sera utilisé en lieu et place. <br/><b>sans cache</b><br/>ne pas stocker les URLs dans la base de données, et créer les URLs classiques de Joomla<br/><b>passer</b><br/>ne pas construire les URLs pour ce composant<br/>');
DEFINE('_COM_SEF_TT_ADV4','Options avancées');
DEFINE('_COM_SEF_TITLE_MANAGER','sh404SEF');
DEFINE('_COM_SEF_VIEWMODE','Mode:');
DEFINE('_COM_SEF_SORTBY','Classer par:');
DEFINE('_COM_SEF_HITS','Hits');
DEFINE('_COM_SEF_DATEADD','Date création');
DEFINE('_COM_SEF_SEFURL','URL optimisée');
DEFINE('_COM_SEF_URL','UURL');
DEFINE('_COM_SEF_REALURL','URL réelle');
DEFINE('_COM_SEF_EDIT','Modifier');
DEFINE('_COM_SEF_ADD','Ajouter');
DEFINE('_COM_SEF_NEWURL','Nouvelle URL optimisée');
DEFINE('_COM_SEF_TT_NEWURL','Vous ne pouvez faire que des redirections relatives depuis la racine du dossier Joomla <b>sans</b> le / du début');
DEFINE('_COM_SEF_OLDURL','Ancienne URL, non optimisée');
DEFINE('_COM_SEF_TT_OLDURL','Cett URL doit commencer par index.php');
DEFINE('_COM_SEF_SAVEAS','Enregistrer comme redirection personnalisée');
DEFINE('_COM_SEF_TITLE_SUPPORT','Support sh404SEF');
DEFINE('_COM_SEF_HELPVIA','<b>L\'aide est disponible au travers des forums :</b>');
DEFINE('_COM_SEF_OFFICIAL','Forum du projet');
DEFINE('_COM_SEF_MAMBERS','Forum JoomlaFrance (forum.joomlafacile.com)');
DEFINE('_COM_SEF_TITLE_PURGE','Vider la base de données des URLs sh404SEF');
DEFINE('_COM_SEF_USE_DEFAULT','(traitement normal)');
DEFINE('_COM_SEF_NOCACHE','sans cache');
DEFINE('_COM_SEF_SKIP','passer');
DEFINE('_COM_SEF_INSTALLED_VERS','Version installée:');
DEFINE('_COM_SEF_COPYRIGHT','Copyright');
DEFINE('_COM_SEF_LICENSE','Licence');
DEFINE('_COM_SEF_SUPPORT_404SEF','');
DEFINE('_COM_SEF_CONFIG_UPDATED','Configuration mise à jour');
DEFINE('_COM_SEF_WRITE_ERROR','Erreur lors de la sauvegarde de la configuration');
DEFINE('_COM_SEF_NOACCESS','Accès impossible');
DEFINE('_COM_SEF_FATAL_ERROR_HEADERS','ERREUR FATALE: HEADER déjà envoyé');
DEFINE('_COM_SEF_UPLOAD_OK','Le fichier a été envoyé avec succès');
DEFINE('_COM_SEF_ERROR_IMPORT','Erreur lors de l\'importation:');
DEFINE('_COM_SEF_INVALID_SQL','Instructions SQL invalide dans le fichier:');
DEFINE('_COM_SEF_NO_UNLINK','Impossible de supprimer le fichier envoyé dans le dossier media');
DEFINE('_COM_SEF_IMPORT_OK','Les URL personnalisées ont été importées correctement !');
DEFINE('_COM_SEF_WRITE_FAILED','Impossible de sauver le fichier envoyé dans le dossier media');
DEFINE('_COM_SEF_EXPORT_FAILED','Echec de l\'exportation!!!');
DEFINE('_COM_SEF_IMPORT_EXPORT','Importer/Exporter<br />redirections');
DEFINE('_COM_SEF_SELECT_FILE','Merci de commencer par choisir un fichier');
DEFINE('_COM_SEF_IMPORT','Importer des redirections personnalisées');
DEFINE('_COM_SEF_EXPORT','Sauvegarder vos redirections personnalisées');

// component interface
DEFINE('_COM_SEF_NOREAD','ERREUR FATALE: impossible de lire le fichier ');
DEFINE('_COM_SEF_CHK_PERMS','Merci de vérifier les permissions d\'accès aux fichier, et de contrôler que ce fichier peut être lu.');
DEFINE('_COM_SEF_DEBUG_DATA_DUMP','DUMP des données de DEBUG terminé: chargement de la page terminé');
DEFINE('_COM_SEF_STRANGE','Quelque chose de bizarre vient de se produire, et cela n\'aurait pas du arriver<br />');

//Added by Leon
define('_FULL_TITLE', 'Titre complet');
define('_TITLE_ALIAS', 'Alias de titre');
define('_COM_SEF_SHOW_CAT', 'Inclure la catégorie');

// added by shumisha

// General params
define('_COM_SEF_SH_REPLACEMENTS', 'Liste de remplacements');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Les caractères non valides dans des URLs, comme les caractères accentués par exemple, peuvent être remplacés suivant la table saisie ici. <br />Le format est xxx | yyy pour chaque règle de remplacement. xxx est le caractère à remplacer, et yyy est le caractère à employer à la place. <br />Il peut y avoir plusiers règles, séparées par des virgules (,). Entre l`ancien et le nouveau caractère, placez un | (touche AltGr + touche 6 en haut du clavier. <br />Notez que xxx et yyy peuvent être des caractères multiples, comme dans Œ|oe ');

define('_COM_SEF_SH_CACHE_TITLE', 'Gestion du cache');
define('_COM_SEF_SH_USE_URL_CACHE', 'Activation du cache URL');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'Si activé, les URLs ré-écrites sont chargées dans un cache en mémoire, ce qui accélère beaucoup le temps de création des pages. Par contre, cela consomme de la mémoire!');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'Taille du cache');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'Lorsque la mise en cache des URLs est activée, ce paramètre limite sa taille. Entrez le nombre d URLs à mettre en cache au maximum (les URLs au delà de cette limite seront toujours traitées, mais pas mises en cache, et le temps de chargement sera plus élevé). En première approche, chaque URL pèse à peu près 200 octets (100 pour l URL SEF, et 100 pour l URL non SEF. Donc, par exemple, 5000 URLs occuperont environ 1 Mo.');

// URL translation
define('_COM_SEF_SH_TRANSLATION_TITLE', 'Gestion des traductions');
define('_COM_SEF_SH_TRANSLATE_URL', 'Traduire les URLs');
define('_COM_SEF_TT_SH_TRANSLATE_URL', 'Si activé, et que votre site est multilingue, les éléments constitutifs des URLs seront traduits dans la langue du visiteur, tel que permis par Joomfish. Sinon, les URLs seront entièrement dans la langue par défaut du site. Sans effet si votre site n`est pas multilingue.');
// itemid control
define('_COM_SEF_SH_ITEMID_TITLE', 'Gestion de l`Itemid');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Insérer l`Itemid du menu si aucun');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Si aucun Itemid n`est présent dans l`URL non-SEF avant sa transformation en URL sef, et que vous activez cette option, l`Itemid de l`élément de menu courant sera ajouté à cette URL non-sef. De cette manière, si l`on clique sur ce lien, on restera sur la même page, c`est à dire que les mêmes modules par exemple seront affichés.)');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'Insérer le titre de menu si pas d`Itemid');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'Si aucun Itemid n`est présent dans l`URL non-SEF avant sa transformation en URL sef, et que vous activez cette option, le titre de l`élément actif de menu sera inséré dans l`URL sef. Ce paramètre devrait être activé si le précédent l`est, car cela devrait empêcher la formation d`URLs se terminant par -2, -3, -... quand un même article est vu sur plusieurs pages, sans pour autant être accessible directement depuis un lien dans un menu, ou bien une table de catégories ou de section.');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'Toujours insérer un titre');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'Si activé, le titre de l`élément de menu désigné par l`Itemid figurant dans l`URL non-sef, ou celui de l`élément de menu actif à défaut, sera inséré dans l`URL SEF.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Toujours ajouter l`Itemid à l`URL SEF');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'Si activé, l`Itemid de l`URL non-sef (ou l`Itemid de  l`élément courant du menu si aucun ne figure dans l`URL non-sef) sera ajouté à la fin de l`URL sef. A utiliser à la place de Toujours insérer un titre si vous avez plusieurs éléments de menu qui portent le même titre (par exemple un dans le menu principal et un autre dans le menu supérieur).');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Titre par défaut');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'Quand le paramètre ci-dessus est activé, vous pouvez saisir un titre ici, qui sera alors employé à la place des titres de menus. Notez bien qu`alors ce titre est invariant, et en particulier qu`il ne sera pas traduit.');
// Virtuemart params
define('_COM_SEF_SH_VM_TITLE', 'Configuration Virtuemart');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Insérer le nom de la boutique');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'Si activé, le nom de la boutique (c`est à dire le titre de l`élément de menu qui y conduit), sera systématiquement ajouté au début des URL sef.');
define('_COM_SEF_SH_SHOP_NAME', 'Nom boutique par défaut');
define('_COM_SEF_TT_SH_SHOP_NAME', 'Quand le paramètre ci-dessus est activé, vous pouvez saisir un nom ici, qui sera alors employé à la place des titres de menus. Notez bien qu`alors ce nom est invariant, et en particulier qu`il ne sera pas traduit.');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'Insérer identifiant produit');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'Si activé, le nom d`un produit dans une URL sera toujours précédé de l`identifiant interne de ce produit<br />Par exemple, monsite.com/3-mon-tres-beau-produit.html.<br />C`est utile en particulier si vous n`utilisez pas tous les noms de catégories, car des produits dans des catégories différentes peuvent porter le même nom. Notez bien que l`on parle ici de l`identifiant interne du produit, qui est toujours unique, et non du code produit (SKU) que vous entrez pour chaque produit.');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'Code produit à la place du nom');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'Si activé, le code produit (aussi appelé SKU par Virtuemart) sera utilisé en lieu et place du nom complet du produit.');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'Insérer le nom du fabricant');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'Si activé, le nom du fabricant, s`il y en a un pour ce produit, est inséré dans l`URL sef pour toutes les liens menant à l`affichage d`un produit.<br />Par exemple : monsite.com/nom-du-fabricant/nom-du-produit.html');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Insérer identifiant fabricant');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'Si activé, le nom d`un fabricant dans une URL sera toujours précédé de l`identifiant interne de ce fabricant<br />par exemple : monsite.com/6-nom-du-fabricant/mon-tres-beau-produit.html.');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Insérer nom catégories');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'Si réglé sur <strong>Aucune</strong>, aucun nom de catégorie ne sera inséré dans les URL sef menant à une page produit, par exemple : <br /> monsite.com/joomla-cms.html<br />Si réglé sur <strong>La dernière seulement</strong>, le nom de la catégorie à laquelle appartient le produit sera inséré dans l`URL sef, par exemple: <br /> monsite.com/php-mysql/joomla-cms.html<br />Si réglé sur <strong>Toutes les catégories imbriquées</strong>, le nom de toute la succession de catégories auxquelles appartient le produit sera inséré, par exemple : <br /> monsite.com/logiciels/cms/php-mysql/joomla-cms.html');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'Aucune');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'La dernière seulement');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'Toutes les catégories imbriquées');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'Insérer identifiant catégorie');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID', 'Si activé, le nom d`une catégorie sera toujours précédé dans les URL sef menant à une page produit d`un identifiant unique, par exemple : <br /> monsite.com/2-logiciels/6-cms/2-php-mysql/joomla-cms.html');

// V 1.2.4.h
// insert numerical id params
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE', 'Identificateur unique');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID', 'Insérer un identifiant unique dans l`URL');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID', 'Si <strong>Activé</strong>, un identificateur numérique sera inséré dans l`URL, pour faciliter son inclusion dans des services de nouvelles comme Google news. L`identifiant aura le format suivant : 2007041100000, avec 20070411 la date de création de l`article et 00000 l`identifiant unique interne à Joomla de l`article. Pensez à mettre à jour la date de création de votre article lorsque vous le publiez une fois terminé. Par contre, vous ne devrez plus changer cette date de création une fois l`article publié.');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_ALL_CAT', 'Toutes les catégories');
define('_COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'Appliquer à quelles catégories');
define('_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST', 'L`identifiant numérique sera seulement inséré dans les URL des articles des catégories que vous sélectionnez ici. Vous pouvez sélectionner plusieurs catégories en apuuyant et maintenant la touche Ctrl avant de cliquer sur le nom d`une catégorie.');

// V 1.2.4.j
define('_COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF', 'Redirection 301 de non-SEF vers SEF');
define('_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF', 'Si réglé sur <strong>Oui</strong>, les URL non-sef seront automatiquement redirigée (redirection 301) vers leur équivalent SEF s``il existe déjà dans la base de données. S``il n`existe pas, il est créé, sauf si la page comporte des données transmises par POST, auquel cas rien n``est fait.');
define('_COM_SEF_SH_LIVE_SECURE_SITE', 'URL en mode SSL');
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', '<strong>Indiquez ici l`URl à utiliser lors du passage en mode SSL (https)</strong>.<br />Nécessaire seulement si vous utilisez un accès de type https. Si vous laissez vide, et que vous utilisez https, sh404SEF emploiera l`adresse http<strong>S</strong>://URLNormaleDuSite.<br />Entrez une adresse complète, sans / à la fin. Exemple : <strong>https://www.monsite.com</strong> ou <strong>https://serveurSSLpartage.fr/moncompte</strong>.');

// V 1.2.4.k
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'Configuration iJoomla Magazine');
define('_COM_SEF_SH_ACTIVATE_IJOOMLA_MAG', 'Activer gestion iJoomla magazine dans les articles');
define('_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG', 'Si <strong>Activé</strong>, et qu`un paramètre appellé `ed` est passé dans l`URL d`affichage d`un article, il sera interprêté comme l`identifiant d`un numéro de magazine IJoomla.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Insérer identifiant numéro');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID', 'Si <strong>Activé</strong>, l`identifiant interne unique du numéro sera inséré avant le titre, afin d`être sur qu`il soit unique.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME', 'Insérer le nom du magazine dans les URL');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME', 'Si <strong>Activé</strong>, le nom du magazine (c`est à dire le titre de l`élément de menu qui y conduit), sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_SH_IJOOMLA_MAG_NAME', 'Nom magazine par défaut');
define('_COM_SEF_TT_SH_IJOOMLA_MAG_NAME', 'Quand le paramètre ci-dessus est activé, vous pouvez saisir un nom, qui sera alors employé à la place du titre de l`élément de menu. Notez bien qu`alors ce nom est invariant, et en particulier qu`il ne sera pas traduit.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Insérer identifiant magazine');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID', 'Si <strong>activé</strong>, le titre du magazine dans une URL sera toujours précédé de l`identifiant interne de ce magazine<br />par exemple : monsite.com/<strong>6</strong>-nom du magazine/titre-de-mon-article.html.');
define('_COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Insérer identifiant article');
define('_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID', 'Si <strong>activé</strong>, le titre d`un article dans une URL sera toujours précédé de l`identifiant interne de cet article. Par exemple: <br /> monsite.com/Joomla-magazine/<strong>56</strong>-titre-de-super-article.html');

define('_COM_SEF_SH_CB_TITLE', 'Configuration Community Builder');
define('_COM_SEF_SH_CB_INSERT_NAME', 'Insérer nom Community Builder');
define('_COM_SEF_TT_SH_CB_INSERT_NAME', 'Si <strong>Activé</strong>, le titre de l`élément de menu qui conduit à Community builder sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_SH_CB_NAME', 'Nom CB par défaut');
define('_COM_SEF_TT_SH_CB_NAME', 'Quand le paramètre précédent est activé, vous pouvez saisir un nom, qui sera alors employé à la place du titre de l`élément de menu. Notez bien qu`alors ce nom est invariant, et en particulier qu`il ne sera pas traduit.');
define('_COM_SEF_SH_CB_INSERT_USER_NAME', 'Insérer nom utilisateur');
define('_COM_SEF_TT_SH_CB_INSERT_USER_NAME', 'Si <strong>Activé</strong>, le nom de l`utilisateur sera inséré dans les URLs. <strong>ATTENTION</strong>: ceci entraîne une augmentation significative de la place occupée dans la base de données, et peut ralentir le chargement des pages si vous avez beaucoup d`utilisateurs inscrits. Si non activé, l`identifiant de l`utilisateur continue à être passée au format habituel (....?user=245 par exemple)');
define('_COM_SEF_SH_CB_INSERT_USER_ID', 'Insérer identifiant utilisateur');
define('_COM_SEF_TT_SH_CB_INSERT_USER_ID', 'Si <strong>Activé</strong>, l`identifiant unique de chaque utilisateur sera ajouté avant son nom <strong>lorsque l`option précédente est activée</strong>, dans le cas où deux utilisateurs auraient le même nom.');

define('_COM_SEF_SH_LOG_404_ERRORS', 'Enregistrer les erreurs 404');
define('_COM_SEF_TT_SH_LOG_404_ERRORS', 'Si <strong>Activé</strong>, les erreurs 404 se produisant seront enregistrées dans la base de données. Cela permet de détecter d`éventuelles erreurs dans votre site. Cela peut aussi prendre de l`espace inutile, et vous pouvez donc probablement le désactiver une fois la phase de mise au point de votre site terminée.');

define('_COM_SEF_SH_VM_ADDITIONAL_TEXT', 'Ajouter texte additionel');
define('_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT', 'Si <strong>Activé</strong>, un texte additionnel sera ajouté aux URL, quand on parcourt les catégories. Par exemple : ..../categorie-A/voir-tous-les-produits.html à la place de ..../categorie-A/ .');

// V 1.2.4.m
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Redirection 301 du SEF JOOMLA vers SEF');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'Si réglé sur <strong>Oui</strong>, les URL SEF standard de JOOMLA seront automatiquement redirigée (redirection 301) vers leur équivalent SEF s``il existe déjà dans la base de données. S``il n`existe pas, il est créé, sauf si la page comporte des données transmises par POST, auquel cas rien n``est fait.');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Insérer le nom de la flypage');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'Si activé, le nom de la flypage sera inséré dans l`URL menant à un produit. Cela peut être désactivé si vous n`utilisez qu`une seule flypage, et si vous n`utilisez pas le bouton PDF.');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Configuration Letterman  ');
define('_COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID', 'Itemid par défaut pour la page Letterman');
define('_COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID', 'Entrez l`Itemid à insérer dans les liens générés par Letterman : désinscription, messages de confirmation, ...');
define('_COM_SEF_SH_FB_TITLE', 'Configuration Fireboard  ');
define('_COM_SEF_SH_FB_INSERT_NAME', 'Insérer nom Fireboard');
define('_COM_SEF_TT_SH_FB_INSERT_NAME', 'Si <strong>Activé</strong>, le titre de l`élément de menu qui conduit à Fireboard sera systématiquement ajouté au début des URL sef');
define('_COM_SEF_SH_FB_NAME', 'Nom Fireboard par défaut');
define('_COM_SEF_TT_SH_FB_NAME', 'Quand le paramètre précédent est activé, vous pouvez saisir un nom, qui sera alors employé à la place du titre de l`élément de menu. Notez bien qu`alors ce nom est invariant, et en particulier qu`il ne sera pas traduit.');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_NAME', 'Insérer le nom de la categorie');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME', 'Si activé, le nom de la categorie du forum est inséré dans l`URL sef pour tous les liens menant à l`affichage d`un post ou d`une catégorie');
define('_COM_SEF_SH_FB_INSERT_CATEGORY_ID', 'Insérer identifiant catégorie');
define('_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID', 'Si activé, le nom de catégorie dans une URL sera toujours précédé de l`identifiant interne de cette catégorie, ce qui est utile quand plusieurs catégories ont le même nom.');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT', 'Insérer sujet du message');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT', 'Si activé, le sujet d`un message sera inséré dans l`URL sef pour tous les liens menant à l`affichage de ce message');
define('_COM_SEF_SH_FB_INSERT_MESSAGE_ID', 'Insérer identifiant message');
define('_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID', 'Si activé, le sujet du message dans une URL sera toujours précédé de l`identifiant interne de ce sujet, ce qui est utile quand plusieurs sujets ont le même nom.');
define('_COM_SEF_SH_INSERT_LANGUAGE_CODE', 'Insérer code langue dans les URL');
define('_COM_SEF_TT_SH_INSERT_LANGUAGE_CODE', 'Si activé, le code langue iso sera inséré dans les URL générées, sauf pour celles dans la langue par défaut du site.');
DEFINE('_COM_SEF_SH_DO_NOT_TRANSLATE_URL','Ne pas traduire');
DEFINE('_COM_SEF_SH_DO_NOT_INSERT_LANGUAGE_CODE','Ne pas insérer code');
define('_COM_SEF_SH_ADV_MANAGE_URL', 'Traitement des URL');
define('_COM_SEF_TT_SH_ADV_MANAGE_URL', 'Pour chaque composant installé :<br /><b>traitement normal</b><br/>Traite normalement les URLs. Si un fichier extension SEO avancée est présent, il sera utilisé en lieu et place. <br/><b>sans cache</b><br/>ne pas stocker les URLs dans la base de données, et créer les URLs classiques de Joomla<br/><b>passer</b><br/>ne pas construire les URLs pour ce composant<br/>');
define('_COM_SEF_SH_ADV_TRANSLATE_URL', 'Traduction des URL');
define('_COM_SEF_TT_SH_ADV_TRANSLATE_URL', 'Pour chaque composant installé, choisissez si les URL doivent être traduites ou non. Sans effet si votre site ne comporte qu`une seule langue.');
define('_COM_SEF_SH_ADV_INSERT_ISO', 'Insertion du code ISO');
define('_COM_SEF_TT_SH_ADV_INSERT_ISO', 'Pour chaque composant installé, et si votre site est multi-lingue, indiquez si vous voulez insérer le code de langue dans les URL. Par exemple : www.monsite.com/<b>en</b>/introduction.html. Le code en indique l`anglais. Notez que le code ne sera jamais inséré pour la langue par défaut du site.');
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'Utiliser le pseudo');
define('_COM_SEF_TT_SH_CB_USE_USER_PSEUDO', 'Si activé, le pseudonyme de l`utilisateur sera employé au lieu de son nom dans les URL lorsque vous avez activé cette option (voir ci-dessus)');
define('_COM_SEF_SH_OVERRIDE_SEF_EXT', 'Remplacer extension SEF');
define('_COM_SEF_SH_DO_NOT_OVERRIDE_SEF_EXT', 'Ne pas remplacer extension');
define('_COM_SEF_TT_SH_ADV_OVERRIDE_SEF', 'Certains composants sont livrés avec des fichiers d`extensions sef (sef_ext) destinés aux logiciels OpenSEF ou SEF Advanced. Si ce paramètre est placé sur Remplacer extension SEF, l`extension livrée avec le composant ne sera pas utilisée, mais remplacée par celle de sh404SEF (si elle existe bien sur). Dans le cas contraire, c`est l`extension livrée avec le composant qui sera mise en oeuvre.');
//V 1.2.4.q
define('_COM_SEF_SH_CONF_TAB_MAIN', 'Principaux');
define('_COM_SEF_SH_CONF_TAB_PLUGINS', 'Plugins');
define('_COM_SEF_SH_CONF_TAB_ADVANCED', 'Avancés');
define('_COM_SEF_SH_CONF_TAB_BY_COMPONENT', 'Par composant');

// V 1.2.4.q
define('_COM_SEF_SH_ENCODE_URL', 'Encoder les URL');
define('_COM_SEF_TT_SH_ENCODE_URL', 'Si activé, les URL produites par sh404SEF seront encodées de manière à être compatibles avec les langues ayant des caractères non latin. L`encodage ressemble à : monsite.com/%34%56%E8%67%12.....');
define('_COM_SEF_SH_FILTER', 'Filtre');
define('_COM_SEF_CONFIRM_ERASE_CACHE', 'Voulez-vous vider le cache URL ? Ceci est toujours recommandé après une modification de la configuration. Pour régénerer le cache, vous devez visiter de nouveau la page d`accueil de votre site, ou mieux : créer un sitemap.');
define('_COM_SEF_SH_CAT_TABLE_SUFFIX', 'Table');
define('_COM_SEF_SH_REDIR_TOTAL', 'Total');
define('_COM_SEF_SH_REDIR_SEF', 'SEF');
define('_COM_SEF_SH_REDIR_404', '404');
define('_COM_SEF_SH_REDIR_CUSTOM', 'Perso.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX','id menu');
define('_COM_SEF_SH_FORCE_NON_SEF_HTTPS', 'Forcer non sef si HTTPS');
define('_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS', 'Si activé, toutes les URL resteront non sef en cas de passage au mode SSL (HTTPS). Cela permet de fonctionner avec certaines configuration de serveurs SSL partagés');
define('_COM_SEF_SH_GUESS_HOMEPAGE_ITEMID', 'Deviner l`Itemid sur page d`accueil');
define('_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID', 'Si activé, sur la page d`accueil, l`Itemid des URL menant à des articles (com_content) sera supprimé et remplacé par celui que sh404SEF recherchera. Cela permet d`éviter que les articles visibles à la fois sur la page d`accueil et sur une autre page ne puissent être vus que sur la page d`accueil.');

?>
