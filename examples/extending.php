<?php

/**
 * This example shows how to extend Sanitizer class to simplify your coding and add more features.
 */

//Import Sanitizer class into the global namespace
use Sanitizers\Sanitizers\Sanitizer;

require_once "../src/BKS.auto.php";

/**
 * Use Sanitizer as a base class and extend it
 */
class MySanitizer extends Sanitizer
{
    /**
     * MySanitizer class constructor.
     *
     * @param  bool|null                     $exceptions Do you want to enable exceptions?
     * @param  \Psr\Log\LoggerInterface|null $logger     You can pass an instance of a PSR-3 compatible logger here
     * @param   SanitizerData|null $sanitizerData The SanitizerData class
     * @return MySanitizer The MySanitizer class
     */
    public function __construct($exceptions = null, $logger = null, $sanitizerData = null)
    {
        //Don't forget to do this or other things may not be set correctly!
        parent::__construct($exceptions, $logger, $sanitizerData);
        $baseDir = dirname(dirname(__FILE__));
        //Load config from ini
        //Comment it out, if you don't want config from ini

        $this->configFromIni($baseDir . "/src/config.ini"); //replace `$baseDir . "/src/config.ini"` with path to config.ini
    }

    /**
     * Validate user input
     *
     * @param string $type
     * @param string $text
     * @return bool
     */
    public function validate($type, $text, $trim = true, $htmlspecialchars = true, $alpha_num = false, $ucwords = false)
    {
        if (empty($type)) {
            $type = gettype($text);

            if ($type === "string") {
                $type = "";
            }
        }

        $text = parent::sanitize($type, $text, $trim, $htmlspecialchars, $alpha_num, $ucwords);
        if (empty($text)) {
            return false;
        }

        switch (strtolower($type)) {
            case "int":
            case "integer":
                return filter_var($text, FILTER_VALIDATE_INT) ? true : false;
                break;
            case "float":
                return filter_var($text, FILTER_VALIDATE_FLOAT) ? true : false;
                break;
            case "hex":
                return preg_match_all("/[a-f0-9]/s", "", $text) ? true : false;
                break;
            case "url":
                return filter_var($text, FILTER_VALIDATE_URL) ? true : false;
                break;
            case "email":
                return filter_var($text, FILTER_VAIDATE_EMAIL) ? true : false;
                break;
            case "username":
                return preg_match_all("/[^a-z0-9]/s", "", $text) ? true : false;
                break;
            case "string":
            case "text":
            case "password":
            case "name":
            case "message":
            default:
                return is_string($text);
                break;
        }
        return false;
    }
}

$sanitizer = new MySanitizer(true);
try {
    if ($sanitizer->validate("name", "<script src=http://ha.ckers.org/xss.js></script>")) {
        echo "Name is valid." . PHP_EOL;
    } else {
        echo "Name is invalid." . PHP_EOL;
    }
} catch (Exception $e) {
    echo "Could not Sanitize user input.";
    echo $e->getMessage();
}
