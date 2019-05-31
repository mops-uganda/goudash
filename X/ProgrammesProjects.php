<?php
require_once("inc/init.php");

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('view_subprogrammes');
$data->order_by('VoteCode','asc');
$data->table_name('List of Government Programmes / Projects');
$data->columns('VoteName,ProgrammeName,SubProgramName,ProjectObjectives');
$data->fields('VoteName,ProgrammeName,SubProgramName,ProjectObjectives');
$data->column_cut(250,'ProgrammeName');
$data->column_cut(250,'SubProgramName');
$data->column_cut(250,'ProjectObjectives');
$data->label(array('VoteCode'=>'Vote','VoteName'=>'Ministry/Department/Agency','ProgrammeName'=>'Programme','SubProgramName'=>'Department / Project','ProjectObjectives'=>'Department / Project Objective'));
$data->column_pattern('VoteName', '<a href="#X/votedetails?Vote={VoteCode}">{value}</a>');
$data->column_pattern('ProgrammeName', '<a href="#X/progdetails?ID={ProgrammeNameID}&SectorCode={SectorCode}&VoteCode={VoteCode}&ProgramCode={ProgramCode}&Programme={ProgrammeName}">{value}</a>');
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_title();
$data->limit(25);


if (isset($_GET['SelectBy'])) {
    $data->where('VoteCode =', $_GET['Vote']);
}
$db = Xcrud_db::get_instance();
$db->query('SELECT COUNT(*) as counter FROM view_subprogrammes');
$counter = $db->row()["counter"];
$db->query('SELECT DISTINCT VoteCode, VoteName FROM `votes` ORDER BY VoteCode ASC');
$list = $db->result();
?>

<script>
    $('nav').find('a[href$="X/ProgrammesProjects"]').parent('li').addClass("active");
</script>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
            Govt Programmes / Projects
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h4> <?php echo $counter; ?> <span class="txt-color-blue"> <i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i> Departments / Projects</span></h4>
            </li>
        </ul>
    </div>
</div>

<div class="alert alert-info">
        <strong>Filter:</strong> by Vote (Ministry, Deptartment or Agency) :-
        <input type="hidden" id="SelectBy" name="SelectBy" value="Sector" />
        <label class="input-sm">
            <select name="Vote" onchange="document.location.href='#X/ProgrammesProjects?SelectBy=Vote&Vote='+this.value">
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

                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Government Sub Programmes and Projects</h2>

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
