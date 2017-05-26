<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https:css/bootstrap-theme.min.css">

</head>
<body>
    <main class="container">
    <h1>User Registration</h1>
        <?php
            if (empty($_GET['errorMessage']))
                echo '<div class="alert alert-info" id="message">Please create your account</div>';
            else
                echo '<div class="alert alert-danger" id="message">That email was already taken</div>';
        ?>


    <form method="post" action="saveRegistration.php">
        <fieldset class="form-group">
            <label for="email" class="col-sm-1">Email: </label>
            <input name="email" id="email" required type="email" placeholder="Email" />
        </fieldset>
        <fieldset class="form-group">
            <label for="password" class="col-sm-1">Password: </label>
            <input type="password" name="password" id="password" required placeholder="Password" pattern="(?=.*\d)(?=.*[A-Z].{8,}"/>
            <span id="result"></span>
        </fieldset>
        <fieldset class="form-group">
            <label for="confirm" class="col-sm-1">Email: </label>
            <input type="password" name="confirm" id="confirm" required placeholder="Confirm Password" pattern="(?=.*\d)(?=.*[A-Z].{8,}" />
        </fieldset>
        <button class="btn btn-success btnRegister col-sm-offset-1">Register</button>
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
