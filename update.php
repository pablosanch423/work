<?php include "header.php"; ?>
<?php include "db.php"; ?>

<?php
if (isset($_POST['submit'])) {
    $student_id = $_POST['id'];
    $fname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $regexName = "/^[a-zA-Z\s]+$/";
    $regexEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    $isValid = true;
    $errors = [];

    if (!preg_match($regexName, $fname)) {
        $isValid = false;
        $errors[] = "Invalid first name. Only letters and white space allowed.";
    }
    if (!preg_match($regexName, $lname)) {
        $isValid = false;
        $errors[] = "Invalid last name. Only letters and white space allowed.";
    }
    if (!preg_match($regexEmail, $email)) {
        $isValid = false;
        $errors[] = "Invalid email format.";
    }

    if ($isValid) {
        $query = "UPDATE students SET firstname = '{$fname}', lastname = '{$lname}', email = '{$email}' WHERE id = {$student_id}";

        if (mysqli_query($conn, $query)) {
            header("Location: home.php");
        } else {
            echo "<div class='alert alert-danger' role='alert'>Error updating student: " . mysqli_error($conn) . "</div>";
        }
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger' role='alert'>$error</div>";
        }
    }
}

if (isset($_GET['id'])) {
    $student_id = $_GET['id'];
    $query = "SELECT * FROM students WHERE id = $student_id";
    $result = mysqli_query($conn, $query);

    if ($row = mysqli_fetch_assoc($result)) {
        $fname = $row['firstname'];
        $lname = $row['lastname'];
        $email = $row['email'];
    }
}
?>

<div class="container mt-5">
    <h2>Edit Student</h2>
    <form action="update.php" method="post">
        <input type="hidden" name="id" value="<?php echo $student_id; ?>">
        <div class="mb-3">
            <label for="firstname" class="form-label">First Name</label>
            <input type="text" class="form-control" id="firstname" name="firstname" value="<?php echo $fname; ?>" required>
        </div>
        <div class="mb-3">
            <label for="lastname" class="form-label">Last Name</label>
            <input type="text" class="form-control" id="lastname" name="lastname" value="<?php echo $lname; ?>" required>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <button type="submit" name="submit" class="btn btn-primary">Update</button>
    </form>
    <form action="home.php" class="mt-1">
        <button type="submit" class="btn btn-warning">Go Back</button>
    </form>
</div>

<?php include "footer.php"; ?>