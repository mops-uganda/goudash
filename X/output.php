<?php
require_once("inc/init.php");
?>
<div id="inbox-content" class="inbox-body no-content-padding">

    <div id="menu-list" class="inbox-side-bar">
        <h4>Key Outputs</h4><br>
        <ul class="inbox-menu-lg">
            <li>
                <a class="vote-load" href="javascript:void(0);"><i class="fa fa-lg fa-fw fa-circle-o-notch"></i> Ministry / Agency</a>
            </li>
            <li>
                <a class="prog-load" href="javascript:void(0);"><i class="fa fa-lg fa-fw fa-circle-o-notch"></i> Programme</a>
            </li>
        </ul>



        <div class="air air-bottom inbox-space">
            Key <strong>Outputs</strong>
        </div>

    </div>

    <div class="table-wrap custom-scroll animated fast fadeInRight">
        <!-- ajax will fill this area -->
        LOADING...

    </div>


</div>

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

        // fix table height
        tableHeightSize();

        $(window).resize(function() {
            tableHeightSize()
        })
        function tableHeightSize() {

            if ($('body').hasClass('menu-on-top')) {
                var menuHeight = 68;
                // nav height

                var tableHeight = ($(window).height() - 224) - menuHeight;
                if (tableHeight < (320 - menuHeight)) {
                    $('.table-wrap').css('height', (320 - menuHeight) + 'px');
                } else {
                    $('.table-wrap').css('height', tableHeight + 'px');
                }

            } else {
                var tableHeight = $(window).height() - 224;
                if (tableHeight < 320) {
                    $('.table-wrap').css('height', 320 + 'px');
                } else {
                    $('.table-wrap').css('height', tableHeight + 'px');
                }

            }

        }

        /*
         * LOAD INBOX MESSAGES
         */
        loadInbox();
        function loadInbox() {
            loadURL("X/budgets-sector.php", $('#inbox-content > .table-wrap'))
        }

        /*
         * Buttons (compose mail and inbox load)
         */
        $(".sector-load").click(function() {
            loadInbox();
            $("#menu-list>ul>li.active").removeClass("active");
            $(".inbox-menu-lg li").eq(0).addClass("active");
        });
        $(".vote-load").click(function() {
            loadURL("X/budgets-vote.php", $('#inbox-content > .table-wrap'));
            $("#menu-list>ul>li.active").removeClass("active");
            $(".inbox-menu-lg li").eq(1).addClass("active");
        });
        $(".prog-load").click(function() {
            loadURL("X/budgets-programme.php", $('#inbox-content > .table-wrap'));
            $("#menu-list>ul>li.active").removeClass("active");
            $(".inbox-menu-lg li").eq(2).addClass("active");
        });
        $(".dept-load").click(function() {
            loadURL("X/budgets-departments.php", $('#inbox-content > .table-wrap'));
            $("#menu-list>ul>li.active").removeClass("active");
            $(".inbox-menu-lg li").eq(3).addClass("active");
        });
        $(".key-outputs-load").click(function() {
            loadURL("X/budgets-keyoutputs.php", $('#inbox-content > .table-wrap'));
            $("#menu-list>ul>li.active").removeClass("active");
            $(".inbox-menu-lg li").eq(4).addClass("active");
        });
        $(".detailed-items-load").click(function() {
            loadURL("X/budgets-lineitems.php", $('#inbox-content > .table-wrap'));
            $("#menu-list>ul>li.active").removeClass("active");
            $(".inbox-menu-lg li").eq(5).addClass("active");
        });

        // compose email
        $("#compose-mail").click(function() {
            loadURL("X/email-compose.php", $('#inbox-content > .table-wrap'));
        });

    };

    // end pagefunction

    // load delete row plugin and run pagefunction

    loadScript("js/plugin/delete-table-row/delete-table-row.min.js", pagefunction);

</script>
