<?
	/*****  ServiceSurvey::remove  ***************************************
	 *
	 *  $Id: remove.php,v 1.2 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_remove_ServiceSurvey_LOADED ) == true )
		return ;

	$_OFFICE_remove_ServiceSurvey_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceSurvey_remove_OldFootprints  *********************
	 *
	 *  History:
	 *	Holger				May 31, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_remove_OldFootprints( &$dbh,
								$aspid,
								$expireday )
	{
		if ( ( $aspid == "" ) || ( $expireday == "" ) )
		{
			return false ;
		}

		$query = "DELETE FROM chatfootprints WHERE aspID = $aspid AND created < $expireday" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>