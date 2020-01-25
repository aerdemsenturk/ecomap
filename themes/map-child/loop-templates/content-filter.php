<?php
/**
 * BROWSE
 * Content
 * 
 * @package understrap
 */

?>

<div class="modal" id="ModalFilters" tabindex="-1" role="dialog" aria-labelledby="ModalFiltersTitle" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
		<?php echo facetwp_display( 'facet', 'search' ); ?>
		<button type="button" class="btn btn-primary float-right" onclick="FWP.reset()">Clear</button>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
		</button>
      </div>
      <div class="modal-body">
			<div class="row no-gutter">
				<!-- Mobile version selected items -->
				<div class="col-12 mt-3 mb-3 d-block d-sm-none">	
				<?php the_content(); ?>
				</div>
				<div class="col-12 p-3 border-right">
				<h4 class="pb-4">TYPE</h4>
				<?php echo facetwp_display( 'facet', 'case_type' ); ?>
				</div>
				<div class="col-12 col-lg-4 col-md-4 col-sm-12 col-xs-12 p-3 border-right border-top small">
				<h5 class="pb-4">ACTOR</h5>
				<p>Pro</p>
				<?php echo facetwp_display( 'facet', 'actor_relations_pro' ); ?>
				<p>Contra</p>
				<?php echo facetwp_display( 'facet', 'actor_relations_contra' ); ?>
				</div>
				<div class="col-12 col-lg-4 col-md-4 col-sm-12 col-xs-12 p-3 border-right border-top small">
				<h5 class="pb-4">COMMODITY</h5>
				<?php echo facetwp_display( 'facet', 'commodity' ); ?>
				</div>
				<div class="col-12 col-lg-4 col-md-4 col-sm-12 col-xs-12 p-3 border-top small">
				<h5 class="pb-4">IMPACT</h5>
				<p>Visible</p>
				<?php echo facetwp_display( 'facet', 'visible_impact' ); ?>
				<p>Potential</p>
				<?php echo facetwp_display( 'facet', 'potential_impact' ); ?>
				</div>
				<!-- <div class="col-12">
				<?php echo facetwp_display( 'facet', 'temporal_start' ); ?>
				<?php echo facetwp_display( 'facet', 'temporal_end' ); ?>
				</div> -->
			</div> 
      </div>
    </div>
  </div>
</div>

<div class="row">
	<div class="col-6 mt-6 mr-3 mb-3 d-none d-lg-block d-md-block d-sm-block fixed-left">	
		<?php the_content(); ?>
	</div>
</div>
