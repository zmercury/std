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
    <title>Assignments - SMS</title>
    
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

                    <li class="nav-link selected">
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

        <?php
            if($_SESSION['role'] == 'admin' || $_SESSION['role'] == 'teacher') {
        ?>

        <div class="text">
            <div class="home-top">
                <div class="home-notice">
                    <div class="home-notice-left">
                        <h4>Add Assignment</h4>
                        <form action="./components/add_assignment.php" class="addstudent" method="POST" >
                            <input type="hidden" name="session_user" value="<?php echo $_SESSION['login_user']; ?>">
                            <input type="text" name="questions" id="questions" placeholder="Add your questions here" style="height: 4em !important">
                            <label for="deadline">Submission Date</label>
                            <input 
                                type="datetime-local"
                                id="deadline"
                                name="deadline"
                                value="2023-01-01T00:00"
                                min="2023-01-01T00:00"
                                max="2024-12-15T00:00"
                            />  
                            <button type="submit" name="submit">Add </button>
                        </form>
                    </div>
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
        
        <div class="text" >
            <div class="home-top" style="margin-bottom: 2em;">
                <div class="home-notice">
                    <div class="home-notice-left">
                        <h4 style="margin-bottom: 1em;">Recent Assignments</h4>
                        <?php if (!empty($assignments)) : ?>
                        <div class="inner-fetched-assignment">
                            <?php foreach ($assignments as $assignment) : ?>
                                <h4 style="font-size: 13px !important;">🕑 Added at:  <?php echo date("d M Y h:i a", strtotime($assignment['curtime'])); ?>  -  <span style="color: #ade8f4"><?php echo $assignment['addedby']; ?></span></h4> 
                                <h4 style="font-size: 13px !important;">⏳ Submission Date:  <?php echo date("d M Y h:i a", strtotime($assignment['submissiondate'])); ?></h4> 
                                <h4 style="margin-left: 2em; margin-bottom: 2em; font-weight: 500;">  <?php echo $assignment['assignment']; ?></h4>
                            <?php endforeach; ?>
                        </div>
                        <?php else : ?>
                            <p>No Assignement found</p>
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