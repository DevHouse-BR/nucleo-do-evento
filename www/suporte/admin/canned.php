<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$sid = $action = $deptid = $cannedid = $ave_rating_string = $prev_action = "" ;
	$updated = 0 ;
	if ( !isset( $HTTP_SESSION_VARS['session_admin'] ) )
	{
		HEADER( "location: ../index.php" ) ;
		exit ;
	}
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : $HTTP_POST_VARS['sid'] ;

	if ( !isset( $HTTP_SESSION_VARS['session_admin'][$sid]['asp_login'] ) || !file_exists( "../web/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: ../index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("../web/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."-conf-init.php") ;
	include_once("../system.php") ;
	include_once("../lang_packs/$LANG_PACK.php") ;
	include_once("../web/VERSION_KEEP.php") ;
	include_once("../API/sql.php" ) ;
	include_once("../API/Util.php") ;
	include_once("../API/Users/get.php") ;
	include_once("../API/Users/update.php") ;
	include_once("../API/Canned/put.php") ;
	include_once("../API/Canned/get.php") ;
	include_once("../API/Canned/remove.php") ;
	include_once("../API/Canned/update.php") ;
?>
<?
	// initialize
	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "20" ;
		$text_width_long = "35" ;
		$textbox_width = "70" ;
	}
	else
	{
		$text_width = "10" ;
		$text_width_long = "20" ;
		$textbox_width = "40" ;
	}

	// check to make sure session is set.  if not, user is not authenticated.
	// send them back to login
	if ( !$HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] )
	{
		HEADER( "location: ../" ) ;
		exit ;
	}

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_POST_VARS['prev_action'] ) ) { $prev_action = $HTTP_POST_VARS['prev_action'] ; }
	if ( isset( $HTTP_GET_VARS['prev_action'] ) ) { $prev_action = $HTTP_GET_VARS['prev_action'] ; }
	if ( isset( $HTTP_POST_VARS['deptid'] ) ) { $deptid = $HTTP_POST_VARS['deptid'] ; }
	if ( isset( $HTTP_GET_VARS['deptid'] ) ) { $deptid = $HTTP_GET_VARS['deptid'] ; }
	if ( isset( $HTTP_POST_VARS['cannedid'] ) ) { $cannedid = $HTTP_POST_VARS['cannedid'] ; }
	if ( isset( $HTTP_GET_VARS['cannedid'] ) ) { $cannedid = $HTTP_GET_VARS['cannedid'] ; }

	if ( ( $action == "canned_responses" ) || ( $prev_action == "canned_responses" ) )
		$section = 1;
	else if ( ( $action == "canned_commands" ) || ( $prev_action == "canned_commands" ) )
		$section = 2 ;
	else if ( ( $action == "canned_initiate" ) || ( $prev_action == "canned_initiate" ) )
		$section = 4 ;

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
	
	if ( $action == "add_canned" )
	{
		$action = $HTTP_POST_VARS['prev_action'] ;
		if ( $cannedid )
			ServiceCanned_update_Canned( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $cannedid, $deptid, $HTTP_POST_VARS['name'], $HTTP_POST_VARS['message'] ) ;
		else
			ServiceCanned_put_UserCanned( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $deptid, $HTTP_POST_VARS['type'], $HTTP_POST_VARS['name'], $HTTP_POST_VARS['message'] ) ;
		$cannedid = 0 ;
		$deptid = 0 ;
		$updated = 1 ;
	}
	else if ( $action == "delete_canned" )
	{
		$action = $HTTP_GET_VARS['prev_action'] ;
		ServiceCanned_remove_UserCanned( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $cannedid ) ;
		$cannedid = 0 ;
		$deptid = 0 ;
	}

	$admin = AdminUsers_get_UserInfo( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], $HTTP_SESSION_VARS['session_admin'][$sid]['aspID'] ) ;
	$admin_departments = AdminUsers_get_UserDepartments( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ) ;

	$admin_dept_hash = Array() ;
	$admin_dept_hash[0] = "All My Departments" ;
	$admin_dept_select_string = "" ;
	for ( $c = 0; $c < count( $admin_departments ); ++$c )
	{
		$department = $admin_departments[$c] ;
		$admin_dept_select_string .= "deptID = $department[deptID] OR " ;
		$admin_dept_hash[$department['deptID']] = stripslashes( $department['name'] ) ;
	}
	$admin_dept_select_string = substr( $admin_dept_select_string, 0, strlen( $admin_dept_select_string ) - 3 ) ;

