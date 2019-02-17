<?php
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


<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-magenta" id="wid-id-3" data-widget-sortable="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-bar-chart"></i> </span>
                    <h2>Political Verification of Self Performance Inspection</h2>

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
                        <strong>Political Verification of Self Performance Inspection</strong>  The Political Leadership will verify the self assessment scores of the Technical Wing by conducting their own assessment of their MDA/LG.
                        <br><br><p><strong>General Criteria for assessing performance:</strong></p>
                        <strong>1 = Poor</strong> Very Unsatisfactory (Not available or Available, but not accessible) - > (Below 40%)
                        <br><strong>2 = Fair</strong> Unsatisfactory (Inadequate or Not up to required standard / Not satisfactory) - > (41% - 60%)
                        <br><strong>3 = Good</strong> Satisfactory (Adequate / Up to required standard / Satisfactory) - > (61% - 80%)
                        <br><strong>4 = Very Good</strong> Very Adequate / Very Satisfactory - > (81% - 90%)
                        <br><strong>5 = Excellent</strong> Exceeds Requirement - > (91% - 100%)
                        <?php
                        if ($counter){
                            $data = Xcrud::get_instance();
                            $data->table('performance_scores');
                            $data->table_name('Performance Scores for Vote: ' . $user->country_id . ' - ' . $VoteName);
                            $data->join('performance_question','performance_questions','sub_section_ID');
                            $data->columns('performance_question,performance_questions.sub_section,performance_questions.section,self_score,political_score');
                            $data->fields('performance_questions.sub_section,performance_questions.section,political_score,political_comments');
                            $data->relation('self_score','performace_scores_list','score','description');
                            $data->relation('political_score','performace_scores_list','score','description');
                            $data->relation('RDC_score','performace_scores_list','score','description');
                            $data->relation('Inspection_Team_score','performace_scores_list','score','description');
                            $data->highlight('self_score', '=', 1, '#e89e9e');
                            $data->highlight('self_score', '=', 2, '#FADBD8');
                            $data->highlight('self_score', '=', 3, '#e2dda0');
                            $data->highlight('self_score', '=', 4, '#5DADE2');
                            $data->highlight('self_score', '=', 5, '#2ECC71');
                            $data->highlight('political_score', '=', 1, '#e89e9e');
                            $data->highlight('political_score', '=', 2, '#FADBD8');
                            $data->highlight('political_score', '=', 3, '#e2dda0');
                            $data->highlight('political_score', '=', 4, '#5DADE2');
                            $data->highlight('political_score', '=', 5, '#2ECC71');

                            $data->label(array('performance_question' => 'Qn ID','performance_questions.sub_section' => 'Performance Question','meetTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'));
                            $data->unset_add();
                            $data->unset_remove();
                            echo $data->render();

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
