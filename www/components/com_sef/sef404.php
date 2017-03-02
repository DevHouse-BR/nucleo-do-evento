<?php
/**
 * SEF module for Joomla!
 * Originally written for Mambo as 404SEF by W. H. Welch.
 *
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}
 *   
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');
// V 1.2.4.p
define('_OPENSEF', '1');

global $database, $URI, $my, $option, $index, $base, $mosConfig_absolute_path, 
       $mosConfig_live_site, $mosConfig_lang, $shHttpsSave;

// shumisha 2007-03-13 added URL and iso code caching
require_once('components/com_sef/shCache.php');

$debug = 0;
// Hack in mos database as required
if (!is_object(@$database)) {
    $database = new database($GLOBALS['mosConfig_host'], $GLOBALS['mosConfig_user'], $GLOBALS['mosConfig_password'], $GLOBALS['mosConfig_db'], $GLOBALS['mosConfig_dbprefix']);
}

$REQUEST = $SRU = $_SERVER['REQUEST_URI'];
if ($debug) {
    $GLOBALS['404SEF_DEBUG']['INDEX'] = $index;
    $GLOBALS['404SEF_DEBUG']['BASE'] = $base;
    $GLOBALS['404SEF_DEBUG']['QUERY_STRING'] = $_SERVER['QUERY_STRING'];
    $GLOBALS['404SEF_DEBUG']['REQUEST'] = $REQUEST;
    $GLOBALS['404SEF_DEBUG']['URI'] = $URI;
}
// V 1.2.4.j 2007-04-16 use own config secure url to fix ssl switch management
$http_host = explode(':', $_SERVER['HTTP_HOST'] );
if( (!empty( $_SERVER['HTTPS'] ) && strtolower( $_SERVER['HTTPS'] ) != 'off' || isset( $http_host[1] ) && $http_host[1] == 443)) 
  $shHttpsSave = empty($sefConfig->shConfig_live_secure_site) ? 
      'https://'.substr( $mosConfig_live_site, 7 ) 
    : $sefConfig->shConfig_live_secure_site;
else 
  $shHttpsSave = null;
  
  //var_dump($URI);
  //die();
// Lets some quick sanity checks
switch ($URI->path) {
    case $base:
    case $base.$index: {
        // shumisha
        $option = (isset($_GET['option'])) ? $_GET['option'] : (isset($_REQUEST['option'])) ? $_REQUEST['option'] : null;
        // shumisha : need to reset language to default if we are loading homepage. It's a bad fix !
        // shumisha 2077-03-28 : this breaks language when URL is home, but other data is passed through
        // POST. So let's try to improve by checking also that no option is requested
        // V 1.2.4.q use empty instead of testing directly the variable to prevent notices
      	//if ( is_null($option) && ($_GET['lang'] == '')|| $_REQUEST['lang'] == '')))
      	if ( is_null($option) && (empty($_GET['lang']) || empty($_REQUEST['lang'])))
          $_GET['lang'] = shGetIsoCodeFromName($mosConfig_lang);

        if (is_null($option)) {
            $GLOBALS['404SEF_DEBUG']['REDIRECT_INDEX'] = 0;
            // fix those funky polls by ensuring we have an Itemid for the homepage
            //$query = "SELECT `id`,`link` FROM #__menu where ((`menutype`='mainmenu') AND (`published` > 0) AND (`ordering`='1') AND (`parent` = 0) AND (`access` >= '".(isset($my) ? (intval(@$my->id)) : 0)."'))";		/*Beat: strange rule, but sometimes my is not set here, so at least stop PHP error*/
            //$database->setQuery($query);
            // V 1.2.4.q modified query, first item of menu is not always ordering = 1 !!!                          
	          $query = "SELECT `id`,`link` FROM #__menu where ((`menutype`='mainmenu') AND (`published` > 0) AND (`access` >= '".(isset($my) ? (intval(@$my->id)) : 0)."')) ORDER BY parent, ordering";	
            $database->setQuery($query, 0, 1);

            if (($row = $database->loadRow())) {
                $GLOBALS['404SEF_DEBUG']['REDIRECT_INDEX'] = 1;
                $_GET['Itemid'] = $_REQUEST['Itemid'] = $Itemid = $row[0];
                $_SERVER['QUERY_STRING'] = $QUERY_STRING  = str_replace("index.php?","",$row[1])."&Itemid=$Itemid";
                $REQUEST_URI = $GLOBALS['mosConfig_live_site']."/index.php?".$QUERY_STRING;
                $_SERVER['REQUEST_URI'] = $REQUEST_URI;
                $matches = array();
                if (preg_match("/option=([a-zA-Z_0-9]+)/", $QUERY_STRING, $matches)) {
                    $_GET['option'] = $_REQUEST['option'] = $option = $matches[1];
                }

                // shumisha V 1.2.4.k better handling of homepage if it is not com_frontpage
			          parse_str($QUERY_STRING,$vars);
			          $_GET = array_merge($_GET,$vars);
			          $_REQUEST = array_merge($_REQUEST,$vars);

                $GLOBALS['404SEF_DEBUG']['ROW'] = $row;
                $GLOBALS['404SEF_DEBUG']['QUERY_STRING'] = $QUERY_STRING;
                $GLOBALS['404SEF_DEBUG']['REQUEST_URI'] = $REQUEST_URI;
                
                unset($matches);
                if (!headers_sent()) {
                  if (!empty($shHttpsSave))  // V 1.2.4.j
                    $mosConfig_live_site = $shHttpsSave;  
                  header('HTTP/1.0 200 OK');
                }
                else {
                    $url = $GLOBALS['mosConfig_live_site'].$_SERVER['QUERY_STRING'];
                    //print_r($path_array);
                    die("<br />Are we debugging???<br />Killed at line ".__LINE__." in ".basename(__FILE__).": HEADERS ALREADY SENT (200)<br />URL=".@$url.":<br />OPTION=".@$option.":");
                }
            }
        } 
        // V 1.2.4.j : optionnally redirect non-sef URL to SEF counterpart. This does not work however if Joomfish is active
        // as Joomfish has not been initialiaed at this point in time, and thus cannot translate. So we disable this function
        // if Joomfish is running (but enable it again if JF is running but current language is default languages, as this
        // is what JF will return)
        else {
          if (!empty($shHttpsSave))  // V 1.2.4.j 
            $mosConfig_live_site = $shHttpsSave;
           //echo '<br />shJFDiscoverLanguage() : '.shJFDiscoverLanguage().'<br />'; 
	        if ( $sefConfig->shRedirectNonSefToSef && !empty($URI->url) && empty($_POST)   
            && ( empty($GLOBALS[ 'mosConfig_mbf_content' ]) // V 1.2.4.q 
                || ( !empty($GLOBALS[ 'mosConfig_mbf_content' ]) 
                     && (shJFDiscoverLanguage() == $GLOBALS[ 'mosConfig_lang' ]) ) ) // $mosConfig_lang is still deafult lang, as
                                                                      // language has not been discovered yet
             ) {  
            //echo '<br />$URIUrl'.$URI->url.'<br />';
            $lang = mosGetParam( $_GET, 'lang', $mosConfig_lang );
            //echo '<br />$lang : '.$lang.'<br />'; 
            //echo '<br />$mosConfig_lang : '.$mosConfig_lang.'<br />';
            $shSefUrl = sefRelToAbs($URI->url, $lang);

            //echo '<br />$shSefUrl : '.$shSefUrl.'<br />';
            //echo '<br />$shSefUrl encodée'.str_replace(' ', '%20', $shSefUrl).'<br />';
            //die();
		        if ( ltrim(str_replace($mosConfig_live_site, '', str_replace(' ', '%20', $shSefUrl)), '/') != $URI->url)  { // non sef url already have a sef equivalent, so let's 301 redirect to it
              mosRedirect( $shSefUrl );
            }
	        }
        }
        break;
    }
    case "": {
        die(_COM_SEF_STRANGE." URI->path=".$URI->path.":<br />".basename(__FILE__)."-".__LINE__);
    }
    default: {
        // sanity check ok so process URI
        // strip out the base
        // V 1.2.4.q we may have to decode URl
        if ($sefConfig->shEncodeUrl) {
          if (!empty($URI->path)) {
            //echo 'uri path before = '.$URI->path.'<br />';
            //var_dump($URI);
            $URI->path = shUrlDecode($URI->path);
            //echo 'uri path after = '.$URI->path.'<br />';
            //die();
          }
          if (count($URI->querystring) > 0) {
          }
          if (!empty($URI->anchor)) {
          
          }
        }
        $path = preg_replace("/^".preg_quote($base,"/")."/","",$URI->path);
        $path_array = explode("/",$path);
        //var_dump($path_array);
        $ext = getExt($path_array);
        $sef_ext_class = "sef_".$ext['name'];

        // V 1.2.4.p if other than J! SEF, then use sh404SEF to decode
        if ($sef_ext_class != 'sef_content' && $sef_ext_class != 'sef_component') {
          $sef_ext_class = 'sef_404';
          $ext['path'] = $GLOBALS['mosConfig_absolute_path']."/components/com_sef/sef_ext.php";
          $ext['name'] = '404';
        }
        
        if ($debug) {
            $GLOBALS['404SEF_DEBUG']['EXT'] = $ext;
            $GLOBALS['404SEF_DEBUG']['SEF_EXT'] = $sef_ext_class;
            $GLOBALS['404SEF_DEBUG']['PATH'] = $path;
        }
        //Dit is meestal sef_404 en anders heeft het te maken met sef advance
        require_once($ext['path']);
        eval("\$sef_ext = new $sef_ext_class;");
        
        $pos = 0;

        if (isset($_REQUEST['option'])) {
            $pos = array_search($_REQUEST['option'],$path_array);
        }
        if (!(($sef_ext_class == "sef_content")or($sef_ext_class == "sef_component"))) {
            if ($pos == 0) {
              array_unshift($path_array,"option");
            }
        }
        if ($debug) {
            $GLOBALS['404SEF_DEBUG']['POS'] = $pos;
            $GLOBALS['404SEF_DEBUG']['PATH_ARRAY'] = $path_array;
        }

        $_SEF_SPACE = $sefConfig->replacement;
        //echo '<br />$sef_ext_class = '.$sef_ext_class;
        $QUERY_STRING  = $sef_ext->revert($path_array, $pos);
        //echo '<br />$QUERY_STRING = '.$QUERY_STRING; 
        //die();
        // V 1.2.4.l added automatic redirect of Joomla standard SEF to sh404SEF URL.
        // V 1.2.4.p restrict automatic redirect to Joomla own sef, otherwise it breaks opensef/sefadvance sef_ext files 
        if ($sef_ext_class == 'sef_content' || $sef_ext_class == 'sef_component') {  // if we have Joomla standard SEF
		      if ( $sefConfig->shRedirectJoomlaSefToSef && $URI->url && empty($_POST)) { // and are set to auto-redirect to SEF URLs
		        if (!empty($shHttpsSave)) 
              $mosConfig_live_site = $shHttpsSave;
            $shSefUrl = $mosConfig_live_site.'/index.php?'. $QUERY_STRING; 
            //echo '<br />$pos : '.$pos.'<br />';
            //var_dump($path_array);
            //echo '<br />URI = ';
            //var_dump($URI);
            //echo '<br />$shSefUrl : '.$shSefUrl.'<br />'; 
            // check if language in URL
            $shIsoCode = '';
            $shTemp = explode( 'lang,', $shSefUrl);
            if (!empty($shTemp[1]))
              $shIsoCode = explode('&', $shTemp[1]);
            //echo '$shSefUrl : '.$shSefUrl.'<br />';
            //echo '<br />$shIsoCode : '.$shIsoCode.'<br />';
            //die();  
            $shSefUrl = sefRelToAbs($shSefUrl, shGetNameFromIsoCode( $shIsoCode));
            
            //echo '<br />$shSefUrl après : '.$shSefUrl.'<br />';
            //echo '<br />$URI->URL après : '.$URI->url.'<br />';
            //die();
            
            if ( ltrim(str_replace($mosConfig_live_site, '', $shSefUrl), '/') != $URI->url)  { 
               mosRedirect( $shSefUrl );
               
            }
	        }
        }    
        // end of change
        if (is_valid($QUERY_STRING)) { 

            $anchor = ($URI->anchor) ? '#'.$URI->anchor:'';
            $_SERVER['QUERY_STRING'] = $QUERY_STRING = str_replace('&?', '&', $QUERY_STRING./*(isset($QS) ? $QS : '').*/$anchor);
            $REQUEST_URI = $GLOBALS['mosConfig_live_site'].'/index.php?'.$QUERY_STRING;
            $_SERVER['REQUEST_URI'] = $REQUEST_URI;

            if (preg_match("/option=([a-zA-Z_0-9]+)/", $QUERY_STRING, $matches)) {
                $_GET['option'] = $_REQUEST['option'] = $option = $matches[1];
            }

            unset($matches);

            while (list($key, $value) = each($_GET)) {
                $GLOBALS[$key] = $value;
            }

            // Don't allow config vars to be passed as global
            // shumisha 2007-04-16 V 1.2.4.j including configuration.php was breaking session management after ssl
            // switch using url rewriting in virtuemart. User could not login, because $mosConfig_live_site
            // was properly set at beginning of /index.php, but here it was rewritten by the inclusion.
            // additionnally, $mosConfig_live_site was NOT properly set by Joomla 1.0.12 in case of shared SSL
            // additionnally, the fix provided by Soeren on VM forum would not work if Joomla was installed in a sub dir
            // so I have added my own secure site URL in sh404SEF config. It must be set if you are usin a SSL site 
            include( "configuration.php" );
            if (!empty($shHttpsSave))
              $mosConfig_live_site = $shHttpsSave;
            // shumisha end of fix
            
            if (!headers_sent()) {
                header('HTTP/1.0 200 OK');
            }
            else{
                $url = $GLOBALS['mosConfig_live_site']."/index.php?".$_SERVER['QUERY_STRING'];
                print_r($path_array);
                die("<br />Are we debugging???<br />Killed at line ".__LINE__." in ".basename(__FILE__).": HEADERS ALREADY SENT (200)<br />URL=".@$url.":<br />OPTION=".@$option.":");
            }
        }
        else {
            // bad URL, so check to see if we've seen it before
            // V 1.2.4.k 404 errors logging is now optional
            if ($sefConfig->shLog404Errors) {
              $query = "SELECT * FROM #__redirection WHERE oldurl = '".$path."'";
              $database->setQuery($query);
              $results=$database->loadObjectList();

              if ($results) {
                  // we have, so update counter
                  $database->setQuery("UPDATE #__redirection SET cpt=(cpt+1) WHERE oldurl = '".$path."'");
                  $database->query();
              }
              else {
                  // record the bad URL
                  $query = 'INSERT INTO `#__redirection` ( `cpt` , `rank`, `oldurl` , `newurl` , `dateadd` ) ' // V 1.2.4.q
                  . ' VALUES ( \'1\', `0`,\''.$path.'\', \'\', CURDATE() );'
                  . ' ';
                  $database->setQuery($query);
                  $database->query();
              }
            } 
            // redirect to the error page
            // You MUST create a static content page with the title 404 for this to work properly
            $mosmsg = "FILE NOT FOUND: ".$path;
            $_GET['mosmsg'] = $_REQUEST['mosmsg'] = $mosmsg;
            $option="com_content";
            $task="view";

            if ($sefConfig->page404 == "0") {
                $sql='SELECT id  FROM #__content WHERE `title`="404"';
                $database->setQuery( $sql );

                if (($id = $database->loadResult())) {
                    $Itemid = null; /*Beat: was wrong: =$id : the $Itemid represents the menuId, and $id the contentId ! */
                    //$_SERVER['QUERY_STRING'] = "option=com_content&task=view&id=$id&Itemid=$id&mosmsg=$mosmsg"; // shumisha : was still wrong
                    $_SERVER['QUERY_STRING'] = "option=com_content&task=view&id=$id&mosmsg=$mosmsg";
                    $_SERVER['REQUEST_URI'] = $GLOBALS['mosConfig_live_site']."/index.php?".$_SERVER['QUERY_STRING'];
                    $_GET['option'] = $_REQUEST['option'] = $option;
                    $_GET['task'] = $_REQUEST['task'] = $task;

                    /*Beat: was wrong: $_GET['Itemid'] = $_REQUEST['Itemid'] = $Itemid; */
                    unset($_GET['Itemid']);
                    unset($_REQUEST['Itemid']);
                    $_GET['id'] = $_REQUEST['id'] = $id;
                }
                else {
                    die(_COM_SEF_DEF_404_MSG.$mosmsg."<br>URI:".$_SERVER['REQUEST_URI']);
                }
            }
            elseif ($sefConfig->page404 == "9999999") {
                //redirect to frontpage
                $Front404 = 1;
            }
            else{
                $id = $Itemid  = $sefConfig->page404;
                $_SERVER['QUERY_STRING'] = "option=com_content&task=view&id=$id&Itemid=$id&mosmsg=$mosmsg";
                $_SERVER['REQUEST_URI'] = $GLOBALS['mosConfig_live_site']."/index.php?".$_SERVER['QUERY_STRING'];
                $_GET['option'] = $_REQUEST['option'] = $option;
                $_GET['task'] = $_REQUEST['task'] = $task;
                $_GET['Itemid'] = $_REQUEST['Itemid'] = $Itemid;
                $_GET['id'] = $_REQUEST['id'] = $id;
            }

            if (!headers_sent()) {
                header('HTTP/1.0 404 NOT FOUND');
                if ($Front404) mosRedirect( $GLOBALS['mosConfig_live_site'] );
            }
            else {
                $url = sefRelToAbs($GLOBALS['mosConfig_live_site']."/index.php?".$_SERVER['QUERY_STRING']);
                print_r($path_array);
                die("<br />Are we debugging???<br />Killed at line ".__LINE__." in ".basename(__FILE__).": HEADERS ALREADY SENT (404)<br />URL=".@$url.":<br />OPTION=".@$option.":");
                //mosRedirect($url);
            }
        } //end bad url
    }//
}

