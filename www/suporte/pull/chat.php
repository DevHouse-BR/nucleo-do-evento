<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$sessionid = $requestid = $string = "" ;
	$session_chat = $HTTP_SESSION_VARS['session_chat'] ;
	$sid = ( isset( $HTTP_GET_VARS['sid'] ) ) ? $HTTP_GET_VARS['sid'] : $HTTP_POST_VARS['sid'] ;
	if ( isset( $HTTP_POST_VARS['sessionid'] ) ) { $sessionid = $HTTP_POST_VARS['sessionid'] ; }
	if ( isset( $HTTP_GET_VARS['sessionid'] ) ) { $sessionid = $HTTP_GET_VARS['sessionid'] ; }
	if ( isset( $HTTP_POST_VARS['requestid'] ) ) { $requestid = $HTTP_POST_VARS['requestid'] ; }
	if ( isset( $HTTP_GET_VARS['requestid'] ) ) { $requestid = $HTTP_GET_VARS['requestid'] ; }

	if ( !file_exists( "../web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting...</font>" ;
		exit ;
	}
	include_once("../web/conf-init.php") ;	
	include_once("../web/".$session_chat[$sid]['asp_login']."/".$session_chat[$sid]['asp_login']."-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/Util.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/update.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Chat/put.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Logs/get.php") ;

	// update chat activity time to keep track to see if they are still chatting
	ServiceChat_update_ChatActivityTime( $dbh, $session_chat[$sid]['screen_name'], $sessionid, 0 ) ;
	ServiceChat_remove_CleanChatSessionList( $dbh ) ;
	$total_chatting = ServiceChat_get_SessionUserTotal( $dbh, $sessionid ) ;

	// print out a message if the party has left (if there is no record of the party in
	// the chatsessionlist table.
	if ( ( $total_chatting <= 1 ) && ( $HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] >= 2 ) )
	{
		if ( $HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] == 2 )
		{
			$timestamp = date( "$TIMEZONE_FORMAT:i:s$TIMEZONE_AMPM", ( time() + $TIMEZONE ) ) ;
			// ONLY use this lang pack if needed....we don't want to keep loading it with
			// each refresh.
			include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;

			// JKEEP is used as a flag to signal NOT to strip JavaScript for the admin's chat...
			// usually JavaScript is stripped so the pushed webpage does not popup.
			$string = "<STRIP_FOR_PLAIN><script language=\"JavaScript\">window.parent.window.options.stop_timer();</script><JKEEP><font color=\"#FF0000\"><b><tstamp ($timestamp) tstamp>$LANG[CHAT_PARTYLEFTSESSION]</b></font><br></STRIP_FOR_PLAIN>" ;
			UtilChat_AppendToChatfile( $session_chat[$sid]['chatfile_get'], $string ) ;
			UtilChat_AppendToChatfile( $session_chat[$sid]['chatfile_transcript'], $string ) ;
			++$HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] ;
			// add the last one so it does not keep writing the message
		}
	}
	else if ( ( $total_chatting == 1 ) && ( !$HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] ) )
	{
		++$HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] ;
		// $session_chat[$sid][total_counter] is now 1
	}
	// this situation is when admin accepts chat... then there is already 2 people but
	// $session_chat[total_counter] is undefined
	else if ( ( $total_chatting == 2 ) && ( !$HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] ) )
	{
		$HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] = 1 ;
		// $session_chat[$sid][total_counter] is now 1
	}
	else if ( ( $total_chatting == 2 ) && ( $HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] <= 1 ) )
	{
		++$HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] ;
		// $session_chat[$sid][total_counter] is now 2
	}

	// let's check the polling time so we can automatically transfer the call
	// to the next operator if the current operator does not pickup
	// let's ONLY do this if one person is chatting and they are NOT admin
	if ( ( $HTTP_SESSION_VARS['session_chat'][$sid]['admin_poll_time'] < ( time() - $POLL_TIME ) ) && ( $total_chatting == 1 ) && !$session_chat[$sid]['isadmin'] && ( $HTTP_SESSION_VARS['session_chat'][$sid]['total_counter'] == 1 ) || file_exists( "$DOCUMENT_ROOT/web/chatpolling/$sessionid.txt" ) )
	{
		// delete the chatpolling flag (happens when operator rejects)
		if ( file_exists( "$DOCUMENT_ROOT/web/chatpolling/$sessionid.txt" ) )
			unlink( "$DOCUMENT_ROOT/web/chatpolling/$sessionid.txt" ) ;

		$admin = AdminUsers_get_LessLoadedDeptUser( $dbh, $session_chat[$sid]['deptid'], $HTTP_SESSION_VARS['session_chat'][$sid]['admin_poll_list'], $session_chat[$sid]['aspID'] ) ;
		// if we were able to poll another admin, then let's transfer the call...
		// if not, send the call to "leave a message" form.
		// ALSO: if no deptid (or 0), then it's an operator-to-operator and
		// we don't want to poll to next... take it to leave a message
		if ( isset( $admin['userID'] ) && $session_chat[$sid]['deptid'] )
		{
			$now = time() ;
			// put request log here so it tracks if operator took the call, not took the call,
			// or reject (busy) the call
			$requestloginfo = ServiceLogs_get_SessionRequestLog( $dbh, $sessionid ) ;
			// change the chatsession name to keep the log and then put new log
			ServiceChat_update_ChatRequestLogValue( $dbh, $sessionid, "chat_session", "$requestloginfo[userID]-$sessionid" ) ;

			$browser = stripslashes( $requestloginfo['browser'] ) ;
			ServiceChat_put_ChatRequestLog( $dbh, $admin['userID'], $requestloginfo['deptID'], $requestloginfo['surveyID'], $sessionid, $requestloginfo['display_resolution'], $requestloginfo['url'], $requestloginfo['aspID'], 0, $requestloginfo['ip'], $browser ) ;

			$requestinfo = ServiceChat_get_ChatRequestInfo( $dbh, $requestid ) ;
			// when userID is 999999999, it means previous op hit "busy"
			if ( $requestinfo['userID'] == 999999999 )
				ServiceChat_update_TransferCall( $dbh, $requestid, $admin['userID'], $session_chat[$sid]['deptid'], 2 ) ;
			else
				ServiceChat_update_TransferCall( $dbh, $requestid, $admin['userID'], $session_chat[$sid]['deptid'], 1 ) ;
			$HTTP_SESSION_VARS['session_chat'][$sid]['admin_poll_list'] .= " AND chat_admin.userID <> $admin[userID]" ;
			$HTTP_SESSION_VARS['session_chat'][$sid]['admin_poll_time'] = $now + 3 ;	// add 3 seconds extra buffer
		}
		else
		{
			$string = "<JKEEP><script language=\"JavaScript\"> window.parent.message_box(); </script>" ;
			UtilChat_AppendToChatfile( $session_chat[$sid]['chatfile_get'], $string ) ;

			// only update the session log if it has not been rejected
			$chatsession_log_info = ServiceLogs_get_SessionRequestLog( $dbh, $session_chat[$sid]['sessionid'] ) ;
			if ( $chatsession_log_info['status'] != 3 )
				ServiceChat_update_ChatRequestLogStatus( $dbh, $session_chat[$sid]['sessionid'], 0 ) ;
			ServiceChat_remove_ChatRequest( $dbh, $requestid ) ;
		}
	}

	// put writing flag file if is writing
	if ( isset( $HTTP_GET_VARS['iswriting'] ) && ( $HTTP_GET_VARS['iswriting'] == 1 ) )
	{
		$fp = fopen("$DOCUMENT_ROOT/web/chatsessions/w_".$session_chat[$sid]['chatfile_put'], "a");
		fwrite( $fp, $string, strlen( $string ) ) ;
		fclose( $fp ) ;
	}
	else if ( isset( $HTTP_GET_VARS['iswriting'] ) )
	{
		// remove the write flag file
		if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/w_".$session_chat[$sid]['chatfile_put'] ) )
			unlink( "$DOCUMENT_ROOT/web/chatsessions/w_".$session_chat[$sid]['chatfile_put'] ) ;
	}
	mysql_close( $dbh['con'] ) ;

	Header( "Content-type: image/gif" ) ;
	if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/".$session_chat[$sid]['chatfile_get'] ) && !is_dir( "$DOCUMENT_ROOT/web/chatsessions/".$session_chat[$sid]['chatfile_get'] ) )
		readfile( "$DOCUMENT_ROOT/images/empty_nodelete.gif" ) ;
	else if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/w_".$session_chat[$sid]['chatfile_get'] ) )
		readfile( "$DOCUMENT_ROOT/images/empty_nodelete2.gif" ) ;
	else
		readfile( "$DOCUMENT_ROOT/images/empty_nodelete3.gif" ) ;
?>