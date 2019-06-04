<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/officers';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
$user = Auth::user();

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('officers');
$data->columns('ID,first_name,last_name,officer_title_short,department,username');
$data->relation('department','department','ID','department_name','');
$data->relation('vote','votes','VoteCode','VoteName')
    ->set_lang('add','Add New Officer');



echo $data->render();