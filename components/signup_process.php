<?php
require_once("./connection.php");
if(isset($_POST['submit'])){
    if(empty($_POST['role']) || empty($_POST['username']) || empty($_POST['password'])){
        header("location:../index.php");
    }
    else{
        $role = $_POST['role'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $email = $_POST['email'];

        $query = "INSERT INTO `users`(`role`,`uname`, `upass`,`email`) VALUES ('$role','$username','$password','$email'); ";
        $result = mysqli_query($conn,$query);
        if($result){
            echo "<h1>A new user created successfully.</h1>";
            echo "<script>setTimeout(\"location.href = '../index.php'; \",500); </script>";
        }
        else{
            header("location:../index.php");
        }
    }
}
?>