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
DEFINE("_VRECOMMEND_CPL_CONFIG","Configuration");
DEFINE("_VRECOMMEND_CPL_TRACKING","Suivi des envois");
DEFINE("_VRECOMMEND_CPL_EXPORTALL","Export tous mails");
DEFINE("_VRECOMMEND_CPL_EXPORTREPLY","Export reply mails");
DEFINE("_VRECOMMEND_CPL_STATS","Statistiques");
DEFINE("_VRECOMMEND_CPL_PURGE","Purger");
DEFINE("_VRECOMMEND_CPL_ABOUT","A Propos");

// ADMIN
DEFINE("_VRECOMMEND_NOTWRITING","Fichier de configuration non-ouvert en écriture!");
DEFINE("_VRECOMMEND_SAVESETTINGS","sauvé");
DEFINE("_VRECOMMEND_SETTINGS","Configuration");
DEFINE("_VRECOMMEND_TRACKINGDELETED","tracking supprimé");
DEFINE("_VRECOMMEND_NODATAFOREXPORT","Aucune donnée à exporter.");
DEFINE("_VRECOMMEND_CSVNOTWRITING","Fichier CSV non-ouvert en écriture!");
DEFINE("_VRECOMMEND_EXPORTEMAILSTOCSV","Exporter les emails dans un fichier CSV");
DEFINE("_VRECOMMEND_EXPORTCSV","Export CSV");

// ADMIN TAB SETTINGS
DEFINE("_VRECOMMEND_GENERALSETTING","Configuration générale");
DEFINE("_VRECOMMEND_GENERAL","Général");
DEFINE("_VRECOMMEND_REGISTEREDONLY","Utilisateurs enregistrés");
DEFINE("_VRECOMMEND_ALLOWREGISTERED","Seul les utilisateurs enregistrés pourront recommander un article ?");
DEFINE("_VRECOMMEND_LINK_TO_CB","Lier au profil de Community Builder");
DEFINE("_VRECOMMEND_LINK_TO_CB_DETAIL","Sur utilisateur enregistré seulement, ajoute dans le mail un lien au profil utilisateur de Community Builder.");
DEFINE("_VRECOMMEND_MAXRECOMMENDSENDING","Max envoi recommandation");
DEFINE("_VRECOMMEND_MAXDAILYRECOMMEND","Max/jour recommandations/user");
DEFINE("_VRECOMMEND_UNLIMITED","Illimité");
DEFINE("_VRECOMMEND_USERCUSTOMMESSAGE","User custom message");
DEFINE("_VRECOMMEND_SHOWFORM","Formulaire d'envoi");
DEFINE("_VRECOMMEND_NORMAL","normal");
DEFINE("_VRECOMMEND_POPUP","popup");
DEFINE("_VRECOMMEND_CUSTOMYOURPOPUP","Personnalisation de la popup");
DEFINE("_VRECOMMEND_WIDTH","Largeur");
DEFINE("_VRECOMMEND_HEIGHT","Hauteur");
DEFINE("_VRECOMMEND_ACTIVATEADSENSE","Afficher Google Adsense");
DEFINE("_VRECOMMEND_SETTINGADSENSEDESCRIPTION","Paramétrer Google Adsense dans le dernier onglet");
DEFINE("_VRECOMMEND_POSITIONADSENSE","Position Adsense");
DEFINE("_VRECOMMEND_TOP","Haut");
DEFINE("_VRECOMMEND_BOTTOM","Bas");
DEFINE("_VRECOMMEND_BOTH","Les deux");
DEFINE("_VRECOMMEND_AD_FORMAT","Format");

// ADMIN TAB PLUGIN
DEFINE("_VRECOMMEND_PLUGIN","Plugin");
DEFINE("_VRECOMMEND_CHOOSEMODEOPERATING","Choisir le mode de fonctionnement");
DEFINE("_VRECOMMEND_MODEOPERATING","Mode de fonctionnement");
DEFINE("_VRECOMMEND_INDIVIDUALCOMMANDBOT","Mode manuel (insertion par tag)");
DEFINE("_VRECOMMEND_CHOOSEFROMSECTIONBELOW","Automatique (choisir les sections çi-dessous)");
DEFINE("_VRECOMMEND_DEF_MODEOPERATING","Avec le mode manuel par tag {visualrecommend}, vous pouvez choisir quel article sera recommandé ou non. Le mode semi-auto utilise le tag ainsi que le choix des sections. Si vous utilisez le mode automatique, ce sera toute la ou les sections choisies qui pourront être recommandées.");
DEFINE("_VRECOMMEND_SECTIONSAVAILABLE","Sections disponibles");
DEFINE("_VRECOMMEND_DEF_SECTIONSAVAILABLE","Si vous utilisez la seconde ou la troisième option, vous pouvez sélectionner ici chaque section qui sera utilisée par le système de recommandation. Sélections multiples possible.");
DEFINE("_VRECOMMEND_ONLYONFULLTEXT","Ne montrer que sur le texte entier");
DEFINE("_VRECOMMEND_BOTH_INDIVIDUALTAG_AND_SECTIONBELOW","Semi-automatique (tag et choix des sections çi-dessous)");
DEFINE("_VRECOMMEND_STATICCONTENTS","Articles statiques");
DEFINE("_VRECOMMEND_STYLECSS","Class CSS");
DEFINE("_VRECOMMEND_STYLECSSDESCRIPTION","Optionnel: définissez le nom de la classe CSS utilisé pour le lien (exemple readon ou small etc...)");