?>
<? include_once("./header.php") ; ?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<script language="JavaScript">
<!--
	function do_submit()
	{
		if ( ( document.form.name.value == "" ) || ( document.form.message.value == "" ) )
			alert( "All fields must be supplied." ) ;
		else
			document.form.submit() ;
	}

	function do_delete( cannedid )
	{
		if ( confirm( "Are you sure you want to delete?" ) )
			location.href = "canned.php?action=delete_canned&prev_action=<? echo $action ?>&deptid=<? echo $deptid ?>&sid=<? echo $sid ?>&cannedid="+cannedid ;
	}

	function put_command(selected_index)
	{
		if ( selected_index > 0 )
			document.form.message.value = document.form.command[selected_index].value ;
	}

	function check_command()
	{
		if ( document.form.command.selectedIndex == 0 )
		{
			alert( "Please choose a command first." ) ;
			document.form.command.focus() ;
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

<?
	if ( $action == "canned_responses" ):
	$canneds = ServiceCanned_get_UserCannedByType( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], 0, 'r', $admin_dept_select_string ) ;
	$cannedinfo = ServiceCanned_get_CannedInfo( $dbh, $cannedid, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ) ;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
    <td width="100%" height="350" valign="top"> 
	  <p><span class="title">Operator: Canned Responses</span><br>
		Canned responses are quick way to write messages that you would need to 
		type frequently.</p>
	<table cellspacing=1 cellpadding=2 border=0 width="100%">
	  <tr> 
		<th align="left" nowrap>Reference</th>
		<th align="left">Message</th>
		<th align="left">Department</th>
		<th align="center">&nbsp;</th>
		<th align="center">&nbsp;</th>
	  </tr>
	  <?
			for ( $c = 0; $c < count( $canneds ); ++$c )
			{
				$canned = $canneds[$c] ;

				$canned_name = Util_Format_ConvertSpecialChars( $canned['name'] ) ;
				$canned_message = nl2br( Util_Format_ConvertSpecialChars( $canned['message'] ) ) ;

				$class = "altcolor1" ;

				$edit_string = "&nbsp;" ;
				$delete_string = "&nbsp;" ;
				if ( $canned['userID'] == $admin['userID'] )
				{
					$edit_string = "<a href=\"canned.php?sid=$sid&deptid=$deptid&action=canned_responses&cannedid=$canned[cannedID]&#theform\">Edit</a>" ;
					$delete_string = "<a href=\"JavaScript:do_delete( $canned[cannedID] )\">Delete</a>" ;
				}
				$department = $admin_dept_hash[$canned['deptID']] ;
				if ( ( $canned['userID'] == $admin['userID'] ) || ( $canned['userID'] > 10000000 ) )
				{
					print "
						<tr class=\"$class\">
							<td>$canned_name</td>
							<td>$canned_message</td>
							<td>$department</td>
							<td>$edit_string</td>
							<td>$delete_string</td>
						</tr>
					" ;
				}
			}
		?>
	  <tr> 
		<td colspan=5 class="hdash2"><img src="../images/spacer.gif" width="1" height="1"></td>
	  </tr>
	  </table>

		<a name="theform"><form method="POST" action="canned.php" name="form"></a>
		<input type="hidden" name="action" value="add_canned">
		<input type="hidden" name="prev_action" value="<? echo $action ?>">
		<input type="hidden" name="type" value="r">
		<input type="hidden" name="sid" value="<? echo $sid ?>">
		<input type="hidden" name="cannedid" value="<? echo $cannedid ?>">
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td>Reference</td>
			<td><input name="name" type="text" style="width:100px" size="<? echo $text_width ?>" maxlength="20" value="<? echo stripslashes( $cannedinfo['name'] ) ?>"> <i>(example: Greeting)</i></td>
		</tr>
		<tr>
			<td>Message</td>
			<td>
				<table cellspacing=0 cellpadding=0 border=0><tr><td><textarea name="message" cols="<? echo $text_width_long ?>" rows=2 wrap="virtual"><? echo preg_replace( "/\"/", "&quot;", stripslashes( $cannedinfo['message'] ) ) ?></textarea></td><td>&nbsp;</td><td><span class="small">HTML not allowed.  Please use <a href="JavaScript:open_help( 'commands' )">commands</a>.<br><span class="hilight">%%user%%</span> - visitors's login</td></tr></table>
			</td>
		</tr>
		<tr>
			<td>Department</td>
			<td><select name="deptid"><option value="0" <?= ( $cannedinfo['deptID'] == 0 ) ? "selected" : "" ?>>All My Departments</option>
			<?
				for ( $c = 0; $c < count( $admin_departments ); ++$c )
				{
					$department = $admin_departments[$c] ;
					$selected = "" ;
					if ( $department['deptID'] == $cannedinfo['deptID'] )
						$selected = "selected" ;

					print "<option value=\"$department[deptID]\" $selected>$department[name]</option>" ;
				}
			?><select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" class="mainButton" value="Submit" OnClick="do_submit()"></td>
		</tr>
		</table>

		</form>
    </td>







<?
	elseif ( $action == "canned_commands" ):
	$selected_push = $selected_email = $selected_url = $selected_image = "" ;
	$canneds = ServiceCanned_get_UserCannedByType( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], 0, 'c', $admin_dept_select_string ) ;
	$cannedinfo = ServiceCanned_get_CannedInfo( $dbh, $cannedid, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ) ;
	if ( preg_match( "/^push:/", $cannedinfo['message'] ) )
		$selected_push = "selected" ;
	else if ( preg_match( "/^email:/", $cannedinfo['message'] ) )
		$selected_email = "selected" ;
	else if ( preg_match( "/^url:/", $cannedinfo['message'] ) )
		$selected_url = "selected" ;
	else if ( preg_match( "/^image:/", $cannedinfo['message'] ) )
		$selected_image = "selected" ;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
    <td width="100%" height="350" valign="top"> 
	  <p><span class="title">Operator: Canned Commands</span><br>
		Canned commands are quick ways to execute simple HTML tasks.</p>
	  <table cellspacing=1 cellpadding=2 border=0 width="100%">
		<tr> 
		  <th align="left" nowrap>Reference</th>
		  <th align="left">Message</th>
		  <th align="left">Department</th>
		  <th align="center">&nbsp;</th>
		  <th align="center">&nbsp;</th>
		</tr>
		<?
			for ( $c = 0; $c < count( $canneds ); ++$c )
			{
				$canned = $canneds[$c] ;

				$canned_name = Util_Format_ConvertSpecialChars( $canned['name'] ) ;
				$canned_message = Util_Format_ConvertSpecialChars( $canned['message'] ) ;

				$class = "altcolor1" ;

				$edit_string = "&nbsp;" ;
				$delete_string = "&nbsp;" ;
				if ( $canned['userID'] == $admin['userID'] )
				{
					$edit_string = "<a href=\"canned.php?sid=$sid&deptid=$deptid&action=canned_commands&cannedid=$canned[cannedID]&#theform\">Edit</a>" ;
					$delete_string = "<a href=\"JavaScript:do_delete( $canned[cannedID] )\">Delete</a>" ;
				}
				$department = $admin_dept_hash[$canned['deptID']] ;
				if ( ( $canned['userID'] == $admin['userID'] ) || ( $canned['userID'] > 10000000 ) )
				{
					print "
						<tr class=\"$class\">
							<td>$canned_name</td>
							<td>$canned_message</td>
							<td>$department</td>
							<td>$edit_string</td>
							<td>$delete_string</td>
						</tr>
					" ;
				}
			}
		?>
		<tr> 
		  <td colspan=5 class="hdash2"><img src="../images/spacer.gif" width="1" height="1"></td>
		</tr>
		</table>

		<a name="theform"><form method="POST" action="canned.php" name="form"></a>
		<input type="hidden" name="action" value="add_canned">
		<input type="hidden" name="prev_action" value="<? echo $action ?>">
		<input type="hidden" name="type" value="c">
		<input type="hidden" name="sid" value="<? echo $sid ?>">
		<input type="hidden" name="cannedid" value="<? echo $cannedid ?>">

		<table cellspacing=0 cellpadding=2 border=0>
		<tr> 
			<td>Reference</td>
			<td><input name="name" type="text" style="width:100px" size="<? echo $text_width ?>" maxlength="20" value="<? echo $cannedinfo['name'] ?>"> <i>(example: PUSH demo)</i></td>
		</tr>
		<tr>
			<td>Command</td>
			<td><select name="command" OnChange="put_command( this.selectedIndex )">
				<option value=""></option>
				<option value="push:" <? echo $selected_push ?>>push:</option>
				<option value="email:" <? echo $selected_email ?>>email:</option>
				<option value="url:" <? echo $selected_url ?>>url:</option>
				<option value="image:" <? echo $selected_image ?>>image:</option>
				</select> <font color="#FF0000">*</font>
			</td>
		</tr>
		<tr>
			<td>Message</td>
			<td><input type="text" name="message" size="<? echo $text_width_long - 5 ?>" OnFocus="check_command()" OnBlur="new_string=replace(this.value, ' ', '');this.value=new_string;return true;" value="<? echo preg_replace( "/\"/", "&quot;", stripslashes( $cannedinfo['message'] ) ) ?>"></td>
		</tr>
		<tr>
			<td>Department</td>
			<td><select name="deptid"><option value="0" <?= ( $cannedinfo['deptID'] == 0 ) ? "selected" : "" ?>>All My Departments</option>
			<?
				for ( $c = 0; $c < count( $admin_departments ); ++$c )
				{
					$department = $admin_departments[$c] ;
					$selected = "" ;
					if ( $department['deptID'] == $cannedinfo['deptID'] )
						$selected = "selected" ;

					print "<option value=\"$department[deptID]\" $selected>$department[name]</option>" ;
				}
			?><select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" class="mainButton" value="Submit" OnClick="do_submit()"></td>
		</tr>
		</table>

		<br>
		
		<ul><font color="#FF0000">*</font> Commands
			<li> <b>url:</b><i> URL</i> (hyperlink a URL)
			<li> <b>email:</b><i> example@thesite.com</i> (hyperlink an email)
			<li> <b>image:</b><i> URL/sample.gif</i> (embed an image)
			<li> <b>push:</b><i> URL</i>  (opens new browser containing URL of webpage, word docs, etc.)
		</ul>

		</form>
	  </td>








