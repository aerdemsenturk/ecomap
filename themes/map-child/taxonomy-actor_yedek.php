<?php get_header(); ?>

<?php
$container   = get_theme_mod( 'understrap_container_type' );
?>

<?php echo GeoMashup::map('add_map_type_control=true'); ?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">

		<header class="page-header">
			<?php
			
			the_archive_title( '<h2 class="page-title">', '</h2>' );

			$term_object = get_queried_object();
			$actor_type = get_field('actor_type', 'actor_' . $term_object->term_id . '' );
			$actor_web = get_field('actor_web', 'actor_' . $term_object->term_id . '' );
			$actor_image = get_field('actor_image', 'actor_' . $term_object->term_id . '' );
			$actor_country = get_field('actor_country', 'actor_' . $term_object->term_id . '' );
			
			//subtitle
			echo $actor_type;
			echo '&nbsp;';
			echo $term_object->taxonomy;
			echo '&nbsp; - ';
			echo $actor_country;

			// actor web
			if($actor_web)
			{
			echo '<div><a href="' . $actor_web . '" target="_blank">Web Adresi</a></div>';
			}

			// actor image
			echo '<div class="row">';
			echo '<div class="col-6"><a href="' . $actor_web . '" target="_blank">' . '<img src="' . $actor_image['sizes']['thumbnail'] . '" class="rounded-circle" alt="' . $actor_image['alt'] .'"></a></div>';
			the_archive_description( '<div class="col-6">', '</div>' );
			echo '</div>';

			?>

		</header>
		
		<!-- Masonry Style
		<div class="row" id="ms-container">

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="ms-item col-6 col-lg-2 col-md-2 col-sm-3 col-xs-6 ">
					<div class="card">
						<div class="card-img-top">
							<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="modal-link">
								<?php the_post_thumbnail( 'medium' ); ?>
							</a>

						</div>
						<div class="card-block">
							<h5 class="card-title"><a href="<?php the_permalink(); ?>" class="post-title-link modal-link"><?php the_title(); ?></a></h5>
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

		<script type="text/javascript">
						jQuery(window).load(function() {
							var container = document.querySelector('#ms-container');
							var msnry = new Masonry( container, {
								itemSelector: '.ms-item',
								columnWidth: '.ms-item',
							});
						});
		</script>
		-->

		<p><?php global $wp_query; echo $wp_query->post_count; ?> adet sonuç görüntüleniyor</p>

	</div><!-- Container end -->

		<div class="card-block">
			<!-- Cases -->

			<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="card">
				<div class="card-header" >
					<div class="row">
						<div class="col-1">
							<a href="#gm-map-1" title="Haritada göster" data-toggle="tooltip" data-placement="right" onclick="window.scrollTo(0,0);frames['gm-map-1'].GeoMashup.clickMarker('<?php the_ID()?>')"><div class="show_on_map">✹</div></a>
						</div>
						<div class="col-4 nopadding">
							<?php echo get_the_date('Y'); ?>

							<a role="tab" id="<?php the_ID(); ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php the_ID(); ?>"
							aria-expanded="false" aria-controls="collapse<?php the_ID(); ?>">
							<h4><?php the_title(); ?></h4>
							</a>

						</div>

						<div class="col-3 text-left">
							<?php
							$commodity_terms = get_the_terms( $post->ID,  'commodity' );
							if ( ! empty( $commodity_terms ) ) {
								if ( ! is_wp_error( $commodity_terms ) ) {
										foreach( $commodity_terms as $term ) {
											echo '<a href="' . get_term_link( $term->slug, 'commodity' ) . '">●&nbsp;' . esc_html( $term->name ) . '&nbsp;</a>'; 
										}
								}
							}
							?>
						</div>

						<div class="col-4 text-left">
							<?php
							$impact_terms = get_the_terms( $post->ID,  'impact' );
							if ( ! empty( $impact_terms ) ) {
								if ( ! is_wp_error( $impact_terms ) ) {
										foreach( $impact_terms as $term ) {
											echo '<a href="' . get_term_link( $term->slug, 'impact' ) . '">●&nbsp;' . esc_html( $term->name ) . '&nbsp;</a>'; 
										}
								}
							}
							?>
						</div>

					</div>
				</div>
			
				<div id="collapse<?php the_ID(); ?>" class="collapse" role="tabpanel" aria-labelledby="<?php the_ID(); ?>">
					<div class="card-block">

							<div class="row">
								<div class="col-6">
									<?php the_excerpt(); ?>
								</div>
								<div class="col-3">
								<?php	
									$types = get_field('actor_pro');
									foreach($types as $type) {
										$term_link = get_term_link( $type );
										$actor_type = get_field('actor_type', 'actor_' . $type->term_id . '' );
	
										if ( has_term( $type->term_id, 'actor')) {
											echo '<ul class="list-group list-group-flush">';
											echo '<li class="list-group-item"><a href="' . esc_url( $term_link ) . '">' . $type->name . '</a> - <i>' . $actor_type . '</i></li>';
											echo '</ul>';
										}
									} 
								?>
								</div>
								<div class="col-3">
								<?php	
									$types = get_field('actor_contra');
									foreach($types as $type) {
										$term_link = get_term_link( $type );
										$actor_type = get_field('actor_type', 'actor_' . $type->term_id . '' );
	
										if ( has_term( $type->term_id, 'actor')) {
											echo '<ul class="list-group list-group-flush">';
											echo '<li class="list-group-item"><a href="' . esc_url( $term_link ) . '">' . $type->name . '</a> - <i>' . $actor_type . '</i></li>';
											echo '</ul>';
										}
									} 
								?>
								</div>

								<div class="col-3">
									<?php if ( function_exists( 'has_post_thumbnail') and has_post_thumbnail() ) : ?>
									<?php the_post_thumbnail( array(900,900) ); ?>
									<?php endif; ?>
								</div>
							</div>

					</div>
				</div>

			</div>

			<div class="clearfix"></div>

			<?php endwhile;
			else : ?>
			<h1><?php _e('No posts were found.'); ?></h1>
			<?php endif; ?>

		</div>

		<!-- The pagination component -->
		<?php understrap_pagination(); ?>

</div><!-- Wrapper end -->

<?php get_footer(); ?>

<script type="text/javascript">

jQuery(function () {
  jQuery('[data-toggle="tooltip"]').tooltip()
})
// https://stackoverflow.com/questions/35992900/bootstrap-accordion-scroll-to-top-of-active-open-accordion-on-click
jQuery('.collapse').on('shown.bs.collapse', function(e) {
  var $card = jQuery(this).closest('.card');
  jQuery('html,body').animate({
    scrollTop: $card.offset().top -32
  }, 400);
});

</script>
