<?
	/*****  ServiceTranscripts::put  ***************************************
	 *
	 *  $Id: put.php,v 1.9 2004/08/30 20:04:39 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_ServiceTranscripts_LOADED ) == true )
		return ;

	$_OFFICE_PUT_ServiceTranscripts_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceTranscripts_put_ChatTranscript  ******************************
	 *
	 *  History:
	 *	Kyle Hicks				Dec 15, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceTranscripts_put_ChatTranscript( &$dbh,
				$sessionid,
				$transcript,
				$userid,
				$from_screen_name,
				$email,
				$deptid,
				$aspid,
				$created )
	{
		if ( ( $transcript == "" ) || ( $userid == "" )
			|| ( $deptid == "" ) || ( $from_screen_name == "" )
			|| ( $sessionid == "" ) || ( $aspid == "" ) )
		{
			return false ;
		}

		if ( !$created )
			$created = time() ;

		$from_screen_name = addslashes( $from_screen_name ) ;
		$plain = preg_replace( "/<STRIP_FOR_PLAIN>(.*?)<\/STRIP_FOR_PLAIN>/", "", $transcript ) ;
		$plain = preg_replace( "/Chat \[dynamic box\]/", "", $plain ) ;
		$plain = addslashes( strip_tags( $plain ) ) ;
		$plain = preg_replace( "/'/", "&#039;", $plain ) ;

		$transcript = preg_replace( "/<script(.*?)<\/script>/", "", $transcript ) ;
		$transcript = preg_replace( "/<body(.*?)>/", "", $transcript ) ;
		$transcript = preg_replace( "/'/", "&#039;", $transcript ) ;

		$query = "SELECT * FROM chattranscripts WHERE chat_session = '$sessionid'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			
			if ( $data['chat_session'] )
				$query = "UPDATE chattranscripts SET userID = $userid, from_screen_name = '$from_screen_name', email = '$email', created = $created, deptID = '$deptid', plain = '$plain', formatted = '$formatted', aspID = $aspid WHERE chat_session = '$chat_session'" ;
			else
				$query = "INSERT INTO chattranscripts VALUES('$sessionid', $userid, '$from_screen_name', '$email', $created, '$deptid', '$plain', '$transcript', $aspid)" ;
			database_mysql_query( $dbh, $query ) ;

			if ( $dbh[ 'ok' ] )
			{
				return true ;
			}
		}
		return false ;
	}
?>