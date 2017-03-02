<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$sid = $action = $deptid = $order_by = $sort_by = $page = $error = $chat_session = $search_string = $ave_rating_string = "" ;
	$updated = $winapp = $x = 0 ;
	if ( isset( $HTTP_POST_VARS['winapp'] ) ) { $winapp = $HTTP_POST_VARS['winapp'] ; }
	if ( isset( $HTTP_GET_VARS['winapp'] ) ) { $winapp = $HTTP_GET_VARS['winapp'] ; }
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_POST_VARS['deptid'] ) ) { $deptid = $HTTP_POST_VARS['deptid'] ; }
	if ( isset( $HTTP_GET_VARS['deptid'] ) ) { $deptid = $HTTP_GET_VARS['deptid'] ; }
	if ( isset( $HTTP_POST_VARS['order_by'] ) ) { $order_by = $HTTP_POST_VARS['order_by'] ; }
	if ( isset( $HTTP_GET_VARS['sort_by'] ) ) { $sort_by = $HTTP_GET_VARS['sort_by'] ; }
	if ( isset( $HTTP_POST_VARS['page'] ) ) { $page = $HTTP_POST_VARS['page'] ; }
	if ( isset( $HTTP_GET_VARS['page'] ) ) { $page = $HTTP_GET_VARS['page'] ; }
	if ( isset( $HTTP_POST_VARS['chat_session'] ) ) { $chat_session = $HTTP_POST_VARS['chat_session'] ; }
	if ( isset( $HTTP_GET_VARS['chat_session'] ) ) { $chat_session = $HTTP_GET_VARS['chat_session'] ; }
	if ( isset( $HTTP_POST_VARS['search_string'] ) ) { $search_string = $HTTP_POST_VARS['search_string'] ; }
	if ( isset( $HTTP_GET_VARS['search_string'] ) ) { $search_string = $HTTP_GET_VARS['search_string'] ; }
	if ( isset( $HTTP_POST_VARS['sid'] ) ) { $sid = $HTTP_POST_VARS['sid'] ; }
	if ( isset( $HTTP_GET_VARS['sid'] ) ) { $sid = $HTTP_GET_VARS['sid'] ; }
	if ( isset( $HTTP_POST_VARS['x'] ) ) { $x = $HTTP_POST_VARS['x'] ; }
	if ( isset( $HTTP_GET_VARS['x'] ) ) { $x = $HTTP_GET_VARS['x'] ; }

	if( !$sid )
	{
		HEADER( "location: ../index.php?winapp=$winapp&e=2" ) ;
		exit ;
	}

	include_once("../web/conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/API/Util.php") ;
	include_once("$DOCUMENT_ROOT/API/Util_Page.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/update.php") ;
	include_once("$DOCUMENT_ROOT/API/Transcripts/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Logs/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Logs/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Spam/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Spam/put.php") ;
	include_once("$DOCUMENT_ROOT/API/Spam/remove.php") ;

	if ( !isset( $HTTP_SESSION_VARS['session_admin'] ) || !isset( $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ) || !file_exists( "../web/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		// called from WinApp - since it won't register the session, read from cookie and reset
		if ( $action == "set" )
		{
			if ( !isset( $HTTP_SESSION_VARS['session_admin'] ) )
			{
				session_register( "session_admin" ) ;
				$HTTP_SESSION_VARS['session_admin'] = ARRAY() ;
			}

			$aspinfo = AdminASP_get_UserInfo( $dbh, $x ) ;
			$admin = AdminUsers_get_UserInfoBySession( $dbh, $x, $sid ) ;

			// reset $sid so it registered online if launched admin console again
			$sid  = time() ;
			$HTTP_SESSION_VARS['session_admin'][$sid] = ARRAY() ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['screen_name'] = $admin['login'] ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] = $admin['userID'] ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['requests'] = 0 ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] = $aspinfo['aspID'] ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] = $aspinfo['login'] ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['active_footprints'] = 0 ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['winapp'] = 0 ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['close_timer'] = 0 ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['traffic_monitor'] = 0 ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['available_status'] = 1 ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['sound'] = "on" ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['request_ids'] = "" ;
			$HTTP_SESSION_VARS['session_admin'][$sid]['traffic_timer'] = $admin['console_refresh'] ;

			$url = "jump.php?sid=$sid" ;
			if ( isset( $HTTP_GET_VARS['ip'] ) )
			{
				// set $action to set again for flag on condition below
				$url = "jump.php?sid=$sid&action=set&ip=$HTTP_GET_VARS[ip]" ;
			}
			HEADER( "location: $url" ) ;
			exit ;
		}
		else
		{
			HEADER( "location: ../index.php?winapp=$winapp&e=3" ) ;
			exit ;
		}
	}
	
	include_once("../web/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."-conf-init.php") ;
?>
<?
	// initialize
	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "20" ;
		$text_width_long = "60" ;
		$textbox_width = "80" ;
	}
	else
	{
		$text_width = "10" ;
		$text_width_long = "30" ;
		$textbox_width = "40" ;
	}

	// check to make sure session is set.  if not, user is not authenticated.
	// send them back to login
	if ( !$HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] )
	{
		HEADER( "location: ../index.php?winapp=$winapp&e=4" ) ;
		exit ;
	}
	$now = time() ;

	// update all admins status to not available if they have been idle
	AdminUsers_update_IdleAdminStatus( $dbh, $admin_idle ) ;
	ServiceChat_remove_CleanChatSessions( $dbh ) ;

	if ( $action == "edit_password" )
		$section = 3 ;
	else if ( $action == "canned_responses" )
		$section = 1 ;
	else if ( $action == "canned_commands" )
		$section = 2 ;
	else
		$section = 5 ;

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)

	$nav_line = "&nbsp;";
