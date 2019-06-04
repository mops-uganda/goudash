<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('hr_active_payroll');
$data ->change_type('Male', 'price','0', array('suffix'=>' /=','decimals'=>'0'));
echo $data->render();