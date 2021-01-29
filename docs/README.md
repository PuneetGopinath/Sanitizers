# Sanitizers Docs

<p align="center"><i><u>v1.0.1</u></i></p><br>

First require the **Sanitizers.php** file.<br>
**Note:** the file from where you are including **Sanitizers.php** should contain the file **config.php** in the directory where **Sanitizers.php** exists.

And replace **path/to/Sanitizers.php** with path to **Sanitizers.php** file.

```
use Sanitizers\Sanitizers\Sanitizer;
require_once("path/to/Sanitizers.php");
```

Then, Sanitize the input.<br>
For example,<br>
```
\\ passing `false` in Sanitizer class disables exceptions
$sanitize = new Sanitizer(false);
$username = $sanitize->Username($_POST['username']);
$password = $sanitize->Hex($_POST['password']);
```

<hr><b><p align="center">OR</p></b><hr>

```
\\ passing `true` in Sanitizer class enables exceptions
$sanitize = new Sanitizer(true);

try {
    $username = $sanitize->Username($_POST['username']);
    $password = $sanitize->Hex($_POST['password']);
} catch (Exception $e) {
    echo "Could not Sanitize user input. Error: " . $e;
}
```

You can understand more by seeing [examples](https://github.com/PuneetGopinath/Sanitizers/tree/main/examples) folder in github.
