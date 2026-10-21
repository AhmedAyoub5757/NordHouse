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

