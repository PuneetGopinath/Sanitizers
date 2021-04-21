<?php

/**
 * BK Sanitizers - Quickly Sanitize user data
 * Copyright (c) 2021 The BK Sanitizers Team
 * PHP Version 5.3
 *
 * @author    Puneet Gopinath (PuneetGopinath) <baalkrshna@gmail.com>
 * @copyright 2021 The BK Sanitizers Team
 * @license   http://www.opensource.org/licenses/MIT MIT
 * @see       https://github.com/PuneetGopinath/Sanitizers BKS - GitHub
 * @see       https://packagist.org/packages/sanitizers/sanitizers BKS - Packagist
 */

namespace Sanitizers\Test;

use Sanitizers\Sanitizers\Sanitizer;
use Sanitizers\Sanitizers\SanitizerData;
use Yoast\PHPUnitPolyfills\TestCases\TestCase;
use PHPUnit\Framework\Assert;

/**
 * BK Sanitizers - unit test class.
 */
final class BKSTest extends TestCase
{
    /**
     * Holds the Sanitizer instance.
     *
     * @var Sanitizer
     */
    private $sanitizer;

    /**
     * Holds the SanitizerData instance.
     *
     * @var SanitizerData
     */
    private $sanitizerData;

    /**
     * Run before each test is started.
     */
    protected function set_up()
    {
        $this->sanitizer = new Sanitizer();
        $this->sanitizerData = new SanitizerData();
    }

    /**
     * Run after each test is completed.
     */
    protected function tear_down()
    {
        //Clean global variables
        $this->sanitizer = null;
        $this->sanitizerData = null;
    }

    /**
     * Test sanitize function.
     */
    public function testSanitize()
    {
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "hex",
                "d7b05d4f4e75ce249dda9bf9a5e9aa5f2bf7fae7ae10fc44fcef4ddd8603a4e4"
            ),
            "d7b05d4f4e75ce249dda9bf9a5e9aa5f2bf7fae7ae10fc44fcef4ddd8603a4e4"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "int",
                "1.5"
            ),
            "15"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "float",
                "1.5"
            ),
            "1.5"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "name",
                "\0saNiTiZeRs ä\x80"
            ),
            "Sanitizers"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "email",
                "<AdMiN@example.com>"
            ),
            "admin@example.com"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "message",
                "Hi Name<br><img src=http://example.com/No_file.png onerror=alert('XSS');></img>"
            ),
            "Hi Name"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "url",
                "http://example.com/index.php?username=<script>alert('XSS');</script>"
            ),
            "http://example.com/index.php?username=alert('XSS');"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "username",
                "PuneetGopinath"
            ),
            "puneetgopinath"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "html",
                "<b>Text in bold</b><!-- This is a comment --><link rel=stylesheet " .
                "src=http://ha.ckers.org/bad.css /><a href=\"javascript:alert('XSS');\">Click here</a>"
            ),
            "<b>Text in bold</b><!-- This is a comment --><link rel=stylesheet " .
            "src=http://ha.ckers.org/bad.css /><a href=\"javascript:alert('XSS');\">Click here</a>"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "password",
                "\$UnIQUe|`_-#pass•WorD%!?"
            ),
            "\$UnIQUe|`_-#passWorD%!?"
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "clean",
                "XSS <script>alert('XSS');</script>"
            ),
            "XSS"
        );
    }
}
