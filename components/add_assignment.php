<?php
require_once("./connection.php");
session_start();

if(isset($_POST['submit'])){
    if(empty($_POST['questions']) || empty($_POST['deadline'])) {
        header("location:../assignment.php");
    }
    else{
        $question = $_POST['questions'];
        $username = $_POST['session_user'];
        $submissiondate = $_POST['deadline'];

        $query = "INSERT INTO `assignment`(`curtime`,`submissiondate`,`addedby`,`assignment`) VALUES (NOW(),'$submissiondate','$username','$question')";
        $result = mysqli_query($conn,$query);
        if($result){
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css"/>
<link rel="icon" type="image/x-icon" href="./assets/images/planet.png">
<title>Loading Page</title>
<style>
    body {
        margin: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 100vh;
        background-color: #18191a;
    }
    .loading-container {
        text-align: center;
    }
    .loading-text {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 10px;
    }
    .loading-spinner {
        border: 4px solid rgba(0, 0, 0, 0.1);
        border-top: 4px solid #ccc;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        animation: spin 1s linear infinite;
    }
    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
</head>
<body>
<div class="loading-container">
    <div class="loading-spinner"></div>
</div>

<script>
  // Simulate loading completion after 3 seconds (for demonstration purposes)
    setTimeout(function() {
        document.body.style.overflow = 'auto'; // Enable scrolling after loading
        document.querySelector('.loading-container').style.display = 'none';
    }, 2000);
</script>
</body>
</html>


<?php
            echo "<script>setTimeout(\"location.href = '../assignment.php'; \",2000); </script>";
        }
        else{
            header("location:../assignment.php");
        }
    }
}
?>
