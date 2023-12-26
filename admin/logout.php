<?php
include_once "utils/smarter.php";

session_name("admin_session");
session_start();
$_SESSION['logged'] = false;
Smarter\redirect('/');
?>