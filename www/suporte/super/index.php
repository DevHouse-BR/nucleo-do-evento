<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: ../setup/index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php") ;
	include_once("../system.php") ;
	include_once("../lang_packs/$LANG_PACK.php") ;
	include_once("../web/VERSION_KEEP.php" ) ;
	include_once("../API/sql.php" ) ;
	include_once("../API/Form.php") ;
	include_once("../API/ASP/get.php") ;
?>
<?

	// initialize
	$success = 0 ;
?>
<?
	// functions
?>
<?
	// conditions
?>
<? include_once( "./header.php" ) ; ?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<span class="title">Congratulations!  System is successfully setup!</span><p>
This is the super admin area.  You can update your company information and customize your company logo here.
<p>
[ <a href="profile.php">Your Site Profile</a> ]
[ <a href="customize.php">Customize Logo</a> ]
[ <a href="dbinfo.php">Database Info</a> ]

<?
	if ( file_exists( "asp.php" ) && $ASP_KEY )
		print "		<big><b>[ <a href=\"asp.php\">ASP Service Suite</a> ]</b></big>" ;
?>
<p>
<font color="#FF0000"><b>PASSWORD PROTECT THIS (super/) DIRECTORY!</b></font>  For documentation and help please consult the http://www.phplivesupport.com/documentation/viewarticle.php?aid=33  PHP Live! User Manual.
<br>
<hr>
<big><b>Site setup area:</b></big>
<p>
To customize your site online/offline icons, manage departments and users, view logs, and other setup tasks, please go to the below setup area and login with your site login and password (from above profile).
<p>
<big><b><a href="<? echo $BASE_URL ?>/setup/index.php"><? echo $BASE_URL ?>/setup/</a></b></big>
<hr>

<? include_once( "./footer.php" ) ; ?>