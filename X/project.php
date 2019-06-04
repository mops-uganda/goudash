<?php
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');
$user = Auth::user();
$xcrud = Xcrud::get_instance();
$xcrud->table('projects');
$xcrud->order_by('projectID','desc');
$xcrud->table_name('List of Strategic Projects, with Tasks, Milestones and Timelines');
$xcrud->button('#X/projectdetails?projectid={projectID}','Details','glyphicon glyphicon-new-window');
$xcrud->pass_default('createdBy',$user->username);
$xcrud->pass_var('createdBy', $user->username);
$xcrud->columns('projectName,projectID,projectPriority,projectLead,projectCost,projectStatus,impProgress');
$xcrud->fields('projectName,projectID,projectType,projectPriority,projectStartFY,projectStartDate,projectDecription,projectLead,projectCost,projectStatus,projectDeadline,impProgress,createdBy,deleted');
$xcrud->label(array('projectID'=>'Details','projectName'=>'Project Name','projectType'=>'Project Type','projectPriority'=>'Priority','projectStartFY'=>'Start FY','projectStartDate'=>'Start Date','projectDecription'=>'Description','projectLead'=>'Lead Ministry/Agency','projectCost'=>'Project Cost','projectStatus'=>'Project Status','projectDeadline'=>'Project Deadline','impProgress'=>'% Progress','createdBy'=>'Author','deleted'=>'Deleted? Dont Change'));
$xcrud->column_pattern('impProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {impProgress}%">{impProgress}%</div></div>');
$xcrud->column_pattern('projectName', '<a href="#" class="xcrud-action" data-task="view" data-primary="{projectID}">{value}</a>');
$xcrud->column_pattern('projectID', '<a class="btn btn-info btn-xs" href="#X/projectdetails?projectid={projectID}">Details</a>');
$xcrud->change_type('projectType','select','','National Flagship Project,Sector Strategic Project,Ministry/Agency Project,International Project,Normal Project');
$xcrud->change_type('projectStartFY','select','','2015/2016,2016/2017,2017/2018,2018/2019,2019/2020');
$xcrud->change_type('projectStatus','select','','Not Started,On going,Delayed,On Hold,Cancelled,Completed');
$xcrud->change_type('projectPriority','select','','Very High,High,Normal,Low');
$xcrud->change_type('projectCost', 'price', '', array('prefix'=>'UGX ', 'point'=>'0', 'decimals'=>'0'));
$xcrud->relation('projectLead','votes','VoteCode','VoteName','VoteCode<400');
$xcrud->highlight('projectStatus', '=', "Not Started", '#e89e9e');
$xcrud->highlight('projectStatus', '=', "Completed", '#bee89e');
$xcrud->highlight('projectStatus', '=', "Delayed", '#e2dda0');
$xcrud->unset_title();
?>

<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-blueLight" id="wid-id-3" data-widget-sortable="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false">
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
                    <span class="widget-icon"> <i class="fa fa-bar-chart"></i> </span>
                    <h2>List of <strong>Strategic Projects</strong> <i>, with Tasks, Milestones and Timelines</i></h2>

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
                        <?php
                        echo $xcrud->render();
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

