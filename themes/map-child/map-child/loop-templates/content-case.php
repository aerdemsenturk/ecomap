<?php
/**
 * Single post partial script template.
 *
 * @package understrap
 */
?>

<div class="toggle-content-close">
	<svg data-toggle="tooltip" title="Hide content" data-placement="left" id="toggleclose" onclick="togglecontent()" viewBox="0 0 64 64" width="25px" height="25px" style="transform: rotate(0deg); fill: currentcolor;" class="data-ex-icons-arrowright "><path d="M26.7,54.7l-4.5-4.4c-0.4-0.4-0.4-1,0-1.4L38.6,33L22.2,17c-0.4-0.4-0.4-1,0-1.5l4.5-4.4c0.4-0.4,1.1-0.4,1.5,0 l17.1,16.7l4.5,4.4c0.4,0.4,0.4,1,0,1.4L45.2,38L28.2,54.7C27.8,55.1,27.1,55.1,26.7,54.7"></path></svg>
</div>

<div class="toggle-content-open">
	<svg data-toggle="tooltip" title="Show content" data-placement="left" id="toggleopen" onclick="togglecontent()" viewBox="0 0 64 64" width="25px" height="25px" style="transform: rotate(180deg); fill: currentcolor;" class="data-ex-icons-arrowright "><path d="M26.7,54.7l-4.5-4.4c-0.4-0.4-0.4-1,0-1.4L38.6,33L22.2,17c-0.4-0.4-0.4-1,0-1.5l4.5-4.4c0.4-0.4,1.1-0.4,1.5,0 l17.1,16.7l4.5,4.4c0.4,0.4,0.4,1,0,1.4L45.2,38L28.2,54.7C27.8,55.1,27.1,55.1,26.7,54.7"></path></svg>
