<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	// initialize
	$success = 0 ;
	$keyword_url = "" ;
	$l = ( isset( $HTTP_GET_VARS['l'] ) ) ? $HTTP_GET_VARS['l'] : "" ;
	$x = ( isset( $HTTP_GET_VARS['x'] ) ) ? $HTTP_GET_VARS['x'] : "" ;
	$action = ( isset( $HTTP_GET_VARS['action'] ) ) ? $HTTP_GET_VARS['action'] : "" ;
	$deptid = ( isset( $HTTP_GET_VARS['deptid'] ) ) ? $HTTP_GET_VARS['deptid'] : 0 ;
	$catid = ( isset( $HTTP_GET_VARS['catid'] ) ) ? $HTTP_GET_VARS['catid'] : 0 ;
	$page = ( isset( $HTTP_GET_VARS['page'] ) ) ? $HTTP_GET_VARS['page'] : 0 ;
	$questid = ( isset( $HTTP_GET_VARS['questid'] ) ) ? $HTTP_GET_VARS['questid'] : 0 ;
	$keyword = ( isset( $HTTP_GET_VARS['keyword'] ) ) ? $HTTP_GET_VARS['keyword'] : "" ;
	$stripped = ( isset( $HTTP_GET_VARS['stripped'] ) ) ? $HTTP_GET_VARS['stripped'] : 0 ;

	include_once("../../web/conf-init.php") ;
	if ( !file_exists( "$DOCUMENT_ROOT/web/$l/$l-conf-init.php" ) || !file_exists( "$DOCUMENT_ROOT/web/conf-init.php" ) )
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting... [request.php]</font>" ;
	}
	include_once("$DOCUMENT_ROOT/web/$l/$l-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Util_Page.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APIknowledge/Util.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APIknowledge/get.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APIknowledge/put.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APIknowledge/update.php") ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "25" ;
	}
	else
	{
		$text_width = "15" ;
	}
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "rate" )
	{
		Knowledge_put_QuestionRating( $dbh, $x, $questid, $catid, $HTTP_GET_VARS['rating'] ) ;
		$action = "expand_question" ;
		$success = 1 ;
	}
	else if ( $action == "search" )
	{
		LIST( $deptid, $catid ) = explode( "<:>", $HTTP_GET_VARS['category'] ) ;
		Knowledge_put_SearchTerm( $dbh, $x, $keyword ) ;
	}

	$total_questions = Knowledge_get_TotalASPQuestions( $dbh, $x ) ;
?>
<html>
<head>
<title> <? echo $LANG['TITLE_SUPPORTREQUEST'] ?> </title>

<link rel="Stylesheet" href="<? echo $BASE_URL ?>/css/base.css">

<script language="JavaScript">
<!--
	function do_alert()
	{
		if ( <? echo $success ?> )
			alert( "<? echo $LANG['KB_RATE_SUBMIT'] ?>" ) ;
	}

	function do_search()
	{
		if ( document.form_search.keyword.value == "" )
			alert( "<? echo $LANG['KB_ERROR_KEYWORD'] ?>" ) ;
		else if ( document.form_search.keyword.value.length < 3 )
			alert( "<? echo $LANG['KB_ERROR_KEYWORD_LEAST'] ?>" ) ;
		else
			document.form_search.submit() ;
	}

	function toggle_fill( the_text )
	{
		if ( document.form.canned.checked )
		{
			parent.window.writer.document.form.kb.value = 1 ;
			parent.window.writer.document.form.message.value = the_text ;
		}
		else
		{
			parent.window.writer.document.form.kb.value = 0 ;
			parent.window.writer.document.form.message.value = "" ;
		}
	}

//-->
</script>
<script language="JavaScript" src="<? echo $BASE_URL ?>/js/global.js"></script>

</head>

<? if ( $stripped ): ?>
<? $css_path = "../../" ; include( "../../css/default.php" ) ; ?>
<body class="bg" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0" OnLoad="do_alert()">
<? else: ?>
<body bgColor="<? echo $CHAT_REQUEST_BACKGROUND ?>" text="<? echo $TEXT_COLOR ?>" link="<? echo $LINK_COLOR ?>" alink="<? echo $ALINK_COLOR ?>" vlink="<? echo $VLINK_COLOR ?>" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0" OnLoad="do_alert()">
<? endif ; ?>

