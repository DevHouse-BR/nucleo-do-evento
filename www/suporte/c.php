<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	include_once("./web/conf-init.php") ;	
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Clicks/get.php") ;
	include_once("$DOCUMENT_ROOT/API/Clicks/put.php") ;
	include_once("$DOCUMENT_ROOT/API/Refer/put.php") ;

	$k = "" ;
	if ( isset( $HTTP_GET_VARS['k'] ) ) { $k = $HTTP_GET_VARS['k'] ; }

	LIST( $aspid, $trackid, $key ) = explode( ".", $k ) ;
	$trackinfo = ServiceClicks_get_TrackingURLInfo( $dbh, $aspid, $trackid, $key ) ;
	$userinfo = AdminASP_get_UserInfo( $dbh, $aspid ) ;

	if ( isset( $trackinfo['landing_url'] ) )
	{
		// track refer
		$refer = "&nbsp;" ;
		if ( isset( $HTTP_SERVER_VARS['HTTP_REFERER'] ) )
			$refer = $HTTP_SERVER_VARS['HTTP_REFERER'] ;
		ServiceRefer_put_Refer( $dbh, $aspid, $HTTP_SERVER_VARS['REMOTE_ADDR'], $refer, $trackid ) ;
		ServiceClicks_put_Click( $dbh, $aspid, $trackid ) ;
		HEADER( "location: $trackinfo[landing_url]" ) ;
		exit ;
	}
	else
	{
		print "<font size=5><b>Error: Destination URL not found.</b></font><p>Please contact <a href=\"mailto:$userinfo[contact_email]?subject=Tracking URL\">$userinfo[contact_email]</a> to report this error." ;
	}
?>