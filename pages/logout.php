<?php
// Start the session
//The session_start() function must be the very first thing in your document. Before any HTML tags.
session_start();
unset($_SESSION['username']);
unset($_GET['referer']);

session_destroy();


header('location: index.php');
?>