<link rel="stylesheet" href="docs/css/main.css" />

# Install BK Sanitizers

## Table of Contents

 * [Prerequisites](#prerequisites)
 * [Installing Sanitizers](#install)

<h2><a name="prerequisites">Prerequisites</a></h2>

To install BK Sanitizers, you will need:
 * Minimum PHP 5.4.0 compiler
 * PHP filter extension (commonly it is pre installed)
 * If you want to encode strings then; you need php mbstring, iconv extensions

<h2><a name="install">Installing Sanitizers</a></h2>

1. Install source code

 * Installing from composer:
> Run `composer require sanitizers/sanitizers`
> OR
> Add this line to the require key **composer.json** file. `"sanitizers/sanitizers": "^1.0"`

 * Installing from github:
> [Download source code from releases page](https://github.com/PuneetGopinath/Sanitizers/releases/)
> Extract files to your project's folder

2. Edit src/bootstrap.php or src/config.ini if you want to modify config options
3. If you are going to use src/config.ini, Then add this line to your php app before sanitizing any user input `$sanitizer->configFromIni("path/to/src/config.ini");`
4. Now sanitize user input !!