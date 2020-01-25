<?php
/**
 * Single post partial script template.
 *
 * @package understrap
 */
?>

<div class="toggle-content-close d-none d-lg-block d-md-block d-sm-block">
	<svg data-toggle="tooltip" title="Hide content" data-placement="left" id="toggleclose" onclick="togglecontent()" viewBox="0 0 64 64" width="25px" height="25px" style="transform: rotate(0deg); fill: currentcolor;" ><path d="M26.7,54.7l-4.5-4.4c-0.4-0.4-0.4-1,0-1.4L38.6,33L22.2,17c-0.4-0.4-0.4-1,0-1.5l4.5-4.4c0.4-0.4,1.1-0.4,1.5,0 l17.1,16.7l4.5,4.4c0.4,0.4,0.4,1,0,1.4L45.2,38L28.2,54.7C27.8,55.1,27.1,55.1,26.7,54.7"></path></svg>
</div>

<div class="toggle-content-open">
	<svg data-toggle="tooltip" title="Show content" data-placement="left" id="toggleopen" onclick="togglecontent()" viewBox="0 0 64 64" width="25px" height="25px" style="transform: rotate(180deg); fill: currentcolor;" ><path d="M26.7,54.7l-4.5-4.4c-0.4-0.4-0.4-1,0-1.4L38.6,33L22.2,17c-0.4-0.4-0.4-1,0-1.5l4.5-4.4c0.4-0.4,1.1-0.4,1.5,0 l17.1,16.7l4.5,4.4c0.4,0.4,0.4,1,0,1.4L45.2,38L28.2,54.7C27.8,55.1,27.1,55.1,26.7,54.7"></path></svg>
</div>

<header class="page-header mt-4 ml-6 d-none d-md-block fixed-left">
	<?php the_title( '<h4>Actor: ', '</h4>' );?>
