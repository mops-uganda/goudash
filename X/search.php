<?php
    use \SmartUI\Util as SmartUtil;
    use \Common\HTMLIndent;

    //initilize the page
    require_once 'inc/init.php';

    //Get search parameters
    $reportid = 100;

    if (isset($_GET['id'])) {
        $reportid = $_GET['id'];
    }

    $query = '';

    if (isset($_GET['q'])) {
        $query = $_GET['q'];
    }

    //Start to query search results
    require ('../lib/xcrud/xcrud.php');
    $data = Xcrud::get_instance();
    $data->table('reports')
            ->where('ReportTitle LIKE "%' . $query . '%" OR ReportDescription LIKE "%' . $query . '%"')
            ->columns('rid,ReportTitle,itemsList,reportCategory')
            ->fields('rid,ReportTitle,itemsList,reportCategory,ReportDescription')
            ->column_pattern('itemsList', '<a class="btn btn-info btn-xs" href="#X/{link}?id={rid}"><i class="fa fa-external-link "></i> View Report</a>')
            ->column_pattern('ReportTitle', '<a href="#" class="xcrud-action" data-task="view" data-primary="{rid}">{value}</a>')
            ->column_cut(70,'ReportTitle')
            ->unset_add()
            ->unset_edit()
            ->unset_remove()
            ->unset_limitlist()
            ->unset_title()
            ->unset_print()
            ->unset_csv()
            ->limit(20)
            ->label(array('itemsList' => 'Basic Report','rid' => 'ID','ReportTitle'=>'Report Title','reportCategory'=>'Report Category','ReportDescription'=>'Report Description'));

    $projects = Xcrud::get_instance();
    $projects->table('subprogrammes')
                ->where('(SubProgramName LIKE "%' . $query . '%" OR projectDecription LIKE "%' . $query . '%") AND LENGTH(SubProgramCode) = 4 AND Priority = 1')
                ->order_by('id','asc')
                ->table_name('List of Strategic Projects, with Tasks, Milestones and Timelines')
                ->pass_default('createdBy',$user->username)
                ->pass_var('createdBy', $user->username)
                ->pass_default('Priority',1)
                ->pass_var('Priority',1)
                ->columns('SubProgramName,ID,VoteCode,projectPriority,projectCost,projectStatus,Tasks_Complete')
                ->fields('SubProgramCode,SubProgramName,ID,Tasks_Complete,projectCost,projectStatus,projectDecription,VoteCode,ResponsibleOfficers,ProjectObjectives,ProjectOutputs,GOU,external_Funded,projectType,projectPriority,projectStartFY,projectStartDate,projectDeadline,createdBy')
                ->label(array('SubProgramCode'=>'Code','ResponsibleOfficers'=>'Responsible Officer','ProjectObjectives'=>'Project Objectives','ProjectOutputs'=>'Project Outputs','ID'=>'Details','SubProgramName'=>'Project Name','VoteCode'=>'Lead Ministry/Agency','projectType'=>'Project Type','projectPriority'=>'Priority','projectStartFY'=>'Start FY','projectStartDate'=>'Start Date','projectDecription'=>'Description','projectCost'=>'Project Cost','projectStatus'=>'Project Status','projectDeadline'=>'Project Deadline','Tasks_Complete'=>'% Progress','createdBy'=>'Author','deleted'=>'Deleted? Dont Change'))
                ->column_pattern('Tasks_Complete', '<div class="progress left progress-striped" rel="tooltip" data-original-title="Stacked Progress" data-placement="top"><div class="progress-bar progress-barX" style="width: {Tasks_Almost_Complete}%"></div><div class="progress-bar progress-bar-success" style="width: {Tasks_Complete}%">{Tasks_Complete}%</div></div>')
                ->column_pattern('SubProgramName', '<a href="#" class="xcrud-action" data-task="view" data-primary="{id}">{value}</a>')
                ->column_pattern('ID', '<a class="btn btn-info btn-xs" href="#X/projectdetails?id={id}&Tasks_Complete={Tasks_Complete}&Tasks_Almost_Complete={Tasks_Almost_Complete}&Code={SubProgramCode}&ProjectName={SubProgramName}">Details</a>')
                ->change_type('projectStartFY','select','','2015/2016,2016/2017,2017/2018,2018/2019,2019/2020')
                ->relation('VoteCode','votes','VoteCode','VoteName','VoteCode<400')
                ->highlight('projectStatus', '=', "Not Started", '#e89e9e')
                ->highlight('projectStatus', '=', "Completed", '#bee89e')
                ->highlight('projectStatus', '=', "Almost Complete", '#E5F2C9')
                ->highlight('projectStatus', '=', "Delayed", '#e2dda0')
                ->highlight('projectStatus', '=', "On Hold", '#e89e9e')
                ->highlight('projectPriority', '=', "Very High", '#C0C5C1')
                ->highlight('projectPriority', '=', "High", '#EAF0CE')
                ->unset_title()
                ->unset_limitlist()
                ->limit(15)
                ->unset_add()
                ->unset_edit()
                ->unset_remove()
                ->unset_print()
                ->unset_csv();

    $tasks = Xcrud::get_instance();
    $tasks->table('projecttasks')
                ->join('projectID','projects','projectID')
                ->where('projectTaskTitle LIKE "%' . $query . '%" OR projects.projectName LIKE "%' . $query . '%"')
                ->columns('projectTaskTitle,projects.projectName,assigned_to,priority,status,imProgress')
                ->fields('projectTaskTitle,projects.projectName,imProgress,projects.projectName,projectTaskDescription,assigned_to,collaborators,start_date,deadline,priority,status')
                ->label(array('projectTaskTitle' => 'Task','projects.projectName' => 'Project Name','projectTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'))
                ->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>')
                ->column_pattern('projects.projectName', "<a href='#X/projectdetails?projectid={projectID}'>{projects.projectName}</a>")
                ->column_pattern('projectTaskTitle', '<a href="#" class="xcrud-action" data-task="view" data-primary="{projectTaskID}">{value}</a>')
                ->relation('assigned_to','votes','VoteCode','VoteName','VoteCode<400')
                ->highlight('status', '=', "Not Started", '#e89e9e')
                ->highlight('status', '=', "Completed", '#bee89e')
                ->highlight('status', '=', "Delayed", '#e2dda0')
                ->unset_add()
                ->unset_edit()
                ->unset_remove()
                ->unset_limitlist()
                ->unset_title()
                ->unset_print()
                ->unset_csv();

    $meetings = Xcrud::get_instance();
    $meetings->table('meetings')
                ->where('meetName LIKE "%' . $query . '%" OR meetDecription LIKE "%' . $query . '%"')
                ->button('#X/meetdetails?meetid={meetID}','Details','glyphicon glyphicon-new-window')
                ->pass_default('createdBy',$user->username)
                ->pass_var('createdBy', $user->username)
                ->columns('meetName,meetID,meetType,meetFY,meetDate,meetTasksDeadline,meetTasksStatus,impProgress')
                ->fields('meetName,meetID,meetDecription,meetType,meetFY,meetOrganiser,meetDate,meetTasksDeadline,meetTasksStatus,impProgress,createdBy')
                ->label(array('meetID' => 'Details','meetName' => 'Meeting / Event','meetType' => 'Meet Types', 'meetFY' => 'Fin. Year', 'meetDate' => 'Meet Date', 'impProgress' => '% Progress', 'meetTasksDeadline' => 'Deadline', 'meetTasksStatus' => 'Status','meetDecription' => 'Description','meetOrganiser' => 'Organised By'))
                ->column_pattern('impProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {impProgress}%">{impProgress}%</div></div>')
                ->column_pattern('meetName', '<a href="#" class="xcrud-action" data-task="view" data-primary="{meetID}">{value}</a>')
                ->column_pattern('meetID', '<a class="btn btn-info btn-xs" href="#X/meetdetails?meetid={meetID}">Details</a>')
                ->relation('meetType','meettype','MeetType','MeetType','')
                ->change_type('meetFY','select','','2015/2016,2016/2017,2017/2018,2018/2019,2019/2020')
                ->change_type('meetTasksStatus','select','','Not Started,On going,Delayed,On Hold,Cancelled,Completed')
                ->highlight('meetTasksStatus', '=', "Not Started", '#e89e9e')
                ->highlight('meetTasksStatus', '=', "Completed", '#bee89e')
                ->highlight('meetTasksStatus', '=', "Delayed", '#e2dda0')
                ->unset_add()
                ->unset_edit()
                ->unset_remove()
                ->unset_limitlist()
                ->unset_title()
                ->unset_print()
                ->unset_csv();

    $actions = Xcrud::get_instance();
    $actions->table('meettasks')
                ->join('meetID','meetings','meetID')
                ->where('meetTaskTitle LIKE "%' . $query . '%" OR meetings.meetName LIKE "%' . $query . '%"')
                ->columns('meetTaskTitle,meetings.meetName,assigned_to,start_date,deadline,priority,status,imProgress')
                ->fields('meetTaskTitle,imProgress,meetings.meetName,meetTaskDescription,assigned_to,collaborators,start_date,deadline,priority,status')
                ->label(array('meetTaskTitle' => 'Task','meetings.meetName' => 'Meet / Event','meetTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'))
                ->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>')
                ->column_pattern('meetings.meetName', "<a href='#X/meetdetails?meetid={meetID}'>{meetings.meetName}</a>")
                ->column_pattern('meetTaskTitle', '<a href="#" class="xcrud-action" data-task="view" data-primary="{meetTaskID}">{value}</a>')
                ->relation('meetType','meettype','MeetType','MeetType','')
                ->change_type('priority','select','','Low,Normal,High,Critical')
                ->change_type('status','select','','Not Started,On going,Delayed,Cancelled,Completed')
                ->highlight('status', '=', "Not Started", '#e89e9e')
                ->highlight('status', '=', "Completed", '#bee89e')
                ->highlight('status', '=', "Delayed", '#e2dda0')
                ->unset_add()
                ->unset_edit()
                ->unset_remove()
                ->unset_limitlist()
                ->unset_title()
                ->unset_print()
                ->unset_csv();

    $votes = Xcrud::get_instance();
    $votes->table('votesview')
                ->where('VoteName LIKE "%' . $query . '%" OR VoteCode LIKE "%' . $query . '%"')
                ->columns('VoteCode,VoteName,MDATypeName,Sector,ThematicArea')
                ->fields('VoteCode,VoteName,MDATypeName,VoteMission,SectorCode,Sector,ThematicArea')
                ->label(array('VoteCode'=>'Vote','VoteName'=>'Ministry/Department/Agency','MDATypeName'=>'Vote Type','VoteMission'=>'Mission','ThematicArea'=>'Thematic Area'))
                ->column_pattern('VoteName', '<a href="#X/votedetails?Vote={VoteCode}">{value}</a>')
                ->unset_add()
                ->unset_edit()
                ->unset_remove()
                ->unset_limitlist()
                ->unset_title()
                ->unset_print()
                ->unset_csv();

    $dept_projects = Xcrud::get_instance();
    $dept_projects->table('view_subprogrammes')
                ->where('VoteName LIKE "%' . $query . '%" OR ProgrammeName LIKE "%' . $query . '%" OR SubProgramName LIKE "%' . $query . '%"')
                ->columns('VoteName,ProgrammeName,SubProgramName')
                ->fields('VoteName,ProgrammeName,SubProgramName,ProjectObjectives')
                ->column_cut(250,'ProgrammeName')
                ->column_cut(250,'SubProgramName')
                ->label(array('VoteCode'=>'Vote','VoteName'=>'Ministry/Department/Agency','ProgrammeName'=>'Programme','SubProgramName'=>'Department / Project','ProjectObjectives'=>'Department / Project Objective'))
                ->column_pattern('VoteName', '<a href="#X/votedetails?Vote={VoteCode}">{value}</a>')
                ->column_pattern('ProgrammeName', '<a href="#X/progdetails?ID={ProgrammeNameID}&SectorCode={SectorCode}&VoteCode={VoteCode}&ProgramCode={ProgramCode}&Programme={ProgrammeName}">{value}</a>')
                ->unset_add()
                ->unset_edit()
                ->unset_remove()
                ->unset_limitlist()
                ->unset_title()
                ->unset_print()
                ->unset_csv();

    $LGs = Xcrud::get_instance();
    $LGs->table('d_population')
                ->where('Sub_Region LIKE "%' . $query . '%" OR District LIKE "%' . $query . '%" OR Sub_County LIKE "%' . $query . '%" OR Parish LIKE "%' . $query . '%"')
                ->columns('Region,Sub_Region,District,LC_Level,Sub_County,Parish,Total,Households')
                ->fields('Region,Sub_Region,District,LC_Level,Sub_County,Parish,Total,Households')
                ->label(array('Total'=>'Population'))
                ->unset_add()
                ->unset_edit()
                ->unset_remove()
                ->unset_limitlist()
                ->unset_title()
                ->unset_print()
                ->unset_csv();



    $reports_txt = $data->render();
    $projects_txt = $projects->render();
    $tasks_txt = $tasks->render();
    $meetings_txt = $meetings->render();
    $actions_txt = $actions->render();
    $votes_txt = $votes->render();
    $dept_projects_txt = $dept_projects->render();
    $LGs_txt = $LGs->render();


    $_ui->start_track();

    // smartui code
    $tabs = array(
        'Reports' => 'Reports',
        'Projects' => 'Projects',
        'ProjectTasks' => 'Project Tasks',
        'MeetingsEvents' => 'Meetings / Events',
        'Actions' => 'Actions',
        'MinistriesAgencies' => 'Ministries / Agencies',
        'DepartmentsProjects' => 'Departments / Projects',
        'LocalGovernments' => 'Local Governments'
    );
    $tab = $_ui->create_tab($tabs);

    $tab->content('Reports', $reports_txt)
        ->icon('Reports', 'fa fa-home')
        ->content('Projects', $projects_txt)
        ->icon('Projects', 'fa fa-slack')
        ->content('ProjectTasks', $tasks_txt)
        ->icon('ProjectTasks', 'fa fa-cube')
        ->content('MeetingsEvents', $meetings_txt)
        ->icon('MeetingsEvents', 'fa fa-reorder')
        ->content('Actions', $actions_txt)
        ->icon('Actions', 'fa fa-bar-chart-o')
        ->content('MinistriesAgencies', $votes_txt)
        ->icon('MinistriesAgencies', 'fa fa-envelope')
        ->content('DepartmentsProjects', $dept_projects_txt)
        ->icon('DepartmentsProjects', 'fa fa-asterisk')
        ->content('LocalGovernments', $LGs_txt)
        ->icon('LocalGovernments', 'fa fa-yelp');

    $tab->options('bordered', true)
        ->options('widget', true);
    $tab->active('Reports', true);

    $tab_html = $tab->print_html(true);

?>
<style>
    .progress-barX {
        background-color: #e3e4d1;
    }
</style>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-search fa-fw "></i>
            Search Results for &dash;&dash; <?php echo '"'.$query.'"';
            ?>
        </h1>
    </div>
</div>

<?php
echo $tab_html;
?>


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
     * //setup nav height (dynamic)
     * nav_page_height();
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
     */



</script>