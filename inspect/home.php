<?php
require ('../lib/xcrud/xcrud.php');
$data = Xcrud::get_instance();
$data->table('view_inspection_by_vote');
$data->table_name('Online Joint Inspection and Performance Scorecard Dashboard');
$data->columns('vote,Vote_Name,Total_Score,Count');
$data->fields('vote,Vote_Name,Total_Score,Count');
$data->unique('vote');
$data->column_cut(3,'vote');

$data->highlight('Total_Score', '<', 41, '#e89e9e')
    ->highlight('Total_Score', '>', 40, '#FADBD8')
    ->highlight('Total_Score', '>', 80, '#e2dda0')
    ->highlight('Total_Score', '>', 120, '#5DADE2')
    ->highlight('Total_Score', '>', 160, '#2ECC71');

$data->limit(100)
    ->unset_limitlist();

?>
<!-- Xcrud CSS -->
<link href="./lib/xcrud/plugins/timepicker/jquery-ui-timepicker-addon.css" rel="stylesheet" type="text/css">
<link href="./lib/xcrud/themes/bootstrap/xcrud.css" rel="stylesheet" type="text/css">


<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-3" data-widget-sortable="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-bar-chart"></i> </span>
                    <h2>Online Joint Inspection and Performance Scorecard Dashboard</i></h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body">
                        <br>Inspection and Performance Assessment of Ministries, Departments, Agencies (MDAs), Local Governments (LGs) and service delivery facilities.<br>
                        <?php
                        echo $data->render();
                        include "xcrud_js.php";
                        ?>
                    </div>
                    <!-- end widget content -->

                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->

    </div>

    <!-- end row -->

    <!-- end row -->

</section>

<script type="text/javascript">
    pageSetUp();
</script>
