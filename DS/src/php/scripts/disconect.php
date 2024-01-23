<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
session_start();
unset($_SESSION['user_id']);
echo '<meta http-equiv="refresh" content="0;URL=../../../../index.php">';
?>