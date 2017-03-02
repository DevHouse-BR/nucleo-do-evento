<?
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: index.php" ) ; exit ; }
	if ( !file_exists( "../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php") ;
	include_once("../web/VERSION_KEEP.php") ;
	include_once("../web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("../system.php") ;
	include_once("../lang_packs/$LANG_PACK.php") ;

	$section = 7;			// Section number - see header.php for list of section numbers

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
	<p><span class="title">Marketing and Sales</span><br></p>
	  <p>
		<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/click_track.php" ) ): ?>
		Create/Edit your Click-Through tracking URLs for your marketing campaigns.<br>
		<big><li> <strong><a href="../admin/traffic/click_track.php">Create/Edit Click Track'it</a></strong></big></p>
		<p>
		<? endif; ?>
		<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/web/$session_setup[login]/salespath.php" ) ): ?>
		Understand your most important visitors (people who PURCHASED your product/service).  Sales Path will report the footprints, refer URL, and other important data of every customer that completed your purchase process.<br>
		<big><li> <strong><a href="salespath.php"><font color="#FF8080"><b>Sales Path</b></font></a></strong></big></p>
		<p>
		<? endif ; ?>
    <p>&nbsp;</p></td>
  <td height="350" align="center" style="background-image: url(../images/g_marketing_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
</table>


<?php 
// Include Footer
include_once("footer.php");


?>
