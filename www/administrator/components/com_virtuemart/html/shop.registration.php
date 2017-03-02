<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' ); 
/**
*
* @version $Id: shop.registration.php 617 2007-01-04 19:43:08Z soeren_nb $
* @package VirtueMart
* @subpackage html
* @copyright Copyright (C) 2004-2005 Soeren Eberhardt. All rights reserved.
* @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
* VirtueMart is free software. This version may have been modified pursuant
* to the GNU General Public License, and as distributed it includes or
* is derivative of works licensed under the GNU General Public License or
* other free or open source software licenses.
* See /administrator/components/com_virtuemart/COPYRIGHT.php for copyright notices and details.
*
* http://virtuemart.net
*/
mm_showMyFileName( __FILE__ );
$mainframe->setPageTitle( $VM_LANG->_REGISTER_TITLE );
$mainframe->appendPathWay( $VM_LANG->_REGISTER_TITLE.' / '. _BUTTON_LOGIN );
if( !$my->id ) {
  ?>
            <fieldset>
                <legend><span class="sectiontableheader"><?php echo $VM_LANG->_PHPSHOP_RETURN_LOGIN ?></span></legend>
                <br />
            <?php 
                        include(PAGEPATH.'checkout.login_form.php');
            ?>
                <br />
            </fieldset><br />
            <?php
          
          
          ?><br />
            <div class="sectiontableheader"><?php echo $VM_LANG->_PHPSHOP_NEW_CUSTOMER ?></div>
                <br /><?php
          
                include(PAGEPATH. 'checkout_register_form.php');
?>
                <br />
<?php
}
else {
	mosRedirect( $sess->url( URL.'index.php?page='.HOMEPAGE ) );
}