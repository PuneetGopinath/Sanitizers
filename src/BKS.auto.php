<?php

/**
 * BK Sanitizers - Quickly Sanitize user data
 * Copyright (c) 2021 The BK Sanitizers Team
 * PHP Version 5.3
 *
 * @author    Puneet Gopinath (PuneetGopinath) <baalkrshna@gmail.com>
 * @copyright 2021 The BK Sanitizers Team
 * @license   http://www.opensource.org/licenses/MIT MIT
 * @see       https://github.com/PuneetGopinath/Sanitizers BKS on GitHub
 * @see       https://packagist.org/packages/sanitizers/sanitizers BKS on Packagist
 */

$dir = dirname(__FILE__);

require_once $dir . "/Sanitizer.php";
require_once $dir . "/SanitizerData.php";
if (is_readable($dir . "/HTMLPurifier/HTMLPurifier.auto.php")) {
    require_once $dir . "/HTMLPurifier/HTMLPurifier.auto.php";
}
