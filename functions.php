<?php
/**
 * Kinetic Theme Functions
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Setup theme defaults & support
function kinetic_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
	
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'kinetic' ),
	) );
}
add_action( 'after_setup_theme', 'kinetic_theme_setup' );

// Enqueue styles and scripts
// Enqueue styles and scripts
function kinetic_enqueue_assets() {
	// 3rd Party CSS
	wp_enqueue_style( 'locomotive-scroll-css', 'https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.css', array(), '4.1.4' );

	// Theme Main CSS
	wp_enqueue_style( 'kinetic-main', get_template_directory_uri() . '/assets/css/main.css', array( 'locomotive-scroll-css' ), '1.0.0' );

	// 3rd Party JS (GSAP + ScrollTrigger + Locomotive Scroll)
	wp_enqueue_script( 'gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array(), '3.12.5', true );
	wp_enqueue_script( 'gsap-scroll-trigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array( 'gsap' ), '3.12.5', true );
	wp_enqueue_script( 'locomotive-scroll-js', 'https://cdn.jsdelivr.net/npm/locomotive-scroll@4.1.4/dist/locomotive-scroll.min.js', array(), '4.1.4', true );

	// Theme Main JS
	wp_enqueue_script( 'kinetic-main', get_template_directory_uri() . '/assets/js/main.js', array( 'gsap', 'gsap-scroll-trigger', 'locomotive-scroll-js' ), '1.0.0', true );
}
add_action( 'wp_enqueue_scripts', 'kinetic_enqueue_assets' );

// Register custom Elementor widget category
function kinetic_add_elementor_widget_category( $elements_manager ) {
	$elements_manager->add_category(
		'kinetic-widgets',
		array(
			'title' => __( 'Kinetic Custom Widgets', 'kinetic' ),
			'icon'  => 'fa fa-plug',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'kinetic_add_elementor_widget_category' );

// Auto-include all custom Elementor widgets from inc/widgets/
function kinetic_register_elementor_widgets( $widgets_manager ) {
	$widget_files = glob( get_template_directory() . '/inc/widgets/*.php' );
	foreach ( $widget_files as $file ) {
		require_once $file;
	}
}
add_action( 'elementor/widgets/register', 'kinetic_register_elementor_widgets' );

/**
 * Register Custom REST API Endpoint for Terminal Contact Questionnaire
 */
function kinetic_register_contact_endpoint() {
    register_rest_route( 'kinetic/v1', '/submit-inquiry', array(
        'methods'             => 'POST',
        'callback'            => 'kinetic_handle_inquiry_submission',
        'permission_callback' => '__return_true',
    ) );
}
add_action( 'rest_api_init', 'kinetic_register_contact_endpoint' );

function kinetic_handle_inquiry_submission( $request ) {
    $params = $request->get_json_params();

    // Sanitize Inputs
    $services = ! empty( $params['services'] ) ? array_map( 'sanitize_text_field', $params['services'] ) : array();
    $budget   = ! empty( $params['budget'] ) ? sanitize_text_field( $params['budget'] ) : 'NOT SPECIFIED';
    $details  = ! empty( $params['details'] ) ? sanitize_textarea_field( $params['details'] ) : '';
    $name     = ! empty( $params['name'] ) ? sanitize_text_field( $params['name'] ) : '';
    $email    = ! empty( $params['email'] ) ? sanitize_email( $params['email'] ) : '';

    // Validation
    if ( empty( $name ) || empty( $email ) || ! is_email( $email ) ) {
        return new WP_REST_Response( array(
            'success' => false,
            'message' => 'VALID NAME AND EMAIL ARE REQUIRED.',
        ), 400 );
    }

    // Build Email Body
    $admin_email = get_option( 'admin_email' );
    $subject     = '⚡ NEW KINETIC INQUIRY: ' . strtoupper( $name );
    
    $message  = "<h2>NEW PROJECT INQUIRY SUBMISSION</h2><hr>";
    $message .= "<p><strong>Client Name:</strong> {$name}</p>";
    $message .= "<p><strong>Email:</strong> {$email}</p>";
    $message .= "<p><strong>Services Required:</strong> " . implode( ', ', $services ) . "</p>";
    $message .= "<p><strong>Budget Tier:</strong> {$budget}</p>";
    $message .= "<p><strong>Project Details:</strong><br>{$details}</p>";

    $headers = array( 'Content-Type: text/html; charset=UTF-8', "From: KINETIC Engine <{$admin_email}>" );

    // Send Mail via WordPress Engine
    $mail_sent = wp_mail( $admin_email, $subject, $message, $headers );

    if ( $mail_sent ) {
        return new WP_REST_Response( array(
            'success' => true,
            'message' => 'INQUIRY TRANSMITTED SUCCESSFULLY.',
        ), 200 );
    } else {
        return new WP_REST_Response( array(
            'success' => false,
            'message' => 'SERVER MAIL ERROR. PLEASE TRY AGAIN LATER.',
        ), 500 );
    }
}

/**
 * Enqueue Three.js and Theme Assets
 */
/**
 * Enqueue Kinetic Theme Scripts and Libraries
 */
function kinetic_enqueue_hero_three_scripts() {
	// Three.js CDN
	wp_enqueue_script(
		'three-js',
		'https://cdnjs.cloudflare.com/ajax/libs/three.js/r128/three.min.js',
		array(),
		'r128',
		true
	);

	// GSAP & ScrollTrigger
	wp_enqueue_script(
		'gsap',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js',
		array(),
		'3.12.2',
		true
	);

	wp_enqueue_script(
		'gsap-scroll-trigger',
		'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/ScrollTrigger.min.js',
		array( 'gsap' ),
		'3.12.2',
		true
	);

	// Main Theme JS
	wp_enqueue_script(
		'kinetic-main-js',
		get_template_directory_uri() . '/assets/js/main.js',
		array( 'jquery', 'three-js', 'gsap', 'gsap-scroll-trigger' ),
		'1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'kinetic_enqueue_hero_three_scripts' );


