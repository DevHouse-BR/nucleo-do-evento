<?php

defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

global $sefConfig; 

$title[] = 'banners';

$title[] = '/';

$title[] = $task . $bid . $sefConfig->suffix;


if (count($title) > 0) $string = sef_404::sefGetLocation($string, $title,@$this_task);

if ($debug) { $GLOBALS['404SEF_DEBUG']['CLASS_SEF_404'][$debug_string]['STRING'] = $string; }

?>
