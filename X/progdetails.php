<?php
require_once("inc/init.php");
require ('../lib/xcrud/xcrud.php');

$db = Xcrud_db::get_instance();
$sql = 'SELECT DISTINCT VoteCode, VoteName FROM `votes` ORDER BY VoteCode ASC';
$db->query($sql);
$list = $db->result();

$ID = '2';
$SectorCode = '13';
$VoteCode = '003';
$ProgramCode = '01';
$Programme = 'Programme Name';
if (isset($_GET['ID'])) {
    $ID = $_GET['ID'];
}

if (isset($_GET['SectorCode'])) {
    $SectorCode = $_GET['SectorCode'];
}

if (isset($_GET['VoteCode'])) {
    $VoteCode = $_GET['VoteCode'];
}

if (isset($_GET['ProgramCode'])) {
    $ProgramCode = $_GET['ProgramCode'];
}

if (isset($_GET['Programme'])) {
    $Programme = $_GET['Programme'];
}


$data = Xcrud::get_instance();
$data->table('programmes');
$data->join('VoteCode','votes','VoteCode');
$data->fields('programmes.VoteCode,ProgramCode,ProgrammeName,ProgramObjective,ResponsibleOfficer');
$data->column_cut(250,'ProgrammeName');
$data->column_cut(250,'ProgramObjective');
$data->label(array('ProgramCode'=>'Sector Code / Programme Code','ResponsibleOfficer'=>'Responsible Officer','VoteCode'=>'Vote','VoteName'=>'Ministry/Department/Agency','ProgrammeName'=>'Government Programme','ProgramObjective'=>'Program Objective'));
$data->column_pattern('VoteName', '<a href="#X/votedetails?Vote={VoteCode}">{value}</a>');
$data->column_pattern('ProgramCode', '{SectorCode}-{ProgramCode}');
$data->column_pattern('VoteCode', '{VoteCode}:- {votes.VoteName}');
$data->unset_add();
$data->unset_edit();
$data->unset_list();
$data->unset_remove();
$data->unset_title();
$data->limit(25);

if (isset($_GET['ID'])) {
    $data->where('ID =', $_GET['ID']);
}
$overviewtext = $data->render('view', $ID);

$depts_projects_Text = "List of <strong>Departments and Projects </strong>(sub-programmes) withing Programme <strong>" . $Programme . "</strong>";
$depts_projects_ = Xcrud::get_instance();
$depts_projects_->table('subprogrammes');
$depts_projects_->order_by('SubProgramCode','asc');
$depts_projects_->where('', 'SectorCode='.$SectorCode.' AND VoteCode='.$VoteCode.' AND ProgramCode='.$ProgramCode);
$depts_projects_->columns('SubProgramCode,SubProgramName,ProjectObjectives,ProjectOutputs');
$depts_projects_->fields('SubProgramCode,SubProgramName,ResponsibleOfficers,ProjectObjectives,ProjectOutputs');
$depts_projects_->label(array('SubProgramCode'=>'SCode','SubProgramName'=>'Department / Project','ResponsibleOfficers'=>'Responsible Officer','ProjectObjectives'=>'Objectives','ProjectOutputs'=>'Outputs'));
$depts_projects_->unset_title();
$depts_projects_->unset_add();
$depts_projects_->unset_edit();
$depts_projects_->unset_remove();
$depts_projects_->unset_limitlist();
$depts_projects_->column_cut(150,'ProjectObjectives,ProjectOutputs');

$depts_projects_Text = $depts_projects_Text . $depts_projects_->render();

$key_outputs_Text = "List of <strong>Key Outputs </strong>to be delivered by Programme <strong>" . $Programme . "</strong>";
$key_outputs_ = Xcrud::get_instance();
$key_outputs_->table('keyoutputs');
$key_outputs_->order_by('KeyOutputCode','asc');
$key_outputs_->where('', 'SectorCode='.$SectorCode.' AND VoteCode='.$VoteCode.' AND ProgramCode='.$ProgramCode);
$key_outputs_->columns('OutputClassCode,KeyOutputCode,KeyOutputDescription,isKeySector,isServiceDelivery');
$key_outputs_->fields('OutputClassCode,KeyOutputCode,KeyOutputDescription,isKeySector,isServiceDelivery');
$key_outputs_->label(array('OutputClassCode'=>'Class','KeyOutputCode'=>'KO Code','KeyOutputDescription'=>'Key Output','isKeySector'=>'Sector Output','isServiceDelivery'=>'Service Delivery Output'));
$key_outputs_->unset_title();
$key_outputs_->unset_add();
$key_outputs_->unset_edit();
$key_outputs_->unset_remove();
$key_outputs_->unset_limitlist();
$key_outputs_->column_cut(150,'KeyOutputDescription');

