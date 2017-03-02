<?php
/**
 * SEF module for Joomla! rd_rss plugin
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}  
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_lang, $mosConfig_absolute_path, $sh_LANG, $sefConfig;  

// V 1.2.4.q must comply with translation restrictions
$shLangName = empty($lang) ? $mosConfigLang : shGetNameFromIsoCode( $lang);
$shLangIso = (shTranslateUrl($option, $shLangName)) ? (isset($lang) ? $lang : shGetIsoCodeFromName( $mosConfig_lang))
                                       : (isset($GLOBALS['mosConfig_defaultLang']) ? 
                                             shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang'])
                                           : shGetIsoCodeFromName( $mosConfig_lang));


$shLangIso = shLoadPluginLanguage( 'com_rd_rss', $shLangIso, '_COM_SEF_SH_RD_RSS'); 
  
$title = array();
$dosef=true;
$shItemidString = '';

$title[] = $sh_LANG[$shLangIso]['_COM_SEF_SH_RD_RSS'];
       
// fetch contact name
if (!empty($id)) {
  $query  = "SELECT name, id FROM #__rd_rss" ;
  $query .= "\n WHERE id=".$id;
  $database->setQuery( $query );
  if (!shTranslateUrl($option, $shLangName)) // V 1.2.4.m
    $database->loadObject($result, false);
  else $database->loadObject($result);
	if (!empty($result)) $title[] = $result->name;
	else $title[] = $id;
}    

$title[] = '/';
shRemoveFromGETVarsList('option');
if (!empty($Itemid))
  shRemoveFromGETVarsList('Itemid');
shRemoveFromGETVarsList('lang');
shRemoveFromGETVarsList('id');

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
