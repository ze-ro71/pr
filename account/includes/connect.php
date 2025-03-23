<?php
session_start();
$servername = "127.0.0.1";
$server_user = "root";
$server_pass = "";
$dbname = "food";
$name = isset($_POST['name']) ? $_POST['name'] : null;
$role = isset($_POST['role']) ? $_POST['role'] : null;
$con = new mysqli($servername, $server_user, $server_pass, $dbname);
?>