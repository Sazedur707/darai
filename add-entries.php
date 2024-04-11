<?php

if (isset($_POST['name'], $_POST['entry'])) {
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
    $contact = $_POST['contact'];
    $title = $_POST['title'];
    $entry = $_POST['entry'];

    // Prepare the SQL statement
    $stmt = $conn->prepare("INSERT INTO entries (name, contact, title, entry) VALUES (?, ?, ?, ?)");

    // Bind the parameters and execute the statement
    $stmt->bind_param("ssss", $name, $contact, $title, $entry);

    if ($stmt->execute()) {
        echo "Data inserted successfully";

        // Get the last inserted ID
        $lastID = $stmt->insert_id;

        // Create the table name
        $tableName = "user_" . $lastID;

        // Create the SQL query to create the table
        $sql = "CREATE TABLE $tableName (
            id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(30) NOT NULL,
            comment VARCHAR(50) NOT NULL,
            dt DATETIME(3)
        )";

        // Echo the last inserted ID
        echo $lastID;

        // Uncomment the following lines if needed
        // ----------------------------------------
        // // Redirect the user after data insertion
        // header("Location: insert-note.html");
        // die;

        // Wait for 3 seconds
        // sleep(3);

        // ----------------------------------------

        // Execute the table creation query
        if ($conn->query($sql) === TRUE) {
            echo "Table '$tableName' created successfully.";
        } else {
            echo "Error creating table: " . $conn->error;
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and database connection
    $stmt->close();
    $conn->close();
}
?>









<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diary</title>
</head>

<body
    style="margin:0px 0px;background-color:aliceblue; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;">
    <div class="top" style="padding:3px 4px;color: white; background-color: green; margin: 0px 0px; ">
        <div class="logo" style="margin: 10px;">
            <h1><span style="font-family:'Courier New', Courier, monospace !important;">DaiRai:</span><span
                    style="font-size: 20px; font-family:'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif !important;">
                    Write your thoughts!</span></h1>
        </div>
    </div>
    <div class="toptow"
        style="display:block; text-align: center; padding:10px 4px;color: white; background-color: rgb(48, 253, 48); margin: 0px 0px; ">
        <div class="buttons">
            <a href="index.html">Home</a>
            <a href="add-entries.php">New Entry</a>
            <a href="entries.php">Entries</a>
            <a href="About.html">About</a>
        </div>
    </div>


    <div class="entry-body" style="text-align: center;">
        <h2 style="margin: 40px 0px; margin-top: 60px;">Enter your entry.</h2>
        <div class="entrybox">
            <form class="entry-form" action="add-entries.php" method="post">
                <input type="text" name="name" placeholder="Name" required><br>
                <input type="text" name="contact" placeholder="Contact link or email address(Optional)"><br>
                <input type="text" name="title" placeholder="Title"><br>
                <textarea type="text" name="entry" placeholder="Your entry here" required
                    style="margin:8px 0px;font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif; padding: 19px 20px; font-size: 15px; height: 400px; width: 310px; box-shadow: 0px 4px 10px black; background-color: rgb(255, 255, 255); border: none;"></textarea><br>
                <button class="btn" type="submit">
                    Share
                </button>
                <div class="php">
                </div>
            </form>
        </div>
    </div>











    <div class="copyright" style="text-align: center; margin-top: 150px; margin-bottom: 40px;">&copy; Saji</div>
</body>
<style>
    * {
        margin: 0;
    }


    .entry-form input {
        font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif;
        padding: 19px 20px;
        font-size: 15px;
        /* height: 400px; */
        width: 310px;
        box-shadow: 0px 2px 7px black;
        background-color: rgb(255, 255, 255);
        border: none;
        margin: 8px 0px;
    }

    .btn {
        border-radius: 5px;
        margin-top: 20px;
        width: 340px;
        background-color: green;
        color: white;
        border: none;
        height: 40px;
        font-size: 18px;
    }

    .btn:hover {
        background-color: red;
        transition: 1s;
        cursor: pointer;
    }

    .buttons a {
        text-decoration: none;
        color: black;
        font-weight: bold;
        background-color: white;
        padding: 4px 10px;
        margin: 2px 2px;
    }

    .buttons a:hover {
        background-color: black;
        color: white;
    }
</style>

</html>











<!-- Lorem ipsum dolor sit amet consectetur adipisicing elit. Enim reprehenderit suscipit ad reiciendis fugiat voluptatem
eum, voluptatibus soluta consequatur mollitia tempore quia? Eveniet beatae, modi dolor, deleniti vel adipisci mollitia
voluptatibus maiores recusandae minus reiciendis nisi culpa quibusdam reprehenderit a aut! Consectetur delectus
perferendis porro quis facilis a, fugit ex! -->