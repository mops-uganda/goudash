<?php
require_once 'lib/Kendo/DataSourceResult.php';
require_once 'lib/Kendo/Autoload.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    header('Content-Type: application/json');

    $request = json_decode(file_get_contents('php://input'));

    $result = new DataSourceResult('mysql:host=localhost;dbname=dash', 'root', '');

    $type = $_GET['type'];

    $columns = array('Color_Name', 'Color_Class');

    switch ($type) {
        case 'create':
            $result = $result->create('locations', $columns, $request->models, 'location_id');
            break;
        case 'read':
            $result = $result->read('colors', $columns, $request);
            break;
        case 'update':
            $result = $result->update('locations', $columns, $request->models, 'location_id');
            break;
        case 'destroy':
            $result = $result->destroy('locations', $request->models, 'location_id');
            break;
    }

    echo json_encode($result, JSON_NUMERIC_CHECK);

    exit;
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Title</title>

        <link rel="stylesheet" href="dist/styles/web/kendo.common.min.css" />
        <link rel="stylesheet" href="dist/styles/web/kendo.default.min.css" />

        <script src="dist/js/jquery.min.js"></script>
        <script src="dist/js/kendo.all.min.js"></script>
    </head>
    <body>

<?php

$transport = new \Kendo\Data\DataSourceTransport();