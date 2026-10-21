<?php
/**
 * Fallback template — the single-page build is assembled via Elementor
 * on the front page, so this mostly just needs to exist.
 */

if ( ! defined( 'ABSPATH' ) ) exit;

get_header();
?>

<main id="main-content">
	<?php
	while ( have_posts() ) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();