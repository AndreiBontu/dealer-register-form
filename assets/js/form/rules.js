const formRules = {
  "first-name": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
      { type: "string_length", min: 1, max: 50, error_message: "First Name should be between 1 and 50 characters." },
      { type: "pattern", pattern: /^[a-zA-Z ]*$/, error_message: "First Name should only contain letters and spaces." }
    ]
  },
  "last-name": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
      { type: "string_length", min: 1, max: 50, error_message: "Last Name should be between 1 and 50 characters." },
      { type: "pattern", pattern: /^[a-zA-Z ]*$/, error_message: "Last Name should only contain letters and spaces." }
    ]
  },
  "email": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
      { type: "email", error_message: "Email must be formatted correctly." },
    ]
  },
  "phone-number": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
      { type: "pattern", pattern: /^[+()\-.\sx0-9]*$/, error_message: "A valid phone number may only contain numbers, +()-. or x" },
      { type: "range", min: 10, max: 15, error_message: "The number you entered is not in range." },
    ]
  },
  "position": {
    rules: [
      { type: "required", error_message: "Please complete this required field." }
    ]
  },
  "how-did-you-hear-about-us": {
    rules: [
      { type: "required", error_message: "Please complete this required field." }
    ]
  },
  "company-name": {
    rules: [
      { type: "required", error_message: "Please complete this required field." }
    ]
  },
  "company-domain-name": {
    rules: [
      { type: "required", error_message: "Please complete this required field." }
    ]
  },
  "phone": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
      { type: "pattern", pattern: /^[+()\-.\sx0-9]*$/, error_message: "A valid phone number may only contain numbers, +()-. or x" },
      { type: "range", min: 10, max: 15, error_message: "The number you entered is not in range." },
    ]
  },
  "street-address": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "city": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "state-region": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "zip-code": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "location-type": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "tax-id": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "tax": { // fix this
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "years-business": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "company-size": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "annual-sales": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
      { type: "number", error_message: "The value should be a number." },
    ]
  },
  "project-size": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "product-showroom": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "buying-group": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  },
  "privacy-consent": {
    rules: [
      { type: "required", error_message: "Please complete this required field." },
    ]
  }
};