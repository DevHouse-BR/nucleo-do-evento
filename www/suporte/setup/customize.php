<?
	/*******************************************************
	* COPYRIGHT OSI CODES - PHP Live!
	*******************************************************/
	session_start() ;
	if ( isset( $HTTP_SESSION_VARS['session_setup'] ) ) { $session_setup = $HTTP_SESSION_VARS['session_setup'] ; } else { HEADER( "location: index.php" ) ; exit ; }
	if ( !file_exists( "../web/$session_setup[login]/$session_setup[login]-conf-init.php" ) || !file_exists( "../web/conf-init.php" ) )
	{
		HEADER( "location: index.php" ) ;
		exit ;
	}
	include_once("../web/conf-init.php");
	include_once("../web/$session_setup[login]/$session_setup[login]-conf-init.php") ;
	include_once("../system.php") ;
	include_once("../lang_packs/$LANG_PACK.php") ;
	include_once("../web/VERSION_KEEP.php") ;
	$section = 2;			// Section number - see header.php for list of section numbers

	// This is used in footer.php and it places a layer in the menu area when you are in
	// a section > 0 to provide navigation back.
	// This is currently set as a javascript back, but it could be replaced with explicit
	// links as using the javascript back button can cause problems after submitting a form
	// (cause the data to get resubmitted)

	$nav_line = '<a href="options.php" class="nav">:: Home</a>';
?>
<?

	// initialize
	$action = $error_mesg = $extension = "" ;
	$success = 0 ;

	if ( preg_match( "/(MSIE)|(Gecko)/", $HTTP_SERVER_VARS['HTTP_USER_AGENT'] ) )
		$text_width = "12" ;
	else
		$text_width = "9" ;

	// get variables
	if ( isset( $HTTP_POST_VARS['action'] ) ) { $action = $HTTP_POST_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['action'] ) ) { $action = $HTTP_GET_VARS['action'] ; }
	if ( isset( $HTTP_GET_VARS['success'] ) ) { $success = $HTTP_GET_VARS['success'] ; }
?>
<?
	// functions
