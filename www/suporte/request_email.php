<?
	include_once("./web/conf-init.php") ;
	include_once("./system.php") ;
?>
<html>
<head>
<title>  </title>

<!-- BEGIN PHP Live! Code, copyright 2001 OSI Codes -->
<script language="JavaScript">
<!--
// the reason for using date is to set a unique value so the status
// image is NOT CACHED (Netscape problem).  keep this or bad things could happen
var date = new Date() ;
var unique = date.getTime() ;
var request_url = "<? echo $BASE_URL ?>/request.php?l=<? echo $HTTP_GET_VARS['l'] ?>&x=<? echo $HTTP_GET_VARS['x'] ?>&deptid=<?= isset( $HTTP_GET_VARS['deptid'] ) ? $HTTP_GET_VARS['deptid'] : 0 ?>&page=Email+Signature" ;

function launch_support()
{
	top.resizeTo( 480, 530 ) ;
	location.href = request_url ;
}
//-->
</script>
<!-- END PHP Live! Code, copyright 2001 OSI Codes -->
</head>
<body bgColor="#FFFFFF" OnLoad="launch_support()">

</body>
</html>