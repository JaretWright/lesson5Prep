<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https:css/bootstrap-theme.min.css">
</head>
<body>
<main class="container">
    <h1>Login</h1>
    <?php
        if (!empty($_GET['invalid']))
            echo '<div class="alert alert-danger" id="message">Invalid user name or password</div>';
        else
            echo '<div class="alert alert-info" id="message">Please log into your account</div>';
    ?>
    <form method="post" action="validate.php">
        <fieldset class="form-group">
            <label for="email" class="col-sm-1">Email:</label>
            <input name="email" id="email" required type="email" placeholder="Email" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-1">Password:</label>
            <input type="password" name="password" id="password"   required />
        </fieldset>
        <button class="btn btn-success col-sm-offset-1">Login</button>
    </form>
</main>
</body>
<!-- Latest jQuery -->
<script src="js/jquery-3.2.1.min.js"></script>

<!-- Latest compiled and minified JavaScript -->
<script src="js/bootstrap.min.js"></script>

<!-- custom js -->
<script src="js/app.js"></script>

</html>
