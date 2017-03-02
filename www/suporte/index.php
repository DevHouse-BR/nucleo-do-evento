<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$l = "" ;
	// try to get cookie value first
	if ( isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_SITE'] ) ) { $l = $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_SITE'] ; }
	if ( isset( $HTTP_GET_VARS['l'] ) ) { $l = $HTTP_GET_VARS['l'] ; }
	if ( isset( $HTTP_POST_VARS['l'] ) ) { $l = $HTTP_POST_VARS['l'] ; }

	if ( !file_exists( "./web/conf-init.php" ) )
	{
		HEADER( "location: setup/index.php" ) ;
		exit ;
	}
	include_once("./web/conf-init.php") ;
	if ( file_exists( "web/$l/$l-conf-init.php" ) && $l )
		include_once("./web/$l/$l-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/API/Util_Error.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/Util_CleanFiles.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/update.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/get.php") ;
?>
<?
	// initialize
	$action = $error = $sid = $site = $remember = "" ;
	$sound_file = "cellular.wav" ;
	$isadmin = $winapp = $autologin = $wflag = 0 ;

	if ( !isset( $HTTP_SESSION_VARS['session_admin'] ) )
	{
		session_register( "session_admin" ) ;
		$HTTP_SESSION_VARS['session_admin'] = ARRAY() ;
	}

	// check to see if the site login is passes.  if not, then let's see how many
	// sites are in the asp model.  if only ONE, then default to that one.
	$total_sites = AdminASP_get_TotalUsers( $dbh ) ;
	if ( $total_sites == 1 )
	{
		$site = AdminASP_get_AllUsers( $dbh, 0, 1 ) ;
		$l = $site[0]['login'] ;
	}

	if ( isset( $LOGO ) && file_exists( "$DOCUMENT_ROOT/web/$l/$LOGO" ) && $LOGO )
		$logo = "$BASE_URL/web/$l/$LOGO" ;
	else if ( file_exists( "$DOCUMENT_ROOT/web/$LOGO_ASP" ) && $LOGO_ASP )
		$logo = "$BASE_URL/web/$LOGO_ASP" ;
	else
		$logo = "$BASE_URL/images/logo.gif" ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_POST_VARS['winapp'] ) ) { $winapp = $HTTP_POST_VARS['winapp'] ; }
	if ( isset( $HTTP_GET_VARS['winapp'] ) ) { $winapp = $HTTP_GET_VARS['winapp'] ; }
	if ( isset( $HTTP_GET_VARS['wflag'] ) ) { $wflag = $HTTP_GET_VARS['wflag'] ; }
?>
<?
	// functions
?>
<?
	// conditions

	if ( ( isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_LOGIN'] ) && isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_PASSWORD'] ) && isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_SITE'] ) ) && !$action )
		$autologin = 1 ;

	if ( $action == "login" )
	{
		if ( $l )
			$site = $l ;
		else
			$site = $HTTP_POST_VARS['site'] ;

		$aspinfo = AdminASP_get_ASPInfoByASPLogin( $dbh, $site ) ;
		$admin = AdminUsers_get_UserInfoByLoginPass( $dbh, $HTTP_POST_VARS['login'], $HTTP_POST_VARS['password'], $aspinfo['aspID'] ) ;

		if ( !$aspinfo['active_status'] )
			$error = "Service is inactive.  Please contact your setup admin for details." ;
		else
		{
			if ( $admin['userID'] && ( $admin['aspID'] == $aspinfo['aspID'] ) )
			{
				CleanFiles_util_CleanChatSessionFiles() ;
				CleanFiles_util_CleanSurveySessionFiles() ;

				// set $sid.  $sid is used to keep track of this admin user.  $sid allows
				// so a user can log into several admin departments on same computer.  it is
				// passed everywhere the admin goes.
				$sid = time() ;

				$HTTP_SESSION_VARS['session_admin'][$sid] = ARRAY() ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['screen_name'] = $HTTP_POST_VARS['login'] ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] = $admin['userID'] ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['requests'] = 0 ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] = $aspinfo['aspID'] ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] = $aspinfo['login'] ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['active_footprints'] = 0 ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['winapp'] = "$winapp" ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['close_timer'] = 0 ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['traffic_monitor'] = 0 ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['available_status'] = 1 ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['sound'] = "on" ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['request_ids'] = "" ;
				$HTTP_SESSION_VARS['session_admin'][$sid]['traffic_timer'] = $admin['console_refresh'] ;
				$isadmin = 1 ;

				// check to see if they want to be remembered... if so, just set cookie.
				// let's set it for 1 month for now.
				$cookie_lifespan = time() + 60*60*24*30 ;
				if ( isset( $HTTP_POST_VARS['remember'] ) )
				{
					setcookie( "COOKIE_PHPLIVE_LOGIN", $HTTP_POST_VARS['login'], $cookie_lifespan ) ;
					setcookie( "COOKIE_PHPLIVE_PASSWORD", $HTTP_POST_VARS['password'], $cookie_lifespan ) ;
					setcookie( "COOKIE_PHPLIVE_SITE", $aspinfo['login'], $cookie_lifespan ) ;
				}
			}
			else
			{
				// reset cookie if cookies are set
				if ( isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_LOGIN'] ) && isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_PASSWORD'] ) )
				{
					setcookie( "COOKIE_PHPLIVE_LOGIN", "", -1 ) ;
					setcookie( "COOKIE_PHPLIVE_PASSWORD", "", -1 ) ;
					setcookie( "COOKIE_PHPLIVE_SITE", "", -1 ) ;
				}
				$error = "Login failed.  NOTE: password is (CaSE senSiTiVE)." ;
			}
		}
	}
	else if ( $action == "logout" )
	{
		if ( isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_LOGIN'] ) && isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_PASSWORD'] ) && !$wflag )
		{
			setcookie( "COOKIE_PHPLIVE_LOGIN", "", -1 ) ;
			setcookie( "COOKIE_PHPLIVE_PASSWORD", "", -1 ) ;
			setcookie( "COOKIE_PHPLIVE_SITE", "", -1 ) ;
		}
		$sid = $HTTP_GET_VARS['sid'] ;
		$l = $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ;
		AdminUsers_update_Status( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], 0 ) ;
		AdminUsers_update_UserValue( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], "last_active_time", $admin_idle - 300 ) ;
		$HTTP_SESSION_VARS['session_admin'][$sid] = Array() ;
		HEADER( "location: index.php?wflag=$wflag&l=$l&winapp=$winapp&" ) ;
		exit ;
	}
	else
	{
		// do the cleaning of the chat database of old requests and sessions.
		ServiceChat_remove_CleanChatSessionList( $dbh ) ;
		ServiceChat_remove_CleanChatSessions( $dbh ) ;
		ServiceChat_remove_CleanChatRequests( $dbh ) ;
	}
