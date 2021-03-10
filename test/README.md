<link rel="stylesheet" href="../docs/css/main.css" />

# Sanitizers Test

You can test PHP Sanitizers using the file **SanitizersTest.php**

You will get an output which is similar to this.<br>
&rarr;

```
> php test/SanitizersTest.php -- --debug
Using composer autoload files

Using Sanitizers version: 1.0.1

Array Key -- Original Value => Sanitized Value

hex -- 44fe9d308ab4681036cdc0e72a4cc596eb999455ada075dada5c2df594d80852 => 44fe9d308ab4681036cdc0e72a4cc596eb999455ada075dada5c2df594d80852

int -- 31.5 => 315

float -- 31.5 => 31.5

name -- saNiTiZeRs ä� => Sanitizers

email -- AdMiN@ExAmPle.cOm => admin@example.com

message -- Sanitizers - Quickly sanitize user data.
See this project at <a href='https://github.com/PuneetGopinath/Sanitizers'>GitHub</a> => Sanitizers - Quickly sanitize user data.
See this project at GitHub

username -- PuneetGopinath => puneetgopinath

html -- <b>Text in bold</b><!-- This is a comment --><style>body {display: none;}</style> => <b>Text in bold</b><!-- This is a comment -->



Array Key -- Original Value => Auto Sanitized Value

hex -- 44fe9d308ab4681036cdc0e72a4cc596eb999455ada075dada5c2df594d80852 => 44fe9d308ab4681036cdc0e72a4cc596eb999455ada075dada5c2df594d80852

int -- 31.5 => 315

float -- 31.5 => 31.5

name -- saNiTiZeRs ä� => Sanitizers

email -- AdMiN@ExAmPle.cOm => admin@example.com

message -- Sanitizers - Quickly sanitize user data.
See this project at <a href='https://github.com/PuneetGopinath/Sanitizers'>GitHub</a> => Sanitizers - Quickly sanitize user data.
See this project at GitHub

username -- PuneetGopinath => puneetgopinath

html -- <b>Text in bold</b><!-- This is a comment --><style>body {display: none;}</style> => <b>Text in bold</b><!-- This is a comment -->

Debug_info: {"logger":null,"config":{"maxInputLength":100,"encoding":"UTF-8","preventXSS":true,"slashes":true},"ini":false,"exceptions":false}
```