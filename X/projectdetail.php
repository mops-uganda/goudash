<?php
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');
require_once("inc/init.php");


$projectid = 0;
$projectname = "Project Name";

if (isset($_GET['projectid'])) {
    $projectid = $_GET['projectid'];
}

$db = Xcrud_db::get_instance();
$sql = 'SELECT projectName, impProgress FROM `projects` WHERE projectID = ' . $projectid;
$db->query($sql);
$array = $db->result();

$projectname = $array[0]["projectName"];
$impProgress = 0; $impProgress = $array[0]["impProgress"];

$user = Auth::user();
$username = $user->username;
$xcrud = Xcrud::get_instance();
$xcrud->table('projects');
$xcrud->table_name($projectname);
$xcrud->fields('projectName,projectType,projectPriority,projectStartFY,projectStartDate,projectDecription,projectLead,projectCost,projectStatus,projectDeadline,impProgress,createdBy,deleted');
$xcrud->label(array('projectName'=>'Project Name','projectType'=>'Project Type','projectPriority'=>'Priority','projectStartFY'=>'Start FY','projectStartDate'=>'Start Date','projectDecription'=>'Description','projectLead'=>'Lead Ministry/Agency','projectCost'=>'Project Cost','projectStatus'=>'Project Status','projectDeadline'=>'Project Deadline','impProgress'=>'% Progress','createdBy'=>'Author','deleted'=>'Deleted? Dont Change'));
$xcrud->column_pattern('impProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {impProgress}%">{impProgress}%</div></div>');
$xcrud->change_type('projectCost', 'price', '', array('prefix'=>'UGX ', 'point'=>'0', 'decimals'=>'0'));
$xcrud->relation('projectLead','votes','VoteCode','VoteName','VoteCode<400');
$xcrud->unset_list();
$xcrud->unset_title();

$overviewtext = $xcrud->render('view', $projectid);

$tasks = Xcrud::get_instance();
$tasks->table('projecttasks');
$tasks->where('projectID =', $projectid);
$tasks->table_name('Strategic Tasks');
$tasks->pass_default('projectID',$projectid);
$tasks->pass_var('projectID', $projectid);
$tasks->columns('projectTaskTitle,assigned_to,start_date,deadline,priority,status,imProgress');
$tasks->fields('projectTaskTitle,projectTaskDescription,assigned_to,collaborators,start_date,deadline,priority,status,imProgress,projectID');
$tasks->label(array('projectTaskTitle' => 'Project Task','projectTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'));
$tasks->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>');
$tasks->change_type('priority','select','','Low,Normal,High,Critical');
$tasks->change_type('status','select','','Not Started,On going,Delayed,Cancelled,Completed');
$tasks->relation('assigned_to','votes','VoteCode','VoteName','VoteCode<400');
$tasks->highlight('status', '=', "Not Started", '#e89e9e');
$tasks->highlight('status', '=', "Completed", '#bee89e');
$tasks->highlight('status', '=', "Delayed", '#e2dda0');
$tasks->unset_title();

$tasksText = "A Project Task is an <strong>Activity</strong> that needs to be accomplished within a <strong>defined period of time or by a deadline</strong> to achieve the Project-related goals.<br>";
$tasksText = $tasksText . $tasks->render();

$notes = Xcrud::get_instance();
$notes->table('projectnotes');
$notes->where('projectID =', $projectid);
$notes->table_name('Strategic Action Notes');
$notes->pass_default('projectID',$projectid);
$notes->pass_default('createdBy',$username);
$notes->pass_var('projectID', $projectid);
$notes->pass_var('createdBy', $username);
$notes->columns('createdDate,projectNotesTitle,createdBy');
$notes->fields('projectNotesTitle,projectNotesDecription,createdDate,createdBy,projectID');
$notes->label(array('projectNotesTitle' => 'Notes','projectNotesDecription' => 'Description', 'createdDate' => 'Date Entered', 'createdBy' => 'Author'));
$notes->unset_title();

