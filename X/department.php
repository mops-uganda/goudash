<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/department';
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
        ->columns('department_name,department_abbrev,department_type,department_head')
        ->fields('vote,department_name,department_abbrev,department_type,department_head');



echo $data->render();