<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: index.php" ) ; exit ; }
	if ( !file_exists( "../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("../web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/update.php") ;
	$section = 6;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)

	$nav_line = '<a href="options.php" class="nav">:: Home</a>';
?>
<?

	// initialize
	$action = "" ;
	$success = 0 ;
	$error_mesg = "" ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "12" ;
	else
		$text_width = "9" ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_POST_VARS['success'] ) ) { $success = $HTTP_POST_VARS['success'] ; }
	if ( isset( $HTTP_GET_VARS['success'] ) ) { $success = $HTTP_GET_VARS['success'] ; }
?>
<?
	// functions
?>
<?
	// conditions
	if ( $action == "update_polling" )
	{
		$action = "polling" ;
		$COMPANY_NAME = addslashes( $COMPANY_NAME) ;
		$conf_string = "0LEFT_ARROW0?
			\$LOGO = '$LOGO' ;
			\$COMPANY_NAME = '$COMPANY_NAME' ;
			\$SUPPORT_LOGO_ONLINE = '$SUPPORT_LOGO_ONLINE' ;
			\$SUPPORT_LOGO_OFFLINE = '$SUPPORT_LOGO_OFFLINE' ;
			\$SUPPORT_LOGO_AWAY = '$SUPPORT_LOGO_AWAY' ;
			\$VISITOR_FOOTPRINT = '$VISITOR_FOOTPRINT' ;
			\$TEXT_COLOR = '$TEXT_COLOR' ;
			\$FRAME_COLOR = '$FRAME_COLOR' ;
			\$LINK_COLOR = '$LINK_COLOR' ;
			\$ALINK_COLOR = '$ALINK_COLOR' ;
			\$VLINK_COLOR = '$VLINK_COLOR' ;
			\$CLIENT_COLOR = '$CLIENT_COLOR' ;
			\$ADMIN_COLOR = '$ADMIN_COLOR' ;
			\$CHAT_REQUEST_BACKGROUND = '$CHAT_REQUEST_BACKGROUND' ;
			\$CHAT_BOX_BACKGROUND = '$CHAT_BOX_BACKGROUND' ;
			\$CHAT_BOX_TEXT = '$CHAT_BOX_TEXT' ;
			\$POLL_TIME = '$HTTP_POST_VARS[polltime]' ;
			\$INITIATE = '$INITIATE' ;
			\$INITIATE_IMAGE = '$INITIATE_IMAGE' ;
			\$IPNOTRACK = '$IPNOTRACK' ;
			\$LANG_PACK = '$LANG_PACK' ;?0RIGHT_ARROW0" ;

		$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
		$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
		$fp = fopen ("../web/$session_setup[login]/$session_setup[login]-conf-init.php", "wb+") ;
		fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
		fclose( $fp ) ;

		$POLL_TIME = $HTTP_POST_VARS['polltime'] ;
		$success = 1 ;
	}
	else if ( $action == "update_polling_type" )
	{
		/*
			legend:
				0 = set order
				1 = round-robin
				2 = random
		*/
		AdminASP_update_TableValue( $dbh, $session_setup['aspID'], "admin_polling_type", $HTTP_POST_VARS['type'] ) ;
		$HTTP_SESSION_VARS['session_setup']['admin_polling_type'] = $HTTP_POST_VARS['type'] ;
		HEADER( "location: chatprefs.php?action=polling_type&success=1" ) ;
		exit ;
	}
?>
<? include_once("./header.php") ; ?>
<script language="JavaScript">
<!--
	function add_ip()
	{
		if ( ( document.ip.ip1.value == "" ) || ( document.ip.ip2.value == "" )
			|| ( document.ip.ip3.value == "" ) || ( document.ip.ip4.value == "" ) )
			alert( "IP is Invalid." ) ;
		else if ( ( document.ip.ip1.value > 255 ) || ( document.ip.ip2.value > 255 )
			|| ( document.ip.ip3.value > 255 ) || ( document.ip.ip4.value > 255 ) )
			alert( "Each IP value cannot be greater then 255." ) ;
		else
		{
			if ( confirm( "Don't track page view data and footprints for this IP?" ) )
				document.ip.submit() ;
		}
	}

	function do_remove_ip( index )
	{
		if ( index < 0 )
			alert( "Please select an IP to remove from list." ) ;
		else
		{
			if ( confirm( "Remove this IP from exclude list?" ) )
				document.ip_excluded.submit() ;
		}
	}

	function update_tracking()
	{
		if ( confirm( "Are you sure?" ) )
			document.tracking.submit() ;
	}

	function update_polling()
	{
		if ( document.polling.polltime.value < 20 )
			alert( "Must be at LEAST 20 seconds or more." ) ;
		else
			document.polling.submit() ;
	}

	function do_alert()
	{
		<? if ( $success ) { print "		alert( 'Success!' ) ;\n" ; } ?>
	}
//-->
</script>

<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->


