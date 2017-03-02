<?php
/**
 * sh404SEF support for fireboard forum component.
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
$shLangIso = shLoadPluginLanguage( 'com_fireboard', $shLangIso, '_SH404SEF_FB_SHOW_USER_PROFILE');

$title = array();
$dosef = true;
$shItemidString = '';

shRemoveFromGETVarsList('option');
if (!empty($lang))
  shRemoveFromGETVarsList('lang');
if (!empty($Itemid))
  shRemoveFromGETVarsList('Itemid');

// start Fireboard specific stuff
$func = isset($func) ? @$func : null;   

if (!function_exists('shFBCategoryName')) {
  function shFBCategoryName( $option, $catid, $shLangIso) {

  global $sefConfig, $database, $sh_LANG;
  
  if (empty($catid)) return '';
  if ( $sefConfig->shFbInsertCategoryName) { 
    $query  = "SELECT id, name FROM #__fb_categories" ;
		$query .= "\n WHERE id=".$catid;
	  $database->setQuery( $query );
	  if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
	    $database->loadObject($result, false);
	  else   
	    $database->loadObject($result);
  } else $result = '';      
	$shCat = empty($result)?  // no name available
    $sh_LANG[$shLangIso]['_SH404SEF_FB_CATEGORY'].$sefConfig->replacement.$catid // put ID
    : ($sefConfig->shFbInsertCategoryId ? $catid.$sefConfig->replacement : ''); // if name, put ID only if requested
  return $shCat.(empty( $result ) ? '' :  $result->name);  
  }        
}

// shumisha : insert magazine name from menu
$shFireboardName = empty($sefConfig->shFireboardName) ?  getMenuTitle($option, null, $Itemid, null, $shLangName ) : $sefConfig->shFireboardName;

switch ($func)
{
    case 'userprofile': 
      shRemoveFromGETVarsList('func');
      switch ($do) {
        case 'show':
          if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
		      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_SHOW_USER_PROFILE'];
		      shRemoveFromGETVarsList('do');
		    break;
		    case 'unfavorite':
		      if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
		      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_SHOW_USER_UNFAVORITE'];
		      shRemoveFromGETVarsList('do');
		    break;
		    case 'unsubscribe':
		      if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
		      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_SHOW_USER_UNSUBSCRIBE'];
		      shRemoveFromGETVarsList('do');
		    break;
      }
      
		break;
		case 'latest':
		  if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
		  if ($do == 'show' && isset($sel))
		      $title[]= $sh_LANG[$shLangIso]['_SH404SEF_FB_SHOW_LATEST_'.$sel];
		  else $title[]= $sh_LANG[$shLangIso]['_SH404SEF_FB_SHOW_LATEST'];   
      shRemoveFromGETVarsList('do'); 
      shRemoveFromGETVarsList('func');
      if (isset($sel))
        shRemoveFromGETVarsList('sel');
		break;
		case 'rules':  // V 1.2.4.g 2007-04-07
		  if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
      shRemoveFromGETVarsList('func');
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_SHOW_RULES'];
		break;
		
		case 'faq':
		  if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_SHOW_FAQ'];
      shRemoveFromGETVarsList('func');
		break;
		  
    case 'showcat':
      //catid = 2 
      // view = threaded // view = flat
      if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
      shRemoveFromGETVarsList('func');
      $shCat = shFBCategoryName( $option, $catid, $shLangIso);
		  if (!empty ($shCat)) $title[] = $shCat;
		  shRemoveFromGETVarsList('catid');
		  switch ($view){
        case 'threaded':
          $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_THREADED'];
          shRemoveFromGETVarsList('view');
        break;
        case 'flat':
          $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_FLAT'];
          shRemoveFromGETVarsList('view');
        break;
      }   
    break;
		
		case 'view':
		  //catid= 2
		  //id=1
		  if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
      shRemoveFromGETVarsList('func');
      $shCat = shFBCategoryName( $option, $catid, $shLangIso);  // V 1.2.4.q $option was missing !
		  if (!empty ($shCat)) $title[] = $shCat;
		  shRemoveFromGETVarsList('catid');
		  $result = null;
		  if (!empty($id)) {
		    if ( $sefConfig->shFbInsertMessageSubject) { 
          $query  = "SELECT id, subject FROM #__fb_messages" ;
		      $query .= "\n WHERE id=".$id;
		      $database->setQuery( $query );
		      if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		        $database->loadObject($result, false);
		      else   
		        $database->loadObject($result);
        } else $result = '';  
		    $shMsg = empty($result)?  // no name available
          $sh_LANG[$shLangIso]['_SH404SEF_FB_MESSAGE'].$sefConfig->replacement.$id // put ID
          : ($sefConfig->shFbInsertMessageId ? $id.$sefConfig->replacement : ''); // if name, put ID only if requested
		    $title[] = $shMsg.(empty( $result ) ? '' :  $result->subject);
		    shRemoveFromGETVarsList('id');
      } 
		break;
		
		case 'upload':
		  $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_UPLOAD_AVATAR'];
		  shRemoveFromGETVarsList('func');
		break;
		
		case 'stats':
		  if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
		  $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_STATS'];
		  shRemoveFromGETVarsList('func');
		break;
		
		case 'post':
		  if ($sefConfig->shInsertFireboardName) $title[] = $shFireboardName;
		  shRemoveFromGETVarsList('func');
		  switch ($do) {
		    case 'reply': // do = reply replyto=1 catid=2
		      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_REPLY'];
		      $shCat = shFBCategoryName( $option, $catid, $shLangIso);  // V 1.2.4.q $option was missing
		      if (!empty ($shCat)) { 
            $title[] = $shCat;
            shRemoveFromGETVarsList('catid');
          }   
		      shRemoveFromGETVarsList('do');
		    break;
		    // do = subscribe catid=2 id = 1 fb_thread = 1
		    case 'subscribe':
		      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_SUBSCRIBE'];
		      shRemoveFromGETVarsList('do');
		    break;
		    // do = favorite catid=2 id = 1 fb_thread = 1
		    case 'favorite':
   		    $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_FAVORITE'];
		      shRemoveFromGETVarsList('do');
		    break;
		    // do=quote&replyto=1&catid=2
		    case 'quote':
		      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_QUOTE'];
		      shRemoveFromGETVarsList('do');
		    break;
		    // do=delete&id=1&catid=2
		    case 'delete':
		      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_DELETE'];
		      shRemoveFromGETVarsList('do');
		    break;
		    // do=move&id=1&catid=2&name=bestofjoomla
		    case 'move':
		      $dosef = false;
		    break;
		    // do=edit&id=1&catid=2
		    case 'edit':
          $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_EDIT'];
		      shRemoveFromGETVarsList('do');
		    break;
		    // do=sticky&id=1&catid=2
		    case 'sticky':
		      $dosef = false;
		    break;
		    // do=lock&id=1&catid=2
		    case 'lock':
		      $dosef = false;
		    break;
		    default:  // if creating new post, data is passed through POST, so other variables than func is not available
		      $dosef = false;
		    break;
		  }
		break;
		
		case 'markThisRead':
		  //catid = 2
		  $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_MARK_THIS_READ'];
		  shRemoveFromGETVarsList('func');
		break;
		
    case 'fb_pdf':
      // &id=1&catid=2&func=fb_pdf
      $dosef=false;
		break;
		
    default:
      switch ($task) {
        case 'listcat':
          $title[] = $sh_LANG[$shLangIso]['_SH404SEF_FB_LIST_CAT'];
		      shRemoveFromGETVarsList('task');
		      $shCat = shFBCategoryName( $option, $catid, $shLangIso);  // V 1.2.4.q $option was missing
		      if (!empty ($shCat)) { 
            $title[] = $shCat;
            shRemoveFromGETVarsList('catid');
          }   
        break;
        default:
          $title[] = $shFireboardName;
        break;
      }
    break;
}
//echo 'Rebuild = '.shRebuildNonSefString( $string).'<br />';
if($dosef){
  if (!empty($shItemidString))
    $title[] = $shItemidString; // V 1.2.4.m
  // stitch back additional parameters, not sef-ified
	$shAppendString .= shGETGarbageCollect();  // add automatically all GET variables that had not been used already
  if (!empty($shAppendString)) 
    $shAppendString = '?'.ltrim( $shAppendString, '&'); // don't add to $string, otherwise it will be stored in the DB 
	$string = sef_404::sefGetLocation( shRebuildNonSefString( $string), $title, null, (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), (isset($shLangName) ? @$shLangName : null));
}

//$shLog->l( 5, 'SEF String = %s ', $string);
?>
