<?php
/**
 * Matcha Launch Theme — functions.php
 */

if ( ! defined( 'ABSPATH' ) ) exit;

define( 'MATCHA_THEME_VERSION', '1.0.0' );
define( 'MATCHA_THEME_DIR', get_template_directory() );
define( 'MATCHA_THEME_URI', get_template_directory_uri() );

/**
 * Theme setup
 */
function matcha_theme_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'responsive-embeds' );
	add_theme_support( 'align-wide' );

	// Elementor support
	add_theme_support( 'elementor' );
}
add_action( 'after_setup_theme', 'matcha_theme_setup' );

/**
 * Enqueue assets
 */
function matcha_enqueue_assets() {
	wp_enqueue_style(
		'matcha-main',
		MATCHA_THEME_URI . '/assets/css/main.css',
		array(),
		MATCHA_THEME_VERSION
	);

	wp_enqueue_script(
		'matcha-main',
		MATCHA_THEME_URI . '/assets/js/main.js',
		array(),
		MATCHA_THEME_VERSION,
		true
	);
}
add_action( 'wp_enqueue_scripts', 'matcha_enqueue_assets' );

/**
 * Disable Gutenberg block library CSS on front end (Elementor handles layout)
 */
function matcha_dequeue_block_css() {
	wp_dequeue_style( 'wp-block-library' );
	wp_dequeue_style( 'wp-block-library-theme' );
	wp_dequeue_style( 'global-styles' );
}
add_action( 'wp_enqueue_scripts', 'matcha_dequeue_block_css', 100 );

/**
 * Load custom Elementor widgets
 * Each section lives in its own file inside inc/widgets/
 */
function matcha_load_widget_files() {
	$widgets_path = MATCHA_THEME_DIR . '/inc/widgets/';

	if ( ! is_dir( $widgets_path ) ) return;

	foreach ( glob( $widgets_path . '*.php' ) as $widget_file ) {
		require_once $widget_file;
	}
}

/**
 * Register custom widgets with Elementor
 */
function matcha_register_elementor_widgets( $widgets_manager ) {
	matcha_load_widget_files();

	// Each widget file defines a class named Matcha_<Section>_Widget
	// e.g. Matcha_Hero_Widget, Matcha_Flavors_Widget, etc.
	// They self-register below once classes exist.
	$widget_classes = apply_filters( 'matcha_widget_classes', array() );

	foreach ( $widget_classes as $widget_class ) {
		if ( class_exists( $widget_class ) ) {
			$widgets_manager->register( new $widget_class() );
		}
	}
}
add_action( 'elementor/widgets/register', 'matcha_register_elementor_widgets' );

/**
 * Register a custom Elementor widget category for this project
 */
function matcha_register_widget_category( $elements_manager ) {
	$elements_manager->add_category(
		'matcha-sections',
		array(
			'title' => __( 'Matcha Sections', 'matcha-launch' ),
			'icon'  => 'fa fa-plug',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'matcha_register_widget_category' );

/**
 * Clean up wp_head
 */
function matcha_cleanup_head() {
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head' );
}
add_action( 'init', 'matcha_cleanup_head' );

/**
 * Register navigation menus (optional — likely minimal for single-page site)
 */
function matcha_register_menus() {
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'matcha-launch' ),
	) );
}
add_action( 'after_setup_theme', 'matcha_register_menus' );