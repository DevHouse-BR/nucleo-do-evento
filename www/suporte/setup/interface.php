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

	$section = 2;			// Section number - see header.php for list of section numbers

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
    <td width="100%" height="350" valign="top"> 
	  <p><span class="title">Interface</span><br></p>
	
			Customize your chat window colors and Language.<br>
			<big><li> <strong><a href="customize.php?action=colors">Customize Colors &amp; Language</a></strong></big></p>
			<p>
			Set your default live support status icons.<br>
			<big><li> <strong><a href="customize.php?action=icons">Default Chat Icons</a></strong></big></p>

			<? if ( $INITIATE && !file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) && file_exists( "$DOCUMENT_ROOT/admin/traffic/admin_puller.php" ) ): ?>
			<p>
			Set your default Initiate Chat scrolling image.<br>
			<big><li> <strong><a href="customize.php?action=initiate">Initiate Chat Image</a></strong></big></p>
			<? endif ; ?>
	</td>
	<td style="background-image: url(../images/g_interface_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<?php 
// Include Footer
include_once("footer.php");


?>
