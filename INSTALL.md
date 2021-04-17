<link rel="stylesheet" href="https://puneetgopinath.github.io/css/main.css" />

# How-to install BK Sanitizers

## Table of Contents

 * [Prerequisites](#prerequisites)
 * [Installing Sanitizers](#installing-sanitizers)

<h2><a name="prerequisites">Prerequisites 📋</a></h2>

If you are using composer these things will be checked by composer, no need to worry about these.

To install Sanitizers, you need:

 * Minimum php 5.3.0 compiler.
 * PHP Extensions - filter and mbstring extensions.
 * HTMLPurifier (optional) *(automaticaly installed if you are using composer)* **(recommended)** - You can install HTMLPurifier it will be used when sanitizing html code. Minimum 4.12.0 required. **Note:** If you are not using composer, you have to require it yourself e.g. `require_once '/path/to/HTMLPurifier.auto.php';`

If you want to encode strings then; you need php iconv extension also.

**Note:** The warning messages will be always thrown, we don't have the feature of disabling this, if you want this feature, then submit a feature request using the [Issue tracker](https://github.com/PuneetGopinath/Sanitizers/issues), See [CONTRIBUTING.md](.github/CONTRIBUTING.md#using-the-issue-tracker) if you want to submit a feature request.

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
