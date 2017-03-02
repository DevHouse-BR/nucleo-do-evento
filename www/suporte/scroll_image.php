<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	$x = $l = "" ;
	if ( isset( $HTTP_GET_VARS['x'] ) ) { $x = $HTTP_GET_VARS['x'] ; }
	if ( isset( $HTTP_GET_VARS['l'] ) ) { $l = $HTTP_GET_VARS['l'] ; }

	if ( !file_exists( "./web/$l/$l-conf-init.php" ) || !file_exists( "./web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;
	include_once("$DOCUMENT_ROOT/web/$l/$l-conf-init.php") ;

	// image to load
	$image = "$DOCUMENT_ROOT/images/initiate_chat.gif" ;
	if ( isset( $INITIATE_IMAGE ) && file_exists( "$DOCUMENT_ROOT/web/$l/$INITIATE_IMAGE" ) && $INITIATE_IMAGE && $INITIATE )
		$image = "$DOCUMENT_ROOT/web/$l/$INITIATE_IMAGE" ;
	Header( "Content-type: image/gif" ) ;
	readfile( $image ) ;
?>