<?php
require ('../lib/xcrud/xcrud.php');
$keyoutputs = Xcrud::get_instance();
$keyoutputs->table('projectkeyoutputs');
$keyoutputs->join('projectID','subprogrammes','ID');
$keyoutputs->order_by('projectkeyoutputsID','desc');
$keyoutputs->table_name('List of Project Key Outputs');
$keyoutputs->columns('projectkeyoutputs,subprogrammes.SubProgramName,target,currentachieved,status,imProgress');
$keyoutputs->fields('projectkeyoutputs,subprogrammes.SubProgramName,projectkeyoutputsDescription,assigned_to,deadline,baseline,target,currentachieved,reasonsforvariation,status,imProgress,collaborators,projectID,createdBy,deleted');
$keyoutputs->label(array('projectTaskTitle' => 'Task','subprogrammes.SubProgramName' => 'Project Name','projectTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'));
$keyoutputs->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>');
$keyoutputs->column_pattern('subprogrammes.SubProgramName', "<a href='#X/projectdetails?id={projectID}&Tasks_Complete={subprogrammes.Tasks_Complete}&Tasks_Almost_Complete={subprogrammes.Tasks_Almost_Complete}&Code={subprogrammes.SubProgramCode}&ProjectName={subprogrammes.SubProgramName}'>{subprogrammes.SubProgramName}</a>");
$keyoutputs->column_pattern('projectkeyoutputs', '<a href="#" class="xcrud-action" data-task="view" data-primary="{projectkeyoutputsID}">{value}</a>');
$keyoutputs->label(array('projectkeyoutputs'=>'Key Output','projectkeyoutputsDescription'=>'Description','assigned_to'=>'Responsible Office','deadline'=>'Deadline','baseline'=>'Baseline state','target'=>'Keyoutput Target','currentachieved'=>'Current Output Achieved','reasonsforvariation'=>'Reasons for Variation','status'=>'Status','imProgress'=>'% Achieved','start_date'=>'Start Date','collaborators'=>'Team to achieve output','createdBy'=>'Author','deleted'=>'Deleted?Do not change'));
$keyoutputs->highlight('status', '=', "Not Achieved", '#e89e9e');
$keyoutputs->highlight('status', '=', "Achieved", '#bee89e');
$keyoutputs->highlight('status', '=', "Partially Achieved", '#e2dda0');
$keyoutputs->unset_add();
$keyoutputs->unset_edit();
$keyoutputs->unset_remove();
$keyoutputs->unset_title();

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
                    <h2>List of <strong>Key Outputs </strong></h2>

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
                        <br>Key outputs may be in the form of a <strong>tangible deliverable, component or product, a document, or an intangible service or result</strong>.
                        <?php
                        echo $keyoutputs->render();
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
