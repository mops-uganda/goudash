<?php
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');
$Financial_Year = '2015/2016';
$data = Xcrud::get_instance();
$data->table('performance_report_toc');
$data->table_name('Performance Reports Table of Contents');
$data->relation('Financial_Year','financialyear','FinancialYear','FinancialYear');
$data->pass_default('Financial_Year',$Financial_Year);


echo $data->render();

