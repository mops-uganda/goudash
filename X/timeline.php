<?php
require_once("inc/init.php");
require_once '../securex/extra/auth.php';

$user = Auth::user();
$username = $user->username;

?>
<style>
    .avatar img {
        height: 100px;
        max-width: 100%;
        border-radius: 50%;
    }
    /*avatar*/
    .avatar {
        display: inline-block;
        white-space: nowrap;
    }
    .avatar-lg {
        width: 125px;
        height:125px;
    }
    .avatar-md {
        width: 80px;
        height: 80px;
    }
    .avatar-sm {
        width: 50px;
        height: 50px;
    }
    .avatar-xs {
        width: 30px;
        height: 30px;
    }

    .avatar img{
        height: auto;
        max-width: 100%;
        border-radius: 50%;
    }

    .box {
        display: table;
        table-layout: fixed;
        border-spacing: 0;
        width: 100%;
    }
    .box-content {
        display: table-cell;
        vertical-align: top;
        height: 100%;
        float: none;
        overflow-x: hidden;
    }
    .box.fit .box-content{
        width: 100%;
    }
    .clickable {
        cursor: pointer;
    }

    .not-clickable {
        cursor: default !important;
    }

    .inline-block{
        display: inline-block;
    }
    .block{
        display: block;
    }

    /*form*/
    label{
        font-weight: normal;
    }
    .general-form .form-group:before,
    .general-form .form-group:after {
        content: "";
        display: table;
        line-height: 0;
    }
    .general-form .form-group:after {
        clear: both;
    }
    .general-form textarea {
        height: 75px;
    }
    .general-form .select2 {
        width: 100%;
    }
    .general-form .mini {
        max-width: 200px;
    }

    .general-form .form-control {
        border-radius: 2px;
        border-color: #f6f8f9;
        background-color: #f6f8f9;
        box-shadow: none;
        transition: background 0.5s;
    }

    .general-form.white .form-control {
        border-color: #fff;
        background-color: #fff;
    }
    .general-form.white label {
        margin-top: 5px;
    }
    .general-form.white .select2-container .select2-choice{
        background-color: #fff !important;
    }

    .has-error .help-block,
    .has-error .control-label,
    .has-error .radio,
    .has-error .checkbox,
    .has-error .radio-inline,
    .has-error .checkbox-inline,
    .has-error.radio label,
    .has-error.checkbox label,
    .has-error.radio-inline label,
    .has-error.checkbox-inline label{
        box-shadow: none;
        color: #ec5855;
    }
    .general-form .has-error .form-control{
        box-shadow: none;
        color: #ec5855;
    }
    .general-form .form-control.white {
        background-color: #fff;
    }
    .general-form .form-control:focus,
    .general-form .form-control.white:focus{
        border-color: #ebeff2;
        background-color: #ebeff2;
    }
    .general-form .input-group-addon{
        border-color: #f6f8f9;
        background: #f7f9fa;
        border-radius: 2px;
    }
    .form-control:focus{
        box-shadow: none;
    }

    .file-upload {
        position: relative;
        overflow: hidden;
        margin: 10px;
    }
    .file-upload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }


    .dashed-row .form-group{
        border-bottom: 1px dashed #e2e4e8;
        padding-bottom: 15px;
    }
    .dashed-row .form-group:last-child{
        border-bottom: none;
        padding-bottom: 0px;
    }
    .dashed-row .bd {
        border-bottom: 1px dotted #e2e4e8;
    }
    textarea {
        -webkit-appearance: textarea;
        -webkit-rtl-ordering: logical;
        flex-direction: column;
        resize: auto;
        cursor: text;
        white-space: pre-wrap;
        word-wrap: break-word;
    }
</style>
<!-- row -->

<div class="row">

	<!-- col -->
	<div class="col-xs-12 col-sm-7 col-md-7 col-lg-4">
		<h1 class="page-title txt-color-blueDark"><!-- PAGE HEADER --><i class="fa-fw fa fa-home"></i> Other Pages <span>>
			Timeline </span></h1>
	</div>
	<!-- end col -->

<!-- right side of the page with the sparkline graphs -->
	<!-- col -->
	<!-- end col -->

</div>
<!-- end row -->

<div id="post-form-container">
    <form action="#X/timeline_post" id="post-form" class="general-form" role="form" method="post" accept-charset="utf-8" novalidate="novalidate">
        <div class="box">
            <div class="box-content avatar avatar-md pr15">
                <img src="./securex/public/upload/users/<?php echo $user->avatar; ?>" alt="..." class="avatar">
            </div>
            <div id="post-dropzone" class="post-dropzone box-content form-group">
                <input type="hidden" name="post_id" value="0">
                <input type="hidden" name="reload_list" value="1">
                <textarea name="description" cols="40" rows="4" id="post_description" class="form-control white" placeholder="Share an idea or documents..." data-rule-required="1" data-msg-required="This field is required." aria-required="true" aria-invalid="false"></textarea>

                <div class="post-file-dropzone-scrollbar mCustomScrollbar _mCS_6 mCS-autoHide hide mCS_no_scrollbar" style="height: 90px; position: relative; overflow: visible;"><div id="mCSB_6" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: 90px;"><div id="mCSB_6_container" class="mCSB_container mCS_y_hidden mCS_no_scrollbar_y" style="position:relative; top:0; left:0;" dir="ltr">
                            <div class="post-file-previews clearfix b-t" id="kguedgaijgzfbwl">

                            </div>
                        </div></div><div id="mCSB_6_scrollbar_vertical" class="mCSB_scrollTools mCSB_6_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical mCSB_scrollTools_onDrag_expand" style="display: none;"><div class="mCSB_draggerContainer"><div id="mCSB_6_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; display: block; height: 65px; max-height: 56px; top: 0px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div>
                <footer class="panel-footer b-a clearfix">
                    <button class="btn btn-default upload-file-button pull-left btn-sm round dz-clickable" type="button" style="color:#7988a2" id="zdowhtfpdgnowcp"><i class="fa fa-camera"></i> Upload File</button>
                    <button class="submit-button btn btn-primary pull-right btn-sm" type="submit"><i class="fa fa-paper-plane"></i> Post</button>
                </footer>
            </div>
        </div></form>
