<link rel="stylesheet" href="docs/css/main.css" />
<div class="card">
  <p align="center">
    <a href="https://puneetgopinath.github.io/Sanitizers/docs"><img src="docs/images/Sanitizers-logo-transparent.png" alt="Sanitizers logo" style="width:200;height:200;" height="200" width="200"></a>
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
</div>

<hr>

# Table of contents

 * [Quick Start](#quick-start)
 * [Source Files Structure](#files)
 * [Status](#status)
 * [Prerequisites](#prerequisites)
 * [Tests](#test)
 * [Contributing](#contribute)
 * [Authors](#authors)
 * [LICENSE](#license)
 * [Conclusion](#conclude)

<h2><a name="quick-start">Quick Start</a></h2>

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
> If it contains html code given by users then you have to sanitize it. See HTML_sanitization in
[wikipedia](https://en.m.wikipedia.org/wiki/HTML_sanitization)<br>

- ### How can I clean user input ?

 * First, Sanitize
 * Then, Validate
 * Last, Escape output.
![Validating process image](Sanitize.jpg)

- ### Installation 🔧

See [INSTALL.md](INSTALL.md) file for Installation guide.

- ### Usage

Just include the file and Sanitize the user input.
Example Usage in php:

```php
<?php
// Import classes
use Sanitizers\Sanitizers\Sanitize;

require "src/Sanitizers.php";

// passing `true` in Sanitizer class enables exceptions
$sanitize = new Sanitize(true);
try {
    echo $sanitize->sanitize("username", $_GET['username']);
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
use Sanitizers\Sanitizers\Sanitize;

require "vendor/autoload.php";

$sanitize = new Sanitize(true);
try {
    echo $sanitize->sanitize("username", $_GET['username']);
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    var_dump($e);
}
?>
```

<h2><a name="files">Source Files Structure</a></h2>

```text
Sanitizers/
└── src/
    ├── Sanitizers.php
    └── config.php
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

#### Stargazers

[![Stargazers repo roster for @PuneetGopinath/Sanitizers](https://reporoster.com/stars/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/stargazers)

<h2><a name="prerequisites">Prerequisites 📋</a></h2>

 * #### PHP
Minimum we need php 5.6.0 for Sanitizers to work.
 * #### PHP Extensions
You need filter and mbstring extension.

<h2><a name="test">Tests ⚙️</a></h2>

Run either `composer run-script test` or `php test/SanitizersTest.php -- --debug`

<h2><a name="contribute">Contributing</a></h2>

Plz read [CONTRIBUTING.md](.github/CONTRIBUTING.md)</a> file.

<h2><a name="authors">Authors ✒️</a></h2>

 * Puneet Gopinath - [PuneetGopinath](https://github.com/PuneetGopinath)
See also the list of [contributors](https://github.com/PuneetGopinath/Sanitizers/graphs/contributors) who participated in building this project.

<h2><a name="license">LICENSE 📄</a></h2>

MIT License. Read [LICENSE](LICENSE) file.
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers?ref=badge_large)

<h2><a name="discussion">Discussion 📫</a></h2>

For doubts, use either GitHub discussion or Gitter.

<h2><a name="conclude">Conclusion</a></h2>

If you sanitize user input then, you will be able to manage data properly, validate it, show it in a secure and reliable way.<br>
It makes your web application trustworthy, so it must be one of your main goals from the beginning of your career as a web developer.
