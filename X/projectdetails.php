<?php
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');
require_once("inc/init.php");


$user = Auth::user();
$username = $user->username;

$projectid = 0;
$projectCode = '0000';
$projectname = "Project Name";

if (isset($_GET['id'])) {
    $projectid = $_GET['id'];
}
if (isset($_GET['Code'])) {
    $projectCode = $_GET['Code'];
}
if (isset($_GET['ProjectName'])) {
    $projectname = $_GET['ProjectName'];
}
$Tasks_Almost_Complete = 0;
if (isset($_GET['Tasks_Almost_Complete'])) {
    $Tasks_Almost_Complete = $_GET['Tasks_Almost_Complete'];
}

$Tasks_Complete = 0;
if (isset($_GET['Tasks_Complete'])) {
    $Tasks_Complete = $_GET['Tasks_Complete'];
}

$xcrud = Xcrud::get_instance();
$tasks = Xcrud::get_instance();
$keyoutputs = Xcrud::get_instance();
$milestones = Xcrud::get_instance();
$outcome_kpis = Xcrud::get_instance();
$kpis = Xcrud::get_instance();
$notes = Xcrud::get_instance();
$files = Xcrud::get_instance();
$projecttimeline = Xcrud::get_instance();
$gallery = Xcrud::get_instance();

switch ($user->Strategic_Projects){
    case 1:
        $keyoutputs->unset_edit()->unset_add()->unset_remove();
        $tasks->unset_edit()->unset_add()->unset_remove();
        $milestones->unset_edit()->unset_add()->unset_remove();
        $outcome_kpis->unset_edit()->unset_add()->unset_remove();
        $kpis->unset_edit()->unset_add()->unset_remove();
        $notes->unset_edit()->unset_add()->unset_remove();
        $files->unset_edit()->unset_add()->unset_remove();
        $projecttimeline->unset_edit()->unset_add()->unset_remove();
        $gallery->unset_edit()->unset_add()->unset_remove();
        break;
    case 2:
        $keyoutputs->unset_remove()->unset_add();
        $tasks->unset_remove(); $tasks->unset_add();
        $milestones->unset_remove()->unset_add();
        $outcome_kpis->unset_remove()->unset_add();
        $kpis->unset_remove()->unset_add();
        $notes->unset_remove()->unset_add();
        $files->unset_remove()->unset_add();
        $projecttimeline->unset_remove()->unset_add();
        $gallery->unset_remove()->unset_add();
        break;
    case 3:
        $keyoutputs->unset_remove();
        $tasks->unset_remove();
        $milestones->unset_remove();
        $outcome_kpis->unset_remove();
        $kpis->unset_remove();
        $notes->unset_remove();
        $files->unset_remove();
        $projecttimeline->unset_remove();
        $gallery->unset_remove();
        break;
}

$xcrud->table('subprogrammes')
        ->join('VoteCode','votes','VoteCode')
        ->table_name($projectname)
        ->fields('SubProgramName,projectType,projectPriority,projectDecription,VoteCode,ResponsibleOfficers,ProjectObjectives,ProjectOutputs,projectCost,projectStatus,projectStartFY,projectStartDate,projectDeadline,Tasks_Complete,createdBy')
        ->label(array('SubProgramName'=>'Project Name','ResponsibleOfficers'=>'Responsible Officer','ProjectObjectives'=>'Project Objectives','ProjectOutputs'=>'Project Outputs','projectType'=>'Project Type','projectPriority'=>'Priority','projectStartFY'=>'Start FY','projectStartDate'=>'Start Date','projectDecription'=>'Description','VoteCode'=>'Lead Ministry/Agency','projectCost'=>'Project Cost','projectStatus'=>'Project Status','projectDeadline'=>'Project Deadline','impProgress'=>'% Progress','createdBy'=>'Author','deleted'=>'Deleted? Dont Change'))
        ->column_pattern('Tasks_Complete', '<div class="progress left progress-striped" rel="tooltip" data-original-title="Stacked Progress" data-placement="top"><div class="progress-bar progress-barX" style="width: {Tasks_Almost_Complete}%"></div><div class="progress-bar progress-bar-success" style="width: {Tasks_Complete}%">{Tasks_Complete}%</div></div>')
        ->relation('VoteCode','votes','VoteCode','VoteName','VoteCode<400')
        ->unset_list()
        ->unset_title();
$overviewtext = $xcrud->render('view', $projectid);


