<?php
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
$joomlaspan_ad_format = $params->get('joomlaspan_ad_format');
$joomlaspan_format = explode("-", $joomlaspan_ad_format);
$joomlaspan_ad_width = explode("x", $joomlaspan_format[0]);
$joomlaspan_ad_height = explode("_", $joomlaspan_ad_width[1]);
$ip_safe = 1;
if ($_SERVER["REMOTE_ADDR"] == $params->get('joomlaspan_ip_block1')) $ip_safe = 0;
if ($_SERVER["REMOTE_ADDR"] == $params->get('joomlaspan_ip_block2')) $ip_safe = 0;
if ($_SERVER["REMOTE_ADDR"] == $params->get('joomlaspan_ip_block3')) $ip_safe = 0;
if ($_SERVER["REMOTE_ADDR"] == $params->get('joomlaspan_ip_block4')) $ip_safe = 0;
if ($_SERVER["REMOTE_ADDR"] == $params->get('joomlaspan_ip_block5')) $ip_safe = 0;
//  Add another if statement here with another IP address if
//  you wish to block it as well. You can change this to use
//  an array if you have a bigger list.
//
//$ip_safe = 1; // debugging. Uncomment if you want to see the ads
if ($ip_safe) {
echo('<div style="width: 100%; text-align: center; margin-left: -5px;">' . chr(10));
echo '<div style="width:' .  $joomlaspan_ad_width[0] . 'px;height:' . $joomlaspan_ad_height[0] . 'px;' . $params->get('joomlaspan_ad_css') . ';">';
echo "<!-- Google AdSense by Joomlaspan 2.1 http://www.joomlaspan.com -->\r\n"
. "<script type=\"text/javascript\">\r\n"
. "<!--\r\n"
. "google_ad_client = \"" . $params->get('joomlaspan_ad_client') . "\";\r\n"
. "google_alternate_ad_url = \"" . $params->get('joomlaspan_alternate_ad_url') . "\"; \r\n"
. "google_alternate_color = \"" . $params->get('joomlaspan_alternate_color') . "\"; \r\n"
. "google_ad_width = " .  $joomlaspan_ad_width[0] . "; \r\n"
. "google_ad_height = " . $joomlaspan_ad_height[0] . "; \r\n"
. "google_ad_format = \"" . $joomlaspan_format[0] . "\"; \r\n"
. "google_ad_type = \"" . $params->get('joomlaspan_ad_type') . "\"; \r\n"
. "google_ad_channel = \"" . $params->get('joomlaspan_ad_channel') . "\"; \r\n"
. ( $params->get('joomlaspan_ad_in_frame') ? "google_page_url = document.location; \r\n" : "")
. "google_color_border = [\"" . $params->get('joomlaspan_color_border1') . "\",\"" . $params->get('joomlaspan_color_border2') . "\",\"" . $params->get('joomlaspan_color_border3') . "\",\"" . $params->get('joomlaspan_color_border4') . "\"]; \r\n"
. "google_color_bg = [\"" . $params->get('joomlaspan_color_bg1') . "\",\"" . $params->get('joomlaspan_color_bg2') . "\",\"" . $params->get('joomlaspan_color_bg3') . "\",\"" . $params->get('joomlaspan_color_bg4') . "\"]; \r\n"
. "google_color_link = [\"" . $params->get('joomlaspan_color_link1') . "\",\"" . $params->get('joomlaspan_color_link2') . "\",\"" . $params->get('joomlaspan_color_link3') . "\",\"" . $params->get('joomlaspan_color_link4') . "\"]; \r\n"
. "google_color_url = [\"" . $params->get('joomlaspan_color_url1') . "\",\"" . $params->get('joomlaspan_color_url2') . "\",\"" . $params->get('joomlaspan_color_url3') . "\",\"" . $params->get('joomlaspan_color_url4') . "\"]; \r\n"
. "google_color_text = [\"" . $params->get('joomlaspan_color_text1') . "\",\"" . $params->get('joomlaspan_color_text2') . "\",\"" . $params->get('joomlaspan_color_text3') . "\",\"" . $params->get('joomlaspan_color_text4') . "\"]; \r\n"
. "//--> \r\n"
. "</script>\r\n"
. "<script type=\"text/javascript\"  src=\"http://pagead2.googlesyndication.com/pagead/show_ads.js\"></script>\r\n"
. "<!-- End of Google AdSense by Joomlaspan 2.1 -->\r\n";
echo '</div>';
} else {
//  This is what visitors from the blocked IP addresses
//  will see (specified above).
//  This shows a table with the dimensions of the ad.
//  Change as needed.
//
echo '<div style="float: none; margin: 0px 0px 0px 0px;">' . $params->get('ip_block_alt_code') . '</div>';
echo('</div>' . chr(10));
}
?>