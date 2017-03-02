<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$action = $deptid = $l = $x = $requestid = "" ;
	if ( isset( $HTTP_POST_VARS['l'] ) ) { $l = $HTTP_POST_VARS['l'] ; }
	if ( isset( $HTTP_GET_VARS['l'] ) ) { $l = $HTTP_GET_VARS['l'] ; }
	if ( isset( $HTTP_POST_VARS['x'] ) ) { $x = $HTTP_POST_VARS['x'] ; }
	if ( isset( $HTTP_GET_VARS['x'] ) ) { $x = $HTTP_GET_VARS['x'] ; }
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['deptid'] ) ) { $deptid = $HTTP_GET_VARS['deptid'] ; }
	if ( isset( $HTTP_POST_VARS['deptid'] ) ) { $deptid = $HTTP_POST_VARS['deptid'] ; }
	if ( isset( $HTTP_GET_VARS['requestid'] ) ) { $requestid = $HTTP_GET_VARS['requestid'] ; }

	if ( !file_exists( "web/$l/$l-conf-init.php" ) || !file_exists( "web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;
	include_once("./web/$l/$l-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/remove.php") ;
?>
<?
	// initialize
	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "40" ;
		$textbox_width = "45" ;
	}
	else
	{
		$text_width = "15" ;
		$textbox_width = "30" ;
	}

	$aspinfo = AdminASP_get_UserInfo( $dbh, $x ) ;
	$deptinfo = AdminUsers_get_DeptInfo( $dbh, $deptid, $x ) ;
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "submit" )
	{
		if ( $deptinfo['email'] )
		{
			$cookie_lifespan = time() + 60*60*24*180 ;
			setcookie( "COOKIE_PHPLIVE_VEMAIL", stripslashes( $HTTP_POST_VARS['email'] ), $cookie_lifespan ) ;

			$message = "Live Support Message Delivery:\r\n-------------------------------------------\r\n\r\n" . stripslashes( $HTTP_POST_VARS['message'] ) ;
			$subject = stripslashes( $HTTP_POST_VARS['subject'] ) ;
			mail( $deptinfo['email'], $subject, $message, "From: $HTTP_POST_VARS[name] <$HTTP_POST_VARS[email]>") ;
		}
	}
	else if ( $action == "exit" )
	{
		ServiceChat_remove_ChatRequest( $dbh, $requestid ) ;
	}
?>
<html>
<head>
<title> <? echo $LANG['TITLE_LEAVEMESSAGE'] ?> </title>

<link rel="Stylesheet" href="css/base.css">
<script language="JavaScript" src="js/newwin.js"></script>

<script language="JavaScript">
<!--
	function do_submit()
	{
		if ( ( document.form.name.value == "" ) || ( document.form.email.value == "" )
			|| ( document.form.subject.value == "" ) || ( document.form.message.value == "" ) )
			alert( "<? echo $LANG['MESSAGE_BOX_JS_A_ALLFIELDSSUP'] ?>" ) ;
		else if ( document.form.email.value.indexOf("@") == -1 )
			alert( "<? echo $LANG['MESSAGE_BOX_JS_A_INVALIDEMAIL'] ?>" ) ;
		else
			document.form.submit() ;
	}

	//window.parent.document.title = "<? echo $LANG['TITLE_SUPPORTREQUEST'] ?>" ;
//-->
</script>

</head>
<body bgColor="<? echo $CHAT_REQUEST_BACKGROUND ?>" text="<? echo $TEXT_COLOR ?>" link="<? echo $LINK_COLOR ?>" alink="<? echo $ALINK_COLOR ?>" vlink="<? echo $VLINK_COLOR ?>" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
<center>

<?
	if ( file_exists( "web/$l/$LOGO" ) && $LOGO )
		$logo = "web/$l/$LOGO" ;
	else if ( file_exists( "web/$LOGO_ASP" ) && $LOGO_ASP )
		$logo = "web/$LOGO_ASP" ;
	else
		$logo = "images/logo.gif" ;
