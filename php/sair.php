<?php
	session_start();
	session_unset();
	session_destroy();
	echo '<div style="margin-top:5%;text-align:center;"><h1>Redirecionando para Login.</h1><meta HTTP-EQUIV="Refresh" CONTENT="3; URL=../">
	<img src="../css/gif/loading.gif" class="img-responsive" >	</div>;'; 
?>