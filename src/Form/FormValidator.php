<?php

namespace DealerRegisterForm\src\Form;

use DealerRegisterForm\src\Validator\Validator;

class FormValidator {
    private array $fields;
    private array $errors = [];
    private mixed $sanitizedData;

    public function __construct() {
        $this->fields = FormFields::getFormFields();
    }

    /**
     * Method to validate each field against its rules
     *
     * @param  array  $data
     * @return bool
     */
    public function validate(array $data): bool {
        $this->errors = []; // Clear any previous errors
        $this->sanitizedData = []; // Store sanitized data

        foreach ($this->fields as $field => $config) {
            $value = $data[$field] ?? '';// Get the field value from input data

            // Apply sanitization based on field name
            $sanitizedValue = $this->sanitizeField($field, $value);
            // Store sanitized data
            $this->sanitizedData[$field] = $sanitizedValue;

            foreach ($config['rules'] as $rule) {
                $isValid = $this->applyRule($rule['type'], $sanitizedValue, $rule);

                if (!$isValid) {
                    $this->errors[$field] = $rule['error_message'];
                    break; // Stop further validation for this field if one rule fails
                }
            }
        }

        return empty($this->errors);
    }

    public function getErrors(): array {
        return $this->errors;
    }

    public function getSanitizedData(): array {
        return $this->sanitizedData;
    }

    /**
     * Apply the rule based on its type
     *
     * @param  string  $type
     * @param  mixed  $value
     * @param  array  $rule
     * @return bool
     */
    private function applyRule(string $type, mixed $value, array $rule): bool {
        // Skip validation if the field is optional and the value is empty
        if ($value === '' || $value === null) {
            if ($type !== 'required') {
                return true;
            }
        }

        return match ($type) {
            'required' => Validator::required($value),
            'string_length' => Validator::string_length($value, $rule['min'] ?? 1, $rule['max'] ?? 255),
            'pattern' => Validator::pattern($value, $rule['pattern']),
            'email' => Validator::email($value),
            'range' => Validator::range($value),
            'array' => Validator::array($value),
            default => true,
        };
    }


    /**
     * Method to sanitize the field based on the field name
     *
     * @param  string  $field
     * @param $value
     * @return array|string|null
     */
    private function sanitizeField(string $field, $value): array|string|null
    {
        return match ($field) {
            'email' => sanitize_email($value),
            'phone', 'phone-number' => preg_replace('/[^0-9+\-() ]/', '', $value),
            'url' => esc_url($value),
            'attracted-to-us', 'primary-industry' => is_array($value) ? array_map('sanitize_text_field', $value) : sanitize_text_field($value),
            default => sanitize_text_field($value),
        };
    }
}
