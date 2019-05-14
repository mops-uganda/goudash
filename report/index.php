<!DOCTYPE html>
<html>
<head>
    <link href="styles/kendo.common.min.css" rel="stylesheet" type="text/css" />
    <link href="styles/kendo.default.min.css" rel="stylesheet" type="text/css" />
    <script src="js/jquery.min.js"></script>
    <script src="js/kendo.web.min.js"></script>
</head>
<body>
<?php require_once 'lib/Kendo/Autoload.php'; ?>
<?php
// Instantiate a new instance of the DatePicker class and specify its 'id'
$datepicker = new \Kendo\UI\DatePicker('datepicker');
$calendae = new \Kendo\UI\Calendar('MyCalendar');

// Configure the datepicker using the fluent API
$datepicker->start('year')
    ->format('MMMM yyyy');

// Output the datepicker HTML and JavaScript by echo-ing the result of the render method
echo $datepicker->render();
echo '<br>';
echo $calendae->render();
echo '<br>';

$o1=new stdClass();
$o1->id = 1;
$o1->value = 'Mundua';
$o2=new stdClass();
$o2->id = 2;
$o2->value = 'Patrick';
$o_list = array($o1,$o2);
$o_DataSource = new \Kendo\Data\DataSource();
$o_DataSource->data($o_list);
$o_drop_list = new \Kendo\UI\DropDownList('MyList');
$o_drop_list->dataSource($o_DataSource)
            ->dataValueField('id')
            ->dataTextField('value');
echo $o_drop_list->render();

?>
</body>
</html>