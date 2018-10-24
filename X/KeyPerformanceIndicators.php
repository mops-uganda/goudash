<?php
require_once("inc/init.php");
require ('../lib/xcrud/xcrud.php');

$data = Xcrud::get_instance();
$data->table('view_kpis');
$data->order_by('VoteCode','asc');
$data->table_name('List of Key Performance Indicators');
$data->columns('VoteName, ProgrammeName, KeyOutputDescription, KeyIndicatorName, Indicator_Measure, Indicator_Type, MethodofMeasurement, SourceofData');
$data->fields('VoteName, ProgrammeName, KeyOutputDescription, KeyIndicatorName, Indicator_Measure, Indicator_Type, MethodofMeasurement, SourceofData');
$data->label(array('VoteName'=>'Ministry / Agency','ProgrammeName'=>'Govt Department','KeyOutputDescription'=>'Key Output','KeyIndicatorName'=>'Key Performance Indicator','Indicator_Measure'=>'Indicator Measure','Indicator_Type'=>'Indicator Type','MethodofMeasurement'=>'Method of Measure','SourceofData'=>'Source of Data'));
$data->column_pattern('VoteName', '<a href="#X/votedetails?Vote={VoteCode}">{value}</a>');
$data->column_pattern('ProgrammeName', '<a href="#X/progdetails?ID={ProgrammeNameID}&SectorCode={SectorCode}&VoteCode={VoteCode}&ProgramCode={ProgramCode}&Programme={ProgrammeName}">{value}</a>');
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_title();
$data->limit(50);

if (isset($_GET['SelectBy'])) {
    $data->where('VoteCode =', $_GET['Vote']);
}


$db = Xcrud_db::get_instance();
$db->query('SELECT COUNT(*) as counter FROM `view_kpis`');
$counter = $db->row()["counter"];
$db->query('SELECT DISTINCT VoteCode, VoteName FROM `votes` ORDER BY VoteCode ASC');
$list = $db->result();
?>

<script>
    $('nav').find('a[href$="X/KeyPerformanceIndicators.php"]').parent('li').addClass("active");
</script>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
            Key Performance Indicators
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h4> <?php echo $counter; ?> <span class="txt-color-blue"> <i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i> KPIs</span></h4>
            </li>
        </ul>
    </div>
</div>

<div class="alert alert-info">
    <form name="selectMDA" class="smart-form">
        <strong>Filter:</strong> by Vote (Ministry, Deptartment or Agency) :-
        <input type="hidden" id="SelectBy" name="SelectBy" value="Sector" />
        <label class="input-sm">
            <select name="Vote" onchange="document.location.href='#X/KeyPerformanceIndicators?SelectBy=Vote&Vote='+this.value">
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
            <div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">
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
                    <h2>Key Performance Indicators (KPIs)</h2>

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
