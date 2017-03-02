<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$session_chat = $HTTP_SESSION_VARS['session_chat'] ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : "" ;
	$requestid = ( isset( $HTTP_GET_VARS['requestid'] ) ) ? $HTTP_GET_VARS['requestid'] : "" ;
	$sessionid = ( isset( $HTTP_GET_VARS['sessionid'] ) ) ? $HTTP_GET_VARS['sessionid'] : "" ;

	if ( !file_exists( "web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php" ) || !file_exists( "web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;	
	include_once("./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("./system.php") ;
?>
<?
	// initialize
	
	// we use $rand to prevent loading from cached pages
	mt_srand ((double) microtime() * 1000000);
	$rand = mt_rand() ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title> Chat [admin options] </title>

<? $css_path = "./" ; include( "./css/default.php" ) ; ?>

<script language="JavaScript">
<!--
//-->
</script>

</head>
<body class="bg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<span class="small">
[<a href="chat_admin_vinfo.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&requestid=<? echo $requestid ?>&rand=<? echo $rand ?>" target="admin_main">Visitor Info</a>]

<? if ( $VISITOR_FOOTPRINT && !file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) ): ?>
[<a href="chat_admin_vinfo.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&requestid=<? echo $requestid ?>&rand=<? echo $rand ?>&action=footprints" target="admin_main">Footprints</a>]
<? endif ; ?>

[<a href="chat_admin_vinfo.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&requestid=<? echo $requestid ?>&rand=<? echo $rand ?>&action=transcripts" target="admin_main">Transcripts</a>]

[<a href="chat_admin_transfer.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&requestid=<? echo $requestid ?>&rand=<? echo $rand ?>" target="admin_main">Transfer Call</a>]

<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/knowledge.php" ) ): ?>
[<a href="<? echo $BASE_URL ?>/admin/traffic/knowledge_search.php?l=<? echo $session_chat[$sid]['asp_login'] ?>&x=<? echo $session_chat[$sid]['aspID'] ?>&stripped=1" target="admin_main">Knowledge Base</a>]
<? endif ; ?>

[<a href="chat_admin_vinfo.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&requestid=<? echo $requestid ?>&rand=<? echo $rand ?>&action=spam" target="admin_main">Spam Block</a>]

</center>

</body>
</html>