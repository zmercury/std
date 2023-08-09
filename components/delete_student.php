<?php
require_once("./connection.php");

if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $query = "DELETE FROM students WHERE uid=$student_id";

        $result = mysqli_query($conn, $query);
        if ($result) {
            header("location:../student.php");
            exit();
        } else {
            header("location:../student.php");
            exit();
        }
    }
} else {
    header("location:../student.php");
    exit();
}
?>

<script>
    if (confirm("Are you sure you want to delete this student?")) {
        window.location.href = "delete_student.php?student_id=<?php echo $student_id; ?>&confirm=true";
    } else {
        window.location.href = "../student.php";
    }
</script>
