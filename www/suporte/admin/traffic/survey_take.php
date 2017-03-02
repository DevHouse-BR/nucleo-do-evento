<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	include_once("../../web/conf-init.php");
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php");
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APISurvey/get.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APISurvey/put.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APISurvey/update.php") ;

	$error = $admin_push_string = "" ;
	$userid = $deptid = 0 ;
	$admin_push_array = Array() ;

	// sort the choices and populate the array of selected/unselected choices
	if ( isset( $HTTP_POST_VARS['choices'] ) )
		$choices = $HTTP_POST_VARS['choices'] ;
	else
		$choices = ARRAY() ;

	$choices_array = Array() ;
	for( $c = 0; $c < count( $choices ); ++$c )
	{
		$choice = $choices[$c] ;
		$choices_array[$choice] = 1 ;
	}
	for ( $c = 0; $c < 5; ++$c )
	{
		if ( !isset( $choices_array[$c] ) )
			$choices_array[$c] = 0 ;
	}
	// end polpulate array

	$userinfo = AdminASP_get_UserInfo( $dbh, $HTTP_POST_VARS['aspid'] ) ;
	$survey = ServiceSurvey_get_SurveyInfo( $dbh, $HTTP_POST_VARS['aspid'], $HTTP_POST_VARS['surveyid'] ) ;
	$survey_data = unserialize( $survey['survey_data'] ) ;
	if ( file_exists( "$DOCUMENT_ROOT/web/$userinfo[login]/$userinfo[login]-conf-init.php" ) )
	{
		include_once("$DOCUMENT_ROOT/web/$userinfo[login]/$userinfo[login]-conf-init.php") ;
		include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	}
	else
	{
		print "<font color=\"#FF0000\">[Configuration Error: config files not found!] Exiting... </font>" ;
		exit ;
	}


	// remove flag file if exists
	if ( file_exists( "$DOCUMENT_ROOT/web/chatrequests/$HTTP_SERVER_VARS[REMOTE_ADDR].s" ) )
	{
		$admin_push_array = file( "$DOCUMENT_ROOT/web/chatrequests/$HTTP_SERVER_VARS[REMOTE_ADDR].s" ) ;
		$admin_push_string = $admin_push_array[0] ;
		LIST( $userid, $deptid ) = explode( "<:>", $admin_push_string ) ;
		unlink( "$DOCUMENT_ROOT/web/chatrequests/$HTTP_SERVER_VARS[REMOTE_ADDR].s" ) ;
	}

	if ( !isset( $HTTP_POST_VARS['request'] ) )
		$HTTP_POST_VARS['request'] = 0 ;

	if ( !isset( $HTTP_POST_VARS['aspid'] ) || !isset( $HTTP_POST_VARS['surveyid'] ) )
		$error = "Error: Data passed is invalid: aid-n" ;
	else
	{
		if ( !$survey['surveyID'] )
			$error = "Error: Data passed is invalid: sid-n-$surveyid" ;
		else
		{
			$q_open = "" ;
			if ( isset( $HTTP_POST_VARS['q_open'] ) )
				$q_open = $HTTP_POST_VARS['q_open'] ;
			if ( ServiceSurvey_put_SurveyLog( $dbh, $HTTP_POST_VARS['aspid'], $HTTP_POST_VARS['surveyid'], 0, $choices_array[0], $choices_array[1], $choices_array[2], $choices_array[3], $choices_array[4], $HTTP_SERVER_VARS['REMOTE_ADDR'], $q_open ) )
			{
				ServiceSurvey_update_SurveyChoiceTotal( $dbh, $HTTP_POST_VARS['aspid'], $HTTP_POST_VARS['surveyid'], $choices_array[0], $choices_array[1], $choices_array[2], $choices_array[3], $choices_array[4] ) ;
			}
			else
				$error = "You have already taken this survey.  Thank you." ;
		}
	}
?>
<html>
<head>
<title> - </title>
<link rel="Stylesheet" href="../../css/base.css">

