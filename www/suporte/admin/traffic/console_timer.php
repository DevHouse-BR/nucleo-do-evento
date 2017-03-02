<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$sid = $action = "" ;
	$success = 0 ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : "" ;
	$l = ( isset( $HTTP_GET_VARS['l'] ) ) ? $HTTP_GET_VARS['l'] : "" ;
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
	include_once("$DOCUMENT_ROOT/API/Users/update.php") ;
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

	// initialize
?>
<?
	// functions
?>
<?
	// conditions
	if ( $action == "submit" )
	{
		switch ( $HTTP_GET_VARS['type'] )
		{
			case "every":
				$value = 10 ;
				break ;
			case "set":
				$value = $HTTP_GET_VARS['minute'] * 60 ;
				break ;
			default:
				$value = 0 ;

		}
		AdminUsers_update_UserValue( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], "console_refresh", $value ) ;
		$HTTP_SESSION_VARS['session_admin'][$sid]['traffic_timer'] = $value ;
		$success = 1 ;
	}

	$admin = AdminUsers_get_UserInfo( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
	$total_active_footprints = ServiceFootprintUnique_get_TotalActiveFootprints( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
?>
<html>
<head>
<title> Operator [ Set Traffic Monitor Refresh Rate ] </title>

<? $css_path = "../../" ; include_once( "../../css/default.php" ) ; ?>

<script language="JavaScript">
<!--
	parent.window.control_pull_traffic( "stop" ) ;
	parent.window.traffic_timer = <? echo $admin['console_refresh'] ?> ;

	function do_alert()
	{
		if ( <? echo $success ?> )
			alert( "Update success!" ) ;

		window.status = '' ;
		
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
			[ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?counter=<? echo $total_active_footprints ?>&sid=<? echo $sid ?>&action=open_console&start=1&l=<? echo $l ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>">back to traffic monitor</a> ]
			<font color="#BBBBBB">[ set refresh rate ]</font>
			
			<? if ( $admin['op2op'] && file_exists( "$DOCUMENT_ROOT/admin/traffic/ops.php" ) && ( AdminUsers_get_TotalUsers( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) > 1 ) ): ?>
			[ <a href="<? echo $BASE_URL ?>/admin/traffic/ops.php?sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>">operators</a> ] &nbsp;
			<? endif ; ?>
			
			[ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?counter=0&sid=<? echo $sid ?>&action=close_console&start=1&l=<? echo $l ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>">close</a> ]
			</td>
		</tr>
		</table>
	</td>
  </tr>
  <tr class="hdash"> 
	<td colspan="2">&nbsp;</td>
  </tr>
  <tr>
	<form method="GET" action="console_timer.php">
	<input type="hidden" name="action" value="submit">
	<input type="hidden" name="sid" value="<? echo $sid ?>">
	<input type="hidden" name="l" value="<? echo $l ?>">
	<td>
		<big><b>Set your traffic monitor refresh rate</b></big>
		<p>
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td><input type="radio" name="type" value="every" <?= ( $admin['console_refresh'] == 10 ) ? "checked" : "" ?>></td>
			<td> Update traffic monitor every time there is change in traffic.</td>
		</tr>
		<tr>
			<td><input type="radio" name="type" value="set" <?= ( $admin['console_refresh'] > 10 ) ? "checked" : "" ?>></td>
			<td> Update traffic monitor every <select name="minute"><option <?= ( ( $admin['console_refresh']/60 ) == 1 ) ? "selected" : "" ?> >1</option><option <?= ( ( $admin['console_refresh']/60 ) == 3 ) ? "selected" : "" ?>>3</option><option <?= ( ( $admin['console_refresh']/60 ) == 5 ) ? "selected" : "" ?>>5</option><option <?= ( ( $admin['console_refresh']/60 ) == 10 ) ? "selected" : "" ?>>10</option></select> minute(s)</td>
		</tr>
		<tr><td colspan=2>&nbsp;</td></tr>
		<tr>
			<td>&nbsp;</td>
			<td> <input type="submit" value="Update Changes" class="mainButton"></td>
		</tr>
		</table>
	</td>
	</form>
  </tr>
</table>


</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>