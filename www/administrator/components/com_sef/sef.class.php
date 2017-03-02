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

/**
* @package Mambo_4.5.1
*/

class mosSEF extends mosDBTable
{
	/** @var int */
	var $id		= null;
	/** @var int */
	var $cpt	= null;
	/** @var string */
	var $oldurl	= null;
	/** @var string */
	var $newurl	= null;
	/** @var tinyint */
	/** @var date */
	var $dateadd	= null;
	
	function mosSEF( &$_db ) {
		$this->mosDBTable( '#__redirection', 'id', $_db );
	}
	
	function check() {
        //initialize
        $this->_error = null;
        $this->oldurl = trim($this->oldurl);
        $this->newurl = trim($this->newurl);
        // check for valid URLs
        if (($this->oldurl == '')||($this->newurl == '')){
            $this->_error .= _COM_SEF_EMPTYURL;
            return false;
        }
        if (eregi("^\/", $this->oldurl)) {
            $this->_error .= _COM_SEF_NOLEADSLASH;
        }
        if ((eregi("^index.php", $this->newurl)) === false ) {
            $this->_error .= _COM_SEF_BADURL;
        }
        if (is_null($this->_error)) {
	        // check for existing URLS
	        $this->_db->setQuery( "SELECT id FROM #__redirection WHERE `oldurl` LIKE '".$this->oldurl."'");
	        $xid = intval( $this->_db->loadResult() );
	        if ($xid && $xid != intval( $this->id )) {
	            $this->_error = _COM_SEF_URLEXIST;
	            return false;
	        }
	        return true;
	   }else{
	   	 return false;
	   }
	}
}

class SEFConfig {

  /* string,  version number */
	var $version = '1.2.4.q - BETA - <a href="http://extensions.siliana.net">extensions.Siliana.net</a>';
	/* boolean, is 404 SEF enabled  */
	var $Enabled = true;
	/* char,  Character to use for url replacement */
	var $replacement = '-';
	/* char,  Character to use for page spacer */
	var $pagerep = '-';
	/* strip these characters */
	var $stripthese = ',|~|!|@|%|^|*|(|)|+|<|>|:|;|{|}|[|]|---|--';
	/* characters replacement table v 1.2.4.f April 4, 2007*/
	var $shReplacements = 'Š|S, Œ|O, Ž|Z, š|s, œ|oe, ž|z, Ÿ|Y, ¥|Y, µ|u, À|A, Á|A, Â|A, Ã|A, Ä|A, Å|A, Æ|A, Ç|C, È|E, É|E, Ê|E, Ë|E, Ì|I, Í|I, Î|I, Ï|I, Ð|D, Ñ|N, Ò|O, Ó|O, Ô|O, Õ|O, Ö|O, Ø|O, Ù|U, Ú|U, Û|U, Ü|U, Ý|Y, ß|s, à|a, á|a, â|a, ã|a, ä|a, å|a, æ|a, ç|c, è|e, é|e, ê|e, ë|e, ì|i, í|i, î|i, ï|i, ð|o, ñ|n, ò|o, ó|o, ô|o, õ|o, ö|o, ø|o, ù|u, ú|u, û|u, ü|u, ý|y, ÿ|y, ß|ss';
	/* string,  suffix for "files" */
	var $suffix = '.html';
	/* string,  file to display when there is none */
  var $addFile = '';
	/* trims friendly characters from where they shouldn't be */
	var $friendlytrim = '-|.';
	/* string,  page text */
	var $pagetext = 'Page-%s';
	/* boolean, convert url to lowercase */
	var $LowerCase = false;
	/* boolean, include the section name in url */
	var $ShowSection = false;
	/* boolean, exclude the category name in url */
  var $ShowCat = true;
	/* boolean, use the title_alias instead of the title */
	var $UseAlias = true;
	/* int, id of #__content item to use for static page */
	var $page404 = 0;
	/* Array, contains predefined components. */
	var $predefined = array(
	   	//'contact',
	   	'frontpage',
	   	//'login',
	   	'newsfeeds',
	   	//'search',
	   	'sef',
	   	'weblinks'
	   	);
	/* Array, contains components 404 SEF will ignore. */
	var $skip = array();
	/* Array, contains components 404 SEF will not add to the DB.
	 * default style URLs will be generated for these components instead
	 */
	var $nocache = array('events');
	// shumisha : additional parameters
	/* Array, contains components 404 SEF will override their own sef_ext file if it has its own plugin. */
	var $shDoNotOverrideOwnSef = array();
	/* boolean,  true (default) to log 404 errors to DB, false otherwise  */
  var $shLog404Errors = true;
	/* boolean,  true (default) to use in mem cache, false to disable  */
  var $shUseURLCache = true;
  /* integer, max number of URL couple (sef + non-sef url) allowed in cache */
  var $shMaxURLInCache = 10000;
  /* boolean,  true (default) to translate texts in URL */
  var $shTranslateURL = true;
  /* boolean,  true (default) will always insert language iso code in URL (for other than default language) */
  var $shInsertLanguageCode = true;
  /* Array, contains components sh404SEF will NOT translate URLs */
	var $notTranslateURLList = array();  // V 1.2.4.m
	/* Array, contains components sh404SEF will NOT insert iso code in URL */
	var $notInsertIsoCodeList = array();
  // cache management
  /* boolean, true if insert Itemid of menu item is none exists */
  var $shInsertGlobalItemidIfNone = true;
  /* boolean, if true insert title of menu item if no Itemid exists for the URL*/
  var $shInsertTitleIfNoItemid = false;
  /* boolean, true if always insert title of menu item. URL Itemid is used, if any, or menu item title*/
  var $shAlwaysInsertMenuTitle= false;
  /* boolean, true if always append Itemid of non-sef URL (or of current menu item if none) to SEF URL */
  var $shAlwaysInsertItemid= false; // v 1.2.4.f
  /* string, default menu name, to be used if $shAlwaysInsertMenuTitle is true, to override menu title */
  var $shDefaultMenuItemName = '';
  /* boolean, if true, Getvars not used in URl will be reappend to it  */
  var $shAppendRemainingGETVars = true;
  