?>
<?
	// conditions
	if ( $action == "upload_logo" )
	{
		$pic_name = $HTTP_POST_FILES['pic']['name'] ;
		$now = time() ;
		$filename = eregi_replace( " ", "_", $pic_name ) ;
		$filename = eregi_replace( "%20", "_", $filename ) ;

		$filesize = $HTTP_POST_FILES['pic']['size'] ;
		$filetype = $HTTP_POST_FILES['pic']['type'] ;

		if ( eregi( "gif", $filetype ) )
			$extension = "GIF" ;
		elseif ( eregi( "jpeg", $filetype ) )
			$extension = "JPEG" ;

		$filename = $HTTP_POST_VARS['logo_name']."_$now.$extension" ;
		if ( eregi( "gif", $filetype ) ||  eregi( "jpeg", $filetype ) )
		{
			if( copy( $HTTP_POST_FILES['pic']['tmp_name'], "../web/$session_setup[login]/$filename" ) )
			{
				if ( $HTTP_POST_VARS['logo_name'] == "LOGO" )
				{
					if ( file_exists ( "../web/$session_setup[login]/$LOGO" ) && $LOGO )
						unlink( "../web/$session_setup[login]/$LOGO" ) ;
					$LOGO = $filename ;
				}

				// set if not set in conf file
				if ( !isset( $IPNOTRACK ) ) { $IPNOTRACK = "" ; }
				$COMPANY_NAME = addslashes( $COMPANY_NAME) ;
				$conf_string = "0LEFT_ARROW0?
				\$LOGO = '$LOGO' ;
				\$COMPANY_NAME = '$COMPANY_NAME' ;
				\$SUPPORT_LOGO_ONLINE = '$SUPPORT_LOGO_ONLINE' ;
				\$SUPPORT_LOGO_OFFLINE = '$SUPPORT_LOGO_OFFLINE' ;
				\$SUPPORT_LOGO_AWAY = '$SUPPORT_LOGO_AWAY' ;
				\$VISITOR_FOOTPRINT = '$VISITOR_FOOTPRINT' ;
				\$TEXT_COLOR = '$TEXT_COLOR' ;
				\$FRAME_COLOR = '$FRAME_COLOR' ;
				\$LINK_COLOR = '$LINK_COLOR' ;
				\$ALINK_COLOR = '$ALINK_COLOR' ;
				\$VLINK_COLOR = '$VLINK_COLOR' ;
				\$CLIENT_COLOR = '$CLIENT_COLOR' ;
				\$ADMIN_COLOR = '$ADMIN_COLOR' ;
				\$CHAT_REQUEST_BACKGROUND = '$CHAT_REQUEST_BACKGROUND' ;
				\$CHAT_BOX_BACKGROUND = '$CHAT_BOX_BACKGROUND' ;
				\$CHAT_BOX_TEXT = '$CHAT_BOX_TEXT' ;
				\$POLL_TIME = '$POLL_TIME' ;
				\$INITIATE = '$INITIATE' ;
				\$INITIATE_IMAGE = '$INITIATE_IMAGE' ;
				\$IPNOTRACK = '$IPNOTRACK' ;
				\$LANG_PACK = '$LANG_PACK' ;?0RIGHT_ARROW0" ;

				$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
				$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
				$fp = fopen ("../web/$session_setup[login]/$session_setup[login]-conf-init.php", "wb+") ;
				fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
				fclose( $fp ) ;
			}
			unlink( $HTTP_POST_FILES['pic']['tmp_name'] ) ;

			HEADER( "location: customize.php?action=logo&success=1" ) ;
			exit ;
		}
		else if ( $pic_name != "" )
		{
			$action = "logo" ;
			$error_mesg = "Please upload ONLY GIF or JPEG formats.<br>" ;
		}
	}
	else if ( $action == "upload_icons" )
	{
		$pic_name = $HTTP_POST_FILES['pic']['name'] ;
		$now = time() ;
		$filename = eregi_replace( " ", "_", $pic_name ) ;
		$filename = eregi_replace( "%20", "_", $filename ) ;

		$filesize = $HTTP_POST_FILES['pic']['size'] ;
		$filetype = $HTTP_POST_FILES['pic']['type'] ;

		if ( eregi( "gif", $filetype ) )
			$extension = "GIF" ;
		elseif ( eregi( "jpeg", $filetype ) )
			$extension = "JPEG" ;

		$filename = $HTTP_POST_VARS['logo_name']."_$now.$extension" ;
		if ( eregi( "gif", $filetype ) ||  eregi( "jpeg", $filetype ) )
		{
			if( copy( $HTTP_POST_FILES['pic']['tmp_name'], "../web/$session_setup[login]/$filename" ) )
			{
				if ( $HTTP_POST_VARS['logo_name'] == "SUPPORT_LOGO_ONLINE" )
				{
					if ( file_exists ( "../web/$session_setup[login]/$SUPPORT_LOGO_ONLINE" ) && $SUPPORT_LOGO_ONLINE )
						unlink( "../web/$session_setup[login]/$SUPPORT_LOGO_ONLINE" ) ;
					$SUPPORT_LOGO_ONLINE = $filename ;
				}
				else if ( $HTTP_POST_VARS['logo_name'] == "SUPPORT_LOGO_OFFLINE" )
				{
					if ( file_exists ( "../web/$session_setup[login]/$SUPPORT_LOGO_OFFLINE" ) && $SUPPORT_LOGO_OFFLINE )
						unlink( "../web/$session_setup[login]/$SUPPORT_LOGO_OFFLINE" ) ;
					$SUPPORT_LOGO_OFFLINE = $filename ;
				}
				else if ( $HTTP_POST_VARS['logo_name'] == "SUPPORT_LOGO_AWAY" )
				{
					if ( file_exists ( "../web/$session_setup[login]/$SUPPORT_LOGO_AWAY" ) && $SUPPORT_LOGO_AWAY )
						unlink( "../web/$session_setup[login]/$SUPPORT_LOGO_AWAY" ) ;
					$SUPPORT_LOGO_AWAY = $filename ;
				}

				// set if not set in conf file
				if ( !isset( $IPNOTRACK ) ) { $IPNOTRACK = "" ; }
				$COMPANY_NAME = addslashes( $COMPANY_NAME) ;
				$conf_string = "0LEFT_ARROW0?
				\$LOGO = '$LOGO' ;
				\$COMPANY_NAME = '$COMPANY_NAME' ;
				\$SUPPORT_LOGO_ONLINE = '$SUPPORT_LOGO_ONLINE' ;
				\$SUPPORT_LOGO_OFFLINE = '$SUPPORT_LOGO_OFFLINE' ;
				\$SUPPORT_LOGO_AWAY = '$SUPPORT_LOGO_AWAY' ;
				\$VISITOR_FOOTPRINT = '$VISITOR_FOOTPRINT' ;
				\$TEXT_COLOR = '$TEXT_COLOR' ;
				\$FRAME_COLOR = '$FRAME_COLOR' ;
				\$LINK_COLOR = '$LINK_COLOR' ;
				\$ALINK_COLOR = '$ALINK_COLOR' ;
				\$VLINK_COLOR = '$VLINK_COLOR' ;
				\$CLIENT_COLOR = '$CLIENT_COLOR' ;
				\$ADMIN_COLOR = '$ADMIN_COLOR' ;
				\$CHAT_REQUEST_BACKGROUND = '$CHAT_REQUEST_BACKGROUND' ;
				\$CHAT_BOX_BACKGROUND = '$CHAT_BOX_BACKGROUND' ;
				\$CHAT_BOX_TEXT = '$CHAT_BOX_TEXT' ;
				\$POLL_TIME = '$POLL_TIME' ;
				\$INITIATE = '$INITIATE' ;
				\$INITIATE_IMAGE = '$INITIATE_IMAGE' ;
				\$IPNOTRACK = '$IPNOTRACK' ;
				\$LANG_PACK = '$LANG_PACK' ;?0RIGHT_ARROW0" ;

				$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
				$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
				$fp = fopen ("../web/$session_setup[login]/$session_setup[login]-conf-init.php", "wb+") ;
				fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
				fclose( $fp ) ;
			}
			unlink( $HTTP_POST_FILES['pic']['tmp_name'] ) ;

			HEADER( "location: customize.php?action=icons&success=1" ) ;
			exit ;
		}
		else if ( $pic_name != "" )
		{
			$action = "icons" ;
			$error_mesg = "Please upload ONLY GIF or JPEG formats.<br>" ;
		}
	}
	else if ( $action == "update_colors" )
	{
		$form = $HTTP_POST_VARS['form'] ;

		// set variable if not set
		if ( !isset( $SUPPORT_LOGO_AWAY ) )
			$SUPPORT_LOGO_AWAY = "" ;
		else if ( !isset( $INITIATE_IMAGE ) )
			$INITIATE_IMAGE = "" ;

		$COMPANY_NAME = addslashes( $COMPANY_NAME) ;
		$conf_string = "0LEFT_ARROW0?
		\$LOGO = '$LOGO' ;
		\$COMPANY_NAME = '$COMPANY_NAME' ;
		\$SUPPORT_LOGO_ONLINE = '$SUPPORT_LOGO_ONLINE' ;
		\$SUPPORT_LOGO_OFFLINE = '$SUPPORT_LOGO_OFFLINE' ;
		\$SUPPORT_LOGO_AWAY = '$SUPPORT_LOGO_AWAY' ;
		\$VISITOR_FOOTPRINT = '$VISITOR_FOOTPRINT' ;
		\$TEXT_COLOR = '#$form[TEXT_COLOR]' ;
		\$FRAME_COLOR = '#$form[FRAME_COLOR]' ;
		\$LINK_COLOR = '#$form[LINK_COLOR]' ;
		\$ALINK_COLOR = '#$form[ALINK_COLOR]' ;
		\$VLINK_COLOR = '#$form[VLINK_COLOR]' ;
		\$CLIENT_COLOR = '#$form[CLIENT_COLOR]' ;
		\$ADMIN_COLOR = '#$form[ADMIN_COLOR]' ;
		\$CHAT_REQUEST_BACKGROUND = '#$form[CHAT_REQUEST_BACKGROUND]' ;
		\$CHAT_BOX_BACKGROUND = '#$form[CHAT_BOX_BACKGROUND]' ;
		\$CHAT_BOX_TEXT = '#$form[CHAT_BOX_TEXT]' ;
		\$POLL_TIME = '$POLL_TIME' ;
		\$INITIATE = '$INITIATE' ;
		\$INITIATE_IMAGE = '$INITIATE_IMAGE' ;
		\$IPNOTRACK = '$IPNOTRACK' ;
		\$LANG_PACK = '$form[LANG_PACK]' ;?0RIGHT_ARROW0" ;

		$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
		$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
		$fp = fopen ("../web/$session_setup[login]/$session_setup[login]-conf-init.php", "wb+") ;
		fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
		fclose( $fp ) ;
		HEADER( "location: customize.php?action=colors&success=1" ) ;
		exit ;
	}
	else if ( $action == "upload_initiate" )
	{
		$pic_name = $HTTP_POST_FILES['pic']['name'] ;
		$now = time() ;
		$filename = eregi_replace( " ", "_", $pic_name ) ;
		$filename = eregi_replace( "%20", "_", $filename ) ;

		$filesize = $HTTP_POST_FILES['pic']['size'] ;
		$filetype = $HTTP_POST_FILES['pic']['type'] ;

		if ( eregi( "gif", $filetype ) )
			$extension = "GIF" ;
		elseif ( eregi( "jpeg", $filetype ) )
			$extension = "JPEG" ;

		$filename = $HTTP_POST_VARS['logo_name']."_$now.$extension" ;
		if ( eregi( "gif", $filetype ) ||  eregi( "jpeg", $filetype ) )
		{
			if( copy( $HTTP_POST_FILES['pic']['tmp_name'], "../web/$session_setup[login]/$filename" ) )
			{
				if ( $HTTP_POST_VARS['logo_name'] == "INITIATE_IMAGE" )
				{
					if ( isset( $INITIATE_IMAGE ) && file_exists ( "../web/$session_setup[login]/$INITIATE_IMAGE" ) && $INITIATE_IMAGE )
						unlink( "../web/$session_setup[login]/$INITIATE_IMAGE" ) ;
					$INITIATE_IMAGE = $filename ;
				}

				// set if not set in conf file
				if ( !isset( $IPNOTRACK ) ) { $IPNOTRACK = "" ; }
				$COMPANY_NAME = addslashes( $COMPANY_NAME) ;
				$conf_string = "0LEFT_ARROW0?
				\$LOGO = '$LOGO' ;
				\$COMPANY_NAME = '$COMPANY_NAME' ;
				\$SUPPORT_LOGO_ONLINE = '$SUPPORT_LOGO_ONLINE' ;
				\$SUPPORT_LOGO_OFFLINE = '$SUPPORT_LOGO_OFFLINE' ;
				\$SUPPORT_LOGO_AWAY = '$SUPPORT_LOGO_AWAY' ;
				\$VISITOR_FOOTPRINT = '$VISITOR_FOOTPRINT' ;
				\$TEXT_COLOR = '$TEXT_COLOR' ;
				\$FRAME_COLOR = '$FRAME_COLOR' ;
				\$LINK_COLOR = '$LINK_COLOR' ;
				\$ALINK_COLOR = '$ALINK_COLOR' ;
				\$VLINK_COLOR = '$VLINK_COLOR' ;
				\$CLIENT_COLOR = '$CLIENT_COLOR' ;
				\$ADMIN_COLOR = '$ADMIN_COLOR' ;
				\$CHAT_REQUEST_BACKGROUND = '$CHAT_REQUEST_BACKGROUND' ;
				\$CHAT_BOX_BACKGROUND = '$CHAT_BOX_BACKGROUND' ;
				\$CHAT_BOX_TEXT = '$CHAT_BOX_TEXT' ;
				\$POLL_TIME = '$POLL_TIME' ;
				\$INITIATE = '$INITIATE' ;
				\$INITIATE_IMAGE = '$INITIATE_IMAGE' ;
				\$IPNOTRACK = '$IPNOTRACK' ;
				\$LANG_PACK = '$LANG_PACK' ;?0RIGHT_ARROW0" ;

				$conf_string = preg_replace( "/0LEFT_ARROW0/", "<", $conf_string ) ;
				$conf_string = preg_replace( "/0RIGHT_ARROW0/", ">", $conf_string ) ;
				$fp = fopen ("../web/$session_setup[login]/$session_setup[login]-conf-init.php", "wb+") ;
				fwrite( $fp, $conf_string, strlen( $conf_string ) ) ;
				fclose( $fp ) ;
			}
			unlink( $HTTP_POST_FILES['pic']['tmp_name'] ) ;

			HEADER( "location: customize.php?action=initiate&success=1" ) ;
			exit ;
		}
		else if ( $pic_name != "" )
		{
			$action = "initiate" ;
			$error_mesg = "Please upload ONLY GIF or JPEG formats.<br>" ;
		}
	}
