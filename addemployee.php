<?php
require_once('./backend/navbar.php');
require_once('./backend/_dbconnect.php');
?>
<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Employees Details</title>
    <link rel="stylesheet" href="./assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <div class="container text-center mt-5 col-md-3">
        <h2> Add Employee Details</h2>
        <form method="POST" action="./employee_list.php">
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="address" class="form-label">Address</label>
                <input type="text" class="form-control" id="address" name="address" required>
            </div>
            <div class="mb-3">
                <label for="phoneno" class="form-label">Phone Number</label>
                <input type="text" class="form-control" id="phoneno" name="phoneno" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="mb-3">
                <label for="department" class="form-label">Department</label>
                <input type="text" class="form-control" id="department" name="department" required>
            </div>
            <div class="mb-3">
                <div class="form-group">
                    <!--&emsp giving the spaces -->
                    <label class="myInput" for="updated_comments">Comments:&emsp;</label>
                    <input class="myInput" type="text" id="updated_comments" name="updated_comments"
                        value="New Employee" readonly>
                </div>

                <button type="submit" class="btn btn-primary mt-3">Add Data</button>
        </form>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

</body>

</html>