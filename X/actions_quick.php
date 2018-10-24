<?php
require ('../lib/xcrud/xcrud.php');
$tasks = Xcrud::get_instance();
$tasks->table('meettasks');
$tasks->join('meetID','meetings','meetID');
$tasks->order_by('meetTaskID','desc');
$tasks->table_name('List of Strategic Undertakings, Tasks and Actions');
$tasks->columns('meetTaskTitle,meetings.meetName');
$tasks->fields('meetTaskTitle,imProgress,meetings.meetName,meetTaskDescription,assigned_to,collaborators,start_date,deadline,priority,status');
$tasks->label(array('meetTaskTitle' => 'Task','meetings.meetName' => 'Meet / Event','meetTaskDescription' => 'Description', 'assigned_to' => 'Assigned To', 'collaborators' => 'Collaborators', 'imProgress' => '% Progress', 'start_date' => 'Start Date', 'deadline' => 'Deadline','priority' => 'Priority','status' => 'Status'));
$tasks->column_pattern('imProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {imProgress}%">{imProgress}%</div></div>');
$tasks->column_pattern('meetings.meetName', "<a href='#X/meetdetails?meetid={meetID}'>{meetings.meetName}</a>");
$tasks->column_pattern('meetTaskTitle', '<a href="#" class="xcrud-action" data-task="view" data-primary="{meetTaskID}">{value}</a>');
$tasks->relation('meetType','meettype','MeetType','MeetType','');
$tasks->change_type('priority','select','','Low,Normal,High,Critical');
$tasks->change_type('status','select','','Not Started,On going,Delayed,Cancelled,Completed');
$tasks->highlight('status', '=', "Not Started", '#e89e9e');
$tasks->highlight('status', '=', "Completed", '#bee89e');
$tasks->highlight('status', '=', "Delayed", '#e2dda0');
$tasks->unset_add();
$tasks->unset_edit();
$tasks->unset_remove();
$tasks->unset_search();
$tasks->unset_limitlist();
$tasks->unset_print();
$tasks->unset_csv();
$tasks->unset_numbers();
$tasks->unset_title();


echo $tasks->render();
