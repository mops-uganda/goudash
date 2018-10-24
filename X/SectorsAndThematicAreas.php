<?php
require_once("inc/init.php");
require ('../lib/xcrud/xcrud.php');

$data = Xcrud::get_instance();
$data->table('sectors');
$data->order_by('SectorCode','asc');
$data->table_name('List of Sectors and Thematic Areas');
$data->columns('SectorCode,Sector,ID_TA,ThematicArea');
$data->fields('SectorCode,Sector,ThematicArea');
$data->label(array('SectorCode' => 'Code','ThematicArea'=>'Thematic Area','ID_TA'=>'Sector Details'));
$data->column_pattern('Sector', '<a href="#" class="xcrud-action" data-task="view" data-primary="{ID_TA}">{value}</a>');
$data->column_pattern('ID_TA', '<a class="btn btn-info btn-xs" href="#X/sectordetails?sectorid={SectorCode}&sector={Sector}">Sector Details</a>');
$data->unset_add();
$data->unset_edit();
$data->unset_remove();
$data->unset_limitlist();
$data->unset_title();
$data->unset_pagination();
$data->limit(20);

?>

<div class="row">
    <div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
        <h1 class="page-title txt-color-blueDark">
            <i class="fa fa-table fa-fw "></i>
            Sectors and Thematic Areas
        </h1>
    </div>
    <div class="col-xs-12 col-sm-5 col-md-5 col-lg-8">
        <ul id="sparks" class="">
            <li class="sparks-info">
                <h5> No. of Sectors <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;17</span></h5>
            </li>
            <li class="sparks-info">
                <h5> Thematic Areas <span class="txt-color-purple"><i class="fa fa-arrow-circle-up" data-rel="bootstrap-tooltip" title="Increased"></i>&nbsp;4</span></h5>
            </li>
        </ul>
    </div>
</div>

<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-darken" id="wid-id-0" data-widget-editbutton="false">
                <!-- widget options:
				usage: <div class="jarviswidget" id="wid-id-0" data-widget-editbutton="false">

				data-widget-colorbutton="false"
				data-widget-editbutton="false"
				data-widget-togglebutton="false"
				data-widget-deletebutton="false"
				data-widget-fullscreenbutton="false"
				data-widget-custombutton="false"
				data-widget-collapsed="true"
				data-widget-sortable="false"

				-->
                <header>
                    <span class="widget-icon"> <i class="fa fa-table"></i> </span>
                    <h2>Sectors and Thematic Areas </h2>

                </header>

                <!-- widget div-->
                <div>

                    <!-- widget edit box -->
                    <div class="jarviswidget-editbox">
                        <!-- This area used as dropdown edit box -->

                    </div>
                    <!-- end widget edit box -->

                    <!-- widget content -->
                    <div class="widget-body no-padding">
                        <?php
                        echo $data->render();
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
<!-- end widget grid -->

<script type="text/javascript">


    pageSetUp();


    // pagefunction
    var pagefunction = function() {

    };





</script>
