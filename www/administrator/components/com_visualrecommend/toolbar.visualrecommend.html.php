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

global $id, $option, $iconcpanel, $_VERSION;

if ( $_VERSION->PRODUCT == 'Joomla!' ){	
	if ( $_VERSION->RELEASE >= '1.5' ) {
		$iconcpanel = 'default.png';
	}else{
		$iconcpanel = '../components/com_visualrecommend/images/cpanel.png';
	}		
}elseif( $_VERSION->PRODUCT == 'Mambo' ){
	$iconcpanel = '../components/com_visualrecommend/images/cpanel.png';
}

class MENUVRC {

	function CONFIG() {
		global $iconcpanel, $_VERSION;
		
		if ( $_VERSION->PRODUCT == 'Joomla!' ){	
			if ( $_VERSION->RELEASE >= '1.5' ) {
				JMenuBar::title( JText::_( _VRECOMMEND_SETTINGS ), 'config.png' );
			}
		}
		mosMenuBar::startTable();
		mosMenuBar::custom('', $iconcpanel, $iconcpanel, 'cpanel', false);
		mosMenuBar::spacer();
		mosMenuBar::save( 'savesettings' );
		mosMenuBar::spacer();
		mosMenuBar::cancel( 'cancelsettings' );
		mosMenuBar::endTable();
	}
	
	function TRACKING(){
		global $iconcpanel, $_VERSION;
		
		if ( $_VERSION->PRODUCT == 'Joomla!' ){	
			if ( $_VERSION->RELEASE >= '1.5' ) {
				JMenuBar::title( JText::_( _VRECOMMEND_TRACKING ), 'massemail.png' );
			}
		}
		mosMenuBar::startTable();
		mosMenuBar::custom('', $iconcpanel, $iconcpanel, 'cpanel', false);
		mosMenuBar::spacer();
		mosMenuBar::editList('showtracking');
		mosMenuBar::spacer();
		mosMenuBar::deleteList( '', 'deltracking');
		mosMenuBar::endTable();	
	}

	function SHOWTRACKING() {
		global $iconcpanel, $id, $_VERSION;
		
		if ( $_VERSION->PRODUCT == 'Joomla!' ){	
			if ( $_VERSION->RELEASE >= '1.5' ) {
				JMenuBar::title( JText::_( _VRECOMMEND_SHOWTRACKING ), 'user.png' );
			}
		}				
		mosMenuBar::startTable();	
		mosMenuBar::custom('', $iconcpanel, $iconcpanel, 'cpanel', false);
		mosMenuBar::spacer();
		mosMenuBar::deleteList( '', 'deltrackingItem');
		mosMenuBar::spacer();
		if ( $id ) {
			// for existing items the button is renamed `close`
			mosMenuBar::cancel( 'canceltracking', _VRECOMMEND_CLOSE );
		} else {
			mosMenuBar::cancel( 'canceltracking' );
		}
		mosMenuBar::endTable();
	}
	
	function ABOUT() {
		global $iconcpanel, $_VERSION;
		
		if ( $_VERSION->PRODUCT == 'Joomla!' ){	
			if ( $_VERSION->RELEASE >= '1.5' ) {
				JMenuBar::title( JText::_( _VRECOMMEND_ABOUT ), 'cpanel.png' );
				$btnback = 'back.png';
			}else $btnback = 'back_f2.png';
		}else $btnback = 'back_f2.png';	
		
		mosMenuBar::startTable();				
		mosMenuBar::custom('', $iconcpanel, $iconcpanel, 'cpanel', false);
		mosMenuBar::endTable();
	}
	
	function TOP10() {
		global $iconcpanel, $_VERSION;
		
		if ( $_VERSION->PRODUCT == 'Joomla!' ){	
			if ( $_VERSION->RELEASE >= '1.5' ) {
				JMenuBar::title( JText::_( _VRECOMMEND_TOP_10 ) );
				$btnback = 'back.png';
			}else $btnback = 'back_f2.png';
		}else $btnback = 'back_f2.png';	
					
		mosMenuBar::startTable();		
		mosMenuBar::custom('', $iconcpanel, $iconcpanel, 'cpanel', false);
		mosMenuBar::endTable();
	}	
}
?>