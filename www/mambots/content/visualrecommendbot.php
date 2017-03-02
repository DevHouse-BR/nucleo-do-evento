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

global $_VERSION, $option;

if ( $_VERSION->PRODUCT == 'Joomla!' ){	
	if ( $_VERSION->RELEASE >= '1.5' ) {
		$mainframe->registerEvent( 'onPrepareContent', 'visualrecommendbot15' );
	}else $_MAMBOTS->registerFunction( 'onPrepareContent', 'visualrecommendbot10' );
} elseif ( $_VERSION->PRODUCT == 'Mambo' ){	
		$_MAMBOTS->registerFunction( 'onPrepareContent', 'visualrecommendbot10' );
}

function visualrecommendbot10( $published , &$row, &$params, $page=0 ) {
	if ( @$row->content ){
		return;
	}		
	if ( !$published ) {
		$row->text = str_replace( "{visualrecommend}", "", $row->text );
		return;
	}
	visualrecommendbot( $row, $params, $page );
}

function visualrecommendbot15( &$row, &$params, $page=0 ) {
	if ( @$row->content ){
		return;
	}	
	visualrecommendbot( $row, $params, $page );
}


function visualrecommendbot( &$row, &$params, $page=0 ) {
	global $database, $mosConfig_lang, $mosConfig_live_site, $mosConfig_absolute_path, $Itemid, $option, $task;

	// Get the right language if it exists
	if (file_exists($mosConfig_absolute_path.'/administrator/components/com_visualrecommend/languages/'.$mosConfig_lang.'.php')) {
		include_once($mosConfig_absolute_path.'/administrator/components/com_visualrecommend/languages/'.$mosConfig_lang.'.php');
	} else {
		include_once($mosConfig_absolute_path.'/administrator/components/com_visualrecommend/languages/english.php');
	}
	require($mosConfig_absolute_path.'/administrator/components/com_visualrecommend/visualrecommend_config.php');	
	
	$seclistarray = explode (",", $vr_sectionlist);
	
	switch ( $option ){
		case 'com_alphacontent':
			$com = "alphacontent";
			break;
		case 'com_content':
		default :
			$com = "content";
	}
	
	switch ( $vr_displayFormMode ){
		case '1':
			$status = 'status=no,toolbar=no,scrollbars=yes,titlebar=no,menubar=no,resizable=yes,width='.$vr_width_popup.',height='.$vr_height_popup.',directories=no,location=no';
			$link = $mosConfig_live_site . "/index2.php?option=com_visualrecommend&task=showform&com=" . $com . "&id=" . $row->id . "&Itemid=" . $Itemid;
			$formlink = "<a href=\"" . $link . "\" target=\"_blank\" onclick=\"window.open('" . $link . "','win2','" . $status . "'); return false;\">" . _VRECOMMEND_RECOMMEND . "</a>";
		break;
		case '0':
		default :
			$formlink = "<a href='".sefRelToAbs("index.php?option=com_visualrecommend&task=showform&com=".$com."&id=".$row->id."&itemid=".$Itemid)."'>" . _VRECOMMEND_RECOMMEND . "</a>";	
	}	
	
	if ( ( $option=='com_content' || $option=='com_alphacontent' )&& $task=='view') {
		if ( $vr_mainmode == "0" && strpos($row->text, "{visualrecommend}") !== false ) {		  
			$row->text = str_replace( "{visualrecommend}", $formlink, $row->text );
		} elseif ( $vr_mainmode == "1" && in_array ($row->sectionid, $seclistarray) ) {
			$row->text = str_replace( "{visualrecommend}", "", $row->text );		
			$row->text .= "<p><span class=\"".$vr_styleclass."\">" . $formlink . "</span></p>";		
		} elseif ( $vr_mainmode == "2" ) {
			if ( strpos($row->text, "{visualrecommend}") !== false ) {
				$row->text = str_replace( "{visualrecommend}", $formlink, $row->text );
			} elseif ( in_array (isset($row->sectionid), $seclistarray) ){
				$row->text = str_replace( "{visualrecommend}", "", $row->text );		
				$row->text .= "<p><span class=\"".$vr_styleclass."\">" . $formlink . "</span></p>";		
			}
		}else{
			$row->text = str_replace( "{visualrecommend}", "", $row->text );				
		}		
	} else { // If we are not on the content page 
		if ( $vr_fulltext=='0' ){			
			if ( $vr_mainmode == "0" && strpos($row->text, "{visualrecommend}") !== false ) {		  
				$row->text = str_replace( "{visualrecommend}", $formlink, $row->text );
			} elseif ( $vr_mainmode == "1" && in_array ($row->sectionid, $seclistarray) ) {
				$row->text = str_replace( "{visualrecommend}", "", $row->text );		
				$row->text .= "<p><span class=\"".$vr_styleclass."\">" . $formlink . "</span></p>";		
			} elseif ( $vr_mainmode == "2" ) {
				if ( strpos($row->text, "{visualrecommend}") !== false ) {
					$row->text = str_replace( "{visualrecommend}", $formlink, $row->text );
				} elseif ( in_array (isset($row->sectionid), $seclistarray) ){
					$row->text = str_replace( "{visualrecommend}", "", $row->text );		
					$row->text .= "<p><span class=\"".$vr_styleclass."\">" . $formlink . "</span></p>";		
				}
			}else{
				$row->text = str_replace( "{visualrecommend}", "", $row->text );				
			}		
		}
	}
	return true;
}
?>