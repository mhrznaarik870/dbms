<?php
include './backend/_dbconnect.php';

// Check if employee ID is provided for deletion
if (isset($_GET['empid'])) {
    $empid = $_GET['empid'];

    // Prepare and execute the SQL delete statement
    $stmt = $conn->prepare("DELETE FROM empdetails WHERE empid=?");
    $stmt->bind_param("i", $empid);

    if ($stmt->execute()) {
        header("Location: index.php?action=deleted");
        exit;
    } else {
        $error = "Error deleting data: " . $conn->error;
    }

    $stmt->close();
}
?>