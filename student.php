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
    <title>Students - SMS</title>
    
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

                    <li class="nav-link selected">
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
        $conn = new mysqli('localhost', 'root', '', 'sms');
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        $sql = "SELECT * FROM students";
        $result = $conn->query($sql);
        
        $students = array(); 
        
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $students[] = $row; 
            }
        }
        
        $conn->close();
    ?>

    <section class="home">
        <div class="text">Hello <?php echo ucwords($_SESSION['login_user']) ?>👋</div>

        <div class="text">
            <div class="fetched-data">
                <div class="inner-fetched">
                    <h2>Students</h2>
                    <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'admin') {  ?>
                        <a href="./add_student.php">
                            <button class="add-student">Add Students</button>
                        </a>
                    <?php } ?>
                </div>
                <?php if (!empty($students)) : ?>
                <div class="inner-fetched-other">
                    <table border="1" class="fetched-table">
                        <tr>
                            <th>S.N.</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Date of Birth</th>
                            <th>Phone</th>
                            <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'admin') {  ?>
                                <th colspan="2">Actions</th>
                            <?php } ?>
                        </tr>
                        <?php foreach ($students as $student) : ?>
                            <tr>
                                <td><?php echo $student['symbolnum']; ?></td>
                                <td><?php echo $student['fname']; ?></td>
                                <td><?php echo $student['lname']; ?></td>
                                <td><?php echo $student['email']; ?></td>
                                <td><?php echo $student['dob']; ?></td>
                                <td><?php echo $student['phone']; ?></td>
                                <?php if($_SESSION['role'] === 'admin' || $_SESSION['role'] === 'admin') {  ?>
                                <td><?php echo '<a href="edit_student.php?student_id=' . $student['uid'] . '"><button class="edit-button">Edit</button></a>'; ?></td>
                                <td><?php echo '<a href="./components/delete_student.php?student_id=' . $student['uid'] . '"><button class="delete-button">Delete</button></a>'; ?></td>
                                <?php } ?>
                            </tr>
                        <?php endforeach; ?>
                    </table>
                </div>
                <?php else : ?>
                    <p>No student data available.</p>
                <?php endif; ?>
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