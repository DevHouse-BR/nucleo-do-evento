<?php
/*********************************************
* VisualRecommend - Component                *
* Copyright (C) 2007 by Bernard Gilly        *
* --------- All Rights Reserved ------------ *      
* Homepage   : www.visualclinic.fr           *
* Version    : 1.1.0                         *
* License    : Creative Commons              *
*********************************************/

// ensure this file is being included by a parent file
defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );

// Get the right language if it exists
if (file_exists($mosConfig_absolute_path."/administrator/components/com_visualrecommend/languages/".$mosConfig_lang.".php")){
     include_once($mosConfig_absolute_path."/administrator/components/com_visualrecommend/languages/".$mosConfig_lang.".php");
     }else{
     include_once($mosConfig_absolute_path."/administrator/components/com_visualrecommend/languages/english.php");
     }

class HTML_VRC_FRONTEND {

	function displayForm( $title, $template='', $option, $id, $itemid, $com, $displayGoogleAdense ){
	global $mainframe, $mosConfig_live_site, $mosConfig_absolute_path, $my;
	
	require( $mosConfig_absolute_path.'/administrator/components/com_visualrecommend/visualrecommend_config.php' );		
	
	if ( ($my->id>'0' && $vr_registered=='1') || $vr_registered=='0' ){	
		$vr_maxsending2 = $vr_maxsending - 1 ;	
		@session_start('visualrecommendmail');	
		$link_reduce = sefRelToAbs("index.php?option=com_visualrecommend&task=showform&com=".$com."&id=".$id."&Itemid=".$itemid);
		
		if ( $vr_displayFormMode ) {			
			$mainframe->addCustomHeadTag( '<link rel="stylesheet" href="' . $mosConfig_live_site . '/templates/'. $template .'/css/template_css.css" type="text/css" />' );
			$mainframe->setPageTitle( stripslashes( $title ) );
			$link_reduce = sefRelToAbs("index2.php?option=com_visualrecommend&task=showform&com=".$com."&id=".$id."&Itemid=".$itemid);
		}
		?>
		<script language="JavaScript" type="text/JavaScript">
		function create_field(i) {
			var i2 = i + 1;
			var rest = (<?php echo $vr_maxsending; ?> - 1)- i;
			document.getElementById('numfield_'+i).innerHTML = '<table width="100%"  border="0" cellspacing="0" cellpadding="0"><tr><td><div align="left"><input name="namefriend[]" type="text" size="25" class="inputbox"></div></td><td><div align="right"><input name="emailfriend[]" type="text" size="25" class="inputbox"></div></td></tr></table>';
			if( rest>0 ){
				document.getElementById('numfield_'+i).innerHTML += (i <= <?php echo $vr_maxsending2; ?>) ? '<br /><span id="numfield_'+i2+'"><a href="javascript:create_field('+i2+')"><?php echo _VRECOMMEND_ADDEMAIL; ?></a> ('+rest+')<input type="hidden" id="numfieldemail" name="numfieldemail" value="'+i+'"></span>' : '';
			}else{
				document.getElementById('numfield_'+i).innerHTML += (i <= <?php echo $vr_maxsending2; ?>) ? '<br /><span id="numfield_'+i2+'"><a href="<?php echo $link_reduce; ?>"><?php echo _VRECOMMEND_TO_REDUCE; ?></a><input type="hidden" id="numfieldemail" name="numfieldemail" value="'+i+'"></span>' : '';
			}
		}
		
		function MM_findObj(n, d) { //v4.01
		  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
			d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
		  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
		  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
		  if(!x && d.getElementById) x=d.getElementById(n); return x;
		}
		
		function MM_validateForm() { //v4.0
		  var i,p,q,nm,test,num,min,max,errors='',args=MM_validateForm.arguments;
		  for (i=0; i<(args.length-2); i+=3) { test=args[i+2]; val=MM_findObj(args[i]);
			if (val) { nm=val.name; if ((val=val.value)!="") {
			  if (test.indexOf('isEmail')!=-1) { p=val.indexOf('@');
				if (p<1 || p==(val.length-1)) errors+='- '+nm+' must contain an e-mail address.\n';
			  } else if (test!='R') { num = parseFloat(val);
				if (isNaN(val)) errors+='- '+nm+' must contain a number.\n';
				if (test.indexOf('inRange') != -1) { p=test.indexOf(':');
				  min=test.substring(8,p); max=test.substring(p+1);
				  if (num<min || max<num) errors+='- '+nm+' must contain a number between '+min+' and '+max+'.\n';
			} } } else if (test.charAt(0) == 'R') errors += '- '+nm+' is required.\n'; }
		  } if (errors) alert('The following error(s) occurred:\n'+errors);
		  document.MM_returnValue = (errors == '');
		}
		</script>
		<?php if ( $displayGoogleAdense && $vr_ads_position!='1' ) echo $displayGoogleAdense . "<br />" ; ?>		
		<div style="clear:both;">
		<form action="" method="post" name="visualrecommendform" onSubmit="MM_validateForm('emailsender','','RisEmail');return document.MM_returnValue">
		  <img src="http://www.nucleodoevento.com.br/images/icones/email.png"/>
		  <table width="100%" border="0" align="left" cellpadding="0" cellspacing="0" style="font-family:Arial, Helvetica, sans-serif; font-size:11px;">
            <tr>
              <td colspan="2" class="contentheading" style="font-size:12px;"><?php echo _VRECOMMEND_RECOMMEND_FORM; ?></td>
            </tr>
            <tr>
              <td colspan="2" class="contentdescription"><?php echo stripslashes( $title ); ?></td>
            </tr>
            <tr>
              <td><?php echo _VRECOMMEND_YOURFRIENDNAME; ?></td>
              <td><div align="right"><?php echo _VRECOMMEND_YOURFRIENDEMAILADRESS; ?></div></td>
            </tr>			
            <tr><td><div align="left"><input name="namefriend[]" type="text" size="25" class="inputbox">
            </div></td><td><div align="right"><input name="emailfriend[]" type="text" size="25" class="inputbox">
            </div></td></tr>
			<?php if ( $vr_maxsending > 1 ) { ?>			
            <tr>
              <td colspan="2">
			  <span id="numfield_1"><a href="javascript:create_field(1)"><?php echo _VRECOMMEND_ADDEMAIL; ?></a> (<?php echo $vr_maxsending-1; ?>)<input type="hidden" id="numfieldemail" name="numfieldemail" value="0"></span>
			  </td>
            </tr>			
			<?php } ?>
            <tr>
              <td valign="bottom"><?php echo _VRECOMMEND_YOURNAME; ?></td>
              <td valign="bottom"><div align="right"><?php echo _VRECOMMEND_YOUREMAILADDRESS; ?></div></td>
            </tr>
            <tr>
              <td><div align="left">
			  <?php 
			  if ( $my->id ){ 
				echo "<input type='hidden' name='namesender' value='".$my->name."'>";
				echo "<strong>" . $my->name . "</strong>";
			  }else{
			  ?>
              <input name="namesender" type="text" size="25" value="<?php
			  if(isset($_SESSION['namesender'])) {
			  	echo $_SESSION['namesender'];
			  }
			  ?>" class="inputbox">
			  <?php } ?>
              </div></td>
              <td><div align="right">
              <input name="emailsender" type="text" size="25" value="<?php
			  if(isset($_SESSION['emailsender'])) {
			  	echo $_SESSION['emailsender'];
			  }
			  ?>" class="inputbox">
              </div></td>
            </tr>
			<?php if ( $vr_custom_msg ){ ?>
            <tr>
              <td colspan="2"><?php echo _VRECOMMEND_MESSAGEADDEDATYOURRECOMMEND; ?></td>
            </tr>			
            <tr>			
              <td colspan="2"><textarea name="message" rows="8" class="inputbox" style="width:100%;"><?php if(isset($_SESSION['message'])) {echo $_SESSION['message'];} ?></textarea></td>
            </tr>
			<?php 
				}	
			?>			
            <tr>
			  <td colspan="2">
			<?php 
			// Check if CB component exist
			$pathFileCB = "components/com_comprofiler/comprofiler.php";		
			if ( file_exists( $pathFileCB ) ) {
				$checkCBcomponent = 1;	
			} else $checkCBcomponent = 0;	
			if( $vr_link2CB && $checkCBcomponent && $my->id>0){
			?>
              <input type="checkbox" name="addlink2profile" value="1"> <?php echo _VRECOMMEND_ADD_LINK_PROFILE; ?>
			<?php  } else { ?>
			  <input type="hidden" name="addlink2profile" value="0">
			<?php  } ?>
			  </td>
            </tr>			
            <tr>
              <td colspan="2"><input type="submit" name="Submit" value="<?php echo _VRECOMMEND_SUBMIT; ?>" class="button"></td>
            </tr>
          </table>
		<input type="hidden" name="option" value="<?php echo $option; ?>" />
		<input type="hidden" name="task" value="send" />
		<input type="hidden" name="cid" value="<?php echo $id; ?>" />
		<input type="hidden" name="itemid" value="<?php echo $itemid; ?>" />
		<input type="hidden" name="com" value="<?php echo $com; ?>" />
		</form>
		<div style="text-align:right;font-family:Arial, Helvetica, sans-serif; font-size:11px;">
		<?php
			if ( $vr_displayFormMode ) echo "<br /><a href=\"javascript:window.close();\">" . _VRECOMMEND_CLOSE . "</a>";
			echo "</div>";	
			if ( $displayGoogleAdense && $vr_ads_position>=1 ) echo "<br />" . $displayGoogleAdense;		
		}else{
			echo _VRECOMMEND_ONLYREGISTERED;
		}
		echo('</div>');
	}		
}
?>