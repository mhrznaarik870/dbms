<!DOCTYPE html>
<html>

<head>
    <title>Login</title>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<body>
    <?php
    // Define the correct username and password
    $correctUsername = "admin";
    $correctPassword = "password";

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the entered username and password from the form
        $enteredUsername = $_POST["username"];
        $enteredPassword = $_POST["password"];

        // Check if the entered credentials match the correct credentials
        if ($enteredUsername == $correctUsername && $enteredPassword == $correctPassword) {
            // Redirect to the employee_list.php page
            header("Location: employee_list.php");
            exit();
        } else {
            // Display an error message using JavaScript alert
            echo '<script>alert("The username or the password is incorrect. Please try again!");</script>';
        }
    }
    ?>


    <div class="container text-center col-md-3">
        <div class="login-box">
            <h2>Login</h2>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required class="form-control">
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" required class="form-control">
                </div>
                <button type="submit" class="login-btn btn btn-primary mt-3">Login</button>
            </form>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>

</html>