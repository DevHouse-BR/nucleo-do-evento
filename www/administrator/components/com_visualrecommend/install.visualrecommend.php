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

function com_install() {
global $mosConfig_live_site, $mosConfig_absolute_path, $mosConfig_lang, $database, $_VERSION;

require( $mosConfig_absolute_path.'/administrator/components/com_visualrecommend/version.php' );
	 
?>
<code><table width="500"  border="0" align="center" cellpadding="0" cellspacing="0">
<tr><td><div align="left">
<strong>Installation Process :</strong><br /><br />
<?php
	if ( $_VERSION->PRODUCT == 'Joomla!' ){	
		if ( $_VERSION->RELEASE >= '1.5' ) {
			$massmail_img = 'massmail.png';
		}else{
			$massmail_img = 'mass_email.png';
		}
	} else $massmail_img = 'mass_email.png';
	
  # Set up new icons for admin menu
  echo "Start correcting icons in administration backend.<br />";
  $database->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_visualrecommend/images/visualrecommend_icon.png' WHERE admin_menu_link='option=com_visualrecommend'");
  $iconresult[0] = $database->query();
  $database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/controlpanel.png' WHERE admin_menu_link='option=com_visualrecommend&task=controlpanel'");
  $iconresult[1] = $database->query();  
  $database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/config.png' WHERE admin_menu_link='option=com_visualrecommend&task=config'");
  $iconresult[2] = $database->query();
  $database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/users.png' WHERE admin_menu_link='option=com_visualrecommend&task=tracking'");
  $iconresult[3] = $database->query();  
  $database->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_visualrecommend/images/statistic_icon.png' WHERE admin_menu_link='option=com_visualrecommend&task=statstracking'");
  $iconresult[4] = $database->query();  
  $database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/$massmail_img' WHERE admin_menu_link='option=com_visualrecommend&task=exporttracking'");
  $iconresult[5] = $database->query();
  $database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/$massmail_img' WHERE admin_menu_link='option=com_visualrecommend&task=exportreplytracking'");
  $iconresult[6] = $database->query();
  $database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/trash.png' WHERE admin_menu_link='option=com_visualrecommend&task=purgealltracking'");
  $iconresult[7] = $database->query();
  $database->setQuery("UPDATE #__components SET admin_menu_img='js/ThemeOffice/credits.png' WHERE admin_menu_link='option=com_visualrecommend&task=about'");
  $iconresult[8] = $database->query();
  foreach ($iconresult as $i=>$icresult) {
		if ($icresult) {
		  echo "<font color='green'>FINISHED:</font> Image of menu entry $i has been corrected.<br />";
		} else {
		  echo "<font color='red'>ERROR:</font> Image of menu entry $i could not be corrected.<br />";
		}
  }
  
  // Upgrade VisualRecommend 1.0.0 to 1.1.0
  $VisualRecommendUpgrades[0]['test'] = "SELECT `num_reply` FROM #__visualrecommend";
  $VisualRecommendUpgrades[0]['updates'][0] = "ALTER TABLE #__visualrecommend ADD `num_reply` TINYINT( 1 ) DEFAULT '0' NOT NULL AFTER `mails`";
  $VisualRecommendUpgrades[0]['updates'][1] = "ALTER TABLE #__visualrecommend ADD `mails_reply` TEXT DEFAULT '' NOT NULL AFTER `num_reply`";
  $VisualRecommendUpgrades[0]['updates'][2] = "ALTER TABLE #__visualrecommend ADD `num_points` INT( 11 ) DEFAULT '0' NOT NULL AFTER `mails_reply`";
  $VisualRecommendUpgrades[0]['updates'][3] = "ALTER TABLE #__visualrecommend ADD `link` VARCHAR( 255 ) DEFAULT '' NOT NULL AFTER `date`";
  $VisualRecommendUpgrades[0]['updates'][4] = "ALTER TABLE #__visualrecommend ADD `keyreply` VARCHAR( 30 ) DEFAULT '' NOT NULL AFTER `link`";
  $VisualRecommendUpgrades[0]['message'] = "VisualRecommend 1.0.0 to <strong>1.1.0</strong>";
	
  //Apply Upgrades

  foreach ($VisualRecommendUpgrades AS $VRupgrade) {
	  $database->setQuery($VRupgrade['test']);
	  //if it fails test then apply upgrade
	  if (!$database->query()) {
	  	  echo "<br />Start Upgrade VisualRecommend table.<br />";
		  foreach($VRupgrade['updates'] as $VRScript) {
			  $database->setQuery($VRScript);
			  if(!$database->query()) {
				  //Upgrade failed
				  echo("<font color='red'>".$VRupgrade['message']." failed! SQL error:" . $database->stderr(true)."</font><br />");
				  //return;
			  }
		  }
		//Upgrade was successful
		echo "<font color='green'>".$VRupgrade['message']." Upgrade Applied Successfully!</font><br />";
	  } 
  }  
  
  // Add bot
  if ( $_VERSION->PRODUCT == 'Joomla!' ){	
	  if ( $_VERSION->RELEASE >= '1.5' ) {
		  $dir_plugin = 'plugins';
	  }else{
		  $dir_plugin = 'mambots';
	  }
  } else $dir_plugin = 'mambots';	 
  
  echo "<br />Start install bot.<br />";
  if ( is_writable( "$mosConfig_absolute_path/$dir_plugin/content/" ) ){
	$adminDir = dirname(__FILE__);
	@rename( $adminDir. "/mambots/content/visualrecommendbot.php", "$mosConfig_absolute_path/$dir_plugin/content/visualrecommendbot.php" );
	@rename( $adminDir. "/mambots/content/visualrecommendbot.txt", "$mosConfig_absolute_path/$dir_plugin/content/visualrecommendbot.xml" );
	// publish bot  
	$query = "INSERT INTO `#__$dir_plugin` VALUES ('', 'VisualRecommentBot', 'visualrecommendbot', 'content', 0, 0, 1, 0, 0, 0, '0000-00-00 00:00:00', '')";
	$database->setQuery( $query );
	if ( $database->query() ){
	  echo "<font color='green'>FINISHED:</font> Plugin has been installed and published.<br />";
	} else {
	  echo "<font color='red'>ERROR:</font> <strong>Plugin</strong> not be published.<br />";
	} 
  } else echo "<font color='red'>ERROR:</font> Plugin not be installed.<br />";

// MENTIONS COPYRIGHT
$copyStart = 2007; 
$copyNow = date('Y');  
if ($copyStart == $copyNow) { 
	$copySite = $copyStart;
} else {
	$copySite = $copyStart." - ".$copyNow ;
} 
?>
</div>
</td></tr>
  <tr>
    <td><div align="left"><br /><img src="<?php echo $mosConfig_live_site."/administrator/components/com_visualrecommend" ?>/images/visualrecommend.gif"><br />
	<font color="green"><b>Installation VisualRecommend v.<?php echo _VRECOMMEND_NUM_VERSION; ?> finished.</b></font><br /><br />
	  VisualRecommend &copy; <?php echo $copySite ; ?> - Bernard Gilly - <a href="http://www.visualclinic.fr" target="_blank">www.visualclinic.fr</a><br />
	  All rights reserved<br /><br />
    </div></td></tr>
</table></code>
<?php
}
?>