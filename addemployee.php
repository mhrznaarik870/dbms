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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container col-md-3">
        <div class="container">
            <form method="POST" action="./index.php">
                <h2 align="center">Enter the details</h2>
                <div class="mb-3 my-5">
                    <label for="name" class="form-label">Employee Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <input type="text" class="form-control" id="address" name="address">
                </div>
                <div class="mb-3">
                    <label for="phoneno" class="form-label">Phone No.</label>
                    <input type="text" class="form-control" id="phoneno" name="phoneno">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email">
                </div>
                <div class="mb-3">
                    <label for="department" class="form-label">Department</label>
                    <input type="text" class="form-control" id="department" name="department">
                    <div id="help" class="form-text">Make sure the records are correct.</div>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-warning">Cancel</button>
            </form>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        crossorigin="anonymous"></script>
</body>

</html>