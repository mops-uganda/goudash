<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('hr_active_payroll');
$data ->change_type('Male', 'price','0', array('suffix'=>' /=','decimals'=>'0'));
echo $data->render();
include "xcrud_js.php";
?>

<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">