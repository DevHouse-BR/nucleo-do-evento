<?php
/*********************************************
* VisualRecommend - Component                *
* Copyright (C) 2007 by Bernard Gilly        *
* --------- All Rights Reserved ------------ *      
* Homepage   : www.visualclinic.fr           *
* Version    : 1.1.0                         *
* License    : Creative Commons              *
*********************************************/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// Get the right language if it exists
if (file_exists($mosConfig_absolute_path."/administrator/components/com_visualrecommend/languages/".$mosConfig_lang.".php")){
     include_once($mosConfig_absolute_path."/administrator/components/com_visualrecommend/languages/".$mosConfig_lang.".php");
     }else{
     include_once($mosConfig_absolute_path."/administrator/components/com_visualrecommend/languages/english.php");
     }
	 
class HTML_VRC {

	////////////////////////////  CONTROL PANEL  /////////////////////////////
	function showcontrolpanel( $option ) {
	global $mosConfig_live_site;
	?>
	<table width="100%" border="0" cellpadding="0" cellspacing="0" class="adminheading">
      <tr>
        <th class="cpanel">&nbsp;<?php echo "VisualRecommend :: Control Panel" ; ?></th>
      </tr>
    </table>
	<table class="adminform">
      <tr>
        <td width="40%" valign="top">
		<?php
			function quickiconButtonVR( $link, $image, $text, $option ) {
			global $_VERSION;
			
			if ( $_VERSION->PRODUCT == 'Mambo' ){ 
		?>			
				<style type="text/css">
				<!--
				#cpanel {  text-align: center;  vertical-align: middle; }				
				#cpanel div.icon   { margin: 3px; }
				#cpanel div.icon a { 
					display: block; float: left;
					height: 97px !important;
					height: 100px; 
					width: 108px !important;
					width: 110px; 
					vertical-align: middle; 
					text-decoration : none;
					border: 1px solid #DDD;
					padding: 2px 5px 1px 5px;
				}				
				#cpanel div.icon a:link    {  color : #808080;  }
				#cpanel div.icon a:hover   { 
					color : #333; 
					background-color: #f1e8e6;  
					border: 1px solid #c24733;
					padding: 3px 4px 0px 6px; 
				}
				#cpanel div.icon a:active  {  color : #808080;  }
				#cpanel div.icon a:visited {  color : #808080;  }				
				#cpanel div.icon img { margin-top: 13px; }
				#cpanel div.icon span { display: block; padding-top: 3px;}
				-->
				</style>		
		<?php } ?>				
				<div style="float:left;">
					<div class="icon">
						<a href="<?php echo $link; ?>">
							<?php echo mosAdminMenus::imageCheckAdmin( $image, '/administrator/components/'.$option.'/images/icons/', NULL, NULL, $text ); ?>
							<span><?php echo $text; ?></span>
						</a>
					</div>
				</div>
				<?php
			}		
			?>
			<div id="cpanel">
				<?php
				$link = 'index2.php?option='.$option.'&amp;task=config';
				quickiconButtonVR( $link, 'config.png', _VRECOMMEND_CPL_CONFIG, $option );
			
				$link = 'index2.php?option='.$option.'&amp;task=tracking';
				quickiconButtonVR( $link, 'user.png', _VRECOMMEND_CPL_TRACKING, $option );
			
				$link = 'index2.php?option='.$option.'&amp;task=exporttracking';
				quickiconButtonVR( $link, 'massmail.png', _VRECOMMEND_CPL_EXPORTALL, $option );
			
				$link = 'index2.php?option='.$option.'&amp;task=exportreplytracking';
				quickiconButtonVR( $link, 'massmail.png', _VRECOMMEND_CPL_EXPORTREPLY, $option );
			
				$link = 'index2.php?option='.$option.'&amp;task=statstracking';
				quickiconButtonVR( $link, 'stats.png', _VRECOMMEND_CPL_STATS, $option );
			
				$link = 'index2.php?option='.$option.'&amp;task=purgealltracking';
				quickiconButtonVR( $link, 'trash.png', _VRECOMMEND_CPL_PURGE, $option );
			
				$link = 'index2.php?option='.$option.'&amp;task=about';
				quickiconButtonVR( $link, 'info.png', _VRECOMMEND_CPL_ABOUT, $option );			
				?>
			</div>	
			<div style="clear:both;"> </div>	
		</td>
        <td width="60%" valign="top"><?php statstracking( $option, 0 ); ?></td>
      </tr>
    </table>
	  <?php
	}		

	function showConfig( $option ) {
	global $mosConfig_live_site, $mosConfig_absolute_path, $database;
	
	require( $mosConfig_absolute_path.'/administrator/components/com_visualrecommend/visualrecommend_config.php' );

	?>
	<script type="text/javascript" src="<?php echo $mosConfig_live_site;?>/includes/js/overlib_mini.js"></script>
	<script language="JavaScript" type="text/JavaScript">
	<!--
	function MM_reloadPage(init) {  //reloads the window if Nav4 resized
	  if (init==true) with (navigator) {if ((appName=="Netscape")&&(parseInt(appVersion)==4)) {
		document.MM_pgW=innerWidth; document.MM_pgH=innerHeight; onresize=MM_reloadPage; }}
	  else if (innerWidth!=document.MM_pgW || innerHeight!=document.MM_pgH) location.reload();
	}
	MM_reloadPage(true);
	//-->
	</script>
<table width="100%"  border="0">
<tr><td><img src="<?php echo $mosConfig_live_site."/administrator/components/com_visualrecommend" ?>/images/visualrecommend.gif"><br>
  <br></td>
</tr>
  <tr>  
    <td valign="top">
<div id="overDiv" style="position:absolute; visibility:hidden; z-index:10000;"></div>
<form action="index2.php" method="POST" name="adminForm" >
<?php
  mosCommonHTML::loadOverlib();
  $aclisttabs = new mosTabs( 0 );
  $aclisttabs->startPane( "config" );
    $aclisttabs->startTab( _VRECOMMEND_GENERAL,"General-page");
  ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="4" class="adminList">
    <tr class="row1">
      <td colspan="2" valign="top"><strong><?php echo _VRECOMMEND_GENERALSETTING ; ?></strong></td>
    </tr>
    <tr class="row0">
      <td width="15%" valign="top"><?php echo _VRECOMMEND_REGISTEREDONLY ; echo "&nbsp;&nbsp;" . mosToolTip( _VRECOMMEND_ALLOWREGISTERED ); ?> </td>
      <td width="85%" valign="top"><?php
			  echo mosHTML::yesnoRadioList( 'vr_registered', 'class="inputbox"', $vr_registered );				
			   
			?>
        &nbsp;&nbsp;
        <input type="checkbox" name="vr_link2CB" id="vr_link2CB" value="1"<?php echo $vr_link2CB ? ' checked="checked"' : ''; ?> />  <?php echo _VRECOMMEND_LINK_TO_CB ; echo "&nbsp;&nbsp;" . mosToolTip( _VRECOMMEND_LINK_TO_CB_DETAIL ); ?></td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_USERCUSTOMMESSAGE ; ?></td>
      <td valign="top"><?php
			  echo mosHTML::yesnoRadioList( 'vr_custom_msg', 'class="inputbox"', $vr_custom_msg );				
			?>
        <input type="hidden" id="vr_displayFormMode" name="vr_displayFormMode" value="1">
	  </td>
    </tr>
	<!--  
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_SHOWFORM ; ?></td>
      <td valign="top">
	  	   <?php
			$displayMode[] = mosHTML::makeOption( '0', _VRECOMMEND_NORMAL  );
			$displayMode[] = mosHTML::makeOption( '1', _VRECOMMEND_POPUP );
			$displayModeForm = mosHTML::radioList( $displayMode, 'vr_displayFormMode', 'class="inputbox"', $vr_displayFormMode );
			echo $displayModeForm;	  
		   ?>
      </td>
    </tr>
	-->
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_MAXRECOMMENDSENDING ; ?></td>
      <td valign="top">
        <?php
		$confmaxsending[] = mosHTML::makeOption( '1', '1' );		
		$confmaxsending[] = mosHTML::makeOption( '3', '3' );	
		$confmaxsending[] = mosHTML::makeOption( '5', '5' );	
		$confmaxsending[] = mosHTML::makeOption( '10', '10' );
		$listmaxsending = mosHTML::selectList( $confmaxsending, 'vr_maxsending', 'size="1"', 'value', 'text', $vr_maxsending );
		echo $listmaxsending;			  
	   ?>
      </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_MAXDAILYRECOMMEND ; ?></td>
      <td valign="top"><?php
	    $confmaxdaily[] = mosHTML::makeOption( '0', _VRECOMMEND_UNLIMITED );	
		$confmaxdaily[] = mosHTML::makeOption( '5', '5' );		
		$confmaxdaily[] = mosHTML::makeOption( '10', '10' );	
		$confmaxdaily[] = mosHTML::makeOption( '15', '15' );	
		$confmaxdaily[] = mosHTML::makeOption( '20', '20' );
		$confmaxdaily[] = mosHTML::makeOption( '25', '25' );
		$confmaxdaily[] = mosHTML::makeOption( '30', '30' );
		$confmaxdaily[] = mosHTML::makeOption( '50', '50' );		
		$listmaxdaily = mosHTML::selectList( $confmaxdaily, 'vr_maxdaily', 'size="1"', 'value', 'text', $vr_maxdaily );
		echo $listmaxdaily;			  
	   ?></td>
    </tr>
    <tr class="row1">
      <td colspan="2" valign="top"><strong><?php echo _VRECOMMEND_CUSTOMYOURPOPUP ; ?></strong></td>
      </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_WIDTH ; ?></td>
      <td valign="top"><input name="vr_width_popup" type="text" id="vr_width_popup" size="6" value="<?php echo $vr_width_popup ; ?>">
&nbsp;&gt; 100 </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_HEIGHT ; ?></td>
      <td valign="top"><input name="vr_height_popup" type="text" id="vr_height_popup" size="6" value="<?php echo $vr_height_popup ; ?>">
&nbsp;&gt; 100 </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ACTIVATEADSENSE ; ?></td>
      <td valign="top">
	  <?php
		echo mosHTML::yesnoRadioList( 'vr_ads_activate', 'class="inputbox"', $vr_ads_activate ) . "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<em>" . _VRECOMMEND_SETTINGADSENSEDESCRIPTION ."</em>" ;			  
	  ?>
	  </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_AD_FORMAT ; ?></td>
      <td valign="top">
	  <?php
		$confAdsFormat[] = mosHTML::makeOption( '728x90_as', '728 x 90 Leaderboard' );		
		$confAdsFormat[] = mosHTML::makeOption( '468x60_as', '468 x 60 Banner' );	
		$confAdsFormat[] = mosHTML::makeOption( '234x60_as', '234 x 60 Half Banner' );	
		$confAdsFormat[] = mosHTML::makeOption( '125x125_as', '125 x 125 Button' );	
		$confAdsFormat[] = mosHTML::makeOption( '120x240_as', '120 x 240 Vertical Banner' );	
		$confAdsFormat[] = mosHTML::makeOption( '300x250_as', '300 x 250 Medium rectangle' );	
		$confAdsFormat[] = mosHTML::makeOption( '250x250_as', '250 x 250 Square' );	
		$confAdsFormat[] = mosHTML::makeOption( '336x280_as', '336 x 280 Large Rectangle' );	
		$confAdsFormat[] = mosHTML::makeOption( '180x150_as', '180 x 150 Small Rectangle' );	
		$confAdsFormat[] = mosHTML::makeOption( '728x15_0ads_al', '728 x 15 Adlink 4 links' );	
		$confAdsFormat[] = mosHTML::makeOption( '468x15_0ads_al', '468 x 15 Adlink 4 links' );	
		$confAdsFormat[] = mosHTML::makeOption( '120x90_0ads_al', '120 x 90 Adlink 4 links' );	
		$confAdsFormat[] = mosHTML::makeOption( '160x90_0ads_al', '160 x 90 Adlink 4 links' );			
		$confAdsFormat[] = mosHTML::makeOption( '180x90_0ads_al', '180 x 90 Adlink 4 links' );	
		$confAdsFormat[] = mosHTML::makeOption( '200x90_0ads_al', '200 x 90 Adlink 4 links' );
		$confAdsFormat[] = mosHTML::makeOption( '728x15_0ads_al_s', '728 x 15 Adlink 5 links' );
		$confAdsFormat[] = mosHTML::makeOption( '468x15_0ads_al_s', '468 x 15 Adlink 5 links' );
		$confAdsFormat[] = mosHTML::makeOption( '120x90_0ads_al_s', '120 x 90 Adlink 5 links' );	
		$confAdsFormat[] = mosHTML::makeOption( '160x90_0ads_al_s', '160 x 90 Adlink 5 links' );	
		$confAdsFormat[] = mosHTML::makeOption( '180x90_0ads_al_s', '180 x 90 Adlink 5 links' );	
		$confAdsFormat[] = mosHTML::makeOption( '200x90_0ads_al_s', '200 x 90 Adlink 5 links' );		
		$listAdsFormat = mosHTML::selectList( $confAdsFormat, 'vr_ads_format', 'size="1"', 'value', 'text', $vr_ads_format );
		echo $listAdsFormat;			  
	  ?>
	  </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_POSITIONADSENSE ; ?></td>
      <td valign="top">
        <?php
			$confAdsPosition[] = mosHTML::makeOption( '0', _VRECOMMEND_TOP  );
			$confAdsPosition[] = mosHTML::makeOption( '1', _VRECOMMEND_BOTTOM );
			$confAdsPosition[] = mosHTML::makeOption( '2', _VRECOMMEND_BOTH );
			$listAdsPosition = mosHTML::selectList( $confAdsPosition, 'vr_ads_position', 'size="1"', 'value', 'text', $vr_ads_position );
			echo $listAdsPosition;	  
		   ?>
      </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_ALIGNMENT ; ?></td>
      <td valign="top">
        <?php
		$confAdsAlignment[] = mosHTML::makeOption( 'left', _VRECOMMEND_ADS_LEFT );		
		$confAdsAlignment[] = mosHTML::makeOption( 'right', _VRECOMMEND_ADS_RIGHT );	
		$confAdsAlignment[] = mosHTML::makeOption( 'center', _VRECOMMEND_ADS_CENTER );	
		$confAdsAlignment[] = mosHTML::makeOption( 'none', _VRECOMMEND_ADS_NONE );
		$listAdsAlignment = mosHTML::selectList( $confAdsAlignment, 'vr_ads_alignment', 'size="1"', 'value', 'text', $vr_ads_alignment );
		echo $listAdsAlignment . "&nbsp;&nbsp;" . mosToolTip( _VRECOMMEND_ADS_ALIGNMENT_DESC );			  
	   ?>
      </td>
    </tr>
	</table>
	<?php   
    $aclisttabs->endTab();
	$aclisttabs->startTab(_VRECOMMEND_PLUGIN,"Plugin-page");
  ?>
   <table width="100%" border="0" cellspacing="0" cellpadding="4" class="adminList">
    <tr class="row1">
      <td colspan="2"><strong><?php echo _VRECOMMEND_CHOOSEMODEOPERATING ; ?></strong></td>
    </tr>
    <tr class="row0">
      <td width="15%"><?php echo _VRECOMMEND_MODEOPERATING ; ?></td>
      <td width="85%">
	  <?php 
	    $vrmainmode[] = mosHTML::makeOption( '0', _VRECOMMEND_INDIVIDUALCOMMANDBOT );
		$vrmainmode[] = mosHTML::makeOption( '2', _VRECOMMEND_BOTH_INDIVIDUALTAG_AND_SECTIONBELOW );
        $vrmainmode[] = mosHTML::makeOption( '1', _VRECOMMEND_CHOOSEFROMSECTIONBELOW );
        $mc_vr_mainmode = mosHTML::selectList( $vrmainmode, 'vr_mainmode', 'class="inputbox" size="1"', 'value', 'text', $vr_mainmode );
        echo $mc_vr_mainmode;
		echo "&nbsp;" . mosToolTip( _VRECOMMEND_DEF_MODEOPERATING ); 	  
	  ?>
	  </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_SECTIONSAVAILABLE ; ?></td>
      <td valign="top">
	    <table width="100%"  border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td width="4%" valign="top"><select size="5" name="vrselections[]" class="inputbox" multiple="multiple">
              <?php		
        $seclistarray = explode (",", $vr_sectionlist);
		echo "<option value='0'";
		if (in_array ('0', $seclistarray)) echo " selected";
		echo ">" . _VRECOMMEND_STATICCONTENTS . "</option>";
        $database -> setQuery("SELECT id, title FROM #__sections WHERE published='1' ORDER BY title ASC");
        $dbsectionlist = $database -> loadObjectList();
        foreach ($dbsectionlist as $slrow){
          echo "<option value='$slrow->id' ";
          if (in_array ($slrow->id, $seclistarray)) echo "selected";
          echo ">$slrow->title</option>";
        }
      ?>
            </select></td>
            <td width="96%" valign="top">&nbsp;              
	<?php 	  
		echo mosToolTip( _VRECOMMEND_DEF_SECTIONSAVAILABLE );  	  
	  ?></td>
          </tr>
        </table>
	  </td>
    </tr>
    <tr class="row0">
      <td><?php echo _VRECOMMEND_ONLYONFULLTEXT ; ?></td>
      <td><?php  echo mosHTML::yesnoRadioList( 'vr_fulltext', 'class="inputbox"', $vr_fulltext ); ?></td>
    </tr>
    <tr class="row0">
      <td><?php echo _VRECOMMEND_STYLECSS ; ?></td>
      <td><input name="vr_styleclass" type="text" id="vr_styleclass" size="20" value="<?php echo $vr_styleclass ; ?>">&nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_STYLECSSDESCRIPTION ) ; ?></td>
    </tr>
  </table>
	<?php   
    $aclisttabs->endTab();
	$aclisttabs->startTab(_VRECOMMEND_MAIL,"Mail-page");
  ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="4" class="adminList">
    <tr class="row1">
      <td colspan="2" valign="top"><strong><?php echo _VRECOMMEND_MAILSETTINGS ; ?></strong></td>
      </tr>
    <tr class="row0">
      <td width="15%" valign="top"><?php echo _VRECOMMEND_MAILSUBJECT ; ?></td>
      <td width="85%" valign="top"><input name="vr_subject" type="text" id="vr_subject" size="60" value="<?php echo $vr_subject ; ?>">
	  </td>
    </tr>
    <tr class="row0">
      <td valign="top">
	  <?php echo _VRECOMMEND_MAILMESSAGEBODY ; ?><br /><br /><strong>
	  <?php echo _VRECOMMEND_AVAILABLE_TAGS ; ?></strong><br><br /><font color="green">
	  {sender_name}<br>	  
	  {friend_name}<br>
	  {sitename}<br>
	  {title_content_url}<br>
	  {custom_field_by_user}</font></td>
      <td valign="top">
	    <textarea name="vr_messagebody" cols="75" rows="20"><?php echo $vr_messagebody ; ?></textarea>
	  </td>
    </tr>
  </table>
  <?php
    $aclisttabs->endTab();
	$aclisttabs->startTab(_VRECOMMEND_MISCELLANEOUS,"Miscellaneous-page");
  ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="4" class="adminList">
    <tr class="row1">
      <td colspan="2" valign="top"><strong><?php echo _VRECOMMEND_AWARDS ; ?></strong></td>
      </tr>
    <tr class="row0">
      <td width="15%" valign="top"><?php echo _VRECOMMEND_POINTS_BY_SENT_MAIL ; ?></td>
      <td width="85%" valign="top"><input name="vr_numpointssend" type="text" id="vr_numpointssend" size="6" value="<?php echo $vr_numpointssend ; ?>">
      </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_POINTS_ON_POSITIVE_RECOMMEND ; ?></td>
      <td valign="top"><input name="vr_numpointsreply" type="text" id="vr_numpointsreply" size="6" value="<?php echo $vr_numpointsreply ; ?>">
      </td>
    </tr>
  </table>
  <?php
    $aclisttabs->endTab();
	$aclisttabs->startTab(_VRECOMMEND_TAB_GOOGLEADSENSE,"Adsense-page");
  ?>
  <table width="100%" border="0" cellspacing="0" cellpadding="4" class="adminList">
    <tr class="row1">
      <td colspan="2" valign="top"><strong><?php echo _VRECOMMEND_SETTINGSADSENSE ; ?></strong></td>
      </tr>
    <tr class="row0">
      <td width="15%" valign="top"><?php echo _VRECOMMEND_ADS_ID ; ?></td>
      <td width="85%" valign="top"><input name="vr_ads_clientID" type="text" id="vr_ads_clientID" size="30" value="<?php echo $vr_ads_clientID ; ?>">
	  &nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_ADS_ID_DESC ); ?>
	  </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_CHANNEL ; ?></td>
      <td valign="top"><input name="vr_ads_channel" type="text" id="vr_ads_channel" size="30" value="<?php echo $vr_ads_channel ; ?>">
	  &nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_ADS_CHANNEL_DESC ); ?>
	  </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_TYPE ; ?></td>
      <td valign="top">
        <?php
		$confAdsType[] = mosHTML::makeOption( '', _VRECOMMEND_ADS_TYPE_DEFAULTACCOUNT );		
		$confAdsType[] = mosHTML::makeOption( 'text', _VRECOMMEND_ADS_TYPE_TEXTONLY );	
		$confAdsType[] = mosHTML::makeOption( 'text_image', _VRECOMMEND_ADS_TYPE_TEXTANDIMAGE );	
		$confAdsType[] = mosHTML::makeOption( 'image', _VRECOMMEND_ADS_TYPE_IMAGEONLY );
		$listAdsType = mosHTML::selectList( $confAdsType, 'vr_ads_type', 'size="1"', 'value', 'text', $vr_ads_type );
		echo $listAdsType . "&nbsp;&nbsp;" . mosToolTip( _VRECOMMEND_ADS_TYPE_DESC );			  
	   ?>
	</td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_ALTERNATE ; ?></td>
      <td valign="top"><input name="vr_ads_alternate" type="text" id="vr_ads_alternate" size="12" value="<?php echo $vr_ads_alternate ; ?>">
        &nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_ADS_ALTERNATE_DESC ); ?> </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_ALTERNATE_COLOR ; ?></td>
      <td valign="top"><input name="vr_ads_alternate_color" type="text" id="vr_ads_alternate_color" value="<?php echo $vr_ads_alternate_color ; ?>" size="6" maxlength="6">        &nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_ADS_ALTERNATE_COLOR_DESC ); ?> </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_BORDER_COLOR ; ?></td>
      <td valign="top"><input name="vr_ads_border_color" type="text" id="vr_ads_border_color" value="<?php echo $vr_ads_border_color ; ?>" size="6" maxlength="6">
        &nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_INHEXWHITOUT ); ?> </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_BACKGROUND_COLOR ; ?></td>
      <td valign="top"><input name="vr_ads_background_color" type="text" id="vr_ads_background_color" value="<?php echo $vr_ads_background_color ; ?>" size="6" maxlength="6">
        &nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_INHEXWHITOUT ); ?> </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_LINK_COLOR ; ?></td>
      <td valign="top"><input name="vr_ads_link_color" type="text" id="vr_ads_link_color" value="<?php echo $vr_ads_link_color ; ?>" size="6" maxlength="6">
        &nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_INHEXWHITOUT ); ?> </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_URL_COLOR ; ?></td>
      <td valign="top"><input name="vr_ads_url_color" type="text" id="vr_ads_url_color" value="<?php echo $vr_ads_url_color ; ?>" size="6" maxlength="6">
        &nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_INHEXWHITOUT ); ?> </td>
    </tr>
    <tr class="row0">
      <td valign="top"><?php echo _VRECOMMEND_ADS_TEXT_COLOR ; ?></td>
      <td valign="top"><input name="vr_ads_text_color" type="text" id="vr_ads_text_color" value="<?php echo $vr_ads_text_color ; ?>" size="6" maxlength="6">
        &nbsp;&nbsp;<?php echo mosToolTip( _VRECOMMEND_INHEXWHITOUT ); ?> </td>
    </tr>
  </table>
  <?php
    $aclisttabs->endTab();
  	$aclisttabs->endPane();
