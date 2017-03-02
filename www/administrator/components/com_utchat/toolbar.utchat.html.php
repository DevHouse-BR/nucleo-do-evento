<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

class TOOLBAR_utchat {

    function CONF_MENU() {

      mosMenuBar::startTable();
      mosMenuBar::spacer();
      mosMenuBar::save('saveeditconf');
      mosMenuBar::spacer();
      mosMenuBar::cancel();
      mosMenuBar::spacer();
      mosMenuBar::endTable();


   }
	
}
?>
