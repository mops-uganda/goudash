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
$repDef = $db->result();
$db->query($repDef[0]["SQL_Statement"]);
$graph_data = $db->result();
$numrows=count($graph_data);

list($XAxis, $YAxis, $YAxis2, $Tooltip, $Tooltip2) = array('XAxis','YAxis','YAxis2','Tooltip','Tooltip2');
$no_columns = $repDef[0]["columns"];
$column_size = $repDef[0]["Colmn_Size"];
switch ($no_columns){
    case 1: list($XAxis, $YAxis, $Tooltip, $Legend) = explode(':',$repDef[0]["X_Y_Axis"]); $YAxis2=""; $Legend2=""; break;
    case 2: list($XAxis, $YAxis, $YAxis2, $Tooltip, $Legend, $Legend2) = explode(':',$repDef[0]["X_Y_Axis"]); break;
}

$graphData="[";
$graphData2="[";
$graphLabels='[';

//echo $YAxis;
//echo $YAxis2;

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


//echo $numrows . "<br>";
//echo $no_columns . "<br>";
//echo $graphData . "<br>";
//echo $graphLabels . "<br>";
//echo $graphData2 . "<br>";
?>
<script src="js/Chart.min.js"></script>
<script src="js/chartjs-plugin-labels.js"></script>
<button class="btn btn-success btn-labeled btn-md " onclick="location.href='<?php echo $repDef[0]["return_link"] ?>';"><span class="btn-label"><i class="fa fa-chevron-left"></i></span> <?php echo $repDef[0]["return_link_text"] ?></button>
<button class="btn btn-warning btn-labeled btn-md " onclick="location.reload();"><span class="btn-label"><i class="fa fa-refresh"></i></span> Refresh</button>
<div class="container">
    <h2><?php echo $repDef[0]["Graph_Name"]; ?></h2>
    <div>
        <canvas id="doughnut-chart"></canvas>
    </div>
</div>
<script>
    new Chart(document.getElementById("doughnut-chart"), {
        type: 'doughnut',
        data: {
            labels: <?php echo $graphLabels;?>,
            datasets: [
                {
                    label: "Population (millions)",
                    backgroundColor: ["#3E312E", "#A09A7B","#323617","#B8903B","#733C24","#6F572C","#2A301B","#496152","#738984","#B0BD9F","#290F1C","#71474F","#D58C57","#CAC59E","#9B9596","#3D4543","#657669","#7E927D","#191C2C","#41425E","#AECCC6"],
                    data: <?php echo $graphData;?>
                }
            ]
        },
        options: {
            legend: {
                display: true,
                position: "bottom",
                labels: {
                    fontSize: 15
                }
            },
            title: {
                display: true,
                text: '<?php echo $repDef[0]["Graph_Name"]; ?>'
            },
            plugins: {
                labels: {
                    render: 'label',
                    fontColor: ['white','white','white','white','white','white','white','white','white','white','white','white','white']
                }
            }
        }
    });
</script>