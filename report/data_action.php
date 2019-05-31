<?php
require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();

$task_array = json_decode($_POST['models'], true);
foreach ($task_array as $row){
    $db->query('UPDATE votes_corex SET Vote_Code="' . $row["Vote_Code"] . '", Vote_Name="' . $row["Vote_Name"] . '", Vote_type="' . $row["Vote_type"] . '", Central_or_Local_Government="' . $row["Central_or_Local_Government"] . '" WHERE ID = ' . $row["ID"]);
}
file_put_contents('testfile.txt', $sql . "\n" . print_r($task_array, true), true);

$result = array();
$result["data"] = "Success";
return $result;