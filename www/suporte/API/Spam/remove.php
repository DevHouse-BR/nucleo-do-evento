<?
	/*****  ServiceSpam::remove  ***************************************
	 *
	 *  $Id: remove.php,v 1.2 2004/10/13 18:44:08 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_REMOVE_ServiceSpam_LOADED ) == true )
		return ;

	$_OFFICE_REMOVE_ServiceSpam_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceSpam_remove_IP  ***************************
	 *
	 *  History:
	 *	Holger				August 25, 2004
	 *
	 *****************************************************************/
	FUNCTION ServiceSpam_remove_IP( &$dbh,
						$aspid,
						$ip )
	{
		if ( ( $aspid == "" ) || ( $ip == "" ) )
		{
			return false ;
		}

		$query = "DELETE FROM chatspamips WHERE aspID = $aspid AND ip = '$ip'" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return true ;
	}

	/*****  ServiceSpam_remove_CleanOldIPs  *****************
	 *
	 *  History:
	 *	Holger				August 25, 2004
	 *
	 *****************************************************************/
	FUNCTION ServiceSpam_remove_CleanOldIPs( &$dbh )
	{
		$expired = time() - (60*60*24*3) ;
		$query = "DELETE FROM chatspamips WHERE created < $expired" ;
		database_mysql_query( $dbh, $query ) ;

		return true ;
	}

?>