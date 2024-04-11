<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Entries</title>
</head>
<body>

<style>
    .fixed-container {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        z-index: 9999;
        background-color: green;
        color: white;
    }

    .top {
        padding: 3px 4px;
    }

    .toptow {
        text-align: center;
        padding: 10px 4px;
        background-color: rgb(48, 253, 48);
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

<div class="fixed-container">
    <div class="top">
        <div class="logo" style="margin: 10px;">
            <h1>
                <span style="font-family: 'Courier New', Courier, monospace !important;">DaiRai:</span>
                <span style="font-size: 20px; font-family: 'Trebuchet MS', 'Lucida Sans Unicode', 'Lucida Grande', 'Lucida Sans', Arial, sans-serif !important;">Entries</span>
            </h1>
        </div>
    </div>

    <div class="toptow">
        <div class="buttons">
        <a href="index.html">Home</a>
            <a href="add-entries.php">New Entry</a>
            <a href="entries.php">Entries</a>
            <a href="About.html">About</a>
        </div>
    </div>
</div>


<div class="final-wrapper">
<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "diary";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "Select * from `entries`";
$result = mysqli_query($conn, $sql);
if($result){
    while($row=mysqli_fetch_assoc($result)){
        $id = $row['id'];
        $name = $row['name'];
        $contact = $row['contact'];
        $title = $row['title'];
        $entry = $row['entry'];
        $dt = $row['dt'];
        $tableName = "user_".$id;

        if(isset($_POST['name'],$_POST['comment'])){
            $name = $_POST['name'];
            $comment = $_POST['comment'];
           
        
            // Prepare the SQL statement
            $stmt = $conn->prepare("INSERT INTO `$tableName` (name, comment) VALUES (?, ?)");
        
            // Bind the parameters and execute the statement
            $stmt->bind_param("ss", $name, $comment);
            echo $tableName;
            if ($stmt->execute()) {
                sleep(2);}
                // Close the statement and database connection
            $stmt->close();

        
        }

        echo '<div class="entry-box-wrapper"><div class="entry-box">';
        echo $id."<br>";
        echo "<strong style='font-size:18px;'>".$name."</strong><br>";
        echo "<span style='font-size:10px; '>Entry: ".$dt.'<br></span>';
        echo "<span style = 'font-size: 11px; '>Contact: ".$contact."</span><br><br>";
        echo "<span style='color:green; font-size: 20px'>".$title."</span><br>";
        echo $entry .'<br>'; 
        
        echo '<br><br><br>';
        echo'<style>
        
        .container {
        width: 310px;
        //   padding: 20px;
        margin: 0 auto;
        }
        
        
        .title {
        font-size: 19px;
        font-weight: bold;
        margin-bottom: 20px;
        }
        
        .comment-container {
        margin-bottom: 20px;
        padding: 7px;
        background-color: #f5f5f5;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        
        
        .comment-header {
        font-weight: bold;
        margin-bottom: 5px;
        }
        
        
        .comment-body {
        margin-bottom: 10px;
        }
        
       
        .comment-footer {
        font-size: 12px;
        color: #888;
        }
        
        
        .comment-form {
        margin-bottom: 20px;
        }
        
        .comment-form input[type="text"],
        .comment-form textarea {
        display: block;
        width: 300px;
        padding: 10px;
        margin-bottom: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-family: Arial, sans-serif;
        font-size: 14px;
        }
        
        .comment-form button {
        background-color: green;
        color: #fff;
        border: none;
        cursor: pointer;
        padding: 10px;
        border-radius: 5px;
        //   font-family: Arial, sans-serif;
        font-size: 14px;
        }
    </style>
    </head>
    <body>
    <div class="container">
        <div class="title">Comments</div>
        
        <div class="comment-container">
        <div class="comment-header">John Doe</div>
        <div class="comment-body"></div>
        <div class="comment-footer">June 10, 2023</div>
        </div>
        
        
        
        <!-- Comment form -->
        <form class="comment-form" action="entries.php" method="post">
        <input type="text" name="name" placeholder="Your Name">
        <textarea name="comment" placeholder="Write your comment here"></textarea>
        <button type="submit">Add Comment</button>
        </form>
    </div>';
    echo "<br></div></div>";
    echo "</div>";

    }
}

?>
    </div>
</body>
</html>

<style>
    *{
        margin: 0;
    }
    .final-wrapper{
        /* border:1px solid black; */
        margin-top: 130px;

    }
    .entry-box-wrapper{
        /* text-align: center; */
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
    }
    .entry-box{
        -webkit-box-shadow: 0px 0px 67px 0px rgba(227,223,227,1);
        -moz-box-shadow: 0px 0px 67px 0px rgba(227,223,227,1);
        box-shadow: -1px 5px 6px 0px rgb(0 0 0);
        width: 310px;
        margin-top: 10px;
        margin-bottom: 10px;
        padding: 10px 21px;
        border:1px solid green;
}
</style>