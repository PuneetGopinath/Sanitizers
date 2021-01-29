<?php
use Sanitizers\Sanitizers\Sanitize;
require_once("../src/Sanitizers.php");

if (isset($_POST["Submit"]))
{
    $sanitize = new Sanitize();
    $code = $sanitize->sanitize("hex", $_POST["code"]);

    // Now use variable $code for the code...
    print_r(array("code" => $code, "Sanitize" => $sanitize, "_POST" => $_POST)); //Testing
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
        <p>Confirm Registration</p>
        <form class="form-control" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label class="form-text" for="code">Code:</label><br>
            <input required class="form-input" type="password" name="code" />
            <!-- Extra input tags like CSRF Protection, etc... -->
            <input required class="btn btn-primary" type="submit" name="Submit" value="Confirm Registration" />
        </form>
    </body>
</html>
