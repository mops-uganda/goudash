<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('view_vote_budgets');
// SELECT itembudget.Sector As SectorCode, sectors.Sector, SUM(`Q1Budget`) AS `Q1Budget`, SUM(`Q2Budget`) AS `Q2Budget`, SUM(`Q3Budget`) AS `Q3Budget`, SUM(`Q4Budget`) AS `Q4Budget`, SUM(`BudgetEstimates`) AS `AnnualBudget`, SUM(`BudgetEstimates`)*100/(SELECT SUM(BudgetEstimates) FROM itembudget) AS Percent FROM `itembudget` LEFT JOIN sectors ON itembudget.Sector = sectors.SectorCode GROUP BY itembudget.Sector
// SELECT itembudget.Vote As VoteCode, votes.VoteName, SUM(`Q1Budget`) AS `Q1Budget`, SUM(`Q2Budget`) AS `Q2Budget`, SUM(`Q3Budget`) AS `Q3Budget`, SUM(`Q4Budget`) AS `Q4Budget`, SUM(`BudgetEstimates`) AS `AnnualBudget`, SUM(`BudgetEstimates`)*100/(SELECT SUM(BudgetEstimates) FROM itembudget) AS Percent FROM `itembudget` LEFT JOIN votes ON (itembudget.Vote = votes.VoteCode AND itembudget.Sector = votes.SectorCode) GROUP BY itembudget.Vote
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_limitlist();
$data->unset_title();
$data->unset_csv();
$data->unset_print();
$data->limit(25);
$data->change_type('Q1Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q1Budget','align-right');
$data->change_type('Q2Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q2Budget','align-right');
$data->change_type('Q3Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q3Budget','align-right');
$data->change_type('Q4Budget', 'price', '', array('decimals'=>'0')); $data->column_class('Q4Budget','align-right');
$data->change_type('AnnualBudget', 'price', '', array('decimals'=>'0')); $data->column_class('AnnualBudget','align-right');
$data->change_type('Percent', 'price', '', array('decimals'=>'2')); $data->column_class('Percent','align-right');
$data->label(array('VoteCode' => 'Code','VoteName'=>'Vote Name','Q1Budget'=>'Q1 Budget','Q2Budget'=>'Q2 Budget','Q3Budget' => 'Q3 Budget','Q4Budget'=>'Q4 Budget','AnnualBudget'=>'Annual Budget','Percent'=>'%'));
$data->sum('Q1Budget','align-right');
$data->sum('Q2Budget','align-right');
$data->sum('Q3Budget','align-right');
$data->sum('Q4Budget','align-right');
$data->sum('AnnualBudget','align-right');
$data->sum('Percent','align-right');
$data->sum('VoteName','','Grand Total');
echo $data->render();
