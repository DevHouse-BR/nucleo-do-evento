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
	include_once("$DOCUMENT_ROOT/API/Clicks/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Clicks/put.php") ;
	include_once("$DOCUMENT_ROOT/API/Clicks/update.php") ;
	include_once("$DOCUMENT_ROOT/API/Clicks/remove.php") ;

	$section = 7;			// Section number - see header.php for list of section numbers
	$page_title = "PHP Live! - Administration";

	$nav_line = '<a href="../../setup/options.php" class="nav">:: Home</a>';
	$css_path = "../../" ;
?>
<?

	// initialize
	$action = $error_mesg = "" ;
	$success = $deptid = $trackid = 0 ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['trackid'] ) ) { $trackid = $HTTP_GET_VARS['trackid'] ; }
	if ( isset( $HTTP_POST_VARS['trackid'] ) ) { $trackid = $HTTP_POST_VARS['trackid'] ; }

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "50" ;
		$text_width_long = "85" ;
	}
	else
	{
		$text_width = "15" ;
		$text_width_long = "43" ;
	}
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "create" )
	{
		if ( $trackid )
		{
			ServiceClicks_update_TrackingURL( $dbh, $session_setup['aspID'], $trackid, $HTTP_POST_VARS['name'], $HTTP_POST_VARS['landing_url'], $HTTP_POST_VARS['color'] ) ;
			$trackid = 0 ;
		}
		else
		{
			ServiceClicks_put_Tracking( $dbh, $session_setup['aspID'], $HTTP_POST_VARS['name'], $HTTP_POST_VARS['landing_url'], $HTTP_POST_VARS['color'] ) ;
		}
	}
	else if ( $action == "delete" )
	{
		ServiceClicks_remove_TrackingURL( $dbh, $session_setup['aspID'], $trackid ) ;
	}

	$url_edit = ServiceClicks_get_TrackingURLInfoByID( $dbh, $session_setup['aspID'], $trackid ) ;
	$urls = ServiceClicks_get_AllTrackingURLs( $dbh, $session_setup['aspID'] ) ;
?>
<? include_once("$DOCUMENT_ROOT/setup/header.php") ; ?>
<script language="JavaScript">
<!--
	function do_submit()
	{
		if ( ( document.form.name.value == "" ) || ( document.form.landing_url.value == "" )
			|| ( document.form.landing_url.value == "http://" ) )
			alert( "Please provide all the fields." ) ;
		else
			document.form.submit() ;
	}

	function verify_url()
	{
		if ( ( document.form.landing_url.value == "" ) || ( document.form.landing_url.value == "http://" ) )
			alert( "Please provide a valid URL." ) ;
		else
		{
			newwin = window.open( document.form.landing_url.value, "verify" ) ;
			newwin.focus() ;
		}
	}

	function denied()
	{
		alert( "Please select the color from the left." ) ;
		document.form.name.focus() ;
	}

	function switch_color( color )
	{
		document.form.color.value = color ;
	}

	function do_delete( trackid )
	{
		if ( confirm( "Really delete this tracking URL?" ) )
		{
			location.href = "click_track.php?action=delete&trackid="+trackid ;
		}
	}
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td width="100%" valign="top"> 
	<p><span class="title">Marketing: Click Track'it</span><br>
	  Create click tracking URLs to track all your ad campaigns and PPC (Pay Per Click) listings (Overture, Google, FindWhat, etc).  PHP <i>Live!</i> will report and track the click-throughs and will alert you in the traffic monitor.</p>

		<form method="POST" action="click_track.php" name="form">
		<input type="hidden" name="action" value="create">
		<input type="hidden" name="trackid" value="<?= isset( $url_edit['trackID'] ) ? $url_edit['trackID'] : "" ?>">
		<table cellspacing=0 cellpadding=2 border=0>
		<tr>
			<td><img src="../../images/counters/1s_on.gif" width="25" height="25" border=0 alt=""></td>
			<td><span class="basetxt">
				Campaign Name (example: "Overture Listing")<br>
				<input type="text" name="name" size="<? echo $text_width ?>" maxlength="50" class="input" value="<?= isset( $url_edit['name'] ) ? $url_edit['name'] : "" ?>">
			</td>
		</tr>
		<tr>
			<td><img src="../../images/counters/2s_on.gif" width="25" height="25" border=0 alt=""></td>
			<td><span class="basetxt">
				Click Destination URL<br>
				(visitor landing page after clicking the tracking URL)<br>
				<input type="text" name="landing_url" size="<? echo $text_width ?>" maxlength="200" class="input" value="<?= ( isset( $url_edit['landing_url'] ) ) ? $url_edit['landing_url'] : "http://" ?>"></span> <span class="smalltxt">[ <a href="JavaScript:verify_url()">verify URL</a> ]</span>
			</td>
		</tr>
		<tr>
			<td><img src="../../images/counters/3s_on.gif" width="25" height="25" border=0 alt=""></td>
			<td><span class="basetxt">
				Select Indication Color (indicator color on the visitor traffic monitor)<br>
				<table cellspacing=2 cellpadding=0 border=0>
				<tr>
					<td>
						<table cellspacing=2 cellpadding=0 border=0>
						<tr>
							<td bgColor="#DDFFEE"><a href="JavaScript:switch_color('#DDFFEE')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
							<td bgColor="#FFE6E6"><a href="JavaScript:switch_color('#FFE6E6')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
							<td bgColor="#EAEAF4"><a href="JavaScript:switch_color('#EAEAF4')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
							<td bgColor="#FFEEDD"><a href="JavaScript:switch_color('#FFEEDD')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
							<td bgColor="#FFC1FF"><a href="JavaScript:switch_color('#FFC1FF')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
							<td bgColor="#FFFFCE"><a href="JavaScript:switch_color('#FFFFCE')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
							<td bgColor="#D9FFFF"><a href="JavaScript:switch_color('#D9FFFF')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
							<td bgColor="#C4C4FF"><a href="JavaScript:switch_color('#C4C4FF')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
							<td bgColor="#FFD8B0"><a href="JavaScript:switch_color('#FFD8B0')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
							<td bgColor="#BFDFDF"><a href="JavaScript:switch_color('#BFDFDF')"><img src="<? echo $BASE_URL ?>/images/spacer.gif" width="15" height="15" border=1></a></td>
						</tr>
						</table>
					</td>
					<td><font size=2><input type="text" name="color" size="7" maxlength="7" class="input" OnFocus="denied()" value="<?= isset( $url_edit['color'] ) ? $url_edit['color'] : "" ?>"></td>
				</tr>
				</table>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td><input type="button" OnClick="do_submit()" class="mainButton" value="<?= isset( $url_edit['trackID'] ) ? "Update Tracking URL" : "Create Tracking URL" ?>"></td>
		</tr>
		</table>
		</form>
	
	</td>
  <td height="350" align="center" style="background-image: url(../../images/g_marketing_big.jpg);background-repeat: no-repeat;"><img src="../../images/spacer.gif" width="229" height="1"></td>
