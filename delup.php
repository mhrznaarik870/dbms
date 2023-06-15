<?php
require_once './backend/_dbconnect.php';
require_once './backend/navbar.php';

// Initialize the $showAlert, $showUpdateAlert, and $showError variables
$showAlert = false;
$showUpdateAlert = false;
$showError = false;

// Check if the delete_id parameter is present in the URL
if (isset($_GET['delete_id'])) {
    $deleteId = $_GET['delete_id'];

    // Delete the record from the database
    $sql = "DELETE FROM `empdetails` WHERE `empid` = '$deleteId'";
    $result = mysqli_query($conn, $sql);

    // Check if the deletion was successful
    if ($result) {
        $showAlert = true;
    } else {
        $showError = true;
    }
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Process the form data and update the database record
    $empId = $_GET['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phoneno = $_POST['phoneno'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    $sql = "UPDATE `empdetails` SET `name` = '$name', `address` = '$address', `phoneno` = '$phoneno',
            `email` = '$email', `department` = '$department' WHERE `empid` = '$empId'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $showUpdateAlert = true;
    } else {
        $showError = true;
    }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Employees</title>
</head>

<body>
    <div class="container d-flex justify-content-center">
        <?php if ($showAlert): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Employee deleted successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($showUpdateAlert): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Employee updated successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($showError): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert" style="background-color: red;">
                <strong>Error!</strong> Failed to perform the operation.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Employee ID</th>
                    <th scope="col">Name</th>
                    <th scope="col">Address</th>
                    <th scope="col">Phone No.</th>
                    <th scope="col">Email</th>
                    <th scope="col">Department</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($conn)) {
                    $sql = "SELECT * FROM `empdetails` ";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "
                        <tr>
                            <th scope='row'>" . $row['empid'] . "</th>
                            <td>" . $row['name'] . "</td>
                            <td>" . $row['address'] . "</td>
                            <td>" . $row['phoneno'] . "</td>
                            <td>" . $row['email'] . "</td>
                            <td>" . $row['department'] . "</td>
                            <td>
                                <a href='edit.php?id=" . $row['empid'] . "' class='btn btn-primary btn-sm'>Edit</a>
                                <a href='?delete_id=" . $row['empid'] . "' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this employee?\")'>Delete</a>
                            </td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>

<!-- Link to Bootstrap CSS and JS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
    crossorigin="anonymous"></script>

</html>