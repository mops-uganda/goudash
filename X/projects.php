<?php
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');
$user = Auth::user();
$xcrud = Xcrud::get_instance();
$xcrud->table('subprogrammes');
$xcrud->where('LENGTH(SubProgramCode) = 4 AND Priority = 1');
$xcrud->order_by('id','asc');
$xcrud->table_name('List of Strategic Projects, with Tasks, Milestones and Timelines');
$xcrud->pass_default('createdBy',$user->username);
$xcrud->pass_var('createdBy', $user->username);
$xcrud->pass_default('Priority',1);
$xcrud->pass_var('Priority',1);
$xcrud->columns('SubProgramName,ID,VoteCode,projectPriority,projectStatus,Tasks_Complete');
$xcrud->fields('SubProgramCode,SubProgramName,ID,projectCost,Tasks_Complete,Tasks_Almost_Complete,projectStatus,projectDecription,VoteCode,ResponsibleOfficers,ProjectObjectives,ProjectOutputs,GOU,external_Funded,projectType,projectPriority,projectStartFY,projectStartDate,projectDeadline,createdBy');
$xcrud->label(array('Tasks_Complete'=>'Tasks Complete','Tasks_Almost_Complete'=>'Tasks Complete or Almost Complete','SubProgramCode'=>'Code','ResponsibleOfficers'=>'Responsible Officer','ProjectObjectives'=>'Project Objectives','ProjectOutputs'=>'Project Outputs','ID'=>'Details','SubProgramName'=>'Project Name','VoteCode'=>'Lead Ministry/Agency','projectType'=>'Project Type','projectPriority'=>'Priority','projectStartFY'=>'Start FY','projectStartDate'=>'Start Date','projectDecription'=>'Description','projectCost'=>'Project Cost','projectStatus'=>'Project Status','projectDeadline'=>'Project Deadline','impProgress'=>'% Progress','createdBy'=>'Author','deleted'=>'Deleted? Dont Change'));
$xcrud->column_pattern('Tasks_Complete', '<div class="progress left progress-striped" rel="tooltip" data-original-title="Stacked Progress" data-placement="top"><div class="progress-bar progress-barX" style="width: {Tasks_Almost_Complete}%"></div><div class="progress-bar progress-bar-success" style="width: {Tasks_Complete}%">{Tasks_Complete}%</div></div>');
$xcrud->column_pattern('SubProgramName', '<a href="#" class="xcrud-action" data-task="view" data-primary="{id}">{value}</a>');
$xcrud->column_pattern('ID', '<a class="btn btn-info btn-xs" href="#X/projectdetails?id={id}&Tasks_Complete={Tasks_Complete}&Tasks_Almost_Complete={Tasks_Almost_Complete}&Code={SubProgramCode}&ProjectName={SubProgramName}">Details</a>');
$xcrud->change_type('projectStartFY','select','','2015/2016,2016/2017,2017/2018,2018/2019,2019/2020');
$xcrud->relation('VoteCode','votes','VoteCode','VoteName','VoteCode<400');
$xcrud->highlight('projectStatus', '=', "Not Started", '#e89e9e');
$xcrud->highlight('projectStatus', '=', "Completed", '#bee89e');
$xcrud->highlight('projectStatus', '=', "Almost Complete", '#E5F2C9');
$xcrud->highlight('projectStatus', '=', "Delayed", '#e2dda0');
$xcrud->highlight('projectStatus', '=', "On Hold", '#e89e9e');
$xcrud->highlight('projectPriority', '=', "Very High", '#C0C5C1');
$xcrud->highlight('projectPriority', '=', "High", '#EAF0CE');
$xcrud->unset_title();
$xcrud->unset_limitlist();
$xcrud->unset_remove();
$xcrud->limit(15);
if ($user->Strategic_Projects < 2) $xcrud->unset_edit();
?>
<style>
    .progress-barX {
        background-color: #e3e4d1;
    }
</style>

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

