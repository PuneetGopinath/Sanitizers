<?php

/**
 * This file is part of the BK Sanitizers project.
 * Autoload file for BK Sanitizers
 * PHP Version 5.3.
 *
 * @package   BK_Sanitizers
 * @copyright 2021 The BK Sanitizers Team
 * @license   MIT
 * @see       https://github.com/PuneetGopinath/Sanitizers BK Sanitizers on GitHub
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Sanitizers\Sanitizers;

require_once dirname(__FILE__) . "/Sanitizer.php";

/**
 * SanitizerData class for Storing data required for Sanitizer class
 *
 * @author Puneet Gopinath (PuneetGopinath) <baalkrshna@gmail.com>
 */
class SanitizerData
{
    /**
     * Default configuration options
     *
     * @var array
     */
    public $config = array(
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

3. A bool indicating whether to prevent XSS strictly
*/

//If you set preventXSS as true then you should also set encoding to "UTF-8"
