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
	$action = $userid = $deptid = $error = "" ;
	$success = 0 ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "20" ;
	else
		$text_width = "10" ;
	$timespan_select = ARRAY( "Days", "Months", "Years" ) ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['deptid'] ) ) { $deptid = $HTTP_GET_VARS['deptid'] ; }
	if ( isset( $HTTP_POST_VARS['deptid'] ) ) { $deptid = $HTTP_POST_VARS['deptid'] ; }
	if ( isset( $HTTP_GET_VARS['userid'] ) ) { $userid = $HTTP_GET_VARS['userid'] ; }
	if ( isset( $HTTP_POST_VARS['userid'] ) ) { $userid = $HTTP_POST_VARS['userid'] ; }
	if ( isset( $HTTP_GET_VARS['success'] ) ) { $success = $HTTP_GET_VARS['success'] ; }
	if ( isset( $HTTP_POST_VARS['success'] ) ) { $success = $HTTP_POST_VARS['success'] ; }

	LIST( $COMPANY_NAME ) = EXPLODE( "<:>", $COMPANY_NAME ) ;
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "add_user" )
	{
		// if $userid is passed, then we want to update that userid
		$rateme = 0 ;
		if ( isset( $HTTP_POST_VARS['rateme'] ) ) { $rateme = $HTTP_POST_VARS['rateme'] ; }
		$op2op = 0 ;
		if ( isset( $HTTP_POST_VARS['op2op'] ) ) { $op2op = $HTTP_POST_VARS['op2op'] ; }
		if ( $userid )
		{
			$edit_admin = AdminUsers_get_UserInfo( $dbh, $userid, $session_setup['aspID'] ) ;
			if ( !AdminUsers_get_IsNameTaken( $dbh, $HTTP_POST_VARS['name'], $session_setup['aspID'] ) || ( $edit_admin['name'] == stripslashes( $HTTP_POST_VARS['name'] ) ) )
			{
				AdminUsers_update_User( $dbh, $userid, $HTTP_POST_VARS['login'], $HTTP_POST_VARS['password'], $HTTP_POST_VARS['name'], $HTTP_POST_VARS['email'], addslashes( $COMPANY_NAME ), $session_setup['aspID'], $rateme, $op2op ) ;
				
				$userid = 0 ;
				$edit_admin = ARRAY() ;
				unset( $HTTP_POST_VARS['edit_admin'] ) ;
				$success = 1 ;
			}
			else
				$error = "The name ($HTTP_POST_VARS[name]) is already in use.  Please choose another name." ;
		}
		else
		{
			// let's check to make sure they do not exceed max number of users
			$aspinfo = AdminASP_get_UserInfo( $dbh, $session_setup['aspID'] ) ;
			$total_users = AdminUsers_get_TotalUsers( $dbh, $session_setup['aspID'] ) ;

			if ( $total_users < $aspinfo['max_users'] )
			{
				if ( !AdminUsers_get_IsLoginTaken( $dbh, $HTTP_POST_VARS['login'], $session_setup['aspID'] ) )
				{
					if ( !AdminUsers_get_IsNameTaken( $dbh, $HTTP_POST_VARS['name'], $session_setup['aspID'] ) )
					{
						if ( AdminUsers_put_user( $dbh, $HTTP_POST_VARS['login'], $HTTP_POST_VARS['password'], $HTTP_POST_VARS['name'], $HTTP_POST_VARS['email'], addslashes( $COMPANY_NAME ), $session_setup['aspID'], $rateme, $op2op ) )
							$success = 1 ;
						else
							$error = "Error: ".$dbh['error'] ;
					}
					else
						$error = "The name (". stripslashes( $HTTP_POST_VARS['name'] ) .") is already in use.  Please choose another name." ;
				}
				else
					$error = "The login ($HTTP_POST_VARS[login]) is already in use. Please use another." ;
			}
			else
				$error = "Your MAX operator limit has been reached!  User COULD NOT be added." ;
		}
	}
	else if ( ( $action == "add_deptuser" ) && isset( $HTTP_POST_VARS['users'] ) )
	{
		$users = $HTTP_POST_VARS['users'] ;
		if ( isset( $HTTP_POST_VARS['deptids'] ) )
		{
			$deptids = $HTTP_POST_VARS['deptids'] ;

			for ( $c = 0; $c < count( $deptids ); ++$c )
			{
				$deptid = $deptids[$c] ;
				for ( $c2 = 0; $c2 < count( $users ); ++$c2 )
				{
					AdminUsers_put_DeptUser( $dbh, $users[$c2], $deptid ) ;
				}
			}
			$deptid = 0 ;
			$success = 1 ;
		}
	}
	else if ( $action == "delete" )
	{
		AdminUsers_remove_user( $dbh, $userid, $session_setup['aspID'] ) ;
		$userid = 0 ;
		unset( $HTTP_POST_VARS['edit_admin'] ) ;
	}
	else if ( $action == "delete_deptuser" )
	{
		AdminUsers_remove_DeptUser( $dbh, $userid, $deptid ) ;
		$userid = 0 ;
		unset( $HTTP_POST_VARS['edit_admin'] ) ;
	}
	else if ( $action == "order" )
	{
		$users = $HTTP_POST_VARS['order'] ;
		while ( LIST ( $userid, $order ) = EACH( $users ) )
		{
			AdminUsers_update_UserDeptOrder( $dbh, $userid, $deptid, $order ) ;
		}
		HEADER ( "location: adduser.php?deptid=$deptid&success=1" ) ;
		exit ;
	}

	if ( $userid )
		$edit_admin = AdminUsers_get_UserInfo( $dbh, $userid, $session_setup['aspID'] ) ;

	$admins = AdminUsers_get_AllUsers( $dbh, 0, 0, $session_setup['aspID'] ) ;
	$departments = AdminUsers_get_AllDepartments( $dbh, $session_setup['aspID'], 1 ) ;
