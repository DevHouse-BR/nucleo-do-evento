<?php
/*********************************************
* VisualRecommend - Component                *
* Copyright (C) 2007 by Bernard Gilly        *
* --------- All Rights Reserved ------------ *      
* Homepage   : www.visualclinic.fr           *
* Version    : 1.1.0                         *
* License    : Creative Commons              *
*********************************************/

/** ensure this file is being included by a parent file */
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// load the html drawing class
require_once( $mainframe->getPath( 'front_html' ) );
require( $mosConfig_absolute_path . '/administrator/components/com_visualrecommend/visualrecommend_config.php' );
require( $mosConfig_absolute_path.'/administrator/components/com_visualrecommend/version.php' );

// Get the right language if it exists
if (file_exists($mosConfig_absolute_path."/administrator/components/com_visualrecommend/languages/".$mosConfig_lang.".php")){
  include_once($mosConfig_absolute_path."/administrator/components/com_visualrecommend/languages/".$mosConfig_lang.".php");
}else{
  include_once($mosConfig_absolute_path."/administrator/components/com_visualrecommend/languages/english.php");
}

$id = mosGetParam( $_REQUEST, 'id', '0' );
$gid = $my->gid;
$vid = mosGetParam( $_REQUEST, 'vid', '0' );
$email = mosGetParam( $_REQUEST, 'email', '' );

$copyStart = 2007; 
$copyNow = date('Y');
if ($copyStart == $copyNow) { 
	$copySite = $copyStart;
} else {
	$copySite = $copyStart."-".$copyNow ;
} 

switch ( $task ) {		
	case 'send':
		send( $option, $id, $gid );
		break;			
	case 'reply':
		reply( $vid, $email );
		break;				
	case 'showform':
	default:	
		showform( $option, $id );
}

function showform( $option, $id ) {	
	global $database, $mosConfig_absolute_path;
	
	require( $mosConfig_absolute_path . '/administrator/components/com_visualrecommend/visualrecommend_config.php' );
	
	$com = mosGetParam( $_GET, 'com', 'content' );
	$itemid = intval( mosGetParam( $_GET, 'itemid', 0 ) );	
	
	$query = "SELECT title FROM #__content WHERE id='$id'";
	$database->setQuery( $query );
	$title = stripslashes($database->loadResult());	
	
	if ( $vr_template_popup!='' ) {
		$template = $vr_template_popup;
	}else{
		$query = "SELECT template"
		. "\n FROM #__templates_menu"
		. "\n WHERE client_id = 0"
		. "\n AND menuid = 0"
		;
		$database->setQuery( $query );
		$template = $database->loadResult();
	}
	
	// Display Goole Adsense Banners	
	$displayGoogleAdense = _displayGoogleAds ( $vr_ads_activate );
			
	HTML_VRC_FRONTEND::displayForm( $title, $template, $option, $id, $itemid, $com, $displayGoogleAdense );
}

function reply ( $vid, $email ){
	global $mainframe, $database, $mosConfig_absolute_path;	
	
	require( $mosConfig_absolute_path . '/administrator/components/com_visualrecommend/visualrecommend_config.php' );
	
	$query = "SELECT contentid, link, mails_reply, userid, num_points"
	. "\n FROM #__visualrecommend"
	. "\n WHERE keyreply = '$vid'"
	;
	$database->setQuery( $query );
	$row = NULL;
		
	if ( $database->loadObject( $row ) ) {
		$link = $row->link;
		$reply = $row->mails_reply;
		$num_points = $row->num_points;

		if ( strstr($reply, $email) == '' ) {
			if ( $reply !='' ) { $reply .= ';' ; }
			$reply .= $email;
			// record reply
			if ( $row->userid ){ $num_points = $num_points + $vr_numpointsreply; }			
			$query = "UPDATE #__visualrecommend"
			. "\n SET num_reply = num_reply + 1, mails_reply = '$reply', num_points = '$num_points'"
			. "\n WHERE keyreply = '$vid'"
			;
			$database->setQuery( $query );
			$database->query() or die( $database->stderr() );
		}
	
	} else $link = 'index.php';

	mosRedirect ( $link );

}

