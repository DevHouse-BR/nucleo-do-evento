<?
	/*****  ServiceChat::update  *****************************
	 *
	 *  $Id: update.php,v 1.16 2004/10/13 18:44:08 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_UPDATE_ServiceChat_LOADED ) == true )
		return ;

	$_OFFICE_UPDATE_ServiceChat_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceChat_update_ChatRequestStatus  *********************
	 *
	 *  History:
	 *	Kory Cline				Nov 8, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_update_ChatRequestValue( &$dbh,
					  $requestid,
					  $table,
					  $value )
	{
		if ( $requestid == "" )
		{
			return false ;
		}

		$value = addslashes( $value ) ;
		$query = "UPDATE chatrequests SET $table = '$value' WHERE requestID = $requestid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceChat_update_ChatActivityTime  ***********************
	 *
	 *  History:
	 *	Kory Cline				NOv 8, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_update_ChatActivityTime( &$dbh,
					  $screen_name,
					  $sessionid,
					  $future_buffer )
	{
		if ( ( $screen_name == "" ) || ( $sessionid == "" ) )
		{
			return false ;
		}

		$now = time() ;
		$now += $future_buffer ;

		// on the query, we check to see if future buffer has been added, if so, then don't
		// update the time, or session will time out!
		$screen_name = addslashes( $screen_name ) ;
		$query = "UPDATE chatsessionlist SET updated = '$now' WHERE sessionID = $sessionid AND screen_name = '$screen_name' AND updated <= '$now'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceChat_update_ChatRequestLogStatus  *********************
	 *
	 *  History:
	 *	Nate Lee				Dec 16, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_update_ChatRequestLogStatus( &$dbh,
					$chat_session,
					$status )
	{
		if ( $chat_session == "" )
		{
			return false ;
		}

		$query = "UPDATE chatrequestlogs SET status = '$status' WHERE chat_session = '$chat_session'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceChat_update_ChatRequestLogValue  *********************
	 *
	 *  History:
	 *	Kyle Hicks				May 7, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_update_ChatRequestLogValue( &$dbh,
					$chat_session,
					$column,
					$value )
	{
		if ( ( $chat_session == "" ) || ( $column == "" ) )
		{
			return false ;
		}

		$value = addslashes( $value ) ;
		$query = "UPDATE chatrequestlogs SET $column = '$value' WHERE chat_session = '$chat_session'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceChat_update_TransferCall  ***********************
	 *
	 *  History:
	 *	Kory Cline				Jan 10, 2002
	 *
	 *	tflag: 0-new, 1-polled, 2-busy, 3-transferred
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_update_TransferCall( &$dbh,
					  $requestid,
					  $new_userid,
					  $new_deptid,
					  $tflag )
	{
		if ( ( $requestid == "" ) || ( $new_userid == "" )
			|| ( $new_deptid == "" ) )
		{
			return false ;
		}

		$query = "UPDATE chatrequests SET userID = $new_userid, deptID = $new_deptid, status = 0, tstatus = 1 WHERE requestID = $requestid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			ServiceChat_update_ChatRequestValue( $dbh, $requestid, "tflag", $tflag ) ;
			return true ;
		}
		return false ;
	}

	/*****  ServiceChat_update_SessionListLogin  ***********************
	 *
	 *  History:
	 *	Kory Cline				Jan 10, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_update_SessionListLogin( &$dbh,
					  $sessionid,
					  $login_old,
					  $login_new )
	{
		if ( ( $sessionid == "" ) || ( $login_old == "" )
			|| ( $login_new == "" ) )
		{
			return false ;
		}

		global $TRANSFER_BUFFER ;

		// here is the thing, when we transfer, we simply replace the current session chat
		// with the new operator info.  BUT, if the session is left idle, it will think
		// session has ended.  so, let's tack on some minutes to give the new operator time
		// to pick-up
		$future_buffer = time() + $TRANSFER_BUFFER ;

		$query = "UPDATE chatsessionlist SET screen_name = '$login_new', updated = '$future_buffer' WHERE sessionID = '$sessionid' AND screen_name = '$login_old'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>
