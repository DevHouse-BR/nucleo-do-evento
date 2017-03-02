<?
	/*****  ServiceFootprintUnique::remove  ***************************************
	 *
	 *  $Id: remove.php,v 1.3 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_REMOVE_ServiceFootprintUnique_LOADED ) == true )
		return ;

	$_OFFICE_REMOVE_ServiceFootprintUnique_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceFootprintUnique_remove_IdleFootprints  ***************************
	 *
	 *  History:
	 *	Holger				March 3, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceFootprintUnique_remove_IdleFootprints( &$dbh,
						$aspid )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		global $FOOTPRINT_IDLE ;
		$idle = time() - $FOOTPRINT_IDLE ;

		$query = "DELETE FROM chatfootprintsunique WHERE aspID = $aspid AND updated < $idle" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return true ;
	}

?>
