<?php
$vote = '005';
$votename = "Ministry of Public Service";

if (isset($_GET['vote'])) {
    $vote = $_GET['vote'];
}
require_once("inc/init.php");
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');


$user = Auth::user();
$username = $user->username;

$xcrud = Xcrud::get_instance();


$db = Xcrud_db::get_instance();
$sql = 'SELECT Vote_Code, Vote_Name, Vote_type FROM votes_core WHERE Vote_Code = ' . $vote;
$db->query($sql);
$array = $db->result();
$votename = $array[0]["Vote_Name"];
$vote = $array[0]["Vote_Code"];



$xcrud->table('votes_core');
$xcrud->table_name($votename);
$xcrud->fields('Vote_Code,Vote_Name,Vote_type,Central_or_Local_Government');
$xcrud->columns('Vote_Code,Vote_Name,Vote_type,Central_or_Local_Government');

$xcrud->unset_list();
$xcrud->unset_title();

$overviewtext = $xcrud->render('view', $vote);

$structure = Xcrud::get_instance();
$structure->table('vote_departments')
    ->where('vote =', $vote)
    ->table_name('Departments, Divisions and Units')
    ->pass_default('vote',$vote)
    ->pass_var('vote', $vote)
    ->columns('department_name,Jobs')
    ->fields('department_name,department_type,description', false, 'Add New Department, Division or Section', 'create')
    ->fields('department_name,department_type,description', false, 'Overview', 'edit')
    ->fields('id,department_name,Jobs,description', false, 'Overview', 'view')
    ->column_pattern('id','{vote}-{id}')
    ->change_type('priority','select','','Low,Normal,High,Critical')
    ->subselect('Jobs','SELECT SUM(approv_no) FROM vote_departments_jobs WHERE dept_id = {id}')
    ->column_width('Jobs','60px')
    ->column_class('Jobs','align-right')
    ->unset_title();

$structure->button('#', "Top", 'glyphicon glyphicon-arrow-up icon-arrow-up', 'btn xcrud-action', array(
    'data-action' => 'movetop',
    'data-task' => 'action',
    'data-vote' => '{vote}',
    'data-primary' => '{id}'));
$structure->button('#', "Bottom", 'glyphicon glyphicon-arrow-down icon-arrow-down', 'btn xcrud-action', array(
    'data-action' => 'movebottom',
    'data-task' => 'action',
    'data-vote' => '{vote}',
    'data-primary' => '{id}'));

$structure->create_action('movetop', 'movetop');
$structure->create_action('movebottom', 'movebottom');

$structure->highlight_row('department_type','=','Ministers Office', '', 'Political_Office');
$structure->highlight_row('department_type','=','Executive Office', '', 'Executive_Office');
$structure->highlight_row('department_type','=','Directorate Heading', '','Directorate_Heading');
$structure->highlight_row('department_type','=','Directorate', '','Directorate');
$structure->highlight_row('department_type','=','Department Heading', '', 'Department_Heading');
$structure->highlight_row('department_type','=','', '#050c23');
$structure->highlight_row('department_type','=','Department', '#D4DBC5');
$structure->highlight_row('department_type','=','Division Heading', '#b0b8e5');
$structure->highlight_row('department_type','=','Stand Alone Division', '#b0b8e5');

$structure->column_pattern('department_type','{department_type}');
$structure->column_callback('department_name','department_card');

$structure->unset_sortable()
            ->limit(50);
$structure->order_by('ordering, id')
        ->label(array('department_name'=>'List of Departments, Divisions, Sections and Units'));
$structure->set_lang('add','Add New Directorate, Department, Division, Section or Unit');
$structure->set_lang('return','Return to List of Directorates, Departments, Divisions, Sections and Units');
$jobs_list = $structure->nested_table('List of Jobs and Approved Establishment','id','vote_departments_jobs','dept_id');
$jobs_list->columns('job_title,salary_scale,approv_no,monthly_salary,Annual_Salary')
            ->subselect('Annual_Salary','{monthly_salary}*{approv_no}*12')
            ->label(array('Annual_Salary'=>'Annual Salary'))
            ->fields('job_title,salary_scale,approv_no,monthly_salary,Annual_Salary')
            ->table_name('List of Jobs and Approved Establishment')
            ->change_type('monthly_salary', 'price','0', array('suffix'=>' ','decimals'=>'0'))
            ->change_type('Annual_Salary', 'price','0', array('suffix'=>' ','decimals'=>'0'))
            ->column_class('approv_no,monthly_salary,Annual_Salary','align-right')
            ->sum('approv_no,Annual_Salary','align-right','Total: {value}');


