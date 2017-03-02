<?php
/**
 * SEF module for Joomla!
 * Originally written for Mambo as 404SEF by W. H. Welch.
 *
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10} 
 */
 
// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');

class HTML_sef

{
	function configuration(&$lists, $txt404)
	
	{
	   global $sefConfig, $sef_config_file;
	   
	   $tabs = new mosTabs(0);
	   
	?>
		<table class="adminheading">
		<tr><th>
		<?php
		echo _COM_SEF_TITLE_CONFIG.((file_exists( $sef_config_file )) ? ((is_writable( $sef_config_file )) ? _COM_SEF_WRITEABLE : _COM_SEF_UNWRITEABLE ) : _COM_SEF_USING_DEFAULT)
		?>
		<br/><font class="small" align="left"><a href="index2.php?option=com_sef"><?php echo _COM_SEF_BACK?></a></font>
		</th></tr>
		</table>
		<?php if (!$GLOBALS['mosConfig_sef']) {
	               	echo _COM_SEF_DISABLED;
	       	}
	       	$x=0;
	       	?>
	        <div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
	        <script language="Javascript" src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/includes/js/overlib_mini.js"></script>
	        <script language="Javascript">
				    function submitbutton(pressbutton) {
				      if (pressbutton == 'save') {
	                var eraseCache = confirm("<?php echo _COM_SEF_CONFIRM_ERASE_CACHE; ?>");
	                if (eraseCache) document.getElementById("eraseCache").value = "1";
	            }
							<?php getEditorContents( 'editor1', 'introtext' ) ; ?>
							submitform( pressbutton );
					}
					//-->
					</script>
	        <form action="index2.php?option=com_sef&task=saveconfig" method="post" name="adminForm" id="adminForm">
	<?php         
	  $tabs->startPane("sh404SEFConf");
  	$tabs->startTab( _COM_SEF_SH_CONF_TAB_MAIN,"basics");    
	?>        
        <table class="adminform">
	        <tr>
	            <th colspan="4"><?php echo _COM_SEF_TITLE_BASIC; ?></th>
	        </tr>
	        <?php //Dit zit hier niet goed; ?>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_ENABLED;?>?</td>
	            <td width="150"><?php echo $lists['enabled'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_ENABLED,_COM_SEF_ENABLED);?></td>
	            <td rowspan="9" valign="top" align="right"><b>
	             <?php echo _COM_SEF_DEF_404_PAGE;?></b><br/><br/>
			<?php
			// parameters : areaname, content, hidden field, width, height, cols, rows
			editorArea( 'editor1',  $txt404, 'introtext','450','150','50','11' );
			?>
	            </td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_REPLACE_CHAR;?></td>
	            <td width="150"><input type="text" name="replacement" value="<?php echo $sefConfig->replacement;?>" size="1" maxlength="1"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_REPLACE_CHAR,_COM_SEF_REPLACE_CHAR);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_PAGEREP_CHAR;?></td>
	            <td width="150"><input type="text" name="pagerep" value="<?php echo $sefConfig->pagerep;?>" size="1" maxlength="1"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_PAGEREP_CHAR,_COM_SEF_PAGEREP_CHAR);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_STRIP_CHAR;?></td>
	            <td width="150"><input type="text" name="stripthese" value="<?php echo $sefConfig->stripthese;?>" size="60" maxlength="255"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_STRIP_CHAR,_COM_SEF_STRIP_CHAR);?></td>
	        </tr>
	        <!-- shumisha 2007-04-01 new param for characters replacement table  -->
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_REPLACEMENTS;?></td>
	            <td width="150"><textarea name="shReplacements" cols="60" rows="5"><?php echo $sefConfig->shReplacements;?></textarea></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_REPLACEMENTS,_COM_SEF_SH_REPLACEMENTS);?></td>
	        </tr>
          <!-- shumisha 2007-04-01 end of new param for characters replacement table  -->
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_FRIENDTRIM_CHAR;?></td>
	            <td width="150"><input type="text" name="friendlytrim" value="<?php echo $sefConfig->friendlytrim;?>" size="60" maxlength="255"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_FRIENDTRIM_CHAR,_COM_SEF_FRIENDTRIM_CHAR);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_USE_ALIAS;?>?</td>
	            <td width="150"><?php echo $lists['usealias'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_USE_ALIAS,_COM_SEF_USE_ALIAS);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SUFFIX;?></td>
	            <td width="150"><input type="text" name="suffix" value="<?php echo $sefConfig->suffix; ?>" size="6" maxlength="6"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SUFFIX,_COM_SEF_SUFFIX);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_ADDFILE;?></td>
	            <td width="150"><input type="text" name="addFile" value="<?php echo $sefConfig->addFile; ?>" size="60" maxlength="60"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_ADDFILE,_COM_SEF_ADDFILE);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_PAGETEXT;?></td>
	            <td width="150"><input type="text" name="pagetext" value="<?php echo $sefConfig->pagetext; ?>" size="10" maxlength="20"></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_PAGETEXT,_COM_SEF_PAGETEXT);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_LOWER;?>?</td>
	            <td width="150"><?php echo $lists['lowercase'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_LOWER,_COM_SEF_LOWER);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SHOW_SECT;?>?</td>
	            <td width="150"><?php echo $lists['showsection'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SHOW_SECT,_COM_SEF_SHOW_SECT);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SHOW_CAT;?>?</td>
	            <td width="150"><?php echo $lists['showcat'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SHOW_CAT,_COM_SEF_SHOW_CAT);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_404PAGE;?></td>
	            <td width="150"><?php echo $lists['page404'];?></td>
	            <td>
	            <?php echo mosToolTip(_COM_SEF_TT_404PAGE,_COM_SEF_404PAGE);?>
	            </td>
	        </tr>
	        
          <!-- shumisha 2007-04-01 new params for language  -->
          <th colspan="3"><?php echo _COM_SEF_SH_TRANSLATION_TITLE;?></th> 
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_TRANSLATE_URL;?>?</td>
	            <td width="150"><?php echo $lists['shTranslateURL'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_TRANSLATE_URL,_COM_SEF_SH_TRANSLATE_URL);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_LANGUAGE_CODE;?>?</td>
	            <td width="150"><?php echo $lists['shInsertLanguageCode'];?></td>
	            <td><?php echo mosToolTip( _COM_SEF_TT_SH_INSERT_LANGUAGE_CODE,
                                          _COM_SEF_SH_INSERT_LANGUAGE_CODE);?></td>
	        </tr>
	        <!-- shumisha 2007-04-01 end of new params for language  -->
	        
	        <!-- shumisha 2007-04-01 new params for Numerical Id insert  -->
	        <th colspan="3"><?php echo _COM_SEF_SH_INSERT_NUMERICAL_ID_TITLE;?></th>
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_NUMERICAL_ID;?>?</td>
	            <td width="150"><?php echo $lists['shInsertNumericalId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_INSERT_NUMERICAL_ID,
                _COM_SEF_SH_INSERT_NUMERICAL_ID);?></td>
	        </tr>	
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST;?>?</td>
	            <td width="150"><?php echo $lists['shInsertNumericalIdCatList'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_INSERT_NUMERICAL_ID_CAT_LIST,
                _COM_SEF_SH_INSERT_NUMERICAL_ID_CAT_LIST);?></td>
	        </tr>
	        <!-- shumisha 2007-04-01 end of new params for Numerical Id insert  -->
	</table>      
	<?php        
	$tabs->endTab();
	$tabs->startTab(_COM_SEF_SH_CONF_TAB_PLUGINS,"plugins");
  ?>  
  <table class="adminform">
   
          <!-- shumisha 2007-04-01 new params for Virtuemart  -->	  
          <th colspan="3"><?php echo _COM_SEF_SH_VM_TITLE;?></th>   
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_VM_INSERT_SHOP_NAME;?>?</td>
	            <td width="150"><?php echo $lists['shVmInsertShopName'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_VM_INSERT_SHOP_NAME,
                _COM_SEF_SH_VM_INSERT_SHOP_NAME);?></td>
	        </tr>
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_SHOP_NAME;?></td>
	            <td width="150"><input type="text" name="shShopName" value="<?php echo $sefConfig->shShopName;?>" size="30" maxlength="30"></td>
	            <td><?php echo mosToolTip( _COM_SEF_TT_SH_SHOP_NAME,
                                         _COM_SEF_SH_SHOP_NAME);?></td>
	        </tr> 
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_PRODUCT_ID;?>?</td>
	            <td width="150"><?php echo $lists['shInsertProductId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_INSERT_PRODUCT_ID,
                _COM_SEF_SH_INSERT_PRODUCT_ID);?></td>
	        </tr>
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_VM_USE_PRODUCT_SKU;?>?</td>
	            <td width="150"><?php echo $lists['shVmUseProductSKU'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_VM_USE_PRODUCT_SKU,
                _COM_SEF_SH_VM_USE_PRODUCT_SKU);?></td>
	        </tr>
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME;?>?</td>
	            <td width="150"><?php echo $lists['shVmInsertManufacturerName'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_NAME,
                _COM_SEF_SH_VM_INSERT_MANUFACTURER_NAME);?></td>
	        </tr>
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_VM_INSERT_MANUFACTURER_ID;?>?</td>
	            <td width="150"><?php echo $lists['shInsertManufacturerId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_VM_INSERT_MANUFACTURER_ID,
                _COM_SEF_SH_VM_INSERT_MANUFACTURER_ID);?></td>
	        </tr>            
	        <tr>
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_VM_INSERT_CATEGORIES;?></td>
	            <td width="150"><?php echo $lists['shVMInsertCategories'];?></td>
	            <td>
	            <?php echo mosToolTip(_COM_SEF_TT_SH_VM_INSERT_CATEGORIES,_COM_SEF_SH_VM_INSERT_CATEGORIES);?>
	            </td>
	        </tr>   
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_VM_INSERT_CATEGORY_ID;?>?</td>
	            <td width="150"><?php echo $lists['shInsertCategoryId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_VM_INSERT_CATEGORY_ID,
                _COM_SEF_SH_VM_INSERT_CATEGORY_ID);?></td>
	        </tr> 
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_VM_ADDITIONAL_TEXT;?>?</td>
	            <td width="150"><?php echo $lists['shVmAdditionalText'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_VM_ADDITIONAL_TEXT,
                _COM_SEF_SH_VM_ADDITIONAL_TEXT);?></td>
	        </tr> 
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_VM_INSERT_FLYPAGE;?>?</td>
	            <td width="150"><?php echo $lists['shVmInsertFlypage'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_VM_INSERT_FLYPAGE,
                _COM_SEF_SH_VM_INSERT_FLYPAGE);?></td>
	        </tr> 
          <!-- shumisha 2007-04-01 end of new params for Virtuemart  -->
          
          <!-- shumisha 2007-04-25 new params for Community Builder  -->	  
          <th colspan="3"><?php echo _COM_SEF_SH_CB_TITLE;?></th>   
          
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>         
	            <td width="200"><?php echo _COM_SEF_SH_CB_INSERT_NAME;?>?</td>
	            <td width="150"><?php echo $lists['shInsertCBName'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_CB_INSERT_NAME,
                _COM_SEF_SH_CB_INSERT_NAME);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>       
	            <td width="200"><?php echo _COM_SEF_SH_CB_NAME;?></td>
	            <td width="150"><input type="text" name="shCBName" value="<?php echo $sefConfig->shCBName;?>" size="30" maxlength="30"></td>
	            <td><?php echo mosToolTip( _COM_SEF_TT_SH_CB_NAME,
                                         _COM_SEF_SH_CB_NAME);?></td>
	        </tr> 
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>     
	            <td width="200"><?php echo _COM_SEF_SH_CB_INSERT_USER_NAME;?>?</td>
	            <td width="150"><?php echo $lists['shCBInsertUserName'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_CB_INSERT_USER_NAME,
                _COM_SEF_SH_CB_INSERT_USER_NAME);?></td>
	        </tr>
	        
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_CB_INSERT_USER_ID;?>?</td>
	            <td width="150"><?php echo $lists['shCBInsertUserId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_CB_INSERT_USER_ID,
                _COM_SEF_SH_CB_INSERT_USER_ID);?></td>
	        </tr>
	        
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_CB_USE_USER_PSEUDO;?>?</td>
	            <td width="150"><?php echo $lists['shCBUseUserPseudo'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_CB_USE_USER_PSEUDO,
                _COM_SEF_SH_CB_USE_USER_PSEUDO);?></td>
	        </tr>
	        
	        <!-- shumisha 2007-04-25 new params for Community Builder  -->
    
          <!-- shumisha 2007-04-25 new params for Fireboard  -->	  
          <th colspan="3"><?php echo _COM_SEF_SH_FB_TITLE;?></th>   
          
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>         
	            <td width="200"><?php echo _COM_SEF_SH_FB_INSERT_NAME;?>?</td>
	            <td width="150"><?php echo $lists['shInsertFireboardName'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_FB_INSERT_NAME,
                _COM_SEF_SH_FB_INSERT_NAME);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>       
	            <td width="200"><?php echo _COM_SEF_SH_FB_NAME;?></td>
	            <td width="150"><input type="text" name="shFireboardName" value="<?php echo $sefConfig->shFireboardName;?>" size="30" maxlength="30"></td>
	            <td><?php echo mosToolTip( _COM_SEF_TT_SH_FB_NAME,
                                         _COM_SEF_SH_FB_NAME);?></td>
	        </tr> 
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>     
	            <td width="200"><?php echo _COM_SEF_SH_FB_INSERT_CATEGORY_NAME;?>?</td>
	            <td width="150"><?php echo $lists['shFbInsertCategoryName'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_FB_INSERT_CATEGORY_NAME,
                _COM_SEF_SH_FB_INSERT_CATEGORY_NAME);?></td>
	        </tr>
	        
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_FB_INSERT_CATEGORY_ID;?>?</td>
	            <td width="150"><?php echo $lists['shFbInsertCategoryId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_FB_INSERT_CATEGORY_ID,
                _COM_SEF_SH_FB_INSERT_CATEGORY_ID);?></td>
	        </tr>
	        
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>     
	            <td width="200"><?php echo _COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT;?>?</td>
	            <td width="150"><?php echo $lists['shFbInsertMessageSubject'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_FB_INSERT_MESSAGE_SUBJECT,
                _COM_SEF_SH_FB_INSERT_MESSAGE_SUBJECT);?></td>
	        </tr>
	        
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_FB_INSERT_MESSAGE_ID;?>?</td>
	            <td width="150"><?php echo $lists['shFbInsertMessageId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_FB_INSERT_MESSAGE_ID,
                _COM_SEF_SH_FB_INSERT_MESSAGE_ID);?></td>
	        </tr>
	        <!-- shumisha 2007-04-25 new params for Fireboardr  -->
          
	        <!-- shumisha 2007-04-01 new params for Letterman  -->
	        <th colspan="3"><?php echo _COM_SEF_SH_LETTERMAN_TITLE;?></th>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID;?></td>
	            <td width="150"><input type="text" name="shLMDefaultItemid" value="<?php echo $sefConfig->shLMDefaultItemid; ?>" size="10" maxlength="10"></td>
             <td><?php echo mosToolTip( _COM_SEF_TT_SH_LETTERMAN_DEFAULT_ITEMID,
                                        _COM_SEF_SH_LETTERMAN_DEFAULT_ITEMID);?></td>
	        </tr>
	        <!-- shumisha 2007-04-01 end of new params for Letterman  -->
	        
          <!-- shumisha 2007-04-25 new params for iJoomla magazine  -->	  
          <th colspan="3"><?php echo _COM_SEF_SH_IJOOMLA_MAG_TITLE;?></th>   
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_ACTIVATE_IJOOMLA_MAG;?>?</td>
	            <td width="150"><?php echo $lists['shActivateIJoomlaMagInContent'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_ACTIVATE_IJOOMLA_MAG,
                _COM_SEF_SH_ACTIVATE_IJOOMLA_MAG);?></td>
	        </tr>
          
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>         
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME;?>?</td>
	            <td width="150"><?php echo $lists['shInsertIJoomlaMagName'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_NAME,
                _COM_SEF_SH_INSERT_IJOOMLA_MAG_NAME);?></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>       
	            <td width="200"><?php echo _COM_SEF_SH_IJOOMLA_MAG_NAME;?></td>
	            <td width="150"><input type="text" name="shIJoomlaMagName" value="<?php echo $sefConfig->shIJoomlaMagName;?>" size="30" maxlength="30"></td>
	            <td><?php echo mosToolTip( _COM_SEF_TT_SH_IJOOMLA_MAG_NAME,
                                         _COM_SEF_SH_IJOOMLA_MAG_NAME);?></td>
	        </tr> 
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>     
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID;?>?</td>
	            <td width="150"><?php echo $lists['shInsertIJoomlaMagMagazineId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID,
                _COM_SEF_SH_INSERT_IJOOMLA_MAG_MAGAZINE_ID);?></td>
	        </tr>
	        
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID;?>?</td>
	            <td width="150"><?php echo $lists['shInsertIJoomlaMagIssueId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ISSUE_ID,
                _COM_SEF_SH_INSERT_IJOOMLA_MAG_ISSUE_ID);?></td>
	        </tr>
	        
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>     
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID;?>?</td>
	            <td width="150"><?php echo $lists['shInsertIJoomlaMagArticleId'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID,
                _COM_SEF_SH_INSERT_IJOOMLA_MAG_ARTICLE_ID);?></td>
	        </tr>
	        <!-- shumisha 2007-04-25 new params for iJoomla magazine  -->
	</table>      
	<?php        
	$tabs->endTab();
	$tabs->startTab(_COM_SEF_SH_CONF_TAB_ADVANCED,"Advanced");
  ?>  
  <table class="adminform">        
	        
	        <!-- shumisha 2007-04-01 new params for cache  -->
	        <tr><th colspan="4"><?php echo _COM_SEF_SH_CACHE_TITLE;?></th></tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_USE_URL_CACHE;?></td>
	            <td width="150"><?php echo $lists['shUseURLCache'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_USE_URL_CACHE,_COM_SEF_SH_USE_URL_CACHE);?></td>
	            <td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_MAX_URL_IN_CACHE;?></td>
	            <td width="150"><input type="text" name="shMaxURLInCache" value="<?php echo $sefConfig->shMaxURLInCache; ?>" size="10" maxlength="10"></td>
             <td><?php echo mosToolTip(_COM_SEF_TT_SH_MAX_URL_IN_CACHE,_COM_SEF_SH_MAX_URL_IN_CACHE);?></td>
             <td></td>
	        </tr>
	        <!-- shumisha 2007-04-01 end of new params for cache  -->
	        
	        <tr>
	        <th colspan="8"><?php echo _COM_SEF_TITLE_ADV;?></th>
	        </tr>
	        
	        <!-- shumisha 2007-04-13 new params for automatic 301 redirect of non-sef URL  -->
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF;?>?</td>
	            <td width="150"><?php echo $lists['shRedirectNonSefToSef'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_REDIRECT_NON_SEF_TO_SEF,
                _COM_SEF_SH_REDIRECT_NON_SEF_TO_SEF);?></td>
              <td></td>  
	        </tr>	
	        <!-- shumisha 2007-05-4 new params for automatic 301 redirect of joomla-sef URL  -->
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF;?>?</td>
	            <td width="150"><?php echo $lists['shRedirectJoomlaSefToSef'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_REDIRECT_JOOMLA_SEF_TO_SEF,
                _COM_SEF_SH_REDIRECT_JOOMLA_SEF_TO_SEF);?></td>
              <td></td>  
	        </tr>
	        <!-- shumisha 2007-04-13 end of new params for automatic 301 redirect of joomla-sef URL  -->
	        <!-- V 1.2.4.k new param to enable/disable 404 errors logging to DB  -->
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_LOG_404_ERRORS;?>?</td>
	            <td width="150"><?php echo $lists['shLog404Errors'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_LOG_404_ERRORS,
                _COM_SEF_SH_LOG_404_ERRORS);?></td>
              <td></td>  
	        </tr>	
	        <!-- shumisha 2007-04-13 end of new params for enable/disable 404 errors logging to DB  -->
          <!-- shumisha 2007-04-13 new params for secure live site URL  -->
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_LIVE_SECURE_SITE;?></td>
	            <td width="150"><input type="text" name="shConfig_live_secure_site" value="<?php echo $sefConfig->shConfig_live_secure_site;?>" size="30" maxlength="60"></td>
	            <td><?php echo mosToolTip( _COM_SEF_TT_SH_LIVE_SECURE_SITE,
                                         _COM_SEF_SH_LIVE_SECURE_SITE);?></td>
              <td></td>                           
	        </tr> 
	        <!-- shumisha 2007-04-13 end of new params for secure live site  -->
          <!-- shumisha 2007-04-13 new params for HTTPS force non sef  -->
          <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_FORCE_NON_SEF_HTTPS;?>?</td>
	            <td width="150"><?php echo $lists['shForceNonSefIfHttps'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_FORCE_NON_SEF_HTTPS,
                _COM_SEF_SH_FORCE_NON_SEF_HTTPS);?></td>
	        </tr>
          <!-- shumisha 2007-04-13 end of new params HTTPS force non sef  -->
          <!-- shumisha 2007-04-01 new params for Itemid handling and URL construction  -->
          <th colspan="4"><?php echo _COM_SEF_SH_ITEMID_TITLE;?></th>  
           <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_GUESS_HOMEPAGE_ITEMID;?>?</td>
	            <td width="150"><?php echo $lists['guessItemidOnHomepage'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_GUESS_HOMEPAGE_ITEMID,
                _COM_SEF_SH_GUESS_HOMEPAGE_ITEMID);?></td><td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE;?>?</td>
	            <td width="150"><?php echo $lists['shInsertGlobalItemidIfNone'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_INSERT_GLOBAL_ITEMID_IF_NONE,
                _COM_SEF_SH_INSERT_GLOBAL_ITEMID_IF_NONE);?></td><td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID;?>?</td>
	            <td width="150"><?php echo $lists['shInsertTitleIfNoItemid'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_INSERT_TITLE_IF_NO_ITEMID,
                _COM_SEF_SH_INSERT_TITLE_IF_NO_ITEMID);?></td><td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE;?>?</td>
	            <td width="150"><?php echo $lists['shAlwaysInsertMenuTitle'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_ALWAYS_INSERT_MENU_TITLE,
                _COM_SEF_SH_ALWAYS_INSERT_MENU_TITLE);?></td><td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_ALWAYS_INSERT_ITEMID;?>?</td>
	            <td width="150"><?php echo $lists['shAlwaysInsertItemid'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_ALWAYS_INSERT_ITEMID,
                _COM_SEF_SH_ALWAYS_INSERT_ITEMID);?></td><td></td>
	        </tr>
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_DEFAULT_MENU_ITEM_NAME;?></td>
	            <td width="150"><input type="text" name="shDefaultMenuItemName" value="<?php echo $sefConfig->shDefaultMenuItemName;?>" size="30" maxlength="30"></td>
	            <td><?php echo mosToolTip( _COM_SEF_TT_SH_DEFAULT_MENU_ITEM_NAME,
                                         _COM_SEF_SH_DEFAULT_MENU_ITEM_NAME);?></td><td></td>
	        </tr>
	        <!-- shumisha 2007-04-01 end of new params for Itemid handling and URL construction  -->
	        <!-- shumisha 2007-05-28 new params for URL encoding  -->
	        <tr<?php $x++; echo (($x % 2) ? '':' class="row1"' );?>>
	            <td width="200"><?php echo _COM_SEF_SH_ENCODE_URL;?>?</td>
	            <td width="150"><?php echo $lists['shEncodeUrl'];?></td>
	            <td><?php echo mosToolTip(_COM_SEF_TT_SH_ENCODE_URL,
                _COM_SEF_SH_ENCODE_URL);?></td><td></td>
	        </tr>
	        <!-- shumisha 2007-04-13 end of new params for  URL encoding -->
  </table>        
  <?php        
	$tabs->endTab();
	$tabs->startTab(_COM_SEF_SH_CONF_TAB_BY_COMPONENT,"ByComponent");
  ?>  
	  <table class="adminform">
	  <tr>      
	<?php	  
	  echo "<td width=\"100\" align=\"center\">&nbsp;</td>\n";
		echo "<td width=\"100\" align=\"center\">&nbsp;".mosToolTip(_COM_SEF_TT_SH_ADV_MANAGE_URL,
             _COM_SEF_SH_ADV_MANAGE_URL)."</td>\n";
		echo "<td width=\"100\" align=\"center\">&nbsp;".mosToolTip(_COM_SEF_TT_SH_ADV_TRANSLATE_URL,
             _COM_SEF_SH_ADV_TRANSLATE_URL)."</td>\n";
		echo "<td width=\"100\" align=\"center\">&nbsp;".mosToolTip(_COM_SEF_TT_SH_ADV_INSERT_ISO,
              _COM_SEF_SH_ADV_INSERT_ISO)."</td>\n";
    echo "<td width=\"100\" align=\"center\">&nbsp;".mosToolTip(_COM_SEF_TT_SH_ADV_OVERRIDE_SEF,
              _COM_SEF_SH_OVERRIDE_SEF_EXT)."</td>\n";
	  echo '</tr>';
		foreach($lists['adv_config'] as $key=>$compList) {
			$x++;
			echo '<tr'.(($x % 2) ? '':' class="row1"' )." colspan=\"6\">\n";
			echo '<td width="100">'.$key."</td>\n";
			echo '<td width="100">'.$compList['manageURL']."</td>\n";
			echo '<td width="100">'.$compList['translateURL']."</td>\n";
			echo '<td width="100">'.$compList['insertIsoCode']."</td>\n";
      echo '<td width="100">'.$compList['shDoNotOverrideOwnSef']."</td>\n";
			echo "<td></td>\n";
	    echo "</tr>\n";
		}
		echo '</table>';
	?>
	        <tr>
	            <th colspan="4"></th>
	        </tr>
	 </table>
  <?php        
	$tabs->endTab();
	$tabs->endPane();
  ?>       
	        <input type="hidden" name="id" value="">
	        <input type="hidden" name="task" value="saveconfig">
	        <input type="hidden" name="option" value="com_sef">
	        <input type="hidden" name="section" value="config">
	        <input type="hidden" name="eraseCache" id="eraseCache" value="0">
	    </form>
    <?php
	}
	
	function viewSEF( &$rows, &$lists, $pageNav, $option, $viewmode=0, $search = '' ) { 
  // V 1.2.4.q added search
	
	global $my;
	
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _COM_SEF_TITLE_MANAGER;?>
			<br/><font class="small" align="left"><a href="index2.php?option=com_sef"><?php echo _COM_SEF_BACK?></a></font>
			</th>
			<td nowrap >
			<?php
			if ($viewmode == 2) {
			?><br/>
			<a href="index2.php?option=<?php echo $option; ?>&task=import_export&ViewModeId=<?php echo $viewmode?>"><?php echo _COM_SEF_IMPORT_EXPORT; ?></a>&nbsp;&nbsp;
			<?php }else{
			?>
			&nbsp;
			</td>
			<?php }
			?>
			<td width="right">
			<?php echo _COM_SEF_VIEWMODE.$lists['viewmode'];?>
			</td>
			<td width="right">
			<?php echo _COM_SEF_SORTBY.$lists['sortby'];?>
			</td>
			
			<td align="left">
			<?php echo _COM_SEF_SH_FILTER.':'; ?> <br />
			<input type="text" name="search" value="<?php echo htmlspecialchars( $search );?>" class="text_area" onChange="document.adminForm.submit();" />
			</td>
			
		</tr>
		</table>
		<table class="adminlist">
		<tr>
			<th width="20px">
			#
			</th>
			<th width="20px">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count( $rows ); ?>);" />
			</th>
			<th class="title" width="50px">
			<?php echo _COM_SEF_HITS;?>
			</th>
			<th class="title">
			<?php echo (($viewmode == 1) ? _COM_SEF_DATEADD: _COM_SEF_SEFURL) ?>
			</th>
			<th>
			<?php echo (($viewmode == 1) ? _COM_SEF_URL:_COM_SEF_REALURL ) ?>
			</th>
		</tr>
		<?php
		$k = 0;
		//for ($i=0, $n=count( $rows ); $i < $n; $i++) {
		foreach (array_keys($rows) as $i) {
			$row = &$rows[$i];
			?>
			<tr class="<?php echo 'row'. $k; ?>">
				<td align="center">
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
				<?php echo mosHTML::idBox( $i, $row->id, false ); ?>
				</td>
				<td>
				<?php echo $row->cpt; ?>
				</td>
				<td style="text-align:left;">
				<?php if ($viewmode == 1) {?>
					<?php echo $row->dateadd;?>
				<?php }else{ ?>
					<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')">
					<?php echo $row->oldurl;?>
					</a>
				<?php } ?>
				</td>
				<td style="text-align:left;" width="80%">
				<?php if ($viewmode == 1) {?>
					<a href="#edit" onclick="return listItemTask('cb<?php echo $i;?>','edit')">
					<?php echo $row->oldurl;?>
					</a>
				<?php }else echo $row->newurl;?>
				</td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</table>
		<?php echo $pageNav->getListFooter(); ?>
		<input type="hidden" name="option" value="<?php echo $option;?>" />
		<input type="hidden" name="task" value="view" />
		<input type="hidden" name="boxchecked" value="0" />
		</form>
		<?php
	}
	
	function editSEF( &$_row, &$lists, $_option ) {
	
?>
	<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
	<script language="Javascript" src="<?php echo $GLOBALS['mosConfig_live_site']; ?>/includes/js/overlib_mini.js"></script>
	<script language="javascript">
	<!--
	function changeDisplayImage() {
		if (document.adminForm.imageurl.value !='') {
			document.adminForm.imagelib.src='../images/404sef/' + document.adminForm.imageurl.value;
		} else {
			document.adminForm.imagelib.src='images/blank.png';
		}
	}
	function submitbutton(pressbutton) {
		var form = document.adminForm;
		if (pressbutton == 'cancel') {
			submitform( pressbutton );
			return;
		}
		// do field validation
<?php if ( ($_row->id) && $_row->dateadd == "0000-00-00" ) { ?>
		if (form.customurl.checked ) {
			form.dateadd.value = "<?php echo date('Y-m-d'); ?>"
		}else{
			form.dateadd.value = "0000-00-00"
		}
<?php } ?>
		if (form.newurl.value == "") {
			alert( "<?php echo _COM_SEF_EMPTYURL?>" );
		} else {
			if (form.newurl.value.match(/^index.php/)) {
				submitform( pressbutton );
			}else{
				alert( "<?php echo _COM_SEF_BADURL ?>" );
			}
		}
	}
	//-->
	</script>
	<table class="adminheading">
		<tr>
			<th>404 SEF <?php echo $_row->id ? _COM_SEF_EDIT : _COM_SEF_ADD;?> Url</th>
		</tr>
	</table>
	<form action="index2.php" method="post" name="adminForm">
	<table class="adminform">
		<tr>
			<td width="20%"><?php echo _COM_SEF_NEWURL;?></td>
			<td width="70%"><input class="inputbox" type="text" size="100" name="oldurl" value="<?php echo $_row->oldurl; ?>">
			<?php echo mosToolTip(_COM_SEF_TT_NEWURL);?></td>
			<td width="10%">&nbsp;</td>
		</tr>
		<tr>
			<td><?php echo _COM_SEF_OLDURL;?></td>
			<td align="left"><input class="inputbox" type="text" size="100" name="newurl" value="<?php echo $_row->newurl; ?>">
			<?php echo mosToolTip(_COM_SEF_TT_OLDURL);?>
			<?php echo ( ($_row->id) && $_row->dateadd == "0000-00-00" ) ? '<br />'._COM_SEF_SAVEAS.'<input type="checkbox" name="customurl" value="0">' : '';?>
			</div>
			</td>
		</tr>
		<tr>
			<td colspan="3">&nbsp;</td>
		</tr>
	</table>
	<input type="hidden" name="option" value="<?php echo $_option; ?>">
	<input type="hidden" name="dateadd" value="<?php echo $_row->dateadd; ?>">
	<input type="hidden" name="id" value="<?php echo $_row->id; ?>">
	<input type="hidden" name="task" value="">
	</form>
<?php
	}
	
	function help(){
	
	?>
		 <table class="adminform">
	        <tr>
	            <th colspan="4"><?php echo _COM_SEF_TITLE_SUPPORT;?></th>
	        </tr>
	        <tr>
	        	<td>
<?php global $mosConfig_absolute_path; include( $mosConfig_absolute_path.'/administrator/components/com_sef/readme.inc'); ?>
            </td>
	        </tr>
	<?php
	}
	
	function purge($option, $message, $confirmed){
	
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th>
			<?php echo _COM_SEF_TITLE_PURGE;?>
			<br/><font class="small" align="left"><a href="index2.php?option=com_sef"><?php echo _COM_SEF_BACK?></a></font>
			</th>
		</tr>
		<tr>
			<td><p class="message"><?php echo $message ?><br/>
				<input type="hidden" name="option" value="<?php echo $option;?>" />
			<?php if (($message == _COM_SEF_SUCCESSPURGE)||($message == _COM_SEF_NORECORDS)) { ?>
				<input type="hidden" name="task" value="" />
				<input type="submit" name="continue" value="<?php echo _COM_SEF_OK ?>"</p>
			<?php }else{ ?>
				<input type="hidden" name="task" value="purge" />
				<input type="submit" name="confirmed" value="<?php echo _COM_SEF_PROCEED ?>"</p>
			<?php } ?>
			</td>
		</tr>
	<?php
	}
	
	function import_export( $ViewModeId = 0) {
	
?>
<script type="text/javascript">
function checkForm(){
if (document.backupform.userfile.value == ""){
alert('<?php echo _COM_SEF_SELECT_FILE; ?>');
return false;
}else{
return true;
}
}
function toggle_display(idname){
obj = fetch_object(idname);
if (obj){
if (obj.style.display == "none"){
obj.style.display = "";
}else{
obj.style.display = "none";
}
}
return false;
}
</script>
<center>
<form method="post" action="index2.php?option=com_sef&task=import&ViewModeId=$ViewModeId" enctype="multipart/form-data" onSubmit="return checkForm();" name="backupform">
<input type="file" name="userfile">
<input type="submit" value="<?php echo _COM_SEF_IMPORT; ?>">
</form>
<input type="button" value="<?php echo _COM_SEF_EXPORT; ?>" onClick="javascript:location.href='index2.php?option=com_sef&task=export&ViewModeId=<?php echo $ViewModeId;?>'"></center>
<?php
	}
}
?>