<?
	if ( file_exists( "$DOCUMENT_ROOT/web/$l/$LOGO" ) && $LOGO )
		$logo = "$BASE_URL/web/$l/$LOGO" ;
	else if ( file_exists( "$DOCUMENT_ROOT/web/$LOGO_ASP" ) && $LOGO_ASP )
		$logo = "$BASE_URL/web/$LOGO_ASP" ;
	else
		$logo = "$BASE_URL/images/logo.gif" ;
?>
<? if ( !$stripped ): ?>
<table cellspacing=0 cellpadding=2 border=0><tr><td><img src="<? echo $logo ?>"></td></tr></table>
<? endif ; ?>


<? if ( $stripped && !$total_questions ): ?>
<br><br>
<center>
<table cellspacing=0 cellpadding=2 border=0><tr><td>Your Knowledge Base is empty.  Please <a href="<? echo $BASE_URL ?>/setup/" target="newwin">setup and build</a>.</td></tr></table>
</center>


<? else: ?>


<table width="96%" border="0" align="center" cellpadding="0" cellspacing="2">
<form method="GET" action="knowledge_search.php" name="form_search">
<input type="hidden" name="action" value="search">
<input type="hidden" name="x" value="<? echo $x ?>">
<input type="hidden" name="l" value="<? echo $l ?>">
<input type="hidden" name="deptid" value="<? echo $deptid ?>">
<input type="hidden" name="stripped" value="<? echo $stripped ?>">
<tr valign="top"> 
	<td align="right" valign="middle"><span class="basetxt"><b><? echo $LANG['WORD_SEARCH'] ?>: </b></td>
	<td colspan="4" align="left">
		<select name="category" style="width:99%;" class="select">
		<option value="0<:>0"> -- <? echo $LANG['KB_ALL_DEPT'] ?> --</option>
		<?
			$dept_cat_string = "$deptid<:>$catid" ;
			// future v2.6 feature
			// $departments[] = AdminUsers_get_DeptInfo( $dbh, $deptid, $x ) ;
			$departments = AdminUsers_get_AllDepartments( $dbh, $x, 0 ) ;
			for ( $c = 0; $c < count( $departments ); ++$c )
			{
				$department = $departments[$c] ;

				$name = stripslashes( $department['name'] ) ;
				$selected = "" ;
				if ( $dept_cat_string == "$department[deptID]<:>0" )
					$selected = "selected" ;
				print "<option value=\"$department[deptID]<:>0\" $selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - $name</option>" ;

				$deptcats = Knowledge_get_DeptCats( $dbh, $x, $department['deptID'] ) ;
				for ( $c2 = 0; $c2 < count( $deptcats ); ++$c2 )
				{
					$department2 = $deptcats[$c2] ;
					$name = stripslashes( $department2['name'] ) ;
					$selected = "" ;
					if ( $dept_cat_string == "$department[deptID]<:>$department2[catID]" )
						$selected = "selected" ;
					print "<option value=\"$department[deptID]<:>$department2[catID]\" $selected>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; - $name</option>" ;

					UtilKnowledge_PrintSubCats( $dbh, $x, $department2['catID'], 0 ) ;
				}
			}
		?>
		</select>
	</td>
</tr>
<tr valign="top"> 
	<td align="right" valign="center"><span class="basetxt"><b><? echo $LANG['WORD_KEYWORD'] ?>:</b></td>
	<td width="70%" align="left" valign="center"> <input name="keyword" type="text" style="width:99%;" value="<? echo $keyword ?>" class="input"></td>
	<td width="22" align="left" valign="center"> <input type="button" value="<? echo $LANG['WORD_SEARCH'] ?>" class="button" OnClick="do_search()"></td>
	<td>&nbsp;&nbsp;&nbsp;&nbsp; </td>
	<? if ( !$stripped ): ?>
	<td nowrap valign="center" align="right"><span class="smalltxt"><a href="JavaScript:parent.window.location.reload()"><? echo $LANG['KB_LIVE_SUPPORT'] ?></a></td>
	<? endif ; ?>