$notesText = "<strong>Project Notes</strong> and Information";
$notesText = $notesText . $notes->render();

$files = Xcrud::get_instance();
$files->table('projectfiles');
$files->where('projectID =', $projectid);
$files->table_name('Strategic Action Files');
$files->pass_default('projectID',$projectid);
$files->pass_default('createdBy',$username);
$files->pass_var('projectID', $projectid);
$files->pass_var('createdBy', $username);
$files->columns('createDate,projectFileTxt,projectFilename,createdBy');
$files->fields('projectFileTxt,projectFilename,projectFileDescription,createdBy,createDate,projectID');
$files->change_type('projectFilename', 'file', '', array('not_rename'=>true));
$files->label(array('projectFileTxt' => 'File Information','projectFilename' => 'File Name','projectFileDescription' => 'Description', 'createDate' => 'Date Uploaded', 'createdBy' => 'Author'));
$files->unset_title();

$filesText = "<strong>Project Files</strong> and Documents";
$filesText = $filesText . $files->render();

$projecttimeline = Xcrud::get_instance();
$projecttimeline->table('projectactiontimelines');
$projecttimeline->where('projectID =', $projectid);
$projecttimeline->order_by('projectActionTimelinesID','desc');
$projecttimeline->table_name('Activity Timelines');
$projecttimeline->pass_default('projectID',$projectid);
$projecttimeline->pass_default('createdBy',$username);
$projecttimeline->pass_var('projectID', $projectid);
$projecttimeline->pass_var('createdBy', $username);
$projecttimeline->columns('projectActionDate,projectActionTitle,projectActionTask,createdBy');
$projecttimeline->fields('projectActionDate,projectActionTitle,projectActionTask,projectActionDescription,createdBy,projectID');
$projecttimeline->label(array('projectActionDate' => 'Activity Date','projectActionTitle' => 'Activity','projectActionTask' => 'Task that Project Activity contributes to', 'projectActionDescription' => 'Description', 'createdBy' => 'Author'));
$projecttimeline->relation('projectActionTask','projecttasks','projectTaskID','projectTaskTitle','projectID={projectID}');
$projecttimeline->unset_title();

$projecttimelineText = "<strong>Project activities</strong> and <strong>timelines of events</strong> within te implementation of the Project";
$projecttimelineText = $projecttimelineText . $projecttimeline->render();

$keyoutputsText = "The output may be in the form of a <strong>tangible deliverable, component or product, a document, or an intangible service or result</strong>.";
$keyoutputs = Xcrud::get_instance();
$keyoutputs->table('projectkeyoutputs');
$keyoutputs->where('projectID =', $projectid);
$keyoutputs->table_name('Key Outputs');
$keyoutputs->pass_default('projectID',$projectid);
$keyoutputs->pass_default('createdBy',$username);
$keyoutputs->pass_var('projectID', $projectid);
$keyoutputs->pass_var('createdBy', $username);
$keyoutputs->columns('projectkeyoutputs,target,currentachieved,status,imProgress');
$keyoutputs->fields('projectkeyoutputs,projectkeyoutputsDescription,assigned_to,deadline,baseline,target,currentachieved,reasonsforvariation,status,imProgress,collaborators,projectID,createdBy,deleted');
$keyoutputs->label(array('projectkeyoutputs'=>'Key Output','projectkeyoutputsDescription'=>'Description','assigned_to'=>'Responsible Office','deadline'=>'Deadline','baseline'=>'Baseline state','target'=>'Keyoutput Target','currentachieved'=>'Current Output Achieved','reasonsforvariation'=>'Reasons for Variation','status'=>'Status','imProgress'=>'% Achieved','start_date'=>'Start Date','collaborators'=>'Team to achieve output','createdBy'=>'Author','deleted'=>'Deleted?Do not change'));
$keyoutputs->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>');
$keyoutputs->change_type('status','select','','Not Achieved,On going,Delayed,Partially Achieved,Achieved');
$keyoutputs->highlight('status', '=', "Not Achieved", '#e89e9e');
$keyoutputs->highlight('status', '=', "Achieved", '#bee89e');
$keyoutputs->highlight('status', '=', "Partially Achieved", '#e2dda0');
$keyoutputs->unset_title();

