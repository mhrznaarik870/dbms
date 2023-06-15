<?php
require_once './backend/_dbconnect.php';
require_once './backend/navbar.php';

// Initialize the $showAlert and $showError variables
$showAlert = false;
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
    // Process the form data and update the record in the database
    $id = $_POST['id'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phoneno = $_POST['phoneno'];
    $email = $_POST['email'];
    $department = $_POST['department'];

    $sql = "UPDATE empdetails SET `name` = '$name', `address` = '$address', `phoneno` = '$phoneno', `email` = '$email', `department` = '$department' WHERE `empid` = '$id'";

    $result = mysqli_query($conn, $sql);
    if ($result) {
        $showAlert = true;
    } else {
        $showError = true;
    }
}

// Get the employee details based on the provided ID
$id = $_GET['id'];
$sql = "SELECT * FROM `empdetails` WHERE `empid` = '$id'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Edit Employee</title>
</head>

<body>
    <?php require_once './backend/navbar.php'; ?>

    <div class="container d-flex justify-content-center">
        <?php if ($showAlert): ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <strong>Success!</strong> Employee details updated successfully.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <?php if ($showError): ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Error!</strong> Failed to update employee details.
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        <?php endif; ?>

        <form action="./index.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $row['empid']; ?>">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="<?php echo $row['name']; ?>">
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address"
                    value="<?php echo $row['address']; ?>">
            </div>
            <div class="mb-3">
                <label for="phoneno" class="form-label">Phone No.</label>
                <input type="text" class="form-control" id="phoneno" name="phoneno"
                    value="<?php echo $row['phoneno']; ?>">
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['email']; ?>">
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department"
                    value="<?php echo $row['department']; ?>">
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
        </form>

        <!-- Delete Confirmation Modal -->
        <div class="modal fade" id="deleteConfirmationModal" tabindex="-1"
            aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteConfirmationModalLabel">Delete Confirmation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this employee?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <a href="?delete_id=<?php echo $row['empid']; ?>" class="btn btn-danger">Delete</a>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- Link to Bootstrap CSS and JS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>

    <script>
        // Show the delete confirmation modal when the "Delete" button is clicked
        const deleteButton = document.querySelector('.delete-btn');
        const deleteConfirmationModal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
        deleteButton.addEventListener('click', () => {
            deleteConfirmationModal.show();
        });
    </script>

</body>

</html>