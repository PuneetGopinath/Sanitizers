<div class="card">
  <h2 align="center">BK Sanitizers Docs</h2>
    Latest release: <img alt="GitHub release (latest by date)" src="https://img.shields.io/github/v/release/PuneetGopinath/Sanitizers">
</div>

<link rel="stylesheet" href="css/main.css" />

### Steps

1. Loading classes

```
use Sanitizers\Sanitizers\Sanitizer;
```

 * without composer autoload:

Replace **/path/to/src/Sanitizers.php** with path to **src/Sanitizers.php** file in the code below.

```
require "/path/to/src/Sanitizers.php";
```

 * with composer autoload:

Replace **/path/to/vendor/autoload.php** with path to **vendor/autoload.php** file in the code below.

```
require "/path/to/vendor/autoload.php";
```

2. Then, Sanitize input.<br>
For example,<br>

```
// passing `false` in Sanitize class disables exceptions
$sanitizer = new Sanitizer(false);
$username = $sanitizer->sanitize("username", $_POST['username']);
$password = $sanitizer->sanitize("password", $_POST['password']);
```

<b>OR if you want to enable exceptions</b>

```
// passing `true` in Sanitize class enables exceptions
$sanitizer = new Sanitizer(true);

try {
    $username = $sanitizer->sanitize("username", $_POST["username"]);
    $password = $sanitizer->sanitize("password", $_POST["password"]);
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    var_dump($e);
}
```

If you want to sanitize full array then use `sanitizeArray($array, $filters);`, See `FUNCTIONS.md` file for more info.

If you want to use `psr/log` for debugging, Then create a new logger in a variable `$logger`, then run `$sanitizer = new Sanitizer(/*bool exceptions*/, $logger);`

You will find more to play with in the [examples](https://github.com/PuneetGopinath/Sanitizers/tree/main/examples) folder.

For understaning functions, see [FUNCTIONS.md](FUNCTIONS.md).
