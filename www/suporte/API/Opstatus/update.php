<?
	/*****  OpStatus::update  ***************************************
	 *
	 *  $Id: update.php,v 1.2 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_UPDATE_OpStatus_LOADED ) == true )
		return ;

	$_OFFICE_UPDATE_OpStatus_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  OpStatus_update_Status  *********************
	 *
	 *  History:
	 *	Nate Lee				Nov 3, 2001
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_Status( &$dbh,
					  $userid,
					  $status )
	{
		if ( $userid == "" )
		{
			return false ;
		}

		$query = "UPDATE chat_admin SET available_status = $status WHERE userID = $userid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  OpStatus_update_Signal  *********************
	 *
	 *  History:
	 *	Kyle Hicks				Jan 20, 2002
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_Signal( &$dbh,
					  $userid,
					  $signal,
					  $aspid )
	{
		if ( ( $userid == "" ) || ( $aspid == "" ) )
		{
			return false ;
		}

		$query = "UPDATE chat_admin SET signal = $signal WHERE userID = $userid AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  OpStatus_update_LastActiveTime  *********************
	 *
	 *  History:
	 *	Nate Lee				Nov 3, 2001
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_LastActiveTime( &$dbh,
					  $userid,
					  $time,
					  $sid )
	{
		if ( ( $userid == "" ) || ( $sid == "" ) )
		{
			return false ;
		}

		$query = "UPDATE chat_admin SET last_active_time = $time, session_sid = '$sid' WHERE userID = $userid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  OpStatus_update_UserValue  *********************
	 *
	 *  History:
	 *	Nate Lee				Dec 12, 2001
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_UserValue( &$dbh,
					  $userid,
					  $tbl_name,
					  $value )
	{
		if ( ( $userid == "" ) || ( $tbl_name == "" ) )
		{
			return false ;
		}

		$value = addslashes( $value ) ;

		$query = "UPDATE chat_admin SET $tbl_name = '$value' WHERE userID = $userid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  OpStatus_update_IdleAdminStatus  *********************
	 *
	 *  History:
	 *	Nate Lee				Nov 3, 2001
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_IdleAdminStatus( &$dbh, $idle )
	{
		if ( $idle == "" )
		{
			return false ;
		}

		$query = "UPDATE chat_admin SET available_status = 0 WHERE last_active_time < $idle" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  OpStatus_update_Password  *********************
	 *
	 *  History:
	 *	Kyle Hicks				Dec 18, 2001
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_Password( &$dbh,
					  $userid,
					  $password )
	{
		if ( $password == "" )
		{
			return false ;
		}

		$password = md5( $password ) ;

		$query = "UPDATE chat_admin SET password = '$password' WHERE userID = $userid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  OpStatus_update_User  *********************
	 *
	 *  History:
	 *	Kyle Hicks				Dec 19, 2001
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_User( &$dbh,
						$userid,
						$login,
						$password,
						$name,
						$email,
						$company,
						$aspid,
						$rateme,
						$op2op )
	{
		if ( ( $login == "" ) || ( $password == "" )
			|| ( $name == "" ) || ( $email == "" )
			|| ( $company == "" ) || ( $userid == "" )
			|| ( $aspid == "" ) )
		{
			return false ;
		}

		$password = md5( $password ) ;

		$query = "UPDATE chat_admin SET login = '$login', password = '$password', name = '$name', email = '$email', company = '$company', rateme = '$rateme', op2op = '$op2op' WHERE userID = $userid AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  OpStatus_update_DeptValue  *********************
	 *
	 *  History:
	 *	Kyle				April 27, 2002
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_DeptValue( &$dbh,
					  $aspid,
					  $deptid,
					  $tbl_name,
					  $value )
	{
		if ( ( $aspid == "" ) || ( $deptid == "" )
			|| ( $tbl_name == "" ) )
		{
			return false ;
		}

		$value = addslashes( $value ) ;

		$query = "UPDATE chatdepartments SET $tbl_name = '$value' WHERE deptID = $deptid AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  OpStatus_update_UserDeptOrder  *********************
	 *
	 *  History:
	 *	Kyle				August 28, 2002
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_UserDeptOrder( &$dbh,
					  $userid,
					  $deptid,
					  $order )
	{
		if ( ( $userid == "" ) || ( $deptid == "" ) )
		{
			return false ;
		}

		$query = "UPDATE chatuserdeptlist SET ordernum = '$order' WHERE userID = $userid AND deptID = $deptid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  OpStatus_update_UserDeptActvyTime  *********************
	 *
	 *  History:
	 *	Kyle				July 23, 2003
	 *
	 *****************************************************************/
	FUNCTION OpStatus_update_UserDeptActvyTime( &$dbh,
					  $userid,
					  $deptid )
	{
		if ( ( $userid == "" ) || ( $deptid == "" ) )
		{
			return false ;
		}

		$now = time() ;
		$query = "UPDATE chatuserdeptlist SET last_active = '$now' WHERE userID = $userid AND deptID = $deptid" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}
?>
