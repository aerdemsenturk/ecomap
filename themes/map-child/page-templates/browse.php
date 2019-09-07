<?php
/**
 * Template Name: Full Width Browse Page
 *
 * Template for displaying a page without sidebar even if a sidebar widget is published.
 *
 * @package understrap
 */

get_header();
?>

<div id="full-width-page-wrapper">

	<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'loop-templates/content', 'browse' ); ?>
	<?php endwhile; // end of the loop. ?>

</div><!-- Wrapper end -->

<?php get_footer(); ?>