<?php
session_start();
if (isset($_SESSION['login_user']) && isset($_SESSION['role'])) {
    if ((time() - $_SESSION['last_login_timestamp']) > 12000) {
        header("location:index.php");
    } else {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="./assets/css/scrollbar.css">
    <link rel="icon" type="image/x-icon" href="./assets/images/planet.png">
    <title>Edit Student - SMS</title>
    
</head>
<body>
    <nav class="sidebar close">
        <header>
            <div class="image-text">
                <span class="image">
                    <img src="./assets/images/planet.png" alt="">
                </span>

                <div class="text logo-text">
                    <span class="name"><?php echo ucwords($_SESSION['login_user']); ?></span>
                    <span class="profession"><?php echo ucwords($_SESSION['role']); ?></span>
                </div>
            </div>

            <i class='bx bx-chevron-right toggle'></i>
        </header>

        <div class="menu-bar">
            <div class="menu">

                <li class="search-box">
                    <i class='bx bx-search icon'></i>
                    <input type="text" placeholder="Search...">
                </li>

                <ul class="menu-links">
                    <li class="nav-link">
                        <a href="./dashboard.php">
                            <i class='bx bx-home icon' ></i>
                            <span class="text nav-text">Dashboard</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./student.php">
                            <i class='bx bx-user icon' ></i>
                            <span class="text nav-text">Students</span>
                        </a>
                    </li>
                    
                    <li class="nav-link selected">
                        <a href="./add_student.php">
                            <i class='bx bx-user-plus icon' ></i>
                            <span class="text nav-text">Add Students</span>
                        </a>
                    </li>
                    
                    <li class="nav-link">
                        <a href="./teacher.php">
                            <i class='bx bx-user icon'></i>
                            <span class="text nav-text">Teachers</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./add_teacher.php">
                            <i class='bx bx-user-plus icon' ></i>
                            <span class="text nav-text">Add Teachers</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./schedule.php">
                            <i class='bx bx-calendar icon' ></i>
                            <span class="text nav-text">Schedule</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./assignment.php">
                            <i class='bx bx-book-content icon' ></i>
                            <span class="text nav-text">Assignment</span>
                        </a>
                    </li>

                    <li class="nav-link">
                        <a href="./add_notice.php">
                            <i class='bx bx-notification icon'></i>
                            <span class="text nav-text">Notice</span>
                        </a>
                    </li>

                </ul>
            </div>

            <div class="bottom-content">
                <li class="">
                    <a href="./components/logout.php?Logout">
                        <i class='bx bx-log-out icon' ></i>
                        <span class="text nav-text">Logout</span>
                    </a>
                </li>

                <li class="mode">
                    <div class="sun-moon">
                        <i class='bx bx-moon icon moon'></i>
                        <i class='bx bx-sun icon sun'></i>
                    </div>
                    <span class="mode-text text">Dark mode</span>

                    <div class="toggle-switch">
                        <span class="switch"></span>
                    </div>
                </li>   
                
            </div>
        </div>
    </nav>

    <?php
        // edit_student.php
        require_once("./components/connection.php");

        if (isset($_GET['student_id'])) {
            $student_id = $_GET['student_id'];

            $query = "SELECT * FROM students WHERE uid=$student_id"; 
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) { 
                $student_data = mysqli_fetch_assoc($result);

                $symbolnumber = $student_data['symbolnum'];
                $firstname = $student_data['fname'];
                $lastname = $student_data['lname'];
                $email = $student_data['email'];
                $dob = $student_data['dob'];
                $phonenumber = $student_data['phone'];
            } else {
                header("location:../add_student.php");
                exit();
            }
        } else {
            header("location:../add_student.php");
            exit();
        }
    ?>



    <section class="home">
        <div class="text">Hello <?php echo ucwords($_SESSION['login_user']) ?>👋</div>

        <?php 
            if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') {
        ?>
            <div class="text">
                <div class="add-student-container">
                    <h2 style="font-size: 25px;">Edit Student</h2>
                    <form action="./components/edit_student_data.php" method="POST" class="addstudent">
                        <input type="hidden" name="student_id" value="<?php echo $student_id; ?>">
                        <label for="symbolnumber">Symbol Number</label><br>
                        <input type="number" name="symbolnumber" value="<?php echo $symbolnumber; ?>" id="symbolnumber"><br>
                        <label for="firstname">Firstname</label><br>
                        <input type="text" name="firstname" value="<?php echo $firstname; ?>" id="firstname"><br>
                        <label for="lastname">Lastname</label><br>
                        <input type="text" name="lastname" value="<?php echo $lastname; ?>" id="lastname"><br>
                        <label for="email">Email</label><br>
                        <input type="email" name="email" value="<?php echo $email; ?>" id="email"><br>
                        <label for="dob">Date of Birth</label><br>
                        <input type="date" name="dob" value="<?php echo $dob; ?>" id="dob"><br>
                        <label for="phonenumber">Phone Number</label><br>
                        <input type="number" name="phonenumber" value="<?php echo $phonenumber; ?>" id="phonenumber"><br><br>
                        <button type="submit" name="submit">Update Student</button>
                    </form>
                </div>
            </div>
        <?php 
            } else {
        ?>
        <div class="text">
            <span id="permission-text">⛔ Only Admin and Teacher can access this page!</span>
        </div>
        <?php } ?>

    </section>

    <script src="./assets/scripts/dashboard.js"></script>

</body>
</html>
<?php
    }
} else {
    header("location:index.php");
}
?>