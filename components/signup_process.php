<?php
require_once("./connection.php");
if(isset($_POST['submit'])){
    if(empty($_POST['role']) || empty($_POST['username']) || empty($_POST['password']) || empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email'])) {
        header("location:../index.php");
    }
    else{
        $role = $_POST['role'];
        $firstname = $_POST['firstname'];
        $lastname = $_POST['lastname'];
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $query = "INSERT INTO `users`(`role`,`fname`,`lname`,`uname`,`email`,`upass`) VALUES ('$role','$firstname','$lastname','$username','$email','$password'); ";
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