<?php
include 'backend/_dbconnect.php';
require_once 'backend/navbar.php';

// Check if form is submitted for updating data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $empid = $_POST['empid'];
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phoneno = $_POST['phoneno'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $updated_comments = $_POST['updated_comments'];


    // Prepare the SQL update statement
    $stmt = $conn->prepare("UPDATE empdetails SET name=?, address=?, phoneno=?, email=?, department=?, updated_comments=? WHERE empid=?");

    // Check if the prepare() function succeeded
    if ($stmt) {
        // Bind parameters and execute the statement
        $stmt->bind_param("ssisssi", $name, $address, $phoneno, $email, $department, $updated_comments, $empid);
        if ($stmt->execute()) {
            $stmt->close();
            header("Location: employee_list.php?action=updated");
            exit;
        } else {
            $error = "Error updating data: " . $conn->error;
        }
    } else {
        $error = "Error preparing statement: " . $conn->error;
    }
}



// Retrieve the employee details based on the empid
if (isset($_GET['empid'])) {
    $empid = $_GET['empid'];
    $sql = "SELECT * FROM empdetails WHERE empid=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $empid);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
        $name = $row['name'];
        $address = $row['address'];
        $phoneno = $row['phoneno'];
        $email = $row['email'];
        $department = $row['department'];
        $updated_comments = $row['updated_comments'];
    } else {
        // No employee found with the given empid
        $error = "No employee found with the specified ID.";
    }

    $stmt->close();
} else {
    // No empid specified
    $error = "No employee ID specified.";
}


?>

<!DOCTYPE html>
<html>

<head>
    <title>Edit Employee Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center col-md-3">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php else: ?>
            <h2>Edit Employee Details</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
                <input type="hidden" name="empid" value="<?php echo $empid; ?>">
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input type="text" class="form-control" id="name" name="name" value="<?php echo $name; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address" value="<?php echo $address; ?> "
                        required>
                </div>
                <div class="mb-3">
                    <label for="phoneno" class="form-label">Phone Number</label>
                    <input type="text" class="form-control" id="phoneno" name="phoneno" value="<?php echo $phoneno; ?>"
                        required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $email; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" class="form-control" id="department" name="department"
                        value="<?php echo $department; ?>" required>
                </div>
                <div class="mb-3">
                    <label for="updated_comments" class="form-label">Update the Comments for changing the details</label>
                    <input type="text" class="form-control" id="updated_comments" name="updated_comments"
                        value="<?php echo $updated_comments; ?>" required>

                </div>

                <button type="submit" class="btn btn-primary">Update</button>
            </form>
        <?php endif; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>