</header>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
		
	<div class="d-flex no-gutters">
		<!--LEFT-->
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
		<!--RIGHT-->
		<div class="scroll-area col-12 col-lg-6 col-md-6 col-sm-6 col-xs-6 border-left" id="toggle">	
		
			<div class="list-title-area"></div>
		
			<div class="col-12 pt-3 bg-primary text-white float-left">
				<p>
					<?php the_title(); ?>
					<?php
						// Farklı yöntem
						// echo get_the_term_list( $post->ID, 'actor_type', '● ', ', ' ); 

						$actor_type = get_the_terms( $post->ID,  'actor_type' );
						$actor_country = get_the_terms( $post->ID,  'actor_country' );

						if ( ! empty( $actor_type ) ) {
							if ( ! is_wp_error( $actor_type ) ) {
									foreach( $actor_type as $type ) {
										echo '<a href="' . get_term_link( $type->slug, 'actor_type' ) . '">●&nbsp;' . esc_html( $type->name ) . '&nbsp;</a>'; 
									}
							}
						}
						if ( ! empty( $actor_country ) ) {
							if ( ! is_wp_error( $actor_country ) ) {
									foreach( $actor_country as $country ) {
										echo '<a href="' . get_term_link( $country->slug, 'actor_country' ) . '">●&nbsp;' . esc_html( $country->name ) . '&nbsp;</a>'; 
									}
							}
						}
					?>
				</p>
				<?php the_content(); ?>
			</div>

			<!--RELATED CASES-->
			<?php if( $posts ): ?>
				<div class="card-block" id="accordion" role="tablist" aria-multiselectable="true">
					<?php foreach( $posts as $post ): ?>
						<div class="card">

							<div class="card-header">
								<div class="row">
									<div class="col-12 pb-2 col-lg-12">
										<small>
											<?php echo get_the_date('Y'); ?>
										</small>
										⎯
										<small>
											<?php
											$case_type = get_the_terms( $post->ID,  'case_type' );
											if ( ! empty( $case_type ) ) {
												if ( ! is_wp_error( $case_type ) ) {
														foreach( $case_type as $type ) {
															echo '<a href="' . get_term_link( $type->slug, 'case_type' ) . '">' . esc_html( $type->name ) . '</a>'; 
														}
												}
											}
											?>
										</small>
										<a id="heading<?php the_ID(); ?>" data-toggle="collapse" href="#collapse<?php the_ID(); ?>" aria-expanded="true" aria-controls="collapse<?php the_ID(); ?>" onclick="frames['gm-map-1'].GeoMashup.clickObjectMarker('<?php the_ID()?>')">
											<h4><?php the_title(); ?></h4>
										</a>
									</div>
								</div>
							</div>

							<div id="collapse<?php the_ID(); ?>" class="collapse" data-parent="#accordion" aria-labelledby="heading<?php the_ID(); ?>">
								<div class="card-block">
									<div class="row">

										<!--ACTOR POST TYPE VERSION -->
										<div class="col-12 pt-3 pb-3 border-bottom">
											<?php the_excerpt(); ?>
										</div>

										<div class="col-4 pt-2 pb-4 small border-right">
										<p>ACTORS</p>
												<?php 
												$actors_pro = get_field('actor_relations_pro');
												$actors_contra = get_field('actor_relations_contra');
												?>

												<?php if( $actors_pro ): ?>
													
													<?php foreach( $actors_pro as $actor_pro ): ?>
													
															<a href="<?php echo get_permalink( $actor_pro->ID ); ?>">
															●&nbsp;<?php echo get_the_title( $actor_pro->ID ); ?>
															</a>
													
													<?php endforeach; ?>
											
												<?php endif; ?>

												<?php if( $actors_contra ): ?>
													
													<?php foreach( $actors_contra as $actor_contra ): ?>
														
															<a href="<?php echo get_permalink( $actor_contra->ID ); ?>">
															●&nbsp;<?php echo get_the_title( $actor_contra->ID ); ?>
															</a>
														
													<?php endforeach; ?>
													
												<?php endif; ?>
										</div>

										<div class="col-4 pt-2 pb-4 small border-right">
										<p>COMMODITIES</p>
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

										<div class="col-4 pt-2 pb-4 small">
										<p>IMPACTS</p>
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
							</div>

						</div>
					<?php endforeach; ?>
				</div>
			<?php endif; ?>

			<div class="list-title-area"></div>

			<!--ENTRY META-->
			<!-- <div class="col-12 mt-5 mb-5 border-top entry-meta">
						<small><b>Editor </b><?php the_author_posts_link(); ?></small>
						<small><b> Last Update </b><?php the_modified_time( 'j F Y' ); ?></small>
					</div>
			</div> -->

			<div class="toggle-content-back">
				<?php do_action('back_button'); ?>
			</div>

		</div>
		
	</div>

</article>				

<script type="text/javascript">

	// Toggle content js version
	function togglecontent() {

		var x = document.getElementById("toggle");
		if (x.style.display === "none") {
			x.style.display = "block";
		} else {
			x.style.display = "none";
        }

        var togglebutton = document.getElementById("toggleclose");
		if (togglebutton.style.display === "none") {
			togglebutton.style.display = "block";
		} else {
			togglebutton.style.display = "none";
        }

        var togglebutton = document.getElementById("backbutton");
		if (togglebutton.style.display === "none") {
			togglebutton.style.display = "block";
		} else {
			togglebutton.style.display = "none";
        }

        var togglebutton = document.getElementById("toggleopen");
		if (togglebutton.style.display === "block") {
			togglebutton.style.display = "none";
		} else {
			togglebutton.style.display = "block";
		}
    }

	// Tooltip 
	jQuery(function () {
		jQuery('[data-toggle="tooltip"]').tooltip(
			{
			// placement: 'bottom', 
            html: true,
			animation: true, //https://github.com/twbs/bootstrap/issues/21607#issuecomment-309634023
			}
		)
	})

</script>


						


