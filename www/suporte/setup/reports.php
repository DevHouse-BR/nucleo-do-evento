<?
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
	$section = 3;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)

	$nav_line = '<a href="options.php" class="nav">:: Home</a>';

	// Include header
	include_once("./header.php");
?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
    <td width="100%" valign="top"> 
	  <p><span class="title">Reports</span><br></p>
	  <p>
		View visitor footprints and page views. It breaks down the top most visited pages by daily or monthly.<br>
		<big><li> <strong><a href="footprints.php">Traffic &amp; Visitor Footprints</a></strong></big></p>
	  <p>
		See where your visitors are coming from with Refer URL stats.<br>
		<big><li> <strong><a href="refer.php">Refer URL Statistics</a></strong></big></p>
	  </td>
  <td height="350" align="center" valign="bottom" style="background-image: url(../images/g_reports_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
 </table>


<?php 
// Include Footer
include_once("footer.php");


?>
