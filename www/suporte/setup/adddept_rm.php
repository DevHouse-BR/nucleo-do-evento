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
	include_once("../API/Users/remove.php") ;
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

	if ( $action == "do_delete" )
	{
		AdminUsers_remove_Dept( $dbh, $deptid, $HTTP_POST_VARS['transfer_deptid'], $session_setup['aspID'] ) ;
		$close_window = 1 ;
	}

	if ( $deptid )
	{
		$edit_dept = AdminUsers_get_DeptInfo( $dbh, $deptid, $session_setup['aspID'] ) ;
		LIST( $edit_exp_value, $edit_exp_word ) = explode( "<:>", $edit_dept['transcript_expire_string'] ) ;
	}

	$departments = AdminUsers_get_AllDepartments( $dbh, $session_setup['aspID'], 1 ) ;
?>
<html>
<head>
<title> Delete Department </title>
<? $css_path = "../" ; include_once( "../css/default.php" ) ; ?>
<script language="JavaScript">
<!--
	function do_alert()
	{
		if( <? echo $close_window ?> )
		{
			opener.window.location.href = "adddept.php?s=1" ;
			window.close() ;
		}
	}

	function confirm_delete()
	{
		if ( confirm( "Really delete department?" ) )
			document.form.submit() ;
	}
//-->
</script>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="do_alert()">
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="height:100%">
  <tr> 
	<td height="47" valign="top" class="bgMenuBack"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td><img src="../images/spacer.gif" width="10" height="1"></td>
		</tr>
	  </table></td>
  </tr>
  <tr> 
	<td align="center" valign="middle" class="bg">
	<? 
		if ( $action == "confirm_delete" ):
		$deptinfo = AdminUsers_get_DeptInfo( $dbh, $deptid, $session_setup['aspID'] ) ;
	?>
	<form method="POST" action="adddept_rm.php" name="form">
	<input type="hidden" name="action" value="do_delete">
	<input type="hidden" name="deptid" value="<? echo $deptid ?>">

	Transfer all users, transcripts and logs from<br>
	department <b><? echo $deptinfo['name'] ?></b> to:
	<p>
	<select name="transfer_deptid" class="select" class="select">
	<?
		for ( $c = 0; $c < count( $departments ); ++$c )
		{
			$department = $departments[$c] ;

			if ( $department['deptID'] != $deptid )
				print "<option value=".$department['deptID'].">".$department['name']."</option>" ;
		}
	?>
	</select>
	<p>
	<input type="button" class="mainButton" onClick="javaScript:confirm_delete()" value="Delete Department">
	</form>


	<? elseif ( $close_window ): ?>
	<!-- put nothing here if window is to close -->


	<? endif; ?>
</td>
  </tr>
  <tr> 
	<td height="20" align="right" class="bgFooter" style="height:20px"><img src="../images/bg_corner_footer.gif" alt="" width="94" height="20"></td>
  </tr>
  <tr> 
	<td height="20" align="center" class="bgCopyright" style="height:20px">Powered by PHP Live! - v1.9.7 &copy; OSI Codes Inc</td>
  </tr>
</table>
<!-- This navigation layer is placed at the very botton of the HTML to prevent pesky problems with NS4.x -->
</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>