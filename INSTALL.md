<link rel="stylesheet" href="docs/css/main.css" />

# Install Sanitizers

## Table of Contents
 * [Prerequisites](#prerequisites)
 * [Install Sanitizers](#install)

<h2><a name="prerequisites">Prerequisites</a></h2>

To install Sanitizers, you will need:
 * Minimum PHP 5.6.0 compiler
 * PHP filter extension (commonly it is pre installed)
 * If you want to encode strings then; you need php mbstring, iconv extensions

<h2><a name="install">Install Sanitizers</a></h2>

1. Install package

Installing from composer:
> Run `composer require sanitizers/sanitizers`

<p align="center">OR</p>

> Add this line to your **composer.json** file. If you already have require (key in composer.json) just add `"sanitizers/sanitizers": "^1.0"`
or else add this

```
"require": {
    "sanitizers/sanitizers": "^1.0"
}
```

Installing from github:
> [Download from releases page](https://github.com/PuneetGopinath/Sanitizers/releases/)
> Extract files to your project's folder

2. Edit src/config.php
3. 

