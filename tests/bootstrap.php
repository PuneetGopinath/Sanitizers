<?php

/**
 * PHPUnit bootstrap file.
 */

if (file_exists("vendor/autoload.php")) {
    require_once "vendor/autoload.php";
} else {
    require_once dirname(dirname(__FILE__)) . "/vendor/autoload.php";
}
