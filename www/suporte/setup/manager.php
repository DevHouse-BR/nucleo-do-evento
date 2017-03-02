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
	$section = 1;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)

	$nav_line = '<a href="options.php" class="nav">:: Home</a>';

	// Include header
	include_once("./header.php");
?>


<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td width="100%" valign="top"> 
	<p><span class="title">Manager: Operators and Departments</span><br></p>
	  <p>Here, you can create, edit or delete your company departments.<br>
		<big><li> <strong><a href="adddept.php">Create &amp; Edit Departments</a></strong></big></p>
	  <p>Here, you can create, edit or delete your operators.<br>
		<big><li> <strong><a href="adduser.php">Create &amp; Edit Operators</a></strong></big></p>
	<p>
		Generate your Support HTML Code to place your website.<br>
		<big><li> <strong><a href="code.php">Generate HTML</a></strong></big></p>
	</td>
  <td height="350" style="background-image: url(../images/g_manage_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<?php 
// Include Footer
include_once("footer.php");


?>
