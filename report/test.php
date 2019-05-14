<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/kendo.common.min.css">
<link rel="stylesheet" href="css/kendo.rtl.min.css">
<link rel="stylesheet" href="css/kendo.default.min.css">
<link rel="stylesheet" href="css/kendo.mobile.all.min.css">

<script src="js/jquery.min.js"></script>
<script src="js/angular.min.js"></script>
<script src="js/jszip.min.js"></script>
<script src="js/kendo.all.min.js"></script>
<script src="js/kendo.timezones.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/chroma.min.js"></script>

<?php require_once 'lib/Kendo/Autoload.php'; ?>
<style type="text/css">
    .k-grid table {
        font-size: 13px;
    }
    .k-pager-wrap>.k-link>.k-icon {
        margin-top: 5px;
    }
</style>
<div id="example">
    <?php
    require ('../lib/xcrud/xcrud.php');
    $db = Xcrud_db::get_instance();
    $db->query('SELECT * FROM `votes_core`');
    $data = $db->result();
    $num_rows=count($data);

    $dataSource = new \Kendo\Data\DataSource();
    $dataSource->data($data);
    $dataSource->pageSize(25);

    $votesCount = new \Kendo\Data\DataSourceAggregateItem();
    $votesCount->field("Vote_type")
        ->aggregate("count");

    $group = new \Kendo\Data\DataSourceGroupItem();
    $group->field('Vote_type')
            ->addAggregate($votesCount);
    $dataSource->addAggregateItem($votesCount);

    $grid = new \Kendo\UI\Grid('votes');

    $orderID = new \Kendo\UI\GridColumn();
    $orderID->field('Vote_Code');
    $orderID->width("120");
    $orderID->title('Vote_Code');

    $shipCountry = new \Kendo\UI\GridColumn();
    $shipCountry->field('Vote_Name');
    $shipCountry->title('Vote_Name');


    $shipAddress = new \Kendo\UI\GridColumn();
    $shipAddress->field('Vote_type');
    $shipAddress->title('Vote_type')
                ->width("200")
                ->footerTemplate('Total Count: #=count#');

    $Central_or_Local_Government = new \Kendo\UI\GridColumn();
    $Central_or_Local_Government->field('Central_or_Local_Government');
    $Central_or_Local_Government->title('Central or Local_Government')
                                ->width("200");

    $grid->addColumn($orderID);
    $grid->addColumn($shipCountry);
    $grid->addColumn($shipAddress);
    $grid->addColumn($Central_or_Local_Government);
    $grid->dataSource($dataSource);

    $sortable = new \Kendo\UI\GridSortable();
    $sortable->mode('multiple')
        ->showIndexes(true)
        ->allowUnsort(true);
    $grid->sortable($sortable)
            ->selectable('cell multiple');
    $grid->scrollable(false);
    $grid->filterable(true);
    $grid->groupable(true);
    $grid->pageable(true);
    $grid->columnMenu(true);
    $grid->attr('class','ra-section');

    echo $grid->render();
    ?>
</div>
<?php
require ('../lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$db->query('SELECT * FROM `votes_core`');
$data = $db->result();
$num_rows=count($data);
echo json_encode($data);
?>

