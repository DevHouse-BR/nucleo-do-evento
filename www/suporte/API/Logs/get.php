<?
	/*****  ServiceLogs::get  **********************************
	 *
	 *  $Id: get.php,v 1.7 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_GET_ServiceLogs_LOADED ) == true )
		return ;

	$_OFFICE_GET_ServiceLogs_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceLogs_get_SessionRequestLog  *************************
	 *
	 *  History:
	 *	Holger				Dec 15, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceLogs_get_SessionRequestLog( &$dbh,
						$chat_session )
	{
		if ( $chat_session == "" )
		{
			return false ;
		}

		$query = "SELECT * FROM chatrequestlogs WHERE chat_session = '$chat_session'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceLogs_get_TotalDeptRequests  *************************
	 *
	 *  History:
	 *	Holger				Dec 15, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceLogs_get_TotalDeptRequests( &$dbh,
						$deptid )
	{
		if ( $deptid == "" )
		{
			return false ;
		}

		$query = "SELECT COUNT(*) AS total FROM chatrequestlogs WHERE deptID = '$deptid'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceLogs_get_DayMostLiveRequestPage  *********************
	 *
	 *  History:
	 *	Holger				Dec 27, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceLogs_get_DayMostLiveRequestPage( &$dbh,
								$begin,
								$end,
								$limit,
								$aspid )
	{
		if ( ( $begin == "" ) || ( $end == "" )
			|| ( $aspid == "" ) )
		{
			return false ;
		}

		$limit_string = "" ;
		$footprints = ARRAY() ;

		if ( $limit )
			$limit_string = "LIMIT $limit" ;

		$query = "SELECT url, count(*) AS total FROM chatrequestlogs WHERE created > $begin AND created <= $end AND aspID = $aspid GROUP BY url ORDER BY total DESC $limit_string" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while ( $data = database_mysql_fetchrow( $dbh ) )
			{
				$footprints[] = $data ;
			}
			return $footprints ;
		}
		return false ;
	}

	/*****  ServiceLogs_get_TotalIpRequests  *************************
	 *
	 *  History:
	 *	Holger				Dec 27, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceLogs_get_TotalIpRequests( &$dbh,
						$ip,
						$aspid )
	{
		if ( ( $ip == "" ) || ( $aspid == "" ) )
		{
			return 0 ;
		}

		$query = "SELECT COUNT(*) AS total FROM chatrequestlogs WHERE ip = '$ip' AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return 0 ;
	}

	/*****  ServiceLogs_get_TotalRequestsPerDay  *****************
	 *
	 *  History:
	 *	Holger				Dec 15, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceLogs_get_TotalRequestsPerDay( &$dbh,
						$deptid,
						$begin,
						$end,
						$status,
						$aspid )
	{
		if ( ( $begin == "" ) || ( $end == "" )
			|| ( $aspid == "" ) )
		{
			return false ;
		}

		$department_string = "" ;

		if ( $deptid )
			$department_string = "AND deptID = '$deptid'" ;

		$query = "SELECT COUNT(*) AS total FROM chatrequestlogs WHERE created >= $begin AND created < $end AND aspID = $aspid $department_string AND status = $status" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceLogs_get_TotalBrowserCount  **********************
	 *
	 *  History:
	 *	Holger				Dec 15, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceLogs_get_TotalBrowserCount( &$dbh,
						$browser )
	{
		if ( $browser == "" )
		{
			return false ;
		}

		$query = "SELECT COUNT(*) AS total FROM chatrequestlogs WHERE browser_os LIKE '%$browser%'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceLogs_get_TotalUserRequestCount  *******************
	 *
	 *  History:
	 *	Holger				Dec 15, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceLogs_get_TotalUserRequestCount( &$dbh,
						$userid )
	{
		if ( $userid == "" )
		{
			return false ;
		}

		$query = "SELECT COUNT(*) AS total FROM chatrequestlogs WHERE userID = '$userid'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceLogs_get_TotalUserRequestCountPerDay  **************
	 *
	 *  History:
	 *	Holger				Dec 15, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceLogs_get_TotalUserRequestCountPerDay( &$dbh,
						$userid,
						$begin,
						$end,
						$status,
						$aspid )
	{
		if ( ( $userid == "" ) || ( $begin == "" )
			|| ( $end == "" ) || ( $aspid == "" ) )
		{
			return false ;
		}

		$query = "SELECT COUNT(*) AS total FROM chatrequestlogs WHERE userID = '$userid' AND created >= $begin AND created < $end AND status = $status AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

?>
