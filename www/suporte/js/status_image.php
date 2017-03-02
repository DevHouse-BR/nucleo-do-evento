<!--
// copyright OSI Codes, PHP Live! Support
// http://www.osicodes.com
function dounique() { var date = new Date() ; return date.getTime() ; }
var tracker_refresh = 10000 ; // 1000 = 1 second
var do_tracker_flag_<? echo $HTTP_GET_VARS['btn'] ?> = 1 ;
var start_tracker = dounique() ;
var time_elapsed ;
var refer = escape( document.referrer ) ;
var phplive_base_url = '<? echo $HTTP_GET_VARS['base_url'] ?>' ;
var initiate = chat_opened = 0 ;
var pullimage_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?> = new Image ;
var date = new Date() ;
var unique = dounique() ;
var url = escape( location.toString() ) ;
var phplive_image_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?> = "<? echo $HTTP_GET_VARS['base_url'] ?>/image.php?l=<? echo $HTTP_GET_VARS['l'] ?>&x=<? echo $HTTP_GET_VARS['x'] ?>&deptid=<? echo $HTTP_GET_VARS['deptid'] ?>&page="+url+"&unique="+unique+"&refer="+refer+"&text=<?= ( isset( $HTTP_GET_VARS['text'] ) ) ? $HTTP_GET_VARS['text'] : "" ?>" ;


var scriptpad = "" ;
var ns=(document.layers);
var ie=(document.all);
var w3=(document.getElementById && !ie);

/********************************************/
/***** proactive image settings: begin ******/
var ProactiveDiv ;
var browser_width ;
var backtrack = 0 ;
var isclosed = 0 ;
var repeat = 1 ;
var timer = 20 ;
var halt = 0 ;

// write external style here.. it won't work if we put it directly in the DIV
style = "<style type=\"text/css\">" ;
style += "<!--" ;
style += "#ProactiveSupport_<? echo $HTTP_GET_VARS['deptid'] ?>_<? echo $HTTP_GET_VARS['btn'] ?> {visibility:hidden; position:absolute; height:1; width:1; top:0; left:0;}" ;
style += "-->" ;
style += "</style>" ;
document.write( style ) ;
if (ie||w3)
	browser_width = document.body.offsetWidth ;
else
	browser_width = window.outerWidth ;

function toggleMotion( flag )
{
	if ( flag )
		halt = 1 ;
	else
		halt = 0 ;
}

function initializeProactive(){

	if(!ns && !ie && !w3) return ;
	if(ie)		ProactiveDiv = eval('document.all.ProactiveSupport_<? echo $HTTP_GET_VARS['deptid'] ?>_<? echo $HTTP_GET_VARS['btn'] ?>.style') ;
	else if(ns)	ProactiveDiv = eval('document.layers["ProactiveSupport_<? echo $HTTP_GET_VARS['deptid'] ?>_<? echo $HTTP_GET_VARS['btn'] ?>"]') ;
	else if(w3)	ProactiveDiv = eval('document.getElementById("ProactiveSupport_<? echo $HTTP_GET_VARS['deptid'] ?>_<? echo $HTTP_GET_VARS['btn'] ?>").style') ;

	if (ie||w3)
		ProactiveDiv.visibility = "visible" ;
	else
		ProactiveDiv.visibility = "show" ;

	backtrack = 0 ;
	isclosed = 0 ;
	repeat = 1 ;
	moveIt(20) ;
}

function moveIt( h )
{
	if (ie)
	{
		documentHeight = document.body.offsetHeight/2+document.body.scrollTop-20 ;
		documentWidth = document.body.offsetWidth ;
	}
	else if (ns)
	{
		documentHeight = window.innerHeight/2+window.pageYOffset-20 ;
		documentWidth = window.innerWidth ;
	}
	else if (w3)
	{
		documentHeight = self.innerHeight/2+window.pageYOffset-20 ;
		documentWidth = self.innerWidth ;
	}
	ProactiveDiv.top = documentHeight-100 ;
	ProactiveDiv.left = documentWidth/2 ; // mod

	// took out scrolling as of v2.7
	//ProactiveDiv.left = h ;
	//if ( h > ( browser_width - 350 ) )
	//	backtrack = 1 ;
	//if ( backtrack && repeat && !halt )
	//	h -= 2 ;
	//else if ( !backtrack && repeat && !halt )
	//	h += 2 ;

	if ( halt )
	{
		setTimeout("moveIt("+h+")",timer) ;
	}
	else if ( ( !backtrack || ( backtrack && ( h >= 20 ) ) ) && ( ( ProactiveDiv.visibility == "visible" ) || ( ProactiveDiv.visibility == "show" ) ) && repeat && !isclosed )
		setTimeout("moveIt("+h+")",timer) ;
	else if ( !isclosed )
	{
		backtrack = 0 ;
		repeat = 0 ;
		setTimeout("moveIt("+h+")",timer) ;
	}
	else
	{
		// incase it is closed during when it's off the page, set the position
		// back to the page so the horizontal scrollbars disappear (IE only)
		ProactiveDiv.left = h ;
	}
}

function DoClose(){
	if (ie||w3)
		ProactiveDiv.visibility = "hidden" ;
	else
		ProactiveDiv.visibility = "hide" ;
	isclosed = 1 ;
	halt = 0 ;
}

/********************************************/
/********************************************/


