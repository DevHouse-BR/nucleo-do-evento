<?php
/**
 * SEF module for Joomla!
 * Originally written for Mambo as 404SEF by W. H. Welch.
 *
 * @author      $Author: shumisha $
 * @copyright   Yannick Gaultier - 2007
 * @package     sh404SEF
 * {shSourceVersionTag: V 1.2.4.q - 2007-06-10}
 */

// Security check to ensure this file is being included by a parent file.
if (!defined('_VALID_MOS')) die('Direct Access to this location is not allowed.');


global $_SEF_SPACE, $lowercase;
class sef_component
{

    function revert (&$url_array, $pos)
    {
		global $_SEF_SPACE;

		$QUERY_STRING = '';

		if (strcspn ($url_array[1], ',') == strlen($url_array[1])) {
			// This is a nocache url
			$x = 0;
			$c = count($url_array);
			while ($x < $c) {
				if (isset($url_array[$x]) && $url_array[$x] != '' && isset($url_array[$x + 1]) && $url_array[$x + 1] != '') {
					$_GET[$url_array[$x]] = $_REQUEST[$url_array[$x]] = $url_array[$x + 1];
					$QUERY_STRING .= '&'.$url_array[$x].'='.$url_array[$x + 1];
				}
				$x += 2;
			}
		}
		else {
			//This is a default mambo SEF url for a component
			foreach($url_array as $value) {
				$temp = explode(",", $value);
				if (isset($temp[0]) && $temp[0] != '' && isset($temp[1]) && $temp[1]!="") {
					$_GET[$temp[0]] = $_REQUEST[$temp[0]] = $temp[1];
					$QUERY_STRING .= "&$temp[0]=$temp[1]";
				}
			}
		}
		
		return str_replace("&option","option",$QUERY_STRING);
	}
}

class sef_content
{

