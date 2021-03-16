<?php
/**
 * PHP Sanitizers - Quickly Sanitize user data
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
     * Optional LoggerInterface for debugging used if psr/log package is installed.
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
    const VERSION = "1.0.1";

    /**
     * Are we using config settings from ini
     * 
     * @var bool
     */
    public $ini = false;

    /**
     * Create new Sanitizers class
     * 
     * @param bool $exceptions
     * @param \Psr\Log\LoggerInterface $logger
     * @return Sanitize
     */
    public function __construct($exceptions=null, $logger=null)
    {
        $this->exceptions = (bool) $exceptions;
        $this->logger = $logger;

        $this->set("*", config);
    }

    /**
     * Returns Sanitizers version
     * 
     * @return string
     */
    public function getVersion()
    {
        return self::VERSION;
    }

    /**
     * Load configuration from ini file
     * 
     * @param string $file
     * @return ""
     */
    public function configFromIni($file="config.ini")
    {
        $ini = parse_ini_file($file, true);
        $this->set("*", $ini);
        $this->ini = true;
        return "";
    }

    /**
     * Change configuration options
     * 
     * @param string $case
     * @param string|array $value
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
            case "slashes":
                $this->config["slashes"] = (bool)$value;
                break;
            case "preventXSS":
                $this->config["preventXSS"] = (bool)$value;
                break;
            case "*":
                $this->set("encoding", $value["encoding"]);
                $this->set("maxInputLength", $value["maxInputLength"]);
                $this->set("slashes", $value["slashes"]);
                $this->set("preventXSS", $value["preventXSS"]);
                return true;
                break;
            default:
                if ($this->exceptions) {
                    throw new \Exception($this->fatal . "Invalid config key: $case with value: $value");
                }
                return false;
                break;
        }

        if (isset($this->config["preventXSS"]) && isset($this->config["encoding"])) {
            if ($this->config["preventXSS"] === true && strtoupper($this->config["encoding"]) !== "UTF-8") {
                $msg = $this->fatal . "If you set preventXSS as true then you should also set encoding to UTF-8";
                if ($this->logger) {
                    $this->logger->error($msg);
                }
                throw new \Error($msg);
            }
        }

        if ($value === "default") {
            $this->config[$case] = config[$case];
        }
        return true;
    }

    /**
     * Default Sanitizing user input function
     * 
     * @param string $text
     * @param bool $trim
     * @param bool $html_entities
     * @param bool $alpha_num
     * @param bool $ucwords
     * @return string
     */
    public function clean($text, $trim=true, $html_entities=true, $alpha_num=false, $ucwords=true)
    {
        if ($alpha_num)
            $text = preg_replace("/\W/si", "", $text);

        $text = strip_tags(str_replace(chr(0)/*Remove NULL character*/, "", $text));

        if (mb_strlen($text) > $this->config["maxInputLength"]) {
            $text = mb_substr($text, 0, $this->config["maxInputLength"]);
        }

        if ($html_entities) {
            $text = htmlspecialchars($text, /*flags=*/ENT_QUOTES | ENT_SUBSTITUTE, $this->config["encoding"]);
        }

        if (function_exists("iconv") && $this->config["preventXSS"]) {
            $text = iconv(mb_detect_encoding($text, mb_detect_order(), true), "UTF-8", $text);
        } else if (!function_exists("iconv")) {
            error_log($this->warn . "PHP extension iconv not installed");
        }

        if ($trim)
            $text = trim($text);

        if ($this->config["slashes"])
            $text = addslashes($text);

        if ($this->config["preventXSS"]) {
            $text = utf8_encode($text);
        }

        if ($ucwords)
            $text = ucwords(strtolower($text));

        return $text;
    }

    /**
     * Sanitize a input
     * 
     * @param string $type
     * @param string|int|float $text
     * @param bool $trim
     * @param bool $html_entities
     * @param bool $alpha_num
     * @param bool $ucwords
     * @return string
     */
    public function sanitize($type, $text, $trim=true, $html_entities=true, $alpha_num=false, $ucwords=true)
    {
        $input = $text;
        if (!isset($type) || is_null($type)) {
            $type = gettype($text);

            if ($type === "string") {//If $type is not given and php says it is a string
                $type = "message";//Then take it as message (because We don't know whether it contains EOL)
            }
        }

        switch (strtolower($type)) {
            case "int":
            case "integer":
                $text = preg_replace("/[^0-9]/s", "", filter_var((string)$text, FILTER_SANITIZE_NUMBER_INT));
                $text = (int)$text+0;
                break;
            case "float":
                $text = $this->clean(preg_replace("/[^0-9.]/s", "", filter_var((string)$text, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION)), $trim, $html_entities, false, false);
                $text = (float)$text+0;
                break;
            case "string":
            case "text":
                $text = preg_replace("/[^A-Za-z0-9]/s", "", filter_var($this->clean((string)$text, $trim, $html_entities, $alpha_num, $ucwords), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));
                break;
            case "hex":
                $text = preg_replace("/[^a-f0-9]/s", "", filter_var($this->clean((string)$text, $trim, $html_entities, $alpha_num, false), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));
                break;
            case "url":
                $text = filter_var((string)$text, FILTER_SANITIZE_URL);
                break;
            case "password":
                $text = $this->clean((string)$text, false, false, false);
                break;
            case "name":
                $text = preg_replace("/[^A-Za-z\s+]/s", "", filter_var($this->clean((string)$text, $trim, $html_entities, $alpha_num, $ucwords), FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH));
                break;
            case "message":
                $text = $this->clean($text, false, true, false, false);
                break;
            case "email":
                $text = filter_var(strtolower($this->clean((string)$text, $trim, $html_entities, false, false)), FILTER_SANITIZE_EMAIL);
                break;
            case "username":
                $text = strtolower($this->sanitize("text", (string)$text, $trim, $html_entities, $alpha_num, false));
                break;
            default:
                $text = $this->clean($text, $trim, $html_entities, $alpha_num, $ucwords);
                break;
        }
        if ($this->logger) {
            $this->logger->debug('Sanitized given input "{input}" to "{output}".', array("input" => $input,"output" => $text,));
        }
        return $text;
    }

    /**
     * Text without any number
     * 
     * @param string $text
     * @param bool $trim
     * @param bool $html_entities
     * @param bool $alpha_num
     * @return string
     */
    public function NonNumericText($text, $trim=true, $html_entities=true, $alpha_num=false)
    {
        $text = preg_replace("/[^A-Za-z]/s", "", $this->sanitize("text", (string)$text, $trim, $html_entities));
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
            $settings = array("trim" => true, "html_entities" => true, "alpha_num" => false);
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

            switch (strtolower($filters["types"][$key])) {
                case "int":
                case "integer":
                    $sanitized = $this->sanitize("integer", $value, $settings["trim"], $settings["html_entities"], $settings["alpha_num"]);
                    break;
                case "string":
                case "text":
                    $sanitized = $this->sanitize("text", $value, $settings["trim"], $settings["html_entities"]);
                    break;
                case "hex":
                    $sanitized = $this->sanitize("hex", $value, $settings["trim"], $settings["html_entities"], $settings["alpha_num"]);
                    break;
                case "float":
                    $sanitized = $this->sanitize("float", $value, $settings["trim"], $settings["html_entities"], $settings["alpha_num"]);
                    break;
                case "name":
                    $sanitized = $this->sanitize("name", $value, $settings["trim"], $settings["html_entities"], $settings["alpha_num"]);
                    break;
                case "username":
                    $sanitized = $this->sanitize("username", $value, $settings["trim"], $settings["html_entities"], $settings["alpha_num"]);
                    break;
                case "email":
                    $sanitized = $this->sanitize("email", $value, $settings["trim"], $settings["html_entities"], false);
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
                    $sanitized = $this->clean($value, $settings["trim"], $settings["html_entities"], $settings["alpha_num"]);
                    break;
            }

            $array[$key] = $sanitized;
        }
        return $array;
    }
}
?>
