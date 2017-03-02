<?php
/*------------------------------------------------------------------------
# Nucleo do Evento
# ------------------------------------------------------------------------
# Copyright
# @license - Copyrighted Commercial Software
# Author: 
# Websites:  
-------------------------------------------------------------------------*/

defined( '_VALID_MOS' ) or die( 'Restricted access' );
$iso = split( '=', _ISO );
/*echo "<?xml version=\"1.0\" encoding=\"'. $iso[1] .'\"?' .'>";*/
global $ja_color_themes, $ja_header_images, $ja_width_default, $ja_color_default, $ja_font_size_default, $ja_tool, $ja_menutype, $ja_template_path, $ja_template_absolute_path, $ja_headerimg, $ja_color, $ja_width, $ja_font_size, $ja_template_name;

$ja_template_name = 'nucleodoevento';

# BEGIN: TEMPLATE CONFIGURATIONS ##########
####################################
#support extra color themes
$ja_color_themes = array('default', 'orange', 'green'); // You can add more color array if needed
####################################
# Change the width of the template
$ja_width_default = 'wide'; // 'narrow': 800x600; 'wide': 1024x768; 'auto': fluid width
# default color
$ja_color_default = 'default'; //blank for default, else pick one of in extra color themes $ja_color_themes
#font size default
$ja_font_size_default = 3;
# Enable users option
$ja_tool = 2; // 0: disable all; 1: Screen tool; 2: font tool; 3: screen + font; 4: color tool; 5: screen + color; 6: font + color; 7: all;
# Choose your prefer Menu Type
$ja_menutype = 3; // 1: Split Menu; 2: Son of Suckerfish Dropdown Menu; 3: Transmenu; 4: Script Dropline Menu;
# END: TEMPLATE CONFIGURATIONS ##########

# Define the template path ##########
$ja_template_path = $mosConfig_live_site.'/templates/'.$ja_template_name;
$ja_template_absolute_path = $mosConfig_absolute_path.'/templates/'.$ja_template_name;
include ($ja_template_absolute_path."/ja_templatetools.php");

$topnav = "";
$subnav = "";
if ($ja_menutype == 1) {
	require($ja_template_absolute_path."/ja_splitmenu.php");
	$topnav = ja_topNav('topmenu', array('default'));
	$subnav = ja_subNav('topmenu');
} else if ($ja_menutype == 4) {
	require($ja_template_absolute_path."/ja_scriptdlmenu.php");
	$topnav = $jamenu->menuObj->main;
	$subnav = $jamenu->menuObj->sub;
}

# Auto Collapse Divs Functions ##########
$ja_left = mosCountModules( 'left' );
$ja_right = mosCountModules( 'right' );