  // virtuemart management
  /* boolean, true if always insert title of shop menu item */
  var $shVmInsertShopName= true;  
  /* string, default menu name, to be used if $shVmInsertShopName is true, to override menu title */
  var $shShopName = '';
  /* boolean, if true, product ID will be prepended to product name */
  var $shInsertProductId = false;  
  /* boolean, if true, product sku will be used instead of name */
  var $shVmUseProductSKU = false; 
  /* boolean, if true, product Manufacturer name will be included in URL */
  var $shVmInsertManufacturerName = false;
  /* boolean, if true, product if will be prepended to manufacturer name */
  var $shInsertManufacturerId = false;
  /* integer, if 0, no categories will be inserted in URL for a product
              if 1, only 'last' category will be inserted in URL
              if 2, all nested categories will be inserted in URL */
  var $shVMInsertCategories = 1;
  
  /* boolean, if true, an additional text will be appended to sef URl when browsing categories
  * ie : .../product_cat/view-all-products.html VS .../product_cat/     */
  var $shVmAdditionalText = true;
  /* boolean, if true, a flypage name will be inserted in URL     */
  var $shVmInsertFlypage = true;
  
  /* boolean, if true, category id will be prepended to category name */
  var $shInsertCategoryId = false;
  /* boolean, if true, numerical id will be prepended to URL, for inclusion in Googlenews  */
  var $shInsertNumericalId = false;
  /* text, list of categories of content to which numerical id should be applied  */
  var $shInsertNumericalIdCatList = '';
  /* boolean, if true, non-sef URL like index.php?option=com_content&task=view&id=12&Itemid=2 will be 301-redirected to their sef equivalent */
  var $shRedirectNonSefToSef = true; 
  /* boolean, if true, Joomla sef URL like /content/view/12/61 will be 301-redirected to their sef equivalent */
  var $shRedirectJoomlaSefToSef = true; 
  /* string, should be set to SSL secure URL of site if any used. No trailing / */
  var $shConfig_live_secure_site = '';
  /* boolean, if true, ed non-sef parameter will be interpreted as a iJoomla param in com_content plugin  */
  var $shActivateIJoomlaMagInContent = true;
  /* boolean, if true, issue id of iJoomla magazine will be prepended to category name */
  var $shInsertIJoomlaMagIssueId = false;
  /* boolean, if true, magazine name will be prepended to all URL */
  var $shInsertIJoomlaMagName = true;
  /* string, magazine name to be used instead of menu name of magazine */
  var $shIJoomlaMagName = '';
  /* boolean, if true, magazine id will be inserted before magazine title */
  var $shInsertIJoomlaMagMagazineId = false;
  /* boolean, if true, article id will be inserted before article title */
  var $shInsertIJoomlaMagArticleId = false;
  
  
  /* boolean, if true, name of menu item leading to Community builder will be prepended to all URL */
  var $shInsertCBName = false;
  /* string, default name to be used instead of menu name of CB */
  var $shCBName = '';
  /* boolean, if true, user name will be inserte to all URL wher appropriate. Warning : this will
  *  increase DB space used? Normally user id is still passed as a GET param (ie ...?user=245)   
  *  to save space and increase speed  */
  var $shCBInsertUserName = false;
  /* boolean, if true, id of user will be prepended to its name when previous option is activated
  *  in case two users have the same name */
  var $shCBInsertUserId = true;
  /* boolean, if true user pseudo will be used instead of name */
  var $shCBUseUserPseudo = true;
  