if ($debug) {
    $GLOBALS['404SEF_DEBUG']['SERVER_QUERY_STRING'] = $_SERVER['QUERY_STRING'];
    $GLOBALS['404SEF_DEBUG']['SERVER_REQUEST_URI'] = $_SERVER['REQUEST_URI'];
}

/** The function finds the language which is to be used for the user/session
 * 
 * It is possible to choose the language based on the client browsers configuration,
 * the activated language of the configuration and the language a user has choosen in
 * the past. The decision of this order is done in the JoomFish configuration.
 * 
 * The other topic while choosing the language is to change the $mosConfig_lang var 
 * for the other CMT's and same this for the user in the session or cockie.
 * 
 * This is a modified copy of what's available in Joomfish system bot.  
 */
 
function shJFDiscoverLanguage ( ) {
	global $mosConfig_lang, $database,$_MAMBOTS;

	if (empty($GLOBALS[ 'mosConfig_mbf_content' ]))
	  return $mosConfig_lang; 
	  
	// check if param query has previously been processed
	if ( !isset($_MAMBOTS->_system_mambot_params['jfSystembot']) ) {
		// load mambot params info
		$query = "SELECT params"
		. "\n FROM #__mambots"
		. "\n WHERE element = 'jfdatabase.systembot'"
		. "\n AND folder = 'system'"
		;
		$database->setQuery( $query );
		$database->loadObject($mambot);	
		
		// save query to class variable
		$_MAMBOTS->_system_mambot_params['jfSystembot'] = $mambot;
	}
	// pull query data from class variable
	$mambot = $_MAMBOTS->_system_mambot_params['jfSystembot'];	
	
	$botParams = new mosParameters( $mambot->params );
	$determitLanguage 		= $botParams->def( 'determitLanguage', 1 );
	$newVisitorAction		= $botParams->def( 'newVisitorAction', "browser" );
	//echo '$determitLanguage: '.$determitLanguage.'<br />';
	//echo '$newVisitorAction: '.$newVisitorAction.'<br />';
	$mbfcookie = mosGetParam( $_COOKIE, 'mbfcookie', null );
	//echo '$mbfcookie: '.print_r($mbfcookie).'<br />';
	if (isset($mbfcookie["lang"]) && $mbfcookie["lang"] != "") {
		$client_lang = $mbfcookie["lang"];
		//die($client_lang);
	} else {
		$client_lang = '';
	}
	//echo '$client_lang: '.$client_lang.'<br />';
	// lang from URI should always overrule everything!
	$lang = mosGetParam( $_GET, 'lang', '' );
	if( $lang != '' ) {
		$client_lang = $lang;
	}
	//echo '$lang: '.$lang.'<br />';
	// if we have no language from cookie or query lang value then resort to joomfish settings
	if ($client_lang==''){	
		if ($newVisitorAction=="browser" && $_SERVER["HTTP_ACCEPT_LANGUAGE"] != "" ) {
			// no language chooses - assume from browser configuration
			// language negotiation by Kochin Chang, June 16, 2004
			// retrieve active languages from database
			$active_lang = null;
			$activeLanguages = JoomFishManager::getActiveLanguages();
			if( count( $activeLanguages ) == 0 ) {
				return $mosConfig_lang;
			}

			foreach ($activeLanguages as $lang) {
				$active_lang[] = $lang->iso;
			}

			// figure out which language to use
			$browserLang = explode(',', $_SERVER["HTTP_ACCEPT_LANGUAGE"]);

			foreach( $browserLang as $lang ) {
				$shortLang = substr( $lang, 0, 2 );

				if( in_array($lang, $active_lang) ) {
					$client_lang = $lang;
					break;
				}

				if ( in_array($shortLang, $active_lang) ) {
					$client_lang = $shortLang;
					break;
				}
			}
			// if language is still blank then use first active language!
			if ($client_lang==""){
				$client_lang = $activeLanguages[0]->iso;
			}
		}
		elseif ($newVisitorAction=="joomfish"){
			// This list is ordered already!
			$activeLanguages = JoomFishManager::getActiveLanguages();
			if( count( $activeLanguages ) == 0 ) {
				return $mosConfig_lang;
			}
			else {
				$client_lang = $activeLanguages[0]->iso;				
			}
			
		}
		// otherwise default use site default language
		else {
			$activeLanguages = JoomFishManager::getActiveLanguages();
			if( count( $activeLanguages ) == 0 ) {
				return $mosConfig_lang;
			}
			foreach ($activeLanguages as $lang) {
				if ($lang->code==$mosConfig_lang){
					$client_lang = $lang->iso;
					break;
				}
			}			
			// if language is still blank then use first active language!
			if ($client_lang==""){
				$client_lang = $activeLanguages[0]->iso;
			}
		}
	}
	
	// get the name of the language file for joomla
	$mbfLang = new jfLanguage($database);
	$mbfLang->loadByISO( $client_lang );
	
	if( isset($mbfLang) && $mbfLang->code != "" && $mbfLang->active) {
		return $mbfLang->code;
	} else {
	  return $mosConfig_lang;
	}
}


