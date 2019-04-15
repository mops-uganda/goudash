<?php
session_start();
$opmDashSkin = "";

$user = Auth::user();
$username = $user->username;
$logo = 'logo';
if (isset($_COOKIE["opmDashSkin"])) {
    $_SESSION["opmDashSkin"] = "" . $_COOKIE["opmDashSkin"];
}
if (isset($_SESSION["opmDashSkin"])){
    $opmDashSkin = $_SESSION["opmDashSkin"];
    if ($opmDashSkin != 'smart-style-0') $logo = 'logo-white';
}

require ('lib/xcrud/xcrud.php');
$db = Xcrud_db::get_instance();
$db->query('SELECT `VoteName` FROM `votes` WHERE VoteCode = "' . $user->country_id .'"');
$VoteName = $db->row()["VoteName"];
$db->query('SELECT report_name, report_id, link FROM `reports_favourite` WHERE username = "' . $username . '"');
$list = $db->result();

?>
    <!DOCTYPE html>
<html lang="en-us" <?php echo implode(' ', array_map(function($prop, $value) {
    return $prop.'="'.$value.'"';
}, array_keys($page_html_prop), $page_html_prop)) ;?>>
    <head>
        <meta charset="utf-8">
        <!--<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">-->

        <title> <?php echo $page_title != "" ? $page_title." - " : ""; ?> Uganda Government Dashboard </title>
        <meta name="description" content="">
        <meta name="author" content="">

        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">

        <!-- Basic Styles -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/font-awesome.min.css">

        <!-- GOU Dashboard Styles : Caution! DO NOT change the order -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-production-plugins.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-production.min.css">
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-skins.min.css">

        <!-- GOU Dashboard RTL Support is under construction-->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/smartadmin-rtl.min.css">
        <link rel="prefetch" href="http://dash.go.ug/lib/xcrud/plugins/dash.min.js">


        <?php

        if ($page_css) {
            foreach ($page_css as $css) {
                echo '<link rel="stylesheet" type="text/css" media="screen" href="'.ASSETS_URL.'/css/'.$css.'">';
            }
        }
        ?>

        <!-- Demo purpose only: goes with demo.js, you can delete this css when designing your own WebApp -->
        <link rel="stylesheet" type="text/css" media="screen" href="<?php echo ASSETS_URL; ?>/css/demo.min.css">

        <!-- FAVICONS -->
        <link rel="shortcut icon" href="<?php echo ASSETS_URL; ?>/img/favicon/favicon.ico" type="image/x-icon">
        <link rel="icon" href="<?php echo ASSETS_URL; ?>/img/favicon/favicon.ico" type="image/x-icon">

        <!-- GOOGLE FONT -->
        <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,700italic,300,400,700">

        <!-- Specifying a Webpage Icon for Web Clip
             Ref: https://developer.apple.com/library/ios/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html -->
        <link rel="apple-touch-icon" href="<?php echo ASSETS_URL; ?>/img/splash/sptouch-icon-iphone.png">
        <link rel="apple-touch-icon" sizes="76x76" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-ipad.png">
        <link rel="apple-touch-icon" sizes="120x120" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-iphone-retina.png">
        <link rel="apple-touch-icon" sizes="152x152" href="<?php echo ASSETS_URL; ?>/img/splash/touch-icon-ipad-retina.png">

        <!-- iOS web-app metas : hides Safari UI Components and Changes Status Bar Appearance -->
        <meta name="apple-mobile-web-app-capable" content="yes">
        <meta name="apple-mobile-web-app-status-bar-style" content="black">

        <!-- Startup image for web apps -->
        <link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/ipad-landscape.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:landscape)">
        <link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/ipad-portrait.png" media="screen and (min-device-width: 481px) and (max-device-width: 1024px) and (orientation:portrait)">
        <link rel="apple-touch-startup-image" href="<?php echo ASSETS_URL; ?>/img/splash/iphone.png" media="screen and (max-device-width: 320px)">
        <script type="text/javascript">
            var search_page = function () {
                document.location.href='#X/search?q='+document.getElementById("search-fld").value;
            };

            window.onload=function(){
                var input = document.getElementById("search-fld");
                input.addEventListener("keyup", function(event) {
                    event.preventDefault();
                    if (event.keyCode === 13) {
                        search_page();
                    }
                });
            }

        </script>

    </head>
<body <?php echo implode(' ', array_map(function($prop, $value) {
    return $prop.'="'.$value.'"';
}, array_keys($page_body_prop), $page_body_prop)) ;?> class="<?php echo $opmDashSkin; ?>">
    <!-- POSSIBLE CLASSES: minified, fixed-ribbon, fixed-header, fixed-width
         You can also add different skin classes such as "smart-skin-1", "smart-skin-2" etc...-->
