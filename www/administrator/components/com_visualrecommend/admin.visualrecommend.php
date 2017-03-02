<?php
/*********************************************
* VisualRecommend - Component                *
* Copyright (C) 2007 by Bernard Gilly        *
* --------- All Rights Reserved ------------ *      
* Homepage   : www.visualclinic.fr           *
* Version    : 1.1.0                         *
* License    : Creative Commons              *
*********************************************/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// ensure user has access to this function
if (!($acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'all' )
		| $acl->acl_check( 'administration', 'edit', 'users', $my->usertype, 'components', 'com_visualrecommend' ))) {
	mosRedirect( 'index2.php', _NOT_AUTH );	
}

require_once( $mainframe->getPath( 'admin_html' ) );
require( $mosConfig_absolute_path.'/administrator/components/com_visualrecommend/visualrecommend_config.php' );
require( $mosConfig_absolute_path.'/administrator/components/com_visualrecommend/version.php' );

$cid = mosGetParam( $_POST, 'cid', array(0) );
$idcontent = mosGetParam( $_REQUEST, 'idcontent', '' );

if (!is_array( $cid )) {
	$cid = array(0);
}

switch ( $task ) {

	// CONFIGURATION
	case "config":		
		showConfig( $option ) ;
		break;

	case "savesettings":
		savesettings( $option );
		break;
		
	case "cancelsettings":
		mosRedirect( "index2.php?option=$option&task=config" );
		break;
		
	// TRACKING	
	case "tracking":
		tracking( $option );
		break;
		
	case "showtracking":
		showtracking( $option, $cid, $idcontent );
		break;		
	
	case "canceltracking":
		mosRedirect( "index2.php?option=$option&task=tracking" );
		break;	
		
	case "deltracking":
		deltracking( $option, $cid, 'contentid', 'tracking', $idcontent );
		break;			
		
	case "deltrackingItem":
		deltracking( $option, $cid, 'id', 'showtracking&idcontent=', $idcontent);
		break;				

	case "purgealltracking":
		purgealltracking( $option );
		break;			
		
	// EXPORT TRACKING	
	case "exporttracking":		
		exporttracking( $option, 0 );
		break;

	case "exportreplytracking":		
		exporttracking( $option, 1 );
		break;
		
	// STATS			
	case "statstracking":		
		statstracking( $option, 1 );
		break;

	// ABOUT	
	case "about":
		HTML_VRC::about( $option, _VRECOMMEND_NUM_VERSION );
		break;	

	// DEFAULT			
	case "controlpanel":	
	default:
		showControlPanel( $option );
}

function showControlPanel( $option ) {
	HTML_VRC::showcontrolpanel( $option );
}

function showConfig( $option ) {
	HTML_VRC::showConfig( $option );
}

