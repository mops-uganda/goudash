<?php
$meetid = 0;
$meetname = "Meet Name";

if (isset($_GET['meetid'])) {
    $meetid = $_GET['meetid'];
}
require_once("inc/init.php");
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');


$user = Auth::user();
$username = $user->username;

$xcrud = Xcrud::get_instance();
$tasks = Xcrud::get_instance();
$meetemergingissues = Xcrud::get_instance();
$notes = Xcrud::get_instance();
$files = Xcrud::get_instance();
$activitytimeline = Xcrud::get_instance();

switch ($user->Strategic_Actions){
    case 1:
        $tasks->unset_edit()->unset_add()->unset_remove();
        $notes->unset_edit()->unset_add()->unset_remove();
        $files->unset_edit()->unset_add()->unset_remove();
        $activitytimeline->unset_edit()->unset_add()->unset_remove();
        $meetemergingissues->unset_edit()->unset_add()->unset_remove();
        break;
    case 2:
        $tasks->unset_remove()->unset_add();
        $notes->unset_remove()->unset_add();
        $files->unset_remove()->unset_add();
        $activitytimeline->unset_remove()->unset_add();
        $meetemergingissues->unset_remove()->unset_add();

        break;
    case 3:
        $tasks->unset_remove();
        $notes->unset_remove();
        $files->unset_remove();
        $activitytimeline->unset_remove();
        $meetemergingissues->unset_remove();
        break;
}

$db = Xcrud_db::get_instance();
$sql = 'SELECT meetName, impProgress FROM meetings WHERE meetID = ' . $meetid;
$db->query($sql);
$array = $db->result();
$meetname = $array[0]["meetName"];
$impProgress = 0; $impProgress = $array[0]["impProgress"];



$xcrud->table('meetings');
$xcrud->table_name($meetname);
$xcrud->fields('meetName,meetDecription,meetType,meetFY,meetOrganiser,meetDate,meetTasksDeadline,meetTasksStatus,impProgress');
$xcrud->label(array('meetName' => 'Meet / Event','meetType' => 'Meet Types', 'meetFY' => 'Financial Year', 'meetDate' => 'Meet Date', 'impProgress' => '% Progress', 'meetTasksDeadline' => 'Deadline', 'meetTasksStatus' => 'Status','meetDecription' => 'Description','meetOrganiser' => 'Organised By'));
$xcrud->column_pattern('impProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {impProgress}%">{impProgress}%</div></div>');

$xcrud->unset_list();
$xcrud->unset_title();

$overviewtext = $xcrud->render('view', $meetid);


$tasks->table('meettasks')
    ->where('meetID =', $meetid)
    ->table_name('Strategic Tasks')
    ->pass_default('meetID',$meetid)
    ->pass_var('meetID', $meetid)
    ->columns('meetTaskTitle,assigned_to,start_date,deadline,priority,status,imProgress')
    ->fields('meetTaskTitle,meetTaskDescription,assigned_to,collaborators,start_date,deadline,priority,status,imProgress,meetID')
    ->label(array('meetTaskTitle' => 'Task','meetTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'))
    ->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>')
    ->change_type('priority','select','','Low,Normal,High,Critical')
    ->change_type('status','select','','Not Started,On going,Delayed,Cancelled,Completed')
    ->highlight('status', '=', "Not Started", '#e89e9e')
    ->highlight('status', '=', "Completed", '#bee89e')
    ->highlight('status', '=', "Delayed", '#e2dda0')
    ->unset_title();

$tasksText = "<strong>Strategic Tasks / Undertakings </strong> needed to achieve the Goals of the Strategic Meeting or Event.<br>";
$tasksText = $tasksText . $tasks->render();

$meetemergingissues->table('meetemergingissues')
    ->where('meetID =', $meetid)
    ->table_name('Emerging Issues/Bottlenecks/Risks')
    ->pass_default('meetID',$meetid)
    ->pass_var('meetID', $meetid)
    ->columns('meetEmergingIssue,priority,assigned_to,status,imProgress')
    ->fields('meetEmergingIssue,meetEmergingIssueDetails,priority,meetEmergingIssueMitigation,meetEmergingIssueMitigationCosts,assigned_to,start_date,deadline,status,imProgress,collaborators')
    ->label(array('meetEmergingIssue' => 'Emerging Issue, Bottleneck or Risk','meetEmergingIssueDetails' => 'Details', 'meetEmergingIssueMitigation'=>'Mitigation Actions required', 'meetEmergingIssueMitigationCosts'=>'Costs associated with Mitigation', 'assigned_to' => 'Actions Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'))
    ->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>')
    ->change_type('priority','select','','Low,Normal,High,Critical')
    ->change_type('status','select','','Actions Not Started,Actions Started,Actions On going,Actions Delayed,Actions Cancelled,Actions Completed')
    ->highlight('status', '=', "Actions Not Started", '#e89e9e')
    ->highlight('status', '=', "Actions Completed", '#bee89e')
    ->highlight('status', '=', "Actions Delayed", '#e2dda0')
    ->unset_title();

$meetEmergingIssuesText = "Emerging <strong> Issues, Bottlenecks or Risks </strong> that are likely to impede the achievement Goals of the Strategic Meeting or Event.<br>";
$meetEmergingIssuesText = $meetEmergingIssuesText . $meetemergingissues->render();

