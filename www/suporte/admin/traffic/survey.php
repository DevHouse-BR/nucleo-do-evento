<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: ../../setup/index.php" ) ; exit ; }
	if ( !file_exists( "../../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../../web/conf-init.php" ) )
	{
		HEADER( "location: ../../setup/options.php" ) ;
		exit ;
	}
	include_once("../../web/conf-init.php");
	include_once("$DOCUMENT_ROOT/web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/Util_Page.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APISurvey/get.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APISurvey/put.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APISurvey/update.php") ;
	include_once("$DOCUMENT_ROOT/admin/traffic/APISurvey/remove.php") ;
	$section = 7;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)
	$nav_line = "<a href=\"$BASE_URL/setup/options.php\" class=\"nav\">:: Home</a>" ;
	$css_path = "../../" ;
?>
<?

	// initialize
	$action = $error_mesg = $page_string = "" ;
	$success = $deptid = $surveyid = $page = 0 ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "50" ;
	else
		$text_width = "25" ;

	if ( !isset( $HTTP_SESSION_VARS['session_survey'] ) )
	{
		session_register( "session_survey" ) ;
		$HTTP_SESSION_VARS['session_survey'] = ARRAY() ;
	}

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['deptid'] ) ) { $deptid = $HTTP_GET_VARS['deptid'] ; }
	if ( isset( $HTTP_POST_VARS['deptid'] ) ) { $deptid = $HTTP_POST_VARS['deptid'] ; }
	if ( isset( $HTTP_GET_VARS['success'] ) ) { $success = $HTTP_GET_VARS['success'] ; }
	if ( isset( $HTTP_POST_VARS['success'] ) ) { $success = $HTTP_POST_VARS['success'] ; }
	if ( isset( $HTTP_GET_VARS['surveyid'] ) ) { $surveyid = $HTTP_GET_VARS['surveyid'] ; }
	if ( isset( $HTTP_POST_VARS['surveyid'] ) ) { $surveyid = $HTTP_POST_VARS['surveyid'] ; }
	if ( isset( $HTTP_GET_VARS['page'] ) ) { $page = $HTTP_GET_VARS['page'] ; }
	if ( isset( $HTTP_POST_VARS['page'] ) ) { $page = $HTTP_POST_VARS['page'] ; }

	if ( $action )
		$nav_line = "<a href=\"$BASE_URL/admin/traffic/survey.php\" class=\"nav\">:: Previous</a>" ;
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "step2" )
	{
		if ( isset( $HTTP_POST_VARS['name'] ) )
			$HTTP_SESSION_VARS['session_survey']['name'] = $HTTP_POST_VARS['name'] ;
	}
	else if ( $action == "step3" )
	{
		if ( isset( $HTTP_POST_VARS['intro'] ) )
		{
			$HTTP_SESSION_VARS['session_survey']['intro'] = $HTTP_POST_VARS['intro'] ;
			$HTTP_SESSION_VARS['session_survey']['q_survey'] = $HTTP_POST_VARS['q_survey'] ;
			$HTTP_SESSION_VARS['session_survey']['stype'] = $HTTP_POST_VARS['stype'] ;
			$HTTP_SESSION_VARS['session_survey']['numchoices'] = $HTTP_POST_VARS['numchoices'] ;
		}
	}
	else if ( $action == "step4" )
	{
		$HTTP_SESSION_VARS['session_survey']['q_open'] = $HTTP_POST_VARS['q_open'] ;
		$HTTP_SESSION_VARS['session_survey']['post_mesg'] = $HTTP_POST_VARS['post_mesg'] ;
		$HTTP_SESSION_VARS['session_survey']['choices'] = $HTTP_POST_VARS['choices'] ;
	}
	else if ( $action == "done" )
	{
		$survey_data_array = ARRAY() ;
		if ( isset( $HTTP_SESSION_VARS['session_survey']['name'] ) )
		{
			$survey_data_array['name'] = $HTTP_SESSION_VARS['session_survey']['name'] ;
			$survey_data_array['intro'] = $HTTP_SESSION_VARS['session_survey']['intro'] ;
			$survey_data_array['q_survey'] = $HTTP_SESSION_VARS['session_survey']['q_survey'] ;
			$survey_data_array['stype'] = $HTTP_SESSION_VARS['session_survey']['stype'] ;
			$survey_data_array['numchoices'] = $HTTP_SESSION_VARS['session_survey']['numchoices'] ;
			$survey_data_array['q_open'] = $HTTP_SESSION_VARS['session_survey']['q_open'] ;
			$survey_data_array['choices'] = $HTTP_SESSION_VARS['session_survey']['choices'] ;
			$survey_data_array['post_mesg'] = $HTTP_SESSION_VARS['session_survey']['post_mesg'] ;
			$survey_data = serialize( $survey_data_array ) ;
			ServiceSurvey_put_Survey( $dbh, $session_setup['aspID'], $session_setup['login'], 0, $HTTP_SESSION_VARS['session_survey']['name'], $survey_data ) ;
			$HTTP_SESSION_VARS['session_survey']['choices'] = Array() ;
			$HTTP_SESSION_VARS['session_survey'] = Array() ;
			HEADER( "location: survey.php?success=1" ) ;
			exit ;
		}
	}
	else if ( $action == "activate" )
	{
		ServiceSurvey_update_ActivateSurvey( $dbh, $session_setup['aspID'], $session_setup['login'], 0, $HTTP_GET_VARS['surveyid'] ) ;
		HEADER( "location: survey.php?success=1" ) ;
		exit ;
	}
	else if ( $action == "update" )
	{
		$survey = ServiceSurvey_get_SurveyInfo( $dbh, $session_setup['aspID'], $surveyid ) ;
		if ( isset( $survey['survey_data'] ) )
			$survey_data = unserialize( $survey['survey_data'] ) ;

		$survey_data['intro'] = $HTTP_POST_VARS['intro'] ;
		$survey_data['q_survey'] = $HTTP_POST_VARS['q_survey'] ;
		$survey_data['q_open'] = $HTTP_POST_VARS['q_open'] ;
		$survey_data['post_mesg'] = $HTTP_POST_VARS['post_mesg'] ;
		$survey_data_string = serialize( $survey_data ) ;

		ServiceSurvey_update_SurveyValue( $dbh, $session_setup['aspID'], $surveyid, "name", $HTTP_POST_VARS['name'] ) ;
		ServiceSurvey_update_SurveyValue( $dbh, $session_setup['aspID'], $surveyid, "survey_data", $survey_data_string ) ;
		$action = "edit" ;
		$success = 1 ;
	}
	else if ( $action == "delete" )
	{
		ServiceSurvey_remove_Survey( $dbh, $session_setup['aspID'], $surveyid ) ;
		$success = 1 ;
	}
