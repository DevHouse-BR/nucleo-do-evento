<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$sid = $action = $ip = $start = $sound = "" ;
	$surveyid = $counter = 0 ;
	$do_pull = 1 ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : "" ;
	$l = ( isset( $HTTP_GET_VARS['l'] ) ) ? $HTTP_GET_VARS['l'] : "" ;
	$x = ( isset( $HTTP_GET_VARS['x'] ) ) ? $HTTP_GET_VARS['x'] : "" ;
	$ip = ( isset( $HTTP_GET_VARS['ip'] ) ) ? $HTTP_GET_VARS['ip'] : "" ;
	$start = ( isset( $HTTP_GET_VARS['start'] ) ) ? $HTTP_GET_VARS['start'] : "" ;
	$sound = ( isset( $HTTP_GET_VARS['sound'] ) ) ? $HTTP_GET_VARS['sound'] : "" ;

	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_POST_VARS['surveyid'] ) ) { $surveyid = $HTTP_POST_VARS['surveyid'] ; }
	if ( isset( $HTTP_GET_VARS['surveyid'] ) ) { $surveyid = $HTTP_GET_VARS['surveyid'] ; }
	if ( isset( $HTTP_POST_VARS['counter'] ) ) { $counter = $HTTP_POST_VARS['counter'] ; }
	if ( isset( $HTTP_GET_VARS['counter'] ) ) { $counter = $HTTP_GET_VARS['counter'] ; }

	if ( !file_exists( "../../web/$l/$l-conf-init.php" ) || !file_exists( "../../web/conf-init.php" ) )
	{
		HEADER( "location: ../index.php" ) ;
		exit ;
	}
	include_once("../../web/conf-init.php") ;
	include_once("../../web/$l/$l-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/API/Chat/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint_unique/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint_unique/update.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Refer/get.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APISurvey/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Clicks/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Canned/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint_unique/remove.php") ;
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
		$optimized = 1 ;
		$text_width = "65" ;
	}
	else
	{
		$optimized = 0 ;
		$text_width = "30" ;
	}

	// initialize
	$m = date( "m",mktime() ) ;
	$y = date( "Y",mktime() ) ;
	$d = date( "j",mktime() ) ;

	// the timespan to get the stats
	$begin = mktime( 0,0,0,$m,$d,$y ) ;
	$end = mktime( 23,59,59,$m,$d,$y ) ;

	// we use $rand to prevent loading from cached pages
	mt_srand ((double) microtime() * 1000000);
	$rand = mt_rand() ;

	ServiceFootprintUnique_remove_IdleFootprints( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
	$admin = AdminUsers_get_UserInfo( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
	$can_initiate = AdminUsers_get_CanUserInitiate( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ) ;
	if ( !$can_initiate || !$INITIATE )
		$action = "close_console" ;
	$idle = time() - $FOOTPRINT_IDLE ;	
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "footprints" )
	{
		$do_pull = 0 ;
	}
	else if ( $action == "chat" )
	{
		$do_pull = 0 ;
	}
	else if ( $action == "close_console" )
	{
		$do_pull = 0 ;
		$HTTP_SESSION_VARS['session_admin'][$sid]['traffic_monitor'] = 0 ;
	}
	else if ( $action == "open_console" )
	{
		$HTTP_SESSION_VARS['session_admin'][$sid]['traffic_monitor'] = 1 ;
	}
	else if ( $action == "push_survey" )
	{
		$do_pull = 0 ;
		ServiceFootprintUnique_update_FootprintValue( $dbh, $ip, "surveyID", $surveyid ) ;
		$flag_string = "$admin[userID]<:>$HTTP_GET_VARS[deptid]" ;
		$fp = fopen( "$DOCUMENT_ROOT/web/chatrequests/$ip.s", "wb+" ) ;
		fwrite( $fp, $flag_string, strlen( $flag_string ) ) ;
		fclose( $fp ) ;
	}
	else if ( $action == "survey" )
		$do_pull = 0 ;
	else if ( $action == "sound" )
		$HTTP_SESSION_VARS['session_admin'][$sid]['sound'] = $sound ;
	
?>
<html>
<head>
<title> Operator [ visitor traffic monitor ] </title>

<? $css_path = "../../" ; include_once( "../../css/default.php" ) ; ?>

<script language="JavaScript">
<!--
	var temp ;
	var newwin ;
	function start_pulling()
	{
		<? if ( !$HTTP_SESSION_VARS['session_admin'][$sid]['traffic_monitor'] ): ?>
			parent.window.control_pull_traffic( "stop" ) ;
		<? elseif ( !$do_pull ): ?>
			parent.window.control_pull_traffic( "stop" ) ;
		<? else: ?>
			parent.window.traffic_monitor_on = 0 ;
			if ( parent.window.traffic_timer > 10 )
				temp = setTimeout("parent.window.control_pull_traffic('start')",<? echo $admin['console_refresh'] ?> * 1000) ;
			else
			{
				parent.window.control_pull_traffic('start') ;
				temp = setTimeout("start_pulling()",<? echo $admin['console_refresh'] ?> * 1000) ;
			}
		<? endif ; ?>
	}

	function open_chat( ip, page )
	{
		for ( c = 0; c < document.form.method.length; ++c )
		{
			if ( document.form.method[c].checked )
				method_index = document.form.method[c].value ;
		}
		dept_index = document.form.deptid.selectedIndex ;
		deptid = document.form.deptid[dept_index].value ;
		message_index = document.form.message.selectedIndex ;
		messageid = document.form.message[message_index].value ;
		page = escape( page ) ;
		url = "../../request.php?action=initiate&ip="+ip+"&sid=<? echo $sid ?>&userid=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ?>&l=<? echo $l ?>&x=<? echo $x ?>&messageid="+messageid+"&page="+page+"&method="+method_index+"&deptid="+deptid+"&" ;

		winname = parent.window.dounique() ;
		newwin = window.open(url, winname, "scrollbars=no,menubar=no,resizable=0,location=no,width=450,height=560") ;
		temp = setTimeout("location.href = '<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?action=chat&start=1&rand=<? echo $rand ?>&sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>&ip=<? echo $ip ?>'",15000) ;
		newwin.focus() ;
	}

	function push_survey( form )
	{
		document.form.submit() ;
	}

	function switch_sound( flag )
	{
		location.href = "admin_puller.php?action=sound&sid=<? echo $sid ?>&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>&sound="+flag+"&counter=<? echo $counter ?>" ;
	}

	function open_admin_setup()
	{
		dept_index = document.form.deptid.selectedIndex ;
		deptid = document.form.deptid[dept_index].value ;
		url = "<? echo $BASE_URL ?>/admin/index.php?x=<? echo $x ?>&sid=<? echo $sid ?>&action=set&canned=1" ;
		newwin = window.open(url, "setup_admin") ;
		newwin.focus() ;
	}

	// used for popup info box
	var info_array = new Array() ;
//-->
</script>

<style type="text/css">
<!--
#dek {POSITION:absolute;VISIBILITY:hidden;Z-INDEX:200;}
//-->
</style>

</head>
<body bgColor="#FFFFFF" text="#000000" link="#35356A" vlink="#35356A" alink="#35356A" marginheight="0" marginwidth="0" topmargin="0" leftmargin="2" OnLoad="start_pulling()">


<?
	if ( $action == "footprints" ):
	$footprint = ServiceFootprintUnique_get_IPFootprintInfo( $dbh, $ip, $x ) ;
?>
	<table cellspacing=1 cellpadding=0 border=0 width="100%">
	  <tr> 
		<td colspan="2">
		  [ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?rand=<? echo $rand ?>&sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>&start=1">back to traffic monitor</a> ]
		  <font color="#BBBBBB">[ view footprints ]</font>
		  [ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?action=chat&rand=<? echo $rand ?>&sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>&ip=<? echo $ip ?>">initiate chat</a> ] &nbsp; IP Address: <b><? echo $ip ?></b>
		  </td>
	  </tr>
	  <tr class="hdash"> 
		<td colspan="2">&nbsp;</td>
	  </tr>
	</table>

	<? if ( !$footprint['ip'] ): ?>
	<span class="panelTitle"><font color="#FF0000">Visitor has left site or is unavailable.</font></font>

	<? 
		else:
		$footprints_today = ServiceFootprint_get_DayFootprint( $dbh, $ip, $begin, $end, 0, $x, 0, 0 ) ;
		$footprints_beforetoday = ServiceFootprint_get_BeforeDayFootprint( $dbh, $ip, $begin, 20, $x ) ;
	?>


	<!-- display only if visitor footprints is enabled -->
	<table width="100%" border=0 cellpadding=3 cellspacing=1>
	  <tr align="left"> 
		<td colspan="2">Pages visited today - based on ip</td>
	  </tr>
	<?
		for ( $c = 0; $c < count( $footprints_today );++$c )
		{
			$footprint = $footprints_today[$c] ;
			$class = "altcolor2" ;
			if ( $c % 2 )
				$class = "altcolor3" ;
			print "<tr class=\"$class\"><td>$footprint[total]</td><td><a href=\"$footprint[url]\" target=\"new\">$footprint[url]</a></td></tr>\n" ;
		}
	?>
	  <tr class="altcolor1"> 
		<td colspan="2" align="center" class="hdash">&nbsp;</td>
	  </tr>
	  <tr align="left"> 
		<td colspan="2">Pages visited before today (top 20 pages) - based on ip</td>
	  </tr>
	<?
		for ( $c = 0; $c < count( $footprints_beforetoday );++$c )
		{
			$footprint = $footprints_beforetoday[$c] ;
			$class = "altcolor2" ;
			if ( $c % 2 )
				$class = "altcolor3" ;
			print "<tr class=\"$class\"><td>$footprint[total]</td><td><a href=\"$footprint[url]\" target=\"new\">$footprint[url]</a></td></tr>\n" ;
		}
	?>
	</table>

	<? endif; ?>
<!-- end visitor footprings -->













<?
	elseif ( $action == "chat" ):
	$chatrequestinfo = ServiceChat_get_IPChatRequestInfo( $dbh, $x, $ip ) ;
	$admin_departments = AdminUsers_get_UserDepartments( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ) ;
	$select_dept = "" ;
	for ( $c = 0; $c < count( $admin_departments ); ++$c )
	{
		$department = $admin_departments[$c] ;
		$select_dept .= "<option value=\"$department[deptID]\">$department[name]</option>" ;
	}
	$canneds = ServiceCanned_get_UserCannedByType( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], 0, 'i', '' ) ;
	$select_canned = "" ;
	for ( $c = 0; $c < count( $canneds ); ++$c )
	{
		$canned = $canneds[$c] ;
		$select_canned .= "<option value=\"$canned[cannedID]\">$canned[name]</option>" ;
	}

	$footprint = ServiceFootprintUnique_get_IPFootprintInfo( $dbh, $ip, $x ) ;
	$duration = $footprint['updated'] - $footprint['created'] ;
	if ( $duration > 60 )
		$duration = floor( $duration/60 ) . " min" ;
	else
		$duration = $duration . " sec" ;

	$start_date = mktime( 0,0,0,date("m"),date("j"),date("Y") ) ;
	$end_date = mktime( 23,59,59,date("m"),date("j"),date("Y") ) ;
	$total_initiated = ServiceChat_get_TotalInitiatedOnDate( $dbh, $x, $ip, $start_date, $end_date ) ;
	if ( count( $canneds ) <= 0 )
		$status = "<span class=\"panelTitle\"><font color=\"#FF0000\">You must create Canned Initiate Messages.</font></font>" ;
	else if ( $chatrequestinfo['requestID'] )
		$status = "<span class=\"panelTitle\"><font color=\"#FF0000\">Visitor is currently on a support call.</font></span>" ;
	else if ( $footprint['updated'] > $idle )
		$status = "<a href=\"JavaScript:void(0)\" OnClick=\"open_chat( '$footprint[ip]', '$footprint[url]' )\" class=\"panelTitle\">Click HERE to initiate chat now!</a>" ;
	else
		$status = "<span class=\"panelTitle\"><font color=\"#FF0000\">Visitor has left site or is unavailable.</font></font>" ;
?>
<table cellspacing=1 cellpadding=0 border=0 width="100%">
  <tr> 
	<td colspan="2">
	  [ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?rand=<? echo $rand ?>&sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>&start=1">back to traffic monitor</a> 
	  ]
	  [ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?action=footprints&rand=<? echo $rand ?>&sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>&ip=<? echo $ip ?>">view footprints</a> ]
	  <font color="#BBBBBB">[ initiate chat ]</font>
	  &nbsp; IP Address: <b><? echo $ip ?></b>
	  </td>
  </tr>
  <tr class="hdash"> 
	<td colspan="2">&nbsp;</td>
  </tr>
</table>

<? if ( !$footprint['ip'] ): ?>
<span class="panelTitle"><font color="#FF0000">Visitor has left site or is unavailable.</font></font>

<? else: ?>
<table cellspacing=1 cellpadding=3 border=0 width="100%">
<form name="form" method="GET" action="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php" OnSubmit="alert('To initiate chat, click on the link below.'); return false">
<input type="hidden" name="action" value="chat">
<input type="hidden" name="rand" value="<? echo $rand ?>">
<input type="hidden" name="sid" value="<? echo $sid ?>">
<input type="hidden" name="l" value="<? echo $l ?>">
<input type="hidden" name="x" value="<? echo $x ?>">
<input type="hidden" name="ip" value="<? echo $ip ?>">
<tr>
	<td align="right" width="70" class="altcolor2"><b>On Page</b></td>
	<td class="altcolor2"><? echo $footprint['url'] ?></td>
</tr>
<tr>
	<td align="right" width="70" class="altcolor2"><b>Duration</b></td>
	<td class="altcolor2"><? echo $duration ?></td>
</tr>
<tr>
	<td align="right" width="70" class="altcolor2"><b>Initiated</b></td>
	<td class="altcolor2"><? echo $total_initiated ?> time(s)</td>
</tr>
<tr>
	<td align="right" width="70" class="altcolor2"><b>Department</b></td>
	<td class="altcolor2"><select name="deptid"><? echo $select_dept ?></select></td>
</tr>
<tr>
	<td align="right" width="70" class="altcolor2"><b>Options</b></td>
	<td class="altcolor2">
		<input type="radio" name="method" value="0"> Instant Chat Pop-up |
		<input type="radio" name="method" value="2" checked> Image Scrolling
	</td>
</tr>
<tr>
	<td align="right" width="70" class="altcolor2"><b>Question</b></td>
	<td class="altcolor2">
		<? if ( count( $canneds ) <= 0 ): ?>
		<a href="JavaScript:open_admin_setup()">Click to Create Initiate Messages</a> - [ <a href="JavaScript:location.reload( true )">reload</a> ]
		<? else: ?>
		<select name="message"><? echo $select_canned ?></select> <a href="JavaScript:open_admin_setup()">Create Initiate Messages</a> - [ <a href="JavaScript:location.reload( true )">reload</a> ]
		<? endif; ?>
	</td>
</tr>
<tr class="altcolor2">
	<td>&nbsp;</td>
	<td><b><? echo $status ?></b></td>
</tr>
</form>
</table>
<? endif; ?>










<?
	elseif ( !$HTTP_SESSION_VARS['session_admin'][$sid]['traffic_monitor'] ):
	$total_active_footprints = ServiceFootprintUnique_get_TotalActiveFootprints( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
?>
<? if ( $can_initiate && $INITIATE ): ?>
<script language="JavaScript">window.status = "" ;</script>
<table cellspacing=1 cellpadding=0 border=0 width="100%">
  <tr> 
	<td colspan="2">
		[ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?counter=<? echo $total_active_footprints ?>& action=open_console&sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>">open traffic monitor</a> ]
		[ <a href="<? echo $BASE_URL ?>/admin/traffic/console_timer.php?sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>&admin_puller.php?counter=0">set refresh rate</a> ]
		<? if ( $admin['op2op'] && file_exists( "$DOCUMENT_ROOT/admin/traffic/ops.php" ) && ( AdminUsers_get_TotalUsers( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) > 1 ) ): ?>
		[ <a href="<? echo $BASE_URL ?>/admin/traffic/ops.php?sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>&admin_puller.php?counter=0">operators</a> ]
		<? endif ; ?>
	</td>
  </tr>
  <tr class="hdash"> 
	<td colspan="2">&nbsp;</td>
  </tr>
</table>
<? else: ?>
	&nbsp;
<? endif ; ?>










<?
	else:
	$footprints = ServiceFootprintUnique_get_ActiveFootprints( $dbh, $x ) ;
	$total_active_footprints = count( $footprints ) ;
	$footprint_hash = Array() ;
	$ip_query = "" ;
	for( $c = 0; $c < count( $footprints ); ++$c )
	{
		$footprint = $footprints[$c] ;
		$ip = $footprint['ip'] ;
		$footprint_hash[$ip] = Array() ;
		$ip_query .= "OR ip = '$ip' " ;
	}
	
	$total_chat_requests = ServiceChat_get_TotalChatRequestsIps( $dbh, $x, $ip_query ) ;
	for ( $c = 0; $c < count( $total_chat_requests ); ++$c )
	{
		$total_chat_request = $total_chat_requests[$c] ;
		$ip = $total_chat_request['ip'] ;
		$footprint_hash[$ip]['chat_requests'] = $total_chat_request['total'] ;
	}
	$total_initiates = ServiceChat_get_TotalInitiatedIps( $dbh, $x, $ip_query ) ;
	for ( $c = 0; $c < count( $total_initiates ); ++$c )
	{
		$total_initiate = $total_initiates[$c] ;
		$ip = $total_initiate['ip'] ;
		$footprint_hash[$ip]['total_initiate'] = $total_initiate['total'] ;
	}

	if ( $admin['console_refresh'] == 10 )
		$refresh_string = "every time there is change in traffic" ;
	else
	{
		$minutes = $admin['console_refresh']/60 ;
		$refresh_string = "every $minutes minute(s)" ;
	}
?>
<script language="JavaScript">
	window.status = "<? echo count( $footprints ) ?> visitors [ monitor set to update <? echo $refresh_string ?> ]" ;
</script>

<table cellspacing=1 cellpadding=0 border=0 width="100%">
  <tr> 
	<td colspan="2">
		<table cellspacing=0 cellpadding=2 border=0>
		<form>
		<tr>
			<td>
				[ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?sid=<? echo $sid ?>&action=open_console&start=1&l=<? echo $l ?>&x=<? echo $x ?>">reload traffic monitor</a> ]
				[ <a href="<? echo $BASE_URL ?>/admin/traffic/console_timer.php?sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>&admin_puller.php?counter=0">set refresh rate</a> ]
				<? if ( $admin['op2op'] && file_exists( "$DOCUMENT_ROOT/admin/traffic/ops.php" ) && ( AdminUsers_get_TotalUsers( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) > 1 ) ): ?>
				[ <a href="<? echo $BASE_URL ?>/admin/traffic/ops.php?sid=<? echo $sid ?>&l=<? echo $l ?>&x=<? echo $x ?>&admin_puller.php?counter=0">operators</a> ] &nbsp;
				<? endif ; ?>
				[ <a href="<? echo $BASE_URL ?>/admin/traffic/admin_puller.php?counter=0&sid=<? echo $sid ?>&action=close_console&start=1&l=<? echo $l ?>&x=<? echo $x ?>">close</a> ]
			</td>
			<td>[ sound:</td>
			<td><font size=1><input type="radio" name="sound" value="on" onClick="switch_sound( 'on' )" <?= ( $HTTP_SESSION_VARS['session_admin'][$sid]['sound'] == "on" ) ? "checked" : "" ?>></td>
			<td>on</td>
			<td> | </td>
			<td><font size=1><input type="radio" name="sound" value="off" onClick="switch_sound( 'off' )" <?= ( $HTTP_SESSION_VARS['session_admin'][$sid]['sound'] == "off" ) ? "checked" : "" ?>></td>
			<td>off ]</td>
		</tr>
		<tr>
			<td colspan=7 align="right"><span class="small"><? echo count( $footprints) ?> visitor(s) on your website &raquo; traffic monitor set to update <? echo $refresh_string ?></td>
		</tr>
		</form>
		</table>
	</td>
  </tr>
  <tr class="hdash"> 
	<td colspan="2">&nbsp;</td>
  </tr>
</table>
<table cellspacing=0 cellpadding=1 border=0 width="100%">
<?
	for ( $c = 0; $c < count( $footprints ); ++$c )
	{
		$footprint = $footprints[$c] ;
		$ip = $footprint['ip'] ;

		$duration = $footprint['updated'] - $footprint['created'] ;

		$minutes = 1 ;
		if ( $duration > 60 )
		{
			$minutes = floor( $duration/60 ) ;
			$duration = $minutes . " min" ;
		}
		else
			$duration = $duration . " sec" ;

		//$hostname = gethostbyaddr( $footprint['ip'] ) ;
		$referinfo = ServiceRefer_get_ReferInfo( $dbh, $x, $footprint['ip'] ) ;
		$numfootprints = ( isset( $referinfo['numfootprints'] ) ) ? $referinfo['numfootprints'] : 0 ;

		$refer_url = "<i>not available</i>" ;
		if ( isset( $referinfo['refer_url'] ) )
		{
			$string_length = strlen( $referinfo['refer_url'] ) ;
			$refer_url = stripslashes( $referinfo['refer_url'] ) ;
			if ( $string_length > 70 )
				$refer_url = wordwrap( $refer_url, 65, "<br>", 1 ) ;
			$refer_url = "<a href=\"$referinfo[refer_url]\" target=\"new\"><font color=\"#000000\">$refer_url</font></a>" ;
		}

		$footprint_url = stripslashes( $footprint['url'] ) ;
		$string_length = strlen( $footprint_url ) ;
		if ( $string_length > 70 )
			$footprint_url = wordwrap( $footprint_url, 65, "<br>", 1 ) ;

		$total_chat_requests = ( isset( $footprint_hash[$ip]['chat_requests'] )  ) ? $footprint_hash[$ip]['chat_requests'] : 0 ;
		$total_initiated = ( isset( $footprint_hash[$ip]['total_initiate'] )  ) ? $footprint_hash[$ip]['total_initiate'] : 0 ;
		
		$class = "altcolor2" ;
		if ( $c % 2 )
			$class = "altcolor3" ;

		$exclude_string = "" ;
		if ( preg_match( "/$footprint[ip]/", $IPNOTRACK ) )
			$exclude_string = "<font color=\"#FF0000\"><b>Note:</b> internal excluded IP</font>" ;

		$tracking_string = "<td class=\"$class\" valign=\"top\">&nbsp;</td>" ;
		if ( $referinfo['trackID'] )
		{
			$trackinfo = ServiceClicks_get_TrackingURLInfoByID( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'], $referinfo['trackID'] ) ;
			$tracking_name = stripslashes( $trackinfo['name'] ) ;
			$tracking_string = "<td bgColor=\"$trackinfo[color]\" width=100 valign=\"top\"><b>Track'it</b><br>$tracking_name</td>" ;
		}
		
		// visitor importance values
		$imp_value = 0 ;
		if ( $referinfo['trackID'] )
			$imp_value += 20 ;
		$imp_value += $total_chat_requests * 3 ;
		$imp_value += $minutes ;

		$percent = $imp_value ;
		if ( $percent > 100 )
			$percent = 100 ;

		$percent_blank = 100 - $percent ;

		print "
			<tr onMouseOver=\"this.bgColor='#C6D6FD';\" onMouseOut=\"this.bgColor='#FFFFFF';\"><td><table cellspacing=0 cellpadding=1 border=0 width=\"100%\">
				<tr class=\"$class\">
					<td width=\"105\" valign=\"top\">$ip<br><img src=\"$BASE_URL/images/spacer.gif\" width=100 height=1></td>
					<td><b>On Page: </b> <a href=\"$footprint[url]\" target=new><font color=\"#000000\">$footprint_url</font></a></td>
					<td>&nbsp;</td>
				</tr>
				<tr class=\"$class\">
					$tracking_string
					<td>
						<b>Requested Chat:</b> $total_chat_requests &nbsp; <b>Operator Initiated Chat:</b> $total_initiated
						<br>
						<b>Refer URL:</b> $refer_url<br>
						<b>Options: </b>[ <a href=\"$BASE_URL/admin/traffic/admin_puller.php?action=footprints&rand=$rand&sid=$sid&l=$l&x=$x&ip=$ip\">view footprints</a> ]
						[ <a href=\"$BASE_URL/admin/traffic/admin_puller.php?action=chat&rand=$rand&sid=$sid&l=$l&x=$x&ip=$ip\">initiate chat</a> ] $exclude_string
					</td>
					<td align=\"right\" valign=\"top\"><b>Duration</b><br>$duration</td>
				</tr>
			</td></tr></table></td></tr>
		" ;
	}

	// output blank message if no traffic
	if ( $total_active_footprints <= 0 )
		print "<tr><td><big><b>Currently no traffic at this time...</td></tr>" ;
?>
</table>
<br><br><br>

<?
	if ( !$start && ( count( $footprints ) > 0 ) && ( $HTTP_SESSION_VARS['session_admin'][$sid]['sound'] == "on" ) && ( $total_active_footprints != $HTTP_SESSION_VARS['session_admin'][$sid]['active_footprints'] ) ):
?>
	<EMBED src="../../sounds/doorbell.wav" width=0 height=0 autostart=true loop=false>
<? endif ; ?>
<? $HTTP_SESSION_VARS['session_admin'][$sid]['active_footprints'] = $total_active_footprints ; ?>


<? endif ; ?>


</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>