$notes->table('meetnotes')
    ->where('meetID =', $meetid)
    ->table_name('Strategic Action Notes')
    ->pass_default('meetID',$meetid)
    ->pass_default('createdBy',$username)
    ->pass_var('meetID', $meetid)
    ->pass_var('createdBy', $username)
    ->columns('createdDate,meetNotesTitle,createdBy')
    ->fields('meetNotesTitle,meetNotesDecription,createdDate,createdBy,meetID')
    ->label(array('meetNotesTitle' => 'Notes','meetNotesDecription' => 'Description', 'createdDate' => 'Date Entered', 'createdBy' => 'Author'))
    ->unset_title();

$notesText = $notes->render();

$files->table('meetfiles')
    ->where('meetID =', $meetid)
    ->table_name('Strategic Action Files')
    ->pass_default('meetID',$meetid)
    ->pass_default('createdBy',$username)
    ->pass_var('meetID', $meetid)
    ->pass_var('createdBy', $username)
    ->columns('createDate,meetFileTxt,meetFilename,createdBy')
    ->fields('meetFileTxt,meetFilename,meetFileDescription,createdBy,createDate,meetID')
    ->change_type('meetFilename', 'file', '', array('not_rename'=>true))
    ->label(array('meetFileTxt' => 'File Information','meetFilename' => 'File Name','meetFileDescription' => 'Description', 'createDate' => 'Date Uploaded', 'createdBy' => 'Author'))
    ->unset_title();

$filesText = $files->render();

$activitytimeline->table('meetactiontimelines')
    ->where('meetID =', $meetid)
    ->order_by('meetActionTimelinesID','desc')
    ->table_name('Activity Timelines')
    ->pass_default('meetID',$meetid)
    ->pass_default('createdBy',$username)
    ->pass_var('meetID', $meetid)
    ->pass_var('createdBy', $username)
    ->columns('meetActionDate,meetActionTitle,meetActionTask,createdBy')
    ->fields('meetActionDate,meetActionTitle,meetActionTask,meetActionDescription,createdBy,meetID')
    ->label(array('meetActionDate' => 'Activity Date','meetActionTitle' => 'Activity','meetActionTask' => 'Task that Activity contributes to', 'meetActionDescription' => 'Description', 'createdBy' => 'Author'))
    ->relation('meetActionTask','meettasks','meetTaskID','meetTaskTitle','meetID={meetID}')
    ->unset_title();

$activitytimelineText = $activitytimeline->render();


?>
<div class="row"><button class="btn btn-success btn-labeled btn-md " onclick="location.href='#X/meetings?=<?php echo mt_rand(5, 500) ?>';"><span class="btn-label"><i class="fa fa-chevron-left"></i></span> Return to List of Strategic Meetings / Events</button><br><br></div>
<div class="row">
    <div class="col-sm-8">
        <h4><?php echo $meetname; ?></h4></div>
    <div class="col-sm-4"><div class="progress left active progress-striped"><div class="progress-bar bg-color-greenLight" style="width: <?php echo $impProgress; ?>%"><?php echo $impProgress; ?>%</div></div></h3></div>
</div>

<?php
// draw tabs
$_ui->start_track();

// smartui code
$tabs = array(
    'Overview' => 'Overview',
    'StrategicTasks' => 'Strategic Tasks / Undertakings',
    'EmergingIssues' => 'Emerging Issues, Bottlenecks or Risks',
    'Notes' => 'Notes',
    'Files' => 'Files',
    'ProjectTimeline' => 'Project Timeline',
);
$tab = $_ui->create_tab($tabs);

$tab->content('Overview', $overviewtext)
    ->icon('Overview', 'fa fa-home')
    ->content('StrategicTasks', $tasksText)
    ->icon('StrategicTasks', 'fa fa-slack')
    ->content('EmergingIssues', $meetEmergingIssuesText)
    ->icon('EmergingIssues', 'fa fa-cube')
    ->content('Notes', $notesText)
    ->icon('Notes', 'fa fa-envelope')
    ->content('Files', $filesText)
    ->icon('Files', 'fa fa-asterisk')
    ->content('ProjectTimeline', $activitytimelineText)
    ->icon('ProjectTimeline', 'fa fa-yelp');

$tab->options('bordered', true)
    ->options('widget', true);
$tab->active('Overview', true);

$tab_html = $tab->print_html(true);

echo $tab_html;
?>


<script language="javascript">
    drawBreadCrumb(["Strategic Meetings or Events", "<?php echo $meetname; ?>"]);
</script>

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

    /*
     * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
     * eg alert("my home function");
     *
     * var pagefunction = function() {
     *   ...
     * }
     * loadScript("js/plugin/_PLUGIN_NAME_.js", pagefunction);
     *
     * TO LOAD A SCRIPT:
     * var pagefunction = function (){
     *  loadScript(".../plugin.js", run_after_loaded);
     * }
     *
     * OR
     *
     * loadScript(".../plugin.js", run_after_loaded);
     */

    // PAGE RELATED SCRIPTS

    // pagefunction

    var pagefunction = function() {
        $('nav').find('a[href$="X/meetings.php"]').parent('li').addClass("active");

    };

    // end pagefunction

    // run pagefunction on load

    pagefunction();

</script>

