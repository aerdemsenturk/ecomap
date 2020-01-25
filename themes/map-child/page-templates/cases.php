<?php
/**
 * Template Name: Cases
 *
 * @package understrap
 */

get_header();
?>

<div class="wrapper" id="full-width-page-wrapper">

	<?php while ( have_posts() ) : the_post(); ?>
	<?php get_template_part( 'loop-templates/content', 'filter' ); ?>
	<?php endwhile; // end of the loop. ?>

	<?php echo facetwp_display( 'template', 'main' ); ?>
	
</div><!-- Wrapper end -->

<?php get_footer(); ?>