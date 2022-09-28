<?php
session_start();
$_SESSION["logout_time"] = date('d-m-y h:i:s');
// remove all session variables
session_unset();

// destroy the session
session_destroy();

header("Location: page_logout.php");