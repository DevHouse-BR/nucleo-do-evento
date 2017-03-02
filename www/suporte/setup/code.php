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
	include_once("../lang_packs/$LANG_PACK.php") ;
	include_once("../web/VERSION_KEEP.php") ;
	include_once("../system.php") ;
	include_once("../API/sql.php") ;
	include_once("../API/Users/get.php") ;
	$section = 1;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)
?>
<?
	// initialize
	$action = "" ;
	$deptid = 0 ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "30" ;
		$textbox_width = "80" ;
	}
	else
	{
		$text_width = "15" ;
		$textbox_width = "40" ;
	}

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['deptid'] ) ) { $deptid = $HTTP_GET_VARS['deptid'] ; }

	$nav_line = '<a href="options.php" class="nav">:: Home</a>' ;
	if ( $action )
		$nav_line = '<a href="code.php" class="nav">:: Previous</a>' ;

	// create survey file if not exist
	if ( !file_exists( "$DOCUMENT_ROOT/web/$session_setup[login]/surveys.php" ) )
	{
		$fp = fopen( "$DOCUMENT_ROOT/web/$session_setup[login]/surveys.php", "wb+" ) ;
		fwrite( $fp, "", strlen( "" ) ) ;
		fclose( $fp ) ;
	}
?>
<?
	// functions
?>
<?
	// conditions
?>
<? include_once("./header.php"); ?>
<script language="JavaScript">
<!--
	function gen_text_code()
	{
		if ( document.form_text.link_text.value == "" )
			alert( "Please provide a text." ) ;
		else
		{
			window.open( "code_text.php?deptid=<? echo $deptid ?>&text="+escape( document.form_text.link_text.value ), "text_code", "scrollbars=yes,menubar=no,resizable=1,location=no,width=450,height=250" ) ;
		}
	}
//-->
</script>

<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td height="350" valign="top"> <p><span class="title">Interface: Generate 
	  HTML </span><br>
	  Generate your Support HTML Code to place your website.</p>
	<ul>
	  <li>You can generate a code that displays ALL your created departments 
		OR you can generate code JUST for a particular department.</li>
	  <li> If you generate code for a specific department, the user will 
		not see the department drop-down menu. They will only be prompted 
		for their name. </li>
	</ul>
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="hdash">&nbsp;</td>
	  </tr>
	</table>

<?
	if ( $action == "generate" ):
	$BASE_URL_STRIP = $BASE_URL ;
	//$BASE_URL_STRIP = preg_replace( "/http:/", "", $BASE_URL ) ;
?>
	<li> <b>STATUS ICON HTML CODE.</b>  Simply copy the below code into your webpages.  
	<ul>
		<span class="hilight">
			<li> Please keep the code EXACTLY the way it shows. Make sure your HTML editing program does not break up the long lines.
			<li> Place the code INSIDE the &lt;body&gt; tags.  Failure to do so may cause errors.
		</span>
	</ul>
	<form>
	<textarea cols="<? echo $textbox_width ?>" rows="8" wrap="virtual" onFocus="this.select(); return true;"><!-- BEGIN PHP Live! code, (c) OSI Codes Inc. -->
<script language="JavaScript" src="<? echo $BASE_URL_STRIP ?>/js/status_image.php?base_url=<? echo $BASE_URL_STRIP ?>&l=<? echo $session_setup['login'] ?>&x=<? echo $session_setup['aspID'] ?>&deptid=<? echo $deptid ?>&btn=1"><a href=""></a></script>
<!-- END PHP Live! code : (c) OSI Codes Inc. --></textarea>
	</form>
	The above code will produce the below status icon and link.<br>
