<?php

$finder = PhpCsFixer\Finder::create()
    ->in(__DIR__ . '/src')
    ->in(__DIR__ . '/tests')
;

return PhpCsFixer\Config::create()
    ->finder($finder)
    ->setUsingCache(true)
    ->setCacheFile(__DIR__ . '/var/phpcs/.php_cs.cache')
;