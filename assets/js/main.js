// Select all required checkboxes and radios in the dealer-register-form
document.querySelectorAll('#dealer-register-form fieldset').forEach((fieldset) => {
  const requiredCheckboxes = fieldset.querySelectorAll('input[type="checkbox"].required');
  const requiredRadios = fieldset.querySelectorAll('input[type="radio"].required');

  // Function to validate checkbox or radio input
  const validateInput = () => {
    const errorId = `${fieldset.id}-error`;
    let errorMessage = document.getElementById(errorId);

    // Check if at least one checkbox is checked in the fieldset
    let isChecked = Array.from(requiredCheckboxes).some(input => input.checked);

    // Check if at least one radio button is checked in the fieldset
    if (requiredRadios.length > 0) {
      isChecked = Array.from(requiredRadios).some(input => input.checked);
    }

    if (!isChecked) {
      // Show error if no checkbox/radio is selected
      if (!errorMessage) {
        errorMessage = document.createElement('p');
        errorMessage.id = errorId;
        errorMessage.className = 'text-red-500 text-xs mt-1';
        errorMessage.textContent = 'Please complete this required field.';
        fieldset.appendChild(errorMessage);
      }
      fieldset.classList.add('border-red-500');
    } else {
      if (errorMessage) {
        errorMessage.remove();
      }
      fieldset.classList.remove('border-red-500');
    }
  };

  // Add event listeners to checkboxes and radios
  requiredCheckboxes.forEach((checkbox) => {
    checkbox.addEventListener('change', validateInput);
  });
  requiredRadios.forEach((radio) => {
    radio.addEventListener('change', validateInput);
  });
});

// Render upload block when tax-exempt is selected
const taxExemptRadio = document.getElementById("tax-exempt");
const taxExemptContainer = document.getElementById("taxExemptContainerUpload");

taxExemptRadio.addEventListener("change", function() {
  if (taxExemptRadio.checked) {
    // Check if the content block already exists
    if (!document.getElementById("taxExemptBlock")) {
      const block = document.createElement("div");
      block.id = "taxExemptBlock";
      block.className = "mt-3";

      // Insert the file upload HTML block
      block.innerHTML = `
          <div class="text-sm/6">
            <label for="file-upload" class="relative cursor-pointer bg-white focus-within:outline-none">
              <span class="text-xs label-required">Upload your Tax Exemption Certificate</span>
              <input id="file-upload" name="file-upload" type="file">
            </label>
          </div>
        `;

      // Append the created block to the container and make it visible
      taxExemptContainer.appendChild(block);
      taxExemptContainer.style.display = 'block';

      // Add the validation logic for the file upload input after it's created
      const fileUpload = block.querySelector('#file-upload');
      fileUpload.addEventListener('blur', () => {
        const errorId = 'file-upload-error';
        let errorMessage = document.getElementById(errorId);

        // Check if a file has been selected
        if (!fileUpload.files.length) {
          if (!errorMessage) {
            errorMessage = document.createElement('p');
            errorMessage.id = errorId;
            errorMessage.className = 'text-red-500 text-xs mt-1';
            errorMessage.textContent = 'Please complete this required field.';

            // Appending error message after the file upload input
            fileUpload.closest('div').appendChild(errorMessage);
          }
          fileUpload.classList.add('border-red-500');
        }
      });

      // Handle focus event for the file input
      fileUpload.addEventListener('focus', () => {
        const errorId = 'file-upload-error';
        const errorMessage = document.getElementById(errorId);

        if (errorMessage) {
          errorMessage.remove();
        }

        fileUpload.classList.remove('border-red-500');
      });
    }
  }
});

// Remove the block when the radio button is unchecked
document.addEventListener("click", function(event) {
  if (event.target.name === "tax" && event.target !== taxExemptRadio) {
    const block = document.getElementById("taxExemptBlock");
    if (block) {
      block.remove();
    }
  }
});

// Render input block when "yes" radio is selected
const yesRadio = document.getElementById("yes");
const buyingGroupContainer = document.getElementById("buying-group-name-container");

yesRadio.addEventListener("change", function() {
  if (yesRadio.checked) {
    // Check if the content block already exists
    if (!document.getElementById("buyingGroupBlock")) {
      const block = document.createElement("div");
      block.id = "buyingGroupBlock";

      // Insert the buying group name input block
      block.innerHTML = `
        <label for="buying-group-name">Buying Group Name</label>
        <div class="">
          <input
            type="text"
            name="buying-group-name"
            id="buying-group-name"
            autocomplete="city"
            class="block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
          >
        </div>
      `;

      // Append the created block to the container and make it visible
      buyingGroupContainer.appendChild(block);
      buyingGroupContainer.style.display = 'block';
    }
  }
});

// Remove the block when the radio button is unchecked
document.addEventListener("click", function(event) {
  if (event.target.name === "buying-group" && event.target !== yesRadio) {
    const block = document.getElementById("buyingGroupBlock");
    if (block) {
      block.remove();
    }
  }
});