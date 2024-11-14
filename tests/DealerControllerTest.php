<?php

/**
 * Dealer Registration Form Tests
 *
 * @group dealer-register-form
 */
class DealerControllerTest extends WP_UnitTestCase {
    /**
     * Test for successful form submission.
     */
    public function testSubmitForm_Success() {
        // Mock necessary methods
        $mock = $this->getMockBuilder('DealerController')
            ->onlyMethods([
                'verify_recaptcha',
                'is_dealer_email_exists',
                'save_dealer_data',
                'validate_file_upload',
            ])
            ->getMock();

        // Simulate successful reCAPTCHA verification
        $mock->method('verify_recaptcha')
            ->willReturn(true);

        // Simulate no email conflict
        $mock->method('is_dealer_email_exists')
            ->willReturn(false);

        // Simulate successful dealer data saving
        $mock->method('save_dealer_data')
            ->willReturn(123); // Mocked dealer ID

        // Simulate POST data
        $_POST = [
            'dealer_form_nonce' => 'valid_nonce',
            'email' => 'test@example.com',
            'company_name' => 'Example Company',
            'g-recaptcha-response' => 'valid-captcha-response',
            'tax' => 'No Tax Exempt'
        ];

        // Call the submitForm method
        $response = $mock->submitForm();

        // Assert success response
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('Thank you for registering! Your submission was successful sent.', $response['message']);
    }

    /**
     * Test for failed reCAPTCHA verification.
     */
    public function testSubmitForm_Fail_ReCAPTCHA() {
        $mock = $this->getMockBuilder('DealerController')
            ->onlyMethods(['verify_recaptcha'])
            ->getMock();

        // Simulate failed reCAPTCHA verification
        $mock->method('verify_recaptcha')
            ->willReturn(false);

        // Simulate POST data
        $_POST = [
            'dealer_form_nonce' => 'valid_nonce',
            'email' => 'test@example.com',
            'company_name' => 'Example Company',
            'g-recaptcha-response' => 'invalid-captcha-response'
        ];

        // Call the submitForm method
        $response = $mock->submitForm();

        // Assert failure response due to reCAPTCHA
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('reCAPTCHA verification failed.', $response['message']);
    }

    /**
     * Test for duplicate email.
     */
    public function testSubmitForm_Fail_EmailExists() {
        $mock = $this->getMockBuilder('DealerController')
            ->onlyMethods(['is_dealer_email_exists'])
            ->getMock();

        // Simulate email already exists
        $mock->method('is_dealer_email_exists')
            ->willReturn(true);

        // Simulate POST data
        $_POST = [
            'dealer_form_nonce' => 'valid_nonce',
            'email' => 'existing-email@example.com',
            'company_name' => 'Example Company',
            'g-recaptcha-response' => 'valid-captcha-response'
        ];

        // Call the submitForm method
        $response = $mock->submitForm();

        // Assert failure response due to existing email
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('This email has already been registered.', $response['message']);
    }

    /**
     * Test for failed form validation.
     */
    public function testSubmitForm_Fail_Validation() {
        $mock = $this->getMockBuilder('FormValidator')
            ->onlyMethods(['formValidator->validate', 'formValidator->getErrors'])
            ->getMock();

        // Simulate failed form validation
        $mock->method('formValidator->validate')
            ->willReturn(false);
        $mock->method('formValidator->getErrors')
            ->willReturn(['error' => 'Validation failed']);

        // Simulate POST data
        $_POST = [
            'dealer_form_nonce' => 'valid_nonce',
            'email' => 'invalid-email',
            'company_name' => 'Example Company',
            'g-recaptcha-response' => 'valid-captcha-response'
        ];

        // Call the submitForm method
        $response = $mock->submitForm();

        // Assert failure response due to validation errors
        $this->assertArrayHasKey('error', $response);
        $this->assertEquals('Validation failed', $response['error']);
    }

    /**
     * Test for file upload (Tax Exempt).
     */
    public function testSubmitForm_FileUpload_Success() {
        $mock = $this->getMockBuilder('DealerController')
            ->onlyMethods(['validate_file_upload'])
            ->getMock();

        // Simulate file upload success
        $mock->method('validate_file_upload')
            ->willReturn('path/to/uploaded/file');

        // Simulate POST data for tax exemption
        $_POST = [
            'dealer_form_nonce' => 'valid_nonce',
            'email' => 'test@example.com',
            'company_name' => 'Example Company',
            'g-recaptcha-response' => 'valid-captcha-response',
            'tax' => 'Tax Exempt'
        ];

        // Call the submitForm method
        $response = $mock->submitForm();

        // Assert success response
        $this->assertArrayHasKey('message', $response);
        $this->assertEquals('Thank you for registering! Your submission was successful sent.', $response['message']);
    }

    /**
     * Test for failed file upload (Tax Exempt).
     */
    public function testSubmitForm_FileUpload_Fail() {
        $mock = $this->getMockBuilder('DealerController')
            ->onlyMethods(['validate_file_upload'])
            ->getMock();

        // Simulate failed file upload
        $mock->method('validate_file_upload')
            ->willReturn(new WP_Error('upload_error', 'File upload failed'));

        // Simulate POST data for tax exemption
        $_POST = [
            'dealer_form_nonce' => 'valid_nonce',
            'email' => 'test@example.com',
            'company_name' => 'Example Company',
            'g-recaptcha-response' => 'valid-captcha-response',
            'tax' => 'Tax Exempt'
        ];

        // Call the submitForm method
        $response = $mock->submitForm();

        // Assert failure response due to file upload failure
        $this->assertArrayHasKey('file-upload', $response);
        $this->assertEquals('File upload failed', $response['file-upload']);
    }
}