$structureText = "List of <strong>Directorates, Departments, Divisions, Sections and Units.</strong><br>";
$structureText = $structureText . $structure->render();

?>


<?php
// draw tabs
$_ui->start_track();

// smartui code
$tabs = array(
    'Departments' => 'List of Departments, Divisions and Units',
    'Establishment' => 'Structures and Establishment',
    'Notes' => 'Notes',
    'Files' => 'Files',
    'Overview' => 'Overview'
);
$tab = $_ui->create_tab($tabs);

$tab->content('Overview', $overviewtext)
    ->icon('Overview', 'fa fa-home')
    ->content('Departments', $structureText)
    ->icon('Departments', 'fa fa-slack');

$tab->options('bordered', true)
    ->options('widget', true);
$tab->active('Departments', true);

$tab_html = $tab->print_html(true);

echo $tab_html;

?>





<script language="javascript">
    drawBreadCrumb(["Vote Structure and Establishment", "<?php echo $votename; ?>"]);
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
<style>
    .Political_Office{
        font-size: 13px;
        font-weight: bold;
        font-family: Verdana, Geneva, sans-serif;

        background-color:#808661;
        border: 1px solid #676d48;
        background-image: -o-linear-gradient(bottom, #999f7a 0%, #808661 100%);
        background-image: -moz-linear-gradient(bottom, #999f7a 0%, #808661 100%);
        background-image: -webkit-linear-gradient(bottom, #999f7a 0%, #808661 100%);
        background-image: -ms-linear-gradient(bottom, #999f7a 0%, #808661 100%);
        background-image: linear-gradient(to bottom, #999f7a 0%, #808661 100%);
        -webkit-box-shadow: inset 0 1px 0 #b2b893;
        -moz-box-shadow: inset 0 1px 0 #b2b893;
        box-shadow: inset 0 1px 0 #b2b893;
        text-shadow: 0 1px 0 #b2b893;
        color: #282e0b;


    }
    .Executive_Office{
        font-size: 13px;
        font-weight: bold;
        font-family: Verdana, Geneva, sans-serif

        background-color:#8f7b6d;
        border: 1px solid #766254;
        background-image: -o-linear-gradient(bottom, #a89486 0%, #8f7b6d 100%);
        background-image: -moz-linear-gradient(bottom, #a89486 0%, #8f7b6d 100%);
        background-image: -webkit-linear-gradient(bottom, #a89486 0%, #8f7b6d 100%);
        background-image: -ms-linear-gradient(bottom, #a89486 0%, #8f7b6d 100%);
        background-image: linear-gradient(to bottom, #a89486 0%, #8f7b6d 100%);
        -webkit-box-shadow: inset 0 1px 0 #c1ad9f;
        -moz-box-shadow: inset 0 1px 0 #c1ad9f;
        box-shadow: inset 0 1px 0 #c1ad9f;
        text-shadow: 0 1px 0 #c1ad9f;
        color: #513e31;
    }
    .Directorate_Heading{
        font-size: 13px;
        font-weight: bold;
        font-family: Verdana, Geneva, sans-serif;

        background-color:#b49c1c;
        border: 1px solid #9b8303;
        background-image: -o-linear-gradient(bottom, #cdb535 0%, #b49c1c 100%);
        background-image: -moz-linear-gradient(bottom, #cdb535 0%, #b49c1c 100%);
        background-image: -webkit-linear-gradient(bottom, #cdb535 0%, #b49c1c 100%);
        background-image: -ms-linear-gradient(bottom, #cdb535 0%, #b49c1c 100%);
        background-image: linear-gradient(to bottom, #cdb535 0%, #b49c1c 100%);
        -webkit-box-shadow: inset 0 1px 0 #e6ce4e;
        -moz-box-shadow: inset 0 1px 0 #e6ce4e;
        box-shadow: inset 0 1px 0 #e6ce4e;
        text-shadow: 0 1px 0 #e6ce4e;
        color: #483d01;

    }

    .Directorate{
        background-color:#dee7e6;
        border: 1px solid #c5cecd;
        background-image: -o-linear-gradient(bottom, #f7ffff 0%, #dee7e6 100%);
        background-image: -moz-linear-gradient(bottom, #f7ffff 0%, #dee7e6 100%);
        background-image: -webkit-linear-gradient(bottom, #f7ffff 0%, #dee7e6 100%);
        background-image: -ms-linear-gradient(bottom, #f7ffff 0%, #dee7e6 100%);
        background-image: linear-gradient(to bottom, #f7ffff 0%, #dee7e6 100%);
        -webkit-box-shadow: inset 0 1px 0 #ffffff;
        -moz-box-shadow: inset 0 1px 0 #ffffff;
        box-shadow: inset 0 1px 0 #ffffff;
        text-shadow: 0 1px 0 #ffffff;
        color: #0f0915;

    }
    .Department_Heading{
        font-weight: bold;
        font-family: Verdana, Geneva, sans-serif;

        background-color:#b5b694;
        border: 1px solid #9c9d7b;
        background-image: -o-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -moz-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -webkit-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -ms-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: linear-gradient(to bottom, #cecfad 0%, #b5b694 100%);
        -webkit-box-shadow: inset 0 1px 0 #e7e8c6;
        -moz-box-shadow: inset 0 1px 0 #e7e8c6;
        box-shadow: inset 0 1px 0 #e7e8c6;
        text-shadow: 0 1px 0 #e7e8c6;
        color: #1b1c02;
    }
    .Department_{

    }
    .Division_Heading{

    }
    .Stand_Alone_Division{

    }
    .cell_indent{
        text-indent: 15px;
    }.cell_indent2{
        text-indent: 30px;
    }.cell_indent3{
        text-indent: 45px;
    }.cell_indent4{
        text-indent: 60px;
    }.cell_indent5{
        text-indent: 75px;
    }
    .fc-head-container thead tr, .table thead tr {
        font-size: 13px;
        background-color:#b5b694;
        border: 1px solid #9c9d7b;
        background-image: -o-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -moz-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -webkit-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -ms-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: linear-gradient(to bottom, #cecfad 0%, #b5b694 100%);
        -webkit-box-shadow: inset 0 1px 0 #e7e8c6;
        -moz-box-shadow: inset 0 1px 0 #e7e8c6;
        box-shadow: inset 0 1px 0 #e7e8c6;
        text-shadow: 0 1px 0 #e7e8c6;
        color: #1b1c02;
    }
    .btn-default {
        background-color: #eae5c9;
    }

    .col-sm-9 {
        padding-left: 0px;
        padding-top: 7px;
        font-family: Verdana, Geneva, sans-serif;
    }
    .col-sm-3 {
        padding-top: 7px;
        font-family: Verdana, Geneva, sans-serif;
    }
    .xcrud-num {
        color: #21300ad1;
    }
    .ui-tabs .ui-tabs-nav li a {
        background-color:#ca6402;
        border: 1px solid #b14b00;
        background-image: -o-linear-gradient(bottom, #e37d1b 0%, #ca6402 100%);
        background-image: -moz-linear-gradient(bottom, #e37d1b 0%, #ca6402 100%);
        background-image: -webkit-linear-gradient(bottom, #e37d1b 0%, #ca6402 100%);
        background-image: -ms-linear-gradient(bottom, #e37d1b 0%, #ca6402 100%);
        background-image: linear-gradient(to bottom, #e37d1b 0%, #ca6402 100%);
        -webkit-box-shadow: inset 0 1px 0 #fc9634;
        -moz-box-shadow: inset 0 1px 0 #fc9634;
        box-shadow: inset 0 1px 0 #fc9634;
        text-shadow: 0 1px 0 #fc9634;
        color: #f3efed;
    }
    .ui-tabs .ui-tabs-nav li.ui-tabs-active a {
        border-bottom: 1px solid #0a5a22;
        background-color:#b5b694;
        border: 1px solid #9c9d7b;
        background-image: -o-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -moz-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -webkit-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -ms-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: linear-gradient(to bottom, #cecfad 0%, #b5b694 100%);
        -webkit-box-shadow: inset 0 1px 0 #e7e8c6;
        -moz-box-shadow: inset 0 1px 0 #e7e8c6;
        box-shadow: inset 0 1px 0 #e7e8c6;
        text-shadow: 0 1px 0 #e7e8c6;
        color: #4b4d10;
    }
    .form-horizontal .control-label {
        padding-top: 12px;
    }
    .xcrud .xcrud-list td.xcrud-sum {
        background-color:#b5b694;
        border: 1px solid #9c9d7b;
        background-image: -o-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -moz-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -webkit-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -ms-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: linear-gradient(to bottom, #cecfad 0%, #b5b694 100%);
        -webkit-box-shadow: inset 0 1px 0 #e7e8c6;
        -moz-box-shadow: inset 0 1px 0 #e7e8c6;
        box-shadow: inset 0 1px 0 #e7e8c6;
        text-shadow: 0 1px 0 #e7e8c6;
        color: #454709;
        font-size: 13px;
    }
    .table-bordered>thead>tr>th {
        border: 1px solid #babb97;
    }
    .xcrud-list td.align-right {
        padding-top: 15px;
    }
</style>

