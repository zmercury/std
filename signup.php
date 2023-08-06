<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="./assets/images/planet.png">
    <link rel="stylesheet" href="./assets/css/main.css">
    <script src="./assets/scripts/main.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
    <title>Home - SMS</title>
</head>
<body>
    <nav class="navContainer">
        <div class="leftNav flexLeft">
            <img src="./assets/images/planet.png" alt="logo" style="width: 50px; margin-right: 15px;">
            <h2>SIS</h2>
        </div>
        <div class="rightNav flexCenter">
            <a href="./index.php">Home</a>
            <a href="./faq.php">FAQ's</a>
        </div>
    </nav>
    <main class="mainContainer">
        <div class="innerMainContainer">
            <div class="innerLeft">
                <div class="leftInnerContainer">
                    <h1 style="padding-bottom: .3em;">Sign Up to your account</h1>
                    <p style="padding-bottom: 1.8em;">Please enter your details to create an account</p>
                    <hr width="100%" size="1" class="hr-lines">
                    <form class="form-signup" action="./components/signup_process.php" method="POST">
                        <label for="role">Role</label><br>
                        <select name="role" id="role">
                            <option value="">Choose your role</option>
                            <option value="student">Student</option>
                            <option value="teacher">Teacher</option>
                            <option value="admin">Admin</option>
                        </select><br>
                        <label for="username">Username</label><br>
                        <input type="text" name="username" placeholder="Username" id="username"></input><br>
                        <label for="email">Email</label><br>
                        <input type="email" name="email" placeholder="company@name.com" id="email"></input><br>
                        <label for="username">Password</label><br>
                        <input type="password" name="password" placeholder="Password" id="password"></input><br><br>
                        <button type="submit" name="submit">Sign Up</button>
                    </form>
                    <span>Already have an account?<a href="./index.php"> Login now</a></span>
                </div>
            </div>
            <div class="innerRight">
                <div class="innerMainContainer">
                    <div class="leftInnerContainer">
                        <!-- <img src="./assets/images/login.jpg" alt="" style="border-radius: 7px; height: 100%;"> -->
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>