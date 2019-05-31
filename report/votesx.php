<?php
require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$db->query('SELECT * FROM `votes_coreX`');
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
            toolbar: ["excel","create", "save", "cancel"],
            excel: {
                fileName: "Votes Export.xlsx",
                proxyURL: "https://dash.go.ug/service/export",
                filterable: true
            },
            dataSource: {
                transport: {
                    read:  {
                        url: "data_result",
                        dataType: "json"
                    },
                    cache: false,
                    update: {
                        url: "data_action?type=update",
                        dataType: "json",
                        type: "POST"
                    },
                    destroy: {
                        url: "data_action?type=delete",
                        dataType: "json",
                        type: "POST"
                    },
                    create: {
                        url: "data_action?type=create",
                        dataType: "json",
                        type: "POST"
                    },
                    parameterMap: function(options, operation) {
                        if (operation !== "read" && options.models) {
                            return {models: kendo.stringify(options.models)};
                        }
                    }
                },
                requestEnd: onRequestEnd,
                batch: true,
                pageSize: 25,
                aggregate: [
                    { field: "Vote_Code", aggregate: "count" }
                ],
                schema: {
                    model: {
                        id: "ID",
                        fields: {
                            Vote_Code: { validation: { required: true } },
                            Vote_Name: { validation: { required: true } },
                            Vote_type: { validation: { required: true } },
                            Central_or_Local_Government: { validation: { required: true } },
                        }
                    }
                }
            },
            groupable: true,
            sortable: {
                mode: "multiple",
                allowUnsort: true,
                showIndexes: true
            },
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
                },
                { command: [
                    { className: "btn-destroy", name: "destroy", text: "Remove" }
                    ]
                }
            ],
            editable: true
        });
        function onRequestEnd(e) {
            if (e.type == "create") {
                e.sender.read();
            }
            else if (e.type == "update") {
                e.sender.read();
            }
        }
    </script>
</div>

<style type="text/css">
    .myfonts{
        font-family: "Helvetica Neue",Helvetica,Arial,sans-serif!important;
        font-size: 13px;
    }
    .btn-destroy {
        background-color: #d9d3ca;
    }
</style>


</body>
</html>