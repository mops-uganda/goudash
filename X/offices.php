<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/offices';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
$user = Auth::user();

require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('offices');
$data->relation('Department','department','ID','department_name','');
$data->relation('vote','votes','VoteCode','VoteName');
$data->relation('head_officer','officers','ID','officer_title_short');

echo $data->render();