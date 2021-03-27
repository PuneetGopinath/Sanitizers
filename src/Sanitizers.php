<?php
/**
 * Sanitizers - Quickly Sanitize user data
 * Copyright (c) 2021 The BK Sanitizers Team
 * 
 * @see https://github.com/PuneetGopinath/Sanitizers
 * @see https://packagist.org/packages/sanitizers/sanitizers
 * @license MIT
 * @author Puneet Gopinath (PuneetGopinath) <baalkrshna@gmail.com>
 */

namespace Sanitizers\Sanitizers;

require dirname(__FILE__) . "/bootstrap.php";

/**
 * Sanitizer class for Sanitizing user input
 */
class Sanitizer
{
    /**
     * Do you want to enable exceptions? You can pass a bool in __construct method in parameter 1
     * 
     * ```php
     * $sanitizer = new Sanitizer(true);
     * ```
     * 
     * @var bool
     */
    protected $exceptions = null;

    /**
     * Optional LoggerInterface for debugging, You can pass an instance of a PSR-3 compatible logger in __construct method in parameter 2
     * 
     * ```php
     * $logger = new myPsr3Logger();
     * $sanitizer = new Sanitizer(false, $logger);
     * ```
     * 
     * @var \Psr\Log\LoggerInterface|null
     */
    public $logger = null;

    /**
     * Configuration settings
     * 
     * @var array
     */
    public $config = array();

    /**
     * Message for fatal error
     * 
     * @var string
     */
    private $fatal = "Fatal Error: Sanitizers: ";

    /**
     * Message for warning
     * 
     * @var string
     */
    private $warn = "Warning: Sanitizers: ";

    /**
     * Sanitizers Version number.
     * 
     * @var string
     */
    const VERSION = "1.1.0";

    /**
     * Are we using config settings from ini ?
     * 
     * @var bool
     */
    public $ini = false;

    /**
     * Sanitizer class constructor.
     * 
     * @param bool|null $exceptions Do you want to enable exceptions?
     * @param \Psr\Log\LoggerInterface|null $logger You can pass an instance of a PSR-3 compatible logger here
     * @return Sanitizer
     */
    public function __construct($exceptions=null, $logger=null)
    {
        $this->exceptions = (bool) $exceptions;
        $this->logger = $logger;

        $this->set("*", config);
    }

    /**
     * Load configuration from ini file
     * 
     * @param string $file Path to config.ini file
     * @return null
     */
    public function configFromIni($file="config.ini")
    {
        $ini = parse_ini_file($file, true);
        $this->set("*", $ini);
        $this->ini = true;
        return null;
    }