?>
<? include_once("$DOCUMENT_ROOT/setup/header.php") ; ?>
<script language="JavaScript">
<!--
	function goto_step2()
	{
		if ( document.form.name.value == "" )
			alert( "Please provide the survey name." ) ;
		else
		{
			document.form.name.value = replace( document.form.name.value, '"', "&quot;" ) ;
			document.form.submit() ;
		}
	}

	function goto_step3()
	{
		if ( ( document.form.intro.value == "" ) || ( document.form.q_survey.value == "" )
			|| ( document.form.numchoices.value == "" ) )
			alert( "All fields MUST be provided." ) ;
		else
		{
			if ( document.form.numchoices.value <= 1 )
				alert( "Number of choices must be at least 2." ) ;
			else if ( document.form.numchoices.value > 5 )
				alert( "Number of choices must be 5 or less." ) ;
			else
			{
				document.form.intro.value = replace( document.form.intro.value, '"', "&quot;" ) ;
				document.form.q_survey.value = replace( document.form.q_survey.value, '"', "&quot;" ) ;
				document.form.submit() ;
			}
		}
	}

	function goto_step4()
	{
		var ok = 1 ;
		for( c = 1; c < ( document.form.length - 3 ) ; ++c )
		{
			if ( document.form[c].value == "" )
			{
				alert( "Please provide a value for choice " + c ) ;
				ok = 0 ;
			}
			else
				document.form[c].value = replace( document.form[c].value, '"', "&quot;" ) ;
		}

		if ( ok )
			document.form.submit() ;
	}

	function goto_done()
	{
		if ( confirm( "Ready to create Survey?" ) )
			document.form.submit() ;
	}

	function toggle_active( field )
	{
		location.href = "survey.php?action=activate&surveyid="+field.value ;
	}

	function do_delete( surveyid )
	{
		if ( confirm( "Really delete this Survey?" ) )
		{
			if ( confirm( "All data will be lost!  Really delete?" ) )
				location.href = "survey.php?action=delete&surveyid="+surveyid ;
		}
	}

	function goto_update()
	{
		var ok = 1 ;
		for( c = 2; c < ( document.form.length - 3 ) ; ++c )
		{
			if ( document.form[c].value == "" )
				ok = 0 ;
			else
				document.form[c].value = replace( document.form[c].value, '"', "&quot;" ) ;
		}
		if ( document.form.post_mesg.value == "" )
			ok = 0 ;
			

		if ( ok )
		{
			document.form.post_mesg.value = replace( document.form.post_mesg.value, '"', "&quot;" ) ;
			document.form.submit() ;
		}
		else
			alert( "All fields must be filled. (Open ended Question optional)" ) ;
	}

	function view_survey( surveyid )
	{
		location.href = "survey.php?action=view&surveyid="+surveyid ;
	}

	function PHPLiveSubmitSurvey(form)
	{
		newwin = window.open( "<? echo $BASE_URL ?>/web/index.php", "newwin", 'scrollbars=no,menubar=no,resizable=0,location=no,screenX=50,screenY=100,width=450,height=350' ) ;
		form.target = "newwin" ;
		form.action = "<? echo $BASE_URL ?>/admin/traffic/survey_take.php" ;
		form.method = "POST" ;
		form.submit() ;
	}
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td width="100%" valign="top"> 
	<p><span class="title">Survey: Proactive Survey</span><br>
	  Create or Edit your <i>Proactive Survey</i> to gather information from your website visitors.  You can instantly push surveys to website vistors directly from the operator traffic monitor.</p>

		<form method="POST" action="survey.php" name="form">
		<? if ( $action == "step2" ): ?>

		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td><span class="basicTitle">Create New Survey: Step 2:</span></td>
			<td><a href="survey.php"><img src="../../images/counters/1s_on.gif" width="25" height="25" border=0 alt=""></a></td>
			<td><img src="../../images/counters/2s_on.gif" width="25" height="25" border=0 alt=""></td>
			<td><img src="../../images/counters/3s_off.gif" width="25" height="25" border=0 alt=""></td>
			<td><img src="../../images/counters/4s_off.gif" width="25" height="25" border=0 alt=""></td>
		</tr>
		</table>
		<input type="hidden" name="action" value="step3">
		<table cellspacing=0 cellpadding=2 border=0 width="100%">
		<tr class="altcolor2">
			<td colspan=2><span class="medium">Welcome intro example (max 255 chars): <i>"Thank you for visiting PHP Live! Support. To better assist you, please take a moment to fill out our survey."</i></td>
		</tr>
		<tr class="altcolor2">
			<td>Welcome Intro</td>
			<td><input type="text" name="intro" size=<? echo $text_width ?> maxlength=255 value="<?= ( isset( $HTTP_SESSION_VARS['session_survey']['intro'] ) && $HTTP_SESSION_VARS['session_survey']['intro'] ) ? $HTTP_SESSION_VARS['session_survey']['intro'] : "" ?>"></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">Provide the survey question for your visitors. (max 255 chars)</td>
		</tr>
		<tr class="altcolor2">
			<td>Survey Question</td>
			<td><input type="text" name="q_survey" size=<? echo $text_width ?> maxlength=255 value="<?= ( isset( $HTTP_SESSION_VARS['session_survey']['q_survey'] ) && $HTTP_SESSION_VARS['session_survey']['q_survey'] ) ? $HTTP_SESSION_VARS['session_survey']['q_survey'] : "" ?>"></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">Number of possible choices the visitor will select from for the above question. (max 5 choices)</td>
		</tr>
		<tr class="altcolor2">
			<td>Number of possible choices</td>
			<td><input type="text" name="numchoices" size=2 maxlength=1 onKeyPress="return numbersonly(event)" value="<?= ( isset( $HTTP_SESSION_VARS['session_survey']['numchoices'] ) && $HTTP_SESSION_VARS['session_survey']['numchoices'] ) ? $HTTP_SESSION_VARS['session_survey']['numchoices'] : "" ?>"></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">Can visitors choose SINGLE or MULTIPLE selection from your available choices?</td>
		</tr>
		<tr class="altcolor2">
			<td>Radio or Checkbox</td>
			<td><select name="stype"><option value="radio" <?= ( isset( $HTTP_SESSION_VARS['session_survey']['stype'] ) && ( $HTTP_SESSION_VARS['session_survey']['stype'] == "radio" ) ) ? "selected" : "" ?>>Single Selection (radio)</option><option value="checkbox" <?= ( isset( $HTTP_SESSION_VARS['session_survey']['stype'] ) && ( $HTTP_SESSION_VARS['session_survey']['stype'] == "checkbox" ) ) ? "selected" : "" ?>>Multiple Selection (checkbox)</option></select></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" OnClick="goto_step3()" class="mainButton" value="Proceed to Step 3"></td>
		</tr>
		</table>



		<? elseif ( $action == "step3" ): ?>
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td><span class="basicTitle">Create New Survey: Step 3:</span></td>
			<td><a href="survey.php"><img src="../../images/counters/1s_on.gif" width="25" height="25" border=0 alt=""></a></td>
			<td><a href="survey.php?action=step2"><img src="../../images/counters/2s_on.gif" width="25" height="25" border=0 alt=""></a></td>
			<td><img src="../../images/counters/3s_on.gif" width="25" height="25" border=0 alt=""></td>
			<td><img src="../../images/counters/4s_off.gif" width="25" height="25" border=0 alt=""></td>
		</tr>
		</table>
		<input type="hidden" name="action" value="step4">
		<table cellspacing=0 cellpadding=2 border=0>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">Provide the available choices of the survey question. (max 100 char)</td>
		</tr>
		<tr class="altcolor1">
			<td colspan=2>The survey question was: <i>"<? echo $HTTP_SESSION_VARS['session_survey']['q_survey'] ?>"</i></td>
		</tr>
		<?
			$q_survey_choices_array = ARRAY() ;
			if ( isset ( $HTTP_SESSION_VARS['session_survey']['choices'] ) )
				$q_survey_choices_array = $HTTP_SESSION_VARS['session_survey']['choices'] ;

			for ( $c = 0; $c < $HTTP_SESSION_VARS['session_survey']['numchoices']; ++$c )
			{
				$num_display = $c + 1 ;
				// set the array if not set already
				if ( !isset( $q_survey_choices_array[$c] ) )
					$q_survey_choices_array[$c] = "" ;
				print "
					<tr class=\"altcolor2\">
						<td>Choice $num_display</td>
						<td><input type=\"text\" name=\"choices[]\" size=25 maxlength=100 value=\"$q_survey_choices_array[$c]\"></td>
					</tr>
				" ;
			}
		?>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">You may ask an open ended question to get feedbacks or comments.  The question will be answered by visitors using a textbox form.  Leave this field blank if you do not wish to have an open ended question. (max 255 chars)</td>
		</tr>
		<tr class="altcolor2">
			<td>Open Ended Question (optional)</td>
			<td><input type="text" name="q_open" size=<? echo $text_width ?> maxlength=255 value="<?= ( isset( $HTTP_SESSION_VARS['session_survey']['q_open'] ) && $HTTP_SESSION_VARS['session_survey']['q_open'] ) ? $HTTP_SESSION_VARS['session_survey']['q_open'] : "" ?>"></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">Post survey message (max 255 chars).  <i>"Thank you for taking the survey.  Your feedback is very important to us.  If you would like to chat with our Live Support Agent, just click on the button below."</i></td>
		</tr>
		<tr class="altcolor2">
			<td>Post Survey Mesg</td>
			<td><input type="text" name="post_mesg" size=<? echo $text_width ?> maxlength=255 value="<?= ( isset( $survey_data['post_mesg'] ) && $survey_data['post_mesg'] ) ? $survey_data['post_mesg'] : "" ?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" OnClick="goto_step4()" class="mainButton" value="Proceed to Step 4"></td>
		</tr>
		</table>




		<? elseif ( $action == "step4" ): ?>
		<input type="hidden" name="action" value="done">
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td><span class="basicTitle">Create New Survey: Final Step - Verify Survey:</span></td>
			<td><a href="survey.php"><img src="../../images/counters/1s_on.gif" width="25" height="25" border=0 alt=""></a></td>
			<td><a href="survey.php?action=step2"><img src="../../images/counters/2s_on.gif" width="25" height="25" border=0 alt=""></a></td>
			<td><a href="survey.php?action=step3"><img src="../../images/counters/3s_on.gif" width="25" height="25" border=0 alt=""></a></td>
			<td><img src="../../images/counters/4s_on.gif" width="25" height="25" border=0 alt=""></td>
		</tr>
		</table>
		Verify your data and if correct, press the "Create Survey" to finish!  If you would like to make modifications, just click on the steps above.
		<p>

		<table cellspacing=0 cellpadding=2 border=0 width="100%">
		<tr class="altcolor2">
			<th width="100" align="left">Survey Name</th>
			<td><? echo $HTTP_SESSION_VARS['session_survey']['name'] ?></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<th width="100" align="left">Welcome Intro Text</th>
			<td><? echo $HTTP_SESSION_VARS['session_survey']['intro'] ?></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<th width="100" align="left">Survey Question</th>
			<td><? echo $HTTP_SESSION_VARS['session_survey']['q_survey'] ?></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<th width="100" align="left">Choices</th>
			<td><br>
			<?
				$choices = $HTTP_SESSION_VARS['session_survey']['choices'] ;
				for ( $c = 0; $c < count( $choices ); ++$c )
					print "<input type=\"".$HTTP_SESSION_VARS['session_survey']['stype']."\" name=\"null\"> $choices[$c]<br>" ;
			?>
			</td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<th width="100" align="left">Open Ended Question</th>
			<td><? echo $HTTP_SESSION_VARS['session_survey']['q_open'] ?></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<th width="100" align="left">Post Survey Mesg</th>
			<td><? echo $HTTP_SESSION_VARS['session_survey']['post_mesg'] ?></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" OnClick="goto_done()" class="mainButton" value="Looks Good!  Create Survey!"></td>
		</tr>
		</table>






		<? 
			elseif( $action == "edit" ):
			$survey = ServiceSurvey_get_SurveyInfo( $dbh, $session_setup['aspID'], $surveyid ) ;
			if ( isset( $survey['survey_data'] ) )
				$survey_data = unserialize( $survey['survey_data'] ) ;
		?>
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td><span class="basicTitle">Edit Survey:</span></td>
		</tr>
		<tr>
			<td colspan=2 class="hilight">Because of the sensative nature of the survey data and to limit misleading results, only the name, welcome intro and the questions can be updated.</td>
		</tr>
		</table>
		<input type="hidden" name="action" value="update">
		<input type="hidden" name="surveyid" value="<? echo $surveyid ?>">
		<table cellspacing=0 cellpadding=2 border=0 width="100%">
		<tr class="altcolor2"">
			<td colspan=2><span class="medium">Suvey Name is only used for your reference.  It is not displayed to visitors.</td>
		</tr>
		<tr class="altcolor2"">
			<td>Survey Name</td>
			<td><input type="text" name="name" size=<? echo $text_width ?> maxlength=60 value="<?= ( isset( $survey['name'] ) && $survey['name'] ) ? stripslashes( $survey['name'] ) : "" ?>"></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">Welcome intro example (max 255 chars): <i>"Thank you for visiting PHP Live! Support. To better assist you, please take a moment to fill out our survey."</i></td>
		</tr>
		<tr class="altcolor2">
			<td>Welcome Intro</td>
			<td><input type="text" name="intro" size=<? echo $text_width ?> maxlength=255 value="<?= ( isset( $survey_data['intro'] ) && $survey_data['intro'] ) ? stripslashes( $survey_data['intro'] ) : "" ?>"></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">Provide the survey question for your visitors. (max 255 chars)</td>
		</tr>
		<tr class="altcolor2">
			<td>Survey Question</td>
			<td><input type="text" name="q_survey" size=<? echo $text_width ?> maxlength=255 value="<?= ( isset( $survey_data['q_survey'] ) && $survey_data['q_survey'] ) ? stripslashes( $survey_data['q_survey'] ) : "" ?>"></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">You may ask an open ended question to get feedbacks or comments.  The question will be answered by visitors using a textbox form.  Leave this field blank if you do not wish to have an open ended question. (max 255 chars)</td>
		</tr>
		<tr class="altcolor2">
			<td>Open Ended Question (optional)</td>
			<td><input type="text" name="q_open" size=<? echo $text_width ?> maxlength=255 value="<?= ( isset( $survey_data['q_open'] ) && $survey_data['q_open'] ) ? stripslashes( $survey_data['q_open'] ) : "" ?>"></td>
		</tr>
		<tr><td height="2" colspan=8 class="hdash"><img src="../../images/spacer.gif" width="1" height="2"></td></tr>
		<tr class="altcolor2">
			<td colspan=2><span class="medium">Post survey message (max 255 chars).  <i>"Thank you for taking the survey.  Your feedback is very important to us.  If you would like to chat with our Live Support Agent, just click on the button below."</i></td>
		</tr>
		<tr class="altcolor2">
			<td>Post Survey Mesg</td>
			<td><input type="text" name="post_mesg" size=<? echo $text_width ?> maxlength=255 value="<?= ( isset( $survey_data['post_mesg'] ) && $survey_data['post_mesg'] ) ? stripslashes( $survey_data['post_mesg'] ) : "" ?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" OnClick="goto_update()" class="mainButton" value="Update Survey"></td>
		</tr>
		</table>





		<? 
			elseif ( $action == "view" ):
			$survey = ServiceSurvey_get_SurveyInfo( $dbh, $session_setup['aspID'], $surveyid ) ;
			if ( isset( $survey['survey_data'] ) )
				$survey_data = unserialize( $survey['survey_data'] ) ;
		
			$survey_choices_string = "" ;
			$survey_choices = $survey_data['choices'] ;
			for ( $c = 0; $c < count( $survey_choices ); ++$c )
				$survey_choices_string .= "<input type=\"$survey_data[stype]\" name=\"choices[]\" value=\"$c\"> ". stripslashes( $survey_choices[$c] ) . "<br>" ;
			$q_open_string = "" ;
			if ( $survey_data['q_open'] )
				$q_open_string = stripslashes( $survey_data['q_open'] ) . "<br><textarea cols=40 rows=5 name=\"q_open\"></textarea><p>" ;
			$survey_name = stripslashes( $survey['name'] ) ;
			$survey_intro = stripslashes( $survey_data['intro'] ) ;
			$survey_question = stripslashes( $survey_data['q_survey'] ) ;

			$default_branding = preg_replace( "/'/", "\"", $LANG['DEFAULT_BRANDING'] ) ;

			$survey_js_file = "<table cellspacing=0 cellpadding1 border=0 bgColor=\"#000000\"><tr><td><table bgcolor=\"#000000\" cellpadding=0 cellspacing=0 border=0 width=\"450\"> 				<tr> 					<td> 						<table bgcolor=\"#E9E9E9\" cellpadding=0 cellspacing=0 border=0 width=\"100%\"> 						<tr> 							<td width=\"100%\"> 								<table cellspacing=0 cellpadding=5 border=0 width=\"100%\"> 								<tr> 									<td align=\"right\"><a href=\"JavaScript:void(0)\"><font size=1 face=\"arial\" color=\"#000000\">|x| close window</font></a></td> 								</tr> 								</table> 								<br><table cellspacing=0 cellpadding=5 border=0 width=\"100%\"><tr><td><font size=2 face=\"arial\" color=\"#000000\"><big><b>$survey_intro</b></big></td></tr></table> 							</td> 						</tr> 						</table> 					</td> 				</tr> 				<tr> 					<td><img src=\"$BASE_URL/images/survey_themes/splitter.gif\" width=\"450\" height=\"13\" border=0 alt=\"\"></td> 				</tr> 					<td bgColor=\"#FFFFFF\"><font face=\"arial\" size=2><form target=newwin method=POST action=\"$BASE_URL/admin/traffic/survey_take.php\" name=\"phplive_surveyform\"><input type=\"hidden\" name=\"aspid\" value=\"$session_setup[aspID]\"><input type=\"hidden\" name=\"surveyid\" value=\"$surveyid\"><table cellspacing=0 cellpadding=5 border=0 width=\"100%\"><tr><td><font size=2 face=\"arial\"><p>$survey_question<br>$survey_choices_string<p>$q_open_string<p><input type=button value=\"Submit Survey\" OnClick=\"PHPLiveSubmitSurvey(this.form)\" style=\"background-color : #E2E2E2; font-weight : bold; cursor: hand;\"></font></td></tr></table></form><p><table cellspacing=0 cellpadding=5 border=0 width=\"100%\"><tr><td><font size=1 face=\"arial\">$default_branding - v$PHPLIVE_VERSION &copy; OSI Codes Inc</td></tr></table> 					</td> 				</tr> 				</table></td></tr></table>" ;
		?>

		<span class="basicTitle">View Survey: <? echo $survey_name ?></span><p>
		<? echo $survey_js_file ?>
		






		<? 
			elseif ( $action == "results" ):
			$survey = ServiceSurvey_get_SurveyInfo( $dbh, $session_setup['aspID'], $surveyid ) ;
			$surveylogs = ServiceSurvey_get_AllSurveyLogs( $dbh, $session_setup['aspID'], $surveyid, $page, 20 ) ;
			$total_logs = ServiceSurvey_get_TotalSurveyLogs( $dbh, $session_setup['aspID'], $surveyid ) ;
			$page_string = Page_util_CreatePageString( $dbh, $page, "survey.php?action=results&surveyid=$surveyid", 20, $total_logs ) ;

			$survey_data = unserialize( stripslashes( $survey['survey_data'] ) ) ;
			$numchoices = $survey_data['numchoices'] ;
			$survey_choices = $survey_data['choices'] ;

			$type_string = "Single Select" ;
			if ( $survey_data['stype'] == "checkbox" )
				$type_string = "Multiple Select" ;

			$percentage = Array() ;
			for ( $c = 0; $c < $numchoices; ++$c )
			{
				$index = $c + 1 ;
				$index_string = "s_c$index" ;
				$percentage[$c] = 0 ;
				if ( $survey['s_totaltaken'] )
					$percentage[$c] = floor( ( $survey[$index_string]/$survey['s_totaltaken'] ) * 100 ) ;
			}
		?>
		<span class="basicTitle">Survey Results: <? echo $survey['name'] ?></span><br>
		Total Survey Taken: <? echo $survey['s_totaltaken'] ?><br>
		Type of Selection: <? print "$type_string ($survey_data[stype])" ?><p>
		<table cellspacing=0 cellpadding=2 border=0 width="100%">
		<?
			for ( $c = 0; $c < count( $survey_choices ); ++$c )
			{
				$index = $c + 1 ;
				$index_string = "s_c$index" ;
				
				$class = "altcolor1" ;
				if ( $c % 2 )
					$class = "altcolor3" ;
				// give some buffer for the result text

				print "<tr class=\"$class\"><td width=\"100%\">Choice $index: <b>$survey_choices[$c]</b><br>Percentage: $survey[$index_string] ($percentage[$c]%)<br><img src=\"$BASE_URL/images/graph_blue.gif\" width=\"$percentage[$c]%\" height=10\"></td><tr><tr><td height=\"2\" colspan=8 class=\"hdash\"><img src=\"../../images/spacer.gif\" width=\"1\" height=\"2\"></td></tr>" ;
			}
		?>
		</table>
		<p>
		Page: <? echo $page_string ?><br>
		<table cellspacing=1 cellpadding=2 border=0 width="100%">
		<tr>
		<?
			for ( $c = 1; $c <= $numchoices; ++$c )
				print "<th width=20>$c</th>" ;
			if ( $survey_data['q_open'] )
				print "<th align=\"left\"><i>\"$survey_data[q_open]\"</i></th>" ;
		?>
		</tr>
		<?
			for ( $c = 0; $c < count( $surveylogs ); ++$c )
			{
				$surveylog = $surveylogs[$c] ;
				$q_open = stripslashes( $surveylog['q_open'] ) ;
				$class = "altcolor1" ;
				if ( $c % 2 )
					$class = "altcolor3" ;

				$answer_string = "" ;
				for ( $c2 = 1; $c2 <= $numchoices; ++$c2 )
				{
					$index_string = "s_c$c2" ;
					$checked = "&nbsp;" ;
					if ( $surveylog[$index_string] )
						$checked = "X" ;
					$answer_string .= "<td align=\"center\">$checked</td>" ;
				}

				print "<tr class=\"$class\">$answer_string<td>$q_open&nbsp;</td></tr>" ;
			}
		?>
		</table>








		<?
			else:
			$surveys = ServiceSurvey_get_AllASPSurveys( $dbh, $session_setup['aspID'], $deptid ) ;
		?>
		Current surveys are listed below.  You may only select ONE active survey at a time.  The active survey will be the current survey your operators will be able to push to visitors.<p>
		<span class="hilight">Remember</span>, if you have modified the Survey, you must click "Activate" again for the changes to take effect.<br>
		<table cellspacing=1 cellpadding=2 border=0 width="100%">
		<tr>
			<th align="left">Survey Name</th>
			<th>Active</th>
			<th>Results</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
			<th>&nbsp;</th>
		</tr>
		<?
			if ( count( $surveys ) <= 0 )
				print "<td colspan=6 class=\"altcolor1\">No surveys created at this time.</td>" ;
			else
			{
				for ( $c = 0; $c < count( $surveys ); ++$c )
				{
					$survey = $surveys[$c] ;
					$survey_name = stripslashes( $survey['name'] ) ;
					$created = date( "D M d, Y", $survey['created'] ) ;

					$checked = "" ;
					if ( $survey['isactive' ] )
						$checked = "checked" ;

					$class = "altcolor1" ;
					if ( $c % 2 )
						$class = "altcolor2" ;

					print "<tr class=\"$class\"><td>$survey_name</td><td align=\"center\"><input type=\"radio\" name=\"activate\" value=\"$survey[surveyID]\" $checked OnClick=\"toggle_active(this)\"></td><td align=\"center\"><a href=\"survey.php?action=results&surveyid=$survey[surveyID]\"><img src=\"../../images/graph_icon.gif\" width=\"15\" height=\"15\" border=0 alt=\"View Results\"></a></td><td><a href=\"JavaScript:view_survey( $survey[surveyID] )\">View</a></td><td><a href=\"survey.php?action=edit&surveyid=$survey[surveyID]\">Edit</a></td><td><a href=\"JavaScript:do_delete( $survey[surveyID] )\">Delete</a></td></tr>" ;
				}
			}
		?>
		</table>

		<br>
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td><span class="basicTitle">Create New Survey: Step 1:</span></td>
			<td><img src="../../images/counters/1s_on.gif" width="25" height="25" border=0 alt=""></td>
			<td><img src="../../images/counters/2s_off.gif" width="25" height="25" border=0 alt=""></td>
			<td><img src="../../images/counters/3s_off.gif" width="25" height="25" border=0 alt=""></td>
			<td><img src="../../images/counters/4s_off.gif" width="25" height="25" border=0 alt=""></td>
		</tr>
		</table>
		<input type="hidden" name="action" value="step2">
		<table cellspacing=0 cellpadding=2 border=0 width="100%">
		<tr class="altcolor2"">
			<td colspan=2><span class="medium">Suvey Name is only used for your reference.  It is not displayed to visitors.</td>
		</tr>
		<tr class="altcolor2"">
			<td>Survey Name</td>
			<td><input type="text" name="name" size=<? echo $text_width ?> maxlength=60 value="<?= ( isset( $HTTP_SESSION_VARS['session_survey']['name'] ) && $HTTP_SESSION_VARS['session_survey']['name'] ) ? $HTTP_SESSION_VARS['session_survey']['name'] : "" ?>"></td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" OnClick="goto_step2()" class="mainButton" value="Proceed to Step 2"></td>
		</tr>
		</table>






		<? endif ; ?>
		</form>

	
	</td>
  <td height="350" align="center" style="background-image: url(../../images/g_marketing_big);background-repeat: no-repeat;"><img src="../../images/spacer.gif" width="229" height="1"></td>
</tr>
</table>

<? include_once( "$DOCUMENT_ROOT/setup/footer.php" ) ; ?>