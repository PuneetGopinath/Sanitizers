<link rel="stylesheet" href="docs/css/main.css" />
<div class="card">
  <p align="center">
    <a href="https://puneetgopinath.github.io/Sanitizers/docs"><img src="docs/images/Sanitizers-logo-transparent.png" alt="Sanitizers logo" style="width:300;height:300;" height="300" width="300"></a>
  </p>
  <h2 align="center">Sanitizers (BK S)</h2>

  <p align="center">
    Quickly Sanitize user data<br><br>
    Sanitizers can also be called BK Sanitizers (<b>B</b>aal-<b>K</b>rshna <b>Sanitizers</b>)<br><br>
    Latest release: <img alt="GitHub release (latest by date)" src="https://img.shields.io/github/v/release/PuneetGopinath/Sanitizers">
    <br><br>See:<br>
    <a href="https://puneetgopinath.github.io/Sanitizers/docs"><b>Sanitizers Docs</b></a> &raquo;<br>
    <a href="https://github.com/PuneetGopinath/Sanitizers/wiki"><b>Sanitizers Wiki</b></a> &raquo;<br><br>
    Info &rArr;
    <a href="https://github.com/PuneetGopinath/Sanitizers/issues/new?template=bug_report.md">Report bug(s)</a> • <a href="https://github.com/PuneetGopinath/Sanitizers/releases">See Releases</a> • <a href="https://github.com/PuneetGopinath/Sanitizers/issues/new?template=feature_request.md">Request feature</a>
  </p><br><br>
  <a href="https://twitter.com/intent/tweet?text=See%20this%20PHP%20Sanitizers%20on%20GitHub:&url=https%3A%2F%2Fgithub.com%2FPuneetGopinath%2FSanitizers&hashtags=php,backend,sanitizers,php-sanitize,developers"><img alt="Twitter" src="https://img.shields.io/twitter/url?style=social&url=https%3A%2F%2Fgithub.com%2FPuneetGopinath%2FSanitizers" /></a>
  <a href="https://gitter.im/BaalKrshna/Sanitizers?utm_source=badge&utm_medium=badge"><img alt="Join the chat at https://gitter.im/BaalKrshna/Sanitizers" src="https://badges.gitter.im/BaalKrshna/Sanitizers.svg" /></a>
  <img alt="GitHub forks" src="https://img.shields.io/github/forks/PuneetGopinath/Sanitizers?style=social">
  <img alt="GitHub watchers" src="https://img.shields.io/github/watchers/PuneetGopinath/Sanitizers?style=social">
</div>

<hr>

