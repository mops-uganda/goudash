<?php
require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$sql = 'SELECT ItemCode, LEFT(ItemCode,3) as Class, d_itemlevelclass.ClassificationName FROM `items` LEFT JOIN d_itemlevelclass ON LEFT(ItemCode,3) = d_itemlevelclass.ClassCode';
$db->query($sql);
$array = $db->result();

for ($count=0;$count<count($array);$count++){
    $sql = 'UPDATE items SET Item_Class = "' . $array[$count]["ClassificationName"] . '" WHERE ItemCode = "' . $array[$count]["ItemCode"] . '"';
    echo $sql;
    $db->query($sql);
}