<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: ../../setup/index.php" ) ; exit ; }
	if ( !file_exists( "../../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../../web/conf-init.php");
	include_once("$DOCUMENT_ROOT/web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/API/Util_Cal.php" ) ;
	include_once("$DOCUMENT_ROOT/API/Clicks/get.php") ;
	$section = 7;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)

	$nav_line = '<a href="click_track.php" class="nav">:: Previous</a>';
	$css_path = "../../" ;
?>
<?

	// initialize
	// initialize
	$action = "" ;
	$trackid = $m = $y = $d = 0 ;
	if ( isset( $HTTP_GET_VARS['m'] ) ) { $m = $HTTP_GET_VARS['m'] ; }
	if ( isset( $HTTP_GET_VARS['d'] ) ) { $d = $HTTP_GET_VARS['d'] ; }
	if ( isset( $HTTP_GET_VARS['y'] ) ) { $y = $HTTP_GET_VARS['y'] ; }
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['trackid'] ) ) { $trackid = $HTTP_GET_VARS['trackid'] ; }
	if ( isset( $HTTP_POST_VARS['trackid'] ) ) { $trackid = $HTTP_POST_VARS['trackid'] ; }

	if ( !$m )
		$m = date( "m",mktime() ) ;
	if ( !$y )
		$y = date( "Y",mktime() ) ;
	$d = date( "j",mktime() ) ;


	// this is for the monthly breakdown
	$stat_begin = mktime( 0,0,0,$m,1,$y ) ;
	$stat_end = mktime( 23,59,59,$m,31,$y ) ;
	
	$stats = ServiceClicks_get_TotalTrackingClicksDay( $dbh, $session_setup['aspID'], $trackid, $stat_begin, $stat_end ) ;

	$stats_hash = Array() ;
	// create hash
	for ( $c = 0; $c < count( $stats ); ++$c )
	{
		$stat = $stats[$c] ;
		$statdate = $stat['statdate'] ;
		$stats_hash[$statdate] = $stat['clicks'] ;
	}

	$trackinfo = ServiceClicks_get_TrackingURLInfoByID( $dbh, $session_setup['aspID'], $trackid ) ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<? include_once("$DOCUMENT_ROOT/setup/header.php"); ?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td valign="top" width="100%"> <p><span class="title">Marketing: Click Tracking</span>
  <p>
	Below is the complete monthly breakdown of the clicks received from tracking campaign: <big><strong><? echo $trackinfo['name'] ?></strong></big>
	</p>
	
	<table cellspacing=1 cellpadding=2 border=0 width="100%">
	  <tr align="left"> 
		<th nowrap>Day</th>
		<th nowrap>Clicks</th>
	  </tr>
	<?
		$grand_total = 0 ;
		for ( $c = 1; $m == date( "m", mktime( 0,0,1,$m,$c,$y ) ); ++$c )
		{
			$date = mktime( 0,0,1,$m,$c,$y ) ;
			$day = date( "F d, Y D", $date ) ;

			$day_clicks = 0 ;
			if ( isset( $stats_hash[$date] ) )
				$day_clicks = $stats_hash[$date] ;
			$grand_total += $day_clicks ;

			$class = "class=\"altcolor1\"" ;
			if ( $c % 2 )
				$class = "class=\"altcolor2\"" ;

			if ( $c == $d )
				$class = "bgColor=\"#DDFFDD\"" ;

			print "
				<tr $class>
					<td>$day</td>
					<td align=\"left\">$day_clicks</td>
				</tr>" ;
		}
	?>
	<tr class="altcolor3">
		<th width="180" nowrap align="left">Grand Total for Month</th>
		<th align="left"><? echo $grand_total ?></th>
	</tr>
	 </table>
	
	</td>
  <td height="350" align="center" valign="top" style="background-image: url(../../images/g_marketing_big.jpg);background-repeat: no-repeat;"><img src="../../images/spacer.gif" width="229" height="1"><br> <img src="../../images/spacer.gif" width="1" height="220">
	<form name="form" method="GET" action="click_track_view.php">
	<input type="hidden" name="trackid" value="<? echo $trackid ?>">
	<select name="m">
	<?
		for ( $c = 1; $c <= 12; ++$c )
		{
			$month = date( "F", mktime( 0,0,1,$c,1,$y ) ) ;
			$selected = "" ;
			if ( $c == $m )
				$selected = "selected" ;
			print "<option value=$c $selected>$month</option>" ;
		}
	?>
	</select>
	<select name="y">
	<?
		for ( $c = 2003; $c <= 2100; ++$c )
		{
			$selected = "" ;
			if ( $c == $y )
				$selected = "selected" ;
			print "<option value=$c $selected>$c</option>" ;
		}
	?>
	</select>
	<br><br>
	<input type="submit" value="Jump to Month" style="background-color : #E2E2E2; font-weight : bold; cursor: hand;">
	</form>
  </td>
</tr>
 </table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<? include_once( "$DOCUMENT_ROOT/setup/footer.php" ) ; ?>