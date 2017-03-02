<?
	$current_version = "2.8" ;
	include( "../../web/VERSION_KEEP.php" ) ;

	$error = $version = $notice_string = "" ;
	$url = 0 ;

	if ( isset( $HTTP_GET_VARS['version'] ) ) { $version = $HTTP_GET_VARS['version'] ; }
	if ( $version == "1.9.8" )
		$notice_string = "IMPORTANT!  You MUST Generate NEW HTML Code in the Setup area to avoid errors on your site and to activate the new features!" ;

	switch ( $PHPLIVE_VERSION )
	{
		case "1.9":
			$url = "1.9.5_patch.php" ;
			break ;
		case "1.9.5":
			$url = "1.9.6_patch.php" ;
			break ;
		case "1.9.6":
			$url = "1.9.7_patch.php" ;
			break ;
		case "1.9.7":
			$url = "1.9.7.1_patch.php" ;
			break ;
		case "1.9.7.1":
			$url = "1.9.7.2_patch.php" ;
			break ;
		case "1.9.7.2":
			$url = "1.9.8_patch.php" ;
			break ;
		case "1.9.8":
			$url = "1.9.9_patch.php" ;
			break ;
		case "1.9.9":
			$url = "2.0_patch.php" ;
			break ;
		case "2.0":
			$url = "2.1_patch.php" ;
			break ;
		case "2.1":
			$url = "2.1.1_patch.php" ;
			break ;
		case "2.1.1":
			$url = "2.2_patch.php" ;
			break ;
		case "2.2":
			$url = "2.3_patch.php" ;
			break ;
		case "2.3":
			$url = "2.5_patch.php" ;
			break ;
		case "2.5":
			$url = "2.5.1_patch.php" ;
			break ;
		case "2.5.1":
			$url = "2.5.2_patch.php" ;
			break ;
		case "2.5.2":
			$url = "2.6_patch.php" ;
			break ;
		case "2.6":
			$url = "2.6.1_patch.php" ;
			break ;
		case "2.6.1":
			$url = "2.6.5_patch.php" ;
			break ;
		case "2.6.5":
			$url = "2.6.6_patch.php" ;
			break ;
		case "2.6.6":
			$url = "2.7_patch.php" ;
			break ;
		case "2.7":
			$url = "2.8_patch.php" ;
			break ;
		case $current_version:
			$error = "<font color=\"#0000FF\">Your PHP Live! system is UP TO DATE.  No more patches available.<p> <a href=\"../index.php\"><li> Click Here to return to your Setup area.</a></font>" ;
			break ;
		default:
			$error = "Your PHP Live! version is too old.  You MUST do a FRESH install.  Remove this current system and install NEW." ;
	}
?>
<html>
<head>
<title> Upgrading and Patching your PHP Live! system </title>
<script language="JavaScript">
<!--
	if ( '<? echo $url ?>' && ( '<? echo $url ?>' != '0' ) )
		setTimeout("location.href='<? echo $url ?>'",5000) ;
//-->
</script>
<link rel="Stylesheet" href="../../css/base.css">
</head>

<body bgColor="#FFFFFF" text="#000000" link="#35356A" vlink="#35356A" alink="#35356A">
<table cellspacing=0 cellpadding=0 border=0 width="98%">
<tr>
	<td valign="top"><span class="basetxt">
		<img src="../../images/logo.gif">
		<p>

		<? if ( $url ): ?>
		<big><b>Upgrade Patch Available!</b></big>
		<p>
		<b>Redirecting you to <font color="#FF0000"><? echo $url ?></font> - please hold...</b></big>

		<? else: ?>
		<table cellspacing=0 cellpadding=2 border=0 bgColor="#FFBBBB" width="100%">
		<tr>
			<td><span class="basetxt"><big><b>
				<? echo $notice_string ?>
				</b></big>
			</td>
		</table>
		<p>
		<font color="#FF0000"><big><b><? echo $error ?></b></big></big>

		<? endif ; ?>
	</td>
</tr>
</table>
<p>
<font color="#9999B5"><span class="basetxt"></font>
<br>
</body>
</html>