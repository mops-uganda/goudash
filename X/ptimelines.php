<?php
require ('../lib/xcrud/xcrud.php');
$projecttimeline = Xcrud::get_instance();
$projecttimeline->table('projectactiontimelines');
$projecttimeline->join('projectID','subprogrammes','ID');
$projecttimeline->order_by('projectActionTimelinesID','desc');
$projecttimeline->table_name('Project Timelines and Activities');
$projecttimeline->columns('projectActionTitle,projectActionTask,subprogrammes.SubProgramName,projectActionDate,createdBy');
$projecttimeline->fields('projectActionTitle,projectActionTask,subprogrammes.SubProgramName,projectActionDate,projectActionDescription,createdBy');
$projecttimeline->label(array('subprogrammes.SubProgramName' => 'Project Name','projectActionDate' => 'Activity Date','projectActionTitle' => 'Activity','projectActionTask' => 'Task that Project Activity contributes to', 'projectActionDescription' => 'Description', 'createdBy' => 'Author'));
$projecttimeline->column_pattern('subprogrammes.SubProgramName', "<a href='#X/projectdetails?id={projectID}&Tasks_Complete={subprogrammes.Tasks_Complete}&Tasks_Almost_Complete={subprogrammes.Tasks_Almost_Complete}&Code={subprogrammes.SubProgramCode}&ProjectName={subprogrammes.SubProgramName}'>{subprogrammes.SubProgramName}</a>");
$projecttimeline->relation('projectActionTask','projecttasks','projectTaskID','projectTaskTitle','projectID={projectID}');
$projecttimeline->column_pattern('projectActionTitle', '<a href="#" class="xcrud-action" data-task="view" data-primary="{projectActionTimelinesID}">{value}</a>');
$projecttimeline->unset_add();
$projecttimeline->unset_edit();
$projecttimeline->unset_remove();
$projecttimeline->unset_title();


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
                    <h2>List of <strong>Project Implementation Timelines </strong> - and Activities implemented</h2>

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
                        <br><strong>Project activities</strong> and <strong>timelines of events</strong> within te implementation of the Project.<br>
                        <?php
                        echo $projecttimeline->render();
                        include "xcrud_js.php";
                        ?>

                        <!-- Xcrud CSS -->
                        <link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
                        <link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">
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
