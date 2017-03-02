<?php
/**
 * sh404SEF support for iJoomla magazinecomponent.
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

// load the Language File
$shLangIso = shLoadPluginLanguage( 'com_magazine', $shLangIso, '_SH404SEF_IJOOMLA_MAG_SHOW_EDITION');

$title = array();
$dosef = true;
$shItemidString = '';

if (!empty($option))
  shRemoveFromGETVarsList('option');
if (!empty($lang))
  shRemoveFromGETVarsList('lang');
if (!empty($Itemid))
  shRemoveFromGETVarsList('Itemid');

// start IJoomla specific stuff
$func = isset($func) ? @$func : null;   
if (!empty($func)) {
  shRemoveFromGETVarsList('func');
}  

// shumisha : insert magazine name from menu
$shIJoomlaMagName = empty($sefConfig->shIJoomlaMagName) ?  getMenuTitle($option, (isset($task) ? @$task : null), $Itemid, '', $shLangName ) : $sefConfig->shIJoomlaMagName;

switch ($func)
{
    case 'author_articles':
      if ($sefConfig->shInsertIJoomlaMagName) $title[] = $shIJoomlaMagName;
      if ( !empty ($authorid)) { 
        $query  = "SELECT id, name FROM #__users" ;
		    $query .= "\n WHERE id=".$author_id;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $database->loadObject($result, false);
        else $database->loadObject($result);
		    $shRef = empty($result)?  // no name available
        $sh_LANG[$shLangIso]['_SH404SEF_IJOOMLA_MAG_AUTHOR'].$sefConfig->replacement.$author_id // put ID
          : ($sefConfig->shInsertAuthorId ? $authorid.$sefConfig->replacement : ''); // if name, put ID only if requested
		    $title[] = $shRef.(empty( $result ) ? '' :  $result->name);
      }
      shRemoveFromGETVarsList('authorid');
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_IJOOMLA_MAG_VIEW_ALL_ARTICLES'];
		break;
		case 'author_list':
		  if ($sefConfig->shInsertIJoomlaMagName) $title[] = $shIJoomlaMagName;
		  $title[] = $sh_LANG[$shLangIso]['_SH404SEF_IJOOMLA_MAG_VIEW_ALL_AUTHORS'];
		break;
		case 'show_magazine':  // V 1.2.4.g 2007-04-07
		  if ($sefConfig->shInsertIJoomlaMagName) $title[] = $shIJoomlaMagName;
		  if ( !empty ($id)) { 
        $query  = "SELECT id, title FROM #__magazine_sections" ;
		    $query .= "\n WHERE id=".$id;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $database->loadObject($result, false);
        else $database->loadObject($result);
		    $shRef = empty($result)?  // no name available
        $sh_LANG[$shLangIso]['_SH404SEF_IJOOMLA_MAG_MAGAZINE'].$sefConfig->replacement.$id // put ID
          : ($sefConfig->shInsertIJoomlaMagMagazineId ? $id.$sefConfig->replacement : ''); // if name, put ID only if requested
		    $title[] = $shRef.(empty( $result ) ? '' :  $result->title);
      }
      shRemoveFromGETVarsList('id');
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_IJOOMLA_MAG_VIEW_MAGAZINE'];
		break;
		
		case 'show_edition':
		  //echo 'func = '.$func.'<br />';
		  //echo 'id = '.$id.'<br />';
		  if ($sefConfig->shInsertIJoomlaMagName) $title[] = $shIJoomlaMagName;
		  if ( !empty ($id)) { 
        $query  = "SELECT id, title FROM #__magazine_categories" ;
		    $query .= "\n WHERE id=".$id;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $database->loadObject($result, false);
        else $database->loadObject($result);
		    $shRef = empty($result)?  // no name available
        $sh_LANG[$shLangIso]['_SH404SEF_IJOOMLA_MAG_EDITION'].$sefConfig->replacement.$id // put ID
          : ($sefConfig->shInsertIJoomlaMagIssueId ? $id.$sefConfig->replacement : ''); // if name, put ID only if requested
        //echo 'shRef = '.$shRef.'<br />';
		    $title[] = $shRef.(empty( $result ) ? '' :  $result->title);
		    //var_dump($title);
		    //die();
      }
      shRemoveFromGETVarsList('id');
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_IJOOMLA_MAG_SHOW_EDITION'];
		break;
		  
    case 'show_article':
      if ($sefConfig->shInsertIJoomlaMagName) $title[] = $shIJoomlaMagName;
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_IJOOMLA_MAG_SHOW_RELATED_ARTICLES'];
    break;
		
    default:
      $title[] = $shIJoomlaMagName;
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