$keyoutputsText = $keyoutputsText . $keyoutputs->render();



$milestonesText = "Milestones are <strong>Checkpoints</strong> throughout the life of the project used in Project Management to mark specific points or stages along a project implementation timeline.";

$milestones = Xcrud::get_instance();
$milestones->table('projectmilestones');
$milestones->where('projectID =', $projectid);
$milestones->table_name('Milestones');
$milestones->pass_default('projectID',$projectid);
$milestones->pass_default('createdBy',$username);
$milestones->pass_var('projectID', $projectid);
$milestones->pass_var('createdBy', $username);
$milestones->columns('projectmilestone,currentachieved,status,imProgress');
$milestones->fields('projectmilestone,projectmilestoneDescription,assigned_to,deadline,currentachieved,reasonsforvariation,status,imProgress,collaborators,projectID,createdBy,deleted');
$milestones->label(array('projectmilestone'=>'Milestone','projectmilestoneDescription'=>'Description','assigned_to'=>'Responsible Office','deadline'=>'Deadline','currentachieved'=>'Current Achieved','reasonsforvariation'=>'Reasons for Variation','status'=>'Status','imProgress'=>'% Achieved','start_date'=>'Start Date','collaborators'=>'Team to achieve Milestone','createdBy'=>'Author','deleted'=>'Deleted?Do not change'));
$milestones->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>');
$milestones->change_type('status','select','','Not Achieved,On going,Delayed,Partially Achieved,Achieved');
$milestones->unset_title();

$milestonesText = $milestonesText . $milestones->render();

$kpisText = "Key Performance Indicators <strong>KPIs</strong> are <strong>measurable values</strong> that demonstrate if the Project is achieving its design objectives.";
$kpis = Xcrud::get_instance();
$kpis->table('projectkpis');
$kpis->where('projectID =', $projectid);
$kpis->table_name('Key Performance Indicators');
$kpis->pass_default('projectID',$projectid);
$kpis->pass_default('createdBy',$username);
$kpis->pass_var('projectID', $projectid);
$kpis->pass_var('createdBy', $username);
$kpis->columns('KeyIndicatorName, target, currentachieved, status, imProgress');
$kpis->fields('KeyIndicatorName, Indicator_Measure, MethodofMeasurement, SourceofData, Indicator_Type, deadline, baseline, target, currentachieved, reasonsforvariation, status, imProgress, collaborators, deleted, projectID, createdBy, deleted');
$kpis->label(array('KeyIndicatorName'=>'Key Performance Indicator', 'Indicator_Measure'=>'Indicator Measure', 'MethodofMeasurement'=>'Method of Measurement', 'SourceofData'=>'Source of Data', 'Indicator_Type'=>'Indicator Type', 'deadline'=>'Deadline to achieve', 'baseline'=>'Baseline', 'target'=>'Target', 'currentachieved'=>'Current Achieved', 'reasonsforvariation'=>'Reason for Variation', 'status'=>'Status', 'imProgress'=>'% Achieved', 'collaborators'=>'Partners to achieve KPI', 'deleted'=>'Active? Do not change', 'projectID'=>'Project ID', 'createdBy'=>'Author'));
$kpis->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>');
$kpis->change_type('status','select','','Not Achieved,On going,Delayed,Partially Achieved,Achieved');
$kpis->change_type('Indicator_Measure','select','','Quantity,Efficiency,Quality');
$kpis->change_type('Indicator_Type','select','','Number,Percentage,Yes/No,Good/Fair/Poor,High/Medium/Low,Ratio,Text,Value (Shs Bns),Policy Process,Rate,Time,Process,Value,Legislative Process,Stages');
$kpis->highlight('status', '=', "Not Achieved", '#e89e9e');
$kpis->highlight('status', '=', "Achieved", '#bee89e');
$kpis->highlight('status', '=', "Partially Achieved", '#e2dda0');
$kpis->unset_title();

