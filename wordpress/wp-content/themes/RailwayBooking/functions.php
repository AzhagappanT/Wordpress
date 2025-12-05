<?php
/**
 * Railway Booking Theme Functions
 */

function railway_booking_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'railway-booking'),
    ));
}
add_action('after_setup_theme', 'railway_booking_setup');

function railway_booking_scripts()
{
    wp_enqueue_style('railway-style', get_stylesheet_uri());
}
add_action('wp_enqueue_scripts', 'railway_booking_scripts');

/**
 * Register Custom Post Types
 */
function railway_register_cpts()
{
    // Register Train CPT
    register_post_type('train', array(
        'labels' => array(
            'name' => __('Trains', 'railway-booking'),
            'singular_name' => __('Train', 'railway-booking'),
            'add_new_item' => __('Add New Train', 'railway-booking'),
            'edit_item' => __('Edit Train', 'railway-booking'),
        ),
        'public' => true,
        'has_archive' => true,
        'menu_icon' => 'dashicons-train',
        'supports' => array('title', 'editor', 'custom-fields'),
    ));

    // Register Booking CPT
    register_post_type('booking', array(
        'labels' => array(
            'name' => __('Bookings', 'railway-booking'),
            'singular_name' => __('Booking', 'railway-booking'),
        ),
        'public' => false, // Not public
        'show_ui' => true, // Show in admin
        'menu_icon' => 'dashicons-tickets-alt',
        'supports' => array('title', 'custom-fields'),
    ));
}
add_action('init', 'railway_register_cpts');
