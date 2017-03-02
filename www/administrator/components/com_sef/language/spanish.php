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
// Spanish Translation by Juan Timaná - http://www.ezwp.com / sietbukuel@gmail.com
//

// Dont allow direct linking
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// admin interface
DEFINE('_COM_SEF_CONFIG','Configuración de <br/>sh404SEF');
DEFINE('_COM_SEF_CONFIG_DESC','Configurar sh404SEF');
DEFINE('_COM_SEF_HELP','Soporte para<br/>sh404SEF');
DEFINE('_COM_SEF_HELPDESC','Necesitas ayuda con sh404SEF?');
DEFINE('_COM_SEF_INFO','Documentación de <br/>404SEF');
DEFINE('_COM_SEF_INFODESC','Ver sumario y documentación de sh404SEF');
DEFINE('_COM_SEF_VIEWURL','Ver/Editar<br/>SEF Urls');
DEFINE('_COM_SEF_VIEWURLDESC','Ver/Editar SEF Urls');
DEFINE('_COM_SEF_VIEW404','Ver/Editar<br/>404 Logs');
DEFINE('_COM_SEF_VIEW404DESC','Ver/Editar 404 Logs');
DEFINE('_COM_SEF_VIEWCUSTOM','Ver/Editar<br/>Redirecciones personalizadas');
DEFINE('_COM_SEF_VIEWCUSTOMDESC','Ver/Editar Redirecciones personalizadas');
DEFINE('_COM_SEF_SUPPORT','Sitio Web de<br/>Support');
DEFINE('_COM_SEF_SUPPORTDESC','Visitar el sitio de soporte para sh404SEF (nueva ventana)');
DEFINE('_COM_SEF_BACK','Regresar al panel de Control de sh404SEF');
DEFINE('_COM_SEF_PURGEURL','Purgar<br/>SEF Urls');
DEFINE('_COM_SEF_PURGEURLDESC','Purgar SEF Urls');
DEFINE('_COM_SEF_PURGE404','Purgar<br/>404 Logs');
DEFINE('_COM_SEF_PURGE404DESC','Purgar 404 Logs');
DEFINE('_COM_SEF_PURGECUSTOM','Purgar<br/>Redirecciones personalizadas');
DEFINE('_COM_SEF_PURGECUSTOMDESC','Purgar Redirecciones personalizadas');
DEFINE('_COM_SEF_WARNDELETE','ADVERTENCIA!!!<br/>Vas a borrar ');
DEFINE('_COM_SEF_RECORD',' record');
DEFINE('_COM_SEF_RECORDS',' records');
DEFINE('_COM_SEF_NORECORDS','No se encontraron records.');
DEFINE('_COM_SEF_PROCEED',' Proceder ');
DEFINE('_COM_SEF_OK',' OK ');
DEFINE('_COM_SEF_SUCCESSPURGE','Se purgaron los records exitósamente');
DEFINE('_PREVIEW_CLOSE','Cerrar esta ventana');
DEFINE('_COM_SEF_EMPTYURL','Debes especificar una URL para la redirección.');
DEFINE('_COM_SEF_NOLEADSLASH','No debes incluir ningun slash al princio de la nueva');
DEFINE('_COM_SEF_BADURL','La vieja y no SEF URL debe comenzar con inde.php');
DEFINE('_COM_SEF_URLEXIST','Esta URL ya existe en la base de datos!');
DEFINE('_COM_SEF_SHOW0','Mostrar SEF Urls');
DEFINE('_COM_SEF_SHOW1','Mostrar 404 Log');
DEFINE('_COM_SEF_SHOW2','Mostrar Redirecciones Personalizadas');
DEFINE('_COM_SEF_INVALID_URL','URL INVALIDA: este enlace requiere de un Itemid válido, pero no fue encontrado.<br/>SOLUCION: Crear un item en el menú. No necesitas publicarlo, sólo crearlo.');
DEFINE('_COM_SEF_DEF_404_MSG','<h1>Error 404: Página No Encontrada</h1><h4>Lo sentimos, pero la página que busca no existe o no se pudo encontrar</h4>');
DEFINE('_COM_SEF_SELECT_DELETE','Selecciona un item para borrar');
DEFINE('_COM_SEF_ASC',' (asc) ');
DEFINE('_COM_SEF_DESC',' (desc) ');
DEFINE('_COM_SEF_WRITEABLE',' <b><font color="green">Permite escritura</font></b>');
DEFINE('_COM_SEF_UNWRITEABLE',' <b><font color="red">No permite escritura</font></b>');
DEFINE('_COM_SEF_USING_DEFAULT',' <b><font color="red">Usando los valores por defecto</font></b>');
DEFINE('_COM_SEF_DISABLED',"<p class='error'>NOTA: Soporte para SEF en Joomla/Mambo está actualmente desabilitado. Para usar SEF, hablítelo desde la<a href='".
	$GLOBALS['mosConfig_live_site']."/administrator/index2.php?option=com_config'>Configuración Global</a> página SEO.</p>");
