<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: index.php" ) ; exit ; }
	if ( !file_exists( "../web/".$session_setup['login']."/".$session_setup['login']."-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("../web/".$session_setup['login']."/".$session_setup['login']."-conf-init.php") ;
	include_once("../system.php") ;
	include_once("../lang_packs/$LANG_PACK.php") ;
	include_once("../web/VERSION_KEEP.php") ;
	include_once("../API/sql.php" ) ;
	include_once("../API/Users/get.php") ;
	include_once("../API/Users/put.php") ;
	include_once("../API/Users/remove.php") ;
	include_once("../API/Users/update.php") ;
	include_once("../API/ASP/get.php") ;
	$section = 1;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)
	$nav_line = '<a href="options.php" class="nav">:: Home</a>';
?>
<?
	// initialize
	$action = $error = $deptid = $edit_exp_value = $edit_exp_word = "" ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "20" ;
	else
		$text_width = "10" ;

	$success = $close_window = 0 ;

	$timespan_select = ARRAY( 1=>"Days", 2=>"Months", 3=>"Years" ) ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['deptid'] ) ) { $deptid = $HTTP_GET_VARS['deptid'] ; }
	if ( isset( $HTTP_POST_VARS['deptid'] ) ) { $deptid = $HTTP_POST_VARS['deptid'] ; }
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "add_dept" )
	{
		$aspinfo = AdminASP_get_UserInfo( $dbh, $session_setup['aspID'] ) ;
		$total_departments = AdminUsers_get_TotalDepartments( $dbh, $session_setup['aspID'] ) ;
		
		// let's make sure they don't exceed their max departments
		if ( $total_departments <= $aspinfo['max_dept'] )
		{
			if ( !$deptid && ( $total_departments == $aspinfo['max_dept'] ) )
				$error = "Your MAX department limit has been reached!  Department COULD NOT be added." ;
			else
			{
				$initiate_chat = ( isset( $HTTP_POST_VARS['initiate_chat'] ) ) ? $HTTP_POST_VARS['initiate_chat'] : 0 ;
				$visible = ( isset( $HTTP_POST_VARS['visible'] ) ) ? $HTTP_POST_VARS['visible'] : 0 ;
				if ( AdminUsers_put_department( $dbh, $deptid, $HTTP_POST_VARS['name'], $visible, $HTTP_POST_VARS['email'], $HTTP_POST_VARS['save_transcripts'], $HTTP_POST_VARS['share_transcripts'], $HTTP_POST_VARS['exp_value'], $HTTP_POST_VARS['exp_word'], $session_setup['aspID'], $initiate_chat, $LANG['CHAT_GREETING'] ) )
				{
					$deptid = "" ;
					$success = 1 ;
				}
				else
					$error = "Error: ".$dbh['error'] ;
			}
		}
		else
			$error = "Your MAX department limit has been reached!  Department COULD NOT be added." ;
	}

	if ( $deptid )
	{
		$edit_dept = AdminUsers_get_DeptInfo( $dbh, $deptid, $session_setup['aspID'] ) ;
		LIST( $edit_exp_value, $edit_exp_word ) = explode( "<:>", $edit_dept['transcript_expire_string'] ) ;
	}

	$departments = AdminUsers_get_AllDepartments( $dbh, $session_setup['aspID'], 1 ) ;
?>
<? include_once("./header.php"); ?>
<script language="JavaScript">
<!--
	function do_update_dept()
	{
		if ( ( document.dept.name.value == "" ) || ( document.dept.email.value == "" ) )
			alert( "All fields must be supplied." ) ;
		else
			document.dept.submit() ;
	}

	function do_delete( deptid )
	{
		window.open("adddept_rm.php?action=confirm_delete&deptid="+deptid, 'Confirm', 'scrollbars=no,menubar=no,resizable=0,location=no,width=350,height=250') ;
	}

	function do_alert()
	{
		if( <? echo $success ?> )
			alert( 'Success!' ) ;
		if( <? echo $close_window ?> )
		{
			opener.window.location.href = "adddept.php?s=1" ;
			window.close() ;
		}
	}

	function open_help( action )
	{
		url = "<? echo $BASE_URL ?>/help.php?action=" + action ;
		newwin = window.open(url, "help", "scrollbars=yes,menubar=no,resizable=1,location=no,width=350,height=250") ;
		newwin.focus() ;
	}
