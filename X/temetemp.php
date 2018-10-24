<div class="box-content">
    <div id="timeline-content" class="clearfix p15 mb20 mCustomScrollbar _mCS_4 mCS-autoHide mCS_touch_action" style="height: 703px; position: relative; overflow: visible;"><div id="mCSB_4" class="mCustomScrollBox mCS-minimal-dark mCSB_vertical mCSB_outside" tabindex="0" style="max-height: none;"><div id="mCSB_4_container" class="mCSB_container" style="position: relative; top: 0px; left: 0px;" dir="ltr">
                <div id="post-form-container">
                    <form action="http://me.publicservice.go.ug/index.php/timeline/save" id="post-form" class="general-form" role="form" method="post" accept-charset="utf-8" novalidate="novalidate">
                        <div class="box">
                            <div class="box-content avatar avatar-md pr15">
                                <img src="http://me.publicservice.go.ug/assets/images/avatar.jpg" alt="..." class="mCS_img_loaded">
                            </div>
                            <div id="post-dropzone" class="post-dropzone box-content form-group">
                                <input type="hidden" name="post_id" value="0">
                                <input type="hidden" name="reload_list" value="1">
                                <textarea name="description" cols="40" rows="10" id="post_description" class="form-control white" placeholder="Share an idea or documents..." data-rule-required="1" data-msg-required="This field is required." aria-required="true"></textarea>

                                <div class="post-file-dropzone-scrollbar hide">
                                    <div class="post-file-previews clearfix b-t" id="iddowmldyajuoou">

                                    </div>
                                </div>
                                <footer class="panel-footer b-a clearfix">
                                    <button class="btn btn-default upload-file-button pull-left btn-sm round dz-clickable" type="button" style="color:#7988a2" id="eocaljekwwvykte"><i class="fa fa-camera"></i> Upload File</button>
                                    <button class="submit-button btn btn-primary pull-right btn-sm" type="submit"><i class="fa fa-paper-plane"></i> Post</button>
                                </footer>
                            </div>
                        </div></form>
                </div>
                <script type="text/javascript">
                    $(document).ready(function() {

                        var uploadUrl = "http://me.publicservice.go.ug/index.php/timeline/upload_file";
                        var validationUrl = "http://me.publicservice.go.ug/index.php/timeline/validate_post_file";
                        var dropzone = attachDropzoneWithForm("#post-dropzone", uploadUrl, validationUrl);

                        $("#post-form").appForm({
                            isModal: false,
                            onSuccess: function(result) {
                                if ($("body").hasClass("dropzone-disabled")) {
                                    location.reload();
                                } else {
                                    $("#post_description").val("");
                                    $("#timeline").prepend(result.data);
                                    dropzone.removeAllFiles();
                                }
                            }
                        });

                    });
                </script>            <div id="timeline">    <div id="post-content-container-4" class="post-content">
                        <div class="post clearfix">
                            <div class="post-date clearfix">
                                <span>Today</span>
                            </div>
                            <div class="media clearfix">

                                <div class="media-body">
                                    <div class="clearfix mb15">
                                        <div class="media-left ">
                            <span class="avatar avatar-sm">
                                <img src="http://me.publicservice.go.ug/assets/images/avatar.jpg" alt="..." class="mCS_img_loaded">
                            </span>
                                        </div>
                                        <div class="media-left ">
                                            <div class="mt5"><a href="http://me.publicservice.go.ug/index.php/team_members/view/1" class="dark strong">Mundua Patrick</a></div>
                                            <small><span class="text-off">Today at 01:57 pm</span></small>
                                        </div>

                                        <!--  only admin and creator can delete the post -->
                                        <span class="pull-right mt-50 dropdown">
                                <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-chevron-down clickable"></i>
                                </div>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a href="#" class="" title="Delete" data-fade-out-on-success="#post-content-container-4" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/delete/4"><i class="fa fa-times"></i> Delete</a> </li>
                                </ul>
                            </span>

                                    </div>

                                    <p>
                                        Hallo                    </p>


                                    <div class="mb15 clearfix">
                                        <a href="#" data-real-target="#reply-form-container-4" class="dark" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/post_reply_form/4"><i class="fa fa-reply font-11"></i> Reply</a>                        <a href="#" class="hide" id="reload-reply-list-button-4" data-real-target="#reply-list-4" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/view_post_replies/4"></a>
                                    </div>
                                    <div id="reply-list-4">    <div id="reply-content-container-5" class="media mb15 b-l reply-container">
                                            <div class="media-left pl15">
            <span class="avatar avatar-xs">
                <img src="http://me.publicservice.go.ug/assets/images/avatar.jpg" alt="...">
            </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <a href="http://me.publicservice.go.ug/index.php/team_members/view/1" class="dark strong">Mundua Patrick</a>                <small><span class="text-off">Today at 10:23 pm</span></small>


                                                    <span class="pull-right dropdown reply-dropdown">
                        <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                            <small class="p5"> <i class="fa fa-chevron-down clickable"></i></small>
                        </div>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#" class="" title="Delete" data-fade-out-on-success="#reply-content-container-5" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/delete/5"><i class="fa fa-times"></i> Delete</a> </li>
                        </ul>
                    </span>
                                                </div>

                                                <p>Hello</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="reply-form-container-4"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="post-content-container-2" class="post-content">
                        <div class="post clearfix">
                            <div class="post-date clearfix">
                                <span>Today</span>
                            </div>
                            <div class="media clearfix">

                                <div class="media-body">
                                    <div class="clearfix mb15">
                                        <div class="media-left ">
                            <span class="avatar avatar-sm">
                                <img src="http://me.publicservice.go.ug/assets/images/avatar.jpg" alt="..." class="mCS_img_loaded">
                            </span>
                                        </div>
                                        <div class="media-left ">
                                            <div class="mt5"><a href="http://me.publicservice.go.ug/index.php/team_members/view/1" class="dark strong">Mundua Patrick</a></div>
                                            <small><span class="text-off">Today at 12:18 pm</span></small>
                                        </div>

                                        <!--  only admin and creator can delete the post -->
                                        <span class="pull-right mt-50 dropdown">
                                <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-chevron-down clickable"></i>
                                </div>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a href="#" class="" title="Delete" data-fade-out-on-success="#post-content-container-2" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/delete/2"><i class="fa fa-times"></i> Delete</a> </li>
                                </ul>
                            </span>

                                    </div>

                                    <p>
                                        Are you sure?                    </p>

                                    <div class="timeline-images mb15"><a href="http://me.publicservice.go.ug/files/timeline_files/timeline_post_file5b8f9f8046b12-FB_IMG_1459407306632.jpg" class="mfp-image" data-title="FB_IMG_1459407306632.jpg"><img src="http://me.publicservice.go.ug/files/timeline_files/timeline_post_file5b8f9f8046b12-FB_IMG_1459407306632.jpg" alt="timeline_post_file5b8f9f8046b12-FB_IMG_1459407306632.jpg" class="mCS_img_loaded"></a></div>
                                    <div class="mb15 clearfix">
                                        <a href="#" data-real-target="#reply-form-container-2" class="dark" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/post_reply_form/2"><i class="fa fa-reply font-11"></i> Reply</a>                        <a href="#" class="hide" id="reload-reply-list-button-2" data-real-target="#reply-list-2" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/view_post_replies/2"></a><a href="http://me.publicservice.go.ug/index.php/timeline/download_files/2" class="pull-right" title="Download">Download</a>
                                    </div>
                                    <div id="reply-list-2">    <div id="reply-content-container-3" class="media mb15 b-l reply-container">
                                            <div class="media-left pl15">
            <span class="avatar avatar-xs">
                <img src="http://me.publicservice.go.ug/assets/images/avatar.jpg" alt="...">
            </span>
                                            </div>
                                            <div class="media-body">
                                                <div class="media-heading">
                                                    <a href="http://me.publicservice.go.ug/index.php/team_members/view/1" class="dark strong">Mundua Patrick</a>                <small><span class="text-off">Today at 12:20 pm</span></small>


                                                    <span class="pull-right dropdown reply-dropdown">
                        <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                            <small class="p5"> <i class="fa fa-chevron-down clickable"></i></small>
                        </div>
                        <ul class="dropdown-menu" role="menu">
                            <li role="presentation"><a href="#" class="" title="Delete" data-fade-out-on-success="#reply-content-container-3" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/delete/3"><i class="fa fa-times"></i> Delete</a> </li>
                        </ul>
                    </span>
                                                </div>

                                                <p>Yesy</p>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="reply-form-container-2"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="post-content-container-1" class="post-content">
                        <div class="post clearfix">
                            <div class="post-date clearfix">
                                <span>Today</span>
                            </div>
                            <div class="media clearfix">

                                <div class="media-body">
                                    <div class="clearfix mb15">
                                        <div class="media-left ">
                            <span class="avatar avatar-sm">
                                <img src="http://me.publicservice.go.ug/assets/images/avatar.jpg" alt="..." class="mCS_img_loaded">
                            </span>
                                        </div>
                                        <div class="media-left ">
                                            <div class="mt5"><a href="http://me.publicservice.go.ug/index.php/team_members/view/1" class="dark strong">Mundua Patrick</a></div>
                                            <small><span class="text-off">Today at 12:17 pm</span></small>
                                        </div>

                                        <!--  only admin and creator can delete the post -->
                                        <span class="pull-right mt-50 dropdown">
                                <div class="text-off dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="true">
                                    <i class="fa fa-chevron-down clickable"></i>
                                </div>
                                <ul class="dropdown-menu" role="menu">
                                    <li role="presentation"><a href="#" class="" title="Delete" data-fade-out-on-success="#post-content-container-1" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/delete/1"><i class="fa fa-times"></i> Delete</a> </li>
                                </ul>
                            </span>

                                    </div>

                                    <p>
                                        Looks Great today                    </p>


                                    <div class="mb15 clearfix">
                                        <a href="#" data-real-target="#reply-form-container-1" class="dark" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/post_reply_form/1"><i class="fa fa-reply font-11"></i> Reply</a>                        <a href="#" class="hide" id="reload-reply-list-button-1" data-real-target="#reply-list-1" data-act="ajax-request" data-action-url="http://me.publicservice.go.ug/index.php/timeline/view_post_replies/1"></a>
                                    </div>
                                    <div id="reply-list-1"></div>
                                    <div id="reply-form-container-1"></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>        </div></div><div id="mCSB_4_scrollbar_vertical" class="mCSB_scrollTools mCSB_4_scrollbar mCS-minimal-dark mCSB_scrollTools_vertical mCSB_scrollTools_onDrag_expand" style="display: block;"><div class="mCSB_draggerContainer"><div id="mCSB_4_dragger_vertical" class="mCSB_dragger" style="position: absolute; min-height: 50px; height: 626px; top: 0px; display: block; max-height: 669px;"><div class="mCSB_dragger_bar" style="line-height: 50px;"></div></div><div class="mCSB_draggerRail"></div></div></div></div>
</div>