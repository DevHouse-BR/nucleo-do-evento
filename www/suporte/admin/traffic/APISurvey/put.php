<?
	/*****  ServiceSurvey::put  ***************************************
	 *
	 *  $Id: put.php,v 1.6 2003/09/18 22:55:11 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_ServiceSurvey_LOADED ) == true )
		return ;

	$_OFFICE_PUT_ServiceSurvey_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/
	include_once( "$DOCUMENT_ROOT/admin/traffic/APISurvey/update.php" ) ;

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceSurvey_put_Survey  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$id ( inserted id )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				Nov 9, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_put_Survey( &$dbh,
				$aspid,
				$asplogin,
				$deptid,
				$name,
				$survey_data )
	{
		if ( ( $aspid == "" ) || ( $name == "" )
			|| ( $survey_data == "" ) || ( $asplogin == "" ) )
		{
			return false ;
		}

		$now = time() ;
		$name = addslashes( $name ) ;
		$survey_data = addslashes( $survey_data ) ;

		// check to see if it is the first one.  if it is, then activate it.
		$query = "SELECT count(*) AS total FROM chatsurveys WHERE aspID = '$aspid'" ;
		database_mysql_query( $dbh, $query ) ;
		$data = database_mysql_fetchrow( $dbh ) ;
		if ( $data['total'] > 0 )
			$active = 0 ;
		else
			$active = 1 ;

		$query = "INSERT INTO chatsurveys VALUES( 0, '$aspid', '$deptid', $active, $now, 0, 0,0,0,0,0, '$name', '$survey_data' )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$id = database_mysql_insertid ( $dbh ) ;

			// activate active survey
			if ( $active )
				ServiceSurvey_update_ActivateSurvey( $dbh, $aspid, $asplogin, $deptid, $id ) ;
			return $id ;
		}
		return false ;
	}

	/*****  ServiceSurvey_put_SurveyLog  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$id ( inserted id )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				Nov 9, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_put_SurveyLog( &$dbh,
				$aspid,
				$surveyid,
				$rejected,
				$s_c1,
				$s_c2,
				$s_c3,
				$s_c4,
				$s_c5,
				$ip,
				$q_open )
	{
		if ( ( $aspid == "" ) || ( $surveyid == "" )
			|| ( $ip == "" ) )
		{
			return false ;
		}

		$now = time() ;
		$q_open = addslashes( $q_open ) ;

		$query = "INSERT INTO chatsurveylogs VALUES( $aspid, $surveyid, '$rejected', $s_c1,$s_c2,$s_c3,$s_c4,$s_c4, $now, '$ip', '$q_open' )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>