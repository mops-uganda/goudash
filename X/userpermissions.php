<?php
require ('../lib/access/xcrud.php');
$data = Xcrud::get_instance();
$data->table('users');
$data->where('userlevel <', 10);
$data->table_name('User Settings and Permissions');
$data->columns('username,email,first_name,last_name,userlevel,country_id,Strategic_Projects,Strategic_Actions,Strategic_Data,Govt_Performance,Reports');
$data->fields('username,email,first_name,last_name,userlevel,country_id,Strategic_Projects,Strategic_Actions,Strategic_Data,Govt_Performance,Reports');
$data->relation('Strategic_Projects','permission_levels','PID','Permission');
$data->relation('Strategic_Actions','permission_levels','PID','Permission');
$data->relation('Strategic_Data','permission_levels','PID','Permission','PID<2');
$data->relation('Govt_Performance','permission_levels','PID','Permission');
$data->relation('Reports','permission_levels','PID','Permission','PID<2');
$data->relation('country_id','votes','VoteCode','VoteName');
$data->label(array('country_id' => 'Ministry, Agency or Local Government'));
$data->unset_add();
$data->unset_remove();
$data->unset_limitlist();
echo $data->render();