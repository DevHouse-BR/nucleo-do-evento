<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$session_admin = $HTTP_SESSION_VARS['session_admin'] ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : $HTTP_POST_VARS['sid'] ;

	include_once("../web/conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint_unique/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/update.php") ;

	// image to load, if no request is made
	$image_path = "$DOCUMENT_ROOT/images/empty_nodelete.gif" ;

	// get admin info to see if there is kill signal
	$admin = AdminUsers_get_UserInfo( $dbh, $session_admin[$sid]['admin_id'], $session_admin[$sid]['aspID'] ) ;
	// update admin's activity time so it does not automatically have offline status
	AdminUsers_update_LastActiveTime( $dbh, $session_admin[$sid]['admin_id'], time(), $sid ) ;
	// auto update admin console to Online if offline because of connection lag
	if ( ( $admin['last_active_time'] > $admin_idle ) && ( $admin['utrigger'] == 1 ) && ( $admin['available_status'] == 0 ) )
		AdminUsers_update_AutoUpdateOnlineStatus( $dbh, $session_admin[$sid]['admin_id'] ) ;

	$total_requests = ServiceChat_get_UserTotalChatRequests( $dbh, $session_admin[$sid]['admin_id'] ) ;
	$HTTP_SESSION_VARS['session_admin'][$sid]['requests_reload'] = $total_requests ;

	// do the cleaning of the chat database and chat session txt files
	// of old requests and sessions.
	ServiceChat_remove_CleanChatSessionList( $dbh ) ;
	ServiceChat_remove_CleanChatSessions( $dbh ) ;
	ServiceChat_remove_CleanChatRequests( $dbh ) ;
	mysql_close( $dbh['con'] ) ;

	Header( "Content-type: image/gif" ) ;
	if ( ( $session_admin[$sid]['requests'] != $HTTP_SESSION_VARS['session_admin'][$sid]['requests_reload'] ) || ( $admin['signal'] == 9 ) )
	{
		readfile( $image_path ) ;
	}
	// no else statement... if request is made, make the image an error
?>