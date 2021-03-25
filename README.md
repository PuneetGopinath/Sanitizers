<link rel="stylesheet" href="docs/css/main.css" />
<div class="card">
  <p align="center">
    <a href="https://puneetgopinath.github.io/Sanitizers/docs">
      <img src="docs/images/Sanitizers-logo-transparent.png" alt="Sanitizers logo" style="width:300;height:300;" height="300" width="300" />
    </a>
  </p>
  <h2 align="center">BK Sanitizers (BKS)</h2>

> *Quickly Sanitize user data*

  <img alt="Welcome" src="gif/Welcome.gif" />

  <p align="center">
    <b>BK Sanitizers is a community-developed, free and open source library for sanitizing user data in PHP.</b><br><br>
    An acronym or abbreviation for <b>B</b>aal-<b>K</b>rshna <b>Sanitizers</b> is BK Sanitizers
    <br><br>
    Latest release: <img alt="GitHub release (latest by date)" src="https://img.shields.io/github/v/release/PuneetGopinath/Sanitizers"><br>
    <br><br>Explore:<br>
    <a href="https://puneetgopinath.github.io/Sanitizers/docs"><b>Sanitizers Docs</b></a> &raquo;<br>
    <a href="https://github.com/PuneetGopinath/Sanitizers/wiki"><b>Sanitizers Wiki</b></a> &raquo;<br><br>
    Pages &rArr;
    <a href="https://github.com/PuneetGopinath/Sanitizers/issues/new?template=bug_report.md">Report bug(s)</a> • <a href="https://github.com/PuneetGopinath/Sanitizers/releases">Releases</a> • <a href="https://github.com/PuneetGopinath/Sanitizers/issues/new?template=feature_request.md">Request feature</a> • <a href="https://baalkrshna.hashnode.dev/series/bks">Blog</a>
  </p><br><br>
  <a href="https://twitter.com/intent/tweet?text=This%20PHP%20Sanitizers%20Helped%20Me%20A%20Lot%20In%20My%20Projects.%20Make%20Sure%20To%20Check%20It%20Out:\&url=https%3A%2F%2Fgithub.com%2FPuneetGopinath%2FSanitizers\&hashtags=php,backend,developer,opensource,bksanitizers"><img alt="Twitter" src="https://img.shields.io/twitter/url?style=social&url=https%3A%2F%2Fgithub.com%2FPuneetGopinath%2FSanitizers" /></a>
  <a href="https://gitter.im/BaalKrshna/Sanitizers?utm_source=badge&utm_medium=badge"><img alt="Join the chat at https://gitter.im/BaalKrshna/Sanitizers" src="https://badges.gitter.im/BaalKrshna/Sanitizers.svg" /></a>
  <a href="https://github.com/PuneetGopinath/Sanitizers/stargazers"><img alt="GitHub stars" src="https://img.shields.io/github/stars/PuneetGopinath/Sanitizers?style=social"></a><br>
</div>

<hr>

