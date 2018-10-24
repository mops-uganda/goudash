Hello
<?php

$post_info= $_POST['description'];

foreach ($_POST as $key => $value) {
    echo "<tr>";
    echo "<td>";
    echo $key;
    echo "</td>";
    echo "<td>";
    echo $value;
    echo "</td>";
    echo "</tr>";
}

require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$db->query('INSERT INTO `data` (`label`, `value`) VALUES ("tt", "pp");');