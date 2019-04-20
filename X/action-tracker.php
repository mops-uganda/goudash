<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/action-tracker';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
$user = Auth::user();

date_default_timezone_set('Africa/Nairobi');

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('actions_tracker')
        ->table_name('Assignment Action Tracker','Track assignments to officers','icon-connection')
        ->field_tooltip('action','Action or Assignment to be tracked')
        ->column_tooltip('action','Action or Assignment to be tracked')
        ->columns('action,assigned_to,assignment_date,current_status,deadline_date,percent_progress')
        ->pass_default(array('assigned_by' => $user->username, 'city' => 'Kampala'))
        ->readonly('assigned_by')
        ->pass_default('assignment_date', date("d.m.Y"))
        ->pass_var('FY', '2019/2020')
        ->relation('assigned_to','officers','username','officer_title_short','')

        ->fields('action,assigned_to,priority,description,origin_type,origin_of_action,assignment_date,deadline_date', false, 'Edit Action', 'create')
        ->fields('assigned_by', false, 'Meta Data', 'create')

        ->fields('action,assigned_to,received,received_date,description', false, 'Overview', 'edit')
        ->fields('current_status,reason_status,completion_date,percent_progress,general_comments', false, 'Current Status', 'edit')

        ->fields('action,priority,assigned_by,assigned_to,description,assignment_date,deadline_date,origin_type,origin_of_action', false, 'Overview', 'view')
        ->fields('received,received_date,current_status,reason_status,completion_date,percent_progress,general_comments', false, 'Current Status', 'view')
        ->set_lang('add','Add New Action');
echo $data->render();