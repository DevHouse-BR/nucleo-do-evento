<?php
/**
 * sh404SEF support for com_search component.
 * Yannick Gaultier (shumisha)
 * shumisha@gmail.com
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}
 */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_lang, 
       $sh_LANG;  // V 1.2.4.q

// V 1.2.4.m must comply with translation restrictions
$shLangName = empty($lang) ? $mosConfigLang : shGetNameFromIsoCode( $lang);
$shLangIso = (shTranslateUrl($option, $shLangName)) ? (isset($lang) ? $lang : shGetIsoCodeFromName( $mosConfig_lang))
                                       : (isset($GLOBALS['mosConfig_defaultLang']) ? 
                                             shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang'])
                                           : shGetIsoCodeFromName( $mosConfig_lang));
                                           
$shLangIso = shLoadPluginLanguage( 'com_search', $shLangIso, '_COM_SEF_SH_SEARCH');
$title = array();
$dosef = true;
$shItemidString = '';

  shRemoveFromGETVarsList('option');
  shRemoveFromGETVarsList('lang');  
  shRemoveFromGETVarsList('Itemid');
  shRemoveFromGETVarsList('task');
  if (!empty($limit))
    shRemoveFromGETVarsList('limit');
  shRemoveFromGETVarsList('limitstart'); // limitstart can be zero
  //$title[] = getMenuTitle($option, (isset($task) ? @$task : null));
	$title[] = $sh_LANG[$shLangIso]['_COM_SEF_SH_SEARCH'];
	$ordering = isset($ordering) ? @$ordering : null;
  switch ($ordering) {
    case 'newest'   : 
      $title[] =  $sh_LANG[$shLangIso]['_SEARCH_NEWEST'];
      shRemoveFromGETVarsList('ordering');
    break;  
	  case 'oldest' : 
    $title[] = $sh_LANG[$shLangIso]['_SEARCH_OLDEST'];;
      shRemoveFromGETVarsList('ordering');
    break;
	  case 'popular' : 
      $title[] = $sh_LANG[$shLangIso]['_SEARCH_POPULAR'];
      shRemoveFromGETVarsList('ordering');
    break;  
	  case 'alpha': 
    $title[] = $sh_LANG[$shLangIso]['_SEARCH_ALPHABETICAL'];
      shRemoveFromGETVarsList('ordering');
    break; 
	  case 'category':
      $title[] = $sh_LANG[$shLangIso]['_SEARCH_CATEGORY'];
      shRemoveFromGETVarsList('ordering'); 
    break;  
  }  
if($dosef){
  if (!empty($shItemidString))
    $title[] = $shItemidString; // V 1.2.4.m
  // stitch back additional parameters, not sef-ified
	$shAppendString .= shGETGarbageCollect();  // add automatically all GET variables that had not been used already
  if (!empty($shAppendString)) 
    $shAppendString = '?'.ltrim( $shAppendString, '&'); // don't add to $string, otherwise it will be stored in the DB 
	$string = sef_404::sefGetLocation( shRebuildNonSefString( $string), $title, null, (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), (isset($shLangName) ? @$shLangName : null));
}
  
?>
