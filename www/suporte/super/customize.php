<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	include_once("../web/conf-init.php");
	include_once("../API/sql.php") ;
	include_once("../system.php") ;
	include_once("../lang_packs/$LANG_PACK.php") ;
	include_once("../web/VERSION_KEEP.php" ) ;
?>
<?

	// initialize
	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "12" ;
	else
		$text_width = "9" ;

	// get variables
	$action = $error_mesg = "" ;
	$success = 0 ;
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['success'] ) ) { $success = $HTTP_GET_VARS['success'] ; }
?>
<?
	// functions
?>
<?
	// conditions
	if ( $action == "upload_logo" )
	{
		$now = time() ;
		$pic_name = $HTTP_POST_FILES['pic']['name'] ;
		$filename = eregi_replace( " ", "_", $pic_name ) ;
		$filename = eregi_replace( "%20", "_", $filename ) ;

		$filesize = $HTTP_POST_FILES['pic']['size'] ;
		$filetype = $HTTP_POST_FILES['pic']['type'] ;

		if ( eregi( "gif", $filetype ) )
			$extension = "GIF" ;
		elseif ( eregi( "jpeg", $filetype ) )
			$extension = "JPEG" ;

		$filename = $HTTP_POST_VARS['logo_name']."_$now.$extension" ;
		if ( eregi( "gif", $filetype ) ||  eregi( "jpeg", $filetype ) )
		{
			if( copy( $HTTP_POST_FILES['pic']['tmp_name'], "../web/$filename" ) )
			{
				if ( $HTTP_POST_VARS['logo_name'] == "LOGO" )
				{
					if ( file_exists ( "../web/$LOGO_ASP" ) && $LOGO_ASP )
						unlink( "../web/$LOGO_ASP" ) ;
					$LOGO = $filename ;
				}

				$SITE_NAME = addslashes( $SITE_NAME ) ;

				if ( !isset( $ASP_KEY ) ) { $ASP_KEY = "" ; }
				$conf_string = "0LEFT_ARROW0?
					\$ASP_KEY = '$ASP_KEY' ;
					\$NO_PCONNECT = '$NO_PCONNECT' ;
					\$DATABASETYPE = '$DATABASETYPE' ;
					\$DATABASE = '$DATABASE' ;
					\$SQLHOST = '$SQLHOST' ;
					\$SQLLOGIN = '$SQLLOGIN' ;
					\$SQLPASS = '$SQLPASS' ;
					\$DOCUMENT_ROOT = '$DOCUMENT_ROOT' ;
					\$BASE_URL = '$BASE_URL' ;
					\$SITE_NAME = '$SITE_NAME' ;
					\$LOGO_ASP = '$LOGO' ;
					\$LANG_PACK = '$LANG_PACK' ;?0RIGHT_ARROW0" ;
				$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
				$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
				$fp = fopen ("../web/conf-init.php", "wb+") ;
				fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
				fclose( $fp ) ;
			}
			unlink( $HTTP_POST_FILES['pic']['tmp_name'] ) ;

			HEADER( "location: customize.php?success=1" ) ;
			exit ;
		}
		else if ( $pic_name != "" )
			$error_mesg = "Please upload ONLY GIF or JPEG formats.<br>" ;
	}

	if ( file_exists( "../web/$LOGO_ASP" ) && $LOGO_ASP )
		$logo = "../web/$LOGO_ASP" ;
	else
		$logo = "../images/logo.gif" ;
?>
<? include_once( "./header.php" ) ; ?>
<script language="JavaScript">
<!--
	function do_upload(the_form)
	{
		if ( the_form.pic.value == "" )
			alert( "Input cannot be blank." ) ;
		else
			the_form.submit() ;
	}
//-->
</script>

<span class="title">Company Logo</span> - <a href="index.php">back to menu</a><p>

Below is suggested MAX image size.<br>
<big><b>(max width: 250px - max height: 53px).</b></big><p>

Current Company Logo:<br>
<img src="<? echo $logo ?>"><p>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<font color="#FF0000"><? echo $error_mesg ?></font><br>
Update your logo below.  Please make sure the file is ONLY GIF or JPEG file format.
<form method="POST" action="customize.php" enctype="multipart/form-data" name="logo">
<input type="hidden" name="action" value="upload_logo">
<input type="hidden" name="logo_name" value="LOGO">
Company Logo <input type="file" name="pic" size="20">
<p>
<input type="button" class="mainButton" value="Update Company Logo" OnClick="do_upload(document.logo)">
</form>

<? include_once( "./footer.php" ) ; ?>