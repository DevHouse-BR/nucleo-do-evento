<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$session_chat = $HTTP_SESSION_VARS['session_chat'] ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : $HTTP_POST_VARS['sid'] ;

	if ( !file_exists( "web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php" ) || !file_exists( "web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;	
	include_once("./web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("./system.php") ;
	include_once("./lang_packs/$LANG_PACK.php") ;
	include_once("./API/sql.php") ;
	include_once("./API/Util.php") ;
	include_once("./API/Users/get.php") ;
	include_once("./API/Canned/get.php") ;
?>
<?
	// initialize

	// we use $rand to prevent loading from cached pages
	mt_srand ((double) microtime() * 1000000);
	$rand = mt_rand() ;

	$admin_dept_select_string = "deptID = ".$session_chat[$sid]['deptid'] ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title> Chat [admin canned] </title>

<? $css_path = "./" ; include( "./css/default.php" ) ; ?>

<script language="JavaScript">
<!--
	function do_select( the_form )
	{
		index = the_form.selections.selectedIndex ;
		orig_message = parent.window.writer.document.form.message.value ;
		new_message = the_form.selections[index].value ;
		parent.window.writer.document.form.message.value = new_message ;
	}
//-->
</script>

</head>
<body class="bg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<center>
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="height:10">
  <tr> 
	<td valign="top" class="bgMenuBack"></td>
  </tr>
</table>
<span class="small">

Go to your admin area to add more canned messages - <a href="chat_admin_canned.php?sid=<? echo $sid ?>&rand=<? echo $rand ?>">Refresh</a></span>
<table cellspacing=1 cellpadding=2 border=0>
<tr>
	<form name="canned_responses">
	<td><span class="small">
		Canned Responses<br>
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td>
				<select name="selections">
				<option value="">&nbsp;
				<?
					$canneds = ServiceCanned_get_UserCannedByType( $dbh, $session_chat[$sid]['admin_id'], $session_chat[$sid]['deptid'], 'r', $admin_dept_select_string ) ;
					for ( $c = 0; $c < count( $canneds ); ++$c )
					{
						$canned = $canneds[$c] ;
						$canned_name = Util_Format_ConvertSpecialChars( $canned['name'] ) ;
						$canned_message = Util_Format_ConvertSpecialChars( $canned['message'] ) ;

						print "		<option value=\"$canned_message\">$canned_name</option>\n" ;
					}
				?>
				</select>
			</td>
			<td>
				<a href="JavaScript:do_select( document.canned_responses )"><img src="images/buttons/select.gif" border=0 alt="Select"></a>
			</td>
		</tr>
		</table>
		<span>
	</td>
	</form>
	<td><font size=1>&nbsp;</font></td>
	<form name="canned_commands">
	<td><span class="small">
		Canned Commands<br>
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td>
				<select name="selections">
				<option value="">&nbsp;
				<?
					$canneds = ServiceCanned_get_UserCannedByType( $dbh, $session_chat[$sid]['admin_id'], $session_chat[$sid]['deptid'], 'c', $admin_dept_select_string ) ;
					for ( $c = 0; $c < count( $canneds ); ++$c )
					{
						$canned = $canneds[$c] ;
						$canned_name = Util_Format_ConvertSpecialChars( $canned['name'] ) ;
						$canned_message = Util_Format_ConvertSpecialChars( $canned['message'] ) ;

						print "		<option value=\"$canned_message\">$canned_name</option>\n" ;
					}
				?>
				</select>
			</td>
			<td>
				<a href="JavaScript:do_select( document.canned_commands )"><img src="images/buttons/select.gif"  border=0 alt="Select"></a>
			</td>
		</tr>
		</table>
		</span>
	</td>
	</form>
</tr>
</table>
</center>

</body>
</html>