<?
	elseif ( $action == "canned_initiate" ):
	$canneds = ServiceCanned_get_UserCannedByType( $dbh, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'], 0, 'i', $admin_dept_select_string ) ;
	$cannedinfo = ServiceCanned_get_CannedInfo( $dbh, $cannedid, $HTTP_SESSION_VARS['session_admin'][$sid]['admin_id'] ) ;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
    <td width="100%" height="350" valign="top"> 
	  <p><span class="title">Operator: Canned Initiate Message</span><br>
		When you intiate a chat with a visitor, you can select the opening question/intro.  Input your messages below for your selection choices.</p>
	<table cellspacing=1 cellpadding=2 border=0 width="100%">
	  <tr> 
		<th align="left" nowrap>Reference</th>
		<th align="left">Message</th>
		<th align="center">&nbsp;</th>
		<th align="center">&nbsp;</th>
	  </tr>
	  <?
			for ( $c = 0; $c < count( $canneds ); ++$c )
			{
				$canned = $canneds[$c] ;

				$canned_name = Util_Format_ConvertSpecialChars( $canned['name'] ) ;
				$canned_message = Util_Format_ConvertSpecialChars( $canned['message'] ) ;

				$class = "altcolor1" ;

				$edit_string = "&nbsp;" ;
				$delete_string = "&nbsp;" ;
				if ( $canned['userID'] == $admin['userID'] )
				{
					$edit_string = "<a href=\"canned.php?sid=$sid&deptid=$deptid&action=canned_initiate&cannedid=$canned[cannedID]\">Edit</a>" ;
					$delete_string = "<a href=\"JavaScript:do_delete( $canned[cannedID] )\">Delete</a>" ;
				}

				if ( ( $canned['userID'] == $admin['userID'] ) || ( $canned['userID'] > 10000000 ) )
				{
					print "
						<tr class=\"$class\">
							<td>$canned_name</td>
							<td>$canned_message</td>
							<td>$edit_string</td>
							<td>$delete_string</td>
						</tr>
					" ;
				}
			}
		?>
	  <tr> 
		<td colspan=4 class="hdash2"><img src="../images/spacer.gif" width="1" height="1"></td>
	  </tr>
	  </table>

		<form method="POST" action="canned.php" name="form">
		<input type="hidden" name="action" value="add_canned">
		<input type="hidden" name="prev_action" value="<? echo $action ?>">
		<input type="hidden" name="type" value="i">
		<input type="hidden" name="sid" value="<? echo $sid ?>">
		<input type="hidden" name="cannedid" value="<? echo $cannedid ?>">
		<input type="hidden" name="deptid" value="0">
		<table cellspacing=0 cellpadding=2 border=0>
		<tr> 
			<td>Reference</td>
			<td> <input name="name" type="text" style="width:100px" size="<? echo $text_width ?>" maxlength="20" value="<? echo stripslashes( $cannedinfo['name'] ) ?>"> <i>(example: Sales Intro)</i></td>
		</tr>
		<tr>
			<td>Message</td>
			<td> <input name="message" type="text" size="<? echo $text_width_long ?>" value="<? echo preg_replace( "/\"/", "&quot;", stripslashes( $cannedinfo['message'] ) ) ?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td> <input type="button" class="mainButton" value="Submit" OnClick="do_submit()"></td>
		</tr>
		</table>

	  </form>
    </td>












<? else: ?>
<!-- future release may use this space -->




<? endif ; ?>
	<td style="background-image: url(../images/g_canned_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
  </tr>
</table>

<? include_once( "../setup/footer.php" ); ?>