function savesettings ( $option ) {
	global $mosConfig_absolute_path;
	
	$configfile = "components/$option/visualrecommend_config.php";
	@chmod ($configfile, 0766);
	$permission = is_writable($configfile);
	if (!$permission ) {		
		mosRedirect("index2.php?option=$option&task=config", _VRECOMMEND_NOTWRITING );
		return;
	}	
	
	$msg = "";
	$vr_link2CB = intval( mosGetParam( $_POST, 'vr_link2CB', 0 ));
	$vr_width_popup = mosGetParam( $_POST, 'vr_width_popup', '380' );
	if ( !is_numeric( $vr_width_popup ) || $vr_width_popup<100) {
		$vr_width_popup = 380;
	}
	$vr_height_popup = mosGetParam( $_POST, 'vr_height_popup', '480' );
	if ( !is_numeric( $vr_height_popup ) || $vr_height_popup<100) {
		$vr_height_popup = 480;	
	}
	$vr_numpointssend = intval( mosGetParam( $_POST, 'vr_numpointssend', 0 ));
	$vr_numpointsreply = intval( mosGetParam( $_POST, 'vr_numpointsreply', 0 ));
	
	// List sections
	$vr_sectionlist = implode(",", mosGetParam( $_POST, 'vrselections', 0 ));
	
	$config = "<?php\n";	
	$config .= "/*********************************************\n";
	$config .= "* VisualRecommend - Component                *\n";
	$config .= "* Copyright (C) 2007 by Bernard Gilly        *\n";
	$config .= "* --------- All Rights Reserved ------------ *\n";  
	$config .= "* Homepage   : www.visualclinic.fr           *\n";
	$config .= "* Version    : "._VRECOMMEND_NUM_VERSION."                         *\n";
	$config .= "* License    : Creative Commons              *\n";
	$config .= "*********************************************/\n";
	$config .= "\n";
	$config .= "defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );\n";
	$config .= "\n";
	$config .= "\$vr_sectionlist = \"" .$vr_sectionlist ."\";\n"; 
	$config .= "\$vr_link2CB = \"".$vr_link2CB."\";\n";
	$config .= "\$vr_width_popup = \"".$vr_width_popup."\";\n";
	$config .= "\$vr_height_popup = \"".$vr_height_popup."\";\n";
	$config .= "\$vr_numpointssend = \"".$vr_numpointssend."\";\n";
	$config .= "\$vr_numpointsreply = \"".$vr_numpointsreply."\";\n";

    foreach ( $_POST as $k=>$v ) {
		 if ( $k!='option' && $k!='task' && $k!='vrselections' && $k!='vr_link2CB' && $k!='vr_numpointssend' && $k!='vr_numpointsreply' && $k!='vr_width_popup' && $k!='vr_height_popup' ){ 
		 	$config .= "$".$k." = \"".$v."\";\n";
		 }
    }	   
	$config .= "?>\n";
	if ($fp = fopen("$configfile", "w")) {
		fputs($fp, $config, strlen($config));
		fclose ($fp);
	}
	mosRedirect("index2.php?option=$option&task=config", _VRECOMMEND_SAVESETTINGS.$msg );
}

/**
* List the records
* @param string The current GET/POST option
*/
function tracking( $option ) {
	global $database, $mainframe, $mosConfig_list_limit;

	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search 	= $database->getEscaped( trim( strtolower( $search ) ) );
	
	$where = "";
	if ( $search ) {
		$where = "\nWHERE c.title LIKE '%$search%' OR v.name LIKE '%$search%' OR v.mail_sender LIKE '%$search%' OR v.mails LIKE '%$search%'";
	}

	$query = "SELECT v.*, c.title AS title, SUM(v.num_send) AS recommends, COUNT(v.contentid) AS sendings, MAX(date) AS lastsending"
	. "\nFROM #__visualrecommend AS v"
	. "\nLEFT JOIN #__content AS c ON v.contentid=c.id"
	. $where
	. "\nGROUP BY v.contentid"
	;
	$database->setQuery( $query );
	$rows1 = $database->loadObjectList();
	$total = count($rows1);

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	// get the subset (based on limits) of required records
	$query = "SELECT v.*, c.title AS title, SUM(v.num_send) AS recommends, SUM(v.num_reply) AS replys, COUNT(v.contentid) AS sendings, MAX(date) AS lastsending"
	. "\nFROM #__visualrecommend AS v"
	. "\nLEFT JOIN #__content AS c ON v.contentid=c.id"
	. $where
	. "\nGROUP BY v.contentid"
	. "\nORDER BY lastsending DESC"
	. "\nLIMIT $pageNav->limitstart,$pageNav->limit"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();	

	// NUM USERS
	$query = "SELECT COUNT(*) FROM #__visualrecommend";
	$database->setQuery( $query );
	$rowUsers = $database->loadResult();
	
	// NUM FRIENDS
	$query = "SELECT SUM(num_send) FROM #__visualrecommend";
	$database->setQuery( $query );
	$rowSend = $database->loadResult();
	
	// NUM ARTICLES
	$query = "SELECT COUNT(DISTINCTROW(contentid)) FROM #__visualrecommend";
	$database->setQuery( $query );
	$rowContent = $database->loadResult();

	HTML_VRC::tracking( $rows, $pageNav, $search, $option, $rowUsers, $rowSend, $rowContent);
}

