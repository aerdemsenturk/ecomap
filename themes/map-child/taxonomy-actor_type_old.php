<?php get_header(); ?>

<?php
$container   = get_theme_mod( 'understrap_container_type' );
?>

<div class="wrapper" id="archive-wrapper">

	<div class="<?php echo esc_html( $container ); ?>" id="content" tabindex="-1">
        <div class="row">
            <div class="col-12">
                <header class="page-header">
                    <?php
                    
                    the_archive_title( '<h2 class="page-title">', '</h2>' );

                    // case type image
                    // echo '<div class="row">';
                    // echo '<div class="col-6"><a href="' . $actor_web . '" target="_blank">' . '<img src="' . $actor_image['sizes']['thumbnail'] . '" class="rounded-circle" alt="' . $actor_image['alt'] .'"></a></div>';
                    the_archive_description( '<div class="col-6">', '</div>' );
                    // echo '</div>';

                    ?>
                    <p><?php global $wp_query; echo $wp_query->post_count; ?> adet sonuç görüntüleniyor</p>
                </header>
            </div>  
        </div>  	

	</div><!-- Container end -->

	<div class="card-block">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

		<div class="card">
			<div class="card-header" >
				<div class="row">
					<div class="col-12 col-lg-4 p-1">
						<a role="tab" id="<?php the_ID(); ?>" data-toggle="collapse" data-parent="#accordion" href="#collapse<?php the_ID(); ?>"
						aria-expanded="false" aria-controls="collapse<?php the_ID(); ?>">
						<h4><?php the_title(); ?></h4>
						</a>
					</div>
				</div>
			</div>

			<div id="collapse<?php the_ID(); ?>" class="collapse" role="tabpanel" aria-labelledby="<?php the_ID(); ?>">
				<div class="card-block">
					<div class="row">
						<div class="col-12 col-lg-6 pb-2 pt-2">
							<?php the_excerpt(); ?>
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

		<div class="clearfix"></div>

		<?php endwhile; else : ?>
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
	jQuery('[data-toggle="tooltip"]').tooltip(
		{
		placement: 'right', 
		animation: false, //https://github.com/twbs/bootstrap/issues/21607#issuecomment-309634023
		}
	)
	})

	// COLLAPSE https://stackoverflow.com/questions/35992900/bootstrap-accordion-scroll-to-top-of-active-open-accordion-on-click
	jQuery('.collapse').on('shown.bs.collapse', function(e) {
	var $card = jQuery(this).closest('.card');
	jQuery('html,body').animate({
		scrollTop: $card.offset().top
	}, 400);
	});

</script>
