<?php
session_start();
session_destroy();
foreach($_COOKIE as $k => $v)
	setcookie($k, "", time()-3600);
?>
<script type="text/javascript">
	location.assign("login.php");
</script>