// ADMIN TAB MAIL
DEFINE("_VRECOMMEND_MAIL","Mail");
DEFINE("_VRECOMMEND_MAILSETTINGS","Paramètres Mail");
DEFINE("_VRECOMMEND_MAILSUBJECT","Sujet du mail");
DEFINE("_VRECOMMEND_MAILMESSAGEBODY","Corps du message");
DEFINE("_VRECOMMEND_AVAILABLE_TAGS","Tags disponibles:");

// ADMIN TAB MISCELLENAEOUS
DEFINE("_VRECOMMEND_MISCELLANEOUS","Options");
DEFINE("_VRECOMMEND_AWARDS","Attribution de points (utilisateurs enregistrés seulement)");
DEFINE("_VRECOMMEND_POINTS_BY_SENT_MAIL","Points par email envoyé");
DEFINE("_VRECOMMEND_POINTS_ON_POSITIVE_RECOMMEND","Points par retour positif");

// ADMIN TAB ADSENSE
DEFINE("_VRECOMMEND_TAB_GOOGLEADSENSE","Adsense");
DEFINE("_VRECOMMEND_SETTINGSADSENSE","Paramétrage Google Adsense");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT","Ads Alignement");
DEFINE("_VRECOMMEND_ADS_LEFT","Gauche");
DEFINE("_VRECOMMEND_ADS_RIGHT","Droit");
DEFINE("_VRECOMMEND_ADS_CENTER","Centrer");
DEFINE("_VRECOMMEND_ADS_NONE","Aucun");
DEFINE("_VRECOMMEND_ADS_ALIGNMENT_DESC","Choose the ad alignment that you desire. If any choice disrupts your template orientation, choose none");
DEFINE("_VRECOMMEND_ADS_ID","Client ID");
DEFINE("_VRECOMMEND_ADS_ID_DESC","Please type your Client ID provided by Google AdSense. Authors AdSense ID is used as the default ID.");
DEFINE("_VRECOMMEND_ADS_CHANNEL","Ads Channel");
DEFINE("_VRECOMMEND_ADS_CHANNEL_DESC","Type the channel ID that you may have set in Google AdSense Admin options. It is advisable to assign a channel to track your earnings better.");
DEFINE("_VRECOMMEND_ADS_TYPE","Ads Type");
DEFINE("_VRECOMMEND_ADS_TYPE_DESC","Choose the ads types you would like to display on your page. If you are choosing Image Ads only option, plase use only these sizes: 728X90 - Leaderboard, 468X60 - Banner, 300X250 - Medium Rectangle, 160X600 - Wide Skyscraper and 120X600 - Skyscraper.");
DEFINE("_VRECOMMEND_ADS_TYPE_DEFAULTACCOUNT","Option de mon compte par défaut");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTONLY","Texte seulement");
DEFINE("_VRECOMMEND_ADS_TYPE_TEXTANDIMAGE","Texte et image");
DEFINE("_VRECOMMEND_ADS_TYPE_IMAGEONLY","Image seulement");
DEFINE("_VRECOMMEND_ADS_ALTERNATE","URL Ads Alternative");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_DESC","Alternate Ads URL to specify other ads when no ads are available. Alternatively, you may just type http:// for no alternate ads. But why not use alternate ads when you have that option?");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR","Couleur alternative");
DEFINE("_VRECOMMEND_ADS_ALTERNATE_COLOR_DESC","Alternate color when no ads are available, in hex, without #");
DEFINE("_VRECOMMEND_INHEXWHITOUT","In hex, without # (example FFFFFF)");
DEFINE("_VRECOMMEND_ADS_BORDER_COLOR","Border color");
DEFINE("_VRECOMMEND_ADS_BACKGROUND_COLOR","Background color");
DEFINE("_VRECOMMEND_ADS_LINK_COLOR","Link color");
DEFINE("_VRECOMMEND_ADS_URL_COLOR","Url color");
DEFINE("_VRECOMMEND_ADS_TEXT_COLOR","Text color");

