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

namespace Sanitizers\Sanitizers;

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
     * @var array $config The configuration options
     */
    public $config = array(
        "maxInputLength" => 100,
        "encoding" => "UTF-8",
        "preventXSS" => true
    );
}
