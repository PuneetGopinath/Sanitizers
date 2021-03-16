# Sanitizers ChangeLog 1.0

All notable changes to BKS Sanitizers library will be added to this file.

[Older ChangeLogs](#older-changelogs)

## Releases

Format is `version    (*dd-mm-yyyy*)`

### v1.0.2    (*20-03-2021*)

#### Info
 * 🐛 Bug fix release

### Bug fixes
 * Fix bug function `Integer` and `Float` returns as string, it should return as `int` and `float` respectively

#### Changes
 * Moved global variable `$config` to constant `\Sanitizers\Sanitizers\config`
 * Use `mb_strlen` and `mb_substr` instead of `strlen` and `substr` respectively because they return exact length and correctly remove extra characters
 * Use `$this->config` for configuration options instead of `$this->maxInputLength` and `$this->encoding`
 * Replaced `[]` with `array()` for backward compability
 * Rename config.php to bootstrap.php

#### Functions
 * `Integer($number)` changed to `sanitize("integer", $number)`
 * `Hex($hex)` changed to `sanitize("hex", $hex)`
 * `Email($email)` changed to `sanitize("email", $email)`
 * `Username($username)` changed to `sanitize("username", $username)`
 * `Text($text)` changed to `sanitize("text", $text)`
 * `Name($name)` changed to `sanitize("name", $name)`
 * `Float($number)` changed to `sanitize("float", $number)`
 * `URL($url)` changed to `sanitize("url", $url)`
 * `sanitizeArray()` function - sanitizes an array
 * `sanitize("message", $message);`, for strings that contains EOL (END OF LINE) [mostly useful for contact forms]
 * Sanitize HTML code using `$sanitizer->HTML($code)`
 * `$sanitizer->set(/*key*/, /*value*/);` function - modifies a config option temporarily
 * Added loading config from Ini file using `configFromIni("/path/to/src/config.ini");`
 * Added whether to use `addslashes` function and to `preventXSS` in configuration
 * `htmlspecialchars` can be disabled or enabled using param(parameter) #3 in clean and param #4 sanitize function
 * Get Sanitizers version using `$sanitizer->getVersion();`

#### Additions
 * Optional include `psr/log` library for debuging
 * Added `INSTALL.md` for installing guidlines
 * Added `.github/CODE_OF_CONDUCT.md` for CODE OF CONDUCT
 * Added `.github/SUPPORT.md` for SUPPORT
 * Added `debug_info` in tests

#### Deletions
 * Removed checking of correct encoding, anyway php says **Note: Any other character sets are not recognized. The default encoding will be used instead and a warning will be emitted.** in [php.net](http://www.php.net/manual/en/function.htmlspecialchars).
 * Removed fallback values and removed error_log if config file not found

#### Docs
 * Removed confusing message `the file from where you are including **Sanitizers.php** should contain the file **config.php** in the directory where **Sanitizers.php** exists.`
 * Clearly added point `1. Loading classes` and `2. Then, Sanitize input`
 * Clearly added how to enable `exceptions` and use `psr/log` library
 * Explained about sanitizers function in a new file `FUNCTIONS.md`
 * Added `Trobleshooting` Sanitizers in wiki
 * Improved Wiki

### v1.0.1    (*05-02-2021*)

#### Info
 * 🐛 Bug fix release

### Bug fixes
 * Warning: Undefined variable $config in src/Sanitizers.php on line 10
 * Warning: Trying to access array offset on value of type null in src/Sanitizers.php on line 10
 * Warning: Undefined variable $config in src/Sanitizers.php on line 11
 * Warning: Trying to access array offset on value of type null in src/Sanitizers.php on line 11

#### Functions
 * Added Sanitize URL using `$sanitizer->URL($url);`.
 * Enable exceptions by passing `true` in Sanitizer class.
 * Change `private function` clean to `public function` clean.
 * Instead of repeating same `filter_var` in function Username use `$this->Text($username);`
 * `trim` can be disabled or enabled using param #2 in clean function

#### Additions
 * Composer
 * Sanitizers testing
 * `error_log` if config file not found or not readable.
 * namespace `Sanitizers\Sanitizers`
 * Check whether `encoding` is correct.

#### Deletions
 * No deletions

#### Docs
 * Added explaination for namespaces, exceptions
 * Corrected this mistake `the file you are using (or the file from where you are including Sanitizers.php) should contain the file *config.php* in the same directory`
 * Added examples of using Sanitizers

### v1.0.0    (*28-01-2021*)

#### Info
 * 🎉 Initial release of Sanitizers!

<h2><a name="older-changelogs">Older ChangeLogs</a></h2>

 * No older ChangeLogs
