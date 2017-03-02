<?
	/*****  Knowledge::remove  ***************************************
	 *
	 *  $Id: remove.php,v 1.2 2004/06/11 22:19:00 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_REMOVE_Knowledge_LOADED ) == true )
		return ;

	$_OFFICE_REMOVE_Knowledge_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  Knowledge_remove_Question  ************************************
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
	FUNCTION Knowledge_remove_Question( &$dbh,
						$aspid,
						$questid )
	{
		if ( ( $aspid == "" ) || ( $questid == "" ) )
		{
			return false ;
		}

		$query = "DELETE FROM chatkbquestions WHERE aspID = $aspid AND questid = $questid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}

		return false ;
	}

	/*****  Knowledge_remove_Category  ************************************
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
	FUNCTION Knowledge_remove_Category( &$dbh,
						$aspid,
						$catid )
	{
		if ( ( $aspid == "" ) || ( $catid == "" ) )
		{
			return false ;
		}

		$subcats = Array() ;

		$query = "SELECT * FROM chatkbcats WHERE aspID = $aspid AND catID_parent = $catid" ;
		database_mysql_query( $dbh, $query ) ;
		while( $data = database_mysql_fetchrow( $dbh ) )
				$subcats[] = $data ;

		for ( $c = 0; $c < count( $subcats ); ++$c )
		{
			$category = $subcats[$c] ;
			Knowledge_remove_Category( $dbh, $aspid, $category['catID'] ) ;
		}
		$query = "DELETE FROM chatkbquestions WHERE aspID = $aspid AND catID = $catid" ;
		database_mysql_query( $dbh, $query ) ;
		$query = "DELETE FROM chatkbcats WHERE aspID = $aspid AND catID_parent = $catid" ;
		database_mysql_query( $dbh, $query ) ;
		$query = "DELETE FROM chatkbcats WHERE aspID = $aspid AND catID = $catid" ;
		database_mysql_query( $dbh, $query ) ;
		$query = "DELETE FROM chatkbratings WHERE aspID = $aspid AND catID = $catid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}

		return false ;
	}

?>