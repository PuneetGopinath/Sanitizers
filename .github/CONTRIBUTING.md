# Contributing to BK Sanitizers !!!

Looking to contribute to BKS?
_**Here's how we can help.**_

The following is a set of guidelines for contributing to BKS. These are mostly guidelines, not rules. Use your best judgment, and feel free to propose changes to this document in a pull request.

We welcome Pull requests !!

For major changes, please open an [discussion](https://github.com/PuneetGopinath/Sanitizers/discussions) to discuss what you would like to change.

## Asking Questions

Please read [SUPPORT.md](SUPPORT.md) for knowing where to ask questions

Don't use GitHub issues for asking questions, we use GitHub issues for bug reports and feature requests.

## Using the Issue tracker

Reporting bugs and Requesting features should be done using the issue tracker

You can [Report bug](https://github.com/PuneetGopinath/Sanitizers/issues/new?template=bug_report.md) or [Request feature](https://github.com/PuneetGopinath/Sanitizers/issues/new?template=feature_request.md)

## Pull request

**Note:** Before submitting your PR, check whether your code adheres to BKS coding standards (which is mostly [PSR-12](https://www.php-fig.org/psr/psr-12/)) by running [PHP CodeSniffer](https://github.com/squizlabs/PHP_CodeSniffer):

```
# If you downloaded from Composer:
./vendor/bin/phpcs --extensions=php --standard=PSR12 src

# Or else if you downloaded from cURL:
php phpcs.phar --extensions=php --standard=PSR12 src

# Or else if it is in the /bin or $PREFIX/bin folder
phpcs --extensions=php --standard=PSR12 src
```

Any problems can probably be fixed automatically by using its partner tool, PHP code beautifier (phpcbf):

```
# If you downloaded from Composer:
./vendor/bin/phpcbf --extensions=php --standard=PSR12 src

# Or else if you downloaded from cURL:
php phpcbf.phar --extensions=php --standard=PSR12 src

# Or else if it is in the /bin or $PREFIX/bin folder
phpcbf --extensions=php --standard=PSR12 src
```

Steps to submit a pr:

1. Fork the repo
2. Clone it
3. Edit
4. Now commit
5. Then push and give us a pull request

## Where can I contribute to BKS?

You can contribute us by:

 * Improving docs
 * Translating docs, readme
 * Improving source code, examples and built-in tests
 * Visuals in different platforms, See [Visuals in readme](https://github.com/PuneetGopinath/Sanitizers#visuals), currently only termux (android) available

## Translating

**Are you trying to translate our readme and docs to other languages ??**

Thank you very much !!

1. Fork our repo
2. Create new branch with the language name, for example: `en-us`
3. Clone it
4. Edit the docs, `INSTALL.md`, `.github/SUPPORT.md`, `.github/CONTRIBUTING.md` and readme
5. At the end of readme add `Translated by your full name` in that language but not in english, replace `your full name` with your name in that language
6. Now commit
7. The push and give us a pull request

#### Languages already translated

 * No languages

## Other options

 * You can also contribute by funding the Author
 * Even asking questions will help us improve our docs and wiki, Ask at gitter or at IRC #bksanitizers channel in `irc.freenode.net` server

# Code of Conduct

Plz read [CODE_OF_CONDUCT.md](CODE_OF_CONDUCT.md)
