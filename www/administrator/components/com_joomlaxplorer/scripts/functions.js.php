<?php
// ensure this file is being included by a parent file
if( !defined( '_JEXEC' ) && !defined( '_VALID_MOS' ) ) die( 'Restricted access' );
/**
 * @version $Id: $
 * @package joomlaXplorer
 * @copyright soeren 2007
 * @author The joomlaXplorer project (http://joomlacode.org/gf/project/joomlaxplorer/)
 * @author The  The QuiX project (http://quixplorer.sourceforge.net)
 * @license
 * The contents of this file are subject to the Mozilla Public License
 * Version 1.1 (the "License"); you may not use this file except in
 * compliance with the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 * 
 * Software distributed under the License is distributed on an "AS IS"
 * basis, WITHOUT WARRANTY OF ANY KIND, either express or implied. See the
 * License for the specific language governing rights and limitations
 * under the License.
 * 
 * Alternatively, the contents of this file may be used under the terms
 * of the GNU General Public License Version 2 or later (the "GPL"), in
 * which case the provisions of the GPL are applicable instead of
 * those above. If you wish to allow use of your version of this file only
 * under the terms of the GPL and not to allow others to use
 * your version of this file under the MPL, indicate your decision by
 * deleting  the provisions above and replace  them with the notice and
 * other provisions required by the GPL.  If you do not delete
 * the provisions above, a recipient may use your version of this file
 * under either the MPL or the GPL."
 * 
*/
/**
 * Layout and Application Logic Functions based on ExtJS
 */
?>
function showLoadingIndicator( el, replaceContent ) {
	if( !el ) return;
	var loadingimg = 'components/com_joomlaxplorer/images/indicator.gif';
	var imgtag = '<img src="'+ loadingimg + '" alt="Loading..." border="0" name="Loading" align="absmiddle" />';
	
	if( replaceContent ) {
		el.innerHTML = imgtag;
	}
	else {
		el.innerHTML += imgtag;
	}
}
function getURLParam( strParamName, myWindow){
	if( !myWindow ){
		myWindow = window;
	}
  var strReturn = "";
  var strHref = myWindow.location.href;
  if ( strHref.indexOf("?") > -1 ){
    var strQueryString = strHref.substr(strHref.indexOf("?")).toLowerCase();
    var aQueryString = strQueryString.split("&");
    for ( var iParam = 0; iParam < aQueryString.length; iParam++ ){
      if ( aQueryString[iParam].indexOf(strParamName + "=") > -1 ){
        var aParam = aQueryString[iParam].split("=");        
        strReturn = aParam[1];
        break;
      }
    }
  }
  return strReturn;
}

