<?php
require ('../lib/crud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('department');
?>
<link href="../dash/lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="../dash/lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">
<?php
echo $data->render();
?>
<script src="../dash/lib/crud/plugins/jquery.min.js"></script>
<script type="text/javascript">
    jQuery.noConflict();
</script>
<script><?php include "../lib/crud/plugins/jquery-ui/jquery-ui.min.js";?></script>
<script><?php include "../lib/crud/plugins/jcrop/jquery.Jcrop.min.js";?></script>
<script><?php include "../lib/crud/plugins/timepicker/jquery-ui-timepicker-addon.js";?></script>
<script><?php include "../editors/tinymce/tinymce.min.js";?></script>
<script><?php include "../lib/crud/plugins/xcrud.js";?></script>

<script type="text/javascript">
    var xcrud_config = {"url":"http:\/\/localhost\/dash\/lib\/crud\/xcrud_ajax.php","editor_url":"http:\/\/localhost\/dash\/editors\/tinymce\/tinymce.min.js","editor_init_url":false,"force_editor":false,"date_first_day":1,"date_format":"dd.mm.yy","time_format":"HH:mm:ss","lang":{"add":"Add","edit":"Edit","view":"View","remove":"Remove","duplicate":"Duplicate","print":"Print","export_csv":"Export into CSV","search":"Search","go":"Go","reset":"Reset","save":"Save","save_return":"Save & Return","save_new":"Save & New","save_edit":"Save & Edit","return":"Return","modal_dismiss":"Close","add_image":"Add image","add_file":"Add file","exec_time":"Execution time:","memory_usage":"Memory usage:","bool_on":"Yes","bool_off":"No","no_file":"no file","no_image":"no image","null_option":"- none -","total_entries":"Total entries:","table_empty":"Entries not found.","all":"All","deleting_confirm":"Do you really want remove this entry?","undefined_error":"It looks like something went wrong...","validation_error":"Some fields are likely to contain errors. Fix errors and try again.","image_type_error":"This image type is not supported.","unique_error":"Some fields are not unique.","your_position":"Your position","search_here":"Search here...","all_fields":"All fields","choose_range":"- choose range -","next_year":"Next year","next_month":"Next month","today":"Today","this_week_today":"This week up to today","this_week_full":"This full week","last_week":"Last week","last_2weeks":"Last two weeks","this_month":"This month","last_month":"Last month","last_3months":"Last 3 months","last_6months":"Last 6 months","this_year":"This year","last_year":"Last year"},"rtl":0};
</script>


