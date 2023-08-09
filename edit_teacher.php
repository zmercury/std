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
    <title>Edit Teacher - SMS</title>
    
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
                    
                    <li class="nav-link">
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

                    <li class="nav-link selected">
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
        // edit_teacher.php
        require_once("./components/connection.php");

        if (isset($_GET['teacher_id'])) {
            $teacher_id = $_GET['teacher_id'];

            $query = "SELECT * FROM teachers WHERE uid=$teacher_id"; 
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) { 
                $teacher_data = mysqli_fetch_assoc($result);

                $teachersrealid = $teacher_data['teachersid'];
                $subject = $teacher_data['subject'];
                $firstname = $teacher_data['fname'];
                $lastname = $teacher_data['lname'];
                $email = $teacher_data['email'];
                $dob = $teacher_data['dob'];
                $phonenumber = $teacher_data['phone'];
            } else {
                header("location:./add_teacher.php");
                exit();
            }
        } else {
            header("location:./teacher.php");
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
                <h2 style="font-size: 25px;">Edit Teachers</h2>
                <form action="./components/edit_teacher_data.php" method="POST" class="addstudent">
                    <input type="hidden" name="teacher_id" value="<?php echo $teacher_id; ?>">
                    <label for="teachersid">Teachers ID</label><br>
                    <input type="number" name="teachersid" value="<?php echo $teachersrealid; ?>" placeholder="Teacher's ID" id="teachersid"></input><br>
                    <label for="subject">Subject</label><br>
                    <input type="text" name="subject" value="<?php echo $subject; ?>" placeholder="Subject" id="subject"></input><br>
                    <label for="firstname">Firstname</label><br>
                    <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="Firstname" id="firstname"></input><br>
                    <label for="lastname">Lastname</label><br>
                    <input type="text" name="lastname" value="<?php echo $lastname; ?>" placeholder="Lastname" id="lastname"></input><br>
                    <label for="email">Email</label><br>
                    <input type="email" name="email" value="<?php echo $email; ?>" placeholder="company@name.com" id="email"></input><br>
                    <label for="dob">Date of Birth</label><br>
                    <input type="date" name="dob" value="<?php echo $dob; ?>" placeholder="DOB" id="dob"></input><br>
                    <label for="phonenumber">Phone Number</label><br>
                    <input type="number" name="phonenumber" value="<?php echo $phonenumber; ?>" placeholder="Phone Number" id="phonenumber"></input><br><br>
                    <button type="submit" name="submit">Update Teacher</button>
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