<?
	/*****  ServiceSpam::get  **********************************
	 *
	 *  $Id: get.php,v 1.1 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_GET_ServiceSpam_LOADED ) == true )
		return ;

	$_OFFICE_GET_ServiceSpam_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceSpam_get_IPs  *************************
	 *
	 *  History:
	 *	Holger				August 25, 2004
	 *
	 *****************************************************************/
	FUNCTION ServiceSpam_get_IPs( &$dbh,
						$aspid )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		$ips = Array() ;

		$query = "SELECT * FROM chatspamips WHERE aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$ips[] = $data ;
			return $ips ;
		}
		return false ;
	}

?>
