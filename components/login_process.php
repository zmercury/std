<?php
session_start();
require_once("connection.php");

if(isset($_POST['submit'])){
    $_SESSION['last_login_timestamp'] = time();
    
    $username = mysqli_real_escape_string($conn, $_POST['user']);
    $password = mysqli_real_escape_string($conn, $_POST['pass']);
    $role = mysqli_real_escape_string($conn, $_POST['role']);
    
    if(empty($role) || empty($username) || empty($password)){
        header("Location: ../index.php");
        exit();
    } else {
        $query = "SELECT * FROM `users` WHERE `role` = '$role' AND `uname` = '$username' AND `upass` ='$password'";
        $result = mysqli_query($conn, $query);

        if(mysqli_num_rows($result) > 0){
            $_SESSION['login_user'] = $username;
            $_SESSION['role'] = $role;
            header("Location: ../dashboard.php");
            exit();
        } else {
            header("Location: ../index.php?Invalid=Invalid Credentials");
            exit();
        }
    }
}
?>
