<?php
require_once("./connection.php");
if(isset($_POST['submit'])){
    if(empty($_POST['notice-content']) || empty($_POST['status'])) {
        header("location:../add_notice.php");
    }
    else{
        $noticeInfo = $_POST['notice-content'];
        $noticeStatus = $_POST['status'];

        $query = "INSERT INTO `notice`(`status`,`notice-date`,`notice-data`) VALUES ('$noticeStatus',NOW(),'$noticeInfo')";
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
    setTimeout(function() {
        document.body.style.overflow = 'auto'; 
        document.querySelector('.loading-container').style.display = 'none';
    }, 2000);
</script>
</body>
</html>


<?php
            echo "<script>setTimeout(\"location.href = '../add_notice.php'; \",2000); </script>";
        }
        else{
            header("location:../add_notice.php");
        }
    }
}
?>