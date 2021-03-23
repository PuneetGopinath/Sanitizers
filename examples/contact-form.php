<?php

/**
 * This example shows how to use Sanitizers in a contact form
 */

//Import Sanitizer class into the global namespace
use Sanitizers\Sanitizers\Sanitizer;

require "../src/Sanitizers.php";

if (isset($_POST["Submit"]))
{
    $sanitizer = new Sanitizer();
    $name = $sanitizer->sanitize("name", $_POST["name"]);
    $email = $sanitizer->sanitize("email", $_POST["email"]);
    $sanitizer->set("maxInputLength", 5000);
    $message = $sanitizer->clean($_POST["message"], false, false, false, false);
    $dept = $sanitizer->sanitize("text", $_POST["dept"]);

    // Now use variables $name, $email, $message, $dept for user inputs...
    print_r(array("name" => $name, "email" => $email, "message" => $message, "dept" => $dept, "Sanitizer" => $sanitizer, "_POST" => $_POST)); //Testing
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
        <p>Contact us!</p>
        <form class="form-control" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <label class="form-text" for="name">Name:</label><br>
            <input required class="form-input" type="text" name="name"><br><br>
            <label class="form-text" for="email">Email address:</label><br>
            <input required class="form-input" type="email" name="email"><br><br>
            <label class="form-text" for="message">Message:<b>Note: if more than 5000 letters, then extra letters will be removed</b></label><br>
            <textarea class="form-input" name="message" rows="8" cols="20"></textarea><br><br>
            <label class="form-text" for="dept">Send query to department:</label>
            <select class="form-select" name="dept" id="dept">
                <option value="sales">Sales</option>
                <option value="support" selected="true">Technical support</option>
                <option value="accounts">Accounts</option>
            </select><br>
            <input required class="btn btn-primary" type="submit" name="Submit" value="Send Email">
        </form>
    </body>
</html>
