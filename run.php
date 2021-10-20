<?php
declare(strict_types = 1);
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

require_once 'vendor/autoload.php';
require_once 'Parse.php';
require_once 'FileIterator.php';

$parser = new Parse('carriers.log');
$parser->run();

print_r (PHP_EOL . 'The script is now using: ' . round(memory_get_usage() / 1024) . 'KB of memory.');
print_r (PHP_EOL . 'Peak usage: ' . round(memory_get_peak_usage() / 1024) . 'KB of memory.');