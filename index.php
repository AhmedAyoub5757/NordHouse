<?php
/**
 * Main Template File (Canvas Style for Elementor Single Page)
 */
get_header(); 
?>

<main id="primary" class="site-main">
	<?php
	if ( have_posts() ) :
		while ( have_posts() ) :
			the_post();
			the_content();
		endwhile;
	endif;
	?>
</main>

<?php 
get_footer();