  /* integer, default value for Itemid when using lettermand newsletter component */
  var $shLMDefaultItemid = 0;
  
  /* boolean, if true, default name for board will be prepended to URL */
  var $shInsertFireboardName = true;
  /* string, default name for Fireboard forum if previous param is true. If empty, menu element 
  /* name will be used */
  var $shFireboardName = '';
  /* boolean, if true name of forum category will be inserted in URL */
  var $shFbInsertCategoryName = true;
  /* boolean, if true, Category id will be prepended to category name, in case 2 categories have same name */
  var $shFbInsertCategoryId = false;
  /* boolean, if true, message subject will be inserted in URL */
  var $shFbInsertMessageSubject = true;
  /* boolean, if true message id will be prepended to subject, in case 2 messages have same subject */
  var $shFbInsertMessageId = true;

  /* boolean, if true, url will be urlencoded, needed for some non-latin languages */
  var $shEncodeUrl = false;  
  
  /* boolean, if true, Itemid from url on homepage with com_content will be removed, so that com_content plugin
  *  can try guess amore appropriate one  */
  var $guessItemidOnHomepage = true; // V 1.2.4.q
  // V 1.2.4.q : added param to force non-sef if https, as we are not through with some shared ssl servers!
  var $shForceNonSefIfHttps = false;
    
  // compatiblity variables, for sef_ext files usage from OpenSef/SEf Advance
  var $encode_page_suffix = '';
  var $encode_space_char = '';
  var $encode_lowercase = '';
  var $encode_strip_chars = '';
  var $spec_chars_d;
  var $spec_chars;
  
