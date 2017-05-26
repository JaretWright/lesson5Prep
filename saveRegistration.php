<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Save Registration</title>
</head>
<body>
<?php
    //the client side validation is complete, so now we perform
    //server side validation as well in case someone just sends a URL instead
    //of navigating to the page
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];
    $ok = true;

    if (empty($email)){
        echo 'email must be populated <br />';
        $ok=false;
    }


    if (strlen($password) < 8){
        echo 'password must be at least 8 characters';
        $ok = false;
    }


    if ($password != $confirm){
        echo 'passwords do not match <br />';
        $ok = false;
    }

    //if the email and passwords passed all the tests
    if ($ok)
    {
        //Step 1 - connect to the DB
        $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //Step 2 - write the SQL statement
        $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";

        //Step 3 - hash the password
        $password = password_hash($password, PASSWORD_DEFAULT);

        //Step 3 - prepare and execute the SQL
        $cmd = $conn->prepare($sql);
        $cmd->bindParam(':email',$email, PDO::PARAM_STR, 100);
        $cmd->bindParam(':password',$password, PDO::PARAM_STR, 255);

        try{
            $cmd->execute();
        }
        catch (Exception $e){
            if (strpos($e->getMessage(), 'Integrity constraint violation: 1062') == true)
            {
                header('location:registration.php?errorMessage=email-already-exists');
            }
        }


        //Step 4 - close the DB connection
        $conn = null;

        //Step 5 - redirect to a login page
        header('location:login.php');
    }

?>
</body>
</html>
