<?php
/**
 * SEF module for Joomla! com_registration plugin
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}  
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_lang, $mosConfig_absolute_path, $sh_LANG, $sefConfig;  

// V 1.2.4.m must comply with translation restrictions
$shLangName = empty($lang) ? $mosConfigLang : shGetNameFromIsoCode( $lang);
$shLangIso = (shTranslateUrl($option, $shLangName)) ? (isset($lang) ? $lang : shGetIsoCodeFromName( $mosConfig_lang))
                                       : (isset($GLOBALS['mosConfig_defaultLang']) ? 
                                             shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang'])
                                           : shGetIsoCodeFromName( $mosConfig_lang));

/*echo '$task='.$task.'<br />';
echo '$Itemid='.$Itemid.'<br />';
echo '$Option='.$option.'<br />';   
echo '$shLangIso1='.$shLangIso.'<br />';*/                                        
$shLangIso = shLoadPluginLanguage( 'com_registration', $shLangIso, '_COM_SEF_SH_LOST_PASSWORD');
/*echo '$shLangIso='.$shLangIso.'<br />';
echo '$shLangname='.$shLangName.'<br />'; */
$title = array();
$dosef = true;
$shItemidString = '';
       
// do something about that Itemid thing
if (eregi('Itemid=[0-9]+', $string) === false) { // if no Itemid in non-sef URL
  //global $Itemid;
  if ($sefConfig->shInsertGlobalItemidIfNone && !empty($shCurrentItemid)) {
    $string .= '&Itemid='.$shCurrentItemid;  // append current Itemid
    $Itemid = $shCurrentItemid;
    shAddToGETVarsList('Itemid', $Itemid); // V 1.2.4.m
  }   
  if ($sefConfig->shInsertTitleIfNoItemid)
  	$title[] = $sefConfig->shDefaultMenuItemName ? $sefConfig->shDefaultMenuItemName : getMenuTitle($option, (isset($task) ? @$task : null), $shCurrentItemid, null, $shLangName );
  $shItemidString = $sefConfig->shAlwaysInsertItemid ? 
    _COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX.$sefConfig->replacement.$shCurrentItemid
    : '';
} else {  // if Itemid in non-sef URL
  $shItemidString = $sefConfig->shAlwaysInsertItemid ? 
    _COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX.$sefConfig->replacement.$Itemid
    : '';
}
  
// optional first part of URL, to be set in language file
if (!empty($sh_LANG[$shLangIso]['_COM_SEF_SH_REGISTRATION'])) 
  $title[] = $sh_LANG[$shLangIso]['_COM_SEF_SH_REGISTRATION'];

$task = isset($task) ? @$task : null;

switch ($task) {
  case 'register':
    $title[] =  $sh_LANG[$shLangIso]['_COM_SEF_SH_REGISTER'];
  break;
  case 'lostPassword':
    $title[] = $sh_LANG[$shLangIso]['_COM_SEF_SH_LOST_PASSWORD'];
  break;
  case 'activate':
  default:
    $dosef = false;
  break;  
}
    
if (!empty($title))
  if (!empty($sefConfig->suffix)) {
	  $title[count($title)-1] .= $sefConfig->suffix;
  }
  else {
	  $title[] = '/';
  }

shRemoveFromGETVarsList('option');
if (!empty($Itemid))
  shRemoveFromGETVarsList('Itemid');
shRemoveFromGETVarsList('lang');
if (!empty($task))
  shRemoveFromGETVarsList('task');

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
