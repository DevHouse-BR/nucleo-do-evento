<?
	session_start() ;
	if ( !isset( $HTTP_SESSION_VARS['session_admin'] ) && !isset( $HTTP_SESSION_VARS['session_chat'] ) && !isset( $HTTP_SESSION_VARS['session_setup'] ) )
	{
		print "<font color=\"#FF0000\">[Access Denied] Exiting...</font>" ;
		exit ;
	}

	$action = "" ;
	$x = $chat_session = $success = 0 ;
	if ( isset( $HTTP_GET_VARS['x'] ) ) { $x = $HTTP_GET_VARS['x'] ; }
	if ( isset( $HTTP_POST_VARS['x'] ) ) { $x = $HTTP_POST_VARS['x'] ; }
	if ( isset( $HTTP_GET_VARS['l'] ) ) { $l = $HTTP_GET_VARS['l'] ; }
	if ( isset( $HTTP_POST_VARS['l'] ) ) { $l = $HTTP_POST_VARS['l'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['chat_session'] ) ) { $chat_session = $HTTP_GET_VARS['chat_session'] ; }
	if ( isset( $HTTP_POST_VARS['chat_session'] ) ) { $chat_session = $HTTP_POST_VARS['chat_session'] ; }

	if ( !file_exists( "../web/$l/$l-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error in view_transcript.php: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("../web/$l/$l-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/get.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Transcripts/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Logs/get.php") ;
?>
<?
	// initialize
	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "30" ;
		$textbox_width = "35" ;
	}
	else
	{
		$text_width = "20" ;
		$textbox_width = "22" ;
	}

	$aspinfo = AdminASP_get_UserInfo( $dbh, $x ) ;
	$transcriptinfo = ServiceTranscripts_get_TranscriptInfo(  $dbh, $chat_session, $x ) ;
	$userinfo = AdminUsers_get_UserInfo( $dbh, $transcriptinfo['userID'], $x ) ;
	$date = date( "D m/d/y $TIMEZONE_FORMAT:i$TIMEZONE_AMPM", ( $transcriptinfo['created'] + $TIMEZONE ) ) ;
	$requestlog = ServiceLogs_get_SessionRequestLog( $dbh, $chat_session ) ;
	$chat_session = preg_replace( "/\.txt/", "", $chat_session ) ;
?>
<?
	if ( $action == "send" )
	{
		$department = AdminUsers_get_DeptInfo( $dbh, $transcriptinfo['deptID'], $x ) ;
		$subject = "$aspinfo[company] Chat Transcript" ;
		$header = "$LANG[WORD_COMPANY]: $COMPANY_NAME_TEMP
$LANG[WORD_DEPARTMENT]: $department[name]
$LANG[WORD_NAME]: $userinfo[name]
$LANG[WORD_EMAIL]: $userinfo[email]
$LANG[WORD_DAY]: $date\n" ;
		$transcript = preg_replace( "/Chat \[dynamic box\]/", "", stripslashes( $transcriptinfo['formatted'] ) ) ;
		$transcript = preg_replace( "/<br>/", "\r\n", $transcript ) ;
		$transcript = preg_replace( "/<hr>/", "\r\n---------------------------------------------\r\n", $transcript ) ;
		$transcript = preg_replace( "/<(.*?)>/", "", $transcript ) ;
		$transcript = preg_replace( "/[$]/", "$ ", $transcript ) ;
		$transcript = preg_replace( "/&#039;/", "'", $transcript ) ;
		$transcript = "$header $transcript" ;
		$transcript = wordwrap( $transcript, 70 ) ;
		$visitor_name = preg_replace( "/<(.*?)>/", "", stripslashes( $transcriptinfo['from_screen_name'] ) ) ;

		$message = preg_replace( "/%%transcript%%/", $transcript, stripslashes( $aspinfo['trans_email'] ) ) ;
		$message = preg_replace( "/%%username%%/", $visitor_name, $message ) ;
		$optmessage = stripslashes( $HTTP_POST_VARS['optmessage'] ) ;
		mail( $HTTP_POST_VARS['email'], $subject, "$optmessage\r\n\r\n$message", "From: $aspinfo[company] <$aspinfo[contact_email]>") ;
		$success = 1 ;
	}
?>
<html>
<head>
<title> Chat Transcript </title>
<? $css_path = "../" ; include( "../css/default.php" ) ; ?>

<script language="JavaScript">
<!--
	function do_alert()
	{
		if ( <? echo $success ?> )
			alert( "Transcript has been sent!" ) ;
	}

	function do_submit()
	{
		if ( document.form.email.value == "" )
			alert( "Please input a valid email address." ) ;
		else
			document.form.submit() ;
	}
//-->
</script>

</head>
<body class="bg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="do_alert()">
<center>
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
		<table cellspacing=1 cellpadding=0 border=0 width="95%">
		<tr>
			<td>
				<table cellspacing=1 cellpadding=2 border=0>
				<tr><td class="altcolor2"><b>Transcript</b></td><td> <? echo $chat_session  ?></td></tr>
				<tr><td class="altcolor2"><b>Date</b></td><td> <? echo $date ?></td></tr>
				<tr><td class="altcolor2"><b>Operator</b></td><td> <? echo $userinfo['name'] ?> [ <a href="mailto:<? echo $userinfo['email'] ?>"><? echo $userinfo['email'] ?></a> ]</td></tr>
				<tr><td class="altcolor2"><b>Visitor</b></td><td> <? echo $transcriptinfo['from_screen_name'] ?> <? if ( isset( $transcriptinfo['email'] ) ): ?>(<a href="mailto:<? echo $transcriptinfo['email'] ?>"><? echo $transcriptinfo['email'] ?></a>)<? endif ; ?></td></tr>
				<tr><td class="altcolor2"><b>IP</b></td><td> <? echo $requestlog['ip'] ?> (<? echo $requestlog['hostname'] ?>)</td></tr>
				<tr><td class="altcolor2"><b>Browser</b></td><td> <? echo $requestlog['browser_os'] ?></td></tr>
				<tr><td class="altcolor2"><b>Monitor</b></td><td> <? echo $requestlog['display_resolution'] ?></td></td></tr>
				</table>
			</td>
		</tr>
		<tr><td class="hdash">&nbsp;</td></tr>
		<tr>
			<td valign="top" bgColor="<? echo $CHAT_BOX_BACKGROUND ?>">
			<?
				$transcript = stripslashes( $transcriptinfo['formatted'] ) ;
				$transcript = preg_replace( "/<tstamp (.*?) tstamp>/", " <font size=1>\\1</font> ", $transcript ) ;
				echo $transcript ;
			?>
			</td>
		</tr>
		<tr><td class="hdash">&nbsp;</td></tr>

		</table>
		<br>

		<form method="POST" action="view_transcript.php" name="form">
		<input type="hidden" name="action" value="send">
		<input type="hidden" name="l" value="<? echo $l ?>">
		<input type="hidden" name="x" value="<? echo $x ?>">
		<input type="hidden" name="chat_session" value="<? echo $chat_session ?>">
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td>Email Transcript to: </td>
			<td><input type="text" name="email" size="<? echo $text_width ?>" maxlength="160" class="input"></td>
		</tr>
		<tr>
			<td>Optional Message: </td>
			<td><textarea cols=<? echo $textbox_width ?> rows=2 name="optmessage"></textarea></td>
		</tr>
		<tr>
			<td></td><td align="left"><input type="button" value="Email Transcript" OnClick="do_submit()" style="background-color : #E2E2E2; font-weight : bold; cursor: hand;"> &nbsp; <input type="button" value="Close Window" OnClick="window.close()" style="background-color : #E2E2E2; font-weight : bold; cursor: hand;"></td>
		</tr>
		</table>
		</form>

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
<!-- This navigation layer is placed at the very botton of the HTML to prevent pesky problems with NS4.x -->
<div id="navBack" style="position:absolute; left:8px; top:76px; width:62px; height:16px; z-index:1; visibility: hidden;"> 
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td><?php echo "" ?></td>
	</tr>
  </table>
</div>
</table>
</body>
</html>