function openActionDialog( caller, action ) {
	var selectedRows = jx_itemgrid.getSelectionModel().getSelections();
	if( selectedRows.length < 1 ) {
		var selectedNode = dirTree.getSelectionModel().getSelectedNode();
		if( selectedNode ) {
			selectedRows = Array( dirTree.getSelectionModel().getSelectedNode().id.replace( /_RRR_/g, '/' ) );
		}
	}
	var dontNeedSelection = { mkitem:1, get_about:1, ftp_authentication:1, upload:1, search:1 };
	if( dontNeedSelection[action] == null  && selectedRows.length < 1 ) {
		Ext.Msg.alert( '<?php echo jx_Lang::err('error', true )."','".jx_Lang::err('miscselitems', true ) ?>');
		return false;
	}

	switch( action ) {
		case 'search':
		case 'view':
		case 'mkitem':
		case 'copy':
		case 'move':
		case 'edit':
		case 'rename':
		case 'chmod':
		case 'upload':
		case 'archive':
		case 'ftp_authentication':
		case 'get_about':
			requestParams = getRequestParams();
			requestParams.action = action;
									
            dialog = new Ext.LayoutDialog("action-dlg", { 
                    autoCreate: true,
                    modal:true,
                    width:600,
                    height:400,
                    shadow:true,
                    minWidth:300,
                    minHeight:300,
                    proxyDrag: true,
                    //animateTarget: typeof caller.getEl == 'function' ? caller.getEl() : caller,
					title: 'Website Dialog',
                    center: {
                        autoScroll:true
                    }
					
            });
            dialog.addKeyListener(27, dialog.hide, dialog);
			dialog_panel = new Ext.ContentPanel('dialog-center', {
									autoCreate: true,
									autoScroll:true,
									fitToFrame: true
								});

			dialog_panel.load( { url: 'index2.php', 
								params: Ext.urlEncode( requestParams ),
								scripts: true,
								callback: function(oElement, bSuccess, oResponse) {
											if( oResponse && oResponse.responseText ) {
											try{ json = Ext.decode( oResponse.responseText );
												if( json.error != '' && typeof json.error != 'xml' ) {													
													Ext.Msg.alert( '<?php echo jx_Lang::err('error', true ) ?>', json.error );
													dialog.destroy();
												}
											} catch(e) {}
											}
										}
							});
            var layout = dialog.getLayout();
            layout.beginUpdate();
            layout.add('center', dialog_panel );
            layout.endUpdate();
            
            dialog.show();
            dialog.on('hide', function() { Ext.QuickTips.init() } );
            break;
            
		case 'delete':
			var num = selectedRows.length;
			Ext.Msg.confirm('<?php echo jx_Lang::msg('dellink', true ) ?>?', String.format("<?php echo jx_Lang::err('miscdelitems', true ) ?>", num ), deleteFiles);
			break;
		case 'extract':
			Ext.Msg.confirm('<?php echo jx_Lang::msg('extractlink', true ) ?>?', "<?php echo jx_Lang::msg('extract_warning', true ) ?>", extractArchive);
			break;
		case 'download':
			document.location = 'index3.php?option=com_joomlaxplorer&action=download&item='+ encodeURIComponent(jx_itemgrid.getSelectionModel().getSelected().get('name')) + '&dir=' + encodeURIComponent( datastore.directory );
			break;
	}
}
function handleCallback(requestParams, node) {
	var conn = new Ext.data.Connection();
	
	conn.request({
		url: 'index3.php',
		params: requestParams,
		callback: function(options, success, response ) {
			if( success ) {
				json = Ext.decode( response.responseText );
				if( json.success ) {
					Ext.Msg.alert( 'Success', json.message );
					try { 
						if( dropEvent) {
							dropEvent.target.parentNode.reload();
							dropEvent = null;
						}
						if( node ) {
							if( options.params.action == 'delete' || options.params.action == 'rename' ) {
								node.parentNode.select();
							}
							node.parentNode.reload();
						} else {
							datastore.reload();
						}
					} catch(e) { datastore.reload(); }
				} else {
					Ext.Msg.alert( 'Failure', json.error );
				}
			}
			else {
				Ext.Msg.alert( 'Error', 'Failed to connect to the server.');
			}
			
		}
	});
}
function getRequestParams() {
	var selitems, dir, node;
	var selectedRows = jx_itemgrid.getSelectionModel().getSelections();
	if( selectedRows.length < 1 ) {
		node = dirTree.getSelectionModel().getSelectedNode();
		if( node ) {
			var dir = dirTree.getSelectionModel().getSelectedNode().id.replace( /_RRR_/g, '/' );
			var lastSlash = dir.lastIndexOf( '/' );
			if( lastSlash > 0 ) {
				selitems = Array( dir.substring(lastSlash+1) );
			} else {
				selitems = Array( dir );
			}
		} else {
			selitems = {};
		}
		dir = datastore.directory.substring( 0, datastore.directory.lastIndexOf('/'));
	}
	else {
		selitems = Array(selectedRows.length);
	
		if( selectedRows.length > 0 ) {
			for( i=0; i < selectedRows.length;i++) {
				selitems[i] = selectedRows[i].get('name');
			}
		}
		dir = datastore.directory;
	}

	var requestParams = { 
		option: 'com_joomlaxplorer', 
		dir: dir,
		item: selitems.length > 0 ? selitems[0]:'',
		'selitems[]': selitems
	};
	return requestParams;
}
/**
* Function for actions, which don't require a form like download, extraction, deletion etc.
*/
function deleteFiles(btn) {
	if( btn != 'yes') {
		return;
	}
	requestParams = getRequestParams();
	requestParams.action = 'delete';
	handleCallback(requestParams);
}
function extractArchive(btn) {
	if( btn != 'yes') {
		return;
	}
	requestParams = getRequestParams();
	requestParams.action = 'extract';
	handleCallback(requestParams);
}
function deleteDir( node ) {
	requestParams = getRequestParams();
	requestParams.dir = datastore.directory.substring( 0, datastore.directory.lastIndexOf('/'));
	requestParams.selitems = Array( node.id.replace( /_RRR_/g, '/' ) );
	requestParams.action = 'delete';
	handleCallback(requestParams, node);
}

