<?php
include('session.php');

session_start();

// Unset all of the session variables.
session_unset();

// Destroy the session.
session_destroy();
?>
<html>
<head>
<title>Logged Out</title>
</head>
<body>
<h1>You are now logged out.</h1>
</body>
</html>
