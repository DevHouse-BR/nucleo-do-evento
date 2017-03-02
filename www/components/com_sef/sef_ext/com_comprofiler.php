<?php
/**
 * sh404SEF prototype support for Community Builder component.
 * Yannick Gaultier (shumisha)
 * shumisha@gmail.com
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}
 */

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// init languages system 
// When using joomfish, we'll need on the same page strings for various languages (in the language switcher module)
global $mosConfig_lang, $mosConfig_absolute_path, $sh_LANG, $sefConfig;

// V 1.2.4.m must comply with translation restrictions
$shLangName = empty($lang) ? $mosConfigLang : shGetNameFromIsoCode( $lang);
$shLangIso = (shTranslateUrl($option, $shLangName)) ? (isset($lang) ? $lang : shGetIsoCodeFromName( $mosConfig_lang))
                                       : (isset($GLOBALS['mosConfig_defaultLang']) ? 
                                             shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang'])
                                           : shGetIsoCodeFromName( $mosConfig_lang));
                                           
// load the Language File
$shLangIso = shLoadPluginLanguage( 'com_comprofiler', $shLangIso, '_SH404SEF_CB_VIEW_USER_DETAILS'); 

$title = array();
$dosef = true;
$shItemidString = '';

shRemoveFromGETVarsList('option');
if (!empty($lang))
  shRemoveFromGETVarsList('lang');
if (isset($limit))
  shRemoveFromGETVarsList('limit');  
if (isset($limitstart))
  shRemoveFromGETVarsList('limitstart'); 
    
// shumisha : insert CB name from menu
$shCBName = empty($sefConfig->shCBName) ?  getMenuTitle($option, (isset($task) ? @$task : null), $Itemid, null, $shLangName ) : $sefConfig->shCBName;

// do something about that Itemid thing  V 1.2.4.m
if (eregi('Itemid=[0-9]+', $string) === false) { // if no Itemid in non-sef URL
  //global $Itemid;
  //echo 'Itemid Global= '. $shCurrentItemid.'<br />';
  if ($sefConfig->shInsertGlobalItemidIfNone && !empty($shCurrentItemid)) {
    $string .= '&Itemid='.$shCurrentItemid;  // append current Itemid
    //echo 'Itemid Global 2= '. $shCurrentItemid.'<br />';
    //echo 'String= '. $string.'<br />';
    $Itemid = $shCurrentItemid; 
    shAddToGETVarsList('Itemid', $Itemid);
  }  
  if ($sefConfig->shInsertTitleIfNoItemid) {
  	$title[] = $sefConfig->shCBName ? $sefConfig->shCBName : getMenuTitle($option, (isset($task) ? @$task : null), $shCurrentItemid, null, $shLangName );
  	// prevent from adding another time
  	$sefConfig->shInsertCBName = false;
  }	
  //echo 'Itemid Local= '. $Itemid.'<br />';
  $shItemidString = $sefConfig->shAlwaysInsertItemid ? 
    _COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX.$sefConfig->replacement.$Itemid
    : '';
} else {  // if Itemid in non-sef URL
  $shItemidString = $sefConfig->shAlwaysInsertItemid ? 
    _COM_SEF_SH_ALWAYS_INSERT_ITEMID_PREFIX.$sefConfig->replacement.$Itemid
    : '';
  if ($sefConfig->shAlwaysInsertMenuTitle){
    //global $Itemid; V 1.2.4.g we want the string option, not current page !
    $title[] = $sefConfig->shCBName ? 
      $sefConfig->shCBName 
      : getMenuTitle($option, (isset($task) ? @$task : null), $Itemid, null, $shLangName );
    // prevent from adding another time
  	$sefConfig->shInsertCBName = false;  
  }  
} 

if (!empty($Itemid))
  shRemoveFromGETVarsList('Itemid');  

$task = isset($task) ? @$task : null;
if ($task)
  shRemoveFromGETVarsList('task');



