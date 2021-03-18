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
 * Use `$this->config` for configuration options instead of `$this->maxInputLength` and `$this->encoding`

#### Functions
 * `htmlspecialchars` can be disabled or enabled using param(parameter) #3 in all functions
 * Get Sanitizers version using `$sanitizer->getVersion();`

#### Additions
 * Added `INSTALL.md` for installing guidlines
 * Added `.github/CODE_OF_CONDUCT.md` for CODE OF CONDUCT

#### Deletions
 * Removed checking of correct encoding, anyway php says **Note: Any other character sets are not recognized. The default encoding will be used instead and a warning will be emitted.** in [php.net](http://www.php.net/manual/en/function.htmlspecialchars).

#### Docs
 * Removed confusing message `the file from where you are including **Sanitizers.php** should contain the file **config.php** in the directory where **Sanitizers.php** exists.`
 * Clearly added point `1. Loading classes` and `2. Then, Sanitize input`
 * Added `Trobleshooting` Sanitizers in wiki
 * Improved Wiki
 * Added contact-form, confirm-reg in examples

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
