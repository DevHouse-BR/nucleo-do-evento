<?
	/*****  Knowledge::put  ***************************************
	 *
	 *  $Id: put.php,v 1.3 2004/06/20 02:53:33 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_PUT_Knowledge_LOADED ) == true )
		return ;

	$_OFFICE_PUT_Knowledge_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  Knowledge_put_Category  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$id ( inserted id )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 13, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_put_Category( &$dbh,
				$aspid,
				$deptid,
				$parentid,
				$name,
				$order )
	{
		if ( ( $aspid == "" ) || ( $name == "" )
			|| ( $deptid == "" ) )
		{
			return false ;
		}

		$name = addslashes( $name ) ;

		$query = "INSERT INTO chatkbcats VALUES( 0, '$aspid', '$deptid', '$parentid', '$order', '$name' )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$id = database_mysql_insertid ( $dbh ) ;
			return $id ;
		}
		return false ;
	}

	/*****  Knowledge_put_Question  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$id ( inserted id )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 13, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_put_Question( &$dbh,
				$aspid,
				$deptid,
				$catid,
				$question,
				$answer )
	{
		if ( ( $aspid == "" ) || ( $deptid == "" )
			|| ( $catid == "" ) || ( $question == "" )
			|| ( $answer == "" ) )
		{
			return false ;
		}

		$question = addslashes( $question ) ;
		$answer = addslashes( $answer ) ;

		$query = "INSERT INTO chatkbquestions VALUES( 0, '$aspid', '$catid', '$deptid', '0', 0, '$question', '$answer' )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$id = database_mysql_insertid ( $dbh ) ;
			return $id ;
		}
		return false ;
	}

	/*****  Knowledge_put_QuestionRating  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$id ( inserted id )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 14, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_put_QuestionRating( &$dbh,
				$aspid,
				$questid,
				$catid,
				$rating )
	{
		if ( ( $aspid == "" ) || ( $questid == "" )
			|| ( $catid == "" ) )
		{
			return false ;
		}

		global $HTTP_SERVER_VARS ;

		$now = time() ;
		$ip = $HTTP_SERVER_VARS['REMOTE_ADDR'] ;
		$query = "REPLACE INTO chatkbratings VALUES( '$aspid', '$questid', '$catid', '$rating', $now, '$ip' )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			if ( $rating == 1 )
			{
				$query = "UPDATE chatkbquestions SET points = points + 1 WHERE questID = $questid AND aspID = $aspid" ;
				database_mysql_query( $dbh, $query ) ;
			}
			else
			{
				$query = "UPDATE chatkbquestions SET points = points - 1 WHERE questID = $questid AND aspID = $aspid" ;
				database_mysql_query( $dbh, $query ) ;
			}
			return true ;
		}
		return false ;
	}

	/*****  Knowledge_put_SearchTerm  *************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$id ( inserted id )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				June 19, 2004
	 *
	 *****************************************************************/
	FUNCTION Knowledge_put_SearchTerm( &$dbh,
				$aspid,
				$searchterm )
	{
		if ( ( $aspid == "" ) || ( $searchterm == "" ) )
		{
			return false ;
		}

		$searchterm = addslashes( $searchterm ) ;

		$query = "SELECT * FROM chatkbsearchterms WHERE searchterm = '$searchterm'" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			
			if ( isset( $data['searchID'] ) && $data['searchID'] )
			{
				$counter = $data['counter'] + 1 ;
				$query = "REPLACE INTO chatkbsearchterms VALUES( $data[searchID], $aspid, $counter, '$searchterm', '$data[correction]', '$data[related]' )" ;
			}
			else
				$query = "INSERT INTO chatkbsearchterms VALUES( 0, $aspid, 1, '$searchterm', '', '' )" ;
			database_mysql_query( $dbh, $query ) ;

			return true ;
		}
		return false ;
	}

?>