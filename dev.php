<?php
error_reporting(E_ALL | E_STRICT);

// If the dependencies aren't installed, we have to bail and offer some help.
if (!file_exists(__DIR__ . '/vendor/autoload.php')) {
    exit("\nPlease run `composer install` to install dependencies.\n\n");
}

$app = require __DIR__ . '/vendor/autoload.php';

use Symfony\Component\Finder\Finder;

$steps = array(
    function ($path) {
        // TODO: Look for a composer file with a setting for vendor path
        if (file_exists($path . '/vendor/bin/pake')) {
            return $path . '/vendor/bin/pake';
        }
        return false;
    },
    function ($path) {
        $finder = new Finder();
        $finder->files()->name('pake')->in($path)->notPath('pake-cli');
        if (iterator_count($finder)) {
            $files = array_keys(iterator_to_array($finder));
            return $files[0];
        }
        return false;
    },
    function ($path) {
        for ($i = 1; $i < 3; $i++) {
            $path = realpath($path . '/..');
            if ((file_exists($path . '/.hgrc') || file_exists($path . '/.git')) && file_exists($path . '/vendor/bin/pake')) {
                return $path . '/vendor/bin/pake';
            }
        }
        return false;
    }
);

foreach ($steps as $step) {
    $path = $step(defined('IN_PHAR') ? $phar_cwd : getcwd());
    if ($path) {
        array_shift($argv);
        passthru($path . '  --force-tty ' . implode(' ', $argv), $exitCode);
        exit($exitCode);
    }
}

print "Unable to locate pake";
exit (1);




/* End of dev.php */