function send( $option, $uid, $gid ) {
	global $mainframe, $database, $Itemid, $mosConfig_sef, $_VERSION, $my;
	global $mosConfig_sitename, $mosConfig_live_site, $mosConfig_absolute_path, $mosConfig_mailfrom, $mosConfig_fromname, $copySite;	
	
	if ( $uid=='0' ) {
		return;
	}		
	require( $mosConfig_absolute_path . '/administrator/components/com_visualrecommend/visualrecommend_config.php' );	
	
	$itemid          = intval( mosGetParam( $_POST, 'itemid', 0 ) );	
	$addlink2profile = intval( mosGetParam( $_POST, 'addlink2profile', 0 ) );	
	$com             = mosGetParam( $_POST, 'com', 'content' );		
	$message         = mosGetParam( $_POST, 'message', '' );	
	$message         = $database->getEscaped( $message );
	$message         = stripslashes( $message );

	// Check if CB component exist
	$pathFileCB = "components/com_comprofiler/comprofiler.php";		
	if ( file_exists( $pathFileCB ) ) {
		$checkCBcomponent = 1;	
	} else $checkCBcomponent = 0;	
	
	$namesender = stripslashes( mosGetParam( $_POST, 'namesender', '' ) );
	$emailsender = mosGetParam( $_POST, 'emailsender', '' );
	
	if( $vr_link2CB && $checkCBcomponent && $my->id>0 && $addlink2profile){
		$profileSender =  "\n\n" . _VRECOMMEND_ADD_LINK_PROFILE . " " . $namesender . " : \n" . sefRelToAbs( 'index.php?option=com_comprofiler&amp;task=userProfile&amp;user=' . $my->id . CBAuthorItemid() );
	} else $profileSender = "";
	
	$numfieldemail = $_POST['numfieldemail']+1;
	@session_start('visualrecommendmail');
	session_register('namesender');
	session_register('emailsender');
	session_register('message');
	$_SESSION['namesender']  = $namesender;
	$_SESSION['emailsender'] = $emailsender;
	$_SESSION['message']     = $message;	
	$namefriend  = $_POST['namefriend'];
	$emailfriend = $_POST['emailfriend'];	

	for ( $i=0, $n=$numfieldemail; $i < $n; $i++ ){	
		if ( $emailfriend[$i]!='' ){	
			if (!(is_email($emailfriend[$i])) || trim($namefriend[$i])=='' ){	
				echo "<script> alert('"._VRECOMMEND_FRIENDEMAILERROR. " ".($i+1) ."'); history.back();</script>";
				exit();
			}
			if ( trim($namefriend[$i])=='' ){	
				echo "<script> alert('"._VRECOMMEND_FRIENDNAMEERROR. " ".($i+1) ."'); history.back();</script>";
				exit();
			}
		}
	}	
	if ( trim( $namesender) =='' ){	
		echo "<script> alert('" . _VRECOMMEND_NAME_ERROR . "'); history.back();</script>";
		exit();
	}	

	if ( $_VERSION->PRODUCT == 'Joomla!' ){	
		if ( $_VERSION->RELEASE >= '1.5' ){
			$now = date('Y-m-d H:i:s', time() + $mainframe->getCfg('offset') * 60 * 60);
		} else $now = _CURRENT_SERVER_TIME;
	}elseif( $_VERSION->PRODUCT == 'Mambo' ){	
		global $mosConfig_offset;
		$now = date( "Y-m-d H:i:s", time()+$mosConfig_offset*60*60 );
	}
	$nullDate = $database->getNullDate();	
	
	$query = "SELECT a.*, cc.name AS category, s.name AS section, s.published AS sec_pub, cc.published AS cat_pub,"
	. "\n  s.access AS sec_access, cc.access AS cat_access, s.id AS sec_id, cc.id as cat_id"
	. "\n FROM #__content AS a"
	. "\n LEFT JOIN #__categories AS cc ON cc.id = a.catid"
	. "\n LEFT JOIN #__sections AS s ON s.id = cc.section AND s.scope = 'content'"
	. "\n WHERE a.id = " . (int) $uid
	. "\n AND a.state = 1"
	. "\n AND a.access <= " . (int) $gid
	. "\n AND ( a.publish_up = " . $database->Quote( $nullDate ) . " OR a.publish_up <= " . $database->Quote( $now ) . " )"
	. "\n AND ( a.publish_down = " . $database->Quote( $nullDate ) . " OR a.publish_down >= " . $database->Quote( $now ) . " )"
	;
	$database->setQuery( $query );
	$row = NULL;

	if ( $database->loadObject( $row ) ){
		if ( !$row->cat_pub && $row->catid ) {
			mosNotAuth();
			return;
		}
		if ( !$row->sec_pub && $row->sectionid ) {
			mosNotAuth();
			return;
		}
		if ( ($row->cat_access > $gid) && $row->catid ) {
			mosNotAuth();
			return;
		}
		if ( ($row->sec_access > $gid) && $row->sectionid ) {
			mosNotAuth();
			return;
		}		
		$yourname 			= $namesender;
		$youremail 			= $emailsender;		
		$titleArticle 		= $row->title;
		
		$query = "SELECT template"
		. "\n FROM #__templates_menu"
		. "\n WHERE client_id = 0"
		. "\n AND menuid = 0"
		;
		$database->setQuery( $query );
		$template = $database->loadResult();
		if ( $itemid ) {
			$_itemid = '&Itemid='. $itemid;
		} else {
			if ( $_VERSION->PRODUCT == 'Joomla!' && $_VERSION->RELEASE >= '1.5' ) {
				$itemid = getItemid( $uid );
			} else {
				$itemid  = $mainframe->getItemid( $uid, 0, 0  );
			}
			//........			
			if ( $itemid ) {
				$_itemid = '&Itemid='. $itemid;
			
			} else {
				$itemid = '';
				$_itemid = '&Itemid=';
			}
		}		
		$ip = getenv('REMOTE_ADDR');		
		$curdate = date( "Y-m-d" );		
		if ( $vr_maxdaily > '0' ){
			$query = "SELECT COUNT(*) FROM #__visualrecommend WHERE ip='$ip' AND date LIKE '$curdate%';";
			$database->setQuery( $query );
			$checkdate = $database->loadResult();
			if( $checkdate >= $vr_maxdaily ){
				echo _VRECOMMEND_MAXDAILYEXCEEDED;			
				return;
			}
		}	
		
		$link = sefRelToAbs( 'index.php?option=com_'.$com.'&task=view&id='. $uid . $_itemid );	
		$ifsefTurnOff = ( !$mosConfig_sef ) ? $mosConfig_live_site."/" : "";
		$num_send = 0;
		$mails = "";
		$key_reply = uniqid(time());
		
		for ( $i=0, $n=$numfieldemail; $i < $n; $i++ ){
			$email = $emailfriend[$i];
			$invited = $namefriend[$i];			
			$subject = str_replace("{sender_name}", $yourname, $vr_subject);
			$subject = str_replace("{friend_name}", $invited, $subject);
			$subject = str_replace("{sitename}", $mosConfig_sitename, $subject);
			$subject = str_replace("{title_content_url}", $titleArticle, $subject);
			$subject = str_replace("{custom_field_by_user}", "", $subject);			
			
			$linkreply = sefRelToAbs( $ifsefTurnOff . "index.php?option=com_visualrecommend&task=reply&vid=". $key_reply . "&email=" . $email );		
			
			$titlewithlink = stripslashes( $titleArticle ) . "\n" . $linkreply . "\n";		
			
			$msg = stripslashes( $vr_messagebody );
			$msg = str_replace( "{sender_name}", $yourname, $msg );			
			$msg = str_replace( "{friend_name}", $invited, $msg );			
			$msg = str_replace( "{sitename}", $mosConfig_live_site, $msg );
			$msg = str_replace( "{title_content_url}", $titlewithlink, $msg );
			if( $vr_custom_msg ){
				$msg = str_replace( "{custom_field_by_user}", $message, $msg );
			}else{
				$msg = str_replace( "{custom_field_by_user}", "", $msg );
			}					
			$msg .= $profileSender;
			// If you want to remove (hide) the legal mention of this copyright notice, please contact the author 
			// e-mail : contact@visualclinic.fr
			// copyright @ 2007 - All rights reserved
			//$msg .= "\n\n\nPowered by VisualRecommend © $copySite - http://www.visualclinic.fr - All rights reserved\n";
			
			if ( $emailfriend[$i]!='' && trim($namefriend[$i])!='' ){	
				$success = mosMail( $youremail, $yourname, $email, $subject, $msg );				
				if ($success) {
					$num_send++;
					$separate = ( $i>0 )? ';' : '';
					$mails .= $separate . $emailfriend[$i];
				}
			}		
		}
		
		$date  = date( "Y-m-d H:i:s" );		
		$userid =  ( $my->id )? $my->id : '0';	
		$num_pointsend = 0;			
		if ( $userid ) { $num_pointsend = $num_send*$vr_numpointssend; }
		$query = "INSERT INTO #__visualrecommend SET contentid='$uid', num_send='$num_send', name='$yourname', mail_sender='$youremail', userid='$userid', mails='$mails', ip='$ip', date='$date', link='$link', num_points='$num_pointsend' , keyreply='$key_reply';";
		$database->setQuery( $query );
		$database->query();	
		// google Adsense		
		$displayGoogleAdense = _displayGoogleAds ( $vr_ads_activate );
		if ( $displayGoogleAdense && $vr_ads_position!='1' ) echo $displayGoogleAdense . "<br />";		
		echo "<div style=\"clear:both;\">";
		if ( $num_send ){
			echo $num_send . " " . _VRECOMMEND_SENDINGSRELEASED;		
		}else{
			echo _VRECOMMEND_NOSENDINGRELEASED;				
		}
		if ( $vr_displayFormMode == '1' ) {
			echo "<br /><a href=\"javascript:window.close();\">" . _VRECOMMEND_CLOSE . "</a>";
		} else echo "<br /><br /><a href=\"" . $link . "\">" . _VRECOMMEND_GOTO_ARTICLE . "</a>";
		echo "</div>";
		// google Adsense
		if ( $displayGoogleAdense && $vr_ads_position>=1 ) echo "<br />" . $displayGoogleAdense;
	} else {
		mosNotAuth();
		return;
	}
	unset($_SESSION['namesender']);	
	unset($_SESSION['emailsender']);	
	unset($_SESSION['message']);	
}

