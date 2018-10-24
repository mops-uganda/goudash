<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$vote = '';
if (isset($_GET['vote'])) {
    $vote = $_GET['vote'];
}
if (isset($_GET['votename'])) {
    $votename = $_GET['votename'];
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
    echo '<h4>Vote:- '.$vote.' '.$votename.'</h4>';
    $data->table('view_dept_proj_budget');
    $data->columns('Programme,ProgrammeName,Program,Project,ProjProgName,Q1Budget,Q2Budget,Q3Budget,Q4Budget,AnnualBudget');
    $data->where('vote = ',$vote);
    $data->change_type('Q1Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q1Budget','align-right');
    $data->change_type('Q2Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q2Budget','align-right');
    $data->change_type('Q3Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q3Budget','align-right');
    $data->change_type('Q4Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q4Budget','align-right');
    $data->change_type('AnnualBudget', 'price', '', array('decimals'=>'0')); $data->column_class('AnnualBudget','align-right');
    $data->label(array('Programme' => 'PCode','ProgrammeName'=>'Programme Name','ProjProgName'=>'Department / Project','Q1Budget'=>'Q1 Budget','Q2Budget'=>'Q2 Budget','Q3Budget' => 'Q3 Budget','Q4Budget'=>'Q4 Budget','AnnualBudget'=>'Annual Budget'));
    $data->sum('Q1Budget','align-right');
    $data->sum('Q2Budget','align-right');
    $data->sum('Q3Budget','align-right');
    $data->sum('Q4Budget','align-right');
    $data->sum('AnnualBudget','align-right');
    $data->sum('ProgrammeName','','Grand Total');
    $data->column_pattern('Programme', '{Sector}-{Programme}</a>');
}else{
    echo "<h4>Select Vote to view Programme Budgets</h4><br>";
    $data->table('votes');
    $data->columns('VoteCode,VoteName');
    $data->label(array('VoteCode' => 'Code','VoteName'=>'Vote Name - (Ministry / Agency)'));
    $data->column_pattern('VoteName', '<a href="javascript:getinfo(&quot;{VoteCode}&quot;,&quot;{VoteName}&quot;);">{value}</a>');
}

echo $data->render();

?>

<script>

    function getinfo(myvote,myvotename) {
        loadURL("X/budgets-departments?vote=".concat(myvote,"&votename=",myvotename) , $('#inbox-content > .table-wrap'));

    }



</script>

