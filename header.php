<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<?php wp_head(); ?>
</head>
<body <?php body_class( 'bg-dark text-light' ); ?>>
<?php wp_body_open(); ?>

<header class="site-header">
	<div class="header-container">
		<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="brand-logo">
			<?php bloginfo( 'name' ); ?><span>.</span>
		</a>
		<nav class="main-navigation">
			<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
				'container'      => false,
				'fallback_cb'    => false,
			) );
			?>
		</nav>
	</div>
</header>
<main id="primary" class="site-main">