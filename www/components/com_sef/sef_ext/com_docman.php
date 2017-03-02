<?php
/**
 * 404SEFx support for DocMAN component.

 * Michal Unzeitig, ARTIO s.r.o.
 * michal.unzeitig@artio.net
 * http://www.artio.cz
 *
 * @author      $Author:michal $
 * @package     404SEFx
 * @subpackage  extensions
 * @version     $Name$, ($Revision:6015 $, $Date:2006-02-14 13:30:00 +0100 (Tue, 14 Feb 2006) $)
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $mosConfig_lang, $mosConfig_absolute_path, $sh_LANG, $sefConfig; 

// V 1.2.4.m must comply with translation restrictions
$shLangName = empty($lang) ? $mosConfigLang : shGetNameFromIsoCode( $lang);
$shLangIso = (shTranslateUrl($option, $shLangName)) ? (isset($lang) ? $lang : shGetIsoCodeFromName( $mosConfig_lang))
                                       : (isset($GLOBALS['mosConfig_defaultLang']) ? 
                                             shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang'])
                                           : shGetIsoCodeFromName( $mosConfig_lang));
                                           
$title = array();
$dosef = true;
$shItemidString = '';
shRemoveFromGETVarsList('option');
if (!empty($lang))
  shRemoveFromGETVarsList('lang');  
if (!empty($Itemid))
  shRemoveFromGETVarsList('Itemid');
  
$task = isset($task) ? @$task : null;
switch ($task)
{
    case 'cat_view':
        {
            $title[] = getMenuTitle($option, $task, $Itemid, null, $shLangName);
            $title = array_merge($title, sef_404::getContentTitles('category', $gid, $Itemid, $shLangName));
            $title[] = '/';
            $task = null;
            shRemoveFromGETVarsList('task');
            break;
        }
    case 'doc_download':
    case 'doc_details':
    case 'doc_view':
        {
            $database->setQuery('SELECT dmname, catid FROM #__docman WHERE id = '.$gid);
            $rows = $database->loadObjectList();

            if ($debug){$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404'][$debug_string][$option] = $rows;}
            if ($database->getErrorNum()) {
                die($database->stderr());
            }

            $title[] = getMenuTitle($option, $task, $Itemid, null, $shLangName);
            if (@count($rows) > 0) {
                $title = array_merge($title, sef_404::getContentTitles('category', $rows[0]->catid, $Itemid, $shLangName));
                $title[] = !empty($rows[0]->dmname) ? titleToLocation($rows[0]->dmname) : $gid;
            }
            $title[] = '/';
            $task = substr($task, 4);
            shRemoveFromGETVarsList('task');
            break;
        }
    default:
        {
            $title[] = getMenuTitle($option, $matchTask, $Itemid, null, $shLangName);
            $title[] = '/';
            if (!empty($task))
              shRemoveFromGETVarsList('task');
        }
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
