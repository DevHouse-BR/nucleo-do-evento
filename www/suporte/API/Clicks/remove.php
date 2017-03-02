<?
	/*****  ServiceClicks::remove  ***************************************
	 *
	 *  $Id: remove.php,v 1.2 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_remove_ServiceClicks_LOADED ) == true )
		return ;

	$_OFFICE_remove_ServiceClicks_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceClicks_remove_TrackingURL  *********************
	 *
	 *  History:
	 *	Holger				Feb 21, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_remove_TrackingURL( &$dbh,
								$aspid,
								$trackid )
	{
		if ( ( $aspid == "" ) || ( $trackid == "" ) )
		{
			return false ;
		}

		$query = "DELETE FROM chatclicktracking WHERE aspID = $aspid AND trackID = $trackid" ;
		database_mysql_query( $dbh, $query ) ;
		$query = "DELETE FROM chatclicks WHERE aspID = $aspid AND trackID = $trackid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>