//-->
</script>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td><p><span class="title">Manager: Create/Edit Department</span><br>
	  Here, you can create, edit or delete your company departments.</p>
	<ul>
	  <li> The <i>department email</i> is where the messages will delivered 
		on the "Leave a Message Form" when operators are not available. 
	  </li>
	  <li> The <i>auto save transcripts</i> enables the system to automatically 
		save all support transcripts without manually saving them. Setting 
		transcript <i>expire time</i> to zero (0) will NOT delete the 
		transcripts. </li>
	</ul>
	<font color="#FF0000"><? echo $error ?></font>
	<table width="450" border=0 cellpadding=3 cellspacing=1>
	  <form method="POST" action="adddept.php" name="dept">
		<input type="hidden" name="action" value="add_dept">
		<input type="hidden" name="deptid" value="<? echo $deptid ?>">
		<tr> 
		  <td width="157">Department</td>
		  <td width="286"><input type="text" name="name" size="<? echo $text_width ?>" maxlength="30" value="<?= isset( $edit_dept['name'] ) ? $edit_dept['name'] : "" ?>"></td>
		</tr>
		<tr> 
		  <td>Department Email </td>
		  <td><input type="text" name="email" size="<? echo $text_width ?>" maxlength="150" value="<?= isset( $edit_dept['email'] ) ? $edit_dept['email'] : "" ?>"></td>
		</tr>
		<!-- v2.5.1 forward, transcripts will be saved automatically -->
		<input type="hidden" name="save_transcripts" value="1">
		<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/admin_puller.php" ) ): ?>
		<tr> 
		  <td>Visible to Public? </td>
		  <td> <select name="visible">
			  <?= ( ( isset( $edit_dept['visible'] ) && $edit_dept['visible'] ) || !isset( $edit_dept['visible'] ) ) ? "<option value=1 selected>Yes<option value=0>No" : "<option value=1>Yes<option value=0 selected>No" ?></select> [ <a href="JavaScript:open_help( 'visible' )">? help</a> ]</td>
		</tr>
		<? else: ?>
		<input type="hidden" name="visible" value="1">
		<? endif ; ?>
		<tr>
		  <td>Share saved transcripts? </td>
		  <td> <select name="share_transcripts">
			  <?= ( ( isset( $edit_dept['transcript_share'] ) && $edit_dept['transcript_share'] ) || !isset( $edit_dept['transcript_share'] ) ) ? "<option value=1 selected>Yes<option value=0>No" : "<option value=1>Yes<option value=0 selected>No" ?></select> [ <a href="JavaScript:open_help( 'share_transcripts' )">? help</a> ]</td>
		</tr>
		<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/admin_puller.php" ) ): ?>
		<tr align="center"> 
		  <td colspan=2 class="hilight">If initiate chat is disabled, 
			operator's traffic monitor will also be disabled.</td>
		</tr>
		<tr>
		  <td>Allow initiate chat? </td>
		  <td> <select name="initiate_chat">
				<?= ( ( isset( $edit_dept['initiate_chat'] ) && $edit_dept['initiate_chat'] ) || !isset( $edit_dept['initiate_chat'] ) ) ? "<option value=1 selected>Yes<option value=0>No" : "<option value=1>Yes<option value=0 selected>No" ?></select> </td>
		</tr>
		<? endif ; ?>
		<tr> 
		  <td>Transcripts expire after</td>
		  <td> <input type="text" name="exp_value" size=2 maxlength=3 value="<? echo $edit_exp_value ?>" onKeyPress="return numbersonly(event)"> 
			<select name="exp_word">
			  <?
					while ( LIST( $option_value, $option_string ) = EACH( $timespan_select ) )
					{
						$selected = "" ;
						if ( $option_value == $edit_exp_word )
							$selected = "selected" ;

						print "					<option value=\"$option_value\" $selected>$option_string</option>\n" ;
					}

					// reset it so we can use again below
					reset( $timespan_select ) ;
				?>
			</select> </td>
		</tr>
		<tr> 
		  <td>&nbsp; </td>
		  <td><input type="button" class="mainButton" onClick="javaScript:do_update_dept()" value="Submit"></td>
		</tr>
	  </form>
	</table></td>
  <td style="background-image: url(../images/g_manage_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