</div>

<script type="text/javascript">
    var frm = $('#post-form');

    frm.submit(function (e) {

        e.preventDefault();

        $.ajax({
            type: frm.attr('method'),
            url: frm.attr('action'),
            data: frm.serialize(),
            success: function (data) {
                console.log(data);
                document.location.href='#X/timeline?_';
            },
            error: function (data) {
                console.log('An error occurred.');
                console.log(data);
            },
        });
    });
</script>

<!-- row -->
<div class="row">

	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

		<div class="well well-sm">
			<!-- Timeline Content -->
			<div class="smart-timeline">
				<ul class="smart-timeline-list">
					<li>
						<div class="smart-timeline-icon">
							<img src="img/avatars/sunny.png" width="32" height="32" />
						</div>
						<div class="smart-timeline-time">
							<small>just now</small>
						</div>
						<div class="smart-timeline-content">
							<p>
								<a href="javascript:void(0);"><strong>Trip to Adalaskar</strong></a>
							</p>
							<p>
								Check out my tour to Adalaskar
							</p>
							<p>
								<a href="javascript:void(0);" class="btn btn-xs btn-primary"><i class="fa fa-file"></i> Read the post</a>
							</p>
							<img src="img/superbox/superbox-thumb-4.jpg" alt="img" width="150">



						</div>
					</li>
					<li>
						<div class="smart-timeline-icon">
							<i class="fa fa-file-text"></i>
						</div>
						<div class="smart-timeline-time">
							<small>1 min ago</small>
						</div>
						<div class="smart-timeline-content">
							<p>
								<strong>Meeting invite for "GENERAL GNU" [<a href="javascript:void(0);"><i>Go to my calendar</i></a>]</strong>
							</p>

							<div class="well well-sm display-inline">
								<p>Will you be able to attend the meeting - <strong> 10:00 am</strong> tomorrow?</p>
								<button class="btn btn-xs btn-default">Confirm Attendance</button>
							</div>

						</div>
					</li>
					<li>
						<div class="smart-timeline-icon bg-color-greenDark">
							<i class="fa fa-bar-chart-o"></i>
						</div>
						<div class="smart-timeline-time">
							<small>5 hrs ago</small>
						</div>
						<div class="smart-timeline-content">
							<p>
								<strong class="txt-color-greenDark">24hrs User Feed</strong>
							</p>

							<div class="sparkline"
							data-sparkline-type="compositeline"
							data-sparkline-spotradius-top="5"
							data-sparkline-color-top="#3a6965"
							data-sparkline-line-width-top="3"
							data-sparkline-color-bottom="#2b5c59"
							data-sparkline-spot-color="#2b5c59"
							data-sparkline-minspot-color-top="#97bfbf"
							data-sparkline-maxspot-color-top="#c2cccc"
							data-sparkline-highlightline-color-top="#cce8e4"
							data-sparkline-highlightspot-color-top="#9dbdb9"
							data-sparkline-width="170px"
							data-sparkline-height="40px"
							data-sparkline-line-val="[6,4,7,8,4,3,2,2,5,6,7,4,1,5,7,9,9,8,7,6]"
							data-sparkline-bar-val="[4,1,5,7,9,9,8,7,6,6,4,7,8,4,3,2,2,5,6,7]"></div>

							<br>
						</div>
					</li>
					<li>
						<div class="smart-timeline-icon">
							<i class="fa fa-user"></i>
						</div>
						<div class="smart-timeline-time">
							<small>yesterday</small>
						</div>
						<div class="smart-timeline-content">
							<p>
								<a href="javascript:void(0);"><strong>Update user information</strong></a>
							</p>
							<p>
								Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus.
							</p>

							Tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit

							<ul class="list-inline">
								<li>
									<img src="img/superbox/superbox-thumb-6.jpg" alt="img" width="50">
								</li>
								<li>
									<img src="img/superbox/superbox-thumb-5.jpg" alt="img" width="50">
								</li>
								<li>
									<img src="img/superbox/superbox-thumb-7.jpg" alt="img" width="50">
								</li>
							</ul>
						</div>
					</li>
					<li>
						<div class="smart-timeline-icon">
							<i class="fa fa-pencil"></i>
						</div>
						<div class="smart-timeline-time">
							<small>12 Mar, 2013</small>
						</div>
						<div class="smart-timeline-content">
							<p>
								<a href="javascript:void(0);"><strong>Nabi Resource Report</strong></a>
							</p>
							<p>
								Ean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis.
							</p>
							<a href="javascript:void(0);" class="btn btn-xs btn-default">Read more</a>
						</div>
					</li>
					<li class="text-center">
						<a href="javascript:void(0)" class="btn btn-sm btn-default"><i class="fa fa-arrow-down text-muted"></i> LOAD MORE</a>
					</li>
				</ul>
			</div>
			<!-- END Timeline Content -->

		</div>

	</div>

</div>

<!-- end row -->


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

	/*
	 * ALL PAGE RELATED SCRIPTS CAN GO BELOW HERE
	 * eg alert("my home function");
	 */

	// pagefunction
	
	var pagefunction = function() {
		
	};
	
	// end pagefunction
	
	// run pagefunction on load

	pagefunction();

</script>
