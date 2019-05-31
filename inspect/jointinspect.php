<?php
session_start();
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');

$user = Auth::user();

$db = Xcrud_db::get_instance();
$sql = 'SELECT COUNT(*) AS counter FROM performance_scores WHERE vote = "' . $user->country_id . '" AND FY = "2019/2020"';
$db->query($sql);
$counter = $db->row()["counter"];

$db->query('SELECT `VoteName` FROM `votes` WHERE VoteCode = "' . $user->country_id .'"');
$VoteName = $db->row()["VoteName"];


?>
<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">


<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-red" id="wid-id-3" data-widget-sortable="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-bar-chart"></i> </span>
                    <h2>Joint Inspection Team Scorecard</h2>

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
                        <strong>Joint Inspection Team Scorecard</strong>  The Joint Inspection Team will score their own scores based on sampling MDAs/LGs and reviewing by both the technical and political scores.
                        <br><br><p><strong>General Criteria for assessing performance:</strong></p>
                        <strong>1 = Poor</strong> Very Unsatisfactory (Not available or Available, but not accessible) - > (Below 40%)
                        <br><strong>2 = Fair</strong> Unsatisfactory (Inadequate or Not up to required standard / Not satisfactory) - > (41% - 60%)
                        <br><strong>3 = Good</strong> Satisfactory (Adequate / Up to required standard / Satisfactory) - > (61% - 80%)
                        <br><strong>4 = Very Good</strong> Very Adequate / Very Satisfactory - > (81% - 90%)
                        <br><strong>5 = Excellent</strong> Exceeds Requirement - > (91% - 100%)
                        <?php
                        if ($counter){
                            $data = Xcrud::get_instance();
                            $data   ->table('performance_scores')
                                    ->table_name('Performance Scores for Vote: ' . $user->country_id . ' - ' . $VoteName)
                                    ->join('performance_question','performance_questions','sub_section_ID')
                                    ->columns('performance_question,performance_questions.sub_section,performance_questions.section,self_score,political_score,Inspection_Team_score')
                                    ->fields('performance_questions.sub_section,performance_questions.section,Inspection_Team_score,Inspection_Team_comments')
                                    ->relation('self_score','performace_scores_list','score','description')
                                    ->relation('political_score','performace_scores_list','score','description')
                                    ->relation('RDC_score','performace_scores_list','score','description')
                                    ->relation('Inspection_Team_score','performace_scores_list','score','description')
                                    ->highlight('self_score', '=', 1, '#e89e9e')
                                    ->highlight('self_score', '=', 2, '#FADBD8')
                                    ->highlight('self_score', '=', 3, '#e2dda0')
                                    ->highlight('self_score', '=', 4, '#5DADE2')
                                    ->highlight('self_score', '=', 5, '#2ECC71')
                                    ->highlight('political_score', '=', 1, '#e89e9e')
                                    ->highlight('political_score', '=', 2, '#FADBD8')
                                    ->highlight('political_score', '=', 3, '#e2dda0')
                                    ->highlight('political_score', '=', 4, '#5DADE2')
                                    ->highlight('political_score', '=', 5, '#2ECC71')
                                    ->highlight('Inspection_Team_score', '=', 1, '#e89e9e')
                                    ->highlight('Inspection_Team_score', '=', 2, '#FADBD8')
                                    ->highlight('Inspection_Team_score', '=', 3, '#e2dda0')
                                    ->highlight('Inspection_Team_score', '=', 4, '#5DADE2')
                                    ->highlight('Inspection_Team_score', '=', 5, '#2ECC71')
                                    ->label(array('performance_question' => 'Qn ID','performance_questions.sub_section' => 'Performance Question','meetTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'))
                                    ->unset_add()
                                    ->unset_remove();
                            echo $data->render();
                            include "xcrud_js.php";

                        }else{
                            ?>
                            <br><br><div class="btn btn-warning btn-lg btn-block">
                                <i class="fa fa-upload"></i>
                                Inspection not yet commenced for <?php echo $user->country_id . " - " . $VoteName; ?> > Please ask your Technical Team to commence and carry out their self assessment.
                            </div>
                            <?php
                        }

                        //echo $counter;
                        //echo $PerformanceQuestions->render();
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
