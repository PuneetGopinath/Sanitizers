<?php
use Sanitizers\Sanitizers\Sanitize;
require_once("../src/Sanitizers.php");

if (isset($_POST["Submit"]))
{
    $sanitize = new Sanitize();
    $username = $sanitize->sanitize("username", $_POST["username"]);
    $password = $sanitize->sanitize("password", $_POST["password"]);

    // Now use variables $username, $password for user form inputs...
    print_r(array("username" => $username, "password" => $password, "Sanitize" => $sanitize, "_POST" => $_POST)); //Testing
    // Check in Database, Send email, etc...
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- meta tags, head content... -->
        <link rel="stylesheet" href="main.css" />
    </head>
    <body>
        <p>Login Form</p>
        <form class="form-control" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label class="form-text" for="username">Username:</label><br>
            <input required class="form-input" type="text" name="username" /><br><br>
            <label class="form-text" for="password">Password:</label><br>
            <input required class="form-input" type="password" name="password" />
            <!-- Extra input tags like CSRF Protection, password validation, etc... -->
            <input required class="btn btn-primary" type="submit" name="Submit" value="Login" />
        </form>
    </body>
</html>
