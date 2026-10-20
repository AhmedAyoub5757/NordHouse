<?php
/**
 * Fallback template.
 * This is a single-page Elementor build — the real markup for the front
 * page comes from Elementor's own content output (widgets render inside
 * the_content). This file stays deliberately minimal: a shell + content.
 *
 * @package Nordhouse
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

<main id="nordhouse-main" class="nordhouse-main">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();