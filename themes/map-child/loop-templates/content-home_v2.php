<?php
/**
 * Partial template for content in page.php
 * Harita Anasayafası
 * 
 * @package understrap
 */

?>

<article <?php post_class(); ?> id="post-
	<?php the_ID(); ?>">

	<div class="entry-content">
		<div class="container-fluid">
			<div class="row no-gutters">

				<div class="col-lg-10 col-md-12 col-sm-12 col-12">
						<?php 
						$args = array(
							'post_type'=> 'script_item',
							'order'    => 'ASC'
						);
						query_posts( $args );
						?>

						<?php echo GeoMashup::map('add_map_type_control=true&height=600&marker_select_highlight=true&marker_select_info_window=false&marker_select_center=false'); ?>
						<?php wp_reset_query(); ?>
				</div>

				<div class="col-lg-2 col-md-12 col-sm-12 col-12">
					<div class="scroll_area">
						<?php echo GeoMashup::visible_posts_list() ?>
					</div>
				</div>

			</div>
		</div>
		<div class="container-fluid">
			<div class="row">
				
			    <div class="col-lg-10 col-md-12 col-sm-12 col-12">
						</br><?php echo GeoMashup::full_post(); ?></br>
				</div>

				<div class="col-lg-2 col-md-12 col-sm-12 col-12">
						</br><?php echo GeoMashup::term_legend('noninteractive=false&format=ul') ?></br>
				</div>

				<div class="col-lg-12 col-md-12 col-sm-12 col-12">
					<?php the_content(); ?>
				</div>

			</div>
		</div>
	</div><!-- .entry-content -->
		
</article><!-- #post-## -->