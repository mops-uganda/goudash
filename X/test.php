<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('department');
?>

<?php
echo $data->render();
echo "<div>" . Xcrud::load_js() . "</div>";
//include "xcrud_js.php";
?>
