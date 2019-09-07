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
		
		<p><?php global $wp_query; echo $wp_query->post_count; ?> adet sonuç görüntüleniyor</p>

	</div><!-- Container end -->

	<div class="card-block">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="card">
			<div class="card-header" >
				<div class="row">

					<div class="col-1 p-1 pb-2">
						<a href="#gm-map-1" title="Haritada göster" data-toggle="tooltip" data-placement="right" onclick="window.scrollTo(0,0);frames['gm-map-1'].GeoMashup.clickMarker('<?php the_ID()?>')"><div class="show_on_map">✹</div></a>				
					</div>

					<div class="col-1 p-1 pb-2">
						<?php
						$case_type = get_the_terms( $post->ID,  'case_type' );
						if ( ! empty( $case_type ) ) {
							if ( ! is_wp_error( $case_type ) ) {
									foreach( $case_type as $type ) {
										echo '<small><a href="' . get_term_link( $type->slug, 'case_type' ) . '">●&nbsp;' . esc_html( $type->name ) . '&nbsp;</a></small>'; 
									}
							}
						}
						?>
					</div>

					<div class="col-4 p-0 pt-1">
						<small><?php echo get_the_date('Y'); ?></small>
						<a role="tab" id="<?php the_ID(); ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php the_ID(); ?>"
						aria-expanded="false" aria-controls="collapse<?php the_ID(); ?>">
						<h4><?php the_title(); ?></h4>
						</a>
					</div>

					<div class="col-3 text-left p-1 pb-2">
						<?php
						$commodity_terms = get_the_terms( $post->ID,  'commodity' );
						if ( ! empty( $commodity_terms ) ) {
							if ( ! is_wp_error( $commodity_terms ) ) {
									foreach( $commodity_terms as $term ) {
										echo '<small><a href="' . get_term_link( $term->slug, 'commodity' ) . '">●&nbsp;' . esc_html( $term->name ) . '&nbsp;</a></small>'; 
									}
							}
						}
						?>
					</div>

					<div class="col-3 text-left p-1 pb-2">
						<?php
						$impact_terms = get_the_terms( $post->ID,  'impact' );
						if ( ! empty( $impact_terms ) ) {
							if ( ! is_wp_error( $impact_terms ) ) {
									foreach( $impact_terms as $term ) {
										echo '<small><a href="' . get_term_link( $term->slug, 'impact' ) . '">●&nbsp;' . esc_html( $term->name ) . '&nbsp;</a></small>'; 
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
							<div class="col-6 pb-2 pt-2 ">
								<?php the_excerpt(); ?>
							</div>
							<div class="col-3 pb-2">
							<?php	
								$types = get_field('actor_pro');
								foreach($types as $type) {
									$term_link = get_term_link( $type );
									$actor_type = get_field('actor_type', 'actor_' . $type->term_id . '' );

									if ( has_term( $type->term_id, 'actor')) {
										echo '<ul class="list-group list-group-flush">';
										echo '<li class="list-group-item"><small><a href="' . esc_url( $term_link ) . '">' . $type->name . '</a> - <i>' . $actor_type . '</i></small></li>';
										echo '</ul>';
									}
								} 
							?>
							</div>
							<div class="col-3 pb-2">
							<?php	
								$types = get_field('actor_contra');
								foreach($types as $type) {
									$term_link = get_term_link( $type );
									$actor_type = get_field('actor_type', 'actor_' . $type->term_id . '' );

									if ( has_term( $type->term_id, 'actor')) {
										echo '<ul class="list-group list-group-flush">';
										echo '<li class="list-group-item"><small><a href="' . esc_url( $term_link ) . '">' . $type->name . '</a> - <i>' . $actor_type . '</i></small></li>';
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
		<h4><?php _e('No posts'); ?></h4>
		<?php endif; ?>

	</div>

	<!-- The pagination component -->
	<?php understrap_pagination(); ?>

</div><!-- Wrapper end -->

<?php get_footer(); ?>

<script type="text/javascript">

	//TOGGLE
	jQuery(function () {
	jQuery('[data-toggle="tooltip"]').tooltip()
	})

	// https://stackoverflow.com/questions/35992900/bootstrap-accordion-scroll-to-top-of-active-open-accordion-on-click
	jQuery('.collapse').on('shown.bs.collapse', function(e) {
	var $card = jQuery(this).closest('.card');
	jQuery('html,body').animate({
		scrollTop: $card.offset().top
	}, 400);
	});

</script>
