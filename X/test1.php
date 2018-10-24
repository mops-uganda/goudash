<?php
require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$db->query('SELECT * FROM events');
$events = $db->result();
echo json_encode($events);

?>