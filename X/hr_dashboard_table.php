<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('reports');
$data->where('reportCategory = ', 'Human Resources');
$data->columns('rid,ReportTitle,itemsList,reportCategory,Liked');
$data->fields('rid,ReportTitle,itemsList,reportCategory,ReportDescription');
$data->column_pattern('itemsList', '<a href="#X/{link}?id={rid}" class="btn btn-labeled {btn_bg_color}"> <span class="btn-label"><i class="glyphicon glyphicon-th-list"></i></span>View {reportType} </a>');
$data->label(array('itemsList' => 'View Report','rid' => 'ID','ReportTitle'=>'Report Title','reportCategory'=>'Report Category','ReportDescription'=>'Report Description'));

$data->subselect('Liked','SELECT COUNT(*) FROM `reports_favourite` WHERE username = "' . $username . '" AND report_id = {rid}')
    ->column_tooltip('Liked','Add to Favourite Screens or Reports');
$data->change_type('Liked', 'bool');
$data->highlight('Liked','!=','0','#b1c779')
    ->column_cut(200,'ReportTitle');
$data->button('#', "Add to favourite reports", 'glyphicon glyphicon-link icon-arrow-up', 'btn xcrud-action', array(
    'data-action' => 'add_fav_report',
    'data-task' => 'action',
    'data-username' => $username,
    'data-report_name' => '{ReportTitle}',
    'data-report_category' => '{reportCategory}',
    'data-link' => '{link}',
    'data-primary' => '{rid}'),
    array('Liked', '=', '0'));
$data->create_action('add_fav_report','add_fav_report');

$data->limit(25);
$data->unset_limitlist();
$data->unset_add()->unset_edit()->unset_remove()->unset_title();