# Table of contents

 * [Quick Start](#quick-start)
 * [Visuals](#visuals)
 * [Files](#files)
 * [Status](#status)
 * [Prerequisites](#prerequisites)
 * [Tests](#tests)
 * [Contributing](#contributing)
 * [Authors](#authors)
 * [LICENSE](#license)
 * [Discussion](#discussion)
 * [Spread BK Sanitizers](#spread)
 * [Conclusion](#conclusion)

<h2><a name="quick-start">Quick Start 🚀</a></h2>

- [Download the latest version](https://github.com/PuneetGopinath/Sanitizers/archive/v1.0.1.zip)

- ### Clone the repo:

`git clone https://github.com/PuneetGopinath/Sanitizers.git` OR `gh repo clone PuneetGopinath/Sanitizers`

- ### What is Sanitize ??

/ˈsanɪtʌɪz/ - to make something completely clean and free from bacteria.<br>

> In web development to sanitize means that you remove unsafe characters from the input.<br>
> Sanitize is a function to check (and remove) harmful data (which can harm the software) from user input.<br>
> Sanitizing user input is the most secure method of user input validation to strip out anything that is not on the whitelist.<br>

- ### When and why should I use Sanitizers ?

> Whenever you store user's data (in database or anywhere), and if that data will be read/available to (unsuspecting) users, then you have to sanitize it.<br>
> See also HTML_sanitization in
[wikipedia](https://en.m.wikipedia.org/wiki/HTML_sanitization)<br>

- ### What is SQL injection

SQL injection is a method used by hackers to inject malicious SQL codes while running SQL query.

Example SQL injection in php:

for example, here `$_POST["userId"]` is `105 OR 1=1`

    $query = "SELECT * FROM Users WHERE UserId = " . $_POST["userId"];
it will become:

    $query = "SELECT * FROM Users WHERE UserId = 105 OR 1=1";

The SQL above is valid and will return ALL rows from the "Users" table, since `OR 1=1` is always TRUE.

Does the example above look dangerous? What if the "Users" table contains names and passwords?

[Source](https://www.w3schools.com/sql/sql_injection.asp)

- ### How can I clean user input ?

 * First, Sanitize
 * Then, Validate
 * Last, Escape output.
![Validating process image](gif/Sanitize.jpg)

- ### Installation 🔧

See [INSTALL.md](INSTALL.md) file for Installation guide.

- ### Usage

Just include the file and Sanitize the user input.
Example Usage in php:

```php
<?php
// Import classes
use Sanitizers\Sanitizers\Sanitizer;

require "src/Sanitizers.php";

// passing `true` in Sanitize class enables exceptions
$sanitizer = new Sanitizer(true);
try {
    echo $sanitizer->sanitize("username", $_GET["username"]);
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    var_dump($e);
}
?>
```

Example Usage in composer:

```php
<?php
// Import classes
use Sanitizers\Sanitizers\Sanitizer;

require "vendor/autoload.php";

$sanitizer = new Sanitizer(true);
try {
    echo $sanitizer->sanitize("username", $_GET["username"]);
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    var_dump($e);
}
?>
```

<h2><a name="visuals">Visuals</a></h2>

- ### Testing with and without composer autoload in Termux (on Android)

![Gif of testing on termux](gif/BK-Sanitizers-termux.gif)

I ran:
```bash
composer validate # Validates composer.json
composer test # Test without composer autoload
composer update # Update dependencies and install autoload
composer test # Test with composer autoload
```

<h2><a name="files">Files</a></h2>

```text
Sanitizers/
└── src/
    ├── Sanitizers.php
    └── config.ini
    └── bootstrap.php
└── examples/
    └── README.md
    └── confirm-reg.php
    └── contact-form.php
    └── login.php
    └── register.php
└── test/
    └── SanitizersTest.php
    └── README.md
```

<h2><a name="status">Status</a></h2>

[![Join the chat at https://gitter.im/BaalKrshna/Sanitizers](https://badges.gitter.im/BaalKrshna/Sanitizers.svg)](https://gitter.im/BaalKrshna/Sanitizers?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers?ref=badge_shield)

#### Workflows

![PHP Composer](https://github.com/PuneetGopinath/Sanitizers/actions/workflows/php.yml/badge.svg)

#### GitHub

[![Github Downloads](https://img.shields.io/github/downloads/PuneetGopinath/Sanitizers/total.svg)](https://github.com/PuneetGopinath/Sanitizers/releases)
[![GitHub stars](https://img.shields.io/github/stars/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/stargazers)
[![GitHub issues](https://img.shields.io/github/issues-raw/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr-raw/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/pulls)
[![GitHub package.json dynamic](https://img.shields.io/github/package-json/description/PuneetGopinath/Sanitizers)]()
[![GitHub release (latest by date)](https://img.shields.io/github/v/release/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/releases)
![Snyk Vulnerabilities for GitHub Repo](https://img.shields.io/snyk/vulnerabilities/github/PuneetGopinath/Sanitizers)
[![GitHub top language](https://img.shields.io/github/languages/top/PuneetGopinath/Sanitizers)]()
[![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/PuneetGopinath/Sanitizers)]()
[![GitHub language count](https://img.shields.io/github/languages/count/PuneetGopinath/Sanitizers)]()
[![GitHub repo size](https://img.shields.io/github/repo-size/PuneetGopinath/Sanitizers)]()
![Maintenance](https://img.shields.io/maintenance/yes/2021)

#### Packagist

[![Latest Stable Version](https://poser.pugx.org/sanitizers/sanitizers/v)](https://packagist.org/packages/sanitizers/sanitizers)
[![PHP Support](https://img.shields.io/packagist/php-v/sanitizers/sanitizers)](https://packagist.org/packages/sanitizers/sanitizers)
[![Latest Unstable Version](https://poser.pugx.org/sanitizers/sanitizers/v/unstable)](https://packagist.org/packages/sanitizers/sanitizers)
[![Total Downloads](https://poser.pugx.org/sanitizers/sanitizers/downloads)](//packagist.org/packages/sanitizers/sanitizers)
[![Monthly Downloads](https://poser.pugx.org/sanitizers/sanitizers/d/monthly)](//packagist.org/packages/sanitizers/sanitizers)
[![.gitattributes](https://poser.pugx.org/sanitizers/sanitizers/gitattributes)](//packagist.org/packages/sanitizers/sanitizers)
[![composer.lock](https://poser.pugx.org/sanitizers/sanitizers/composerlock)](//packagist.org/packages/sanitizers/sanitizers)
[![Daily Downloads](https://poser.pugx.org/sanitizers/sanitizers/d/daily)](//packagist.org/packages/sanitizers/sanitizers)
![Packagist Stars](https://img.shields.io/packagist/stars/sanitizers/sanitizers)

#### Stargazers Thank you very much !!

[![Stargazers repo roster for @PuneetGopinath/Sanitizers](https://reporoster.com/stars/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/stargazers)

<h2><a name="prerequisites">Prerequisites 📋</a></h2>

 * #### PHP
Minimum we need php 5.6.0 for Sanitizers to work.
 * #### PHP Extensions
You need filter and mbstring extension.

<h2><a name="tests">Tests ⚙️</a></h2>

Run either `composer run-script test` or `php test/SanitizersTest.php -- --debug`

<h2><a name="contributing">Contributing</a></h2>

Plz read [CONTRIBUTING.md](.github/CONTRIBUTING.md)</a> file.

<h2><a name="authors">Authors ✒️</a></h2>

 * Puneet Gopinath - [PuneetGopinath](https://github.com/PuneetGopinath)

See also the list of [contributors](https://github.com/PuneetGopinath/Sanitizers/graphs/contributors) who participated in building this project.

<h2><a name="license">LICENSE 📄</a></h2>

MIT License. Read [LICENSE](LICENSE) file.
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers?ref=badge_large)

<h2><a name="discussion">Discussion 📫</a></h2>

For doubts, use either GitHub discussion or Gitter.

<h2><a name="spread">Spread BK Sanitizers! 🎉</a></h2>

Help spread awareness about BK Sanitizers by:

 * Share in social media platforms to spread it.
 * add BK Sanitizers in your site's credits list.

<h2><a name="conclusion">Conclusion</a></h2>

If you sanitize user input then, you will be able to manage data properly, validate it, show it in a secure and reliable way.<br>
It makes your web application trustworthy, so it must be one of your main goals from the beginning of your career as a web developer.
