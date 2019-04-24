<?php
session_start();
session_destroy();
header("Location: login.php");
?>
<p>"You are logged out!"</p>