/*
 * 404SEF SUPPORT FUNCTIONS
 */
function sef_ext_exists($this_name)
{
    global $database, $sefConfig;

    $debug = 0;

    // check for sef_ext
    $this_name = str_replace($sefConfig->replacement, " ", $this_name);
    $sql = "SELECT `id`,`link` FROM #__menu  WHERE ((`name` LIKE '%".$this_name."%') AND (`published` > 0))";
    $database->setQuery($sql);
    $rows = @$database->loadObjectList();

    if ($database->getErrorNum()) {
        die($database->stderr());
    }

    if ($debug) {
        $GLOBALS['404SEF_DEBUG']['SEF_EXT_EXISTS']['THIS_NAME'] = $this_name;
        $GLOBALS['404SEF_DEBUG']['SEF_EXT_EXISTS']['ROWS'] = $rows;
    }

    if (@count($rows) > 0) {
        $option = str_replace("index.php?option=","",$rows[0]->link);
        if (file_exists($GLOBALS['mosConfig_absolute_path']."/components/$option/sef_ext.php")){
            if ($debug) $GLOBALS['404SEF_DEBUG']['SEF_EXT_EXISTS']['FOUND'] = 1;
            return @$rows[0];
        }
        else {
            if ($debug) $GLOBALS['404SEF_DEBUG']['SEF_EXT_EXISTS']['FOUND'] = 0;
            unset($rows);
        }
    }

    return null;
}

