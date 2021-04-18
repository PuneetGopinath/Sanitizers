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
 * Sanitizer class for Sanitizing user input
 *
 * @author Puneet Gopinath (PuneetGopinath) <baalkrshna@gmail.com>
 */
class Sanitizer
{
    /**
     * BKS Version number.
     * Used for easier checks, like if BKS is up to date or not
     *
     * @var string VERSION The Version number
     */
    const VERSION = "1.1.0";

    /**
     * Do you want to enable exceptions?
     * You can pass a bool in __construct method in parameter 1
     *
     * Example:
     * ```php
     * $sanitizer = new Sanitizer(true);
     * ```
     *
     * @var bool|null $exceptions Do you want to throw exceptions?
     */
    protected $exceptions = null;

    /**
     * Optional LoggerInterface for debugging
     * You can pass an instance of a PSR-3 compatible logger
     * in __construct method in parameter 2
     *
     * Example:
     * ```php
     * $logger = new myPsr3Logger();
     * $sanitizer = new Sanitizer(false, $logger);
     * ```
     *
     * @var \Psr\Log\LoggerInterface|null $logger The PSR-3 compatible logger
     */
    protected $logger = null;

    /**
     * The SanitizerData class
     *
     * @var SanitizerData|null $sanitizerData The SanitizerData class
     */
    protected $sanitizerData = null;

    /**
     * Configuration settings
     *
     * @var array $config The configuration options
     */
    protected $config = array();

    /**
     * Are we using config settings from ini ?
     *
     * @var bool $ini Are we using config settings from ini ?
     */
    protected $ini = false;

    /**
     * Sanitizer class constructor.
     *
     * @param  bool|null                     $exceptions Do you want to enable exceptions?
     * @param  \Psr\Log\LoggerInterface|null $logger     You can pass an instance of a PSR-3 compatible logger here
     * @param   SanitizerData|null $sanitizerData The SanitizerData class
     * @return Sanitizer The Sanitizer class
     */
    public function __construct($exceptions = null, $logger = null, $sanitizerData = null)
    {
        $a = is_a($sanitizerData, __NAMESPACE__ . "\SanitizerData");
        if (empty($sanitizerData) || !$a) {
            $this->sanitizerData = new SanitizerData();
        } elseif (!empty($this->sanitizerData) && $a) {
            $this->sanitizerData = $sanitizerData;
        }

        $sanitizerData = null;
        $this->exceptions = (bool) $exceptions;
        $this->logger = $logger;

        $this->set("*", $this->sanitizerData->config);
    }

    /**
     * Warning message
     *
     * @param string      $msg         The Warning message
     * @param string|null $depreciated If the warning is for depreciated mention it here
     * @param string $deprecatedType What is deprecated, function?, argument?
     * @return string The full Warning message
     */
    private function warn($msg, $depreciated = null, $deprecatedType = "function")
    {
        $message = "Warning: BK Sanitizers: ";
        if (!empty($depreciated)) {
            $message .= "Using depreciated " . $deprecatedType . $depreciated . ", " . $msg;
            error_log($message);
            return $message;
        }
        $message .= $msg;
        error_log($message);
        return $message;
    }

    /**
     * Fatal Error message
     *
     * @param  $msg The Fatal Error message
     * @return string The full Fatal Error message
     */
    private function fatal($msg)
    {
        $msg = "Fatal Error: BK Sanitizers: " . $msg;
        error_log($msg);
        return $msg;
    }

    /**
     * Get config - Useful for debugging purpose
     *
     * @return array The config settings
     */
    public function getConfig()
    {
        return $this->config;
    }

    /**
     * Load configuration from ini file
     *
     * @param  string $file Path to config.ini file
     * @return null Nothing to return, So null
     */
    public function configFromIni($file = "config.ini")
    {
        $ini = parse_ini_file($file, true);
        $this->set("*", $ini);
        $this->ini = true;
        return null;
    }

