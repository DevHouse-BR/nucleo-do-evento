<?
	/*****  ServiceChat::put  ***************************************
	 *
	 *  $Id: put.php,v 1.20 2004/10/13 18:44:08 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_ServiceChat_LOADED ) == true )
		return ;

	$_OFFICE_PUT_ServiceChat_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceChat_put_ChatSessionList  *************************
	 *
	 *  History:
	 *	Nate Lee				Nov 8, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_put_ChatSessionList( &$dbh,
				$screen_name,
				$sessionid )
	{
		if ( ( $sessionid == "" ) || ( $screen_name == "" ) )
		{
			return false ;
		}

		$now = time() ;

		$screen_name = addslashes( $screen_name ) ;
		$query = "SELECT * FROM chatsessionlist WHERE sessionID = $sessionid AND screen_name = '$screen_name'" ;
		database_mysql_query( $dbh, $query ) ;
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;

			if ( $data['sessionID'] )
				return true ;
			else
			{
				$query = "INSERT INTO chatsessionlist VALUES( $sessionid, '$screen_name', $now )" ;
				database_mysql_query( $dbh, $query ) ;

				if ( $dbh[ 'ok' ] )
				{
					return true ;
				}
			}
		}
		return false ;
	}

	/*****  ServiceChat_put_ChatSession  ******************************
	 *
	 *  History:
	 *	Nate Lee				Nov 8, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_put_ChatSession( &$dbh,
				$screen_name,
				$initiate_file )
	{
		if ( $screen_name == "" )
		{
			return false ;
		}

		// Add 5 seconds for cleaning buffer.
		// If no buffer, the system will wipe the chat session too quickly,
		// resulting in no request on some cases.
		// When cleaning, it will check against the buffer.
		$now = time() + 5 ;

		$query = "INSERT INTO chatsessions VALUES($now, '$screen_name', $now, '$initiate_file')" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return $now ;
		}
		return false ;
	}

	/*****  ServiceChat_put_ChatRequestLog  ******************************
	 *
	 *  History:
	 *	Nate Lee				Dec 14, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_put_ChatRequestLog( &$dbh,
				$userid,
				$deptid,
				$surveyid,
				$sessionid,
				$display_resolution,
				$page,
				$aspid,
				$status,
				$ip,
				$browser )
	{
		if ( ( $userid == "" ) || ( $sessionid == "" )
			|| ( $deptid == "" ) || ( $aspid == "" ) 
			|| ( $ip == "" ) )
		{
			return false ;
		}

		$hostname  = gethostbyaddr( $ip ) ;
		$browser = addslashes( $browser ) ;

		$now = time() ;

		// put the data in a log file to keep for records and statistics.
		// keep in mind, we use $chatfile AS the primary ID because there can
		// only be ONE instance of the chat file (uses time() as part of name).
		$query = "INSERT INTO chatrequestlogs VALUES ('$sessionid', '$userid', '$deptid', '$surveyid', '$ip', '$hostname', '$display_resolution', '$browser', $now, '$status', '$page', $aspid)" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceChat_put_ChatRequest  ******************************
	 *
	 *  History:
	 *	Nate Lee				Dec 14, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_put_ChatRequest( &$dbh,
				$userid,
				$deptid,
				$surveyid,
				$from_screen_name,
				$email,
				$sessionid,
				$display_resolution,
				$visitor_time,
				$page,
				$aspid,
				$question,
				$status,
				$ip,
				$browser )
	{
		if ( ( $userid == "" ) || ( $from_screen_name == "" )
			|| ( $sessionid == "" ) || ( $deptid == "" )
			|| ( $aspid == "" ) || ( $ip == "" ) )
		{
			return false ;
		}

		$browser = addslashes( $browser ) ;
		$question = addslashes( $question ) ;

		$now = time() ;

		$query = "SELECT * FROM chatrequests WHERE userID = '$userid' AND from_screen_name = '$from_screen_name' AND sessionID = $sessionid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			if ( $data['requestID'] )
				return $data['requestID'] ;
			else
			{
				$query = "INSERT INTO chatrequests VALUES (0, '$userid', '$deptid', '$aspid', '$from_screen_name', $sessionid, '$surveyid', $now, '$status', 0, 0, '$ip', '$browser', '$display_resolution', '$visitor_time', '$email', '$page', '$question')" ;
				database_mysql_query( $dbh, $query ) ;

				if ( $dbh[ 'ok' ] )
				{
					if ( $id = database_mysql_insertid ( $dbh ) )
					{
						$browser = stripslashes( $browser ) ;
						// if $deptid is not passed, it is operator-to-operator chat
						// and no need to log it
						if ( $deptid )
						{
							if ( ServiceChat_put_ChatRequestLog( $dbh, $userid, $deptid, $surveyid, $sessionid, $display_resolution, $page, $aspid, $status, $ip, $browser ) )
							{
								return $id ;
							}
							else
								return false ;
						}
						return $id ;
					}
				}
				return false ;
			}
		}
		return false ;
	}
?>
