<!DOCTYPE html>
<html>
    <head>
        <link href="styles/kendo.common.min.css" rel="stylesheet" type="text/css" />
        <link href="styles/kendo.default.min.css" rel="stylesheet" type="text/css" />
        <script src="js/jquery.min.js"></script>
        <script src="js/kendo.web.min.js"></script>
    </head>
    <body>
<div id="example">
    <div class="box wide">
        <div class="box-col">
            <h4>Export</h4>
            <form action="test.php" method="POST">
                <input type="hidden" id="download-data" name="data" />
                <input type="hidden" id="download-extension" name="extension" />
                <ul>
<!--                    <li><input type="submit" class="k-button download" data-extension=".xlsx" value="Save as XLSX" /></li>
                    <li><input type="submit" class="k-button download" data-extension=".csv" value="Save as CSV" /></li>
                    <li><input type="submit" class="k-button download" data-extension=".txt" value="Save as Tab-delimited text" /></li>
-->
                    <li><input type="submit" class="k-button download" data-extension=".json" value="Post to test.php" /></li>
<!--      <li><input type = "button" id = "driver" value = "Save to Database" /></li> 
-->
                </ul>
            </form>
        </div>
<!--
        <div class="box-col">
            <h4>Import</h4>
            <input type="file" name="file" id="upload" />
        </div>
-->
    </div>
    <div id="spreadsheet" style="width: 100%;"></div>
    <style>
     .download { width: 260px; }
    </style>
      <script type = "text/javascript" language = "javascript">
         $function() {
            $(".download").click(function () {
                $("#download-data").val(JSON.stringify(spreadsheet.toJSON()));
             //   $("#download-extension").val($(this).data("extension"));
            });
        });
    </script>



<?php 

require_once 'lib/Kendo/Autoload.php';

 
// Create a new instance of Spreadsheet and specify its id
$spreadsheet = new \Kendo\UI\Spreadsheet('spreadsheet');
$spreadsheet->attr('style', 'width: 100%;');

$excel = new \Kendo\UI\SpreadsheetExcel();
$excel->fileName('Kendo UI Spreadsheet Export.xlsx')
      ->proxyURL('index.php?type=save');

$spreadsheet->excel($excel);

$pdf = new \Kendo\UI\SpreadsheetPdf();
$pdf->fileName('Kendo UI Spreadsheet Export.pdf')
      ->proxyURL('index.php?type=save');

$spreadsheet->pdf($pdf);

$sheet = new \Kendo\UI\SpreadsheetSheet();
$sheet->name("Test");
$spreadsheet->addSheet($sheet);

$row = new \Kendo\UI\SpreadsheetSheetRow();
$row->height(50);
$sheet->addRow($row);

$cell = new \Kendo\UI\SpreadsheetSheetRowCell();
$row->addCell($cell);
$cell->value("Test");


// Output it
echo $spreadsheet->render();
  ?>


</div>

</body>
</html>
