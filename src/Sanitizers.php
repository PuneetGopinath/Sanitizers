<?php
/**
 * PHP Sanitizers - Quickly Sanitize user data
 * Copyright (c) 2021 The BK Sanitizers Team
 * 
 * @see https://github.com/PuneetGopinath/Sanitizers
 * @license MIT
 * @author Puneet Gopinath (PuneetGopinath) <baalkrshna@gmail.com>
 */

namespace Sanitizers\Sanitizers;

$config_file = dirname(__FILE__) . "/config.php";
if (is_readable($config_file)) {
    include_once($config_file);
} else {
    error_log("PHP Sanitizers config file not found. Used fallback values, Time: " . time(), 0);
}

/**
 * Sanitizer class for Sanitizing user input
 */
class Sanitizer
{
    public $config = array();
    private $fatal = "Fatal Error: Sanitizers: ";
    private $warn = "Warning: Sanitizers: ";
    const VERSION = "1.0.2";

    public function __construct($exceptions=null)
    {
        $this->exceptions = (bool) $exceptions;
        if (!isset($config) || empty($config)) {// (fallback values) If config.php file is not found in the same directory or not readable then it will use these values
            $config = [
                "maxInputLength" => 1000,
                "encoding" => "UTF-8"
            ];
        }

        $this->set("*", $config);
    }

    public function getVersion()
    {
        return self::VERSION;
    }

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
            case "*":
                $this->set("encoding", $value["encoding"]);
                $this->set("maxInputLength", $value["maxInputLength"]);
                return true;
                break;
            default:
                if ($this->exceptions) {
                    throw new \Exception($this->fatal . "Invalid config key: $case with value: $value");
                }
                return false;
                break;
        }

        if ($value === "default") {
            $this->config[$case] = $config[$case];
        }
        return true;
    }

    public function clean($text, $trim=true, $html_entities=true)
    {
        if (strlen($text) > $this->config["maxInputLength"]) {
            $text = substr($text, 0, $this->config["maxInputLength"]);
        }

        if ($html_entities) {
            $text = htmlspecialchars($text, /*flags=*/ENT_QUOTES | ENT_SUBSTITUTE, $this->config["encoding"]);
        }

        if ($trim)
            $text = trim($text);

        return $text;
    }

    public function Integer($number, $trim=true, $html_entities=true)
    {
        $number = preg_replace("/[^0-9]/s", "", filter_var((string)$number, FILTER_SANITIZE_NUMBER_INT));
        $number = (int)$number+0;
        return $number;
    }

    public function Hex($hex, $trim=true, $html_entities=true)
    {
        $hex = $this->clean(preg_replace("/[^a-f0-9]/s", "", filter_var($hex, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH)));
        return $hex;
    }

    public function Password($password)
    {
        $password = $this->clean((string)$password, false, false, false);
        return $password;
    }

    public function Email($email, $trim=true, $html_entities=true)
    {
        $email = $this->clean(filter_var(strtolower($email), FILTER_SANITIZE_EMAIL));
        return $email;
    }

    public function Username($username, $trim=true, $html_entities=true)
    {
        $username = strtolower(preg_replace("/[^a-z0-9]/s", "", $this->Text($username, $trim, $html_entities)));
        return $username;
    }

    public function Text($text, $trim=true, $html_entities=true)
    {
        $text = $this->clean(preg_replace("/[^a-zA-Z0-9]/s", "", filter_var($text, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH)));
        return $text;
    }

    public function NonNumericText($text, $trim=true, $html_entities=true)
    {
        $text = preg_replace("/[^A-Za-z]/s", "", $this->Text((string)$text, $trim, $html_entities));
        return $text;
    }

    public function Name($name, $trim=true, $html_entities=true)
    {
        $name = $this->clean(preg_replace("/[^a-zA-Z\s+]/s", "", filter_var($name, FILTER_SANITIZE_STRING, FILTER_FLAG_STRIP_LOW | FILTER_FLAG_STRIP_HIGH)));
        return $name;
    }

    public function Float($number, $trim=true, $html_entities=true)
    {
        $number = preg_replace("/[^0-9.]/s", "", filter_var((string)$number, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION));
        $number = (float)$number+0;
        return $number;
    }

    public function URL($url)
    {
        $url = filter_var($url, FILTER_SANITIZE_URL);
        return $url;
    }
}
?>
