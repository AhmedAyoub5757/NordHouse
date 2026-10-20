<?php
/**
 * Nordhouse theme bootstrap.
 *
 * @package Nordhouse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'NORDHOUSE_VERSION', '1.0.0' );
define( 'NORDHOUSE_DIR', get_template_directory() );
define( 'NORDHOUSE_URI', get_template_directory_uri() );

/* -------------------------------------------------------------------------
 * Theme setup
 * ---------------------------------------------------------------------- */
function nordhouse_setup() {
	load_theme_textdomain( 'nordhouse', NORDHOUSE_DIR . '/languages' );

	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'script', 'style' ) );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'align-wide' );
	add_theme_support( 'responsive-embeds' );

	// Elementor support.
	add_theme_support( 'elementor' );
	add_theme_support( 'elementor-pro' ); // harmless if Pro isn't installed; future-proofs us.

	register_nav_menus( array(
		'primary' => __( 'Primary Navigation', 'nordhouse' ),
	) );
}
add_action( 'after_setup_theme', 'nordhouse_setup' );

/* -------------------------------------------------------------------------
 * Assets
 * ---------------------------------------------------------------------- */
function nordhouse_enqueue_assets() {
	// Fonts — Space Grotesk (display) + Inter (body).
	wp_enqueue_style(
		'nordhouse-fonts',
		'https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap',
		array(),
		null
	);

	// Theme stylesheet (required by WP, kept empty/minimal).
	wp_enqueue_style( 'nordhouse-style', get_stylesheet_uri(), array(), NORDHOUSE_VERSION );

	// Main compiled styles.
	$main_css = NORDHOUSE_DIR . '/assets/css/main.css';
	wp_enqueue_style(
		'nordhouse-main',
		NORDHOUSE_URI . '/assets/css/main.css',
		array( 'nordhouse-fonts' ),
		file_exists( $main_css ) ? filemtime( $main_css ) : NORDHOUSE_VERSION
	);

	// Main JS — defer, no jQuery dependency.
	$main_js = NORDHOUSE_DIR . '/assets/js/main.js';
	wp_enqueue_script(
		'nordhouse-main',
		NORDHOUSE_URI . '/assets/js/main.js',
		array(),
		file_exists( $main_js ) ? filemtime( $main_js ) : NORDHOUSE_VERSION,
		true
	);
	wp_script_add_data( 'nordhouse-main', 'strategy', 'defer' );
}
add_action( 'wp_enqueue_scripts', 'nordhouse_enqueue_assets' );

/* -------------------------------------------------------------------------
 * Global color palette (Customizer) -> CSS custom properties
 * Single source of truth. Every widget should reference these tokens,
 * never hardcode a hex value.
 * ---------------------------------------------------------------------- */
function nordhouse_color_defaults() {
	return array(
		'color_bg'          => '#0B0B0C',
		'color_bg_alt'       => '#141416',
		'color_text'         => '#F4F3EF',
		'color_text_muted'   => '#9A9A9D',
		'color_accent'       => '#D6FF3F',
		'color_accent_2'     => '#5B6CFF',
		'color_border'       => '#2A2A2D',
	);
}

function nordhouse_customize_register( $wp_customize ) {
	$defaults = nordhouse_color_defaults();

	$wp_customize->add_panel( 'nordhouse_theme_options', array(
		'title'    => __( 'Nordhouse Theme Options', 'nordhouse' ),
		'priority' => 10,
	) );

	$wp_customize->add_section( 'nordhouse_colors', array(
		'title' => __( 'Colors', 'nordhouse' ),
		'panel' => 'nordhouse_theme_options',
	) );

	$labels = array(
		'color_bg'        => __( 'Background', 'nordhouse' ),
		'color_bg_alt'    => __( 'Background (alt)', 'nordhouse' ),
		'color_text'      => __( 'Text', 'nordhouse' ),
		'color_text_muted'=> __( 'Text (muted)', 'nordhouse' ),
		'color_accent'    => __( 'Accent (primary)', 'nordhouse' ),
		'color_accent_2'  => __( 'Accent (secondary)', 'nordhouse' ),
		'color_border'    => __( 'Border / hairline', 'nordhouse' ),
	);

	foreach ( $defaults as $key => $default ) {
		$wp_customize->add_setting( $key, array(
			'default'           => $default,
			'sanitize_callback' => 'sanitize_hex_color',
			'transport'         => 'postMessage',
		) );

		$wp_customize->add_control( new WP_Customize_Color_Control(
			$wp_customize,
			$key,
			array(
				'label'   => $labels[ $key ],
				'section' => 'nordhouse_colors',
			)
		) );
	}
}
add_action( 'customize_register', 'nordhouse_customize_register' );

function nordhouse_output_color_variables() {
	$defaults = nordhouse_color_defaults();
	$vars     = array();

	foreach ( $defaults as $key => $default ) {
		$value           = get_theme_mod( $key, $default );
		$css_var         = '--' . str_replace( '_', '-', $key );
		$vars[]          = $css_var . ': ' . $value . ';';
	}

	echo '<style id="nordhouse-color-vars">:root{' . implode( '', $vars ) . '}</style>' . "\n";
}
add_action( 'wp_head', 'nordhouse_output_color_variables', 5 );

/* -------------------------------------------------------------------------
 * Elementor: custom widget category + registration
 * Drop new widget classes in inc/widgets/ and register them below.
 * ---------------------------------------------------------------------- */
function nordhouse_elementor_widget_categories( $elements_manager ) {
	$elements_manager->add_category(
		'nordhouse',
		array(
			'title' => __( 'Nordhouse Sections', 'nordhouse' ),
			'icon'  => 'eicon-layout',
		)
	);
}
add_action( 'elementor/elements/categories_registered', 'nordhouse_elementor_widget_categories' );

function nordhouse_register_widgets( $widgets_manager ) {
	require_once NORDHOUSE_DIR . '/inc/class-widget-base.php';

	/**
	 * Register each section widget here as it's built, e.g.:
	 *
	 * require_once NORDHOUSE_DIR . '/inc/widgets/class-navbar.php';
	 * $widgets_manager->register( new \Nordhouse\Widgets\Navbar() );
	 *
	 * require_once NORDHOUSE_DIR . '/inc/widgets/class-hero.php';
	 * $widgets_manager->register( new \Nordhouse\Widgets\Hero() );
	 */
}
add_action( 'elementor/widgets/register', 'nordhouse_register_widgets' );

/* -------------------------------------------------------------------------
 * Cleanup
 * ---------------------------------------------------------------------- */
function nordhouse_cleanup_head() {
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
	remove_action( 'wp_print_styles', 'print_emoji_styles' );
}
add_action( 'init', 'nordhouse_cleanup_head' );

/**
 * This is a single landing-page build — disable comments / comment UI
 * entirely to keep the admin and markup clean.
 */
function nordhouse_disable_comments_admin_menu() {
	remove_menu_page( 'edit-comments.php' );
}
add_action( 'admin_menu', 'nordhouse_disable_comments_admin_menu' );

add_filter( 'comments_open', '__return_false', 20, 2 );
add_filter( 'pings_open', '__return_false', 20, 2 );