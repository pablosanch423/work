<?php include "header.php"; ?>
<div class="container mt-5">
    <h1 class="text-center">Data to Perform CRUD Operations</h1>
    <a href="create.php" class="btn btn-outline-dark mb-2"><i class="bi bi-person-plus"></i> Create New Student</a>

    <table class="table table-striped table-bordered table-hover">
        <thead class="table-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">First Name</th>
                <th scope="col">Last Name</th>
                <th scope="col">Email</th>
                <th scope="col" colspan="3" class="text-center">CRUD Operations</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                include "db.php";
                $query = "SELECT * FROM students";
                $view_students = mysqli_query($conn, $query);

                while ($row = mysqli_fetch_assoc($view_students)) {
                    $student_id = $row["id"]; 
                    $fname = $row['firstname']; 
                    $lname = $row['lastname']; 
                    $email = $row['email']; 

                    echo "<tr>
                        <th scope='row'>{$student_id}</th>
                        <td>{$fname}</td>
                        <td>{$lname}</td>
                        <td>{$email}</td>
                        <td class='text-center'><a href='view.php?id={$student_id}' class='btn btn-primary'>View</a></td>
                        <td class='text-center'><a href='update.php?id={$student_id}' class='btn btn-primary'>Update</a></td>
                        <td class='text-center'><a href='delete.php?id={$student_id}' class='btn btn-danger'>Delete</a></td>
                    </tr>";
                }
            ?>
        </tbody>
    </table>
</div>

<?php include "footer.php" ?> 