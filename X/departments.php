<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/departments';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
$user = Auth::user();

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('department')
    ->set_lang('add','Add New Department')
    ->relation('vote','votes','VoteCode','VoteName')
    ->relation('department_type','department_type','department_type','department_type','')
    ->pass_default('department_head','9')
    ->relation('department_head','officers','ID','officer_title_short')
    ->columns('department_name,department_abbrev,department_head,department_type,vote')
    ->fields('vote,department_name,department_abbrev,department_type,department_head');



echo $data->render();
include "xcrud_js.php";
?>
<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">

