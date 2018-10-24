<?php
require_once("inc/init.php");
require_once("queryX.php");
$pagedesc = "Details of Vote - Ministry, Department of Agency";
$sqladd="";
$votecode="001";
if (isset($_GET['Vote'])) {
    $votecode = $_GET['Vote'];
}
$overviewdataset = getcounts("SELECT * FROM votesview WHERE VoteCode = ".$votecode);
$progdataset = getcounts("SELECT ProgrammeName, SubProgramName, ProjectObjectives FROM `view_subprogrammes` WHERE VoteCode = ".$votecode);
$keyoutputsdataset = getcounts("SELECT ProgrammeName, KeyOutputDescription FROM `view_keyoutputs` WHERE VoteCode = ".$votecode);
$kpisdataset = getcounts("SELECT ProgrammeName, KeyOutputDescription, KeyIndicatorName, Indicator_Measure, Indicator_Type, MethodofMeasurement, SourceofData FROM `view_kpis` WHERE VoteCode = ".$votecode);
$MDAlist = getcounts("SELECT VoteCode, VoteName FROM `votes` ORDER BY VoteCode ASC");
$row = $overviewdataset->fetch_assoc();
$VoteCodex = ''.$row["VoteCode"];
$VoteName = ''.$row["VoteName"];
$MDAType = ''.$row["MDATypeName"];
$SectorCode = ''.$row["SectorCode"];
$Sector = ''.$row["Sector"];
$ThematicArea = ''.$row["ThematicArea"];
$VoteMission = ''.$row["VoteMission"];
?>
<script language="javascript">
    drawBreadCrumb(["Vote Details", "<?php echo $VoteName; ?>"]);
    function submitter(showed) {
        document.getElementById("SelectBy").value = showed.name;
        this.selectMDA.submit();
    }
</script>
<style>
    .overview{
        border-color: #b7c5c0;
        color: #5781a8;
        background-color: #ffffff;
    }
</style>

<div class="row">
    <div>
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-institution fa-fw "></i>
            <?php echo $row["VoteCode"] . " - " . $row["VoteName"] ?>
        </h1>
    </div>
</div>

<div class="alert alert-info">
    <form name="selectMDA" class="smart-form">
        <strong>Select Vote:</strong>  :-
        <input type="hidden" id="SelectBy" name="SelectBy" value="Sector" />
        <label class="input-sm">
            <select name="Vote" onchange="document.location.href='#X/votedetails?SelectBy=Vote&Vote='+this.value">
                <option value="0">Select Ministry, Department or Agency</option>
                <?php
                while ($row = $MDAlist->fetch_row()){
                    ?>
                    <tr>
                        <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                    </tr>
                    <?php
                }
                ?>
            </select> <i></i>
        </label>
    </form>
</div>

