<?php

/**
 * This example shows how to use Sanitizers in a login form
 */

//Import Sanitizer class into the global namespace
use Sanitizers\Sanitizers\Sanitizer;

require "../src/Sanitizers.php";

if (isset($_POST["Submit"]))
{
    $sanitizer = new Sanitizer();
    $username = $sanitizer->sanitize("username", $_POST["username"]);
    $password = $sanitizer->sanitize("password", $_POST["password"]);

    // Now use variables $username, $password for user form inputs...
    print_r(array("username" => $username, "password" => $password, "Sanitizer" => $sanitizer, "_POST" => $_POST)); //Testing
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
