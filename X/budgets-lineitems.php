<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$vote = '';
$ProgramCode = '';
$SubProgramCode = '';
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
if (isset($_GET['SubProgramCode'])) {
    $SubProgramCode = $_GET['SubProgramCode'];
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
        if ($SubProgramCode){
            echo '<h4>Vote: '.$vote.' Department / Program:'.$SectorCode.'-'.$ProgramCode.'-'.$SubProgramCode.' '.$_GET['SubProgramName'].'</h4>';
            $sql = 'SELECT Item, items.ItemName AS Item_Name, FORMAT(Q1Budget,0) AS Q1_Budget, FORMAT(Q2Budget,0) AS Q2_Budget, FORMAT(Q3Budget,0) AS Q3_Budget, FORMAT(Q4Budget,0) AS Q4_Budget, FORMAT(BudgetEstimates,0)  AS Annual_Budget FROM `itembudget` LEFT JOIN items ON itembudget.Item = items.ItemCode  WHERE FY = "' . $fy . '" AND Vote = "' . $vote .'" AND Sector = "' . $SectorCode .'" AND Vote_Function = "' . $ProgramCode .'" AND (Project = "' . $SubProgramCode .'" OR Program = "' . $SubProgramCode .'") ORDER BY Item';
            $data->query($sql);
            $data->columns('Item, Item_Name,Q1_Budget,Q2_Budget,Q3_Budget,Q4_Budget,Annual_Budget');
            $data->change_type('Q1_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q1_Budget','align-right');
            $data->change_type('Q2_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q2_Budget','align-right');
            $data->change_type('Q3_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q3_Budget','align-right');
            $data->change_type('Q4_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q4_Budget','align-right');
            $data->change_type('Annual_Budget', 'price', '', array('decimals'=>'0')); $data->column_class('AnnualBudget','align-right');
        }else{
            echo "<h4>Step 3 of 4 - Select Departments / Projects to Line Item Budgets Budgets</h4><br>";
            $data->table('subprogrammes');
            $data->where('VoteCode='.$vote.' AND ProgramCode='.$ProgramCode);
            $data->columns('VoteCode,SubProgramCode,SubProgramName');
            $data->label(array('VoteCode' => 'Vote','SubProgramCode' => 'Code','SubProgramName'=>'Select Department / Project'));
            $data->column_pattern('SubProgramCode', '{SectorCode}-{ProgramCode}-{SubProgramCode}');
            $data->column_pattern('SubProgramName', '<a href="javascript:getbudget(&quot;{VoteCode}&quot;,&quot;{SectorCode}&quot;,&quot;{ProgramCode}&quot;,&quot;{SubProgramCode}&quot;,&quot;{SubProgramName}&quot;);">{value}</a>');
        }

    }else{
        echo "<h4>Step 2 of 4 - Select Programme to view Departments / Projects</h4><br>";
        $data->table('programmes');
        $data->where('VoteCode='.$vote);
        $data->columns('VoteCode,ProgramCode,ProgrammeName');
        $data->label(array('VoteCode' => 'Vote','ProgramCode' => 'PCode','ProgrammeName'=>'Select Programme'));
        $data->column_pattern('ProgramCode', '{SectorCode}-{ProgramCode}');
        $data->column_pattern('ProgrammeName', '<a href="javascript:getdeptproject(&quot;{VoteCode}&quot;,&quot;{SectorCode}&quot;,&quot;{ProgramCode}&quot;,&quot;{ProgrammeName}&quot;);">{value}</a>');
    }
}else{
    echo "<h4>Step 1 of 4 - Select Vote to Filter Programme</h4><br>";
    $data->table('votes');
    $data->columns('VoteCode,VoteName');
    $data->label(array('VoteCode' => 'Vote','VoteName'=>'Vote Name - (Ministry / Agency)'));
    $data->column_pattern('VoteName', '<a href="javascript:getprogrammes(&quot;{VoteCode}&quot;);">{value}</a>');
}

echo $data->render();
include "xcrud_js.php";
?>

<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">

<script>
    function getprogrammes(myvote) {
        loadURL("X/budgets-lineitems?vote=".concat(myvote) , $('#inbox-content > .table-wrap'));
    }

    function getdeptproject(myvote,mysector,myprogramme,myprogrammename) {
        loadURL("X/budgets-lineitems?vote=".concat(myvote,"&SectorCode=",mysector,"&ProgramCode=",myprogramme,"&ProgrammeName=",myprogrammename) , $('#inbox-content > .table-wrap'));
    }

    function getbudget(myvote,mysector,myprogramme,mysubprogramme,mysubprogrammename) {
        loadURL("X/budgets-lineitems?vote=".concat(myvote,"&SectorCode=",mysector,"&ProgramCode=",myprogramme,"&SubProgramCode=",mysubprogramme,"&SubProgramName=",mysubprogrammename) , $('#inbox-content > .table-wrap'));
    }


</script>
