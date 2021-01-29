<?php
require_once("src/Sanitizers.php");
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
    "message" => "Sanitizers - Quickly sanitize user data.\r\nSee this github project at https://github.com/PuneetGopinath/Sanitizers\r\nKeywords: [\"Sanitizers\",\"back-end\",\"Sanitize\",\"web\",\"PHP Sanitizers\",\"Sanitize user input\"].",
    "username" => "PuneetGopinath"
];
$values = [
    "hex" => $sanitize->Hex($test_values["hex"]),
    "name" => $sanitize->Name($test_values["name"]),
    "email" => $sanitize->Email($test_values["email"]),
    "message" => $sanitize->clean($test_values["message"], false, 5000),
    "username" => $sanitize->Username($test_values["username"])
];

echo "Array Key -- Original Value => Sanitized Value" . EOL;

foreach ($test_values as $i => $value) {
    echo $i . " -- " . $value . " => " . $values[$i] . EOL;
}

?>