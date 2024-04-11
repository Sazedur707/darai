<?php

if (isset($_POST['name'], $_POST['comment'])) {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "diary";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check for connection errors
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $name = $_POST['name'];
    $comment = $_POST['comment'];
    

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO $tableName (name, comment) VALUES (?, ?)");

    // Bind the parameters and execute the statement
    $stmt->bind_param("ssss", $name, $comment);

     $conn->close();
}
?>