<?php
require ('../lib/xcrud/xcrud.php');
$tasks = Xcrud::get_instance();
$tasks->table('subprogrammes');
$tasks->where('LENGTH(SubProgramCode) = 4 AND Priority = 1');
$tasks->button('#X/projectdetails?id={id}&impProgress={impProgress}&Code={SubProgramCode}&ProjectName={SubProgramName}','Details','glyphicon glyphicon-new-window');
$tasks->columns('SubProgramName');
$tasks->fields('SubProgramCode,SubProgramName,ID,impProgress,projectCost,projectStatus,projectDecription,VoteCode,ResponsibleOfficers,ProjectObjectives,ProjectOutputs,GOU,external_Funded,projectType,projectPriority,projectStartFY,projectStartDate,projectDeadline,createdBy');
$tasks->column_pattern('impProgress', '<div class="progress left progress-striped"><div class="progress-bar bg-color-greenLight" style="width: {impProgress}%">{impProgress}%</div></div>');
$tasks->column_pattern('SubProgramName', '<a href="#" class="xcrud-action" data-task="view" data-primary="{id}">{value}</a>');
$tasks->label(array('SubProgramCode'=>'Code','ResponsibleOfficers'=>'Responsible Officer','ProjectObjectives'=>'Project Objectives','ProjectOutputs'=>'Project Outputs','ID'=>'Details','SubProgramName'=>'Project Name','VoteCode'=>'Lead Ministry/Agency','projectType'=>'Project Type','projectPriority'=>'Priority','projectStartFY'=>'Start FY','projectStartDate'=>'Start Date','projectDecription'=>'Description','projectCost'=>'Project Cost','projectStatus'=>'Project Status','projectDeadline'=>'Project Deadline','impProgress'=>'% Progress','createdBy'=>'Author','deleted'=>'Deleted? Dont Change'));
$tasks->unset_add();
$tasks->unset_edit();
$tasks->unset_remove();
$tasks->unset_search();
$tasks->unset_limitlist();
$tasks->unset_print();
$tasks->unset_csv();
$tasks->unset_numbers();
$tasks->unset_title();
echo $tasks->render();
include "xcrud_js.php";
?>

<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">