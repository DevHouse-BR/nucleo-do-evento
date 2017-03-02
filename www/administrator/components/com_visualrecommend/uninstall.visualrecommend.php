<?php 
/*********************************************
* VisualRecommend - Component                *
* Copyright (C) 2007 by Bernard Gilly        *
* --------- All Rights Reserved ------------ *      
* Homepage   : www.visualclinic.fr           *
* Version    : 1.1.0                         *
* License    : Creative Commons              *
*********************************************/

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

function com_uninstall(){
	global $database, $mosConfig_absolute_path, $_VERSION;
	
	if ( $_VERSION->PRODUCT == 'Joomla!' ){	
	  if ( $_VERSION->RELEASE >= '1.5' ) {
		  $dir_plugin = 'plugins';
	  }else{
		  $dir_plugin = 'mambots';
	  }
	} else $dir_plugin = 'mambots';	 
	
	// uninstall bot
	$query = "DELETE FROM #__$dir_plugin WHERE element='visualrecommendbot'";
	$database->setQuery( $query );
	$database->query();
	@unlink( "$mosConfig_absolute_path/$dir_plugin/content/visualrecommendbot.php" );
	@unlink( "$mosConfig_absolute_path/$dir_plugin/content/visualrecommendbot.xml" );
	echo "<p><strong>VisualRecommend was uninstalled successfully.</strong></p>";
	echo "Bot was uninstalled";
}
?>