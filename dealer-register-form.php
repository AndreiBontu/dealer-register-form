<?php

/**
*
* Plugin Name: Dealer Register Form
* Description: This is a custom dealer form register
* Version: 1.0.0
* Text Domain: dealer-register-form
* Author: Andrei Bontu
*
**/

if (!defined('ABSPATH')) {
    die('You cannot access this file directly.');
}

// Define constants
define('MY_PLUGIN_PATH', plugin_dir_path(__FILE__));
define('MY_PLUGIN_URL', plugin_dir_url(__FILE__));

// Load Composer Autoload
if (file_exists(MY_PLUGIN_PATH . 'vendor/autoload.php')) {
    require_once MY_PLUGIN_PATH . 'vendor/autoload.php';
}

use DealerRegisterForm\src\Includes\FormSettings;

if (!class_exists('DealerRegisterForm')) {
    class DealerRegisterForm
    {
        public function __construct()
        {
            $this->initialize();
        }

        private function initialize(): void
        {
            new FormSettings();

            // Include other necessary files
            include_once(MY_PLUGIN_PATH . '/dealer-submissions.php');
        }
    }

    $dealerRegisterForm = new DealerRegisterForm();
}