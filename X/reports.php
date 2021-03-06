<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/reports';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
require_once("inc/init.php");

$reportid = 500;

if (isset($_GET['id'])) {
    $reportid = $_GET['id'];
}

require ('../lib/xcrud/xcrud.php');

$user = Auth::user();
$username = $user->username;

$db = Xcrud_db::get_instance();
$sql = 'SELECT * FROM `reports` WHERE rid = ' . $reportid;
$db->query($sql);
$r = $db->result();

$data = Xcrud::get_instance();


if ($r[0]["reportType"] == 'Query'){
    $data->query($r[0]["ReportSQL"]);
}else{
    $data->table($r[0]["ReportTable"]);
}

$data->order_by($r[0]["orderColumn"],$r[0]["orderAsc"]);
$data->table_name($r[0]["ReportTitle"])
    ->set_lang('return','Return to ' . $r[0]["ReportTitle"]);
if ($r[0]["whereTxt"]) $data->where('' . $r[0]["whereTxt"] . '');
$data->columns($r[0]["gridColumns"]);
$data->fields($r[0]["gridFields"]);

if ($reportid == 500) {
    $data->subselect('Quick','SELECT COUNT(*) FROM `reports_favourite` WHERE username = "' . $username . '" AND report_id = {rid}');
    $data->change_type('Quick', 'bool');
    $data->highlight('Quick','!=','0','#b1c779');

    $data->button('#', "Add to favourite reports", 'glyphicon glyphicon-link icon-arrow-up', 'btn xcrud-action', array(
        'data-action' => 'add_fav_report',
        'data-task' => 'action',
        'data-username' => $username,
        'data-report_name' => '{ReportTitle}',
        'data-report_category' => '{reportCategory}',
        'data-link' => '{link}',
        'data-primary' => '{rid}'),
        array('Quick', '=', '0'));
    $data->create_action('add_fav_report','add_fav_report');
}

if ($r[0]["column_patternYN"]) $data->column_pattern($r[0]["column_patternfield"], $r[0]["column_pattern"]);
if ($r[0]["column_patternYN2"]) $data->column_pattern($r[0]["column_patternfield2"], $r[0]["column_pattern2"]);
if ($r[0]["isJoin"]) $data->join($r[0]["isJoinKey"],$r[0]["joinTable"],$r[0]["joinTableField"]);
if ($r[0]["textCut1"]) $data->column_cut($r[0]["textCut1"],$r[0]["textCutField1"]);
if ($r[0]["textCut2"]) $data->column_cut($r[0]["textCut2"],$r[0]["textCutField2"]);
if ($r[0]["highlight"]){$h = explode(':',$r[0]["highlight"]); $data->highlight($h[0], $h[1], $h[2], $h[3]);}
if ($r[0]["highlight2"]){$h = explode(':',$r[0]["highlight2"]); $data->highlight($h[0], $h[1], $h[2], $h[3]);}


if ($r[0]["subselect"]) $data->subselect($r[0]["subselect"], $r[0]["subselect_query"]);
if ($r[0]["subselect2"]) $data->subselect($r[0]["subselect2"], $r[0]["subselect_query2"]);

if ($r[0]["unset_add"]) $data->unset_add();
if ($r[0]["unset_edit"]) $data->unset_edit();
if ($r[0]["unset_remove"]) $data->unset_remove();
if ($r[0]["unset_limitlist"]) $data->unset_limitlist();
if ($r[0]["unset_title"]) $data->unset_title();
if ($r[0]["unset_pagination"]) $data->unset_pagination();
$data->limit($r[0]["pagerowsize"]);

