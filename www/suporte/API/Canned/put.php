<?
	/*****  ServiceCanned::put  ***************************************
	 *
	 *  $Id: put.php,v 1.8 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_ServiceCanned_LOADED ) == true )
		return ;

	$_OFFICE_PUT_ServiceCanned_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceCanned_put_UserCanned  *************************
	 *
	 *  History:
	 *	Nate Lee				Nov 12, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceCanned_put_UserCanned( &$dbh,
				$userid,
				$deptid,
				$type,
				$name,
				$message )
	{
		if ( ( $userid == "" ) || ( $type == "" )
			|| ( $name == "" ) || ( $message == "" )
			|| ( $deptid == "" ) )
		{
			return false ;
		}

		$name = addslashes( $name ) ;
		$message = addslashes( $message ) ;
		
		$query = "INSERT INTO chatcanned VALUES( 0, $userid, '$deptid', '$type', '$name', '$message' )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$id = database_mysql_insertid ( $dbh ) ;
			return $id ;
		}

		return false ;
	}

?>