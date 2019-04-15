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
    ->columns('department_name,department_type')
    ->fields('department_name,department_type,description')
    ->change_type('priority','select','','Low,Normal,High,Critical')
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
$structure->highlight_row('department_type','=','Ministers Office', '#AB87FF');
$structure->highlight_row('department_type','=','Executive Office', '#B4E1FF');
$structure->highlight_row('department_type','=','Directorate Heading', '#A6974F');
$structure->highlight_row('department_type','=','Department Heading', '#A1AC2D');
$structure->highlight_row('department_type','=','', '#050c23');
$structure->highlight_row('department_type','=','Department', '#D4DBC5');
$structure->highlight_row('department_type','=','Division Heading', '#b0b8e5');
$structure->highlight_row('department_type','=','Stand Alone Division', '#b0b8e5');

$structure->unset_sortable()
    ->limit(50);
$structure->order_by('ordering, id');
$structure->set_lang('add','Add New Directorate, Department, Division, Section or Unit');
$structure->set_lang('return','Return to List of Directorates, Departments, Divisions, Sections and Units');


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

