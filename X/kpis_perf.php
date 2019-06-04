<?php
require_once("inc/init.php");

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('kpisperf');
$data->where('Priority = 1');
$data->order_by('ID','asc');
$data->table_name('Planned Key Performance Indicators');
$data->columns('KeyOutputCode,Key_Performance_Indicator,Annual_Target,Q1_Scorecard,Q2_Scorecard,Q3_Scorecard,Q4_Scorecard');
$data->fields('KeyOutputCode,Key_Performance_Indicator,Annual_Target,Q1_Actual_Target,Q2_Actual_Target,Q3_Actual_Target,Q4_Actual_Target');
$data->column_cut(250,'Key_Performance_Indicator,Annual_Target');
$data->column_pattern('KeyOutputCode', '{SectorCode}-{ProgramCode}-{KeyOutputCode}');
$data->column_pattern('Q1_Scorecard', '<div class="btn-group"><a class="btn btn-default txt-color-green dropdown-toggle btn-xs" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false"><span class="caret"></span></a><ul class="dropdown-menu"><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q1::Achieved::{ID}">Achieved</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q1::Partially Achieved::{ID}">Partially Achieved</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q1::Not Achieved::{ID}">Not Achieved</a></li><li class="divider"></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q1::No Data::{ID}">No Data</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q1::-::{ID}">Not Assessed</a></li></ul></div>   {Q1_Actual_Target}');
$data->column_pattern('Q2_Scorecard', '<div class="btn-group"><a class="btn btn-default txt-color-green dropdown-toggle btn-xs" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false"><span class="caret"></span></a><ul class="dropdown-menu"><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q2::Achieved::{ID}">Achieved</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q2::Partially Achieved::{ID}">Partially Achieved</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q2::Not Achieved::{ID}">Not Achieved</a></li><li class="divider"></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q2::No Data::{ID}">No Data</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q2::-::{ID}">Not Assessed</a></li></ul></div>   {Q2_Actual_Target}');
$data->column_pattern('Q3_Scorecard', '<div class="btn-group"><a class="btn btn-default txt-color-green dropdown-toggle btn-xs" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false"><span class="caret"></span></a><ul class="dropdown-menu"><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q3::Achieved::{ID}">Achieved</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q3::Partially Achieved::{ID}">Partially Achieved</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q3::Not Achieved::{ID}">Not Achieved</a></li><li class="divider"></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q3::No Data::{ID}">No Data</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q3::-::{ID}">Not Assessed</a></li></ul></div>   {Q3_Actual_Target}');
$data->column_pattern('Q4_Scorecard', '<div class="btn-group"><a class="btn btn-default txt-color-green dropdown-toggle btn-xs" data-toggle="dropdown" href="javascript:void(0);" aria-expanded="false"><span class="caret"></span></a><ul class="dropdown-menu"><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q4::Achieved::{ID}">Achieved</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q4::Partially Achieved::{ID}">Partially Achieved</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q4::Not Achieved::{ID}">Not Achieved</a></li><li class="divider"></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q4::No Data::{ID}">No Data</a></li><li><a href="#" class="xcrud-action" data-task="action" data-action="KPI_Achieved_action" data-primary="Q4::-::{ID}">Not Assessed</a></li></ul></div>   {Q4_Actual_Target}');
$data->label(array('KeyOutputCode'=>'Code','VoteCode'=>'Vote'));
$data->relation('VoteCode','votes','VoteCode','VoteName');
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_title();
$data->limit(50);

$data->create_action('KPI_Achieved_action', 'KPI_Achieved_action');

$data->highlight('Q1_Scorecard', '=', "Achieved", '#8BBD8B');
$data->highlight('Q1_Scorecard', '=', "Partially Achieved", '#E5F2C9');
$data->highlight('Q1_Scorecard', '=', "Not Achieved", '#CA907E');
$data->highlight('Q1_Scorecard', '=', "No Data", '#C0C5C1');

$data->highlight('Q2_Scorecard', '=', "Achieved", '#8BBD8B');
$data->highlight('Q2_Scorecard', '=', "Partially Achieved", '#E5F2C9');
$data->highlight('Q2_Scorecard', '=', "Not Achieved", '#CA907E');
$data->highlight('Q2_Scorecard', '=', "No Data", '#C0C5C1');

$data->highlight('Q3_Scorecard', '=', "Achieved", '#8BBD8B');
$data->highlight('Q3_Scorecard', '=', "Partially Achieved", '#E5F2C9');
$data->highlight('Q3_Scorecard', '=', "Not Achieved", '#CA907E');
$data->highlight('Q3_Scorecard', '=', "No Data", '#C0C5C1');

$data->highlight('Q4_Scorecard', '=', "Achieved", '#8BBD8B');
$data->highlight('Q4_Scorecard', '=', "Partially Achieved", '#E5F2C9');
$data->highlight('Q4_Scorecard', '=', "Not Achieved", '#CA907E');
$data->highlight('Q4_Scorecard', '=', "No Data", '#C0C5C1');


$where = 'WHERE Priority = 1';

if (isset($_GET['SelectBy'])) {
    $data->where('VoteCode =', $_GET['Vote']);
    $where = 'WHERE Priority = 1 AND VoteCode = "'.$_GET['Vote'].'"';
}

$db = Xcrud_db::get_instance();
$db->query('SELECT COUNT(*) as counter FROM `kpisperf` ' . $where);
$counter = $db->row()["counter"];
$db->query('SELECT DISTINCT VoteCode, VoteName FROM `votes` ORDER BY VoteCode ASC');
$list = $db->result();
?>

<script>
    $('nav').find('a[href$="X/kpis_perf.php"]').parent('li').addClass("active");
</script>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
            Scorecard of Priority Key Performance Indicators
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h4> <?php echo $counter ?> <span class="txt-color-blue"> <i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i> Priority KPIs</span></h4>
            </li>
        </ul>
    </div>
</div>

<div class="alert alert-info">
    <form name="selectMDA" class="smart-form">
        <strong>Filter:</strong> by Vote (Ministry, Deptartment or Agency) :-
        <input type="hidden" id="SelectBy" name="SelectBy" value="Sector" />
        <label class="input-sm">
            <select name="Vote" onchange="document.location.href='#X/kpis_perf?SelectBy=Vote&Vote='+this.value">
                <option value="0">Select Ministry, Department or Agency</option>
                <?php
                for ($count=0;$count<count($list);$count++){
                    ?>
                    <option value="<?php echo $list[$count]["VoteCode"] ?>"><?php echo $list[$count]["VoteName"] ?></option>
                    <?php
                }
                ?>
            </select> <i></i>
        </label>
    </form>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-pinkDark" id="wid-id-3" data-widget-editbutton="false" data-widget-deletebutton="false">
                <!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Scorecard of Priority Key Performance Indicators</h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <?php
                        echo $data->render();
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
<!-- end widget grid -->

<script type="text/javascript">


    pageSetUp();


    var pagefunction = function() {

    };

    // load related plugins


</script>
