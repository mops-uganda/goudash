<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/govtprojects';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);

require ('../lib/xcrud/xcrud.php');
require_once("inc/init.php");


$user = Auth::user();

$data = Xcrud::get_instance();
$data->table('subprogrammes');
$data->join('VoteCode','votes','VoteCode');
$data->where('LENGTH(SubProgramCode) = 4');
$data->order_by('VoteCode','asc');
$data->table_name('List of Government Projects, Tick on the Left to Mark as a Priority, Strategic Project');
$data->columns('SubProgramCode,SubProgramName,ID,votes.VoteName,Priority');
$data->column_cut(250,'ProgrammeName');
$data->column_cut(250,'SubProgramName');
$data->column_cut(250,'ProjectObjectives');
$data->label(array('votes.VoteName'=>'Vote','ID'=>'Details','VoteName'=>'Ministry/Department/Agency','SubProgramCode'=>'Code','SubProgramName'=>'Project','ProjectObjectives'=>'Department / Project Objective'));
$data->column_pattern('ID', '<a class="btn btn-info btn-xs" href="#X/projectdetails?id={id}&Tasks_Complete={Tasks_Complete}&Tasks_Almost_Complete={Tasks_Almost_Complete}&Code={SubProgramCode}&ProjectName={SubProgramName}">Details</a>');
$data->column_pattern('SubProgramName', '<a href="#" class="xcrud-action" data-task="view" data-primary="{ID}">{value}</a>');
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_title();
$data->limit(25);
$data->highlight('Priority', '=', "1", '#bee89e');

if (($user->Strategic_Projects) > 1){
    $data->create_action('publish', 'publish_action'); // action callback, function publish_action() in functions.php
    $data->create_action('unpublish', 'unpublish_action');
    $data->button('#', 'Normal Project', 'icon-close glyphicon glyphicon-star-empty', 'xcrud-action',
        array(  // set action vars to the button
            'data-task' => 'action',
            'data-action' => 'publish',
            'data-primary' => '{ID}'),
        array(  // set condition ( when button must be shown)
            'Priority',
            '!=',
            '1')
    );
    $data->button('#', 'Priority Strategic Project', 'icon-checkmark glyphicon glyphicon-ok', 'xcrud-action',
        array(
            'data-task' => 'action',
            'data-action' => 'unpublish',
            'data-primary' => '{ID}'),
        array(
            'Priority',
            '=',
            '1'));
}

if (isset($_GET['SelectBy'])) {
    $data->where('VoteCode =', $_GET['Vote']);
}
$db = Xcrud_db::get_instance();
$db->query('SELECT COUNT(*) as counter FROM view_subprogrammes WHERE LENGTH(SubProgramCode) = 4');
$counter = $db->row()["counter"];
$db->query('SELECT DISTINCT VoteCode, VoteName FROM `votes` ORDER BY VoteCode ASC');
$list = $db->result();
?>

<script>
    $('nav').find('a[href$="X/govtprojects.php"]').parent('li').addClass("active");
</script>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
            All Government Projects
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h4> <?php echo $counter; ?> <span class="txt-color-blue"> <i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i> Projects</span></h4>
            </li>
        </ul>
    </div>
</div>

<div class="alert alert-info">
    <strong>Filter:</strong> by Vote (Ministry, Deptartment or Agency) :-
    <input type="hidden" id="SelectBy" name="SelectBy" value="Sector" />
    <label class="input-sm">
        <select name="Vote" onchange="document.location.href='#X/govtprojects?SelectBy=Vote&Vote='+this.value">
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
                    <h2>Government Projects</h2>

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
                        <h5>List of Government Projects, <strong>Tick on the Right Button </strong> to Mark as a Priority, Strategic Project</h5>
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
