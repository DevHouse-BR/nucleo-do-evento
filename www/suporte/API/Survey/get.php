<?
	/*****  ServiceSurvey::get  ***************************************
	 *
	 *  $Id: get.php,v 1.3 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_GET_ServiceSurvey_LOADED ) == true )
		return ;

	$_OFFICE_GET_ServiceSurvey_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceSurvey_get_DeptTotalRates  *****************
	 *
	 *  History:
	 *	Kyle Hicks				Oct 27, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_get_DeptTotalRates ( &$dbh,
						$userid,
						$deptid,
						$begin,
						$end,
						$aspid )
	{
		if ( ( $begin == "" ) || ( $end == "" )
			|| ( $aspid == "" ) )
		{
			return false ;
		}

		$user_string = $dept_string = "" ;
		if ( $userid )
			$user_string = "AND userID = $userid" ;
		if ( $deptid )
			$dept_string = "AND deptID = '$deptid'" ;

		$query = "SELECT COUNT(*) AS total FROM chat_adminrate WHERE created >= $begin AND created < $end AND aspID = $aspid $dept_string $user_string" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  ServiceSurvey_get_DeptTotalRatings  *****************
	 *
	 *  History:
	 *	Kyle Hicks				Oct 27, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_get_DeptTotalRatings ( &$dbh,
						$userid,
						$deptid,
						$begin,
						$end,
						$aspid )
	{
		if ( ( $begin == "" ) || ( $end == "" )
			|| ( $aspid == "" ) )
		{
			return false ;
		}

		$user_string = $dept_string = "" ;
		if ( $userid )
			$user_string = "AND userID = $userid" ;
		if ( $deptid )
			$dept_string = "AND deptID = '$deptid'" ;

		$query = "SELECT SUM( rating ) AS total FROM chat_adminrate WHERE created >= $begin AND created < $end AND aspID = $aspid $dept_string $user_string" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}
?>