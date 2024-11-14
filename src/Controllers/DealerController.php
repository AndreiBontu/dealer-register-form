<?php

namespace DealerRegisterForm\src\Controllers;

use DealerRegisterForm\src\Form\FormValidator;
use JetBrains\PhpStorm\NoReturn;
use WP_Error;

class DealerController
{
    private FormValidator $formValidator;

    public function __construct(FormValidator $formValidator)
    {
        $this->formValidator = $formValidator;
    }

    #[NoReturn] public function submitForm(): void
    {
        // Verify the nonce for security
        if (!isset($_POST['dealer_form_nonce']) || !wp_verify_nonce($_POST['dealer_form_nonce'], 'dealer_form_nonce_action')) {
            wp_send_json_error(['message' => 'Security check failed. Please refresh and try again.']);
            wp_die();
        }

        if (!$this->verify_recaptcha($_POST['g-recaptcha-response'])) {
            wp_send_json_error(['message' => 'reCAPTCHA verification failed.']);
            wp_die();
        }

        // Check if the email already exists
        if ($this->is_dealer_email_exists(sanitize_email($_POST['email']))) {
            wp_send_json_error(['message' => 'This email has already been registered.']);
            wp_die();
        }

        // Sanitize and validate the form data
        if (!$this->formValidator->validate($_POST)) {
            $errors = $this->formValidator->getErrors();
            wp_send_json_error($errors);
            wp_die();
        }

        // Retrieve sanitized data for saving
        $sanitizedData = $this->formValidator->getSanitizedData();

        // Verify user's affiliation with the specified company via an external API
        //if (isset($_POST['company_name'])) {
        //    $company_name = sanitize_text_field($_POST['company_name']);
        //    $verification_response = $this->verify_affiliation_with_company($company_name, sanitize_email($_POST['email']));

        //    if (!$verification_response['success']) {
        //        wp_send_json_error(['message' => 'The company name does not match our records. Please check the company name or contact support.']);
        //        wp_die();
        //    }
        //}

        // Check if Tax Exemption is selected and if a file is uploaded
        if (isset($_POST['tax']) && $_POST['tax'] === 'Tax Exempt') {
            $file_url = $this->validate_file_upload(); // Call to validate file upload

            if (is_wp_error($file_url)) {
                error_log('Tax exemption file upload failed. Error: ' . $file_url->get_error_message());
                wp_send_json_error(['file-upload' => $file_url->get_error_message()]);
                wp_die();
            }

            // Add the file URL to sanitized data if the file is valid
            $sanitizedData['tax_exempt_file_url'] = $file_url;
        }

        // Save the data or process as needed
        $dealer_id = $this->save_dealer_data($sanitizedData);

        if (!$dealer_id) {
            error_log('Dealer data could not be saved. Data: ' . print_r($sanitizedData, true));
            wp_send_json_error(['message' => 'There was an issue saving your data. Please try again.']);
            wp_die();
        }

        // Send confirmation email (OPTIONAL)
        //$dealer_email = $sanitizedData['email'];
        //$subject = 'Thank you for registering as a dealer';
        //$message = 'Hello ' . $sanitizedData['first_name'] . ' ' . $sanitizedData['last_name'] . ",\n\n";
        //$message .= "Thank you for registering with us as a dealer. Your registration is now complete.\n\n";
        //$message .= "Best regards,\nYour Company Name";

        //$mail_sent = wp_mail($dealer_email, $subject, $message);

        //if (!$mail_sent) {
            //error_log('Failed to send confirmation email to ' . $dealer_email);
            //wp_send_json_error(['message' => 'Your registration was successful, but we could not send the confirmation email.']);
            //wp_die();
        //}

        // Log successful dealer registration
        error_log('Dealer registration successful. Dealer ID: ' . $dealer_id . ' - Email: ' . $sanitizedData['email']);

        // Send success response with additional data
        wp_send_json_success([
            'message' => 'Thank you for registering! Your submission was successful sent.'
        ]);
        wp_die();
    }