/**
*	Debug Function, that works like print_r for Objects in Javascript
*/
function var_dump(obj) {
	var vartext = "";
	for (var prop in obj) {
		if( isNaN( prop.toString() )) {
			vartext += "\t->"+prop+" = "+ eval( "obj."+prop.toString()) +"\n";
		}
    }
   	if(typeof obj == "object") {
    	return "Type: "+typeof(obj)+((obj.constructor) ? "\nConstructor: "+obj.constructor : "") + "\n" + vartext;
   	} else {
      	return "Type: "+typeof(obj)+"\n" + vartext;
	}
}//end function var_dump

//http://www.bazon.net/mishoo/home.epl?NEWS_ID=1345
function doGetCaretPosition (textarea) {

	var txt = textarea.value;
	var len = txt.length;
	var erg = txt.split("\n");
	var pos = -1;
	if(typeof textarea.selectionStart != "undefined") { // FOR MOZILLA
		pos = textarea.selectionStart;
	}
	else if(typeof document.selection != "undefined") { // FOR MSIE
		range_sel = document.selection.createRange();
		range_obj = textarea.createTextRange();
		range_obj.moveToBookmark(range_sel.getBookmark());
		range_obj.moveEnd('character',textarea.value.length);
		pos = len - range_obj.text.length;
	}
	if(pos != -1) {
		var ind = 0;
		for(;erg.length;ind++) {
			len = erg[ind].length + 1;
			if(pos < len)
			break;
			pos -= len;
		}
		ind++; pos++;
		return [ind, pos]; // ind = LINE, pos = COLUMN

	}
}
/**
* This function allows us to change the position of the caret
* (cursor) in the textarea
* Various workarounds for IE, Firefox and Opera are included
* Firefox doesn't count empty lines, IE does...
*/
function setCaretPosition( textarea, linenum ) {
	if (isNaN(linenum)) {
		updatePosition( textarea );
		return;
	}
	var txt = textarea.value;
	var len = txt.length;
	var erg = txt.split("\n");
		
	var ind = 0;
	var pos = 0;
	var nonempty = -1;
	var empty = -1;
	for(;ind < linenum;ind++) {
		/*alert( "Springe zu Zeile: "+linenum
				+"\naktuelle Zeile: "+ (ind+1) 
				+ "\naktuelle Position: "+pos 
				+ "\nText in dieser Zeile: "+erg[ind]);*/
		if( !erg[ind] && pos < len ) { empty++; pos++; continue; }
		else if( !erg[ind] ) break;
		pos += erg[ind].length;
		nonempty++;
	}
	try {
		pos -= erg[ind-1].length;	
	} catch(e) {}
	
	textarea.focus();
	
	if(textarea.setSelectionRange)
	{
		pos += nonempty;
		textarea.setSelectionRange(pos,pos);
	}
	else if (textarea.createTextRange) {
		pos -= empty;
		var range = textarea.createTextRange();
		range.collapse(true);
		range.moveEnd('character', pos);
		range.moveStart('character', pos);
		
		range.select();
	}
}
/** 
* Updates the Position Indicator fields
*/
function updatePosition(textBox) {
	var posArray = doGetCaretPosition(textBox);
	if( posArray[0] ) {
	    Ext.fly( 'txtLine' ).set( { value: posArray[0] } );
	}
	if( posArray[1] ) {
	    Ext.fly( 'txtColumn' ).set( { value: posArray[1] } );
	}
}