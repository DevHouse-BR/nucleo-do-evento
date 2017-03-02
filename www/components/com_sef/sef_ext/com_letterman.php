<?php
/**
 * sh404SEF support for com_letterman component.
 * Yannick Gaultier (shumisha)
 * shumisha@gmail.com
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

$shLangIso = shLoadPluginLanguage( 'com_letterman', $shLangIso, '_COM_SEF_LETTERMAN');

$title = array();
$dosef = true;
$shItemidString = '';
  
shRemoveFromGETVarsList('option');
if (!empty($lang))
  shRemoveFromGETVarsList('lang');  
if (!empty($sefConfig->shLMDefaultItemid)) {
    //$shGETVars['Itemid'] = $sefConfig->shLMDefaultItemid;
  shAddToGETVarsList('Itemid', $sefConfig->shLMDefaultItemid); // V 1.2.4.q
    // we add then remove value to GET Vars, sounds weird, but Itemid value has been added to
    // non sef string in the process
  shRemoveFromGETVarsList('Itemid');
}   
   
  $title[] = $sh_LANG[$shLangIso]['_COM_SEF_LETTERMAN'];
  $task = isset($task) ? @$task : null;
  switch ($task) {
      case 'confirm':
         $title[] = $sh_LANG[$shLangIso]['_COM_SEF_LM_CONFIRM'];
	 shRemoveFromGETVarsList('task');
      break;
      case 'subscribe' :
        $title[] = $sh_LANG[$shLangIso]['_COM_SEF_LM_SUBSCRIBE'];
	 shRemoveFromGETVarsList('task');
      break;
      case 'unsubscribe':
         $title[] = $sh_LANG[$shLangIso]['_COM_SEF_LM_UNSUBSCRIBE'];
	 shRemoveFromGETVarsList('task');
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
