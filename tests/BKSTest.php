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
 * BK Sanitizers - phpunit test class.
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
                1.5
            ),
            15
        );
        $this->assertStringContainsString(
            $this->sanitizer->sanitize(
                "float",
                1.5
            ),
            1.5
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
                "http://example.com/index.php?username=test"
            ),
            "http://example.com/index.php?username=test"
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

    /**
     * Test sanitizeArray function.
     */
    public function testSanitizeArray()
    {
        $testValues = array(
            "hex" => "d7b05d4f4e75ce249dda9bf9a5e9aa5f2bf7fae7ae10fc44fcef4ddd8603a4e4",
            "int" => 1.5,
            "float" => 1.5,
            "name" => "\0saNiTiZeRs ä\x80",
            "email" => "<AdMiN@example.com>",
            "message" => "Hi Name<br><img src=http://example.com/No_file.png onerror=alert('XSS');></img>",
            "url" => "http://example.com/index.php?username=test",
            "username" => "PuneetGopinath",
            "html" => "<b>Text in bold</b><!-- This is a comment --><link rel=stylesheet " .
            "src=http://ha.ckers.org/bad.css /><a href=\"javascript:alert('XSS');\">Click here</a>",
            "password" => "\$UnIQUe|`_-#pass•WorD%!?",
            "clean" => "XSS <script>alert('XSS');</script>"
        );
        $filters = array(
            "types" => array(
                "hex" => "hex",
                "int" => "integer", //You can also use int ("int" => "int")
                "float" => "float",
                "name" => "name",
                "email" => "email",
                "message" => "message",
                "url" => "url",
                "username" => "username",
                "html" => "html",
                "password" => "password",
                "clean" => "clean" //Will use clean function
            ),
            "message" => array(
                "trim" => false, //Enables php trim function, default:true
                "htmlspecialchars" => true, //Enables using htmlspecialchars, default:true
                "alpha_num" => false, //Sets value to be alpha_numeric, default:false
                "ucwords" => false
            ),
            "html" => array(
                "tags" => "<b><i><em><p><a><br>"//Optinal Allowed tags
            )
        );
        $autoValues = $this->sanitizer->sanitizeArray($testValues, $filters);
        $expectedValues = array(
            "hex" => "d7b05d4f4e75ce249dda9bf9a5e9aa5f2bf7fae7ae10fc44fcef4ddd8603a4e4",
            "int" => 15,
            "float" => 1.5,
            "name" => "Sanitizers",
            "email" => "admin@example.com",
            "message" => "Hi Name",
            "url" => "http://example.com/index.php?username=test",
            "username" => "puneetgopinath",
            "html" => "<b>Text in bold</b><!-- This is a comment --><link rel=stylesheet " .
            "src=http://ha.ckers.org/bad.css /><a href=\"javascript:alert('XSS');\">Click here</a>",
            "password" => "\$UnIQUe|`_-#passWorD%!?",
            "clean" => "XSS"
        );
        $this->assertEquals($autoValues, $expectedValues);
    }
}