</tr>
</form>
<tr>
	<td colspan=5><span class="basetxt">
		<hr noshade size="1" color="#BBBBBB">

		<?
			if ( $action == "expand_question" ):
			$questioninfo = Knowledge_get_QuestInfo( $dbh, $x, $questid ) ;
			$question = stripslashes( $questioninfo['question'] ) ;
			$answer = nl2br( stripslashes( $questioninfo['answer'] ) ) ;

			$ratinginfo = Knowledge_get_QuestRatingInfoIP( $dbh, $questid ) ;
			$deptinfo = AdminUsers_get_DeptInfo( $dbh, $questioninfo['deptID'], $x ) ;
			Knowledge_update_QuestionClicks( $dbh, $x, $questid ) ;
		?>
		<table cellspacing=0 cellpadding=0 border=0>
		<tr>
			<td><span class="smalltxt">
				<big><b><a href="JavaScript:history.go(<?= ( $success ) ? "-2" : "-1" ?>)">&lt; <? echo $LANG['WORD_BACK'] ?></a></b></big><br><? echo $LANG['KB_HERE'] ?>: <a href="knowledge_search.php?x=<? echo $x ?>&l=<? echo $l ?>&deptid=<? echo $deptinfo['deptID'] ?>&stripped=<? echo $stripped ?>"><? echo $LANG['WORD_MAIN'] ?></a> &gt; <a href="knowledge_search.php?l=<? echo $l ?>&x=<? echo $x ?>&action=expand_cat&deptid=<? echo $deptinfo['deptID'] ?>&catid=0&stripped=<? echo $stripped ?>"><? echo stripslashes( $deptinfo['name'] ) ?></a> <? echo UtilKnowledge_PrintMenu( $dbh, $deptinfo['deptID'], $catid, "" ) ?>
			</td>
		</tr>
		</table>
		<br>
		<table cellspacing=0 cellpadding=2 border=0 width="100%">
		<tr>
			<td width="16"></td>
			<td width="100%"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="100%" height=1></td>
		</tr>
		<tr>
			<td valign="top" width="16"><img src="../../images/knowledge/document.gif" border=0 alt=""></td>
			<td valign="top"><span class="basetxt">
				<big><b><? echo $LANG['WORD_QUESTION'] ?></b>: </big><br>
				<? echo $question ?>

				<br>
				<hr noshade size="1" color="#BBBBBB">
			</td>
		</tr>
		<form method="GET" action="knowledge_search.php" name="form">
		<input type="hidden" name="action" value="rate">
		<input type="hidden" name="l" value="<? echo $l ?>">
		<input type="hidden" name="x" value="<? echo $x ?>">
		<input type="hidden" name="deptid" value="<? echo $deptid ?>">
		<input type="hidden" name="questid" value="<? echo $questid ?>">
		<input type="hidden" name="catid" value="<? echo $catid ?>">
		<input type="hidden" name="stripped" value="<? echo $stripped ?>">
		<tr>
			<td valign="top" width="16"><img src="../../images/knowledge/document.gif" border=0 alt=""></td>
			<td valign="top"><span class="basetxt">
				<big><b><? echo $LANG['WORD_ANSWER'] ?></b>: </big><br>

				<? if ( $stripped ): ?>
				<table cellspacing=0 cellpadding=2 border=0 width="100%">
				<tr class="">
					<td class="altcolor2"><span class="small"><input type="checkbox" name="canned" value="<? echo preg_replace( "/<br \/>/", "", preg_replace( "/\"/", "&quot;", $answer ) ) ; ?>" OnClick="toggle_fill( this.value )"> check this box to use this answer</td>
				</tr>
				</table>
				<br>
				<? endif ; ?>

				<? echo $answer ?>
				<br>
				<hr noshade size="1" color="#BBBBBB">

				<? if ( $ratinginfo['aspID'] && !$stripped ): ?>
				<? echo $LANG['KB_RATE_SUBMIT'] ?>



				<? else: ?>

					<? if ( !$stripped ): ?>
					<table cellspacing=0 cellpadding=2 border=0>
					<tr>
						<td><span class="smalltxt"><? echo $LANG['KB_HELPFUL'] ?> </td><td><span class="smalltxt"><input type="radio" name="rating" value=1 OnClick="document.form.submit()"></td><td><span class="smalltxt"> <? echo $LANG['WORD_YES'] ?></td><td><span class="smalltxt">&nbsp; | &nbsp;</td><td><span class="smalltxt"><input type="radio" name="rating" value=0 OnClick="document.form.submit()"></td><td><span class="smalltxt"> <? echo $LANG['WORD_NO'] ?></td>
					</tr></table>
					<? endif ; ?>

				<? endif ; ?>
			</td>
		</tr>
		</form>
		</table>





		<?
			elseif ( $action == "expand_cat" ):
			$total_qs = Knowledge_get_TotalCatQuestions( $dbh, $x, $deptid, $catid ) ;
			$deptinfo = AdminUsers_get_DeptInfo( $dbh, $deptid, $x ) ;

			if ( $catid )
			{
				$department = Knowledge_get_CatInfo( $dbh, $x, $catid ) ;
				$deptcats = Knowledge_get_ParentsCats( $dbh, $x, $catid ) ;
			}
			else
			{
				$department = AdminUsers_get_DeptInfo( $dbh, $deptid, $x ) ;
				$deptcats = Knowledge_get_DeptCats( $dbh, $x, $department['deptID'] ) ;
			}
			$name = stripslashes( $department['name'] ) ;
		?>
		<table cellspacing=0 cellpadding=0 border=0>
		<tr>
			<td><span class="smalltxt"><big><b><a href="JavaScript:history.go(-1)">&lt; <? echo $LANG['WORD_BACK'] ?></a></b></big><br><? echo $LANG['KB_HERE'] ?>: <a href="knowledge_search.php?x=<? echo $x ?>&l=<? echo $l ?>&deptid=<? echo $deptinfo['deptID'] ?>&stripped=<? echo $stripped ?>"><? echo $LANG['WORD_MAIN'] ?></a> &gt; <a href="knowledge_search.php?l=<? echo $l ?>&x=<? echo $x ?>&action=expand_cat&deptid=<? echo $deptinfo['deptID'] ?>&catid=0&stripped=<? echo $stripped ?>"><? echo stripslashes( $deptinfo['name'] ) ?></a> <? echo UtilKnowledge_PrintMenu( $dbh, $department['deptID'], $catid, "" ) ?></td>
		</tr>
		</table>
		<br>
		<?
			print "<table cellspacing=0 cellpadding=2 border=0><tr><td valign=\"top\"><img src=\"$BASE_URL/images/knowledge/folder_closed.gif\" border=0 alt=\"$name\"></td><td valign=\"top\"><span class=\"basetxt\"><b>$name</b><br>" ;

			$questions = Knowledge_get_CatQuestions( $dbh, $x, $department['deptID'], $catid, 0 ) ;
			for ( $q = 0; $q < count( $questions ); ++$q )
			{
				UtilKnowledge_PrintQuestion( $questions[$q] ) ;
			}
			print "</td></tr></table>" ;

			for ( $c2 = 0; $c2 < count( $deptcats ); ++$c2 )
			{
				$category = $deptcats[$c2] ;

				$total_qs = Knowledge_get_TotalCatQuestions( $dbh, $x, $category['deptID'], $category['catID'] ) ;
				$name = stripslashes( $category['name'] ) ;
				print "<table cellspacing=0 cellpadding=2 border=0><tr><td><img src=\"$BASE_URL/images/spacer.gif\" width=16 height=1></td><td valign=\"top\"><img src=\"$BASE_URL/images/knowledge/folder_closed.gif\" border=0 alt=\"$name\"></td><td valign=\"top\"><span class=\"basetxt\"><b>$name</b> &nbsp; [ <a href=\"$BASE_URL/admin/traffic/knowledge_search.php?l=$l&x=$x&action=expand_cat&deptid=$category[deptID]&catid=$category[catID]&stripped=$stripped\">+ $LANG[FULL_LIST] ($total_qs) ...</a> ]<br>" ;

				$questions = Knowledge_get_CatQuestions( $dbh, $x, $category['deptID'], $category['catID'], 3 ) ;
				for ( $q = 0; $q < count( $questions ); ++$q )
				{
					UtilKnowledge_PrintQuestion( $questions[$q] ) ;
				}
				print "</td></tr></table>" ;

				UtilKnowledge_PrintSubCatsFolder( $dbh, $x, $category['catID'], 0 ) ;
			}
		?>










		<?
			elseif ( $action == "search" ):
			$keyword_url = preg_replace( "/ /", "+", $keyword ) ;
			$questions = Knowledge_get_KeywordSearchResults( $dbh, $x, $deptid, $catid, $keyword, $page, 15 ) ;
			$total_questions = Knowledge_get_TotalKeywordSearchResults( $dbh, $x, $deptid, $catid, $keyword ) ;
			$page_string = Page_util_CreatePageString( $dbh, $page, "knowledge_search.php?action=search&x=$x&l=$l&category=$HTTP_GET_VARS[category]&keyword=$keyword_url", 15, $total_questions ) ;
		?>
		<table cellspacing=0 cellpadding=0 border=0>
		<tr>
			<td><span class="basetxt"><big><b><a href="knowledge_search.php?x=<? echo $x ?>&l=<? echo $l ?>&stripped=<? echo $stripped ?>"><? echo $LANG['WORD_MAIN'] ?></a> &gt; <? echo $LANG['WORD_SEARCH'] ?> <? echo $LANG['WORD_KEYWORD'] ?>: <i><? echo $keyword ?></i></big></b> &nbsp;&nbsp; (<? echo $total_questions ?> <? echo $LANG['RESULTS_FOUND'] ?>)</td>
		</tr>
		</table>
		<br>
		<span class="smalltxt"><? echo $LANG['WORD_PAGE'] ?>: <? echo $page_string ?></span>
		<p>
		<?
			for ( $q = 0; $q < count( $questions ); ++$q )
			{
				UtilKnowledge_PrintQuestion( $questions[$q] ) ;
			}

			if ( count( $questions ) <= 0 )
				print "$LANG[KB_NO_RESULTS]<br>" ;
		?>
		<br>
		<span class="smalltxt"><? echo $LANG['WORD_PAGE'] ?>: <? echo $page_string ?></span>







		<? else: ?>
		<span class="smalltxt"><big><b><? echo $LANG['KB'] ?> <? echo $LANG['WORD_TOPICS'] ?></b></big>
		<br><br>
		<?	
			for ( $c = 0; $c < count( $departments ); ++$c )
			{
				$department = $departments[$c] ;
		
				$total_qs = Knowledge_get_TotalCatQuestions( $dbh, $x, $department['deptID'], 0 ) ;
				$name = stripslashes( $department['name'] ) ;
				print "<table cellspacing=0 cellpadding=2 border=0><tr><td valign=\"top\"><img src=\"$BASE_URL/images/knowledge/folder_closed.gif\" border=0 alt=\"$name\" width=\"9\" height=\"9\"></td><td valign=\"top\"><span class=\"basetxt\"><b>$name</b> &nbsp; [ <a href=\"$BASE_URL/admin/traffic/knowledge_search.php?l=$l&x=$x&action=expand_cat&deptid=$department[deptID]&catid=0&stripped=$stripped\">+ $LANG[FULL_LIST] ($total_qs) ...</a> ]<br>" ;

				$questions = Knowledge_get_CatQuestions( $dbh, $x, $department['deptID'], 0, 3 ) ;
				for ( $q = 0; $q < count( $questions ); ++$q )
				{
					UtilKnowledge_PrintQuestion( $questions[$q] ) ;
				}
				print "</td></tr></table>" ;

				$deptcats = Knowledge_get_DeptCats( $dbh, $x, $department['deptID'] ) ;
				for ( $c2 = 0; $c2 < count( $deptcats ); ++$c2 )
				{
					$category = $deptcats[$c2] ;

					$total_qs = Knowledge_get_TotalCatQuestions( $dbh, $x, $category['deptID'], $category['catID'] ) ;
					$name = stripslashes( $category['name'] ) ;
					print "<table cellspacing=0 cellpadding=2 border=0><tr><td><img src=\"$BASE_URL/images/spacer.gif\" width=16 height=1></td><td valign=\"top\"><img src=\"$BASE_URL/images/knowledge/folder_closed.gif\" border=0 alt=\"$name\" width=\"9\" height=\"9\"></td><td valign=\"top\"><span class=\"basetxt\"><b>$name</b> &nbsp; [ <a href=\"$BASE_URL/admin/traffic/knowledge_search.php?l=$l&x=$x&action=expand_cat&deptid=$category[deptID]&catid=$category[catID]&stripped=$stripped\">+ $LANG[FULL_LIST] ($total_qs) ...</a> ]<br>" ;

					$questions = Knowledge_get_CatQuestions( $dbh, $x, $category['deptID'], $category['catID'], 3 ) ;
					for ( $q = 0; $q < count( $questions ); ++$q )
					{
						UtilKnowledge_PrintQuestion( $questions[$q] ) ;
					}
					print "</td></tr></table>" ;

					UtilKnowledge_PrintSubCatsFolder( $dbh, $x, $category['catID'], 0 ) ;
				}
			}
		?>


		<? endif ; ?>

		<? if ( !$stripped ): ?>
		<hr noshade size="1" color="#BBBBBB">
		<? endif ; ?>

	</td>
</tr>
</table>

<? endif ; ?>

<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->
&nbsp; <span class="smalltxt">

<? if ( !$stripped ): ?>
<? if ( file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) ): ?>

<? else: ?>
<? echo $LANG['DEFAULT_BRANDING'] ?>
<? endif ; ?>
v<? echo $PHPLIVE_VERSION ?> &copy; OSI Codes Inc.</span>
<? endif ; ?>



</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>