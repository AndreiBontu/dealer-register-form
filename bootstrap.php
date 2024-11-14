<?php

// Load the WordPress testing environment
$_tests_dir = getenv('WP_PHPUNIT__DIR') ?: 'vendor/wp-phpunit/wp-phpunit';

if (!$_tests_dir || !file_exists($_tests_dir . '/includes/bootstrap.php')) {
    echo "Could not find WordPress test files in $_tests_dir.\n";
    exit(1);
}

// Load WordPress functions
require_once $_tests_dir . '/includes/functions.php';

// Manually load the plugin file
require_once dirname(__FILE__) . '/dealer-register-form.php';

// Start up the WP testing environment
require $_tests_dir . '/includes/bootstrap.php';
