<?php
/**
 * This file is part of the BK Sanitizers project.
 * Autoload file for BK Sanitizers
 * 
 * @see https://github.com/PuneetGopinath/Sanitizers
 * @license MIT
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sanitizers\Sanitizers;

require_once dirname(__FILE__) . "/Sanitizer.php";

namespace Sanitizers\Sanitizers;

class SanitizerData
{
    /**
     * Default configuration options
     * 
     * @var array
     */
    const config = array(
        "maxInputLength" => 100, // 1
        "encoding" => "UTF-8", // 2
        "preventXSS" => true // 3
    );
}
/*
1. Maximum length of string (user input)
If user input is more than maxInputLength then extra characters will be removed

2. See https://www.php.net/manual/en/function.htmlspecialchars
For a list of encoding options

3. A bool indicating whether to prevent XSS
*/

//If you set preventXSS as true then you should also set encoding to "UTF-8"
?>
