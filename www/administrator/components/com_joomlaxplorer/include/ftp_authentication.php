<?php
// ensure this file is being included by a parent file
if( !defined( '_JEXEC' ) && !defined( '_VALID_MOS' ) ) die( 'Restricted access' );
/**
 * @version $Id: $
 * @package joomlaXplorer
 * @copyright soeren 2007
 * @author The joomlaXplorer project (http://joomlacode.org/gf/project/joomlaxplorer/)
 * @author The  The QuiX project (http://quixplorer.sourceforge.net)
 * 
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
 * This file handles ftp authentication
 *
 */
class jx_ftp_authentication {
	function execAction() {
	  	$ftp_login = mosGetParam( $_POST, 'ftp_login_name', '' );
	  	$ftp_pass = mosGetParam( $_POST, 'ftp_login_pass', '' );
		global $dir, $mosConfig_live_site;
		
		if( $ftp_login != '' || $ftp_pass != '' ) {
	
			$ftp_host = mosGetParam( $_POST, 'ftp_host', 'localhost:21' );
			$url = @parse_url( 'ftp://' . $ftp_host);
			if( empty( $url )) {			
				jx_Result::sendResult('ftp_authentication', false, 'Unable to parse the specified Host Name. Please use a hostname in this format: hostname:21' );
			}
			$port = empty($url['port']) ? 21 : $url['port'];
			$ftp = new Net_FTP( $url['host'], $port, 20 );
			
			$res = $ftp->connect();
			if( PEAR::isError( $res )) {
				jx_Result::sendResult('ftp_authentication', false, $GLOBALS['messages']['ftp_connection_failed'] );
			}
			else {
				$res = $ftp->login( $ftp_login, $ftp_pass );
				$ftp->disconnect();
				if( PEAR::isError( $res )) {
					jx_Result::sendResult('ftp_authentication', false, $GLOBALS['messages']['ftp_login_failed'] );
					
				}
				
				$_SESSION['ftp_login'] = $ftp_login;
				$_SESSION['ftp_pass'] = $ftp_pass;
				$_SESSION['ftp_host'] = $_POST['ftp_host'];
				$_SESSION['file_mode'] = 'ftp';
				
				session_write_close();
				
				jx_Result::sendResult('ftp_authentication', true, 'Login OK!' );
			}
			
		}
		else {
			?>
	<div style="width:auto;">
	    <div class="x-box-tl"><div class="x-box-tr"><div class="x-box-tc"></div></div></div>
	    <div class="x-box-ml"><div class="x-box-mr"><div class="x-box-mc">
	
	        <h3 style="margin-bottom:5px;"><?php echo $GLOBALS["messages"]["ftp_header"] ?></h3>
	        <strong><?php echo $GLOBALS["messages"]["ftp_login_lbl"] ?></strong><br />
	<br />
	        <div id="adminForm">
	
	        </div>
	    </div></div></div>
	    <div class="x-box-bl"><div class="x-box-br"><div class="x-box-bc"></div></div></div>
	</div>
			<script type="text/javascript">
	var simple = new Ext.form.Form({
	    labelWidth: 175, // label settings here cascade unless overridden
	    url:'<?php echo make_link("rename",$dir,$item) ?>'
	});
	simple.add(
	    new Ext.form.TextField({
	        fieldLabel: '<?php echo jx_Lang::msg('ftp_login_name', true ) ?>',
	        name: 'ftp_login_name',
	        width:175,
	        allowBlank:false
	    }),
	    new Ext.form.TextField({
	        fieldLabel: '<?php echo jx_Lang::msg('ftp_login_pass', true ) ?>',
	        name: 'ftp_login_pass',
	        inputType: 'password',
	        width:175,
	        allowBlank:false
	    }),
	    new Ext.form.TextField({
	        fieldLabel: '<?php echo jx_Lang::msg('ftp_hostname_port', true ) ?>',
	        name: 'ftp_hostname_port',
	        value: '<?php echo mosGetParam($_SESSION,'ftp_host', 'localhost:21') ?>',
	        width:175,
	        allowBlank:false
	    })
	    );
	
	simple.addButton('Save', function() {
	    simple.submit({
	        waitMsg: '<?php echo jx_Lang::msg('ftp_login_check', true ) ?>',
	        //reset: true,
	        reset: false,
	        success: function(form, action) { location.reload() },
	        failure: function(form, action) {Ext.MessageBox.alert('Error!', action.result.error);},
	        scope: simple,
	        // add some vars to the request, similar to hidden fields
	        params: {option: 'com_joomlaxplorer', 
	        		action: 'ftp_authentication'
	        }
	    });
	});
	simple.addButton('<?php echo jx_Lang::msg( 'btncancel', true ) ?>', function() { dialog.destroy(); } );
	simple.render('adminForm');
			</script>
			
			<br/>
		<?php
		}
	}
}
function ftp_logout() {
	unset($_SESSION['ftp_login']);
	unset($_SESSION['ftp_pass']);
	unset($_SESSION['ftp_host']);
	session_write_close();
	mosRedirect('index2.php?option=com_joomlaxplorer&file_mode=file');
}