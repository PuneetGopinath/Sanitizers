# Sanitizers Test

You can test PHP Sanitizers using the file **SanitizersTest.php**

You will get an output which is similar to this.<br>
&rarr;

```
$ composer test
> php test/SanitizersTest.php
Not using composer

Array Key -- Original Value => Sanitized Value

hex -- 9120b35c7bfe2ffb5116735966f08aa670140fc5ddfb6c6ded566f24867cf781 => 9120b35c7bfe2ffb5116735966f08aa670140fc5ddfb6c6ded566f24867cf781

int -- 31.5 => 315

float -- 31.5 => 31.5

name -- Some Name ä� => Some Name

email -- ADMIN@ExAMpLe.com => admin@example.com

message -- Hi <script>alert('I am XSS');</script> => Hi &lt;script&gt;alert(&#039;I am XSS&#039;);&lt;/script&gt;

username -- PuneetGopinath => puneetgopinath
```
