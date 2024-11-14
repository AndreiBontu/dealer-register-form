// Select the form
const form = document.querySelector('#dealer-register-form');

// Add event listeners for input fields
document.querySelectorAll('#dealer-register-form input.required, #dealer-register-form select.required').forEach((input) => {
  input.addEventListener('blur', () => {
    const isValid = validateField(input);

    if (isValid) {
      clearErrorMessage(input);
    }
  });

  input.addEventListener('focus', () => {
    clearErrorMessage(input);
  });
});

// Apply validation on form submission
jQuery(document).ready(function($) {
  $('#dealer-register-form').on('submit', function(event) {
    event.preventDefault();
    let isValidForm = true;

    // Ensure the reCAPTCHA response is populated
    const recaptchaResponse = $('#g-recaptcha-response').val();
    if (!recaptchaResponse) {
      $('#form-feedback').html('<p class="text-red-500 text-xs">Please complete the reCAPTCHA verification.</p>');
      return;
    }

    document.querySelectorAll('#dealer-register-form input.required, #dealer-register-form select.required').forEach((input) => {
      const isValid = validateField(input);

      if (!isValid) {
        isValidForm = false;
      } else {
        clearErrorMessage(input);
      }
    });

    if (!validateRadioButtonsByName('tax')) {
      isValidForm = false;
    }

    if (!validateRadioButtonsByName('buying-group')) {
      isValidForm = false;
    }

    if (!validateCheckboxByName('primary-industry')) {
      isValidForm = false;
    }

    if (!validateCheckboxByName('privacy-consent')) {
      isValidForm = false;
    }

    // Tax Exempt file upload validation (if the tax-exempt radio is selected)
    const taxExemptRadio = document.getElementById("tax-exempt");
    const fileUpload = document.getElementById("file-upload");
    if (taxExemptRadio.checked && fileUpload) {
      const errorId = 'file-upload-error';
      let errorMessage = document.getElementById(errorId);

      if (!fileUpload.files.length) {
        isValidForm = false;
        if (!errorMessage) {
          errorMessage = document.createElement('p');
          errorMessage.id = errorId;
          errorMessage.className = 'text-red-500 text-xs mt-1';
          errorMessage.textContent = 'Please upload the required Tax Exemption Certificate.';
          fileUpload.closest('div').appendChild(errorMessage);
        }
        fileUpload.classList.add('border-red-500');
      } else {
        clearErrorMessage(fileUpload);
      }
    }

    if (!isValidForm) {
      return false;
    }

    // Create a new FormData object from the form
    let formData = new FormData(form);

    formData.append('action', 'dealer_form_submission');
    formData.append('dealer_form_nonce', dealer_form_ajax.nonce);

    $.ajax({
      url: dealer_form_ajax.ajax_url,
      type: 'POST',
      data: formData,
      contentType: false,
      processData: false,
      success: function(response) {
        if (response.success) {
          handleSuccess(response);
        } else {
          grecaptcha.reset();
          handleError(response);
        }
      },
      error: function(xhr, status, error) {
        handleAjaxError(xhr, status, error);
      }
    });
  });
});

function showErrorMessage(input, errorId, message) {
  let errorMessage = document.getElementById(errorId);
  if (!errorMessage) {
    errorMessage = document.createElement('p');
    errorMessage.id = errorId;
    errorMessage.className = 'text-red-500 text-xs mt-1';
    errorMessage.textContent = message;
    input.parentNode.appendChild(errorMessage);
  }
  input.classList.add('border-red-500');
}

// Helper function to clear error message on checkboxes
function clearErrorMessageById(errorId) {
  const errorMessage = document.getElementById(errorId);
  if (errorMessage) {
    // Remove the error message if it exists
    errorMessage.remove();
  }
}

// Helper function to clear error messages
function clearErrorMessage(input) {
  const errorId = `${input.id}-error`;
  const errorMessage = document.getElementById(errorId);
  if (errorMessage) {
    errorMessage.remove();
  }
  input.classList.remove('border-red-500');
}

// Helper function to validate individual field
function validateField(input) {
  const errorId = `${input.id}-error`;
  const fieldRules = formRules[input.id];
  let isValid = true;

  if (fieldRules) {
    fieldRules.rules.forEach(rule => {
      if (rule.type === 'required' && !input.value) {
        isValid = false;
        showErrorMessage(input, errorId, rule.error_message);
      }
      if (rule.type === 'string_length' && (input.value.length < rule.min || input.value.length > rule.max)) {
        isValid = false;
        showErrorMessage(input, errorId, rule.error_message);
      }
      if (rule.type === 'range' && !isInRange(input.value, rule.min, rule.max)) {
        isValid = false;
        showErrorMessage(input, errorId, rule.error_message);
      }
      if (rule.type === 'pattern' && !new RegExp(rule.pattern).test(input.value)) {
        isValid = false;
        showErrorMessage(input, errorId, rule.error_message);
      }
      if (rule.type === 'email' && !isValidEmail(input.value)) {
        isValid = false;
        showErrorMessage(input, errorId, rule.error_message);
      }
      if (rule.type === 'number' && isNaN(input.value)) {
        isValid = false;
        showErrorMessage(input, errorId, rule.error_message);
      }
    });
  }

  return isValid;
}

