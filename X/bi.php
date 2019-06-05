<?php
require_once '../securex/extra/auth.php';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
$returnURL = 'X/bi';
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
require_once("inc/init.php");
require ('../lib/xcrud/xcrud.php');


$db = Xcrud_db::get_instance();
$db->query('SELECT DISTINCT reportCategory FROM reports');
$result = $db->result();
$db->query('SELECT rid, ReportTitle, reportCategory, link, reportType, hasFilter, filterSQL, filterText, filterURL, filterColumn, hasFilter2, filterSQL2, filterText2, filterURL2, filterColumn2, hasFilter3, filterSQL3, filterText3, filterURL3, filterColumn3 FROM reports');
$reports_list = $db->result();
?>
<div>
<!-- widget grid -->
<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-sm-12 col-md-12 col-lg-12" style="height: 70%;">

            <!-- Widget ID (each widget will need unique ID)-->
            <div style="height: 70%;" class="jarviswidget jarviswidget-color-greenLight" id="wid-id-2" data-widget-editbutton="false" data-widget-deletebutton="false" data-widget-sortable="false">
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
                    <h2>Business Intelligence Analytical Tool </h2>
                </header>
                <!-- widget div-->
                <div id="bi" class="row">
                    <!-- widget content -->
                    <div class="col-sm-12 col-xs-12 innerDIV">
                        <div class="shadd col-sm-12 col-xs-12">
                            <form class="smart-form ng-untouched ng-pristine ng-valid" novalidate="">
                                <div class="col-3 col-xs-12 section_block">
                                    <header>
                                        <li class="fa fa-slack"></li> Report Category
                                    </header>
                                    <fieldset>
                                        <section>
                                            <label class="select report-btn">
                                                <!--                                            <select onchange="data_filter(this.value)">-->
                                                <select @change="r_filter($event)" id="ReportCategory">
                                                    <option value="0">Choose Report Category</option>
                                                    <?php
                                                    foreach ($result as $row){
                                                        print_r(' <option value="' . $row["reportCategory"] . '">' . $row["reportCategory"] . '</option>');
                                                    }
                                                    ?>
                                                </select> <i></i>
                                            </label>
                                            <section>
                                                <label class="toggle">
                                                    <input checked="checked" name="radio-toggle" type="radio">
                                                    <i data-swchoff-text="OFF" data-swchon-text="ON"></i>Preset Reports</label>
                                                <label class="toggle">
                                                    <input name="radio-toggle" type="radio">
                                                    <i data-swchoff-text="OFF" data-swchon-text="ON"></i>Report From Table</label>
                                            </section>
                                        </section>
                                    </fieldset>
                                </div>
                                <div class="col-3 col-xs-12 section_block">
                                    <header>
                                        <li class="fa fa-slack"></li> Select Report
                                    </header>
                                    <fieldset>
                                        <section>
                                            <label class="select report-btn">
                                                <select @change="report_changed($event)" id="Select_Report_Table" v-model="report_id">
                                                    <option value="500">Select Report</option>
                                                    <option v-for="item in filtered_list" :value="item.rid">{{ item.ReportTitle }}</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </fieldset>
                                    <fieldset>
                                        <a @click="loadReport()" class="btn btn-labeled bg-color-greenLight txt-color-white report-btn"> <span class="btn-label"><i class="glyphicon glyphicon-th-list"></i></span>View {{ report_type }} </a>
                                    </fieldset>
                                </div>
                                <div class="col-3 col-xs-12 section_block">
                                    <header>
                                        <li class="fa fa-slack"></li> Filter Report
                                    </header>
                                    <fieldset>
                                        <section>
                                            <label v-if="hasFilter_1 === 'on'" class="select report-btn">
                                                <select class="input-sm">
                                                    <option value="0">Select /  {{ selected_row[0].filterText }}</option>
                                                    <option v-for="filter_item in filter_select_1" :value="filter_item[filter_1_value]">{{ filter_item[filter_1_name] }}</option>
                                                </select> <i></i>
                                            </label>
                                            <label v-if="hasFilter_2 === 'on'" class="select report-btn">
                                                <select class="input-sm">
                                                    <option value="0">Select /  {{ selected_row[0].filterText2 }}</option>
                                                    <option v-for="filter_item in filter_select_2" :value="filter_item[filter_2_value]">{{ filter_item[filter_2_name] }}</option>
                                                </select> <i></i>
                                            </label>
                                            <label v-if="hasFilter_3 === 'on'" class="select report-btn">
                                                <select class="input-sm">
                                                    <option value="0">Select /  {{ selected_row[0].filterText3 }}</option>
                                                    <option v-for="filter_item in filter_select_3" :value="filter_item[filter_3_value]">{{ filter_item[filter_3_name] }}</option>
                                                </select> <i></i>
                                            </label>
                                        </section>
                                    </fieldset>
                                </div>
                                <div class="col-3 col-xs-12 section_block">
                                    <header>
                                        <li class="fa fa-slack"></li> Select Fields
                                    </header>
                                    <fieldset>
                                        <section>
                                            <div class="row">
                                                <div class="col col-4">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox" checked="checked">
                                                        <i></i>Field 1</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox">
                                                        <i></i>Field 2</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox">
                                                        <i></i>Field 3</label>
                                                </div>
                                                <div class="col col-4">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox">
                                                        <i></i>Field 4</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox">
                                                        <i></i>Field 5</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox">
                                                        <i></i>Field 6</label>
                                                </div>
                                                <div class="col col-4">
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox">
                                                        <i></i>Field 7</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox">
                                                        <i></i>Field 8</label>
                                                    <label class="checkbox">
                                                        <input type="checkbox" name="checkbox">
                                                        <i></i>Field 9</label>
                                                </div>
                                            </div>
                                        </section>
                                    </fieldset>
                                </div>
                            </form>
                        </div>
                    </div>
                    <div class="col-sm-12 col-xs-12 innerDIV">
                        <div id="report_content" class="shadd col-sm-12 col-xs-12" style="background-image: url('img/bg_material2.jpg')">
                            Select Report
                        </div>
                    </div>
                    <!-- end widget content -->
                    <div class="col-md-12" style="margin-bottom: 10px"> </div>
                </div>
                <!-- end widget div -->

            </div>
            <!-- end widget -->

        </article>
        <!-- WIDGET END -->

    </div>

    <!-- end row -->

