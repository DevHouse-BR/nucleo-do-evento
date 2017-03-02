<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$sid = $action = $ip = $start = $sound = "" ;
	$surveyid = $counter = 0 ;
	$do_pull = 1 ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : $HTTP_POST_VARS['sid'] ;
	$l = ( isset( $HTTP_GET_VARS['l'] ) ) ? $HTTP_GET_VARS['l'] : "" ;
	$x = ( isset( $HTTP_GET_VARS['x'] ) ) ? $HTTP_GET_VARS['x'] : "" ;
	$ip = ( isset( $HTTP_GET_VARS['ip'] ) ) ? $HTTP_GET_VARS['ip'] : "" ;
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }

	if ( !file_exists( "../../web/$l/$l-conf-init.php" ) || !file_exists( "../../web/conf-init.php" ) )
	{
		HEADER( "location: ../index.php" ) ;
		exit ;
	}
	include_once("../../web/conf-init.php") ;
	include_once("../../web/$l/$l-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint_unique/get.php") ;
?>
<?
	// make sure they have access to this page
	// if admin session is set, then they have access
	if ( !$HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] )
	{
		HEADER( "location: ../../index.php" ) ;
		exit ;
	}

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "65" ;
	}
	else
	{
		$text_width = "30" ;
	}

	// initialize
	$admins = AdminUsers_get_AllUsers( $dbh, 0, 0, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
	$total_active_footprints = ServiceFootprintUnique_get_TotalActiveFootprints( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title> Operator [ operator-to-operator ] </title>

<? $css_path = "../../" ; include_once( "../../css/default.php" ) ; ?>

<script language="JavaScript">
<!--
	var refresh ;
	parent.window.control_pull_traffic( "stop" ) ;

	function do_alert()
	{
		// every minute
		refresh = setTimeout( "window.location.reload( true );", 15000 ) ;
		parent.window.control_pull_traffic( "stop" ) ;
	}

	function start_op2op( name, operator )
	{
		var date = new Date() ;
		var unique = date.getTime() ;
		var url = "<? echo $BASE_URL ?>/request.php?action=op2op&userid=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ?>&op2op="+operator+"&l=<? echo $l ?>&x=<? echo $x ?>&deptid=0&page=" ;
		var newwin = window.open( url, unique, 'scrollbars=no,menubar=no,resizable=0,location=no,screenX=50,screenY=100,width=450,height=350' ) ;
		newwin.focus() ;
	}
//-->
</script>

</head>
<body bgColor="#FFFFFF" text="#000000" link="#35356A" vlink="#35356A" alink="#35356A" marginheight="0" marginwidth="0" topmargin="0" leftmargin="2" onLoad="do_alert()">


<table cellspacing=1 cellpadding=0 border=0 width="100%">
  <tr> 
	<td colspan="2">
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td>
			[ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?counter=<? echo $total_active_footprints ?>&sid=<? echo $sid ?>&action=open_console&start=1&l=<? echo $l ?>&x=<? echo $x ?>">back to traffic monitor</a> ]
			[ <a href="<? echo $BASE_URL ?>/admin/traffic/console_timer.php?sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>">set refresh rate</a> ]
			<font color="#BBBBBB">[ operators ]</font> &nbsp;
			[ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?counter=0&sid=<? echo $sid ?>&action=close_console&start=1&l=<? echo $l ?>&x=<? echo $x ?>">close</a> ]
			</td>
		</tr>
		</table>
	</td>
  </tr>
  <tr class="hdash"> 
	<td colspan="2">&nbsp;</td>
  </tr>
  <tr>
	<td>
		<table width="100%" border=0 cellpadding=2 cellspacing=1>
		<tr>
			<td nowrap><b>Name</b></td>
			<td nowrap align="center"><b>Online Status</b></td>
			<td nowrap align="center"><b>Console Status</b></td>
			<td nowrap align="center"><b>Supporting</b></td>
			<td nowrap align="center">&nbsp;</td>
		</tr>
		<?
			for ( $c = 0; $c < count( $admins ); ++$c )
			{
				$admin = $admins[$c] ;
				$total_sessions = ServiceChat_get_UserTotalChatSessions( $dbh, $admin['name'] ) ;

				$bgcolor = "#EEEEF7" ;
				if ( $c % 2 )
					$bgcolor = "#E6E6F2" ;

				$online_status = "Offline" ;
				$bgcolor_status = "#FFE8E8" ;
				$activity = "not available" ;
				if ( ( $admin['available_status'] == 1 ) && ( $admin['last_active_time'] > $admin_idle ) )
				{
					$online_status = "Online" ;
					$bgcolor_status = "#E1FFE9" ;
					$activity = "$total_sessions requests" ;
				}
				else if ( $admin['available_status'] == 2 )
				{
					$online_status = "Away" ;
					$bgcolor_status = "#FEC65B" ;
				}

				$consol_status = "Closed" ;
				$bgcolor_consol = "#FFE8E8" ;
				if ( $admin['signal'] == 9 )
				{
					$consol_status = "Open" ;
					$bgcolor_consol = "#E1FFE9" ;
				}
				else if ( $admin['last_active_time'] > $admin_idle )
				{
					$consol_status = "Open" ;
					$bgcolor_consol = "#E1FFE9" ;
				}

				$request_string = "<font color=#BCBCBC>[ request chat ]</font>" ;
				if ( $admin['userID'] == $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] )
					$request_string = "&nbsp;" ;
				else if ( $online_status == "Online" )
					$request_string = "<a href=\"JavaScript:start_op2op( '$admin[name]', $admin[userID] )\">[ request chat ]</a>" ;

				print "
					<tr class=\"altcolor2\">
						<td>$admin[name]</td>
						<td align=\"center\" bgColor=\"$bgcolor_status\">$online_status</td>
						<td align=\"center\" bgColor=\"$bgcolor_consol\">$consol_status</td>
						<td align=\"center\">$activity</td>
						<td align=\"center\">
							$request_string
						</td>
					</tr>
				" ;
			}
		?>
		</table>
	</td>
  </tr>
</table>


</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>