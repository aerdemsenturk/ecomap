<?php
/**
 * Single post partial script template.
 *
 * @package understrap
 */

?>

<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<div class="entry-content">

		<div class="row">

			<div class="col-lg-4 col-md-12 col-sm-12 col-12">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
				<?php the_content(); ?>
				</br>
				</br>
			</div>

			<div class="col-lg-12 col-md-12 col-sm-12 col-12">
				<div class="entry-meta">
					<small><b>Editör </b><?php the_author_posts_link(); ?></small>
					<small><b> Son güncelleme </b><?php the_modified_time( 'j F Y' ); ?></small>
					<h1><?php do_action('back_button'); ?></h1>
				</div><!-- .entry-meta -->
			</div>
		</div>

	</div>

</article>


						<h2>RELATED CASES ON MAP</h2>

						<?php 
						/*
						*  Query posts for a relationship value.
						*  This method uses the meta_query LIKE to match the string "123" to the database value a:1:{i:0;s:3:"123";} (serialized array)
						*/

						$cases_map = array(
							'post_type' => 'case',
							'meta_query' => array(
								array(
									'key' => 'actor_relations_pro', // name of custom field
									'value' => '"' . get_the_ID() . '"', // matches exactly "123", not just 123. This prevents a match for "1234"
									'compare' => 'LIKE', // LIKE sağlıklı mı? https://acfextras.com/dont-query-repeaters/
								)
							)
						);

						$show_on_map = new WP_Query($cases_map);
						$posts = get_posts( $cases_map );

						echo GeoMashup::map([
							'map_content' => $show_on_map
						]);

						?>
						
						<h2>RELATED CASES</h2>
						
						<?php if( $posts ): ?>
							<ul>
							<?php foreach( $posts as $post ): ?>
								<li>
									<a href="<?php echo get_permalink( $post->ID ); ?>">
										<?php echo get_the_title( $post->ID ); ?>
									</a>
								</li>
							<?php endforeach; ?>
							</ul>
						<?php endif; ?>

					



						


