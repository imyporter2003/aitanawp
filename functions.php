<?php
/**
 * Aitana Financial Services Theme — Functions
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if (!function_exists('aitana_setup')):
    function aitana_setup()
    {
        // Theme support
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array('search-form', 'comment-form', 'gallery', 'caption'));
        add_theme_support('custom-logo');

        // Register nav menus
        register_nav_menus(array(
            'primary' => __('Primary Menu', 'aitana'),
        ));
    }
endif;
add_action('after_setup_theme', 'aitana_setup');

/**
 * Enqueue scripts and styles.
 */
function aitana_scripts()
{
    // Main stylesheet
    wp_enqueue_style('aitana-style', get_stylesheet_uri(), array(), '1.0.0');

    // Mobile nav toggle
    wp_enqueue_script(
        'aitana-nav',
        get_template_directory_uri() . '/js/nav.js',
        array(),
        '1.0.0',
        true
    );

}
add_action('wp_enqueue_scripts', 'aitana_scripts');

/**
 * Custom body classes
 */
function aitana_body_classes($classes)
{
    if (is_page()) {
        $classes[] = 'aitana-page';
    }
    return $classes;
}
add_filter('body_class', 'aitana_body_classes');

/**
 * Helper: get page URL by slug
 */
function aitana_page_url($slug)
{
    $page = get_page_by_path($slug);
    return $page ? get_permalink($page->ID) : home_url('/' . $slug . '/');
}
