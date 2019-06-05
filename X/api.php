<?php
require ('../lib/xcrud/xcrud.php');
$sql = 'SELECT Vote_Code, Vote_Name FROM votes_core';
if (isset($_GET['sql'])) {
    $sql = $_GET['sql'];
}
$db = Xcrud_db::get_instance();
$db->query($sql);
$data = $db->result();
$num_rows=count($data);
header('Content-Type: application/json');
echo json_encode($data);
//echo $sql;
