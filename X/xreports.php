<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/xreports';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
require ('../lib/xcrud/xcrud.php');
$xreports = Xcrud::get_instance();
$xreports->table('reports');
$xreports->table_name('List of Reports');
$xreports->show_primary_ai_column(true);

echo $xreports->render();
include "xcrud_js.php";
?>

<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">