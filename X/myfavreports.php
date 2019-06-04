<?php

require_once("inc/init.php");
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');


$user = Auth::user();
$username = $user->username;

$xcrud = Xcrud::get_instance();

$xcrud->table('reports_favourite');
$xcrud->table_name("My Favourite Reports");

$xcrud->fields('report_name,report_category,link,report_id,comments');
$xcrud->columns('report_name,report_category');

$xcrud->unset_add();
$xcrud->unset_edit();
$xcrud->unset_limitlist();


echo $xcrud->render();