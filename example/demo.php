<?php
require(dirname(__DIR__) . '/vendor/autoload.php');

// Fetch urls from csv
$urls = file('urls.csv', FILE_IGNORE_NEW_LINES|FILE_SKIP_EMPTY_LINES);

// Find invalid urls
$scanner = new \Myself\Tools\Url\Scanner($urls);
$invalidUrls = $scanner->getInvalidUrls();

// Do something with invalid urls
print_r($invalidUrls);