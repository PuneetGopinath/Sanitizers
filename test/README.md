<link rel="stylesheet" href="../docs/css/main.css" />

# Sanitizers Test

You can test PHP Sanitizers using the file **SanitizersTest.php**

If you run `composer test` or `php test/SanitizersTest.php -- --debug`
You will get an output which is similar to this.<br>
&rarr;

```
> php test/SanitizersTest.php -- --debug
Using composer autoload files

Using Sanitizers version: 1.0.2

Array Key -- Original Value => Sanitized Value

hex -- 44fe9d308ab4681036cdc0e72a4cc596eb999455ada075dada5c2df594d80852 => 44fe9d308ab4681036cdc0e72a4cc596eb999455ada075dada5c2df594d80852

int -- 31.5 => 315

float -- 31.5 => 31.5

name -- saNiTiZeRs ä� => Sanitizers

email -- AdMiN@ExAmPle.cOm => admin@example.com

message -- Sanitizers - Quickly sanitize user data.
See this project at https://github.com/PuneetGopinath/Sanitizers => Sanitizers - Quickly sanitize user data.
See this project at https://github.com/PuneetGopinath/Sanitizers

username -- PuneetGopinath => puneetgopinath

html -- <b>Text in bold</b><!-- This is a comment --><style>body {display: none;}</style> => <b>Text in bold</b><!-- This is a comment -->



Array Key -- Original Value => Auto Sanitized Value

hex -- 44fe9d308ab4681036cdc0e72a4cc596eb999455ada075dada5c2df594d80852 => 44fe9d308ab4681036cdc0e72a4cc596eb999455ada075dada5c2df594d80852

int -- 31.5 => 315

float -- 31.5 => 31.5

name -- saNiTiZeRs ä� => Sanitizers

email -- AdMiN@ExAmPle.cOm => admin@example.com

message -- Sanitizers - Quickly sanitize user data.
See this project at https://github.com/PuneetGopinath/Sanitizers => Sanitizers - Quickly sanitize user data.
See this project at https://github.com/PuneetGopinath/Sanitizers

username -- PuneetGopinath => puneetgopinath

html -- <b>Text in bold</b><!-- This is a comment --><style>body {display: none;}</style> => <b>Text in bold</b><!-- This is a comment -->

Debug_info: configFromIni: , {"Sanitizer":{"logger":null,"config":{"encoding":"UTF-8","maxInputLength":100,"slashes":true,"preventXSS":true},"ini":false,"exceptions":false},"version":"1.0.2"}
```