?>
<? include_once("./header.php"); ?>
<style>
<!--
.relative { position:relative; }
//--></style>
<script language="JavaScript">
<!--
	function do_upload(the_form)
	{
		if ( the_form.pic.value == "" )
			alert( "Input cannot be blank." ) ;
		else
			the_form.submit() ;
	}

	function do_submit()
	{
		ok = 1 ;
		for ( c = 0; c < document.customize.length; ++c )
		{
			if ( document.customize[c].value == "" )
			{
				ok = 0 ;
				break ;
			}
		}
		if ( ok )
			document.customize.submit() ;
		else
			alert( "All fields must be supplied." ) ;
	}

	function do_alert()
	{
		<? if ( $success ) { print "		alert( 'Success!' ) ;\n" ; } ?>
	}

	function change_color( i, value )
	{
		if ( document.getElementById && !document.all )
			document.getElementById(i).style.backgroundColor = value ;
		else if ( document.layers )
			document.layers[i].bgColor = value ;
		else if ( document.all )
			document.all[i].style.background = value ;
	}

	<? if ( $action == "colors" ): ?>

	function getAnchorPosition(anchorname){var useWindow=false;var coordinates=new Object();var x=0,y=0;var use_gebi=false, use_css=false, use_layers=false;if(document.getElementById){use_gebi=true;}else if(document.all){use_css=true;}else if(document.layers){use_layers=true;}if(use_gebi && document.all){x=AnchorPosition_getPageOffsetLeft(document.all[anchorname]);y=AnchorPosition_getPageOffsetTop(document.all[anchorname]);}else if(use_gebi){var o=document.getElementById(anchorname);x=AnchorPosition_getPageOffsetLeft(o);y=AnchorPosition_getPageOffsetTop(o);}else if(use_css){x=AnchorPosition_getPageOffsetLeft(document.all[anchorname]);y=AnchorPosition_getPageOffsetTop(document.all[anchorname]);}else if(use_layers){var found=0;for(var i=0;i<document.anchors.length;i++){if(document.anchors[i].name==anchorname){found=1;break;}}if(found==0){coordinates.x=0;coordinates.y=0;return coordinates;}x=document.anchors[i].x;y=document.anchors[i].y;}else{coordinates.x=0;coordinates.y=0;return coordinates;}coordinates.x=x;coordinates.y=y;return coordinates;}
	function getAnchorWindowPosition(anchorname){var coordinates=getAnchorPosition(anchorname);var x=0;var y=0;if(document.getElementById){if(isNaN(window.screenX)){x=coordinates.x-document.body.scrollLeft+window.screenLeft;y=coordinates.y-document.body.scrollTop+window.screenTop;}else{x=coordinates.x+window.screenX+(window.outerWidth-window.innerWidth)-window.pageXOffset;y=coordinates.y+window.screenY+(window.outerHeight-24-window.innerHeight)-window.pageYOffset;}}else if(document.all){x=coordinates.x-document.body.scrollLeft+window.screenLeft;y=coordinates.y-document.body.scrollTop+window.screenTop;}else if(document.layers){x=coordinates.x+window.screenX+(window.outerWidth-window.innerWidth)-window.pageXOffset;y=coordinates.y+window.screenY+(window.outerHeight-24-window.innerHeight)-window.pageYOffset;}coordinates.x=x;coordinates.y=y;return coordinates;}
	function AnchorPosition_getPageOffsetLeft(el){var ol=el.offsetLeft;while((el=el.offsetParent) != null){ol += el.offsetLeft;}return ol;}
	function AnchorPosition_getWindowOffsetLeft(el){return AnchorPosition_getPageOffsetLeft(el)-document.body.scrollLeft;}
	function AnchorPosition_getPageOffsetTop(el){var ot=el.offsetTop;while((el=el.offsetParent) != null){ot += el.offsetTop;}return ot;}
	function AnchorPosition_getWindowOffsetTop(el){return AnchorPosition_getPageOffsetTop(el)-document.body.scrollTop;}


	function PopupWindow_getXYPosition(anchorname){var coordinates;if(this.type == "WINDOW"){coordinates = getAnchorWindowPosition(anchorname);}else{coordinates = getAnchorPosition(anchorname);}this.x = coordinates.x;this.y = coordinates.y;}
	function PopupWindow_setSize(width,height){this.width = width;this.height = height;}
	function PopupWindow_populate(contents){this.contents = contents;this.populated = false;}
	function PopupWindow_setUrl(url){this.url = url;}
	function PopupWindow_setWindowProperties(props){this.windowProperties = props;}
	function PopupWindow_refresh(){if(this.divName != null){if(this.use_gebi){document.getElementById(this.divName).innerHTML = this.contents;}else if(this.use_css){document.all[this.divName].innerHTML = this.contents;}else if(this.use_layers){var d = document.layers[this.divName];d.document.open();d.document.writeln(this.contents);d.document.close();}}else{if(this.popupWindow != null && !this.popupWindow.closed){if(this.url!=""){this.popupWindow.location.href=this.url;}else{this.popupWindow.document.open();this.popupWindow.document.writeln(this.contents);this.popupWindow.document.close();}this.popupWindow.focus();}}}
	function PopupWindow_showPopup(anchorname){this.getXYPosition(anchorname);this.x += this.offsetX;this.y += this.offsetY;if(!this.populated &&(this.contents != "")){this.populated = true;this.refresh();}if(this.divName != null){if(this.use_gebi){document.getElementById(this.divName).style.left = this.x + "px";document.getElementById(this.divName).style.top = this.y;document.getElementById(this.divName).style.visibility = "visible";}else if(this.use_css){document.all[this.divName].style.left = this.x;document.all[this.divName].style.top = this.y;document.all[this.divName].style.visibility = "visible";}else if(this.use_layers){document.layers[this.divName].left = this.x;document.layers[this.divName].top = this.y;document.layers[this.divName].visibility = "visible";}}else{if(this.popupWindow == null || this.popupWindow.closed){if(this.x<0){this.x=0;}if(this.y<0){this.y=0;}if(screen && screen.availHeight){if((this.y + this.height) > screen.availHeight){this.y = screen.availHeight - this.height;}}if(screen && screen.availWidth){if((this.x + this.width) > screen.availWidth){this.x = screen.availWidth - this.width;}}var avoidAboutBlank = window.opera ||( document.layers && !navigator.mimeTypes['*']) || navigator.vendor == 'KDE' ||( document.childNodes && !document.all && !navigator.taintEnabled);this.popupWindow = window.open(avoidAboutBlank?"":"about:blank","window_"+anchorname,this.windowProperties+",width="+this.width+",height="+this.height+",screenX="+this.x+",left="+this.x+",screenY="+this.y+",top="+this.y+"");}this.refresh();}}
	function PopupWindow_hidePopup(){if(this.divName != null){if(this.use_gebi){document.getElementById(this.divName).style.visibility = "hidden";}else if(this.use_css){document.all[this.divName].style.visibility = "hidden";}else if(this.use_layers){document.layers[this.divName].visibility = "hidden";}}else{if(this.popupWindow && !this.popupWindow.closed){this.popupWindow.close();this.popupWindow = null;}}}
	function PopupWindow_isClicked(e){if(this.divName != null){if(this.use_layers){var clickX = e.pageX;var clickY = e.pageY;var t = document.layers[this.divName];if((clickX > t.left) &&(clickX < t.left+t.clip.width) &&(clickY > t.top) &&(clickY < t.top+t.clip.height)){return true;}else{return false;}}else if(document.all){var t = window.event.srcElement;while(t.parentElement != null){if(t.id==this.divName){return true;}t = t.parentElement;}return false;}else if(this.use_gebi && e){var t = e.originalTarget;while(t.parentNode != null){if(t.id==this.divName){return true;}t = t.parentNode;}return false;}return false;}return false;}
	function PopupWindow_hideIfNotClicked(e){if(this.autoHideEnabled && !this.isClicked(e)){this.hidePopup();}}
	function PopupWindow_autoHide(){this.autoHideEnabled = true;}
	function PopupWindow_hidePopupWindows(e){for(var i=0;i<popupWindowObjects.length;i++){if(popupWindowObjects[i] != null){var p = popupWindowObjects[i];p.hideIfNotClicked(e);}}}
	function PopupWindow_attachListener(){if(document.layers){document.captureEvents(Event.MOUSEUP);}window.popupWindowOldEventListener = document.onmouseup;if(window.popupWindowOldEventListener != null){document.onmouseup = new Function("window.popupWindowOldEventListener();PopupWindow_hidePopupWindows();");}else{document.onmouseup = PopupWindow_hidePopupWindows;}}
	function PopupWindow(){if(!window.popupWindowIndex){window.popupWindowIndex = 0;}if(!window.popupWindowObjects){window.popupWindowObjects = new Array();}if(!window.listenerAttached){window.listenerAttached = true;PopupWindow_attachListener();}this.index = popupWindowIndex++;popupWindowObjects[this.index] = this;this.divName = null;this.popupWindow = null;this.width=0;this.height=0;this.populated = false;this.visible = false;this.autoHideEnabled = false;this.contents = "";this.url="";this.windowProperties="toolbar=no,location=no,status=no,menubar=no,scrollbars=auto,resizable,alwaysRaised,dependent,titlebar=no";if(arguments.length>0){this.type="DIV";this.divName = arguments[0];}else{this.type="WINDOW";}this.use_gebi = false;this.use_css = false;this.use_layers = false;if(document.getElementById){this.use_gebi = true;}else if(document.all){this.use_css = true;}else if(document.layers){this.use_layers = true;}else{this.type = "WINDOW";}this.offsetX = 0;this.offsetY = 0;this.getXYPosition = PopupWindow_getXYPosition;this.populate = PopupWindow_populate;this.setUrl = PopupWindow_setUrl;this.setWindowProperties = PopupWindow_setWindowProperties;this.refresh = PopupWindow_refresh;this.showPopup = PopupWindow_showPopup;this.hidePopup = PopupWindow_hidePopup;this.setSize = PopupWindow_setSize;this.isClicked = PopupWindow_isClicked;this.autoHide = PopupWindow_autoHide;this.hideIfNotClicked = PopupWindow_hideIfNotClicked;}

	ColorPicker_targetInput = null;
	function ColorPicker_writeDiv(){document.writeln("<DIV ID=\"colorPickerDiv\" STYLE=\"position:absolute;visibility:hidden;\"> </DIV>");}
	function ColorPicker_show(anchorname){this.showPopup(anchorname);}
	function ColorPicker_pickColor(td,color,obj){change_color(td,color);obj.hidePopup();pickColor(color);}
	function pickColor(color){if(ColorPicker_targetInput==null){alert("Target Input is null, which means you either didn't use the 'select' function or you have no defined your own 'pickColor' function to handle the picked color!");return;}ColorPicker_targetInput.value = color;}
	function ColorPicker_select(inputobj,linkname){if(inputobj.type!="text" && inputobj.type!="hidden" && inputobj.type!="textarea"){alert("colorpicker.select: Input object passed is not a valid - OR you may be using an old browser (Netscape 4.x)");window.ColorPicker_targetInput=null;return;}window.ColorPicker_targetInput = inputobj;this.show(linkname);}
	function ColorPicker_highlightColor(c){var thedoc =(arguments.length>1)?arguments[1]:window.document;var d = thedoc.getElementById("colorPickerSelectedColor");d.style.backgroundColor = c;d = thedoc.getElementById("colorPickerSelectedColorValue");d.innerHTML = c;}
	function ColorPicker(){var windowMode = false;if(arguments[0] == "div"){var divname = "colorPickerDiv";}else if(arguments[0] == "window"){var divname = '';windowMode = true;}else{var divname = arguments[0];}if(divname != ""){var cp = new PopupWindow(divname);}else{var cp = new PopupWindow();cp.setSize(225,250);}cp.currentValue = "#FFFFFF";cp.writeDiv = ColorPicker_writeDiv;cp.highlightColor = ColorPicker_highlightColor;cp.show = ColorPicker_show;cp.select = ColorPicker_select;var colors = new Array("000000","000033","000066","000099","0000CC","0000FF","330000","330033","330066","330099","3300CC",
	"3300FF","660000","660033","660066","660099","6600CC","6600FF","990000","990033","990066","990099",
	"9900CC","9900FF","CC0000","CC0033","CC0066","CC0099","CC00CC","CC00FF","FF0000","FF0033","FF0066",
	"FF0099","FF00CC","FF00FF","003300","003333","003366","003399","0033CC","0033FF","333300","333333",
	"333366","333399","3333CC","3333FF","663300","663333","663366","663399","6633CC","6633FF","993300",
	"993333","993366","993399","9933CC","9933FF","CC3300","CC3333","CC3366","CC3399","CC33CC","CC33FF",
	"FF3300","FF3333","FF3366","FF3399","FF33CC","FF33FF","006600","006633","006666","006699","0066CC",
	"0066FF","336600","336633","336666","336699","3366CC","3366FF","666600","666633","666666","666699",
	"6666CC","6666FF","996600","996633","996666","996699","9966CC","9966FF","CC6600","CC6633","CC6666",
	"CC6699","CC66CC","CC66FF","FF6600","FF6633","FF6666","FF6699","FF66CC","FF66FF","009900","009933",
	"009966","009999","0099CC","0099FF","339900","339933","339966","339999","3399CC","3399FF","669900",
	"669933","669966","669999","6699CC","6699FF","999900","999933","999966","999999","9999CC","9999FF",
	"CC9900","CC9933","CC9966","CC9999","CC99CC","CC99FF","FF9900","FF9933","FF9966","FF9999","FF99CC",
	"FF99FF","00CC00","00CC33","00CC66","00CC99","00CCCC","00CCFF","33CC00","33CC33","33CC66","33CC99",
	"33CCCC","33CCFF","66CC00","66CC33","66CC66","66CC99","66CCCC","66CCFF","99CC00","99CC33","99CC66",
	"99CC99","99CCCC","99CCFF","CCCC00","CCCC33","CCCC66","CCCC99","CCCCCC","CCCCFF","FFCC00","FFCC33",
	"FFCC66","FFCC99","FFCCCC","FFCCFF","00FF00","00FF33","00FF66","00FF99","00FFCC","00FFFF","33FF00",
	"33FF33","33FF66","33FF99","33FFCC","33FFFF","66FF00","66FF33","66FF66","66FF99","66FFCC","66FFFF",
	"99FF00","99FF33","99FF66","99FF99","99FFCC","99FFFF","CCFF00","CCFF33","CCFF66","CCFF99","CCFFCC",
	"CCFFFF","FFFF00","FFFF33","FFFF66","FFFF99","FFFFCC","FFFFFF");var total = colors.length;var width = 18;var cp_contents = "";var windowRef =(windowMode)?"window.opener.":"";if(windowMode){cp_contents += "<HTML><HEAD><TITLE>Select Color</TITLE></HEAD>";cp_contents += "<BODY BGCOLOR=#FFFFFF MARGINWIDTH=0 MARGINHEIGHT=0 LEFTMARGIN=0 TOPMARGIN=0><FONT SIZE=3 FACE='arial'><CENTER>";}cp_contents += "<TABLE BORDER=1 CELLSPACING=1 CELLPADDING=0>";var use_highlight =(document.getElementById || document.all)?true:false;for(var i=0;i<total;i++){if((i % width) == 0){cp_contents += "<TR>";}if(use_highlight){var mo = 'onMouseOver="'+windowRef+'ColorPicker_highlightColor(\''+colors[i]+'\',window.document)"';}else{mo = "";}cp_contents += '<TD BGCOLOR="'+colors[i]+'"><FONT SIZE="-3"><A HREF="#" onClick="'+windowRef+'ColorPicker_pickColor(\''+arguments[2]+'\',\''+colors[i]+'\','+windowRef+'window.popupWindowObjects['+cp.index+']);return false;" '+mo+' STYLE="text-decoration:none;">&nbsp;&nbsp;&nbsp;</A></FONT></TD>';if( ((i+1)>=total) ||(((i+1) % width) == 0)){cp_contents += "</TR>";}}if(document.getElementById){var width1 = Math.floor(width/2);var width2 = width = width1;cp_contents += "<TR><TD COLSPAN='"+width1+"' BGCOLOR='#ffffff' ID='colorPickerSelectedColor'>&nbsp;</TD><TD COLSPAN='"+width2+"' ALIGN='CENTER' ID='colorPickerSelectedColorValue'>#FFFFFF</TD></TR>";}cp_contents += "</TABLE>";if(windowMode){cp_contents += "<b>"+arguments[1]+"</b></CENTER></BODY></HTML>";}cp.populate(cp_contents+"\n");cp.offsetY = 25;cp.autoHide();return cp;}

	<? endif ; ?>

