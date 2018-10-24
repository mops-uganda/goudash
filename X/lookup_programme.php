<?php
require ('../lib/xcrud/xcrud.php');
$vote = '003';
if (isset($_GET['vote'])) {
    $vote = $_GET['vote'];
}

$db = Xcrud_db::get_instance();
$db->query('SELECT ID, SectorCode, VoteCode, ProgramCode, ProgrammeName FROM `programmes` WHERE VoteCode = ' . $vote .' ORDER BY ProgramCode ASC');
$list = $db->result();
?>
<label class="input-sm">
    <select id="ProgramSelect">
        <?php
        for ($count=0;$count<count($list);$count++){
            ?>
            <tr>
                <option value="#X/progdetails?ID=<?php echo $list[$count]["ID"] ?>&SectorCode=<?php echo $list[$count]["SectorCode"] ?>&VoteCode=<?php echo $list[$count]["VoteCode"] ?>&ProgramCode=<?php echo $list[$count]["ProgramCode"] ?>&Programme=<?php echo $list[$count]["ProgrammeName"] ?>"><?php echo $list[$count]["ProgrammeName"] ?></option>
            </tr>
            <?php
        }
        ?>
    </select> <a class="btn btn-success btn-xs" href="javascript:getProgramme(0);"><i class="fa fa-external-link"></i>Go</a>
</label>
<script>
    function getProgramme() {
        var e = document.getElementById("ProgramSelect");
        var linker = e.options[e.selectedIndex].value;
        document.location.href=linker;
    }
</script>
