<h2 align="center">BK Sanitizers Docs - Learn more about XSS</h2>

<link rel="stylesheet" href="https://puneetgopinath.github.io/Sanitizers/css/main.css" />

The basic questions about XSS are below:

## What is XSS ??

XSS stands for Cross Site Scripting.

## What are the important things to do for preventing XSS ?

1. Always sanitize and validate all user input.
2. [Add a strict Content Security Policy (CSP)](https://web.dev/strict-csp/).

## When do XSS vulnerabilities arise?

They usually arise from:

 * Allowing user input to be add to your html code. (Use HTMLPurifier)
 * Allowing users to upload HTML/SVG files and serving those back unsafely (Use HTMLPurifier/SVG sanitizer).
 * Passing user input into executable functions/properties in JS. (Use Any Sanitizer like BK Sanitizers)
 * Loading scripts from untrusted website. (You have to trust that website, we can't do anything)

---------------------------------------------------------------------

You can also play with xss game [here](http://xss-game.appspot.com).

---------------------------------------------------------------------

[Back to home](README.md)
