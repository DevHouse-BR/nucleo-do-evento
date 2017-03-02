<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; }
	$action = $error = $login = $password = $l = "" ;
	include_once("../web/conf-init.php") ;
	include_once("$DOCUMENT_ROOT/API/Util_Error.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/get.php") ;
?>
<?
	// initialize
	if ( !isset( $HTTP_SESSION_VARS['session_setup'] ) )
	{
		session_register( "session_setup" ) ;
		$session_setup = ARRAY() ;
		$HTTP_SESSION_VARS['session_setup'] = ARRAY() ;
	}
	if ( !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}

	if ( file_exists( "$DOCUMENT_ROOT/web/$LOGO_ASP" ) && $LOGO_ASP )
		$logo = "$BASE_URL/web/$LOGO_ASP" ;
	else
		$logo = "$BASE_URL/images/logo.gif" ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
?>
<?
	// functions
?>
<?
	// conditions
	if ( $action == "login" )
	{
		if ( isset( $HTTP_POST_VARS['login'] ) ) { $login = $HTTP_POST_VARS['login'] ; }
		if ( isset( $HTTP_GET_VARS['login'] ) ) { $login = $HTTP_GET_VARS['login'] ; }
		if ( isset( $HTTP_POST_VARS['password'] ) ) { $password = $HTTP_POST_VARS['password'] ; }
		if ( isset( $HTTP_GET_VARS['password'] ) ) { $password = $HTTP_GET_VARS['password'] ; }

		$admin = AdminASP_get_UserInfoByLoginPass( $dbh, $login, $password ) ;
		if ( $admin['aspID'] )
		{
			if ( $admin['active_status'] )
			{
				$HTTP_SESSION_VARS['session_setup'] = $admin ;
				HEADER( "location: $BASE_URL/setup/options.php" ) ;
				exit ;
			}
			else
				$error = "Account is inactive." ;
		}
		else
			$error = "Invalid login or password." ;
	}
	else if ( $action == "logout" )
	{
		session_unregister( "session_setup" ) ;
	}
?>
<html>
<head>
<title>PHP Live! - Setup</title>
<? $css_path = "../" ; include_once( "../css/default.php" ) ; ?>

<script language="JavaScript">
<!--
	function do_alert()
	{
		<?
			if ( $error )
				print " alert( \"$error\" ) ;" ;
		?>
	}
//-->
</script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="do_alert()">
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="height:100%">
  <tr> 
	<td height="65" valign="top" class="bgHead"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td width="102" height="65" valign="bottom" class="bgCornerTop"><img src="../images/bg_corner_top.gif" width="102" height="65"></td>
		  <td height="65"><img src="<? echo $logo ?>" border="0"> 
		  </td>
		</tr>
	  </table></td>
  </tr>
  <tr> 
	<td height="47" valign="top" class="bgMenuBack"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td><img src="../images/bg_corner_bot.gif" width="121" height="47"> <img src="../images/spacer.gif" width="10" height="1"></td>
		</tr>
	  </table></td>
  </tr>
  <tr> 
	<td align="center" valign="top" class="bg">
		<!-- **** Start of the page body area **** -->
		<form method="POST" action="<? echo $BASE_URL ?>/setup/login.php" name="form">
		<input type="hidden" name="action" value="login">
		<table cellspacing=1 cellpadding=3 border=0 width="300">
		<tr align="center"> 
			<th colspan=2><span class="basicTitle">Site Setup Login</span></th>
		</tr>
		<tr> 
			<td align="right"><strong>Login:</strong></td>
			<td> 
			<input type="text" style="width: 150px" name="login" size="10" maxlength="15" value="<? echo $login ?>"></td>
		</tr>
		<tr> 
			<td align="right"><strong>Password:</strong></td>
			<td> 
			<input type="password"  style="width: 150px" name="password" size="10" maxlength="15"></td>
		</tr>
		<tr> 
			<td>&nbsp;</td>
			<td> 
			<input name="Submit" type="submit" class="mainButton" value="Login as Setup Admin"></td>
		</tr>
	  </table>
	</form>

		<!-- **** End of the page body area **** -->
	  </p></td>
  </tr>
  <tr> 
	<td height="20" align="right" class="bgFooter" style="height:20px"><img src="../images/bg_corner_footer.gif" alt="" width="94" height="20"></td>
  </tr>
  <!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

  <tr> 
	<td height="20" align="center" class="bgCopyright" style="height:20px">
		<? if ( file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) ): ?>
		
		<? else: ?>
		<? echo $LANG['DEFAULT_BRANDING'] ?>
		<? endif ; ?>
		v<? echo $PHPLIVE_VERSION ?> &copy; OSI Codes Inc.</span>
	</td>
  </tr>
</table>
<!-- This navigation layer is placed at the very botton of the HTML to prevent pesky problems with NS4.x -->
</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>