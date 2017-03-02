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
	include_once("../API/ASP/update.php") ;
	$section = 5;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)

	$nav_line = '<a href="options.php" class="nav">:: Home</a>';
?>
<?

	// initialize
	$action = $error = "" ;
	$success = 0 ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "60" ;
		$textbox_width = "70" ;
	}
	else
	{
		$text_width = "35" ;
		$textbox_width = "35" ;
	}

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "update" )
	{
		AdminASP_update_TableValue( $dbh, $session_setup['aspID'], "trans_message", $HTTP_POST_VARS['trans_message'] ) ;
		AdminASP_update_TableValue( $dbh, $session_setup['aspID'], "trans_email", $HTTP_POST_VARS['trans_email'] ) ;
		$HTTP_SESSION_VARS['session_setup']['trans_message'] = $HTTP_POST_VARS['trans_message'] ;
		$HTTP_SESSION_VARS['session_setup']['trans_email'] = $HTTP_POST_VARS['trans_email'] ;
		$session_setup['trans_message'] = $HTTP_POST_VARS['trans_message'] ;
		$session_setup['trans_email'] = $HTTP_POST_VARS['trans_email'] ;
		$success = 1 ;
	}
?>
<? include_once("./header.php"); ?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<script language="JavaScript">
<!--
	function do_submit()
	{
		if ( ( document.form.trans_message.value == "" ) || ( document.form.trans_email.value == "" ) )
			alert( "All fields MUST be provided." ) ;
		else if ( document.form.trans_email.value.indexOf("%%transcript%%") == -1 )
			alert( "Email body MUST contain the %%transcript%% variable." ) ;
		else
		{
			document.form.submit() ;
		}
	}

	function do_alert()
	{
		if( <? echo $success ?> )
			alert( 'Success!' ) ;
	}
//-->
</script>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td height="350" valign="top"> <p><span class="title">Preferences: Email 
	  Transcript</span><br>
	  You can customize the web page message of the &quot;Email Transcripts&quot; 
	  page and also the email content of the transcript letter. Place 
	  your company profile, promotions or other informative informations 
	  inside the outgoing transcript email. </p>
	  <form method="POST" action="email_transcript.php" name="form">
	<input type="hidden" name="action" value="update">
	<table cellspacing=1 cellpadding=2 border=0 width="100%">
	  <tr> 
		<td valign="top" align="right" nowrap><strong>Webpage Text:</strong></td>
		<td valign="top"> <input type="text" name="trans_message" size="<? echo $text_width ?>" maxlength="255" style="width:300px" value="<? echo stripslashes( $session_setup['trans_message'] ) ?>"></td>
	  </tr>
	  <tr>
		<td colspan=2>&nbsp;</td>
	  </tr>
	  <tr> 
		<td>&nbsp;</td>
		<td> <span class="hilight">%%username%%</span> - chat name used 
		  by visitor (optional)<br>
		  <span class="hilight">%%transcript%%</span> - the complete chat 
		  transcript. (MUST be included.)</td>
	  
	  <tr> 
		<td valign="top" align="right" nowrap><strong>Email Body:</strong></td>
		<td valign="top"> <textarea cols="<? echo $textbox_width ?>" name="trans_email" rows="12" wrap="virtual" style="width:300px"><? echo stripslashes( $session_setup['trans_email'] ) ?></textarea></td>
	  </tr>
	  <tr> 
		<td>&nbsp;</td>
		<td> <input type="button" class="mainButton" value="Submit" OnClick="do_submit()"></td>
	  </tr>
	</table>
	</form>
	</td>
  <td style="background-image: url(../images/g_prefs_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<? include_once( "./footer.php" ) ; ?>