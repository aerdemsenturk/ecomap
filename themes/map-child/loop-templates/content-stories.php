<?php
/**
 * Stories
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

    <div class="flex-fill scroll-area story-default" id="storyleft">
            <iframe class="embed-responsive-item" id="storyleft-map" style="border: none;" width="100%" height="100%" src="../wp-content/themes/map-child/diagram/stories-map.html"></iframe>
    </div>
    
    <div class="scroll-area col-12 col-lg-6 col-md-6 col-sm-6 col-xs-6" id="toggle">

        <div class="list-title-area"></div>
        
        <div class="col-12 pt-3 bg-primary text-white float-left">
            <p>There are 3 stories published</p>
        </div> 
        
        <div class="card-block border-left" id="accordion">

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 pb-2 col-lg-12">
                                <small>
                                2019 ⎯ 3D Vis
                                </small>
                                <a id="headingS1" data-toggle="collapse" href="#collapseS1" aria-expanded="true" aria-controls="collapseS1" onclick="costofgold()">
                                    <h4>Cost of Gold</h4>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="collapseS1"  data-parent="#accordion" aria-labelledby="headingS1">
                        <div class="row">

                            <!--ACTOR POST TYPE VERSION -->
                            <div class="col-12 pt-3 pb-3 border-bottom">
                                <p>Gold is an element that has profoundly influenced the physical and sociological structure of the earth through history due to its abstract value, although there is no benefit that should be considered.
                                Today most of the gold is used as jewelry. Or rather not used. Most of the extracted gold is stored in boxes as bars. It is constantly changing in shape and is in constant physical or virtual circulation. Perhaps your gold watch includes a Roman coin that was in circulation 2,000 years ago. This is a financial asset that can be virtualized by doing some transactions on the stock exchange.
                                </p> 
                                <a href="http://localhost:8080/examples/quarry/">See Story →</a>  
                            </div>

                            <div class="col-6 pt-2 pb-4 small border-right">
                                <p>CREATED BY</p>
                                <p>A. Erdem Şentürk</p>
                            </div>

                            <div class="col-6 pt-2 pb-4 small border-right">
                                <p>COMMODITIES</p>
                                Do you need?
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 pb-2 col-lg-12">
                                <small>
                                    2019 ⎯ Digital Map
                                </small>
                                <a id="headingS2" data-toggle="collapse" href="#collapseS2" aria-expanded="true" aria-controls="collapseS2" onclick="toxicvalley()">
                                    <h4>The Toxic Valley</h4>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="collapseS2"  data-parent="#accordion" aria-labelledby="headingS2">
                        <div class="row">

                            <!--ACTOR POST TYPE VERSION -->
                            <div class="col-12 pt-3 pb-3 border-bottom">
                                <p>
                                How global industry turned a once green Turkish province into an environmental wasteland. 
                                The Toxic Valley investigation also sought to measure the extent of pollution in the area. When official statistics proved vague or out of date, we took samples of Dilovası’s main river and had them analysed by experts. The samples revealed levels of metals and harmful chemicals such as mercury, iron and ammonia far in excess of legal limits.
                                In 2007, a Turkish parliamentary commission reported on the environmental effects of industrialisation in the area, recommending that Dilovası be designated a “health disaster zone”. But rather than curbing the industrialisation of Kocaeli, the Turkish government has encouraged it, by dramatically expanding the number of industrial zones and providing incentives to businesses in the area.
                                </P>
                                Not published yet                       
                            </div>

                            <div class="col-6 pt-2 pb-4 small border-right">
                                <p>CREATED BY</p>
                                <p>Zeynep Şentek, Craig Shaw</p>
                                <p>Additional reporting by Mina Eroğlu, Doğu Eroğlu, Ali Tahir Kaya, Elif Alçınkaya, Maria Kamarianaki</p>
                            </div>

                            <div class="col-6 pt-2 pb-4 small border-right">
                                <p>COMMODITIES</p>
                                Do you need?
                            </div>

                        </div>
                    </div>
                </div>

                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-12 pb-2 col-lg-12">
                                <small>
                                2019 ⎯ Interview
                                </small>
                                <a id="headingS3" data-toggle="collapse" href="#collapseS3" aria-expanded="true" aria-controls="collapseS3" onclick="listofposions()">
                                    <h4>List of the Posions - Interview with Bülent Şık</h4>
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="collapse" id="collapseS3"  data-parent="#accordion" aria-labelledby="headingS3">
                        <div class="row">

                            <!--ACTOR POST TYPE VERSION -->
                            <div class="col-12 pt-3 pb-3 border-bottom">
                                 <p>
                                 Turkish scientist, food engineer and human rights activist Bülent Şık was sentenced to 15 months in jail after publishing the results of a study he and other scientists had done that linked toxic pollution to a high incidence of cancer in western Turkey.    
                                 The study was commissioned by Turkey’s Ministry of Health to see whether there was a connection between toxicity in soil, water, and food and the high incidence of cancer in western Turkey. Working for 5 years, Şık and a team of scientists discovered dangerous levels of pesticides, heavy metals, and polycyclic aromatic hydrocarbons in multiple food and water samples from several provinces in western Turkey. Water in several residential areas was also found to be unsafe for drinking because of lead, aluminum, chrome, and arsenic pollution.
                                 </p>
                                 Not published yet
                            </div>

                            <div class="col-6 pt-2 pb-4 small border-right">
                                <p>CREATED BY</p>
                                <p>Anıl Olcan</p>
                            </div>

                            <div class="col-6 pt-2 pb-4 small border-right">
                                <p>COMMODITIES</p>
                                Do you need?
                            </div>

                        </div>
                    </div>
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

    // TOXIC VALLEY
    function toxicvalley() {
         var element = document.getElementById("storyleft");
         element.classList.toggle("toxic-valley");
         element.classList.remove("cost-of-gold", "list-of-posions");

         var element = document.getElementById("storyleft-map");
         element.classList.add("d-none");

         var element = document.getElementById("collapseS2");

         if (element.classList.contains("show")) {
            var element = document.getElementById("storyleft-map");
            element.classList.remove("d-none");
                } else {
            // No my-class :(
        }
    }

     // COST OF GOLD
    function costofgold() {
         var element = document.getElementById("storyleft");
         element.classList.toggle("cost-of-gold");
         element.classList.remove("toxic-valley", "list-of-posions");

         var element = document.getElementById("storyleft-map");
         element.classList.add("d-none");

         var element = document.getElementById("collapseS1");

         if (element.classList.contains("show")) {
            var element = document.getElementById("storyleft-map");
            element.classList.remove("d-none");
                } else {
            // No my-class :(
        }
    }

     // LIST OF POISONS
    function listofposions() {
         var element = document.getElementById("storyleft");
         element.classList.toggle("list-of-posions");
         element.classList.remove("toxic-valley", "cost-of-gold");

         var element = document.getElementById("storyleft-map");
         element.classList.add("d-none");

         var element = document.getElementById("collapseS3");
         
         if (element.classList.contains("show")) {
            var element = document.getElementById("storyleft-map");
            element.classList.remove("d-none");
                } else {
            // No my-class :(
        }
    }
    
</script>