<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*
	* This script tracks users and updates their status as they visit different
	* pages.  Footprint is done with image.php, NOT this script.  This script
	* is mainly used to keep the visitor status current so it registers the visitor
	* as still on the site.
	*******************************************************/
	$page = $x = $l = $action = "" ;
	if ( isset( $HTTP_GET_VARS['page'] ) ) { $page = $HTTP_GET_VARS['page'] ; }
	if ( isset( $HTTP_GET_VARS['x'] ) ) { $x = $HTTP_GET_VARS['x'] ; }
	if ( isset( $HTTP_GET_VARS['l'] ) ) { $l = $HTTP_GET_VARS['l'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }

	if ( !file_exists( "./web/$l/$l-conf-init.php" ) || !file_exists( "./web/conf-init.php" ) )
	{
		if ( preg_match( "//", $HTTP_SERVER_VARS['SERVER_NAME'] ) )
		{
						HEADER( "location: index.php" ) ;
		}
		else
			print "<font color=\"#FF0000\">Config error: reason: $HTTP_GET_VARS[l] config not found!  Exiting... [image.php]</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;
	include_once("$DOCUMENT_ROOT/web/$l/$l-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint_unique/put.php") ;

	// image to load, if no request is made
	$image_path_no = "$DOCUMENT_ROOT/images/empty_nodelete.gif" ;
	// image to load if request is made (popup)
	$image_path_popup = "$DOCUMENT_ROOT/images/empty_nodelete2.gif" ;
	// image to load if request is made (scroll)
	$image_path_scroll = "$DOCUMENT_ROOT/images/empty_nodelete3.gif" ;
	// image to load if push survey
	$image_path_survey = "$DOCUMENT_ROOT/images/counters/20.gif" ;

	$remote_addr = $HTTP_SERVER_VARS['REMOTE_ADDR'] ;
	if ( $action == "reject" )
	{
		include_once("$DOCUMENT_ROOT/API/Chat/update.php") ;
		include_once("$DOCUMENT_ROOT/API/Chat/Util.php") ;
		$initiate_file = "$remote_addr.pop" ;
		if ( file_exists( "$DOCUMENT_ROOT/web/chatrequests/$remote_addr.scr" ) )
			$initiate_file = "$remote_addr.scr" ;
		$requestarray = file( "$DOCUMENT_ROOT/web/chatrequests/$initiate_file" ) ;
		$requestid = rtrim( $requestarray[0] ) ;
		$sessionid = rtrim ( $requestarray[1] ) ;
		$adminid = rtrim( $requestarray[2] ) ;
		ServiceChat_update_ChatRequestLogStatus( $dbh, $sessionid, 5 ) ;
		$string = "<STRIP_FOR_PLAIN><script language=\"JavaScript\">window.parent.window.options.stop_timer();</script><JKEEP><hr><font color=\"#FF0000\">Visitor has declined the chat invitation.  <b>Chat has ended.</b></font><hr></STRIP_FOR_PLAIN>" ;
		UtilChat_AppendToChatfile( $sessionid."_visitor.txt", $string ) ;
		unlink( "$DOCUMENT_ROOT/web/chatrequests/$initiate_file" ) ;
	}
	else
	{
		$page = urldecode( $page ) ;
		ServiceFootprintUnique_put_Footprint( $dbh, $remote_addr, $page, $x ) ;
	}
	
	mysql_close( $dbh['con'] ) ;
	if ( file_exists( "$DOCUMENT_ROOT/web/chatrequests/$remote_addr.pop" ) && $remote_addr )
	{
		Header( "Content-type: image/gif" ) ;
		readfile( $image_path_popup ) ;
	}
	else if ( file_exists( "$DOCUMENT_ROOT/web/chatrequests/$remote_addr.scr" ) && $remote_addr )
	{
		Header( "Content-type: image/gif" ) ;
		readfile( $image_path_scroll ) ;
	}
	else if ( file_exists( "$DOCUMENT_ROOT/web/chatrequests/$remote_addr.s" ) && $remote_addr )
	{
		Header( "Content-type: image/gif" ) ;
		readfile( $image_path_survey ) ;
	}
	else
	{
		Header( "Content-type: image/gif" ) ;
		readfile( $image_path_no ) ;
	}
?>