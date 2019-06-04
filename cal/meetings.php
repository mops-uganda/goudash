<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/meetings';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
$user = Auth::user();

date_default_timezone_set('Africa/Nairobi');

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('calendar')
    ->table_name('Meetings and Events','Track assignments to officers','icon-connection')
    //->field_tooltip('action','Action or Assignment to be tracked')
    //->column_tooltip('action','Action or Assignment to be tracked')
    ->column_pattern('title', '
    <div class="alert cardi container-fluid">
    <div class="col-sm-9">
        <i class="fa fa-tasks" style="padding-right: 5px"></i><strong>{title}</strong><p></p>
        <span class="label label-success">Category: {category}</span>
        <span class="label label-warning">Priority: {Priority}</span>
        <span class="label bg-color-greenLight" style="margin-left: 5px">Venue: {Venue}</span><p></p>
        <span>{description}</span>
    </div>
    <div class="col-sm-3 pull-right">
        <span class="pull-right"><strong>From <i class="fa fa-clock-o" style="padding-right: 5px"></i></strong> {start}</span><br>
        <span class="pull-right"><strong>To <i class="fa fa-clock-o" style="padding-right: 5px"></i></strong> {end}</span>
    </div>
</div>
    ')
    ->columns('title')
    ->fields('title,description,start,end,allDay,category,Venue,Priority')
    ->change_type('allDay','select','','true,false')
    ->change_type('category','select','','General,Meeting,Assignment,Personal')
    ->change_type('Priority','select','','High,Normal,Low')
    ->unset_add()->unset_edit()->unset_remove()->unset_view()
    ->order_by('start','asc')
    //->pass_default(array('assigned_by' => $user->username, 'city' => 'Kampala'))
    //->readonly('assigned_by')
    //->pass_default('assignment_date', date("d.m.Y"))
    //->pass_var('FY', '2019/2020')
    //->relation('assigned_to','officers','username','officer_title_short')
    //->column_class('assignment_date,deadline_date', 'pull-right')

    //->fields('action,assigned_to,priority,description,origin_type,origin_of_action,assignment_date,deadline_date', false, 'Edit Action', 'create')
    //->fields('assigned_by', false, 'Meta Data', 'create')

    //->fields('action,assigned_to,received,received_date,description', false, 'Overview', 'edit')
    //->fields('current_status,reason_status,completion_date,percent_progress,general_comments', false, 'Current Status', 'edit')

    //->fields('action,priority,assigned_by,assigned_to,description,assignment_date,deadline_date,origin_type,origin_of_action', false, 'Overview', 'view')
    //->fields('received,received_date,current_status,reason_status,completion_date,percent_progress,general_comments', false, 'Current Status', 'view')
    //->column_callback('action','add_user_icon')
    ->set_lang('add','Add New Meetings / Event');
echo $data->render();
?>
<!--
<style>
    .table-bordered, .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        line-height: 74px;
    }
</style>
-->
<style>
    .xcrud-top-actions{
        background-color:#b5b694;
        border: 1px solid #9c9d7b;
        background-image: -o-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -moz-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -webkit-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -ms-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: linear-gradient(to bottom, #cecfad 0%, #b5b694 100%);
        -webkit-box-shadow: inset 0 1px 0 #e7e8c6;
        -moz-box-shadow: inset 0 1px 0 #e7e8c6;
        box-shadow: inset 0 1px 0 #e7e8c6;
        color: #9c9d7b;
    }
    .xcrud-view{
        padding-top: 8px;
    }
    .table-striped>tbod<div class="xcrud-view">y>tr:nth-of-type(odd) {
                                                  background-color: #eeede9;}
    .fc-head-container thead tr, .table thead tr{
        background-color:#ccc5b1;
        border: 1px solid #b3ac98;
        background-image: -o-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -moz-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -webkit-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -ms-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: linear-gradient(to bottom, #e5deca 0%, #ccc5b1 100%);
        -webkit-box-shadow: inset 0 1px 0 #fef7e3;
        -moz-box-shadow: inset 0 1px 0 #fef7e3;
        box-shadow: inset 0 1px 0 #fef7e3;
        color: #3a6b58;
        height: 40px;
        font-size: 14px;
    }
    .alert{
        font-size: 16px;
    }
    .cardi{
        background: #eceef1 100% linear-gradient(#e3e2e8 0%, #e0d9d9 50%, #e0d9d9 50%, #e3e2e8 100%);
        box-shadow: 0 4px 20px 0 rgba(0,0,0,.14), 0 7px 10px -5px rgba(216, 217, 189, 0.4);
        border-left: 5px solid #44500b;
        padding-left: 20px;
        color: #1b1604;
    }
    .icon-background1 {
        color: #ffc0ff;
    }

</style>