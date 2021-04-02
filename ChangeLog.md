# BK Sanitizers ChangeLog 1.1

All notable changes to BK Sanitizers library will be added to this file.

[Older ChangeLogs](#older-changelogs)

## Releases

Format is `version (*dd-mm-yyyy*)`

### v1.1.0 (*unreleased*)

#### Info
 * 🚀 Feature update release

### Bug fixes
 * 

#### Changes
 * Moved global variable `$config` to variable `\Sanitizers\Sanitizers\SanitizerData->config`
 * Use `mb_strlen` and `mb_substr` instead of `strlen` and `substr` respectively because they return exact length and correctly remove extra characters
 * Replaced `[]` with `array()` for backward compability
 * Rename `config.php` to `BKS.auto.php`
 * Rename `Sanitizers.php` to `Sanitizer.php`
 * Renamed variable `$html_entities` to `$htmlspecialchars`
 * `Integer($number)` changed to `sanitize("integer", $number)`
 * `Hex($hex)` changed to `sanitize("hex", $hex)`
 * `Email($email)` changed to `sanitize("email", $email)`
 * `Username($username)` changed to `sanitize("username", $username)`
 * `Text($text)` changed to `sanitize("text", $text)`
 * `Name($name)` changed to `sanitize("name", $name)`
 * `Float($number)` changed to `sanitize("float", $number)`
 * `URL($url)` changed to `sanitize("url", $url)`
 * `Password($paasword)` changed to `sanitize("password", $paasword)`

#### Additions
 * Optional include `psr/log` library for debuging
 * Added `.github/SUPPORT.md` for SUPPORT
 * Added `debug_info` in tests
 * Added removing null character in user input
 * Added whether to `preventXSS` in configuration
 * Added `sanitizeArray()` function - sanitizes an array
 * Added `sanitize("message", $message);`, for strings that contains EOL (END OF LINE) [commonly used for contact forms]
 * Added Sanitize HTML code using `$sanitizer->HTML($code)`
 * Added loading config from Ini file using `configFromIni("/path/to/src/config.ini");`
 * Added testing password, url, clean functions in tests
 * Added onerror attribute to message in tests
 * Use php `strip_tags` function when sanitizing urls
 * Added whether to use `ucwords` in `clean` and some types of `sanitize` function
 * Always use `ucwords` in sanitize function in type "name"
 * Added example output for test in `test/example.md`
 * Added SanitizerData class for keeping data for Sanitizers in it (like configuration settings)

#### Deletions
 * Removed fallback values and removed `error_log` if config file not found
 * Removed `NOTES.md`
 * Removed `getVersion()` function use `$sanitizer::VERSION` constant directly

#### Docs
 * Clearly added how to use `psr/log` library
 * New file `FUNCTIONS.md` for understanding sanitizers functions
 * New file `getting-started.md` for Getting Started guide
 * New file `config.md` for Configuring BKS guide
 * New file `files.md` for explanation of main files in BKS
 * New file `FAQ.md` for the faqs asked to BKS
 * Added extending in examples
 * Added Asking question section in wiki
 * Added asking questions in contributing guidelines

#### Depreciated
 * Depreciated function `NonNumericText`

<h2><a name="older-changelogs">Older ChangeLogs</a></h2>

 * [1.0](https://github.com/PuneetGopinath/Sanitizers/blob/1.0-dev/ChangeLog.md)
