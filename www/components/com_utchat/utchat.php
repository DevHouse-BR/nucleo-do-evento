<?php
/*
###################################################
# utChat    - A joomla chat component             #
# Author     : Yann Sallou   (syan)               #
# Copyright (C) 2007  by  Yann Sallou             #
# Homepage   : www.utopiart.com                   #
# Version    : 0.2.2                              #
# License    : Released under GPL terms           #
###################################################

 utChat

 Copyright (C) 2007 Yann Sallou  All rights reserved.

 This program is free software; you can redistribute it and/or
 modify it under the terms of the GNU General Public License
 as published by the Free Software Foundation; either version 2
 of the License, or (at your option) any later version.

 Please note that the GPL states that any headers in files and
 Copyright notices as well as credits in headers, source files
 and output (screens, prints, etc.) can not be removed.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 GNU General Public License for more details.

 The "GNU General Public License" (GPL) is available at
 http://www.gnu.org/copyleft/gpl.html.
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

require_once dirname(__FILE__)."/src/phpfreechat.class.php";

require_once($mosConfig_absolute_path.'/configuration.php');
require_once($mosConfig_absolute_path.'/includes/joomla.php');

if (!isset( $database )) {
  $database = new database( $mosConfig_host, $mosConfig_user, $mosConfig_password, $mosConfig_db, $mosConfig_dbprefix );
}

if (!isset( $mainframe )) {
  $mainframe = new mosMainFrame( $database, $option, '..' );
  $mainframe->initSession();
}

if (!isset( $my )) {
  $my = $mainframe->getUser(); 
} 
$uid = $my->username;

$utparams['serverid']   = md5(__FILE__);
$utparams['title']      = $mosConfig_sitename;
$utparams['language']   = $mosConfig_locale;
$utparams['nick']       = iconv("ISO-8859-1", "UTF-8", $uid);

require_once ($mosConfig_absolute_path.'/administrator/components/com_utchat/admin.utchat.conf.php');

$chat = new phpFreeChat($utparams);

$chat->printJavascript();
$chat->printStyle();
$chat->printChat();

echo "<!-- utChat joomla component - http://www.utopiart.com -->";
?>