?>
<? include_once("./header.php"); ?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<script language="JavaScript">
<!--
	function do_update_user()
	{
		if ( ( document.user.name.value == "" ) || ( document.user.login.value == "" )
			|| ( document.user.password.value == "" ) || ( document.user.email.value == "" ) )
		{
			alert( "All fields must be supplied." ) ;
		}
		else
			document.user.submit() ;
	}

	function do_delete( userid )
	{
		if ( confirm( "Are you sure you want to delete?" ) )
			location.href = "adduser.php?action=delete&userid="+userid ;
	}

	function remove_deptuser( userid, deptid )
	{
		if ( confirm( "Really delete this user from this department?" ) )
			location.href = "adduser.php?action=delete_deptuser&userid="+userid+"&deptid="+deptid ;
	}

	function do_alert()
	{
		if( <? echo $success ?> )
			alert( 'Success!' ) ;
	}
//-->
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="15" OnLoad="do_alert()">
<tr> 
  <td valign="top"><p><span class="title">Manager: Create/Edit Operator</span><br>
	  Here, you can create, edit or delete your operators.</p>
	<ul>
	  <li><span class="hilight">Remember</span>, after you create a new operator, YOU MUST ASSIGN the 
		operator to a department. </li>
	  <li> The system also allows you to assign an operator to multiple 
		departments. </li>
	</ul>
	<font color="#FF0000"><? echo $error ?></font>
	<p>
	
	<strong><big>Step 1:</big></strong> Create an Operator<br> <table cellpadding=3 cellspacing=1 border=0 width="100%">
	  <form method="POST" action="adduser.php" name="user">
		<input type="hidden" name="userid" value="<?= isset( $edit_admin['userID'] ) ? $edit_admin['userID'] : "" ?>">
		<input type="hidden" name="action" value="add_user">
		<tr align="left"> 
		  <th colspan="4">Operator</th>
		</tr>
		<tr class="altcolor1"> 
		  <td>Login</td>
		  <td> <input type="text" name="login" size="<? echo $text_width ?>" maxlength="15" value="<?= isset( $edit_admin['login'] ) ? $edit_admin['login'] : "" ?>"></td>
		  <td>Password</td>
		  <td> <input type="text" name="password" size="<? echo $text_width ?>" maxlength="15"></td>
		</tr>
		<tr class="altcolor1"> 
		  <td>Name</td>
		  <td> <input type="text" name="name" size="<? echo $text_width ?>" maxlength="50" value="<?= isset( $edit_admin['name'] ) ? $edit_admin['name'] : "" ?>"></td>
		  <td>Email</td>
		  <td> <input type="text" name="email" size="<? echo $text_width ?>" maxlength="150" value="<?= isset( $edit_admin['email'] ) ? $edit_admin['email'] : "" ?>"></td>
		</tr>
		<tr class="altcolor1">
			<td colspan=4>Allow visitors to rate this operator's level of support: <input type="checkbox" name="rateme" value=1 <?= ( isset( $edit_admin['rateme'] ) && $edit_admin['rateme'] ) ? "checked" : "" ?>></td>
		</tr>
		<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/admin_puller.php" ) ): ?>
		<tr class="altcolor1">
			<td colspan=4>Allow operator-to-operator chat: <input type="checkbox" name="op2op" value=1 <?= ( isset( $edit_admin['op2op'] ) && $edit_admin['op2op'] ) ? "checked" : "" ?>></td>
		</tr>
		<? endif ; ?>
		<tr align="center"> 
		  <td colspan=4> <input type="button" class="mainButton" onClick="do_update_user()" value="Add/Edit Operator"> 
		  </td>
		</tr>
	  </form>
	</table>
	<br>
	<table cellspacing=0 cellpadding=0 border=0 width="100%"><tr><td height="2" colspan=3 class="hdash"><img src="../images/spacer.gif" width="1" height="2"></td></tr></table>
	<br>
	<strong><big>Step 2:</big></strong> Assign Operator to a department.<br> 
	<table cellspacing=1 cellpadding=3 border=0 width="100%">
	  <tr> 
		<th width="5">&nbsp;</th>
		<th width="60" align="left">Login</th>
		<th align="left">Name</th>
		<th align="left">Email</th>
		<th align="center">&nbsp;</th>
		<th align="center">&nbsp;</th>
	  </tr>
		<form method="POST" action="adduser.php">
		<input type="hidden" name="action" value="add_deptuser">
		<?
			for ( $c = 0; $c < count( $admins ); ++$c )
			{
				$admin = $admins[$c] ;
				$date = date( "D m/d/y h:i a", $admin['created'] ) ;

				$class = "altcolor1" ;
				if ( $c % 2 )
					$class = "altcolor2" ;

				print "
					<tr class=\"$class\">
						<td><input type=\"checkbox\" name=\"users[]\" value=\"$admin[userID]\" class=\"checkbox\"></td>
						<td>$admin[login]</td>
						<td>$admin[name]</td>
						<td><a href=\"mailto:$admin[email]\">$admin[email]</a></td>
						<td align=\"center\"><a href=\"adduser.php?userid=$admin[userID]\">Edit</a></td>
						<td align=\"center\"><a href=\"JavaScript:do_delete( $admin[userID] )\">Delete</a></td>
					</tr>
				" ;
			}
		?>
		<tr> 
		  <td colspan="8">
			<table cellspacing=0 cellpadding=2 border=0>
			<tr>
				<td>Add checked operator(s) to department<br><i>(press "Ctrl" key to multi-select)</i></td>
				<td>
					<select name="deptids[]" size=3 multiple style="width:150" width="150">
					<?
						for ( $c = 0; $c < count( $departments ); ++$c )
						{
							$department = $departments[$c] ;
							print "<option value=$department[deptID]>$department[name]</option>" ;
						}
					?>
					</select>
				</td>
				<td><input type="submit" class="mainButton" value="Submit"></td>
			</tr>
			</table>
			</td>
		</tr>
	  </form>
	</table>
	<p>&nbsp; </p></td>
	<td valign="top">
		<table cellspacing=1 cellpadding=3 border=0 width="100%">
	  <tr> 
		<th width=80 align="left">Department</th>
		<th align="left">Assigned Operators</th>
	  </tr>
	<?
		for ( $c = 0; $c < count( $departments ); ++$c )
		{
			$department = $departments[$c] ;
			$department_users = AdminUsers_get_AllDeptUsers( $dbh, $department['deptID'] ) ;
	
			$display_string = "" ;
			if ( !$department['visible'] )
				$display_string = "(hidden)" ;

			print "<tr class=\"altcolor2\"><td valign=\"top\">$department[name]<br>$display_string</td>" ;
			print "
					<td valign=\"top\">
					<form method=POST action=\"adduser.php\">
					<input type=\"hidden\" name=\"action\" value=\"order\">
					<input type=\"hidden\" name=\"deptid\" value=\"$department[deptID]\">
					<table cellspacing=0 cellpadding=2 border=0>
			" ;

			$update_string = "" ;
			if ( count( $department_users ) > 0 )
				$update_string = "Update Request Order <input type=\"submit\" class=\"mainButton\" value=\"Update Order\">" ;
			for ( $c2 = 0; $c2 < count( $department_users ); ++$c2 )
			{
				$user = $department_users[$c2] ;
				$ordernum = AdminUsers_get_DeptUserOrderNum( $dbh, $user['userID'], $department['deptID'] ) ;
				print "
						<tr>
						<td>$user[login]</td>
						<td><input type=\"text\" name=\"order[$user[userID]]\" value=\"$ordernum\" size=2 maxlength=3 onKeyPress=\"return numbersonly(event)\"></td>
						<td>[<a href=\"JavaScript:remove_deptuser( $user[userID], $department[deptID] )\">remove</a>]</td>
						</tr>
						" ;
			}
			print "</table>$update_string</form></td></tr>" ;
		}
	?>
	</table>
	</td>
  <!-- <td style="background-image: url(images/g_manage_big.jpg);background-repeat: no-repeat;"><img src="images/spacer.gif" width="229" height="1"></td> -->
</tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<? include_once( "./footer.php" ) ; ?>