<?php
if (!$no_main_header) {

    ?>
    <!-- HEADER -->
    <header id="header">
        <div id="logo-group">

            <!-- PLACE YOUR LOGO HERE -->
            <span id="logo"> <img src="<?php echo ASSETS_URL . '/img/'. $logo . '.png' ?>" alt="GOU Dashboard"> </span>
            <!-- END LOGO PLACEHOLDER -->

            <!-- Note: The activity badge color changes when clicked and resets the number to 0
            Suggestion: You may want to set a flag when this happens to tick off all checked messages / notifications -->
            <span id="activity" class="activity-dropdown"> <i class="fa fa-external-link"></i></span>

            <!-- AJAX-DROPDOWN : control this dropdown height, look and feel from the LESS variable file -->
            <div class="ajax-dropdown">

                <!-- the ID links are fetched via AJAX to the ajax container "ajax-notifications" -->
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-default">
                        <input type="radio" name="activity" id="<?php echo APP_URL; ?>/X/actions_quick.php">
                        Actions </label>
                    <label class="btn btn-default">
                        <input type="radio" name="activity" id="<?php echo APP_URL; ?>/X/ptasks_quick.php">
                        Projects </label>
                    <label class="btn btn-default">
                        <input type="radio" name="activity" id="<?php echo APP_URL; ?>/X/reports_quick.php">
                        Reports </label>
                </div>

                <!-- notification content -->
                <div class="ajax-notifications custom-scroll">

                    <div class="alert alert-transparent">
                        <h4>Click a button to show messages here</h4>
                        This blank page message helps protect your privacy, or you can show the first message here automatically.
                    </div>

                    <i class="fa fa-lock fa-4x fa-border"></i>

                </div>
                <!-- end notification content -->

                <!-- footer: refresh area -->
                <span> Last updated on: 12/10/2018
								<button type="button" data-loading-text="<i class='fa fa-refresh fa-spin'></i> Loading..." class="btn btn-xs btn-default pull-right">
									<i class="fa fa-refresh"></i>
								</button> </span>
                <!-- end footer -->

            </div>
            <!-- END AJAX-DROPDOWN -->
        </div>

        <!-- projects dropdown -->
        <div class="project-context hidden-xs">
            <span class="label">Government Dashboard :: <span><?php echo "Vote - ".$user->country_id; ?>: <?php echo $VoteName; ?></span></span>
            <span id="project-selector" class="popover-trigger-element dropdown-toggle" data-toggle="dropdown">Favourite Reports/Screens <i class="fa fa-angle-down"></i></span>

            <!-- Suggestion: populate this list with fetch and push technique -->
            <ul class="dropdown-menu">
                <?php
                for ($count=0;$count<count($list);$count++){
                    ?>
                    <li><a href="#X/<?php echo $list[$count]["link"] ?>?id=<?php echo $list[$count]["report_id"] ?>"><i class="glyphicon glyphicon-new-window"></i> <?php echo $list[$count]["report_name"] ?></a></li>
                    <?php
                }
                ?>
                <li class="divider"></li>
                <li>
                    <a href="#X/myfavreports"><i class="fa fa-power-off"></i> My Favourite Reports</a>
                    <a href="#X/reports"><i class="fa fa-power-off"></i> All Reports</a>
                </li>
            </ul>
            <!-- end dropdown-menu-->
        </div>
        <!-- end projects dropdown -->

        <!-- pulled right: nav area -->

        <div class="pull-right">

            <!-- collapse menu button -->
            <div id="hide-menu" class="btn-header pull-right">
                <span> <a href="javascript:void(0);" title="Collapse Menu" data-action="toggleMenu"><i class="fa fa-reorder"></i></a> </span>
            </div>
            <!-- end collapse menu -->

            <!-- #MOBILE -->
            <!-- Top menu profile link : this shows only when top menu is active -->
            <ul id="mobile-profile-img" class="header-dropdown-list hidden-xs padding-5">
                <li class="">
                    <a href="#" class="dropdown-toggle no-margin userdropdown" data-toggle="dropdown">
                        <img src="<?php echo ASSETS_URL; ?>/securex/public/upload/users/<?php echo $user->avatar; ?>" alt="<?php echo $user->first_name; ?>" class="online" />
                    </a>
                    <ul class="dropdown-menu pull-right">
                        <li>
                            <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0"><i class="fa fa-cog"></i> Setting</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="securex/public" class="padding-10 padding-top-0 padding-bottom-0"> <i class="fa fa-user"></i> <u>P</u>rofile</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="toggleShortcut"><i class="fa fa-arrow-down"></i> <u>S</u>hortcut</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="javascript:void(0);" class="padding-10 padding-top-0 padding-bottom-0" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i> Full <u>S</u>creen</a>
                        </li>
                        <li class="divider"></li>
                        <li>
                            <a href="<?php echo APP_URL; ?>/securex/public/logout" class="padding-10 padding-top-5 padding-bottom-5" data-action="userLogout"><i class="fa fa-sign-out fa-lg"></i> <strong><u>L</u>ogout</strong></a>
                        </li>
                    </ul>
                </li>
            </ul>

            <!-- logout button -->
            <div id="logout" class="btn-header transparent pull-right">
                <span> <a href="<?php echo APP_URL; ?>/securex/public/logout" title="Sign Out" data-action="userLogout" data-logout-msg="You can improve your security further after logging out by closing this opened browser"><i class="fa fa-sign-out"></i></a> </span>
            </div>
            <!-- end logout button -->

            <!-- search mobile button (this is hidden till mobile view port) -->
            <div id="search-mobile" class="btn-header transparent pull-right">
                <span> <a href="javascript:void(0)" title="Search"><i class="fa fa-search"></i></a> </span>
            </div>
            <!-- end search mobile button -->

            <!-- input: search field -->
            <div class="header-search pull-right">
                <input type="text" name="q" placeholder="Find reports and more" id="search-fld" >
                <button onclick='search_page()'>
                    <i class="fa fa-search"></i>
                </button>
                <a href="javascript:void(0);" id="cancel-search-js" title="Cancel Search"><i class="fa fa-times"></i></a>
            </div>
            <!-- end input: search field -->
            <div id="refresh" class="btn-header transparent pull-right">
                <span> <a href="javascript:location.reload();" title="Refresh"><i class="fa fa-refresh"></i></a> </span>
            </div>
            <!-- fullscreen button -->
            <div id="fullscreen" class="btn-header transparent pull-right">
                <span> <a href="javascript:void(0);" title="Full Screen" data-action="launchFullscreen"><i class="fa fa-arrows-alt"></i></a> </span>
            </div>
            <!-- end fullscreen button -->

            <!-- #Voice Command: Start Speech -->
            <div id="speech-btn" class="btn-header transparent pull-right hidden-sm hidden-xs">
                <div>
                    <a href="javascript:void(0)" title="Voice Command" data-action="voiceCommand"><i class="fa fa-microphone"></i></a>
                    <div class="popover bottom"><div class="arrow"></div>
                        <div class="popover-content">
                            <h4 class="vc-title">Voice command activated <br><small>Please speak clearly into the mic</small></h4>
                            <h4 class="vc-title-error text-center">
                                <i class="fa fa-microphone-slash"></i> Voice command failed
                                <br><small class="txt-color-red">Must <strong>"Allow"</strong> Microphone</small>
                                <br><small class="txt-color-red">Must have <strong>Internet Connection</strong></small>
                            </h4>
                            <a href="javascript:void(0);" class="btn btn-success" onclick="commands.help()">See Commands</a>
                            <a href="javascript:void(0);" class="btn bg-color-purple txt-color-white" onclick="$('#speech-btn .popover').fadeOut(50);">Close Popup</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end voice command -->

            <!-- Financial Years dropdown  -->
            <ul class="header-dropdown-list hidden-xs">
                <li>
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-anchor"></i> <span> Financial Year 2016/2017 </span> <i class="fa fa-angle-down"></i> </a>
                    <ul class="dropdown-menu pull-right">
                        <?php
                        $db->query('SELECT FinancialYear FROM `financialyear`');
                        $list = $db->result();
                        for ($count=0;$count<count($list);$count++){
                            ?>
                            <li><a href="#" onclick='window.location = "#X/dashboard.php?FY=<?php echo $list[$count]["FinancialYear"] ?>"' class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-anchor"></i> <span> <?php echo "  " . $list[$count]["FinancialYear"] ?> </span> </a></li>
                            <?php
                        }
                        ?>


                    </ul>
                </li>
            </ul>
            <!-- end Financial Years  -->

        </div>
        <!-- end pulled right: nav area -->

    </header>
    <!-- END HEADER -->

    <!-- SHORTCUT AREA : With large tiles (activated via clicking user name tag)
    Note: These tiles are completely responsive,
    you can add as many as you like
    -->
    <div id="shortcut">
        <ul>
            <li>
                <a href="#X/inbox.php" class="jarvismetro-tile big-cubes bg-color-blue"> <span class="iconbox"> <i class="fa fa-envelope fa-4x"></i> <span>Mail <span class="label pull-right bg-color-darken">14</span></span> </span> </a>
            </li>
            <li>
                <a href="#X/calendar.php" class="jarvismetro-tile big-cubes bg-color-orangeDark"> <span class="iconbox"> <i class="fa fa-calendar fa-4x"></i> <span>Calendar</span> </span> </a>
            </li>
            <li>
                <a href="securex/public" class="jarvismetro-tile big-cubes selected bg-color-pinkDark"> <span class="iconbox"> <i class="fa fa-user fa-4x"></i> <span>My Profile </span> </span> </a>
            </li>
        </ul>
    </div>
    <!-- END SHORTCUT AREA -->

    <?php
}
?>