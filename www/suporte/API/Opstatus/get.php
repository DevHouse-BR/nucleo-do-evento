<?
	/*****  OpStatus::get  ***************************************
	 *
	 *  $Id: get.php,v 1.2 2004/08/26 00:28:59 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_GET_OpStatus_LOADED ) == true )
		return ;

	$_OFFICE_GET_OpStatus_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  OpStatus_get_UserStatusLogs  *********************
	 *
	 *  History:
	 *	Kyle Hicks				Oct 15, 2003
	 *
	 *****************************************************************/
	FUNCTION OpStatus_get_UserStatusLogs( &$dbh,
								$userid,
								$aspid,
								$begin,
								$end )
	{
		if ( ( $userid == "" ) || ( $aspid == "" ) )
		{
			return false ;
		}

		$logs = Array() ;

		$query = "SELECT chat_adminstatus.*, chat_admin.login AS login, chat_admin.name AS name FROM chat_adminstatus, chat_admin WHERE chat_admin.userID = chat_adminstatus.userID AND chat_adminstatus.userID = $userid AND chat_admin.aspID = $aspid AND chat_adminstatus.created > $begin AND chat_adminstatus.created <= $end ORDER BY chat_adminstatus.created ASC" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$logs[] = $data ;
			return $logs ;
		}
		return false ;
	}

?>