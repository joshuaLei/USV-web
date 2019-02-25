<!DOCTYPE html>
<html>
<body>
<?php
	$_usv = $_GET["usv"];
	$_route = $_GET["route"];
	$_mode = $_GET["mode"];
	
	if ($_mode == "manual"){
		require_once("manual.php");
		usv($_usv, $_route);
	}else if($_mode == "auto"){
		require_once("auto.php");
		usv($_usv, $_route);
	}
?>
</body>
</html>