$tasks->table('projecttasks')
    ->where('projectID =', $projectid)
    ->table_name('Strategic Tasks')
    ->pass_default('projectID',$projectid)
    ->pass_var('projectID', $projectid)
    ->pass_default('projectCode',$projectCode)
    ->pass_var('projectCode', $projectCode)
    ->columns('projectTaskTitle,Output_It_Contributes_To,assigned_to,start_date,deadline,priority,status,imProgress')
    ->fields('projectTaskTitle,Output_It_Contributes_To,projectTaskDescription,assigned_to,collaborators,start_date,deadline,priority,status,imProgress')
    ->label(array('projectTaskTitle' => 'Project Task','projectTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'))
    ->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>')
    ->change_type('priority','select','','Low,Normal,High,Critical')
    ->change_type('status','select','','Not Started,On going,Delayed,Cancelled,Completed')
    ->relation('Output_It_Contributes_To','projectkeyoutputs','projectkeyoutputsID','projectkeyoutputs','projectCode='.$projectCode)
    ->relation('assigned_to','votes','VoteCode','VoteName','VoteCode<400')
    ->highlight('status', '=', "Not Started", '#e89e9e')
    ->highlight('status', '=', "Delayed", '#E3B23C')
    ->highlight('status', '=', "Completed", '#bee89e')
    ->highlight('status', '=', "Partially Achieved", '#e2dda0')
    ->unset_title()
    ->unset_limitlist();

$tasksText = "A Project Task is an <strong>Activity</strong> that needs to be accomplished within a <strong>defined period of time or by a deadline</strong> to achieve the Project-related goals.<br>";
$tasksText = $tasksText . $tasks->render();

$keyoutputsText = "The output may be in the form of a <strong>tangible deliverable, component or product, a document, or an intangible service or result</strong>.";

$keyoutputs->table('projectkeyoutputs')
    ->where('projectID =', $projectid)
    ->table_name('Key Outputs')
    ->pass_default('projectID',$projectid)
    ->pass_default('createdBy',$username)
    ->pass_var('projectID', $projectid)
    ->pass_var('createdBy', $username)
    ->pass_default('projectCode',$projectCode)
    ->pass_var('projectCode', $projectCode)
    ->columns('projectkeyoutputs,target,currentachieved,status,imProgress')
    ->fields('projectkeyoutputs,projectkeyoutputsDescription,assigned_to,deadline,baseline,target,currentachieved,reasonsforvariation,status,imProgress,collaborators,projectID,createdBy,deleted')
    ->fields('projectID,createdBy,deleted')
    ->label(array('projectkeyoutputs'=>'Key Output','projectkeyoutputsDescription'=>'Description','assigned_to'=>'Responsible Office','deadline'=>'Deadline','baseline'=>'Baseline state','target'=>'Keyoutput Target','currentachieved'=>'Current Output Achieved','reasonsforvariation'=>'Reasons for Variation','status'=>'Status','imProgress'=>'% Achieved','start_date'=>'Start Date','collaborators'=>'Team to achieve output','createdBy'=>'Author','deleted'=>'Deleted?Do not change'))
    ->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>')
    ->change_type('status','select','','Not Achieved,On going,Delayed,Partially Achieved,Achieved')
    ->highlight('status', '=', "Not Achieved", '#e89e9e')
    ->highlight('status', '=', "Delayed", '#E3B23C')
    ->highlight('status', '=', "Achieved", '#bee89e')
    ->highlight('status', '=', "Partially Achieved", '#e2dda0')
    ->unset_title()
    ->unset_limitlist();

$keyoutputsText = $keyoutputsText . $keyoutputs->render();


$milestonesText = "Milestones are <strong>Checkpoints</strong> throughout the life of the project used in Project Management to mark specific points or stages along a project implementation timeline.";

