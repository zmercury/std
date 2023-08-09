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
    <title>Add Notice - SMS</title>
    
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

                    <li class="nav-link selected">
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

        <?php 
            if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') {
        ?>
        <div class="text">
            <div class="home-notice-left">
                <div class="add-student-container">
                    <h2 style="font-size: 25px;">Add Notice</h2>
                    <form action="./components/add_notice_data.php" method="POST" class="addstudent">
                        <input type="text" name="notice-content" placeholder="Notice Content goes here" id="notice-content"  style="height: 6em; margin-bottom: 0px;"></input><br>
                        <select name="status" id="status" style="margin-top: 0;" class="select">
                            <option value="">Choose your status</option>
                            <option value="important">Important - Front Page</option>
                            <option value="basic">Basic</option>
                        </select>
                        <button type="submit" name="submit" style="margin-top: .6em;">Add  Notice</button>
                    </form>
                </div>
            </div>
        </div>
        <?php 
            } 
        ?>

        <?php
            $conn = new mysqli('localhost', 'root', '', 'sms');
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $sql = "SELECT * FROM notice";
            $result = $conn->query($sql);

            $notices = array(); 

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $notices[] = $row; 
                }
            }

            rsort($notices);

            $conn->close();
        ?>
        
        <div class="text" >
            <div class="home-top" style="margin-bottom: 2em;">
                <div class="home-notice">
                    <div class="home-notice-left">
                        <h4 style="margin-bottom: 1em;">Recent Notice</h4>
                        <?php if (!empty($notices)) : ?>
                        <div class="inner-fetched-assignment">
                            <?php foreach ($notices as $notice) : ?>
                                <h4 style="font-size: 13px !important;">🕑 Added at:  <?php echo date("d M Y h:i a", strtotime($notice['notice-date'])); ?> 

                                <?php 
                                    if ($notice['status'] === 'important') {
                                ?>
                                    - <span style="color: #e63946;;"> ⚠️<?php echo ucfirst($notice['status']) ?> </span>
                                <?php 
                                    } 
                                ?>

                                <h4 style="margin-left: 2em; margin-bottom: 2em; font-weight: 500;">  <?php echo $notice['notice-data']; ?></h4>
                            <?php endforeach; ?>
                        </div>
                        <?php else : ?>
                            <p>No Notice found</p>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
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