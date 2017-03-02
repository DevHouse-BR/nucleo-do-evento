<?
	// this page is designed to see if the configuration files exist and if
	// mysql database is not corrupt
	//
	// copyright OSI Codes Inc. (http://www.osicodes.com) PHP Live! Support
	// script author: Seth@thesite.com
	//
	if ( file_exists( "../web/conf-init.php" ) )
	{
		include_once("../web/conf-init.php") ;
		include_once("../system.php") ;
		include_once("../web/VERSION_KEEP.php") ;
		include_once("../API/sql.php") ;
	}
	else
	{
		print "<font color=\"#FF0000\"><b>config file (conf-init.php) not found</b></font><br>" ;
	}
?>
<h2>PHP Live! Config Settings Check</h2>
Checking if session dir (<font color="#B87F23"><? echo session_save_path() ?></font>) is writeable
<? if ( is_writable( session_save_path() ) ): ?>
<font color="#0000FF"><b>Passed!</b></font>
<? else: ?>
<font color="#FF0000"><b>Failed - Please allow full read/write permission on dir <? echo session_save_path() ?></b></font>
<? endif ; ?>
<br>
<br>
Document Root: <font color="#B87F23"><? echo $DOCUMENT_ROOT ?></font><br>
Base URL: <font color="#B87F23"><? echo $BASE_URL ?></font><br>
<hr>
<h2>PHP Info</h2>
<? print phpinfo() ; ?>