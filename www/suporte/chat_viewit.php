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
?>
<?
	// initialize
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

</head>
<frameset rows="4,*,4" cols="*" border="0" frameborder="0" framespacing=0>
	<frame src="request_ftop.php?l=<? echo $session_chat[$sid]['asp_login'] ?>" name="ftop" noresize border=0 scrolling=no>
	<frameset rows="*" cols="4,*,4" border="0" frameborder="0" framespacing=0>
		<frame src="request_fleft.php?l=<? echo $session_chat[$sid]['asp_login'] ?>" name="fleft" noresize border=0 scrolling=no>
		<frame src="chat_viewit_main.php?sid=<? echo $sid ?>" name="fmain" noresize border=0 scrolling=auto>
		<frame src="request_fright.php?l=<? echo $session_chat[$sid]['asp_login'] ?>" name="fright" noresize border=0 scrolling=no>
	</frameset>
	<frame src="request_fbottom.php?l=<? echo $session_chat[$sid]['asp_login'] ?>" name="fbottom" noresize border=0 scrolling=no>
</frameset>
<noframes>
</html>