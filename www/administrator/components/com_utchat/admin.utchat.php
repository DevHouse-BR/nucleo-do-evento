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

if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_utchat' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );
}

//error_reporting(E_ALL);

define('UTCHAT_JABSPATH',$mainframe->getCfg( 'absolute_path' ));
define('UTCHAT_ABSADMPATH',UTCHAT_JABSPATH.'/administrator/components/com_utchat');
define('UTCHAT_JLIVESITE',$mainframe->getCfg( 'live_site' ));
// TODO ............................................................
//define('UTCHAT_ABSPATH',UTCHAT_JABSPATH.'/components/com_utchat');
//define('UTCHAT_LANG',$mainframe->getCfg( 'lang' ));

$task 	= trim( mosGetParam( $_REQUEST, 'task', '' ));

switch ($task) {
    case "saveeditconf":
     	 $file=mosGetParam($_POST,'file','');
     	 $confcontent=mosGetParam($_POST,'confcontent','');
       saveConf ($file,$confcontent, $option);
       break;
    default:
        showConf($option);
        break;
} 

function showConf ($option) {
  $file = UTCHAT_ABSADMPATH.'/admin.utchat.conf.php';
  @chmod ($file, 0766);
  $permission = is_writable($file);
  if (!$permission) {
    echo "<center><h1><font color=red>Warning...</font></h1><br />";
    echo "<b>Your config file is $file </b><br />";
    echo "<b>You need to chmod this to 766 in order for the config to be updated</b></center><br /><br />";
  }
  if (get_magic_quotes_gpc()) {
	 $file = stripslashes($file);
  }
  $f=fopen($file,"r");
  $content = fread($f, filesize($file));
  $content = str_replace ( '<?php', '', $content);
  $content = str_replace ( '?>', '', $content);
  ?>
  <form action="index2.php?" method="post" name="adminForm" class="adminForm" id="adminForm">
  <table cellpadding="4" cellspacing="0" border="0" width="100%" class="adminform">
    <tr><th>Path: <?php echo $file; ?></th></tr>
    <tr><td><textarea cols="100" rows="20" name="confcontent"><?php echo $content; ?></textarea></td></tr>
    <tr><td class="error">Please Note: the file must be Writable to Save Changes.<br /><br />
    to see at the documentation of <a href='http://www.phpfreechat.net/' alt='phpfreechat doc'  target=_blank>
    <img src='<?php echo UTCHAT_JLIVESITE; ?>/components/com_utchat/logo_80x15.gif' alt='utChat' border='0' />
    </a> PLEASE !!!!!!!</td></tr>
  </table>
  <input type="hidden" name="file" value="<?php echo $file; ?>" />
  <input type="hidden" name="option" value="<?php echo $option; ?>">
  <input type="hidden" name="task" value="">
  </form>
  <br />
  <center>
  <a href='http://www.utopiart.com/utchat/' target='_blank'>
    <img src='<?php echo UTCHAT_JLIVESITE; ?>/components/com_utchat/logo_utchat_80x15.gif' alt='utChat' border='0' />
  </a>
  <a href='http://www.phpfreechat/' target='_blank'>
    <img src='<?php echo UTCHAT_JLIVESITE; ?>/components/com_utchat/logo_80x15.gif' alt='phpfreechat' border='0' />
  </a>
  </center>

<?php
}

function saveConf($file,$confcontent, $option) {
  echo "Saving config file should be here...file=$file";
  if (is_writable($file)==false){
    echo "<script>alert('The file is not writable.')</script>";
    echo "<script>document.location.href='index2.php?option=".$option."&task=showConf'</script>\n";
  }
  echo "<script>alert('utChat config file saved.')</script>";
  echo "<script>document.location.href='index2.php?option=".$option."&task=showConf'</script>\n";
  if ($fp = fopen( $file, "w")) {
    $confcontent = '<?php '.$confcontent.' ?>';
    fputs($fp,stripslashes($confcontent));
    fclose($fp);
    mosRedirect( "index2.php?option=$option&task=showConf", "Configuration file saved" );
  } else {
    mosRedirect( "index2.php?option=$option", "FATAL ERROR: File could not be opened." );
  }
}
?>