<!-- BEGIN PHP Live! code, (c) OSI Codes Inc. -->
<script language="JavaScript" src="<? echo $BASE_URL_STRIP ?>/js/status_image.php?base_url=<? echo $BASE_URL_STRIP ?>&l=<? echo $session_setup['login'] ?>&x=<? echo $session_setup['aspID'] ?>&deptid=<? echo $deptid ?>&btn=1"><a href=""></a></script>
<!-- END PHP Live! code : (c) OSI Codes Inc. -->
	<p>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="hdash">&nbsp;</td>
	  </tr>
	</table>
	<form name="form_text">
	<b>TEXT ONLY LINK</b>
	<span class="medium"><li> <b>OR</b> type in a text below to produce HTML code that is <b>TEXT ONLY</b> with no graphic image.
	<br><input type="text" name="link_text" size="<? echo $text_width ?>" maxlength="255"> <input type="button" OnClick="gen_text_code()" value="Generate Code" class="mainButton">
	</form>
	<p>


	<table width="100%" border="0" cellspacing="0" cellpadding="0">
	  <tr>
		<td class="hdash">&nbsp;</td>
	  </tr>
	</table>
	<form>
	<b>EMAIL SIGNATURE</b>
	<span class="medium"><li> Below code can be placed inside your <b>EMAIL SIGNATURE</b>.

	<textarea cols="<? echo $textbox_width ?>" rows="5" wrap="virtual" onFocus="this.select(); return true;"><a href="<? echo $BASE_URL ?>/request_email.php?l=<? echo $session_setup['login'] ?>&x=<? echo $session_setup['aspID'] ?>&deptid=<? echo $deptid ?>" target="new"><img src="<? echo $BASE_URL ?>/image.php?l=<? echo $session_setup['login'] ?>&x=<? echo $session_setup['aspID'] ?>&deptid=<? echo $deptid ?>&refer=Email+Signature" border=0 alt="Click for Live Support!"></a></textarea>
	</form>



<?
	else:
	$departments = AdminUsers_get_AllDepartments( $dbh, $session_setup['aspID'], 1 ) ;
	$totalusers = AdminUsers_get_TotalUsers( $dbh, $session_setup['aspID'] ) ;
?>
	<ul>
		<? if ( count( $departments ) <= 0 ): ?>
		<span class="hilight">Before you can generate HTML code to put on your website, you need to <a href="<? echo $BASE_URL ?>/setup/adddept.php">Create a Support Department</a>.</span>


		<? elseif ( $totalusers <= 0 ): ?>
		<span class="hilight">Before you can generate HTML code to put on your website, you need to <a href="<? echo $BASE_URL ?>/setup/adduser.php">Create an Operator</a>.</span>



		<? else: ?>
		<ul>
			<?
				$ok = 0 ;
				$output_string = "" ;
				for ( $c = 0; $c < count( $departments ); ++$c )
				{
					$department = $departments[$c] ;
					$totaluserdeptlist = AdminUsers_get_TotalUsersDeptList( $dbh, $session_setup['aspID'], $department['deptID'] ) ;
					if ( $totaluserdeptlist )
					{
						$ok = 1 ;
						if ( $department['visible'] )
							$output_string .= "<li> <a href=\"code.php?action=generate&deptid=$department[deptID]&\">$department[name]</a>\n" ;
						else
							$output_string .= "<li> $department[name] (<span class=\"hilight\">Hidden Department - code not available</span>)\n" ;
					}
					else
					{
						$output_string .= "<li> $department[name] (<span class=\"hilight\">Warning:</span> <a href=\"adduser.php\">assign operators</a>)\n" ;
					}
				}

				if ( !$ok )
					print "<span class=\"hilight\">You have not assigned an operator to a department.  Before you can generate the HTML code, you need to <a href=\"$BASE_URL/setup/adduser.php\">Assigned an operator to a Department</a>.</span>" ;
				else
					print "<li> <a href=\"$BASE_URL/setup/code.php?action=generate&deptid=0\"><strong>Generate HTML to display ALL departments.</strong></a> <p><ul>Generate HTML for ONLY the specified department below. $output_string</ul>" ;
			?>
		  </ul>
		  <? endif ; ?>
	</ul>
	
  <? endif ;?>
  </td>
	<td style="background-image: url(../images/g_manage_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
</table>


<? include_once( "./footer.php" ) ; ?>