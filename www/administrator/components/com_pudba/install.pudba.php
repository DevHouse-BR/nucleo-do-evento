<?php
###############################################
# PU Database Admin - A Joomla 1.0.X Component#
# Copyright (C) 2007  by Pragmatic Utopia     #
# Homepage   : www.pragmaticutopia.com        #
# Email      : rick@pragmaticutopia.com       #
# Version    : 1.0.0                          #
# License    : Released under GPL             #
#					      #
# Based on PHP Mini MySQL Admin		      #
# (c) 2004-2007 Oleg Savchuk <osa@viakron.com>#
# Charset support - 			      #
# thanks to Alex Didok http://www.main.com.ua #
#					      #
# http://phpminiadmin.sourceforge.net	      #
###############################################
	
	function com_install() 
	{
  		global $database;
		global $mainframe;
		$abspath = $mainframe->getCfg('absolute_path');
		echo "Changing admin menu icons...<br>";
		$database->setQuery("UPDATE #__components SET admin_menu_img='../administrator/components/com_pudba/images/menu.png' WHERE admin_menu_link='option=com_pudba'");
          	$result[0] = $database->query();
          	foreach ($result as $i=>$iresult) 
		{
            		if ($iresult) {
              			echo "Icon " . $i . " changed: <font color=green>OK</font><br />";
            		} else {
              			echo "Error changing icon ".$i.". This is not a serious error, and can be ignored.<br>";
            		}
		}
		echo "<p><b>PU Database Admin Installation Complete</b></p>";
	}
?> 