?>
<input type="hidden" name="option" value="<?php echo $option; ?>" />
<input type="hidden" name="task" value="" />
</form>
	</td>
  </tr>
</table>	
    <?php	
	}
		
	////////////////////////////  TRACKING  /////////////////////////////
	function tracking( &$rows, &$pageNav, $search, $option, &$rowUsers, &$rowSend, &$rowContent ) {
	global $mainframe;	

	$stats = str_replace("{numvisitor}", $rowUsers,_VRECOMMEND_STATISTICS);
	$stats = str_replace("{numfriend}", $rowSend, $stats);
	$stats = str_replace("{numarticle}", $rowContent, $stats);	
	
		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th width="100%">
			<?php echo _VRECOMMEND_TRACKING . " :: " . $stats ; ?>
			</th>
			<td align="right">
			<?php echo _VRECOMMEND_FILTER; ?>:
			</td>
			<td>
			<input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" />
			</td>
		</tr>
		</table>
		
		<table class="adminlist" cellspacing="1">
		<thead>
		<tr>
			<th width="5">
			#
			</th>
			<th width="5" class="title">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th class="title" width="40%" align="left">
			<?php echo _VRECOMMEND_TITLE ; ?>
			</th>
			<th width="4%" class="title" align="center">
			<?php echo _VRECOMMEND_ID ; ?>
			</th>
		    <th width="15%" class="title" align="center"><?php echo _VRECOMMEND_RECOMMENDS_USERS ; ?></th>
		    <th width="5%" class="title" align="center"><?php echo _VRECOMMEND_REPLY ; ?></th>
		    <th width="5%" class="title" align="center">%</th>
		    <th width="20%" class="title" align="left"><?php echo _VRECOMMEND_LASTRECOMMEND ; ?></th>
		</tr>
		</thead>
		<tfoot>
		  <tr>
			<td colspan="8">
				<?php echo $pageNav->getListFooter(); ?>
			</td>
		  </tr>
		</tfoot>
		<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];			
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td>
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td>
				<?php echo mosHTML::idBox( $i, $row->contentid );?>				
				</td>
				<td>
					<a href="#show" onClick="return listItemTask('cb<?php echo $i;?>','showtracking')" title="<?php echo _VRECOMMEND_SHOWTRACKING; ?>">
					<?php echo $row->title; ?>
					</a>	
				</td>
				<td><div align="center"><?php echo $row->contentid; ?></div></td>
			    <td><div align="center"><?php echo "<strong>".$row->recommends . "</strong> / " . $row->sendings ; ?></div></td>
			    <td><div align="center"><?php echo $row->replys; ?></div></td>
			    <td><div align="center"><?php echo "<font color='blue'>" . HTML_VRC::percent($row->replys,$row->recommends,100) . "%</font>"; ?></div></td>
			    <td><div align="left"><?php echo $row->lastsending; ?></div></td>
			</tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</tbody>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="tracking" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
	}
	
	function percent($num,$total,$percent) 
	{ 
	  $nbr = ($num/$total) * $percent; 
	  return round($nbr); 
	} 
	
	////////////////////////////  SHOW DETAIL TRACKING  /////////////////////////////
	function showtracking( &$rows, &$pageNav, $search, $option, $idcontent ) {
	global $mainframe;
	
		mosCommonHTML::loadOverlib();
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th width="100%">
			<?php echo _VRECOMMEND_TRACKING ; ?> :: content ID <?php echo $idcontent ; ?>
			</th>
			<td align="right">
			<?php echo _VRECOMMEND_FILTER; ?>:
			</td>
			<td align="right">
			  <input type="text" name="search" value="<?php echo $search;?>" class="inputbox" onChange="document.adminForm.submit();" /></td>	
		  </tr>
		</table>
		
		<table class="adminlist" cellspacing="1">
		<thead>
		<tr>
			<th width="5">
			#
			</th>
			<th width="5" class="title">
			<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($rows); ?>);" />
			</th>
			<th width="2%" class="title"><?php echo _VRECOMMEND_ID ; ?></th>
		    <th width="10%" class="title" align="left"><?php echo _VRECOMMEND_DATE ; ?></th>
		    <th width="20%" class="title" align="left"><?php echo _VRECOMMEND_NAME ; ?></th>
		    <th width="2%" class="title" align="center"><?php echo _VRECOMMEND_SENDINGS ; ?></th>
		    <th width="25%" class="title" align="left"><?php echo _VRECOMMEND_MAILS ; ?></th>
		    <th width="3%" class="title" align="left"><?php echo _VRECOMMEND_REPLY ; ?></th>
		    <th width="25%" class="title" align="left"><?php echo _VRECOMMEND_POSITIVES_MAILS ; ?></th>
		    <th width="2%" class="title" align="left"><?php echo _VRECOMMEND_POINTS ; ?></th>
		    <th width="11%" class="title" align="left"><?php echo _VRECOMMEND_IP ; ?></th>
	      </tr>
		</thead>
		<tfoot>
		  <tr>
			<td colspan="11">
				<?php echo $pageNav->getListFooter(); ?>
			</td>
		  </tr>
		</tfoot>
		<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count($rows); $i < $n; $i++) {
			$row = $rows[$i];			
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td valign="top">
				<?php echo $pageNav->rowNumber( $i ); ?>
				</td>
				<td  valign="top">
				<?php echo mosHTML::idBox( $i, $row->id );?>				
				</td>
				<td valign="top"><div align="center"><?php echo $row->contentid; ?></div></td>
			    <td valign="top"><div align="left"><?php echo $row->date; ?></div></td>
			    <td valign="top"><div align="left"><strong><?php echo $row->name; ?></strong> <?php echo $row->mail_sender; ?>
				<?php
					if ( $row->userid ) {
					echo "<font color='red'>[" . _VRECOMMEND_REGISTERED . "]</font>";
					} else echo "<font color='green'>[" . _VRECOMMEND_GUEST . "]</font>";
				?>
				</div></td>
			    <td valign="top"><div align="center"><?php echo $row->num_send; ?></div></td>
			    <td valign="top"><div align="left"><?php echo str_replace( ";", "<br />", $row->mails); ?></div></td>
			    <td valign="top"><div align="center"><?php echo $row->num_reply; ?></div></td>
			    <td valign="top"><div align="left"><?php echo $row->mails_reply; ?></div></td>
			    <td valign="top"><div align="center"><?php echo $row->num_points; ?></div></td>
			    <td valign="top"><div align="left"><?php echo $row->ip; ?></div></td>
		    </tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</tbody>
		</table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="showtracking" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="idcontent" value="<?php echo $idcontent; ?>" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
		<?php
	}
	
	////////////////////////////  SHOW DETAIL TRACKING  /////////////////////////////
	function statstracking( &$rowsUsersMostActive, &$rowsMostPoints, &$rowsMostRecommend, $option, $all ) {
	global $mainframe, $mosConfig_live_site;
		
		?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
		<tr>
			<th width="100%">
			<?php echo _VRECOMMEND_TOP_10 ; ?> :: <?php echo _VRECOMMEND_MOST_ITEM_RECOMMENDED ; ?>
			</th>
			<td align="right">&nbsp;</td>
			<td align="right">&nbsp;</td>	
		  </tr>
		</table>
		<table class="adminlist" cellspacing="1">
		<tbody>
		<?php
		$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width=450,height=520,directories=no,location=no';
		$k = 0;
		for ($i=0, $n=count($rowsMostRecommend); $i < $n; $i++) {
			$row = $rowsMostRecommend[$i];			
			$link = $mosConfig_live_site . "/index2.php?option=com_content&task=view&id=".$row->cid;
			$preview_item = "<a href=\"" . $link . "\" target=\"_blank\" onclick=\"window.open('" . $link . "','win2','" . $status . "'); return false;\">";
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td valign="top" width="50%"><div align="left"><?php echo $preview_item . $row->title . "</a>" ; ?></div></td>
			    <td valign="top" width="50%"><div align="left"><?php echo $row->recommends . " " . _VRECOMMEND_STATS_RECOMMEND . "   <span class='smallgrey'>-  ( ". $row->reply ." "._VRECOMMEND_CONFIRMED." )</span>" ; ?></div></td>
		    </tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</tbody>
		</table>
		<br />
		<?php if ( $all ) { ?>
		<table class="adminheading">
		<tr>
			<th width="100%">
			<?php echo _VRECOMMEND_TOP_10 ; ?> :: <?php echo _VRECOMMEND_MOST_ACTIVE_REGISTERED_USERS ; ?>
			</th>
			<td align="right">&nbsp;</td>
			<td align="right">&nbsp;</td>	
		  </tr>
		</table>
		<table class="adminlist" cellspacing="1">
		<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count($rowsUsersMostActive); $i < $n; $i++) {
			$row = $rowsUsersMostActive[$i];			
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td valign="top" width="50%"><div align="left"><?php echo "<strong>". $row->name . "</strong> (" . $row->username .")"; ?></div></td>
			    <td valign="top" width="50%"><div align="left"><?php echo $row->numsend . " " . _VRECOMMEND_STATS_RECOMMEND ; ?></div></td>
		    </tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</tbody>
		</table>
		<br />
		<table class="adminheading">
		<tr>
			<th width="100%">
			<?php echo _VRECOMMEND_TOP_10 ; ?> :: <?php echo _VRECOMMEND_BEST_POINTS ; ?>
			</th>
			<td align="right">&nbsp;</td>
			<td align="right">&nbsp;</td>	
		  </tr>
		</table>
		<table class="adminlist" cellspacing="1">
		<tbody>
		<?php
		$k = 0;
		for ($i=0, $n=count($rowsMostPoints); $i < $n; $i++) {
			$row = $rowsMostPoints[$i];			
			?>
			<tr class="<?php echo "row$k"; ?>">
				<td valign="top" width="50%"><div align="left"><?php echo "<strong>". $row->name . "</strong> (" . $row->username .")"; ?></div></td>
			    <td valign="top" width="50%"><div align="left"><?php echo $row->numpoints . " " . _VRECOMMEND_POINTS ; ?></div></td>
		    </tr>
			<?php
			$k = 1 - $k;
		}
		?>
		</tbody>
		</table>
		<br />		
		<?php } ?>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="" />
		</form>
		<?php
	}
	
	function about( $option, $version ) {
	global $mosConfig_live_site;
	?>
		<form action="index2.php" method="post" name="adminForm">
		<table class="adminheading">
          <tr>
            <th width="100%"> <?php echo _VRECOMMEND_ABOUT ; ?> </th>
          </tr>
        </table>
		<table class="adminlist" cellspacing="1">
          <thead>
            <tr>
              <th width="100%">&nbsp; </th>
            </tr>
          </thead>
          <tfoot>
            <tr>
              <td><div align="center"></div></td>
            </tr>
          </tfoot>
          <tbody>
            <tr class="row0">
              <td><p><img src="<?php echo $mosConfig_live_site."/administrator/components/com_visualrecommend" ?>/images/visualrecommend.gif"><br>
                <br>                
      <strong>VisualRecommend</strong> is  a viral marketing tool used for recommend your articles to user-friendly.
      Mails tracking, statistics and export mailing-list to CSV file.<br>
      <strong><font color="red">Important !</font></strong> According to the country of use of this component, collecting and using peoples email addresses without their consent could get you into illegal terms. This component collects the senders email and the recipients email  and you have no way of knowing if this person wants to receive emails from you in the future. So just be very careful if you export the emails and plan to use them for marketing. This component must be used with responsibly!<br>
      This Software is provided without warranty or guarantee.      <br />
                  <br />
                  <strong>License</strong> : <br />
                  <!--Creative Commons License-->
                  <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/2.5/"><img alt="Creative Commons License" style="border-width: 0" src="http://i.creativecommons.org/l/by-nc-nd/2.5/88x31.png"/></a><br/>
                  This work is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/2.5/">Creative Commons Attribution-Noncommercial-No Derivative Works 2.5  License</a>.
                  <!--/Creative Commons License-->
                  <!-- <rdf:RDF xmlns="http://web.resource.org/cc/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#" xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#">
	<Work rdf:about="">
		<license rdf:resource="http://creativecommons.org/licenses/by-nc-nd/2.5/" />
	</Work>
	<License rdf:about="http://creativecommons.org/licenses/by-nc-nd/2.5/"><permits rdf:resource="http://web.resource.org/cc/Reproduction"/><permits rdf:resource="http://web.resource.org/cc/Distribution"/><requires rdf:resource="http://web.resource.org/cc/Notice"/><requires rdf:resource="http://web.resource.org/cc/Attribution"/><prohibits rdf:resource="http://web.resource.org/cc/CommercialUse"/></License></rdf:RDF> -->
                  <br />
                  <strong>Author</strong> : Bernard Gilly<br />
                  <strong>Website</strong> : <a href="http://www.visualclinic.fr" target="_blank">www.visualclinic.fr</a><br />
                  <strong>Version</strong> <?php echo $version ; ?><br>
                  <br>
                  <strong>Vote &amp; Review</strong> : <br>
                  If you find my free stuff useful, why not vote and review this component on official extensions Joomla.org :<br> 
                  <a href="http://extensions.joomla.org/component/option,com_mtree/task,viewowner/user_id,2316/Itemid,35/" target="_blank">http://extensions.joomla.org/component/option,com_mtree/task,viewowner/user_id,2316/Itemid,35/ </a><br>
                  <br>
                  <strong>Donate to VisualRecommend </strong>:<br>
                  You can send us a <a href="http://www.visualclinic.fr/support.html" target="_blank">donation</a> and thus support the VisualRecommend further development.                  <br>
                </p>
              </td>
            </tr>
          </tbody>
        </table>	
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="about" />
		<input type="hidden" name="boxchecked" value="0" />
		<input type="hidden" name="hidemainmenu" value="0">
		</form>
	<?php
	}
	
 }
?>
