<?
	/*****  ServiceSurvey::remove  ***************************************
	 *
	 *  $Id: remove.php,v 1.4 2003/09/18 22:55:11 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_REMOVE_ServiceSurvey_LOADED ) == true )
		return ;

	$_OFFICE_REMOVE_ServiceSurvey_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceSurvey_remove_Survey  ************************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	true ( success )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				Nov 16, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_remove_Survey( &$dbh,
						$aspid,
						$surveyid )
	{
		if ( ( $aspid == "" ) || ( $surveyid == "" ) )
		{
			return false ;
		}

		$query = "DELETE FROM chatsurveylogs WHERE aspID = $aspid AND surveyID = $surveyid" ;
		database_mysql_query( $dbh, $query ) ;
		$query = "DELETE FROM chatsurveys WHERE aspID = $aspid AND surveyID = $surveyid" ;
		database_mysql_query( $dbh, $query ) ;
		$query = "UPDATE chatrequestlogs SET surveyID = 0 WHERE surveyID = $surveyid AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}

		return false ;
	}

?>