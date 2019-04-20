<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/dashboard';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
$user = Auth::user();
$username = $user->username;

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('reports');
$data->where('reportCategory = ', 'Human Resources');
$data->table_name('List of HR Analytics Reports');
$data->columns('rid,ReportTitle,itemsList,reportCategory,Quick');
$data->fields('rid,ReportTitle,itemsList,reportCategory,ReportDescription');
$data->column_pattern('itemsList', '<a href="#X/reports?id={rid}" class="btn btn-labeled bg-color-greenLight txt-color-white"> <span class="btn-label"><i class="glyphicon glyphicon-th-list"></i></span>View {reportType} </a>');
$data->label(array('itemsList' => 'View Report','rid' => 'ID','ReportTitle'=>'Report Title','reportCategory'=>'Report Category','ReportDescription'=>'Report Description'));

$data->subselect('Quick','SELECT COUNT(*) FROM `reports_favourite` WHERE username = "' . $username . '" AND report_id = {rid}');
$data->change_type('Quick', 'bool');
$data->highlight('Quick','!=','0','#E5F993');
$data->button('#', "Add to favourite reports", 'glyphicon glyphicon-link icon-arrow-up', 'btn xcrud-action', array(
    'data-action' => 'add_fav_report',
    'data-task' => 'action',
    'data-username' => $username,
    'data-report_name' => '{ReportTitle}',
    'data-report_category' => '{reportCategory}',
    'data-link' => '{link}',
    'data-primary' => '{rid}'),
    array('Quick', '=', '0'));
$data->create_action('add_fav_report','add_fav_report');

$data->limit(25);
$data->unset_limitlist();
$data->unset_add()->unset_edit()->unset_remove();


?>


<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-3" data-widget-sortable="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-bar-chart"></i> </span>
                    <h2>List of <strong>HR Analytics Reports </strong> <i> by Categoty</i></h2>

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
                        <div class="col-xs-6 col-md-4"><h4 class="alert alert-success"> Staff on the Payroll: <strong>314,501</strong></h4></div>
                        <div class="col-xs-6 col-md-4"><h4 class="alert alert-info"> Permanent & Pensionable: <strong>233,909</strong></h4></div>
                        <div class="col-xs-6 col-md-4"><h4 class="alert alert-warning"> Staff on Probation: <strong>71,814</strong></h4></div>
                        <div class="col-xs-6 col-md-4"><h4 class="alert alert-success"> New Recruitments Last FY: <strong>9,110</strong></h4></div>
                        <div class="col-xs-6 col-md-4"><h4 class="alert alert-info"> Number of Pensioners: <strong>76,913</strong></h4></div>
                        <div class="col-xs-6 col-md-4"><h4 class="alert alert-warning"> Annual Pension Cost: <strong>288.7 Bn/=</strong></h4></div>

                        <?php
                        echo $data->render();
                        ?>
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

    <!-- end row -->

</section>

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

        // switch style change
        $('input[name="checkbox-style"]').change(function() {
            //alert($(this).val())
            $this = $(this);

            if ($this.attr('value') === "switch-1") {
                $("#switch-1").show();
                $("#switch-2").hide();
            } else if ($this.attr('value') === "switch-2") {
                $("#switch-1").hide();
                $("#switch-2").show();
            }

        });

        // tab - pills toggle
        $('#show-tabs').click(function() {
            $this = $(this);
            if($this.prop('checked')){
                $("#widget-tab-1").removeClass("nav-pills").addClass("nav-tabs");
            } else {
                $("#widget-tab-1").removeClass("nav-tabs").addClass("nav-pills");
            }

        });

    };

    // end pagefunction

    // run pagefunction on load

    pagefunction();


</script>