    /**
     * Modify configuration options temporarily
     *
     * @param  string       $case  The key of the setting
     * @param  string|array $value The value of the setting
     * @return bool Whether the config option has been modified or not
     */
    public function set($case, $value = "default")
    {
        if (!is_array($this->config)) {
            $this->config = array();
        }

        switch ($case) {
            case "encoding":
                $this->config["encoding"] = (string)$value;
                break;
            case "maxInputLength":
                $this->config["maxInputLength"] = (int)$value;
                break;
            case "preventXSS":
                $this->config["preventXSS"] = (bool)$value;
                break;
            case "*":
                if (
                    $this->set("encoding", $value["encoding"]) &&
                    $this->set("maxInputLength", $value["maxInputLength"]) &&
                    $this->set("preventXSS", $value["preventXSS"])
                ) {
                    return true;
                }
                break;
            default:
                if ($this->exceptions) {
                    throw new \Exception($this->fatal("Invalid config key: $case with value: $value"));
                }
                return false;
                break;
        }

        if (
            isset($this->config["preventXSS"]) &&
            isset($this->config["encoding"])
        ) {
            if (
                $this->config["preventXSS"] === true &&
                strtoupper($this->config["encoding"]) !== "UTF-8"
            ) {
                $msg = $this->fatal("If you set preventXSS as true then you should also set encoding to \"UTF-8\"");
                if ($this->logger) {
                    $this->logger->error($msg);
                }
                throw new \Error($msg);
                return false;
            }
        }

        if ($value === "default") {
            $this->config[$case] = $this->sanitizerData->config[$case];
        }
        return true;
    }

    /**
     * Default Sanitizing input function
     *
     * @param  string $text             The input data.
     * @param  bool   $trim             Do you want to trim the input data?
     * @param  bool   $htmlspecialchars Do you want to use htmlspecialchars in input data?
     * @param  bool   $alpha_num        Is the input data alpha numeric?
     * @param  bool   $ucwords          Do you want to convert first letter of each word to upper case?
     * @return string The sanitized string
     */
    public function clean($text, $trim = true, $htmlspecialchars = true, $alpha_num = false, $ucwords = false)
    {
        $text = $this->stripTagsContent((string)$text);

        if (
            $htmlspecialchars &&
            $this->config["preventXSS"]
        ) {
            $text = htmlspecialchars($text, ENT_QUOTES, "UTF-8");
        } elseif (
            $htmlspecialchars &&
            !($this->config["preventXSS"])
        ) {
            $text = htmlspecialchars($text, ENT_QUOTES, $this->config["encoding"]);
        }

        if ($trim) {
            $text = trim($text);
        }

        if ($alpha_num) {
            $text = preg_replace("/\W/si", "", $text);
        }

        $text = str_replace(chr(0)/*NULL character*/, "", $text); //Remove NULL character

        if (mb_strlen($text) > $this->config["maxInputLength"]) {
            $text = mb_substr($text, 0, $this->config["maxInputLength"]);
        }

        if ($this->config["preventXSS"]) {
            $text = utf8_encode($text);
        }

        if (function_exists("iconv") && $this->config["preventXSS"]) {
            $text = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
        } elseif (!function_exists("iconv")) {
            $this->warn("PHP extension iconv not installed.");
        }

        if ($ucwords) {
            $text = ucwords(strtolower($text));
        }

        return $text;
    }