DEFINE('_COM_SEF_TITLE_CONFIG','Configuración sh404SEF');
DEFINE('_COM_SEF_TITLE_BASIC','Configuración Básica');
DEFINE('_COM_SEF_ENABLED','habilitado');
DEFINE('_COM_SEF_TT_ENABLED','Si lo defines como No, se usarán las URLs SEF por defecto');
DEFINE('_COM_SEF_DEF_404_PAGE','<b>Página 404 por defecto</b><br>');
DEFINE('_COM_SEF_REPLACE_CHAR','Caracter de reemplazo');
DEFINE('_COM_SEF_TT_REPLACE_CHAR','Caracter usado para reemplazar caracteres desconocidos en la URL');
DEFINE('_COM_SEF_PAGEREP_CHAR','Page spacer character');
DEFINE('_COM_SEF_TT_PAGEREP_CHAR','Character to use to space page numbers away from the rest of the URL');
DEFINE('_COM_SEF_STRIP_CHAR','Strip characters');
DEFINE('_COM_SEF_TT_STRIP_CHAR','Characters to strip from the URL, separate with |');
DEFINE('_COM_SEF_FRIENDTRIM_CHAR','Trim friendly characters');
DEFINE('_COM_SEF_TT_FRIENDTRIM_CHAR','Characters to trim from around the URL, separate with |');
DEFINE('_COM_SEF_USE_ALIAS','Usar Título Alias');
DEFINE('_COM_SEF_TT_USE_ALIAS','Usar titlos_alias y no el título en la URL');
DEFINE('_COM_SEF_SUFFIX','Sufijo');
DEFINE('_COM_SEF_TT_SUFFIX','Extensión para usar en los \\\'archivos\\\'. Para desabilitar dejarlo en blanco. Comunmente es \\\'html\\\'.');
DEFINE('_COM_SEF_ADDFILE','Default index file.');
DEFINE('_COM_SEF_TT_ADDFILE','File name to place after a blank url / when no file exists.  Useful for bots that crawl your site looking for a specific file in that place but returns a 404 because there is none there.');
DEFINE('_COM_SEF_PAGETEXT','Texto Página');
DEFINE('_COM_SEF_TT_PAGETEXT','Texto para serparar páginas multiples. Usar %s para insertar el número, por defecto irá al final de la URL. Si algún sufijo está definido será agregado al final de la URL.');
DEFINE('_COM_SEF_LOWER','Todo en minúsculas');
DEFINE('_COM_SEF_TT_LOWER','Convierte todos los caracteres a minúscilas en la URL','Todo en minúsculas');
DEFINE('_COM_SEF_SHOW_SECT','Mostrar sección');
DEFINE('_COM_SEF_TT_SHOW_SECT','Defínelo como Sí para incluir el nombre de la sección en la URL');
DEFINE('_COM_SEF_HIDE_CAT','Ocultar Categoría');
DEFINE('_COM_SEF_TT_SHOW_CAT','Defínelo como Si para excluir el nombre de la categoría en la URL');
DEFINE('_COM_SEF_404PAGE','Página 404');
DEFINE('_COM_SEF_TT_404PAGE','Página de contenido estático para uasr con 404 no encontró errores (si está publicado o no, no importa)');
DEFINE('_COM_SEF_TITLE_ADV','Configuración Avanzada del Componente');
DEFINE('_COM_SEF_TT_ADV','<b>manejador por defecto</b><br/>proceso normal, si alguna extensión de SEF Advance está presente se usará. <br/><b>nocache</b><br/>no gurdar las urls en la base de datos ni crear el estilo antiguo de URLs-SEF<br/><b>skip</b><br/>no usar SEF para este componente<br/>');
DEFINE('_COM_SEF_TT_ADV4','Opciones avanzadas para ');
DEFINE('_COM_SEF_TITLE_MANAGER','Administrador de 404 SEF');
DEFINE('_COM_SEF_VIEWMODE','Modo:');
DEFINE('_COM_SEF_SORTBY','Ordenar por:');
DEFINE('_COM_SEF_HITS','Hits');
DEFINE('_COM_SEF_DATEADD','Fecha');
DEFINE('_COM_SEF_SEFURL','Url SEF');
DEFINE('_COM_SEF_URL','Url');
DEFINE('_COM_SEF_REALURL','Url Real');
DEFINE('_COM_SEF_EDIT','Editar');
DEFINE('_COM_SEF_ADD','Agregar');
DEFINE('_COM_SEF_NEWURL','Nueva URL SEF');
DEFINE('_COM_SEF_TT_NEWURL','Sólo redirección relativa a la carpeta raiz de Joomla/Mambo <i>sin</i> slash al princio');
DEFINE('_COM_SEF_OLDURL','Antigua URL no-SEF');
DEFINE('_COM_SEF_TT_OLDURL','Esta URL debe comezar con index.php');
DEFINE('_COM_SEF_SAVEAS','Guardar una redirección personalizada');
DEFINE('_COM_SEF_TITLE_SUPPORT','Soporte para sh404SEF');
DEFINE('_COM_SEF_HELPVIA','<b>La ayuda esta diponisble en los siguientes foros:</b>');
DEFINE('_COM_SEF_OFFICIAL','Foros oficiales del proyecto');
DEFINE('_COM_SEF_MAMBERS','Foro Mambers');
DEFINE('_COM_SEF_TITLE_PURGE','Purgar base de datos de sh404SEF');
DEFINE('_COM_SEF_USE_DEFAULT','(usar manejador por defecto)');
DEFINE('_COM_SEF_NOCACHE','sin caché');
DEFINE('_COM_SEF_SKIP','Saltar');
DEFINE('_COM_SEF_INSTALLED_VERS','Versión Instalada:');
DEFINE('_COM_SEF_COPYRIGHT','Derechos de Autor');
DEFINE('_COM_SEF_LICENSE','Licencia');
DEFINE('_COM_SEF_SUPPORT_404SEF','Soporta a sh404SEF');
DEFINE('_COM_SEF_CONFIG_UPDATED','Configuración actualizada');
DEFINE('_COM_SEF_WRITE_ERROR','Error al escribir la configuración');

