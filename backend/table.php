<?php
include 'function.php';

//Create the connetion
$conn = OpenCon();
//sql to create table
$sql = "CREATE TABLE empdetails (
    empid INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name  VARCHAR(30) NOT NULL,
    address VARCHAR(20) NOT NULL,
    phoneno BIGINT(10),
    email VARCHAR(50),
    department VARCHAR(20),
    Reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    )";

if ($conn->query($sql) === TRUE) {
  echo "Table created successfully";
} else {
  echo "Error creating table! " . $conn->error;
}
CloseCon($conn);
?>