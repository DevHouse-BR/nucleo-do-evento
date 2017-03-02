<?php


/** 
 * mosSefPatch extends mosMainframe
 * it actual inherits the mosMainframe class and overrulles the functions that are needed
 * for creating Joomla SEO settings
 * Joomlatwork 30 june 2006
 */
class mosSefPatch extends mosMainFrame {
	
	/**
	* @param string
	*/
	function setPageTitle( $title=null ) {
        if (@$GLOBALS['mosConfig_pagetitles']) {
            $title = trim( htmlspecialchars( $title ) );
            $this->_head['title'] = $title ;
        }
	}
	/**
	* @param string The value of the name attibute
	* @param string The value of the content attibute to append to the existing
	* Tags ordered in with Site Keywords and Description first
	* Joomlatwork: adjusted clean display of the META fields
	*/
	function appendMetaTag( $name, $content ) {
        $name = trim( htmlspecialchars( $name ) );
        $n = count( $this->_head['meta'] );
        for ($i = 0; $i < $n; $i++) {
            if ($this->_head['meta'][$i][0] == $name) {
                $content = trim( htmlspecialchars( $content ) );
                if ( $content != "" & $this->_head['meta'][$i][1] == "")  {
                    $this->_head['meta'][$i][1] .= ',' . $content;
                }
                return;
        		}
        }
        $this->addMetaTag( $name, $content );
	}
	
	/**
	* @return string
	*/
	function getHead() {
		$head = array();
		if ( $this->getPageTitle() == "" ) {
			$this->_head['title'] = $GLOBALS['mosConfig_sitename'];
		}
		$head[] = '<title>' . $this->_head['title'] . '</title>';
		foreach ($this->_head['meta'] as $meta) {
			if ($meta[2]) {
				$head[] = $meta[2];
			}
			$head[] = '<meta name="' . $meta[0] . '" content="' . $meta[1] . '" />';
			if ($meta[3]) {
				$head[] = $meta[3];
			}
		}
		foreach ($this->_head['custom'] as $html) {
			$head[] = $html;
		}
		return implode( "\n", $head ) . "\n";
	}

}