<?php get_header(); ?>

<div class="toggle-content-close d-none d-lg-block d-md-block d-sm-block">
	<svg data-toggle="tooltip" title="Hide content" data-placement="left" id="toggleclose" onclick="togglecontent()" viewBox="0 0 64 64" width="25px" height="25px" style="transform: rotate(0deg); fill: currentcolor;""><path d="M26.7,54.7l-4.5-4.4c-0.4-0.4-0.4-1,0-1.4L38.6,33L22.2,17c-0.4-0.4-0.4-1,0-1.5l4.5-4.4c0.4-0.4,1.1-0.4,1.5,0 l17.1,16.7l4.5,4.4c0.4,0.4,0.4,1,0,1.4L45.2,38L28.2,54.7C27.8,55.1,27.1,55.1,26.7,54.7"></path></svg>
</div>

<div class="toggle-content-open">
	<svg data-toggle="tooltip" title="Show content" data-placement="left" id="toggleopen" onclick="togglecontent()" viewBox="0 0 64 64" width="25px" height="25px" style="transform: rotate(180deg); fill: currentcolor;" class="data-ex-icons-arrowright "><path d="M26.7,54.7l-4.5-4.4c-0.4-0.4-0.4-1,0-1.4L38.6,33L22.2,17c-0.4-0.4-0.4-1,0-1.5l4.5-4.4c0.4-0.4,1.1-0.4,1.5,0 l17.1,16.7l4.5,4.4c0.4,0.4,0.4,1,0,1.4L45.2,38L28.2,54.7C27.8,55.1,27.1,55.1,26.7,54.7"></path></svg>
</div>

<header class="page-header mt-4 ml-6 d-none d-md-block fixed-left">
	<?php the_archive_title( '<h4>', '</h4>' );?>
</header>

<div class="d-flex no-gutters">

	<div class="flex-fill">
		<?php echo GeoMashup::map('add_map_type_control=true'); ?>
	</div>  
	
    <div class="col-12 col-lg-6 col-md-6 col-sm-6 col-xs-6 scroll-area" id="toggle">
		
        <div class="list-title-area"></div>

        <div class="col-12 pt-3 pb-3 d-block border-left d-md-none">
            <small><?php the_archive_title( '<p>', '</p>' );?></small>
        </div>  
	
        <div class="col-12 pt-3 bg-primary text-white float-left">
            <p><?php global $wp_query; echo $wp_query->post_count; ?> related cases</p>
        </div> 

        <div class="card-block border-left" id="accordion">
            <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

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

                <div class="collapse" id="collapse<?php the_ID(); ?>"  data-parent="#accordion" aria-labelledby="heading<?php the_ID(); ?>">
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

            <?php endwhile; else : ?>
                <div class="col-12 p-3">
                    <h4><?php _e('No related cases'); ?></h4>
                    <button type="button" class="btn btn-outline-primary btn-sm" onclick="FWP.reset()">Clear selections</button>
                </div>  
            <?php endif; ?>

		</div>
		
        <div class="list-title-area"></div>

        <div class="toggle-content-back">
	        <?php do_action('back_button'); ?>
        </div>

     </div> 

</div>   
 
<?php get_footer(); ?>

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

		var togglebutton = document.getElementById("toggleopen");
		if (togglebutton.style.display === "block") {
			togglebutton.style.display = "none";
		} else {
			togglebutton.style.display = "block";
		}
	}

	//TOGGLE 
	jQuery(function () {
		jQuery('[data-toggle="tooltip"]').tooltip(
			{
			// placement: 'right', 
			animation: true, //https://github.com/twbs/bootstrap/issues/21607#issuecomment-309634023
			}
		)
	})
	
</script>
