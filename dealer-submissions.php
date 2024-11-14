<?php

if (!defined('ABSPATH')) {
    die('You cannot access this file directly.');
}

/**
 * @return void
 */
function create_submissions_page(): void
{
    $args = [
        'public' => true,
        'post_type' => 'dealer-submissions',
        'has_archive' => true,
        'publicly_queryable' => false,
        'labels' => [
            'name' => 'Dealer Submissions',
            'singular_name' => 'Submissions',
            'edit_item' => 'View Dealer Submission',
        ],
        'supports' => false,
        'capability_type' => 'post',
        'capabilities' => [
            'create_posts' => false,
        ],
        'map_meta_cap' => true,
    ];

    register_post_type('dealer-submissions', $args);
}
add_action('init', 'create_submissions_page');

/**
 * @return void
 */
function display_meta_box_with_submissions(): void
{
    add_meta_box('custom_dealer_submissions', 'Submission', 'display_dealer_submissions', 'dealer-submissions');
}
add_action('add_meta_boxes', 'display_meta_box_with_submissions');

/**
 * @return void
 */
function display_dealer_submissions(): void
{
    $attractions = get_post_meta(get_the_ID(), 'attracted-to-us', true);
    $formatted_attractions = is_array($attractions) ? implode(', ', $attractions) : $attractions;

    $primary_industry = get_post_meta(get_the_ID(), 'primary-industry', true);
    $formatted_primary_industry = is_array($primary_industry) ? implode(', ', $primary_industry) : $primary_industry;

    $buying_group_name = esc_html(get_post_meta(get_the_ID(), 'buying-group-name', true)) ?: 'Undefined';

    $uploaded_file_url = get_post_meta(get_the_ID(), 'tax_exempt_file_url', true);

    echo '<h1><strong>Dealer Information</strong></h1>';

    echo '<ul>';
    echo '<li><strong>First Name:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'first-name', true)) . '</li>';
    echo '<li><strong>Last Name:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'last-name', true)) . '</li>';
    echo '<li><strong>Email:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'email', true)) . '</li>';
    echo '<li><strong>Phone Number:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'phone-number', true)) . '</li>';
    echo '<li><strong>Position:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'position', true)) . '</li>';
    echo '<li><strong>How did you hear about us:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'how-did-you-hear-about-us', true)) . '</li>';
    echo '<li><strong>What attracted you to us:</strong> ' . esc_html($formatted_attractions) . '</li>';
    echo '</ul>';

    echo '<h1><strong>Company Information</strong></h1>';

    echo '<ul>';
    echo '<li><strong>Company Name:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'company-name', true)) . '</li>';
    echo '<li><strong>Company Domain Name:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'company-domain-name', true)) . '</li>';
    echo '<li><strong>Phone:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'phone', true)) . '</li>';
    echo '<li><strong>Street Address:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'street-address', true)) . '</li>';
    echo '<li><strong>City:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'city', true)) . '</li>';
    echo '<li><strong>State/Region:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'state-region', true)) . '</li>';
    echo '<li><strong>Zip Code:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'zip-code', true)) . '</li>';
    echo '<li><strong>Location Type:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'location-type', true)) . '</li>';
    echo '<li><strong>Tax ID:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'tax-id', true)) . '</li>';
    echo '<li><strong>Tax:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'tax', true)) . '</li>';
    if ($uploaded_file_url) {
        // Display the file URL as a link
        echo '<li><strong>Uploaded File (Tax Exemption Certificate):</strong> <a href="' . esc_url($uploaded_file_url) . '" target="_blank">Download File</a></li>';
    }
    echo '</ul>';

    echo '<h1><strong>About Your Company</strong></h1>';

    echo '<ul>';
    echo '<li><strong>Years in Business:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'years-business', true)) . '</li>';
    echo '<li><strong>Company Size:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'company-size', true)) . '</li>';
    echo '<li><strong>Approximate Annual Sales:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'annual-sales', true)) . '</li>';
    echo '<li><strong>Average Project Size:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'project-size', true)) . '</li>';
    echo '<li><strong>Product Showroom:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'product-showroom', true)) . '</li>';
    echo '<li><strong>Primary Industry:</strong> ' . esc_html($formatted_primary_industry) . '</li>';
    echo '<li><strong>Buying Group:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'buying-group', true)) . '</li>';
    echo '<li><strong>Buying Group Name:</strong> ' . $buying_group_name . '</li>';
    echo '<li><strong>Account Type:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'account-type', true)) . '</li>';
    echo '<li><strong>Privacy Policy:</strong> ' . esc_html(get_post_meta(get_the_ID(), 'privacy-consent', true)) . '</li>';
    echo '</ul>';
}

/**
 * @param $columns
 * @return array
 */
function manage_dealer_submissions_columns($columns): array
{
    return [
        'cb' => $columns['cb'],
        'first-name' => 'First Name',
        'last-name' => 'Last Name',
        'email' => 'Email',
        'company-name' => 'Company Name',
    ];
}
add_filter('manage_dealer-submissions_posts_columns', 'manage_dealer_submissions_columns');

/**
 * @param $column
 * @param $post_id
 * @return void
 */
function display_dealer_submission_columns($column, $post_id): void
{
    switch ($column) {
        case 'first-name':
            echo esc_html(get_post_meta($post_id, 'first-name', true));
            break;
        case 'last-name':
            echo esc_html(get_post_meta($post_id, 'last-name', true));
            break;
        case 'email':
            echo esc_html(get_post_meta($post_id, 'email', true));
            break;
        case 'company-name':
            echo esc_html(get_post_meta($post_id, 'company-name', true));
            break;
    }
}
add_action('manage_dealer-submissions_posts_custom_column', 'display_dealer_submission_columns', 10, 2);

/**
 * Remove Quick Edit for the custom post type.
 *
 * @param  array  $actions The list of actions for the post.
 * @param  WP_Post  $post The current post object.
 * @return array Modified list of actions.
 */
function remove_quick_edit_for_dealer_submissions(array $actions, WP_Post $post): array
{
    // Check if the post type is 'dealer-submissions'
    if ($post->post_type == 'dealer-submissions') {
        // Remove the Quick Edit action
        unset($actions['inline hide-if-no-js']);
    }

    return $actions;
}
add_filter('post_row_actions', 'remove_quick_edit_for_dealer_submissions', 10, 2);
