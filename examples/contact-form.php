<?php
require_once("Sanitizers.php");
use Sanitizers\Sanitizers\Sanitizer;

if (isset($_POST['Submit']))
{
    $sanitize = new Sanitizer();
    $name = $sanitize->Name($_POST['name']);
    $email = $sanitize->Email($_POST['email']);
    $message = $sanitize->clean($_POST['message'], /*trim=*/false, /*maxInputLength*/5000);

    // No need to sanitize dept because it's value is given by us only
    // Now use variables $name, $email, $message for user inputs...
    // Check in Database, Send email, etc...
}

?>
<!DOCTYPE html>
<html>
    <head>
        <!-- meta tags, head content... -->
    </head>
    <body>
        <p>Contact us!</p>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <label for="name">Name:</label><br>
            <input type="text" name="name"><br><br>
            <label for="email">Email address:</label><br>
            <input type="email" name="email"><br><br>
            <label for="message">Message:<b>Note: if more than 5000 letters, then extra letters will be removed</b></label><br>
            <textarea name="message" rows="8" cols="20"></textarea><br><br>
            <label for="dept">Send query to department:</label>
            <select name="dept" id="dept">
                <option value="sales">Sales</option>
                <option value="support" selected="true">Technical support</option>
                <option value="accounts">Accounts</option>
            </select><br>
            <input type="submit" name="Submit" value="Send Email">
        </form>
    </body>
</html>
