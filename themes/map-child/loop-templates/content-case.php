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
				<?php echo get_the_term_list( $post->ID, 'case_type', '● ', ', ' ); ?>
				</p>

				<?php the_content(); ?>

				<?php if( get_field('spatial_country') ): ?>
				<?php the_field('spatial_country'); ?>, 
				<?php endif; ?>

				<?php if( get_field('spatial_region') ): ?>
				<?php the_field('spatial_region'); ?>, 
				<?php endif; ?>

				<?php if( get_field('spatial_city') ): ?>
				<?php the_field('spatial_city'); ?>
				<?php endif; ?>

				</br>

				<?php the_field('geo_address'); ?>
				</br>

				<?php if( get_field('temporal_start') ): ?>
				<?php the_field('temporal_start'); ?> — <?php the_field('temporal_end'); ?>
				<?php endif; ?>

				<div class="row">
					<!--COMMODITY-->
					<div class="col-12 mt-5 mb-3">
						<h4>COMMODITY</h4>
					</div>

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

					<!--ACTORS 2 PRO CONTRA-->
					<div class="col-12 mt-5 mb-3">
						<h3>ACTORS</h43>
					</div>

					<div class="mt-5 mb-3 col-lg-6 col-md-12 col-sm-12">
						<?php
						
							if (have_rows('actor_pro2')) {
								while (have_rows('actor_pro2')) {

									the_row();
									$finances = get_sub_field('finance');
									$goverments = get_sub_field('goverment');
									$companies = get_sub_field('company');

									if( $goverments ):

									foreach ($goverments as $goverment) {

										echo '<ul>';
										echo '<li><a href="' . get_term_link( $goverment ) . '">' . $goverment->name . '</a> - <i> Goverment </i></li></li>';
										echo '</ul>';

									}

									endif;
									if( $companies ):

									foreach ($companies as $company) {

										echo '<ul>';
										echo '<li><a href="' . get_term_link( $company ) . '">' . $company->name . '</a> - <i> Company </i></li></li>';
										echo '</ul>';

									}

									endif;
									if( $finances ):

									foreach ($finances as $finance) {

										echo '<ul>';
										echo '<li><a href="' . get_term_link( $finance ) . '">' . $finance->name . '</a> - <i> Finance </i></li></li>';
										echo '</ul>';
				
									}
									endif;
								}
							}

						?>
					</div>

					<div class="mt-5 mb-3 col-lg-6 col-md-12 col-sm-12">
						<?php
							
							if (have_rows('actor_contra2')) {
								while (have_rows('actor_contra2')) {

									the_row();
									$non_goverments = get_sub_field('non-goverment');


									if( $non_goverments ):

									foreach ($non_goverments as $non_goverment) {

										echo '<ul>';
										echo '<li><a href="' . get_term_link( $non_goverment ) . '">' . $non_goverment->name . '</a> - <i> Goverment </i></li></li>';
										echo '</ul>';

									}

									endif;
							
								}
							}

						?>
					</div>

					<!--CASE ARCHIVE-->
					<div class="col-12 mt-5 mb-3">

						<?php if( have_rows('case_timeline') ): ?>

							<div class="mb-3 ">
								<h4>TIMELINE</h4>
							</div>

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

// jQuery version

// jQuery(document).ready(function(){
//   jQuery("button").click(function(){
//     jQuery("#toggle").toggle(500);
//   });
// });

</script>