/**
* List the records
* @param string The current GET/POST option
*/
function showtracking( $option, $cid, $idcontent ) {
	global $database, $mainframe, $mosConfig_list_limit;
	
	$limit 		= intval( $mainframe->getUserStateFromRequest( "viewlistlimit", 'limit', $mosConfig_list_limit ) );
	$limitstart = intval( $mainframe->getUserStateFromRequest( "view{$option}limitstart", 'limitstart', 0 ) );
	$search 	= $mainframe->getUserStateFromRequest( "search{$option}", 'search', '' );
	$search 	= $database->getEscaped( trim( strtolower( $search ) ) );		

	if (count( $cid )) {
		$cid = implode( ',', $cid );		
	}
	if ( $idcontent!='' ) {
		$cid = $idcontent;
	}else {
		$idcontent = $cid;
	}
	
	$where2 = "";
	if ( $search ) {
		$where2 = "\nAND (name LIKE '%$search%' OR mail_sender LIKE '%$search%' OR mails LIKE '%$search%' OR ip LIKE '%$search%')";				
	}	

	// get the total number of records
	$query = "SELECT COUNT(*)"
	. "\n FROM #__visualrecommend"
	. "\n WHERE contentid=$cid"
	.$where2
	;
	$database->setQuery( $query );
	$total = $database->loadResult();

	require_once( $GLOBALS['mosConfig_absolute_path'] . '/administrator/includes/pageNavigation.php' );
	$pageNav = new mosPageNav( $total, $limitstart, $limit  );

	// get the subset (based on limits) of required records
	$query = "SELECT * FROM #__visualrecommend"
	. "\n WHERE contentid=$cid"
	.$where2
	. "\nORDER BY date DESC"
	. "\nLIMIT $pageNav->limitstart,$pageNav->limit"
	;
	$database->setQuery( $query );
	$rows = $database->loadObjectList();	

	HTML_VRC::showtracking( $rows, $pageNav, $search, $option, $idcontent );
}

/**
* Removes records
* @param array An array of id keys to remove
* @param string The current GET/POST option
*/
function deltracking( $option, &$cid, $track, $goback, $idcontent ) {
	global $database;

	if (count( $cid )) {
		$cids = implode( ',', $cid );
		$query = "DELETE FROM #__visualrecommend"
		. "\n WHERE $track IN ( $cids )"
		;
		$database->setQuery( $query );
		if (!$database->query()) {
			echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
		}
	}
	
	$msg = _VRECOMMEND_TRACKINGDELETED;
	if ( $idcontent!='' ){
		$goback .= $idcontent;
	}
	mosRedirect( 'index2.php?option=' . $option . '&task=' . $goback, $msg );
}

// Purge all tracking
function purgealltracking( $option ) {
	global $database;

	$query = "DELETE FROM #__visualrecommend";
	$database->setQuery( $query );
	if (!$database->query()) {
		echo "<script> alert('".$database->getErrorMsg()."'); window.history.go(-1); </script>\n";
	}
	$msg = _VRECOMMEND_TRACKINGDELETED;	
	mosRedirect( 'index2.php?option=' . $option . '&task=tracking', $msg );
}

