<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Album Details</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="css/bootstrap-theme.min.css">

    </head>
<body>
    <main class="container">
        <h1>Album Details</h1>

        <?php
            // check the URL for an albumId in case the user clicked the edit button
            $albumID = $_GET['albumid'];
            $title = null;
            $year = null;
            $artist = null;
            $cover = null;

            //need to decide if this is a new album or an edit situation
            if (!empty(@$albumID))
            {
                //connect to the DB
                $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');
                //write the SQL command
                $sql = "SELECT * FROM albums WHERE albumID = :albumID";

                //prep the SQL command
                $cmd = $conn->prepare($sql);
                $cmd->bindParam(':albumID', $albumID, PDO::PARAM_INT);

                //execute the SQL command
                $cmd->execute();

                //fetch the results
                $album = $cmd->fetch();

                //drop the connection
                $conn=null;

                //update the variables
                $title = $album['title'];
                $year = $album['year'];
                $artist = $album['artist'];
                $albumGenre = $album['genre'];
                //$cover = $album['cover'];
            }

        ?>

        <form method="post" action="saveAlbum.php">
            <fieldset class="form-group">
                <label for="title" class="col-sm-1">Title: *</label>
                <input name="title" id="title" required placeholder="Album title"
                    value="<?php echo $title?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="year" class="col-sm-1">Year:</label>
                <input name="year" id="year" type="number" min="1900" placeholder="Release Year"
                       value="<?php echo $year?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="artist" class="col-sm-1">Artist: *</label>
                <input name="artist" id="artist" required placeholder="Artist Name"
                       value="<?php echo $artist?>"/>
            </fieldset>

            <fieldset class="form-group">
                <label for="genre" class="col-sm-1">Genre: *</label>
                <select name="genre" id="genre">
                    <?php
                        //connect to the DB
                        $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');

                        //create a query
                        $sql = "SELECT genre FROM genres ORDER BY genre";

                        //prep the query
                        $cmd = $conn->prepare($sql);

                        //execute the command
                        $cmd->execute();
                        $genres = $cmd->fetchAll();

                        foreach ($genres as $genre)
                        {
                            if ($albumGenre == $genre['genre'])
                            {
                                echo '<option selected>'.$genre['genre'].'</option>';
                            }
                            else
                            {
                                echo '<option>'.$genre['genre'].'</option>';
                            }
                        }

                        //close the connection
                        $conn = null;
                    ?>
                </select>
            </fieldset>
            <input name="albumID" id="albumID" value="<?php echo $albumID; ?>" type="hidden"/>
            <button class="btn btn-success col-sm-offset-1">Save</button>


        </form>

    </main>


</body>

    <!-- Latest compiled and minified JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</html>
