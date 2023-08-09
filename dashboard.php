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
    <title>Dashboard - SMS</title>
    
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

            $importantNotice = null;

            foreach($notices as $notice) {
                if($notice['status'] === 'important') {
                    $importantNotice = $notice;
                    break;
                } else {
                    $importantNotice = "There is no Important Notices for today!";
                }
            }

            $str = implode(",", $importantNotice);

            $conn->close();
        ?>

    <section class="home">
        <div class="text">Hello <?php echo ucwords($_SESSION['login_user']) ?>👋</div>

        <div class="text">
            <div class="home-top">
                <div class="home-notice">
                    <div class="home-notice-left">
                        
                    
                        <h4>Notice</h4>
                        <span class="date" style="font-weight: 700;">Last Updated: <?php echo date("d M Y h:s a", strtotime($notice['notice-date'])) ?></span>
                        <p> <?php echo $notice['notice-data'] ?> </p>
                        
                        <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') { ?>
                        <div id="quick-actions" style="margin-top: .5em !important; width: fit-content;">
                                <i class='bx bx-plus'></i>
                                <a href="./add_notice.php"><span>Add Notice</span></a>
                        </div>
                        <?php } ?>


                    </div>
                </div>
            </div>
        </div>

        <div class="text">
            <div class="home-top">
                <div class="home-notice">
                    <div class="home-notice-left">
                        <h4>Quick Actions</h4>
                        <div class="home-notice-left-quick-actions">
                            <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') { ?>
                            <div id="quick-actions">
                                <i class='bx bx-plus'></i>
                                <a href="./add_student.php"><span>Add Students</span></a>
                            </div>
                            <?php } ?>
                            <div id="quick-actions">
                                <i class='bx bx-note'></i>
                                <a href="./student.php"><span>Students Record</span></a>
                            </div>
                            <?php if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') { ?>
                            <div id="quick-actions">
                                <i class='bx bx-plus'></i>
                                <a href="./add_teacher.php"><span>Add Teachers</span></a>
                            </div>
                            <?php } ?>
                            <div id="quick-actions">
                                <i class='bx bx-note'></i>
                                <a href="./teacher.php"><span>Teachers Record</span></a>
                            </div>
                            <div id="quick-actions">
                                <i class='bx bx-calendar' ></i>
                                <a href="./schedule.php"><span>Schedule</span></a>
                            </div>
                            <div id="quick-actions">
                                <i class='bx bx-book-bookmark' ></i>
                                <a href="./assignment.php"><span>Assignments</span></a>
                            </div>
                            <div id="quick-actions">
                                <i class='bx bx-notification icon'></i>
                                <a href="./add_notice.php"><span>Notice</span></a>
                            </div>
                            <div id="quick-actions">
                                <i class='bx bx-question-mark icon'></i>
                                <a href="./faq_inner.php"><span>FAQ</span></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>  

        <?php
        $conn = new mysqli('localhost', 'root', '', 'sms');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);
        
        $students = 0; 
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students = $students + 1;
            }
        }
        
        $conn->close();
    ?>

    <?php
        $conn = new mysqli('localhost', 'root', '', 'sms');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM teachers";
        $result = $conn->query($sql);
        
        $teachers = 0; 
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $teachers = $teachers + 1;
            }
        }
        
        $conn->close();
    ?>

    <?php
        $conn = new mysqli('localhost', 'root', '', 'sms');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM assignment";
        $result = $conn->query($sql);
        
        $assignments = array(); 
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $assignments[] = $row; 
            }
        }

        rsort($assignments);

        $conn->close();
    ?>


        <div class="text">
            <div class="parent">
                    <div class="home-top">
                        <div class="home-notice">
                            <div class="home-notice-left">
                                <div class="home-notice-left-inner" style="display: flex; justify-content:space-between; align-items:center; flex-wrap: wrap; ">
                                    <h4 style="margin-bottom: .6em;">Today's Assignment</h4> 
                                    <span class="assignment-date" style="font-weight: 800; font-size: 13px;"><?php echo date('d M Y'); ?></span>
                                </div>
                                <?php if (!empty($assignments)) : ?>
                                <div class="inner-fetched-assignment">
                                    <?php    
                                        foreach ($assignments as $assignment) : 
                                    ?>                               
                                        <h4 style="font-size: 13px !important;">🕑 Added at:  <?php echo date("d M Y", strtotime($assignment['curtime'])); ?>  -  <span style="color: #ade8f4"><?php echo $assignment['addedby']; ?></span></h4> 
                                        <h4 style="margin-left: 2em;  font-weight: 500;">  <?php echo $assignment['assignment']; ?></h4>
                                        <h4 style="margin-left: 2.4em; font-size: 11px !important; font-weight: 500; margin-bottom: .5em; color:#C0DFA1;"> ⛔   Submission Date:  <?php echo date("d M Y", strtotime($assignment['submissiondate'])); ?></h4> 
                                    <?php
                                        endforeach; 
                                    ?>
                                </div>
                                <?php else : ?>
                                    <p>No Assignement found</p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="home-notice-left">
                        <h4>Total Students</h4>
                        <span class="count-entity"> <?php echo $students ?></span>
                    </div>
                    <div class="home-notice-left">
                        <h4>Total Teachers</h4>
                        <span class="count-entity"> <?php echo $teachers ?></span>
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