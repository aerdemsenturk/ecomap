<?php
/**
 * Partial template for content in page.php
 * Harita Anasayafası
 * 
 * @package understrap
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="container-fluid">

		<div class="row">

			<div class="col-6 p-0">
				<?php echo GeoMashup::term_legend('noninteractive=false&format=ul') ?>
			</div>

			<div class="col-6 p-0">
				<ul class="list-group list-group-flush">
					<?php
					// Show recently modified posts
					$recently_updated_posts = new WP_Query( array(
						'post_type'      => 'case',
						'posts_per_page' => 8,
						'orderby'        => 'modified',
						'no_found_rows'  => true, // speed up query when we don't need pagination
					) );
					if ( $recently_updated_posts->have_posts() ) :
						while( $recently_updated_posts->have_posts() ) : $recently_updated_posts->the_post(); ?>
					<li class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">
							<a href="<?php the_permalink(); ?>" title="<?php esc_attr( get_the_title() ); ?>">
							<?php the_title(); ?></a>
							<small class="text-muted"><?php the_modified_time( 'j F Y' ); ?></small>
					</li>
					<?php endwhile; ?>
					<?php wp_reset_postdata(); ?>
					<?php endif; ?>
				</ul>
			</div>

			<div class="col-12">
				<div class="entry-content">
					<?php the_content(); ?>
					<a href="#gm-map-1" title="Showallmarkers" onclick="frames['gm-map-1'].GeoMashup.hideMarkers()">Hide Markers</a>
					<a href="#gm-map-1" title="Hideallmarkers" onclick="frames['gm-map-1'].GeoMashup.showMarkers()">Show Markers</a>
				</div><!-- .entry-content -->
			</div>

		</div>

	</div>

</article><!-- #post-## -->