</div>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
	
	<div class="d-flex no-gutters">

		<div class="flex-fill">
			<?php echo GeoMashup::map('map_content=single&add_map_type_control=true');?>
		</div>

		<div class="col-12 col-lg-6 col-md-6 scroll-area" id="toggle">	
			
			<?php		
				if ( has_post_thumbnail() ) {
					the_post_thumbnail();
				}
				else {
					// Default image
					echo '<img src="' . get_bloginfo( 'stylesheet_directory' ) . '/css/images/default-image-bg.svg" height="300px" />';
				}
			?>

			<header class="entry-header pl-3 pr-3 mt-4">
				<?php the_title( '<h3 class="entry-title">', '</h3>' ); ?>
			</header><!-- .entry-header -->
			
			<div class="entry-content pl-3 pr-4 ">

				<p>
					<?php
						// Farklı yöntem
						// echo get_the_term_list( $post->ID, 'case_type', '● ', ', ' ); 

						$case_type = get_the_terms( $post->ID,  'case_type' );
						if ( ! empty( $case_type ) ) {
							if ( ! is_wp_error( $case_type ) ) {
									foreach( $case_type as $type ) {
										echo '<small><a href="' . get_term_link( $type->slug, 'case_type' ) . '">●&nbsp;' . esc_html( $type->name ) . '&nbsp;</a></small>'; 
									}
							}
						}
					?>
				</p>
				
				<p>
					<?php the_field('geo_address'); ?>
				</p>

				<p>
					<small>
					<?php if( get_field('temporal_start') ): ?>
					<?php the_field('temporal_start'); ?> —
					<?php else : ?>
						? —
					<?php endif; ?>

					<?php if( get_field('temporal_end') ): ?>
					<?php the_field('temporal_end'); ?>			
					<?php else : ?>
						TODAY
					<?php endif; ?>
					</small>
				</p>

				<?php the_content(); ?>

				<!-- <?php if( get_field('spatial_country') ): ?>
				<?php the_field('spatial_country'); ?>, 
				<?php endif; ?>

				<?php if( get_field('spatial_region') ): ?>
				<?php the_field('spatial_region'); ?>, 
				<?php endif; ?>

				<?php if( get_field('spatial_city') ): ?>
				<?php the_field('spatial_city'); ?>
				<?php endif; ?> -->

				<div class="row no-gutters">

					<!--NEW ACTOR POST TYPE VERSION. OLD VERSION: https://trello.com/c/D0THOFCk -->

					<?php if( $posts ): ?>	
					<?php foreach( $posts as $post ): ?>
						
					<?php 
					$actors_pro = get_field('actor_relations_pro');
					$actors_contra = get_field('actor_relations_contra');
					?>

					<div class="col-12 pt-5 pb-3 mt-3 border-top">
							<h4>ACTORS</h4>
					</div>

					<?php if( $actors_pro ): ?>

						<div class="col-6 pb-5 pt-5 pl-3 pr-3">
							<p>Pro</p>
							<ul>
							<?php foreach( $actors_pro as $actor_pro ): ?>
								<li>
									<a href="<?php echo get_permalink( $actor_pro->ID ); ?>">
										<?php echo get_the_title( $actor_pro->ID ); ?>
									</a>
									<small>
									<?php
										// Basit yöntem
										echo get_the_term_list( $actor_pro->ID, 'actor_type', '', ', ' );
										echo get_the_term_list( $actor_pro->ID, 'actor_country', ' - ', ', ' ); 

										// Başka yöntem

										// $actor_type = get_the_terms( $actor_contra->ID,  'actor_type' );
										// if ( ! empty( $actor_type ) ) {
										// 	if ( ! is_wp_error( $actor_type ) ) {
										// 			foreach( $actor_type as $type ) {
										// 				echo '<small><a href="' . get_term_link( $type->slug, 'actor_type' ) . '">●&nbsp;' . esc_html( $type->name ) . '&nbsp;</a></small>'; 
										// 			}
										// 	}
										// }
									?>
									</small>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<?php if( $actors_contra ): ?>
						<div class="col-6 pb-5 pt-5 pl-3 pr-3">
							<p>Con</p>
							<ul>
							<?php foreach( $actors_contra as $actor_contra ): ?>
								<li>
									<a href="<?php echo get_permalink( $actor_contra->ID ); ?>">
										<?php echo get_the_title( $actor_contra->ID ); ?>
									</a>
									<small>
									<?php
										// Basit yöntem
										echo get_the_term_list( $actor_contra->ID, 'actor_type', '', ', ' );
										echo get_the_term_list( $actor_contra->ID, 'actor_country', ' - ', ', ' ); 

										// Başka yöntem

										// $actor_type = get_the_terms( $actor_contra->ID,  'actor_type' );
										// if ( ! empty( $actor_type ) ) {
										// 	if ( ! is_wp_error( $actor_type ) ) {
										// 			foreach( $actor_type as $type ) {
										// 				echo '<small><a href="' . get_term_link( $type->slug, 'actor_type' ) . '">●&nbsp;' . esc_html( $type->name ) . '&nbsp;</a></small>'; 
										// 			}
										// 	}
										// }
									?>
									</small>
								</li>
							<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
						
					<?php endforeach; ?>
					<?php endif; ?>

					<!--NEW IMPACT VERSION. OLD VERSION: https://trello.com/c/rYLM5I8E -->
					<div class="col-12 pt-5 pb-3 border-top">
							<h4>IMPACTS</h4>
					</div>

					<?php $visible_impact_terms = get_field( 'visible_impact' ); ?>
					<?php if ( $visible_impact_terms ): ?>

						<div class="col-6 pb-5 pt-5 pl-3 pr-3">

							<p>Visible</p>
							<ul>
								<?php foreach ( $visible_impact_terms as $visible_impact_term ): ?>
								
								<?php $term_type = get_field('impact_type', 'impact_' . $visible_impact_term->term_id . '' ); ?>
								<li><a href="<?php echo get_term_link( $visible_impact_term ) ?>"><?php echo $visible_impact_term->name; ?></a> - <small><?php echo $term_type; ?></small></li>
								
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>
						
					<?php $potential_impact_terms = get_field( 'potential_impact' ); ?>
					<?php if ( $potential_impact_terms ): ?>
						<div class="col-6 pb-5 pt-5 pl-3 pr-3">
							<p>Potential</p>
							<ul>
								<?php foreach ( $potential_impact_terms as $potential_impact_term ): ?>
								
								<?php $term_type = get_field('impact_type', 'impact_' . $potential_impact_term->term_id . '' ); ?>
								<li><a href="<?php echo get_term_link( $potential_impact_term ) ?>"><?php echo $potential_impact_term->name; ?></a> - <small><?php echo $term_type; ?></small></li>
								
								<?php endforeach; ?>
							</ul>
						</div>
					<?php endif; ?>

					<!--COMMODITY-->
					
					<div class="col-12 pt-5 pb-3 border-top">
						<h4>COMMODITY</h4>
					</div>
					
					<div class="col-12 pb-5 pt-5">

						<?php	
						$types = get_terms( array( 
							'taxonomy' => 'commodity', 
							'hide_empty' => true, ) 
						);

						foreach($types as $type) {

							$term_link = get_term_link( $type );
							$image = get_field('commodity_image', 'commodity_' . $type->term_id . '' );
			
							if ( has_term( $type->term_id, 'commodity')) {
								echo '<div class="img-container d-inline-block">';
								echo '<a href="' . esc_url( $term_link ) . '">';
								echo '<img class="image rounded-circle" src="' . $image['sizes']['thumbnail'] . '" alt="' . $type->name .'"></a>'; 

								echo '<div class="overlay rounded-circle"><a class="text" href="' . esc_url( $term_link ) . '">' . $type->name .'</a></div></div>';
							}
						} 
						?>


					</div>
						
					<!--TIMELINE CASE ARCHIVE-->
					
					<?php if( have_rows('case_timeline') ): ?>
						<div class="col-12 pt-5 pb-3 border-top">
							<h4>TIMELINE</h4>								
							<ul class="timeline mt-5">

								<?php while( have_rows('case_timeline') ): the_row(); 
									// vars
									$date = get_sub_field('date');
									$text = get_sub_field('text');
									$image = get_sub_field('image');
									$source = get_sub_field('source');

									$url = $image['url'];
									$title = $image['title'];
									$alt = $image['alt'];
									$caption = $image['caption'];

									$source_url = $source['url'];
									$source_title = $source['title'];
									$source_target = $source['target'] ? $source['target'] : '_blank';
								?>

									<li class="timeline-item m-2">
										
										<?php if( $date ): ?>
											<h4 class="mt-4"><?php echo $date; ?></h4>
										<?php endif; ?>
										
										<?php if( !empty($image) ): ?>
											<img class="float-left w-10 mr-2 mb-2 mt-1" src="<?php echo $image['url']; ?>" alt="<?php echo $image['alt']; ?>" />
										<?php endif; ?>

										<?php if( $text ): ?>
											<?php echo $text; ?>
										<?php endif; ?>

										<?php if( $source ): ?>
											<a href="<?php echo esc_url($source_url); ?>" target="<?php echo esc_attr($source_target); ?>">
											<?php echo esc_html($source_title); ?>
											</a>
										<?php endif; ?>

									</li>

								<?php endwhile; ?>

							</ul>
						</div>
					<?php endif; ?>

					<!--DOCUMENTATION CASE ARCHIVE-->

					<?php if( have_rows('case_documents') ): ?>
						<div class="col-12 pt-5 pb-3 border-top">
							<h4>DOCUMENTATION</h4>
						</div>
						
						<div class="col-12 pt-5 pl-3">			
							<ul>

								<?php while( have_rows('case_documents') ): the_row(); 
									// vars
									$file = get_sub_field('file');

									$file_url = $file['url'];
									$file_title = $file['title'];
								?>

									<li>

										<?php if( $file ): ?>
										<a class="iframe-popup" href="<?php echo esc_url($file_url); ?>">
											<?php echo esc_html($file_title); ?>
										</a>
										<?php endif; ?>

									</li>

								<?php endwhile; ?>

							</ul>
						</div>
					<?php endif; ?>
					
					<!--ENTRY META-->
					<div class="col-12 mt-5 mb-5 border-top entry-meta">
						<small><b>Editor </b><?php the_author_posts_link(); ?></small>
						<small><b> Last Update </b><?php the_modified_time( 'j F Y' ); ?></small>
					</div>
					<div class="toggle-content-back">
						<?php do_action('back_button'); ?>
					</div>
				</div>
				
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
            html: true,
			// placement: 'bottom', 
			animation: true, //https://github.com/twbs/bootstrap/issues/21607#issuecomment-309634023
			}
		)
	})

	// Toggle content jQuery version

	// jQuery(document).ready(function(){
	//   jQuery("button").click(function(){
	//     jQuery("#toggle").toggle(500);
	//   });
	// });

</script>