    /*
     * Modify configuration options temporarily
     * 
     * @param string $case The key of the setting
     * @param string|array $value The value of the setting
     * @return bool
     */
    public function set($case, $value="default")
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
            case "escape":
                $this->config["escape"] = (bool)$value;
                break;
            case "preventXSS":
                $this->config["preventXSS"] = (bool)$value;
                break;
            case "*":
                if (
                    $this->set("encoding", $value["encoding"]) &&
                    $this->set("maxInputLength", $value["maxInputLength"]) &&
                    $this->set("escape", $value["escape"]) &&
                    $this->set("preventXSS", $value["preventXSS"])
                ) {
                    return true;
                }
                break;
            default:
                if ($this->exceptions) {
                    throw new \Exception($this->fatal . "Invalid config key: $case with value: $value");
                }
                return false;
                break;
        }

        if (isset($this->config["preventXSS"]) && (isset($this->config["encoding"]) || isset($this->config["escape"]))) {
            if ($this->config["preventXSS"] === true && (strtoupper($this->config["encoding"]) !== "UTF-8" || $this->config["escape"] !== true)) {
                $msg = $this->fatal . "If you set preventXSS as true then you should also set encoding to \"UTF-8\" and escape to true";
                if ($this->logger) {
                    $this->logger->error($msg);
                }
                throw new \Error($msg);
                return false;
            }
        }

        if ($value === "default") {
            $this->config[$case] = config[$case];
        }
        return true;
    }

    /**
     * Default Sanitizing input function
     * 
     * @param string $text The input data.
     * @param bool $trim Do you want to trim the input data?
     * @param bool $htmlspecialchars Do you want to use htmlspecialchars in input data?
     * @param bool $alpha_num Is the input data alpha numeric?
     * @param bool $ucwords Do you want to automatically add upper case letters to each words?
     * @return string
     */
    public function clean($text, $trim=true, $htmlspecialchars=true, $alpha_num=false, $ucwords=false)
    {
        if ($trim)
            $text = trim($text);

        if ($this->config["escape"])
            $text = $this->escape((string)$text);

        // Remove any attribute starting with on or xmlns
        $text = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $text);

        $text = preg_replace("/<([a-z][a-z0-9]*)[^>]*?(\/?)>/si",'<$1$2>', $text); //See: https://stackoverflow.com/a/3026235
        //We are not sanitizing html code so remove all html code and attributes
        $text = strip_tags($this->HTML($text));
        if ($alpha_num)
            $text = preg_replace("/\W/si", "", $text);

        $text = str_replace(chr(0)/*NULL character*/, "", $text); //Remove NULL character

        if (mb_strlen($text) > $this->config["maxInputLength"]) {
            $text = mb_substr($text, 0, $this->config["maxInputLength"]);
        }

        if ($htmlspecialchars && $this->config["escape"]) {
            $text = htmlspecialchars(htmlspecialchars_decode($text, ENT_QUOTES), ENT_QUOTES | ENT_SUBSTITUTE, $this->config["encoding"]);
        } else if ($htmlspecialchars && !($this->config["escape"])) {
            $text = htmlspecialchars($text, ENT_QUOTES | ENT_SUBSTITUTE, $this->config["encoding"]);
        }

        if ($this->config["preventXSS"]) {
            $text = utf8_encode($text);
        }

        if (function_exists("iconv") && $this->config["preventXSS"]) {
            $text = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
        } else if (!function_exists("iconv")) {
            error_log($this->warn . "PHP extension iconv not installed.");
        }

        if ($ucwords)
            $text = ucwords(strtolower($text));

        return $text;
    }

    /**
     * Escape input
     * 
     * No need to use this function if you used clean or sanitize function on the input string.
     * 
     * @param $input The input data.
     * @return string
     */
    public function escape($input)
    {
        return htmlspecialchars(addslashes(stripslashes($input)), ENT_QUOTES, "UTF-8");
    }

    /**
     * Sanitize a input
     * 
     * @param string $type The input type.
     * @param string|int|float $text The input data.
     * @param bool $trim
     * @param bool $htmlspecialchars
     * @param bool $alpha_num
     * @param bool $ucwords
     * @return string|int|float
     */
    public function sanitize($type, $text, $trim=true, $htmlspecialchars=true, $alpha_num=false, $ucwords=false)
    {
        $input = $text;
        if (!isset($type) || is_null($type)) {
            $type = gettype($text);

            if (gettype($text) === "string") {//If $type is not given and php detects it as a string
                $type = "message"; //Then take it as message (because We don't know whether it contains EOL)
            }
        }

        switch (strtolower($type)) {
            case "int":
            case "integer":
                $text = preg_replace("/[^0-9]/s", "", filter_var((string)$text, FILTER_SANITIZE_NUMBER_INT));
                $text = (int)$text+0;
                break;
            case "float":
                $text = preg_replace("/[^0-9.]/s", "", filter_var((string)$text, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
                $text = (float)$text+0;
                break;
            case "string":
            case "text":
                $text = preg_replace("/[^A-Za-z0-9]/s", "", filter_var($this->clean((string)$text, $trim, $htmlspecialchars, $alpha_num, $ucwords), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));
                break;
            case "hex":
                $text = preg_replace("/[^a-f0-9]/s", "", filter_var($this->clean((string)$text, $trim, $htmlspecialchars, $alpha_num, false), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));
                break;
            case "url":
                $text = filter_var(strip_tags((string)$text), FILTER_SANITIZE_URL);
                break;
            case "password":
                $text = filter_var($this->clean((string)$text, false, false, false, false), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH);
                break;
            case "name":
                $text = $this->clean(preg_replace("/[^A-Za-z\s+]/s", "", filter_var((string)$text, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH)), $trim, $htmlspecialchars, $alpha_num, true);
                break;
            case "message":
                $text = $this->clean($text, false, true, false, false);
                break;
            case "email":
                $text = filter_var(strtolower($this->clean((string)$text, $trim, $htmlspecialchars, false, false)), FILTER_SANITIZE_EMAIL);
                break;
            case "username":
                $text = preg_replace("/[^a-z0-9]/s", "", strtolower($this->sanitize("text", (string)$text, $trim, $htmlspecialchars, $alpha_num, false)));
                break;
            default:
                $text = $this->clean($text, $trim, $htmlspecialchars, $alpha_num, $ucwords);
                break;
        }
        if ($this->logger) {
            $this->logger->debug("Sanitized given input \"{input}\" to \"{output}\".", array("input" => $input,"output" => $text));
        }
        return $text;
    }

    /**
     * Text without any number (Depreciated)
     * 
     * @param string $text
     * @param bool $trim
     * @param bool $htmlspecialchars
     * @param bool $alpha_num
     * @return string
     */
    public function NonNumericText($text, $trim=true, $htmlspecialchars=true, $alpha_num=false)
    {
        error_log($this->warn . "You are using the depreciated function NonNumericText instead use the sanitize function with type parameter as \"text\" (see FUNCTIONS.md in docs for understanding sanitize function)");
        $text = preg_replace("/[^A-Za-z]/s", "", $this->sanitize("text", (string)$text, $trim, $htmlspecialchars));
        return $text;
    }

    /**
     * https://www.php.net/manual/en/function.strip-tags.php#86964
     * 
     * @param string $text
     * @param string $tags
     * @param bool $invert
     * @return string
     */
    private function strip_tags_content($text, $tags="", $invert=false)
    {
        preg_match_all('/<(.+?)[\s]*\/?[\s]*>/si', trim($tags), $tags);
        $tags = array_unique($tags[1]);

        if (is_array($tags) && count($tags) > 0) {
            if ($invert === false) {
                return preg_replace('@<(?!(?:'. implode("|", $tags) .')\b)(\w+)\b.*?>.*?</\1>@si', "", $text);
            } else {
                return preg_replace('@<('. implode("|", $tags) .')\b.*?>.*?</\1>@si', "", $text);
            }
        } else if ($invert === false) {
            return preg_replace('@<(\w+)\b.*?>.*?</\1>@si', "", $text);
        }
        return $text;
    }

    /**
     * Sanitize a html code
     * 
     * @param string $text
     * @param string $tags
     * @return string
     */
    public function HTML($text, $tags="<b><i><em><p><a><br>")
    {

        $text = $this->strip_tags_content(preg_replace(array("/javascript:/si", "/src=/si"), "", (string)$text), $tags);

        return $text;
    }

    /**
     * Sanitize a array
     * 
     * @param array $array
     * @param array $filters
     * @return array
     */
    public function sanitizeArray($array, $filters=array("types"=>array()))
    {
        foreach ($array as $key => $value)
        {
            $settings = array("trim" => true, "htmlspecialchars" => true, "alpha_num" => false, "ucwords" => true);
            if (isset($filters[$key]))
            {
                if (is_string($filters[$key])) {
                    $filters[$key] = explode("|", $filters[$key]);
                    $filters[$key] = array_combine($filters[$key], $filters[$key]);
                }
                foreach ($settings as $key2 => $value2) {
                    if (isset($filters[$key][$key2]))
                        $settings[$key2] = $filters[$key][$key2];
                    if (is_string($settings[$key2]))
                        $settings[$key2] = true;
                }
            }

            if (!isset($filters["types"][$key])) {
                $filters["types"][$key] = gettype($value);
                if ($filters["types"][$key] === "string") {
                    $filters["types"][$key] = "message";
                }
            }

            if (empty($filters[$key]["tags"]) && $filters["types"][$key] === "html") {
                $filters[$key]["tags"] = "<b><i><em><p><a><br>";
            }

            switch (strtolower($filters["types"][$key])) {
                case "int":
                case "integer":
                    $sanitized = $this->sanitize("integer", $value, $settings["trim"], $settings["htmlspecialchars"], $settings["alpha_num"], $settings["ucwords"]);
                    break;
                case "string":
                case "text":
                    $sanitized = $this->sanitize("text", $value, $settings["trim"], $settings["htmlspecialchars"]);
                    break;
                case "hex":
                    $sanitized = $this->sanitize("hex", $value, $settings["trim"], $settings["htmlspecialchars"], $settings["alpha_num"], $settings["ucwords"]);
                    break;
                case "float":
                    $sanitized = $this->sanitize("float", $value, $settings["trim"], $settings["htmlspecialchars"], $settings["alpha_num"], $settings["ucwords"]);
                    break;
                case "name":
                    $sanitized = $this->sanitize("name", $value, $settings["trim"], $settings["htmlspecialchars"], $settings["alpha_num"], $settings["ucwords"]);
                    break;
                case "username":
                    $sanitized = $this->sanitize("username", $value, $settings["trim"], $settings["htmlspecialchars"], $settings["alpha_num"], $settings["ucwords"]);
                    break;
                case "email":
                    $sanitized = $this->sanitize("email", $value, $settings["trim"], $settings["htmlspecialchars"], false);
                    break;
                case "html":
                    $sanitized = $this->HTML($value, $filters[$key]["tags"]);
                    break;
                case "array":
                    $sanitized = $this->sanitizeArray($value, $settings);
                    break;
                case "url":
                    $sanitized = $this->sanitize("url", $value);
                    break;
                case "message":
                    $sanitized = $this->clean($value, false, true, false, false);
                    break;
                default:
                    $sanitized = $this->clean($value, $settings["trim"], $settings["htmlspecialchars"], $settings["alpha_num"], $settings["ucwords"]);
                    break;
            }

            $array[$key] = $sanitized;
        }
        return $array;
    }
}
?>