	function revert (&$url_array, $pos)
	{ // V 1.2.4.l  // updated based on includes/sef.php.
	  $uri 				= explode('content/', $_SERVER['REQUEST_URI']);
		$option 			= 'com_content';
		$_GET['option'] 	= $option;
		$_REQUEST['option'] = $option;
		$pos 				= array_search ('content', $url_array);

		// language hook for content
		$lang = '';
		foreach($url_array as $key=>$value) {
			if ( !strcasecmp(substr($value,0,5),'lang,') ) {
				$temp = explode(',', $value);
				if (isset($temp[0]) && $temp[0] != '' && isset($temp[1]) && $temp[1] != '') {
					$_GET['lang'] 		= $temp[1];
					$_REQUEST['lang'] 	= $temp[1];
					$lang 				= $temp[1];
				}
				unset($url_array[$key]);
			}
		}

		if (isset($url_array[$pos+8]) && $url_array[$pos+8] != '' && in_array('category', $url_array) && ( strpos( $url_array[$pos+5], 'order,' ) !== false ) && ( strpos( $url_array[$pos+6], 'filter,' ) !== false ) ) {
			// $option/$task/$sectionid/$id/$Itemid/$order/$filter/$limit/$limitstart
			$task 					= $url_array[$pos+1];
			$sectionid				= $url_array[$pos+2];
			$id 					= $url_array[$pos+3];
			$Itemid 				= $url_array[$pos+4];
			$order 					= str_replace( 'order,', '', $url_array[$pos+5] );
			$filter					= str_replace( 'filter,', '', $url_array[$pos+6] );
			$limit 					= $url_array[$pos+7];
			$limitstart 			= $url_array[$pos+8];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['sectionid'] 		= $sectionid;
			$_REQUEST['sectionid'] 	= $sectionid;
			$_GET['id'] 			= $id;
			$_REQUEST['id'] 		= $id;
			$_GET['Itemid'] 		= $Itemid;
			$_REQUEST['Itemid'] 	= $Itemid;
			$_GET['order'] 			= $order;
			$_REQUEST['order'] 		= $order;
			$_GET['filter'] 		= $filter;
			$_REQUEST['filter'] 	= $filter;
			$_GET['limit'] 			= $limit;
			$_REQUEST['limit'] 		= $limit;
			$_GET['limitstart'] 	= $limitstart;
			$_REQUEST['limitstart'] = $limitstart;

			$QUERY_STRING = "option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid&order=$order&filter=$filter&limit=$limit&limitstart=$limitstart";
		} else if (isset($url_array[$pos+7]) && $url_array[$pos+7] != '' && $url_array[$pos+5] > 1000 && ( in_array('archivecategory', $url_array) || in_array('archivesection', $url_array) ) ) {
			// $option/$task/$id/$limit/$limitstart/year/month/module
			$task 					= $url_array[$pos+1];
			$id						= $url_array[$pos+2];
			$limit 					= $url_array[$pos+3];
			$limitstart 			= $url_array[$pos+4];
			$year 					= $url_array[$pos+5];
			$month 					= $url_array[$pos+6];
			$module					= $url_array[$pos+7];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['id'] 			= $id;
			$_REQUEST['id'] 		= $id;
			$_GET['limit'] 			= $limit;
			$_REQUEST['limit'] 		= $limit;
			$_GET['limitstart'] 	= $limitstart;
			$_REQUEST['limitstart'] = $limitstart;
			$_GET['year'] 			= $year;
			$_REQUEST['year'] 		= $year;
			$_GET['month'] 			= $month;
			$_REQUEST['month'] 		= $month;
			$_GET['module']			= $module;
			$_REQUEST['module']		= $module;

			$QUERY_STRING = "option=com_content&task=$task&id=$id&limit=$limit&limitstart=$limitstart&year=$year&month=$month&module=$module";
		} else if (isset($url_array[$pos+7]) && $url_array[$pos+7] != '' && $url_array[$pos+6] > 1000 && ( in_array('archivecategory', $url_array) || in_array('archivesection', $url_array) ) ) {
			// $option/$task/$id/$Itemid/$limit/$limitstart/year/month
			$task 					= $url_array[$pos+1];
			$id						= $url_array[$pos+2];
			$Itemid 				= $url_array[$pos+3];
			$limit 					= $url_array[$pos+4];
			$limitstart 			= $url_array[$pos+5];
			$year 					= $url_array[$pos+6];
			$month 					= $url_array[$pos+7];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['id'] 			= $id;
			$_REQUEST['id'] 		= $id;
			$_GET['Itemid'] 		= $Itemid;
			$_REQUEST['Itemid'] 	= $Itemid;
			$_GET['limit'] 			= $limit;
			$_REQUEST['limit'] 		= $limit;
			$_GET['limitstart'] 	= $limitstart;
			$_REQUEST['limitstart'] = $limitstart;
			$_GET['year'] 			= $year;
			$_REQUEST['year'] 		= $year;
			$_GET['month'] 			= $month;
			$_REQUEST['month'] 		= $month;

			$QUERY_STRING = "option=com_content&task=$task&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart&year=$year&month=$month";
		} else if (isset($url_array[$pos+7]) && $url_array[$pos+7] != '' && in_array('category', $url_array) && ( strpos( $url_array[$pos+5], 'order,' ) !== false )) {
			// $option/$task/$sectionid/$id/$Itemid/$order/$limit/$limitstart
			$task 					= $url_array[$pos+1];
			$sectionid				= $url_array[$pos+2];
			$id 					= $url_array[$pos+3];
			$Itemid 				= $url_array[$pos+4];
			$order 					= str_replace( 'order,', '', $url_array[$pos+5] );
			$limit 					= $url_array[$pos+6];
			$limitstart 			= $url_array[$pos+7];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['sectionid'] 		= $sectionid;
			$_REQUEST['sectionid'] 	= $sectionid;
			$_GET['id'] 			= $id;
			$_REQUEST['id'] 		= $id;
			$_GET['Itemid'] 		= $Itemid;
			$_REQUEST['Itemid'] 	= $Itemid;
			$_GET['order'] 			= $order;
			$_REQUEST['order'] 		= $order;
			$_GET['limit'] 			= $limit;
			$_REQUEST['limit'] 		= $limit;
			$_GET['limitstart'] 	= $limitstart;
			$_REQUEST['limitstart'] = $limitstart;

			$QUERY_STRING = "option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid&order=$order&limit=$limit&limitstart=$limitstart";
		} else if (isset($url_array[$pos+6]) && $url_array[$pos+6] != '') {
		// $option/$task/$sectionid/$id/$Itemid/$limit/$limitstart
			$task 					= $url_array[$pos+1];
			$sectionid				= $url_array[$pos+2];
			$id 					= $url_array[$pos+3];
			$Itemid 				= $url_array[$pos+4];
			$limit 					= $url_array[$pos+5];
			$limitstart 			= $url_array[$pos+6];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['sectionid'] 		= $sectionid;
			$_REQUEST['sectionid'] 	= $sectionid;
			$_GET['id'] 			= $id;
			$_REQUEST['id'] 		= $id;
			$_GET['Itemid'] 		= $Itemid;
			$_REQUEST['Itemid'] 	= $Itemid;
			$_GET['limit'] 			= $limit;
			$_REQUEST['limit'] 		= $limit;
			$_GET['limitstart'] 	= $limitstart;
			$_REQUEST['limitstart'] = $limitstart;

			$QUERY_STRING = "option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart";
		} else if (isset($url_array[$pos+5]) && $url_array[$pos+5] != '') {
		// $option/$task/$id/$Itemid/$limit/$limitstart
			$task 					= $url_array[$pos+1];
			$id 					= $url_array[$pos+2];
			$Itemid 				= $url_array[$pos+3];
			$limit 					= $url_array[$pos+4];
			$limitstart 			= $url_array[$pos+5];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['id'] 			= $id;
			$_REQUEST['id'] 		= $id;
			$_GET['Itemid'] 		= $Itemid;
			$_REQUEST['Itemid'] 	= $Itemid;
			$_GET['limit'] 			= $limit;
			$_REQUEST['limit'] 		= $limit;
			$_GET['limitstart'] 	= $limitstart;
			$_REQUEST['limitstart'] = $limitstart;

			$QUERY_STRING = "option=com_content&task=$task&id=$id&Itemid=$Itemid&limit=$limit&limitstart=$limitstart";
		} else if (isset($url_array[$pos+4]) && $url_array[$pos+4] != '' && ( in_array('archivecategory', $url_array) || in_array('archivesection', $url_array) )) {
		// $option/$task/$year/$month/$module
			$task 					= $url_array[$pos+1];
			$year 					= $url_array[$pos+2];
			$month 					= $url_array[$pos+3];
			$module 				= $url_array[$pos+4];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['year'] 			= $year;
			$_REQUEST['year'] 		= $year;
			$_GET['month'] 			= $month;
			$_REQUEST['month'] 		= $month;
			$_GET['module'] 		= $module;
			$_REQUEST['module']		= $module;

			$QUERY_STRING = "option=com_content&task=$task&year=$year&month=$month&module=$module";
		} else if (!(isset($url_array[$pos+5]) && $url_array[$pos+5] != '') && isset($url_array[$pos+4]) && $url_array[$pos+4] != '') {
		// $option/$task/$sectionid/$id/$Itemid
			$task 					= $url_array[$pos+1];
			$sectionid 				= $url_array[$pos+2];
			$id 					= $url_array[$pos+3];
			$Itemid 				= $url_array[$pos+4];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['sectionid'] 		= $sectionid;
			$_REQUEST['sectionid'] 	= $sectionid;
			$_GET['id'] 			= $id;
			$_REQUEST['id'] 		= $id;
			$_GET['Itemid'] 		= $Itemid;
			$_REQUEST['Itemid'] 	= $Itemid;

			$QUERY_STRING = "option=com_content&task=$task&sectionid=$sectionid&id=$id&Itemid=$Itemid";
		} else if (!(isset($url_array[$pos+4]) && $url_array[$pos+4] != '') && (isset($url_array[$pos+3]) && $url_array[$pos+3] != '')) {
		// $option/$task/$id/$Itemid
			$task 					= $url_array[$pos+1];
			$id 					= $url_array[$pos+2];
			$Itemid 				= $url_array[$pos+3];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['id'] 			= $id;
			$_REQUEST['id'] 		= $id;
			$_GET['Itemid'] 		= $Itemid;
			$_REQUEST['Itemid'] 	= $Itemid;

			$QUERY_STRING = "option=com_content&task=$task&id=$id&Itemid=$Itemid";
		} else if (!(isset($url_array[$pos+3]) && $url_array[$pos+3] != '') && (isset($url_array[$pos+2]) && $url_array[$pos+2] != '')) {
		// $option/$task/$id
			$task 					= $url_array[$pos+1];
			$id 					= $url_array[$pos+2];

			// pass data onto global variables
			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;
			$_GET['id'] 			= $id;
			$_REQUEST['id'] 		= $id;

			$QUERY_STRING = "option=com_content&task=$task&id=$id";
		} else if (!(isset($url_array[$pos+2]) && $url_array[$pos+2] != '') && (isset($url_array[$pos+1]) && $url_array[$pos+1] != '')) {
		// $option/$task
			$task = $url_array[$pos+1];

			$_GET['task'] 			= $task;
			$_REQUEST['task'] 		= $task;

			$QUERY_STRING = 'option=com_content&task='. $task;
		}

		if ($lang!='') {
			$QUERY_STRING .= '&amp;lang='. $lang;
		}

	return 	$QUERY_STRING;
	}

}

