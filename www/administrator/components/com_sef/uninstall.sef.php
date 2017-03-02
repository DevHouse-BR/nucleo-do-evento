<?php

/*
 * @version $Id: uninstall.sef.php,v 1.1 2005/01/21 01:17:51 marlboroman_2k Exp $
 *
 * 404 SEF for MOS 4.5.1
 *
 * Author:	W.H.Welch <marlboroman_2k@yahoo.com>
 * Copyright:	2004 W.H.Welch
 * License:	GNU General Public License
 * Modified by Yannick Gaultier (shumisha) 
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}
 */


defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function com_uninstall() {
  global $database, $mosConfig_absolute_path;

  // uninstall modules
	$database->setQuery( "DELETE FROM `#__modules` WHERE `module`= 'mod_shJoomfish';");
	$database->query();
	@unlink( "$mosConfig_absolute_path/modules/mod_shJoomfish.css" );
  @unlink( "$mosConfig_absolute_path/modules/mod_shJoomfish.php" );
  @unlink( "$mosConfig_absolute_path/modules/mod_shJoomfish.xml" );

	echo '<h3>sh404SEF and shJoomfish module have been succesfully uninstalled. However, shCustomTags module WAS NOT uninstalled, just in case you would like to keep using it, or you have defined manual tags. Please uninstall manually, using Joomla Installation / module menu.</h3>';
	if (substr(PHP_OS, 0, 3) == 'WIN') {
		$filename = "C:\Inetpub\wwwroot\web.config";
		echo '<p align="left">Please remember to remove '.$filename." and the Custom Error you created with the Internet Services Manager</p>";
	}
}