function checkinitiate_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>()
{
	initiate = pullimage_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>.width ;
	if ( ( initiate == 2 ) && !chat_opened )
	{
		chat_opened = 1 ;
		launch_support_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>() ;
	}
	else if ( ( initiate == 3 ) && !chat_opened )
	{
		chat_opened = 1 ;
		initializeProactive() ;
	}

	if ( ( initiate == 1 ) && chat_opened )
		chat_opened = 0 ;
}
function do_tracker_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>()
{
	// check to make sure they are not idle for more then 1 hour... if so, then
	// they left window open and let's stop the tracker to save server load time.
	// (1000 = 1 second)
	var unique = dounique() ;
	time_elapsed = unique - start_tracker ;
	if ( time_elapsed > 3600000 )
		do_tracker_flag_<? echo $HTTP_GET_VARS['btn'] ?> = 0 ;

	pullimage_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?> = new Image ;
	pullimage_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>.src = "<? echo $HTTP_GET_VARS['base_url'] ?>/image_tracker.php?l=<? echo $HTTP_GET_VARS['l'] ?>&x=<? echo $HTTP_GET_VARS['x'] ?>&page="+url+"&unique="+unique ;

	pullimage_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>.onload = checkinitiate_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?> ;
	if ( do_tracker_flag_<? echo $HTTP_GET_VARS['btn'] ?> == 1 )
		setTimeout("do_tracker_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>()",tracker_refresh) ;
}
function launch_support_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>()
{
	var request_url_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?> = "<? echo $HTTP_GET_VARS['base_url'] ?>/request.php?l=<? echo $HTTP_GET_VARS['l'] ?>&x=<? echo $HTTP_GET_VARS['x'] ?>&deptid=<? echo $HTTP_GET_VARS['deptid'] ?>&page="+url ;
	newwin = window.open( request_url_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>, unique, 'scrollbars=no,menubar=no,resizable=0,location=no,screenX=50,screenY=100,width=450,height=350' ) ;
	newwin.focus() ;
	DoClose() ;
}

function WriteChatDiv()
{
	var scroll_image = new Image ;
	scroll_image.src = "<? echo $HTTP_GET_VARS['base_url'] ?>/scroll_image.php?x=<? echo $HTTP_GET_VARS['x'] ?>&l=<? echo $HTTP_GET_VARS['l'] ?>&"+unique ;

	output = "<div id=\"ProactiveSupport_<? echo $HTTP_GET_VARS['deptid'] ?>_<? echo $HTTP_GET_VARS['btn'] ?>\">" ;
	output += "<table cellspacing=0 cellpadding=0 border=0>" ;
	output += "<tr><td align=right><table cellspacing=0 cellpadding=0 border=0><tr><td bgColor=#E1E1E1><a href='JavaScript:RejectInitiate();' OnMouseOver=\"toggleMotion(1)\" OnMouseOut=\"toggleMotion(0)\"><font color=#828282 size=1 face=arial>&nbsp;close window</font>&nbsp;<img src=\"<? echo $HTTP_GET_VARS['base_url'] ?>/images/initiate_close.gif\" width=10 height=10 border=0></a></td></tr></table></td></tr>" ;
	output += "<tr><td align=center>" ;
	output += "<a href=\"JavaScript:launch_support_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>()\" OnMouseOver=\"toggleMotion(1)\" OnMouseOut=\"toggleMotion(0)\"><img src=\""+scroll_image.src+"\" border=0></a>" ;
	output += "</td></tr></table>" ;
	output += "</div>" ;
	document.writeln( output ) ;

	if(ie)		ProactiveDiv = eval('document.all.ProactiveSupport_<? echo $HTTP_GET_VARS['deptid'] ?>_<? echo $HTTP_GET_VARS['btn'] ?>.style') ;
	else if(ns)	ProactiveDiv = eval('document.layers["ProactiveSupport_<? echo $HTTP_GET_VARS['deptid'] ?>_<? echo $HTTP_GET_VARS['btn'] ?>"]') ;
	else if(w3)	ProactiveDiv = eval('document.getElementById("ProactiveSupport_<? echo $HTTP_GET_VARS['deptid'] ?>_<? echo $HTTP_GET_VARS['btn'] ?>").style') ;

	if (ie||w3)
		ProactiveDiv.visibility = "hidden" ;
	else
		ProactiveDiv.visibility = "hide" ;
}

function RejectInitiate()
{
	var rejectimage_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?> = new Image ;
	rejectimage_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>.src = "<? echo $HTTP_GET_VARS['base_url'] ?>/image_tracker.php?l=<? echo $HTTP_GET_VARS['l'] ?>&x=<? echo $HTTP_GET_VARS['x'] ?>&unique="+unique+"&action=reject" ;
	DoClose() ;
	chat_opened = 0 ;
}

var status_image_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?> = "<a href='JavaScript:void(0)' onMouseOver='window.status=\"Click for Live Support\"; return true;' onMouseOut='window.status=\"\"; return true;' OnClick='launch_support_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>()'><?= ( isset( $HTTP_GET_VARS['text'] ) ) ? $HTTP_GET_VARS['text'] : "" ?><img src="+phplive_image_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>+" border=0 alt='Click for Live Support'></a>" ;
do_tracker_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?>() ;
document.write( status_image_<? echo $HTTP_GET_VARS['btn'] ?>_<? echo $HTTP_GET_VARS['deptid'] ?> ) ;

WriteChatDiv() ;
//-->