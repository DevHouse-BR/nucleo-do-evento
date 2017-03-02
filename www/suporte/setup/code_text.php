<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: index.php" ) ; exit ; }
	if ( !file_exists( "../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("$DOCUMENT_ROOT/web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
?>
<?
	// initialize
	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$textbox_width = "80" ;
	else
		$textbox_width = "50" ;

	$deptid = ( isset( $HTTP_GET_VARS['deptid'] ) ) ? $HTTP_GET_VARS['deptid'] : "" ;

	$BASE_URL_STRIP = $BASE_URL ;
	//$BASE_URL_STRIP = preg_replace( "/http:/", "", $BASE_URL ) ;
?>
<html>
<head>
<title> Text Only HTML Code </title>
<? $css_path = "../" ; include( "../css/default.php" ) ; ?>

<script language="JavaScript">
<!--

//-->
</script>

</head>
<body bgColor="#FFFFFF" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<table width="100%" border="0" cellpadding="0" cellspacing="0" style="height:100%">
  <tr> 
	<td height="47" valign="top" class="bgMenuBack"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr>
		  <td width="10"><img src="<? echo $css_path ?>images/spacer.gif" width="10" height="1"></td>
		</tr>
	  </table></td>
  </tr>
  <tr>
	<form>
	<td valign="top" class="bg" align="center">
		<span class="basicTitle">TEXT ONLY HTML code</span>
		<br>
<textarea cols="<? echo $textbox_width ?>" rows="8" wrap="virtual" name="messagebox" onFocus="this.select(); return true;"><!-- BEGIN PHP Live! code, (c) OSI Codes Inc. -->
<script language="JavaScript" src="<? echo $BASE_URL_STRIP ?>/js/status_image.php?base_url=<? echo $BASE_URL_STRIP ?>&l=<? echo $session_setup['login'] ?>&x=<? echo $session_setup['aspID'] ?>&deptid=<? echo $deptid ?>&btn=1&text=<? echo preg_replace( "/ /", "+", $HTTP_GET_VARS['text'] ) ?>"></script>
<!-- END PHP Live! code : (c) OSI Codes Inc. --></textarea>
	</td>
	</form>
  </tr>
  <tr> 
	<td height="20" align="right" class="bgFooter" style="height:20px"><img src="<? echo $css_path ?>images/bg_corner_footer.gif" alt="" width="94" height="20"></td>
  </tr>
  <tr>
  <!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->
  
	<td height="20" align="center" class="bgCopyright" style="height:20px">
		<? if ( file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) ): ?>
		
		<? else: ?>
		<? echo $LANG['DEFAULT_BRANDING'] ?>
		<? endif ; ?>
		v<? echo $PHPLIVE_VERSION ?> &copy; OSI Codes Inc.
	</td>
  </tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

</body>
</html>