function getExt($URL_ARRAY)
{
    global $database, $sefConfig;

    $ext = array();
    $row = sef_ext_exists($URL_ARRAY[0]);
    $ext['path'] = $GLOBALS['mosConfig_absolute_path']."/components/com_sef/sef_ext.php";

    if (is_object($row)) {
        $_GET['option'] = $_REQUEST['option'] = $option = str_replace("index.php?option=","",$row->link);
        $_GET['Itemid'] = $_REQUEST['Itemid'] = $row->id;
        $ext['path'] = $GLOBALS['mosConfig_absolute_path']."/components/$option/sef_ext.php";
    }
    elseif ((strpos($URL_ARRAY[0], "com_") !== false) or ($URL_ARRAY[0] == "component")) {
        $_GET['option'] = $_REQUEST['option'] = $option = "com_component";
    }
    elseif($URL_ARRAY[0] == 'content') {
        $_GET['option'] = $_REQUEST['option'] = $option = "com_content";
    }
    else{
        $option = "404";
    }
    $ext['name'] = str_replace("com_","",$option);

    return $ext;
}

function is_valid($string)
{
    global $base, $index;
    if (($string == $index )|($string == $base.$index )) {
        $state = true ;
    }
    else {
        $state = false;
        require_once($GLOBALS['mosConfig_absolute_path']."/components/com_sef/sef_ext.php");
        $sef_ext = new sef_404;
        $option = (isset($_GET['option'])) ? $_GET['option'] : (isset($_REQUEST['option'])) ? $_REQUEST['option'] : null;

        $vars = array();
        if (is_null($option)) {
            parse_str($string, $vars);
            if (isset($vars['option'])) {
                $option = $vars['option'];
            }
        }
        switch ($option) {
            case is_null($option):
            break;
            case "login":		/*Beat: makes this also compatible with CommunityBuilder login module*/
            case "logout": {
                $state = true;
                break;
            }
            default: {
                if (is_valid_component($option)){
                    if ((!($option == "com_content"))|(!($option == "content"))) {
                        $state = true;
                    }
                    else {
                        $title=$sef_ext->getContentTitles($_REQUEST['task'],$_REQUEST['id']);
                        if (count($title) > 0) {
                            $state = true;
                        }
                    }
                } 
                  // shumisha check if this is homepage+lang=xx
                  else {
                  if (substr($string,0,5)=='lang=')
                  $state = true; 
                  }
                  // shumisha end of change
            }
        }
    }
    return $state;
}

function is_valid_component($this)
{
    $state = false;
    $path = $GLOBALS['mosConfig_absolute_path'] .'/components/';

    if (is_dir($path)) {
        if (($contents = opendir($path))) {
            while (($node = readdir($contents)) !== false) {
                if ($node != '.' && $node != '..') {
                    if (is_dir($path.'/'.$node) && $this == $node) {
                        $state = true;
                        break;
                    }
                }
            }
        }
    }
    return $state;
}

function shSortURL($string) {
// URL must be like : index.php?param2=xxx&option=com_ccccc&param1=zzz
// URL returned will be ! index.php?option=com_ccccc&param1=zzz&param2=xxx
  $ret = '';
  /*$URI = new Net_URL($string);
  if (count($URI->querystring) > 0) {
    ksort($URI->querystring);  // sort URL array
    $shNewString = '';
    $ret = 'index.php?';
    foreach ($URI->querystring as $key => $value) {
      //echo 'Key='.$key.' value='.$value.'<br />';
      if (strtolower($key) != 'option') // option is always first parameter
        $shNewString .= '&'.$key.'='.$value;
      else
        $ret .= $key.'='.$value;  
    }     
    $ret .= $ret == 'index.php?' ? ltrim( $shNewString, '&') : $shNewString;
  }*/
  $st = str_replace('&amp;', '&',$string);
  $st = str_replace('index.php', '', $st);
  $st = str_replace('?', '', $st);
  parse_str( $st,$shVars);
  if (count($shVars) > 0) {
    ksort($shVars);  // sort URL array
    $shNewString = '';
    $ret = 'index.php?';
    foreach ($shVars as $key => $value) {
      //echo 'Key='.$key.' value='.$value.'<br />';
      if (strtolower($key) != 'option') // option is always first parameter
        $shNewString .= '&'.$key.'='.$value;
      else
        $ret .= $key.'='.$value;  
    }     
    $ret .= $ret == 'index.php?' ? ltrim( $shNewString, '&') : $shNewString;
  }
  // echo '<br />000000000'.$string.'000000'.$ret.'000000'.'<br />';
  return $ret;
}


  function shGETGarbageCollect() {  // V 1.2.4.m moved to main component from plugins
    // builds up a string using all remaining GET parameters, to be appended to the URL without any sef transformation
    // those variables passed litterally must be removed from $string as well, so that they are not stored in DB
    global $sefConfig, $shGETVars;
  
    if (!$sefConfig->shAppendRemainingGETVars || empty($shGETVars)) return '';
    $ret = '';
    ksort($shGETVars);
    foreach ($shGETVars as $param => $value) {
      $ret .= '&'.$param.'='.$value;
    }
    return $ret;
  }

  function shRebuildNonSefString( $string) { // V 1.2.4.m moved to main component from plugins
    // rebuild a non-sef string, removing all GET vars that were not turned into SEF
    // as we do not want to store them in DB
    
    global $sefConfig, $shRebuildNonSef;
    //echo 'Spot 10 :'.$string.'<br />';
    //var_dump($shRebuildNonSef);echo '<br />';
    if (!$sefConfig->shAppendRemainingGETVars || empty($shRebuildNonSef)) return $string;
    $shNewString = '';
    if (!empty($shRebuildNonSef)) {
      //var_dump($shRebuildNonSef);echo '<br />';
      foreach ($shRebuildNonSef as $param) {  // need to sort, and still place option in first pos.
           $shNewString .= $param;  
	   //echo $shNewtring.'<br />';
      }
      $ret = shSortUrl('index.php?'.ltrim( $shNewString, '&'));  
    }
    //echo 'Spot 11 :'.$ret.'<br />';
    return $ret;
  }

  function shRemoveFromGETVarsList( $paramName) { // V 1.2.4.m moved to main component from plugins
    global $shGETVars, $sefConfig, $shRebuildNonSef;
    
    if (!$sefConfig->shAppendRemainingGETVars) return null;
    if (!empty($paramName)) {
      if (@$shGETVars[$paramName])
        $shValue = $shGETVars[$paramName];
      else $shValue = '';  
      $shRebuildNonSef[] = '&'.$paramName.'='.$shValue;  // build up a non-sef string with the GET vars used to 
                                             // build the SEF string. This string will be the one stored in db instead of
                                             // the full, original one
      unset( $shGETVars[@$paramName]);
    }  
  }

  function shAddToGETVarsList( $paramName, $paramValue) {  // V 1.2.4.m
    global $shGETVars, $shRebuildNonSef;
    if (empty( $paramName)) return;
    $shGETVars[$paramName] = $paramValue;
  }

  function shLoadPluginLanguage ( $pluginName, $language, $defaultString) {  // V 1.2.4.m
  global $sh_LANG, $mosConfig_absolute_path;
  // load the Language File
  if (file_exists( $mosConfig_absolute_path.'/administrator/components/com_sef/language/plugins/'.$pluginName.'.php' )) {
  	include_once( $mosConfig_absolute_path.'/administrator/components/com_sef/language/plugins/'.$pluginName.'.php' );
  }	
  else die('sh404SEF - missing language file for plugin '.$pluginName.'. Cannot continue.');	

  if (!isset($sh_LANG[$language][$defaultString]))
    return 'en';
  else return $language;  
  } 

  function shInsertIsoCodeInUrl($compName, $shLang = null) {  // V 1.2.4.m
  global $sefConfig, $mosConfig_lang;
  $shLang = empty($shLang) ? $mosConfig_lang : $shLang;  // V 1.2.4.q
  /*echo '$shLang shInsertIsoCodeInUrl: '.$shLang.'<br />';
  echo '$mosConfig_lang : '.$mosConfig_lang.'<br />';
  echo '$sefConfig->shInsertLanguageCode: '.$sefConfig->shInsertLanguageCode.'<br />';
  echo '!$GLOBALS[ mosConfig_mbf_content" ] : '.$GLOBALS[ "mosConfig_mbf_content" ].'<br />';
  echo '$GLOBALS["mosConfig_defaultLang"] : '.$GLOBALS["mosConfig_defaultLang"].'<br />';
  echo '$compName : '.$compName.'<br />';
  var_dump($sefConfig->notInsertIsoCodeList); */
    if (empty($compName) || !$sefConfig->shInsertLanguageCode  // if no compname or global param is off
      || empty($GLOBALS[ 'mosConfig_mbf_content' ])    // or no Joomfish, therefore just one lang
      || ( empty($GLOBALS['mosConfig_defaultLang'])    // or Joomfish, but not yet initialised : this is    
            && !empty($GLOBALS[ 'mosConfig_mbf_content' ])  )  // a 301 redir from non-sef to sef
      || ( !empty($GLOBALS['mosConfig_defaultLang'])   // or Joomfish and Joomfish initialised 
            && ($GLOBALS['mosConfig_defaultLang'] == $shLang)) )  // but this is default language
      return false;
    $compName = str_replace('com_', '', $compName);
    return !in_array($compName, $sefConfig->notInsertIsoCodeList);
  }
  
  function shTranslateUrl ($compName, $shLang = null) {  // V 1.2.4.m  // V 1.2.4.q added $shLang param
  global $sefConfig, $mosConfig_lang;
    
    $shLang = empty($shLang) ? $mosConfig_lang : $shLang;
    //echo '$shLang shTranslateUrl: '.$shLang.'<br />';
    if (empty($compName) || !$sefConfig->shTranslateURL
      || empty($GLOBALS[ 'mosConfig_mbf_content' ])
      || (($GLOBALS['mosConfig_defaultLang'] == $shLang))) 
      return false;
    $compName = str_replace('com_', '', $compName);
    return !in_array($compName, $sefConfig->notTranslateURLList);
  }
 
