<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Saving Album...</title>
</head>

<body>
<?php
    $title = $_POST['title'];
    $year = $_POST['year'];
    $artist = $_POST['artist'];

    echo 'title: '.$title.'<br />';
    echo 'year: '.$year.'<br />';
    echo 'artist: '.$artist.'<br />';

    //step 1 - connect to the database
    $conn = new PDO('mysql:host=localhost;dbname=php',
                'root', 'admin');

    //step 2 - create the SQL command to INSERT a record
    $sql = "INSERT INTO albums (title, year, artist) VALUES (:title, :year, :artist);";


    //step 3 - prepare the SQL command and bind the arguments to prevent SQL injection
    $cmd = $conn->prepare($sql);
    $cmd->bindParam(':title', $title, PDO::PARAM_STR, 50);
    $cmd->bindParam(':year', $year, PDO::PARAM_INT, 4);
    $cmd->bindParam(':artist', $artist, PDO::PARAM_STR, 50);

    //step 4 - execute
    $cmd->execute();

    //step 5 - disconnect from database
    $conn = null;

    //step 6 - redirect to the albums page
    header('location:albums.php');
?>
</body>

</html>
