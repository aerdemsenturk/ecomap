<?php
/**
 * BROWSE
 * Content
 * 
 * @package understrap
 */

?>

<!-- Button trigger modal -->
<!-- <button type="button" class="btn btn-primary navbar-button" data-toggle="modal" data-target="#ModalFilters">
  FILTER
</button> -->

<!-- Modal -->
<div class="modal" id="ModalFilters" tabindex="-1" role="dialog" aria-labelledby="ModalFiltersTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<?php echo facetwp_display( 'facet', 'search' ); ?>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
		</button>
      </div>
      <div class="modal-body">
			<div class="row no-gutter">
				<div class="col-6 p-3 border-right">
				<h4 class="pb-4">TYPE</h4>
				<?php echo facetwp_display( 'facet', 'case_type' ); ?>
				</div>
				<div class="col-6 p-3">
				<h4 class="pb-4">VISIBLE IMPACT</h4>
				<?php echo facetwp_display( 'facet', 'visible_impact' ); ?>
				<h4 class="pb-4">POTENTIAL IMPACT</h4>
				<?php echo facetwp_display( 'facet', 'potential_impact' ); ?>
				</div>
				<div class="col-6 p-3 border-right border-top">
				<h4 class="pb-4">COMMODITY</h4>
				<?php echo facetwp_display( 'facet', 'commodity' ); ?>
				</div>
				<div class="col-6 p-3 border-top">
				<h4 class="pb-4">ACTORS PRO</h4>
				<?php echo facetwp_display( 'facet', 'actor_relations_pro' ); ?>
				<h4 class="pb-4">ACTORS CONTRA</h4>
				<?php echo facetwp_display( 'facet', 'actor_relations_contra' ); ?>
				</div>
				<div class="col-12">
				<?php echo facetwp_display( 'facet', 'temporal_start' ); ?>
				<?php echo facetwp_display( 'facet', 'temporal_end' ); ?>
				</div>
			</div> 
      </div>
    </div>
  </div>
</div>


<!-- <a class="btn btn-primary mt-6 ml-3 mb-3" data-toggle="collapse" href="#collapsefacets" role="button" aria-expanded="false" aria-controls="collapsefacets">
	FILTER
</a>

<div class="collapse filters" id="collapsefacets">

		<div class="row">
			<div class="col-3">
			<?php echo facetwp_display( 'facet', 'case_type' ); ?>
			</div>
			<div class="col-3">
			<?php echo facetwp_display( 'facet', 'visible_impact' ); ?>
			<?php echo facetwp_display( 'facet', 'potential_impact' ); ?>
			</div>
			<div class="col-3">
			<?php echo facetwp_display( 'facet', 'commodity' ); ?>
			</div>
			<div class="col-3">
			<?php echo facetwp_display( 'facet', 'actor_relations_pro' ); ?>
			<?php echo facetwp_display( 'facet', 'actor_relations_contra' ); ?>
			</div>

			<div class="col-12">
			<?php echo facetwp_display( 'facet', 'search' ); ?>
			<?php echo facetwp_display( 'facet', 'temporal_start' ); ?>
			<?php echo facetwp_display( 'facet', 'temporal_end' ); ?>
			</div>
		</div> 

</div> -->

<div class="row">
	<div class="col-12">

		<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">
			
			<!-- <header class="entry-header">
				<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
			</header> -->

			<div class="col-6 mt-7 mr-3 mb-3 fixed-left">	
				<?php the_content(); ?>
			</div>

		</article><!-- #post-## -->

	</div>
</div>

