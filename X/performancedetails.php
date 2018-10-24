<?php
require_once '../securex/extra/auth.php';

$Financial_Year = '2015/2016';
$Report_Number = 0.1;
$Report_Title = 'Executive Summary';
$PRID = 1;

if (isset($_GET['FY'])) {
    $Financial_Year = $_GET['FY'];
}

if (isset($_GET['Report_Number'])) {
    $Report_Number = $_GET['Report_Number'];
}

if (isset($_GET['Report_Title'])) {
    $Report_Title = $_GET['Report_Title'];
}

$report_txt = '<br>';

require_once("inc/init.php");
require_once("queryX.php");
require ('../lib/xcrud/xcrud.php');

$user = Auth::user();

$performance_data = Xcrud::get_instance();
$performance_data->table('performance_report');
$performance_data->where('Report_Number =', $Report_Number);
$performance_data->where('Financial_Year =', $Financial_Year);
$performance_data->pass_default('author',$user->username);
$performance_data->pass_var('author', $user->username);
$performance_data->pass_default('Report_Number',$Report_Number);
$performance_data->pass_var('Report_Number', $Report_Number);
$performance_data->pass_default('Financial_Year',$Financial_Year);
$performance_data->pass_var('Financial_Year', $Financial_Year);
$performance_data->pass_default('Report_Title',$Report_Title);
$performance_data->pass_var('Report_Title', $Report_Title);
$performance_data->columns('PRID,Financial_Year,Report_Title,date_entry,author');
$performance_data->fields('Report_Title,Report_Details,date_entry,author');
$performance_data->label(array('Report_Title'=>'Report Title','Report_Details'=>'Details','date_entry'=>'Entry Date','author'=>'Author'));
$performance_data->unset_title();
$performance_data->hide_button('save_new');

$sql = 'SELECT PRID, Report_Title FROM performance_report WHERE Report_Number="'.$Report_Number.'" AND Financial_Year="'.$Financial_Year.'" ORDER BY PRID DESC';
$getReportID = getcounts($sql);
if ($getReportID->num_rows){
    $row = $getReportID->fetch_row();
    $PRID = $row[0];
    // $performance_data->hide_button('add');
    $report_txt = $report_txt . $performance_data->render('view', $PRID);
}else{
    $report_txt = $report_txt . $performance_data->render('create');
}


?>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h4 class="page-title txt-color-blueDark"><i class="fa fa-desktop fa-fw "></i>
            <?php echo $Report_Title ?>
        </h4>
    </div>
</div>
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12">
            <button class="btn btn-success btn-labeled btn-md " onclick="location.href='#X/performancereport?FY=<?php echo $Financial_Year;?>';"><span class="btn-label"><i class="fa fa-chevron-left"></i></span> Return to Government Performance Reports List FY: <?php echo $Financial_Year;?></button>
            <br><br>
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
                    <h2><?php echo $Report_Title ?> </h2>
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
                                            <select class="form-control input-sm">
                                                <option>2013/2014</option>
                                                <option>2014/2015</option>
                                                <option>2015/2016</option>
                                                <option>2016/2017</option>
                                                <option>2017/2018</option>
                                                <option>2018/2019</option>
                                                <option>2019/2020</option>
                                            </select>
                                        </div>

                                    </div>

                                    <div class="col-sm-12 col-md-2 text-align-right">

                                        <button type="submit" class="btn btn-warning btn-xs">
                                            <i class="fa fa-plus"></i> Select
                                        </button>

                                    </div>

                                </div>

                            </form>

                        </div>
                        <div>
                            <?php
                            echo $report_txt;
                            ?>
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

        loadScript("editors/ckeditor/ckeditor.js");

    };

    // end pagefunction

    // run pagefunction on load

    pagefunction();

</script>
