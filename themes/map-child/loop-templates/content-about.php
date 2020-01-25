<?php
/**
 * About
 * 
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
	<?php the_title( '<h4>', '</h4>' );?>
</header>

<div class="d-flex no-gutters">

    <div class="flex-fill scroll-area bg-primary">
		<iframe style="border: none;" width="100%" height="100%" src="../wp-content/themes/map-child/diagram/about-map.html"></iframe>
    </div>

    <div class="scroll-area col-12 col-lg-6 col-md-6 col-sm-6 col-xs-6" id="toggle">

        <div class="list-title-area"></div> 

            <div class="row border-left">
                <div class="col-12 pt-3 pb-3 border-bottom">
                    <?php the_content(); ?>
                </div>
            </div>

        <div class="list-title-area"></div>

        <div class="toggle-content-back">
	        <?php do_action('back_button'); ?>
        </div>

    </div>

</div>
    
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

</script>