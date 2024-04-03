<?php
include "header.php";
include "db.php";

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $firstname = mysqli_real_escape_string($conn, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($conn, $_POST['lastname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $regexName = "/^[a-zA-Z\s]+$/";
    $regexEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    $errors = [];
    if (!preg_match($regexName, $firstname)) {
        $errors[] = "Invalid first name. Only letters and white space allowed.";
    }
    if (!preg_match($regexName, $lastname)) {
        $errors[] = "Invalid last name. Only letters and white space allowed.";
    }
    if (!preg_match($regexEmail, $email)) {
        $errors[] = "Invalid email format";
    }

    if (empty($errors)) {
        $query = "INSERT INTO students (firstname, lastname, email) VALUES ('$firstname', '$lastname', '$email')";

        if(mysqli_query($conn, $query)){
            header("Location: home.php");
        } else {
            echo "ERROR: Could not able to execute $query. " . mysqli_error($conn);
        }
    } else {
        foreach ($errors as $error) {
            echo "<p style='color:red;'>$error</p>";
        }
    }
}
?>

<div class="container mt-5">
    <h2 class="text-center">Create New Student</h2>
    <form action="create.php" method="post">
        <div class="form-group">
            <label for="firstname">First Name:</label>
            <input type="text" class="form-control" id="firstname" name="firstname" required>
        </div>
        <div class="form-group">
            <label for="lastname">Last Name:</label>
            <input type="text" class="form-control" id="lastname" name="lastname" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" required>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Submit</button>
    </form>
    <form action="home.php" class="mt-1">
        <button type="submit" class="btn btn-warning">Go Back</button>
    </form>
</div>

<?php include "footer.php"; ?>
