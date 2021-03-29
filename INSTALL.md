<link rel="stylesheet" href="docs/css/main.css" />

# How-to install BK Sanitizers

## Table of Contents

 * [Prerequisites](#prerequisites)
 * [Installing Sanitizers](#installing-sanitizers)

<h2><a name="prerequisites">Prerequisites 📋</a></h2>

To install Sanitizers, you need:

 * #### PHP
Minimum php 5.3.0 compiler.
 * #### PHP Extensions
You need filter and mbstring extension.

If you want to encode strings then; you need php iconv extension also.

<h2><a name="installing-sanitizers">Installing Sanitizers 📥</a></h2>

1. Install source code

Installing from composer:
> Run `composer require sanitizers/sanitizers`

*OR*

> Add this line to your **composer.json** file.

```
"require": {
    "sanitizers/sanitizers": "^1.1"
}
```

Installing from github:
> [Download source code from releases page](https://github.com/PuneetGopinath/Sanitizers/releases/)
> Extract files to your project's folder

2. Edit src/bootstrap.php or src/config.ini if you want to modify default config settings
3. Add `use Sanitizers\Sanitizers\Sanitizer;` in the top of your php file not inside any function, then add `$sanitizer = new Sanitizer();`
4. If you are going to use src/config.ini, Then add this line `$sanitizer->configFromIni("path/to/src/config.ini");` just after `$sanitizer = new Sanitizer();`
5. Now you can sanitize user input !!
