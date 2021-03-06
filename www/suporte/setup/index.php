<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	error_reporting(0);
	//include_once("../API/Util_Error.php") ;
?>
<?
	// initialize
	if ( preg_match( "/unix/i", $HTTP_SERVER_VARS['SERVER_SOFTWARE'] ) )
		$server = "unix" ;
	else
		$server = "windows" ;
	
	$PHPLIVE_VERSION = "2.8" ;
	$success = 0 ;
	$error = "" ;

	// put php version check module here
	// check_version() ;

	// if system if configured, then let's go to the menu options
	if ( file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: login.php" ) ;
		exit ;
	}

	// open the language pack if passed
	if ( isset( $HTTP_POST_VARS['language'] ) && $HTTP_POST_VARS['language'] )
		include_once( "../lang_packs/$HTTP_POST_VARS[language].php" ) ;

	// do initial checks to make sure setup can run
	if ( !is_dir( session_save_path() ) )
	{
		print "<font color=\"#FF0000\">'session.save_path' directory not set!  Please set your session.save_path in your php.ini file.  It is usally set to /tmp for UNIX, C:\Temp for windows. After you have done this, reload this page.</font>" ;
		exit ;
	}
	if ( file_exists( "../web" ) )
	{
		if ( !is_writable( "../web" ) )
		{
			print "<font color=\"#FF0000\">Please give '<i>web</i>' directory READ/WRITE permission by the browser. (<code>chmod o+rw web</code>).  The '<i>web</i>' directory is located in your root PHP Live! install location.  After you have done this, reload this page.</,font>" ;
			exit ;
		}
		else
		{
			if ( is_dir( "../web/chatsessions" ) != true )
				mkdir( "../web/chatsessions", 0777 ) ;
			if ( is_dir( "../web/chatrequests" ) != true )
				mkdir( "../web/chatrequests", 0777 ) ;
			if ( is_dir( "../web/chatpolling" ) != true )
				mkdir( "../web/chatpolling", 0777 ) ;
		}
	}
	else
	{
		print "<font color=\"#FF0000\">Please create a '<i>web</i>' directory in your root PHP Live! install location.  Make it READ/WRITE permission by the browser. (<code>chmod o+rw web</code>).  After you have done this, reload this page.</font>" ;
		exit ;
	}

	srand((double)microtime());
	$rand = mt_rand(0,1000) ;
?>
<?
	// functions
	function checkVersion( $version )
	{
		if ( phpversion() >= $version )
			return true ;
		return false ;
	}

	function dump_db( $db_name, $db_host, $db_login, $db_password )
	{
		$connection = mysql_pconnect( $db_host, $db_login, $db_password ) ;
		if ( !mysql_select_db( $db_name ) )
			return "<p>Error: Could not locate database[ $db_name ]<p>" ;

		$fp = fopen ("../super/phplive.txt", "r") ;
		while (!feof ($fp))
		{
			unset ( $query ) ;
			unset ( $error ) ;
			$buffer = fgets($fp, 1000);

			if ( preg_match( "/(DROP TABLE)/", $buffer ) )
			{
				$query = substr( $buffer, 0, strlen( $buffer ) - 2 ) ;
				$query = stripslashes( $query ) ;
				$result = mysql_query( $query, $connection ) ;
				$mysql_error .=  mysql_error() ;
			}
			
			if ( preg_match( "/(CREATE TABLE)/", $buffer ) )
			{
				$query .= $buffer ;
				if ( !preg_match( "/\) TYPE=MyISAM/", $buffer ) )
				{
					while ( $buffer = fgets( $fp, 500 ) )
					{
						if ( preg_match( "/\) TYPE=MyISAM/", $buffer ) ){ break 1 ; }
						$query .= $buffer ;
					}
					if ( !preg_match( "/\) TYPE=MyISAM/", $query ) )
						$query = "$query);" ;
				}
				$query = stripslashes( $query ) ;
				$result = mysql_query( $query, $connection ) ;
				$mysql_error .=  mysql_error() ;
			}

			if ( preg_match( "/(INSERT INTO)/", $buffer ) )
			{
				$query = substr( $buffer, 0, strlen( $buffer ) - 2 ) ;
				$query = stripslashes( $query ) ;
				$result = mysql_query( $query, $connection ) ;
				$mysql_error .=  mysql_error() ;
			}
		}
		fclose( $fp ) ;
		mysql_close( $connection ) ;

		if ( $mysql_error )
			$error = "<p>Error: Following database error(s) were generated: <br>$mysql_error<p>http://www.phplivesupport.com/documentation/viewarticle.php?aid=35 Verifying your MySQL Information Help<p>" ;

		return $error ;
	}