// ADMIN TRACKING
DEFINE("_VRECOMMEND_TRACKING","Tracking");
DEFINE("_VRECOMMEND_TITLE","titre");
DEFINE("_VRECOMMEND_ID","ID");
DEFINE("_VRECOMMEND_RECOMMENDS_USERS","Recommandations / Utilisateurs");
DEFINE("_VRECOMMEND_LASTRECOMMEND","Dernière recommandation");
DEFINE("_VRECOMMEND_SENDINGS","envois");
DEFINE("_VRECOMMEND_SHOWTRACKING","Afficher tracking");
DEFINE("_VRECOMMEND_STATISTICS", "{numvisitor} visiteurs ont invité {numfriend} amis à lire {numarticle} articles");

// ADMIN SHOW DETAIL TRACKING
DEFINE("_VRECOMMEND_DATE","Date");
DEFINE("_VRECOMMEND_NAME","Nom");
DEFINE("_VRECOMMEND_IP","IP");
DEFINE("_VRECOMMEND_MAILS","Mail(s)");
DEFINE("_VRECOMMEND_REPLY","Retours");
DEFINE("_VRECOMMEND_POSITIVES_MAILS","Mail(s) positif(s)");

// STATISTICS
DEFINE("_VRECOMMEND_TOP_10","Top 10");
DEFINE("_VRECOMMEND_MOST_ACTIVE_REGISTERED_USERS","Utilisateurs enregistrés les plus actifs");
DEFINE("_VRECOMMEND_BEST_POINTS","Meilleurs total de point");
DEFINE("_VRECOMMEND_MOST_ITEM_RECOMMENDED","Articles les plus recommandés");
DEFINE("_VRECOMMEND_LAST_POSITIVE_REPLY","Derniers retours positifs");
DEFINE("_VRECOMMEND_STATS_RECOMMEND","invitations"); 
DEFINE("_VRECOMMEND_CONFIRMED","confirmés"); 

// COMMON
DEFINE("_VRECOMMEND_FILTER","Filtre");
DEFINE("_VRECOMMEND_CLOSE","Fermer");
DEFINE("_VRECOMMEND_BACK","Retour");
DEFINE("_VRECOMMEND_POINTS","points");
DEFINE("_VRECOMMEND_REGISTERED","Abonné");
DEFINE("_VRECOMMEND_GUEST","Invité");

// ADMIN ABOUT
DEFINE("_VRECOMMEND_ABOUT","A propos");

// FRONT-END
DEFINE("_VRECOMMEND_RECOMMEND","Envoyer cet article");
DEFINE("_VRECOMMEND_RECOMMEND_FORM","Envoyer cet article à des amis...");
DEFINE("_VRECOMMEND_YOURFRIENDNAME","Nom(s) de vos ami(s)");
DEFINE("_VRECOMMEND_YOURFRIENDEMAILADRESS","Adresse(s) email de vos ami(s)");
DEFINE("_VRECOMMEND_YOURNAME","Votre nom (requis)");
DEFINE("_VRECOMMEND_YOUREMAILADDRESS","Votre email (requis)");
DEFINE("_VRECOMMEND_MESSAGEADDEDATYOURRECOMMEND","Message ajouté à votre recommandation (facultatif):");
DEFINE("_VRECOMMEND_SUBMIT","Envoyer");
DEFINE("_VRECOMMEND_ADDEMAIL","Ajouter email(s)");
DEFINE("_VRECOMMEND_FRIENDEMAILERROR","Erreur sur un email de vos amis");
DEFINE("_VRECOMMEND_FRIENDNAMEERROR","Erreur sur le nom de vos amis");
DEFINE("_VRECOMMEND_NAME_ERROR","Erreur sur votre nom");
DEFINE("_VRECOMMEND_ONLYREGISTERED","Seul les utilisateurs enregistrés peuvent recommander par mail un article.<br />SVP connectez-vous oou enregistrez-vous.");
DEFINE("_VRECOMMEND_MAXDAILYEXCEEDED","Vous avez dépassé le quota maximum d'envoi par jour,  vous ne pouvez plus envoyer de recommandation aujourd'hui.");
DEFINE("_VRECOMMEND_SENDINGSRELEASED","envoi(s) réalisé(s). Merci pour vos recommandation(s)");
DEFINE("_VRECOMMEND_NOSENDINGRELEASED","Aucun envoi réalisé. Vérifiez les emails de vos amis.");
DEFINE("_VRECOMMEND_TO_REDUCE","Réduire");
DEFINE("_VRECOMMEND_GOTO_ARTICLE","Revenir à l'article");
DEFINE("_VRECOMMEND_GOTO_PROFILE","Voir le profil de"); // utilisé si Community Builder installé
DEFINE("_VRECOMMEND_ADD_LINK_PROFILE","ajouté un lien vers mon profil"); // utilisé si Community Builder installé
DEFINE("_VRECOMMEND_GOTO_ARTICLE","Revenir à l'article");
?>