<?
	/*****  Knowledge::update  **********************************
	 *
	 *  $Id: update.php,v 1.1 2003/09/17 22:42:15 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_update_Knowledge_LOADED ) == true )
		return ;

	$_OFFICE_update_Knowledge_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  Knowledge_update_QuestionClicks  *********************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	true ( success )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 14, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_update_QuestionClicks( &$dbh,
					$aspid,
					$questid )
	{
		if ( ( $aspid == "" ) || ( $questid == "" ) )
		{
			return false ;
		}

		$query = "UPDATE chatkbquestions SET clicks = clicks + 1 WHERE questID = '$questid' AND aspID = '$aspid'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  Knowledge_update_Category  *********************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	true ( success )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 16, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_update_Category( &$dbh,
					$aspid,
					$catid,
					$name,
					$display_order )
	{
		if ( ( $aspid == "" ) || ( $catid == "" )
			|| ( $name == "" ) )
		{
			return false ;
		}

		$name = addslashes( $name ) ;

		$query = "UPDATE chatkbcats SET name = '$name', display_order = '$display_order' WHERE catID = $catid AND aspID = '$aspid'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  Knowledge_update_Question  *********************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	true ( success )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 16, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_update_Question( &$dbh,
					$aspid,
					$questid,
					$question,
					$answer )
	{
		if ( ( $aspid == "" ) || ( $questid == "" )
			|| ( $question == "" ) || ( $answer == "" ) )
		{
			return false ;
		}

		$question = addslashes( $question ) ;
		$answer = addslashes( $answer ) ;

		$query = "UPDATE chatkbquestions SET question = '$question', answer = '$answer' WHERE questID = '$questid' AND aspID = '$aspid'" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>
