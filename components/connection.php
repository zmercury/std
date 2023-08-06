<?php
    $conn = mysqli_connect("localhost","root","","sms");
    if(!$conn){
        die("Cannnot connect database ".mysqli_connect_errno($conn));
    }
?>