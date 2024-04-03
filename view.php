<?php include "header.php"; ?>
<?php include "db.php"; ?>

<div class="container mt-5">
    <?php
    if (isset($_GET['id'])) {
        $student_id = $_GET['id'];
        $query = "SELECT * FROM students WHERE id = $student_id";
        $result = mysqli_query($conn, $query);

        if ($row = mysqli_fetch_assoc($result)) {
            $fname = $row['firstname'];
            $lname = $row['lastname'];
            $email = $row['email'];

            echo "<h1 class='text-center'>Student Details</h1>";
            echo "<div class='card' style='width: 18rem; margin: auto;'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>{$fname} {$lname}</h5>";
            echo "<h6 class='card-subtitle mb-2 text-muted'>ID: {$student_id}</h6>";
            echo "<p class='card-text'>Email: {$email}</p>";
            echo "<a href='update.php?id={$student_id}' class='card-link'>Edit</a>";
            echo "<a href='home.php' class='card-link'>Back to List</a>";
            echo "</div>";
            echo "</div>";
        } else {
            echo "<p>Student not found.</p>";
        }
    } else {
        echo "<p>No student ID provided.</p>";
    }
    ?>
</div>
