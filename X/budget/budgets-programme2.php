<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$vote = '';
if (isset($_GET['vote'])) {
    $vote = $_GET['vote'];
}
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_limitlist();
$data->unset_title();
$data->unset_csv();
$data->unset_print();
$data->limit(25);
if ($vote){
    $data->table('view_programme_budget');
    $data->columns('vote,Programme,ProgrammeName,Q1Budget,Q2Budget,Q3Budget,Q4Budget,AnnualBudget,Percent');
    $data->where('vote = ',$vote);
    $data->change_type('Q1Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q1Budget','align-right');
    $data->change_type('Q2Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q2Budget','align-right');
    $data->change_type('Q3Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q3Budget','align-right');
    $data->change_type('Q4Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q4Budget','align-right');
    $data->change_type('AnnualBudget', 'price', '', array('decimals'=>'0')); $data->column_class('AnnualBudget','align-right');
    $data->change_type('Percent', 'price', '', array('decimals'=>'2')); $data->column_class('Percent','align-right');
    $data->label(array('Programme' => 'Programme','ProgrammeName'=>'Programme Name','Q1Budget'=>'Q1 Budget','Q2Budget'=>'Q2 Budget','Q3Budget' => 'Q3 Budget','Q4Budget'=>'Q4 Budget','AnnualBudget'=>'Annual Budget','Percent'=>'%'));
    $data->sum('Q1Budget','align-right');
    $data->sum('Q2Budget','align-right');
    $data->sum('Q3Budget','align-right');
    $data->sum('Q4Budget','align-right');
    $data->sum('AnnualBudget','align-right');
    $data->sum('Percent','align-right');
    $data->sum('ProgrammeName','','Grand Total');
}else{
    echo "Select Vote to view Programme Budgets<br><br>";
    $data->table('votes');
    $data->columns('VoteCode,VoteName');
    $data->label(array('VoteCode' => 'Code','VoteName'=>'Vote Name - (Ministry / Agency)'));
    $data->column_class('VoteName', 'votelink');
    $data->column_pattern('VoteName', '<a href="javascript:getinfo({VoteCode});">{value}</a>');
    // $data->column_pattern('VoteName', '<a href="#X/budgets-programme?vote={VoteCode}">{value}</a>');
}

echo $data->render();
include "xcrud_js.php";
?>

<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">

<script>


    function getinfo($vote) {
        //console.log($this.closest("tr").attr("id"));
        // loadURL("X/budgets-programme.php" & $vote, $('#inbox-content > .table-wrap'));
        loadURL("X/email-reply.html", $('#inbox-content > .table-wrap'));
    }



</script>

