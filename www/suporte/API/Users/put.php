<?
	/*****  AdminUsers::put  ***************************************
	 *
	 *  $Id: put.php,v 1.21 2004/08/27 01:19:41 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_AdminUsers_LOADED ) == true )
		return ;

	$_OFFICE_PUT_AdminUsers_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/
	include_once( "$DOCUMENT_ROOT/API/Users/get.php" ) ;

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  AdminUsers_put_user  *******************************
	 *
	 *  History:
	 *	Nate Lee				Dec 2, 2001
	 *
	 *****************************************************************/
	FUNCTION AdminUsers_put_user( &$dbh,
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
			|| ( $company == "" ) || ( $aspid == "" ) )
		{
			return false ;
		}

		$now = time() ;
		$password = md5( $password ) ;

		$query = "SELECT userID FROM chat_admin WHERE login = '$login' AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow ( $dbh ) ;

			if ( $data['userID'] )
			{
				return false ;
			}

			$query = "INSERT INTO chat_admin VALUES (0, '$login', '$password', '$name', '$email', '$company', 0, 0, 1, 10, 0, $now, $aspid, 0, '$rateme', 0, 0, 0, '$op2op', 10, '')" ;
			database_mysql_query( $dbh, $query ) ;

			if ( $dbh[ 'ok' ] )
			{
				$id = database_mysql_insertid ( $dbh ) ;
				return $id ;
			}
			return false ;
		}
		return false ;
	}

	/*****  AdminUsers_put_DeptUser  *******************************
	 *
	 *  History:
	 *	Nate Lee				Dec 2, 2001
	 *
	 *****************************************************************/
	FUNCTION AdminUsers_put_DeptUser( &$dbh,
					$userid,
					$deptid )
	{
		if ( ( $userid == "" ) || ( $deptid == "" ) )
		{
			return false ;
		}

		
		$query = "SELECT * FROM chatuserdeptlist WHERE userID = $userid AND deptID = $deptid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow ( $dbh ) ;

			if ( $data['userID'] )
			{
				return false ;
			}

			$query = "INSERT INTO chatuserdeptlist VALUES( $userid, $deptid, 1, 0 )" ;
			database_mysql_query( $dbh, $query ) ;

			if ( $dbh[ 'ok' ] )
			{
				return true ;
			}
		}
		return false ;
	}

	/*****  AdminUsers_put_department  *******************************
	 *
	 *  History:
	 *	Lance Wall				Dec 25, 2001
	 *
	 *****************************************************************/
	FUNCTION AdminUsers_put_department( &$dbh,
					$deptid,
					$name,
					$visible,
					$email,
					$save_transcripts,
					$share_transcripts,
					$exp_value,
					$exp_word,
					$aspid,
					$initiate_chat,
					$greeting )
	{
		if ( ( $name == "" ) || ( $email == "" ) 
			|| ( $aspid == "" ) )
		{
			return false ;
		}

		global $LANG ;

		$greeting = addslashes( $greeting ) ;
		$deptinfo = AdminUsers_get_DeptInfo( $dbh, $deptid, $aspid ) ;

		// only do checking of duplicate if it is new (deptid not passed)
		if ( ( $deptinfo['name'] == "$name" ) && !$deptid )
		{
			return false ;
		}

		if ( !$exp_value )
			$exp_value = 0 ;
		$exp_string = "$exp_value<:>$exp_word" ;

		// $exp_word: 1=Days, 2=Months, 3=Years
		switch( $exp_word )
		{
			case 1:
				$duration = ( 60*60*24*$exp_value ) ;
				break ;
			case 2:
				$duration = ( 60*60*24*28*$exp_value ) ;
				break ;
			case 3:
				$duration = ( 60*60*24*28*356*$exp_value ) ;
				break ;
			default:
				$duration = 0 ;
		}

		if ( $deptinfo['deptID'] )
		{
			$message_box = addslashes( $deptinfo['message'] ) ;
			$greeting = addslashes( $deptinfo['greeting'] ) ;
			$query = "REPLACE INTO chatdepartments VALUES ('$deptid', '$name', '$visible', '$save_transcripts', '$share_transcripts', '$exp_string', $duration, '$email', $aspid, '$initiate_chat', '$deptinfo[status_image_offline]', '$deptinfo[status_image_online]', '$deptinfo[status_image_away]', '$message_box', '$deptinfo[away_message]', '$greeting')" ;
		}
		else
		{
			$message_box = addslashes( $LANG['MESSAGE_BOX_MESSAGE'] ) ;
			$query = "REPLACE INTO chatdepartments VALUES ('$deptid', '$name', '$visible', '$save_transcripts', '$share_transcripts', '$exp_string', $duration, '$email', $aspid, '$initiate_chat', '', '', '', '$message_box', '', '$greeting')" ;
		}
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$id = database_mysql_insertid ( $dbh ) ;
			return $id ;
		}
		return false ;
	}

?>