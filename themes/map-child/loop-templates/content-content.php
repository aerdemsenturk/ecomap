<?php
/**
 * Single post partial script template.
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
<header class="entry-header">

<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

<div class="entry-meta">

	<?php understrap_posted_on(); ?>

</div><!-- .entry-meta -->

</header><!-- .entry-header -->
	<div class="entry-content">

			<div class="row">

				<div class="col-lg-4 col-md-12 col-sm-12 col-12">
							<?php the_content(); ?>
				</div>

				<div class="col-lg-8 col-md-12 col-sm-12 col-12">
							<?php echo GeoMashup::map('map_content=single&add_map_type_control=true');?>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<div class="entry-meta">
								<small><b>Editör </b><?php the_author_posts_link(); ?></small>
								<small><b> Son güncelleme </b><?php the_modified_time( 'j F Y' ); ?></small>
								<h1><?php do_action('back_button'); ?></h1>
					</div><!-- .entry-meta -->
				</div>

			</div>

	</div><!-- .entry-content -->
	
</article><!-- #post-## -->
