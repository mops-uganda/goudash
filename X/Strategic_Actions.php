<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

$NotStarted = 0;
$Ongoing = 0;
$Delayed = 0;
$OnHold = 0;
$Cancelled = 0;
$Completed = 0;

require_once("queryX.php");
$dataset = getcounts("SELECT meetID, meetName, meetTasksStatus, impProgress, meetTasksDeadline FROM `meetings` ORDER BY meetID DESC LIMIT 20");
$datacounter = getcounts("SELECT COUNT(*) as Counter, status FROM `meettasks` GROUP BY status");

while ($row = $datacounter->fetch_row()){
    switch ($row[1]){
        case "Not Started": $NotStarted = $row[0]; break;
        case "On going": $Ongoing = $row[0]; break;
        case "Delayed": $Delayed = $row[0]; break;
        case "On Hold": $OnHold = $row[0]; break;
        case "Cancelled": $Cancelled = $row[0]; break;
        case "Completed": $Completed = $row[0]; break;
        default: break;
    }
}

require ('../lib/xcrud/xcrud.php');
$tasks = Xcrud::get_instance();
$tasks->table('meettasks');
$tasks->join('meetID','meetings','meetID');
$tasks->order_by('meetTaskID','desc');
$tasks->table_name('List of Strategic Tasks and Actions');
$tasks->columns('meetTaskTitle');
$tasks->fields('meetTaskTitle,imProgress,meetings.meetName,meetTaskDescription,assigned_to,collaborators,start_date,deadline,priority,status');
$tasks->label(array('meetTaskTitle' => 'Task','meetings.meetName' => 'Meet / Event','meetTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'));
$tasks->column_pattern('meetTaskTitle', '<div>{meetTaskTitle}</div><span class="label label-success">{status}</span><div class="progress progress-xs"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%"></div></div>');
$tasks->change_type('meetType','select','','Cabinet Meeting,Annual Review,Event,HE Directive,Parliament Directive,PM Meeting');
$tasks->change_type('priority','select','','Low,Normal,High,Critical');
$tasks->change_type('status','select','','Not Started,On going,Delayed,Cancelled,Completed');
$tasks->unset_add();
$tasks->unset_edit();
$tasks->unset_remove();
$tasks->unset_limitlist();
$tasks->unset_csv();
$tasks->unset_search();
$tasks->unset_print();
$tasks->unset_title();
$tasks->unset_numbers();
$tasks->unset_pagination();
$tasks->limit(20);

$activitytimeline = Xcrud::get_instance();
$activitytimeline->table('meetactiontimelines');
$activitytimeline->join('meetID','meetings','meetID');
$activitytimeline->join('meetActionTask','meettasks','meetTaskID');
$activitytimeline->order_by('meetActionTimelinesID','desc');
$activitytimeline->table_name('Timelines');
$activitytimeline->columns('meetActionDate,meetActionTitle');
$activitytimeline->fields('meetActionDate,meetActionTitle,meettasks.meetTaskTitle,meetings.meetName,meetActionDescription,createdBy');
$activitytimeline->label(array('meetActionDate' => 'Activity Date','meetActionTitle' => 'Activity','meetings.meetName' => 'Meet / Event','meettasks.meetTaskTitle' => 'Task that Activity contributes to', 'meetActionDescription' => 'Description', 'createdBy' => 'Author'));
//$activitytimeline->column_pattern('meetTaskTitle', '<div>{meetTaskTitle}</div><div class="progress progress-xs"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%"></div></div>');
$activitytimeline->unset_add();
$activitytimeline->unset_edit();
$activitytimeline->unset_remove();
$activitytimeline->unset_limitlist();
$activitytimeline->unset_csv();
$activitytimeline->unset_search();
$activitytimeline->unset_print();
$activitytimeline->unset_title();
$activitytimeline->unset_numbers();
$activitytimeline->unset_pagination();
$activitytimeline->limit(20);