function _displayGoogleAds( $display=0 ) {
	global $mosConfig_absolute_path;
	
	if ($display ) {
		require( $mosConfig_absolute_path . '/administrator/components/com_visualrecommend/visualrecommend_config.php' );
	
		$ads_format = explode("-", $vr_ads_format);
		$ads_width  = explode("x", $ads_format[0]);
		$ads_height = explode("_", $ads_width[1]);
		$displayGoogleAds = "<div style=\"float:" . $vr_ads_alignment . ";width:" .  $ads_width[0] . "px;height:" . $ads_height[0] . "px;margin:auto;padding:auto;\">"
		. "<script type=\"text/javascript\">\r\n"
		. "<!--\r\n"
		. "google_ad_client = \"" . $vr_ads_clientID . "\";\r\n"
		. "google_alternate_ad_url = \"" . $vr_ads_alternate . "\"; \r\n"
		. "google_alternate_color = \"" . $vr_ads_alternate_color . "\"; \r\n"
		. "google_ad_width = " .  $ads_width[0] . "; \r\n"
		. "google_ad_height = " . $ads_height[0] . "; \r\n"
		. "google_ad_format = \"" . $ads_format[0] . "\"; \r\n"
		. "google_ad_type = \"" . $vr_ads_type . "\"; \r\n"
		. "google_ad_channel = \"" . $vr_ads_channel . "\"; \r\n"
		. "google_color_border = \"" . $vr_ads_border_color . "\"; \r\n"
		. "google_color_bg = \"" . $vr_ads_background_color . "\"; \r\n"
		. "google_color_link = \"" . $vr_ads_link_color . "\"; \r\n"
		. "google_color_url = \"" . $vr_ads_url_color . "\"; \r\n"
		. "google_color_text = \"" . $vr_ads_text_color . "\"; \r\n"
		. "//--> \r\n"
		. "</script>\r\n"
		. "<script type=\"text/javascript\" src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\">\r\n"
		. "</script>\r\n</div>\r\n";	
	} else $displayGoogleAds = "";
	
	return $displayGoogleAds;
}

