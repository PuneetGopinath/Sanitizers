<link rel="stylesheet" href="docs/css/main.css" />

# How-to install Sanitizers

## Table of Contents

 * [Prerequisites](#prerequisites)
 * [Installing Sanitizers](#installing-sanitizers)

<h2><a name="prerequisites">Prerequisites 📋</a></h2>

To install Sanitizers, you need:

 * #### PHP
Minimum php 5.6.0 compiler.
 * #### PHP Extensions
You need filter and mbstring extension.

If you want to encode strings then; you need php iconv extension also.

<h2><a name="installing-sanitizers">Installing Sanitizers 📥</a></h2>

1. Install package

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
3. If you are going to use src/config.ini, Then add this line to your php app before sanitizing any user input `$sanitizer->configFromIni("path/to/src/config.ini");`
4. Now sanitize user input !!
