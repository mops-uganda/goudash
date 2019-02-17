<?php
require_once '../securex/extra/auth.php';
require ('../lib/xcrud/xcrud.php');
$user = Auth::user();

$db = Xcrud_db::get_instance();
$sql = 'SELECT * FROM `performance_questions` WHERE `Financial_Year` = \'2019/2020\' ORDER BY id ASC';
$db->query($sql);
$list = $db->result();
$sql="-";
$fy = "2019/2020";
$vote = $user->country_id;

for ($count=0;$count<count($list);$count++){
    $sql = "INSERT INTO `performance_scores` (`FY`, `vote`, `performance_question`, `self_score`, `self_comments`, `political_score`, `political_comments`, `RDC_score`, `RDC_comments`, `Inspection_Team_score`, `Inspection_Team_comments`) VALUES ('" . $fy . "', '" . $vote . "', '" . $list[$count]["sub_section_ID"] . "', '0', '-', '0', '-', '0', '-', '0', '-');";
    //echo "<br>" . $sql;
    $db->query($sql);
}
?>

<br><br><div class="btn btn-success btn-lg btn-block" onclick="location.href='#inspect/inspect?<?php echo rand(); ?>';">
    <i class="fa fa-upload"></i>
    <?php echo count($list) . " Inspection Questions Started - "; ?> > Click to start Inspection
</div>

