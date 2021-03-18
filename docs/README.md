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
$username = $sanitizer->Username($_POST['username']);
$password = $sanitizer->Password($_POST['password']);
```

<b>OR if you want to enable exceptions</b>

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
