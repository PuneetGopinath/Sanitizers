<h2 align="center">BK Sanitizers Docs - Getting Started</h2>

<link rel="stylesheet" href="../css/main.css" />

## Introduction

Get started with BK Sanitizers, the library for sanitizing all types of user input in php.

Sanitizers is used to prevent attacks like XSS. Sanitization is one of the most important topic of web security or cybersecurity.

BKS is one such library for protecting your site from XSS. We aim to give you the best protection ever we can.

### Installation

Installation guide can be read in [INSTALL.md](https://github.com/PuneetGopinath/Sanitizers/blob/main/INSTALL.md) file.

### Starter template

If you are using composer, then replace `require "src/Sanitizers.php";` with `require "vendor/autoload.php";`

```php
<?php
// Import classes
use Sanitizers\Sanitizers\Sanitizer;

require "src/Sanitizers.php";

// passing `true` in Sanitizer class enables exceptions
$sanitizer = new Sanitizer(true);
try {
    echo $sanitizer->sanitize("username", $_GET["username"]);
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    echo $e->getMessage();
}
?>
```

### Steps to start using BKS

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

If you want to sanitize full array then use `sanitizeArray($array, $filters);`, See [FUNCTIONS.md](FUNCTIONS.md) file for more info.

Plz read [SUPPORT.md](https://github.com/PuneetGopinath/Sanitizers/blob/main/.github/SUPPORT.md) for asking questions and doubts.

If you want to use `psr/log` for debugging, Then create a new logger in a variable `$logger`, then run `$sanitizer = new Sanitizer(/*bool exceptions*/, $logger);`

You will find more to play with in the [examples](https://github.com/PuneetGopinath/Sanitizers/tree/main/examples) folder.

[Back to home](README.md)
