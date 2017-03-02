<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	$action = $error_mesg = "" ;
	$success = 0 ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: index.php" ) ; exit ; }
	if ( !file_exists( "../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("$DOCUMENT_ROOT/web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint/put.php") ;
?>
<?
	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }

	$month = $HTTP_GET_VARS['month'] ? $HTTP_GET_VARS['month'] : $HTTP_POST_VARS['month'] ;
	$day = $HTTP_GET_VARS['day'] ? $HTTP_GET_VARS['day'] : $HTTP_POST_VARS['day'] ;
	$year = $HTTP_GET_VARS['year'] ? $HTTP_GET_VARS['year'] : $HTTP_POST_VARS['year'] ;

	// initialize
	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "12" ;
	else
		$text_width = "9" ;

	$now = mktime( 0,0,0,date("m"),date("j"),date("Y") ) ;

	$stat_begin = mktime( 0,0,0,$month,$day,$year ) ;
	$stat_end = mktime( 23,59,59,$month,$day,$year ) ;

	if ( !$month || !$day || !$year )
	{
		HEADER( "location: $BASE_URL/setup/options.php" ) ;
		exit ;
	}

	// make sure it does not log current day, because current day is REAL-TIME
	if ( $stat_begin >= $now )
	{
		HEADER( "location: $BASE_URL/setup/options.php?optimized=1" ) ;
		exit ;
	}

	$nextday = mktime( 0,0,0,$month,$day+1,$year ) ;
	$nextday_month = date("m", $nextday ) ;
	$nextday_day = date("j", $nextday ) ;
	$nextday_year = date("Y", $nextday ) ;

	$optimize_day = date( "F j, Y", $stat_begin ) ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title>Optimize Disc Space</title>
<script language="JavaScript">
<!--
	function do_alert()
	{
		<? if ( $success ) { print "		alert( 'Success!' ) ;\n" ; } ?>
	}

	function do_reload()
	{
		setTimeout("location.href='optimize.php?month=<? echo $nextday_month ?>&day=<? echo $nextday_day ?>&year=<? echo $nextday_year ?>'",1000) ;
	}
//-->
</script>
<? $css_path = "../" ; include_once( "../css/default.php" ) ; ?>

</head>
<body leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="height:100%">
  <tr> 
	<td height="65" valign="top" class="bgHead"> <table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td width="102" height="65" valign="bottom" class="bgCornerTop"><img src="../images/bg_corner_top.gif" width="102" height="65"></td>
		  <td height="65"><img src="../images/logo.gif" alt="" width="179" height="53" border="0"> 
		  </td>
		</tr>
	  </table></td>
  </tr>
  <tr> 
	<td height="47" valign="top" class="bgMenuBack"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td><img src="../images/bg_corner_bot.gif" width="121" height="47"> <img src="../images/spacer.gif" width="10" height="1"></td>
		</tr>
	  </table></td>
  </tr>
  <tr> 
	<td align="center" valign="middle" class="bg">
		<font color="#FF0000"><? echo $error_mesg ?></font>
		<p>

		<big><b>Optimizing log files (<font color="#FF0000"><i><? echo $optimize_day ?></i></font>).  Please hold ...</big></b>
		<br>
		<font color="#FF0000">* DO NOT STOP THIS PROCESS!  Please wait until finished...</font>
		<p>
		
		<?
			// do the processing here so that the output of above can be displayed first
			$top_url_visits = ServiceFootprint_get_DayFootprint( $dbh, "", $stat_begin, $stat_end, 25, $session_setup['aspID'], $day, 1 ) ;
			for ( $c = 0; $c < count( $top_url_visits ); ++$c )
			{
				$footprint = $top_url_visits[$c] ;
				ServiceFootprint_put_FootprintURLStat( $dbh, $session_setup['aspID'], $stat_begin, $footprint['url'], $footprint['total'] ) ;
			}

			// put daily page view and unique hits
			$total_page_views = ServiceFootprint_get_TotalDayFootprint( $dbh, $stat_begin, $stat_end, $session_setup['aspID'], 1 ) ;
			$total_unique_visits = ServiceFootprint_get_TotalUniqueDayVisits( $dbh, $stat_begin, $stat_end, $session_setup['aspID'], 1 ) ;
			ServiceFootprint_put_FootprintStat( $dbh, $session_setup['aspID'], $stat_begin, $total_page_views, $total_unique_visits ) ;

			print "Optimizing: $total_unique_visits visits, $total_page_views page views\n" ;

			print "
				<script language=\"JavaScript\">
				<!--
					do_reload() ;
				//-->
				</script>
				" ;
		?>

	  </p></td>
  </tr>
  <tr> 
	<td height="20" align="right" class="bgFooter" style="height:20px"><img src="../images/bg_corner_footer.gif" alt="" width="94" height="20"></td>
  </tr>
  <tr> 
	<td height="20" align="center" class="bgCopyright" style="height:20px">Powered by PHP Live! - v<? echo $PHPLIVE_VERSION ?> &copy; OSI Codes Inc</td>
  </tr>
</table>
<!-- This navigation layer is placed at the very botton of the HTML to prevent pesky problems with NS4.x -->
</body>
</html>
<?
	mysql_close( $dbh['con'] ) ;
?>