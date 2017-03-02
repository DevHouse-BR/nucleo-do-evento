<?
	/*****  ServiceFootprintUnique::update  ***************************************
	 *
	 *  $Id: update.php,v 1.2 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_update_ServiceFootprintUnique_LOADED ) == true )
		return ;

	$_OFFICE_update_ServiceFootprintUnique_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceFootprintUnique_update_FootprintValue  ***************************
	 *
	 *  History:
	 *	Kyle Hicks				Nov 15, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceFootprintUnique_update_FootprintValue( &$dbh,
						$ip,
						$tbl_name,
						$value )
	{
		if ( ( $ip == "" ) || ( $tbl_name == "" ) )
		{
			return false ;
		}

		$value = addslashes( $value ) ;

		$query = "UPDATE chatfootprintsunique SET $tbl_name = '$value' WHERE ip = '$ip'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>