$milestones->table('projectmilestones')
    ->where('projectID =', $projectid)
    ->table_name('Milestones')
    ->pass_default('projectID',$projectid)
    ->pass_default('createdBy',$username)
    ->pass_var('projectID', $projectid)
    ->pass_var('createdBy', $username)
    ->pass_default('projectCode',$projectCode)
    ->pass_var('projectCode', $projectCode)
    ->columns('projectmilestone,currentachieved,status,imProgress')
    ->fields('projectmilestone,projectmilestoneDescription,assigned_to,deadline,currentachieved,reasonsforvariation,status,imProgress,collaborators,projectID,projectCode,createdBy,deleted')
    ->label(array('projectmilestone'=>'Milestone','projectmilestoneDescription'=>'Description','assigned_to'=>'Responsible Office','deadline'=>'Deadline','currentachieved'=>'Current Achieved','reasonsforvariation'=>'Reasons for Variation','status'=>'Status','imProgress'=>'% Achieved','start_date'=>'Start Date','collaborators'=>'Team to achieve Milestone','createdBy'=>'Author','deleted'=>'Deleted?Do not change'))
    ->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>')
    ->change_type('status','select','','Not Achieved,On going,Delayed,Partially Achieved,Achieved')
    ->highlight('status', '=', "Not Achieved", '#e89e9e')
    ->highlight('status', '=', "Delayed", '#E3B23C')
    ->highlight('status', '=', "Achieved", '#bee89e')
    ->highlight('status', '=', "Partially Achieved", '#e2dda0')
    ->unset_title()
    ->unset_limitlist();

$milestonesText = $milestonesText . $milestones->render();

$kpisText = "Key Performance Indicators <strong>KPIs</strong> are <strong>measurable values</strong> that demonstrate if the Project is achieving its design objectives.";
$kpisText = $kpisText . "<br><br><strong>Note: </strong>There are Two (2)  types of Key Performance Indicators <strong>1: Outcome KPIs</strong> and <strong>2: Output KPIs</strong>. Please the Performance of the KPIs below.";

$outcome_kpis->table('projectoutcomekpis')
    ->where('projectID =', $projectid)
    ->table_name('1: Outcome Key Performance Indicators')
    ->pass_default('projectID',$projectid)
    ->pass_default('createdBy',$username)
    ->pass_var('projectID', $projectid)
    ->pass_var('createdBy', $username)
    ->pass_default('projectCode',$projectCode)
    ->pass_var('projectCode', $projectCode)
    ->columns('KeyIndicatorName, target, currentachieved, status, imProgress')
    ->fields('KeyIndicatorName, Indicator_Measure, MethodofMeasurement,Frequency_of_Verification, SourceofData, Indicator_Type, deadline, baseline, target, currentachieved, reasonsforvariation, status, imProgress, collaborators,Assumptions,Risks,createdBy')
    ->label(array('KeyIndicatorName'=>'Key Performance Indicator', 'Indicator_Measure'=>'Indicator Measure', 'MethodofMeasurement'=>'Method of Measurement', 'SourceofData'=>'Source of Data', 'Indicator_Type'=>'Indicator Type', 'deadline'=>'Deadline to achieve', 'baseline'=>'Baseline', 'target'=>'Target', 'currentachieved'=>'Current Achieved', 'reasonsforvariation'=>'Reason for Variation', 'status'=>'Status', 'imProgress'=>'% Achieved', 'collaborators'=>'Partners to achieve KPI', 'deleted'=>'Active? Do not change', 'projectID'=>'Project ID', 'createdBy'=>'Author'))
    ->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>')
    ->change_type('status','select','','Not Achieved,On going,Delayed,Partially Achieved,Achieved')
    ->change_type('Indicator_Measure','select','','Quantity,Efficiency,Quality')
    ->change_type('Indicator_Type','select','','Number,Percentage,Yes/No,Good/Fair/Poor,High/Medium/Low,Ratio,Text,Value (Shs Bns),Policy Process,Rate,Time,Process,Value,Legislative Process,Stages')
    ->highlight('status', '=', "Not Achieved", '#e89e9e')
    ->highlight('status', '=', "Delayed", '#E3B23C')
    ->highlight('status', '=', "Achieved", '#bee89e')
    ->highlight('status', '=', "Partially Achieved", '#e2dda0')
    ->unset_limitlist();

