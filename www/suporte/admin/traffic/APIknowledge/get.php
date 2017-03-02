<?
	/*****  Knowledge::get  **********************************
	 *
	 *  $Id: get.php,v 1.3 2004/06/20 02:53:33 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_GET_Knowledge_LOADED ) == true )
		return ;

	$_OFFICE_GET_Knowledge_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  Knowledge_get_DeptCats  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 12, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_DeptCats( &$dbh,
					$aspid,
					$deptid )
	{
		if ( ( $aspid == "" ) || ( $deptid == "" ) )
		{
			return false ;
		}

		$cats = Array() ;

		$query = "SELECT * FROM chatkbcats WHERE aspID = $aspid AND deptID = $deptid AND catID_parent = 0 ORDER BY display_order ASC" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$cats[] = $data ;
			return $cats ;
		}
		return false ;
	}

	/*****  Knowledge_get_ParentsCats  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 12, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_ParentsCats( &$dbh,
					$aspid,
					$parentid )
	{
		if ( ( $aspid == "" ) || ( $parentid == "" ) )
		{
			return false ;
		}

		$cats = Array() ;

		$query = "SELECT * FROM chatkbcats WHERE aspID = $aspid AND catID_parent = $parentid ORDER BY display_order ASC" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$cats[] = $data ;
			return $cats ;
		}
		return false ;
	}

	/*****  Knowledge_get_CatQuestions  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 12, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_CatQuestions( &$dbh,
					$aspid,
					$deptid,
					$catid,
					$limit )
	{
		if ( $aspid == "")
		{
			return false ;
		}

		$questions = Array() ;

		$limit_string = "" ;
		if ( $limit )
			$limit_string = "LIMIT $limit" ;

		$query = "SELECT * FROM chatkbquestions WHERE aspID = $aspid AND deptID = $deptid AND catID = $catid ORDER BY points DESC $limit_string" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$questions[] = $data ;
			return $questions ;
		}
		return false ;
	}

	/*****  Knowledge_get_TotalCatQuestions  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 12, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_TotalCatQuestions( &$dbh,
					$aspid,
					$deptid,
					$catid )
	{
		if ( $aspid == "")
		{
			return false ;
		}

		$query = "SELECT count(*) AS total FROM chatkbquestions WHERE aspID = $aspid AND deptID = $deptid AND catID = $catid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  Knowledge_get_CatInfo  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 12, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_CatInfo( &$dbh,
					$aspid,
					$catid )
	{
		if ( ( $aspid == "") || ( $catid == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatkbcats WHERE aspID = $aspid AND catID = $catid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  Knowledge_get_QuestInfo  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 12, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_QuestInfo( &$dbh,
					$aspid,
					$questid )
	{
		if ( ( $aspid == "") || ( $questid == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatkbquestions WHERE aspID = $aspid AND questID = $questid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  Knowledge_get_QuestRatingInfoIP  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 14, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_QuestRatingInfoIP( &$dbh,
					$questid )
	{
		if ( $questid == "" )
		{
			return false ;
		}

		global $HTTP_SERVER_VARS ;
		$ip = $HTTP_SERVER_VARS['REMOTE_ADDR'] ;

		$query = "SELECT * FROM chatkbratings WHERE questID = $questid AND ip = '$ip'" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  Knowledge_get_QuestInfod  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 12, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_QuestInfod( &$dbh,
					$aspid,
					$questid )
	{
		if ( ( $aspid == "") || ( $questid == "" ) )
		{
			return false ;
		}

		$query = "SELECT * FROM chatkbquestions WHERE aspID = $aspid AND questID = $questid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data ;
		}
		return false ;
	}

	/*****  Knowledge_get_KeywordSearchResults  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 14, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_KeywordSearchResults( &$dbh,
					$aspid,
					$deptid,
					$catid,
					$keyword,
					$page,
					$page_per )
	{
		if ( ( $aspid == "") || ( $deptid == "" )
			|| ( $keyword == "" ) )
		{
			return false ;
		}

		$page -= 1 ;
		if ( $page < 1 )
		{
			$begin_index = 0 ;
		}
		else
		{
			$begin_index = $page * $page_per ;
		}

		$results = Array() ;

		$dept_string = "" ;
		if ( $deptid )
			$dept_string = "AND deptID = $deptid" ;

		$cat_string = "" ;
		if ( $catid )
			$cat_string = "AND catID = $catid" ;

		$query = "SELECT * FROM chatkbquestions WHERE aspID = $aspid $cat_string $dept_string AND ( question LIKE '%$keyword%' OR answer LIKE '%$keyword%' ) LIMIT $begin_index, $page_per" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$results[] = $data ;
			return $results ;
		}
		return false ;
	}

	/*****  Knowledge_get_TotalKeywordSearchResults  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 14, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_TotalKeywordSearchResults( &$dbh,
					$aspid,
					$deptid,
					$catid,
					$keyword )
	{
		if ( ( $aspid == "") || ( $deptid == "" )
			|| ( $keyword == "" ) )
		{
			return false ;
		}

		$dept_string = "" ;
		if ( $deptid )
			$dept_string = "AND deptID = $deptid" ;

		$cat_string = "" ;
		if ( $catid )
			$cat_string = "AND catID = $catid" ;

		$query = "SELECT count(*) AS total FROM chatkbquestions WHERE aspID = $aspid $cat_string $dept_string AND ( question LIKE '%$keyword%' OR answer LIKE '%$keyword%' )" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  Knowledge_get_TotalASPQuestions  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Seth Adams				Sept 20, 2003
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_TotalASPQuestions( &$dbh,
					$aspid )
	{
		if ( $aspid == "")
		{
			return false ;
		}

		$query = "SELECT count(*) AS total FROM chatkbquestions WHERE aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			$data = database_mysql_fetchrow( $dbh ) ;
			return $data['total'] ;
		}
		return false ;
	}

	/*****  Knowledge_get_SearchTerms  *******************************
	 *
	 *  Parameters:
	 *	&$dbh
	 *		Database connection.
	 *
	 *  Description:
	 *	[DESCRIPTION HERE]
	 *
	 *  Returns:
	 *	$surveys ( array )
	 *	false ( failure )
	 *
	 *  History:
	 *	Kyle Hicks				June 19, 2004
	 *
	 *****************************************************************/
	FUNCTION Knowledge_get_SearchTerms( &$dbh,
					$aspid )
	{
		if ( $aspid == "" )
		{
			return false ;
		}

		$terms = Array() ;

		$query = "SELECT * FROM chatkbsearchterms WHERE aspID = $aspid GROUP BY counter DESC LIMIT 30" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			while( $data = database_mysql_fetchrow( $dbh ) )
				$terms[] = $data ;
			return $terms ;
		}
		return false ;
	}

?>