<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$action = $final_switch = $display_timer = $timer = $checked_son = $checked_soff = $admin_id = "" ;
	// set default
	$value = "on" ;
	$session_chat = $HTTP_SESSION_VARS['session_chat'] ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : $HTTP_POST_VARS['sid'] ;
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_POST_VARS['final_switch'] ) ) { $final_switch = $HTTP_POST_VARS['final_switch'] ; }
	if ( isset( $HTTP_GET_VARS['final_switch'] ) ) { $final_switch = $HTTP_GET_VARS['final_switch'] ; }
	if ( isset( $HTTP_POST_VARS['value'] ) ) { $value = $HTTP_POST_VARS['value'] ; }
	if ( isset( $HTTP_GET_VARS['value'] ) ) { $value = $HTTP_GET_VARS['value'] ; }
	if ( isset( $HTTP_POST_VARS['timer'] ) ) { $timer = $HTTP_POST_VARS['timer'] ; }
	if ( isset( $HTTP_GET_VARS['timer'] ) ) { $timer = $HTTP_GET_VARS['timer'] ; }
	if ( isset( $HTTP_POST_VARS['display_timer'] ) ) { $display_timer = $HTTP_POST_VARS['display_timer'] ; }
	if ( isset( $HTTP_GET_VARS['display_timer'] ) ) { $display_timer = $HTTP_GET_VARS['display_timer'] ; }
	if ( isset( $HTTP_GET_VARS['admin_id'] ) ) { $admin_id = $HTTP_GET_VARS['admin_id'] ; }

	if ( !file_exists( "./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;	
	include_once("./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Util.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/Util.php") ;
?>
<?
	// initialize
	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "4" ;
	else
		$text_width = "3" ;
	
	// we use $rand to prevent loading from cached pages
	mt_srand ((double) microtime() * 1000000) ;
	$rand = mt_rand() ;

	if ( !$final_switch )
		$final_switch = "on" ;
?>
<?
	// functions
?>
<?
	// conditions
	if ( $action == "start" )
	{
		$admin = AdminUsers_get_UserInfo( $dbh, $admin_id, $HTTP_SESSION_VARS['session_chat'][$sid]['aspID'] ) ;
		$department = AdminUsers_get_DeptInfo( $dbh, $session_chat[$sid]['deptid'], $HTTP_SESSION_VARS['session_chat'][$sid]['aspID'] ) ;

		$date = date( "D m/d/y h:i a", time() ) ;
		$greeting = preg_replace( "/%%user%%/", $session_chat[$sid]['visitor_name'], Util_Format_ConvertSpecialChars( $department['greeting'] ) ) ;
		$greeting = preg_replace( "/%%date%%/", $date, $greeting ) ;
		$greeting = preg_replace( "/([\r\n])/", "", nl2br( $greeting ) ) ;

		// put the visitor's fresh chat session AFTER operator has picked up the call
		$transcript_file = $session_chat[$sid]['chatfile_transcript']." file does not exist.  Exiting..." ;
		if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/".$session_chat[$sid]['chatfile_transcript'] ) )
			$transcript_file = file( "$DOCUMENT_ROOT/web/chatsessions/".$session_chat[$sid]['chatfile_transcript'] ) ;
		$transcript = $transcript_file[0] ;

		// reset admin_id in session to new admin (incase first admin hit busy)
		$HTTP_SESSION_VARS['session_chat'][$sid]['admin_id'] = $session_chat[$sid]['admin_id'] = $admin['userID'] ;
		$HTTP_SESSION_VARS['session_chat'][$sid]['admin_name'] = $session_chat[$sid]['admin_name'] = stripslashes( $admin['name'] ) ;

		UtilChat_AppendToChatfile( $session_chat[$sid]['chatfile_get'], $transcript ) ;
	}
	else if ( $action == "switch_sound" )
	{
		$HTTP_SESSION_VARS['session_chat'][$sid]['sound'] = $value ;
	}

	if ( $HTTP_SESSION_VARS['session_chat'][$sid]['sound'] == "on" )
		$checked_son = "checked" ;
	else
		$checked_soff = "checked" ;
?>
<html>
<head>
<title> Chat [options] </title>

<link rel="Stylesheet" href="./css/base.css">

<script language="JavaScript">
<!--
	var NS4 = (document.layers) ? 1 : 0;
	var IE4 = (document.all) ? 1 : 0;
	var W3 = (document.getElementById && !IE4) ? 1 : 0;

	var start ;
	var timer_switch = 0 ;
	var final_switch = "<? echo $final_switch ?>" ;
	var display_timer = "" ;
	var current_switch_value = '<? echo $value ?>' ;

	var temp = setTimeout("window.parent.window.toggle_iswriting(0)", 1000) ;

	function switch_sound( switch_value )
	{
		var the_date = new Date() ;
		unique = the_date.getTime() ;
		if ( !switch_value )
		{
			switch_value = current_switch_value ;
		}
		url = "chat_options.php?action=switch_sound&sid=<? echo $sid ?>&timer="+unixtime+"&value="+switch_value+"&final_switch="+final_switch+"&display_timer="+display_timer+"&null="+unique ;
		location.href = url ;
	}

	function start_timer( initial_value )
	{
		timer_switch = 1 ;
		if ( initial_value )
			unixtime = initial_value ;
		else
		{
			start = new Date() ;
			unixtime = start.getTime() ;
		}
		timer_cycle() ;
	}

	function stop_timer()
	{
		timer_switch = 0 ;
		final_switch = "off" ;
	}

	function timer_cycle(){
		// check to make sure it supports layers
		if ( !NS4 && !IE4 && !W3 )
			return false;

		if ( final_switch == "on" )
		{
			now = new Date() ;
			// let's start at 0 so we can increase each second
			the_timer = new Date( now.getTime() - unixtime ) ;
			minutes = the_timer.getMinutes() ;
			seconds = the_timer.getSeconds() ;
			// tack on 0 if on digit
			if ( minutes <= 9 ) minutes = "0" + minutes ;
			if ( seconds <= 9 ) seconds = "0" + seconds ;

			display_timer = minutes + ":" + seconds ;
			document.form.timer.value = display_timer ;

			// call timer each second so we can see the cycle
			if ( timer_switch && ( final_switch == "on" ) )
				var temp = setTimeout( "timer_cycle()", 1000 ) ;
		}
		else
		{
			if ( display_timer == "" )
				display_timer = '<? echo $display_timer ?>' ;
			document.form.timer.value = display_timer ;
		}
	}

	function do_toggle(menuName)
	{
		toggle_write('Lwrite', 0) ;
		toggle_write('Lwriteno', 0) ;
		toggle_write(menuName, 1) ;
	}

	function toggle_write( menuName, flag )
	{
		if(flag == 1)
		{
			//alert( 'showit' ) ;
			if(NS4){ document.layers[menuName].visibility = "show"; }
			else if(IE4){ document.all[menuName].style.visibility = "visible"; }
			else { document.getElementById(menuName).visibility = "visible"; }
		}
		else
		{
			if(NS4){ document.layers[menuName].visibility = "hide"; }
			else if(IE4){ document.all[menuName].style.visibility = "hidden"; }
			else{ document.getElementById(menuName).visibility = "hidden"; }
		}
	}
//-->
</script>

</head>
<body bgColor="<? echo $CHAT_REQUEST_BACKGROUND ?>" text="<? echo $TEXT_COLOR ?>" link="<? echo $LINK_COLOR ?>" alink="<? echo $ALINK_COLOR ?>" vlink="<? echo $VLINK_COLOR ?>" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" onLoad="start_timer( '<? echo $timer ?>' )">
<center>
<span class="smalltxt">
<table cellspacing=0 cellpadding=1 border=0>
<form name="form">
<tr>
	<td width="120" align="left" nowrap><span class="smalltxt">
		<div id="Lwrite" name="Lwrite" STYLE="POSITION: relative; Z-INDEX: 20; VISIBILITY: hidden;"><?= ( $session_chat[$sid]['isadmin'] && !$session_chat[$sid]['op2op'] ) ? $session_chat[$sid]['visitor_name'] :$session_chat[$sid]['admin_name'] ?> is typing ...</div>
		<div id="Lwriteno" name="Lwriteno" STYLE="POSITION: relative; Z-INDEX: 20; VISIBILITY: hidden;">&nbsp;</div>
	</td>
	<td span class="smalltxt">timer: </td>
	<td span class="smalltxt"><font size=1><input type="text" name="timer" class="input" size="<? echo $text_width ?>" maxlength="5" disabled></td>
	<td><span class="smalltxt">&nbsp;&nbsp;</td>
	<td><span class="smalltxt">&nbsp;[&nbsp;</td>
	<td><span class="smalltxt">sound: </td>
	<td><span class="smalltxt"><font size=1><input type="radio" name="sound" value="on" <? echo $checked_son ?> onClick="switch_sound( 'on' )"></td>
	<td><span class="smalltxt">on</td>
	<td><span class="smalltxt"> | </td>
	<td><span class="smalltxt"><font size=1><input type="radio" name="sound" value="off" <? echo $checked_soff ?> onClick="switch_sound( 'off' )"></td>
	<td><span class="smalltxt">off</td>
	<td><span class="smalltxt">&nbsp;]&nbsp;</td>
</tr>
</form>
</table>
</span>
</center>

</body>
</html>