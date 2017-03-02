<?
	if ( isset( $LOGO ) && file_exists( "$DOCUMENT_ROOT/web/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."/$LOGO" ) && $LOGO )
		$logo = "$BASE_URL/web/".$HTTP_SESSION_VARS['session_admin'][$sid]['asp_login']."/$LOGO" ;
	else if ( file_exists( "$DOCUMENT_ROOT/web/$LOGO_ASP" ) && $LOGO_ASP )
		$logo = "$BASE_URL/web/$LOGO_ASP" ;
	else
		$logo = "$BASE_URL/images/logo.gif" ;
?>
<html>
<head>
<title>PHP Live! - Operator</title>
<? $css_path = "../" ; include( "../css/default.php" ) ; ?>
<script language="JavaScript" src="../js/global.js"></script>
<script language="JavaScript" type="text/JavaScript">
<!--
// when viewing transcripts, we need set this or Javascript error
var loaded = 1 ;
var section = <?php echo $section;?>;	// Section number

var nav_start = '<table width="427" border="0" cellspacing="0" cellpadding="3"><tr><td align="center" class="nav">';
var nav_end = '</td></tr></table>';

var nav = new Array();
nav[0] = 'Operator Administration Area';
nav[1] = 'Canned Responses';
nav[2] = 'Canned Commands';
nav[3] = 'Set Preferences and Change Your Password';
nav[4] = 'Proactive Intro Message';
nav[5] = 'Your Ave. Support Rating - <font color="#48648C" size=2><? echo $ave_rating_string ?></font>';

var button = new Array();
button[0] = '';
button[1] = 'comments';
button[2] = 'commands';
button[3] = 'prefs';
button[4] = 'initiate';
button[5] = '' ;

// Onload
function init(){
	rollOver(section);					// Setup navigation
	if(section>0) sE(gE('navBack'));	// Show back button
}

// Rollover and navigation change
// s = section number; n = button name
function rollOver(s){
	if(button[s] != '' ) MM_swapImage(button[s],'','../images/b_'+button[s]+'-over.gif',1);
	
	// Only show sub-navigation links in none NS4 browsers
	if(!l){
		e = gE('navigation');
		wH(e,nav[s]);
	}
}

// Rollout
function rollOut(s){
	if(!s) s=0;
	if(s>0 && s!=section) MM_swapImgRestore();
}


// Basic functions
d=document;l=d.layers;op=navigator.userAgent.indexOf('Opera')!=-1;var ie=d.all?1:0;var w3c=d.getElementById?1:0;
function gE(e,f){if(l){f=(f)?f:self;var V=f.document.layers;if(V[e])return V[e];for(var W=0;W<V.length;)t=gE(e,V[W++]);return t;}if(d.all)return d.all[e];return d.getElementById(e);} // Get element
function wH(e,h){if(l){Y=e.document;Y.open();Y.write(h);Y.close();}else if(e.innerHTML)e.innerHTML=h;}		// Write html
function sE(e){l?e.visibility='show':e.style.visibility='visible';}
function hE(e){l?e.visibility='hide':e.style.visibility='hidden';}

function MM_swapImgRestore() { //v3.0
  var i,x,a=document.MM_sr; for(i=0;a&&i<a.length&&(x=a[i])&&x.oSrc;i++) x.src=x.oSrc;
}

function MM_findObj(n, d) { //v4.01
  var p,i,x;  if(!d) d=document; if((p=n.indexOf("?"))>0&&parent.frames.length) {
    d=parent.frames[n.substring(p+1)].document; n=n.substring(0,p);}
  if(!(x=d[n])&&d.all) x=d.all[n]; for (i=0;!x&&i<d.forms.length;i++) x=d.forms[i][n];
  for(i=0;!x&&d.layers&&i<d.layers.length;i++) x=MM_findObj(n,d.layers[i].document);
  if(!x && d.getElementById) x=d.getElementById(n); return x;
}

function MM_swapImage() { //v3.0
  var i,j=0,x,a=MM_swapImage.arguments; document.MM_sr=new Array; for(i=0;i<(a.length-2);i+=3)
   if ((x=MM_findObj(a[i]))!=null){document.MM_sr[j++]=x; if(!x.oSrc) x.oSrc=x.src; x.src=a[i+2];}
}


//-->
</script>
</head>
<body onload="init();" leftmargin="0" topmargin="0" marginwidth="0" marginheight="0">
<!-- DO NOT REMOVE THE COPYRIGHT NOTICE OF "&nbsp; OSI Codes Inc." -->

<table width="100%" border="0" cellpadding="0" cellspacing="0" style="height:100%">
  <tr> 
	<td height="65" valign="top" class="bgHead">
		<table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
			<td width="102" height="65" rowspan="2" valign="bottom" class="bgCornerTop"><img src="../images/bg_corner_top.gif" width="102" height="65"></td>
			<td width="179" height="65" rowspan="2"><a href="index.php?sid=<? echo $sid ?>&deptid=<? echo $deptid ?>"><img src="<? echo $logo ?>" border="0"></a></td>
			<td align="right" valign="top">&nbsp;(If you are not <? echo $admin['name'] ?>, <a href="../index.php?action=logout&sid=<? echo $sid ?>">click 
			here</a>)<strong>&nbsp;&nbsp;|&nbsp;&nbsp;<a href="../index.php?action=logout&sid=<? echo $sid ?>">Logout</a>&nbsp;&nbsp;</strong></td>
		</tr>
		</table>
	  </td>
  </tr>
  <tr> 
	<td height="47" valign="top" class="bgMenuBack"><table width="100%" border="0" cellspacing="0" cellpadding="0">
		<tr> 
		  <td width="100%"><img src="../images/bg_corner_bot.gif" width="121" height="47"></td>
		  <td width="427" valign="top" class="bgNav"><table width="427" border="0" cellspacing="0" cellpadding="1">
			  <tr> 
				<td height="24" align="center" class="nav"> <div style="position:relative" id="navigation">&nbsp;</div></td>
			  </tr>
			</table></td>
		  <td width="10"><img src="../images/spacer.gif" width="10" height="1"></td>
		</tr>
	  </table></td>
  </tr>
  <tr> 
	<td valign="top" class="bg">

	<center>
	| <a href="index.php?sid=<? echo $sid ?>&deptid=<? echo $deptid ?>">Home</a> |
	<a href="canned.php?sid=<? echo $sid ?>&deptid=<? echo $deptid ?>&action=canned_responses">Canned Responses</a> |
	<a href="canned.php?sid=<? echo $sid ?>&deptid=<? echo $deptid ?>&action=canned_commands">Canned Commands</a> |
	<? if ( $INITIATE && file_exists( "$DOCUMENT_ROOT/admin/traffic/admin_puller.php" ) ): ?>
	<a href="canned.php?sid=<? echo $sid ?>&deptid=<? echo $deptid ?>&action=canned_initiate">Initiate Messages</a> |
	<? endif; ?>
	<a href="index.php?sid=<? echo $sid ?>&deptid=<? echo $deptid ?>&action=edit_password">Preferences</a> |
	<a href="index.php?sid=<? echo $sid ?>&deptid=<? echo $deptid ?>&action=spam">Spam Blocking</a> |
	</center>
	<br>

	<!-- **** Start of the page body area **** -->
	