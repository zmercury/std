<?php
require_once("./connection.php");

if (isset($_GET['teacher_id'])) {
    $teacher_id = $_GET['teacher_id'];

    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $query = "DELETE FROM teachers WHERE uid=$teacher_id";

        $result = mysqli_query($conn, $query);
        if ($result) {
            header("location:../teacher.php");
            exit();
        } else {
            header("location:../teacher.php");
            exit();
        }
    }
} else {
    header("location:../teacher.php");
    exit();
}
?>

<script>
    if (confirm("Are you sure you want to delete this teacher?")) {
        window.location.href = "delete_teacher.php?teacher_id=<?php echo $teacher_id; ?>&confirm=true";
    } else {
        window.location.href = "../teacher.php";
    }
</script>
