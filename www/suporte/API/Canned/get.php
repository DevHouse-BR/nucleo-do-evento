<?
	/*****  ServiceCanned::get  **********************************
	 *
	 *  $Id: get.php,v 1.12 2004/10/18 08:47:41 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_GET_ServiceCanned_LOADED ) == true )
		return ;

	$_OFFICE_GET_ServiceCanned_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceCanned_get_UserCannedByType  *************************
	 *
	 *  History:
	 *	Kory Cline				Dec 12, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceCanned_get_UserCannedByType( &$dbh,
						$userid,
						$deptid,
						$type,
						$dept_string )
	{
		if ( ( $userid == "" ) || ( $type == "" ) )
		{
			return ARRAY() ;
		}

		$canned = ARRAY() ;

		if ( $dept_string )
			$dept_string = "AND ( $dept_string OR deptID = 0 )" ;

		if ( $deptid && ( $userid > 10000000 ) )
			$query = "SELECT * FROM chatcanned WHERE ( userID = '$userid' AND deptID = $deptid ) AND type = '$type' ORDER BY name ASC" ;
		else if ( $deptid )
			$query = "SELECT * FROM chatcanned WHERE ( ( userID = '$userid' $dept_string ) OR ( userID > 10000000 $dept_string ) ) AND type = '$type' ORDER BY name ASC" ;
		else if ( $dept_string )
			$query = "SELECT * FROM chatcanned WHERE ( userID = '$userid' OR ( userID > 10000000 $dept_string ) ) AND type = '$type' ORDER BY name ASC" ;
		else
			$query = "SELECT * FROM chatcanned WHERE userID = '$userid' AND type = '$type' ORDER BY name ASC" ;

		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
			{
				$canned[] = $data ;
			}
			return $canned ;
		}
		return false ;
	}

	/*****  ServiceCanned_get_CannedInfo  *************************
	 *
	 *  History:
	 *	Kory Cline				Dec 12, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceCanned_get_CannedInfo( &$dbh,
						$cannedid,
						$userid )
	{
		if ( ( $cannedid == "" ) || ( $userid == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatcanned WHERE cannedID = '$cannedid' AND userID = '$userid'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  ServiceCanned_get_CannedInfoByName  *************************
	 *
	 *  History:
	 *	Kyle Hicks				Nov 11, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceCanned_get_CannedInfoByName( &$dbh,
						$deptid,
						$type,
						$name )
	{
		if ( ( $deptid == "" ) || ( $name == "" ) 
			|| ( $type == "" ) )
		{
			return false ;
		}

		$name = addslashes( $name ) ;
		$query = "SELECT * FROM chatcanned WHERE type = '$type' AND name = '$name' AND deptID = $deptid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

?>
