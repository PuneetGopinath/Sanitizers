<?php

/**
 * This example shows how to use Sanitizers in a registration form
 */

//Import Sanitizer class into the global namespace
use Sanitizers\Sanitizers\Sanitizer;

require "../src/Sanitizers.php";

if (isset($_POST["Submit"]))
{
    $sanitizer = new Sanitizer();
    $name = $sanitizer->Name($_POST["name"]);
    $email = $sanitizer->Email($_POST["email"]);
    $username = $sanitizer->Username($_POST["username"]);
    $password = $sanitizer->Password($_POST["password"]);

    // Now use variables $name, $email, $username, $password for user form inputs (name, email, username, password respectively)...
    print_r(array("name" => $name, "email" => $email, "username" => $username, "password" => $password, "Sanitize" => $sanitizer, "_POST" => $_POST)); //Testing
    // Save to Database, Send email, etc...
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <!-- meta tags, head content... -->
    </head>
    <body>
        <p>Registration Form</p>
        <form class="form-control" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label class="form-text" for="name">Your Full Name:</label><br>
            <input required class="form-input" type="text" name="name" /><br><br>
            <label class="form-text" for="email">Email Address:</label><br>
            <input required class="form-input" type="email" name="email" /><br><br>
            <label class="form-text" for="username">Username:</label><br>
            <input required class="form-input" type="text" name="username" /><br><br>
            <label class="form-text" for="password">Password:</label><br>
            <input required class="form-input" type="password" name="password" />
            <!-- Extra input tags like password validation, etc... -->
            <input required class="btn btn-primary" type="submit" name="Submit" value="Create Account" />
        </form>
    </body>
</html>
