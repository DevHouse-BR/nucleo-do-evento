<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: index.php" ) ; exit ; }
	if ( !isset( $session_setup['login'] ) || !file_exists( "../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("$DOCUMENT_ROOT/web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Util_Optimize.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/update.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint/remove.php") ;
	$section = 0;			// Section number - see header.php for list of section numbers

	$current_phplive_version = "2.8" ;

	// auto detect if correct version is used... if not, redict to patch
	if ( $PHPLIVE_VERSION != $current_phplive_version )
	{
		HEADER( "location: patches/" ) ;
		exit ;
	}

	$nav_line = '';
?>
<?
	// initialize

	// update all admins status to not available if they have been idle
	AdminUsers_update_IdleAdminStatus( $dbh, $admin_idle ) ;

	$now = mktime( 0,0,0,date("m"),date("j"),date("Y") ) ;
	$oldest_footprintstat_date = ServiceFootprint_get_LatestFootprintStatDate( $dbh, $session_setup['aspID'] ) ;
	
	if ( $oldest_footprintstat_date )
		$oldest_footprintstat_date = mktime( 0,0,0,date("m", $oldest_footprintstat_date),date("j", $oldest_footprintstat_date),date("Y", $oldest_footprintstat_date) ) ;
	// > 0 because if there is no data, database spits out negative numbers
	if ( ( $oldest_footprintstat_date < $now ) && ( $oldest_footprintstat_date > 0 ) )
	{
		$month = date("m", $oldest_footprintstat_date ) ;
		$day = date("j", $oldest_footprintstat_date ) ;
		$year = date("Y", $oldest_footprintstat_date ) ;
		HEADER( "location: optimize.php?month=$month&day=$day&year=$year" ) ;
		exit ;
	}
	else
	{
		if ( isset( $HTTP_GET_VARS['optimized'] ) )
		{
			// do removing of old data (over 1 month old)
			$expireday = $now - (60*60*24*30) ;
			ServiceFootprint_remove_OldFootprints( $dbh, $session_setup['aspID'], $expireday ) ;

			$tables = ARRAY( "chat_admin", "chatcanned", "chatdepartments", "chatfootprints", "chatfootprintsunique", "chatrequestlogs", "chatrequests", "chatsessionlist", "chatsessions", "chattranscripts", "chatuserdeptlist" ) ;

			if ( !preg_match( "//", $HTTP_SERVER_VARS['SERVER_NAME'] ) )
			{
				Util_OPT_Database( $dbh, $tables ) ;
			}
		}
	}
?>
<?
	// functions
?>
<?
	// conditions
?>
<? include_once("./header.php"); ?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->


<table width="100%" border="0" cellspacing="15" cellpadding="0">
<tr>
	<td valign="top"><strong>Basic Things you should do:</strong> 
	  <br>
		<? if ( file_exists( "../super/asp.php" ) && isset( $ASP_KEY ) && $ASP_KEY ): ?>
		<li> <a href="customize.php?action=logo">Update Company Logo</a></li>
		<? endif ; ?>
		<li> <a href="adddept.php">Create/Edit Departments</a></li>
		<li> <a href="adduser.php">Create/Edit Operators</a></li>
		<li> <a href="code.php">Generate HTML Code</a></li>
	 </td>
	<td colspan=2 valign="top" class="altcolor2"><span class="basicTitle">Operator Login URL:</span><br>
		New operators must login below to go Online and provide support (bookmark the URL):<br>
		<a href="<? echo $BASE_URL ?>/web/<? echo $session_setup['login'] ?>/" class="basicTitle"><font color="#29C029"><strong><? echo $BASE_URL ?>/web/<? echo $session_setup['login'] ?>/</font></a>
	</td>
</tr>
<tr><td height="2" colspan=3 class="hdash"><img src="../images/spacer.gif" width="1" height="2"></td></tr>
  <tr>
	<td width="33%" align="center"><table width="208" border="0" cellspacing="0">
		<tr> 
		  <td width="208" height="138" valign="top" background="../images/g_manage.jpg"><br> 
			<a href="manager.php"><span class="panelTitle">Manager</span></a><br>
			
			<a href="adddept.php" class="sectionLink">Manage Departments</a><br>
			<a href="adduser.php" class="sectionLink">Manage Operators</a><br>
			<a href="code.php" class="sectionLink">Generate HTML</a>
			</td>
		</tr>
	  </table></td>
	  <td width="33%" align="center"><table width="208" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td width="208" height="138" valign="top" background="../images/g_interface.jpg"><br> 
			<a href="interface.php"><span class="panelTitle">Interface</span></a><br>

			<a href="customize.php?action=colors" class="sectionLink">Colors &amp; Language</a><br>
			<a href="customize.php?action=icons" class="sectionLink">Support Icons</a><br>
			<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/admin_puller.php" ) ): ?>
			<a href="customize.php?action=initiate" class="sectionLink">Initiate Chat Image</a>
			<? endif ; ?>
			</td>
		</tr>
	  </table></td>
	  <td width="33%" align="center"> <table width="208" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td width="208" height="138" valign="top" background="../images/g_prefs.jpg"><br> 
			<a href="prefs.php"><span class="panelTitle">Preferences</span></a><br>

			<a href="prefs.php?action=footprints" class="sectionLink">Exclude IP Tracking</a><br>
			<a href="email_transcript.php" class="sectionLink">Email Transcript</a><br>
			<a href="prefs.php?action=timezone" class="sectionLink">Time Zone</a>
			</td>
		</tr>
	  </table></td>
</tr>
<tr>
	<td width="33%" align="center"><table width="208" border="0" cellspacing="0">
		<tr> 
		  <td width="208" height="138" valign="top" background="../images/g_profile.jpg"><br> 
			<a href="profiles.php"><span class="panelTitle">Operator Prefs/Reports</span></a><br>
			
			<a href="statistics.php" class="sectionLink">Support Request</a><br>
			<a href="opratings.php" class="sectionLink">Operator Ratings</a><br>
			<a href="profiles.php?action=pics" class="sectionLink">Operator Pics</a>
			</td>
		</tr>
	  </table></td>
	<td width="33%" align="center"> <table width="208" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td width="208" height="138" valign="top" background="../images/g_sessions.jpg"><br> 
			<a href="sessions.php"><span class="panelTitle">Sessions</span></a><br>

			<a href="processes.php?action=chat" class="sectionLink">Current Chats</a><br>
			<a href="transcripts.php" class="sectionLink">Chat Transcripts</a><br>
			<a href="processes.php?action=consol" class="sectionLink">Admin Console</a>
			</td>
		</tr>
	  </table></td>
		<td width="33%" align="center"><table width="208" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td width="208" height="138" valign="top" background="../images/g_reports.jpg"><br> 
			<a href="reports.php"><span class="panelTitle">Traffic Reports</span></a><br>

			<a href="footprints.php" class="sectionLink">Traffic &amp; Footprints</a><br>
			<a href="refer.php" class="sectionLink">Refer URLs</a>
			</td>
		</tr>
	  </table></td>
</tr>
<tr>
	<td width="33%" align="center"><table width="208" border="0" cellspacing="0">
		<tr>
			<td width="208" height="138" valign="top" background="../images/g_prefs.jpg"><br>
			<a href="chatprefs.php"><span class="panelTitle">Chat Preferences</span></a><br>

			<!-- <a href="chatprefs.php?action=window_type" class="sectionLink">Chat Window Type</a><br> -->
			<a href="chatprefs.php?action=polling" class="sectionLink">Polling Time</a><br>
			<a href="chatprefs.php?action=polling_type" class="sectionLink">Polling Type</a>
			</td>
		</tr>
	  </table></td>
	<? if ( $INITIATE && ( file_exists( "$DOCUMENT_ROOT/admin/traffic/click_track.php" ) || file_exists( "$DOCUMENT_ROOT/web/$session_setup[login]/salespath.php" ) ) ): ?>
	<td width="33%" align="center">
		<table width="208" border="0" cellspacing="0">
		<tr>
			<td width="208" height="138" valign="top" background="../images/g_marketing.jpg"><br>
			<a href="marketing.php"><span class="panelTitle">Marketing & Sales</span></a><br>

			<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/click_track.php" ) ): ?>
			<a href="../admin/traffic/click_track.php" class="sectionLink">Click Track'it</a><br>
			<!-- <a href="../admin/traffic/conversion.php" class="sectionLink">Click Conversion</a><br> -->
			<? endif ; ?>
			<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/web/$session_setup[login]/salespath.php" ) ): ?>
			<a href="salespath.php" class="sectionLink"><font color="#FF8080"><b>Sales Path</b></font></a><br>
			<? endif ; ?>
			</td>
		</tr>
		</table>
	</td>
	<? endif ; ?>
	<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/knowledge.php" ) ): ?>
	<td width="33%" align="center">
		<table width="208" border="0" cellspacing="0">
		<tr> 
			<td width="208" height="138" valign="top" background="../images/g_knowledge.jpg"><br> 
			<a href="../admin/traffic/knowledge.php"><span class="panelTitle">Knowledge Base</span></a><br>

			<a href="../admin/traffic/knowledge_config.php" class="sectionLink">Preferences</a>
			<a href="../admin/traffic/knowledge_config.php?action=config" class="sectionLink">Setup and Build</a>
			</td>
		</tr>
		</table>
	</td>
	<? endif ; ?>
</tr>
<tr>
	<td colspan=3 align="center"><span class="small">For documentation and help please consult the http://www.phplivesupport.com/documentation   PHP Live! User Manual</td>
</tr>
</table>
<? include("footer.php") ; ?>