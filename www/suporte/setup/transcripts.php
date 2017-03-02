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
	include_once("$DOCUMENT_ROOT/API/Util_Page.php") ;
	include_once("$DOCUMENT_ROOT/API/Util.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/Util.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Logs/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Logs/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/Transcripts/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Transcripts/remove.php") ;
	$section = 4;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)
?>
<?

	// initialize
	$action = $error_mesg = $userid = $deptid = $chat_session = $search_string = $searched_string = "" ;
	$success = $page = $deptid = $userid = 0 ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "12" ;
	else
		$text_width = "9" ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['userid'] ) ) { $userid = $HTTP_GET_VARS['userid'] ; }
	if ( isset( $HTTP_GET_VARS['deptid'] ) ) { $deptid = $HTTP_GET_VARS['deptid'] ; }
	if ( isset( $HTTP_GET_VARS['chat_session'] ) ) { $chat_session = $HTTP_GET_VARS['chat_session'] ; }
	if ( isset( $HTTP_GET_VARS['page'] ) ) { $page = $HTTP_GET_VARS['page'] ; }
	if ( isset( $HTTP_GET_VARS['search_string'] ) ) { $search_string = $HTTP_GET_VARS['search_string'] ; }

	$nav_line = '<a href="options.php" class="nav">:: Home</a>';
	if ( $action )
		$nav_line = '<a href="transcripts.php" class="nav">:: Previous</a>';

	$rating_hash = Array() ;
	$rating_hash[4] = "Excellent" ;
	$rating_hash[3] = "Very Good" ;
	$rating_hash[2] = "Good" ;
	$rating_hash[1] = "Needs Improvement" ;
	$rating_hash[0] = "&nbsp;" ;

	ServiceChat_remove_CleanChatSessions( $dbh ) ;
?>
<?
	// functions
?>
<?
	// conditions
	
	if ( $action == "delete" )
	{
		ServiceTranscripts_remove_Transcript( $dbh, $session_setup['aspID'], $chat_session ) ;
		HEADER( "location: transcripts.php?action=view&userid=$userid&deptid=$deptid&page=$page" ) ;
		exit ;
	}
?>
<? include_once( "./header.php" ) ; ?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<script language="JavaScript">
<!--
	function view_transcript( chat_session )
	{
		url = "<? echo $BASE_URL ?>/admin/view_transcript.php?chat_session="+chat_session+"&x=<? echo $session_setup['aspID'] ?>&l=<? echo $session_setup['login'] ?>" ;
		newwin = window.open(url, "transcript", "scrollbars=yes,menubar=no,resizable=1,location=no,width=500,height=550") ;
		newwin.focus() ;

	}

	function do_search()
	{
		string = replace( document.form.search_string.value, " ", "" ) ;
		if ( string.length < 3 )
			alert( "Search string must be AT LEAST 3 characters." )
		else
			document.form.submit() ;
	}

	function do_delete( sessionid )
	{
		if ( confirm( "Really delete this transcript?" ) )
			location.href = "transcripts.php?action=delete&deptid=<? echo $deptid ?>&userid=<? echo $userid ?>&page=<? echo $page ?>&chat_session="+sessionid ;
	}
//-->
</script>


