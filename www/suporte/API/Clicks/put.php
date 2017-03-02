<?
	/*****  ServiceClicks::put  ***************************************
	 *
	 *  $Id: put.php,v 1.2 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_ServiceClicks_LOADED ) == true )
		return ;

	$_OFFICE_PUT_ServiceClicks_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceClicks_put_Tracking  *******************************
	 *
	 *  History:
	 *	Kyle Hicks				Feb 17, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_put_Tracking( &$dbh,
					$aspid,
					$name,
					$landing_url,
					$color )
	{
		if ( ( $aspid == "" ) || ( $name == "" )
			|| ( $landing_url == "" ) || ( $color == "" ) )
		{
			return false ;
		}

		$now = time() ;
		$name = addslashes( $name ) ;
		$landing_url = addslashes( $landing_url ) ;
		$key = substr( time(), -2, strlen( time() ) ) ;

		$query = "INSERT INTO chatclicktracking VALUES (0, $key, $now, $aspid, '$color', '$name', '$landing_url')" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceClicks_put_Click  *******************************
	 *
	 *  History:
	 *	Kyle Hicks				Feb 17, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_put_Click( &$dbh,
					$aspid,
					$trackid )
	{
		if ( ( $aspid == "" ) || ( $trackid == "" ) )
		{
			return false ;
		}

		$today = mktime(0, 0, 1, date( "m", time() ), date( "j", time() ), date( "Y", time() ) ) ;

		$query = "SELECT * FROM chatclicks WHERE aspID = $aspid AND trackID = $trackid AND statdate = $today" ;
		database_mysql_query( $dbh, $query ) ;
		$data = database_mysql_fetchrow( $dbh ) ;

		if ( isset( $data['trackID'] ) )
			$query = "UPDATE chatclicks SET clicks = clicks + 1 WHERE trackID = $trackid AND aspID = $aspid AND statdate = $today" ;
		else
			$query = "INSERT INTO chatclicks VALUES ($trackid, $today, $aspid, 1)" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>