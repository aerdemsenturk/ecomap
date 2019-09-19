<?php
/**
 * Single post partial script template.
 *
 * @package understrap
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="toggle-content" onclick="togglecontent()">↵</div>

	<div class="entry-content">
		
		<div class="d-flex">

			<div class="col-12 col-lg-6 col-md-12 col-sm-12 pr-4 scroll-area" id="toggle">	
				
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				
				<p>
				<?php
					// Farklı yöntem
					// echo get_the_term_list( $post->ID, 'actor_type', '● ', ', ' ); 

					$actor_type = get_the_terms( $post->ID,  'actor_type' );
					$actor_country = get_the_terms( $post->ID,  'actor_country' );

					if ( ! empty( $actor_type ) ) {
						if ( ! is_wp_error( $actor_type ) ) {
								foreach( $actor_type as $type ) {
									echo '<small><a href="' . get_term_link( $type->slug, 'actor_type' ) . '">●&nbsp;' . esc_html( $type->name ) . '&nbsp;</a></small>'; 
								}
						}
					}
					if ( ! empty( $actor_country ) ) {
						if ( ! is_wp_error( $actor_country ) ) {
								foreach( $actor_country as $country ) {
									echo '<small><a href="' . get_term_link( $country->slug, 'actor_country' ) . '">●&nbsp;' . esc_html( $country->name ) . '&nbsp;</a></small>'; 
								}
						}
					}
				?>
				</p>

				<?php the_content(); ?>

			</div>

			<div class="flex-fill">
				<?php 
				/*
				*  Query posts for a relationship value.
				*  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
				*/

				$cases_map = array(
					'post_type' => 'case',
					'meta_query' => array(
						'relation' => 'OR', //**** Use AND or OR as per your required Where Clause
						array(
							'key' => 'actor_relations_contra', // name of custom field
							'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
							'compare' => 'LIKE', // LIKE sağlıklı mı? https://acfextras.com/dont-query-repeaters/
						),
						array(
							'key'     => 'actor_relations_pro',
							'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
							'compare' => 'LIKE', // LIKE sağlıklı mı? https://acfextras.com/dont-query-repeaters/
						),
					)
				);

				$show_on_map = new WP_Query($cases_map);
				$posts = get_posts( $cases_map );

				echo GeoMashup::map([
					'map_content' => $show_on_map
				]);

				?>
			</div>

		</div>

	</div>

</article>

<?php if( $posts ): ?>
	<div class="card-block">
		<?php foreach( $posts as $post ): ?>
			<div class="card">
				<div class="card-header" >
					<div class="row">
						<div class="col-12 col-lg-1 p-1 pb-2">
							<a class="show_on_map" title="Haritada göster" data-toggle="tooltip" href="#gm-map-1" onclick="window.scrollTo(0,0);frames['gm-map-1'].GeoMashup.clickMarker('<?php the_ID()?>')">✹</a>				
						</div>
						<div class="col-12 col-lg-1 p-1 pb-2">
							<?php
							$actor_type = get_the_terms( $post->ID,  'actor_type' );
							if ( ! empty( $actor_type ) ) {
								if ( ! is_wp_error( $actor_type ) ) {
										foreach( $actor_type as $type ) {
											echo '<small><a href="' . get_term_link( $type->slug, 'actor_type' ) . '">●&nbsp;' . esc_html( $type->name ) . '&nbsp;</a></small>'; 
										}
								}
							}
							?>
						</div>
						<div class="col-12 col-lg-4 p-1">
							<small><?php echo get_the_date('Y'); ?></small>
							<a role="tab" id="<?php the_ID(); ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php the_ID(); ?>"
							aria-expanded="false" aria-controls="collapse<?php the_ID(); ?>">
							<h4><?php the_title(); ?></h4>
							</a>
						</div>
						<div class="col-12 col-lg-3 text-left p-1 pb-2">
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
						<div class="col-12 col-lg-3 text-left p-1 pb-2">
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
							<div class="col-12 col-lg-6 pb-2 pt-2">
								<?php the_excerpt(); ?>
							</div>
							<div class="col-6 col-lg-6 col-md-6 col-sm-6 mt-5 mb-3">
								<?php 
								$actors_pro = get_field('actor_relations_pro');
								$actors_contra = get_field('actor_relations_contra');
								?>

								<?php if( $actors_pro ): ?>
									<ul>
									<?php foreach( $actors_pro as $actor_pro ): ?>
										<li>
											<a href="<?php echo get_permalink( $actor_pro->ID ); ?>">
												<?php echo get_the_title( $actor_pro->ID ); ?>
											</a>
										</li>
									<?php endforeach; ?>
									</ul>
								<?php endif; ?>

								<?php if( $actors_contra ): ?>
									<ul>
									<?php foreach( $actors_contra as $actor_contra ): ?>
										<li>
											<a href="<?php echo get_permalink( $actor_contra->ID ); ?>">
												<?php echo get_the_title( $actor_contra->ID ); ?>
											</a>
										</li>
									<?php endforeach; ?>
									</ul>
								<?php endif; ?>
							</div>
							<div class="col-12 col-lg-3">
								<?php if ( function_exists( 'has_post_thumbnail') and has_post_thumbnail() ) : ?>
								<?php the_post_thumbnail( array(900,900) ); ?>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
					
<script type="text/javascript">

// js version

function togglecontent() {
  var x = document.getElementById("toggle");
	if (x.style.display === "none") {
		x.style.display = "block";
	} else {
		x.style.display = "none";
	}
}

// https://stackoverflow.com/questions/35992900/bootstrap-accordion-scroll-to-top-of-active-open-accordion-on-click
jQuery('.collapse').on('shown.bs.collapse', function(e) {
	var $card = jQuery(this).closest('.card');
	jQuery('html,body').animate({
		scrollTop: $card.offset().top
	}, 400);
});

// jQuery version

// jQuery(document).ready(function(){
//   jQuery("button").click(function(){
//     jQuery("#toggle").toggle(500);
//   });
// });

</script>



						