// V 1.2.4.q returns true if current page is home page. Pretty basic right now, returns true if option= com_frontpage
function shIsCurrentPageHome() {
  global $option, $shHomeLink;
  
  //echo '$_SERVER[QUERY_STRING] '.$_SERVER['QUERY_STRING'].'<br />';
  //echo '$shHomeLink '.$shHomeLink.'<br />';
  $currentPage = preg_replace( '/(&|\?)lang=[a-zA-Z]{2,3}/iU', '', $_SERVER['QUERY_STRING']);
  $shHomePage = preg_replace( '/(&|\?)lang=[a-zA-Z]{2,3}/iU', '', $shHomeLink);
  $shHomePage = ltrim( str_replace('index.php', '', $shHomePage), '/');
  $shHomePage = ltrim( str_replace('index.php', '', $shHomePage), '?');
  //echo '$shHomePage '.$shHomePage.'<br />';
  //echo '$currentPage '.$currentPage.'<br />';
  return  $currentPage == $shHomePage;
}  

// V 1.2.4.q finalize url. Would be nicer to integrate it in TtitleToLocation(). Would work for native plugins, artio 
// and sefAdvanced, but not for OpenSEF plugins (as they don't use sefEncode)

function shUrlEncode( $path) {
  $ret = $path;
  //echo 'path = '.$path.'<br />';
  if (!empty($path)) {
    $bits = explode('/', $path);
    $enc = array();
    if (count($bits)) {
      foreach ($bits as $key=>$value) {
        $enc[$key] = urlencode($value); 
      }
      //var_dump($enc);
      $ret = implode($enc,'/');
      //echo 'ret = '.$ret.'<br />';
    }  
  }
  return $ret;
}
function shUrlDecode( $path) {
  $ret = $path;
  //echo 'path = '.$path.'<br />';
  if (!empty($path)) {
    $bits = explode('/', $path);
    $dec = array();
    if (count($bits)) {
      foreach ($bits as $key=>$value) {
        $dec[$key] = urldecode($value);  
      }
      //var_dump($dec);
      $ret = implode($dec,'/');
      //echo 'ret = '.$ret.'<br />';
    }  
  }
  return $ret;
}

function shFinalizeURL( $url) {
  global $sefConfig;
  //echo 'url = '.$url.'<br />';
  if (!empty($url) && $sefConfig->shEncodeUrl) {
    $URI = new Net_URL($url);
    // V 1.2.4.l need to save unsorted URL
    if (!empty($URI->path)) {
    //var_dump($URI);
    $url = $URI->protocol.'://'.$URI->host.shUrlEncode( $URI->path);
    if (count($URI->querystring) > 0) {
      $url .= '?';
      foreach ($URI->querystring as $key=>$value)
        $url.= $key.'='.shUrlEncode($value);
    }
    if ($URI->anchor)
      $url .= '#'.shUrlEncode($URI->anchor);    
    //echo 'result = '.$url.'<br />';
    } 
  }
  return $url;
}
// V 1.2.4.m
global $shHomeLink;
$shHomeLink = null;

