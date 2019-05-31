<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/GovernmentProgrammes';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);

require_once("inc/init.php");
$pagedesc = "List of Government Departments (in MDAs)";

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('view_programmes');
$data->order_by('VoteCode','asc');
$data->table_name('List of Government Departments / Votefunctions');
$data->columns('VoteCode,VoteName,ProgrammeName,ProgramObjective');
$data->fields('VoteCode,VoteName,ProgrammeName,ProgramObjective');
$data->column_cut(250,'ProgrammeName');
$data->column_cut(250,'ProgramObjective');
$data->label(array('VoteCode'=>'Vote','VoteName'=>'Ministry/Department/Agency','ProgrammeName'=>'Government Programme','ProgramObjective'=>'Program Objective'));
$data->column_pattern('VoteName', '<a href="#X/votedetails?Vote={VoteCode}">{value}</a>');
$data->column_pattern('ProgrammeName', '<a href="#X/progdetails?ID={primary_key}&SectorCode={SectorCode}&VoteCode={VoteCode}&ProgramCode={ProgramCode}&Programme={ProgrammeName}">{value}</a>');
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_title();
$data->limit(25);

$VoteName = 'Government Departments / Programmes';
$Vote = '';
if (isset($_GET['Vote'])) {
    $data->where('VoteCode =', $_GET['Vote']);
    $VoteName = $_GET['VoteName'];
    $Vote = $_GET['Vote'];
}

$db = Xcrud_db::get_instance();
$sql = 'SELECT COUNT(*) as counter FROM view_programmes';
$db->query($sql);
$array = $db->result();
$sql = 'SELECT DISTINCT VoteCode, VoteName FROM `votes` ORDER BY VoteCode ASC';
$db->query($sql);
$list = $db->result();
?>

<script>
    $('nav').find('a[href$="X/GovernmentProgrammes"]').parent('li').addClass("active");
</script>
<div class="row">
    <div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
            <?php echo $Vote.': '.$VoteName ?>
        </h1>
    </div>
    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h4> <?php echo ($array[0]["counter"]); ?> <span class="txt-color-blue"> <i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i> Departments</span></h4>
            </li>
        </ul>
    </div>
</div>

<div class="alert alert-info">
        <strong>Filter:</strong> by Vote (Ministry, Deptartment or Agency) :-
        <input type="hidden" id="SelectBy" name="SelectBy" value="Sector" />
        <label class="input-sm">
            <select name="Vote" onchange="document.location.href='#X/GovernmentProgrammes?SelectBy=Vote&Vote='+this.value+'&VoteName='+this.options[this.selectedIndex].text">
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
                    <h2><?php echo $Vote.': '.$VoteName ?></h2>

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
                        include "xcrud_js.php";
                        ?>

                        <!-- Xcrud CSS -->
                        <link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
                        <link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">
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
