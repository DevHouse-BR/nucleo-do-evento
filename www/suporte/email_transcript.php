<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$action = $sessionid = "" ;
	$close_window = 0 ;
	$session_chat = $HTTP_SESSION_VARS['session_chat'] ;
	if ( isset( $HTTP_POST_VARS['sid'] ) ) { $sid = $HTTP_POST_VARS['sid'] ; }
	if ( isset( $HTTP_GET_VARS['sid'] ) ) { $sid = $HTTP_GET_VARS['sid'] ; }
	if ( isset( $HTTP_POST_VARS['sessionid'] ) ) { $sessionid = $HTTP_POST_VARS['sessionid'] ; }
	if ( isset( $HTTP_GET_VARS['sessionid'] ) ) { $sessionid = $HTTP_GET_VARS['sessionid'] ; }
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }

	if ( !file_exists( "web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php" ) || !file_exists( "web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;	include_once("./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("./system.php") ;
	include_once("./lang_packs/$LANG_PACK.php") ;
	include_once("./API/sql.php" ) ;
	include_once("./API/ASP/get.php") ;
	include_once("./API/Users/get.php") ;
	include_once("./API/Survey/put.php") ;
?>
<?
	// initialize
	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "38" ;
	else
		$text_width = "19" ;
	
	$aspinfo = AdminASP_get_UserInfo( $dbh, $session_chat[$sid]['aspID'] ) ;
	$admin = AdminUsers_get_UserInfo( $dbh, $session_chat[$sid]['admin_id'], $session_chat[$sid]['aspID'] ) ;
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "submit" )
	{
		if ( isset( $HTTP_POST_VARS['rate'] ) && ( $HTTP_POST_VARS['rate'] != 0 ) )
		{
			ServiceSurvey_put_AdminSurvey( $dbh, $session_chat[$sid]['admin_id'], $session_chat[$sid]['deptid'], $session_chat[$sid]['aspID'], $session_chat[$sid]['sessionid'], $HTTP_POST_VARS['rate'] ) ;
		}
		if ( isset( $HTTP_POST_VARS['email'] ) && $HTTP_POST_VARS['email'] )
		{
			$department = AdminUsers_get_DeptInfo( $dbh, $session_chat[$sid]['deptid'], $session_chat[$sid]['aspID'] ) ;

			if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/".$session_chat[$sid]['chatfile_transcript'] ) )
			{
				$chat_transcript_file = file( "$DOCUMENT_ROOT/web/chatsessions/".$session_chat[$sid]['chatfile_transcript'] ) ;
				$transcript = $chat_transcript_file[0] ;
			}
			else
				$transcript = $HTTP_SESSION_VARS['session_chat'][$sid]['transcript'] ;

			$cookie_lifespan = time() + 60*60*24*180 ;
			setcookie( "COOKIE_PHPLIVE_VEMAIL", stripslashes( $HTTP_POST_VARS['email'] ), $cookie_lifespan ) ;

			$date = date( "D m/d/y $TIMEZONE_FORMAT:i$TIMEZONE_AMPM", ( time() + $TIMEZONE ) ) ;
			$subject = "$aspinfo[company] Chat Transcript" ;
			$header = "$LANG[WORD_COMPANY]: $COMPANY_NAME_TEMP
$LANG[WORD_DEPARTMENT]: $department[name]
$LANG[WORD_NAME]: $admin[name]
$LANG[WORD_EMAIL]: $admin[email]
$LANG[WORD_DAY]: $date" ;

			$transcript = preg_replace( "/Chat \[dynamic box\]/", "", stripslashes( $transcript ) ) ;
			$transcript = preg_replace( "/<script(.*?)\/script>/", "", $transcript ) ;
			$transcript = preg_replace( "/<br>/", "\r\n", $transcript ) ;
			$transcript = preg_replace( "/<hr>/", "\r\n---------------------------------------------\r\n", $transcript ) ;
			$transcript = preg_replace( "/<(.*?)>/", "", $transcript ) ;
			$transcript = preg_replace( "/[$]/", "$ ", $transcript ) ;
			$transcript = preg_replace( "/&#039;/", "'", $transcript ) ;
			$transcript = "$header $transcript" ;
			$transcript = wordwrap( $transcript, 70 ) ;
			$visitor_name = preg_replace( "/<(.*?)>/", "", $session_chat[$sid]['visitor_name'] ) ;

			$message = preg_replace( "/%%transcript%%/", $transcript, stripslashes( $aspinfo['trans_email'] ) ) ;
			$message = preg_replace( "/%%username%%/", $visitor_name, $message ) ;
			mail( $HTTP_POST_VARS['email'], $subject, $message, "From: $aspinfo[company] <$aspinfo[contact_email]>") ;
		}
		$close_window = 1 ;
	}
?>
<html>
<head>
<title> [ email transcript ] </title>

<link rel="Stylesheet" href="css/base.css">
<script language="JavaScript" src="js/newwin.js"></script>

<script language="JavaScript">
<!--
	function do_submit()
	{
		if ( document.form.email.value != "" )
		{
			if ( document.form.email.value.indexOf("@") == -1 )
				alert( "<? echo $LANG['MESSAGE_BOX_JS_A_INVALIDEMAIL'] ?>" ) ;
			else
				document.form.submit() ;
		}
		else
			document.form.submit() ;
	}

	function viewit()
	{
		window.open( "chat_viewit.php?sid=<? echo $sid ?>", "<? echo time() ?>", "scrollbars=yes,menubar=no,toolbar=no,resizable=0,location=no,width=450,height=520" ) ;
	}

	if ( <? echo $close_window ?> )
		parent.window.close() ;

	//window.parent.document.title = "<? echo $LANG['TITLE_SUPPORTREQUEST'] ?>" ;
//-->
</script>

</head>
<body bgColor="<? echo $CHAT_REQUEST_BACKGROUND ?>" text="<? echo $TEXT_COLOR ?>" link="<? echo $LINK_COLOR ?>" alink="<? echo $ALINK_COLOR ?>" vlink="<? echo $VLINK_COLOR ?>" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
<?
if ( file_exists( "web/".$session_chat[$sid]['asp_login']."/$LOGO" ) && $LOGO )
	$logo = "web/".$session_chat[$sid]['asp_login']."/$LOGO" ;
else if ( file_exists( "web/$LOGO_ASP" ) && $LOGO_ASP )
	$logo = "web/$LOGO_ASP" ;
else
	$logo = "images/logo.gif" ;
?>
<table cellspacing=0 cellpadding=2 border=0><tr><td><img src="<? echo $logo ?>"></td></tr></table>
<table cellspacing=0 cellpadding=2 border=0>
<tr>
<td>
<span class="basetxt">

<? if ( $action == "submit" ): ?>
<? echo $LANG['CHAT_TRANSCRIPT_SENT'] ?> <b><? echo $HTTP_POST_VARS['email'] ?></b>.
<p>
<input type="button" value="Close Window" OnClick="parent.window.close()" class="button"></a></a>
<p>





<? else: ?>
<form method="POST" action="email_transcript.php" name="form">
<input type="hidden" name="action" value="submit">
<input type="hidden" name="sid" value="<? echo $sid ?>">
<input type="hidden" name="sessionid" value="<? echo $sessionid ?>">
<table cellspacing=0 cellpadding=4 border=0>
<? if ( isset( $admin['rateme'] ) && $admin['rateme'] ): ?>
<tr>
	<td colspan=2><span class="basetxt"><big><b>Please rate my support:</b></big> <font size=2><select name="rate" class="select"><option value="x">No Response</option><option value=4>Excellent</option><option value=3>Very Good</option><option value=2>Good</option><option value=1>Needs Improvement</option></select></td>
</tr>
<? endif ; ?>
<tr>
	<td colspan=2><span class="basetxt"><? echo stripslashes( $aspinfo['trans_message'] ) ?></td>
</tr>
<tr>
	<td><span class="basetxt"><? echo $LANG['WORD_EMAIL'] ?></td>
	<td><font size=2> <input type="text" name="email" size="<? echo $text_width ?>" maxlength="255" class="input"></td>
</tr>
<tr><td colspan=2><span class="basetxt">&nbsp;</td>
<tr>
	<td>&nbsp;</td>
	<td><span class="basetxt"><input type="button" value="Submit and Close Window" OnClick="do_submit()" class="button"></a> </td>
</tr>
<tr>
	<td>&nbsp;</td>
	<td><span class="basetxt">[ <a href="JavaScript:viewit()"><? echo $LANG['CHAT_PRINTER_FRIENDLY'] ?></a> ]</td>
</tr>
</table>
</form>

<? endif ; ?>

</td>
</tr>
</table>

<br>
&nbsp; 



</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>