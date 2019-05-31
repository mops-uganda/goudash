<?php
require_once("inc/init.php");

$reportid = 500;

require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$sql = 'SELECT * FROM `reports` WHERE rid = ' . $reportid;
$db->query($sql);
$r = $db->result();

$data = Xcrud::get_instance();
$data->table('reports');
$data->columns('ReportTitle,itemsList');
$data->fields('rid,ReportTitle,itemsList,reportCategory,ReportDescription');


$data->column_pattern('itemsList','<a class="btn btn-info btn-xs" href="#X/{link}?id={rid}"><i class="fa fa-external-link "></i> View {reportType}</a>');
$data->column_pattern('ReportTitle', '<a href="#" class="xcrud-action" data-task="view" data-primary="{rid}">{value}</a>');
$data->column_cut(70,'ReportTitle');
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_search();
$data->unset_limitlist();
$data->unset_print();
$data->unset_csv();
$data->unset_numbers();
$data->unset_title();

$data->label(array('itemsList' => 'Basic Report','rid' => 'ID','ReportTitle'=>'Report Title','reportCategory'=>'Report Category','ReportDescription'=>'Report Description'));

echo $data->render();
include "xcrud_js.php";
?>

<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">