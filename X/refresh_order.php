<?php

$update_array = $_POST['data'];
//$update_array = array_slice($update_array, 0, -4);
//file_put_contents("textfile.txt", print_r($update_array,true), true);

require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();

foreach ($update_array as $row){
    $db->query("UPDATE vote_departments SET ordering = $row[1] WHERE id = $row[0]");
}
echo 'Sort Order Updated and Saved!';