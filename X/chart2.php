<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/graphs';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);

require_once("inc/init.php");
require ('../lib/xcrud/xcrud.php');

$graph_id = 4;
if (isset($_GET['id'])) {
    $graph_id = $_GET['id'];
}

$db = Xcrud_db::get_instance();
$sql = 'SELECT * FROM `graphs` WHERE GID = ' . $graph_id;
$db->query($sql);
$report_definition = $db->result();
$db->query($report_definition[0]["SQL_Statement"]);
$graph_data = $db->result();
$numrows=count($graph_data);
$no_columns = $report_definition[0]["columns"];

list($XAxis, $YAxis, $YAxis2, $Tooltip, $Tooltip2) = array('XAxis','YAxis','YAxis2','Tooltip','Tooltip2');
$no_columns = $report_definition[0]["columns"];
$column_size = $report_definition[0]["Colmn_Size"];
switch ($no_columns){
    case 1: list($XAxis, $YAxis, $Tooltip, $Legend) = explode(':',$report_definition[0]["X_Y_Axis"]); $YAxis2=""; $Legend2=""; break;
    case 2: list($XAxis, $YAxis, $YAxis2, $Tooltip, $Legend, $Legend2) = explode(':',$report_definition[0]["X_Y_Axis"]); break;
}

$graphData="[";
$graphData2="[";
$graphLabels='[';

echo $report_definition[0]["SQL_Statement"];
echo $YAxis2;

for ($count=0;$count<$numrows;$count++){
    $graphData = $graphData . $graph_data[$count][$YAxis];
    if($YAxis2) $graphData2=$graphData2 . $graph_data[$count][$YAxis2];
    $graphLabels = $graphLabels . '"' . $graph_data[$count][$XAxis] . '"';
    if ($count<($numrows-1)) {
        $graphData=$graphData . ",";
        $graphData2=$graphData2 . ",";
        $graphLabels=$graphLabels . ",";
    }
}
$graphData=$graphData."]";
$graphData2=$graphData2."]";
$graphLabels=$graphLabels.']';


echo $numrows . "<br>";
echo $no_columns . "<br>";
echo $graphData . "<br>";
echo $graphLabels . "<br>";
echo $graphData2 . "<br>";

?>

<script src="js/Chart.min.js"></script>
<style>
    .container {
        margin: 5px auto;
        background-color:#f4eee4;
        border: 1px solid #dbd5cb;
        background-image: -o-linear-gradient(bottom, #fffffd 0%, #f4eee4 100%);
        background-image: -moz-linear-gradient(bottom, #fffffd 0%, #f4eee4 100%);
        background-image: -webkit-linear-gradient(bottom, #fffffd 0%, #f4eee4 100%);
        background-image: -ms-linear-gradient(bottom, #fffffd 0%, #f4eee4 100%);
        background-image: linear-gradient(to bottom, #fffffd 0%, #f4eee4 100%);
        -webkit-box-shadow: inset 0 1px 0 #ffffff;
        -moz-box-shadow: inset 0 1px 0 #ffffff;
        box-shadow: inset 0 1px 0 #ffffff;
        text-shadow: 0 1px 0 #ffffff;
        color: #51432a;

    }
</style>
<button class="btn btn-success btn-labeled btn-md " onclick="location.href='#X/reports';"><span class="btn-label"><i class="fa fa-chevron-left"></i></span> Return to List of Reports</button>
<button class="btn btn-warning btn-labeled btn-md " onclick="location.reload();"><span class="btn-label"><i class="fa fa-refresh"></i></span> Refresh</button>
<div class="container">
    <h2><?php echo $report_definition[0]["Graph_Name"]; ?></h2>
    <div>
        <canvas id="bar-chart"></canvas>
    </div>
</div>
<script>
    var nn = <?php echo $no_columns ?>;
    if (nn===1){
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: <?php echo $graphLabels;?>,
                datasets: [
                    {
                        label: "<?php echo $report_definition[0]["Label"]; ?>",
                        backgroundColor: ["#3E312E", "#A09A7B","#323617","#B8903B","#733C24","#6F572C","#2A301B","#496152","#738984","#B0BD9F","#290F1C","#71474F","#D58C57","#CAC59E","#9B9596","#3D4543","#657669","#7E927D","#191C2C","#41425E","#AECCC6"],
                        data: <?php echo $graphData;?>
                    }
                ]
            },
            options: {
                legend: { display: false },
                title: {
                    display: true,
                    text: '<?php echo $report_definition[0]["Graph_Heading"]; ?>'
                },
                legend: {
                    position: "top"
                },
            }
        });
    }

    if(nn===2){
        new Chart(document.getElementById("bar-chart"), {
            type: 'bar',
            data: {
                labels: <?php echo $graphLabels;?>,
                datasets: [
                    {
                        label: "<?php echo $Legend;?>",
                        backgroundColor: "#3E312E",
                        data: <?php echo $graphData;?>
                    }, {
                        label: "<?php echo $Legend2;?>",
                        backgroundColor: "#A09A7B",
                        data: <?php echo $graphData2;?>
                    }
                ]
            },
            options: {
                title: {
                    display: true,
                    text: 'Population growth (millions)'
                }
            }
        });
    }
</script>
