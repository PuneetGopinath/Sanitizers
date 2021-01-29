<?php
require_once("Sanitizers.php");
use Sanitizers\Sanitizers\Sanitizer;

if (isset($_POST['Submit']))
{
    $sanitize = new Sanitizer();
    $username = $sanitize->Username($_POST['username']);
    $password = $sanitize->Hex($_POST['password']);

    // Now use variables $username, $password for user form inputs...
    // Check in Database, Send email, etc...
}
?>
<!DOCTYPE html>
<html>
    <head>
        <!-- meta tags, head content... -->
    </head>
    <body>
        <p>Login Form</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="username">Username:</label><br>
            <input type="text" name="username" /><br><br>
            <label for="password">Password:</label><br>
            <input type="password" name="password" />
            <!-- Extra input tags like CSRF Protection, etc... -->
            <input type="submit" name="Submit" value="Login" />
        </form>
    </body>
</html>
