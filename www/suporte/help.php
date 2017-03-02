<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	include_once("./web/conf-init.php");
	include_once("$DOCUMENT_ROOT/system.php") ;
	include_once("$DOCUMENT_ROOT/lang_packs/$LANG_PACK.php") ;
	include_once("$DOCUMENT_ROOT/web/VERSION_KEEP.php") ;
	include_once("$DOCUMENT_ROOT/API/sql.php") ;
?>
<?

	// initialize
	$action = "" ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "12" ;
	else
		$text_width = "9" ;

	$success = 0 ;
	// update all admins status to not available if they have been idle

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
?>
<?
	// functions
?>
<?
	// conditions
?>
<html>
<head>
<title> PHP Live! Quick Help </title>
<? $css_path = ( !isset( $css_path ) ) ? $css_path = "./" : $css_path ; include_once( $css_path."css/default.php" ) ; ?>

<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<script language="JavaScript">
<!--

//-->
</script>

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
	<td valign="top" class="bg" width="100%">

		<table cellspacing=1 cellpadding=3 border=0 width="95%">
		<tr>
			<td><span class="basicTitle">PHP Live! Quick Help</span><p>

			<? if ( $action == "sp_cell" ): ?>
			<b><li> Cell Phone Format</b><br>
			Always include your COUNTRY CODE in your cell phone.  For US clients, please include the leading 1 and your area code.  For all international clients, include your country code and no prefix:
			<ul> Example Demo Cellular Formats
				<li> 12125555555 (example US)
				<li> 448885550000 (example UK)
			</ul>
				

			<? elseif ( $action == "share_transcripts" ): ?>
			<b><li> Share Transcripts</b><br>
			If you allow sharing of transcripts, all operators that are assigned to a department will be able to view each other's transcripts.  If you do not allow sharing of transcripts, operators will only be able to view their own transcripts.


			<? elseif ( $action == "visible" ): ?>
			<b><li> Department Visible to Public (not hidden)</b><br>
			Hidden departments will allow managers/admins to monitor and be able to receive calls that are only transferred to them or via operator-to-operator chat.  Hidden departments are not visible or directly accessible to the public.


			<? elseif ( $action == "sp_cpage" ): ?>
			<b><li> Purchase Complete Confirmation Page</b><br>
			Typically, every eCommerce websites have a basic order process: browse and select goods/services, capture online payment and lastly a <u><i>purchase complete confirmation page</i></u> or Thank You page.
			<p>
			The "Sales Path" HTML Code belongs in the purchase complete confirmation page.
			<p>
			<b>Question:</b> What if I have a script that creates dynamically a purchase complete confirmation page?<br>
			<b>Answer:</b> Simply place the "Sales Path" HTML code in the confirmation portion of the script (right after the receipt output is fine).


			<? elseif ( $action == "sp_message" ): ?>
			<b><li> &lt;Your Message&gt;</b><br>
			If you notice in the "Sales Path" HTML code, there is <span class="hilight">&lt;Your Message&gt;</span> string.  You need to replace this with that of your personal notification message. This message will be sent to your cellular or email each time a "Sales Path" is tracked.
			<ul> Example Notification Messages
				<li> Just got a Sales!
				<li> A person just signed up!
			</ul>

			If you are computer and code savvy, you can dynamically put variables to your message.  For example, if you have different products and would like to include that information in your notifications, simply generate the notification message from your script!
			<ul> Example Dynamic Notification Messages
				<li> &lt;? print $total ?&gt; units sold at $&lt;? print $cost ?&gt;
			</ul>


			<? elseif ( $action == "commands" ): ?>
			<ul>
				<li> <span class="hilight"><b>url:</b></span><i>URL</i> (hyperlink a URL) 
				<li> <span class="hilight"><b>image:</b></span><i>URL/sample.gif</i> (hyperlink an email)
				<li> <span class="hilight"><b>email:</b></span><i>example@thesite.com</i> (embed an image)
				<li> <span class="hilight"><b>push:</b></span><i>URL</i> (opens new browser containing URL of webpage, word docs, etc.)
			</ul>

			<p>
			examples:<br>
			<code>url:http://www.phplivesupport.com/trial.php</code><br>
			<code>email:example@thesite.com</code>


			<? endif ; ?>

			<p>
			<form><input type="button" class="mainButton" value="Close Window" OnClick="window.close()"></form>
			</td>
		</tr>
		</table>
	</td>
  </tr>
  <tr> 
	<td height="20" align="right" class="bgFooter" style="height:20px"><img src="<? echo $css_path ?>images/bg_corner_footer.gif" alt="" width="94" height="20"></td>
  </tr>
  <tr>
  <!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

	<td height="20" align="center" class="bgCopyright" style="height:20px">
	
	</td>
  </tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->


</body>
</html>
