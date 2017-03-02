<?
	/*****  ServiceRefer::remove  ***************************************
	 *
	 *  $Id: remove.php,v 1.7 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_REMOVE_ServiceRefer_LOADED ) == true )
		return ;

	$_OFFICE_REMOVE_ServiceRefer_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceRefer_remove_OldRefer  ***************************
	 *
	 *  History:
	 *	Holger				March 3, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceRefer_remove_OldRefer( &$dbh,
						$aspid )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		// keep 60 days of refer (updated from 30 days because of sales path
		// needing longer days
		$expired = time() - (60*60*24*20) ;

		$query = "DELETE FROM chatrefer WHERE aspID = $aspid AND created < $expired" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return true ;
	}

?>