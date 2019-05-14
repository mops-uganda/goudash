<?php
require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$db->query('SELECT * FROM `votes_core`');
$data = $db->result();
$num_rows=count($data);

?>
<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="styles/kendo.common.min.css" />
    <link rel="stylesheet" href="styles/kendo.default.min.css" />
    <link rel="stylesheet" href="styles/kendo.default.mobile.min.css" />

    <script src="js/jquery.min.js"></script>
    <script src="js/jszip.js"></script>
    <script src="js/kendo.all.min.js"></script>


</head>
<body>

<div id="datatable" class="myfonts">
    <div id="grid"></div>
    <script>
        $("#grid").kendoGrid({
            toolbar: ["excel"],
            excel: {
                fileName: "Votes Export.xlsx",
                proxyURL: "https://dash.go.ug/service/export",
                filterable: true
            },
            dataSource: {
                data: <?php echo json_encode($data); ?>,
                pageSize: 25,
                aggregate: [
                    { field: "Vote_Code", aggregate: "count" }
                ]
            },
            groupable: true,
            sortable: true,
            scrollable: false,
            filterable: true,
            columnMenu: true,
            pageable: {
                refresh: true,
                pageSizes: true,
                buttonCount: 12
            },
            columns: [
                {
                    field: "Vote_Code",
                    title: "Vote Code",
                    width: 120,
                    aggregates: ["count"], footerTemplate: "#=count# Votes", groupFooterTemplate: "Count: #=count#"
                },
                {   field: "Vote_Name",
                    title: "Vote Name",
                }
                ,
                {   field: "Vote_type",
                    title: "Vote type",
                    width: 200
                },
                {   field: "Central_or_Local_Government",
                    title: "Central or Local Government",
                    width: 200
                }
            ]
        });

    </script>
</div>

<style type="text/css">
    .myfonts{
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif!important;
        font-size: 13px;
    }
</style>


</body>
</html>