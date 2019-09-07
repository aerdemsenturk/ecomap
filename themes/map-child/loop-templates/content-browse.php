<?php
/**
 * Partial template for content in page.php
 * Araştır Sayfası
 * 
 * @package understrap
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	<div class="container">

	<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
					<?php echo facetwp_display( 'facet', 'search' ); ?>
				</div>	
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<?php echo facetwp_display( 'facet', 'types' ); ?>
				</div> 
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<?php echo facetwp_display( 'facet', 'centuries' ); ?>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<?php echo facetwp_display( 'facet', 'found_places' ); ?>
				</div>
				<div class="col-lg-3 col-md-6 col-sm-6 col-xs-12">
					<?php echo facetwp_display( 'facet', 'current_places' ); ?>
				</div>
			</div>

		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->

	</div>

	<?php echo facetwp_display( 'template', 'script_items' ); ?>

	<script type="text/javascript">
	// FacetWP reload yaparsa ms-container yenilensin.
		(function($) {
			$(document).on('facetwp-loaded', function() {

				var $grid = $("#ms-container");
					$grid.imagesLoaded(function () {
						$grid.masonry({
						columnWidth: ".ms-item",
						itemSelector: ".ms-item"
						});
					});
			});
		})(jQuery);

	</script>
</article><!-- #post-## -->