	function SEFConfig() {
	
	GLOBAL $sef_config_file;
		if (file_exists($sef_config_file)) {
			include($sef_config_file);
		}
    // shumisha : 2007-04-01 version was missing ! 
    if (isset($version))		$this->version		= $version;
    // shumisha : 2007-04-01 new parameters ! 
    if (isset($shUseURLCache))		$this->shUseURLCache		= $shUseURLCache;
    // shumisha : 2007-04-01 new parameters ! 
    if (isset($shMaxURLInCache))		$this->shMaxURLInCache		= $shMaxURLInCache;
    // shumisha : 2007-04-01 new parameters ! 
    if (isset($shTranslateURL))		$this->shTranslateURL		= $shTranslateURL;
    //V 1.2.4.m
    if (isset($shInsertLanguageCode))		$this->shInsertLanguageCode		= $shInsertLanguageCode;
    if (isset($notTranslateURLList))		$this->notTranslateURLList		= $notTranslateURLList;
    if (isset($notInsertIsoCodeList))		$this->notInsertIsoCodeList		= $notInsertIsoCodeList;
    
    // shumisha : 2007-04-03 new parameters ! 
    if (isset($shInsertGlobalItemidIfNone))	$this->shInsertGlobalItemidIfNone	= $shInsertGlobalItemidIfNone;
    if (isset($shInsertTitleIfNoItemid))	$this->shInsertTitleIfNoItemid	= $shInsertTitleIfNoItemid;
    if (isset($shAlwaysInsertMenuTitle))	$this->shAlwaysInsertMenuTitle	= $shAlwaysInsertMenuTitle;
    if (isset($shAlwaysInsertItemid))	$this->shAlwaysInsertItemid	= $shAlwaysInsertItemid;
    if (isset($shDefaultMenuItemName))	$this->shDefaultMenuItemName = $shDefaultMenuItemName;
    if (isset($shAppendRemainingGETVars))	$this->shAppendRemainingGETVars = $shAppendRemainingGETVars;
    if (isset($shVmInsertShopName))	$this->shVmInsertShopName = $shVmInsertShopName;
    
    if (isset($shShopName))	$this->shShopName = $shShopName;
    if (isset($shInsertProductId))	$this->shInsertProductId	= $shInsertProductId;
    if (isset($shVmUseProductSKU))	$this->shVmUseProductSKU	= $shVmUseProductSKU;
    if (isset($shVmInsertManufacturerName))		
      $this->shVmInsertManufacturerName = $shVmInsertManufacturerName;
    if (isset($shInsertManufacturerId))	$this->shInsertManufacturerId = $shInsertManufacturerId;
    if (isset($shVMInsertCategories))	$this->shVMInsertCategories= $shVMInsertCategories;
    if (isset($shVmAdditionalText))	$this->shVmAdditionalText= $shVmAdditionalText;
    if (isset($shVmInsertFlypage))	$this->shVmInsertFlypage= $shVmInsertFlypage;
    
    if (isset($shInsertCategoryId))	$this->shInsertCategoryId= $shInsertCategoryId;
    if (isset($shReplacements))	$this->shReplacements= $shReplacements;
    
    if (isset($shInsertNumericalId))	$this->shInsertNumericalId = $shInsertNumericalId;
    if (isset($shInsertNumericalIdCatList))	$this->shInsertNumericalIdCatList = $shInsertNumericalIdCatList;
    
    if (isset($shRedirectNonSefToSef))	$this->shRedirectNonSefToSef = $shRedirectNonSefToSef;
    if (isset($shRedirectJoomlaSefToSef))	$this->shRedirectJoomlaSefToSef = $shRedirectJoomlaSefToSef;
    if (isset($shConfig_live_secure_site))	
      $this->shConfig_live_secure_site = rtrim( $shConfig_live_secure_site, '/');
      
    if (isset($shActivateIJoomlaMagInContent))
     	$this->shActivateIJoomlaMagInContent = $shActivateIJoomlaMagInContent;
    if (isset($shInsertIJoomlaMagIssueId))
     	$this->shInsertIJoomlaMagIssueId = $shInsertIJoomlaMagIssueId;
    if (isset($shInsertIJoomlaMagName))
     	$this->shInsertIJoomlaMagName = $shInsertIJoomlaMagName;
    if (isset($shIJoomlaMagName))
     	$this->shIJoomlaMagName = $shIJoomlaMagName;
    if (isset($shInsertIJoomlaMagMagazineId))
     	$this->shInsertIJoomlaMagMagazineId = $shInsertIJoomlaMagMagazineId;
    if (isset($shInsertIJoomlaMagArticleId))
     	$this->shInsertIJoomlaMagArticleId = $shInsertIJoomlaMagArticleId;
     	
    if (isset($shInsertCBName))
     	$this->shInsertCBName = $shInsertCBName;
    if (isset($shCBName))
     	$this->shCBName = $shCBName;
    if (isset($shCBInsertUserName))
     	$this->shCBInsertUserName = $shCBInsertUserName;
    if (isset($shCBInsertUserId))
     	$this->shCBInsertUserId = $shCBInsertUserId;
    if (isset($shCBUseUserPseudo))
     	$this->shCBUseUserPseudo = $shCBUseUserPseudo; 	
     	
    if (isset($shLog404Errors))
     	$this->shLog404Errors = $shLog404Errors;
     	
    if (isset($shLMDefaultItemid))
     	$this->shLMDefaultItemid = $shLMDefaultItemid;  
     
    if (isset($shInsertFireboardName))
     	$this->shInsertFireboardName = $shInsertFireboardName;   
    if (isset($shFireboardName))
     	$this->shFireboardName = $shFireboardName;
    if (isset($shFbInsertCategoryName))
     	$this->shFbInsertCategoryName = $shFbInsertCategoryName;
    if (isset($shFbInsertCategoryId))
     	$this->shFbInsertCategoryId = $shFbInsertCategoryId;
    if (isset($shFbInsertMessageSubject))
     	$this->shFbInsertMessageSubject = $shFbInsertMessageSubject;
    if (isset($shFbInsertMessageId))
     	$this->shFbInsertMessageId = $shFbInsertMessageId;  
                  	
    if (isset($shDoNotOverrideOwnSef)) // V 1.2.4.m
     	$this->shDoNotOverrideOwnSef = $shDoNotOverrideOwnSef;   
         
    if (isset($shEncodeUrl)) // V 1.2.4.m
     	$this->shEncodeUrl = $shEncodeUrl;
            
    if (isset($guessItemidOnHomepage)) // V 1.2.4.q
     	$this->guessItemidOnHomepage = $guessItemidOnHomepage;
     	
    if (isset($shForceNonSefIfHttps))	// V 1.2.4.q
      $this->shForceNonSefIfHttps= $shForceNonSefIfHttps;
                   
    // shumisha end of new parameters
		if (isset($Enabled))		$this->Enabled		= $Enabled;
  	if (isset($replacement)) 	$this->replacement	= $replacement;
		if (isset($pagerep)) 		$this->pagerep		= $pagerep;
		if (isset($stripthese)) 	$this->stripthese 	= $stripthese;
		if (isset($friendlytrim)) 	$this->friendlytrim	= $friendlytrim;
		if (isset($suffix))			$this->suffix		= $suffix;
		if (isset($addFile)) 		$this->addFile 		= $addFile;
		if (isset($pagetext))		$this->pagetext		= $pagetext;
		if (isset($LowerCase))		$this->LowerCase	= $LowerCase;
		if (isset($ShowSection)) 	$this->ShowSection	= $ShowSection;
		if (isset($HideCat))		$this->HideCat		= $HideCat;
		if (isset($replacement)) 	$this->UseAlias		= $UseAlias;
		if (isset($UseAlias))		$this->page404		= $page404;
		if (isset($predefined))		$this->predefined	= $predefined;
		if (isset($skip))			$this->skip			= $skip;
		if (isset($nocache))		$this->nocache		= $nocache;
		if (isset($ShowCat)) 		$this->ShowCat 		= $ShowCat;
		
    // compatiblity variables, for sef_ext files usage from OpenSef/SEf Advance V 1.2.4.p
    $this->encode_page_suffix = '';// if using an opensef sef_ext, we don't let  them manage suffix
    $this->encode_space_char = $this->replacement;
    $this->encode_lowercase = $this->LowerCase;
    $this->encode_strip_chars = $this->stripthese;
    $shTemp = $this->shGetReplacements();
    foreach ($shTemp as $dest=>$source) {
      $this->spec_chars_d .= $dest.',';
      $this->spec_chars .= $source.',';
    }  
    rtrim($this->spec_chars_d, ',');
    rtrim($this->spec_chars, ',');
    //echo '<br />$this->spec_chars_d'.$this->spec_chars_d.'<br />';
    //echo '<br />$this->spec_chars'.$this->spec_chars.'<br />';
    //die();
	}
	
