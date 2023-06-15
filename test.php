<?php
include './backend/navbar.php';
require './backend/_dbconnect.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Employees</title>
</head>

<!-- INSERT INTO `empdetails` (`empid`, `name`, `address`, `phoneno`, `email`, `department`, `Reg_date`) VALUES (NULL, 'mhrzna', 'gwarko', '986532147', 'aam@gmail.com', 'admin', current_timestamp()); -->

<body text-align="center">
    <div class="container  ">
        <div class="container">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">Employee ID</th>
                        <th scope="col">Name </th>
                        <th scope="col">Address</th>
                        <th scope="col">Phone No.</th>
                        <th scope="col">Email</th>
                        <th scope="col">Department</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    $showAlert = false;
                    $showError = false;


                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        // OpenCon();
                        $name = $_POST['name'];
                        $address = $_POST['address'];
                        $phoneno = $_POST['phoneno'];
                        $email = $_POST['email'];
                        $department = $_POST['department'];

                        $sql = "INSERT INTO `empdetails` ( `name`, `address`, `phoneno`, `email`, `department`, `Reg_date`) VALUES ('$name', '$address', '$phoneno', '$email', '$department', current_timestamp())";

                        $result = mysqli_query($conn, $sql);
                        if ($result) {
                            $showAlert = true;
                        } else {
                            $showError = true;
                        }
                    }


                    // shows the alerts for creation or errors 
                    


                    if ($showAlert) {
                        echo '
                                  <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <strong>SUCCESS!! </strong>Your account is created. Now you can login to our WebSite.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div>';
                        // header('Location: ./addemployee.php');
                    }
                    if ($showError) {
                        echo '      <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                 <strong>Error!! </strong>Your account is not created.
                                 <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                 </div>';
                    }

                    $sql = "SELECT * FROM `empdetails` ";
                    $result = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo " <tr>
                        <th scope='row'>" . $row['empid'] . "</th>
                        <td>" . $row['name'] . "</td>
                        <td>" . $row['address'] . "</td>
                        <td>" . $row['phoneno'] . "</td>
                        <td>" . $row['email'] . "</td>
                        <td>" . $row['department'] . "</td>
                        <td> Actions </td>
                        </tr>";
                        // echo $row['empid'] . "Name is: " . $row['name'] . "Address is: " . $row['address'] . "Phone no is:" . $row['phoneno'] . "E-mail is:" . $row['email'] . "Department is:" . $row['department'];
                        echo '<br>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- entering employee details  -->
        <div class="container ">
            <div class="container  ">
                <form text-center method="POST" action="./index.php">
                    <h2 align="center">Enter the details</h2>
                    <div class="mb-3 my-5">
                        <label for="name" class="form-label">Employee Name</label>
                        <input type="varchar" class="form-control" id="name" name="name">
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Address</label>
                        <input type="varchar" class="form-control" id="address" name="address">
                    </div>
                    <div class="mb-3">
                        <label for="phoneno" class="form-label">Phone No.</label>
                        <input type="bigint" class="form-control" id="phoneno" name="phoneno">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="department" class="form-label">Department</label>
                        <input type="text" class="form-control" id="department" name="department">
                        <div id="help" class="form-text">Make sure the records are correct.
                            <br>
                            <button type="submit" class="btn btn-primary ">Submit</button>
                            <button type="button" class="btn btn-warning ">Cancel</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
            crossorigin="anonymous"></script>
</body>

</html>