?>
<table cellspacing=0 cellpadding=2 border=0><tr><td><img src="<? echo $logo ?>"></td></tr></table>
<br>
<span class="basetxt">

<? if ( $action == "submit" ): ?>
<? echo $LANG['MESSAGE_BOX_SENT'] ?> <b><? echo $deptinfo['name'] ?></b>.
<? if ( file_exists( "$DOCUMENT_ROOT/admin/traffic/knowledge_search.php" ) && $aspinfo['knowledgebase'] ) : ?>
<br><a href="<? echo $BASE_URL ?>/admin/traffic/knowledge_search.php?l=<? echo $l ?>&x=<? echo $x ?>&deptid=<? echo $deptid ?>&"><b><? echo $LANG['CLICK_HERE'] ?></b></a> to search our Knowlede Base.</a>
<? endif ; ?>
<p>
<input type="button" value="<? echo $LANG['WORD_CLOSE'] ?>" OnClick="parent.window.close()" class="button">
<p>






<? else: ?>
<?= ( $deptinfo['message'] ) ? stripslashes( $deptinfo['message'] ) : $LANG['MESSAGE_BOX_MESSAGE'] ?>
<? if ( file_exists( "$DOCUMENT_ROOT/admin/traffic/knowledge_search.php" ) && $aspinfo['knowledgebase'] ) : ?>
<br><a href="<? echo $BASE_URL ?>/admin/traffic/knowledge_search.php?l=<? echo $l ?>&x=<? echo $x ?>&deptid=<? echo $deptid ?>&"><b><? echo $LANG['CLICK_HERE'] ?></b></a> <? echo $LANG['KB_SEARCH'] ?></a>
<? endif ; ?>
<p>
<form method="POST" action="message_box.php" name="form">
<input type="hidden" name="action" value="submit">
<input type="hidden" name="deptid" value="<? echo $deptid ?>">
<input type="hidden" name="x" value="<? echo $x ?>">
<input type="hidden" name="l" value="<? echo $l ?>">
<input type="hidden" name="requestid" value="<? echo $requestid ?>">
<? include("$DOCUMENT_ROOT/API/Users/cp.php") ; ?>
<table cellspacing=0 cellpadding=1 border=0>
<tr>
	<td><span class="basetxt"><font color="#FF0000">*</font> <? echo $LANG['WORD_NAME'] ?></td>
	<td><font size=2> <input type="text" name="name" size="<? echo $text_width ?>" maxlength="255" class="input" value="<?= isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_VLOGIN'] ) ? stripslashes( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_VLOGIN'] ) : "" ?>"></td>
</tr>
<tr>
	<td><span class="basetxt"><font color="#FF0000">*</font> <? echo $LANG['WORD_EMAIL'] ?></td>
	<td><font size=2> <input type="text" name="email" size="<? echo $text_width ?>" maxlength="255" class="input" value="<?= ( isset( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_VEMAIL'] ) && ( $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_VEMAIL'] != "-@-.com" ) ) ? $HTTP_COOKIE_VARS['COOKIE_PHPLIVE_VEMAIL'] : "" ?>"></td>
</tr>
<tr>
	<td><span class="basetxt"><font color="#FF0000">*</font> <? echo $LANG['WORD_SUBJECT'] ?></td>
	<td><font size=2> <input type="text" name="subject" size="<? echo $text_width ?>" maxlength="255" class="input"></td>
</tr>
<tr>
	<td valign="top"><span class="basetxt"><font color="#FF0000">*</font> <? echo $LANG['WORD_MESSAGE'] ?></td>
	<td valign="top"><font size=2> <textarea cols="<? echo $textbox_width ?>" rows="4" name="message" class="textarea"></textarea><br>
	<input type="button" value="<? echo "$LANG[WORD_SEND] $LANG[WORD_EMAIL]" ?>" OnClick="do_submit()" class="button">
	</td>
</tr>
</table>
</form>

<? endif ; ?>

<br>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->
&nbsp;

</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>