?>
<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h3 class="page-title txt-color-blueDark">
            <i class="fa fa-home fa-fw "></i>
            Strategic Actions Dashboard
        </h3>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h4> <?php echo $NotStarted;?> Tasks<span class="txt-color-blueDark"> <i class="fa fa-arrow-circle-left" data-rel="bootstrap-tooltip" title="Increased" ></i> Not Started</span></h4>
            </li>
            <li class="sparks-info">
                <h4> <?php echo $Ongoing;?> Tasks<span class="txt-color-blue"> <i class="fa fa-arrow-circle-right" data-rel="bootstrap-tooltip" title="Increased"></i> On going</span></h4>
            </li>
            <li class="sparks-info">
                <h4> <?php echo $Delayed;?> Tasks<span class="txt-color-red"> <i class="fa  fa-arrow-circle-o-left" data-rel="bootstrap-tooltip" title="Increased"></i> Delayed</span></h4>
            </li>
            <li class="sparks-info">
                <h4> <?php echo $OnHold;?> Tasks<span class="txt-color-purple"><i class="fa fa-arrow-circle-left" data-rel="bootstrap-tooltip" title="Increased"></i> On Hold</span></h4>
            </li>
            <li class="sparks-info">
                <h4> <?php echo $Cancelled;?> Tasks<span class="txt-color-redLight"><i class="fa fa-arrow-circle-down" data-rel="bootstrap-tooltip" title="Increased"></i> Cancel</span></h4>
            </li>
            <li class="sparks-info">
                <h4> <?php echo $Completed;?> Tasks<span class="txt-color-green"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i> Complete</span></h4>
            </li>
        </ul>
    </div>
</div>
<div class="row">
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4">
        <div class="jarviswidget jarviswidget-color-greenLight jarviswidget-sortable" id="wid-id-3" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
            <header><div class="jarviswidget-ctrls" role="menu">    <a href="#X/meetings?=<?php echo mt_rand(5, 500) ?>" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Meets and Events"><i class="fa fa-external-link "></i></a> </div>
                <span class="widget-icon"> <i class="fa fa-home"></i> </span>
                <h2>Strategic Meets and Events </h2>
            </header>
            <div>
                <div class="jarviswidget-editbox">
                </div>

                <!-- Meetings and Events Repeater content -->
                <?php
                $counter = 0;
                $color = "primary"; $color2 = "blueLight";
                while ($row = $dataset->fetch_row()){
                    switch ($row[2]){
                        case "Not Started": $color = "default"; $color2 = "blueLight"; break;
                        case "On going": $color = "primary"; $color2 = "blueDark"; break;
                        case "Delayed": $color = "warning"; $color2 = "redLight"; break;
                        case "On Hold": $color = "info"; $color2 = "yellow"; break;
                        case "Cancelled": $color = "danger"; $color2 = "redLight"; break;
                        case "Completed": $color = "success"; $color2 = "greenLight"; break;
                        default: $color = "default"; $color2 = "blueLight"; break;
                    }
                    ?>
                    <div>
                        <div><a href="#X/meetdetails?meetid=<?php echo $row[0]; ?>"> <span class="text"> <?php echo $row[1]; ?> <br></span></a>
                            <div><span class="label label-<?php echo $color; ?>"><?php echo $row[2]; ?></span> <span class="pull-right">Deadline: <?php echo $row[4]; ?></span></div>
                            <div class="progress progress-xs">
                                <div class="progress-bar bg-color-<?php echo $color2; ?>" style="width: <?php echo $row[3]; ?>%;"></div>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
                <!-- end Meetings and Events Repeater content -->

            </div>
            <!-- end widget div -->

        </div>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4">
        <div class="jarviswidget jarviswidget-color-blue jarviswidget-sortable" id="wid-id-5" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
            <header><div class="jarviswidget-ctrls" role="menu">    <a href="#X/actions.php" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Tasks and Actions"><i class="fa fa-expand "></i></a> </div>
                <span class="widget-icon"> <i class="fa fa-bar-chart-o"></i> </span>
                <h2>Key Actions and Tasks </h2>
            </header>
            <div>
                <div class="jarviswidget-editbox">
                </div>
                <?php echo $tasks->render(); ?>
            </div>
        </div>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-4">
        <div class="jarviswidget jarviswidget-color-purple jarviswidget-sortable" id="wid-id-9" data-widget-colorbutton="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false" role="widget">
            <header><div class="jarviswidget-ctrls" role="menu">    <a href="#X/meetActivityTimelines.php" class="button-icon jarviswidget-fullscreen-btn" rel="tooltip" title="" data-placement="bottom" data-original-title="Timelines"><i class="fa fa-slack "></i></a> </div>
                <span class="widget-icon"> <i class="fa fa-history"></i> </span>
                <h2>Activity Timelines </h2>
            </header>
            <div>
                <div>
                    <?php
                    echo $activitytimeline->render();
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>