// component interface
DEFINE('_COM_SEF_NOREAD','ERROR FATAL: No se puede leer el archivo ');
DEFINE('_COM_SEF_CHK_PERMS','Por favor, revisa y asegúrate de que tu archivo tenga permisos de lectura.');
DEFINE('_COM_SEF_DEBUG_DATA_DUMP','DEBUG DATA DUMP COMPLETO: Carga de la página terminada');
DEFINE('_COM_SEF_STRANGE','Algo extraño ocurrió. Esto no debe ocurrir.<br />');

// added by shumisha

// General params
define('_COM_SEF_SH_REPLACEMENTS', 'Lista de caracteres de reemplacamiento');
define('_COM_SEF_TT_SH_REPLACEMENTS', 'Caracteres no aceptados en la URL, como los caracteres non-latin or con Accentuacion, pueden ser Remplazados sigiente la tabla eligida. <br />Formato es xxx | yyy por cada regla de remplazamiento. xxx es el caracter a remplazar, y  yyy es el nuevo caracter. <br />Es posible que hay varias reglas, separadas par un coma (,). Entre el antiguo y el nuevo caracter pon un  | character. <br />a notar que eso caracteres xxx or yyy pueden ser caracteres multiples, como  Œ|oe ');
// cache params
define('_COM_SEF_SH_CACHE_TITLE', 'Manejo del cache');
define('_COM_SEF_SH_USE_URL_CACHE', 'Utilizar el cache');
define('_COM_SEF_TT_SH_USE_URL_CACHE', 'Si activado, las URL son cargadas en memoria cache, que que mejora el tiempo de carga de las paginas. Pero eso consume mas de memoria!');
define('_COM_SEF_SH_MAX_URL_IN_CACHE', 'Tamaño del cache');
define('_COM_SEF_TT_SH_MAX_URL_IN_CACHE', 'Cuando el cache de las URL son activdas, este parametro limta su tamaño. Pon el nombre maximum de URL a poner en cache (Las URL fuera de este limite seran siempre processadas, pero no cargadas en cache, y el tiempo de cargada sera mas largo). A ver, cada URL tiene un peso maso menos de 200 bytes (100 por el SEF URL y 100 por non-sef URL). Entonces, por ejemplo,  5000 URLs tendra un peso de 1 Mb de memoria.');
// URL translation
define('_COM_SEF_SH_TRANSLATION_TITLE', 'Manejo de los traducciónes');
define('_COM_SEF_SH_TRANSLATE_URL', 'Traducir URL');
define('_COM_SEF_TT_SH_TRANSLATE_URL', 'Si activada, y que su sitio es  multiidioma, los elementos SEF URL son traducidos en la idioma el visitor, como lo hace Joomfish. Si desactivada, las URL van a ser en la idioma por default del sitio. Sin efecto si su web no es multiidioma.');
// itemid control
define('_COM_SEF_SH_ITEMID_TITLE', 'Manejo del Itemid');
define('_COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Insertar Itemid si no hay');
define('_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE', 'Si ninguno Itemid esta presente en el non-sef URL antes a su transformacion en SEF, y que activas este opcion, el Itemid del menu coriente sera agregada a este url non-SEF. De este manero si pinchamos en este enlace nos quedaremos en la misma pagina (ie: se podra ver los mismos modulos)');
define('_COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID', 'Insertar título de menu si no hay Itemid');
define('_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID', 'Si no hay Itemid en la non-sef URL antes de la transformacion en SEF URL, y que activas este opcion, el titulo del elemento activo va a ser insertado en el SEF URL. Este parametro deberia ser activado si el precedente lo es tambien, porque eso permite de prohibir las URL como -2, -3, -... que muchas vezes son agregadas al URL cuando un articulo se puede ver en varios lugares');
define('_COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE', 'Siempre insertar título de menu');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE', 'If set to yes, the menu item title corresponding to the Itemid set up in the non-sef URL, or the current menu item title if no Itemid is set, will be inserted in the SEF URL.');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID', 'Siempre añadir Itemid al SEF URL');
define('_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID', 'If set to yes, the non-sef Itemid (or the current menu item Itemid if none is set in the non-sef URL) will be appended to the SEF URL. This should be used instead of Always insert menu title parameter, if you have several menu items with the same title (as if one in main menu and one in top menu for instance)');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX', 'menu id');
define('_COM_SEF_SH_DEFAULT_MENU_ITEM_NAME', 'Título de menu si falta');
define('_COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME', 'When the above parameter is set to Yes, you can override the text inserted in the SEF URL here. Note that this text will be invariant, and will not be translated for instance');
// Virtuemart params
define('_COM_SEF_SH_VM_TITLE', 'Configuración Virtuemart ');
define('_COM_SEF_SH_VM_INSERT_SHOP_NAME', 'Insertar nombre de tienda');
define('_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME', 'If set to yes, shop name (as defined by shop menu item title) will allways be prepended to SEF URL');
define('_COM_SEF_SH_SHOP_NAME', 'Nombre de tienda si falta');
define('_COM_SEF_TT_SH_SHOP_NAME', 'When the above parameter is set to Yes, you can override the text inserted in the SEF URL here. Note that this text will be invariant, and will not be translated for instance');
define('_COM_SEF_SH_INSERT_PRODUCT_ID', 'Insertar ID de producto');
define('_COM_SEF_TT_SH_INSERT_PRODUCT_ID', 'If set to Yes, product ID will be prepended to product name in the SEF URL<br />For instance : mysite.com/3-my-very-nice-product.html.<br />This is useful if you do not insert all categories names in URL, as several products may have same name, in various categories. Please note that this is not the product SKU, but rather the internal product id, which is always unique.');
define('_COM_SEF_SH_VM_USE_PRODUCT_SKU', 'Utilizar el producto codigo en vez del nombre');
define('_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU', 'If set to Yes, product SKU, the product code you enter for each product, will be used instead of the product full name.');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME', 'Insertar nombre de fabricante');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME', 'If set to Yes, manufacturer name, if any, will be inserted in SEF URL leading to a product.<br />For instance : mysite.com/manufacturer-name/product-name.html');
define('_COM_SEF_SH_VM_INSERT_MANUFACTURER_ID', 'Insertar ID de fabricante');
define('_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID', 'If set to Yes, manufacturer ID will be prepended to manufacturer name in the SEF URL<br />For instance : mysite.com/6-manufacturer-name/3-my-very-nice-product.html.');
define('_COM_SEF_SH_VM_INSERT_CATEGORIES', 'Insertar categorías');
define('_COM_SEF_TT_SH_VM_INSERT_CATEGORIES', 'If set to <strong>None</strong>, no category name will be inserted in a URL leading to a product display, as in : <br /> mysite.com/joomla-cms.html<br />If set to <strong>Only last one</strong>, the name of the category to which the product belongs will be inserted in the SEF URL, as in : <br /> mysite.com/joomla/joomla-cms.html<br />If set to <strong>All nested categories</strong>, the names of all categories to which the product belongs will be added, as in : <br /> mysite.com/software/cms/joomla/joomla-cms.html');
define('_COM_SEF_SH_VM_DO_NOT_SHOW_CATEGORIES', 'Ninguna');
define('_COM_SEF_SH_VM_SHOW_LAST_CATEGORY', 'El último solamente');
define('_COM_SEF_SH_VM_SHOW_ALL_CATEGORIES', 'Categorías imbricadas');
define('_COM_SEF_SH_VM_INSERT_CATEGORY_ID', 'Insertar ID de categorías');
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
define('_COM_SEF_TT_SH_LIVE_SECURE_SITE', 'Set this to the <strong>full base URL of your site when in SSL mode</strong>.<br />Required only if you use https access. If not set, will default to http<strong>S</strong>://normalSiteURL.<br />Please enter full url, without any trailing slash. Example : <strong>https://www.mysite.com</strong> or <strong>https://sharedsslserveur.com/myaccount</strong>.');

