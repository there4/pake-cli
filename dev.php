<?php
error_reporting(E_ALL | E_STRICT);

// If the dependencies aren't installed, we have to bail and offer some help.
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    exit("\nPlease run `composer install` to install dependencies.\n\n");
}

$app = require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Finder\Finder;

$found = '';

// Look in the simple ./vendor/bin
if (file_exists(__DIR__ . './vendor/bin/pake')) {
  $found = __DIR__ . './vendor/bin/pake';
}

$finder = new Finder();
$finder->files()->name('pake')->in(__DIR__);

if (iterator_count($finder)) {
  $files = array_keys(iterator_to_array($finder));
  $found = $files[0];
}

if (!$found) {
  print "Unable to locate pake";
  exit (1);
}

array_shift($argv);
passthru($found . ' ' . implode(' ', $argv));

/* End of dev.php */