<?php
$currentDir = dirname(__FILE__);
$baseDir = dirname($currentDir);
if (is_readable($baseDir . "/vendor/autoload.php")) {
    require_once $baseDir . "/vendor/autoload.php";
} else {
    require_once $baseDir . "/src/Sanitizers.php";
}
use Sanitizers\Sanitizers\Sanitizer;

const EOL = PHP_EOL . PHP_EOL;

$sanitize = new Sanitizer(false);
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
$test_values = [
    "hex" => bin2hex($bytes),
    "name" => "\0Some Name ä\x80",
    "email" => "ADMIN@ExAMpLe.com",
    "message" => "Hi <script>alert('I am XSS');</script>",
    "username" => "PuneetGopinath"
];
$values = [
    "hex" => $sanitize->Hex($test_values["hex"]),
    "name" => $sanitize->Name($test_values["name"]),
    "email" => $sanitize->Email($test_values["email"]),
    "message" => $sanitize->clean($test_values["message"], false, true),
    "username" => $sanitize->Username($test_values["username"])
];

echo "Array Key -- Original Value => Sanitized Value" . EOL;

foreach ($test_values as $i => $value) {
    echo $i . " -- " . $value . " => " . $values[$i] . EOL;
}

?>