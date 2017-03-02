<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$sid = "" ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : $HTTP_POST_VARS['sid'] ;

	if ( !file_exists( "../web/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php") ;	include_once("$DOCUMENT_ROOT/web/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Refer/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;

	ServiceRefer_remove_OldRefer( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
	$admin = AdminUsers_get_UserInfo( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
?>
<html>
<head>
<title> Operator Console </title>

<script language="JavaScript">
<!--

	// timer1=setTimeout("window.location.reload( true );", 10000);

	var date ;
	var unique ;
	var traffic_monitor_on = 0 ;
	var traffic_timer = <? echo $admin['console_refresh'] ?> ;
	var reload_switch = 1 ;

	// we put the request check on this page because of Netscape does not
	// like frames and the var temp = setTimeout does not work when Netscape refreshes
	// the window when we do a resize of window.  so the var temp = setTimeout HAS to
	// be in the parent window, not in the framed window.... in FACT, put
	// most of the JavaScript in the parent window.  it seems Netscape does
	// not even recognize JavaScript functions inside framed window after resizing
	// window ("Netscrape" makes things difficult).
	var pullimage ;
	var loaded = 0 ;
	var pullimage = new Image ;

	var pullimage_traffic ;
	var loaded_traffic = 0 ;
	var pullimage_traffic = new Image ;
	var pflag = 0 ;

	// begin pulling of request
	function checkifloaded()
	{
		loaded = pullimage.width ;
		if ( loaded )
		{
			//parent.window.admin_requests.location.reload( true ) ;
			parent.window.admin_requests.location.href = "admin_requests.php?status=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['available_status'] ?>&sid=<? echo $sid ?>&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>" ;
		}
	}

	function dounique()
	{
		date = new Date() ;
		return date.getTime() ;
	}

	function do_pull()
	{
		unique = dounique() ;
		pullimage = new Image ;
		pullimage.src = '<? echo $BASE_URL ?>/pull/requests.php?sid=<? echo $sid ?>&unique='+unique ;
		pullimage.onload = checkifloaded ;
		var temp = setTimeout("do_pull()",5000) ;
	}
	// end pulling of requests

	// begin pulling of traffic monitor
	function checkifloaded_traffic()
	{
		loaded_traffic = pullimage_traffic.width ;
		if ( ( loaded_traffic && ( traffic_monitor_on == 1 ) ) || ( traffic_timer > 10 ) )
		{
			unique = dounique() ;
			// if 100, then it means 0 requests.  why?  can't have an image size of 0x0,
			// nor 0x1, nor 0xAnything
			if ( loaded_traffic == 100 )
				parent.window.admin_puller.location.reload(true) ;
			else
				parent.window.admin_puller.location.href = "<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?counter="+loaded_traffic+"&sid=<? echo $sid ?>&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>&unique="+unique ;
		}
	}

	function do_pull_traffic()
	{
		if ( traffic_monitor_on == 1 )
		{
			unique = dounique() ;
			pullimage_traffic = new Image ;
			pullimage_traffic.src = '<? echo $BASE_URL ?>/pull/client.php?sid=<? echo $sid ?>&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>&unique='+unique ;
			pullimage_traffic.onload = checkifloaded_traffic ;
		}
	}

	function control_pull_traffic( action )
	{
		if ( action == "start" )
		{
			if ( traffic_monitor_on != 1 )
			{
				traffic_monitor_on = 1 ;
				do_pull_traffic() ;
			}
		}
		else
			traffic_monitor_on = 0 ;
	}
	// end pulling of traffic monitor

	function update_status( status, wflag )
	{
		parent.window.admin_requests.location.href = "admin_requests.php?action=status&status="+status+"&sid=<? echo $sid ?>&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>" ;
	}

	function do_kill()
	{
		if ( confirm( "Really kill the other window?" ) )
			parent.window.admin_requests.location.href = "admin_requests.php?status=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['available_status'] ?>&action=kill&sid=<? echo $sid ?>&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>" ;
	}

	function do_reject( requestid, sessionid )
	{
		parent.window.admin_requests.location.href = "admin_requests.php?status=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['available_status'] ?>&action=reject&sessionid="+sessionid+"&requestid="+requestid+"&sid=<? echo $sid ?>&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>" ;
	}

	function open_chat( requestid, sessionid, deptid )
	{
		// if no deptid, then it is operator-to-operator
		window_height = 560 ;
		if ( deptid == 0 )
			window_height = 350 ;
		url = "../request.php?action=accept&sessionid="+sessionid+"&requestid="+requestid+"&sid=<? echo $sid ?>&userid=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ?>&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>" ;
		newwin = window.open(url, requestid, "scrollbars=no,menubar=no,resizable=0,location=no,width=450,height="+window_height+",screenX=50,screenY=100") ;
		newwin.focus() ;
	}
//-->
</script>
</head>
<frameset rows="175,*" cols="*" border="0" frameborder="0" framespacing="0">
	<frame src="admin_requests.php?status=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['available_status'] ?>&sid=<? echo $sid ?>&start=1&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>" name="admin_requests" noresize border=0 scrolling=auto>
	<!-- <frame src="admin_options.php?sid=<? echo $sid ?>&start=1&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>" name="admin_requests" noresize border=0 scrolling=no> -->

	<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/admin_puller.php" ) ): ?>
	<frame src="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?sid=<? echo $sid ?>&start=1&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>" name="admin_puller" noresize border=0 scrolling=auto>
	<? else: ?>
	<frame src="blank.php?sid=<? echo $sid ?>&start=1&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>" name="admin_puller" noresize border=0 scrolling=auto>
	<? endif ; ?>
</frameset>
<noframes>

</html>
<?
	mysql_close( $dbh['con'] ) ;
?>