$key_outputs_Text = $key_outputs_Text . $key_outputs_->render();

$kpis_Text = "List of <strong>Key Performance Indicators </strong>to be assessed, and delivered by Programme <strong>" . $Programme . "</strong>";
$kpis_ = Xcrud::get_instance();
$kpis_->table('view_kpis');
$kpis_->where('', 'SectorCode='.$SectorCode.' AND VoteCode='.$VoteCode.' AND ProgramCode='.$ProgramCode);
$kpis_->order_by('VoteCode','asc');
$kpis_->table_name('List of Key Performance Indicators');
$kpis_->columns('KeyOutputDescription, KeyIndicatorName, Indicator_Measure, Indicator_Type, MethodofMeasurement, SourceofData');
$kpis_->fields('KeyOutputDescription, KeyIndicatorName, Indicator_Measure, Indicator_Type, MethodofMeasurement, SourceofData');
$kpis_->label(array('VoteName'=>'Ministry / Agency','ProgrammeName'=>'Govt Department','KeyOutputDescription'=>'Key Output','KeyIndicatorName'=>'Key Performance Indicator','Indicator_Measure'=>'Indicator Measure','Indicator_Type'=>'Indicator Type','MethodofMeasurement'=>'Method of Measure','SourceofData'=>'Source of Data'));
$kpis_->unset_add();
$kpis_->unset_edit();
$kpis_->unset_remove();
$kpis_->unset_title();
$kpis_->unset_limitlist();
$kpis_->limit(50);

$kpis_Text = $kpis_Text . $kpis_->render();

?>

<?php
// draw tabs

$_ui->start_track();

// smartui code
$tabs = array(
    'Overview' => 'Overview',
    'DepartmentsProjects' => 'Departments / Projects',
    'KeyOutputs' => 'Key Outputs',
    'KPIs' => 'Key Performance Indicators'
);
$tab = $_ui->create_tab($tabs);

$tab->content('Overview', $overviewtext)
    ->icon('Overview', 'fa fa-home')
    ->content('DepartmentsProjects', $depts_projects_Text)
    ->icon('DepartmentsProjects', 'fa fa-slack')
    ->content('KeyOutputs', $key_outputs_Text)
    ->icon('KeyOutputs', 'fa fa-cube')
    ->content('KPIs', $kpis_Text)
    ->icon('KPIs', 'fa fa-chart');

$tab->options('bordered', true)
    ->options('widget', true);
$tab->active('Overview', true);

$tab_html = $tab->print_html(true);


?>

<script>
    $('nav').find('a[href$="X/GovernmentProgrammes.php"]').parent('li').addClass("active");
</script>
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
            <?php echo $SectorCode . '-' . $ProgramCode . ': ' . $Programme ?></h2>
        </h1>
    </div>
</div>

<div>
    <div class="col-xs-7 col-sm-7 col-md-7 col-lg-7">
    <strong>Choose another Programme:</strong>
    <input type="hidden" id="SelectBy" name="SelectBy" value="Sector" />
    <label class="input-sm">
        <select name="Vote" onchange="javascript:$('#siteloader').load('X/lookup_programme?vote='+this.value);">
            <option value="0">Select Ministry, Department or Agency</option>
            <?php
            for ($count=0;$count<count($list);$count++){
                ?>
                <tr>
                    <option value="<?php echo $list[$count]["VoteCode"] ?>"><?php echo $list[$count]["VoteName"] ?></option>
                </tr>
                <?php
            }
            ?>
        </select> <i></i>
    </label></div>
    <div class="col-xs-5 col-sm-5 col-md-5 col-lg-5" id="siteloader"> Select Programme </div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div>
                <?php
                echo $tab_html;
                include "xcrud_js.php";
                ?>

                <!-- Xcrud CSS -->
                <link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
                <link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">
            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->

    </div>


</section>
<!-- end widget grid -->

<script type="text/javascript">



    pageSetUp();


    var pagefunction = function() {

    };

    // load related plugins


</script>
