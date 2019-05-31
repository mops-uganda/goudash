<?php
require_once '../securex/extra/auth.php';
require_once("inc/init.php");
require ('../lib/xcrud/xcrud.php');


$sector_id = '01';
$sector_name = "Sector Name";

if (isset($_GET['sectorid'])) {
    $sector_id = $_GET['sectorid'];
}

$db = Xcrud_db::get_instance();
$sql = 'SELECT Sector FROM `sectors` WHERE SectorCode = "' . $sector_id . '"';
$db->query($sql);
$sector_name = $db->row()["Sector"];

$xcrud = Xcrud::get_instance();
$xcrud->table('sectors');
$xcrud->table_name($sector_name);
$xcrud->fields('SectorCode,Sector,ThematicArea');
$xcrud->label(array('ThematicArea'=>'Thematic Area','SectorCode'=>'Sector Code','Sector'=>'Sector Name'));
$xcrud->unset_list();
$xcrud->unset_title();

$sector_text = 'Sector Overview';
$sector_text = $sector_text . $xcrud->render('view', $sector_id);

$outcomes = Xcrud::get_instance();
$outcomes->table('sectoroutcomes');
$outcomes->where('SectorCode =', $sector_id);
$outcomes->table_name('Sector Outcomes');
$outcomes->columns('SectorOutcomeCode,SectorOutcome,Status');
$outcomes->fields('SectorOutcomeCode,SectorOutcome,Status');
$outcomes->label(array('SectorOutcomeCode' => 'Outcome Code','SectorOutcome' => 'Sector Outcome'));
$outcomes->column_cut(350,'SectorOutcome');
$outcomes->unset_add();
$outcomes->unset_edit();
$outcomes->unset_remove();
$outcomes->unset_limitlist();
$outcomes->unset_title();
$outcomes->limit(25);


$outcomesText = "<strong>Sector Outcomes</strong> are the long-term planned outcomes for the sector</strong>.<br>";
$outcomesText = $outcomesText . $outcomes->render();

$outcomeindicators = Xcrud::get_instance();
$outcomeindicators->table('sectoroutcomeindicators');
$outcomeindicators->where('SectorCode =', $sector_id);
$outcomeindicators->table_name('Sector Outcomes Indicators');
$outcomeindicators->columns('Outcome_Description,Outcome_Indicators');
$outcomeindicators->fields('Outcome_Description,Outcome_Indicators');
$outcomeindicators->column_cut(350,'Outcome_Indicators');
$outcomeindicators->unset_add();
$outcomeindicators->unset_edit();
$outcomeindicators->unset_remove();
$outcomeindicators->unset_limitlist();
$outcomeindicators->unset_title();
$outcomeindicators->limit(25);


$outcomeindicatorsText = "<strong>Sector Outcomes Indicators</strong> are Sector Indicators used to minitor the long-term planned outcomes for the sector</strong>.<br>";
$outcomeindicatorsText = $outcomeindicatorsText . $outcomeindicators->render();

$objectives = Xcrud::get_instance();
$objectives->table('sectorobjectives');
$objectives->where('SectorCode =', $sector_id);
$objectives->table_name('Sector Objectives');
$objectives->columns('SectorObjCode,Objective,Details');
$objectives->fields('SectorObjCode,Objective,Details');
$objectives->label(array('SectorObjCode' => 'Obj-Code','Objective' => 'Sector Objective','Details' => 'Sector Objective Details'));
$objectives->column_cut(150,'Objective');
$objectives->column_cut(150,'Details');
$objectives->unset_add();
$objectives->unset_edit();
$objectives->unset_remove();
$objectives->unset_limitlist();
$objectives->unset_title();
$objectives->limit(25);


$objectivesText = "<strong>Sector Objectives</strong> are the objectives for the sector, in order to achieve its planned outcomes</strong>.<br>";
$objectivesText = $objectivesText . $objectives->render();

$mdas = Xcrud::get_instance();
$mdas->table('votes');
$mdas->where('SectorCode =', $sector_id);
$mdas->table_name('List of Votes/MDAs');
$mdas->join('MDAType','mdatype','MDATypeID');
$mdas->order_by('VoteCode','asc');
$mdas->columns('VoteCode,VoteName,mdatype.MDATypeName,VoteMission');
$mdas->fields('VoteCode,VoteName,mdatype.MDATypeName,VoteMission');
$mdas->label(array('VoteCode' => 'Vote','VoteName' => 'Ministry, Department or Agency','mdatype.MDATypeName' => 'MDA Type','VoteMission' => 'Vote Mission'));
$mdas->column_cut(150,'VoteMission');
$mdas->unset_add();
$mdas->unset_edit();
$mdas->unset_remove();
$mdas->unset_limitlist();
$mdas->unset_title();
$mdas->limit(50);


$mdasText = "List of <strong>Ministries, Departments and Agencies (Votes)</strong> within the Sector</strong>.<br>";
$mdasText = $mdasText . $mdas->render();

?>
<div class="row"><button class="btn btn-success btn-labeled btn-md " onclick="location.href='#X/SectorsAndThematicAreas.php';"><span class="btn-label"><i class="fa fa-chevron-left"></i></span> Return to List of Sectors</button><br><br></div>
<div class="row">
    <div class="col-sm-12">
        <h4>Sector :  <?php echo $sector_id . ' - ' .$sector_name; ?></h4></div><br><br>
</div>

<?php
// draw tabs
$_ui->start_track();

// smartui code
$tabs = array(
    'Overview' => 'Overview',
    'SectorOutcomes' => 'Sector Outcomes',
    'OutcomesIndicators' => 'Outcomes Indicators',
    'SectorObjectives' => 'Sector Objectives',
    'Votes' => 'Sector Votes (Ministries, Departments and Agencies)'
);
$tab = $_ui->create_tab($tabs);

$tab->content('Overview', $sector_text)
    ->icon('Overview', 'fa fa-home')
    ->content('SectorOutcomes', $outcomesText)
    ->icon('SectorOutcomes', 'fa fa-slack')
    ->content('OutcomesIndicators', $outcomeindicatorsText)
    ->icon('OutcomesIndicators', 'fa fa-cube')
    ->content('SectorObjectives', $objectivesText)
    ->icon('SectorObjectives', 'fa fa-reorder')
    ->content('Votes', $mdasText)
    ->icon('Votes', 'fa fa-bar-chart-o');

$tab->options('bordered', true)
    ->options('widget', true);
$tab->active('Overview', true);

$tab_html = $tab->print_html(true);

echo $tab_html;
include "xcrud_js.php";
?>

<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">



<script language="javascript">
    drawBreadCrumb(["Sectors", "<?php echo $sector_name; ?>"]);
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
        $('nav').find('a[href$="X/SectorsAndThematicAreas.php"]').parent('li').addClass("active");

    };

    // end pagefunction

    // run pagefunction on load

    pagefunction();

</script>