//-->
</script>

<? if ( $action == "colors" ): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  <td height="350" valign="top"> <p><span class="title">Interface: Customize
		Colors &amp; Language</span> <br>
	  Customize your chat window colors below. Colors are in HEX values.
	  </p>
	<form method="POST" action="customize.php" name="customize">
<input type="hidden" name="action" value="update_colors">
	<table width="100%" border="0" cellspacing="1" cellpadding="3">
	  <tr> 
		<td>Language: 
			<select name="form[LANG_PACK]">
			<?
				if ( $dir = @opendir( "../lang_packs" ) )
				{
					while( $file = readdir( $dir ) )
					{
						if ( ( $file = preg_replace( "/\.php/", "", $file ) ) && !preg_match( "/(.bak)|(CVS)/", $file ) && preg_match( "/[0-9a-z]/i", $file ) )
						{
							$selected = "" ;
							if ( $file == $LANG_PACK )
								$selected = "selected" ;
							print "<option value=\"$file\" $selected>$file" ;
						}
					} 
					closedir($dir) ;
				}
			?>
			</select></td>
	  </tr>
	  <tr>
		<td class="hdash">&nbsp;</td>
	  </tr>
	</table>
	<br>
	  <table width="100%" border="0" cellspacing="2" cellpadding="3">
	  <tr><td colspan=3>Only HEX Values (1-10 and A-F).  Do not include the "#" in the field.</td></tr>
		<tr> 
		  <td id="td1" bgColor="<? echo $FRAME_COLOR ?>" style="background-color:<? echo $FRAME_COLOR ?>" class="relative">#<input type="text" name="form[FRAME_COLOR]" value="<? echo preg_replace( "/#/", "", $FRAME_COLOR ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td1', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','Chat Frame Color', 'td1');cp.select(document.customize.elements[2],'c1');return false;" name="c1" id="c1">Pick</a></td>
		  <td class="altcolor2"><strong>Chat Frame Color:</strong> The frame border color of the chat window.</td>
		</tr>
		<tr> 
		  <td id="td2" bgColor="<? echo $CHAT_REQUEST_BACKGROUND ?>" style="background-color:<? echo $CHAT_REQUEST_BACKGROUND ?>" class="relative">#<input type="text" name="form[CHAT_REQUEST_BACKGROUND]" value="<? echo preg_replace( "/#/", "",  $CHAT_REQUEST_BACKGROUND ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td2', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','Chat Request BgColor', 'td2');cp.select(document.customize.elements[3],'c2');return false;" name="c2" id="c2">Pick</a></td>
		  <td class="altcolor2"><strong>Chat Request BgColor:</strong> Background color 
			of live support system. </td>
		</tr>
		<tr> 
		  <td id="td3" bgColor="<? echo $TEXT_COLOR ?>" style="background-color:<? echo $TEXT_COLOR ?>" class="relative">#<input type="text" name="form[TEXT_COLOR]" value="<? echo preg_replace( "/#/", "", $TEXT_COLOR ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td3', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','Text Color', 'td3');cp.select(document.customize.elements[4],'c3');return false;" name="c3" id="c3">Pick</a></td>
		  <td class="altcolor2"><strong>Text Color:</strong> Color of text throughout the 
			system EXCEPT 'Chat Box Text Color' has it's own color.</td>
		</tr>
		<tr> 
		  <td id="td4" bgColor="<? echo $CLIENT_COLOR ?>" style="background-color:<? echo $CLIENT_COLOR ?>" class="relative">#<input type="text" name="form[CLIENT_COLOR]" value="<? echo preg_replace( "/#/", "", $CLIENT_COLOR ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td4', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','Client Login Color', 'td4');cp.select(document.customize.elements[5],'c4');return false;" name="c4" id="c4">Pick</a></td>
		  <td class="altcolor2"><strong>Client Login Color:</strong> Visitor's login name 
			color during chat.</td>
		</tr>
		<tr> 
		  <td id="td5" bgColor="<? echo $ADMIN_COLOR ?>" style="background-color:<? echo $ADMIN_COLOR ?>" class="relative">#<input type="text" name="form[ADMIN_COLOR]" value="<? echo preg_replace( "/#/", "", $ADMIN_COLOR ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td5', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','Admin Login Color', 'td5');cp.select(document.customize.elements[6],'c5');return false;" name="c5" id="c5">Pick</a></td>
		  <td class="altcolor2"><strong>Admin Login Color:</strong> Admin's login name color 
			during chat.</td>
		</tr>
		<tr> 
		  <td id="td6" bgColor="<? echo $LINK_COLOR ?>" style="background-color:<? echo $LINK_COLOR ?>" class="relative">#<input type="text" name="form[LINK_COLOR]" value="<? echo preg_replace( "/#/", "", $LINK_COLOR ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td6', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','Link Color', 'td6');cp.select(document.customize.elements[7],'c6');return false;" name="c6" id="c6">Pick</a></td>
		  <td class="altcolor2"><strong>Link Color:</strong> Color of links throughout the 
			entire system.</td>
		</tr>
		<tr> 
		  <td id="td7" bgColor="<? echo $ALINK_COLOR ?>" style="background-color:<? echo $ALINK_COLOR ?>" class="relative">#<input type="text" name="form[ALINK_COLOR]" value="<? echo preg_replace( "/#/", "", $ALINK_COLOR ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td7', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','ALink Color', 'td7');cp.select(document.customize.elements[8],'c7');return false;" name="c7" id="c7">Pick</a></td>
		  <td class="altcolor2"><strong>ALink Color:</strong> Color of link press throughout 
			the entire system.</td>
		</tr>
		<tr> 
		  <td id="td8" bgColor="<? echo $VLINK_COLOR ?>" style="background-color:<? echo $VLINK_COLOR ?>" class="relative">#<input type="text" name="form[VLINK_COLOR]" value="<? echo preg_replace( "/#/", "", $VLINK_COLOR ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td8', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','VLink Color', 'td8');cp.select(document.customize.elements[9],'c8');return false;" name="c8" id="c8">Pick</a></td>
		  <td class="altcolor2"><strong>VLink Color:</strong> Color of visited links throughout 
			the entire system.</td>
		</tr>
		<tr> 
		  <td id="td9" bgColor="<? echo $CHAT_BOX_BACKGROUND ?>" style="background-color:<? echo $CHAT_BOX_BACKGROUND ?>" class="relative">#<input type="text" name="form[CHAT_BOX_BACKGROUND]" value="<? echo preg_replace( "/#/", "", $CHAT_BOX_BACKGROUND ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td9', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','Chat Box BgColor', 'td9');cp.select(document.customize.elements[10],'c9');return false;" name="c9" id="c9">Pick</a></td>
		  <td class="altcolor2"><strong>Chat Box BgColor:</strong> Background color of chat 
			message area (where messages appear during chat).</td>
		</tr>
		<tr> 
		  <td id="td10" bgColor="<? echo $CHAT_BOX_TEXT ?>" style="background-color:<? echo $CHAT_BOX_TEXT ?>" class="relative">#<input type="text" name="form[CHAT_BOX_TEXT]" value="<? echo preg_replace( "/#/", "", $CHAT_BOX_TEXT ) ?>" size="<? echo $text_width ?>" maxlength="6" onBlur="change_color('td10', this.value)" onKeyPress="return rgbvalues(event)"></td>
		  <td class="altcolor2" width="20"><a href="JavaScript:void(0)" onClick="var cp = new ColorPicker('window','Chat Box Text Color', 'td10');cp.select(document.customize.elements[11],'c10');return false;" name="c10" id="c10">Pick</a></td>
		  <td class="altcolor2"><strong>Chat Box Text Color:</strong> The text color of 
			text messages during chat.</td>
		</tr>
		<tr> 
		  <td>&nbsp;</td>
		</tr>
		<tr>
		  <td><input name="submit" type="submit" class="mainButton" id="submit" value="Submit Changes"></td>
		</tr>
	  </table>
	</form></td>



