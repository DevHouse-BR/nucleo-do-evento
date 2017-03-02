<?
	/*****  OpStatus::put  ***************************************
	 *
	 *  $Id: put.php,v 1.2 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_OpStatus_LOADED ) == true )
		return ;

	$_OFFICE_PUT_OpStatus_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  OpStatus_put_Status  *******************************
	 *
	 *  History:
	 *	Kyle Hicks				Oct 15, 2003
	 *
	 *****************************************************************/
	FUNCTION OpStatus_put_Status( &$dbh,
					$userid,
					$status )
	{
		if ( $userid == "" )
		{
			return false ;
		}

		$now = time() ;

		$query = "INSERT INTO chat_adminstatus VALUES( 0, $userid, $now, $status )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>