function sefRelToAbs($string, $shLanguageParam = null)
// shumisha end of fix
{
    global $database, $sefConfig, $_SEF_SPACE, $mosConfig_lang,
           // shumisha 2007-03-13 added URL caching 
           $shGETVars, $shRebuildNonSef,
           // V 1.2.4.m
           $shHomeLink,
           // V 1.2.4.q
           $mosConfig_live_site, $shHttpsSave;
    
    // V 1.2.4.q quick fix for shared SSL server : if https, switch to non sef
    if (!empty($shHttpsSave) && $sefConfig->shForceNonSefIfHttps ) {
      return shFinalizeURL($string);
    }  
    // shumisha end of change
    $debug = 0;
    // V 1.2.4.m now we have a target language for every call. It is stored in static variable, but
    // can be overriden at every call of the function
    $shLanguage = isset($shLanguageParam) ? $shLanguageParam : $mosConfig_lang;
    //echo '$string = '.$string.'<br />';
    //echo '$shLanguageParam : '.$shLanguageParam.'<br />';
    //echo '$mosConfig_lang : '.$mosConfig_lang.'<br />';
    //die();  
    //if ($string == 'index.php') $shFlag = 1; else $shFlag = 0;
   
    // V 1.2.4.k added homepage check : needed in case homepage is not com_frontpage
    if (empty($shHomeLink)) {  // first, find out about homepage link, from DB. homepage is not always /index.php or similar
                               // it can be a link to anything, a page, a component,...
      // V 1.2.4.q modified query, first item of menu is not always ordering = 1 !!!                          
      //$query = "SELECT `id`,`link` FROM #__menu where ((`menutype`='mainmenu') AND (`published` > 0) AND (`ordering`='1') AND (`parent` = 0) AND (`access` >= '".(isset($my) ? (intval(@$my->id)) : 0)."'))";	
      //$database->setQuery($query);
      $query = "SELECT `id`,`link` FROM #__menu where ((`menutype`='mainmenu') AND (`published` > 0) AND (`access` >= '".(isset($my) ? (intval(@$my->id)) : 0)."')) ORDER BY parent, ordering";	
      $database->setQuery($query, 0, 1);
      $database->loadObject( $shHomePage);
      if ($shHomePage) {
        if ( (substr( $shHomePage->link, 0, 9) == 'index.php')  // if link on homepage is a local page  
            && (!preg_match( '/Itemid=[0-9]*/', $shHomePage->link))) {  // and it does not have an Itemid
          $shHomePage->link .= ($shHomePage->link == 'index.php' ? '?':'&').'Itemid='.$shHomePage->id;  // then add itemid
        }
        $shHomeLink = $shHomePage->link;
        //echo '$homeLink 1 = '.$homeLink.'<br />';
        if (!strpos($shHomeLink,'lang=')) {
          // V 1.2.4.q protect against not existing
          if (!empty($GLOBALS['mosConfig_mbf_content']))
			      $shDefaultIso = shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang']);
			    else $shDefaultIso = shGetIsoCodeFromName($mosConfig_lang);  
				  //echo '$shDefaultIso = '.$shDefaultIso.'<br />';
          $shSepString = (substr($shHomeLink, -9) == 'index.php' ? '?':'&');
          //echo '$shSepString = '.$shSepString.'<br />';
          $shHomeLink .= $shSepString.'lang='.$shDefaultIso;
          //echo '$homeLink 2 = '.$homeLink.'<br />';
      }
        $shHomeLink = shSortUrl($shHomeLink);  // $shHomeLink has lang info, whereas $homepage->link may or may not
        //echo '$homeLink 3 = '.$homeLink.'<br />';
      }  
      //echo '$homeLink 4 = '.$homeLink.'<br />';
      //die();
    }
    if ($shHomeLink) {  // now check URL against our homepage, so as to always return / if homepage
      $v1 = ltrim(str_replace($mosConfig_live_site, '', $string), '/');
      //if ($shFlag) echo '$V1 = '.$v1.'<br />';
      // V 1.2.4.m : remove anchor if any
      $v2 = explode( '#', $v1);
      $v1 = $v2[0];
      $shAnchor = isset($v2[1]) ? '#'.$v2[1] : '';
      $shSepString = (substr($v1, -9) == 'index.php' ? '?':'&');
      $shLangString = $shSepString.'lang='.shGetIsoCodeFromName($shLanguage);
      //if ($shFlag) echo '$shLangString = '.$shLangString.'<br />';
      if (!strpos($v1,'lang=')) {
        $v1 .= $shLangString;
      }
      //if ($shFlag) echo '$V1-2 = '.$v1.'<br />';
      $v1 = str_replace('&amp;', '&', shSortURL($v1));
      //if ($shFlag) echo '$V1-3 = '.$v1.'<br />';
      //if ($shFlag) echo '$shHomeLink = '.$shHomeLink.'<br />';
      if ($v1 == $shHomeLink || $v1 == 'index.php'.$shLangString) {
        //if ($string == 'index.php')
           //echo 'Returning home : #'.$v1.'# VS '.$shHomeLink.'<br />';
        return shFinalizeURL($GLOBALS['mosConfig_live_site'].'/'.$shAnchor);
      }
      // homepage can also be just index.php
       
      //else if ($string == 'index.php') 
        //echo 'NOT Returning home 1 : #'.$v1.'# VS '.$shHomeLink.'<br />';   
    }
     //if ($string == 'index.php') 
       //echo 'NOT Returning home 2'.'<br />'; 
   
    // V 1.2.4.j string to be appended to URL, but not saved to DB
    $shAppendString = '';
    $shRebuildNonSef = array();
    
    $newstring = str_replace($GLOBALS['mosConfig_live_site'].'/', '', $string);
    //echo '<br />000000000'.$newstring.'000000'.shSortURL($newstring).'000000'.'<br />';
    //die();
    if ((!strcasecmp(substr($newstring,0,9), 'index.php'))
    && !eregi('^(([^:/?#]+):)', $newstring)
    && !eregi('this\.options\[selectedIndex\]\.value', $newstring) // V 1.2.4.q did not understand why, but need to leave this here or will break Search module operation. This text gets into $limit variable
    )
    {
        // Replace & character variations.
        $string = str_replace(array('&amp;', '&#38;'), array('&', '&'), $newstring);
        $newstring = $string; // V 1.2.4.q
        $shSaveString = $string;
        //echo 'shSaveString = '.$shSaveString.'<br />';
        // warning : must add &lang=xx (only if it does not exists already), so as to be able to recognize the SefURL in the db if it's there
        if (!strpos($string,'lang=')) {
          $shSepString = (substr($string, -9) == 'index.php' ? '?':'&');
          $anchorTable = explode('#', $string); // V 1.2.4.m remove anchor before adding language
          $string = $anchorTable[0];
          $string .= $shSepString.'lang='.shGetIsoCodeFromName($shLanguage)
             .(!empty($anchorTable[1])? '#'.$anchorTable[1]:''); // V 1.2.4.m then stitch back anchor
        }
        $URI = new Net_URL($string);
        // V 1.2.4.l need to save unsorted URL
        if (count($URI->querystring) > 0) {
            // Import new vars here.
            $option = null;
            $task = null;
            $sid = null;
            // sort GET parameters to avoid some issues when same URL is produced with options not
            // in the same order, ie index.php?option=com_virtuemart&category_id=3&Itemid=2&lang=fr
            // Vs index.php?category_id=3&option=com_virtuemart&Itemid=2&lang=fr
            ksort($URI->querystring);  // sort URL array
            $string = shSortUrl($string);
            // now we are ready to extract vars
            $shGETVars = $URI->querystring;
            extract($URI->querystring, EXTR_REFS);
        }
        $shOption = str_replace('com_', '', $option);
        switch ($shOption) {
          case (in_array($shOption, $sefConfig->skip)): 
            $shComponentType = 'skip';
          break;
          case (in_array($shOption, $sefConfig->nocache)):
            $shComponentType = 'noCache'; 
          break;
          default:
            $shComponentType = 'sh404SEF';
          break;
        }  
       //echo '$option = '.$option.' | $componentType = '.$shComponentType.'<br />';
        // is there a named anchor attached to $string? If so, strip it off, we'll put it back later.
        if ($URI->anchor) 
          //$string = str_replace('#$URI->anchor', '', $string);
          $string = str_replace("#$URI->anchor", '', $string);  // V 1.2.4.m

        if ($debug) {
            $GLOBALS['404SEF_DEBUG']['sefRelToAbs'][$string]= $URI;
            $debug_string = $string;
        }
        
        // shumisha special homepage processing (in other than defautl language)
        // clean up language information, to recognize home page
        //$newstring = preg_replace( '/&amp;lang=[a-zA-Z]{2,3}/iU', '', $newstring);
        //echo '2222222222'.$shHomeLink.'2222'.$newstring.'2222222'.'<br />';
        if  ((shIsHomePage($newstring)) || ($newstring == 'index.php') 
            ){ // this is regular frontpage, but in other language than default
          // shumisha 2007-03-13 URL caching
          // fetch SEF URL from cache if available
          //echo 'aaaaaaaaaaaaaa'.$shHomeLink.'aaaaa'.$newstring.'aaaaaa'.'<br />';
          if ($sefConfig->shUseURLCache)
            $sefstring = shGetSefURLFromCache($string);
          else $sefstring = '';
          // Check if the url is already saved in the database.
          if (!$sefstring) {
          //echo '111111'.$newstring.'11111111';
            if (!$sefstring = getSefUrlFromDatabase($string)) {
              require_once($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext.php');
              $sef_ext = new sef_404();
              // Rewrite the URL now.
              $sefstring = $sef_ext->create($string, $URI->querystring, $shAppendString, $shLanguage);
            }
            // shumisha 2007-03-14 added URL caching : rebuild cache if it has been deleted
            // while sefURL are still in DB
          else if ($sefConfig->shUseURLCache) shAddSefURLToCache( $string, $sefstring);
            // shumisha end of addition
          }  
          // return homepage (+iso which was added by $sef_ext->create)

          // V 1.2.4.j : added $shAppendString to pass non sef parameters. For use with parameters that won't be stored in DB
          $ret = (($sefConfig->LowerCase) ? strtolower($GLOBALS['mosConfig_live_site'].'/'.$sefstring.$shAppendString) : $GLOBALS['mosConfig_live_site'].'/'.$sefstring.$shAppendString);
          //echo 'return 1 = '.shFinalizeURL($ret).'<br />';
          //die();
          return shFinalizeURL($ret);
       }  
        // Reconnect the sid to the url for further processing as per original code
        if (isset($sid)) {
          $sefstring .= '?sid=' . $sid;
        }
        // shumisha end of addition 
        //Predefined is bepaald in het configbestand
        //Skip is bepaald in de backend
        //Waarom geen nieuw en edit?
        //if (   !(  (isset($task) ? ((@$task == "new")|(@$task == "edit")) : false)  )    && isset($option)   ) {
        if (isset($option) && @$task != 'edit') {
            /*Beat: sometimes task is not set, e.g. when $string = "index.php?option=com_frontpage&Itemid=1" */
            switch ($shComponentType) {
                case 'skip': {
                    //$sefstring = $string;
                    $sefstring = $shSaveString;  // V 1.2.4.q : restore untouched URL, except anchor
                                                 // which will be added later
                    break;
                }
                case 'noCache': {
                    if (isset($URI)) unset($URI);
                    $sefstring = 'component/';
                    $URI = new Net_URL($shSaveString);
                    if (count($URI->querystring) > 0) {
                      foreach($URI->querystring as $key => $value) {
                        $sefstring .= "$key,$value/";
                      }
                      $sefstring = str_replace( 'option/', '', $sefstring );
                    }
                    break;
                }
                default: {
                    // shumisha 2007-03-13 URL caching
                    // before anything, try to load from cache
                   // fetch SEF URL from cache if available
                   if ($sefConfig->shUseURLCache) {
                     $sefstring = shGetSefURLFromCache($string);
                   }
                   else $sefstring = '';  
                   if (!$sefstring) {
                   // shumisha end of change for URL caching
                    // If component has its own sef_ext plug-in included.
                        $shDoNotOverride = in_array( $shOption, $sefConfig->shDoNotOverrideOwnSef);
                        //echo '$shDoNotOverride :'.$shDoNotOverride.' = '.$shOption.'<br />';
                        if ((file_exists($GLOBALS['mosConfig_absolute_path'].'/components/'.$option.'/sef_ext.php'))
                          && ($shDoNotOverride                   // and param said do not override 
                              || (!$shDoNotOverride              // or param said override, but we don't have a plugin   
                                 && !file_exists($GLOBALS['mosConfig_absolute_path']
                                 .'/components/com_sef/sef_ext/'.$option.'.php'))  )) {
                          // Load the plug-in file.
                          require_once($GLOBALS['mosConfig_absolute_path'].'/components/'.$option.'/sef_ext.php');
                        $_SEF_SPACE = $sefConfig->replacement;
                        $comp_name = str_replace('com_', '', $option);
                        eval("\$sef_ext = new sef_$comp_name;");
                        $title[] = getMenuTitle($option, null, null, null, $shLanguage); // V 1.2.4.m
                        //echo '$getMenuTitle :'; var_dump($title); echo '<br />';
                        $string = str_replace('&', '&amp;', $string);
                        //echo '$string :'.$string.'<br />';
                        $sefstring = $sef_ext->create($string);
                        //echo '$sefstring :'.$sefstring.'<br />';
                        // V 1.2.4.p : sef_ext extensions for opensef/SefAdvance do not always replace '
                        $sefstring = str_replace( '\'', $sefConfig->replacement, $sefstring);
                        //echo '$sefstring :'.$sefstring.' = '.$string.'<br />';
                        if ($sefstring == $string)
                            return shFinalizeURL($string);
                        else {
                            $sefstring = str_replace(' ', $_SEF_SPACE, $sefstring);
                            $sefstring = str_replace(' ', '', 
                                (shInsertIsoCodeInUrl($option, $shLanguage) ?   // V 1.2.4.q
                                   shGetIsoCodeFromName($shLanguage).'/' : '')
                                .titleToLocation($title[0]).'/'.$sefstring.(($sefstring != '') ? $sefConfig->suffix : ''));
                            $sefstring = str_replace('/'.$sefConfig->suffix, $sefConfig->suffix, $sefstring);
                            //echo '$sefstring2 :'.$sefstring.'<br />';
                            // V 1.2.4.m store it in DB so as to be able to use sef_ext plugins really !
                            $shSefString = (($sefConfig->LowerCase) ? strtolower($sefstring) : $sefstring);
                            $shSefString = str_replace('itemid', 'Itemid', $shSefString);
                            $string = str_replace('&amp;', '&', $string);
                            // V 1.2.4.p check for various URL for same content
                            if ($sefConfig->shUseURLCache)
                              $dburl = shGetNonSefURLFromCache($shSefString);
                            if (!$dburl) {  // V 1.2.4.q 
                              $sql = "SELECT newurl, rank FROM #__redirection WHERE oldurl = '".$shSefString."' ORDER BY rank ASC";
                              $newMaxRank = 0;
				                      $database->setQuery($sql);
                              $dbUrlList = $database->loadObjectList();
                              if (count($dbUrlList) > 0) {
                                $dburl = $dbUrlList[0]->newurl;
                                $newMaxRank = $dbUrlList[count($dbUrlList)-1]->rank+1;
                              }
                            }     
				                    if (empty($dburl)) {  // if no sef url with same non-sef url, we can add this new redirection 
						                  $query = "INSERT INTO #__redirection (rank, oldurl, newurl) ".  // V 1.2.4.q
						                           "VALUES ('".$newMaxRank."','".$shSefString."', '".addslashes(urldecode($string))."')";
						                  $database->setQuery($query);
						                  if (!$database->query()) {
							                  var_dump($query);
						                  }
 						                  shAddSefURLToCache( $string, $shSefString);
 						                }  
                        }
                    }
                    // Component has no own sef extension.
                    else {
                        // Ensure that the session IDs are removed.
			//echo 'Spot 2 :'.$string.' = '.$sefstring.'<br />';
                        if (isset($sid)) $string = str_replace("sid=$sid", '', $string);
                        $string = trim($string, "&?");
                        // Check if the url is already saved in the database.
                        //echo '3333333333333333'.$string.'33333'.$newstring.'33333';
                        if (!$sefstring = getSefUrlFromDatabase($string)) {
			//echo 'Spot 3 :'.$string.' = '.$sefstring.'<br />';
			                      // V 1.2.4.q a trial in better handling homepage articles
			         //echo '$string = '.$string.'<br />';
                           
              if (shIsCurrentPageHome() && ($option == 'com_content')    // com_content component on homepage
                  && $sefConfig->guessItemidOnHomepage) {
                $string = preg_replace( '/(&|\?)Itemid=[^&]*/i', '', $string);  // we remove Itemid, as com_content plugin
                $Itemid = null;                                     // will hopefully do a better job at finding the right one
                unset($URI->querystring['Itemid']);
                unset($shGETVars['Itemid']);
                                                                        
                //echo '$string  remove Itemid= '.$string.'<br />';
                //echo '$URI->querystring = ';
                //var_dump($URI->querystring);
                //echo '<br />';  
                //echo '$Itemid= '.$Itemid.'<br />';                                                          
              }
                            require_once($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext.php');
                            $sef_ext = new sef_404();

                            // Rewrite the URL now.
                            $sefstring = $sef_ext->create($string, $URI->querystring, $shAppendString, $shLanguage);
			    //echo 'Spot 4 :'.$string.' = '.$sefstring.'<br />';
                        }
                        // shumisha 2007-03-14 added URL caching : rebuild cache if it has been deleted
                        // while sefURL are still in DB (why would this happen ????)
                        else if ($sefConfig->shUseURLCache) {
			  //echo 'Spot 5 :'.$string.' = '.$sefstring.'<br />';
			                     shAddSefURLToCache( $string, $sefstring);
			                  }
                        // shumisha end of addition
                        // Reconect the sid to the url.
                        if (isset($sid)) {
                            $sefstring .= '?sid=' . $sid;
                        }
                    }
                }
            }
            } // end of cache check shumisha
            if ($debug){ $GLOBALS['404SEF_DEBUG']['sefRelToAbs']['SEF_EXT'][$debug_string] = $sef_ext;}
            if (isset($sef_ext)) unset($sef_ext);
            //$string =  $GLOBALS['mosConfig_live_site']."/".$sefstring.(($URI->anchor)?"#".$URI->anchor:"");
            // V 1.2.4.j
            $string =  $GLOBALS['mosConfig_live_site']."/".$sefstring.$shAppendString.(($URI->anchor)?"#".$URI->anchor:"");
        }
        $ret = (($sefConfig->LowerCase) ? strtolower($string) : $string);
        $ret = str_replace('itemid', 'Itemid', $ret);
    }
    if (!isset($ret)) $ret = $string;
    if ($debug){ $GLOBALS['404SEF_DEBUG']['sefRelToAbs']['RET'][$debug_string] = $ret;}
    //echo 'return 2 = '.$ret.'<br />';
    //echo 'return 3 = '.shFinalizeURL($ret).'<br />';
    //die();
    return shFinalizeURL($ret);
}

// V 1.2.4.p compatibility function with SEFAdvance
function sefencode( $string) {
  return titleToLocation( $string);
}

function titleToLocation(&$title)
{
    global $sefConfig;

    // remove accented characters v1.2.4.f April 4, 2007 : replaced by backend parameter
    //$title = strtr($title, "ŠŒŽšœžŸ¥µÀÁÂÃÄÅÆÇÈÉÊËÌÍÎÏÐÑÒÓÔÕÖØÙÚÛÜÝßàáâãäåæçèéêëìíîïðñòóôõöøùúûüýÿ", "SOZsozYYuAAAAAAACEEEEIIIIDNOOOOOOUUUUYsaaaaaaaceeeeiiiionoooooouuuuyy");
    // V 1.2.4.q
    $shRep = $sefConfig->shGetReplacements();
    //echo 'shrep<br />';
    //var_dump($shRep);
    if (!empty($shRep))
      $title = strtr($title, $shRep);
    //echo 'shrep fin<br />';
    // remove quotes, spaces, and other illegal characters
    //$title = preg_replace(array('/\'/', '/[^a-zA-Z0-9\-!.,+]+/', '/(^_|_$)/'), array('', $sefConfig->replacement, ''), $title);
    // shumisha 2007-04-15 single quotes should not be removed but replaced by replacement characters, as this will otherwise
    // make some words loose their meaning in some languages
    if (!$sefConfig->shEncodeUrl)  // V 1.2.4.q only remove weird chars if we don't encode URL
      $title = preg_replace(array('/\'/', '/[^a-zA-Z0-9\-!.,+]+/', '/(^_|_$)/'), array($sefConfig->replacement, $sefConfig->replacement, ''), $title);
    
    // V 1.2.4.j remove leading and trailing separator
    $title = trim( $title, $sefConfig->replacement);
    
    $title = (($sefConfig->LowerCase) ? strtolower($title) : $title);
    return $title;
}

// V 1.2.4.q utility function to clean language and pagination info from url
function shCleanUpLangAndPag( $string) {
  $shTempString = preg_replace( '/(&|\?)lang=[a-zA-Z]{2,3}/iU', '', $string);
  $shTempString = preg_replace( '/(&|\?)limit=[^&]*/i', '', $shTempString);
  $shTempString = preg_replace( '/(&|\?)limitstart=[^&]*/i', '', $shTempString);
  return $shTempString;
}
// V 1.2.4.q detect homepage, disregarding language and pagination
function shIsHomepage( $string) {
  global $shHomeLink, $mosConfig_live_site; 
  $shTempString = rtrim(str_replace($mosConfig_live_site, '', $string), '/');
  return shCleanUpLangAndPag($shTempString) == shCleanUpLangAndPag($shHomeLink);
}

function getMenuTitle($option, $task, $id = null, $string = null, $shLanguage = null)
{
    global $database, $sefConfig, $shHomeLink;
    //echo 'Id = '.$id.'<br />';
    $debug = 0;
    //echo 'language dans getMenuTitle : '.$shLanguage.'<br />';
    
    // V 1.2.4.q must also check if homepage, in any language. If homepage, must return $title[]='/'
    // language info and limit/limistart pagination will be added at final stage by sefGetLocation()
    
    if (!empty($string)) {  // V 1.2.4.q replaced isset by empty
      $sql = "SELECT name, link, id".($sefConfig->shTranslateURL?',id':'')." FROM #__menu WHERE link = '$string'";
    }
    elseif (!empty($id)) {
       $sql = "SELECT name, link, id".($sefConfig->shTranslateURL?',id':'')." FROM #__menu WHERE id = '".$id."'";
    }
    else {
        $sql = "SELECT name, link, id".($sefConfig->shTranslateURL?',id':'')." FROM #__menu WHERE link = 'index.php?option=".$option."'";
    }
    $database->setQuery($sql);
    //echo '$shLang  getMenuTitle = '.$shLanguage.'<br />';
    if (isset($shLanguage) && !empty($GLOBALS[ 'mosConfig_mbf_content' ])) {
      $rows = @$database->loadObjectList( '', true, $shLanguage);
      }
    else {
      $rows = @$database->loadObjectList( ); }
    if ($debug) {
        $GLOBALS['404SEF_DEBUG']['getMenuTitle']['ROWS-'.$option."-".$task] = $rows;
        echo"</pre>";
    }

    if ($database->getErrorNum()) {
        die( $database->stderr() );
    }
    elseif(@count($rows) > 0) {
    //echo '$rows[0]->name = '.$rows[0]->name.'<br />';
    //echo '$rows[0]->link = '.$rows[0]->link.'<br />';
    //echo '$rows[0]->id = '.$rows[0]->id.'<br />';
    $shLink = shSortUrl($rows[0]->link.($rows[0]->link == 'index.php' ? '?':'&').'Itemid='.$rows[0]->id);
    //echo '$shLink = '.$shLink.'<br />';
      if (!shIsHomepage( $shLink)) {  // V1.2.4.q homepage detection
        if(!empty($rows[0]->name)) {
            $title = strtolower($rows[0]->name);
        }
      } else $title = '/'; // this is homepage
    }
    else {
        $title = str_replace('com_', '', $option);
    }
    return $title;
}

function getSefUrlFromDatabase($url)
{
    global $database;
    //echo 'Select sef404<br />';
    $query = "SELECT oldurl FROM #__redirection WHERE newurl = '".$url."'";
    $database->setQuery($query, 0, 1);
    if ($database->loadObject($result)) { 
      return $result->oldurl;
    } else 
      return false;  
}



?>
