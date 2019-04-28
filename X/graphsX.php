<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/graphs';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);

require_once("inc/init.php");
require ('../lib/xcrud/xcrud.php');

$graph_id = 4;
if (isset($_GET['id'])) {
    $graph_id = $_GET['id'];
}

$db = Xcrud_db::get_instance();
$sql = 'SELECT * FROM `graphs` WHERE GID = ' . $graph_id;
$db->query($sql);
$report_definition = $db->result();
$db->query($report_definition[0]["SQL_Statement"]);
$graph_data = $db->result();

$numrows=count($graph_data);
list($XAxis, $YAxis, $YAxis2, $Tooltip, $Tooltip2) = array('XAxis','YAxis','YAxis2','Tooltip','Tooltip2');
$no_columns = $report_definition[0]["columns"];
$column_size = $report_definition[0]["Colmn_Size"];
switch ($no_columns){
    case 1: list($XAxis, $YAxis, $Tooltip, $Legend) = explode(':',$report_definition[0]["X_Y_Axis"]); break;
    case 2: list($XAxis, $YAxis, $YAxis2, $Tooltip, $Legend, $Legend2) = explode(':',$report_definition[0]["X_Y_Axis"]); break;
}



$graphData="[";
$graphData2="[";
$ticksData="[";
for ($count=0;$count<$numrows;$count++){
    $graphData=$graphData."[".$count.",".$graph_data[$count][$YAxis]."]";
    $graphData2=$graphData2."[".$count.",".$graph_data[$count][$YAxis2]."]";
    $ticksData=$ticksData."[".$count.",'".$graph_data[$count][$XAxis]."']";
    if ($count<$numrows) {
        $graphData=$graphData.",";
        $graphData2=$graphData2.",";
        $ticksData=$ticksData.",";
    }
}
$graphData=$graphData."]";
$graphData2=$graphData2."]";
$ticksData=$ticksData."]";
//echo $graphData."<br>";
//echo $graphData2."<br>";
//echo $ticksData."<br>";
//echo $Tooltip."<br>";
//echo $Tooltip2."<br>";
?>
<style>
    #legend-container {
        background-color: #fff;
        padding: 2px;
        margin-bottom: 8px;
        border-radius: 3px 3px 3px 3px;
        border: 1px solid #E6E6E6;
        display: inline-block;
        margin: 0 auto;
    }
</style>
<button class="btn btn-success btn-labeled btn-md " onclick="location.href='#X/reports';"><span class="btn-label"><i class="fa fa-chevron-left"></i></span> Return to List of Reports</button>
<button class="btn btn-success btn-labeled btn-md " onclick="location.reload();"><span class="btn-label"><i class="fa fa-refresh"></i></span> Refresh</button>
<br><br>
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
                    <h2><?php echo $report_definition[0]["Graph_Name"]; ?></h2>

                </header>

                <!-- widget div-->
                <div class="demo-container">
                    <div id="placeholder" class="demo-placeholder"></div>
                    <div id="legend-container"></div>
                </div>
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

    var reloadCurrentPage = function(){
        location.href=$(location).attr('hash') + $(location).attr('search') + '&refresh';
    };

    // PAGE RELATED SCRIPTS

    var pagefunction = function() {

        /* chart colors default */
        var $chrt_border_color = "#efefef";
        var $chrt_second = "#6595b4";		/* blue      */
        var $chrt_fourth = "#7e9d3a";		/* green     */


        /* bar chart */

        if ($("#bar-chart").length) {

            var data1 = <?php echo $graphData;?>;
            var data2 = <?php echo $graphData2;?>;
            //var data2 = [[1,60],[2,30],[3,22],[4,79],[5,45],[6,66],[7,60],[8,30],[9,22],[10,79],[11,45],[12,66]];
            //var data3 = [[1,70],[2,60],[3,90],[4,30],[5,55],[6,20],[7,70],[8,60],[9,90],[10,30],[11,55],[12,20]];
            //var data4 = [[1,45],[2,30],[3,120],[4,70],[5,50],[6,50],[7,45],[8,30],[9,120],[10,70],[11,50],[12,50]];

            var ds = new Array();

            ds.push({
                data : data1,
                label:"<?php echo $Legend; ?>",
                bars : {
                    show : true,
                    barWidth : <?php echo $column_size; ?>,
                    order : 1
                }
            });
            <?php if($no_columns==2){ ?>
            ds.push({
                data : data2,
                label:"<?php echo $Legend2; ?>",
                bars : {
                    show : true,
                    barWidth : <?php echo $column_size; ?>,
                    order : 2
                }
            });
            <?php } ?>


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
                legend: {
                    show: true,
                    container: $('#legend-container')
                },
                tooltip : true,
                tooltipOpts : {
                    content : "<span>%y <?php echo $Tooltip; ?></span>",
                    defaultTheme : false
                },
                xaxis: {
                    tickLength: 0,
                    ticks: <?php echo $ticksData;?>,

                },
                yaxis: {
                    tickDecimals: 0,
                    tickFormatter: function numberWithCommas(x) {
                        return x.toString().replace(/\B(?=(?:\d{3})+(?!\d))/g, ",");
                    }
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
