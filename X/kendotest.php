    <link href="../lib/kendo/styles/kendo.common.min.css" rel="stylesheet" type="text/css" />
    <link href="styles/kendo.default.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.web.min.js"></script>
<?php require_once 'lib/Kendo/Autoload.php'; ?>
<?php
// Instantiate a new instance of the DatePicker class and specify its 'id'
$datepicker = new \Kendo\UI\DatePicker('datepicker');

// Configure the datepicker using the fluent API
$datepicker->start('year')
    ->format('MMMM yyyy');

// Output the datepicker HTML and JavaScript by echo-ing the result of the render method
echo $datepicker->render();
?>