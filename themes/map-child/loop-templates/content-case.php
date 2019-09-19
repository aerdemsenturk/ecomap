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

				</br>

				<?php the_field('geo_address'); ?>
				
				</br>

				<?php if( get_field('temporal_start') ): ?>
				<?php the_field('temporal_start'); ?> — 
				<?php endif; ?>

				<?php if( get_field('temporal_end') ): ?>
				<?php the_field('temporal_end'); ?>			
				<?php else : ?>
					TODAY
				<?php endif; ?>

				<!-- <?php 
				// get raw date
				$date = get_field('temporal_start', false, false);
				// make date object
				$date = new DateTime($date);
				?>
				</br>
				<?php echo $date->format('j M Y'); ?> — <?php echo date("j M Y");?> -->

				<div class="row">
					<!--COMMODITY-->
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">

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

					<!--OLD ACTORS PRO CONTRA GROUP VERSION https://trello.com/c/D0THOFCk -->
					<!--NEW ACTOR POST TYPE VERSION -->

					<?php if( $posts ): ?>	
					<?php foreach( $posts as $post ): ?>
						<div class="col-12 mt-5 mb-3">
							<?php 
							$actors_pro = get_field('actor_relations_pro');
							$actors_contra = get_field('actor_relations_contra');
							?>

							<?php if( $actors_pro ): ?>
								<h4>ACTORS PRO</h4>
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
							<?php endif; ?>

							<?php if( $actors_contra ): ?>
								<h4>ACTORS CONTRA</h4>
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
							<?php endif; ?>
						</div>
					<?php endforeach; ?>
					<?php endif; ?>

					<!--IMPACT GROUPED-->
					<div class="col-12">
						<h4>IMPACT</h4>
					</div>

					<div class="col-12 mt-5 mb-3">
						<ul>
							<?php
								if (have_rows('impact_visible')) {
									while (have_rows('impact_visible')) {

										the_row();
										$healths = get_sub_field('impact_visible_health');
										$socials = get_sub_field('impact_visible_social');
										$environmentals = get_sub_field('impact_visible_environmental');

										if( $healths ):

										foreach ($healths as $health) {			
											echo '<li><a href="' . get_term_link( $health ) . '">' . $health->name . '</a> - <i> Health </i></li>';
										}

										endif;
										if( $socials ):

										foreach ($socials as $social) {
											echo '<li><a href="' . get_term_link( $social ) . '">' . $social->name . '</a> - <i> Social </i></li>';
										}

										endif;
										if( $environmentals ):

										foreach ($environmentals as $environmental) {
											echo '<li><a href="' . get_term_link( $environmental ) . '">' . $environmental->name . '</a> - <i> Ennvironmental </i></li>';
										}
		
										endif;
									}
								}
							?>
						</ul>
					</div>

					<div class="col-12 mt-5 mb-3">
						<ul>
							<?php
								if (have_rows('impact_potential')) {
									while (have_rows('impact_potential')) {

										the_row();
										$healths = get_sub_field('impact_potential_health');
										$socials = get_sub_field('impact_potential_social');
										$environmentals = get_sub_field('impact_potential_environmental');

										if( $healths ):

										foreach ($healths as $health) {			
											echo '<li><a href="' . get_term_link( $health ) . '">' . $health->name . '</a> - <i> Health </i></li>';
										}

										endif;
										if( $socials ):

										foreach ($socials as $social) {
											echo '<li><a href="' . get_term_link( $social ) . '">' . $social->name . '</a> - <i> Social </i></li>';
										}

										endif;
										if( $environmentals ):

										foreach ($environmentals as $environmental) {
											echo '<li><a href="' . get_term_link( $environmental ) . '">' . $environmental->name . '</a> - <i> Ennvironmental </i></li>';
										}
		
										endif;
									}
								}
							?>
						</ul>
					</div>

					<!--TIMELINE CASE ARCHIVE-->
					<div class="col-12 mt-5 mb-3">

						<?php if( have_rows('case_timeline') ): ?>
							<h4>TIMELINE</h4>
							<ul class="timeline">

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
						<?php endif; ?>

					</div>
					<!--DOCUMENTATION CASE ARCHIVE-->
					<div class="col-12 mt-5 mb-3">   

						<?php if( have_rows('case_documents') ): ?>

							<div class="mb-3 ">
								<h4>DOCUMENTATION</h4>
							</div>

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

						<?php endif; ?>

					</div>		
					
					<!--ENTRY META-->
					<div class="col-lg-12 col-md-12 col-sm-12 col-12">
						<div class="entry-meta">
							<small><b>Editör </b><?php the_author_posts_link(); ?></small>
							<small><b> Son güncelleme </b><?php the_modified_time( 'j F Y' ); ?></small>
							<h1><?php do_action('back_button'); ?></h1>
						</div>
					</div>
				</div>

			</div>

			<div class="flex-fill">
				<?php echo GeoMashup::map('map_content=single&add_map_type_control=true');?>
			</div>

		</div>

	</div>

</article>

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

//Tooltip 
jQuery(function () {
	jQuery('[data-toggle="tooltip"]').tooltip(
		{
		placement: 'right', 
		animation: false, //https://github.com/twbs/bootstrap/issues/21607#issuecomment-309634023
		}
	)
})

// jQuery version

// jQuery(document).ready(function(){
//   jQuery("button").click(function(){
//     jQuery("#toggle").toggle(500);
//   });
// });

</script>





