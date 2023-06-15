<?php
function OpenCon()
{
    $servername = "localhost";
    $username = "root";
    $password = '';
    $db = "empdirectory";

    $conn = new mysqli($servername, $username, $password, $db);

    if ($conn->connect_error) {
        die("Connection failed! " . $conn->connect_error);
    }
    return $conn;

}
function CLoseCon($conn)
{
    $conn->close();

}
?>