<? elseif ( ( $action == "logo" ) && file_exists( "../super/asp.php" ) ) :
	if ( file_exists( "../web/$session_setup[login]/$LOGO" ) && $LOGO )
		$logo = "../web/$session_setup[login]/$LOGO" ;
	else if ( file_exists( "../web/$LOGO_ASP" ) && $LOGO_ASP )
		$logo = "../web/$LOGO_ASP" ;
	else
		$logo = "../images/logo.gif" ;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  		  <td valign="top" width="100%"> <p><span class="title">Interface: Company Logo</span><br>
			  Customize your company logo by uploading the logo image (GIF/JPEG) file below.<br>
			  </p>
			  Below is suggested MAX image size.<br>
			  <big><b>(max width: 250px - max height: 53px).</b></big><p>
			  <span class="smallTitle"><font color="#FF0000"><? echo $error_mesg ?></font></span><br>

	<table width="100%" border="0" cellspacing="8" cellpadding="0">
	  <form method="POST" action="customize.php" enctype="multipart/form-data" name="logo">
	  <input type="hidden" name="action" value="upload_logo">
		<input type="hidden" name="logo_name" value="LOGO">
		<tr> 
		  		  <td>Current Company Logo:<br>
				  <img src="<? echo $logo ?>"><p>
				  Upload Logo Below
				  <p>
				  
				  <input type="file" name="pic" size="20"> &nbsp; <input type="button" class="mainButton" value="Upload Image" OnClick="do_upload(document.logo);">
			</td>
		</tr>
		<tr> 
	  </form>
	  <td colspan="2" class="hdash">&nbsp;</td>
	  </tr>
	  <tr>
	  <td colspan="2">&nbsp;<br>&nbsp;<br>&nbsp;</td>
	  </tr>
	</table></td>


