<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, PATCH, PUT, DELETE, OPTIONS');
header('Access-Control-Allow-Headers: Origin, Content-Type, X-Auth-Token');

function loadDatabase($sqlStatement){
    include "configsX.php";
    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    $result = $conn->query($sqlStatement);
    return $result;
}

function getcounts($sqlStatement){
    $result = loadDatabase($sqlStatement);
    return $result;
}

function listMDAs(){
    $sql = "SELECT Vote, MDA_LG, MDAType, MDATypeName FROM votes_query WHERE Vote < 200 ORDER BY Vote ASC";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $urllink = "";
        switch (basename($_SERVER['PHP_SELF'])) {
            case "govt_departments.php":
                $urllink=(basename($_SERVER['PHP_SELF']));
                break;
            case "key_outputs.php":
                $urllink=(basename($_SERVER['PHP_SELF']));
                break;
            default:
                $urllink=(basename($_SERVER['PHP_SELF']));
        }
        // output data of each row
        while($row = $result->fetch_assoc()) {
            ?>
            <li class="media">
                <a href="<?php echo $urllink."?vote=".$row["Vote"]?>" class="media-left"><img src="assets/images/placeholder.jpg" class="img-sm img-circle" alt=""></a>
                <div class="media-body">
                    <a href="<?php echo $urllink."?vote=".$row["Vote"]?>" class="media-heading text-semibold"><?php echo $row["MDA_LG"]?></a>
                    <span class="text-size-mini text-muted display-block"><?php echo $row["MDATypeName"]?></span>
                </div>
                <div class="media-right media-middle">
                    <span class="status-mark border-success"></span>
                </div>
            </li>
            <?php
        }
    } else {
        echo "0 results";
    }

    function closeDatabase(){
        $conn->close();
    }

}

?>