<?php
require_once("inc/init.php");
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('votesview');
$data->unique('VoteCode');
$data->order_by('VoteCode','asc');
$data->table_name('List of Ministries, Departments and Agencies');
$data->columns('VoteCode,VoteName,MDATypeName,Sector,ThematicArea');
$data->fields('VoteCode,VoteName,MDATypeName,VoteMission,SectorCode,Sector,ThematicArea');
$data->label(array('VoteCode'=>'Vote','VoteName'=>'Ministry/Department/Agency','MDATypeName'=>'Vote Type','VoteMission'=>'Mission','ThematicArea'=>'Thematic Area'));
$data->column_pattern('VoteName', '<a href="#X/votedetails?Vote={VoteCode}">{value}</a>');
$data->column_pattern('Sector', '<a href="#X/sectordetails?sectorid={SectorCode}&sector={value}">{value}</a>');
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_title();
$data->limit(25);

$where = '';
$ministries = 0;
$agencies = 0;
$departments = 0;

if (isset($_GET['SelectBy'])) {
    switch ($_GET['SelectBy']){
        case "Sector": $data->where('SectorCode =', $_GET['Sector']); $where = 'AND SectorCode = ' . $_GET['Sector']; break;
        case "MDAType": $data->where('MDAType =', $_GET['MDAType']); $where = 'AND MDAType = ' . $_GET['MDAType']; break;
        default: break;
    }
}

$db = Xcrud_db::get_instance();
$sql = 'SELECT DISTINCT MDAType, count(*) as counter FROM votesview WHERE (MDAType=1 OR MDAType=2 OR MDAType=3) ' . $where . ' GROUP BY MDAType';
$db->query($sql);
$array = $db->result();
$sql = 'SELECT SectorCode, Sector FROM sectors';
$db->query($sql);
$sector_list = $db->result();

$txt='';

?>

<script>
    $('nav').find('a[href$="X/MinistriesDeptsAgencies.php"]').parent('li').addClass("active");
</script>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
            Ministries, Depts & Agencies
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <?php
            $others_display = true;
            if (isset($_GET['SelectBy'])) {
                if ($_GET['MDAType']){
                    $others_display = false;
                    switch ($_GET['MDAType']){
                        case 1: $txt = '<h3>' . $array[0]["counter"] . ' Ministries</h3>'; break;
                        case 2: $txt = '<h3>' . $array[0]["counter"] . ' Departments</h3>'; break;
                        case 3: $txt = '<h3>' . $array[0]["counter"] . ' Agencies</h3>'; break;
                        case 10: $txt = '<h3>' . $array[0]["counter"] . ' Referral Hospitals</h3>'; break;
                        case 11: $txt = '<h3>' . $array[0]["counter"] . ' Universities</h3>'; break;
                        case 12: $txt = '<h3>' . $array[0]["counter"] . ' Missions Abroad</h3>'; break;
                    }
                }
                echo $txt;
            }
            if ($others_display) {
                ?>
            <li class="sparks-info">
                <h4> <?php $num = ($array[0]["counter"]);
                    echo $num;
                    $totalMDAs = $num; ?> <span class="txt-color-blue"> <i class="fa fa-arrow-circle-up"
                                                                           data-rel="bootstrap-tooltip"
                                                                           title="Increased"></i> Ministries</span>
                </h4>
            </li>
            <li class="sparks-info">
                <h4> <?php $num = ($array[1]["counter"]);
                    echo $num;
                    $totalMDAs = $totalMDAs + $num; ?> <span class="txt-color-purple"><i
                                class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;Departments</span>
                </h4>
            </li>
            <li class="sparks-info">
                <h4> <?php $num = ($array[2]["counter"]);
                    echo $num;
                    $totalMDAs = $totalMDAs + $num; ?> <span class="txt-color-green"><i
                                class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;Agencies</span>
                </h4>
            </li>
            <li class="sparks-info">
                <h4> <?php echo $totalMDAs; ?> <span class="txt-color-blueDark"><i class="fa fa-arrow-circle-up"
                                                                                   data-rel="bootstrap-tooltip"
                                                                                   title="Increased"></i>&nbsp;Total</span>
                </h4>
            </li>
            <?php
            }
            ?>
        </ul>
    </div>
</div>

<div class="alert alert-info">
        <strong>Filter:</strong> Ministries, Depts and Agencies :-
        <input type="hidden" id="SelectBy" name="SelectBy" value="Sector" />
        <label class="input-sm">
            <select name="MDAType" id="MDAType" onchange="document.location.href='#X/MinistriesDeptsAgencies?SelectBy=MDAType&MDAType='+this.value+'&Sector=0'">
                <option value="0">Filter by Ministry, Department or Agency</option>
                <option value="1">Ministry</option>
                <option value="2">Department</option>
                <option value="3">Agency</option>
                <option value="10">Referral Hospital</option>
                <option value="12">Missions Abroad</option>
                <option value="11">University</option>
            </select> <i></i>
        </label>
        <label class="input-sm">
            <select name="Sector" onchange="document.location.href=this.value"">
                <option value="0">Select Sector</option>
                <?php
                for ($count=0;$count<count($sector_list);$count++){
                    ?>
                        <option value="#X/MinistriesDeptsAgencies?SelectBy=Sector&MDAType=0&Sector=<?php echo $sector_list[$count]["SectorCode"] ?>"><?php echo $sector_list[$count]["Sector"] ?></option>
                    <?php
                }
                ?>
            </select> <i></i>
        </label>
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
                    <h2>Ministries, Departments and Agencies</h2>

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