    private function validate_file_upload(): WP_Error|string
    {
        // Check if the file is uploaded
        if (!isset($_FILES['file-upload']) || $_FILES['file-upload']['error'] !== UPLOAD_ERR_OK) {
            return new WP_Error('file_upload_error', 'Please upload the required Tax Exemption Certificate.');
        }

        $file = $_FILES['file-upload'];
        $allowed_types = ['application/pdf', 'image/jpeg', 'image/png'];
        $file_type = wp_check_filetype($file['name'])['type'];

        // Validate file type
        if (!in_array($file_type, $allowed_types)) {
            return new WP_Error('file_type_error', 'Invalid file type. Only PDF, JPEG, and PNG files are allowed.');
        }

        // Validate file size (e.g., 5 MB limit)
        $max_file_size = 5 * 1024 * 1024;
        if ($file['size'] > $max_file_size) {
            return new WP_Error('file_size_error', 'File size exceeds the limit of 5 MB.');
        }

        // Define the directory for uploads within the plugin folder
        $upload_dir = MY_PLUGIN_PATH . 'dealer-documents/';
        $upload_url = MY_PLUGIN_URL . 'dealer-documents/';

        // Ensure the directory exists with secure permissions
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0755, true); // Create directory with restricted permissions
        }

        // Sanitize the file name
        $file_name = sanitize_file_name($file['name']);
        $unique_file_name = wp_unique_filename($upload_dir, $file_name); // Ensures unique file name
        $file_path = $upload_dir . $unique_file_name;

        // Move the uploaded file to the custom directory
        if (!move_uploaded_file($file['tmp_name'], $file_path)) {
            return new WP_Error('file_move_error', 'There was an error saving the file.');
        }

        // Return the file URL or path for saving
        return $upload_url . $unique_file_name;
    }

    private function save_dealer_data(array $sanitizedData): WP_Error|bool|int
    {
        // Prepare post data
        $post_data = [
            'post_type'    => 'dealer-submissions',
            'post_title'   => 'Submission - ' . $sanitizedData['first-name'] . ' ' . $sanitizedData['last-name'],
            'post_status'  => 'publish',
            'post_author'  => get_current_user_id(),
        ];

        // Insert the post and check for success
        $post_id = wp_insert_post($post_data);

        if (is_wp_error($post_id)) {
            error_log('Failed to insert dealer submission. Error: ' . $post_id->get_error_message());
            return false;
        }

        // If post created successfully, add custom fields (post meta)
        foreach ($sanitizedData as $key => $value) {
            add_post_meta($post_id, $key, $value);
        }

        // Return the post ID for further use (e.g., email, logging, etc.)
        return $post_id;
    }

    private function is_dealer_email_exists($email): bool
    {
        global $wpdb;
        // Prepare query to check if email exists in 'dealer-submissions' post type
        $query = "
            SELECT p.ID
            FROM {$wpdb->posts} p
            INNER JOIN {$wpdb->postmeta} pm ON p.ID = pm.post_id
            WHERE p.post_type = 'dealer-submissions'
            AND pm.meta_key = 'email'
            AND pm.meta_value = %s
            LIMIT 1
        ";

        $dealer_id = $wpdb->get_var($wpdb->prepare($query, $email));

        // Return true if a dealer exists with the given email, otherwise false
        return (bool) $dealer_id;
    }

    private function verify_recaptcha($recaptcha_response) {
        $response = wp_remote_post('https://www.google.com/recaptcha/api/siteverify', [
            'body' => [
                'secret' => RECAPTCHA_SECRET_KEY,
                'response' => $recaptcha_response,
            ],
        ]);
        $response_data = json_decode(wp_remote_retrieve_body($response));
        return $response_data->success;
    }

    private function verify_affiliation_with_company(string $company_name, string $email): array
    {
        // Prepare the data to send to the external API
        $response = wp_remote_post('https://api.example.com/verify-affiliation', [
            'body' => [
                'company_name' => $company_name,
                'email' => $email,
                'api_key' => 'your-api-key',
            ],
        ]);

        // Check for API errors
        if (is_wp_error($response)) {
            error_log('API request failed: ' . $response->get_error_message());
            return ['success' => false, 'message' => 'API request failed. Please try again later.'];
        }

        // Parse the API response
        $response_data = json_decode(wp_remote_retrieve_body($response), true);

        // Check if the response is valid and matches the company
        if (isset($response_data['success']) && $response_data['success'] === true) {
            return ['success' => true];
        }

        // If the API returns a mismatch
        return ['success' => false, 'message' => 'The company name does not match our records. Please check the company name or contact support.'];
    }
}

