<?php
/**
 * Home contents
 *
 * @package understrap
 */

?>
<div class="row">
	<div class="col-12 mt-6">
		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			<!-- <header class="entry-header">
				<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			</header> -->
			<div class="entry-content">
				<?php the_content(); ?>
			</div><!-- .entry-content -->
		</article><!-- #post-## -->
	</div>
</div>