function validateCheckboxByName(inputName) {
  let isValid = true;

  if (inputName === 'primary-industry') {
    // Validate checkboxes in "Primary Industry"
    const primaryIndustryCheckboxes = document.querySelectorAll('#custom-integration, #retail, #rental, #commercial-av, #residential-av, #security-intrusion, #electrical-lighting, #networking-it, #access-control, #intercom, #fire, #electrical-contractor, #it, #other');
    const isAnyCheckboxSelected = Array.from(primaryIndustryCheckboxes).some(checkbox => checkbox.checked);
    const primaryIndustryFieldset = document.querySelector('.industry-wrapper');

    if (!isAnyCheckboxSelected) {
      isValid = false;
      showErrorMessage(primaryIndustryFieldset, 'industry-error', 'Please complete this required field.');
    } else {
      clearErrorMessageById('industry-error');
    }
  }

  if (inputName === 'privacy-consent') {
    const privacyConsentCheckbox = document.querySelector('#privacy-consent');
    const privacyConsentFieldset = document.querySelector('.privacy-consent-wrapper');

    if (!privacyConsentCheckbox.checked) {
      isValid = false;
      showErrorMessage(privacyConsentFieldset, 'privacy-consent-error', 'Please complete this required field.');
    } else {
      clearErrorMessageById('privacy-consent-error');
    }
  }

  return isValid;
}

function validateRadioButtonsByName(inputName) {
  let isValid = true;

  if (inputName === 'tax') {
    // Validate radio buttons
    const taxRadios = document.querySelectorAll('input[name="tax"]');
    const taxSelected = Array.from(taxRadios).some(radio => radio.checked); // Check if any radio is selected
    const taxExemptContainerUpload = document.getElementById('taxExemptContainerUpload'); // Select the taxExemptContainerUpload div for appending the error message

    if (!taxSelected) {
      isValid = false;
      showErrorMessage(taxExemptContainerUpload, 'tax-error', 'Please complete this required field.');
    } else {
      clearErrorMessageById('tax-error');
    }
  }

  if (inputName === 'buying-group') {
    // Validate radio buttons
    const buyingGroupRadios = document.querySelectorAll('input[name="buying-group"]');
    const buyingGroupRadioSelected = Array.from(buyingGroupRadios).some(radio => radio.checked);
    const buyingGroupContainerUpload = document.getElementById('buying-group-name-container');

    if (!buyingGroupRadioSelected) {
      isValid = false;
      showErrorMessage(buyingGroupContainerUpload, 'buying-group-error', 'Please complete this required field.');
    } else {
      clearErrorMessageById('buying-group-error');
    }
  }

  return isValid;
}

function isValidEmail(value) {
  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  return emailRegex.test(value);
}

function isInRange(value, min = 1, max = 15) {
  // Remove non-numeric characters like +, (, ), spaces, etc.
  const numericValue = value.replace(/\D/g, '');

  // If the numeric portion is empty, return true to skip validation
  if (numericValue.length === 0) {
    return true;
  }

  // Check if the length is within the specified range
  return value.length >= min && value.length <= max;
}

// Function to handle successful form submission
function handleSuccess(response) {
  // Reset the form fields
  jQuery('#dealer-register-form')[0].reset();

  // Show the success message
  jQuery('#form-feedback').html(`
        <p class="text-[#37d780] success mt-2">${response.data.message}</p>
  `);
}

// Function to handle error messages
function handleError(response) {
  // If the response contains a message, display it in the general feedback area
  if (response.data.message) {
    jQuery('#form-feedback').html(`
        <p class="text-red-500 text-xs mt-1">${response.data.message}</p>
    `);
  }

  // Loop through the errors and display them
  jQuery.each(response.data, function(field, message) {
    // For other fields, show the error next to the respective input
    let inputField = jQuery('#' + field);

    // Remove any existing error message
    jQuery('#' + field + '-error').remove();
      // Add the new error message
      inputField.after(`
        <p class="text-red-500 text-xs mt-1" id="${field}-error">${message}</p>
      `);
  });
}

// Function to handle AJAX errors
function handleAjaxError(xhr, status, error) {
  console.error('AJAX error:', error);

  // Send error details to WordPress for logging
  $.post(dealer_form_ajax.ajax_url, {
    action: 'log_ajax_error',
    error_message: error,
    error_status: status,
    error_response: xhr.responseText,
    dealer_form_nonce: dealer_form_ajax.nonce
  });
}