$kpis->table('projectkpis')
    ->where('projectID =', $projectid)
    ->table_name('2: Output Key Performance Indicators')
    ->pass_default('projectID',$projectid)
    ->pass_default('createdBy',$username)
    ->pass_var('projectID', $projectid)
    ->pass_var('createdBy', $username)
    ->pass_default('projectCode',$projectCode)
    ->pass_var('projectCode', $projectCode)
    ->columns('KeyIndicatorName,Output_It_Contributes_To, target, currentachieved, status, imProgress')
    ->fields('KeyIndicatorName,Output_It_Contributes_To, Indicator_Measure, MethodofMeasurement, SourceofData, Indicator_Type, deadline, baseline, target, currentachieved, reasonsforvariation, status, imProgress, collaborators, deleted, projectID, createdBy, deleted')
    ->label(array('KeyIndicatorName'=>'Key Performance Indicator', 'Indicator_Measure'=>'Indicator Measure', 'MethodofMeasurement'=>'Method of Measurement', 'SourceofData'=>'Source of Data', 'Indicator_Type'=>'Indicator Type', 'deadline'=>'Deadline to achieve', 'baseline'=>'Baseline', 'target'=>'Target', 'currentachieved'=>'Current Achieved', 'reasonsforvariation'=>'Reason for Variation', 'status'=>'Status', 'imProgress'=>'% Achieved', 'collaborators'=>'Partners to achieve KPI', 'deleted'=>'Active? Do not change', 'projectID'=>'Project ID', 'createdBy'=>'Author'))
    ->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>')
    ->change_type('status','select','','Not Achieved,On going,Delayed,Partially Achieved,Achieved')
    ->change_type('Indicator_Measure','select','','Quantity,Efficiency,Quality')
    ->change_type('Indicator_Type','select','','Number,Percentage,Yes/No,Good/Fair/Poor,High/Medium/Low,Ratio,Text,Value (Shs Bns),Policy Process,Rate,Time,Process,Value,Legislative Process,Stages')
    ->relation('Output_It_Contributes_To','projectkeyoutputs','projectkeyoutputsID','projectkeyoutputs','projectCode='.$projectCode)
    ->highlight('status', '=', "Not Achieved", '#e89e9e')
    ->highlight('status', '=', "Delayed", '#E3B23C')
    ->highlight('status', '=', "Achieved", '#bee89e')
    ->highlight('status', '=', "Partially Achieved", '#e2dda0')
    ->unset_limitlist();

$kpisText = $kpisText . $outcome_kpis->render() . $kpis->render();

$notes->table('projectnotes')
    ->where('projectID =', $projectid)
    ->table_name('Strategic Action Notes')
    ->pass_default('projectID',$projectid)
    ->pass_default('createdBy',$username)
    ->pass_var('projectID', $projectid)
    ->pass_var('createdBy', $username)
    ->pass_default('projectCode',$projectCode)
    ->pass_var('projectCode', $projectCode)
    ->columns('createdDate,projectNotesTitle,createdBy')
    ->fields('projectNotesTitle,projectNotesDecription,createdDate,createdBy,projectID')
    ->label(array('projectNotesTitle' => 'Notes','projectNotesDecription' => 'Description', 'createdDate' => 'Date Entered', 'createdBy' => 'Author'))
    ->unset_title()
    ->unset_limitlist();


$notesText = "<strong>Project Notes</strong> and Information";
$notesText = $notesText . $notes->render();

$files->table('projectfiles')
    ->where('projectID =', $projectid)
    ->table_name('Strategic Action Files')
    ->pass_default('projectID',$projectid)
    ->pass_default('createdBy',$username)
    ->pass_var('projectID', $projectid)
    ->pass_var('createdBy', $username)
    ->pass_default('projectCode',$projectCode)
    ->pass_var('projectCode', $projectCode)
    ->columns('createDate,projectFileTxt,projectFilename,createdBy')
    ->fields('projectFileTxt,projectFilename,projectFileDescription,createdBy,createDate,projectID')
    ->change_type('projectFilename', 'file', '', array('not_rename'=>true))
    ->label(array('projectFileTxt' => 'File Information','projectFilename' => 'File Name','projectFileDescription' => 'Description', 'createDate' => 'Date Uploaded', 'createdBy' => 'Author'))
    ->unset_title()
    ->unset_limitlist();

$filesText = "<strong>Project Files</strong> and Documents";
$filesText = $filesText . $files->render();

$projecttimeline->table('projectactiontimelines')
    ->where('projectID =', $projectid)
    ->order_by('projectActionTimelinesID','desc')
    ->table_name('Activity Timelines')
    ->pass_default('projectID',$projectid)
    ->pass_default('createdBy',$username)
    ->pass_var('projectID', $projectid)
    ->pass_var('createdBy', $username)
    ->pass_default('projectCode',$projectCode)
    ->pass_var('projectCode', $projectCode)
    ->columns('projectActionDate,projectActionTitle,projectActionTask,createdBy')
    ->fields('projectActionDate,projectActionTitle,projectActionTask,projectActionDescription,createdBy,projectID')
    ->label(array('projectActionDate' => 'Activity Date','projectActionTitle' => 'Activity','projectActionTask' => 'Task that Project Activity contributes to', 'projectActionDescription' => 'Description', 'createdBy' => 'Author'))
    ->relation('projectActionTask','projecttasks','projectTaskID','projectTaskTitle','projectID={projectID}')
    ->unset_title()
    ->unset_limitlist();

