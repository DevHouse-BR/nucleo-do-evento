<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	error_reporting(0) ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: ./index.php" ) ; exit ; }
	if ( !file_exists( "../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: ./options.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("$DOCUMENT_ROOT/web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php" ) ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
	{
		$text_width = "70" ;
		$text_width_long = "85" ;
	}
	else
	{
		$text_width = "15" ;
		$text_width_long = "45" ;
	}

	$section = 7;			// Section number - see header.php for list of section numbers
	$page_title = "PHP Live! - Administration" ;
	$nav_line = '<a href="./options.php" class="nav">:: Home</a>' ;
	$css_path = "../" ;
?>
<?

	// initialize
	$action = $regkey = $error = "" ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_POST_VARS['regkey'] ) ) { $regkey = $HTTP_POST_VARS['regkey'] ; }
	if ( isset( $HTTP_GET_VARS['regkey'] ) ) { $regkey = $HTTP_GET_VARS['regkey'] ; }

	if ( file_exists( "$DOCUMENT_ROOT/web/$session_setup[login]/salespath_api.php" ) && file_exists( "$DOCUMENT_ROOT/web/$session_setup[login]/salespath.php" ) )
	{
		HEADER( "location: $BASE_URL/web/$session_setup[login]/salespath.php" ) ;
		exit ;
	}
?>
<?
	// functions
?>
<?
	// conditions

	if ( $action == "activate" )
	{
		// check key file
		$key_url = "http://www.salespath.net/key_check.php?action=verify&key=$regkey&login=$session_setup[login]&" ;
		$fh = fopen( $key_url, "r" )  or ( $error = "Unable to verify your Registration Key.  Please reload this page again.</b>" );
		$response = fgets( $fh, 255 ) ;
		fclose( $fh ) ;

		if ( !$error )
		{
			LIST( $response_key, $response_login ) = explode( "::", $response) ;
			
			if ( ( $response_key == $regkey ) && $regkey && $response && ( $response_login == $session_setup['login'] ) )
			{
				$key_string = "0LEFT_ARROW0? \$REG_KEY = \"$regkey\" ; ?0RIGHT_ARROW0" ;
				$key_string = preg_replace( "/0LEFT_ARROW0/", "<", $key_string ) ;
				$key_string = preg_replace( "/0RIGHT_ARROW0/", ">", $key_string ) ;
				$fp = fopen ("$DOCUMENT_ROOT/web/$session_setup[login]/REG_KEY.php", "wb+") ;
				fwrite( $fp, $key_string, strlen( $key_string ) ) ;
				fclose( $fp ) ;

				// setup Sales Path files
				$sp_string = "" ;
				$key_url = "http://www.salespath.net/key_check.php?action=setup&key=$regkey&login=$session_setup[login]&file=sp" ;
				$fh = fopen( $key_url, "r" ) ;
				while ( !feof( $fh ) )
				{
					$sp_string .= fgets( $fh, 4096 ) ;
				}
				fclose( $fh ) ;

				$fp = fopen ("$DOCUMENT_ROOT/web/$session_setup[login]/salespath.php", "wb+") ;
				fwrite( $fp, $sp_string, strlen( $sp_string ) ) ;
				fclose( $fp ) ;

				$sp_string = "" ;
				$key_url = "http://www.salespath.net/key_check.php?action=setup&key=$regkey&login=$session_setup[login]&file=sp_engine" ;
				$fh = fopen( $key_url, "r" ) ;
				while ( !feof( $fh ) )
				{
					$sp_string .= fgets( $fh, 4096 ) ;
				}
				fclose( $fh ) ;

				$fp = fopen ("$DOCUMENT_ROOT/web/$session_setup[login]/salespath_engine.php", "wb+") ;
				fwrite( $fp, $sp_string, strlen( $sp_string ) ) ;
				fclose( $fp ) ;

				$sp_string = "" ;
				$key_url = "http://www.salespath.net/key_check.php?action=setup&key=$regkey&login=$session_setup[login]&file=sp_api" ;
				$fh = fopen( $key_url, "r" ) ;
				while ( !feof( $fh ) )
				{
					$sp_string .= fgets( $fh, 4096 ) ;
				}
				fclose( $fh ) ;

				$fp = fopen ("$DOCUMENT_ROOT/web/$session_setup[login]/salespath_api.php", "wb+") ;
				fwrite( $fp, $sp_string, strlen( $sp_string ) ) ;
				fclose( $fp ) ;

				HEADER( "location: $BASE_URL/web/$session_setup[login]/salespath.php?success=1" ) ;
				exit ;
			}
			else
			{
				$error = "Registration Key is invalid.  Please try again.  If the problem persists, email 
sp-reg-error-osicodes.com
." ;
				$action = "" ;
			}
		}
	}
