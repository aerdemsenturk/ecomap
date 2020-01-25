<?php get_header(); ?>

<?php
$container   = get_theme_mod( 'understrap_container_type' );
?>

<?php echo GeoMashup::map('add_map_type_control=true'); ?>

<div class="wrapper" id="archive-wrapper">

<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

	<header class="page-header">
		<?php
		the_archive_title( '<h3 class="page-title">', '</h3>' );
		the_archive_description( '<div class="taxonomy-description">', '</div>' );
		?>
		<p><?php global $wp_query; echo $wp_query->post_count; ?> adet sonuç görüntüleniyor</p>
	</header><!-- .page-header -->

<div class="row" id="ms-container">

	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	    <div class="ms-item col-6 col-lg-2 col-md-3 col-sm-6 col-xs-6">
				<div class="card">

					<div class="card-img-top">
						<?php if (has_post_thumbnail()) : ?>
									<?php if ( has_post_thumbnail() ) : ?>
											<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="modal-link" >
												<?php the_post_thumbnail( 'medium' ); ?>
											</a>
									<?php endif; ?>
						<?php else : ?>
						<?php endif; ?>
					</div>

				    <div class="card-block">
			            <h5 class="card-title">
						<a href="<?php the_permalink(); ?>" class="post-title-link modal-link"><?php the_title(); ?></a>
						<br>
						<a href="#gm-map-1" title="Haritada göster" onclick="window.scrollTo(0,0);frames['gm-map-1'].GeoMashup.clickMarker('<?php the_ID()?>')">◎</a>
						<a href="<?php the_permalink(); ?>" title="Tüm detayları görüntüle" >❒</a>
						</h5>
	                </div>

				</div>
		</div>

	<?php endwhile;

	else : ?>
		<article class="no-posts">
			<h1><?php _e('No posts were found.'); ?></h1>
		</article>
	<?php endif; ?>

</div>

<div class="clearfix"></div>

<script type="text/javascript">
				jQuery(window).load(function() {
					var container = document.querySelector('#ms-container');
					var msnry = new Masonry( container, {
						itemSelector: '.ms-item',
						columnWidth: '.ms-item',
					});
				});
</script>

<!-- The pagination component -->
<?php understrap_pagination(); ?>

</div><!-- Container end -->

</div><!-- Wrapper end -->

<?php get_footer(); ?>
