<?php
/**
 * WordPress Testing Configuration
 *
 * This file configures the test environment for running the WordPress unit tests.
 */

// Set the path to the WordPress tests directory.
define( 'WP_TESTS_DIR', '/path/to/your/wp-tests/' ); // Change this to your actual wp-tests directory

// Set the URL of your test site.
define( 'WP_TESTS_URL', 'http://localhost/' );

// Set the admin email address for the test site.
define( 'WP_TESTS_EMAIL', 'admin@localhost' );

// Set the title of your test site.
define( 'WP_TESTS_TITLE', 'WordPress Test Site' );

// Enable debugging during testing.
define( 'WP_TESTS_DEBUG', true );

// Set the path to your WordPress installation (this should be the root directory of your WordPress instance).
define( 'ABSPATH', '/path/to/your/wordpress/installation/' ); // Change this to your actual WordPress installation path

// Configure the WordPress test database settings.
define( 'DB_NAME', 'wordpress_test' ); // Database name for tests
define( 'DB_USER', 'root' );            // Database user
define( 'DB_PASSWORD', '' );            // Database password
define( 'DB_HOST', 'localhost' );       // Database host
define( 'DB_CHARSET', 'utf8' );         // Charset for the test database
define( 'DB_COLLATE', '' );             // Collation for the test database

// Optional: Set up the WordPress secret keys for the test environment (use random values).
define( 'AUTH_KEY',         'put your unique phrase here' );
define( 'SECURE_AUTH_KEY',  'put your unique phrase here' );
define( 'LOGGED_IN_KEY',    'put your unique phrase here' );
define( 'NONCE_KEY',        'put your unique phrase here' );
define( 'AUTH_SALT',        'put your unique phrase here' );
define( 'SECURE_AUTH_SALT', 'put your unique phrase here' );
define( 'LOGGED_IN_SALT',   'put your unique phrase here' );
define( 'NONCE_SALT',       'put your unique phrase here' );