switch ($r[0]["gridLabels"]){
    case 1: $data->label(array('SectorCode' => 'Code','ThematicArea'=>'Thematic Area','SectorObjCode'=>'ObjCode','SectorName' => 'Sector','SectorOutcomeCode'=>'Code','SectorOutcome'=>'Sector Outcome')); break;
    case 2: $data->label(array('Code' => 'Code','NDPObjectives'=>'NDP Objectives')); break;
    case 3: $data->label(array('ProcurementMethod'=>'Procurement Method','ProcurementType'=>'Procurement Type','Ceiling'=>'Ceiling','ThresholdValue'=>'Threshold Value','LeadPeriod'=>'Lead Period')); break;
    case 4: $data->label(array('ParastatalCode'=>'Parastatal Code','AcronymDescription'=>'Acronym Description')); break;
    case 7: $data->label(array('ClassCode'=>'Class Code','ClassificationName'=>'Classification Name')); break;
    case 6: $data->label(array('OutputClassCode'=>'Output Class Code','ItemCode'=>'Item Code','ItemName'=>'Item Name','IsArrears'=>'Is Arrears','IsStatutory'=>'Is Statutory','IsTax'=>'Is Tax','IsWage'=>'Is Wage','IsProcured'=>'Is Procured')); break;
    case 8: $data->label(array('MDATypeID' => 'TypeID','MDATypeName'=>'Type Name')); break;
    case 9: $data->label(array('SectorCode'=>'SCode','VoteCode'=>'Vote','VoteName'=>'Vote Name','ProgramCode'=>'PCode','ProgrammeName'=>'Programme','ProgramObjective'=>'Program Objective','ResponsibleOfficer'=>'Responsible Officer','VoteMission'=>'Vote Mission','MDATypeName'=>'Vote Type','ThematicArea'=>'Thematic Area','SubProgramCode'=>'SPCode','SubProgramName'=>'Department / Project','ProjectObjectives'=>'Department / Project Objectives','KeyOutputCode'=>'KOCode','KeyOutputDescription'=>'Key Output Description','KeyIndicatorName'=>'Key Performance Indicator','MethodofMeasurement'=>'Method of Measure','SourceofData'=>'Source of Data')); break;
    case 99: $data->label(array('itemsList' => 'Basic Report','rid' => 'ID','ReportTitle'=>'Report Title','reportCategory'=>'Report Category','ReportDescription'=>'Report Description')); break;
}

switch ($r[0]["ctypeText1"]){
    case "price": $data->change_type($r[0]["ctypeField1"], 'price', '0', array('decimals'=>'0')); $data->column_class($r[0]["ctypeField1"],'align-right'); break;
    case "shillings": $data->change_type($r[0]["ctypeField1"], 'price','0', array('suffix'=>' /=','decimals'=>'0')); $data->column_class($r[0]["ctypeField1"],'align-right'); break;
    case "number": $data->change_type($r[0]["ctypeField1"], 'price','0', array('suffix'=>' ','decimals'=>'0')); $data->column_class($r[0]["ctypeField1"],'align-right'); break;
    case "2decimal": $data->change_type($r[0]["ctypeField1"], 'price', '0', array('decimals'=>'2')); $data->column_class($r[0]["ctypeField1"],'align-right'); break;
    case "float": $data->change_type($r[0]["ctypeField1"], 'float', '', array('decimals'=>'0', 'separator'=>',')); $data->column_class($r[0]["ctypeField1"],'align-right'); break;
}
switch ($r[0]["ctypeText2"]){
    case "price": $data->change_type($r[0]["ctypeField2"], 'price', '0', array('decimals'=>'0')); $data->column_class($r[0]["ctypeField2"],'align-right'); break;
    case "shillings": $data->change_type($r[0]["ctypeField2"], 'price','0', array('suffix'=>' /=','decimals'=>'0')); $data->column_class($r[0]["ctypeField2"],'align-right'); break;
    case "number": $data->change_type($r[0]["ctypeField2"], 'price','0', array('suffix'=>' ','decimals'=>'0')); $data->column_class($r[0]["ctypeField2"],'align-right'); break;
    case "2decimal": $data->change_type($r[0]["ctypeField2"], 'price', '0', array('decimals'=>'2')); $data->column_class($r[0]["ctypeField2"],'align-right'); break;
    case "float": $data->change_type($r[0]["ctypeField2"], 'float', '', array('decimals'=>'0')); $data->column_class($r[0]["ctypeField2"],'align-right'); break;
}

