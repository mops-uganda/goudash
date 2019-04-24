<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/offices';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
$username = Auth::user()->username;

require ('../lib/xcrud/xcrud.php');
$xcrud1 = Xcrud::get_instance();
$xcrud1->table('stickynotes')
        ->table_name('Sticky Notes');
$xcrud1->columns('title')
        ->where("username=" , $username)
        ->relation('color','alerts','alert_class','alert_name')
        ->column_pattern('title','
            <div class="alert {color} container-fluid">
                <div class="col-sm-9"><strong>{value}</strong><br>{notes}</div>
                <div class="col-sm-3 pull-right"><strong class="pull-right">Date <i class="fa fa-clock-o"></i> {date}</strong><br><br>
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
        ->relation('color','alerts','alert_class','alert_name')
        ->pass_var('username', $username);
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