?>
<?
	// functions
?>
<?
	// conditions
	if ( $action == "update_password" )
	{
		$admin = AdminUsers_get_UserInfo( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;

		if ( md5( $HTTP_POST_VARS['curpassword'] ) == $admin['password'] )
		{
			AdminUsers_update_Password( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $HTTP_POST_VARS['newpassword'] ) ;
			$updated = 1 ;
		}
		else
		{
			$action = $HTTP_POST_VARS['prev_action'] ;
			$error = "Your current password is invalid." ;
		}
		$action = "edit_password" ;
	}
	else if ( $action == "update_poll" )
	{
		AdminUsers_update_UserValue( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], "console_close_min", $HTTP_POST_VARS['console_close_min'] ) ;
		$action = "edit_password" ;
		$updated = 1 ;
	}
	else if ( ( $action == "exclude_ip" ) || ( ( $action == "set" ) && ( isset( $HTTP_GET_VARS['ip'] ) ) ) )
	{
		$action = "spam" ;
		if ( isset( $HTTP_GET_VARS['ip'] ) )
			$new_ip = $HTTP_GET_VARS['ip'] ;
		else
			$new_ip = $HTTP_POST_VARS['ip1'].".".$HTTP_POST_VARS['ip2'].".".$HTTP_POST_VARS['ip3'].".".$HTTP_POST_VARS['ip4']." " ;
		ServiceSpam_put_IP( $dbh, $new_ip, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
		$updated = 1 ;
	}
	else if ( $action == "remove_excluded_ip" )
	{
		$action = "spam" ;
		ServiceSpam_remove_IP( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'], $HTTP_POST_VARS['excluded_ips'] ) ;
	}

	$admin = AdminUsers_get_UserInfo( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
	$deptinfo = AdminUsers_get_DeptInfo( $dbh, $deptid, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
	$can_initiate = AdminUsers_get_CanUserInitiate( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ) ;
	$console_window_height = 260 ;
	if ( $can_initiate )
		$console_window_height = 360 ;

	$rating_hash = Array() ;
	$rating_hash[4] = "Excellent" ;
	$rating_hash[3] = "Very Good" ;
	$rating_hash[2] = "Good" ;
	$rating_hash[1] = "Needs Improvement" ;
	$rating_hash[0] = "no rating yet" ;

	$ave_rating_string = $rating_hash[$admin['rate_ave']] ;
	// revert to blank for transcript
	$rating_hash[0] = "&nbsp;" ;
?>
<? include("./header.php") ; ?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<script language="JavaScript">
<!--
	// do everything here before it loads
	<?
		if ( $HTTP_SESSION_VARS['session_admin'][$sid]['winapp'] == 1 )
			print "		winapp() ;\n" ;
	?>
	
	function open_admin()
	{
		var date = new Date() ;
		var winname = date.getTime() ;
		url = "admin_consol.php?sid=<? echo $sid ?>" ;
		newwin = window.open(url, "operator", "scrollbars=yes,menubar=no,resizable=1,location=no,width=590,status=0,height=<? echo $console_window_height ?>") ;
		newwin.focus() ;
		//location.href = "index.php?sid=<? echo $sid ?>&deptid=<? echo $deptid ?>" ;
	}

	function do_search()
	{
		string = replace( document.form.search_string.value, " ", "" ) ;
		if ( string.length < 3 )
			alert( "Search string must be AT LEAST 3 characters." )
		else
			document.form.submit() ;
	}

	function do_submit_poll()
	{
		document.form_poll.submit() ;
	}

	function check_console_value( minutes )
	{
		if ( minutes == "" )
			document.form_poll.console_close_min.value = 0 ;
	}

	function do_submit_pass()
	{
		if ( ( document.form.newpassword.value == "" ) || ( document.form.curpassword.value == "" ) )
			alert( "All fields must be supplied." ) ;
		else if ( document.form.newpassword.value != document.form.vnewpassword.value )
			alert( "Passwords do not match." ) ;
		else
			document.form.submit() ;
	}

	function winapp()
	{
		url = "admin_consol.php?sid=<? echo $sid ?>" ;
		location.href = url ;
	}

	function view_transcript( chat_session )
	{
		url = "<? echo $BASE_URL ?>/admin/view_transcript.php?chat_session="+chat_session+"&x=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ?>&l=<? echo $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ?>" ;
		newwin = window.open(url, "transcript", "scrollbars=yes,menubar=no,resizable=1,location=no,width=500,height=550") ;
		newwin.focus() ;

	}

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
			if ( confirm( "Block this IP from using the Live Support system?" ) )
				document.ip.submit() ;
		}
	}

	function do_remove_ip( index )
	{
		if ( index < 0 )
			alert( "Please select an IP to remove from list." ) ;
		else
		{
			if ( confirm( "Remove this IP from Spam Block list?" ) )
				document.ip_excluded.submit() ;
		}
	}
//-->
</script>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->


<?
	if ( $action == "edit_password" ):
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr> 
	<td width="100%" height="350" valign="top"> <p><span class="title">Preferences</span><br>
		Setup PHP Live! operator preferences.</p>
	  <p><strong>Console timeout:</strong></p>
	  <ul>
		<li> When you set your admin request console to Offline, the window will 
		  automatically close (for security and to limit system usage).</li>
		<li> Switching to <i>Offline</i> status is helpful when you step away 
		  from your computer for a short time. </li>
	  </ul>
	  
		
	  <table cellspacing=1 cellpadding=1 border=0>
		<form method="POST" action="index.php" name="form_poll">
		<input type="hidden" name="action" value="update_poll">
		<input type="hidden" name="sid" value="<? echo $sid ?>">
		<input type="hidden" name="deptid" value="<? echo $deptid ?>">
		  <tr> 
			<td>Time to wait until the <i>Offline</i> console automatically closes:</td>
			<td> <font size=2> 
			  <input type="text" name="console_close_min" size="3" maxlength="3" value="<?= ( $admin['console_close_min'] ) ? $admin['console_close_min'] : $HTTP_POST_VARS['console_close_min'] ?>" OnBlur="check_console_value(this.value)" onKeyPress="return numbersonly(event)">
			  </font> minutes </td>
		  </tr>
		  <tr> 
			<td>&nbsp; </td>
			<td><input type="button" value="Submit" class="mainButton" OnClick="do_submit_poll()"></td>
		  </tr></form>
		</table>
	  
	  <br>
	  <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td class="hdash">&nbsp;</td>
		</tr>
	  </table>
	  <p><strong>Change Your Password: <font color="#FF0000"><? echo $error ?></font></strong>
	<table cellspacing=1 cellpadding=1 border=0>
	<form method="POST" action="index.php" name="form">
	<input type="hidden" name="action" value="update_password">
	<input type="hidden" name="prev_action" value="<? echo $action ?>">
	<input type="hidden" name="sid" value="<? echo $sid ?>">
	<input type="hidden" name="deptid" value="<? echo $deptid ?>">
	  <tr> 
		<td align="right">Current Password</td>
		<td><input type="password" style="width:120px" name="curpassword" size="<? echo $text_width ?>" maxlength="15"></td>
	  </tr>
	  <tr> 
		<td align="right">New Password</td>
		<td><input type="password" style="width:120px" name="newpassword" size="<? echo $text_width ?>" maxlength="15"></td>
	  </tr>
	  <tr> 
		<td align="right">Verify New Password</td>
		<td><input type="password" style="width:120px" name="vnewpassword" size="<? echo $text_width ?>" maxlength="15"></td>
	  </tr>
	  <tr> 
		<td>&nbsp;</td>
		<? if ( md5( "demo" ) == $admin['password'] ) : ?>
		<td><big><b>Password change has been disabled for Demo operator.</b></big></td>
		<? else: ?>
		<td><input type="button" value="Update Password" class="mainButton" OnClick="do_submit_pass()"></td>
		<? endif ; ?>
	  </tr>
	</form>
  </table>
</p></td>
  <td style="background-image: url(../images/g_prefs_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
 </table>













<?
	elseif ( $action == "spam" ):
	ServiceSpam_remove_CleanOldIPs( $dbh ) ;
	$ips = ServiceSpam_get_IPs( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
  <tr> 
	<td width="100%" height="350" valign="top"> <p><span class="title">Spam Blocking</span><br>
		Block spammers from requesting Live Support.</p>
	  <ul>
		<li> Block IPs from requesting Live Support to limit abuse of system.  Blocked IPs will be automatically cleared (unblocked) after 3 days.</li>
		<li> Blocked IPs are shared and active throughout all departments and operators.</li>
		<li> <span class="hilight">Visitors from blocked IPs will always see an Offline status.<span></li>
	  </ul>
	  
		
	<table border="0" cellpadding="1" cellspacing="2">
	  <form method="POST" action="index.php" name="ip_excluded">
		<tr>
		  <td colspan="4" valign="top"><strong>Block IP from System</strong> </td>
		  <input type="hidden" name="action" value="remove_excluded_ip">
		  <input type="hidden" name="sid" value="<? echo $sid ?>">
		  <input type="hidden" name="deptid" value="<? echo $deptid ?>">
		  <td width="300" rowspan="3" align="center" valign="top">
			<select name="excluded_ips" size=5 style="width:200;font-size:12px" width="200">
			<?
				for( $c = 0; $c < count( $ips ); ++$c )
				{
					$ip = $ips[$c] ;
					print "<option value=\"$ip[ip]\">$ip[ip]</option>" ;
				}
			?>
			</select> <br>
			[<a href="JavaScript:do_remove_ip(document.ip_excluded.excluded_ips.selectedIndex)">remove 
			SELECTED ip from list</a>]</td>
		</tr>
	  </form>
	  <form method="POST" action="index.php" name="ip">
		<input type="hidden" name="action" value="exclude_ip">
		<input type="hidden" name="sid" value="<? echo $sid ?>">
		<input type="hidden" name="deptid" value="<? echo $deptid ?>">
		<tr> 
		  <td valign="top"> <input type="text" name="ip1" size=3 maxlength=3 style="width:30px;" onKeyPress="return numbersonly(event)"></td>
		  <td valign="top"><input type="text" name="ip2" size=3 maxlength=3 style="width:30px;" onKeyPress="return numbersonly(event)"></td>
		  <td valign="top"><input type="text" name="ip3" size=3 maxlength=3 style="width:30px;" onKeyPress="return numbersonly(event)"></td>
		  <td valign="top"><input type="text" name="ip4" size=3 maxlength=3 style="width:30px;" onKeyPress="return numbersonly(event)"></td>
		</tr>
		<tr> 
		  <td colspan="4" valign="top"> 
			<input type="button" class="mainButton" value="Block IP Address" OnClick="add_ip()">
		  </td>
		</tr>
	  </form>
	</table>

</p></td>
  <td style="background-image: url(../images/g_prefs_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
 </table>



















<? else: ?>
<table width="100%" border="0" cellspacing="15" cellpadding="0">
  <tr>

    <td width="100%" rowspan="3" valign="top">
	<form>
	<p><span class="title">Go ONLINE -></span> <input type="button" value="Launch Monitor Request Window" OnClick="open_admin()" style="background-color : #E2E2E2; font-weight : bold; font-size: 16px; cursor: hand;">
	<p>
	  From here you can administrate your PHP Live! settings and 
	  review previous session transcripts.
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr> 
		<td class="hdash">&nbsp;</td>
	  </tr>
	</table>
	</form>

	<form name=dept_select><p>
		To view saved transcripts, please <span class="basicTitle">select your department</span>: 
	<?
			$select_dept = $searched_string = $page_string = "" ;
			$total_transcripts = 0 ;
			$transcripts = ARRAY() ;
			if ( $deptid )
			{
				ServiceLogs_remove_DeptExpireTranscripts( $dbh, $deptid, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
				$department = AdminUsers_get_DeptInfo( $dbh, $deptid, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
				if ( AdminUsers_get_IsUserInDept( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $department['deptID'] ) )
				{
					if ( $department['transcript_share'] )
					{
						$transcripts = ServiceTranscripts_get_DeptTranscripts( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'], $department['deptID'], $order_by, $sort_by, $page, 20, $search_string ) ;
						$total_transcripts = ServiceTranscripts_get_TotalDeptTranscripts( $dbh, $department['deptID'], $search_string ) ;
					}
					else
					{
						$transcripts = ServiceTranscripts_get_UserDeptTranscripts( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'], $admin['userID'], $department['deptID'], $order_by, $sort_by, $page, 20, $search_string ) ;
						$total_transcripts = ServiceTranscripts_get_TotalUserDeptTranscripts( $dbh, $admin['userID'], $department['deptID'], $search_string ) ;
					}
					$page_string = Page_util_CreatePageString( $dbh, $page, "index.php?sid=$sid&deptid=$deptid", 20, $total_transcripts ) ;
				}
			}
			
			$admin_departments = AdminUsers_get_UserDepartments( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ) ;
			for ( $c = 0; $c < count( $admin_departments ); ++$c )
			{
				$department = $admin_departments[$c] ;
				$selected = "" ;
				if ( $department['deptID'] == $deptid )
					$selected = "selected" ;

				$select_dept .= "<option value=\"$department[deptID]\" $selected>$department[name]</option>" ;
			}
			print "<select name=\"department\" class=\"select\" OnChange=\"index=this.selectedIndex;if(index>0){location.href='index.php?sid=$sid&deptid='+document.dept_select.department[index].value}\"><option value=\"-- select department --\">&nbsp;</option>$select_dept</select></form>" ;

			if ( $search_string )
				$searched_string = "Searched: \"$search_string\" &nbsp;|&nbsp; Transcripts Found: $total_transcripts &nbsp;|&nbsp; [ <a href=\"index.php?sid=$sid&deptid=$deptid\">reset</a> ]<br>" ;
		?>

	<? echo $searched_string ?><br>
	Page: <? echo $page_string ?> </font><br>
	<table cellspacing=1 cellpadding=3 border=0 width="100%">
	  <tr> 
		<th align="center">&nbsp;</th>
		<th align="left">Operator</th>
		<th align="left">Visitor</th>
		<th align="left">Rating</th>
		<th align="left">Created</th>
		<th align="left" nowrap>Visitor Question</td>
		<th align="left">Duration</th>
		<th align="left">Size</th>
	  </tr>
	  <?
			for ( $c = 0; $c < count( $transcripts ); ++$c )
			{
				$transcript = $transcripts[$c] ;
				$userinfo = AdminUsers_get_UserInfo( $dbh, $transcript['userID'], $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
				$date = date( "D m/d/y $TIMEZONE_FORMAT:i$TIMEZONE_AMPM", ( $transcript['created'] + $TIMEZONE ) ) ;

				// take out the tags to make it more accurate size. (gets rid of all
				// the javascript tags and all that
				$size = Util_Format_Bytes( strlen( strip_tags( $transcript['plain'] ) ) ) ;
				$rating = ( isset( $transcript['rating'] ) ) ? $transcript['rating'] : 0 ;
				$rating = $rating_hash[$rating] ;

				$class = "altcolor1" ;
				if ( $c % 2 )
					$class = "altcolor2" ;

				$duration = $transcript['created'] - $transcript['chat_session'] ;
				if ( $duration <= 0 ) { $duration = 1 ; }
				if ( $duration > 60 )
					$duration = round( $duration/60 ) . " min" ;
				else
					$duration = $duration . " sec" ;

				preg_match( "/<question>(.*)<\/question>/", $transcript['formatted'], $matches ) ;
				$question = ( isset( $matches[0] ) ) ? $matches[0] : "&nbsp;" ;

				print "
				<tr class=\"$class\">
					<td><a href=\"JavaScript:view_transcript( $transcript[chat_session] )\"><img src=\"../images/view.gif\" border=0 width=28 height=16></a></td>
					<td nowrap>$userinfo[name]</td>
					<td nowrap>$transcript[from_screen_name]</td>
					<td>$rating</td>
					<td nowrap>$date</td>
					<td><i>$question</i></td>
					<td nowrap>$duration</td>
					<td nowrap>$size</td>
				</tr>
				" ;
			}
		?>
	</table>
	<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->
	
	</p>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr> 
		<td class="hdash">&nbsp;</td>
	  </tr>
	</table> 

	  
	 <p>System generated messages, such as party left and greeting messages, 
		are ignored during search.</p> 
	<table cellspacing=1 cellpadding=1 border=0>
	<form method="GET" action="index.php" name="form">
	  <input type="hidden" name="sid" value="<? echo $sid ?>">
	  <input type="hidden" name="deptid" value="<? echo $deptid ?>">
		<tr> 
		  <td><strong>Search:</strong></td>
		  <td><input type="text" name="search_string" value="<? echo $search_string ?>" size="25" maxlength="50" style="width:200px"></td>
		  <td><input type="button" OnClick="do_search()" class="mainButton" value="Search"></td>
		</tr></form>
	  </table>
		<!-- end search area -->
	  </p>
	  </td>
	</tr>
 </table>

<? endif ; ?>

<script language="JavaScript">
<!--
	<? if ( $updated ): ?>
	var temp = setTimeout( "alert( 'Success!' )", 200 ) ;
	<? endif ; ?>
//-->
</script>

<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<? include_once( "../setup/footer.php" ); ?>