<?php
/**
 * SEF module for Joomla! content plugin
 * Based on original 404SEFx code 
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}  
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_lang, $mosConfig_absolute_path, $sh_LANG, $sefConfig, $database, $mainframe;  

// V 1.2.4.m must comply with translation restrictions
$shLangName = empty($lang) ? $mosConfigLang : shGetNameFromIsoCode( $lang);
$shLangIso = (shTranslateUrl($option, $shLangName)) ? 
  (isset($lang) ? $lang : shGetIsoCodeFromName( $mosConfig_lang))
                                       : (isset($GLOBALS['mosConfig_defaultLang']) ? 
                                             shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang'])
                                           : shGetIsoCodeFromName( $mosConfig_lang));

$title = array();
$dosef = true;
$shItemidString = '';
                                           
static $shbs = null, $shbc = null, $shgbs = null;
//echo '$shLangIso = '.$shLangIso.'<br />';                                           
// load the Language File
$shLangIso = shLoadPluginLanguage( 'com_content', $shLangIso, '_COM_SEF_SH_CREATE_NEW');
//echo '$shLangIso 2= '.$shLangIso.'<br />';  
// 1.2.4.q this is content item, so let's try to improve missing Itemid handling
// retrieve section id to know whether this static or not
//echo '$shLangName plugin = '.$shLangName.'<br />';
//echo '$string plugin = '.$string.'<br />';
//echo '$lang = '.$lang.'<br />';
//echo '$task = '.$task.'<br />';
//echo '$sectionid = '.$sectionid.'<br />';
//echo '$id = '.$id.'<br />';
//echo '$Itemid 1= '.$Itemid.'<br />';
//echo '$shCurrentItemid 1= '.$shCurrentItemid.'<br />';
$shHomePageFlag = false;
if ((empty($Itemid) || ($Itemid == 99999999)) && !empty($task) && ($task == 'view')) {
  if (empty($sectionid)) {
    $query = 'SELECT sectionid from #__content WHERE id = '.$id;
    $database->setQuery($query);
    $shSectionId = $database->loadResult();
  } else $shSectionId = $sectionid;  
//echo '$shSectionId = '.$shSectionId.'<br />';  
  // retrieve Itemid
  if ( !empty($shSectionId) ) {  // has section, so regular content !!! we need to cache this !!
    if (!isset($shbs)) $shbs	= $mainframe->getBlogSectionCount();
	  if (!isset($shbc)) $shbc	= $mainframe->getBlogCategoryCount();
	  if (!isset($shgbs)) $shgbs	= $mainframe->getGlobalBlogSectionCount();
//echo '$bs = '.$bs.'<br />';
//echo '$bc = '.$bc.'<br />';
//echo '$gbs = '.$gbs.'<br />';
	  $shItemid = $mainframe->getItemid( $id, 0, 1, $shbs, $shbc, $shgbs );
	  //echo 'shItemid getitemid = '.$shItemid.'<br />';
  } else {  // does not have section, so static
	  $query = "SELECT id"
    	. "\n FROM #__menu"
  		. "\n WHERE type = 'content_typed'"
  		. "\n AND componentid = " . $id
  		;
  	$database->setQuery( $query );
  	$shItemid = $database->loadResult();
//echo 'shItemid selec id = '.$shItemid.'<br />';
  }
  // V 1.2.4.q last possibility : content item is only displayed through com_frontpage
  if (empty($shItemid)) {
    $query = 'SELECT count(content_id) from #__content_frontpage WHERE content_id = '.$id;
    $database->setQuery($query);
    $isOnFrontPage = $database->loadResult();
    //echo '$isOnFrontPage = '.$isOnFrontPage.'<br />';
    if (!empty($isOnFrontPage)) {  // it is on frontpage, let's find out about com_frontpage Itemid
      $query = 'SELECT id,link FROM #__menu WHERE link LIKE "%com_frontpage%"'; // we don't mind if it's not published
      $database->setQuery($query, 0, 1);
      $database->loadObject($shComFrontpage);
      if (!empty($shComFrontpage)) {      // if on frontpage, let's see if com_frontpage 
        global $shHomeLink;               //is actually frontpage
        //echo '$shHomeLink = '.$shHomeLink.'<br />';
        //echo '$shComFrontpage->link = '.$shComFrontpage->link.'<br />';
        //echo '$GLOBALS[ mosConfig_mbf_content ] = '.$GLOBALS[ 'mosConfig_mbf_content' ].'<br />';
        //echo '$GLOBALS[ mosConfig_defaultLang ] = '.$GLOBALS[ 'mosConfig_defaultLang' ].'<br />';
        //echo '$shLangIso 3 = '.$shLangIso.'<br />';
        //echo '$shLangName = '.$shLangName.'<br />';
        //echo '$lang = '.$lang.'<br />';
        if (strpos($shHomeLink, 'com_frontpage') === false) {
          if (empty($GLOBALS[ 'mosConfig_mbf_content' ])
              || (($GLOBALS['mosConfig_defaultLang'] == $shLangName)))
            $string = '';
          else $string = $shLangIso;
          $shHomePageFlag = true;
        } else
          $shItemid =  $shComFrontpage->id;  // content is in com_frontpage, but com_frontpage is not home
          
      }
    }
  }
  // integrate found Itemid
  if (!empty($shItemid)) {
    $string .= '&Itemid='.$shItemid; ;  // append current Itemid 
    $Itemid = $shItemid; 
    shAddToGETVarsList('Itemid', $Itemid); // V 1.2.4.m
  }
}  

$shHomePageFlag = !$shHomePageFlag ? shIsHomepage ($string): $shHomePageFlag;
//if ($shHomePageFlag) die();

//echo '$string = '.$string.'<br />';
if (!$shHomePageFlag) {  // we may have found that this is homepage, so we msut return an empty string
// do something about that Itemid thing
if (eregi('Itemid=[0-9]+', $string) === false) { // if no Itemid in non-sef URL
  //global $Itemid;
  if ($sefConfig->shInsertGlobalItemidIfNone && !empty($shCurrentItemid)) {
    $string .= '&Itemid='.$shCurrentItemid; ;  // append current Itemid 
    $Itemid = $shCurrentItemid; 
    shAddToGETVarsList('Itemid', $Itemid); // V 1.2.4.m
  }  
  if ($sefConfig->shInsertTitleIfNoItemid)
  	$title[] = $sefConfig->shDefaultMenuItemName ? $sefConfig->shDefaultMenuItemName : getMenuTitle($option, (isset($task) ? @$task : null), $shCurrentItemid, null, $shLangName );  // V 1.2.4.q added forced language
  $shItemidString = $sefConfig->shAlwaysInsertItemid ? 
    _COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX.$sefConfig->replacement.$shCurrentItemid
    : '';
} else {  // if Itemid in non-sef URL
  $shItemidString = $sefConfig->shAlwaysInsertItemid ? 
    _COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX.$sefConfig->replacement.$Itemid
    : '';
  if ($sefConfig->shAlwaysInsertMenuTitle){
    //global $Itemid; V 1.2.4.g we want the string option, not current page !
    if ($sefConfig->shDefaultMenuItemName)
      $title[] = $sefConfig->shDefaultMenuItemName;// V 1.2.4.q added force language
    elseif ($menuTitle = getMenuTitle($option, (isset($task) ? @$task : null), $Itemid, '',$shLangName )) {
      //echo 'Menutitle = '.$menuTitle.'<br />';
      if ($menuTitle != '/') $title[] = $menuTitle;
    }  
  }  
}  
// V 1.2.4.m 
shRemoveFromGETVarsList('option');
shRemoveFromGETVarsList('lang');  
shRemoveFromGETVarsList('Itemid');
if (isset($limit))
  shRemoveFromGETVarsList('limit');  
if (isset($limitstart))
  shRemoveFromGETVarsList('limitstart');  

$task = isset($task) ? @$task : null; 
switch ($task) {
	case 'archivecategory':
	case 'archivesection' :
	  $dosef = false;
	break;
	case 'new' :
	  $title[] = $sh_LANG[$shLangIso]['_COM_SEF_SH_CREATE_NEW'];
	  if (!empty($sectionid)) {
      $q = 'SELECT id, title FROM #__sections WHERE id = '.$sectionid;
      $database->setQuery($q);
      if (shTranslateUrl($option, $shLangName)) // V 1.2.4.m
        $database->loadObject( $sectionTitle);
      else $database->loadObject( $sectionTitle, false);
      if ($sectionTitle) {
        $title[] = $sectionTitle->title;
        shRemoveFromGETVarsList('sectionid');
      }  
    }
	  shRemoveFromGETVarsList('task');
	break;
	
	default:
	  // V 1.2.4.j 2007/04/11 : numerical ID, on some categories only
	  if ($sefConfig->shInsertNumericalId && isset($sefConfig->shInsertNumericalIdCatList) 
         && !empty($id) && ($task == 'view')) {
      
      $q = 'SELECT id, catid, created FROM #__content WHERE id = '.$id;
      $database->setQuery($q);
      if (shTranslateUrl($option, $shLangName)) // V 1.2.4.m
        $database->loadObject( $contentElement);
      else $database->loadObject( $contentElement, false);  
      if ($contentElement) {
        $foundCat = array_search($contentElement->catid, $sefConfig->shInsertNumericalIdCatList);
        if (($foundCat !== null && $foundCat !== false) 
            || ($sefConfig->shInsertNumericalIdCatList[0] == ''))  { // test both in case PHP < 4.2.0
          $shTemp = explode(' ', $contentElement->created);
          $title[] = str_replace('-','', $shTemp[0]).$contentElement->id;
	      } 
      }
    }
    
    // V 1.2.4.k 2007/04/25 : if activated, insert edition id and name from iJoomla magazine
    if (!empty($ed) && $sefConfig->shActivateIJoomlaMagInContent && $id && ($task == 'view')) {
      $q = 'SELECT id, title FROM #__magazine_categories WHERE id = '.$ed;
      $database->setQuery($q);
      if (shTranslateUrl($option, $shLangName)) // V 1.2.4.m
        $database->loadObject( $issueName, false);
      else $database->loadObject( $issueName);  
      if ($issueName) {
        $title[] = ($sefConfig->shInsertIJoomlaMagIssueId ? $ed.$sefConfig->replacement:'')
          .$issueName->title;
      } 
      shRemoveFromGETVarsList('ed');
    }
    // end of edition id insertion
    //$shTemp = sef_404::getContentTitles($task,$id, $Itemid, $shLangName);
    //var_dump($shTemp);
    //echo 'Ttitle<br />';
    //var_dump($title);
    //echo '<br />';
		if (!empty($title))
		  // V 1.2.4.m : we now pass Itemid to getContentTitles(), so as to be able to find menu item name
		  // if blogcategory with several categories (because we don't know which category name to use)
		  $title = array_merge($title, sef_404::getContentTitles($task,$id, $Itemid, $shLangName)); // V 1.2.4.q added forced language
		else $title = sef_404::getContentTitles($task,$id,$Itemid, $shLangName); // V 1.2.4.q added forced language
		  //echo 'Itemid = '.$Itemid.'<br />';
		  //echo 'task   = '.$task.'<br />';
		if ((@$task == "view") && !empty($sefConfig->suffix)) {
				$title[count($title)-1] .= $sefConfig->suffix;
			}
			else {
				$title[] = '/';
			}
		// V 1.2.4.q
	  shRemoveFromGETVarsList('task');
    shRemoveFromGETVarsList('id');
    if (!empty($sectionid))
      shRemoveFromGETVarsList('sectionid');  // V 1.2.4.m
    if (!empty($catid))
      shRemoveFromGETVarsList('catid');   // V 1.2.4.m
	}
	
if ($dosef){
  if (!empty($shItemidString))
    $title[] = $shItemidString; // V 1.2.4.m
  // stitch back additional parameters, not sef-ified
	$shAppendString .= shGETGarbageCollect();  // add automatically all GET variables that had not been used already
  if (!empty($shAppendString)) 
    $shAppendString = '?'.ltrim( $shAppendString, '&'); // don't add to $string, otherwise it will be stored in the DB 
	$string = sef_404::sefGetLocation( shRebuildNonSefString( $string), $title, null, (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), (isset($shLangName) ? @$shLangName : null));
}	
} else { // this is multipage homepage
  $title[] = '/';
  $string = sef_404::sefGetLocation( $string, $title, null, (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), (isset($shLangName) ? @$shLangName : null));
}  
?>
