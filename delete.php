<?php
include './backend/_dbconnect.php';
include './backend/navbar.php';

// Check if employee ID is provided for deletion
if (isset($_GET['empid'])) {
    $empid = $_GET['empid'];

    // Check if form is submitted for adding comments
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $comment = $_POST['comment'];

        // Prepare and execute the SQL update statement
        $stmt = $conn->prepare("UPDATE empdetails SET updated_comments=? WHERE empid=?");
        $stmt->bind_param("si", $comment, $empid);

        if ($stmt->execute()) {
            $message = "Comment added successfully!";
            // Comment added successfully, show the confirmation alert
            echo '<script>alert("' . $message . '");</script>';
        } else {
            $error = "Error adding comment: " . $conn->error;
        }

        $stmt->close();

        // Insert records with comments into the 'resigned_employees' table
        $insertStmt = $conn->prepare("INSERT INTO resigned_employees (empid, name, address, phoneno, email, department, resignation_comments) SELECT empid, name, address, phoneno, email, department, updated_comments FROM empdetails WHERE empid=?");
        $insertStmt->bind_param("i", $empid);
        if ($insertStmt->execute()) {
            $insertMessage = "Record inserted into 'resigned_employees' table!";
        } else {
            $insertError = "Error inserting record into 'resigned_employees' table: " . $conn->error;
        }
        $insertStmt->close();
    }

    // Retrieve employee details from the 'empdetails' table
    $stmt = $conn->prepare("SELECT * FROM empdetails WHERE empid=?");
    $stmt->bind_param("i", $empid);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    $stmt->close();

    // Display the employee details
    if ($row) {
        $empid = $row['empid'];
        $name = $row['name'];
        $address = $row['address'];
        $phoneno = $row['phoneno'];
        $email = $row['email'];
        $department = $row['department'];
        $comment = $row['updated_comments'];
    } else {
        $error = "Employee details not found!";
    }
} else {
    $empid = $name = $address = $phoneno = $email = $department = $comment = ""; // Initialize empty values
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Add Comment</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container text-center col-md-6">
        <h2>Add Comment for Employee ID:
            <?php echo $empid; ?>
        </h2>

        <?php if (isset($message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($error)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($insertMessage)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $insertMessage; ?>
            </div>
        <?php endif; ?>

        <?php if (isset($insertError)): ?>
            <div class="alert alert-danger" role="alert">
                <?php echo $insertError; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($empid)): ?>
            <div class="text-left">
                <h4>Employee Details:</h4>
                <p><strong>Employee ID:</strong>
                    <?php echo $empid; ?>
                </p>
                <p><strong>Name:</strong>
                    <?php echo $name; ?>
                </p>
                <p><strong>Address:</strong>
                    <?php echo $address; ?>
                </p>
                <p><strong>Phone No.:</strong>
                    <?php echo $phoneno; ?>
                </p>
                <p><strong>Email:</strong>
                    <?php echo $email; ?>
                </p>
                <p><strong>Department:</strong>
                    <?php echo $department; ?>
                </p>
            </div>
        <?php endif; ?>

        <form method="POST" action="">
            <div class="form-group">
                <label for="comment">Resignation Comment:</label>
                <textarea class="form-control" id="comment" name="comment" rows="3"><?php echo $comment; ?></textarea>
            </div>
            <button type="submit" class="btn btn-primary" onclick="return confirmDelete()">Add Comment</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function confirmDelete() {
            var confirmDelete = confirm("Are you sure you want to add the comment and delete the employee record?");
            if (confirmDelete) {
                window.location.href = "delete.php?empid=<?php echo $empid; ?>";
            } else {
                alert("Deletion canceled.");
                return false;
            }
        }
    </script>
</body>

</html>