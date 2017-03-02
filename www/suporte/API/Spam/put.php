<?
	/*****  ServiceSpam::put  ***************************************
	 *
	 *  $Id: put.php,v 1.1 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_ServiceSpam_LOADED ) == true )
		return ;

	$_OFFICE_PUT_ServiceSpam_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceSpam_put_IP  *******************************
	 *
	 *  History:
	 *	Holger				August 25, 2004
	 *
	 *****************************************************************/
	FUNCTION ServiceSpam_put_IP( &$dbh,
					$ip,
					$aspid )
	{
		if ( ( $ip == "" ) || ( $aspid == "" ) )
		{
			return false ;
		}

		$now = time() ;

		$query = "REPLACE INTO chatspamips VALUES( $aspid, '$ip', $now )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}
?>
