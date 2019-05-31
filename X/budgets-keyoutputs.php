<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$vote = '';
$ProgramCode = '';
$SectorCode = '';
$fy = '2016/2017';
if (isset($_GET['vote'])) {
    $vote = $_GET['vote'];
}
if (isset($_GET['ProgramCode'])) {
    $ProgramCode = $_GET['ProgramCode'];
}
if (isset($_GET['SectorCode'])) {
    $SectorCode = $_GET['SectorCode'];
}
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_limitlist();
$data->unset_title();
$data->unset_csv();
$data->unset_print();
$data->limit(50);
if ($vote){
    if ($ProgramCode){
        echo '<h4>Vote: '.$vote.' Programme:'.$SectorCode.'-'.$ProgramCode.' '.$_GET['ProgrammeName'].'</h4>';
        $sql = 'SELECT itembudget.ProjProgName AS "Department_Project",itembudget.Output AS "Code", view_keyoutputs.KeyOutputDescription AS "KeyOutput_Description", FORMAT(SUM(itembudget.Q1Budget),0) AS "Q1_Budget", FORMAT(SUM(itembudget.Q2Budget),0) AS "Q2_Budget", FORMAT(SUM(Q3Budget),0) AS "Q3_Budget", FORMAT(SUM(Q4Budget),0) AS "Q4_Budget", FORMAT(SUM(BudgetEstimates),0) AS "Annual_Budget" FROM itembudget LEFT JOIN view_keyoutputs ON (itembudget.Vote = view_keyoutputs.VoteCode AND itembudget.Sector = view_keyoutputs.SectorCode AND itembudget.Vote_Function = view_keyoutputs.ProgramCode AND itembudget.Output = view_keyoutputs.KeyOutputCode) WHERE FY = "' . $fy . '" AND Vote = "' . $vote .'" AND Vote_Function = "' . $ProgramCode . '" GROUP BY itembudget.Sector,Vote_Function,Program,Output ORDER BY itembudget.ID';
        $data->query($sql);
        $data->columns('ProgrammeName,Department_Project,Code,KeyOutput_Description,Q1_Budget,Q2_Budget,Q3_Budget,Q4_Budget,Annual_Budget');
        $data->change_type('Q1_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q1_Budget','align-right');
        $data->change_type('Q2_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q2_Budget','align-right');
        $data->change_type('Q3_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q3_Budget','align-right');
        $data->change_type('Q4_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q4_Budget','align-right');
        $data->change_type('Annual_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('AnnualBudget','align-right');
    }else{
        echo "<h4>Step 2 of 3 - Select Programme to view Key Output Budgets</h4><br>";
        $data->table('programmes');
        $data->where('VoteCode='.$vote);
        $data->columns('VoteCode,ProgramCode,ProgrammeName');
        $data->label(array('VoteCode' => 'Code','ProgrammeName'=>'Select Programme'));
        $data->column_pattern('ProgramCode', '{SectorCode}-{ProgramCode}');
        $data->column_pattern('ProgrammeName', '<a href="javascript:getbudget(&quot;{VoteCode}&quot;,&quot;{SectorCode}&quot;,&quot;{ProgramCode}&quot;,&quot;{ProgrammeName}&quot;);">{value}</a>');
    }
}else{
    echo "<h4>Step 1 of 3 - Select Vote to Filter Programme</h4><br>";
    $data->table('votes');
    $data->columns('VoteCode,VoteName');
    $data->label(array('VoteCode' => 'Code','VoteName'=>'Vote Name - (Ministry / Agency)'));
    $data->column_pattern('VoteName', '<a href="javascript:getinfo(&quot;{VoteCode}&quot;);">{value}</a>');
}

echo $data->render();
include "xcrud_js.php";
?>

<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">

<script>

    function getinfo(myvote) {
        loadURL("X/budgets-keyoutputs?vote=".concat(myvote) , $('#inbox-content > .table-wrap'));
    }

    function getbudget(myvote,mysector,myprogramme,myprogrammename) {
        loadURL("X/budgets-keyoutputs?vote=".concat(myvote,"&SectorCode=",mysector,"&ProgramCode=",myprogramme,"&ProgrammeName=",myprogrammename) , $('#inbox-content > .table-wrap'));
    }



</script>

