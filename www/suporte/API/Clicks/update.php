<?
	/*****  ServiceClicks::update  ***************************************
	 *
	 *  $Id: update.php,v 1.2 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_update_ServiceClicks_LOADED ) == true )
		return ;

	$_OFFICE_update_ServiceClicks_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceClicks_update_TrackingURL  *********************
	 *
	 *  History:
	 *	Holger				Feb 21, 2003
	 *
	 *****************************************************************/
	FUNCTION ServiceClicks_update_TrackingURL( &$dbh,
								$aspid,
								$trackid,
								$name,
								$landing_url,
								$color )
	{
		if ( ( $aspid == "" ) || ( $trackid == "" )
			|| ( $name == "" ) || ( $landing_url == "" )
			|| ( $color == "" ) )
		{
			return false ;
		}

		$name = addslashes( $name ) ;
		$landing_url = addslashes( $landing_url ) ;

		$query = "UPDATE chatclicktracking SET name = '$name', landing_url = '$landing_url', color = '$color' WHERE aspID = $aspid AND trackID = $trackid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>