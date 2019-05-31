<?php echo $this->render_table_name(); ?>
<?php if ($this->is_create or $this->is_csv or $this->is_print){?>
    <div class="xcrud-top-actions">
        <div class="btn-group pull-right">
            <?php echo $this->print_button('btn btn-default','glyphicon glyphicon-print');
            echo $this->csv_button('btn btn-default','glyphicon glyphicon-file'); ?>
            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal2">
                <i class="fa fa-info"></i> Info
            </button>
        </div>
        <?php echo $this->add_button('btn btn-success','glyphicon glyphicon-plus-sign'); ?>
        <div class="clearfix"></div>
    </div>
<?php } ?>
<div class="xcrud-list-container">
    <table class="xcrud-list table table-striped table-hover table-bordered">
        <thead>
        <?php echo $this->render_grid_head('tr', 'th'); ?>
        </thead>
        <tbody id="<?php echo $this->table_name ?>">
        <?php echo $this->render_grid_body('tr', 'td'); ?>
        </tbody>
        <tfoot>
        <?php echo $this->render_grid_footer('tr', 'td'); ?>
        </tfoot>
    </table>
</div>
<div class="xcrud-nav">
    <?php echo $this->render_limitlist(true); ?>
    <?php echo $this->render_pagination(); ?>
    <?php echo $this->render_search(); ?>
    <?php echo $this->render_benchmark(); ?>
</div>
<!-- Modal -->
<div class="modal right fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h3 class="modal-title" id="myModalLabel2">Welcome to the Public Service Smart Dashboard</h3>
            </div>

            <div id="help_modal_window" class="modal-body">
                <span style="font-family: Verdana, Geneva, sans-serif; font-size: 16px;">
                    <p>Smart Dashboard for the Public Service analyses and displays visual data on the following.</p>
                    <ol><li>Large Screens at key points for target audiences.</li><li>Mobile Devices like Ipads, Tablets and Phones.</li><li>Desktop Computers.</li></ol>
                    <p>The System has intelligence tools to generate the following presentation layers, that will be visually appealing and easily interpreted by all audiences.</p>
                    <ol><li>Graphs,</li><li>Charts,</li><li>Maps, and</li><li>Tabular Data</li></ol>
                </span>
            </div>

        </div><!-- modal-content -->
    </div><!-- modal-dialog -->
</div><!-- modal -->

<style>
    /*******************************
* MODAL AS LEFT/RIGHT SIDEBAR
* Add "left" or "right" in modal parent div, after class="modal".
* Get free snippets on bootpen.com
*******************************/
    .modal.left .modal-dialog,
    .modal.right .modal-dialog {
        position: fixed;
        margin: auto;
        width: 80%;
        height: 100%;
        -webkit-transform: translate3d(0%, 0, 0);
        -ms-transform: translate3d(0%, 0, 0);
        -o-transform: translate3d(0%, 0, 0);
        transform: translate3d(0%, 0, 0);
    }

    .modal.left .modal-content,
    .modal.right .modal-content {
        height: 100%;
        overflow-y: auto;
        background-image: url("img/bg_material.jpg");
    }

    .modal.left .modal-body,
    .modal.right .modal-body {
        padding: 15px 15px 80px;
    }

    /*Left*/
    .modal.left.fade .modal-dialog{
        left: -320px;
        -webkit-transition: opacity 0.3s linear, left 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, left 0.3s ease-out;
        -o-transition: opacity 0.3s linear, left 0.3s ease-out;
        transition: opacity 0.3s linear, left 0.3s ease-out;
    }

    .modal.left.fade.in .modal-dialog{
        left: 0;
    }

    /*Right*/
    .modal.right.fade .modal-dialog {
        right: -320px;
        -webkit-transition: opacity 0.3s linear, right 0.3s ease-out;
        -moz-transition: opacity 0.3s linear, right 0.3s ease-out;
        -o-transition: opacity 0.3s linear, right 0.3s ease-out;
        transition: opacity 0.3s linear, right 0.3s ease-out;
    }

    .modal.right.fade.in .modal-dialog {
        right: 0;
    }

    /* ----- MODAL STYLE ----- */
    .modal-content {
        border-radius: 0;
        border: none;
    }

    .modal-header {
        padding-top: 10px;
        padding-bottom: 0px;
        font-size: xx-large;
        margin-bottom: 10px;
        background-color: #b5b694;
        border: 1px solid #9c9d7b;
        background-image: -o-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -moz-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -webkit-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -ms-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: linear-gradient(to bottom, #cecfad 0%, #b5b694 100%);
        -webkit-box-shadow: inset 0 1px 0 #e7e8c6;
        -moz-box-shadow: inset 0 1px 0 #e7e8c6;
        box-shadow: inset 0 1px 0 #e7e8c6;
        text-shadow: 0 1px 0 #e7e8c6;
        color: #1e1f06;
    }
    .modal .modal-header .close {
        font-size: xx-large;
        color: #070707;
        margin-bottom: 10px;
        opacity: .4;
    }
</style>