<?
	if ( $action == "view" ):
	ServiceLogs_remove_DeptExpireTranscripts( $dbh, $deptid, $session_setup['aspID'] ) ;
	if ( $userid )
	{
		$info = AdminUsers_get_UserInfo( $dbh, $userid, $session_setup['aspID'] ) ;
		$transcripts = ServiceTranscripts_get_UserDeptTranscripts( $dbh, $session_setup['aspID'], $userid, 0, "", "", $page, 20, $search_string ) ;
		$total_transcripts = ServiceTranscripts_get_TotalUserDeptTranscripts( $dbh, $userid, 0, $search_string ) ;

	}
	else
	{
		$info = AdminUsers_get_DeptInfo( $dbh, $deptid, $session_setup['aspID'] ) ;
		$transcripts = ServiceTranscripts_get_DeptTranscripts( $dbh, $session_setup['aspID'], $deptid, "", "", $page, 20, $search_string ) ;
		$total_transcripts = ServiceTranscripts_get_TotalDeptTranscripts( $dbh, $deptid, $search_string ) ;
	}
	$page_string = Page_util_CreatePageString( $dbh, $page, "transcripts.php?action=view&deptid=$deptid&userid=$userid", 20, $total_transcripts ) ;

	if ( $search_string )
		$searched_string = "Searched: \"$search_string\" &nbsp;|&nbsp; Transcripts Found: $total_transcripts &nbsp;|&nbsp; [ <a href=\"transcripts.php?userid=$userid&deptid=$deptid&action=view\">reset</a> ]<br>" ;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td height="350" valign="top"> <p><span class="title">Sessions: Chat Transcripts: <? echo stripslashes( $info['name'] ) ?></span><br>
	  Below is a complete list of <? echo stripslashes( $info['name'] ) ?>'s past chat transcripts. </p>

		<? echo $searched_string ?><br>
		Page: <? echo $page_string ?><br>
	  <table width="100%" border=0 cellpadding=2 cellspacing=1>
		<tr> 
			<th>&nbsp;</th>
			<th nowrap align="left">Operator</th>
			<th nowrap align="left">Visitor</th>
			<th nowrap align="left">Rating</th>
			<th nowrap align="left">Created</th>
			<th align="left" nowrap>Visitor Question</td>
			<th nowrap align="left">Duration</th>
			<th nowrap align="left">Size</th>
			<th nowrap align="left">&nbsp;</th>
	  </tr>
	   <?
			for ( $c = 0; $c < count( $transcripts ); ++$c )
			{
				$transcript = $transcripts[$c] ;
				$userinfo = AdminUsers_get_UserInfo( $dbh, $transcript['userID'], $session_setup['aspID'] ) ;
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
					<td nowrap><a href=\"JavaScript:do_delete( $transcript[chat_session] )\">delete</a></td>
				</tr>
				" ;
			}
		?>
	</table>

	<p>System generated messages, such as party left and greeting messages, 
	are ignored during search.</p> 
	<table cellspacing=1 cellpadding=1 border=0>
	<form method="GET" action="transcripts.php" name="form">
	<input type="hidden" name="action" value="view">
	<input type="hidden" name="deptid" value="<? echo $deptid ?>">
	<input type="hidden" name="userid" value="<? echo $userid ?>">
	<tr> 
		<td><strong>Search:</strong></td>
		<td><input type="text" name="search_string" value="<? echo $search_string ?>" size="25" maxlength="50" style="width:200px"></td>
		<td><input type="button" OnClick="do_search()" class="mainButton" value="Search"></td>
	</tr></form>
	</table>
	
  </td>

<?
	else:
	$admins = AdminUsers_get_AllUsers( $dbh, 0, 0, $session_setup['aspID'] ) ;
	$departments = AdminUsers_get_AllDepartments( $dbh, $session_setup['aspID'], 1 ) ;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td height="350" valign="top" width="100%"> <p><span class="title">Sessions: Chat Transcripts</span><br>
	  View/Search previous chat transcripts by department or operator.</p>
	  <ul>
		<b><big><strong>Chat Transcripts By Department</strong></big></b>
		<?
			for ( $c = 0; $c < count( $departments ); ++$c )
			{
				$department = $departments[$c] ;
				
				$hidden_string = "" ;
				if ( !$department['visible'] )
					$hidden_string = "(hidden department)" ;

				$name = stripslashes( $department['name'] ) ;
				print "<li> <a href=\"transcripts.php?action=view&deptid=$department[deptID]\">$name</a> $hidden_string<br>" ;
			}
		?>
	  </ul>

	  <ul>
		<b><big><strong>Chat Transcripts by Operator</strong></big></b>
		<?
			for ( $c = 0; $c < count( $admins ); ++$c )
			{
				$admin = $admins[$c] ;
				$name = stripslashes( $admin['name'] ) ;
				print "<li> <a href=\"transcripts.php?action=view&userid=$admin[userID]\">$name</a><br>" ;
			}
		?>
	  </ul>
	  </td>
	  <td style="background-image: url(../images/g_sessions_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>

<? endif ;?>
</tr>
</table>

<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->


<? include_once( "./footer.php" ) ; ?>
