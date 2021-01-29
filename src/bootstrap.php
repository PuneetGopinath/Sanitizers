<?php
/**
 * This file is part of the BK Sanitizers project.
 * Bootstrap file for BK Sanitizers
 * 
 * @see https://github.com/PuneetGopinath/Sanitizers
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sanitizers\Sanitizers;

const config = array(
    "maxInputLength" => 100, // 1
    "encoding" => "UTF-8", // 2
    "preventXSS" => true, // 3
    "slashes" => true // 4
);
/*
1. Maximum length of string (user input)
if user input is more than maxInputLength then extra characters will be removed

2. See https://www.php.net/manual/en/function.htmlspecialchars
For a list of encoding options

3. A boolen indicating whether to prevent XSS

4. A bool indicating whether to add slashes
*/

use \PHP_EOL;

//See: https://stackoverflow.com/a/255531
if (!defined("PHP_EOL")) {
    switch (strtoupper(substr(PHP_OS, 0, 3))) {
        // Windows
        case "WIN":
            define("PHP_EOL", "\r\n");
            break;

        // Mac
        case "DAR":
            define("PHP_EOL", "\r");
            break;

        // Unix
        default:
            define("PHP_EOL", "\n");
    }
}
?>
