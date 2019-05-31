<?php
require ('../lib/xcrud/xcrud.php');
$milestones = Xcrud::get_instance();
$milestones->table('projectmilestones');
$milestones->join('projectID','subprogrammes','ID');
$milestones->order_by('projectmilestoneID','desc');
$milestones->table_name('Milestones');
$milestones->columns('projectmilestone,subprogrammes.SubProgramName,currentachieved,status,imProgress');
$milestones->fields('projectmilestone,subprogrammes.SubProgramName,projectmilestoneDescription,assigned_to,deadline,currentachieved,reasonsforvariation,status,imProgress,collaborators,createdBy,deleted');
$milestones->label(array('projectmilestone'=>'Milestone','subprogrammes.SubProgramName' => 'Project Name','projectmilestoneDescription'=>'Description','assigned_to'=>'Responsible Office','deadline'=>'Deadline','currentachieved'=>'Current Achieved','reasonsforvariation'=>'Reasons for Variation','status'=>'Status','imProgress'=>'% Achieved','start_date'=>'Start Date','collaborators'=>'Team to achieve Milestone','createdBy'=>'Author','deleted'=>'Deleted?Do not change'));
$milestones->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>');
$milestones->column_pattern('subprogrammes.SubProgramName', "<a href='#X/projectdetails?id={projectID}&Tasks_Complete={subprogrammes.Tasks_Complete}&Tasks_Almost_Complete={subprogrammes.Tasks_Almost_Complete}&Code={subprogrammes.SubProgramCode}&ProjectName={subprogrammes.SubProgramName}'>{subprogrammes.SubProgramName}</a>");
$milestones->column_pattern('projectmilestone', '<a href="#" class="xcrud-action" data-task="view" data-primary="{projectmilestoneID}">{value}</a>');
$milestones->unset_add();
$milestones->unset_edit();
$milestones->unset_remove();
$milestones->unset_title();


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
                    <h2>List of <strong>Key Milestones </strong></h2>

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
                        <br>Milestones are <strong>Checkpoints</strong> throughout the life of the project used in Project Management to mark specific points or stages along a project implementation timeline.<br>
                        <?php
                        echo $milestones->render();
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
