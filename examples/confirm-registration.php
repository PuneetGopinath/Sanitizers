<?php
require_once("Sanitizers.php");
use Sanitizers\Sanitizers\Sanitizer;

if (isset($_POST['Submit']))
{
    $sanitize = new Sanitizer();
    $code = $sanitize->Hex($_POST['code']);

    // Now use variable $code for the code...
    // Check in Database, Send email, etc...
}

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- meta tags, head content... -->
    </head>
    <body>
        <p>Confirm Registration</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="code">Code:</label><br>
            <input type="password" name="code" />
            <!-- Extra input tags like CSRF Protection, etc... -->
            <input type="submit" name="Submit" value="Confirm Registration" />
        </form>
    </body>
</html>
