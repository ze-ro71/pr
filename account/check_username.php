<?php
include '../includes/connect.php';

$username = $_POST['username'];

$sql = "SELECT * FROM users WHERE username = '$username'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo 'false';
} else {
    echo 'true';
}
?>