?>
<?
	// initialize and get vars
	$action = $override = "" ;
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_POST_VARS['override'] ) ) { $override = $HTTP_POST_VARS['override'] ; }

	// conditions
	
	if ( $action == "update db" )
	{
		$db_host = $HTTP_POST_VARS['db_host'] ;
		$db_login = $HTTP_POST_VARS['db_login'] ;
		$db_password = $HTTP_POST_VARS['db_password'] ;
		$db_name = $HTTP_POST_VARS['db_name'] ;

		$connection = mysql_connect( $db_host, $db_login, $db_password ) ;
		mysql_select_db( $db_name ) ;
		$sth = mysql_query( "SHOW TABLES", $connection ) ;
		$error = mysql_error() ;
		if ( $error )
		{
			$action = "update company" ;
			$error = "<p>Error: Database produced the following error(s).  Please correct and submit.<br>-- $error --<p>http://www.phplivesupport.com/documentation/viewarticle.php?aid=35  Verifying your MySQL Information Help Docs<p>" ;
		}
		else
		{
			$error = dump_db( $db_name, $db_host, $db_login, $db_password ) ;
			if ( !$error )
			{
				if ( !$error )
				{
					$document_root = stripslashes( $HTTP_POST_VARS['document_root'] ) ;
					$site_name = addslashes( $HTTP_POST_VARS['site_name'] ) ;
					$conf_string = "0LEFT_ARROW0?
						\$ASP_KEY = '' ;
						\$NO_PCONNECT = '$HTTP_POST_VARS[no_pconnect]' ;
						\$DATABASETYPE = '$HTTP_POST_VARS[db_type]' ;
						\$DATABASE = '$db_name' ;
						\$SQLHOST = '$db_host' ;
						\$SQLLOGIN = '$db_login' ;
						\$SQLPASS = '$db_password' ;
						\$DOCUMENT_ROOT = '$HTTP_POST_VARS[document_root]' ;
						\$BASE_URL = '$HTTP_POST_VARS[base_url]' ;
						\$SITE_NAME = '$site_name' ;
						\$LOGO_ASP = 'phplive_logo.gif' ;
						\$LANG_PACK = '$HTTP_POST_VARS[language]' ;?0RIGHT_ARROW0" ;

					// create and put configuration data
					$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
					$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
					$fp = fopen ("../web/conf-init.php", "wb+") ;
					fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
					fclose( $fp ) ;

					if ( ( is_dir( "../web/$HTTP_POST_VARS[login]" ) != true ) && isset( $HTTP_POST_VARS['login'] ) )
						mkdir( "../web/$HTTP_POST_VARS[login]", 0777 ) ;

					if ( file_exists( "../admin/traffic/admin_puller.php" ) )
						$initiate = 1 ;
					else
						$initiate = 0 ;
					$COMPANY_NAME = addslashes( $HTTP_POST_VARS['company'] ) ;
					$conf_string = "0LEFT_ARROW0?
						\$LOGO = '' ;
						\$COMPANY_NAME = '$COMPANY_NAME' ;
						\$SUPPORT_LOGO_ONLINE = 'phplive_support_online.gif' ;
						\$SUPPORT_LOGO_OFFLINE = 'phplive_support_offline.gif' ;
						\$SUPPORT_LOGO_AWAY = '' ;
						\$VISITOR_FOOTPRINT = '1' ;
						\$TEXT_COLOR = '#000000' ;
						\$FRAME_COLOR = '#000000' ;
						\$LINK_COLOR = '#555555' ;
						\$ALINK_COLOR = '#555555' ;
						\$VLINK_COLOR = '#555555' ;
						\$CLIENT_COLOR = '#888888' ;
						\$ADMIN_COLOR = '#0000FF' ;
						\$CHAT_REQUEST_BACKGROUND = '#FFFFFF' ;
						\$CHAT_BOX_BACKGROUND = '#FFFFFF' ;
						\$CHAT_BOX_TEXT = '#000000' ;
						\$POLL_TIME = '45' ;
						\$INITIATE = '$initiate' ;
						\$INITIATE_IMAGE = '' ;
						\$IPNOTRACK = '' ;
						\$LANG_PACK = '$HTTP_POST_VARS[language]'; ?0RIGHT_ARROW0" ;

					$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
					$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
					$fp = fopen ("../web/$HTTP_POST_VARS[login]/$HTTP_POST_VARS[login]-conf-init.php", "wb+") ;
					fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
					fclose( $fp ) ;

					// let's create an index file for the user so
					// the path is more nice...
					// (/phplive/<user>/ instead of /phplive/index.php?l=<user>)
					$index_string = "0LEFT_ARROW0? \$path = explode( \"/\", \$HTTP_SERVER_VARS['PHP_SELF'] ) ; \$total = count( \$path ) ; \$login = \$path[\$total-2] ; \$winapp = isset( \$HTTP_GET_VARS['winapp'] ) ? \$HTTP_GET_VARS['winapp'] : \"\" ; HEADER( \"location: ../../index.php?l=\$login&winapp=\$winapp\" ) ; exit ; ?0RIGHT_ARROW0" ;
					$index_string = preg_replace( "/0LEFT_ARROW0/", "<", $index_string ) ;
					$index_string = preg_replace( "/0RIGHT_ARROW0/", ">", $index_string ) ;
					$fp = fopen ("../web/$HTTP_POST_VARS[login]/index.php", "wb+") ;
					fwrite( $fp, $index_string, strlen( $index_string ) ) ;
					fclose( $fp ) ;

					// now let's create an index.php page in the web/ directory for
					// extra security
					$index_string = "&nbsp;" ;
					$fp = fopen ("../web/index.php", "wb+") ;
					fwrite( $fp, $index_string, strlen( $index_string ) ) ;
					fclose( $fp ) ;

					/*********** insert new data ***************/
					$now = time() ;
					$connection = mysql_connect( $db_host, $db_login, $db_password ) ;
					mysql_select_db( $db_name ) ;
					$trans_email = "Hello %%username%%,

Below is the complete transcript of your chat session:
===
%%transcript%%
===

Thank you

" ;
					$query = "INSERT INTO chat_asp VALUES (0, '$HTTP_POST_VARS[login]', '$HTTP_POST_VARS[password]', '$HTTP_POST_VARS[company]', '$HTTP_POST_VARS[contact_name]', '$HTTP_POST_VARS[contact_email]', '15', '100', '1', '$now', 0, 1, 1, 0, 0, '(optional) If you would like to receive a copy of this chat session transcript, please input your email address below and Submit.', '$trans_email')" ;
					mysql_query( $query, $connection ) ;
					/********************************************/

					// create and put version file
					$version_string = "0LEFT_ARROW0? \$PHPLIVE_VERSION = \"$PHPLIVE_VERSION\" ; ?0RIGHT_ARROW0" ;
					$version_string = preg_replace( "/0LEFT_ARROW0/", "<", $version_string ) ;
					$version_string = preg_replace( "/0RIGHT_ARROW0/", ">", $version_string ) ;
					$fp = fopen ("../web/VERSION_KEEP.php", "wb+") ;
					fwrite( $fp, $version_string, strlen( $version_string ) ) ;
					fclose( $fp ) ;

					$url = $HTTP_POST_VARS['base_url'] ;
					$os = $HTTP_SERVER_VARS['SERVER_SOFTWARE'] ;
					$os = urlencode( $os ) ;
					

					copy( "../files/nodelete.php", "../web/$HTTP_POST_VARS[login]/nodelete.php" ) ;

					HEADER( "location: ../super" ) ;
					exit ;
				}
			}
			else
			{
				$action = "update company" ;
				$error = "<p>Error: Database produced the following error(s).  Please correct and submit.<br>-- $error --<p>http://www.phplivesupport.com/documentation/viewarticle.php?aid=35  Verifying your MySQL Information Help Docs<p>" ;
			}
		}
	}
	else if ( $action == "update document root" )
	{
		$document_root = $HTTP_POST_VARS['document_root'] ;
		$str_len = strlen( $document_root ) ;
		$last = $document_root[$str_len-1] ;
		if ( ( $last == "/" ) || ( $last == "\\" ) )
			$document_root = substr( $document_root, 0, $str_len - 1 ) ;

		if ( !file_exists( "$document_root/super/phplive.txt" ) )
		{
			$action = "update site name" ;
			$temp_root = stripslashes( $document_root ) ;
			$error = "Error: $temp_root - This is NOT the correct unpacked path of PHP <i>Live!</i>.  Please correct and submit." ;
		}
	}
	else if ( $action == "update base url" )
	{
		$document_root = $HTTP_POST_VARS['document_root'] ;
		$base_url = $HTTP_POST_VARS['base_url'] ;
		$str_len = strlen( $base_url ) ;
		$last = $base_url[$str_len-1] ;
		if ( ( $last == "/" ) || ( $last == "\\" ) )
			$base_url = substr( $base_url, 0, $str_len - 1 ) ;

		if ( !fopen ("$base_url/super/phplive.txt", "r") )
		{
			$action = "update document root" ;
			$error = "Error: $base_url - This is NOT the correct URL of the unpacked PHP <i>Live!</i>.  Please correct and submit." ;
		}
	}
	else
	{
		if ( !checkVersion( "4.0.6" ) && !$override )
		{
			print "<font color=\"#FF0000\">Your current PHP version ".phpversion()." is not compatible with PHP <i>Live!</i> Support v".$PHPLIVE_VERSION.".  Please upgrade your PHP to 4.0.6 or greater.  We recommend you install the latest PHP version from <a href=\"http://www.php.net/downloads.php\" target=\"new\">PHP.net</a>.  Please contact your server admin to upgrade your current PHP build.</font>" ;
			exit ;
		}
	}
