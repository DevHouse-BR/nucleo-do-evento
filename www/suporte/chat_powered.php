<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$session_chat = $HTTP_SESSION_VARS['session_chat'] ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : $HTTP_POST_VARS['sid'] ;
	include_once("./web/conf-init.php") ;	
	include_once("./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
?>
<?
	// initialize
	$sessionid = ( isset( $HTTP_GET_VARS['sessionid'] ) ) ? $HTTP_GET_VARS['sessionid'] : "" ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title> Chat [powered] </title>

<link rel="Stylesheet" href="./css/base.css">

<script language="JavaScript">
<!--
	var respawn = 0 ;
	function do_autoclose()
	{
		if ( respawn )
		{
			url = "request.php?sessionid=<? echo $sessionid ?>&sid=<? echo $sid ?>&l=<? echo $session_chat[$sid]['asp_login'] ?>&action=rateme" ;
			newwin = window.open( url, "rateme", 'scrollbars=no,menubar=no,resizable=0,location=no,screenX=50,screenY=100,width=450,height=350' ) ;
			newwin.focus() ;
		}
	}

	function toggle_respawn( flag )
	{
		respawn = flag ;
	}

	function do_refresh( admin_id )
	{
		toggle_respawn(1) ;
		parent.window.frames["main"].location.href = "chat_box.php?action=connected" ;
		var temp = setTimeout( 'do_refresh2( '+admin_id+' )', 1000 ) ;
		
	}

	function do_refresh2( admin_id )
	{
		parent.window.frames["options"].location.href = "chat_options.php?action=start&sid=<? echo $sid ?>&admin_id="+admin_id ;
	}
//-->
</script>

</head>
<body bgColor="<? echo $CHAT_REQUEST_BACKGROUND ?>" text="<? echo $TEXT_COLOR ?>" link="<? echo $LINK_COLOR ?>" alink="<? echo $ALINK_COLOR ?>" vlink="<? echo $VLINK_COLOR ?>" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" <?= ( !isset( $session_chat[$sid]['op2op'] ) || !$session_chat[$sid]['op2op'] ) ? "onUnload=\"do_autoclose()\"" : "" ?>>
<center>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->
<span class="smalltxt">
<? if ( file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) ): ?>

<? else: ?>
<? //echo $LANG['DEFAULT_BRANDING'] ?>
<? endif ; ?>
 <? // echo $PHPLIVE_VERSION ?></span>
</center>

</body>
</html>