?>
<? if ( $wflag ): ?>
<html><head><title>Close</title></head><body> <!-- close_winapp --> </body></html>

<? else: ?>
<html>
<head>
<title>PHP Live! - Operator</title>
<? $css_path = "./" ; include( "./css/default.php" ) ; ?>
<script language="JavaScript">
<!--
	// add a delay before taking them to admin area so the sound file can load.
	// this is for slow connections so the sound file is in memory and faster
	// refresh time when a support request is made.
	if ( <? echo $isadmin ?> )
		var temp = setTimeout("location.href='<? echo $BASE_URL ?>/admin/index.php?sid=<? echo $sid ?>&start=1&winapp=<? echo $winapp ?>'",4000) ;
	
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
		  <td width="102" height="65" valign="bottom" class="bgCornerTop"><img src="images/bg_corner_top.gif" width="102" height="65"></td>
		  <td height="65"><img src="<? echo $logo ?>" border="0"> 
		  </td>
		</tr>
	  </table></td>
  </tr>
  <tr> 
	<td height="47" valign="top" class="bgMenuBack"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td><img src="images/bg_corner_bot.gif" width="121" height="47"> <img src="images/spacer.gif" width="10" height="1"></td>
		</tr>
	  </table></td>
  </tr>
  <tr> 
	<td align="center" valign="top" class="bg">



<? if ( $isadmin == 1 ): ?>
<EMBED src="sounds/cellular.wav" width=0 height=0 autostart=true loop=false>
<table cellspacing=0 cellpadding=0 border=0 width="450">
<tr>
	<td align="center">
		<span class="title">One moment...<br>accessing your account.
	</td>
</tr>
</table>



<? elseif ( $autologin ): ?>
<form method="POST" action="<? echo $BASE_URL ?>/index.php" name="form">
<input type="hidden" name="action" value="login">
<input type="hidden" name="winapp" value="<? echo $winapp ?>">
<input type="hidden" name="l" value="<? echo $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_SITE'] ?>">
<input type="hidden" name="login" value="<? echo $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_LOGIN'] ?>">
<input type="hidden" name="password" value="<? echo $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_PASSWORD'] ?>">
</form>
<script language="JavaScript">
<!--
	document.form.submit()
//-->
</script>





<? elseif ( $l ): ?>
	<form method="POST" action="<? echo $BASE_URL ?>/index.php" name="form">
	<input type="hidden" name="action" value="login">
	<input type="hidden" name="winapp" value="<? echo $winapp ?>">
	<input type="hidden" name="l" value="<? echo $l ?>">
			<table cellspacing=1 cellpadding=3 border=0 width="300">
			  <tr align="center"> 
				<th colspan=2><span class="basicTitle">Operator Login</span></th>
			</tr>
			  <tr> 
				<td align="right"><strong>Login:</strong></td>
				<td> 
				  <input type="text" style="width: 150px" name="login" size="10" maxlength="15" value="<?= isset( $HTTP_POST_VARS['login'] ) ? $HTTP_POST_VARS['login'] : "" ?>"></td>
			</tr>
			  <tr> 
				<td align="right"><strong>Password:</strong></td>
				<td> 
				  <input type="password"  style="width: 150px" name="password" size="10" maxlength="15"></td>
			</tr>
			  <tr> 
				<td align="center">&nbsp; </td>
				<td nowrap> 
				  <input type="checkbox" style="background:none;border:none" name="remember" value="1">
				  <?= ( $winapp ) ? "Automatically login next time" : "Remember my ID on this computer" ?></td>
			</tr>
			  <tr> 
				<td>&nbsp;</td>
				<td> 
				  <input name="Submit" type="submit" class="mainButton" value="Login as Operator"></td>
			</tr>
		  </table>
	</form>



<? else: ?>
<span class="panelTitle">Error: Please make sure you put in the correct URL path.<br>
(example: <span class="hilight"><? echo $BASE_URL ?>/web/&lt;sitelogin&gt;)</span></span>




<? endif ; ?>
</p></td>
  </tr>
  <tr> 
	<td height="20" align="right" class="bgFooter" style="height:20px"><img src="images/bg_corner_footer.gif" alt="" width="94" height="20"></td>
  </tr>
  <tr> 
	<td height="20" align="center" class="bgCopyright" style="height:20px">
		<? if ( file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) ): ?>
		
		<? else: ?>
		<? echo $LANG['DEFAULT_BRANDING'] ?>
		<? endif ; ?>
		
	</td>
  </tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<!-- This navigation layer is placed at the very botton of the HTML to prevent pesky problems with NS4.x -->
</body>
</html>
<? endif ; ?>
<?
	mysql_close( $dbh['con'] ) ;
?>
