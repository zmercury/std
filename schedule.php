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
    <title>Schedule - SMS</title>
    
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

                    <li class="nav-link">
                        <a href="./add_teacher.php">
                            <i class='bx bx-user-plus icon' ></i>
                            <span class="text nav-text">Add Teachers</span>
                        </a>
                    </li>

                    <li class="nav-link selected">
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

    <section class="home">
        <div class="text">Hello <?php echo ucwords($_SESSION['login_user']) ?>👋</div>

        <div class="text">
        <h4 style="margin-bottom: 1em;">Class Schedule</h4>

        <?php
        // Define the schedule data (Day, Teacher Name, Subject, Class Timing)
        $schedule = array(
            "Sunday" => array(
                array("John Doe", "Mathematics", "9:00 AM - 10:30 AM"),
                array("Jane Smith", "Science", "10:45 AM - 12:15 PM"),
                array("Michael Johnson", "English", "1:00 PM - 2:30 PM"),
                array("Emily Brown", "History", "3:00 PM - 4:30 PM")
            ),
            "Monday" => array(
                array("Robert Williams", "Geography", "9:00 AM - 10:30 AM"),
                array("Sarah Lee", "Physical Ed.", "10:45 AM - 12:15 PM"),
                array("David Miller", "Physics", "1:00 PM - 2:30 PM"),
                array("Karen Davis", "Chemistry", "3:00 PM - 4:30 PM")
            ),
            "Tuesday" => array(
                array("Steven Wilson", "Biology", "9:00 AM - 10:30 AM"),
                array("Laura White", "Computer Science", "10:45 AM - 12:15 PM"),
                array("Mark Taylor", "Art", "1:00 PM - 2:30 PM"),
                array("Jennifer Green", "Music", "3:00 PM - 4:30 PM")
            ),
            "Wednesday" => array(
                array("John Doe", "Mathematics", "9:00 AM - 10:30 AM"),
                array("Jane Smith", "Science", "10:45 AM - 12:15 PM"),
                array("Michael Johnson", "English", "1:00 PM - 2:30 PM"),
                array("Emily Brown", "History", "3:00 PM - 4:30 PM"),
                array("Robert Williams", "Geography", "5:00 PM - 6:30 PM")
            ),
            "Thursday" => array(
                array("Sarah Lee", "Physical Ed.", "9:00 AM - 10:30 AM"),
                array("David Miller", "Physics", "10:45 AM - 12:15 PM"),
                array("Karen Davis", "Chemistry", "1:00 PM - 2:30 PM"),
                array("Steven Wilson", "Biology", "3:00 PM - 4:30 PM"),
                array("Laura White", "Computer Science", "5:00 PM - 6:30 PM")
            ),
            "Friday" => array(
                array("Mark Taylor", "Art", "9:00 AM - 10:30 AM"),
                array("Jennifer Green", "Music", "10:45 AM - 12:15 PM"),
                array("John Doe", "Mathematics", "1:00 PM - 2:30 PM"),
                array("Jane Smith", "Science", "3:00 PM - 4:30 PM"),
                array("Michael Johnson", "English", "5:00 PM - 6:30 PM")
            )
        );

        // Display the schedule in an HTML table
        echo "<table border='1' class='fetched-table'>";
        echo "<tr><th>Day</th><th>Teacher Name</th><th>Subject</th><th>Class Timing</th></tr>";

        foreach ($schedule as $day => $classes) {
            echo "<tr><td rowspan='" . count($classes) . "'>" . $day . "</td>";
            $first = true;
            foreach ($classes as $class) {
                if (!$first) {
                    echo "<tr>";
                }
                echo "<td>" . $class[0] . "</td>"; // Teacher Name
                echo "<td>" . $class[1] . "</td>"; // Subject
                echo "<td>" . $class[2] . "</td>"; // Class Timing
                echo "</tr>";
                $first = false;
            }
        }

        echo "</table>";
        ?>
        </div>

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