<? if ( $action == "polling" ): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td height="350" valign="top"> <p><span class="title">Chat Preferences: Request 
	  Polling Time</span><br>
	  When a visitor makes a request, the request will be sent to the 
	  least active online support person of that department. </p>
	<ul>
	  <li>If the support person does not answer the call within the specified 
		time (below), the request will then automatically be polled to 
		the next online support person of that department.</li>
	  <li>If the call is not taken from ANY of the online support person, 
		the call will be directed to the &quot;leave a message&quot; form. 
	  </li>
	</ul>
	<form method="POST" action="chatprefs.php" name="polling">
	  <input type="hidden" name="action" value="update_polling">
	  <p> Must be at LEAST 20 seconds or more, 30 is recommended (keep 
		in mind, it takes time to read the question from the visitor).<br>
		<br>
		<input type="text" name="polltime" size=3 maxlength=3 style="width:30px;" onKeyPress="return numbersonly(event)" value="<?= ( $POLL_TIME ) ? $POLL_TIME : "30" ?>">
		seconds 
	  <p> 
		<input type="button" class="mainButton" value="Update Polling" OnClick="update_polling()">
	  
	</form>
	
  </td>


<? elseif ( $action == "polling_type" ): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr>
	<form method="POST" action="chatprefs.php" name="polling">
	<input type="hidden" name="action" value="update_polling_type">
  <td height="350" valign="top"> <p><span class="title">Chat Preferences: Request 
	  Polling Type</span><br>
	  You can set how the call is to be routed to operators and which operator should gets the call first.</p>
	<ul>
		<table cellspacing=0 cellpadding=3 border=0>
		<tr>
			<td><input type="radio" name="type" value="0" <?= ( $session_setup['admin_polling_type'] == 0 ) ? "checked" : "" ?>></td>
			<td> Defined order that is set in the <a href="adduser.php">operator setup area</a>.</td>
		</tr>
		<tr>
			<td><input type="radio" name="type" value="1" <?= ( $session_setup['admin_polling_type'] == 1 ) ? "checked" : "" ?>></td>
			<td> Round-Robin style: Operator that hasn't taken a call the longest gets the current call.</td>
		</tr>
		<tr>
			<td><input type="radio" name="type" value="2" <?= ( $session_setup['admin_polling_type'] == 2 ) ? "checked" : "" ?>></td>
			<td> Select operator randomly.</td>
		</tr>
		<!-- <tr>
			<td><input type="radio" name="type" value="3" <?= ( $session_setup['admin_polling_type'] == 3 ) ? "checked" : "" ?>></td>
			<td> First-Come-First-Serve: Chat request displays on ALL online operators' windows.  Call routs to the first operator who takes the request.</td>
		</tr> -->
		</table>
	</ul>
	  <p>* There is a final automated load balancing check AFTER the above polling step (except for First-Come-First-Serve).
	  <p> 
		<input type="submit" class="mainButton" value="Update Polling">
	  
	</form>
	
  </td>






<? elseif ( $action == "window_type" ): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr>
	<form method="POST" action="chatprefs.php" name="polling">
	<input type="hidden" name="action" value="update_window_type">
  <td height="350" valign="top"> <p><span class="title">Chat Preferences: Chat Window Type</span><br>
	  Set your visitor's chat window type (open a new window or in a frame).</p>
	<ul>
		<table cellspacing=0 cellpadding=3 border=0>
		<tr>
			<td><input type="radio" name="type" value="0" <?= ( $session_setup['admin_polling_type'] == 0 ) ? "checked" : "" ?>></td>
			<td> Open chat in a new window.<br>
				<b>Benefits</b>
				<li> coming soon...<br>
			</td>
		</tr>
		<tr>
			<td><input type="radio" name="type" value="1" <?= ( $session_setup['admin_polling_type'] == 1 ) ? "checked" : "" ?>></td>
			<td> Open chat in a frame inside the current browser window.<br>
				<b>Benefits</b>
				<li> coming soon...<br>
			</td>
		</tr>
		</table>
	</ul>
	  <p> 
		<input type="submit" class="mainButton" value="Update Polling">
	  
	</form>
	
  </td>





<? else: ?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
    <td width="100%" height="350" valign="top"> 
	  <p><span class="title">Chat Preferences</span><br></p>
	  <p>
		<!-- Set your visitor's chat window type (open a new window or in a frame).<br>
		<big><li> <strong><a href="chatprefs.php?action=window_type">Chat Window Type</a></strong></big></p> -->
		Set your chat polling timeout value (time it takes before a call is passed to another operator).<br>
		<big><li> <strong><a href="chatprefs.php?action=polling">Chat Request Polling Time</a></strong></big></p>
		Set your chat polling type (defined order, round-robin style, random, etc).<br>
		<big><li> <strong><a href="chatprefs.php?action=polling_type">Chat Request Polling Type</a></strong></big></p>
	  </td>


<? endif ;?>
  <!-- <td height="350" align="center" style="background-image: url(../images/g_survey_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td> -->
  <td height="350" align="center" style="background-image: url(../images/g_prefs_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
 </table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<? include_once( "./footer.php" ) ; ?>