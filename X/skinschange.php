<?php
session_start();
if (isset($_GET['skin'])) {
    $skin = $_GET['skin'];
    $_SESSION["opmDashSkin"] = "" . $_GET['skin'];
    setcookie("opmDashSkin", $skin, time() + (86400 * 30), "/"); // 86400 = 1 day
    //echo $_SESSION["opmDashSkin"];
}
header('Location: ../#X/skins.php');
?>