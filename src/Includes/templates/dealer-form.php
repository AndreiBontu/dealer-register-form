<div class="px-8 py-8 bg-white md:px-24 md:py-16 rounded-[10px]">
    <form id="dealer-register-form" method="POST">
        <?php wp_nonce_field('dealer_form_nonce_action', 'dealer_form_nonce'); ?>
        <input type="hidden" name="action" value="dealer_form_submission">
        <input type="hidden" name="redirect_to" value="<?= esc_url($_SERVER['REQUEST_URI']); ?>">

        <div class="space-y-6">
            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                <div class="sm:col-span-3">
                    <label for="first-name" class="block font-medium text-gray-900 label-required">First name</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="first-name"
                            id="first-name"
                            autocomplete="given-name"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="last-name" class="block font-medium text-gray-900 label-required">Last name</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="last-name"
                            id="last-name"
                            autocomplete="family-name"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="sm:col-span-6">
                    <label for="email" class="block font-medium text-gray-900 label-required">Email</label>
                    <p class="mt-1 text-xs text-gray-600 field-desc">By adding your email address, you agree to receive email communications from Pioneer Music Company.</p>
                    <div class="mt-1">
                        <input
                            id="email"
                            name="email"
                            type="email"
                            autocomplete="email"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="phone-number" class="block font-medium text-gray-900 label-required">Phone number</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="phone-number"
                            id="phone-number"
                            autocomplete="given-name"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="position" class="block font-medium text-gray-900 label-required">Position</label>
                    <div class="mt-1">
                        <select
                            id="position"
                            name="position"
                            autocomplete="position"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                            <option value="" disabled selected>Please Select</option>
                            <option>Owner</option>
                            <option>Purchasing</option>
                            <option>Operations</option>
                            <option>Sales</option>
                            <option>Accounting</option>
                            <option>Warehouse</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="how-did-you-hear-about-us" class="block font-medium text-gray-900 label-required">How Did You Hear About Us</label>
                    <div class="mt-1">
                        <select
                            id="how-did-you-hear-about-us"
                            name="how-did-you-hear-about-us"
                            autocomplete="how-did-you-hear-about-us"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                            <option value="" disabled selected>Please Select</option>
                            <option>Recommended by friend or colleague</option>
                            <option>Search engine (Google, Bing, etc.)</option>
                            <option>Social media</option>
                            <option>Blog or publication</option>
                            <option>Sales Rep</option>
                            <option>Vendor</option>
                            <option>Other</option>
                        </select>
                    </div>
                </div>
            </div>

            <fieldset>
                <label>What attracted you to us?</label>
                <div class="mt-1 space-y-1 pl-[5px]">
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="brand-we-carry" name="attracted-to-us[]" type="checkbox" value="Brand(s) we carry" class="h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="brand-we-carry" class="font-medium text-gray-900">Brand(s) we carry</label>
                        </div>
                    </div>
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="specific-job" name="attracted-to-us[]" type="checkbox" value="Specific Job Needs" class="h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="specific-job" class="font-medium text-gray-900">Specific Job Needs</label>
                        </div>
                    </div>
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="local-store" name="attracted-to-us[]" type="checkbox" value="Local Store" class="h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="local-store" class="font-medium text-gray-900">Local Store</label>
                        </div>
                    </div>
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="our-wonderful-personality" name="attracted-to-us[]" type="checkbox" value="Our Wonderful Personality" class="h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="our-wonderful-personality" class="font-medium text-gray-900">Our Wonderful Personality</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                <h2 class="text-[#33475b] text-[20px] font-bold whitespace-nowrap">Company Information</h2>

                <div class="col-span-full">
                    <label for="company-name" class="block font-medium text-gray-900 label-required">Company name</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="company-name"
                            id="company-name"
                            autocomplete="company-name"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="company-domain-name" class="block font-medium text-gray-900 label-required">Company domain name</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="company-domain-name"
                            id="company-domain-name"
                            autocomplete="company-domain-name"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="phone" class="block font-medium text-gray-900 label-required">Phone</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="phone"
                            id="phone"
                            autocomplete="phone"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="street-address" class="block font-medium text-gray-900 label-required">Street address</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="street-address"
                            id="street-address"
                            autocomplete="street-address"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="city" class="block font-medium text-gray-900 label-required">City</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="city"
                            id="city"
                            autocomplete="city"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="state-region" class="block font-medium text-gray-900 label-required">State/Region</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="state-region"
                            id="state-region"
                            autocomplete="state-region"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="sm:col-span-3">
                    <label for="zip-code" class="block font-medium text-gray-900 label-required">Zip Code</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="zip-code"
                            id="zip-code"
                            autocomplete="zip-code"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="location-type" class="block font-medium text-gray-900 label-required">Location Type</label>
                    <div class="mt-1">
                        <select
                            id="location-type"
                            name="location-type"
                            autocomplete="location-type"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                            <option value="" disabled selected>Please Select</option>
                            <option>Commercial</option>
                            <option>Residential</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="tax-id" class="block font-medium text-gray-900 label-required">Tax ID#</label>
                    <div class="mt-1">
                        <input
                            type="text"
                            name="tax-id"
                            id="tax-id"
                            autocomplete="tax-id"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <fieldset class="col-span-full required" id="tax">
                    <label class="block font-medium text-gray-900 label-required">Tax</label>
                    <div class="mt-3 space-y-1 pl-[5px]">
                        <div class="flex items-center gap-x-3">
                            <input id="taxable" name="tax" type="radio" value="Taxable" class="required h-3.5 w-3.5 border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                            <label for="taxable" class="block font-medium text-gray-900">Taxable</label>
                        </div>
                        <div class="flex items-center gap-x-3">
                            <input id="tax-exempt" name="tax" type="radio" value="Tax Exempt" class="required h-3.5 w-3.5 border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                            <label for="tax-exempt" class="block font-medium text-gray-900">Tax Exempt (Upload Exemption Certificates)</label>
                        </div>
                        <div id="taxExemptContainerUpload"></div>
                    </div>
                </fieldset>
            </div>

            <div class="mt-10 grid grid-cols-1 gap-x-6 gap-y-5 sm:grid-cols-6">
                <h2 class="text-[#33475b] text-[20px] font-bold whitespace-nowrap col-span-full">About Your Company</h2>

                <div class="col-span-full">
                    <label for="years-business" class="block font-medium text-gray-900 label-required">Years in Business</label>
                    <div class="mt-1">
                        <select
                            id="years-business"
                            name="years-business"
                            autocomplete="years-business"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                            <option value="" disabled selected>Please Select</option>
                            <option>Less than 1 Year</option>
                            <option>1 to 5 Years</option>
                            <option>More than 5 Years</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="company-size" class="block font-medium text-gray-900 label-required">Company Size</label>
                    <div class="mt-1">
                        <select
                            id="company-size"
                            name="company-size"
                            autocomplete="company-size"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                            <option value="" disabled selected>Please Select</option>
                            <option>1 to 2 Employees</option>
                            <option>3 to 7 Employees</option>
                            <option>8 to 15 Employees</option>
                            <option>15 to 25 Employees</option>
                            <option>More than 25 Employees</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="annual-sales" class="block font-medium text-gray-900 label-required">Approximate Annual Sales</label>
                    <div class="mt-1">
                        <input
                            type="number"
                            name="annual-sales"
                            id="annual-sales"
                            autocomplete="annual-sales"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="project-size" class="block font-medium text-gray-900 label-required">Average Project Size</label>
                    <div class="mt-1">
                        <select
                            id="project-size"
                            name="project-size"
                            autocomplete="project-size"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                            <option value="" disabled selected>Please Select</option>
                            <option>Less than $5,000</option>
                            <option>$5,000 to $10,000</option>
                            <option>$10,000 to $25,000</option>
                            <option>$25,000 to $50,000</option>
                            <option>Greater than $50,000</option>
                        </select>
                    </div>
                </div>

                <div class="col-span-full">
                    <label for="product-showroom" class="block font-medium text-gray-900 label-required">Product Showroom</label>
                    <div class="mt-1">
                        <select
                            id="product-showroom"
                            name="product-showroom"
                            autocomplete="product-showroom"
                            class="required block w-full max-w-[500px] h-[40px] px-4 py-2 text-gray-900 bg-[#f5f8fa] border border-[#cbd6e2] rounded-[3px] text-sm focus:ring-0 focus:outline-none focus:border-[rgba(82,168,236,.8)]"
                        >
                            <option value="" disabled selected>Please Select</option>
                            <option>Yes</option>
                            <option>No</option>
                            <option>Coming Soon</option>
                        </select>
                    </div>
                </div>
            </div>

            <fieldset id="industry">
                <label class="label-required">Primary Industry</label>
                <div class="mt-1 space-y-1 industry-wrapper pl-[5px]">
                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="custom-integration" name="primary-industry[]" type="checkbox" value="Custom Integration (Multi)" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="custom-integration" class="font-medium text-gray-900">Custom Integration (Multi)</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="retail" name="primary-industry[]" type="checkbox" value="Retail" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="retail" class="font-medium text-gray-900">Retail</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="rental" name="primary-industry[]" type="checkbox" value="Rental" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="rental" class="font-medium text-gray-900">Rental</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="commercial-av" name="primary-industry[]" type="checkbox" value="Commercial AV" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="commercial-av" class="font-medium text-gray-900">Commercial AV</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="residential-av" name="primary-industry[]" type="checkbox" value="Residential AV" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="residential-av" class="font-medium text-gray-900">Residential AV</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="security-intrusion" name="primary-industry[]" type="checkbox" value="Security/Intrusion" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="security-intrusion" class="font-medium text-gray-900">Security/Intrusion</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="electrical-lighting" name="primary-industry[]" type="checkbox" value="Electrical/Lighting" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="electrical-lighting" class="font-medium text-gray-900">Electrical/Lighting</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="networking-it" name="primary-industry[]" type="checkbox" value="Networking/IT Datacom" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="networking-it" class="font-medium text-gray-900">Networking/IT Datacom</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="access-control" name="primary-industry[]" type="checkbox" value="Access Control" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="access-control" class="font-medium text-gray-900">Access Control</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="intercom" name="primary-industry[]" type="checkbox" value="Intercom" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="intercom" class="font-medium text-gray-900">Intercom</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="fire" name="primary-industry[]" type="checkbox" value="Fire" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="fire" class="font-medium text-gray-900">Fire</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="electrical-contractor" name="primary-industry[]" type="checkbox" value="Electrical Contractor" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="electrical-contractor" class="font-medium text-gray-900">Electrical Contractor</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="it" name="primary-industry[]" type="checkbox" value="IT" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="it" class="font-medium text-gray-900">IT</label>
                        </div>
                    </div>

                    <div class="relative flex gap-x-3">
                        <div class="flex h-6 items-center">
                            <input id="other" name="primary-industry[]" type="checkbox" value="Other" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        </div>
                        <div class="text-sm/6">
                            <label for="other" class="font-medium text-gray-900">Other</label>
                        </div>
                    </div>
                </div>
            </fieldset>

            <fieldset id="buying-group">
                <label class="label-required">Buying Group</label>
                <div class="mt-1 space-y-1 pl-[5px]">
                    <div class="flex items-center gap-x-3">
                        <input id="yes" name="buying-group" type="radio" value="Yes" class="required h-3.5 w-3.5 border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        <label for="yes" class="block font-medium text-gray-900">Yes</label>
                    </div>
                    <div class="flex items-center gap-x-3">
                        <input id="no" name="buying-group" type="radio" value="No" class="required h-3.5 w-3.5 border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        <label for="no" class="block font-medium text-gray-900">No</label>
                    </div>
                    <div id="buying-group-name-container" class="col-span-full"></div>
                </div>
            </fieldset>

            <fieldset>
                <legend class="text-sm/6 font-semibold text-[#33475b]">Choose your account type:</legend>
                <div class="mt-1 space-y-1 pl-[5px]">
                    <div class="flex items-center gap-x-3">
                        <input id="net-terms" name="account-type" type="radio" value="Net Terms Application" class="h-3.5 w-3.5 border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        <label for="net-terms" class="block font-medium text-gray-900">Net Terms Application</label>
                    </div>
                    <div class="flex items-center gap-x-3">
                        <input id="credit-card" name="account-type" type="radio" value="Credit Card/Check Account Application" class="h-3.5 w-3.5 border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                        <label for="credit-card" class="block font-medium text-gray-900">Credit Card/Check Account Application</label>
                    </div>
                </div>
            </fieldset>

            <fieldset>
                <div class="relative flex gap-x-3 privacy-consent-wrapper">
                    <div class="flex h-6 items-center">
                        <input id="privacy-consent" name="privacy-consent" type="checkbox" value="Yes" class="required h-3.5 w-3.5 rounded border-gray-300 focus:outline-none focus:ring-0 focus:ring-offset-0">
                    </div>
                    <div class="text-sm/6">
                        <label for="privacy-consent" class="font-medium text-gray-900">I agree to the <a href="<?= esc_url(home_url('/privacy-policy/')) ?>" target="_blank">Privacy Policy</a></label>
                    </div>
                </div>
            </fieldset>

            <p class="mt-1 info-text">Please allow at least five business days for trade references to process. If you need an order sooner, apply for a credit account for speedy approval while waiting on terms.</p>

            <div class="g-recaptcha" data-sitekey="6LeTWX4qAAAAAGi_URKaK94sJTTchKqsCFiGcZwC"></div>
        </div>

        <div id="form-feedback" class="mt-12"></div>

        <div class="mt-6 flex items-center justify-start gap-x-6">
            <button type="submit" class="rounded-md bg-[#37d780] text-sm font-semibold shadow-sm form-submit-btn">Submit</button>
        </div>
    </form>
</div>
