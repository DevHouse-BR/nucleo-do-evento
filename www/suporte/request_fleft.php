<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	$l = ( isset( $HTTP_GET_VARS['l'] ) ) ? $HTTP_GET_VARS['l'] : "" ;
	if ( !file_exists( "web/$l/$l-conf-init.php" ) || !file_exists( "web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/$l/$l-conf-init.php") ;
	include_once("./system.php") ;
?>
<?
	// initialize
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title> [frame left] </title>

</head>
<body bgColor="<? echo $FRAME_COLOR ?>" text="<? echo $TEXT_COLOR ?>" link="<? echo $LINK_COLOR ?>" alink="<? echo $ALINK_COLOR ?>" vlink="<? echo $VLINK_COLOR ?>" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
</body>
</html>