<section id="widget-grid" class="">

    <?php
    $overviewtext = '<div>';
    $overviewtext = $overviewtext . '<div class="col-xs-3 col-md-2 alert alert-info overview">Vote</div><div class="col-xs-15 col-md-10 alert alert-info overview">';
    $overviewtext = $overviewtext . $VoteCodex . ' - ' . $VoteName;
    $overviewtext = $overviewtext . '<span class="label bg-color-greenLight pull-right">' . $MDAType . '</span></div>';
    $overviewtext = $overviewtext . '<div class="col-xs-3 col-md-2 alert alert-info overview">Sector<br>Thematic Area</div><div class="col-xs-15 col-md-10 alert alert-info overview" overview>' . $SectorCode . ' - ' . $Sector . '<br>' . $ThematicArea . '</div>';
    $overviewtext = $overviewtext . '<div class="alert alert-info overview"><strong>Mission:</strong><br>' . $VoteMission . '</div>';
    $overviewtext = $overviewtext . '</div>';

    $progtext = '<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">';
    $progtext = $progtext . '<header><span class="widget-icon"> <i class="fa fa-table"></i> </span><h2>Programmes, Departments and Projects</h2></header><div>';
    $progtext = $progtext . '<div class="widget-body no-padding"><table id="datatable_tabletools" class="table table-striped table-bordered table-hover" width="100%"><thead>';
    $progtext = $progtext . '<tr><th>Programme</th><th data-class="expand">Department / Project</th><th data-hide="phone">Objectives</th></tr></thead><tbody>';
    while ($row = $progdataset->fetch_row()){
        $d0 = ''.$row[0]; $d1 = ''.$row[1]; $d2 = ''.$row[2];
        $progtext = $progtext . '<tr><td>' . $d0 . '</td><td>' . $d1 . '</td><td>' . $d2 . '</td></tr>';
    }
    $progtext = $progtext . '</tbody></table></div></div></div>';

    $keyoutputtext = '<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">';
    $keyoutputtext = $keyoutputtext . '<header><span class="widget-icon"> <i class="fa fa-table"></i> </span><h2>Key Outputs</h2></header><div>';
    $keyoutputtext = $keyoutputtext . '<div class="widget-body no-padding"><table id="datatable_tabletoolsx" class="table table-striped table-bordered table-hover" width="100%"><thead>';
    $keyoutputtext = $keyoutputtext . '<tr><th>No</th><th data-class="expand">Department / Programme</th><th data-hide="phone">Key Output</th></tr></thead><tbody>';
    $i=1;
    while ($row = $keyoutputsdataset->fetch_row()){
        $d0 = ''.$row[0]; $d1 = ''.$row[1];
        $keyoutputtext = $keyoutputtext . '<tr><td>' . $i++ . '</td><td>' . $d0 . '</td><td>' . $d1 . '</td></tr>';
    }
    $keyoutputtext = $keyoutputtext . '</tbody></table></div></div></div>';

    $kpitext = '<div class="jarviswidget jarviswidget-color-blueDark" id="wid-id-3" data-widget-editbutton="false">';
    $kpitext = $kpitext . '<header><span class="widget-icon"> <i class="fa fa-table"></i> </span><h2>Key Performance Indicators</h2></header><div>';
    $kpitext = $kpitext . '<div class="widget-body no-padding"><table id="datatable_tabletoolsy" class="table table-striped table-bordered table-hover" width="100%"><thead>';
    $kpitext = $kpitext . '<tr><th>No</th><th data-class="expand">Programme</th><th data-class="expand">KeyOutput</th><th data-hide="phone">Key Indicator</th><th data-hide="phone">Indicator Measure</th><th data-hide="phone">Indicator Type</th><th data-hide="phone">Measurement</th><th data-hide="phone">Data Source</th></tr></thead><tbody>';
    $i=1;
    while ($row = $kpisdataset->fetch_row()){
        $d0 = ''.$row[0]; $d1 = ''.$row[1]; $d2 = ''.$row[2]; $d3 = ''.$row[3]; $d4 = ''.$row[4]; $d5 = ''.$row[5]; $d6 = ''.$row[6];
        $kpitext = $kpitext . '<tr><td>' . $i++ . '</td><td>' . $d0 . '</td><td>' . $d1 . '</td><td>' . $d2 . '</td><td>' . $d3 . '</td><td>' . $d4 . '</td><td>' . $d5 . '</td><td>' . $d6 . '</td></tr>';
    }
    $kpitext = $kpitext . '</tbody></table></div></div></div>';





    // tab in widget
    $_ui->start_track();

    // smartui code
    $tabs = array(
        'Overview' => 'Overview',
        'Programmes' => 'Programmes, Departments and Projects',
        'KeyOutputs' => 'Key Outputs',
        'KPIs' => 'Key Performance Indicators'
    );
    $tab = $_ui->create_tab($tabs);

    $tab->content('Overview', $overviewtext)
        ->icon('Overview', 'fa fa-home')
        ->content('Programmes', $progtext)
        ->icon('Programmes', 'fa fa-slack')
        ->content('KeyOutputs', $keyoutputtext)
        ->icon('KeyOutputs', 'fa fa-cube')
        ->content('KPIs', $kpitext)
        ->icon('KPIs', 'fa fa-chart');

    $tab->options('bordered', true)
        ->options('widget', true);
    $tab->active('Overview', true);

    $tab_html = $tab->print_html(true);

    echo $tab_html;

    ?>

</section>



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

    var pagefunction = function() {
        //console.log("cleared");
        $('nav').find('a[href$="X/MinistriesDeptsAgencies.php"]').parent('li').addClass("active");

        /* // DOM Position key index //

         l - Length changing (dropdown)
         f - Filtering input (search)
         t - The Table! (datatable)
         i - Information (records)
         p - Pagination (paging)
         r - pRocessing
         < and > - div elements
         <"#id" and > - div with an id
         <"class" and > - div with a class
         <"#id.class" and > - div with an id and class

         Also see: http://legacy.datatables.net/usage/features
         */

        /* BASIC ;*/
        //var responsiveHelper_dt_basic = undefined;
        //var responsiveHelper_datatable_fixed_column = undefined;
        var responsiveHelper_datatable_col_reorder = undefined;
        var responsiveHelper_datatable_tabletools = undefined;

        var breakpointDefinition = {
            tablet : 1024,
            phone : 480
        };


        /* END BASIC */


    };

    loadScript("js/plugin/datatables/jquery.dataTables.min.js", function(){
        loadScript("js/plugin/datatables/dataTables.colVis.min.js", function(){
            loadScript("js/plugin/datatables/dataTables.tableTools.min.js", function(){
                loadScript("js/plugin/datatables/dataTables.bootstrap.min.js", function(){
                    loadScript("js/plugin/datatable-responsive/datatables.responsive.min.js", pagefunction)
                });
            });
        });
    });


    /*
     * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
     * eg alert("my home function");
     */



</script>