function is_email( $email ){
	$rBool=false;
	if( preg_match( "/^[\w\.\-]+@\w+[\w\.\-]*?\.\w{1,4}$/", $email ) ){
		$rBool=true;
	}
	return $rBool;
}

function getItemid( $id ){
	$db    = & JFactory::getDBO();
	$menus =& JMenu::getInstance();
	$items = $menus->getMenu();
	$Itemid = null;
	$component = JComponentHelper::getInfo('com_content');
	$n = count( $items );
	if ( $n ){
		for ($i = 0; $i < $n; $i++) {
			$item = &$items[$i];
			if (($item->componentid == $component->id) && ($item->published) && ($item->cParams->get('view_name') == "article") && ($item->mParams->get('article_id') == $id)) {
				return $item->id;
			}
		}
		$article = JTable::getInstance('content', $db);
		$article->load($id);
		// Check to see if it is in a published category
		for ($i = 0; $i < $n; $i++) {
			$item = &$items[$i];
			if (($item->componentid == $component->id) && ($item->published) && ($item->cParams->get('view_name') == "category") && ($item->mParams->get('category_id') == $article->catid)) {
				return $item->id;
			}
		}
		// Check to see if it is in a published section
		for ($i = 0; $i < $n; $i++) {
			$item = &$items[$i];
			if (($item->componentid == $component->id) && ($item->published) && ($item->cParams->get('view_name') == "section") && ($item->mParams->get('section_id') == $article->sectionid)) {
				return $item->id;
			}
		}
		// Category
		for ($i = 0; $i < $n; $i++) {
			$item = &$items[$i];
			if (($item->componentid == $component->id) && ($item->published) && ($item->cParams->get('view_name') == "category") && ($item->mParams->get('category_id') == 0)) {
				return $item->id;
			}
		}
		// Section
		for ($i = 0; $i < $n; $i++) {
			$item = &$items[$i];
			if (($item->componentid == $component->id) && ($item->published) && ($item->cParams->get('view_name') == "section") && ($item->mParams->get('category_id') == 0)) {
				return $item->id;
			}
		}
	}		
	return $Itemid;
}

