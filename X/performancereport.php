<?php
require_once("inc/init.php");
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');
require_once("queryX.php");

ob_start("ob_gzhandler");
$Financial_Year = '2015/2016';
if (isset($_GET['FY'])) {
    $Financial_Year = $_GET['FY'];
}

?>
<style>
    .level2{
        font-size: 90%;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h4 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
            Government Performance Report
        </h4>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h5> GDP <span class="txt-color-blue">$25.53 Bn</span></h5>
                <div class="sparkline txt-color-blue hidden-mobile hidden-md hidden-sm">
                    1300, 1877, 2500, 2577, 2000, 2100, 3000, 2700, 3631, 2471, 2700, 3631, 2471
                </div>
            </li>
            <li class="sparks-info">
                <h5> GDP Growth <span class="txt-color-purple"><i class="fa fa-arrow-circle-up"></i>&nbsp;3.7%</span></h5>
                <div class="sparkline txt-color-purple hidden-mobile hidden-md hidden-sm">
                    110,150,300,130,400,240,220,310,220,300, 270, 210
                </div>
            </li>
            <li class="sparks-info">
                <h5> Population <span class="txt-color-greenDark"><i class="fa fa-user"></i>&nbsp;41.49 Mn</span></h5>
                <div class="sparkline txt-color-greenDark hidden-mobile hidden-md hidden-sm">
                    110,150,300,130,400,240,220,310,220,300, 270, 210
                </div>
            </li>
        </ul>
    </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-0" data-widget-editbutton="false" data-widget-sortable="false" data-widget-deletebutton="false">
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
                    <span class="widget-icon"> <i class="fa fa-lg fa-calendar"></i> </span>
                    <h2>Table of Contents </h2>
                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">

                        <div class="widget-body-toolbar bg-color-white">

                            <form class="form-inline" role="form">

                                <div class="row">

                                    <div class="col-sm-12 col-md-10">

                                        <div class="form-group">
                                            <label class="sr-only">Days</label>
                                            <select class="form-control input-sm" id="fy_select">
                                                <option>2013/2014</option>
                                                <option>2014/2015</option>
                                                <option selected>2015/2016</option>
                                                <option>2016/2017</option>
                                                <option>2017/2018</option>
                                                <option>2018/2019</option>
                                                <option>2019/2020</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-2 text-align-right">

                                        <button onclick="setfy()" class="btn btn-warning btn-xs">
                                            <i class="fa fa-plus"></i> Select
                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>

                        <div class="tree">
                            <ul>
                                <?php
                                $level1 = getcounts('SELECT * FROM `performance_report_toc` WHERE Level = 1 AND Financial_Year = "' . $Financial_Year . '"');
                                if ($level1->num_rows){
                                    echo '<h3>Table of Contents for Performance Report for FY ' . $Financial_Year . '</h3>';
                                    while ($row1 = $level1->fetch_row()){
                                        ?>
                                        <li>
                                            <span><i class="fa fa-lg fa-rss"></i> <?php echo $row1[3]; ?>: <?php echo $row1[5]; ?></span>
                                            <ul>
                                                <?php
                                                $level2 = getcounts('SELECT * FROM `performance_report_toc` WHERE Parent_Number = "' . $row1[3] . '" AND Financial_Year = "' . $Financial_Year . '"');
                                                if ($level2->num_rows){
                                                while ($row2 = $level2->fetch_row()){
                                                if ($row2[2] == 2){
                                                    ?>
                                                    <li style="display:none">
                                                        <span class="label label-success level2"><i class="fa fa-lg fa-plus-circle"></i> <?php echo $row2[3]; ?> : &ndash;&ndash; <?php echo $row2[5]; ?> </span><?php if($row2[6]){ ?> <span class="txt-color-blueDark"><?php echo $row2[6]; ?></span><?php } ?>
                                                        <ul>
                                                            <?php
                                                            $level3 = getcounts('SELECT * FROM `performance_report_toc` WHERE Parent_Number = "' . $row2[3] . '" AND Financial_Year = "' . $Financial_Year . '"');
                                                            while ($row3 = $level3->fetch_row()){
                                                            ?>
                                                            <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> <?php echo $row3[3]; ?>: </span> &ndash;&ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=<?php echo $row3[3]; ?>&Report_Title=<?php echo $row3[5]; ?>"><?php echo $row3[5]; ?></a><?php if($row3[6]){ ?> <span class="txt-color-blueDark"><?php echo $row3[6]; ?></span><?php } ?>
                                                                <?php
                                                                }
                                                                ?>
                                                        </ul>
                                                    </li>
                                                    <?php
                                                }else{
                                                ?>
                                                <li style="display:none"><span><i class="fa fa-dot-circle-o"></i> <?php echo $row2[3]; ?>: </span> &ndash;&ndash; <a href="#X/performancedetails?FY=<?php echo $Financial_Year ?>&Report_Number=<?php echo $row2[3]; ?>&Report_Title=<?php echo $row2[5]; ?>"><?php echo $row2[5]; ?></a><?php if($row2[6]){ ?> <span class="txt-color-blueDark"><?php echo $row2[6]; ?></span><?php } ?>
                                                    <?php
                                                    }
                                                    }
                                                    }
                                                    ?>
                                            </ul>
                                        </li>
                                        <?php
                                    }
                                }else{
                                    echo '<h3>No Table of Contents has been created for FY ' . $Financial_Year . '</h3>';
                                }
                                ?>

                            </ul>
                        </div>

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

    <!-- row -->

    <div class="row">

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

    // PAGE RELATED SCRIPTS
    // pagefunction

    var pagefunction = function() {

        if($(".tree > ul")&&!mytreebranch){var mytreebranch=$(".tree").find("li:has(ul)").addClass("parent_li").attr("role","treeitem").find(" > span").attr("title","Collapse this branch");$(".tree > ul").attr("role","tree").find("ul").attr("role","group"),mytreebranch.on("click",function(a){var b=$(this).parent("li.parent_li").find(" > ul > li");b.is(":visible")?(b.hide("fast"),$(this).attr("title","Expand this branch").find(" > i").addClass("icon-plus-sign").removeClass("icon-minus-sign")):(b.show("fast"),$(this).attr("title","Collapse this branch").find(" > i").addClass("icon-minus-sign").removeClass("icon-plus-sign")),a.stopPropagation()})}

    };
    
    var setfy = function () {
        var e = document.getElementById("fy_select");
        var strUser = e.options[e.selectedIndex].value;
        document.location.href='#X/performancereport?FY='+strUser;
    }

    // end pagefunction

    // run pagefunction on load

    pagefunction();

</script>