?>
<? include_once( "../super/header.php" ) ?>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<script language="JavaScript">
<!--

	var url = location.toString() ;
	url = replace( url, "setup/index.php", "" ) ;

	function do_db_update()
	{
		if ( ( document.form.db_name.value == "" ) || ( document.form.db_host.value == "" )
			|| ( document.form.db_login.value == "" ) || ( document.form.db_password.value == "" ) )
			alert( "All fields must be supplied." )
		else
			document.form.submit() ;
	}

	function do_user_update()
	{
		if ( ( document.form.company.value == "" ) || ( document.form.login.value == "" )
			|| ( document.form.password.value == "" ) || ( document.form.contact_name.value == "" )
			|| ( document.form.contact_email.value == "" ) )
			alert( "All fields MUST be filled." ) ;
		else if ( document.form.company.value.indexOf("'") != -1 )
			alert( "Company name cannot have a single quote (')." ) ;
		else
			document.form.submit() ;
	}
//-->
</script>

<font color="#FF0000"><? echo $error ?></font><br>
<form method="POST" action="index.php" name="form">


		<? if ( $action == "update document root" ): ?>
		<input type="hidden" name="action" value="update base url">
		<input type="hidden" name="language" value="<? echo $HTTP_POST_VARS['language'] ?>">
		<input type="hidden" name="site_name" value="<? echo $HTTP_POST_VARS['site_name'] ?>">
		<input type="hidden" name="document_root" value="<? echo stripslashes( $document_root ) ?>">
		<span class="title">Set your Base URL.</span>
		<br>
		<span class="basetxt">This is the complete URL path of the PHP <i>Live!</i> system.<p>

		Example:<br>
		<font color="#660000">http://phplive.mycompany.com<br>
		http://www.mycompany.com/phplive</font>
		<br>
		<table cellpadding=5 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Base URL</td><td><span class="basetxt"> <input type="text" name="base_url" size=30 maxlength=120></td><td> <input type="submit" class="mainButton" value="Submit" border=0></td>
		</tr>
		</table>
		<script language="JavaScript"> document.form.base_url.value = url ; </script>






		<? elseif ( $action == "update base url" ): ?>
		<input type="hidden" name="action" value="update company">
		<input type="hidden" name="language" value="<? echo $HTTP_POST_VARS['language'] ?>">
		<input type="hidden" name="site_name" value="<? echo $HTTP_POST_VARS['site_name'] ?>">
		<input type="hidden" name="document_root" value="<? echo stripslashes( $HTTP_POST_VARS['document_root'] ) ?>">
		<input type="hidden" name="base_url" value="<? echo stripslashes( $base_url ) ?>">
		<span class="title">Your Company Information.</span>
		<br>
		<br>
		Please provide your default company information.
		<br>
		<font color="#FF0000">(do not include single quote (') in your company name!)</font>
		<p>
		<table cellpadding=1 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Company</td>
			<td><span class="basetxt"><font size=2 face="arial"> <input type="text" name="company" size="<? echo $text_width ?>" maxlength="50"></td>
		</tr>
		<tr>
			<td><span class="basetxt">Choose Login</td>
			<td><font size=2 face="arial"> <input type="text" name="login" size="<? echo $text_width ?>" maxlength="15"></td>
			<td><span class="basetxt">Choose Password</td>
			<td><span class="basetxt"><font size=2 face="arial"> <input type="text" name="password" size="<? echo $text_width ?>" maxlength="15"></td>
		</tr>
		<tr>
			<td><span class="basetxt">Contact Name</td>
			<td><span class="basetxt"><font size=2 face="arial"> <input type="text" name="contact_name" size="<? echo $text_width ?>" maxlength="50"></td>
			<td><span class="basetxt">Contact Email</td>
			<td><span class="basetxt"><font size=2 face="arial"> <input type="text" name="contact_email" size="<? echo $text_width ?>" maxlength="150"></td>
		</tr>
		<tr>
			<td colspan=4>&nbsp;</td>
		</tr>
		<tr>
			<td></td>
			<td><input type="button" OnClick="do_user_update()" class="mainButton" value="Submit"></td>
		</tr>
		</table>
		</table>







		
		<? elseif ( $action == "update company" ): ?>
		<input type="hidden" name="action" value="update db">
		<input type="hidden" name="language" value="<? echo $HTTP_POST_VARS['language'] ?>">
		<input type="hidden" name="site_name" value="<? echo $HTTP_POST_VARS['site_name'] ?>">
		<input type="hidden" name="document_root" value="<? echo stripslashes( $HTTP_POST_VARS['document_root'] ) ?>">
		<input type="hidden" name="base_url" value="<? echo stripslashes( $HTTP_POST_VARS['base_url'] ) ?>">
		<input type="hidden" name="company" value="<? echo $HTTP_POST_VARS['company'] ?>">
		<input type="hidden" name="login" value="<? echo $HTTP_POST_VARS['login'] ?>">
		<input type="hidden" name="password" value="<? echo $HTTP_POST_VARS['password'] ?>">
		<input type="hidden" name="contact_name" value="<? echo $HTTP_POST_VARS['contact_name'] ?>">
		<input type="hidden" name="contact_email" value="<? echo $HTTP_POST_VARS['contact_email'] ?>">
		<span class="title">Configure Database.</span>
		<br>
		<br>
		<font color="#660000">
		<big><b>Before you proceed, create an empty database for your PHP Live! system.  After you have done so, provide the database information below. (NOTE: Don't forget to restart or reload your MySQL so the new access level for this user is set.)</big></b>
		</font>
		<p>
		
		<input type="hidden" value="1" name="no_pconnect">
		<p>
		<table cellpadding=2 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Database Type</td>
			<td><span class="basetxt"> <select name="db_type"><option value='mysql'>MySQL</select></td>
		</tr>
		<tr>
			<td><span class="basetxt">DB Name</td>
			<td><span class="basetxt"> <input type="text" name="db_name" size=15 maxlength="200"></td>
		</tr>
		<tr>
			<td colspan=2><font size=1 face="arial">DB Host is usually set to localhost.</td>
		</tr>
		<tr>
			<td><span class="basetxt">DB Host</td>
			<td><span class="basetxt"> <input type="text" name="db_host" size=15 maxlength="200" value="localhost"></td>
		</tr>
		<tr>
			<td><span class="basetxt">DB Login</td>
			<td><span class="basetxt"> <input type="text" name="db_login" size=15 maxlength="200"></td>
		</tr>
		<tr>
			<td><span class="basetxt">DB Password</td>
			<td><span class="basetxt"> <input type="text" name="db_password" size=15 maxlength="200"></td>
		</tr>
		<tr>
			<td></td>
			<td><input type="button" OnClick="do_db_update()" class="mainButton" value="Submit"></td>
		</tr>
		</table>












		<? 
			elseif( $action == "update site name" ):
			$path_translated = stripslashes( $HTTP_SERVER_VARS['PATH_TRANSLATED'] ) ;
			if ( $server == "unix" )
				$temp_root = preg_replace( "/setup\/index.php/i", "", $path_translated ) ;
			else
				$temp_root = preg_replace( "/setup\\\index.php/i", "", $path_translated ) ;
		?>
		<input type="hidden" name="action" value="update document root">
		<input type="hidden" name="site_name" value="<? echo $HTTP_POST_VARS['site_name'] ?>">
		<input type="hidden" name="language" value="<? echo $HTTP_POST_VARS['language'] ?>">
		<span class="title">Set your Document Root.</span>
		<br>
		<span class="basetxt">This is the complete installed path (unpacked dir) of PHP <i>Live!</i>.<p>

		Example:<br>
		<font color="#660000">UNIX: /home/user/phplive<br>
		Windows: C:\Apache\htdocs\phplive</font>
		<br>
		<table cellpadding=5 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Document Root</td><td><span class="basetxt"> <input type="text" name="document_root" size=30 maxlength=120 value="<? echo $temp_root ?>"></td><td> <input type="submit" class="mainButton" value="Submit" border=0></td>
		</tr>
		</table>





		<? else: ?>
		<input type="hidden" name="action" value="update site name">
		<span class="title">Your Site Name.</span>
		<br>
		<table cellpadding=5 cellspacing=1 border=0>
		<tr>
			<td><span class="basetxt">Site Name</td><td><span class="basetxt"> <input type="text" name="site_name" size=15 maxlength=35 value="PHP Live!"></td>
		</tr>
		<tr>
			<td><span class="basetxt">Language</td>
			<td><span class="basetxt">
			<select name="language">
			<?
				if ( $dir = @opendir( "../lang_packs" ) )
				{
					while( $file = readdir( $dir ) )
					{
						if ( ( $file = preg_replace( "/\.php/", "", $file ) ) && !preg_match( "/(.bak)|(CVS)/", $file ) && preg_match( "/[0-9a-z]/i", $file ) )
						{
							$selected = "" ;
							if ( $file == $LANG_PACK )
								$selected = "selected" ;
							print "<option value=\"$file\" $selected>$file" ;
						}
					} 
					closedir($dir) ;
				}
			?>
			</select>
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td><td><input type="submit" class="mainButton" value="Submit"></td>
		</tr>
		</table>





		<? endif ; ?>
	</form>
	</td></tr></table>
	</td>
  </tr>
  <tr> 
	<td height="20" align="right" class="bgFooter" style="height:20px"><img src="../images/bg_corner_footer.gif" alt="" width="94" height="20"></td>
  </tr>
  <tr> 
	<td height="20" align="center" class="bgCopyright" style="height:20px"></td>
  </tr>
</table>
<!-- This navigation layer is placed at the very botton of the HTML to prevent pesky problems with NS4.x -->
</body>
</html>