<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	* Only calls once when a page loads.  The image_tracker.php is the script
	* that loads periodically to update visitor's status.
	*******************************************************/
	if ( !file_exists( "./web/".$HTTP_GET_VARS['l']."/".$HTTP_GET_VARS['l']."-conf-init.php" ) || !file_exists( "./web/conf-init.php" ) )
	{
		if ( preg_match( "//", $HTTP_SERVER_VARS['SERVER_NAME'] ) )
		{
						HEADER( "location: index.php" ) ;
		}
		else
			print "<font color=\"#FF0000\">Config error: reason: $HTTP_GET_VARS[l] config not found!  Exiting... [image.php]</font>" ;
		exit ;
	}
	include_once("./web/conf-init.php") ;
	include_once("$DOCUMENT_ROOT/web/".$HTTP_GET_VARS['l']."/".$HTTP_GET_VARS['l']."-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/Util_CleanFiles.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Users/update.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint/put.php") ;
	include_once("$DOCUMENT_ROOT/API/Refer/put.php") ;
	include_once("$DOCUMENT_ROOT/API/Footprint_unique/remove.php") ;
	include_once("$DOCUMENT_ROOT/API/Spam/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Spam/remove.php") ;

	if ( $SUPPORT_LOGO_OFFLINE )
		$status_image = $SUPPORT_LOGO_OFFLINE ;
	else
		$status_image = "phplive_support_offline.gif" ;

	if ( isset( $HTTP_GET_VARS['deptid'] ) ) { $deptid = $HTTP_GET_VARS['deptid'] ; } else { $deptid = "" ; }
	if ( isset( $HTTP_GET_VARS['page'] ) ) { $page = urldecode( $HTTP_GET_VARS['page'] ) ; } else { $page = "" ; }
	if ( isset( $HTTP_GET_VARS['text'] ) ) { $text = $HTTP_GET_VARS['text'] ; } else { $text = "" ; }

	ServiceSpam_remove_CleanOldIPs( $dbh ) ;
	CleanFiles_util_CleanSurveySessionFiles() ;
	ServiceFootprintUnique_remove_IdleFootprints( $dbh, $HTTP_GET_VARS['x'] ) ;
	// update all admins status to not available if they have been idle
	AdminUsers_update_IdleAdminStatus( $dbh, $admin_idle ) ;
	$deptinfo = AdminUsers_get_DeptInfo( $dbh, $deptid, $HTTP_GET_VARS['x'] ) ;
	if ( $deptinfo['status_image_offline'] && file_exists( "$DOCUMENT_ROOT/web/".$HTTP_GET_VARS['l']."/$deptinfo[status_image_offline]" ) )
		$status_image = $deptinfo['status_image_offline'] ;

	$blocked = 0 ;
	$ips = ServiceSpam_get_IPs( $dbh, $HTTP_GET_VARS['x'] ) ;
	for ( $c = 0; $c < count( $ips ); ++$c )
	{
		$ip = $ips[$c] ;
		if ( $ip['ip'] == $HTTP_SERVER_VARS['REMOTE_ADDR'] )
		{
			if ( $SUPPORT_LOGO_OFFLINE )
				$status_image = $SUPPORT_LOGO_OFFLINE ;
			else if ( isset( $deptinfo['status_image_offline'] ) )
				$status_image = $deptinfo['status_image_offline'] ;
			else
				$status_image = "phplive_support_offline.gif" ;
			$blocked = 1 ;
			break ;
		}
	}

	if ( !$blocked )
	{
		if ( AdminUsers_get_AreAnyAdminOnline( $dbh, $deptid, $admin_idle, $HTTP_GET_VARS['x'] ) )
		{
			if ( $SUPPORT_LOGO_ONLINE )
				$status_image = $SUPPORT_LOGO_ONLINE ;
			else
				$status_image = "phplive_support_online.gif" ;

			if ( $deptinfo['status_image_online'] && file_exists( "$DOCUMENT_ROOT/web/".$HTTP_GET_VARS['l']."/$deptinfo[status_image_online]" ) )
				$status_image = $deptinfo['status_image_online'] ;
		}
		/*else if ( AdminUsers_get_AreAnyAdminConsolesOnline( $dbh, $deptid, $admin_idle, $HTTP_GET_VARS['x'] ) )
		{
			if ( $SUPPORT_LOGO_AWAY )
				$status_image = $SUPPORT_LOGO_AWAY ;
			else
				$status_image = "phplive_support_away.gif" ;

			if ( $deptinfo['status_image_away'] && file_exists( "$DOCUMENT_ROOT/web/".$HTTP_GET_VARS['l']."/$deptinfo[status_image_away]" ) )
				$status_image = $deptinfo['status_image_away'] ;
		}*/

		// get ips that SHOULD NOT be tracked
		$ip_notrack_string = "" ;
		if ( isset( $IPNOTRACK ) )
			$ip_notrack_string = $IPNOTRACK ;

		// do the tracking, if needed
		if ( $VISITOR_FOOTPRINT && !preg_match( "/(phplive_notally)/", $page ) && !preg_match( "/$HTTP_SERVER_VARS[REMOTE_ADDR]/", $ip_notrack_string ) )
			ServiceFootprint_put_Footprint( $dbh, $HTTP_SERVER_VARS['REMOTE_ADDR'], $page, $HTTP_GET_VARS['x'] ) ;
		
		// track refer
		$refer = "" ;
		if ( isset( $HTTP_GET_VARS['refer'] ) )
			$refer = urldecode( $HTTP_GET_VARS['refer'] ) ;
		ServiceRefer_put_Refer( $dbh, $HTTP_GET_VARS['x'], $HTTP_SERVER_VARS['REMOTE_ADDR'], $refer, 0 ) ;
	}

	if ( file_exists( "$DOCUMENT_ROOT/web/".$HTTP_GET_VARS['l']."/$status_image" ) && $status_image )
		$image_path = "$DOCUMENT_ROOT/web/".$HTTP_GET_VARS['l']."/$status_image" ;
	else
		$image_path = "$DOCUMENT_ROOT/images/$status_image" ;

	// override image setting if "text" variable is present... spit out
	// 1x1 pixle
	if ( $text )
		$image_path = "$DOCUMENT_ROOT/images/counters/1.gif" ;

	$from_page = "" ;
	if ( isset( $HTTP_SERVER_VARS['HTTP_REFERER'] ) ) {  $from_page = $HTTP_SERVER_VARS['HTTP_REFERER'] ; }
	if ( !$from_page )
		$from_page = $page;
	preg_match( "/^(http:\/\/)?([^\/]+)/i", $from_page, $matches ) ;
	// check to see if domain is internal (such as localhost). if it is, skip the
	// second layer of domain name check (taking out www. from www.domain.com)
	$domain = "" ;
	if ( isset( $matches[2] ) )
	{
		$domain = $matches[2] ;
		if ( preg_match( "/\./", $domain ) && $domain )
		{
			preg_match( "/[^\.\/]+\.[^\.\/]+$/", $domain, $matches ) ;
			$domain = $matches[0] ;
		}
	}

	mysql_close( $dbh['con'] ) ;
	Header( "Content-type: image/gif" ) ;
	readfile( $image_path ) ;
?>