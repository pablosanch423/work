<?php
include "header.php";
include "db.php";

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $query = "DELETE FROM students WHERE id = $student_id";

    if (mysqli_query($conn, $query)) {
        header("Location: home.php");
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error deleting student: " . mysqli_error($conn) . "</div>";
    }
} else {
    echo "<div class='alert alert-warning' role='alert'>No student ID provided.</div>";
}
?>

<?php include "footer.php" ?> 
