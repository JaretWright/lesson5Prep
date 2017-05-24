<?php
    ob_start();
?>
<!-- if getting the error "headers already sent"  use ob_start and ob_flush -->
<!-- ob_start() will capture all the HTML until it reaches the ob_flush() -->
<!-- "ob" stands for "output buffer" -->

<!DOCTYPE html>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Delete Album</title>
</head>
<body>
<?php

    $albumID = $_GET['albumid'];

    if (!empty($albumID) && is_numeric($albumID)) {

        //connect to the DB
        $conn = new PDO('mysql:host=localhost;dbname=php', 'root', 'admin');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // turn on the error handling


        //create the SQL statement
        $sql = "DELETE FROM albums WHERE albumID = :albumID";

        //prepare the SQL statement
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':albumID', $albumID, PDO::PARAM_INT);

        //execute the SQL statement
        $cmd->execute();

        //disconnect from the DB
        $conn = null;

        //redirect to the albums page
        header('location:albums.php');
    }
?>
</body>
</html>

<?php ob_flush(); ?>
