<?php
require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$db->query('SELECT * FROM `votes_core`');
$data = $db->result();
$num_rows=count($data);
header('Content-Type: application/json');
echo json_encode($data);
