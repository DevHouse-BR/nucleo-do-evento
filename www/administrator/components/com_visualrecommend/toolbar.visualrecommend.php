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

require_once( $mainframe->getPath( 'toolbar_html' ) );

switch ( $task ) {	
	
	case "config":
		MENUVRC::CONFIG();
		break;		
	case "showtracking":
		MENUVRC::SHOWTRACKING();
		break;		
	case "about":
		MENUVRC::ABOUT();	
		break;	
	case"statstracking":
		MENUVRC::TOP10();	
		break;	
	case "tracking":
		MENUVRC::TRACKING();
	default:		

}		
?>