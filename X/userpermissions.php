<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/userpermissions';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);

require ('../lib/access/xcrud.php');
$data = Xcrud::get_instance();
$data->table('users');
$data->where('userlevel <', 10);
$data->table_name('User Settings and Permissions');
$data->columns('username,email,first_name,last_name,userlevel,country_id,Strategic_Projects,Strategic_Actions,Strategic_Data,inspection_performance,Govt_Performance,Reports');
$data->fields('username,email,first_name,last_name,userlevel,country_id,Strategic_Projects,Strategic_Actions,Strategic_Data,inspection_performance,Govt_Performance,Reports');
$data->relation('Strategic_Projects','permission_levels','PID','Permission');
$data->relation('Strategic_Actions','permission_levels','PID','Permission');
$data->relation('Strategic_Data','permission_levels','PID','Permission','PID<2');
$data->relation('inspection_performance','permission_levels','PID','Permission');
$data->relation('Govt_Performance','permission_levels','PID','Permission');
$data->relation('Reports','permission_levels','PID','Permission','PID<2');
$data->relation('country_id','votes','VoteCode','VoteName');
$data->label(array('country_id' => 'Ministry, Agency or Local Government'));
$data->unset_add();
$data->unset_remove();
$data->unset_limitlist();
echo $data->render();
include "xcrud_js.php";
?>

<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">