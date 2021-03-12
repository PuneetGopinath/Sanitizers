<?php
use Sanitizers\Sanitizers\Sanitizer;

foreach ($argv as $value) {
    if ($value === "--debug" || $value === "-d")
        $debug = true;
    else
        $debug = false;

    if ($value === "--ini")
        $configFromIni = true;
    else
        $configFromIni = false;
}

$debug_info = array();
if ($debug)
    error_reporting(E_ALL);

const EOL = PHP_EOL . PHP_EOL;
$currentDir = dirname(__FILE__);
$baseDir = dirname($currentDir);
if (is_readable($baseDir . "/vendor/autoload.php")) {
    require_once $baseDir . "/vendor/autoload.php";
    echo "Using composer autoload files" . EOL;
} else {
    require_once $baseDir . "/src/Sanitizers.php";
    echo "Not using composer autoload files" . EOL;
}
$sanitizer = new Sanitizer(false);

echo "Using Sanitizers version: " . $sanitizer->getVersion() . EOL;
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
$test_values = array(
    "hex" => bin2hex($bytes),
    "int" => $len-0.5,
    "float" => $len-0.5,
    "name" => "\0saNiTiZeRs ä\x80",
    "email" => "AdMiN@ExAmPle.cOm",
    "message" => "Sanitizers - Quickly sanitize user data.\r\nSee this project at <a href='https://github.com/PuneetGopinath/Sanitizers'>GitHub</a>",
    "username" => "PuneetGopinath",
    "html" => "<b>Text in bold</b><!-- This is a comment --><style>body {display: none;}</style>"
);
if ($configFromIni && is_readable($baseDir . "/src/config.ini"))
    $sanitizer->configFromIni($baseDir . "/src/config.ini");

$values = array(
    "hex" => $sanitizer->sanitize("hex", $test_values["hex"]),
    "int" => $sanitizer->sanitize("integer", $test_values["int"]),
    "float" => $sanitizer->sanitize("float", $test_values["float"]),
    "name" => $sanitizer->sanitize("name", $test_values["name"]),
    "email" => $sanitizer->sanitize("email", $test_values["email"]),
    "message" => $sanitizer->sanitize("message", $test_values["message"], false, true),
    "username" => $sanitizer->sanitize("username", $test_values["username"]),
    "html" => $sanitizer->HTML($test_values["html"])
);
$filters = array(
    "types" => array(
        "hex" => "hex",
        "int" => "integer",//You can also use int ("int" => "int")
        "float" => "float",
        "name" => "name",
        "email" => "email",
        "message" => "message",
        "username" => "username",
        "html" => "html"
    ),
    "message" => array(
        "trim" => false, //Enables php trim function, default:true
        "htmlentities" => true, //Enables using htmlentities, default:true
        "alpha_num" => false //Sets value to be alpha_numeric, default:false
    ),
    "html" => array(
        "tags" => "<b><i><em><p><a><br>"//Allowed tags
    )
);
$auto_values = $sanitizer->sanitizeArray($test_values, $filters);

echo "Array Key -- Original Value => Sanitized Value" . EOL;

foreach ($test_values as $i => $value) {
    echo $i . " -- " . $value . " => " . $values[$i] . EOL;
}

echo EOL . "Array Key -- Original Value => Auto Sanitized Value" . EOL;

foreach ($test_values as $i => $value) {
    echo $i . " -- " . $value . " => " . $auto_values[$i] . EOL;
}
if ($debug)
    $debug_info[] = json_encode($sanitizer);

echo "Debug_info: " . implode(", ", $debug_info) . PHP_EOL;
?>