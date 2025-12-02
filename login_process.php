<?php
session_start();

$username = "admin";
$hashed_password = password_hash("password", PASSWORD_DEFAULT);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $input_username = $_POST['username'];
    $input_password = $_POST['password'];

    if ($input_username == $username && password_verify($input_password, $hashed_password)) {
        $_SESSION['loggedin'] = true;
        header("location: view.php");
        exit;
    } else {
        $_SESSION['login_error'] = "Invalid username or password";
        header("location: admin_login.php");
        exit;
    }
}
?>
