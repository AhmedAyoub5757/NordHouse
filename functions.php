<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Setup Theme Features & Enqueue Assets
 */
function nexus_agency_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-logo' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );
}
add_action( 'after_setup_theme', 'nexus_agency_setup' );

function nexus_agency_enqueue_scripts() {
	// Main CSS
	wp_enqueue_style(
		'nexus-main-style',
		get_template_directory_uri() . '/assets/css/main.css',
		array(),
		'1.0.0'
	);

	// Main JS
	wp_enqueue_script(
		'nexus-main-script',
		get_template_directory_uri() . '/assets/js/main.js',
		array( 'jquery' ),
		'1.0.0',
		true
	);
}
add_action( 'wp_enqueue_scripts', 'nexus_agency_enqueue_scripts' );

/**
 * Register Custom Elementor Category for Theme Widgets
 */
function nexus_add_elementor_widget_categories( $elements_manager ) {
	$elements_manager->add_category(
		'nexus-agency-widgets',
		array(
			'title' => esc_html__( 'Nexus Custom Widgets', 'nexus-agency' ),
			'icon'  => 'fa fa-plug',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'nexus_add_elementor_widget_categories' );