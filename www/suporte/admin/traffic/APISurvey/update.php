<?
	/*****  ServiceSurvey::update  **********************************
	 *
	 *  $Id: update.php,v 1.12 2004/04/21 05:43:52 osicodes Exp $
	 *
	 ****************************************************************/

	if ( ISSET( $_OFFICE_update_ServiceSurvey_LOADED ) == true )
		return ;

	$_OFFICE_update_ServiceSurvey_LOADED = true ;

	/*****

	   Internal Dependencies

	*****/
	include_once( "$DOCUMENT_ROOT/admin/traffic/APISurvey/get.php" ) ;

	/*****

	   Module Specifics

	*****/

	/*****

	   Module Functions

	*****/

	/*****  ServiceSurvey_update_SurveyValue  *********************
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
	 *	Kyle Hicks				Nov 9, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_update_SurveyValue( &$dbh,
					$aspid,
					$surveyid,
					$tbl_name,
					$value )
	{
		if ( ( $aspid == "" ) || ( $surveyid == "" )
			|| ( $tbl_name == "" ) )
		{
			return false ;
		}

		$value = addslashes( $value ) ;

		$query = "UPDATE chatsurveys SET $tbl_name = '$value' WHERE surveyID = '$surveyid' AND aspID = '$aspid'" ;
		database_mysql_query( $dbh, $query ) ;
		
		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceSurvey_update_ActivateSurvey  *********************
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
	 *	Kyle Hicks				Nov 9, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_update_ActivateSurvey( &$dbh,
						$aspid,
						$asplogin,
						$deptid,
						$surveyid )
	{
		if ( ( $aspid == "" ) || ( $surveyid == "" ) 
			|| ( $asplogin == "" ) )
		{
			return false ;
		}

		global $DOCUMENT_ROOT ;
		global $BASE_URL ;
		global $LANG ;
		global $PHPLIVE_VERSION ;

		// reset all to inactive
		$query = "UPDATE chatsurveys SET isactive = 0 WHERE aspID = $aspid AND deptID = '$deptid'" ;
		database_mysql_query( $dbh, $query ) ;
		
		// now turn on the active one
		$query = "UPDATE chatsurveys SET isactive = 1 WHERE surveyID = $surveyid" ;
		database_mysql_query( $dbh, $query ) ;

		// *********** create the active survey *********** //
		$survey = ServiceSurvey_get_SurveyInfo( $dbh, $aspid, $surveyid ) ;
		if ( isset( $survey['survey_data'] ) )
			$survey_data = unserialize( $survey['survey_data'] ) ;
		
		$survey_choices_string = "" ;
		$survey_choices = $survey_data['choices'] ;
		for ( $c = 0; $c < count( $survey_choices ); ++$c )
			$survey_choices_string .= "<input type=\"$survey_data[stype]\" name=\"choices[]\" value=\"$c\"> $survey_choices[$c]<br>" ;
		$q_open_string = "" ;
		if ( $survey_data['q_open'] )
			$q_open_string = "$survey_data[q_open]<br><textarea cols=40 rows=5 name=\"q_open\"></textarea><p>" ;

		$default_branding = preg_replace( "/'/", "\"", $LANG['DEFAULT_BRANDING'] ) ;
		$survey_js_string = "phplive_surveys[0] = '<table cellspacing=0 cellpadding1 border=0 bgColor=\"#000000\"><tr><td><table bgcolor=\"#000000\" cellpadding=0 cellspacing=0 border=0 width=\"450\"> 				<tr> 					<td> 						<table bgcolor=\"#E9E9E9\" cellpadding=0 cellspacing=0 border=0 width=\"100%\"> 						<tr> 							<td width=\"100%\"> 								<table cellspacing=0 cellpadding=5 border=0 width=\"100%\"> 								<tr> 									<td align=\"right\"><a href=\"JavaScript:closeSurvey( $surveyid, 1 )\"><font size=1 face=\"arial\" color=\"#000000\">|x| close window</font></a></td> 								</tr> 								</table> 								<br><table cellspacing=0 cellpadding=5 border=0 width=\"100%\"><tr><td><font size=2 face=\"arial\" color=\"#000000\" ><big><b>$survey_data[intro]</b></big></td></tr></table> 							</td> 						</tr> 						</table> 					</td> 				</tr> 				<tr> 					<td><img src=\"$BASE_URL/images/survey_themes/splitter.gif\" width=\"450\" height=\"13\" border=0 alt=\"\"></td> 				</tr> 					<td bgColor=\"#FFFFFF\"><font face=\"arial\" size=2 color=\"#000000\"><form target=newwin method=POST action=\"<0Q0 echo \$HTTP_GET_VARS['base_url'] 0Q0>/admin/traffic/survey_take.php\" name=\"phplive_surveyform\"><input type=\"hidden\" name=\"aspid\" value=\"$aspid\"><input type=\"hidden\" name=\"surveyid\" value=\"$surveyid\"><table cellspacing=0 cellpadding=5 border=0 width=\"100%\"><tr><td><font size=2 face=\"arial\" color=\"#000000\"><p>$survey_data[q_survey]<br>$survey_choices_string<p>$q_open_string<p><input type=button value=\"Submit Survey\" OnClick=\"PHPLiveSubmitSurvey(this.form)\" style=\"background-color : #E2E2E2; font-weight : bold; cursor: hand;\"></font></td></tr></table></form><p><table cellspacing=0 cellpadding=5 border=0 width=\"100%\"><tr><td><font size=1 face=\"arial\" color=\"#000000\">$default_branding - v$PHPLIVE_VERSION &copy; OSI Codes Inc</td></tr></table> 					</td> 				</tr> 				</table></td></tr></table>' ;" ;

		$survey_js_file = "<!--
var phplive_surveys = new Array() ;
$survey_js_string
var phplive_survey_string = phplive_surveys[0] ;
//-->
" ;
		$survey_js_file = preg_replace( "/0Q0/", "?", $survey_js_file ) ;

		$fp = fopen( "$DOCUMENT_ROOT/web/$asplogin/surveys.php", "wb+" ) ;
		fwrite( $fp, $survey_js_file, strlen( $survey_js_file ) ) ;
		fclose( $fp ) ;
		// *********** end create *********** //

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

	/*****  ServiceSurvey_update_SurveyChoiceTotal  *********************
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
	 *	Kyle Hicks				Nov 10, 2002
	 *
	 *****************************************************************/
	FUNCTION ServiceSurvey_update_SurveyChoiceTotal( &$dbh,
						$aspid,
						$surveyid,
						$s_c1,
						$s_c2,
						$s_c3,
						$s_c4,
						$s_c5 )
	{
		if ( ( $aspid == "" ) || ( $surveyid == "" ) )
		{
			return false ;
		}

		$choice_string = "" ;
		if ( $s_c1 )
			$choice_string .= ", s_c1 = s_c1 + 1" ;
		if ( $s_c2 )
			$choice_string .= ", s_c2 = s_c2 + 1" ;
		if ( $s_c3 )
			$choice_string .= ", s_c3 = s_c3 + 1" ;
		if ( $s_c4 )
			$choice_string .= ", s_c4 = s_c4 + 1" ;
		if ( $s_c5 )
			$choice_string .= ", s_c5 = s_c5 + 1" ;

		$query = "UPDATE chatsurveys SET s_totaltaken = s_totaltaken + 1 $choice_string WHERE surveyID = $surveyid AND aspID = $aspid" ;
		database_mysql_query( $dbh, $query ) ;

		if ( $dbh[ 'ok' ] )
		{
			return true ;
		}
		return false ;
	}

?>
