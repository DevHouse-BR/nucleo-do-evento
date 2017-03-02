<?
	/*****  ServiceChat::get  **********************************
	 *
	 *  $Id: get.php,v 1.15 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_GET_ServiceChat_LOADED ) == true )
		return ;

	$_OFFICE_GET_ServiceChat_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceChat_get_UserChatRequests  *************************
	 *
	 *  History:
	 *	Nate Lee				Nov 10, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_UserChatRequests( &$dbh,
						$userid )
	{
		if ( $userid == "" )
		{
			return false ;
		}

		$chat_requests = ARRAY() ;

		$query = "SELECT * FROM chatrequests WHERE ( userID = '$userid' OR userID = 1000000000 ) AND status = 0" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
			{
				$chat_requests[] = $data ;
			}
			return $chat_requests ;
		}
		return false ;
	}

	/*****  ServiceChat_get_UserTotalChatRequests  *******************
	 *
	 *  History:
	 *	Kyle Hicks					Jan 6, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_UserTotalChatRequests( &$dbh,
						$userid )
	{
		if ( $userid == "" )
		{
			return false ;
		}

		$query = "SELECT count(*) AS total FROM chatrequests WHERE ( userID = '$userid' OR userID = 1000000000 ) AND status = 0" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceChat_get_UserTotalChatSessions  *******************
	 *
	 *  History:
	 *	Kyle Hicks					Jan 10, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_UserTotalChatSessions( &$dbh,
						$login )
	{
		if ( $login == "" )
		{
			return false ;
		}

		$query = "SELECT count(*) AS total FROM chatsessionlist WHERE screen_name = '$login'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceChat_get_TotalChatRequests  *******************
	 *
	 *  History:
	 *	Kyle Hicks					May 1, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_TotalChatRequests( &$dbh,
										$aspid )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		$query = "SELECT count(*) AS total FROM chatrequests WHERE aspID = '$aspid'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceChat_get_ChatRequestInfo  *************************
	 *
	 *  History:
	 *	Nate Lee				Nov 10, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_ChatRequestInfo( &$dbh,
						$requestid )
	{
		if ( $requestid == "" )
		{
			return false ;
		}

		$query = "SELECT * FROM chatrequests WHERE requestID = $requestid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceChat_get_ChatSessionInfo  *************************
	 *
	 *  History:
	 *	Nate Lee				Nov 10, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_ChatSessionInfo( &$dbh,
						$sessionid )
	{
		if ( $sessionid == "" )
		{
			return false ;
		}

		$query = "SELECT * FROM chatsessions WHERE sessionID = $sessionid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceChat_get_UserChatRejects  *************************
	 *
	 *  History:
	 *	Nate Lee				March 8, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_UserChatRejects( &$dbh,
						$screen_name )
	{
		if ( $screen_name == "" )
		{
			return false ;
		}

		$query = "SELECT * FROM chatrequests WHERE from_screen_name = '$from_screen_name' AND status = 0 LIMIT 1" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceChat_get_SessionUserTotal  *************************
	 *
	 *  History:
	 *	Nate Lee				March 8, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_SessionUserTotal( &$dbh,
						$sessionid )
	{
		if ( $sessionid == "" )
		{
			return false ;
		}

		$query = "SELECT count(*) AS total FROM chatsessionlist WHERE sessionID = $sessionid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceChat_get_ChatSessions  *******************
	 *
	 *  History:
	 *	Kyle Hicks					Jan 20, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_ChatSessions( &$dbh,
							$aspid )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		$sessions = ARRAY() ;

		$query = "SELECT * FROM chatsessions, chatrequests WHERE chatrequests.aspID = '$aspid' AND chatrequests.sessionID = chatsessions.sessionID ORDER BY chatrequests.created DESC" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
			{
				$sessions[] = $data ;
			}
			return $sessions ;
		}
		return false ;
	}

	/*****  ServiceChat_get_ChatSessionLogins  *******************
	 *
	 *  History:
	 *	Kyle Hicks					Jan 20, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_ChatSessionLogins( &$dbh,
								$sessionid )
	{
		if ( $sessionid == "" )
		{
			return false ;
		}

		$session = ARRAY() ;

		$query = "SELECT * FROM chatsessionlist WHERE sessionID = $sessionid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
			{
				if( preg_match( "/<(.*)>/", $data['screen_name'] ) )
					$session['visitor'] = $data['screen_name'] ;
				else
					$session['admin'] = $data['screen_name'] ;
			}
			return $session ;
		}
		return false ;
	}

	/*****  ServiceChat_get_IPChatRequestInfo  ********************
	 *
	 *  History:
	 *	Holger				Mar 3, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_IPChatRequestInfo( &$dbh,
						$aspid,
						$ip )
	{
		if ( ( $aspid == "" ) || ( $ip == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatrequests WHERE ip_address = '$ip' AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceChat_get_TotalInitiatedOnDate  *********************
	 *
	 *  History:
	 *	Kyle Hicks				July 31, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_TotalInitiatedOnDate( &$dbh,
						$aspid,
						$ip,
						$start,
						$end )
	{
		if ( ( $aspid == "" ) || ( $start == "")
			|| ( $end == "" ) || ( $ip == "" ) )
		{
			return false ;
		}

		$query = "SELECT count(*) AS total FROM chatrequestlogs WHERE ( status = 4 OR status = 5 ) AND aspID = $aspid AND created >= $start AND created < $end AND ip = '$ip'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceChat_get_IPChatRequestLogInfo  ********************
	 *
	 *  History:
	 *	Kyle Hicks				Sept 30, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_IPChatRequestLogInfo( &$dbh,
						$aspid,
						$ip )
	{
		if ( ( $aspid == "" ) || ( $ip == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatrequestlogs WHERE ip = '$ip' AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceChat_get_TotalChatRequestsIps  ********************
	 *
	 *  History:
	 *	Kyle Hicks				March 2, 2004
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_TotalChatRequestsIps( &$dbh,
						$aspid,
						$ips )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		$output = Array() ;

		$query = "SELECT ip, count(*) AS total FROM chatrequestlogs WHERE ( ip = '0' $ips ) AND aspID = $aspid GROUP BY ip" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$output[] = $data ;
			return $output ;
		}
		return false ;
	}

	/*****  ServiceChat_get_TotalInitiatedIps  *********************
	 *
	 *  History:
	 *	Kyle Hicks				March 2, 2004
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_get_TotalInitiatedIps( &$dbh,
						$aspid,
						$ips )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		$output = Array() ;

		$query = "SELECT ip, count(*) AS total FROM chatrequestlogs WHERE status >= 4 AND status <= 5 AND ( ip = '0' $ips ) AND aspID = $aspid GROUP BY ip" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$output[] = $data ;
			return $output ;
		}
		return false ;
	}
?>