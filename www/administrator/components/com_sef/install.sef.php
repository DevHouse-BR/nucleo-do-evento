<?php
/**
 * SEF module for Joomla!
 * Originally written for Mambo as 404SEF by W. H. Welch.
 *
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

function com_install()
{
    global $database, $mosConfig_absolute_path, $mosConfig_live_site;
    ob_start();
    //this code is copied from the install file of Joomfish 1.7
	  // Add module shJoomfish
	  $database->setQuery( "INSERT INTO `#__modules` (`title`, `content`, `ordering`, `position`, `checked_out`, `checked_out_time`, `published`, `module`, `numnews`, `access`, `showtitle`, `params`, `iscore`, `client_id`) VALUES ('JoomFish language selection (sh version)', '', 2, 'user3', 0, '0000-00-00 00:00:00', 0, 'mod_shJoomfish', 0, 0, 0, '', 0, 0);");
	  $database->query();
	  $moduleID = $database->insertid();
	  $database->setQuery( "INSERT INTO `#__modules_menu` (`moduleid`, `menuid`) VALUES ($moduleID, 0);");
	  $database->query();
	
		$adminDir = dirname(__FILE__);
		
		@rename( $adminDir. "/modules/mod_shJoomfish.css", "$mosConfig_absolute_path/modules/mod_shJoomfish.css");
    @rename( $adminDir. "/modules/mod_shJoomfish.php", "$mosConfig_absolute_path/modules/mod_shJoomfish.php");
    @rename( $adminDir. "/modules/mod_shJoomfish.tmp", "$mosConfig_absolute_path/modules/mod_shJoomfish.xml");
    
    // end of code copied from Joomfish 1.7 install file
    // V 1.2.4.q Copy existing config file from /media to current component. Used to recover configuration when upgrading
    @unlink($adminDir. '/config/config.sef.php');
    @copy( $mosConfig_absolute_path.'/media/sh404_upgrade_conf_'
                  .str_replace('/','_',str_replace('http://', '', $mosConfig_live_site)).'.php', 
             $adminDir. '/config/config.sef.php' );
    
    // success !
    echo '<div class="quote" style="text-align: center;">';
    echo '<h1>sh404SEF installed succesfully!</h1>';
    echo '<h3>You must first edit the configuration, enable it and save before it will become active. If you are using Joomfish, you should as well publish the shJoomfish module, a replacement for Joomfish language switcher module, compatible with SEF URL. Do not forget to unpublish Joomfish module then.</h3>';
    $readdocs = '<p class="message">Please scroll down and read the documentation.<br/>There is still extra configuration that you need to complete for ';
    if (!(strpos($_SERVER['SERVER_SOFTWARE'], 'Microsoft-IIS') === false)) {
        echo $readdocs.'IIS.</p>';
    }
    else {
      echo $readdocs."the apache .htaccess file.</p>";
    }

    include($GLOBALS['mosConfig_absolute_path'].'/administrator/components/com_sef/readme.inc');

    $output = ob_get_contents();
    ob_end_clean();

    return $output;
}
?>
