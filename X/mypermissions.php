<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/mypermissions';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
$permissions = auth()->user()->role->permissions->toArray();
?>
<style>
    .alert-info {
        border-color: #342806;
        color: #0b0e27;
    }
    .alert {
        border-left-width: 15px;
        border-right-width: 15px;
    }
</style>


<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-3" data-widget-sortable="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-bar-chart"></i> </span>
                    <h2>Current User Permissions for User: <strong><?php echo auth()->user()->username;?></strong> <i> with assigned Role: <strong><?php echo auth()->user()->role->description;?></i></strong></h2>
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
                        <h2>A total of <strong><?php echo count($permissions) ?> Permissions </strong>assigned for User: <strong><?php echo auth()->user()->username;?></strong> <i> with assigned Role: <strong><?php echo auth()->user()->role->description;?>.<br></h2>
                        <?php
                        $i = 1;
                        foreach ($permissions as $permission){
                            ?>
                            <div>
                                <alert dismissible="false" type="success"><!---->
                                    <div role="alert" class="alert alert-info alert-dismissible ng-star-inserted bg-color-greenLight"> <!---->
                                        <h5 class="alert-heading"><?php echo $i . ": " . $permission['name']; ?></h5>
                                        <p><?php echo $permission['description']; ?></p></div>
                                </alert>
                            </div>
                            <?php
                            //echo $i . ": " . $permission['name'] . " === > " . $permission['description'] . "<br>";
                            $i = $i + 1;
                        }
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

    /* DO NOT REMOVE : GLOBAL FUNCTIONS!
     *
     * pageSetUp(); WILL CALL THE FOLLOWING FUNCTIONS
     *
     * // activate tooltips
     * $("[rel=tooltip]").tooltip();
     *
     * // activate popovers
     * $("[rel=popover]").popover();
     *
     * // activate popovers with hover states
     * $("[rel=popover-hover]").popover({ trigger: "hover" });
     *
     * // activate inline charts
     * runAllCharts();
     *
     * // setup widgets
     * setup_widgets_desktop();
     *
     * // run form elements
     * runAllForms();
     *
     ********************************
     *
     * pageSetUp() is needed whenever you load a page.
     * It initializes and checks for all basic elements of the page
     * and makes rendering easier.
     *
     */

    pageSetUp();

    // PAGE RELATED SCRIPTS

    // pagefunction

    var pagefunction = function() {

        // switch style change
        $('input[name="checkbox-style"]').change(function() {
            //alert($(this).val())
            $this = $(this);

            if ($this.attr('value') === "switch-1") {
                $("#switch-1").show();
                $("#switch-2").hide();
            } else if ($this.attr('value') === "switch-2") {
                $("#switch-1").hide();
                $("#switch-2").show();
            }

        });

        // tab - pills toggle
        $('#show-tabs').click(function() {
            $this = $(this);
            if($this.prop('checked')){
                $("#widget-tab-1").removeClass("nav-pills").addClass("nav-tabs");
            } else {
                $("#widget-tab-1").removeClass("nav-tabs").addClass("nav-pills");
            }

        });

    };

    // end pagefunction

    // run pagefunction on load

    pagefunction();


</script>