<? elseif ( $action == "icons" ): ?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  		  <td valign="top"> <p><span class="title">Interface: Default Chat Icons</span><br>
			  Set your default chat icons below. If you would like to customize 
			  icons for EACH department, <a href="adddept.php">click here</a></p>
			  <span class="smallTitle"><font color="#FF0000"><? echo $error_mesg ?></font></span><br>

	<table width="100%" border="0" cellspacing="8" cellpadding="0">
	  <form method="POST" action="customize.php" enctype="multipart/form-data" name="support_logo_online">
		<input type="hidden" name="action" value="upload_icons">
		<input type="hidden" name="logo_name" value="SUPPORT_LOGO_ONLINE">
		<tr> 
		  		  <td>Upload <u>Online</u> Support Image<br>
			</a></td>
		  <td rowspan="3" align="right"><img src="<?= ( file_exists( "../web/$session_setup[login]/$SUPPORT_LOGO_ONLINE" ) && $SUPPORT_LOGO_ONLINE ) ? "../web/$session_setup[login]/$SUPPORT_LOGO_ONLINE" : "../images/phplive_support_online.gif" ?>"></td>
		</tr>
		<tr> 
		  <td align="right"> <input type="file" name="pic" size="20"></td>
		</tr>
		<tr> 
		  <td align="right"><input type="button" class="mainButton" value="Upload Image" OnClick="do_upload(document.support_logo_online);"></td>
		</tr> 
	  </form>
	  <tr>
	  <td colspan="2" class="hdash">&nbsp;</td>
	  </tr>
	  <form method="POST" action="customize.php" enctype="multipart/form-data" name="support_logo_offline">
		<input type="hidden" name="action" value="upload_icons">
		<input type="hidden" name="logo_name" value="SUPPORT_LOGO_OFFLINE">
		<tr> 
		  		  <td>Upload <u>Offline</u> Support Image<br>
			</a></td>
		  <td rowspan="3" align="right"><img src="<?= ( file_exists( "../web/$session_setup[login]/$SUPPORT_LOGO_OFFLINE" ) && $SUPPORT_LOGO_OFFLINE ) ? "../web/$session_setup[login]/$SUPPORT_LOGO_OFFLINE" : "../images/phplive_support_offline.gif" ?>"></td>
		</tr>
		<tr> 
		  <td align="right"> <input type="file" name="pic" size="20"></td>
		</tr>
		<tr> 
		  <td align="right"><input type="button" class="mainButton" value="Upload Image" OnClick="do_upload(document.support_logo_offline);"></td>
		</tr>
		</form>
		<!-- <tr>
	<td colspan="2" class="hdash">&nbsp;</td>
	  </tr>
	  <form method="POST" action="customize.php" enctype="multipart/form-data" name="support_logo_away">
		<input type="hidden" name="action" value="upload_icons">
		<input type="hidden" name="logo_name" value="SUPPORT_LOGO_AWAY">
		<tr> 
		  		  <td>Upload <u>Away</u> Support Image<br>
				  If operators' consoles are open but status is offline, below status icon will display.  ONLY when the operators' status are offline AND consoles are closed will the image show the above offline icon.
			</a></td>
		  <td rowspan="3" align="right"><img src="<?= ( file_exists( "../web/$session_setup[login]/$SUPPORT_LOGO_AWAY" ) && $SUPPORT_LOGO_AWAY ) ? "../web/$session_setup[login]/$SUPPORT_LOGO_AWAY" : "../images/phplive_support_away.gif" ?>"></td>
		</tr>
		<tr> 
		  <td align="right"> <input type="file" name="pic" size="20"></td>
		</tr>
		<tr> 
		  <td align="right"><input type="button" class="mainButton" value="Upload Image" OnClick="do_upload(document.support_logo_away);"></td>
		</tr> 
	  </form> -->
	</table></td>


