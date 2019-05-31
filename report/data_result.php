<?php
require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$db->query('SELECT * FROM `votes_coreX`');
$data = $db->result();
$num_rows=count($data);
echo json_encode($data);
?>