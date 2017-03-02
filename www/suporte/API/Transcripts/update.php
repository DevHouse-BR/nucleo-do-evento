<?
	/*****  ServiceTranscripts::update  *****************************
	 *
	 *  $Id: update.php,v 1.4 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_UPDATE_ServiceTranscripts_LOADED ) == true )
		return ;

	$_OFFICE_UPDATE_ServiceTranscripts_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceTranscripts_update_ChatRequestStatus  *********************
	 *
	 *  History:
	 *	Kory Cline				Nov 8, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceTranscripts_update_ChatRequestStatus( &$dbh,
					  $requestid,
					  $status )
	{
		if ( $requestid == "" )
		{
				return false ;
		}

		$query = "UPDATE chatrequests SET status = '$status' WHERE requestID = $requestid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>