?>
<? include_once("$DOCUMENT_ROOT/setup/header.php") ; ?>
<script language="JavaScript">
<!--
	function do_activate()
	{
		if ( regkey = prompt( "Input your Registration Key below", "" ) )
		{
			document.form.regkey.value = regkey ;
			document.form.submit() ;
		}
	}
//-->
</script>

<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td width="100%" valign="top"> 
	<p><span class="title">Marketing: Visitor Sales Path</span><br>
	  Understand your most important visitors (people who PURCHASED your product/service).  Sales Path will report the footprints, refer URL, and other important data of every customer that completed your purchase process.</p>

		<? if ( !file_exists( "$DOCUMENT_ROOT/web/".$session_setup['login']."/salespath_api.php" ) || !file_exists( "$DOCUMENT_ROOT/web/".$session_setup['login']."/salespath.php" ) ): ?>
		<table cellspacing=0 cellpadding=10 border=1 bordercolor="#346BAE" bgColor="#C4D8ED">
		<form name="form" action="salespath.php" method="POST">
		<input type="hidden" name="action" value="activate">
		<input type="hidden" name="regkey" value="">
		<tr>
			<td>

			<? if ( $action == "activate" ): ?>
			Account is activated!


			<? else: ?>
			<font color="#FF0000"><b><? echo $error ?></b></font><p>
			<?
			// suppress error just incase it cannot locate or find
			error_reporting( 0 ) ;
			if ( $fp = fopen ("http://www.salespath.net/data/register.php", "r") ):
				$output = "" ;
				while( $response = fgets( $fp, 255 ) )
				{
					$output .= $response ;
				}
				fclose( $fp ) ;
				
				print $output ;
				?>

			<? else: ?>
				This is an extra add-on (optional) feature that requires registration.
				<p>
				<big><b><a href="http://www.salespath.net" target="new">Sign Up Today</a></b></big> to begin using this powerful marketing and conversion tracking tool! 
				<p>
				This feature will be fully downloadable as an extra Add-on. Track multiple conversions of all your traffic and see which ads/PPC/websites are converting and producing results!
				<p>
				<font color="#FF0000">Provide the below Key during registration (exactly as it is displayed).</font><br>
			<? endif ; ?>

			Key: <input type="text" name="key" value="<? echo $BASE_URL ?>::<? echo $session_setup['aspID'] ?>::<? echo $session_setup['login'] ?>" size="<? echo $text_width ?>">

			<p>
			After you register, click here to <input type="button" value="Activate Sales Path" OnClick="do_activate()">

			<? endif ; ?>

			</td>
		</tr>
		</form>
		</table>

		<? else: ?>
		<script language="JavaScript">
		<!--
			location.href = "<? echo $BASE_URL ?>/web/<? echo $session_setup['login'] ?>/salespath.php" ;
		//-->
		</script>

		<? endif ; ?>
	
	</td>
  <td height="350" align="center" style="background-image: url(../images/g_marketing_big.jpg);background-repeat: no-repeat;" valign="top"><img src="../images/spacer.gif" width="229" height="1"><br><img src="../images/spacer.gif" width="1" height="220"><br></td>
</tr>
</table>

<? include_once( "$DOCUMENT_ROOT/setup/footer.php" ) ; ?>