**Note**: See the [1.0-dev](https://github.com/PuneetGopinath/Sanitizers/tree/1.0-dev) branch, as main branch is developing 1.1.0 minor release so, readme and docs are not for 1.0 releases.
<details open="true">
    <summary align="center">Table of contents</summary>

 * [Features](#features)
 * [Quick Start](#quick-start)
 * [Status](#status)
 * [About](#about)
 * [Visuals](#visuals)
 * [Files](#files)
 * [Prerequisites](#prerequisites)
 * [Tests](#tests)
 * [Contributing](#contributing)
 * [Community](#community)
 * [Authors](#authors)
 * [Supporters](#supporters)
 * [LICENSE](#license)
 * [Comparing](#comparing)
 * [Support Us](#support-us)
 * [CODE_OF_CONDUCT](#code-of-conduct)
 * [Versioning](#versioning)
 * [Conclusion](#conclusion)

</details>

<h2><a name="features">Features</a></h2>

1. Sanitize strings and arrays
2. Namespaced to prevent name clashes
3. Built-in tests
4. Examples for how-to use BKS
5. Escape values
6. Easy to Use

<h2><a name="quick-start">Quick Start 🚀</a></h2>

- [Download the latest version](https://github.com/PuneetGopinath/Sanitizers/archive/v1.0.2.zip)

- ### Clone the repo:

 * Using git:
`git clone https://github.com/PuneetGopinath/Sanitizers.git`
 * Using github cli:
`gh repo clone PuneetGopinath/Sanitizers`

- ### Installation 🔧

See [INSTALL.md](INSTALL.md) file for Installation guide.

- ### Documentation

Plz see [docs](docs/README.md) folder

- ### Usage

Just include the file and Sanitize the user input.
- Example Usage without composer autoload:

```php
<?php
// Import classes
use Sanitizers\Sanitizers\Sanitizer;

require "src/Sanitizers.php";

// passing `true` in Sanitizer class enables exceptions
$sanitizer = new Sanitizer(true);
try {
    echo $sanitizer->sanitize("username", $_GET["username"]);
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    echo $e->getMessage();
}
?>
```

- Example Usage with composer autoload:

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
    echo $e->getMessage();
}
?>
```

<h2><a name="status">Status</a></h2>

This project is currently being maintained. And Will Be Maintained. If You Like This Project And Want This Project To Never Exhaust. Please Consider Donating.

[![Join the chat at https://gitter.im/BaalKrshna/Sanitizers](https://badges.gitter.im/BaalKrshna/Sanitizers.svg)](https://gitter.im/BaalKrshna/Sanitizers?utm_source=badge&utm_medium=badge&utm_campaign=pr-badge&utm_content=badge)
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers.svg?type=shield)](https://app.fossa.com/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers?ref=badge_shield)

#### Workflows

[![PHP Composer](https://github.com/PuneetGopinath/Sanitizers/actions/workflows/php.yml/badge.svg)](https://github.com/PuneetGopinath/Sanitizers/actions/workflows/php.yml)

#### GitHub

![GitHub commit activity](https://img.shields.io/github/commit-activity/y/PuneetGopinath/Sanitizers)
![GitHub last commit](https://img.shields.io/github/last-commit/PuneetGopinath/Sanitizers)
[![Github Downloads](https://img.shields.io/github/downloads/PuneetGopinath/Sanitizers/total.svg)](https://github.com/PuneetGopinath/Sanitizers/releases)
[![GitHub issues](https://img.shields.io/github/issues-raw/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/issues)
[![GitHub pull requests](https://img.shields.io/github/issues-pr-raw/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/pulls)
[![GitHub release (latest by date)](https://img.shields.io/github/v/release/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/releases)
![Snyk Vulnerabilities for GitHub Repo](https://img.shields.io/snyk/vulnerabilities/github/PuneetGopinath/Sanitizers)
[![GitHub top language](https://img.shields.io/github/languages/top/PuneetGopinath/Sanitizers)]()
[![GitHub code size in bytes](https://img.shields.io/github/languages/code-size/PuneetGopinath/Sanitizers)]()
[![GitHub repo size](https://img.shields.io/github/repo-size/PuneetGopinath/Sanitizers)]()

#### Packagist

[![Latest Stable Version](https://poser.pugx.org/sanitizers/sanitizers/v)](https://packagist.org/packages/sanitizers/sanitizers)
[![PHP Support](https://img.shields.io/packagist/php-v/sanitizers/sanitizers)](https://packagist.org/packages/sanitizers/sanitizers)
[![Latest Unstable Version](https://poser.pugx.org/sanitizers/sanitizers/v/unstable)](https://packagist.org/packages/sanitizers/sanitizers)
[![Total Downloads](https://poser.pugx.org/sanitizers/sanitizers/downloads)](https://packagist.org/packages/sanitizers/sanitizers)
[![Monthly Downloads](https://poser.pugx.org/sanitizers/sanitizers/d/monthly)](https://packagist.org/packages/sanitizers/sanitizers)
[![Daily Downloads](https://poser.pugx.org/sanitizers/sanitizers/d/daily)](https://packagist.org/packages/sanitizers/sanitizers)

#### Stargazers over time

[![Stargazers over time](https://starchart.cc/PuneetGopinath/Sanitizers.svg)](https://starchart.cc/PuneetGopinath/Sanitizers)

<!--[![Sparkline](https://stars.medv.io/PuneetGopinath/Sanitizers.svg)](https://stars.medv.io/PuneetGopinath/Sanitizers)-->

<h2><a name="about">About ℹ️</a></h2>

- ### What is Sanitize ??

/ˈsanɪtʌɪz/ - to make something completely clean and free from bacteria.<br>

> In web development to sanitize means that you remove unsafe characters from the input.<br>
> Sanitize is a function to check (and remove) harmful data (which can harm the software) from user input.<br>
> Sanitizing user input is the most secure method of user input validation to strip out anything that is not on the whitelist.<br>

- ### When and why should I use Sanitizers ?

> Whenever you store user's data (in database or anywhere), or if that data will be read/available to (unsuspecting) users, then you have to sanitize it.<br>
> See also HTML_sanitization in
[wikipedia](https://en.m.wikipedia.org/wiki/HTML_sanitization)<br>

- ### What is XSS ??

XSS stands for Cross Site Scripting.

- ### How can I clean user input 🧹 ?

1. Sanitize
2. Validate
3. Escape output.
![Validating process image](gif/Sanitize.jpg)

<h2><a name="visuals">Visuals 📽️</a></h2>

- ### Testing with and without composer autoload in Termux (on Android)

<img alt="Gif of testing on termux" src="gif/BK-Sanitizers-termux.gif" width="300" height="300" />

I ran:
```bash
composer validate # Validates composer.json
composer test # Test without composer autoload
composer update # Update dependencies and install autoload
composer test # Test with composer autoload
```

<h2><a name="files">Files 🗃️</a></h2>

```text
Sanitizers/
└── src/
    ├── Sanitizers.php
    └── config.ini
    └── bootstrap.php
└── examples/
    └── README.md
    └── extending.php
    └── confirm-reg.php
    └── contact-form.php
    └── login.php
    └── register.php
└── test/
    └── SanitizersTest.php
    └── README.md
```

<h2><a name="prerequisites">Prerequisites 📋</a></h2>

See Prerequisites section [in INSTALL.md](INSTALL.md#prerequisites).

<h2><a name="tests">Tests ⚙️</a></h2>

Run either `composer run-script test` or `php test/SanitizersTest.php debug`

<h2><a name="contributing">Contributing</a></h2>

Plz read [CONTRIBUTING.md](.github/CONTRIBUTING.md)</a> file.

<h2><a name="community">Community 💬</a></h2>

Get updates on Sanitizers's development and chat with the BKS maintainers and community members.

Plz see [SUPPORT.md](https://github.com/PuneetGopinath/Sanitizers/blob/main/.github/SUPPORT.md) file.

<h2><a name="authors">Authors ✒️</a></h2>

 * Puneet Gopinath - [GitHub](https://github.com/PuneetGopinath) - [Email](mailto:baalkrshna@gmail.com)

See also the list of [contributors](https://github.com/PuneetGopinath/Sanitizers/graphs/contributors) who participated in building this project.

<h2><a name="supporters">Supporters</a></h2>

👏 Thank you very much !

You have proved that BK Sanitizers has some value !!

### Stargazers

[![Stargazers for @PuneetGopinath/Sanitizers](https://reporoster.com/stars/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/stargazers)

### Forks

[![Forkers for @PuneetGopinath/Sanitizers](https://reporoster.com/forks/PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/network/members)

### Contributors

Thanks to all contributors again !!

[![GitHub Contributors Image](https://contrib.rocks/image?repo=PuneetGopinath/Sanitizers)](https://github.com/PuneetGopinath/Sanitizers/contributors)

<h2><a name="license">LICENSE 📄</a></h2>

MIT License. Read [LICENSE](LICENSE) file.
[![FOSSA Status](https://app.fossa.com/api/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers.svg?type=large)](https://app.fossa.com/projects/git%2Bgithub.com%2FPuneetGopinath%2FSanitizers?ref=badge_large)

<h2><a name="comparing">Comparing 😕</a></h2>

#### Are you comparing BKS library with HTMLPurifier ??

Then, you need to know difference between HTMLPurifier and BKS

1. HTMLPurifier aims at creating safe and valid HTML as close as possible to a given input. But we aim to cover all types of input like name, username, password, etc

<h2><a name="support-us">Support Us</a></h2>

This is optional (we don't force you anything) and you can also try to give at least a star at GitHub.

### Review

<a href="https://www.producthunt.com/posts/bk-sanitizers?utm_source=badge-review&utm_medium=badge&utm_souce=badge-bk-sanitizers#discussion-body" target="_blank"><img src="https://api.producthunt.com/widgets/embed-image/v1/review.svg?post_id=289099&theme=light" alt="BK Sanitizers - Quickly Sanitize user data | Product Hunt" style="width: 250px; height: 54px;" width="250" height="54" /></a>

### Sponsor

Support BK Sanitizers by becoming a sponsor.
Your name will be displayed here.

[Click here to sponsor](https://patreon.com/PuneetGopinath)

### Spread

Help spread awareness about BK Sanitizers by:

 * Twitter: [![Share](https://img.shields.io/badge/Share-Twitter-%231DA1F2?style=flat-square)](https://twitter.com/intent/tweet?text=This%20PHP%20Sanitizers%20Helped%20Me%20A%20Lot%20In%20My%20Projects.%20Make%20Sure%20To%20Check%20It%20Out:\&url=https://github.com/PuneetGopinath/Sanitizers\&hashtags=php,backend,developer,opensource,bksanitizers)

 * Facebook: [![Share](https://img.shields.io/badge/Share-Facebook-%233b5998?style=flat-square)](https://www.facebook.com/sharer/sharer.php?u=https://github.com/PuneetGopinath/Sanitizers)

 * Linkedin: [![Share](https://img.shields.io/badge/Share-Linkedin-%230e76a8?style=flat-square)](https://www.linkedin.com/shareArticle?mini=true\&url=https://github.com/PuneetGopinath/Sanitizers)

 * Pinterest: [![Share](https://img.shields.io/badge/Share-Pinterest-%23c8232c?style=flat-square)](https://pinterest.com/pin/create/button/?media=\&description=This%20PHP%20Sanitizers%20Helped%20Me%20A%20Lot%20In%20My%20Projects.%20Make%20Sure%20To%20Check%20It%20Out:\&url=https://github.com/PuneetGopinath/Sanitizers)

 * Email: [![Share](https://img.shields.io/badge/Share-Email-green?style=flat-square)](mailto:info@example.com?\&subject=See%20this%20Awesome%20PHP%20Sanitizers\&cc=\&bcc=\&body=https://github.com/PuneetGopinath/Sanitizers%0AThis%20PHP%20Sanitizers%20Helped%20Me%20A%20Lot%20In%20My%20Projects.%20Make%20Sure%20To%20Check%20It%20Out)

<h2><a name="code-of-conduct">CODE_OF_CONDUCT</a></h2>

Plz read [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md) for our CODE OF CONDUCT.

<h2><a name="versioning">Versioning</a></h2>

We use [Semantic Versioning](https://semver.org) for our library.

<h2><a name="conclusion">Conclusion 🏁</a></h2>

If you sanitize user input then, you will be able to manage data properly, validate it, show it in a secure and reliable way.

It makes your web application trustworthy, so it must be one of your main goals from the beginning of your career as a web developer.