// V 1.2.4.k
define('_COM_SEF_SH_IJOOMLA_MAG_TITLE', 'Configuración iJoomla Magazine');
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

define('_COM_SEF_SH_CB_TITLE', 'Configuración Community Builder');
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

// V 1.2.4.l
DEFINE('_COM_SEF_IMPORT_EXPORT','Importar/Exportar URLS');

// V 1.2.4.m
define('_COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF', '301 redirect from JOOMLA SEF to sh404SEF');
define('_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF', 'If set to <strong>Yes</strong>, JOOMLA standard SEF url will be 301 redirected to their sh404SEF equivalent, if any in the database. If it does not exists, it will be created on the fly, unless there is some POST data, in which case nothing happens.');
define('_COM_SEF_SH_VM_INSERT_FLYPAGE', 'Insert flypage name');
define('_COM_SEF_TT_SH_VM_INSERT_FLYPAGE', 'If set to Yes, the flypage name will be inserted in the URL leading to a product details. Can be deactivated if you use only one flypage.');
define('_COM_SEF_SH_LETTERMAN_TITLE', 'Configuración Letterman');
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
define('_COM_SEF_SH_CB_USE_USER_PSEUDO', 'Utilisar pseudo del usuario');
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
define('_COM_SEF_SH_FILTER', 'Filtre');
define('_COM_SEF_CONFIRM_ERASE_CACHE', 'Do you want to clear the URL cache ? This is highly recommended after changing configuration. To generate again the cache, you should browse again your homepage, or better : generate a sitemap for your site.');
define('_FULL_TITLE', 'Titulo');
define('_TITLE_ALIAS', 'Alias de titulo');
define('_COM_SEF_SH_CAT_TABLE_SUFFIX', 'Tabla');
define('_COM_SEF_SH_REDIR_TOTAL', 'Total');
define('_COM_SEF_SH_REDIR_SEF', 'SEF');
define('_COM_SEF_SH_REDIR_404', '404');
define('_COM_SEF_SH_REDIR_CUSTOM', 'Custom');
define('_COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX','id menu');
define('_COM_SEF_SH_FORCE_NON_SEF_HTTPS', 'Force non sef if HTTPS');
define('_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS', 'If set to Yes, URL will be forced to non sef after switching to SSL mode(HTTPS). This allows operation with some shared SSL servers causing problems otherwise.');
define('_COM_SEF_SH_GUESS_HOMEPAGE_ITEMID', 'Guess Itemid on homepage');
define('_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID', 'If set to yes, and on homepage only, Itemid of com_content URLs will be removed and replaced by the one sh404SEF guestimates. This is useful when some content elements can be viewed on the frontpage (in blog view for instance), and also on other pages on the site.');
?>

