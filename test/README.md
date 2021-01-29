# Sanitizers

You can test PHP Sanitizers using the file **SanitizersTest.php**

You will get an output which is similar to this.<br>
&rarr;

```
Array Key -- Original Value => Sanitized Value

hex -- c97a2e8c539c4ee07314fdb22be9a28753d73e7c6310aa43d5813b5d59d76f67 => c97a2e8c539c4ee07314fdb22be9a28753d73e7c6310aa43d5813b5d59d76f67

name -- Some Name ä� => Some Name

email -- ADMIN@ExAMpLe.com => admin@example.com

message -- Sanitizers - Quickly sanitize user data.
See this github project at https://github.com/PuneetGopinath/Sanitizers
Keywords: ["Sanitizers","back-end","Sanitize","web","PHP Sanitizers","Sanitize user input"]. => Sanitizers - Quickly sanitize user data.
See this github project at https://github.com/PuneetGopinath/Sanitizers
Keywords: [&quot;Sanitizers&quot;,&quot;back-end&quot;,&quot;Sanitize&quot;,&quot;web&quot;,&quot;PHP Sanitizers&quot;,&quot;Sanitize user input&quot;].

username -- PuneetGopinath => puneetgopinath


```