	function saveConfig($return_data=0, $eraseCache = 1) {
	
	GLOBAL $database, $sef_config_file, $mosConfig_absolute_path, $mosConfig_live_site;
		// when the config changes, we automatically purge the cache before we save.
		//V 1.2.4.q now we ask for confirmation 
		echo 'eraseCache dans class = '.$eraseCache.'<br />';
		if (!empty($eraseCache)) {
		  $query = "DELETE FROM #__redirection WHERE `dateadd` = '0000-00-00'";
		  $database->setQuery( $query );
		  if (!$database->query()) {
			  die( basename(__FILE__)."(line ".__LINE__ .") : ".$database->stderr(1)."<br />");
		  }
      // shumisha 2007-04-01 must also clear cache file:
      if (file_exists($mosConfig_absolute_path.'/components/com_sef/cache/shCacheContent.php'))
        unlink($mosConfig_absolute_path.'/components/com_sef/cache/shCacheContent.php');
    }    
		//build the data file
		$config_data = '<?php // config.sef.php : configuration file for sh404SEF
if (!defined(\'_VALID_MOS\')) die(\'Direct Access to this location is not allowed.\');'."\n";
		foreach ($this as $key=>$value) {
			if ($key != "0") {
				$config_data .= "\$$key = ";
				switch (gettype($value)) {
					case "boolean":
						$config_data .= ($value ? "true" : "false");
					break;
					case "string":
						$config_data .= "\"".addslashes($value)."\"";
					break;
					case "integer":
					case "double":
						$config_data .= strval($value);
					break;
					case "array";
						$datastring ='';
						foreach($value as $key2=>$data) {
							$datastring .= '"'.addslashes($data).'",';
						}
						$datastring = substr($datastring,0,-1);
						$config_data .= "array($datastring)";
						break;
					default:
						$config_data .= "null";
					break;
				}
			}
			$config_data .= ";\n";
		}
		$config_data .= '?'.'>';
		if ($return_data == 1) {
			return $config_data;
		}else{
			// write to disk
			//if (is_writable($sef_config_file)) {
				$trans_tbl = get_html_translation_table(HTML_ENTITIES);
				$trans_tbl = array_flip($trans_tbl);
				$config_data =strtr($config_data, $trans_tbl);
				$fd = fopen($sef_config_file, "w");
				if (fwrite($fd, $config_data, strlen($config_data)) === FALSE) {
       				$ret = 0;
   				}else{
   					$ret = 1;
   				}
				fclose($fd);
				// V 1.2.4.q : save copy of config file to other location for automatic recovering of config when upgrading
				$fd = fopen($mosConfig_absolute_path.'/media/sh404_upgrade_conf_'
                  .str_replace('/','_',str_replace('http://', '', $mosConfig_live_site)).'.php', "w");
				fwrite($fd, $config_data, strlen($config_data));
				fclose($fd);
			//}else{
			//	$ret = 0;
			//}
			return $ret;
		}
	}
	
    /**
     * Return array of URL characters to be replaced.
     * Copied from Artio Joomsef V 1.4.0
     *
     * @return array
     */
     
    function shGetReplacements()
    
    {
        // V 1.2.4.q : initialize variable
        static $shReplacements = null;
        if (isset($shReplacements)) return $shReplacements;
        $shReplacements = array();
        $items = explode(',', $this->shReplacements);
        foreach ($items as $item) {
          if (!empty($item)) {  // V 1.2.4.q better protection. Returns null array if empty
            @list($src, $dst) = explode('|', trim($item));
            $shReplacements[trim($src)] = trim($dst);
          }
        }
        return $shReplacements;
    }
    
	function set($var, $val) {
	
		if (isset($this->$var)) {
			$this->$var = $val;
			return true;
		}
		return false;
	}
	
	function version() {
	
		return $this->$version;
	}
}

// Net/Url.php From the PEAR Library (http://pear.php.net/package/Net_URL)
// +-----------------------------------------------------------------------+
// | Copyright (c) 2002-2004, Richard Heyes                                |
// | All rights reserved.                                                  |
// |                                                                       |
// | Redistribution and use in source and binary forms, with or without    |
// | modification, are permitted provided that the following conditions    |
// | are met:                                                              |
// |                                                                       |
// | o Redistributions of source code must retain the above copyright      |
// |   notice, this list of conditions and the following disclaimer.       |
// | o Redistributions in binary form must reproduce the above copyright   |
// |   notice, this list of conditions and the following disclaimer in the |
// |   documentation and/or other materials provided with the distribution.|
// | o The names of the authors may not be used to endorse or promote      |
// |   products derived from this software without specific prior written  |
// |   permission.                                                         |
// |                                                                       |
// | THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS   |
// | "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT     |
// | LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR |
// | A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT  |
// | OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, |
// | SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT      |
// | LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, |
// | DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY |
// | THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT   |
// | (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE |
// | OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.  |
// |                                                                       |
// +-----------------------------------------------------------------------+
// | Author: Richard Heyes <richard at php net>                            |
// +-----------------------------------------------------------------------+
//
// $Id: sef.class.php,v 1.5 2005/02/06 16:32:15 marlboroman_2k Exp $
//
// Net_URL Class
class Net_URL
{
    /**
    * Full url
    * @var string
    */
    var $url;
    /**
    * Protocol
    * @var string
    */
    var $protocol;
    /**
    * Username
    * @var string
    */
    var $username;
    /**
    * Password
    * @var string
    */
    var $password;
    /**
    * Host
    * @var string
    */
    var $host;
    /**
    * Port
    * @var integer
    */
    var $port;
    /**
    * Path
    * @var string
    */
    var $path;
    /**
    * Query string
    * @var array
    */
    var $querystring;
    /**
    * Anchor
    * @var string
    */
    var $anchor;
    /**
    * Whether to use []
    * @var bool
    */
    var $useBrackets;
    /**
    * PHP4 Constructor
    *
    * @see __construct()
    */
    function Net_URL($url = null, $useBrackets = true)
    {
        $this->__construct($url, $useBrackets);
    }
    /**
    * PHP5 Constructor
    *
    * Parses the given url and stores the various parts
    * Defaults are used in certain cases
    *
    * @param string $url         Optional URL
    * @param bool   $useBrackets Whether to use square brackets when
    *                            multiple querystrings with the same name
    *                            exist
    */
    function __construct($url = null, $useBrackets = true)
    {
        $HTTP_SERVER_VARS  = !empty($_SERVER) ? $_SERVER : $GLOBALS['HTTP_SERVER_VARS'];
        $this->useBrackets = $useBrackets;
        $this->url         = $url;
        $this->user        = '';
        $this->pass        = '';
        $this->host        = '';
        $this->port        = 80;
        $this->path        = '';
        $this->querystring = array();
        $this->anchor      = '';
        // Only use defaults if not an absolute URL given
        if (!preg_match('/^[a-z0-9]+:\/\//i', $url)) {
            $this->protocol    = (isset ($HTTP_SERVER_VARS['HTTPS']) ?
            						 (@$HTTP_SERVER_VARS['HTTPS'] == 'on' ? 'https' : 'http') : 'http');
            /**
            * Figure out host/port
            */
            if (!empty($HTTP_SERVER_VARS['HTTP_HOST']) AND preg_match('/^(.*)(:([0-9]+))?$/U', $HTTP_SERVER_VARS['HTTP_HOST'], $matches)) {
                $host = $matches[1];
                if (!empty($matches[3])) {
                    $port = $matches[3];
                } else {
                    $port = $this->getStandardPort($this->protocol);
                }
            }
            $this->user        = '';
            $this->pass        = '';
            $this->host        = !empty($host) ? $host : (isset($HTTP_SERVER_VARS['SERVER_NAME']) ? $HTTP_SERVER_VARS['SERVER_NAME'] : 'localhost');
            $this->port        = !empty($port) ? $port : (isset($HTTP_SERVER_VARS['SERVER_PORT']) ? $HTTP_SERVER_VARS['SERVER_PORT'] : $this->getStandardPort($this->protocol));
            $this->path        = !empty($HTTP_SERVER_VARS['PHP_SELF']) ? $HTTP_SERVER_VARS['PHP_SELF'] : '/';
            $this->querystring = isset($HTTP_SERVER_VARS['QUERY_STRING']) ? $this->_parseRawQuerystring($HTTP_SERVER_VARS['QUERY_STRING']) : null;
            $this->anchor      = '';
        }
        // Parse the url and store the various parts
        if (!empty($url)) {
            $urlinfo = parse_url($url);
            // Default querystring
            $this->querystring = array();
            foreach ($urlinfo as $key => $value) {
                switch ($key) {
                    case 'scheme':
                        $this->protocol = $value;
                        $this->port     = $this->getStandardPort($value);
                        break;
                    case 'user':
                    case 'pass':
                    case 'host':
                    case 'port':
                        $this->$key = $value;
                        break;
                    case 'path':
                        if ($value{0} == '/') {
                            $this->path = $value;
                        } else {
                            $path = dirname($this->path) == DIRECTORY_SEPARATOR ? '' : dirname($this->path);
                            $this->path = sprintf('%s/%s', $path, $value);
                        }
                        break;
                    case 'query':
                        $this->querystring = $this->_parseRawQueryString($value);
                        break;
                    case 'fragment':
                        $this->anchor = $value;
                        break;
                }
            }
        }
    }
    /**
    * Returns full url
    *
    * @return string Full url
    * @access public
    */
    function getURL()
    {
        $querystring = $this->getQueryString();
        $this->url = $this->protocol . '://'
                   . $this->user . (!empty($this->pass) ? ':' : '')
                   . $this->pass . (!empty($this->user) ? '@' : '')
                   . $this->host . ($this->port == $this->getStandardPort($this->protocol) ? '' : ':' . $this->port)
                   . $this->path
                   . (!empty($querystring) ? '?' . $querystring : '')
                   . (!empty($this->anchor) ? '#' . $this->anchor : '');
        return $this->url;
    }
    /**
    * Adds a querystring item
    *
    * @param  string $name       Name of item
    * @param  string $value      Value of item
    * @param  bool   $preencoded Whether value is urlencoded or not, default = not
    * @access public
    */
    function addQueryString($name, $value, $preencoded = false)
    {
        if ($preencoded) {
            $this->querystring[$name] = $value;
        } else {
            $this->querystring[$name] = is_array($value) ? array_map('rawurlencode', $value): rawurlencode($value);
        }
    }
    /**
    * Removes a querystring item
    *
    * @param  string $name Name of item
    * @access public
    */
    function removeQueryString($name)
    {
        if (isset($this->querystring[$name])) {
            unset($this->querystring[$name]);
        }
    }
    /**
    * Sets the querystring to literally what you supply
    *
    * @param  string $querystring The querystring data. Should be of the format foo=bar&x=y etc
    * @access public
    */
    function addRawQueryString($querystring)
    {
        $this->querystring = $this->_parseRawQueryString($querystring);
    }
    /**
    * Returns flat querystring
    *
    * @return string Querystring
    * @access public
    */
    function getQueryString()
    {
        if (!empty($this->querystring)) {
            foreach ($this->querystring as $name => $value) {
                if (is_array($value)) {
                    foreach ($value as $k => $v) {
                        $querystring[] = $this->useBrackets ? sprintf('%s[%s]=%s', $name, $k, $v) : ($name . '=' . $v);
                    }
                } elseif (!is_null($value)) {
                    $querystring[] = $name . '=' . $value;
                } else {
                    $querystring[] = $name;
                }
            }
            $querystring = implode(ini_get('arg_separator.output'), $querystring);
        } else {
            $querystring = '';
        }
        return $querystring;
    }
    /**
    * Parses raw querystring and returns an array of it
    *
    * @param  string  $querystring The querystring to parse
    * @return array                An array of the querystring data
    * @access private
    */
    function _parseRawQuerystring($querystring)
    {
        $parts  = preg_split('/[' . preg_quote(ini_get('arg_separator.input'), '/') . ']/', $querystring, -1, PREG_SPLIT_NO_EMPTY);
        $return = array();
        foreach ($parts as $part) {
            if (strpos($part, '=') !== false) {
                $value = substr($part, strpos($part, '=') + 1);
                $key   = substr($part, 0, strpos($part, '='));
            } else {
                $value = null;
                $key   = $part;
            }
            if (substr($key, -2) == '[]') {
                $key = substr($key, 0, -2);
                if (@!is_array($return[$key])) {
                    $return[$key]   = array();
                    $return[$key][] = $value;
                } else {
                    $return[$key][] = $value;
                }
            } elseif (!$this->useBrackets AND !empty($return[$key])) {
                $return[$key]   = (array)$return[$key];
                $return[$key][] = $value;
            } else {
                $return[$key] = $value;
            }
        }
        return $return;
    }
    /**
    * Resolves //, ../ and ./ from a path and returns
    * the result. Eg:
    *
    * /foo/bar/../boo.php    => /foo/boo.php
    * /foo/bar/../../boo.php => /boo.php
    * /foo/bar/.././/boo.php => /foo/boo.php
    *
    * This method can also be called statically.
    *
    * @param  string $url URL path to resolve
    * @return string      The result
    */
    function resolvePath($path)
    {
        $path = explode('/', str_replace('//', '/', $path));
        for ($i=0; $i<count($path); $i++) {
            if ($path[$i] == '.') {
                unset($path[$i]);
                $path = array_values($path);
                $i--;
            } elseif ($path[$i] == '..' AND ($i > 1 OR ($i == 1 AND $path[0] != '') ) ) {
                unset($path[$i]);
                unset($path[$i-1]);
                $path = array_values($path);
                $i -= 2;
            } elseif ($path[$i] == '..' AND $i == 1 AND $path[0] == '') {
                unset($path[$i]);
                $path = array_values($path);
                $i--;
            } else {
                continue;
            }
        }
        return implode('/', $path);
    }
    /**
    * Returns the standard port number for a protocol
    *
    * @param  string  $scheme The protocol to lookup
    * @return integer         Port number or NULL if no scheme matches
    *
    * @author Philippe Jausions <Philippe.Jausions@11abacus.com>
    */
    function getStandardPort($scheme)
    {
        switch (strtolower($scheme)) {
            case 'http':    return 80;
            case 'https':   return 443;
            case 'ftp':     return 21;
            case 'imap':    return 143;
            case 'imaps':   return 993;
            case 'pop3':    return 110;
            case 'pop3s':   return 995;
            default:        return null;
       }
    }
    /**
    * Forces the URL to a particular protocol
    *
    * @param string  $protocol Protocol to force the URL to
    * @param integer $port     Optional port (standard port is used by default)
    */
    function setProtocol($protocol, $port = null)
    {
        $this->protocol = $protocol;
        $this->port = is_null($port) ? $this->getStandardPort() : $port;
    }
}
?>