<? elseif ( ( $action == "initiate" ) && $INITIATE && !file_exists( "$DOCUMENT_ROOT/admin/auction/index.php" ) ) :
	if ( isset( $INITIATE_IMAGE ) && file_exists( "../web/$session_setup[login]/$INITIATE_IMAGE" ) && $INITIATE_IMAGE )
		$logo = "../web/$session_setup[login]/$INITIATE_IMAGE" ;
	else
		$logo = "../images/initiate_chat.gif" ;
?>
<table width="100%" border="0" cellspacing="0" cellpadding="15">
<tr> 
  		  <td valign="top" width="100%"> <p><span class="title">Interface: Initiate Chat Image</span><br>
			  When you initiate a chat with a visitor, you have an option to have the below image to scroll across their browser window.  Set your default Initiate Chat scrolling image (GIF/JPEG) file below.</p>
			  <span class="smallTitle"><font color="#FF0000"><? echo $error_mesg ?></font></span><br>

	<table width="100%" border="0" cellspacing="8" cellpadding="0">
	  <form method="POST" action="customize.php" enctype="multipart/form-data" name="initiate">
	  <input type="hidden" name="action" value="upload_initiate">
		<input type="hidden" name="logo_name" value="INITIATE_IMAGE">
		<tr> 
		  		  <td>Current Initiate Chat Scrolling Image:<br>
				  <img src="<? echo $logo ?>"><p>
				  Upload New Image Below
				  <p>
				  
				  <input type="file" name="pic" size="20"> &nbsp; <input type="button" class="mainButton" value="Upload Image" OnClick="do_upload(document.initiate);">
			</td>
		</tr>
		<tr> 
	  </form>
	  <td colspan="2" class="hdash">&nbsp;</td>
	  </tr>
	  <tr>
	  <td colspan="2">&nbsp;<br>&nbsp;<br>&nbsp;</td>
	  </tr>
	</table></td>


<? else: ?>





<? endif ; ?>
		<td style="background-image: url(../images/g_interface_big.jpg);background-repeat: no-repeat;"><img src="../images/spacer.gif" width="229" height="1"></td>
</tr>
</table>
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<? include_once( "./footer.php" ) ; ?>