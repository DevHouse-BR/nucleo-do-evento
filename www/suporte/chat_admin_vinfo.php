<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$session_chat = $HTTP_SESSION_VARS['session_chat'] ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : "" ;
	$action = ( isset( $HTTP_GET_VARS['action'] ) ) ? $HTTP_GET_VARS['action'] : "" ;
	$requestid = ( isset( $HTTP_GET_VARS['requestid'] ) ) ? $HTTP_GET_VARS['requestid'] : "" ;
	$netscape = ( preg_match( "/Netscape/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) ) ? 1 : 0 ;

	if ( !file_exists( "web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php" ) || !file_exists( "web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;	
	include_once("./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Util.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Logs/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Refer/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
?>
<?
	// initialize
	$m = date( "m",mktime() ) ;
	$y = date( "Y",mktime() ) ;
	$d = date( "j",mktime() ) ;

	// the timespan to get the stats
	$begin = mktime( 0,0,0,$m,$d,$y ) ;
	$end = mktime( 23,59,59,$m,$d,$y ) ;
	$requestinfo = ServiceChat_get_ChatRequestInfo( $dbh, $requestid ) ;
	$admin = AdminUsers_get_UserInfo( $dbh, $session_chat[$sid]['admin_id'], $session_chat[$sid]['aspID'] ) ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title> Chat [admin view footprints] </title>

<? $css_path = "./" ; include( "./css/default.php" ) ; ?>

<script language="JavaScript">
<!--
	function view_transcript( chat_session )
	{
		url = "<? echo $BASE_URL ?>/admin/view_transcript.php?chat_session="+chat_session+"&x=<? echo $session_chat[$sid]['aspID'] ?>&l=<? echo $session_chat[$sid]['asp_login'] ?>&action=plain" ;
		//newwin = window.open(url, "transcript", "scrollbars=yes,menubar=no,resizable=1,location=no,width=500,height=550") ;
		//newwin.focus() ;
		location.href = url ;
	}
//-->
</script>

</head>
<body class="bg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<br>
<span class="medium">

<? if ( $HTTP_SESSION_VARS['session_chat'][$sid]['chatfile_get'] == "" ): ?>
<big><b>This session has ended.</b></big>

<?
	elseif ( ( $action == "footprints" ) && $VISITOR_FOOTPRINT ):
	include_once("./API/Footprint/get.php") ;
	$footprints_today = ServiceFootprint_get_DayFootprint( $dbh, $requestinfo['ip_address'], $begin, $end, 0, $session_chat[$sid]['aspID'], 0, 0 ) ;
	$footprints_beforetoday = ServiceFootprint_get_BeforeDayFootprint( $dbh, $requestinfo['ip_address'], $begin, 15, $session_chat[$sid]['aspID'] ) ;
?>
<!-- display only if visitor footprints is enabled -->
Pages visited today - based on ip (<? echo $requestinfo['ip_address'] ?>)<br>
<table cellspacing=1 cellpadding=1 border=0 width="95%">
<tr>
	<th>&nbsp;</th>
	<th align="left">Webpage URL</th>
</tr>
<?
	for ( $c = 0; $c < count( $footprints_today );++$c )
	{
		$footprint = $footprints_today[$c] ;
		$class = "class=\"altcolor1\"" ;
		if ( $c % 2 )
			$class = "class=\"altcolor2\"" ;

		$footprint_url = stripslashes( $footprint['url'] ) ;
		$string_length = strlen( $footprint_url ) ;
		if ( $string_length > 70 )
			$footprint_url = wordwrap( $footprint_url, 65, "<br>", $netscape ) ;

		print "<tr $class><td>$footprint[total]</td><td><a href=\"$footprint[url]?phplive_notally\" target=\"new\">$footprint_url</a></td></tr>\n" ;
	}
?>
</table>
<br>
Pages visited before today (top 15 pages last 3 months)<br>
<table cellspacing=1 cellpadding=1 border=0 width="95%">
<?
	for ( $c = 0; $c < count( $footprints_beforetoday );++$c )
	{
		$footprint = $footprints_beforetoday[$c] ;
		$class = "class=\"altcolor1\"" ;
		if ( $c % 2 )
			$class = "class=\"altcolor2\"" ;

		$footprint_url = stripslashes( $footprint['url'] ) ;
		$string_length = strlen( $footprint_url ) ;
		if ( $string_length > 70 )
			$footprint_url = wordwrap( $footprint_url, 65, "<br>", $netscape ) ;

		print "<tr $class><td>$footprint[total]</td><td><a href=\"$footprint[url]?phplive_notally\" target=\"new\">$footprint_url</a></td></tr>\n" ;
	}
?>
</table>
<!-- end visitor footprings -->



<?
	elseif ( $action == "transcripts" ):
	include_once("./API/Transcripts/get.php") ;
	$transcripts = ServiceTranscripts_get_TranscriptsByIP( $dbh, $requestinfo['ip_address'], $session_chat[$sid]['aspID'] ) ;
?>
Past Transcripts - based on ip (<? echo $requestinfo['ip_address'] ?>)<br>
<table cellspacing=1 cellpadding=1 border=0 width="95%">
<tr>
	<th align="left">Session ID</td>
	<th align="left">Created</td>
	<th align="left">Screen Name</td>
	<th align="left">Size</td>
</tr>
<?
	for ( $c = 0; $c < count( $transcripts );++$c )
	{
		$class = "class=\"altcolor1\"" ;
		if ( $c % 2 )
			$class = "class=\"altcolor2\"" ;

		$transcript = $transcripts[$c] ;
		$date = date( "m/d/y $TIMEZONE_FORMAT:i$TIMEZONE_AMPM", ( $transcript['created'] + $TIMEZONE ) ) ;
		$size = Util_Format_Bytes( strlen( strip_tags( $transcript['plain'] ) ) ) ;
		print "<tr $class><td><a href=\"JavaScript:view_transcript( $transcript[chat_session] )\">$transcript[chat_session]</a></td><td>$date</td><td>$transcript[from_screen_name]</td><td>$size</td></tr>\n" ;
	}
?>
</table>







<?
	elseif ( $action == "spam" ):
?>
Block this IP address from accessing your Live Support system.
<p>
<table cellspacing=0 cellpadding=0 border=0><form><tr><td><input type="button" class="mainButton" OnClick="window.open( '<? echo $BASE_URL ?>/admin/index.php?x=<? echo $session_chat[$sid]['aspID'] ?>&sid=<? echo $admin['session_sid'] ?>&action=set&ip=<? echo $requestinfo['ip_address'] ?>', 'new' )" value="Click Here to block <? echo $requestinfo['ip_address'] ?>"></td></tr></form></table>







<?
	else:
	$total_request = ServiceLogs_get_TotalIpRequests( $dbh, $requestinfo['ip_address'], $session_chat[$sid]['aspID'] ) ;
	$referinfo = ServiceRefer_get_ReferInfo( $dbh, $session_chat[$sid]['aspID'], $requestinfo['ip_address'] ) ;
	$requestlog = ServiceLogs_get_SessionRequestLog( $dbh, $session_chat[$sid]['sessionid'] ) ;

	$clicked_url = stripslashes( $requestinfo['url'] ) ;
	$string_length = strlen( $clicked_url ) ;
	if ( $string_length > 60 )
		$clicked_url = wordwrap( $clicked_url, 55, "<br>", $netscape ) ;
	
	$refer_url = stripslashes( $referinfo['refer_url'] ) ;
	$string_length = strlen( $refer_url ) ;
	if ( $string_length > 60 )
		$refer_url = wordwrap( $refer_url, 55, "<br>", $netscape ) ;
?>

<table cellspacing=1 cellpadding=2 border=0 width="95%">
<tr><th colspan=2 align="center">Visitor Information</th></tr>
<tr class="altcolor1">
	<td align="right" class="altcolor2"><b>Clicked From</td>
	<td><a href="<? echo $requestinfo['url'] ?>" target="new"><? echo $clicked_url ?></a></td>
</tr>
<tr class="altcolor1">
	<td align="right" class="altcolor2"><b>Refer URL</td>
	<td><a href="<? echo stripslashes( $referinfo['refer_url'] ) ?>" target="new"><? echo $refer_url ?></a></td>
</tr>
<? if ( isset( $requestinfo['email'] ) ): ?>
<tr class="altcolor1">
	<td align="right" class="altcolor2" nowrap><b>Email</td>
	<td><a href="mailto:<? echo $requestinfo['email'] ?>"><? echo $requestinfo['email'] ?></a></td>
</tr>
<? endif; ?>
<tr class="altcolor1">
	<td align="right" class="altcolor2" nowrap><b>Chat Request</td>
	<td><? echo $total_request ?> time(s)</td>
</tr>
<tr class="altcolor1">
	<td align="right" class="altcolor2"><b>Browser/OS</td>
	<td><? echo $requestinfo['browser_type'] ?></td>
</tr>
<tr class="altcolor1">
	<td align="right" class="altcolor2"><b>IP Address</td>
	<td><? echo $requestinfo['ip_address'] ?></td>
</tr>
<tr class="altcolor1">
	<td align="right" class="altcolor2"><b>Host Name</td>
	<td><? echo $requestlog['hostname'] ?></td>
</tr>
<tr class="altcolor1">
	<td align="right" class="altcolor2"><b>Monitor</td>
	<td><? echo $requestinfo['display_resolution'] ?></td>
</tr>
<tr class="altcolor1">
	<td align="right" class="altcolor2"><b>Time Zone</td>
	<td><? echo $requestinfo['visitor_time'] ?></td>
</tr>
</table>
<br>
<? endif ; ?>

<br>
</center>

</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>