<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_lang, $mosConfig_absolute_path, $sh_LANG, $sefConfig; 

// V 1.2.4.q must comply with translation restrictions
$shLangName = empty($lang) ? $mosConfigLang : shGetNameFromIsoCode( $lang);
$shLangIso = (shTranslateUrl($option, $shLangName)) ? (isset($lang) ? $lang : shGetIsoCodeFromName( $mosConfig_lang))
                                       : (isset($GLOBALS['mosConfig_defaultLang']) ? 
                                             shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang'])
                                           : shGetIsoCodeFromName( $mosConfig_lang));

// load the Language File
$shLangIso = shLoadPluginLanguage( 'com_newsfeeds', $shLangIso, '_COM_SEF_SH_CREATE_NEW_NEWSFEED');

$title = array();
$dosef = true;
$shItemidString = '';

$title[] = getMenuTitle( $option, isset($task) ? $task:null, isset($Itemid) ? $Itemid:null, 
                         null, $shLangName);

if (!empty($catid)) { // V 1.2.4.q
  $arg2[] = sef_404::getcategories($catid);
  $title = array_merge($title, $arg2);
}
$task = isset($task) ? $task : null;
switch ($task) {
  case 'view':                                         
    if (!empty($feedid)) {
	    $query = 'SELECT name, id FROM #__newsfeeds WHERE id = "'.$feedid.'"';
	    $database->setQuery($query);
	    if (shTranslateURL($option, $shLangName))
	      $rows = $database->loadObjectList( );
	    else  $rows = $database->loadObjectList( null, false);
	    if ($debug){$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404'][$debug_string][$option] = $rows;}
	    if ($database->getErrorNum()) {
		    die( $database->stderr());
	    }elseif( @count( $rows ) > 0 ){
		    if( !empty( $rows[0]->name ) ){
			    $title[] = $rows[0]->name;
		    }
	    }
    }
  break;
  case 'new':
	  $title[] = $sh_LANG[$shLangIso]['_COM_SEF_SH_CREATE_NEW_NEWSFEED'] . $sefConfig->suffix;
	break;
}

shRemoveFromGETVarsList('option');
shRemoveFromGETVarsList('Itemid');
shRemoveFromGETVarsList('lang');
if (!empty($catid))
  shRemoveFromGETVarsList('catid');
if (!empty($task))
  shRemoveFromGETVarsList('task');
if (!empty($feedid))  
  shRemoveFromGETVarsList('feedid');

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
