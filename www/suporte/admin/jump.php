<html>
<head>
<title>jump</title>
<script language="JavaScript">
<!--
	// this file is here because php HEADER redirect still does not
	// read the new session that has been set.  so JavaScript redirect
	// will make it register next time
	function do_jump()
	{
		location.href = "index.php?<? echo $HTTP_SERVER_VARS['QUERY_STRING'] ?>&jump=1" ;
	}
//-->
</script>
</head>
<body OnLoad="do_jump()"></body>
</html>