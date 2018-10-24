<?php
require ('../lib/xcrud/xcrud.php');
$activitytimeline = Xcrud::get_instance();
$activitytimeline->table('meetactiontimelines');
$activitytimeline->join('meetID','meetings','meetID');
$activitytimeline->join('meetActionTask','meettasks','meetTaskID');
$activitytimeline->order_by('meetActionTimelinesID','desc');
$activitytimeline->table_name('Timeline showing ongoing activities');
$activitytimeline->columns('meetActionDate,meetActionTitle,meettasks.meetTaskTitle,meetings.meetName');
$activitytimeline->fields('meetActionDate,meetActionTitle,meettasks.meetTaskTitle,meetings.meetName,meetActionDescription,createdBy');
$activitytimeline->label(array('meetActionDate' => 'Activity Date','meetActionTitle' => 'Activity','meetings.meetName' => 'Meet / Event','meettasks.meetTaskTitle' => 'Task that Activity contributes to', 'meetActionDescription' => 'Description', 'createdBy' => 'Author'));
$activitytimeline->column_pattern('meetActionTitle', '<a href="#" class="xcrud-action" data-task="view" data-primary="{meetActionTimelinesID}">{value}</a>');
$activitytimeline->column_pattern('meetings.meetName', "<a href='#X/meetdetails?meetid={meetID}'>{meetings.meetName}</a>");
$activitytimeline->unset_add();
$activitytimeline->unset_edit();
$activitytimeline->unset_remove();
$activitytimeline->unset_limitlist();


echo $activitytimeline->render();

?>

