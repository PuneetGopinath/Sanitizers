# Sanitizers ChangeLog 1.0

## Releases

### v1.0.2    (*unreleased*)

#### Info
 * 🐛 Bug fix release

### Bug fixes
 * 

#### Changes
 * `Integer($number)` => `sanitize("integer", $number)`
 * `Hex($hex)` => `sanitize("hex", $hex)`
 * `Email($email)` => `sanitize("email", $email)`
 * `Username($username)` => `sanitize("username", $username)`
 * `Text($text)` => `sanitize("text", $text)`
 * `Name($name)` => `sanitize("name", $name)`
 * `Float($number)` => `sanitize("float", $number)`
 * `URL($url)` => `sanitize("url", $url)`
 * Moved global variable `$config` to constant `\Sanitizers\Sanitizers\config`
 * Use `mb_strlen` and `mb_substr` instead of `strlen` and `substr` respectively
 * Use `$this->config = \Sanitizers\Sanitizers\config` for configuration options instead of `$this->maxInputLength` and `$this->encoding`
 * Replaced `[]` with `array()` backward compability
 * Rename config.php to bootstrap.php

#### Additions
 * `sanitizeArray()` function - sanitizes an array
 * `sanitize("message", $message)`, for strings that contains EOL (END OF LINE) [commonly useful for contact forms]
 * Sanitize HTML code using `$sanitize->HTML($code)`
 * `$sanitize->set(/*any key of configuration*/, /*value*/)` function - modifies a config option temporarily
 * Optional include psr/log library for debuging
 * Added whether to use addslashes function and to preventXSS in configuration
 * `htmlspecialchars` can be disabled or enabled using param(parameter) #3 in clean and param #4 sanitize function
 * Can load configuration from Ini file using `configFromIni("/path/to/your/config.ini")`
 * Get Sanitizers version using `$sanitize->version`

#### Deletions
 * Removed checking of correct encoding, anyway php says **Note: Any other character sets are not recognized. The default encoding will be used instead and a warning will be emitted.** in [php.net](http://www.php.net/manual/en/function.htmlspecialchars).
 * Removed fallback values

### v1.0.1    (*05-02-2021*)

#### Info
 * 🐛 Bug fix release

### Bug fixes
 * Warning: Undefined variable $config in src/Sanitizers.php on line 10
 * Warning: Trying to access array offset on value of type null in src/Sanitizers.php on line 10
 * Warning: Undefined variable $config in src/Sanitizers.php on line 11
 * Warning: Trying to access array offset on value of type null in src/Sanitizers.php on line 11

#### Changes
 * Change private function clean to public function clean.
 * Instead of repeating same filter_var in function Username use `$this->Text($username)`

#### Additions

 * Sanitize URL using `URL($url)`.
 * Enable exceptions by passing true in Sanitizer class.
 * namespace `Sanitizers\Sanitizers`
 * Composer
 * Sanitizers testing
 * error_log if config file not found or not readable.
 * Check whether encoding is correct.
 * `trim` can be disabled or enabled using param #2 in clean function

### v1.0.0    (*28-01-2021*)

#### Info
 * 🎉 Initial release of Sanitizers!