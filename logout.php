<?php
session_start();
session_destroy();
unset($_SESSION);

session_start();
$_SESSION["status"] = "You have been logged out.";

header("Location: index.php");
?>