<script language="JavaScript">
<!--
	var win_width = window.screen.availWidth ;
	var win_height = window.screen.availHeight ;

	var now = new Date() ;
	var day = now.getDate() ;
	var time = ( now.getMonth() + 1 ) + '/' + now.getDate() + '/' +  now.getYear() + ' ' ;

	var hours = now.getHours() ;
	var minutes = now.getMinutes() ;
	var seconds = now.getSeconds() ;

	if (hours > 12){
		time += hours - 12 ;
	}  else
	if (hours > 10){
		time += hours ;
	} else
	if (hours > 0){
		time += "0" + hours ;
	} else
		time = "12" ;

	time += ((minutes < 10) ? ":0" : ":") + minutes ;
	time += ((seconds < 10) ? ":0" : ":") + seconds ;
	time += (hours >= 12) ? " P.M." : " A.M." ;

	function do_submit()
	{
		document.form.display_width.value = win_width ;
		document.form.display_height.value = win_height ;
		document.form.datetime.value = time ;
		document.form.submit() ;
	}
//-->
</script>

</head>
<body bgColor="<? echo $CHAT_REQUEST_BACKGROUND ?>" text="<? echo $TEXT_COLOR ?>" link="<? echo $LINK_COLOR ?>" alink="<? echo $ALINK_COLOR ?>" vlink="<? echo $VLINK_COLOR ?>" marginheight="0" marginwidth="0" topmargin="0" leftmargin="0">
<table cellspacing=0 cellpadding=4 border=0 style="height:100%" width="100%" bgColor="<? echo $FRAME_COLOR ?>">
<tr>
	<td valign="top" width="100%">
		<table cellspacing=0 cellpadding=0 border=0 width="100%" style="height:100%" bgColor="<? echo $CHAT_REQUEST_BACKGROUND ?>">
		<tr>
			<td valign="top" width="100%"><span class="basetxt">
				<table cellspacing=0 cellpadding=4 border=0 width="100%"><tr><td valign="top"><span class="basetxt">
				<form method="GET" action="<? echo $BASE_URL ?>/request.php" name="form">
				<?
					if ( file_exists( "$DOCUMENT_ROOT/web/$userinfo[login]/$LOGO" ) && $LOGO )
						$logo = "$BASE_URL/web/$userinfo[login]/$LOGO" ;
					else if ( file_exists( "$DOCUMENT_ROOT/web/$LOGO_ASP" ) && $LOGO_ASP )
						$logo = "$BASE_URL/web/$LOGO_ASP" ;
					else
						$logo = "$BASE_URL/images/logo.gif" ;
				?>
				<img src="<? echo $logo ?>"><p>

				<? if ( $error ): ?>
				<big><b><? echo $error ?></b></big>

				<? else: ?>
				<big><b>Thank you for taking our survey.</b></big>

				<? endif ; ?>
				<p>
				<? echo stripslashes( $survey_data['post_mesg'] ) ?>
				<p>

				<input type="hidden" name="action" value="request">
				<input type="hidden" name="display_width" value="">
				<input type="hidden" name="display_height" value="">
				<input type="hidden" name="datetime" value="">
				<input type="hidden" name="x" value="<? echo $userinfo['aspID'] ?>">
				<input type="hidden" name="l" value="<? echo $userinfo['login'] ?>">
				<input type="hidden" name="deptid" value="<? echo $deptid ?>">
				<input type="hidden" name="userid" value="<? echo $userid ?>">
				<input type="hidden" name="surveyid" value="<? echo $survey['surveyID'] ?>">

				<input type="button" style="background-color : #E2E2E2; font-weight : bold; cursor: hand;" value="Click for Live Support!" OnClick="do_submit()">

				<br><br><br>
				<span class="smalltxt"><? echo $LANG['DEFAULT_BRANDING'] ?> - v<? echo $PHPLIVE_VERSION ?> &copy; OSI Codes Inc.</span>
				</form>
				</td><td><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="1" height="326"></td></tr></table>
			</td>
		</tr>
		</table>
	</td>
</tr>
</table>
</body>
</html>