/**
* Create a CSV file
*/
function exporttracking( $option, $type=0 ) {
	global $database, $mosConfig_live_site, $mosConfig_absolute_path;	
	
	switch ( $type ) {
		case 1:		
		$query = "SELECT mails_reply FROM #__visualrecommend";
		$data1 = "Reply ";
		$action = "exportreplytracking";
		break;
		case 0:	
		default:
		$query = "SELECT mail_sender, mails FROM #__visualrecommend";
		$data1 = "";
		$action = "exporttracking";
	}
	
	$database->setQuery( $query );
	$rows = $database->loadObjectList();		
	$total = count($rows);
	$exportfile = $mosConfig_absolute_path . "/administrator/components/$option/csv/export.csv";
	@chmod ($exportfile, 0766);
	$permission = is_writable($exportfile);
	if (!$permission ) {		
		mosRedirect( "index2.php?option=$option&task=$action", _VRECOMMEND_CSVNOTWRITING );
		return;
	}		
	$msg    = "";
	$data1 .= "Mails;\n"; 
	$data2  = ""; 	
	$i      = 0;
	if ( $rows ) { 
		$a = array();
		foreach( $rows as $row ){
			$i++;
			switch ( $type ) {
			case 1:	
				$email = str_replace( ";", "\n", $row->mails_reply );
				if ( $i<$total) {
					$data2 .= "\n$email\n";
				}elseif ( $i==$total) {
					$data2 .= "\n$email";				
				}
			break;			
			case 0:	
			default:
				$email = str_replace( ";", "\n", $row->mails );
				if ( $i<$total) {
					// Add author mail 
					$data2 .= $row->mail_sender . "\n$email\n";
				}elseif ( $i==$total) {
					$data2 .= $row->mail_sender . "\n$email";				
				}
			}
		}
		$a = explode("\n", $data2);
		$a = array_unique( $a );	
		$b = implode(";\n", $a );
	} else { 
		$msg = _VRECOMMEND_NODATAFOREXPORT;
		mosRedirect( 'index2.php?option=' . $option . '&task=tracking', $msg );
		return;
	} 
	$data = $data1.$b.";";
	if ($fp = fopen("$exportfile", "w")) {
		fputs($fp, $data, strlen($data));
		fclose ($fp);
	}
	$showfile = file_get_contents( $exportfile );
	$namefile = "export.csv";
	$sizefile = filesize($exportfile);	
	@ob_end_clean();
	@ini_set('zlib.output_compression','Off');	
	header('Pragma: public');
	header('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT');
	header('Cache-Control: must-revalidate, pre-check=0, post-check=0, max-age=0');	
	header('Content-Tranfer-Encoding: none');	
	header('Content-Type: application/octetstream; name="'.$namefile.'"');
	header('Content-Disposition: attachement; filename="'.$namefile.'"');	
	header('Content-Length: '.$sizefile);	
	echo $showfile;
	exit();
}

function statstracking( $option, $all=1 ) {
	global $database, $mainframe, $mosConfig_list_limit;	
	
	// Top 10 registered users most active
	$query = "SELECT u.name AS name, u.username AS username, SUM(v.num_send) AS numsend"
	. "\nFROM #__visualrecommend AS v"
	. "\nLEFT JOIN #__users AS u ON v.userid=u.id"
	. "\nWHERE v.userid > '0'"
	. "\nGROUP BY v.userid"
	. "\nORDER BY numsend DESC"
	. "\nLIMIT 10"
	;
	$database->setQuery( $query );
	$rowsUsersMostActive = $database->loadObjectList();		
	
	// Top 10 best points
	$query = "SELECT u.name AS name, u.username AS username, SUM(v.num_points) AS numpoints"
	. "\nFROM #__visualrecommend AS v"
	. "\nLEFT JOIN #__users AS u ON v.userid=u.id"
	. "\nWHERE v.userid > '0'"
	. "\nGROUP BY v.userid"
	. "\nORDER BY numpoints DESC"
	. "\nLIMIT 10"
	;
	$database->setQuery( $query );
	$rowsMostPoints = $database->loadObjectList();		

	// Top 10 articles most recommended
	$query = "SELECT v.contentid AS cid, c.title AS title, SUM(v.num_send) AS recommends, SUM(v.num_reply) AS reply"
	. "\nFROM #__visualrecommend AS v"
	. "\nLEFT JOIN #__content AS c ON v.contentid=c.id"
	. "\nGROUP BY v.contentid"
	. "\nORDER BY recommends DESC"
	. "\nLIMIT 10"
	;
	$database->setQuery( $query );
	$rowsMostRecommend = $database->loadObjectList();		

	HTML_VRC::statstracking( $rowsUsersMostActive, $rowsMostPoints, $rowsMostRecommend, $option, $all );
}

// MENTIONS COPYRIGHT
$copyStart = 2007; 
$copyNow = date('Y');  
if ($copyStart == $copyNow) { 
	$copySite = $copyStart;
} else {
	$copySite = $copyStart." - ".$copyNow ;
} 
?>
<!-- IMPORTANT! DON'T REMOVE THE COPYRIGHT NOTICE -->
<!-- If you want to remove the legal mention of this copyright notice on your front-end, please contact the author -->
<!-- e-mail : contact@visualclinic.fr -->
<table width="100%" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td><div align="center">Copyright &copy; <?php echo $copySite ; ?> by Bernard Gilly - <a href="http://www.visualclinic.fr">visualclinic.fr</a> - All rights reserved<br /></div>
	</td>
  </tr>
</table>