switch (strtolower($task))
{
    case 'userdetails':
      //$shLog->l( 5, 'non SEF String = %s ', $string);	
      //$shLog->l(5, 'Begin : Option = %s - page = %s - func = %s - product_id = %s - category_id = %s - manufacturer_id = %s - shCBName = %s', $option, $page, $func, $product_id, $category_id, $manufacturer_id, $shCBName);
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_VIEW_USER_DETAILS'];
      // add user name to URL if requested to do so. User id is in $user
      if (!empty($user) && $sefConfig->shCBInsertUserName) {
        $query  = "SELECT ".($sefConfig->shCBUseUserPseudo?'user':'')."name FROM #__users" ;
		    $query .= "\n WHERE id=".$user;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $result = $database->loadResult(false);
        else $result = $database->loadResult();
		    $title[] = empty($result)?  // no name available
          $sh_LANG[$shLangIso]['_SH404SEF_CB_USER'].$sefConfig->replacement.$user // put ID
          : ($sefConfig->shCBInsertUserId ? $user.$sefConfig->replacement.$result : $result); // if name, put ID only if requested
        shRemoveFromGETVarsList('user');  
      }
    break;
    case 'userslist':
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_VIEW_USERS_LIST'];
      // manage listid
      if (!empty($listid)) {
        $query  = "SELECT listid, title FROM #__comprofiler_lists" ;
		    $query .= "\n WHERE listid=".$listid;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $database->loadObject($result, false);
        else $database->loadObject($result);
		    $title[] = empty($result)?  // no name available
          $sh_LANG[$shLangIso]['_SH404SEF_CB_LIST'].$sefConfig->replacement.$listid // put ID
          : $result->title; // if name, put ID only if requested
        shRemoveFromGETVarsList('listid');  
      }
    break;
    case 'reportuser':
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_REPORT_USER'];
      // add user name if set to do so / user id is in $uid
      if ($sefConfig->shCBInsertUserName) {
        $query  = "SELECT ".($sefConfig->shCBUseUserPseudo?'user':'')."name FROM #__users" ;
		    $query .= "\n WHERE id=".$uid;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $result = $database->loadResult( false);
		    else  $result = $database->loadResult();
		    $title[] = empty($result)?  // no name available
          $sh_LANG[$shLangIso]['_SH404SEF_CB_USER'].$sefConfig->replacement.$uid // put ID
          : ($sefConfig->shCBInsertUserId ? $uid.$sefConfig->replacement.$result : $result); // if name, put ID only if requested
        shRemoveFromGETVarsList('uid');  
      }
    break;
    case 'banprofile' :
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      switch ($act) {
        case 0:
          $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_USER_UNBAN'];
          shRemoveFromGETVarsList('act');
        break;
        case 1:
          $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_USER_BAN'];
          shRemoveFromGETVarsList('act');
        break;
        case 2:
          $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_USER_BAN_REQUEST'];
          shRemoveFromGETVarsList('act');
        break;
      }
      // add user name if set to do so / user id is in $uid
      if ($sefConfig->shCBInsertUserName) {
        $query  = "SELECT ".($sefConfig->shCBUseUserPseudo?'user':'')."name FROM #__users" ;
		    $query .= "\n WHERE id=".$uid;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $result = $database->loadResult( false);
		    else  $result = $database->loadResult();
		    $title[] = empty($result)?  // no name available
          $sh_LANG[$shLangIso]['_SH404SEF_CB_USER'].$sefConfig->replacement.$uid // put ID
          : ($sefConfig->shCBInsertUserId ? $uid.$sefConfig->replacement.$result : $result); // if name, put ID only if requested
        shRemoveFromGETVarsList('uid');  
      }
    break;
    case 'confirm':
      $dosef = false;
    break;
    case 'logout':
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      if (!empty($sh_LANG[$shLangIso]['_SH404SEF_CB_REGISTRATION'])) 
        $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_REGISTRATION'];
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_LOGOUT'];
    break;
    case 'userprofile':
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_VIEW_USER_PROFILE'];
      // add user name to URL if requested to do so. User id is in $user
      if ($sefConfig->shCBInsertUserName) {
        $query  = "SELECT ".($sefConfig->shCBUseUserPseudo?'user':'')."name FROM #__users" ;
		    $query .= "\n WHERE id=".$user;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $result = $database->loadResult( false);
        else $result = $database->loadResult();
		    $title[] = empty($result)?  // no name available
          $sh_LANG[$shLangIso]['_SH404SEF_CB_USER'].$sefConfig->replacement.$user // put ID
          : ($sefConfig->shCBInsertUserId ? $user.$sefConfig->replacement.$result : $result); // if name, put ID only if requested
        shRemoveFromGETVarsList('user');  
      }
    break;
    case 'manageconnections':
      $dosef = false;
    break;
    case 'login':
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      if (!empty($sh_LANG[$shLangIso]['_SH404SEF_CB_REGISTRATION'])) 
        $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_REGISTRATION'];
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_LOGIN'];  
    break;
    case 'lostpassword':
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      // optional first part of URL, to be set in language file
      if (!empty($sh_LANG[$shLangIso]['_SH404SEF_CB_REGISTRATION'])) 
        $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_REGISTRATION'];
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_LOST_PASSWORD'];  
    break;
    case 'registers':
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      // optional first part of URL, to be set in language file
      if (!empty($sh_LANG[$shLangIso]['_SH404SEF_CB_REGISTRATION'])) 
        $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_REGISTRATION'];
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_REGISTER']; 
    break;
    case 'moderatebans':
      $dosef = false;
    break;
    case 'moderatereports':
      $dosef = false;
    break;
    case 'moderateimages':
      $dosef = false;
    break;
    case 'pendingapprovaluser':
      $dosef = false;
    break;
    case 'useravatar':
      $do = isset($do) ? @$do : null;
      switch (strtolower($do)) {
        case 'deleteavatar':
          if ($sefConfig->shInsertCBName) $title[] = $shCBName;
          $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_DELETE_AVATAR'];
          shRemoveFromGETVarsList('do');
        break;
        default:
          if ($sefConfig->shInsertCBName) $title[] = $shCBName;
          $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_MANAGE_AVATAR'];
        break;
      }
    break;
    case 'emailuser':
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_EMAIL_USER'];
      // add user name if set to do so / user id is in $uid
      if ($sefConfig->shCBInsertUserName) {
        $query  = "SELECT ".($sefConfig->shCBUseUserPseudo?'user':'')."name FROM #__users" ;
		    $query .= "\n WHERE id=".$uid;
		    $database->setQuery( $query );
		    if (!shTranslateUrl($option, $shLangName))  // V 1.2.4.m
		      $result = $database->loadResult( false);
		    else  $result = $database->loadResult();
		    $title[] = empty($result)?  // no name available
          $sh_LANG[$shLangIso]['_SH404SEF_CB_USER'].$sefConfig->replacement.$uid // put ID
          : ($sefConfig->shCBInsertUserId ? $uid.$sefConfig->replacement.$result : $result); // if name, put ID only if requested
        shRemoveFromGETVarsList('uid');  
      }
    break;
    case 'teamcredits':
      if ($sefConfig->shInsertCBName) $title[] = $shCBName;
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_TEAM_CREDITS'];
    break;
    default:
      $title[] = $sh_LANG[$shLangIso]['_SH404SEF_CB_MAIN_PAGE'];
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
