<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$session_chat = $HTTP_SESSION_VARS['session_chat'] ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : "" ;
	$requestid = ( isset( $HTTP_GET_VARS['requestid'] ) ) ? $HTTP_GET_VARS['requestid'] : "" ;
	$sessionid = ( isset( $HTTP_GET_VARS['sessionid'] ) ) ? $HTTP_GET_VARS['sessionid'] : "" ;
	$userid = ( isset( $HTTP_GET_VARS['userid'] ) ) ? $HTTP_GET_VARS['userid'] : "" ;
	$action = ( isset( $HTTP_GET_VARS['action'] ) ) ? $HTTP_GET_VARS['action'] : "" ;
	if ( !file_exists( "web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php" ) || !file_exists( "web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;	
	include_once("./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("./system.php") ;
	include_once("./lang_packs/$LANG_PACK.php") ;
	include_once("./API/sql.php") ;
	include_once("./API/Chat/update.php") ;


	// set frame row properties depending if admin or regular request
	$frame_row_properties = "60,100%,48,36,20,*" ;
	if ( $session_chat[$sid]['isadmin'] && $session_chat[$sid]['deptid'] )
		$frame_row_properties = "60,100%,48,36,78,20,140,*" ;
	// let's start the poll time
	$HTTP_SESSION_VARS['session_chat'][$sid]['admin_poll_time'] = time() ;
	$window_title = preg_replace( "/<(.*)>/", "", $session_chat[$sid]['visitor_name'] ) .": Support Request" ;
?>
<html>
<head>
<title> <? echo $window_title  ?> </title>

<script language="JavaScript" src="./js/browsercheck.js"></script>
<script language="JavaScript">
<!--
	var iswriting = 0 ;

	function pushit( url, winname )
	{
		window.open( url, winname, "scrollbars=yes,menubar=no,toolbar=yes,resizable=1,location=yes") ;
		parent.window.focus() ;
	}

	function toggle_iswriting( value )
	{
		iswriting = value ;
	}

	function message_box()
	{
		location.href = "<? echo $BASE_URL ?>/message_box.php?l=<? echo $session_chat[$sid]['asp_login'] ?>&x=<? echo $session_chat[$sid]['aspID'] ?>&deptid=<? echo $session_chat[$sid]['deptid'] ?>&action=exit&requestid=<? echo $requestid ?>" ;
	}
//-->
</script>
</head>
<frameset rows="<? echo $frame_row_properties ?>" cols="*" border="0" frameborder="0">
	<!-- header to show logo and options -->
	<frame src="chat_header.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&userid=<? echo $userid ?>" name="header" noresize border=0 scrolling=no>
	<!-- the area where messages are displayed -->
	<frame src="chat_box.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&requestid=<? echo $requestid ?>" name="main" noresize border=0 scrolling=auto>
	<!-- the chat writer form -->
	<frame src="chat_write.php?action=<? echo $action ?>&sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>" name="writer" noresize border=0 scrolling=no>
	<frame src="chat_options.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>" name="options" noresize border=0 scrolling=no>
	<? if ( $session_chat[$sid]['isadmin'] && $session_chat[$sid]['deptid'] ): ?>
		<!-- show admin area if admin -->
		<frame src="chat_admin_canned.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&requestid=<? echo $requestid ?>" name="admin_canned" noresize border=0 scrolling=no>
		<frame src="chat_admin_options.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&requestid=<? echo $requestid ?>" name="admin_options" noresize border=0 scrolling=no>
		<frame src="chat_admin_vinfo.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&requestid=<? echo $requestid ?>" name="admin_main" noresize border=0 scrolling=auto>
	<? else: ?>
	<frame src="chat_powered.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>" name="powered" noresize border=0 scrolling=no>
	<? endif ; ?>
	<!-- session check -->
	<frame src="chat_session.php?sessionid=<? echo $sessionid ?>&requestid=<? echo $requestid ?>&sid=<? echo $sid ?>&start=1" name="session" noresize border=0 scrolling=no>
</frameset>
<noframes>

</html>
<?
	mysql_close( $dbh['con'] ) ;
?>