    /**
     * Sanitize a input
     *
     * @param  string           $type             The input type.
     * @param  string|int|float $text             The input data.
     * @param  bool             $trim             Do you want to trim the input data?
     * @param  bool             $htmlspecialchars Do you want to use php htmlspecialchars function on the input data?
     * @param  bool             $alpha_num        Is the input data alpha numeric?
     * @param  bool             $ucwords          Do you want to convert first letter of each word to upper case?
     * @return string|int|float The sanitized string or int or float
     */
    public function sanitize($type, $text, $trim = true, $htmlspecialchars = true, $alpha_num = false, $ucwords = false)
    {
        $input = $text;
        if (empty($type)) {
            $type = gettype($text);

            if ($type === "string") {//If $type is not given and php detects it as a string
                $type = ""; //Then use the default clean function
            }
        }

        $text = (string)$text;

        switch (strtolower($type)) {
            case "int":
            case "integer":
                $text = preg_replace("/[^0-9]/s", "", filter_var($text, FILTER_SANITIZE_NUMBER_INT));
                $text = (int)intval($text) + 0;
                break;
            case "float":
                $text = filter_var($text, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
                $text = (float)floatval(preg_replace("/[^0-9.]/s", "", $text)) + 0;
                break;
            case "string":
            case "text":
                $text = $this->clean($text, $trim, $htmlspecialchars, $alpha_num, $ucwords);
                $text = filter_var(
                    $text,
                    FILTER_SANITIZE_STRING,
                    FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH
                );
                $text = preg_replace("/[^A-Za-z0-9]/s", "", $text);
                break;
            case "hex":
                $text = filter_var(
                    $text,
                    FILTER_SANITIZE_STRING,
                    FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH
                );
                $text = preg_replace("/[^a-f0-9]/s", "", $text);
                $text = $this->clean($text, $trim, $htmlspecialchars, true, false);
                break;
            case "url":
                $text = filter_var($this->stripTagsContent($text), FILTER_SANITIZE_URL);
                break;
            case "password":
                $text = filter_var(
                    $text,
                    FILTER_SANITIZE_STRING,
                    FILTER_FLAG_NO_ENCODE_QUOTES | FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH
                );
                $text = $this->clean($text, false, false, false, false);
                break;
            case "name":
                $text = filter_var(
                    $text,
                    FILTER_SANITIZE_STRING,
                    FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH
                );
                $text = preg_replace("/[^A-Za-z\s+]/s", "", $text);
                $text = $this->clean($text, $trim, $htmlspecialchars, $alpha_num, true);
                break;
            case "message":
                $text = $this->clean($text, false, true, false, false);
                break;
            case "email":
                $text = $this->clean($text, $trim, $htmlspecialchars, false, false);
                $text = filter_var(strtolower($text), FILTER_SANITIZE_EMAIL);
                break;
            case "username":
                $text = $this->sanitize("text", $text, $trim, $htmlspecialchars, true, false);
                $text = preg_replace("/[^a-z0-9]/s", "", strtolower($text));
                break;
            default:
                $text = $this->clean($text, $trim, $htmlspecialchars, $alpha_num, $ucwords);
                break;
        }
        if ($this->logger) {
            $array = array("input" => $input,"output" => $text);
            $this->logger->debug(
                "Sanitized input (\"{input}\") to (\"{output}\")",
                $array
            );
        }
        return $text;
    }

    /**
     * Text without any number (Depreciated)
     *
     * @param  string $text             The input data.
     * @param  bool   $trim             Do you want to trim the input data?
     * @param  bool   $htmlspecialchars Do you want to use php htmlspecialchars function on the input data?
     * @param  bool   $alpha_num
     * @return string The sanitized string
     */
    public function NonNumericText($text, $trim = true, $htmlspecialchars = true, $alpha_num = false, $ucwords = false)
    {
        $this->warn(
            "use sanitize function with type param as \"text\" (see functions in docs for more info)",
            "NonNumericText"
        );
        $text = $this->sanitize("text", (string)$text, $trim, $htmlspecialchars, $alpha_num, $ucwords);
        $text = preg_replace("/[^A-Za-z]/s", "", $text);
        return $text;
    }

    /**
     * https://www.php.net/manual/en/function.strip-tags.php#86964
     *
     * @param  string $text   The html code.
     * @param  string $tags   The allowed html tags.
     * @param  bool   $invert Do you want to change parameter #2 to `The disallowed html tags.`?
     * @return string The striped string
     */
    private function stripTagsContent($text, $tags = "", $invert = false)
    {
        preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
        $tags = array_unique($tags[1]);

        if (is_array($tags) && count($tags) > 0) {
            if ($invert === false) {
                return preg_replace('@<(?!(?:' . implode("|", $tags) . ')\b)(\w+)\b.*?>.*?</\1>@si', "", $text);
            } else {
                return preg_replace('@<(' . implode("|", $tags) . ')\b.*?>.*?</\1>@si', "", $text);
            }
        } elseif ($invert === false) {
            return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', "", $text);
        }
        return $text;
    }

    /**
     * Sanitize a html code
     *
     * @param  string $text
     * @param  string $tags
     * @return string The sanitized html code
     */
    public function HTML($text, $tags = "<b><i><em><p><a><br>")
    {
        // Remove any attribute starting with on or xmlns
        $text = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', (string)$text);
        $text = $this->stripTagsContent((string)$text, $tags);
        if (class_exists("\HTMLPurifier")) {
            $config = \HTMLPurifier_Config::createDefault();
            $purifier = new \HTMLPurifier($config);
            $clean_html = $purifier->purify($text);
        } else {
            $this->warn("HTMLPurifier is not installed or required (See INSTALL.md for more info).");
            $clean_html = $text;
        }

        return $clean_html;
    }

    /**
     * Sanitize a array
     *
     * @param  array $array The input array.
     * @param  array $filters The filters to apply to the values in the array
     * @return array The sanitized array
     */
    public function sanitizeArray($array, $filters = array("types" => array()))
    {
        foreach ($array as $key => $value) {
            $settings = array("trim" => true, "htmlspecialchars" => true, "alpha_num" => false, "ucwords" => false);
            if (isset($filters[$key])) {
                foreach ($settings as $key2 => $value2) {
                    if (isset($filters[$key][$key2])) {
                        $settings[$key2] = $filters[$key][$key2];
                    }
                }
            }

            if (empty($filters["types"][$key])) {
                $filters["types"][$key] = gettype($value);
                if ($filters["types"][$key] === "string") {
                    $filters["types"][$key] = "";
                }
            }

            if (empty($filters[$key]["tags"]) && $filters["types"][$key] === "html") {
                $filters[$key]["tags"] = "<b><i><em><p><a><br>";
            }

            $trim = $settings["trim"];
            $htmlspecialchars = $settings["htmlspecialchars"];
            $alpha_num = $settings["alpha_num"];
            $ucwords = $settings["ucwords"];

            switch (strtolower($filters["types"][$key])) {
                case "int":
                case "integer":
                    $sanitized = $this->sanitize("integer", $value);
                    break;
                case "float":
                    $sanitized = $this->sanitize("float", $value);
                    break;
                case "string":
                case "text":
                    $sanitized = $this->sanitize("text", $value, $trim, $htmlspecialchars, $alpha_num, $ucwords);
                    break;
                case "hex":
                    $sanitized = $this->sanitize("hex", $value, $trim, $htmlspecialchars, true, false);
                    break;
                case "url":
                    $sanitized = $this->sanitize("url", $value);
                    break;
                case "password":
                    $sanitized = $this->sanitize("password", $value);
                    break;
                case "name":
                    $sanitized = $this->sanitize("name", $value, $trim, $htmlspecialchars, true, $ucwords);
                    break;
                case "message":
                    $sanitized = $this->clean($value, false, true, false, false);
                    break;
                case "email":
                    $sanitized = $this->sanitize("email", $value, $trim, $htmlspecialchars, false, false);
                    break;
                case "username":
                    $sanitized = $this->sanitize("username", $value, $trim, $htmlspecialchars, true, false);
                    break;
                case "html":
                    $sanitized = $this->HTML($value, $filters[$key]["tags"]);
                    break;
                default:
                    $sanitized = $this->clean($value, $trim, $htmlspecialchars, $alpha_num, $ucwords);
                    break;
            }

            $array[$key] = $sanitized;
        }
        return $array;
    }
}
