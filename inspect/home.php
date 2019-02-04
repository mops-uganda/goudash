<?php
require ('../lib/xcrud/xcrud.php');
$tasks = Xcrud::get_instance();
$tasks->table('projecttasks');
$tasks->join('projectID','subprogrammes','ID');
$tasks->order_by('projectTaskID','desc');
$tasks->table_name('Online Joint Inspection and Performance Scorecard Tool');
$tasks->columns('projectTaskTitle,subprogrammes.SubProgramName,assigned_to,priority,status,imProgress');
$tasks->fields('projectTaskTitle,subprogrammes.SubProgramName,imProgress,projectTaskDescription,assigned_to,collaborators,start_date,deadline,priority,status');
$tasks->label(array('projectTaskTitle' => 'Task','subprogrammes.SubProgramName' => 'Project Name','projectTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'));
$tasks->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>');
$tasks->column_pattern('subprogrammes.SubProgramName', "<a href='#X/projectdetails?id={projectID}&Tasks_Complete={subprogrammes.Tasks_Complete}&Tasks_Almost_Complete={subprogrammes.Tasks_Almost_Complete}&Code={subprogrammes.SubProgramCode}&ProjectName={subprogrammes.SubProgramName}'>{subprogrammes.SubProgramName}</a>");
$tasks->column_pattern('projectTaskTitle', '<a href="#" class="xcrud-action" data-task="view" data-primary="{projectTaskID}">{value}</a>');
$tasks->relation('assigned_to','votes','VoteCode','VoteName','VoteCode<400');
$tasks->highlight('status', '=', "Not Started", '#e89e9e');
$tasks->highlight('status', '=', "Completed", '#bee89e');
$tasks->highlight('status', '=', "Delayed", '#e2dda0');
$tasks->unset_add();
$tasks->unset_edit();
$tasks->unset_remove();
$tasks->unset_title();

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
                    <h2>Online Joint Inspection and Performance Scorecard Tool</i></h2>

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
                        <br>Inspection and Performance Assessment of Ministries, Departments, Agencies (MDAs), Local Governments (LGs) and service delivery facilities.<br>
                        <?php
                        echo $tasks->render();
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
