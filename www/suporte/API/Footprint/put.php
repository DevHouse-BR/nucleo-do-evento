<?
	/*****  ServiceFootprint::put  ***************************************
	 *
	 *  $Id: put.php,v 1.6 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_ServiceFootprint_LOADED ) == true )
		return ;

	$_OFFICE_PUT_ServiceFootprint_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceFootprint_put_Footprint  *******************************
	 *
	 *  History:
	 *	Nate Lee				Dec 2, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceFootprint_put_Footprint( &$dbh,
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

		$query = "INSERT INTO chatfootprints VALUES( 0, '$ip', $now, '$url', $aspid )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceFootprint_put_FootprintURLStat  *******************************
	 *
	 *  History:
	 *	Holger				May 24, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceFootprint_put_FootprintURLStat( &$dbh,
					$aspid,
					$statdate,
					$url,
					$clicks )
	{
		if ( ( $aspid == "" ) || ( $statdate == "" )
			|| ( $url == "" ) )
		{
			return false ;
		}

		$now = time() ;

		$query = "INSERT INTO chatfootprinturlstats VALUES( 0, '$aspid', '$statdate', $now, '$url', '$clicks' )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceFootprint_put_FootprintStat  *******************************
	 *
	 *  History:
	 *	Holger				May 24, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceFootprint_put_FootprintStat( &$dbh,
					$aspid,
					$statdate,
					$pageviews,
					$uniquevisits )
	{
		if ( ( $aspid == "" ) || ( $statdate == "" ) )
		{
			return false ;
		}

		$now = time() ;

		$query = "INSERT INTO chatfootprintstats VALUES( '$aspid', '$statdate', $now, '$pageviews', '$uniquevisits' )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}
?>