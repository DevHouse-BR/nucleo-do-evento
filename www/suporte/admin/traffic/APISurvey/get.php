<?
	/*****  ServiceSurvey::get  **********************************
	 *
	 *  $Id: get.php,v 1.7 2003/09/18 22:55:11 osicodes Exp $
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

	/*****  ServiceSurvey_get_AllASPSurveys  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$data ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				August 29, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_get_AllASPSurveys( &$dbh,
						$aspid,
						$deptid )
	{
		if ( $aspid == ""  )
		{
			return false ;
		}

		$surveys = ARRAY() ;

		$dept_string = "" ;
		if ( $deptid )
			$dept_string = "AND deptID = '$deptid'" ;

		$query = "SELECT * FROM chatsurveys WHERE aspID = $aspid $dept_string ORDER BY created DESC" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
			{
				$surveys[] = $data ;
			}
			return $surveys ;
		}
		return false ;
	}

	/*****  ServiceSurvey_get_SurveyInfo  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$data ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				Nov 9, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_get_SurveyInfo( &$dbh,
						$aspid,
						$surveyid )
	{
		if ( ( $aspid == ""  ) || ( $surveyid == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatsurveys WHERE aspID = $aspid AND surveyID = $surveyid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceSurvey_get_ActiveSurvey  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$data ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				Nov 11, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_get_ActiveSurvey( &$dbh,
						$aspid )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		$query = "SELECT * FROM chatsurveys WHERE aspID = $aspid AND isactive = 1" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceSurvey_get_DidIPTakeSurvey  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$data ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				Nov 11, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_get_DidIPTakeSurvey( &$dbh,
						$aspid,
						$ip,
						$surveyid )
	{
		if ( ( $aspid == "" ) || ( $ip == "" ) 
			|| ( $surveyid == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatsurveylogs WHERE aspID = $aspid AND ip = '$ip' AND surveyID = $surveyid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceSurvey_get_AllSurveyLogs  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				Nov 11, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_get_AllSurveyLogs( &$dbh,
					$aspid,
					$surveyid,
					$page,
					$page_per )
	{
		if ( ( $aspid == "" ) || ( $surveyid == "" ) )
		{
			return false ;
		}

		$surveys = ARRAY() ;

		$page -= 1 ;
		if ( $page < 1 )
		{
			$begin_index = 0 ;
		}
		else
		{
			$begin_index = $page * $page_per ;
		}

		if ( $page_per )
		{
			$query = "SELECT * FROM chatsurveylogs WHERE aspID = $aspid AND surveyID = $surveyid AND rejected = 0 ORDER BY created DESC LIMIT $begin_index, $page_per" ;
		}
		else
		{
			$query = "SELECT * FROM chatsurveylogs WHERE aspID = $aspid AND surveyID = $surveyid AND rejected = 0 ORDER BY created DESC" ;
		}
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while ( $data = database_mysql_fetchrow( $dbh ) )
			{
				$surveys[] = $data ;
			}
			return $surveys ;
		}
		return false ;
	}

	/*****  ServiceSurvey_get_TotalSurveyLogs  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				Nov 11, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_get_TotalSurveyLogs( &$dbh,
					$aspid,
					$surveyid )
	{
		if ( ( $aspid == "" ) || ( $surveyid == "" ) )
		{
			return false ;
		}

		$query = "SELECT count(*) AS total FROM chatsurveylogs WHERE aspID = $aspid AND surveyID = $surveyid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

?>