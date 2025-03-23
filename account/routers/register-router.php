<?php
include '../includes/connect.php';

if (isset($_POST['username']) && isset($_POST['name']) && isset($_POST['password']) && isset($_POST['phone'])) {
    // Handle the form data
    $username = htmlspecialchars($_POST['username']);
    $name = htmlspecialchars($_POST['name']);
    $password = htmlspecialchars($_POST['password']);
    $phone = $_POST['phone'];

    // Check if the username already exists
    $sql = "SELECT * FROM users WHERE username = '$username'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo '<script>alert("Username already exists!"); window.location.href = "../register.php";</script>';
        exit;
    }

    // Check if the phone number already exists
    $sql = "SELECT * FROM users WHERE contact = '$phone'";
    $result = $con->query($sql);
    if ($result->num_rows > 0) {
        echo '<script>alert("Phone number already exists!"); window.location.href = "../register.php";</script>';
        exit;
    }

    // Hash the password
    

    // Insert the user into the database
    $sql = "INSERT INTO users (name, username, password, contact) VALUES ('$name', '$username', '$password', $phone)";
    if ($con->query($sql) == true) {
        $user_id = $con->insert_id;
        $sql = "INSERT INTO wallet (customer_id) VALUES ($user_id)";
        if ($con->query($sql) == true) {
            $wallet_id = $con->insert_id;
            $cc_number = number(16);
            $cvv_number = number(3);
            $sql = "INSERT INTO wallet_details (wallet_id, number, cvv) VALUES ($wallet_id, $cc_number, $cvv_number)";
            $con->query($sql);
        }
        header("location:../login.php?success=registered");
        exit;
    } else {
        echo '<script>alert("Registration failed!"); window.location.href = "../register.php";</script>';
        exit;
    }
} else {
    header("location:../register.php");
    exit;
}

function number($length) {
    $result = '';

    for ($i = 0; $i < $length; $i++) {
        $result .= mt_rand(0, 9);
    }

    return $result;
}
?>