# Notes

You can see the examples in this file to understand our code.

## PHP Sanitize Flags

1. FILTER_FLAG_STRIP_LOW<br>
**example:** "\0aä\x80" will become "aä\x80".
2. FILTER_FLAG_STRIP_HIGH<br>
**example:** "\0aä\x80" will become "\0a".
3. FILTER_FLAG_ALLOW_FRACTION<br>
**It allows a dot. example:** 100.25 will become 10025 without this flag.

See PHP flags official documentation in [php.net](http://php.net/manual/en/filter.filters.flags.php).

## Important Note

The file from where you are including **Sanitizers.php** should contain the file **config.php** in the directory where **Sanitizers.php** exists.