<tr> 
  <td colspan="2">
  
	<table cellspacing=1 cellpadding=2 border=0 width="100%">
		<?
			for ( $c = 0; $c < count( $departments ); ++$c )
			{
				$department = $departments[$c] ;

				$transcripts_share = "No" ;
				if ( $department['transcript_share'] )
					$transcripts_share = "Yes" ;
				$initiate_chat = "No" ;
				if ( $department['initiate_chat'] )
					$initiate_chat = "Yes" ;
				$public_visible = "No" ;
				if ( $department['visible'] )
					$public_visible = "Yes" ;

				$initiate_column = "" ;
				$initiate_option = "" ;
				if ( $INITIATE  )
				{
					$initiate_option = "<th align=\"left\">Initiate Chat</th>" ;
					$initiate_column = "<td>$initiate_chat</td>" ;
				}
				$visible_column = "" ;
				$visible_option = "" ;
				if ( $INITIATE )
				{
					$visible_option = "<th align=\"left\">Visible</th>" ;
					$visible_column = "<td>$public_visible</td>" ;
				}

				LIST ( $expire_value, $expire_string ) = explode( "<:>", $department['transcript_expire_string'] ) ;

				$delete_string = "" ;
				if ( count( $departments ) > 1 )
					$delete_string = "<a href=\"JavaScript:do_delete( ".$department['deptID']." )\">Delete</a>" ;

				$survey_string = "" ;
				if ( file_exists( "../admin/traffic/survey.php" ) && !file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) )
					$survey_string = "<img src=\"../images/dot.gif\" width=5 height=6> <a href=\"../admin/traffic/survey.php?deptid=$department[deptID]\" class=\"altLink\">survey</a>&nbsp;&nbsp;" ;
				print "
					<tr>
						<th align=\"left\">Department</th>
						$visible_option
						<th align=\"left\" width=\"150\">Email</th>
						<th align=\"left\">Share Transcripts</th>
						<th align=\"left\">Transcripts Expire</th>
						$initiate_option
						<th>&nbsp;</th>
						<th>&nbsp;</th>
					</tr>
					<tr class=\"altcolor1\">
						<td rowspan=\"2\">$department[name]</td>
						$visible_column
						<td><a href=\"mailto:$department[email]\">$department[email]</a></td>
						<td>$transcripts_share</td>
						<td>$expire_value $timespan_select[$expire_string]</td>
						$initiate_column
						<td align=\"center\"><a href=\"adddept.php?deptid=$department[deptID]\">Edit</a></td>
						<td align=\"center\">$delete_string</td>
					</tr>
					<tr class=\"altcolor3\">
						<td colspan=8>
							<img src=\"../images/dot.gif\" width=5 height=6> <a href=\"dept_icons.php?deptid=$department[deptID]\" class=\"altLink\">status icons</a> 
							&nbsp;&nbsp;
							<img src=\"../images/dot.gif\" width=5 height=6> <a href=\"dept.php?action=greeting&deptid=$department[deptID]\" class=\"altLink\">greeting</a> 
							&nbsp;&nbsp;
							<img src=\"../images/dot.gif\" width=5 height=6> <a href=\"dept.php?action=offline&deptid=$department[deptID]\" class=\"altLink\">offline message</a> 
							&nbsp;&nbsp;
							<!-- <img src=\"../images/dot.gif\" width=5 height=6> <a href=\"dept.php?action=away&deptid=$department[deptID]\" class=\"altLink\">away message</a> 
							&nbsp;&nbsp; -->
							<img src=\"../images/dot.gif\" width=5 height=6> <a href=\"dept.php?action=canned_responses&deptid=$department[deptID]\" class=\"altLink\">canned responses</a>
							&nbsp;&nbsp;
							<img src=\"../images/dot.gif\" width=5 height=6> <a href=\"dept.php?action=canned_commands&deptid=$department[deptID]\" class=\"altLink\">canned commands</a>
							&nbsp;&nbsp;
							<!-- $survey_string -->
						</td>
					</tr>
					<tr> 
						<td height=\"5\" colspan=8 class=\"hdash2\"><img src=\"../images/spacer.gif\" width=\"1\" height=\"5\"></td>
					</tr>
				" ;
			}
		?>
		</table>
	</td>
</tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<? include_once( "./footer.php" ) ; ?>