function CBAuthorItemid() {
	global $_CBAuthorbot__Cache_ProfileItemid, $database;
	
	if ( !$_CBAuthorbot__Cache_ProfileItemid ) {
		if ( !isset( $_REQUEST['Itemid'] ) ) {
			$database->setQuery( "SELECT id FROM #__menu WHERE link = 'index.php?option=com_comprofiler' AND published=1" );
			$Itemid = (int) $database->loadResult();
		} else {
			$Itemid = (int) $_REQUEST['Itemid'];
		}
		if ( ! $Itemid ) {
			/** Nope, just use the homepage then. */
			$query = "SELECT id"
			. "\n FROM #__menu"
			. "\n WHERE menutype = 'mainmenu'"
			. "\n AND published = 1"
			. "\n ORDER BY parent, ordering"
			. "\n LIMIT 1"
			;
			$database->setQuery( $query );
			$Itemid = (int) $database->loadResult();
		}
		$_CBAuthorbot__Cache_ProfileItemid = $Itemid;
	}
	if ($_CBAuthorbot__Cache_ProfileItemid) {
		return "&amp;Itemid=" . $_CBAuthorbot__Cache_ProfileItemid;
	} else {
		return null;
	}
}
/*<!-- IMPORTANT! DON'T REMOVE OR HIDE THE LEGAL COPYRIGHT NOTICE !-->
<!-- If you want to remove (hide) the legal mention of this copyright notice, please contact the author -->
<!-- e-mail : contact@visualclinic.fr -->
<div style="clear:both;text-align:center;"><span class="small"><br />
<a href="http://www.visualclinic.fr" target="_blank">VisualRecommend <?php echo _VRECOMMEND_NUM_VERSION; ?> </a> &copy; <?php echo $copySite ; ?> - <a href="http://www.visualclinic.fr" target="_blank">visualclinic.fr</a><br />
 License <a rel="license" href="http://creativecommons.org/licenses/by-nc-nd/2.5/">Creative Commons</a> -  All rights reserved<br /></span>
</div>*/
?>
