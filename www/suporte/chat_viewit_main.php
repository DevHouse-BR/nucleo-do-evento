<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$session_chat = $HTTP_SESSION_VARS['session_chat'] ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : $HTTP_POST_VARS['sid'] ;

	if ( !file_exists( "web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php" ) || !file_exists( "web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;	include_once("./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("./system.php") ;
	include_once("./lang_packs/$LANG_PACK.php") ;
	include_once("./API/sql.php") ;
	include_once("./API/Users/get.php") ;

	// initialize
	$date = date( "D m/d/y $TIMEZONE_FORMAT:i$TIMEZONE_AMPM", ( time() + $TIMEZONE ) ) ;
	$admin = AdminUsers_get_UserInfo( $dbh, $session_chat[$sid]['admin_id'], $session_chat[$sid]['aspID'] ) ;
	$department = AdminUsers_get_DeptInfo( $dbh, $session_chat[$sid]['deptid'], $session_chat[$sid]['aspID'] ) ;
	$chat_transcript = "Error: Transcript not found!" ;
	if ( isset( $HTTP_SESSION_VARS['session_chat'][$sid]['transcript'] ) )
		$chat_transcript = preg_replace( "/<script(.*?)\/script>/", "", $HTTP_SESSION_VARS['session_chat'][$sid]['transcript'] ) ;
	else if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/".$session_chat[$sid]['chatfile_transcript'] ) )
	{
		$chat_transcript_file = file( "$DOCUMENT_ROOT/web/chatsessions/".$session_chat[$sid]['chatfile_transcript'] ) ;
		$chat_transcript =  preg_replace( "/<script(.*?)\/script>/", "", $chat_transcript_file[0] ) ;
	}
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title> <? echo $LANG['TITLE_PRINTVIEW'] ?> </title>

<link rel="Stylesheet" href="./css/base.css">
<script language="JavaScript">var loaded = 0 ;</script>
</head>
<body bgColor="<? echo $CHAT_REQUEST_BACKGROUND ?>" text="<? echo $TEXT_COLOR ?>" link="<? echo $LINK_COLOR ?>" alink="<? echo $ALINK_COLOR ?>" vlink="<? echo $VLINK_COLOR ?>" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
<center>
<table cellspacing=0 cellpadding=2 border=0 width="98%" style="height:100%">
<tr>
	<td valign="top" align="right" width="100%"><span class="smalltxt">[ <a href="JavaScript:print()">Click Here to Print</a> ]</td>
</tr>
<tr>
	<td valign="top"><span class="basetxt" width="100%">
		<!-- begin header -->
		<?
			if ( file_exists( "web/".$session_chat[$sid]['asp_login']."/$LOGO" ) && $LOGO )
				$logo = "web/".$session_chat[$sid]['asp_login']."/$LOGO" ;
			else if ( file_exists( "web/$LOGO_ASP" ) && $LOGO_ASP )
				$logo = "web/$LOGO_ASP" ;
			else
				$logo = "images/logo.gif" ;
		?>
		<img src="<? echo $logo ?>">
		<br>
		<table cellspacing=1 cellpadding=1 border=0 width="100%">
		<tr>
			<td width="80"><span class="basetxt"><b><? echo $LANG['WORD_COMPANY'] ?></b></td>
			<td><span class="basetxt"> <? echo $admin['company'] ?></td>
		</tr>
		<tr>
			<td width="80"><span class="basetxt"><b><? echo $LANG['WORD_DEPARTMENT'] ?></b></td>
			<td><span class="basetxt"> <? echo $department['name'] ?></td>
		</tr>
		<tr>
			<td width="80"><span class="basetxt"><b><? echo $LANG['WORD_NAME'] ?></b></td>
			<td><span class="basetxt"><? echo $admin['name'] ?></td>
		</tr>
		<tr>
			<td width="80"><span class="basetxt"><b><? echo $LANG['WORD_EMAIL'] ?></b></td>
			<td><span class="basetxt"> <a href="mailto:$admin[email]"><? echo $admin['email'] ?></a></td>
		</tr>
		<tr>
			<td width="80"><span class="basetxt"><b><? echo $LANG['WORD_DAY'] ?></b></td>
			<td><span class="basetxt"> <? echo $date ?></td>
		</tr>
		<!-- end header -->
		</table>
		<table cellspacing=1 cellpadding=1 border=0 width="100%" bgColor="<? echo $CHAT_BOX_BACKGROUND ?>"><tr><td><span class="basetxt"><font color="<? echo $CHAT_BOX_TEXT ?>"><? echo stripslashes( $chat_transcript ) ?></td></tr></table>
		<br>
	</td>
</tr>
<tr>
	<td align="center"></td>
</tr>
</table>
<br>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

</center>
</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>