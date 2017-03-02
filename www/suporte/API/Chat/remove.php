<?
	/*****  ServiceChat::remove  ***************************************
	 *
	 *  $Id: remove.php,v 1.15 2004/08/30 20:04:39 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_REMOVE_ServiceChat_LOADED ) == true )
		return ;

	$_OFFICE_REMOVE_ServiceChat_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/
	include_once( "$DOCUMENT_ROOT/API/Transcripts/put.php" ) ;

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceChat_remove_ChatRequest  ***************************
	 *
	 *  History:
	 *	Nate Lee				Nov 5, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_remove_ChatRequest( &$dbh,
						$requestid )
	{
		if ( $requestid == "" )
		{
			return false ;
		}

		$query = "DELETE FROM chatrequests WHERE requestID = $requestid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return true ;
	}

	/*****  ServiceChat_remove_ChatSessionlist  ***************************
	 *
	 *  History:
	 *	Kyle Hicks				Dec 20, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_remove_ChatSessionlist( &$dbh,
						$sessionid )
	{
		if ( $sessionid == "" )
		{
			return false ;
		}

		$query = "DELETE FROM chatsessionlist WHERE sessionID = $sessionid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return true ;
	}

	/*****  ServiceChat_remove_ChatSession  ***************************
	 *
	 *  History:
	 *	Kyle Hicks				Dec 20, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_remove_ChatSession( &$dbh,
						$sessionid )
	{
		if ( $sessionid == "" )
		{
			return false ;
		}

		$query = "DELETE FROM chatsessions WHERE sessionID = $sessionid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return true ;
	}

	/*****  ServiceChat_remove_CleanChatSessionList  ******************
	 *
	 *  History:
	 *	Nate Lee				Nov 5, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_remove_CleanChatSessionList ( &$dbh )
	{
		// clean it up if chat session has been idel...
		// means they logged out or connection is broken
		global $chat_timeout ;
		$now = time() - $chat_timeout ;

		$query = "DELETE FROM chatsessionlist WHERE updated < $now" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return true ;
	}

	/*****  ServiceChat_remove_ChatSessionListByScreenName  ***********
	 *
	 *  History:
	 *	Holger				Jan 16, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_remove_ChatSessionListByScreenName ( &$dbh,
						$sessionid,
						$screen_name )
	{
		if ( ( $sessionid == "" ) || ( $screen_name == "" ) )
		{
			return false ;
		}

		$screen_name = addslashes( $screen_name ) ;
		$query = "DELETE FROM chatsessionlist WHERE sessionID = $sessionid AND screen_name = '$screen_name'" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return true ;
	}

	/*****  ServiceChat_remove_CleanChatSessions  **********************
	 *
	 *  History:
	 *	Nate Lee				Nov 5, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_remove_CleanChatSessions ( &$dbh )
	{
		global $DOCUMENT_ROOT ;
		$sessions = ARRAY() ;

		$now = time() ;

		$query = "SELECT chatsessions.* FROM chatsessions LEFT JOIN chatsessionlist ON chatsessions.sessionID = chatsessionlist.sessionID WHERE chatsessions.created < $now AND chatsessionlist.sessionID is NULL" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			while ( $data = database_mysql_fetchrow( $dbh ) )
			{
				$sessions[] = $data ;
			}

			for ( $c = 0; $c < count( $sessions ); ++$c )
			{
				$session = $sessions[$c] ;
				$query = "DELETE FROM chatsessions WHERE sessionID = $session[sessionID]" ;
				database_mysql_query( $dbh, $query ) ;

				if ( file_exists( "$DOCUMENT_ROOT/web/chatrequests/$session[initiate]" ) && $session['initiate'] )
					unlink( "$DOCUMENT_ROOT/web/chatrequests/$session[initiate]" ) ;
				if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_admin.txt" ) )
					unlink( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_admin.txt" ) ;
				if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_visitor.txt" ) )
					unlink( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_visitor.txt" ) ;

				if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/w_$session[sessionID]"."_admin.txt" ) )
					unlink( "$DOCUMENT_ROOT/web/chatsessions/w_$session[sessionID]"."_admin.txt" ) ;
				if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/w_$session[sessionID]"."_visitor.txt" ) )
					unlink( "$DOCUMENT_ROOT/web/chatsessions/w_$session[sessionID]"."_visitor.txt" ) ;

				if ( file_exists( "$DOCUMENT_ROOT/web/chatpolling/$session[sessionID]".".txt" ) )
					unlink( "$DOCUMENT_ROOT/web/chatpolling/$session[sessionID]".".txt" ) ;
				if ( file_exists( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_transcript.txt" ) && file_exists( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_transcript_info.txt" ) )
				{
					$mod_time = filemtime( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_transcript.txt" ) ;
					$transcript_info_array = file( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_transcript_info.txt" ) ;
					$transcript_data_array = file( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_transcript.txt" ) ;
					$transcript_info = $transcript_info_array[0] ;
					$transcript_data = $transcript_data_array[0] ;
					// format: adminid<:>visitorname<:>deptid<:>aspid<:>--autosaveflag--
					LIST( $userid, $from_screen_name, $email, $deptid, $aspid, $autosave_flag ) = explode( "<:>", $transcript_info ) ;
					if ( $autosave_flag == "autosave_transcript" )
						ServiceTranscripts_put_ChatTranscript( $dbh, $session['sessionID'], $transcript_data, $userid, $from_screen_name, $email, $deptid, $aspid, $mod_time ) ;
					unlink( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_transcript.txt" ) ;
					unlink( "$DOCUMENT_ROOT/web/chatsessions/$session[sessionID]"."_transcript_info.txt" ) ;
				}
			}
		}
		return true ;
	}

	/*****  ServiceChat_remove_CleanChatRequests  **********************
	 *
	 *  History:
	 *	Nate Lee				Nov 8, 2001
	 *
	 *****************************************************************/
	FUNCTION ServiceChat_remove_CleanChatRequests ( &$dbh )
	{
		$sessions = ARRAY() ;

		$query = "SELECT chatrequests.* FROM chatrequests LEFT JOIN chatsessions ON chatsessions.sessionID = chatrequests.sessionID WHERE chatsessions.sessionID is NULL" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			while ( $data = database_mysql_fetchrow( $dbh ) )
			{
				$sessions[] = $data ;
			}

			for ( $c = 0; $c < count( $sessions ); ++$c )
			{
				$session = $sessions[$c] ;
				$query = "DELETE FROM chatrequests WHERE sessionID = $session[sessionID]" ;
				database_mysql_query( $dbh, $query ) ;
			}
		}
		return true ;
	}

?>