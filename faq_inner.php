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
    <!-- <link rel="stylesheet" href="./assets/css/faqs.css"> -->
    <link rel="icon" type="image/x-icon" href="./assets/images/planet.png">
    <title>FAQ - SMS</title>
    
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
                    <li class="nav-link selected">
                        <a href="./dashboard.php">
                            <i class='bx bx-home icon'></i>
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
                    <a href="./components/logout.php?Logout"">
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

    <section class="home">
        <div class="text">Hello <?php echo ucwords($_SESSION['login_user']) ?>👋</div>
        
        <div class="text">
        <h1 style="font-size: 25px; margin-bottom: 1em;">Frequently Asked Questions</h1>
            <div class="accordion">
                <div class="accordion-item">
                    <div class="accordion-header">
                        <img src="./assets/svgs/up.svg" alt="up" style="width: 20px;" class="accordion-icon-up hidden">
                        <img src="./assets/svgs/down.svg" alt="down" style="width: 20px;" class="accordion-icon-down">
                        <h4>What is a Student Management System (SMS)? </h4>
                    </div>
                    <div class="accordion-content">
                        <p>A Student Management System (SMS) is a software application designed to streamline and automate various administrative tasks related to managing student information within educational institutions.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header">
                        <img src="./assets/svgs/up.svg" alt="up" style="width: 20px;" class="accordion-icon-up hidden">
                        <img src="./assets/svgs/down.svg" alt="down" style="width: 20px;" class="accordion-icon-down">
                        <h4>What are the key features of a Student Management System?</h4>
                    </div>
                    <div class="accordion-content">
                        <p>Common features include student registration, enrollment, attendance tracking, grade management, course scheduling, communication tools, and reporting.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header">
                        <img src="./assets/svgs/up.svg" alt="up" style="width: 20px;" class="accordion-icon-up hidden">
                        <img src="./assets/svgs/down.svg" alt="down" style="width: 20px;" class="accordion-icon-down">
                        <h4>Who uses a Student Management System?</h4>
                    </div>
                    <div class="accordion-content">
                        <p>Educational institutions such as schools, colleges, universities, and training centers use SMS to manage student data, academic processes, and administrative tasks.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header">
                        <img src="./assets/svgs/up.svg" alt="up" style="width: 20px;" class="accordion-icon-up hidden">
                        <img src="./assets/svgs/down.svg" alt="down" style="width: 20px;" class="accordion-icon-down">
                        <h4>How does a Student Management System benefit educational institutions?</h4>
                    </div>
                    <div class="accordion-content">
                        <p>SMS improves efficiency by automating tasks, enhances communication between stakeholders, provides data-driven insights, and ensures accurate record-keeping.</p>
                    </div>
                </div>

                <div class="accordion-item">
                    <div class="accordion-header">
                        <img src="./assets/svgs/up.svg" alt="up" style="width: 20px;" class="accordion-icon-up hidden">
                        <img src="./assets/svgs/down.svg" alt="down" style="width: 20px;" class="accordion-icon-down">
                        <h4>Is data stored in a Student Management System secure?</h4>
                    </div>
                    <div class="accordion-content">
                        <p>Yes, reputable SMS platforms implement robust security measures to protect sensitive student information, including encryption and access controls.</p>
                    </div>
                </div>
        </div>

    </section>

    <script src="./assets/scripts/dashboard.js"></script>
    <script src="./assets/scripts/faqs.js"></script>

</body>
</html>
<?php
}
} else {
    header("location:index.php");
}

?>