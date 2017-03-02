<?
	/*****  UtilKnowledge  **********************************
	 *
	 *  $Id: Util.php,v 1.7 2004/06/18 10:34:35 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_GET_UtilKnowledge_LOADED ) == true )
		return ;

	$_OFFICE_UtilKnowledge_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/
	include_once("$DOCUMENT_ROOT/admin/traffic/APIknowledge/get.php") ;

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	FUNCTION UtilKnowledge_PrintSubCats( $dbh,
							$aspid,
							$parentid,
							$counter )
	{
		if ( ( $aspid == "" ) || ( $parentid == "" ) )
		{
			return false ;
		}

		global $dept_cat_string ;

		$counter += 1 ;
		$spaces = 5 * $counter ;
		$tab_spaces = "" ;
		for ( $c = 0; $c < $spaces; ++$c )
			$tab_spaces .= "&nbsp;" ;

		$categories = Knowledge_get_ParentsCats( $dbh, $aspid, $parentid ) ;
		for ( $c = 0; $c < count( $categories ); ++$c )
		{
			$category = $categories[$c] ;
			$name = stripslashes( $category['name'] ) ;
			$selected = "" ;
			if ( $dept_cat_string == "$category[deptID]<:>$category[catID]" )
				$selected = "selected" ;

			if ( $parentid != $category['catID'] )
			{
				print "<option value=\"$category[deptID]<:>$category[catID]\" $selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$tab_spaces - $name</option>" ;
				UtilKnowledge_PrintSubCats( $dbh, $aspid, $category['catID'], $counter ) ;
			}
		}
		return true ;
	}

	FUNCTION UtilKnowledge_PrintSubCatsFolder( $dbh,
							$aspid,
							$parentid,
							$counter )
	{
		if ( ( $aspid == "" ) || ( $parentid == "" ) )
		{
			return false ;
		}

		global $BASE_URL ;
		global $x ;
		global $l ;
		global $LANG ;
		global $stripped ;

		$counter += 1 ;
		$spaces = 32 * $counter ;

		$categories = Knowledge_get_ParentsCats( $dbh, $aspid, $parentid ) ;
		for ( $c = 0; $c < count( $categories ); ++$c )
		{
			$category = $categories[$c] ;

			$total_qs = Knowledge_get_TotalCatQuestions( $dbh, $aspid, $category['deptID'], $category['catID'] ) ;
			$name = stripslashes( $category['name'] ) ;

			print "<table cellspacing=0 cellpadding=2 border=0><tr><td><img src=\"$BASE_URL/images/spacer.gif\" width=$spaces height=1></td><td valign=\"top\"><img src=\"$BASE_URL/images/knowledge/folder_closed.gif\" border=0 alt=\"$name\" width=\"9\" height=\"9\"></td><td valign=\"top\"><span class=\"basetxt\"><b>$name</b> <span class=\"smalltxt\"> &nbsp; [ <a href=\"$BASE_URL/admin/traffic/knowledge_search.php?l=$l&x=$x&action=expand_cat&deptid=$category[deptID]&catid=$category[catID]&stripped=$stripped\">+ $LANG[FULL_LIST] ($total_qs) ...</a> ]<br>" ;

			$questions = Knowledge_get_CatQuestions( $dbh, $aspid, $category['deptID'], $category['catID'], 3 ) ;
			for ( $q = 0; $q < count( $questions ); ++$q )
			{
				UtilKnowledge_PrintQuestion( $questions[$q] ) ;
			}
			print "</td></tr></table>" ;

			UtilKnowledge_PrintSubCatsFolder( $dbh, $aspid, $category['catID'], $counter ) ;
		}
		return true ;
	}

	FUNCTION UtilKnowledge_PrintSubCatsFolderAdmin( $dbh,
							$aspid,
							$parentid,
							$counter )
	{
		if ( ( $aspid == "" ) || ( $parentid == "" ) )
		{
			return false ;
		}

		global $BASE_URL ;
		global $x ;
		global $l ;

		$counter += 1 ;
		$spaces = 32 * $counter ;

		$categories = Knowledge_get_ParentsCats( $dbh, $aspid, $parentid ) ;
		for ( $c = 0; $c < count( $categories ); ++$c )
		{
			$category = $categories[$c] ;

			$name = stripslashes( $category['name'] ) ;

			print "<table cellspacing=0 cellpadding=2 border=0><tr><td><img src=\"$BASE_URL/images/spacer.gif\" width=$spaces height=1></td><td valign=\"top\"><img src=\"$BASE_URL/images/knowledge/folder_closed.gif\" border=0 alt=\"$name\" width=\"9\" height=\"9\"></td><td valign=\"top\"><span class=\"basetxt\"><b>$name</b> [<a href=\"knowledge_config.php?action=edit_cat&catid=$category[catID]\">edit</a>] [<a href=\"JavaScript:remove_cat( $category[catID] )\">remove</a>]<br>" ;

			$questions = Knowledge_get_CatQuestions( $dbh, $aspid, $category['deptID'], $category['catID'], 0 ) ;
			for ( $q = 0; $q < count( $questions ); ++$q )
			{
				UtilKnowledge_PrintQuestionAdmin( $questions[$q] ) ;
			}
			print "</td></tr></table>" ;

			UtilKnowledge_PrintSubCatsFolderAdmin( $dbh, $aspid, $category['catID'], $counter ) ;
		}
		return true ;
	}

	FUNCTION UtilKnowledge_PrintQuestion( $data )
	{
		global $BASE_URL ;
		global $x ;
		global $l ;
		global $keyword_url ;
		global $stripped ;

		$question = stripslashes( $data['question'] ) ;
		print "<table cellspacing=0 cellpadding=1 border=0><tr><td valign=\"top\"><img src=\"$BASE_URL/images/knowledge/document.gif\" border=0 alt=\"$question\"> </td><td valign=\"top\"><span class=\"basetxt\"><a href=\"$BASE_URL/admin/traffic/knowledge_search.php?l=$l&x=$x&action=expand_question&questid=$data[questID]&deptid=$data[deptID]&catid=$data[catID]&keyword=$keyword_url&stripped=$stripped\">$question</a></td></tr></table>" ;
		return true ;
	}

	FUNCTION UtilKnowledge_PrintQuestionAdmin( $data )
	{
		global $BASE_URL ;

		$question = stripslashes( $data['question'] ) ;
		$question = preg_replace( "/</", "&lt;", $question ) ;
		$question = preg_replace( "/>/", "&gt;", $question ) ;
		print "<table cellspacing=0 cellpadding=1 border=0><tr><td valign=\"top\"><img src=\"$BASE_URL/images/knowledge/document.gif\" border=0 alt=\"$question\"> </td><td valign=\"top\"><span class=\"basetxt\">$question<br>(help index: $data[points])<br>[<a href=\"knowledge_config.php?action=edit_quest&questid=$data[questID]\">edit</a>] [<a href=\"JavaScript:remove_question( $data[questID] )\">remove</a>]</td></tr></table>" ;
		return true ;
	}

	FUNCTION UtilKnowledge_PrintMenu( $dbh, $deptid, $catid, $string )
	{
		global $BASE_URL ;
		global $x ;
		global $l ;
		global $stripped ;

		$catinfo = Knowledge_get_CatInfo( $dbh, $x, $catid ) ;
		$name = stripslashes( $catinfo['name'] ) ;

		if ( isset( $catinfo['name'] ) )
		{
			$string = " &gt; <a href=\"knowledge_search.php?l=$l&x=$x&action=expand_cat&deptid=$deptid&catid=$catinfo[catID]&stripped=$stripped\">$name</a> $string " ;

			if ( $catinfo['catID_parent'] )
				$string = UtilKnowledge_PrintMenu( $dbh, $deptid, $catinfo['catID_parent'], $string ) ;

			return $string ;
		}
	}

?>