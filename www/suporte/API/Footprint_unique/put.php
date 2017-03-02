<?
	/*****  ServiceFootprintUnique::put  ***************************
	 *
	 *  $Id: put.php,v 1.8 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_ServiceFootprintUnique_LOADED ) == true )
		return ;

	$_OFFICE_PUT_ServiceFootprintUnique_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceFootprintUnique_put_Footprint  *******************************
	 *
	 *  History:
	 *	Holger					Feb 26, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceFootprintUnique_put_Footprint( &$dbh,
					$ip,
					$url,
					$aspid )
	{
		if ( ( $ip == "" ) || ( $url == "" )
			|| ( $aspid == "" ) )
		{
			return false ;
		}

		$now = time() ;

		$query = "SELECT * FROM chatfootprintsunique WHERE ip = '$ip'" ;
		database_mysql_query( $dbh, $query ) ;
		$data = database_mysql_fetchrow( $dbh ) ;

		if ( isset( $data['ip'] ) )
		{
			$query = "REPLACE INTO chatfootprintsunique VALUES( '$ip', $data[created], $now, '$url', $aspid, $data[surveyID] )" ;
			database_mysql_query( $dbh, $query ) ;
		}
		else
		{
			$query = "REPLACE INTO chatfootprintsunique VALUES( '$ip', $now, $now, '$url', $aspid, 0 )" ;
			database_mysql_query( $dbh, $query ) ;
		}

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>