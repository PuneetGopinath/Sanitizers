<div class="card">
  <p align="center">
    <a href="https://puneetgopinath.github.io/Sanitizers"><img src="images/Sanitizers-logo-transparent.png" alt="Sanitizers logo" style="width:300;height:300;"></a>
  </p>
  <h2 align="center">Sanitizers Docs</h2>
    Latest release: <img alt="GitHub release (latest by date)" src="https://img.shields.io/github/v/release/PuneetGopinath/Sanitizers">
</div>

<link rel="stylesheet" href="css/main.css" />

### Steps
First require the **Sanitizers.php** file.<br>
**Note:** The file from where you are including **Sanitizers.php** should contain the file **config.php** in the directory where **Sanitizers.php** exists.

And replace **path/to/src/Sanitizers.php** with path to **src/Sanitizers.php** file.

```
use Sanitizers\Sanitizers\Sanitize;

require_once("path/to/src/Sanitizers.php");
```

Then, Sanitize the input.<br>
For example,<br>
```
// passing `false` in Sanitizer class disables exceptions
$sanitize = new Sanitize(false);
$username = $sanitize->sanitize("username", $_POST['username']);
$password = $sanitize->sanitize("password", $_POST['password']);
```

<b><p align="center">OR</p></b>

```
// passing `true` in Sanitizer class enables exceptions
$sanitize = new Sanitize(true);

try {
    $username = $sanitize->sanitize("username", $_POST["username"]);
    $password = $sanitize->sanitize("password", $_POST["password"]);
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    var_dump($e);
}
```

You can understand more by seeing [examples](https://github.com/PuneetGopinath/Sanitizers/tree/main/examples) folder in github.

Also see [FUNCTIONS.md](FUNCTIONS.md)