$kpisText = $kpisText . $kpis->render();


$gallery = Xcrud::get_instance();
$gallery->table('projectgallery');
$gallery->where('projectID =', $projectid);
$gallery->table_name('Project Image');
$gallery->pass_default('projectID',$projectid);
$gallery->pass_default('createdBy',$username);
$gallery->pass_var('projectID', $projectid);
$gallery->pass_var('createdBy', $username);
$gallery->columns('projectimage,projectimageTitle,createdDate');
$gallery->fields('projectimage,projectimageTitle,projectimageDecription,createdDate,createdBy,projectID');
$gallery->label(array('projectimage'=>'Project Image', 'projectimageTitle' => 'Title / Caption','projectimageDecription' => 'Description', 'createdDate' => 'Date Entered', 'createdBy' => 'Author'));
$gallery->change_type('projectimage', 'image', false, array(
    'width' => 450,
    'path' => '../uploads/gallery',
    'thumbs' => array(array(
        'height' => 55,
        'width' => 120,
        'crop' => true,
        'marker' => '_th'))));
$gallery->unset_title();

$galleryText = "<strong>Project Gallery</strong> and Images";
$galleryText = $galleryText . $gallery->render();

?>
<div class="row"><button class="btn btn-success btn-labeled btn-md " onclick="location.href='#X/projects.php';"><span class="btn-label"><i class="fa fa-chevron-left"></i></span> Return to List of Strategic Projects</button><br><br></div>
<div class="row">
    <div class="col-sm-8">
        <h4><?php echo $projectname; ?></h4></div>
    <div class="col-sm-4"><div class="progress left active progress-striped"><div class="progress-bar bg-color-greenLight" style="width: <?php echo $impProgress; ?>%"><?php echo $impProgress; ?>%</div></div></h3></div>
</div>

<?php
// draw tabs
$ui = new SmartUI;
$ui->start_track();
$tab_widget = $ui->create_tab(array('Overview', 'Project Tasks', 'Key Outputs', 'Milestones', 'Key Performance Indicators', 'Notes', 'Files', 'Project Timeline', 'Gallery'));
$tab_widget->content(0, $overviewtext);
$tab_widget->active(0, true);
$tab_widget->icon(0, 'fa fa-home');
$tab_widget->content(1, $tasksText);
$tab_widget->icon(1, 'fa fa-slack');
$tab_widget->content(2, $keyoutputsText);
$tab_widget->icon(2, 'fa fa-cube');
$tab_widget->content(3, $milestonesText);
$tab_widget->icon(3, 'fa fa-reorder');
$tab_widget->content(4, $kpisText);
$tab_widget->icon(4, 'fa fa-bar-chart-o');
$tab_widget->content(5, $notesText);
$tab_widget->icon(5, 'fa fa-envelope');
$tab_widget->content(6, $filesText);
$tab_widget->icon(6, 'fa fa-asterisk');
$tab_widget->content(7, $projecttimelineText);
$tab_widget->icon(7, 'fa fa-yelp');
$tab_widget->content(8, $galleryText);
$tab_widget->icon(8, 'fa fa-picture-o');

$tab_widget->options('widget', true)->options('pull', 'left');
$tab_widget_html = $tab_widget->print_html(true);

echo $tab_widget_html;


?>



<script language="javascript">
    drawBreadCrumb(["Strategic Projects", "<?php echo $projectname; ?>"]);
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
        $('nav').find('a[href$="X/projects.php"]').parent('li').addClass("active");

    };

    // end pagefunction

    // run pagefunction on load

    pagefunction();

</script>
