<?
	/*****  ServiceTranscripts::remove  ***************************************
	 *
	 *  $Id: remove.php,v 1.5 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_REMOVE_ServiceTranscripts_LOADED ) == true )
		return ;

	$_OFFICE_REMOVE_ServiceTranscripts_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceTranscripts_remove_Transcript  ***************************
	 *
	 *  History:
	 *	Kyle Hicks				August 20, 2004
	 *
	 *****************************************************************/
	FUNCTION ServiceTranscripts_remove_Transcript( &$dbh,
						$aspid,
						$sessionid )
	{
		if ( ( $aspid == "" ) || ( $sessionid == "" ) )
		{
			return false ;
		}

		$query = "DELETE FROM chattranscripts WHERE chat_session = $sessionid AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return true ;
	}

?>
