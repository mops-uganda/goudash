<?php
require_once("inc/init.php");
?>

<!-- row -->
<div class="row">
	
	<!-- col -->
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
		<h1 class="page-title txt-color-blueDark text-center well">
			
			<!-- PAGE HEADER -->
				GOUDashboard Pre-built Skins<br>
		</h1>
		
	</div>
	<!-- end col -->
	
</div>
<!-- end row -->

<!--
	The ID "widget-grid" will start to initialize all widgets below 
	You do not need to use widgets if you dont want to. Simply remove 
	the <section></section> and you can use wells or panels instead 
	-->

<!-- widget grid -->
<section id="widget-grid" class="">

	<!-- row -->

	<div class="row">

		<!-- a blank row to get started -->
		<div class="col-sm-4">
			<!-- your contents here -->
			<div class="well text-center">
				<h5>
					Skin name "<strong>Glass</strong>" <br> 
				</h5>
				<a href="X/skinschange?skin=smart-style-5" target="_top"><img src="img/demo/layout-skins/skin-glass.png" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;"></a>
			</div>
		</div>
		<div class="col-sm-4">
			<!-- your contents here -->
			<div class="well text-center">
				<h5>
					Skin name "<strong>Orange</strong>" <br>
				</h5>
                <a href="X/skinschange?skin=smart-style-3" target="_top"><img src="img/demo/layout-skins/skin-google.png" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;"></a>
			</div>
		</div>
        <div class="col-sm-4">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>PixelSmash</strong>" <br>
                </h5>
                <a href="X/skinschange?skin=smart-style-4" target="_top"><img src="img/demo/layout-skins/skin-pixel.png" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;"></a>
            </div>
        </div>
			
	</div>

	<div class="row">

		<!-- a blank row to get started -->
		<div class="col-sm-4">
			<!-- your contents here -->
			<div class="well text-center">
				<h5>
					Skin name "<strong>Dark Elegance</strong>" <br> 
				</h5>
                <a href="X/skinschange?skin=smart-style-1" target="_top"><img src="img/demo/layout-skins/skin-dark.png" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;"></a>
			</div>
		</div>
        <div class="col-sm-4">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>Default</strong>" <br>
                </h5>
                <a href="X/skinschange?skin=smart-style-0" target="_top"><img src="img/demo/layout-skins/skin-default.png" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;"></a>
            </div>
        </div>
        <div class="col-sm-4">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>Ultra Light</strong>" <br>
                </h5>
                <a href="X/skinschange?skin=smart-style-2" target="_top"><img src="img/demo/layout-skins/skin-ultralight.png" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;"></a>
            </div>
        </div>
			
	</div>

    <div class="row">

        <!-- a blank row to get started -->
        <div class="col-sm-4">
            <!-- your contents here -->
            <div class="well text-center">
                <h5>
                    Skin name "<strong>Material</strong>" <br>
                </h5>
                <a href="X/skinschange?skin=smart-style-6" target="_top"><img src="img/demo/layout-skins/skin-material.png" class="img-responsive center-block" style="box-shadow: 0px 0px 3px 0px #919191;"></a>
            </div>
        </div>

    </div>

    <!-- end row -->

</section>
<!-- end widget grid -->

<script type="text/javascript">
	
	/* DO NOT REMOVE : GLOBAL FUNCTIONS!
	 *
	 * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
	 *
	 * // activate tooltips
	 * $("[rel=tooltip]").tooltip();
	 *
	 * // activate popovers
	 * $("[rel=popover]").popover();
	 *
	 * // activate popovers with hover states
	 * $("[rel=popover-hover]").popover({ trigger: "hover" });
	 *
	 * // activate inline charts
	 * runAllCharts();
	 *
	 * // setup widgets
	 * setup_widgets_desktop();
	 *
	 * // run form elements
	 * runAllForms();
	 *
	 ********************************
	 *
	 * pageSetUp() is needed whenever you load a page.
	 * It initializes and checks for all basic elements of the page
	 * and makes rendering easier.
	 *
	 */

	pageSetUp();
	
	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 * 
	 * var pagefunction = function() {
	 *   ...
	 * }
	 * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
	 * 
	 * TO LOAD A SCRIPT:
	 * var pagefunction = function (){ 
	 *  loadScript(".../plugin.js", run_after_loaded);	
	 * }
	 * 
	 * OR you can load chain scripts by doing
	 * 
	 * loadScript(".../plugin.js", function(){
	 * 	 loadScript("../plugin.js", function(){
	 * 	   ...
	 *   })
	 * });
	 */
	
	// pagefunction
	
	var pagefunction = function() {
        $('nav').find('a[href$="X/skins.php"]').parent('li').addClass("active");
		// clears the variable if left blank
	};
	
	// end pagefunction

	// destroy generated instances 
	// pagedestroy is called automatically before loading a new page
	// only usable in AJAX version!

	var pagedestroy = function(){
		
		/*
		Example below:

		$("#calednar").fullCalendar( 'destroy' );
		if (debugState){
			root.console.log("✔ Calendar destroyed");
		} 

		For common instances, such as Jarviswidgets, Google maps, and Datatables, are automatically destroyed through the app.js loadURL mechanic

		*/
	}

	// end destroy
	
	// run pagefunction
	pagefunction();
	
</script>