$projecttimelineText = "<strong>Project activities</strong> and <strong>timelines of events</strong> within te implementation of the Project";
$projecttimelineText = $projecttimelineText . $projecttimeline->render();


$gallery->table('projectgallery')
    ->where('projectID =', $projectid)
    ->table_name('Project Image')
    ->pass_default('projectID',$projectid)
    ->pass_default('createdBy',$username)
    ->pass_var('projectID', $projectid)
    ->pass_var('createdBy', $username)
    ->pass_default('projectCode',$projectCode)
    ->pass_var('projectCode', $projectCode)
    ->columns('projectimage,projectimageTitle,createdDate')
    ->fields('projectimage,projectimageTitle,projectimageDecription,createdDate,createdBy,projectID')
    ->label(array('projectimage'=>'Project Image', 'projectimageTitle' => 'Title / Caption','projectimageDecription' => 'Description', 'createdDate' => 'Date Entered', 'createdBy' => 'Author'))
    ->change_type('projectimage', 'image', false, array(
        'width' => 450,
        'path' => '../uploads/gallery',
        'thumbs' => array(array(
            'height' => 55,
            'width' => 120,
            'crop' => true,
            'marker' => '_th'))))
    ->unset_title()
    ->unset_limitlist();

$galleryText = "<strong>Project Gallery</strong> and Images";
$galleryText = $galleryText . $gallery->render();

$return_url = 'projects';
$return_page = 'Strategic';
if (isset($_GET['Refferer'])) {
    $return_url = 'govtprojects';
    $return_page = 'All';
}


?>
<style>
    .progress-barX {
        background-color: #e3e4d1;
    }
</style>

<div class="row"><button class="btn btn-success btn-labeled btn-md " onclick="location.href='#X/<?php echo($return_url); ?>.php';"><span class="btn-label"><i class="fa fa-chevron-left"></i></span> Return to List of <?php echo($return_page); ?> Projects</button><br><br></div>
<div class="row">
    <div class="col-sm-8">
        <h4><?php echo $projectCode . ': ' . $projectname; ?></h4></div>
    <div class="col-sm-4"><div class="progress left progress-striped" rel="tooltip" data-original-title="Stacked Progress" data-placement="top"><div class="progress-bar progress-barX" style="width: <?php echo $Tasks_Almost_Complete; ?>%"></div><div class="progress-bar progress-bar-success" style="width: <?php echo $Tasks_Complete; ?>%"><?php echo $Tasks_Complete; ?>%</div></div></div>
</div>

<?php
$_ui->start_track();

// smartui code
$tabs = array(
    'Overview' => 'Overview',
    'KeyOutputs' => 'Key Outputs',
    'ProjectTasks' => 'Project Tasks',
    'Milestones' => 'Milestones',
    'KeyPerformanceIndicators' => 'Key Performance Indicators',
    'Notes' => 'Notes',
    'Files' => 'Files',
    'ProjectTimeline' => 'Project Timeline',
    'Gallery' => 'Gallery'
);
$tab = $_ui->create_tab($tabs);

$tab->content('Overview', $overviewtext)
    ->icon('Overview', 'fa fa-home')
    ->content('KeyOutputs', $keyoutputsText)
    ->icon('KeyOutputs', 'fa fa-slack')
    ->content('ProjectTasks', $tasksText)
    ->icon('ProjectTasks', 'fa fa-cube')
    ->content('Milestones', $milestonesText)
    ->icon('Milestones', 'fa fa-reorder')
    ->content('KeyPerformanceIndicators', $kpisText)
    ->icon('KeyPerformanceIndicators', 'fa fa-bar-chart-o')
    ->content('Notes', $notesText)
    ->icon('Notes', 'fa fa-envelope')
    ->content('Files', $filesText)
    ->icon('Files', 'fa fa-asterisk')
    ->content('ProjectTimeline', $projecttimelineText)
    ->icon('ProjectTimeline', 'fa fa-yelp')
    ->content('Gallery', $galleryText)
    ->icon('Gallery', 'fa fa-picture-o');

$tab->options('bordered', true)
    ->options('widget', true);
$tab->active('Overview', true);

$tab_html = $tab->print_html(true);

echo $tab_html;
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
