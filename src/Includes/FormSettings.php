<?php

namespace DealerRegisterForm\src\Includes;

use DealerRegisterForm\src\Controllers\DealerController;
use DealerRegisterForm\src\Form\FormValidator;
use JetBrains\PhpStorm\NoReturn;

class FormSettings
{
    public function __construct()
    {
        add_shortcode('dealer-form', [$this, 'showDealerForm']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueCustomStyles']);
        add_action('wp_enqueue_scripts', [$this, 'enqueueCustomScripts']);
        add_action('wp_ajax_dealer_form_submission', [$this, 'handleDealerFormSubmission']);
        add_action('wp_ajax_nopriv_dealer_form_submission', [$this, 'handleDealerFormSubmission']);
        add_action('wp_ajax_log_ajax_error', [$this, 'log_ajax_error']);
        add_action('wp_ajax_nopriv_log_ajax_error', [$this, 'log_ajax_error']);
        add_action('wp_head', [$this, 'add_recaptcha_script']);
    }

    /**
     * Display the dealer form
     * @return bool|string
     */
    public function showDealerForm(): bool|string
    {
        // Start output buffering
        ob_start();

        // Include the template file
        include MY_PLUGIN_PATH . '/src/includes/templates/dealer-form.php';

        // Get the contents of the buffer and end buffering
        return ob_get_clean();
    }

    /**
     * Enqueue plugin styles
     * @return void
     */
    public function enqueueCustomStyles(): void
    {
        wp_enqueue_style('dealer-form-plugin', MY_PLUGIN_URL . 'assets/css/tailwind-output.css');
    }

    /**
     * Enqueue plugin scripts, including jQuery
     * @return void
     */
    public function enqueueCustomScripts(): void
    {
        wp_enqueue_script('jquery');

        // Localize script to pass AJAX URL and nonce
        wp_localize_script('validation', 'dealer_form_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('dealer_form_nonce_action'),
        ));

        wp_enqueue_script(
            'my_plugin_main_script',
            MY_PLUGIN_URL . 'assets/js/main.js',
            array('jquery'),
            null,
            true
        );

        wp_enqueue_script(
            'my_plugin_form_rules',
            MY_PLUGIN_URL . 'assets/js/form/rules.js',
            array('jquery'),
            null,
            true
        );

        wp_enqueue_script(
            'my_plugin_form_validation',
            MY_PLUGIN_URL . 'assets/js/form/validation.js',
            array('jquery'),
            null,
            true
        );

        // Localize script to pass AJAX URL and nonce
        wp_localize_script('my_plugin_form_validation', 'dealer_form_ajax', array(
            'ajax_url' => admin_url('admin-ajax.php'),
            'nonce' => wp_create_nonce('dealer_form_nonce_action'),
        ));
    }

    /**
     * Handle form submission via AJAX
     * @return void
     */
    #[NoReturn] public function handleDealerFormSubmission(): void
    {
        // Verify nonce first (recommended for security)
        check_ajax_referer('dealer_form_nonce_action', 'dealer_form_nonce');

        $controller = new DealerController(new FormValidator());
        $controller->submitForm();
    }

    /**
     * @return void
     */
    #[NoReturn] function log_ajax_error(): void
    {
        // Check nonce for security
        if (!isset($_POST['dealer_form_nonce']) || !wp_verify_nonce($_POST['dealer_form_nonce'], 'dealer_form_nonce_action')) {
            wp_send_json_error('Security check failed.');
            wp_die();
        }

        // Log the error details
        $error_message = sanitize_text_field($_POST['error_message']);
        $error_status = sanitize_text_field($_POST['error_status']);
        $error_response = sanitize_textarea_field($_POST['error_response']);

        // Use error_log or a custom logging function here
        error_log("AJAX Error - Message: $error_message, Status: $error_status, Response: $error_response");

        wp_send_json_success('Error logged successfully.');
        wp_die();
    }

    /**
     * @return void
     */
    function add_recaptcha_script(): void
    {
        echo '<script src="https://www.google.com/recaptcha/api.js" async defer></script>';
    }

}