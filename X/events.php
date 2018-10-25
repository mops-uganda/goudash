<?php
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');
require_once("inc/init.php");


$user = Auth::user();

$data = Xcrud::get_instance();
$data->table('events');
$data->order_by('start','desc');
$data->columns('title,description,start,end');
$data->fields('title,description,start,end,className,icon,allDay');
$data->column_cut(100,'description');
$data->relation('className','colors','Color_Class','Color_Name');
//$data->label(array('votes.VoteName'=>'Vote','ID'=>'Details','VoteName'=>'Ministry/Department/Agency','SubProgramCode'=>'Code','SubProgramName'=>'Project','ProjectObjectives'=>'Department / Project Objective'));
//$data->column_pattern('ID', '<a class="btn btn-info btn-xs" href="#X/projectdetails?id={id}&Tasks_Complete={Tasks_Complete}&Tasks_Almost_Complete={Tasks_Almost_Complete}&Code={SubProgramCode}&ProjectName={SubProgramName}">Details</a>');
//$data->column_pattern('SubProgramName', '<a href="#" class="xcrud-action" data-task="view" data-primary="{ID}">{value}</a>');
$data->unset_title();
$data->limit(25);
//$data->highlight('Priority', '=', "1", '#bee89e');
$data->unset_limitlist();
$data->unset_title();
$data->unset_csv();
$data->unset_print();
?>

    <ul class="demo-btns">
        <li>
            <a class="btn btn-labeled btn-success btn-lg" onclick="location.href='#X/calendar?<?php echo rand(); ?>';"> <span class="btn-label"><i class="fa fa-calendar"></i></span>View Calendar </a>
        </li>
    </ul>
<?php
echo $data->render();