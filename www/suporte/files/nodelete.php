<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	* DO NOT DELETE THIS FILE or you may get errors
	*******************************************************/
	session_start() ;
	include_once("../../web/conf-init.php");
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
	include_once("$DOCUMENT_ROOT/API/ASP/get.php") ;
	
	$l = "" ;
	if ( isset( $HTTP_GET_VARS['l'] ) ) { $l = $HTTP_GET_VARS['l'] ; }

	$userinfo = AdminASP_get_ASPInfoByASPLogin( $dbh, $l ) ;
	if ( isset( $userinfo['aspID'] ) )
		print $userinfo['aspID'] ;
	else
		print "0" ;
?>