if (isset($_GET['select'])) {
    switch ($_GET['select']){
        case 1: if (($_GET[$r[0]["filterColumn"]])) $data->where($r[0]["filterColumn"] . ' =', $_GET[$r[0]["filterColumn"]]); break;
        case 2: if (($_GET[$r[0]["filterColumn2"]])) $data->where($r[0]["filterColumn2"] . ' =', $_GET[$r[0]["filterColumn2"]]); break;
        case 3: if (($_GET[$r[0]["filterColumn3"]])) $data->where($r[0]["filterColumn3"] . ' =', $_GET[$r[0]["filterColumn3"]]); break;
    }
}

?>

<script>
    $('nav').find('a[href$="X/<?php echo $r[0]["menuURL"] ?>"]').parent('li').addClass("active");
</script>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-8 col-lg-9">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
            <?php echo $r[0]["ReportTitle"] ?>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h4><span class="txt-color-blue"> <i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i> <?php echo $r[0]["itemsList"] ?></span></h4>
            </li>
        </ul>
    </div>
</div>
<div class="alert alert-info"><button class="btn bg btn-labeled btn-md btn-success" onclick="location.href='<?php echo $r[0]["return_link"] ?>';"><span class="btn-label"><i class="fa fa-chevron-left"></i></span> <?php echo $r[0]["return_link_text"] ?></button>
    <?php
    if ($r[0]["hasFilter"]) {
        $db->query($r[0]["filterSQL"]);
        $filter_list = $db->result_array();
        ?>
        <div class="btn-group">
            <button class="btn btn-default btn-xs" onclick="location.href='#X/<?php echo $r[0]["filterURL"] ?>?id=<?php echo $reportid ?>';"> <?php echo $r[0]["filterText"] ?> </button>
            <button class="btn btn-success class-1 class-2 class-custom btn-xs dropdown-toggle" data-toggle="dropdown" data-custom-attr="12345" aria-expanded="false"><span class="caret"></span></button>
            <ul role="menu" class="dropdown-menu multi-level scrollable-menu">
                <li><a href="#X/<?php echo $r[0]["filterURL"] ?>?id=<?php echo $reportid ?>"> -- Show all records -- </a></li>
                <li class="divider">-</li>
                <?php
                for ($count=0;$count<count($filter_list);$count++){
                    ?>
                    <li><a href="#X/<?php echo $r[0]["filterURL"] ?>?id=<?php echo $reportid ?>&select=1&SelectBy=<?php echo $r[0]["filterColumn"] ?>&<?php echo $r[0]["filterColumn"] ?>=<?php echo $filter_list[$count][0] ?>"><?php echo $filter_list[$count][1] ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>
    <!-- Filter 2 -->
    <?php
    if ($r[0]["hasFilter2"]) {
        $db->query($r[0]["filterSQL2"]);
        $filter_list = $db->result_array();
        ?>
        <div class="btn-group">
            <button class="btn btn-default btn-xs" onclick="location.href='#X/<?php echo $r[0]["filterURL"] ?>?id=<?php echo $reportid ?>';"> <?php echo $r[0]["filterText2"] ?> </button>
            <button class="btn btn-success class-1 class-2 class-custom btn-xs dropdown-toggle" data-toggle="dropdown" data-custom-attr="12345" aria-expanded="false"><span class="caret"></span></button>
            <ul role="menu" class="dropdown-menu multi-level scrollable-menu">
                <li><a href="#X/<?php echo $r[0]["filterURL2"] ?>?id=<?php echo $reportid ?>"> -- Show all records -- </a></li>
                <li class="divider">-</li>
                <?php
                for ($count=0;$count<count($filter_list);$count++){
                    ?>
                    <li><a href="#X/<?php echo $r[0]["filterURL2"] ?>?id=<?php echo $reportid ?>&select=2&SelectBy=<?php echo $r[0]["filterColumn2"] ?>&<?php echo $r[0]["filterColumn2"] ?>=<?php echo $filter_list[$count][0] ?>"><?php echo $filter_list[$count][1] ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>
    <!-- Filter 3 -->
    <?php
    if ($r[0]["hasFilter3"]) {
        $db->query($r[0]["filterSQL3"]);
        $filter_list = $db->result_array();
        ?>
        <div class="btn-group">
            <button class="btn btn-default btn-xs" onclick="location.href='#X/<?php echo $r[0]["filterURL"] ?>?id=<?php echo $reportid ?>';"> <?php echo $r[0]["filterText3"] ?> </button>
            <button class="btn btn-success class-1 class-2 class-custom btn-xs dropdown-toggle" data-toggle="dropdown" data-custom-attr="12345" aria-expanded="false"><span class="caret"></span></button>
            <ul role="menu" class="dropdown-menu multi-level scrollable-menu">
                <li><a href="#X/<?php echo $r[0]["filterURL3"] ?>?id=<?php echo $reportid ?>"> -- Show all records -- </a></li>
                <li class="divider">-</li>
                <?php
                for ($count=0;$count<count($filter_list);$count++){
                    ?>
                    <li><a href="#X/<?php echo $r[0]["filterURL3"] ?>?id=<?php echo $reportid ?>&select=3&SelectBy=<?php echo $r[0]["filterColumn3"] ?>&<?php echo $r[0]["filterColumn3"] ?>=<?php echo $filter_list[$count][0] ?>"><?php echo $filter_list[$count][1] ?></a></li>
                    <?php
                }
                ?>
            </ul>
        </div>
        <?php
    }
    ?>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-greenDark" id="wid-id-3" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-togglebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2> <?php echo $r[0]["ReportTitle"] ?> </h2>

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
                        echo '<h4>' . $r[0]["Report_Notes"] . '</h4>';
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
<!--<div class="row"><div class="col-md-2"><button class="save btn btn-success">Save sort order</button></div><div class="alert alert-success col-md-10" id="response" role="alert">Sort and save :)</div></div>-->
<script>
    //$( "tbody" ).sortable();
    // var btn_save = $('button.save'), div_response = $('#response');
    //
    // var ul_sortable = $('.ui-sortable');
    //
    // btn_save.on('click', function(e) {
    //     e.preventDefault();
    //
    //     var order_list = [];
    //     //console.log($(ul_sortable).children());
    //     $(ul_sortable).children().each(function (index) {
    //         //console.log($(ul_sortable).children()[index].cells[2].innerText);
    //         order_list.push([$(ul_sortable).children()[index].cells[1].innerText,index,$(ul_sortable).children()[index].cells[2].innerText]);
    //     });
    //     console.log(order_list);
    //
    //     div_response.text('Saving.......');
    //     $.ajax({
    //         data: {data:order_list},
    //         type: 'POST',
    //         url: 'X/refresh_order',
    //         success:function(result) {
    //             div_response.text(result);
    //         }
    //     });
    // });

</script>
<script type="text/javascript">



    pageSetUp();


    var pagefunction = function() {

    };

    // load related plugins

</script>
<style>
    .scrollable-menu {
        height: auto;
        max-height: 500px;
        overflow-x: hidden;
    }
    .xcrud-top-actions{
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
        color: #9c9d7b;
    }
    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #eeede9;}
    .fc-head-container thead tr, .table thead tr{
        background-color:#ccc5b1;
        border: 1px solid #b3ac98;
        background-image: -o-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -moz-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -webkit-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -ms-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: linear-gradient(to bottom, #e5deca 0%, #ccc5b1 100%);
        -webkit-box-shadow: inset 0 1px 0 #fef7e3;
        -moz-box-shadow: inset 0 1px 0 #fef7e3;
        box-shadow: inset 0 1px 0 #fef7e3;
        text-shadow: 0 1px 0 #fef7e3;
        color: #3a6b58;
        height: 40px;
        font-size: 14px;
    }
    .alert{
        font-size: 16px;
    }
</style>