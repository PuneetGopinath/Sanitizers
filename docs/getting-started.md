<h2 align="center">BK Sanitizers Docs - Getting Started</h2>

<link rel="stylesheet" href="https://puneetgopinath.github.io/css/main.css" />

Get started with BK Sanitizers, the library for sanitizing all types of user input in PHP.

## Introduction

A Web Sanitizer is used to prevent XSS attacks. Not only sanitizing user input is enough to prevent XSS, we also need to validate all sanitized user input.

Sanitization is one of the most important topic of web security or cybersecurity.

BKS is one such library for protecting your site from XSS. We aim to give you the best protection ever we can.

We try to cover all types of user input like name, username, password, messages, email, etc...

Have we missed any common type of user input? If so, please try to read the contributing guidelines and try to contribute to BK Sanitizers.

## Installation

Installation guide can be read in [INSTALL.md](https://github.com/PuneetGopinath/Sanitizers/blob/main/INSTALL.md) file.

## Starter template

A basic template for sanitizing user input with BK Sanitizers.

If you are using composer, then replace `require_once "src/BKS.auto.php";` with `require_once "vendor/autoload.php";`.

```php
<?php
// Import classes
use Sanitizers\Sanitizers\Sanitizer;

require_once "src/BKS.auto.php";

// passing `true` in Sanitizer class enables exceptions
$sanitizer = new Sanitizer(true);
try {
    $username = $sanitizer->sanitize("username", $_GET["username"]);
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    echo $e->getMessage();
}
//Do anything with $username, e.g. validate it, save it to database ...
?>
```

## Steps to start using BKS

1. Loading classes

```
use Sanitizers\Sanitizers\Sanitizer;
```

 * without composer autoload:

Replace **/path/to/src/BKS.auto.php** with path to **src/BKS.auto.php** file in the code below.

```
require_once "/path/to/src/BKS.auto.php";
```

 * with composer autoload:

Replace **/path/to/vendor/autoload.php** with path to **vendor/autoload.php** file in the code below.

```
require_once "/path/to/vendor/autoload.php";
```

2. Then, Sanitize input (also add configFromIni if you want to use configuration settings from ini file).<br>

Add `$sanitizer->configFromIni("src/config.ini");` if you want to use config settings from a ini file after defining `$sanitizer` variable.

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

If you want to sanitize arrays then use `sanitizeArray($array, $filters);`, See [FUNCTIONS.md](FUNCTIONS.md) file for understanding sanitizeArray function.

Plz read [SUPPORT.md](https://github.com/PuneetGopinath/Sanitizers/blob/main/.github/SUPPORT.md) if you want to ask questions or clarify doubts.

If you want to use `psr/log` for debugging, Then create a new logger in a variable `$logger` (e.g. `$logger = new myPsr3Logger();`), then pass the `$logger` variable in parameter #2 while constructing Sanitizer class.<br>
Example:
```
$logger = new myPsr3Logger();
$sanitizer = new Sanitizer(false, $logger);
```

You will find more to play with in the [examples](https://github.com/PuneetGopinath/Sanitizers/tree/main/examples) folder.

---------------------------------------------------------------------

[Back to home](README.md)
