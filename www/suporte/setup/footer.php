<!-- **** End of the page body area **** -->
	</td>
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
<!-- This navigation layer is placed at the very botton of the HTML to prevent pesky problems with NS4.x -->
<div id="navBack" style="position:absolute; left:8px; top:76px; width:62px; height:16px; z-index:1; visibility: hidden;"> 
  <table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
	  <td><? echo $nav_line; ?></td>
	</tr>
  </table>
</div>
</body>
</html>