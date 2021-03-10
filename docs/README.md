<div class="card">
  <h2 align="center">Sanitizers Docs</h2>
    Latest release: <img alt="GitHub release (latest by date)" src="https://img.shields.io/github/v/release/PuneetGopinath/Sanitizers">
</div>

<link rel="stylesheet" href="css/main.css" />

### Steps
First require the **Sanitizers.php** file.<br>

And replace **/path/to/src/Sanitizers.php** with path to **src/Sanitizers.php** file.

1. Loading classes
```
use Sanitizers\Sanitizers\Sanitizer;

require "/path/to/src/Sanitizers.php";
```

2. Then, Sanitize the input.<br>
For example,<br>
```
// passing `false` in Sanitize class disables exceptions
$sanitizer = new Sanitizer(false);
$username = $sanitizer->sanitize("username", $_POST['username']);
$password = $sanitizer->sanitize("password", $_POST['password']);
```

<b>OR</b>

```
// passing `true` in Sanitize class enables exceptions
$sanitizer = new Sanitizer(true);

try {
    $username = $sanitizer->Username($_POST["username"]);
    $password = $sanitizer->Password($_POST["password"]);
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    var_dump($e);
}
```

You will find more to play with in the [examples](https://github.com/PuneetGopinath/Sanitizers/tree/main/examples) folder.

For understaning functions, see [FUNCTIONS.md](FUNCTIONS.md).