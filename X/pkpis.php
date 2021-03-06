<?php
require ('../lib/xcrud/xcrud.php');
$kpis = Xcrud::get_instance();
$kpis->table('projectkpis');
$kpis->join('projectID','subprogrammes','ID');
$kpis->order_by('projectkpisID','desc');
$kpis->table_name('Project KPIs');
$kpis->columns('KeyIndicatorName,subprogrammes.SubProgramName,target, currentachieved, status, imProgress');
$kpis->fields('subprogrammes.SubProgramName,KeyIndicatorName, Indicator_Measure, MethodofMeasurement, SourceofData, Indicator_Type, deadline, baseline, target, currentachieved, reasonsforvariation, status, imProgress, collaborators, deleted, projectID, createdBy');
$kpis->label(array('subprogrammes.SubProgramName' => 'Project Name','KeyIndicatorName'=>'Key Performance Indicator', 'Indicator_Measure'=>'Indicator Measure', 'MethodofMeasurement'=>'Method of Measurement', 'SourceofData'=>'Source of Data', 'Indicator_Type'=>'Indicator Type', 'deadline'=>'Deadline to achieve', 'baseline'=>'Baseline', 'target'=>'Target', 'currentachieved'=>'Current Achieved', 'reasonsforvariation'=>'Reason for Variation', 'status'=>'Status', 'imProgress'=>'% Achieved', 'collaborators'=>'Partners to achieve KPI', 'deleted'=>'Active? Do not change', 'projectID'=>'Project ID', 'createdBy'=>'Author'));
$kpis->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>');
$kpis->column_pattern('subprogrammes.SubProgramName', "<a href='#X/projectdetails?id={projectID}&Tasks_Complete={subprogrammes.Tasks_Complete}&Tasks_Almost_Complete={subprogrammes.Tasks_Almost_Complete}&Code={subprogrammes.SubProgramCode}&ProjectName={subprogrammes.SubProgramName}'>{subprogrammes.SubProgramName}</a>");
$kpis->column_pattern('KeyIndicatorName', '<a href="#" class="xcrud-action" data-task="view" data-primary="{projectkpisID}">{value}</a>');
$kpis->highlight('status', '=', "Not Achieved", '#e89e9e');
$kpis->highlight('status', '=', "Achieved", '#bee89e');
$kpis->highlight('status', '=', "Partially Achieved", '#e2dda0');
$kpis->unset_add();
$kpis->unset_edit();
$kpis->unset_remove();
$kpis->unset_title();


?>


<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-3" data-widget-sortable="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-bar-chart"></i> </span>
                    <h2>List of Project <strong>Key Performance Indicators </strong> - KPIs</h2>

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
                        <br>Key Performance Indicators <strong>KPIs</strong> are <strong>measurable values</strong> that demonstrate if the Project is achieving its design objectives.<br>
                        <?php
                        echo $kpis->render();
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
