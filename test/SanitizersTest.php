<?php
use Sanitizers\Sanitizers\Sanitizer;

for ($i = 0; $i < count($argv); $i++) {
    switch ($argv[$i]) {
        case "debug":
            $debug = true;
            break;
        case "ini":
            $configFromIni = true;
        default:
            if (!(isset($debug) && isset($configFromIni))) {
                $debug = false;
                $configFromIni = false;
            }
            break;
    }
}

//See: https://stackoverflow.com/a/255531
if (!defined("PHP_EOL")) {
    switch (strtoupper(substr(PHP_OS, 0, 3))) {
        // Windows
        case "WIN":
            define("PHP_EOL", "\r\n");
            break;

        // Mac
        case "DAR":
            define("PHP_EOL", "\r");
            break;

        // Unix
        default:
            define("PHP_EOL", "\n");
    }
}

$debug_info = array();
if ($debug)
    error_reporting(E_ALL);

const EOL = PHP_EOL . PHP_EOL;
$currentDir = dirname(__FILE__);
$baseDir = dirname($currentDir);
if (is_readable($baseDir . "/vendor/autoload.php")) {
    require $baseDir . "/vendor/autoload.php";
    echo "Using composer autoload files" . EOL;
} else {
    require $baseDir . "/src/Sanitizers.php";
    echo "Not using composer autoload files" . EOL;
}
$sanitizer = new Sanitizer(false);

echo "Using Sanitizers version: " . $sanitizer::VERSION . EOL;
$len = 32; //32 bytes = 256 bits

if (function_exists("random_bytes"))
{
    $bytes = random_bytes($len);
} else if (function_exists("openssl_random_pseudo_bytes"))
{
    $bytes = openssl_random_pseudo_bytes($len);
} else {
    $bytes = hash("sha256", uniqid((string) mt_rand(), true), true);
}
$testValues = array(
    "hex" => bin2hex($bytes),
    "int" => $len-0.5,
    "float" => $len-0.5,
    "name" => "\0saNiTiZeRs ä\x80",
    "email" => "AdMiN@ExAmPle.cOm",
    "message" => "Hi <script src=http://ha.ckers.org/xss.js></script>",
    "url" => "http://example.com/index.php?username=<script>alert('XSS');</script>",
    "username" => "PuneetGopinath", // It will become to smaller case if you want upper case also then use sanitize function with type parameter as name e.g. `$sanitizer->sanitize("name", $username)`
    "html" => "<b>Text in bold</b><!-- This is a comment --><link rel=stylesheet src=http://ha.ckers.org/bad.css /><a href=\"javascript:alert('XSS');\">XSS</a>",
    "password" => "\$UnIQUe|`_-<script>alert('XSS')</script>#pass•WorD%!?",
    "function_clean" => "XSS <script>alert('XSS');</script>"
);

if ($configFromIni && is_readable($baseDir . "/src/config.ini"))
    $sanitizer->configFromIni($baseDir . "/src/config.ini");

$debug_info[] = "configFromIni: " . ($configFromIni?"true":"false");

$values = array(
    "hex" => $sanitizer->sanitize("hex", $testValues["hex"]),
    "int" => $sanitizer->sanitize("integer", $testValues["int"]),
    "float" => $sanitizer->sanitize("float", $testValues["float"]),
    "name" => $sanitizer->sanitize("name", $testValues["name"]),
    "email" => $sanitizer->sanitize("email", $testValues["email"]),
    "message" => $sanitizer->sanitize("message", $testValues["message"], false, true),
    "url" => $sanitizer->sanitize("url", $testValues["url"]),
    "username" => $sanitizer->sanitize("username", $testValues["username"]),
    "html" => $sanitizer->HTML($testValues["html"]),
    "password" => $sanitizer->sanitize("password", $testValues["password"]),
    "function_clean" => $sanitizer->clean($testValues["function_clean"])
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
        "function_clean" => "" //Will use clean function
    ),
    "message" => array(
        "trim" => false, //Enables php trim function, default:true
        "htmlentities" => true, //Enables using htmlentities, default:true
        "alpha_num" => false, //Sets value to be alpha_numeric, default:false
        "ucwords" => false
    ),
    "html" => array(
        "tags" => "<b><i><em><p><a><br>"//Optinal Allowed tags
    )
);
$auto_values = $sanitizer->sanitizeArray($testValues, $filters);

echo "Array Key -- Original Value => Sanitized Value -- same: bool" . EOL;

foreach ($testValues as $i => $value) {
    echo $i . " -- " . $value . " => " . $values[$i] . " -- same: " . (($value === $values[$i])?"true":"false") . EOL;
}

echo EOL . "Array Key -- Original Value => Auto Sanitized Value -- same: bool" . EOL;

foreach ($testValues as $i => $value) {
    echo $i . " -- " . $value . " => " . $auto_values[$i] . " -- same: " . (($value === $auto_values[$i])?"true":"false") . EOL;
}

if ($debug)
    $debug_info[] = json_encode(array("Sanitizer"=>$sanitizer,"version"=>$sanitizer::VERSION));

echo "Debug_info: " . implode(", ", $debug_info) . PHP_EOL;
?>
