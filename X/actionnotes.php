<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/actionnotes';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);

require ('../lib/xcrud/xcrud.php');
$tasks = Xcrud::get_instance();
$tasks->table('meetnotes');
$tasks->join('meetID','meetings','meetID');
$tasks->order_by('meetNotesID','desc');
$tasks->table_name('List of Notes from Strategic Meetings and Events');
$tasks->columns('meetNotesTitle,meetings.meetName,createdDate,createdBy');
$tasks->fields('meetNotesTitle,meetings.meetName,meetNotesDecription,createdDate,createdBy');
$tasks->label(array('meetNotesTitle' => 'Notes','meetings.meetName' => 'Meet / Event','meetNotesDecription' => 'Description', 'createdDate' => 'Date Created','createdBy' => 'Notes Authored by'));
$tasks->column_pattern('meetNotesTitle', '<a href="#" class="xcrud-action" data-task="view" data-primary="{meetNotesID}">{value}</a>');
$tasks->column_pattern('meetings.meetName', "<a href='#X/meetdetails?meetid={meetID}'>{meetings.meetName}</a>");
$tasks->unset_add();
$tasks->unset_edit();
$tasks->unset_remove();
$tasks->unset_limitlist();


echo $tasks->render();

?>

