<?php
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');
$xreports = Xcrud::get_instance();
$xreports->table('reports');
$xreports->table_name('List of Reports');
$xreports->show_primary_ai_column(true);

echo $xreports->render();

