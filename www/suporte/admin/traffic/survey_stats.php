<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: ../../setup/index.php" ) ; exit ; }
	if ( !file_exists( "../../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../../web/conf-init.php" ) )
	{
		HEADER( "location: ../../setup/options.php" ) ;
		exit ;
	}
	include_once("../../web/conf-init.php");
	include_once("$DOCUMENT_ROOT/web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APISurvey/get.php") ;
	$section = 6;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)
	$nav_line = "<a href=\"$BASE_URL/setup/options.php\" class=\"nav\">:: Home</a>" ;
	$css_path = "../../" ;
?>
<?

	// initialize
	$action = $error_mesg = "" ;
	$success = $deptid = $surveyid = 0 ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "12" ;
	else
		$text_width = "9" ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['surveyid'] ) ) { $surveyid = $HTTP_GET_VARS['surveyid'] ; }
	if ( isset( $HTTP_POST_VARS['surveyid'] ) ) { $surveyid = $HTTP_POST_VARS['surveyid'] ; }

	if ( $action )
		$nav_line = "<a href=\"$BASE_URL/admin/traffic/survey.php\" class=\"nav\">:: Previous</a>" ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<? include_once("$DOCUMENT_ROOT/setup/header.php") ; ?>
<script language="JavaScript">
<!--
	
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td width="100%" valign="top"> 
	<p><span class="title">Survey: Proactive Survey Results</span><br>
	  Create or Edit your <i>Proactive Survey</i> &reg; to gather information from your website visitors.  You can instantly push surveys to website vistors directly from the operator traffic monitor.</p>


		<table cellspacing=0 cellpadding=2 border=0>
		
		</table>
	
	</td>
  <td height="350" align="center" style="background-image: url(../../images/g_survey_big.jpg);background-repeat: no-repeat;"><img src="../../images/spacer.gif" width="229" height="1"></td>
</tr>
</table>

<? include_once( "$DOCUMENT_ROOT/setup/footer.php" ) ; ?>