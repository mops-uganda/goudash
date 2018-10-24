<?php require_once("inc/init.php"); ?>
<?php require_once("queryX.php"); ?>
<?php
        $mdaTypeCounter = getcounts("SELECT votesview.Sector, COUNT(*) as counter FROM votesview WHERE votesview.Sector IS NOT NULL AND (MDAType=1 OR MDAType=2 OR MDAType=3) GROUP BY votesview.SectorCode ORDER BY votesview.SectorCode");
        $numrows=$mdaTypeCounter->num_rows;
        //echo $numrows."<br>";
        $counter=0;
        $graphData="[";
        $ticksData="[";
        while ($row = mysqli_fetch_array($mdaTypeCounter)) {
            $counter++;
            $graphData=$graphData."[".$counter.",".$row["counter"]."]";
            $ticksData=$ticksData."[".$counter.",'".$row["Sector"]."']";
            if ($counter<$numrows) {
                $graphData=$graphData.",";
                $ticksData=$ticksData.",";
            }
        }
        $graphData=$graphData."]";
        $ticksData=$ticksData."]";
        //echo $graphData."<br>";
        //echo $ticksData;
?>


<!-- widget grid -->
<section id="widget-grid" class="">
	<!-- row -->
	<div class="row">
		
		<!-- NEW WIDGET START -->
		<article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
			
			<!-- Widget ID (each widget will need unique ID)-->
			<div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
				<!-- widget options:
					usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">
					
					data-widget-colorbutton="false"	
					data-widget-editbutton="false"
					data-widget-togglebutton="false"
					data-widget-deletebutton="false"
					data-widget-fullscreenbutton="false"
					data-widget-custombutton="false"
					data-widget-collapsed="true" 
					data-widget-sortable="false"
					
				-->
				<header>
					<span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
					<h2>Ministries, Departments and Agencies by Sector</h2>
					
				</header>

				<!-- widget div-->
				<div>
					
					<!-- widget edit box -->
					<div class="jarviswidget-editbox">
						<!-- This area used as dropdown edit box -->
						
					</div>
					<!-- end widget edit box -->
					
					<!-- widget content -->
					<div class="widget-body no-padding">
						
						<div id="bar-chart" class="chart" style="height:400px"></div>
						
					</div>
					<!-- end widget content -->
					
				</div>
				<!-- end widget div -->
				
			</div>
			<!-- end widget -->

		</article>
		<!-- WIDGET END -->
		
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


	// PAGE RELATED SCRIPTS

	var pagefunction = function() {

		/* chart colors default */
		var $chrt_border_color = "#efefef";
		var $chrt_second = "#6595b4";		/* blue      */
		var $chrt_fourth = "#7e9d3a";		/* green     */


        /* bar chart */

        if ($("#bar-chart").length) {

            var data1 = <?php echo $graphData;?>;
            //var data2 = [[1,60],[2,30],[3,22],[4,79],[5,45],[6,66],[7,60],[8,30],[9,22],[10,79],[11,45],[12,66]];
            //var data3 = [[1,70],[2,60],[3,90],[4,30],[5,55],[6,20],[7,70],[8,60],[9,90],[10,30],[11,55],[12,20]];
            //var data4 = [[1,45],[2,30],[3,120],[4,70],[5,50],[6,50],[7,45],[8,30],[9,120],[10,70],[11,50],[12,50]];

            var ds = new Array();

            ds.push({
                data : data1,
                label:"No. of MDAs",
                bars : {
                    show : true,
                    barWidth : 0.3,
                    order : 1,
                }
            });


            //Display graph
            plot_3 = $.plot($("#bar-chart"), ds, {
                colors : [$chrt_second, $chrt_fourth, "#666", "#BBB"],
                grid : {
                    show : true,
                    hoverable : true,
                    clickable : true,
                    tickColor : $chrt_border_color,
                    borderWidth : 0,
                    borderColor : $chrt_border_color,
                },
                legend : true,
                tooltip : true,
                tooltipOpts : {
                    content : "<span>%y MDAs</span>",
                    defaultTheme : false
                },
                xaxis: {
                    tickLength: 0,
                    ticks: <?php echo $ticksData;?>,

                },
                yaxis: {
                    tickDecimals: 0
                }

            });

        }

        /* end bar chart */

	};

	// destroy generated instances 
	// pagedestroy is called automatically before loading a new page
	// only usable in AJAX version!

	var pagedestroy = function(){
		
		//destroy flots
		plot_1.shutdown(); 
		plot_1 = null;


		if (debugState){
			root.console.log("✔ Flots destroyed");
		} 

	}

	// end destroy
	
	// end pagefunction

	// load all flot plugins

	loadScript("js/plugin/flot/jquery.flot.cust.min.js", function(){
		loadScript("js/plugin/flot/jquery.flot.resize.min.js", function(){
			loadScript("js/plugin/flot/jquery.flot.fillbetween.min.js", function(){
				loadScript("js/plugin/flot/jquery.flot.orderBar.min.js", function(){
					loadScript("js/plugin/flot/jquery.flot.pie.min.js", function(){
						loadScript("js/plugin/flot/jquery.flot.time.min.js", function(){
							loadScript("js/plugin/flot/jquery.flot.tooltip.min.js", pagefunction);
						});
					});
				});
			});
		});
	});

    loadScript("js/plugin/flot/jquery.flot.categories.min.js");

</script>