class sef_404
{

    function create($string, &$vars, &$shAppendString, $shLanguage)  // V 1.2.4.j shAppendString will be added to sef url, but not saved in DB or cache 
	{
		global $database, $sefConfig;

		$debug = 0;
    // V 1.2.4.m now we have a target language for every call. It is stored in static variable, but
    // can be overriden at every call of the function
    $title = null;
		$index = str_replace($GLOBALS['mosConfig_live_site'], '', $_SERVER['PHP_SELF']);
		$base  = dirname($index);
		$base .= ($base == '/') ? '' : '/';

		// In vars zitten de $option enzo.
		extract($vars);
		if ($debug) {
			$debug_string = $string;
			$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404'][$debug_string]['VARS']= $vars;
		}
		//var_dump($vars);
		// Plug-in system.
		if (file_exists($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext/'.$option.'.php')) {
			include($GLOBALS['mosConfig_absolute_path'].'/components/com_sef/sef_ext/'.$option.'.php');
		}
		else {
  	  $title[] = getMenuTitle($option, (isset($task) ? @$task : null), null, null, $shLanguage );
  	  //echo '$title = ';
      //var_dump($title); 
      //echo '<br />';
			if ($title[0] != '/') $title[] = '/';  // V 1.2.4.q getMenuTitle can now return '/'
			if (count($title) > 0) {
			    // V 1.2.4.q use $shLanguage insted of $lang  (lang name rather than lang code)
			    $string = sef_404::sefGetLocation($string, $title, (isset($task) ? @$task : null), (isset($limit) ? @$limit : null), (isset($limitstart) ? @$limitstart : null), (isset($shLanguage) ? @$shLanguage : null));
			}
		}
		//echo '<br />';
		//var_dump($title);
		//echo '<br />';
		//echo 'string = '.$string;
		//die();
		return $string;
	}

	function revert(&$url_array, $pos)
	{
		GLOBAL $database, $sefConfig;

		$debug=0;

		$QUERY_STRING ="";
		$req = str_replace("option/","",implode("/",$url_array));
		if ($debug) {$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404']['INITIAL_REQ']=$req;}

		// verify trailing slash and default filename if there is one

		if(!eregi($sefConfig->addFile."$",$req) && !eregi($sefConfig->suffix."$",$req)){
			//if there should be a filename add it on
			$req = $req.$sefConfig->addFile;
		}
		if(!eregi("/".$sefConfig->addFile."$",$req) && !eregi($sefConfig->suffix."$",$req)){
			//no suffix or filename entered so make sure there is a slash
			if(eregi($sefConfig->addFile."$",$req)) $req = substr($req,0,strlen($req)-strlen($sefConfig->addFile))."/".$sefConfig->addFile;
		}

		$req = str_replace("//","/",$req);
		if ($debug) {$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404']['REQ']=$req;}
		//$sql="SELECT oldurl, newurl FROM #__redirection WHERE oldurl LIKE '".$req."' LIMIT 1";
		$sql="SELECT oldurl, newurl FROM #__redirection WHERE oldurl = '".$req."' ORDER BY rank ASC LIMIT 1"; // V 1.2.4.q
		$database->setQuery($sql);

		if ($database->loadObject($row)) {
			// use the cached url
			$string = $row->newurl;
			// update the count
			//$database->setQuery("UPDATE #__redirection SET cpt=(cpt+1) WHERE `newurl` LIKE '".$row->newurl."'");
			$database->setQuery("UPDATE #__redirection SET cpt=(cpt+1) WHERE `newurl` = '".$row->newurl."' AND `oldurl` = '".$row->oldurl."'");  // V 1.2.4.q
			$database->query();
			$string = str_replace( '&amp;', '&', $string );
			$QUERY_STRING= str_replace("index.php?","",$string);
			parse_str($QUERY_STRING,$vars);
			//			$QUERY_STRING = str_replace( '&', '&amp;', $QUERY_STRING);
			if ($debug) {
				$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404']['QUERY_STRING'] = $QUERY_STRING;
				$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404']['VARS']= $vars;
			}
			$_GET = array_merge($_GET,$vars);
			$_REQUEST = array_merge($_REQUEST,$vars);
		}
		return $QUERY_STRING;
	}

	function getContentTitles($task,$id, $Itemid=0, $shLang = null)  // V 1.2.4.q can force language
	{
		global $database, $sefConfig, $mosConfig_lang;
    // shumisha end of fix
    //echo 'Itemid = '.$Itemid.'<br />';
		$title = array();
		$shLang = empty($shLang) ? $mosConfig_lang : $shLang;
		$sql = '';
		//echo '$shLang getContentTitles  = '.$shLang.'<br />';
		switch ($task) {
			case 'section':
			case 'blogsection':
				if (!empty($id)){ 
					$sql = "SELECT title AS section".($sefConfig->shTranslateURL?',id':'')." FROM #__sections WHERE id=$id";
				} else {
				$shTemp = getMenuTitle( null, $task, (isset($Itemid) ? @$Itemid : null), '', $shLang);
         //echo '$shTemp = '.$shTemp.'<br />'; 
          $title[] = getMenuTitle( null, $task, (isset($Itemid) ? @$Itemid : null), '',  
                                    $shLang);  // V 1.2.4.q force language 
				}
				if ($task == 'section')
          $title[] = _COM_SEF_SH_CAT_TABLE_SUFFIX;
				break;
			case 'category':
			case 'blogcategory':
			  // V 1.2.4.m replaced isset() by !empty()
				if (!empty($id)){  // if several cat in blogcategory, then id==0, so we don't get in here
				  // V 1.2.4.m if displaying a category or a category blog, we now disregard the 
          // $sefConfig->ShowCat param, as this would cause issue if set to false
					if ($sefConfig->ShowSection == true) {
					  // V 1.2.4.m if displaying a category or a category blog
						$sql = "SELECT s.title AS section".($sefConfig->shTranslateURL?',s.id AS secid ':'').", c.title AS category".($sefConfig->shTranslateURL?',c.id as catid':'') ." FROM #__categories as c ".
							"LEFT JOIN #__sections AS s ".
							"ON c.section=s.id ".
							"WHERE c.id=$id";
					}else{
						$sql = "SELECT title AS category".($sefConfig->shTranslateURL?',id':'')." FROM #__categories WHERE id=$id";
					}
				} else { // V 1.2.4.m if blogcategory with more than one category, then use getMenuTitle() instead
				   $title[] = getMenuTitle( null, $task, (isset($Itemid) ? @$Itemid : null), '', 
                                    $shLang);  // V 1.2.4.q force language
        }
        // V 1.2.4.q : add table suffix if task= category, to distinguish between blog cat and table cat
        if ($task == 'category')
          $title[] = _COM_SEF_SH_CAT_TABLE_SUFFIX;
				break;
			case 'view':
				if (!empty($id)){
				  //echo '$sefConfig->shTranslateURL  = '.$sefConfig->shTranslateURL.'<br />';
					if ($sefConfig->UseAlias == true) {
						// verify title alias is not empty
						$database->setQuery("SELECT title_alias".($sefConfig->shTranslateURL?',id':'')." FROM #__content WHERE id=$id");
						if ($ta = $database->loadResult())
							$title_field = "title_alias";
						else
							$title_field = "title";
					}else{
						$title_field = "title";
					}
				if (($sefConfig->ShowSection == true)||($sefConfig->ShowCat == false)) {
						// V 1.2.4.l bug and fix by alataka
            //$sql ="SELECT ".(($sefConfig->ShowSection == true) ? "s.title AS section".($sefConfig->shTranslateURL?',s.id':'')." AS secid,":"" )." ".
            $sql ="SELECT ".(($sefConfig->ShowSection == true) ? "s.title AS section".($sefConfig->shTranslateURL?',s.id AS secid, ':', '):"" )." ".
            //(($sefConfig->ShowCat == false) ? "":"c.title AS category," )." a.".$title_field." AS title FROM #__content as a ".
            // V 1.2.4.m  bug fix if ShowCat is false a.id instead of id
            //(($sefConfig->ShowCat == false) ? "":"c.title AS category".($sefConfig->shTranslateURL?',c.id AS catid':'').', ' )." a.".$title_field." AS title".($sefConfig->shTranslateURL?',id as id':'')." FROM #__content as a ".
            (($sefConfig->ShowCat == false) ? "":"c.title AS category".($sefConfig->shTranslateURL?',c.id AS catid':'').', ' )." a.".$title_field." AS title".($sefConfig->shTranslateURL?',a.id as id':'')." FROM #__content as a ".
							"LEFT JOIN #__sections AS s ".
							"ON a.sectionid=s.id ".
							"LEFT JOIN #__categories AS c ".
							"ON a.catid=c.id ".
							"WHERE a.id=$id"; 
					}else{
						$sql ="SELECT ".(($sefConfig->ShowCat == false) ? "":"c.title AS category".($sefConfig->shTranslateURL?',c.id AS catid':'').", " )." a.".$title_field." AS title".($sefConfig->shTranslateURL?',a.id as id':'')." FROM #__content as a ".
							"LEFT JOIN #__categories AS c ".
							"ON a.catid=c.id ".
							"WHERE a.id=$id";
					}
				}
				break;
			default :
				$sql ='';
		}
		if ($sql) {
			$row = null;
			$database->setQuery($sql);
			//$database->loadObject( $row ); // V 1.2.4.m
			if (isset($shLang) && !empty($GLOBALS[ 'mosConfig_mbf_content' ])) { // V 1.2.4.q  can force language
        $database->loadObject( $row, true, $shLang);
        //echo '$shLang  = '.$shLang.'<br />';
        //echo '$sql  = '.$sql.'<br />';
        //echo 'Option 1 : <br />';
        //var_dump($row);
      } else {
        $database->loadObject( $row );
        //echo 'Option 2 : <br />';
        //var_dump($row); 
      }
      //---------------------------------------------------------------------
			if (isset($row->section)) {
				$title[] = $row->section;
				if ($task == "section") $title[] = "/";
			}
			if (isset($row->category)) {
				$title[] = $row->category;
				if ($task == "category") $title[] = "/";
			}
			if (isset($row->title)) $title[] = $row->title;
		}
		return $title;
	}

	/**
	 * Vul in de array $title de onderdelen waaruit de link moet bestaan
	 * Bijvoorbeeld: menuitem, categorie, itemnaam
	 * Deze functie last de boel aan elkaar
	 *
	 * @param  string $url
	 * @param  array $title
	 * @param  string $task
	 * @param  int $limit
	 * @param  int $limitstart
	 * @return sefurl
	 */
	function sefGetLocation($url, &$title, $task = null, $limit = null, $limitstart = null, $langParam = null)
	{
		//GLOBAL $database, $sefConfig;
		GLOBAL $database, $sefConfig, $mosConfig_lang, $option,
           $shHomeLink;
		// shumisha end of change
		$debug = 0;
		$lang = empty($langParam) ? $mosConfig_lang : $langParam;
    // V 1.2.4.k added homepage check : needed in case homepage is not com_frontpage
    if (empty($shHomeLink)) {
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
        $shHomeLink = 'index.php';
        if (!strpos($shHomeLink,'lang=')) {
          if ($GLOBALS['mosConfig_mbf_content'])
			      $shDefaultIso = shGetIsoCodeFromName($GLOBALS['mosConfig_defaultLang']);
			    else $shDefaultIso = shGetIsoCodeFromName($mosConfig_lang);
          $shSepString = (substr($shHomeLink, -9) == 'index.php' ? '?':'&');
          $shHomeLink .= $shSepString.'lang='.$shDefaultIso;
      }
        $shHomeLink = shSortUrl($shHomeLink);  // $homeLink has lang info, whereas $homepage->link may or may not
      }  
    }
    // shumisha : try to avoid duplicate content when using Joomfish by always adding &lang=xx to url (stored in DB). 
    // warning : must add &lang=xx only if it does not exists already, which happens for the joomfish language selection modules or search results
    if (!strpos($url,'lang=')) {
      $shSepString = (substr($url, -9) == 'index.php' ? '?':'&');
      $url.= $shSepString.'lang='.shGetIsoCodeFromName($lang);
    }
    // shumisha end of fix
		//shorten the url for storage and for consistancy
		$url = str_replace( '&amp;', '&', $url );
    //echo '$url getloc = '.$url.'<br />';
    // V 1.2.4.q detect multipage homepage
    $shMultiPageHomePageFlag = shIsHomepage($url);
    /*if ($shMultiPageHomePageFlag) {
      echo '$string = '.$url.'<br />';
      echo '$lang = '.$lang.'<br />';
      var_dump($title);
      die();
    }*/
		// get all the titles ready for urls
		$location = array();
		foreach(array_filter($title) as $titlestring) {
			$location[] = titleToLocation($titlestring);
		}
		//remove unwanted characters - Ryan
		$finalstrip = explode("|", $sefConfig->stripthese);
		$takethese = str_replace("|", "", $sefConfig->friendlytrim);

		$imptrim = implode("/", $location);

     // shumisha protect against querying for empty location
		 if ($location == '')
       if ((!$GLOBALS[ 'mosConfig_mbf_content' ] || ($GLOBALS[ 'mosConfig_mbf_content' ] && ( $GLOBALS['mosConfig_defaultLang']== $lang))) && !$sefConfig->addFile
          && !$shMultiPageHomePageFlag) // V 1.2.4.q : need to go further and add pagination
         return ''; // if location is empty, and no Joomfish, or Joomfish but this is default language, then there is nothing to add to url before querying DB
     // shumisha end of change
    
		if(isset($task)){
			$task = str_replace($sefConfig->replacement."-".$sefConfig->replacement, $sefConfig->replacement, $task);
			$task = str_replace($finalstrip, "", $task);
			$task = trim($task,$takethese);
		}

		$imptrim = str_replace($sefConfig->replacement."-".$sefConfig->replacement, $sefConfig->replacement, $imptrim);
		$suffixthere = 0;
		if (eregi($sefConfig->suffix."$", $imptrim))
    {
			$suffixthere = strlen($sefConfig->suffix);
		}

		$imptrim = str_replace($finalstrip, $sefConfig->replacement, substr($imptrim, 0, strlen($imptrim)-$suffixthere));
		// shumisha 2007-04-08 was limiting sefurl lenght to 100 car !! now limit in db is 255
		//$imptrim = str_replace($sefConfig->replacement.$sefConfig->replacement, $sefConfig->replacement, ((strlen($imptrim)>100 - strlen($sefConfig->suffix) - strlen($GLOBALS['mosConfig_live_site'])) ? substr($imptrim, 0, strlen($imptrim) - $suffixthere) : $imptrim));
		$imptrim = str_replace($sefConfig->replacement.$sefConfig->replacement, $sefConfig->replacement, ((strlen($imptrim)>255 - strlen($sefConfig->suffix) - strlen($GLOBALS['mosConfig_live_site'])) ? substr($imptrim, 0, strlen($imptrim) - $suffixthere) : $imptrim));
		// shumisha end of fix

		$suffixthere = 0;
		if (eregi($sefConfig->suffix."$", $imptrim)) 
    {
			$suffixthere = strlen($sefConfig->suffix);
		}

		$imptrim = trim(substr($imptrim,0,strlen($imptrim)-$suffixthere), $takethese);

		$location = str_replace("//", "/", $imptrim.((isset($task)) ? "/".$task.$sefConfig->suffix : ""));
		$location = str_replace("//", "/", str_replace("/".$sefConfig->replacement, "/", $location));

		if ($debug) $GLOBALS['404SEF_DEBUG']['CLASS_SEF_404']['sefGetLocation'][$url] = $location;

		// attempt to intelligently detect page 0 of multi-page urls
		// they don't really need to be added.
//	they do need to be for me or the template doesnt load -Ryan
//		if (isset($limitstart)){
//			if ($limitstart == 0) {
//				$url = preg_replace("/\&limit=[0-9]+\&limitstart=0/","",$url);
//			}
//		}

		//check for non-sef url first and avoid repeative lookups
		//we only want to look for title variations when adding new
		//this should also help eliminate duplicates.
		// shumisha 2003-03-13 added URL Caching
		$realloc = shGetSefURLFromCache($url);
    if (empty($realloc)) {
    // shumisha end of addition
		$query = "SELECT oldurl from #__redirection WHERE newurl = '".$url."'";
		
		$database->setQuery($query);
		
		//if ($realloc = $database->loadResult()) {
		if ($database->loadObject($shTemp)) {
		  $realloc = $shTemp->oldurl;
    } else
      $realloc = false;
      
		if ($realloc) {
			// found a match, so we aredone
			//Dat betekent dus, dat de functie create(), slecht gekozen is
			// shumisha : removed this die() that I do not understand!
      //die('regel292 in sef_ext.php');
      // shumisha end of removal
		}
		else {
			// this is new, so we need to insert the new title.
			//Hier worden eindelijk de nieuwe links gemaakt
			$iteration = 1;
			$realloc = false;
			$prev_temploc = '';

			do {
				// Hier begint de loop met het toevoegen van de component/nummer.html
				// temploc is $location, unless we're on a second or greater iteration,
				// then its $location.$iteration
				// section reworked by Ryan
        // shumisha : not needed anymore, we always add language iso code later on
        //$suffix = (isset($lang) ? '_'.$lang : '').$sefConfig->suffix;
        $suffix = $sefConfig->suffix;
        // shumisha removal of test : prevent multiple pages to be processed properly
				//if (substr($location, -1) == '/') {
				//echo '$location = '.$location.'<br />';
        //echo '$location sub = '.substr($location, -1).'<br />';
        if (!empty($location)) 
				  $shSeparator = (substr($location, -1) == '/') ? '':'/';
				else $shSeparator = '';  
				//echo '$shSeparator = '.$shSeparator.'<br />'; 
					if ($sefConfig->pagetext) {
					//echo '$limit = '.$limit.'<br />'; 
          //echo '$limitstart = '.$limitstart.'<br />';
          // echo '$iteration = '.$iteration.'<br />'; 
						if (!empty($limit)) {
							$pagenum = $limitstart/$limit;
							$pagenum++;
							// Make sure we do not end in infite loop here.
							if ($pagenum < $iteration) $pagenum = $iteration;
						} else {
							$pagenum = $iteration;
						}
						//echo '$pagenum = '.$pagenum.'<br />';
						// shumisha added to handle table-category and table-section which may have variable number of items per page
						// There still will be a problem with filter, which may reduce the total number of items. Thus the item we are looking for
						if ( (strpos($url,'option=com_search')) || (strpos($url,'option=com_content') &&
               (    (strpos( $url, 'task=category')) 
                 //|| (strpos( $url, 'task=blogcategory'))
                 || (strpos( $url, 'task=section'))
                 //|| (strpos( $url, 'task=blogsection'))
                ))) {
                 $shMultPageLength= $sefConfig->pagerep.$limit;
            } else $shMultPageLength= '';
            // shumisha end of addition 
            // shumisha : modified to add # of items per page to URL, for table-category or section-category  
            if (false !== strpos($sefConfig->pagetext, '%s')){
							$page = str_replace('%s', $pagenum, $sefConfig->pagetext).$shMultPageLength.$suffix;
						} else {
							$page = $sefConfig->pagetext.$sefConfig->pagerep.$pagenum.$shMultPageLength.$suffix;
						}   
						// shumisha fix for multiple-part pages : must add page # if limitstart non zero, even if first iteration
						//$temploc = $location.(($iteration == 1) ? "" : $page);
						if (isset($limitstart) 
              //&& ($limitstart != 0)
              ){
               $temploc = $location.$shSeparator.$page;
             }  
             else { 
                $temploc = $location.(($iteration == 1) ? "" : $page);
             }  
						// shumisha end of fix
					}
					else {
						$temploc = $location.(($iteration == 1) ? "" : $sefConfig->pagerep.$iteration.$suffix);
					}
				// shumisha : removed closing } of test above, plus change following elseif() into if()	
				//}
				//elseif ($sefConfig->suffix) {
				if ($sefConfig->suffix) {
				// shumisha end of change
					if  ($sefConfig->suffix != '/') {
						if (eregi($sefConfig->suffix, $location)) {
              // shumisha change for muti-part pages :alter $temploc only if limitstart is not set 
						  if (isset($limitstart) && ($limitstart != 0)) {
                 $temploc = $location.$shSeparator.$page;
              }  
              else { 
							  $temploc = preg_replace("/".$sefConfig->suffix."/", "", $location).(($iteration == 1) ? $sefConfig->suffix : $sefConfig->pagerep.$iteration.$suffix);
							}
						}
						else { 
						  // shumisha protect against empty $location (homepage) : do not add suffix)
						  //// shumisha change for muti-part pages :alter $temploc only if limitstart is not set 
						  if (isset($limitstart) && ($limitstart != 0)) {
                $temploc = $location.$shSeparator.$page;
              }  
              else {
              // shumisha make an exception for first pass if last char is alrady /
							 // $temploc = ($location =='' ? '':$location.(($iteration == 1) ? $sefConfig->suffix : $sefConfig->pagerep.$iteration.$suffix));
							 $temploc = ($location =='' ? '':$location.(($iteration == 1) ? ((substr($location, -1) == '/')? '' : $sefConfig->suffix) : $sefConfig->pagerep.$iteration.$suffix));
							}
						}
					}
					else { 
					  // shumisha protect against empty $location (homepage) : do not add suffix)
					  // shumisha change for muti-part pages :alter $temploc only if limitstart is not set 
						  if (isset($limitstart) && ($limitstart != 0)) {
                 $temploc = $location.$shSeparator.$page.$suffix;
              }  
              else {
						    $temploc = ($location == '' ? '':$location.(($iteration == 1) ? $sefConfig->suffix : $sefConfig->pagerep.$iteration.$suffix));
						  }
					}
				}
				else { 
				  // shumisha change for muti-part pages :alter $temploc only if limitstart is not set 
						  if (isset($limitstart) && ($limitstart != 0)) {
                 $temploc = $location.$shSeparator.$page;
              }  
              else {
					      $temploc = $location.(($iteration == 1) ? '' : $sefConfig->pagerep.$iteration.$suffix);
					    }
				}
				if ($sefConfig->addFile){ 
					if (!eregi($sefConfig->suffix."$", $temploc) && eregi("\/$", $temploc)) $temploc .= $sefConfig->addFile;
				}
				// V 1.2.4.k here we need to check for other-than-default-language homepage
				// remove lang
				$v1 = preg_replace( '/(&|\?)lang=[a-zA-Z]{2,3}/iU', '', $url);
				$v2 = preg_replace( '/(&|\?)lang=[a-zA-Z]{2,3}/iU', '', $shHomeLink);
				if ($v1 == $v2 || $v1 == 'index.php') {  // check if this is homepage
				  if ($GLOBALS[ 'mosConfig_mbf_content' ] && isset( $GLOBALS['mosConfig_defaultLang']) 
              && ( $GLOBALS['mosConfig_defaultLang']!= $lang))   // V 1.2.4.m : insert language code based on param
				    $temploc = shGetIsoCodeFromName($lang).'/';
				  else $temploc = '';  // if homepage in not-default-language, then add language code even if param says opposite
				                       // as we otherwise would not be able to switch language on the frontpage
				} else 
				//echo 'temploc 1 = '.$temploc.'<br />';
				//echo '1 = '.$GLOBALS[ 'mosConfig_mbf_content' ].'<br />';
				//echo '2 = '.$GLOBALS['mosConfig_defaultLang'].'<br />';
				//echo '3 = '.$mosConfig_lang.'<br />';
        // shumisha insert language iso, but only if not default language
        //echo '$shLanguage = '.$lang.'<br />';
        //echo '$option = '.$option.'<br />';
        //echo '$mosConfig_lang = '.$mosConfig_lang.'<br />';
        //echo 'insert = '.shInsertIsoCodeInUrl($option, $lang).'<br />';
				  if (shInsertIsoCodeInUrl($option, $lang)) {  // V 1.2.4.m : insert language code based on param
				                                        // V 1.2.4.q : pass URL lang info, as may not be current lang
				    //$temploc = shGetIsoCodeFromName($mosConfig_lang).'/'.$temploc;
				    $temploc = shGetIsoCodeFromName($lang).'/'.$temploc;   // V 1.2.4.q  must be forced lang, not default
				  }
				//echo 'temploc 2 = '.$temploc.'<br />';
				if ($temploc != '') {
				// shumisha end of change
				
				// see if we have a result for this location
				if ($sefConfig->LowerCase) $temploc = strtolower($temploc);
				
				$sql = "SELECT newurl, rank FROM #__redirection WHERE oldurl = '".$temploc."' ORDER BY rank ASC"; // V 1.2.4.q
				$database->setQuery($sql);

				if ($iteration > 9999) {
					var_dump($sql);
					die('Too many pages :'.$temploc.'##');
				}
        
        // shumisha 2007-03-13 added URL caching, check for various URL for same content
        if ($sefConfig->shUseURLCache)
          $dburl = shGetNonSefURLFromCache($temploc);
        $newMaxRank = 0;  
        if (!$dburl) {
          //$dburl = $database->loadResult();  // V 1.2.4.q  added rank
          $dbUrlList = $database->loadObjectList();
          if (count($dbUrlList) > 0) {
            $dburl = $dbUrlList[0]->newurl;
            $newMaxRank = $dbUrlList[count($dbUrlList)-1]->rank+1;
          }
        }    
				if ($dburl) {
				    if ($dburl == $url) {
						// found the matching object
						// it probably should have been found sooner
						// but is checked again here just for CYA purposes
						// and to end the loop
						$realloc = $temploc;
					}
					// else, didn't find it, increment and try again
					// shumisha added this to close the loop if working on frontpage
					// as domain.tld/index.php?lang=xx and domain.tld/index.php?option=com_frontpage&Itemid=1&lang=xx both must end up in domain.tld/xx/ (if xx is not default language of course - in that case, they must endup in domain.tld)
					// this is true also if Joomfish is not installed and there is no language information in the url
					// V 1.2.4.q  this is a duplicate so we must indert it with incremented rank;
					$query = "INSERT INTO #__redirection (oldurl, newurl, rank) ".  // V 1.2.4.q
						"VALUES ('".$temploc."', '".addslashes(urldecode($url))."', '".$newMaxRank."')";  // V 1.2.4.q
					$database->setQuery($query);
					if (!$database->query()) {
						var_dump($query);
					}
					// shumisha 2007-03-13 added URL caching, need to store this new URL
					shAddSefURLToCache( $url, $temploc);
					$realloc = $temploc; // to close the loop
					// shumisha end of addition
				}
				else {
					//title not found, checken op 404's
					if ($sefConfig->shLog404Errors) { // V 1.2.4.m
					  $query = "SELECT `id` FROM #__redirection WHERE `oldurl` = '$temploc' AND `newurl` = ''";
					  $database->setQuery($query);
					  $id = $database->loadResult();
          } else $id = null;  // V 1.2.4.m if we are not logging 404 errors, then no need to check for
                              // previous hit of this page. We are sure it does not exists, so we can 
                              // directly INSERT it in DB 
					if (!empty($id)) {
						//Er bestaat een 404 pagina voor die geupdate moet worden
						//Dat komt omdat je op deze pagina bent begonnen terwijl en nog geen sef urls waren
					  // V 1.2.4.q : need to update dateadd to 0, as otherwise this redir will be seen as a custom redir
					  // this makes all such 404 errors 'disappear' from the 404 log, but no other solution
						//$query = "UPDATE #__redirection SET `newurl` = '".addslashes(urldecode($url))."'
						$query = "UPDATE #__redirection SET `newurl` = '".
                           addslashes(urldecode($url))."',`dateadd` = '0000-00-00' WHERE `id` = '$id'";
						$database->setQuery($query);
						if (!$database->query()) {
							var_dump($query);
						}
					}
					else {
						/* put it in the database */
						$query = "INSERT INTO #__redirection (oldurl, newurl, rank) ".  // V 1.2.4.q
						"VALUES ('".$temploc."', '".addslashes(urldecode($url))."', '0')";  // V 1.2.4.q
						$database->setQuery($query);
						if (!$database->query()) {
							var_dump($query);
						}
						// shumisha 2007-03-13 added URL caching, need to store this new URL
						shAddSefURLToCache( $url, $temploc);
					}
					$realloc = $temploc;
				}
				}
				$prev_temploc = $temploc;
				$iteration++;
				// shumisha allow loop exit if $temploc = '' (homepage)
			//} while (!$realloc);
			} while ((!$realloc) && ($temploc != ''));
		}
		} // shumisha : enf of check if URL is in cache
		return $realloc;
	}

	function getcategories($catid)
	{
		global $debug, $GLOBALS, $database, $sefConfig;

		if (empty($cat_table)) $cat_table = "#__categories";
		if ($debug){$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404'][$debug_string]['THIS_TASK'] = $this_task; }
    $title = ''; // V 1.2.4.q
		//Als er een categorie in de link staat wordt deze aan title toegevoegd zodat deze
		//In de url wordt opgenomen
		if (isset($catid) && $catid != 0){
			if ($debug){
				$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404'][$debug_string]['CAT_TABLE'] = $cat_table;
				$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404'][$debug_string]['CATID'] = $catid;
			}
			$query = 'SELECT name'.($sefConfig->shTranslateURL?',id':'').' FROM '.$cat_table.' WHERE id = "'.$catid.'"';
			$database->setQuery($query);
			$rows = $database->loadObjectList( );
			if ($debug){$GLOBALS['404SEF_DEBUG']['CLASS_SEF_404'][$debug_string][$option] = $rows;}
			if ($database->getErrorNum()) {
				die( $database->stderr());
			}elseif( @count( $rows ) > 0 ){
				if( !empty( $rows[0]->name ) ){
					$title = $rows[0]->name;
				}
			}
		}
		return $title;
	}

}
?>
