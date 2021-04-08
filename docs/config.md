<h2 align="center">BK Sanitizers Docs - Configuring settings</h2>

<link rel="stylesheet" href="https://puneetgopinath.github.io/Sanitizers/css/main.css" />

To Configure BK Sanitizers read this guide.

The list of all settings are below:

## 1. maxInputLength

Maximum length of string (user input)<br>
A integer specifing the Maximum length of user input. If user input is more than maxInputLength then extra characters will be removed.

## 2. encoding

Encodes user input to the specifed encoding

See https://www.php.net/manual/en/function.htmlspecialchars<br>
For a list of encoding options

## 3. preventXSS

Do you want to prevent XSS strictly? True/False.

**Note:** If you set preventXSS as true then you should also set encoding to "UTF-8".

---------------------------------------------------------------------

[Back to home](README.md)
