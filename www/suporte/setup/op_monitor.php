<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: index.php" ) ; exit ; }
	if ( !file_exists( "../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("../web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("../system.php") ;
	include_once("../lang_packs/$LANG_PACK.php") ;
	include_once("../web/VERSION_KEEP.php") ;
	include_once("../API/sql.php") ;
	include_once("../API/Users/get.php") ;
	include_once("../API/Chat/get.php") ;
?>
<?

	// initialize
	$action = $error_mesg = $adminid = $sessionid = "" ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "12" ;
	else
		$text_width = "9" ;

	$success = 0 ;
	// update all admins status to not available if they have been idle

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['adminid'] ) ) { $adminid = $HTTP_GET_VARS['adminid'] ; }
	if ( isset( $HTTP_GET_VARS['sessionid'] ) ) { $sessionid = $HTTP_GET_VARS['sessionid'] ; }

	$admins = AdminUsers_get_AllUsers( $dbh, 0, 0, $session_setup['aspID'] ) ;
	$last_updated = date( "D m/d/y h:i a", time() ) ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title> Admin Console Monitor </title>
<? $css_path = ( !isset( $css_path ) ) ? $css_path = "../" : $css_path ; include_once( $css_path."css/default.php" ) ; ?>

<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<script language="JavaScript">
<!--
	function do_alert()
	{
		// every minute
		var refresh = setTimeout( "window.location.reload( true );", 60000 ) ;
	}
//-->
</script>

<body onLoad="do_alert()" bgColor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="height:100%">
  <tr> 
	<td height="47" valign="top" class="bgMenuBack"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td width="10"><img src="<? echo $css_path ?>images/spacer.gif" width="10" height="1"></td>
		</tr>
	  </table></td>
  </tr>
  <tr>
	<td valign="top" class="bg" align="center">
		<span class="basicTitle">Operator Console Monitor</span>
		<table width="98%" border="0" cellspacing="0" cellpadding="2">
		<tr> 
		  <td valign="top" align="center"><span class="medium">Page Updated: <? echo $last_updated ?></span>
			<table width="100%" border=0 cellpadding=2 cellspacing=1>
			  <tr align="left"> 
				<th nowrap>Name</th>
				<th align="center" nowrap>Online</th>
				<th align="center" nowrap>Console</th>
			  </tr>
			 <?
					for ( $c = 0; $c < count( $admins ); ++$c )
					{
						$admin = $admins[$c] ;

						$bgcolor = "#EEEEF7" ;
						if ( $c % 2 )
							$bgcolor = "#E6E6F2" ;

						$online_status = "Offline" ;
						$bgcolor_status = "#FFE8E8" ;
						if ( $admin['available_status'] == 1 )
						{
							$online_status = "Online" ;
							$bgcolor_status = "#E1FFE9" ;
						}
						else if ( $admin['available_status'] == 2 )
						{
							$online_status = "Away" ;
							$bgcolor_status = "#FEC65B" ;
						}

						$consol_status = "Closed" ;
						$bgcolor_consol = "#FFE8E8" ;
						if ( $admin['signal'] == 9 )
						{
							$consol_status = "Open" ;
							$bgcolor_consol = "#E1FFE9" ;
						}
						else if ( $admin['last_active_time'] > $admin_idle )
						{
							$consol_status = "Open" ;
							$bgcolor_consol = "#E1FFE9" ;
						}

						print "
							<tr class=\"altcolor2\">
								<td><a href=\"mailto:$admin[email]?subject=Console Status: $online_status\">$admin[name]</a></td>
								<td align=\"center\" bgColor=\"$bgcolor_status\">$online_status</td>
								<td align=\"center\" bgColor=\"$bgcolor_consol\">$consol_status</td>
							</tr>
						" ;
					}
				?>
			</table></td>
		</table>
	</td>
  </tr>
  <tr> 
	<td height="20" align="right" class="bgFooter" style="height:20px"><img src="<? echo $css_path ?>images/bg_corner_footer.gif" alt="" width="94" height="20"></td>
  </tr>
  <tr>
  <!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

	<td height="20" align="center" class="bgCopyright" style="height:20px">
		<? if ( file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) ): ?>
		
		<? else: ?>
		<? echo $LANG['DEFAULT_BRANDING'] ?>
		<? endif ; ?>
		v<? echo $PHPLIVE_VERSION ?> &copy; OSI Codes Inc.
	</td>
  </tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->


</body>
</html>
