<?php
require ('../lib/xcrud/xcrud.php');

$xcrud1 = Xcrud::get_instance();
$xcrud1->table('stickynotes')
        ->table_name('Sticky Notes');
$xcrud1->columns('title')
        ->relation('color','alerts','alert_class','alert_name')
        ->column_pattern('title','
            <div class="alert {color} container-fluid">
                <div class="col-sm-9"><strong>{value}</strong><br>{notes}</div>
                <div class="col-sm-3 pull-right"><strong class="pull-right">Date <i class="fa fa-clock-o"></i> {date}</strong><br>
                </div>
             </div>')
        ->order_by('id','asc');;
$xcrud1->unset_view()->unset_limitlist()->limit(25)->unset_csv()->unset_print();
$xcrud1->hide_button('add');


echo $xcrud1->render();






$xcrud2 = Xcrud::get_instance();
$xcrud2->table('stickynotes')
        ->unset_title();
$xcrud2->fields('title,notes,color,date')
        ->relation('color','alerts','alert_class','alert_name');
$xcrud2->hide_button('save_return,return,save_edit');
$xcrud2->set_lang('save_new','Publish New Note');
echo $xcrud2->render('create');
?>
<script type="text/javascript">
    window.onload = function(){
        jQuery(document).on("xcrudafterrequest",function(event,container){
            if(jQuery(container).closest(".xcrud").prevAll(".xcrud").size()){
                Xcrud.reload(".xcrud:first");
            }
        });
    }
</script>