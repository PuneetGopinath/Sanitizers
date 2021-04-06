<h2 align="center">BK Sanitizers Docs - FAQ</h2>

<link rel="stylesheet" href="https://puneetgopinath.github.io/Sanitizers/css/main.css" />

To know the frequently asked questions to BKS read this file.

The Frequently Asked Questions are:

## What is XSS ??

XSS stands for Cross Site Scripting.

## What is Sanitize ??

/ˈsanɪtʌɪz/ - to make something completely clean and free from bacteria.<br>

> In web development to sanitize means that you remove unsafe characters from the input.

Sanitize is a function to check (and remove) harmful data (which can harm the software) from user input.<br>
Sanitizing user input is the most secure method of user input validation to strip out anything that is not on the whitelist.<br>

## When and why should I use Sanitizers ?

Whenever you store user's data (in database or anywhere), or if that data will be read/available to (unsuspecting) users, then you have to sanitize it.<br>
See also HTML_sanitization in
[wikipedia](https://en.m.wikipedia.org/wiki/HTML_sanitization)<br>

## How can I clean user input ?

1. First, Sanitize
2. Then, Validate
3. Last, Escape output.

<img src="../gif/Sanitize.jpg" alt="Validating process image" style="width:300;height:300;" height="300" width="300" />

[Back to home](README.md)
