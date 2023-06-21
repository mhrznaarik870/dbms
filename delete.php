<?php
include 'backend/_dbconnect.php';
include 'backend/navbar.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if confirmation button is clicked
    if (isset($_POST['confirm'])) {
        $empid = $_POST['empid'];
        $resignedComments = $_POST['resigned_comments'];

        // Retrieve employee details from empdetails table
        $stmt = $conn->prepare("SELECT * FROM empdetails WHERE empid = ?");
        $stmt->bind_param("i", $empid);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();

        // Insert employee details into resigned_employees table
        $stmt = $conn->prepare("INSERT INTO resigned_employees (empid, name, address, phoneno, email, department, resigned_comments, Reg_date) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("isssssss", $row['empid'], $row['name'], $row['address'], $row['phoneno'], $row['email'], $row['department'], $resignedComments, $row['Reg_date']);
        $stmt->execute();

        // Delete employee from empdetails table
        $stmt = $conn->prepare("DELETE FROM empdetails WHERE empid = ?");
        $stmt->bind_param("i", $empid);
        $stmt->execute();

        $message = "Employee deleted successfully!";
        header("Location: resignedEmployees.php");
    } else {
        // Cancellation button is clicked, redirect back to the employee list page
        header("Location: employee_list.php");
        exit();
    }
}

// Retrieve data from the database based on the empid
if (isset($_GET['empid'])) {
    $empid = $_GET['empid'];
    $sql = "SELECT * FROM empdetails WHERE empid = '$empid'";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html>

<head>
    <title>Delete Employee</title>
    <link rel="stylesheet" href="assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center col-md-9">

        <?php if (isset($message)): ?>
            <div class="alert alert-success" role="alert">
                <?php echo $message; ?>
            </div>
        <?php endif; ?>

        <h2>Delete Employee</h2>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Employee Details</h5>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <strong>Employee ID: </strong>
                                <?php echo $row['empid']; ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Name: </strong>
                                <?php echo $row['name']; ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Address: </strong>
                                <?php echo $row['address']; ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Phone Number: </strong>
                                <?php echo $row['phoneno']; ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Email: </strong>
                                <?php echo $row['email']; ?>
                            </li>
                            <li class="list-group-item">
                                <strong>Department: </strong>
                                <?php echo $row['department']; ?>
                            </li>
                            <li class="list-group-item">
                                <form action="" method="POST"
                                    onsubmit="return confirm('Are you sure you want to delete this employee?');">
                                    <input type="hidden" name="empid" value="<?php echo $row['empid']; ?>">
                                    <input type="text" name="resigned_comments" placeholder="Resigned Comments">
                                    <button type="submit" name="confirm" class="btn btn-danger">Confirm</button>
                                    <a href="employee_list.php" class="btn btn-primary">Cancel</a>
                                </form>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
</body>

</html>