if ( $ja_left && $ja_right ) {
	$divid = '';
	} elseif ( $ja_left ) { 
	$divid = '-fr';
	} elseif ( $ja_right ) {
	$divid = '-fl';
	} else {
	$divid = '-f';
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml">

<head>
<?php mosShowHead(); ?>
<meta http-equiv="Content-Type" content="text/html; <?php echo _ISO; ?>" />
<meta http-equiv="Content-Style-Type" content="text/css" />
<meta name="verify-v1" content="PNP1A46UjbPQPrJVZE1M85LGpy/k33G4fkUb0LV6fRs=" />

<link href="<?php echo $ja_template_path;?>/css/template_css.css" rel="stylesheet" type="text/css" />
<link href="<?php echo $ja_template_path;?>/css/colors/<?php echo $ja_color; ?>.css" rel="stylesheet" type="text/css" />
<script defer type="text/javascript" src="pngfix.js"></script>
<? /*if ($_SERVER["HTTPS"] != 'on') { ?>
    <script src="http://www.google-analytics.com/urchin.js" type="text/javascript"></script>
    <script type="text/javascript">
        _uacct = "UA-2242386-1";
        urchinTracker();
    </script>
<? }*/ ?>
<script language="javascript" type="text/javascript" src="<?php echo $ja_template_path;?>/scripts/ja.script.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $ja_template_path;?>/scripts/opacity.js"></script>
<script language="javascript" type="text/javascript" src="<?php echo $ja_template_path;?>/scripts/reflection.js"></script>

<?php genMenuHead(); ?>

<?php if ( $my->id ) { initEditor(); } ?>

<!--[if lte IE 6]>
<style type="text/css">
.clearfix {	height: 1%;}
</style>
<![endif]-->

<!--[if gte IE 7.0]>
<style type="text/css">
.clearfix {	display: inline-block;}
</style>
<![endif]-->
</head>

<body id="bd" class="<?php echo "$ja_width fs".$ja_font_size;?>" <?php if ($option=='com_google_maps') { echo 'onload="initMap()" onunload="GUnload()"'; } ?> >
<a title="Pular Para o Conteúdo" href="<?php echo getCurrentURL();?>#Content" style="display: none;">Pular Para o Conteúdo</a>
<a name="Top" id="Top"></a>

<div id="ja-wrapper">
<div id="ja-wrapper-inner">

<!-- BEGIN: HEADER -->
<div id="ja-header" class="clearfix">
	<h1>
		<div id="logoflash" style="width: 300px; height:110px; text-align:center; vertical-align:middle;"></div>
		<script type="text/javascript" src="swfobject.js"></script>
		<script type="text/javascript">
			var logo = new SWFObject("images/nucleodoevento/logo.swf", "LOGO", "298", "106", "7", "#000000");
			logo.addParam("wmode", "transparent");
			logo.write("logoflash");
		</script>
	</h1>
	
	<?php if ($ja_tool) {?>
	<div id="ja-usertoolswrap">
		<div id="ja-usertools">
			<?php genToolMenu($ja_tool); ?>
		</div>
	</div>
	<?php } ?>

	<?php if (mosCountModules('user4')) {?>
	<div id="ja-search">
		<?php mosLoadModules ( 'user4', -1 ); ?>
	</div>
	<?php } ?>

</div>
<!-- END: HEADER -->

<!-- BEGIN: MAIN NAVIGATION -->
<div id="ja-mainnav" class="clearfix">
<?php
	switch ($ja_menutype) {
		case 1: echo $topnav;
		break;
		case 2:
			include($ja_template_absolute_path."/ja_cssmenu.php");
		break; 
		case 3:
			include($ja_template_absolute_path."/ja_transmenu.php");
		case 4: 
			echo $topnav;
		break;
	}
?>
</div>

<?php if ($subnav) { ?>
<div id="ja-subnav" class="clearfix">
	<?php echo $subnav; ?>&nbsp;
</div>
<?php } ?>
<!-- END: MAIN NAVIGATION -->

<div id="ja-containerwrap">
	<div id="ja-container<?php echo $divid ?>" class="clearfix">

		<!-- BEGIN: CONTENT -->
		<div id="ja-mainbody<?php echo $divid; ?>">
		
		<?php if( mosCountModules('header') ) {?>
		<div id="ja-sh" class="clearfix">
			<?php mosLoadModules('header', -1); ?>
		</div>
		<?php }
		if(($_SERVER["QUERY_STRING"] == "") || (ereg("com_frontpage", $_SERVER["QUERY_STRING"]))){ ?>
			<div id="monoSlideshow"></div>
			<script type="text/javascript">
				var so = new SWFObject("monoslideshow.swf", "SOmonoSlideshow", "760", "250", "7", "#000000");
				so.addVariable("showLogo", "false");
				so.addVariable("dataFile", "slideshow.xml.php");
				so.addParam("wmode", "transparent");
				so.write("monoSlideshow");
			</script>
		<? }
		$spotlight = array ('user1','user2','top');
		$topspl = calSpotlight ($spotlight);
		if( $topspl ) { ?>
		<!-- BEGIN: TOP SPOTLIGHT -->
		<div id="ja-topsl" class="clearfix">
		  <?php if( mosCountModules('user1') ) {?>
		  <div id="ja-topsl1" class="ja-box<?php echo $topspl['modules']['user1']; ?>" style="width: <?php echo $topspl['width']; ?>;">
		    <?php mosLoadModules('user1', -2); ?>
		  </div>
		  <?php } ?>
		  
		  <?php if( mosCountModules('user2') ) {?>
		  <div id="ja-topsl2" class="ja-box<?php echo $topspl['modules']['user2']; ?>" style="width: <?php echo $topspl['width']; ?>;">
		    <?php mosLoadModules('user2', -2); ?>
		  </div>
		  <?php } ?>
		  
		  <?php if( mosCountModules('top') ) {?>
		  <div id="ja-topsl3" class="ja-box<?php echo $topspl['modules']['top']; ?>" style="width: <?php echo $topspl['width']; ?>;">
		    <?php mosLoadModules('top', -2); ?>
		  </div>
		  <?php } ?>
		</div>
		<!-- END: TOP SPOTLIGHT -->
		<?php } ?>
		
		<div id="ja-pathway">
			<strong>Você está aqui:</strong> <?php mosPathway(); ?>
		</div>

		<a name="Content" id="Content"></a>
		<div id="ja-contentwrap">
	
			<div id="ja-content">

				<?php mosMainBody(); ?>
	
				<?php if ( mosCountModules('banner') ) { ?>
				<!-- BEGIN: BANNER -->
				<div id="ja-banner">
					<?php	echo mosLoadModules ( 'banner',-1 ); ?>
				</div>
				<!-- END: BANNER -->
				<?php } ?>

			</div>
		</div>
		
		<?php if ($ja_left) { ?>
		<!-- BEGIN: LEFT COLUMN -->
		<div id="ja-leftcol">
			<div id="ja-leftcol-inner">
				<?php	echo mosLoadModules ( 'left',-3 ); ?>
				<? /*
				<!-- BEGIN PHP Live! code, (c) OSI Codes Inc. -->
				<!--<script language="JavaScript" src="http://www.nucleodoevento.com.br/suporte/js/status_image.php?base_url=http://www.nucleodoevento.com.br/suporte&l=nucleodoevento&x=1&deptid=1&btn=1"><a href=""></a></script>-->
				<!-- END PHP Live! code : (c) OSI Codes Inc. --> */
				?>
			</div>
		</div>
		<!-- END: LEFT COLUMN -->
		<?php } ?>
		
		<?php 	
		$spotlight = array ('user7','user8','user9');
		$botsl = calSpotlight ($spotlight);
		if( $botsl ) { 
		?>
		<!-- BEGIN: BOTTOM SPOTLIGHT -->
		<div id="ja-botsl" class="clearfix">

		  <?php if( mosCountModules('user7') ) {?>
		  <div class="ja-box<?php echo $botsl['modules']['user7']; ?>" style="width: <?php echo $botsl['width']; ?>;">
		    <?php mosLoadModules('user7', -2); ?>
		  </div>
		  <?php } ?>
		  
		  <?php if( mosCountModules('user8') ) {?>
		  <div class="ja-box<?php echo $botsl['modules']['user8']; ?>" style="width: <?php echo $botsl['width']; ?>;">
		    <?php mosLoadModules('user8', -2); ?>
		  </div>
		  <?php } ?>
		  
		  <?php if( mosCountModules('user9') ) {?>
		  <div class="ja-box<?php echo $botsl['modules']['user9']; ?>" style="width: <?php echo $botsl['width']; ?>;">
		    <?php mosLoadModules('user9', -2); ?>
		  </div>
		  <?php } ?>

		</div>
		<!-- END: BOTTOM SPOTLIGHT -->
		<?php } ?>

		</div>
		<!-- END: CONTENT -->
		
		<?php if ($ja_right) { ?>
		<!-- BEGIN: RIGHT COLUMN -->
		<div id="ja-rightcol">
			<div id="ja-rightcol-inner">
				<?php	echo
					mosLoadModules ( 'right',-3 );
				?>
			</div>
		</div><br />
		<!-- END: RIGHT COLUMN -->
		<?php } ?>
	
	</div>
</div>

<!-- BEGIN: FOOTER -->
<div id="ja-footer">

	<?php if ( mosCountModules('user3') ) { ?>
  <div id="ja-footnav" class="clearfix">
		<?php mosLoadModules ( 'user3', -1 ); ?>
	</div>
	<?php } ?>

  <p id="ja-bottomline">
		<?php include_once( $ja_template_absolute_path.'/footer.php' ); ?>
	</p>
	
	<div id="ja-cert">
	 <a href="<?php echo $mosConfig_live_site ?>/index.php?option=com_rss&amp;feed=RSS2.0&amp;no_html=1" target="_blank" title="RSS 2.0" style="text-decoration: none;">
		<img src="<?php echo $ja_template_path;?>/images/but-rss.gif" alt="RSS 2.0" />
	 </a>
		<?php //if ($ja_menutype != 3 ) { ?>
		<a href="http://jigsaw.w3.org/css-validator/validator?uri=<?php echo $mosConfig_live_site;?>" target="_blank" title="Nosso site usa CSS Válido" style="text-decoration: none;">
			<img src="<?php echo $ja_template_path;?>/images/but-css.gif" alt="Nosso site usa CSS Válido" />
		</a>
		<?php //} ?>
		<a href="http://validator.w3.org/check/referer" target="_blank" title="Nosso site é construido com XHTML 1.0 Transitional" style="text-decoration: none;">
			<img src="<?php echo $ja_template_path;?>/images/but-xhtml10.gif" alt="Nosso site é construido com XHTML 1.0 Transitional" />
		</a>
		<a href="<?php echo getCurrentURL();?>#Top" title="Topo da página" style="text-decoration: none;">
			<img src="<?php echo $ja_template_path;?>/images/but-top.gif" alt="Topo da página" />
		</a>
	</div>

</div>
<!-- END: FOOTER -->

</div>
</div>

<?php mosLoadModules( 'debug', -1 );?>
</body>

</html>
