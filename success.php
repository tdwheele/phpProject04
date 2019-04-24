<?php
session_start();
if(!$_SESSION){
    header("Location: login.php");
}
?>
<p>You are logged in!</p>
<a href='login.php'>Back</a>
