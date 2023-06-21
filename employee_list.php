<?php
include 'backend/_dbconnect.php';
include 'backend/navbar.php';

// Check if form is submitted for adding new data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $address = $_POST['address'];
    $phoneno = $_POST['phoneno'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $updated_comments = $_POST['updated_comments'];

    // Prepare and execute the SQL insert statement
    $stmt = $conn->prepare("INSERT INTO empdetails (name, address, phoneno, email, department, updated_comments) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssisss", $name, $address, $phoneno, $email, $department, $updated_comments);


    if ($stmt->execute()) {
        $message = "Data added successfully!";
    } else {
        $error = "Error adding data: " . $conn->error;
    }

    $stmt->close();
}

// Check if the table is updated or deleted
if (isset($_GET['action'])) {
    $action = $_GET['action'];
    if ($action === 'updated') {
        $message = "Data updated successfully!";
    } elseif ($action === 'deleted') {
        $warning = "Data deleted!";
    }
}

// Retrieve data from the database
$sql = "SELECT * FROM empdetails";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html>

<head>
    <title>List of Employees</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
</head>

<body>
    <div class="container text-center col-md-10">

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

        <?php if (isset($warning)): ?>
            <div class="alert alert-warning" role="alert">
                <?php echo $warning; ?>
            </div>
        <?php endif; ?>

        <h2>List of Employees</h2>
        <table class="table table-striped text-center">
            <thead>
                <tr>
                    <th>Employee ID</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Phone Number</th>
                    <th>Email</th>
                    <th>Department</th>
                    <th>Updated Comments</th>
                    <th>Registration Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td>
                            <?php echo $row['empid']; ?>
                        </td>
                        <td>
                            <?php echo $row['name']; ?>
                        </td>
                        <td>
                            <?php echo $row['address']; ?>
                        </td>
                        <td>
                            <?php echo $row['phoneno']; ?>
                        </td>
                        <td>
                            <?php echo $row['email']; ?>
                        </td>
                        <td>
                            <?php echo $row['department']; ?>
                        </td>
                        <td>
                            <?php echo $row['updated_comments']; ?>
                        </td>
                        <td>
                            <?php echo $row['Reg_date']; ?>
                        </td>
                        <td>
                            <a href="edit.php?empid=<?php echo $row['empid']; ?>"
                                class="btn btn-sm btn-primary col-md-7 my-1">Edit</a>
                            <a href="delete.php?empid=<?php echo $row['empid']; ?>"
                                class="btn btn-danger btn-primary my-1 col-md-7">Delete</a>

                        </td>
                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>