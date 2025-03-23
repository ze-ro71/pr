<?php
include '../includes/connect.php';

$phone = $_POST['phone'];

$sql = "SELECT * FROM users WHERE contact = '$phone'";
$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo 'false';
} else {
    echo 'true';
}
?>