</section>
<!-- end widget grid -->

</div>

<script type="text/javascript">
    pageSetUp();

    // pagefunction

    var pagefunction = function() {

    };

    // end pagefunction
    // Load bootstrap wizard dependency then run pagefunction
    pagefunction();

</script>


<!--Vue Script-->
<script>
    new Vue({
        el: '#bi',
        data: {
            report_id: 500,
            report_link: "reports",
            report_type: "All Reports",
            reports_list: <?php echo json_encode($reports_list); ?>,
            filtered_list:[], selected_row:[],
            hasFilter_1: "off", filter_select_1:[], filter_1_name: "", filter_1_value: "", filterText1: "",
            hasFilter_2: "off", filter_select_2:[], filter_2_name: "", filter_2_value: "", filterText2: "",
            hasFilter_3: "off", filter_select_3:[], filter_3_name: "", filter_3_value: "", filterText3: "",
        },
        computed: {
            full_link: function () {
                return 'X/' + this.report_link + '?id=' + this.report_id
            }
        },
        methods: {
            report_changed(event) {
                this.selected_row = this.reports_list.filter(
                    function (el) {
                        return (el.rid === event.target.value);
                    }
                );
                this.report_type = this.selected_row[0].reportType;
                this.report_link = this.selected_row[0].link;
                // console.log(this.selected_row);

                // filter 1
                if (this.selected_row[0].hasFilter === "1") {
                    axios.get('X/api?sql=' + this.selected_row[0].filterSQL)
                        .then(response => {
                            this.filter_select_1 = response.data;
                            if (Object.keys(this.filter_select_1[0]).length == 1){
                                this.filter_1_name = Object.keys(this.filter_select_1[0])[0];
                                this.filter_1_value = Object.keys(this.filter_select_1[0])[0];
                            }
                            if (Object.keys(this.filter_select_1[0]).length == 2){
                                this.filter_1_name = Object.keys(this.filter_select_1[0])[1];
                                this.filter_1_value = Object.keys(this.filter_select_1[0])[0];
                            }
                        });
                    this.hasFilter_1 = "on";
                } else {
                    this.hasFilter_1 = "off";
                }

                // filter 2
                if (this.selected_row[0].hasFilter2 === "1") {
                    axios.get('X/api?sql=' + this.selected_row[0].filterSQL2)
                        .then(response => {
                            this.filter_select_2 = response.data;
                            if (Object.keys(this.filter_select_2[0]).length == 1){
                                this.filter_2_name = Object.keys(this.filter_select_2[0])[0];
                                this.filter_2_value = Object.keys(this.filter_select_2[0])[0];
                            }
                            if (Object.keys(this.filter_select_2[0]).length == 2){
                                this.filter_2_name = Object.keys(this.filter_select_2[0])[1];
                                this.filter_2_value = Object.keys(this.filter_select_2[0])[0];
                            }
                        });
                    this.hasFilter_2 = "on";
                } else {
                    this.hasFilter_2 = "off";
                }

                // filter 3
                if (this.selected_row[0].hasFilter3 === "1") {
                    axios.get('X/api?sql=' + this.selected_row[0].filterSQL3)
                        .then(response => {
                            this.filter_select_3 = response.data;
                            if (Object.keys(this.filter_select_3[0]).length == 1){
                                this.filter_3_name = Object.keys(this.filter_select_3[0])[0];
                                this.filter_3_value = Object.keys(this.filter_select_3[0])[0];
                            }
                            if (Object.keys(this.filter_select_3[0]).length == 2){
                                this.filter_3_name = Object.keys(this.filter_select_3[0])[1];
                                this.filter_3_value = Object.keys(this.filter_select_3[0])[0];
                            }
                        });
                    this.hasFilter_3 = "on";
                } else {
                    this.hasFilter_3 = "off";
                }
            },
            r_filter(event) {
                this.filtered_list = this.reports_list.filter(
                    function (el) {
                        return (el.reportCategory === event.target.value);
                    }
                );
                this.report_id = 500;
                this.report_link = "reports";
                this.report_type = "All Reports";
                this.hasFilter_1 = "off"; this.filter_select_1 = []; this.filter_1_name = ""; this.filter_1_value = "";
                this.hasFilter_2 = "off"; this.filter_select_2 = []; this.filter_2_name = ""; this.filter_2_value = "";
                this.hasFilter_3 = "off"; this.filter_select_3 = []; this.filter_3_name = ""; this.filter_3_value = "";
            },
            loadReport(){
                //console.log(this.full_link);
                //loadURL("X/email-reply.html", $('#report_content > .table-wrap'));
                $('#report_content').load( this.full_link );
            }
        }
    })

    // this.report_id = event.target.value;
    // var mytext = $("#Select_Report_Table option:selected").text();
    // console.log(mytext);
</script>
<!--End Vue Script-->


<style>
    .shadd {
        padding-left: 5px;
        -moz-box-shadow: 1px 1px 4px 0px rgba(173,184,186,1);
        box-shadow: 1px 1px 3px 0px rgba(173,184,186,1);
        background-color: #ffffff;
        margin-right: 5px;
        margin-bottom: 10px;
        display: inline-block;
        padding-right: 6px;
    }
    .section_block {
        margin-right: 5px;
        margin-bottom: 10px;
        display: inline-block;
        vertical-align: top;
    }
    .innerDIV {
        padding-left: 8px;
        padding-right: 8px;
    }
    .jarviswidget>div {
        background-color: #edf1f3 !important;
    }
    .report-btn {
        width: 100%;
        margin-bottom: 10px;
    }
    .smart-form .toggle {
        margin-bottom: 1px;
        font-size: 13px;
    }
    .smart-form .col-3 {
        width: 24%;
    }
    .smart-form .select-multiple select {
        height: 160px;
    }
</style>