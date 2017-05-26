<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Validating User</title>
</head>
<body>
<?php
    $email = $_POST['email'];
    $password = $_POST['password'];

    //Connect to the DB & get the user info
    $conn = new PDO('mysql:host=localhost;dbname=php','root','admin');
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT email, password FROM users WHERE email=:email";
    $cmd=$conn->prepare($sql);
    $cmd->bindParam(':email',$email, PDO::PARAM_STR, 100);
    $cmd->execute();
    $user = $cmd->fetch();

    //check for a valid user
    if (password_verify($password, $user['password']))
    {
        session_start();
        $_SESSION['userID'] = $user['email'];
        $_SESSION['username'] = $email;
        header('location:albums.php');
    }
    else
    {
        echo 'failed login <br />';
        header('location:login.php?invalid=true');
    }
?>
</body>
</html>