</tr>
<tr>
	<form>
	<td colspan=2>
		<table cellspacing=1 cellpadding=2 border=0 width="100%">
		<?
			$m = date( "m",mktime() ) ;
			$y = date( "Y",mktime() ) ;
			$d = date( "j",mktime() ) ;
			// the timespan to get the stats
			$stat_begin = mktime( 0,0,1,$m,$d,$y ) ;
			$stat_end = mktime( 23,59,59,$m,$d,$y ) ;

			for ( $c = 0; $c < count( $urls ); ++$c )
			{
				$url = $urls[$c] ;
				$total_clicks = ServiceClicks_get_TotalTrackingClicks( $dbh, $session_setup['aspID'], $url['trackID'] ) ;
				if ( !$total_clicks ) { $total_clicks = 0 ; }

				$class = "altcolor1" ;
				$day_clicks_array = ServiceClicks_get_TotalTrackingClicksDay( $dbh, $session_setup['aspID'], $url['trackID'], $stat_begin, $stat_end ) ;
				
				if ( isset( $day_clicks_array[0] ) )
					$day_clicks = $day_clicks_array[0] ;
				else
					$day_clicks['clicks'] = 0 ;

				print "
					<tr class=\"$class\">
						<th align=left>Name</th>
						<th align=left>Landing URL</td>
						<th>Clicks Today</th>
						<th>Clicks Total</th>
						<th align=left width=\"10\">&nbsp;</td>
						<th align=left width=\"10\">&nbsp;</td>
					</tr>
					<tr class=\"$class\">
						<td bgColor=\"$url[color]\">$url[name] &nbsp;&nbsp; </td>
						<td><a href=\"$url[landing_url]\" target=\"new\" name=\"track_$url[trackID]\">$url[landing_url]</a></td>
						<td align=center>$day_clicks[clicks]</td>
						<td align=center><a href=\"click_track_view.php?trackid=$url[trackID]\">$total_clicks <img src=\"../../images/graph_icon.gif\" width=\"15\" height=\"15\" border=0 alt=\"View Stats\"></a></td>
						<td><a href=\"click_track.php?trackid=$url[trackID]\">Edit</a></td>
						<td><a href=\"JavaScript:do_delete( $url[trackID] )\">Delete</a></td>
					</tr>
					<tr class=\"$class\">
						<td colspan=6>
							<li> Copy/Paste and use the below URL for your ad campaigns to track your click-through.<br>
							Tracking URL: <input type=text size=$text_width_long maxlength=260 class=\"input\" value=\"$BASE_URL/c.php?k=$session_setup[aspID].$url[trackID].$url[unique_key]\">
						</td>
					</tr>
					<tr class=\"$class\"> 
						<td height=\"5\" class=\"hdash2\" colspan=6><img src=\"../images/spacer.gif\" width=\"1\" height=\"5\"></td>
					</tr>
				" ;
			}
		?>
		</table>
	</td>
	</form>
</tr>
</table>

<? include_once( "$DOCUMENT_ROOT/setup/footer.php" ) ; ?>