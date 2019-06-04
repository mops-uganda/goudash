<?php
require_once '../securex/extra/auth.php';
$returnURL = 'X/dashboard';
if (! Auth::check()) {
    redirectTo('securex/public/login?to=' . $returnURL);
    exit();
}
app(\Vanguard\Services\Logging\UserActivity\Logger::class)->log($returnURL);
$user = Auth::user();
$username = $user->username;

include 'hr_dashboard_table.php';
?>

<!-- /*  Dashboard */ -->
<style>
    /*!
 =========================================================
 * Material Dashboard - v1.1.1
 =========================================================
 * Product Page: http://www.creative-tim.com/product/material-dashboard
 * Copyright 2017 Creative Tim (http://www.creative-tim.com)
 * Licensed under MIT (https://github.com/creativetimofficial/material-dashboard/blob/master/LICENSE.md)
 =========================================================
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 */
    /* ANIMATION */
    /* SHADOWS */
    /* Shadows (from mdl http://www.getmdl.io/) */


    .noUi-stacking .noUi-handle {
        z-index: 10; }

    .noUi-state-tap .noUi-origin {
        transition: left 0.3s, top 0.3s; }

    .noUi-state-drag * {
        cursor: inherit !important; }


    .noUi-vertical .noUi-handle {
        margin-left: 5px;
        cursor: ns-resize; }

    .noUi-horizontal.noUi-extended .noUi-origin {
        right: -15px; }

    .noUi-origin[style^="left: 0"] .noUi-handle {
        background-color: #fff;
        border: 2px solid #c8c8c8; }
    .noUi-origin[style^="left: 0"] .noUi-handle.noUi-active {
        border-width: 1px; }


    [disabled].noUi-slider {
        opacity: 0.5; }

    [disabled] .noUi-handle {
        cursor: not-allowed; }

    .slider .noUi-handle {
        border-color: #532e7d; }
    .slider.slider-info .noUi-connect, .slider.slider-info.noUi-connect {
        background-color: #299cb6; }
    .slider.slider-info .noUi-handle {
        border-color: #299cb6; }
    .slider.slider-success .noUi-connect, .slider.slider-success.noUi-connect {
        background-color: #4e885e; }
    .slider.slider-success .noUi-handle {
        border-color: #4e885e; }
    .slider.slider-warning .noUi-connect, .slider.slider-warning.noUi-connect {
        background-color: #cb7826; }
    .slider.slider-warning .noUi-handle {
        border-color: #cb7826; }
    .slider.slider-danger .noUi-connect, .slider.slider-danger.noUi-connect {
        background-color: #f44336; }
    .slider.slider-danger .noUi-handle {
        border-color: #f44336; }

    @-webkit-keyframes shake {
        from, to {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0); }

        10%, 30%, 50%, 70%, 90% {
            -webkit-transform: translate3d(-10px, 0, 0);
            transform: translate3d(-10px, 0, 0); }

        20%, 40%, 60%, 80% {
            -webkit-transform: translate3d(10px, 0, 0);
            transform: translate3d(10px, 0, 0); } }

    @keyframes shake {
        from, to {
            -webkit-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0); }

        10%, 30%, 50%, 70%, 90% {
            -webkit-transform: translate3d(-10px, 0, 0);
            transform: translate3d(-10px, 0, 0); }

        20%, 40%, 60%, 80% {
            -webkit-transform: translate3d(10px, 0, 0);
            transform: translate3d(10px, 0, 0); } }


    @-webkit-keyframes fadeInDown {
        from {
            opacity: 0;
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0); }

        to {
            opacity: 1;
            -webkit-transform: none;
            transform: none; } }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0); }

        to {
            opacity: 1;
            -webkit-transform: none;
            transform: none; } }

    @-webkit-keyframes fadeOut {
        from {
            opacity: 1; }

        to {
            opacity: 0; } }

    @keyframes fadeOut {
        from {
            opacity: 1; }

        to {
            opacity: 0; } }


    @-webkit-keyframes fadeOutDown {
        from {
            opacity: 1; }

        to {
            opacity: 0;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0); } }

    @keyframes fadeOutDown {
        from {
            opacity: 1; }

        to {
            opacity: 0;
            -webkit-transform: translate3d(0, 100%, 0);
            transform: translate3d(0, 100%, 0); } }


    @-webkit-keyframes fadeOutUp {
        from {
            opacity: 1; }

        to {
            opacity: 0;
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0); } }

    @keyframes fadeOutUp {
        from {
            opacity: 1; }

        to {
            opacity: 0;
            -webkit-transform: translate3d(0, -100%, 0);
            transform: translate3d(0, -100%, 0); } }

    /*.title,
 .card-title,
 .info-title,
 .footer-brand,
 .footer-big h5,
 .footer-big h4,
 .media .media-heading{
 font-weight: $font-weight-extra-bold;
 font-family: $font-family-serif;
 &,
 a{
 color: $black-color;
 text-decoration: none;
 }
 }*/
    h2.title {
        margin-bottom: 30px; }




    blockquote p {
        font-style: italic; }

    a {
        color: #532e7d; }
    a:hover, a:focus {
        color: #47276a;
        text-decoration: none; }
    a.text-info:hover, a.text-info:focus {
        color: #248aa1; }
    a .material-icons {
        vertical-align: middle; }


    *:focus {
        outline: 0; }

    a:focus, a:active, button:active, button:focus, button:hover, button::-moz-focus-inner, input[type="reset"]::-moz-focus-inner, input[type="button"]::-moz-focus-inner, input[type="submit"]::-moz-focus-inner, select::-moz-focus-inner, input[type="file"] > input[type="button"]::-moz-focus-inner {
        outline: 0 !important; }

    output {
        padding-top: 8px;
        font-size: 14px;
        line-height: 1.42857; }



    .alert {
        border: 0;
        border-radius: 0;
        position: relative;
        padding: 20px 15px;
        line-height: 20px; }
    .alert b {
        font-weight: 500;
        text-transform: uppercase;
        font-size: 12px; }
    .alert, .alert.alert-default {
        background-color: #fff;
        color: #55397f;
        border-radius: 3px;
        box-shadow: 0 12px 20px -10px rgba(255, 255, 255, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(255, 255, 255, 0.2); }
    .alert a, .alert.alert-default a, .alert .alert-link, .alert.alert-default .alert-link {
        color: #55397f; }
    .alert.alert-inverse {
        background-color: #2e2e2e;
        color: #fff;
        border-radius: 3px;
        box-shadow: 0 12px 20px -10px rgba(33, 33, 33, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(33, 33, 33, 0.2); }
    .alert.alert-inverse a, .alert.alert-inverse .alert-link {
        color: #fff; }
    .alert.alert-primary {
        background-color: #5f3590;
        color: #fff;
        border-radius: 3px;
        box-shadow: 0 12px 20px -10px rgba(83, 46, 125, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(83, 46, 125, 0.2); }
    .alert.alert-primary a, .alert.alert-primary .alert-link {
        color: #fff; }
    .alert.alert-success {
        background-color: #579869;
        color: #fff;
        border-radius: 3px;
        box-shadow: 0 12px 20px -10px rgba(78, 136, 94, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(78, 136, 94, 0.2); }
    .alert.alert-success a, .alert.alert-success .alert-link {
        color: #fff; }
    .alert.alert-info {
        background-color: #2eaecb;
        color: #fff;
        border-radius: 3px;
        box-shadow: 0 12px 20px -10px rgba(41, 156, 182, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(41, 156, 182, 0.2); }
    .alert.alert-info a, .alert.alert-info .alert-link {
        color: #fff; }
    .alert.alert-warning {
        background-color: #d98532;
        color: #fff;
        border-radius: 3px;
        box-shadow: 0 12px 20px -10px rgba(203, 120, 38, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(203, 120, 38, 0.2); }
    .alert.alert-warning a, .alert.alert-warning .alert-link {
        color: #fff; }
    .alert.alert-danger {
        background-color: #f55a4e;
        color: #fff;
        border-radius: 3px;
        box-shadow: 0 12px 20px -10px rgba(244, 67, 54, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(244, 67, 54, 0.2); }
    .alert.alert-danger a, .alert.alert-danger .alert-link {
        color: #fff; }
    .alert.alert-rose {
        background-color: #eb3573;
        color: #fff;
        border-radius: 3px;
        box-shadow: 0 12px 20px -10px rgba(233, 30, 99, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(233, 30, 99, 0.2); }
    .alert.alert-rose a, .alert.alert-rose .alert-link {
        color: #fff; }
    .alert-info, .alert-danger, .alert-warning, .alert-success {
        color: #fff; }
    .alert-default a, .alert-default .alert-link {
        color: rgba(0,0,0, 0.87); }
    .alert i[data-notify="icon"] {
        font-size: 30px;
        display: block;
        left: 15px;
        position: absolute;
        top: 50%;
        margin-top: -15px; }
    .alert span {
        display: block;
        max-width: 89%; }
    .alert .alert-icon {
        display: block;
        float: left;
        margin-right: 15px; }
    .alert .alert-icon i {
        margin-top: -7px;
        top: 5px;
        position: relative; }

    .alert.alert-with-icon {
        padding-left: 65px; }


    .section-dark .nav-pills > li > a, .section-image .nav-pills > li > a {
        color: #999; }
    .section-dark .nav-pills > li > a:hover, .section-image .nav-pills > li > a:hover, .section-dark .nav-pills > li > a:focus, .section-image .nav-pills > li > a:focus {
        background-color: #eee; }
    .nav-pills > li > a {
        line-height: 24px;
        text-transform: uppercase;
        font-size: 12px;
        font-weight: 500;
        min-width: 100px;
        text-align: center;
        color: #55397f;
        transition: all 0.3s; }

    .modal-content .modal-header {
        border-bottom: none;
        padding-top: 10px;
        padding-right: 24px;
        padding-bottom: 0;
        padding-left: 24px; }
    .modal-content .modal-body {
        padding-top: 24px;
        padding-right: 24px;
        padding-bottom: 16px;
        padding-left: 24px; }
    .modal-content .modal-footer {
        border-top: none;
        padding: 7px; }
    .modal-content .modal-footer.text-center {
        text-align: center; }
    .modal-content .modal-footer button {
        margin: 0;
        padding-left: 16px;
        padding-right: 16px;
        width: auto; }
    .modal-content .modal-footer button.pull-left {
        padding-left: 5px;
        padding-right: 5px;
        position: relative;
        left: -5px; }
    .modal-content .modal-footer button + button {
        margin-bottom: 16px; }
    .modal-content .modal-body + .modal-footer {
        padding-top: 0; }

    .modal .modal-dialog {
        margin-top: 100px; }
    .modal .modal-header .close {
        color: #878787; }
    .modal .modal-header .close:hover, .modal .modal-header .close:focus {
        opacity: 1; }
    .modal .modal-header .close i {
        font-size: 16px; }

    .modal-notice .instruction {
        margin-bottom: 25px; }
    .modal-notice .picture {
        max-width: 150px; }
    .modal-notice .modal-content .btn-raised {
        margin-bottom: 15px; }

    .modal-small .modal-body {
        margin-top: 20px; }

    .navbar .navbar-brand {
        position: relative;
        height: 50px;
        line-height: 30px;
        color: inherit;
        padding: 10px 15px; }
    .navbar .navbar-brand:hover, .navbar .navbar-brand:focus {
        color: inherit;
        background-color: transparent; }
    .navbar .notification {
        position: absolute;
        top: 5px;
        border: 1px solid #fff;
        right: 10px;
        font-size: 9px;
        background: #f44336;
        color: #fff;
        min-width: 20px;
        padding: 0px 5px;
        height: 20px;
        border-radius: 10px;
        text-align: center;
        line-height: 19px;
        vertical-align: middle;
        display: block; }
    .navbar .navbar-text {
        color: inherit;
        margin-top: 15px;
        margin-bottom: 15px; }
    .navbar .navbar-nav > li > a {
        color: inherit;
        padding-top: 15px;
        padding-bottom: 15px;
        font-weight: 400;
        font-size: 12px;
        text-transform: uppercase;
        border-radius: 3px; }
    .navbar .navbar-nav > li > a:hover, .navbar .navbar-nav > li > a:focus {
        color: inherit;
        background-color: transparent; }
    .navbar .navbar-nav > li > a .material-icons, .navbar .navbar-nav > li > a .fa {
        font-size: 20px; }
    .navbar .navbar-nav > li > a.btn:not(.btn-just-icon) .fa {
        position: relative;
        top: 2px;
        margin-top: -4px;
        margin-right: 4px; }
    .navbar .navbar-nav > li > .dropdown-menu {
        margin-top: -20px; }
    .navbar .navbar-nav > li.open > .dropdown-menu {
        margin-top: 0; }
    .navbar .navbar-nav > .active > a, .navbar .navbar-nav > .active > a:hover, .navbar .navbar-nav > .active > a:focus {
        color: inherit;
        background-color: rgba(255, 255, 255, 0.1); }
    .navbar .navbar-nav > .disabled > a, .navbar .navbar-nav > .disabled > a:hover, .navbar .navbar-nav > .disabled > a:focus {
        color: inherit;
        background-color: transparent;
        opacity: 0.9; }
    .navbar .navbar-nav .profile-photo {
        padding: 0 5px 0; }
    .navbar .navbar-nav .profile-photo .profile-photo-small {
        height: 40px;
        width: 40px; }
    .navbar .navbar-toggle {
        border: 0; }
    .navbar .navbar-toggle:hover, .navbar .navbar-toggle:focus {
        background-color: transparent; }
    .navbar .navbar-toggle .icon-bar {
        background-color: inherit;
        border: 1px solid; }
    .navbar .navbar-default .navbar-toggle, .navbar .navbar-inverse .navbar-toggle {
        border-color: transparent; }
    .navbar .navbar-collapse, .navbar .navbar-form {
        border-top: none;
        box-shadow: none; }
    .navbar .navbar-nav > .open > a, .navbar .navbar-nav > .open > a:hover, .navbar .navbar-nav > .open > a:focus {
        background-color: transparent;
        color: inherit; }
    @media (max-width: 767px) {
        .navbar .navbar-nav .navbar-text {
            color: inherit;
            margin-top: 15px;
            margin-bottom: 15px; }

        .navbar .navbar-nav .open .dropdown-menu > .dropdown-header {
            border: 0;
            color: inherit; }
        .navbar .navbar-nav .open .dropdown-menu .divider {
            border-bottom: 1px solid;
            opacity: 0.08; }
        .navbar .navbar-nav .open .dropdown-menu > li > a {
            color: inherit; }
        .navbar .navbar-nav .open .dropdown-menu > li > a:hover, .navbar .navbar-nav .open .dropdown-menu > li > a:focus {
            color: inherit;
            background-color: transparent; }
        .navbar .navbar-nav .open .dropdown-menu > .active > a, .navbar .navbar-nav .open .dropdown-menu > .active > a:hover, .navbar .navbar-nav .open .dropdown-menu > .active > a:focus {
            color: inherit;
            background-color: transparent; }
        .navbar .navbar-nav .open .dropdown-menu > .disabled > a, .navbar .navbar-nav .open .dropdown-menu > .disabled > a:hover, .navbar .navbar-nav .open .dropdown-menu > .disabled > a:focus {
            color: inherit;
            background-color: transparent; } }
    .navbar.navbar-default .logo-container .brand {
        color: #55397f; }
    .navbar .navbar-link {
        color: inherit; }
    .navbar .navbar-link:hover {
        color: inherit; }
    .navbar .btn {
        margin-top: 0;
        margin-bottom: 0; }
    .navbar .btn-link {
        color: inherit; }
    .navbar .btn-link:hover, .navbar .btn-link:focus {
        color: inherit; }
    .navbar .btn-link[disabled]:hover, fieldset[disabled] .navbar .btn-link:hover, .navbar .btn-link[disabled]:focus, fieldset[disabled] .navbar .btn-link:focus {
        color: inherit; }
    .navbar .navbar-form {
        margin: 4px 0 0; }
    .navbar .navbar-form .form-group {
        margin: 0;
        padding: 0; }
    .navbar .navbar-form .form-group .material-input:before, .navbar .navbar-form .form-group.is-focused .material-input:after {
        background-color: inherit; }
    .navbar .navbar-form .form-group .form-control, .navbar .navbar-form .form-control {
        border-color: inherit;
        color: inherit;
        padding: 0;
        margin: 0;
        height: 28px;
        font-size: 14px;
        line-height: 1.42857; }
    .navbar, .navbar.navbar-default {
        background-color: #fff;
        color: #55397f; }
    .navbar .navbar-form .form-group input.form-control::-moz-placeholder, .navbar.navbar-default .navbar-form .form-group input.form-control::-moz-placeholder, .navbar .navbar-form input.form-control::-moz-placeholder, .navbar.navbar-default .navbar-form input.form-control::-moz-placeholder {
        color: #55397f; }
    .navbar .navbar-form .form-group input.form-control:-ms-input-placeholder, .navbar.navbar-default .navbar-form .form-group input.form-control:-ms-input-placeholder, .navbar .navbar-form input.form-control:-ms-input-placeholder, .navbar.navbar-default .navbar-form input.form-control:-ms-input-placeholder {
        color: #55397f; }
    .navbar .navbar-form .form-group input.form-control::-webkit-input-placeholder, .navbar.navbar-default .navbar-form .form-group input.form-control::-webkit-input-placeholder, .navbar .navbar-form input.form-control::-webkit-input-placeholder, .navbar.navbar-default .navbar-form input.form-control::-webkit-input-placeholder {
        color: #55397f; }
    .navbar .dropdown-menu, .navbar.navbar-default .dropdown-menu {
        border-radius: 3px !important; }
    .navbar .dropdown-menu li > a:hover, .navbar.navbar-default .dropdown-menu li > a:hover, .navbar .dropdown-menu li > a:focus, .navbar.navbar-default .dropdown-menu li > a:focus {
        color: #fff;
        background-color: #fff;
        box-shadow: 0 12px 20px -10px rgba(255, 255, 255, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(255, 255, 255, 0.2); }
    .navbar .dropdown-menu .active > a, .navbar.navbar-default .dropdown-menu .active > a {
        background-color: #fff;
        color: #55397f;
        box-shadow: 0 12px 20px -10px rgba(255, 255, 255, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(255, 255, 255, 0.2); }
    .navbar .dropdown-menu .active > a:hover, .navbar.navbar-default .dropdown-menu .active > a:hover, .navbar .dropdown-menu .active > a:focus, .navbar.navbar-default .dropdown-menu .active > a:focus {
        color: #55397f; }
    .navbar.navbar-inverse {
        background-color: #212121;
        color: #fff; }
    .navbar.navbar-inverse .navbar-form .form-group input.form-control::-moz-placeholder, .navbar.navbar-inverse .navbar-form input.form-control::-moz-placeholder {
        color: #fff; }
    .navbar.navbar-inverse .navbar-form .form-group input.form-control:-ms-input-placeholder, .navbar.navbar-inverse .navbar-form input.form-control:-ms-input-placeholder {
        color: #fff; }
    .navbar.navbar-inverse .navbar-form .form-group input.form-control::-webkit-input-placeholder, .navbar.navbar-inverse .navbar-form input.form-control::-webkit-input-placeholder {
        color: #fff; }
    .navbar.navbar-inverse .dropdown-menu {
        border-radius: 3px !important; }
    .navbar.navbar-inverse .dropdown-menu li > a:hover, .navbar.navbar-inverse .dropdown-menu li > a:focus {
        color: #fff;
        background-color: #212121;
        box-shadow: 0 12px 20px -10px rgba(33, 33, 33, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(33, 33, 33, 0.2); }
    .navbar.navbar-inverse .dropdown-menu .active > a {
        background-color: #212121;
        color: #fff;
        box-shadow: 0 12px 20px -10px rgba(33, 33, 33, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(33, 33, 33, 0.2); }
    .navbar.navbar-inverse .dropdown-menu .active > a:hover, .navbar.navbar-inverse .dropdown-menu .active > a:focus {
        color: #fff; }
    .navbar.navbar-primary {
        background-color: #532e7d;
        color: #fff; }
    .navbar.navbar-primary .navbar-form .form-group input.form-control::-moz-placeholder, .navbar.navbar-primary .navbar-form input.form-control::-moz-placeholder {
        color: #fff; }
    .navbar.navbar-primary .navbar-form .form-group input.form-control:-ms-input-placeholder, .navbar.navbar-primary .navbar-form input.form-control:-ms-input-placeholder {
        color: #fff; }
    .navbar.navbar-primary .navbar-form .form-group input.form-control::-webkit-input-placeholder, .navbar.navbar-primary .navbar-form input.form-control::-webkit-input-placeholder {
        color: #fff; }
    .navbar.navbar-primary .dropdown-menu {
        border-radius: 3px !important; }
    .navbar.navbar-primary .dropdown-menu li > a:hover, .navbar.navbar-primary .dropdown-menu li > a:focus {
        color: #fff;
        background-color: #532e7d;
        box-shadow: 0 12px 20px -10px rgba(83, 46, 125, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(83, 46, 125, 0.2); }
    .navbar.navbar-primary .dropdown-menu .active > a {
        background-color: #532e7d;
        color: #fff;
        box-shadow: 0 12px 20px -10px rgba(83, 46, 125, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(83, 46, 125, 0.2); }
    .navbar.navbar-primary .dropdown-menu .active > a:hover, .navbar.navbar-primary .dropdown-menu .active > a:focus {
        color: #fff; }
    .navbar.navbar-success {
        background-color: #4e885e;
        color: #fff; }
    .navbar.navbar-success .navbar-form .form-group input.form-control::-moz-placeholder, .navbar.navbar-success .navbar-form input.form-control::-moz-placeholder {
        color: #fff; }
    .navbar.navbar-success .navbar-form .form-group input.form-control:-ms-input-placeholder, .navbar.navbar-success .navbar-form input.form-control:-ms-input-placeholder {
        color: #fff; }
    .navbar.navbar-success .navbar-form .form-group input.form-control::-webkit-input-placeholder, .navbar.navbar-success .navbar-form input.form-control::-webkit-input-placeholder {
        color: #fff; }
    .navbar.navbar-success .dropdown-menu {
        border-radius: 3px !important; }
    .navbar.navbar-success .dropdown-menu li > a:hover, .navbar.navbar-success .dropdown-menu li > a:focus {
        color: #fff;
        background-color: #4e885e;
        box-shadow: 0 12px 20px -10px rgba(78, 136, 94, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(78, 136, 94, 0.2); }
    .navbar.navbar-success .dropdown-menu .active > a {
        background-color: #4e885e;
        color: #fff;
        box-shadow: 0 12px 20px -10px rgba(78, 136, 94, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(78, 136, 94, 0.2); }
    .navbar.navbar-success .dropdown-menu .active > a:hover, .navbar.navbar-success .dropdown-menu .active > a:focus {
        color: #fff; }
    .navbar.navbar-info {
        background-color: #299cb6;
        color: #fff; }
    .navbar.navbar-info .navbar-form .form-group input.form-control::-moz-placeholder, .navbar.navbar-info .navbar-form input.form-control::-moz-placeholder {
        color: #fff; }
    .navbar.navbar-info .navbar-form .form-group input.form-control:-ms-input-placeholder, .navbar.navbar-info .navbar-form input.form-control:-ms-input-placeholder {
        color: #fff; }
    .navbar.navbar-info .navbar-form .form-group input.form-control::-webkit-input-placeholder, .navbar.navbar-info .navbar-form input.form-control::-webkit-input-placeholder {
        color: #fff; }
    .navbar.navbar-info .dropdown-menu {
        border-radius: 3px !important; }
    .navbar.navbar-info .dropdown-menu li > a:hover, .navbar.navbar-info .dropdown-menu li > a:focus {
        color: #fff;
        background-color: #299cb6;
        box-shadow: 0 12px 20px -10px rgba(41, 156, 182, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(41, 156, 182, 0.2); }
    .navbar.navbar-info .dropdown-menu .active > a {
        background-color: #299cb6;
        color: #fff;
        box-shadow: 0 12px 20px -10px rgba(41, 156, 182, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(41, 156, 182, 0.2); }
    .navbar.navbar-info .dropdown-menu .active > a:hover, .navbar.navbar-info .dropdown-menu .active > a:focus {
        color: #fff; }
    .navbar.navbar-warning {
        background-color: #cb7826;
        color: #fff; }
    .navbar.navbar-warning .navbar-form .form-group input.form-control::-moz-placeholder, .navbar.navbar-warning .navbar-form input.form-control::-moz-placeholder {
        color: #fff; }
    .navbar.navbar-warning .navbar-form .form-group input.form-control:-ms-input-placeholder, .navbar.navbar-warning .navbar-form input.form-control:-ms-input-placeholder {
        color: #fff; }
    .navbar.navbar-warning .navbar-form .form-group input.form-control::-webkit-input-placeholder, .navbar.navbar-warning .navbar-form input.form-control::-webkit-input-placeholder {
        color: #fff; }
    .navbar.navbar-warning .dropdown-menu {
        border-radius: 3px !important; }
    .navbar.navbar-warning .dropdown-menu li > a:hover, .navbar.navbar-warning .dropdown-menu li > a:focus {
        color: #fff;
        background-color: #cb7826;
        box-shadow: 0 12px 20px -10px rgba(203, 120, 38, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(203, 120, 38, 0.2); }
    .navbar.navbar-warning .dropdown-menu .active > a {
        background-color: #cb7826;
        color: #fff;
        box-shadow: 0 12px 20px -10px rgba(203, 120, 38, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(203, 120, 38, 0.2); }
    .navbar.navbar-warning .dropdown-menu .active > a:hover, .navbar.navbar-warning .dropdown-menu .active > a:focus {
        color: #fff; }
    .navbar.navbar-danger {
        background-color: #f44336;
        color: #fff; }
    .navbar.navbar-danger .navbar-form .form-group input.form-control::-moz-placeholder, .navbar.navbar-danger .navbar-form input.form-control::-moz-placeholder {
        color: #fff; }
    .navbar.navbar-danger .navbar-form .form-group input.form-control:-ms-input-placeholder, .navbar.navbar-danger .navbar-form input.form-control:-ms-input-placeholder {
        color: #fff; }
    .navbar.navbar-danger .navbar-form .form-group input.form-control::-webkit-input-placeholder, .navbar.navbar-danger .navbar-form input.form-control::-webkit-input-placeholder {
        color: #fff; }
    .navbar.navbar-danger .dropdown-menu {
        border-radius: 3px !important; }
    .navbar.navbar-danger .dropdown-menu li > a:hover, .navbar.navbar-danger .dropdown-menu li > a:focus {
        color: #fff;
        background-color: #f44336;
        box-shadow: 0 12px 20px -10px rgba(244, 67, 54, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(244, 67, 54, 0.2); }
    .navbar.navbar-danger .dropdown-menu .active > a {
        background-color: #f44336;
        color: #fff;
        box-shadow: 0 12px 20px -10px rgba(244, 67, 54, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(244, 67, 54, 0.2); }
    .navbar.navbar-danger .dropdown-menu .active > a:hover, .navbar.navbar-danger .dropdown-menu .active > a:focus {
        color: #fff; }
    .navbar.navbar-rose {
        background-color: #e91e63;
        color: #fff; }
    .navbar.navbar-rose .navbar-form .form-group input.form-control::-moz-placeholder, .navbar.navbar-rose .navbar-form input.form-control::-moz-placeholder {
        color: #fff; }
    .navbar.navbar-rose .navbar-form .form-group input.form-control:-ms-input-placeholder, .navbar.navbar-rose .navbar-form input.form-control:-ms-input-placeholder {
        color: #fff; }
    .navbar.navbar-rose .navbar-form .form-group input.form-control::-webkit-input-placeholder, .navbar.navbar-rose .navbar-form input.form-control::-webkit-input-placeholder {
        color: #fff; }
    .navbar.navbar-rose .dropdown-menu {
        border-radius: 3px !important; }
    .navbar.navbar-rose .dropdown-menu li > a:hover, .navbar.navbar-rose .dropdown-menu li > a:focus {
        color: #fff;
        background-color: #e91e63;
        box-shadow: 0 12px 20px -10px rgba(233, 30, 99, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(233, 30, 99, 0.2); }
    .navbar.navbar-rose .dropdown-menu .active > a {
        background-color: #e91e63;
        color: #fff;
        box-shadow: 0 12px 20px -10px rgba(233, 30, 99, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(233, 30, 99, 0.2); }
    .navbar.navbar-rose .dropdown-menu .active > a:hover, .navbar.navbar-rose .dropdown-menu .active > a:focus {
        color: #fff; }

    .navbar.navbar-transparent .logo-container .brand {
        color: #fff; }

    @media (max-width: 1199px) {
        .navbar {
            /*
     .navbar-form {
     margin-top: 10px;
     }
     */ }
        .navbar .navbar-brand {
            height: 50px;
            padding: 10px 15px; }

        .navbar .navbar-nav > li > a {
            padding-top: 15px;
            padding-bottom: 15px; } }
    .navbar .alert {
        border-radius: 0;
        left: 0;
        position: absolute;
        right: 0;
        top: 85px;
        width: 100%;
        z-index: 3;
        transition: all 0.3s; }

    .nav-align-center .nav-pills {
        display: inline-block; }

    .popover.left > .arrow, .popover.right > .arrow, .popover.top > .arrow, .popover.bottom > .arrow {
        border: none; }

    .tooltip.left .tooltip-arrow {
        border-left-color: #fff; }
    .tooltip.right .tooltip-arrow {
        border-right-color: #fff; }
    .tooltip.top .tooltip-arrow {
        border-top-color: #fff; }
    .tooltip.bottom .tooltip-arrow {
        border-bottom-color: #fff; }


    footer {
        padding: 15px 0; }
    footer ul {
        margin-bottom: 0;
        padding: 0;
        list-style: none; }
    footer ul li {
        display: inline-block; }
    footer ul li a {
        color: inherit;
        padding: 15px;
        font-weight: 500;
        font-size: 12px;
        text-transform: uppercase;
        border-radius: 3px;
        text-decoration: none;
        position: relative;
        display: block; }
    footer ul li a:hover {
        text-decoration: none; }
    footer .copyright {
        padding: 15px 0;
        margin: 0; }
    footer .copyright .material-icons {
        font-size: 18px;
        position: relative;
        top: 3px; }
    footer .btn {
        margin-top: 0;
        margin-bottom: 0; }

    .dropdown-menu {
        border: 0;
        box-shadow: 0 2px 5px 0 rgba(0, 0, 0, 0.26); }
    .dropdown-menu .divider {
        background-color: rgba(0, 0, 0, .12); }
    .dropdown-menu li > a {
        font-size: 13px;
        padding: 10px 20px;
        margin: 0 5px;
        border-radius: 2px;
        -webkit-transition: all 150ms linear;
        -moz-transition: all 150ms linear;
        -o-transition: all 150ms linear;
        -ms-transition: all 150ms linear;
        transition: all 150ms linear; }
    .dropdown-menu li > a:hover, .dropdown-menu li > a:focus {
        box-shadow: 0 8px 10px 1px rgba(0, 0, 0, 0.14), 0 3px 14px 2px rgba(0, 0, 0, 0.12), 0 5px 5px -3px rgba(0, 0, 0, 0.2); }
    .dropdown-menu.dropdown-with-icons li > a {
        padding: 12px 20px 12px 12px; }
    .dropdown-menu.dropdown-with-icons li > a .material-icons {
        vertical-align: middle;
        font-size: 24px;
        position: relative;
        margin-top: -4px;
        top: 1px;
        margin-right: 12px;
        opacity: 0.5; }
    .dropdown-menu li {
        position: relative; }
    .dropdown-menu li a:hover, .dropdown-menu li a:focus, .dropdown-menu li a:active {
        background-color: #532e7d;
        color: #fff; }
    .dropdown-menu .divider {
        margin: 5px 0; }
    .navbar .dropdown-menu li a:hover, .navbar.navbar-default .dropdown-menu li a:hover, .navbar .dropdown-menu li a:focus, .navbar.navbar-default .dropdown-menu li a:focus, .navbar .dropdown-menu li a:active, .navbar.navbar-default .dropdown-menu li a:active {
        background-color: #532e7d;
        color: #fff;
        box-shadow: 0 12px 20px -10px rgba(83, 46, 125, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(83, 46, 125, 0.2); }

    .card {
        display: inline-block;
        position: relative;
        width: 100%;
        margin: 18px 0;
        box-shadow: 0 1px 4px 0 rgba(0, 0, 0, 0.14);
        border-radius: 3px;
        color: rgba(0,0,0, 0.87);
        background: #fff; }
    .card .card-height-indicator {
        margin-top: 100%; }
    .card .title {
        margin-top: 0;
        margin-bottom: 5px; }
    .card .card-image {
        height: 60%;
        position: relative;
        overflow: hidden;
        margin-left: 15px;
        margin-right: 15px;
        margin-top: -30px;
        border-radius: 6px; }
    .card .card-image img {
        width: 100%;
        height: 100%;
        border-radius: 6px;
        pointer-events: none; }
    .card .card-image .card-title {
        position: absolute;
        bottom: 15px;
        left: 15px;
        color: #fff;
        font-size: 1.3em;
        text-shadow: 0 2px 5px rgba(33, 33, 33, 0.5); }
    .card .category:not([class*="text-"]) {
        color: #999; }
    .card .card-content {
        padding: 15px 20px; }
    .card .card-content .category {
        margin-bottom: 0; }
    .card .card-header {
        box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2);
        margin: -20px 15px 0;
        border-radius: 3px;
        padding: 15px;
        background-color: #999; }
    .card .card-header .title {
        color: #fff; }
    .card .card-header .category {
        margin-bottom: 0;
        color: rgba(255, 255, 255, .62); }
    .card .card-header.card-chart {
        padding: 0;
        min-height: 160px; }
    .card .card-header.card-chart + .content h4 {
        margin-top: 0; }
    .card .card-header .ct-label {
        color: rgba(255, 255, 255, .7); }
    .card .card-header .ct-grid {
        stroke: rgba(255, 255, 255, 0.2); }
    .card .card-header .ct-series-a .ct-point, .card .card-header .ct-series-a .ct-line, .card .card-header .ct-series-a .ct-bar, .card .card-header .ct-series-a .ct-slice-donut {
        stroke: rgba(255, 255, 255, .8); }
    .card .card-header .ct-series-a .ct-slice-pie, .card .card-header .ct-series-a .ct-area {
        fill: rgba(255, 255, 255, .4); }
    .card .chart-title {
        position: absolute;
        top: 25px;
        width: 100%;
        text-align: center; }
    .card .chart-title h3 {
        margin: 0;
        color: #fff; }
    .card .chart-title h6 {
        margin: 0;
        color: rgba(255, 255, 255, .4); }
    .card .card-footer {
        margin: 0 20px 10px;
        padding-top: 10px;
        border-top: 1px solid #eee; }
    .card .card-footer .content {
        display: block; }
    .card .card-footer div {
        display: inline-block; }
    .card .card-footer .author {
        color: #999; }
    .card .card-footer .stats {
        line-height: 22px;
        color: #999;
        font-size: 12px; }
    .card .card-footer .stats .material-icons {
        position: relative;
        top: 4px;
        font-size: 16px; }
    .card .card-footer h6 {
        color: #999; }
    .card img {
        width: 100%;
        height: auto; }
    .card .category .material-icons {
        position: relative;
        top: 6px;
        line-height: 0; }
    .card .category-social .fa {
        font-size: 24px;
        position: relative;
        margin-top: -4px;
        top: 2px;
        margin-right: 5px; }
    .card .author .avatar {
        width: 30px;
        height: 30px;
        overflow: hidden;
        border-radius: 50%;
        margin-right: 5px; }
    .card .author a {
        color: #060409;
        text-decoration: none; }
    .card .author a .ripple-container {
        display: none; }
    .card .table {
        margin-bottom: 0; }
    .card .table tr:first-child td {
        border-top: none; }
    .card [data-background-color="purple"] {
        background: linear-gradient(60deg, #ab47bc, #8e24aa);
        box-shadow: 0 12px 20px -10px rgba(83, 46, 125, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(83, 46, 125, 0.2); }
    .card [data-background-color="blue"] {
        background: linear-gradient(60deg, #26c6da, #00acc1);
        box-shadow: 0 12px 20px -10px rgba(41, 156, 182, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(41, 156, 182, 0.2); }
    .card [data-background-color="green"] {
        background: linear-gradient(60deg, #66bb6a, #43a047);
        box-shadow: 0 12px 20px -10px rgba(78, 136, 94, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(78, 136, 94, 0.2); }
    .card [data-background-color="orange"] {
        background: linear-gradient(60deg, #ffa726, #fb8c00);
        box-shadow: 0 12px 20px -10px rgba(203, 120, 38, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(203, 120, 38, 0.2); }
    .card [data-background-color="red"] {
        background: linear-gradient(60deg, #ef5350, #e53935);
        box-shadow: 0 12px 20px -10px rgba(244, 67, 54, 0.28), 0 4px 20px 0px rgba(0, 0, 0, 0.12), 0 7px 8px -5px rgba(244, 67, 54, 0.2); }
    .card [data-background-color] {
        color: #fff; }
    .card [data-background-color] a {
        color: #fff; }

    .card-stats .title {
        margin: 0; }
    .card-stats .card-header {
        float: left;
        text-align: center; }
    .card-stats .card-header i {
        font-size: 36px;
        line-height: 56px;
        width: 56px;
        height: 56px; }
    .card-stats .card-content {
        text-align: right;}

    .card-nav-tabs .header-raised {
        margin-top: -30px; }
    .card-nav-tabs .nav-tabs {
        background: transparent;
        padding: 0; }
    .card-nav-tabs .nav-tabs-title {
        float: left;
        padding: 10px 10px 10px 0;
        line-height: 24px; }

    .card-plain {
        background: transparent;
        box-shadow: none; }
    .card-plain .card-header {
        margin-left: 0;
        margin-right: 0; }
    .card-plain .content {
        padding-left: 5px;
        padding-right: 5px; }
    .card-plain .card-image {
        margin: 0;
        border-radius: 3px; }
    .card-plain .card-image img {
        border-radius: 3px; }

    .iframe-container {
        margin: 0 -20px 0; }
    .iframe-container iframe {
        width: 100%;
        height: 500px;
        border: 0;
        box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2); }

    .card-profile, .card-testimonial {
        margin-top: 30px;
        text-align: center; }
    .card-profile .btn-just-icon.btn-raised, .card-testimonial .btn-just-icon.btn-raised {
        margin-left: 6px;
        margin-right: 6px; }
    .card-profile .card-avatar, .card-testimonial .card-avatar {
        max-width: 130px;
        max-height: 130px;
        margin: -50px auto 0;
        border-radius: 50%;
        overflow: hidden;
        box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2); }
    .card-profile .card-avatar + .content, .card-testimonial .card-avatar + .content {
        margin-top: 15px; }
    .card-profile.card-plain .card-avatar, .card-testimonial.card-plain .card-avatar {
        margin-top: 0; }

    .nav-tabs {
        background: #532e7d;
        border: 0;
        border-radius: 3px;
        padding: 0 15px; }
    .nav-tabs > li > a {
        color: #fff;
        border: 0;
        margin: 0;
        border-radius: 3px;
        line-height: 24px;
        text-transform: uppercase;
        font-size: 12px; }
    .nav-tabs > li > a:hover {
        background-color: transparent;
        border: 0; }
    .nav-tabs > li > a, .nav-tabs > li > a:hover, .nav-tabs > li > a:focus {
        background-color: transparent;
        border: 0 !important;
        color: #fff !important;
        font-weight: 500; }
    .nav-tabs > li.disabled > a, .nav-tabs > li.disabled > a:hover {
        color: rgba(255, 255, 255, 0.5); }
    .nav-tabs > li .material-icons {
        margin: -1px 5px 0 0; }
    .nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
        background-color: rgba(255, 255, 255, .2);
        transition: background-color 0.1s 0.2s; }


    @media (min-width: 992px) {
        /*.navbar-nav > li > .dropdown-menu:before{
   border-bottom: 11px solid rgba(0, 0, 0, 0.2);
   border-left: 11px solid rgba(0, 0, 0, 0);
   border-right: 11px solid rgba(0, 0, 0, 0);
   content: "";
   display: inline-block;
   position: absolute;
   left: 12px;
   top: -11px;
   }
   .navbar-nav > li > .dropdown-menu:after {
   border-bottom: 11px solid #FFFFFF;
   border-left: 11px solid rgba(0, 0, 0, 0);
   border-right: 11px solid rgba(0, 0, 0, 0);
   content: "";
   display: inline-block;
   position: absolute;
   left: 12px;
   top: -10px;
   }*/
        .navbar-form {
            margin-top: 21px;
            margin-bottom: 21px;
            padding-left: 5px;
            padding-right: 5px; }
        .navbar-nav > li > .dropdown-menu, .dropdown .dropdown-menu, .dropdown-menu.bootstrap-datetimepicker-widget {
            -webkit-transition: all 150ms linear;
            -moz-transition: all 150ms linear;
            -o-transition: all 150ms linear;
            -ms-transition: all 150ms linear;
            transition: all 150ms linear;
            margin-top: -20px;
            visibility: hidden;
            display: block;
            opacity: 0;
            filter: alpha(opacity=0); }
        .navbar-nav > li.open > .dropdown-menu, .dropdown.open .dropdown-menu, .dropdown-menu.bootstrap-datetimepicker-widget.open {
            opacity: 1;
            filter: alpha(opacity=100);
            visibility: visible;
            margin-top: 0px; }
        .navbar-nav.navbar-right > li > .dropdown-menu:before {
            left: auto;
            right: 12px; }
        .navbar-nav.navbar-right > li > .dropdown-menu:after {
            left: auto;
            right: 12px; }
        .footer:not(.footer-big) nav > ul li:first-child {
            margin-left: 0; }
        body > .navbar-collapse.collapse {
            display: none !important; }
        .card form [class*="col-"] {
            padding: 6px; }
        .card form [class*="col-"]:first-child {
            padding-left: 15px; }
        .card form [class*="col-"]:last-child {
            padding-right: 15px; }
        .sidebar .navbar-form {
            display: none !important; }
        .sidebar .nav-mobile-menu {
            display: none; } }
    /*          Changes for small display      */
    @media (max-width: 991px) {
        .sidebar {
            display: none;
            box-shadow: none; }
        .sidebar .sidebar-wrapper {
            padding-bottom: 60px; }
        .sidebar .nav-mobile-menu {
            margin-top: 0; }
        .sidebar .nav-mobile-menu .notification {
            float: left;
            line-height: 30px;
            margin-right: 8px; }
        .sidebar .nav-mobile-menu .open .dropdown-menu {
            position: static;
            float: none;
            width: auto;
            margin-top: 0;
            background-color: transparent;
            border: 0;
            -webkit-box-shadow: none;
            box-shadow: none; }


        .navbar .container {
            left: 0;
            width: 100%;
            -webkit-transition: all 0.33s cubic-bezier(0.685, 0.0473, 0.346, 1);
            -moz-transition: all 0.33s cubic-bezier(0.685, 0.0473, 0.346, 1);
            -o-transition: all 0.33s cubic-bezier(0.685, 0.0473, 0.346, 1);
            -ms-transition: all 0.33s cubic-bezier(0.685, 0.0473, 0.346, 1);
            transition: all 0.33s cubic-bezier(0.685, 0.0473, 0.346, 1);
            position: relative; }

        .navbar .navbar-collapse.collapse, .navbar .navbar-collapse.collapse.in, .navbar .navbar-collapse.collapsing {
            display: none !important; }

        .navbar-nav > li {
            float: none;
            position: relative;
            display: block; }

        .sidebar > ul, .off-canvas-sidebar > ul {
            position: relative;
            z-index: 4;
            overflow-y: scroll;
            height: calc(100vh - 61px);
            width: 100%; }

        .sidebar .logo, .off-canvas-sidebar .logo {
            position: relative;
            z-index: 4; }
        .sidebar .navbar-form, .off-canvas-sidebar .navbar-form {
            margin: 10px 15px;
            float: none !important; }
        .sidebar .navbar-form .btn, .off-canvas-sidebar .navbar-form .btn {
            position: absolute;
            top: 25px;
            right: 15px; }
        .sidebar .table-responsive, .off-canvas-sidebar .table-responsive {
            width: 100%;
            margin-bottom: 15px;
            overflow-x: scroll;
            overflow-y: hidden;
            -ms-overflow-style: -ms-autohiding-scrollbar;
            -webkit-overflow-scrolling: touch; }

        .nav-open .navbar-collapse {
            -webkit-transform: translate3d(0px, 0, 0);
            -moz-transform: translate3d(0px, 0, 0);
            -o-transform: translate3d(0px, 0, 0);
            -ms-transform: translate3d(0px, 0, 0);
            transform: translate3d(0px, 0, 0); }

        .nav-open .navbar .container {
            left: -250px; }

        .nav-open .main-panel {
            left: 0;
            -webkit-transform: translate3d(-260px, 0, 0);
            -moz-transform: translate3d(-260px, 0, 0);
            -o-transform: translate3d(-260px, 0, 0);
            -ms-transform: translate3d(-260px, 0, 0);
            transform: translate3d(-260px, 0, 0); }

        .nav-open .sidebar {
            box-shadow: 0 10px 30px -12px rgba(0, 0, 0, 0.42), 0 4px 25px 0px rgba(0, 0, 0, 0.12), 0 8px 10px -5px rgba(0, 0, 0, 0.2); }

        .nav-open .off-canvas-sidebar, .nav-open .sidebar {
            -webkit-transform: translate3d(0, 0, 0);
            -moz-transform: translate3d(0, 0, 0);
            -o-transform: translate3d(0, 0, 0);
            -ms-transform: translate3d(0, 0, 0);
            transform: translate3d(0, 0, 0); }

        .navbar-toggle .icon-bar {
            display: block;
            position: relative;
            background: #fff;
            width: 24px;
            height: 2px;
            border-radius: 1px;
            margin: 0 auto; }

        .navbar-header .navbar-toggle {
            margin: 10px 15px 10px 0;
            width: 40px;
            height: 40px; }

        @-webkit-keyframes fadeIn {
            0% {
                opacity: 0; }
            100% {
                opacity: 1; } }
        @-moz-keyframes fadeIn {
            0% {
                opacity: 0; }
            100% {
                opacity: 1; } }
        @keyframes fadeIn {
            0% {
                opacity: 0; }
            100% {
                opacity: 1; } }
        .dropdown-menu .divider {
            background-color: rgba(229, 229, 229, 0.15); }

        .navbar-nav .open .dropdown-menu > li > a {
            padding: 15px 15px 5px 50px; }
        .navbar-nav .open .dropdown-menu > li:first-child > a {
            padding: 5px 15px 5px 50px; }
        .navbar-nav .open .dropdown-menu > li:last-child > a {
            padding: 15px 15px 25px 50px; }

        [class*="navbar-"] .navbar-nav > li > a, [class*="navbar-"] .navbar-nav > li > a:hover, [class*="navbar-"] .navbar-nav > li > a:focus, [class*="navbar-"] .navbar-nav .active > a, [class*="navbar-"] .navbar-nav .active > a:hover, [class*="navbar-"] .navbar-nav .active > a:focus, [class*="navbar-"] .navbar-nav .open .dropdown-menu > li > a, [class*="navbar-"] .navbar-nav .open .dropdown-menu > li > a:hover, [class*="navbar-"] .navbar-nav .open .dropdown-menu > li > a:focus, [class*="navbar-"] .navbar-nav .navbar-nav .open .dropdown-menu > li > a:active {
            color: white; }
        [class*="navbar-"] .navbar-nav > li > a, [class*="navbar-"] .navbar-nav > li > a:hover, [class*="navbar-"] .navbar-nav > li > a:focus, [class*="navbar-"] .navbar-nav .open .dropdown-menu > li > a, [class*="navbar-"] .navbar-nav .open .dropdown-menu > li > a:hover, [class*="navbar-"] .navbar-nav .open .dropdown-menu > li > a:focus {
            opacity: 0.7;
            background: transparent; }
        [class*="navbar-"] .navbar-nav.navbar-nav .open .dropdown-menu > li > a:active {
            opacity: 1; }
        [class*="navbar-"] .navbar-nav .dropdown > a:hover .caret {
            border-bottom-color: #777;
            border-top-color: #777; }
        [class*="navbar-"] .navbar-nav .dropdown > a:active .caret {
            border-bottom-color: white;
            border-top-color: white; }


        .social-line .btn {
            margin: 0 0 10px 0; }

        .subscribe-line .form-control {
            margin: 0 0 10px 0; }


        .footer:not(.footer-big) nav > ul li {
            float: none; }


        .form-control + .form-control-feedback {
            margin-top: -8px; }


        .btn.dropdown-toggle {
            margin-bottom: 0; }

        .media-post .author {
            width: 20%;
            float: none !important;
            display: block;
            margin: 0 auto 10px; }

        .media-post .media-body {
            width: 100%; }


        .navbar-header .collapse, .navbar-toggle {
            display: block !important; }

        .navbar-header {
            float: none; }

        .navbar-collapse .nav p {
            font-size: 14px;
            margin: 0; }
        .navbar-collapse [class^="pe-7s-"] {
            float: left;
            font-size: 20px;
            margin-right: 10px; } }

    @media (min-width: 768px) {
        .navbar > .container-fluid .navbar-brand {
            margin-left: 0; } }

    @media (min-width: 992px) {
        .table-full-width {
            margin-left: -20px;
            margin-right: -20px; } }

    body {
        background-color: #c6c6c6; }

    .card {
        background-color: #dfe1e0; }

    .card [data-background-color="purple"] {
        background: linear-gradient(60deg, #5f3590, #47276a); }

    .card [data-background-color="red"] {
        background: linear-gradient(60deg, #f55a4e, #f32c1e); }

    .card [data-background-color="green"] {
        background: linear-gradient(60deg, #579869, #457853); }

    .card [data-background-color="blue"] {
        background: linear-gradient(60deg, #2eaecb, #248aa1); }

    .card [data-background-color="orange"] {
        background: linear-gradient(60deg, #d98532, #b66b22); }

    .card .category:not([class*="text-"]), .card .card-footer .stats {
        color: #878787; }

    .card .card-header .category {
        color: #fff; }

    .card .card-footer {
        border-top: 1px solid #c6c6c6; }

    table {
        border-color: #c6c6c6; }

    .navbar-transparent {
        color: #878787; }
</style>
<style>
    .xcrud-top-actions{
        background-color:#b5b694;
        border: 1px solid #9c9d7b;
        background-image: -o-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -moz-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -webkit-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: -ms-linear-gradient(bottom, #cecfad 0%, #b5b694 100%);
        background-image: linear-gradient(to bottom, #cecfad 0%, #b5b694 100%);
        -webkit-box-shadow: inset 0 1px 0 #e7e8c6;
        -moz-box-shadow: inset 0 1px 0 #e7e8c6;
        box-shadow: inset 0 1px 0 #e7e8c6;
        color: #9c9d7b;
    }
    .table-striped>tbody>tr:nth-of-type(odd) {
        background-color: #eeede9;}
    .fc-head-container thead tr, .table thead tr{
        background-color:#ccc5b1;
        border: 1px solid #b3ac98;
        background-image: -o-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -moz-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -webkit-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: -ms-linear-gradient(bottom, #e5deca 0%, #ccc5b1 100%);
        background-image: linear-gradient(to bottom, #e5deca 0%, #ccc5b1 100%);
        -webkit-box-shadow: inset 0 1px 0 #fef7e3;
        -moz-box-shadow: inset 0 1px 0 #fef7e3;
        box-shadow: inset 0 1px 0 #fef7e3;
        color: #3a6b58;
        height: 40px;
        font-size: 14px;
    }
    .alert{
        font-size: 16px;
    }
</style>

<div class="row">
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="orange">
                <i class="fa fa-table fa-fw "></i>
            </div>
            <div class="card-content">
                <p class="category">Active Payroll</p>
                <h3 class="title">314,501 <small>Staff</small></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="fa fa-sign-in fa-fw "></i> <a href="#X/reports?id=501">Get More Details...</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="green">
                <i class="fa fa-gears fa-fw "></i>
            </div>
            <div class="card-content">
                <p class="category">Permanent & Pensionable</p>
                <h3 class="title">233,909 <small>Staff</small></h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="fa fa-sign-in fa-fw "></i> <a href="#X/reports?id=505">Public Service by Terms of Employment</a>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="red">
                <i class="fa fa-rss fa-fw "></i>
            </div>
            <div class="card-content">
                <p class="category">Annual Pension Cost</p>
                <h3 class="title">UGX 288.7 Bn/=</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="fa fa-sign-in fa-fw "></i> <a href="#X/reports?id=509">Pensions by Age Category</a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-3 col-md-6 col-sm-6">
        <div class="card card-stats">
            <div class="card-header" data-background-color="blue">
                <i class="fa fa-suitcase"></i>
            </div>
            <div class="card-content">
                <p class="category">Wage / Central Gov't</p>
                <h3 class="title">UGX 2,231 Bn/=</h3>
            </div>
            <div class="card-footer">
                <div class="stats">
                    <i class="fa fa-sign-in fa-fw "></i> <a href="#X/reports?id=513">Wage by Vote / Central Government</a>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xs-6 col-md-3"><h4 class="alert alert-success"> New Recruitments Last FY: <strong class="pull-right">9,110</strong></h4></div>
<div class="col-xs-6 col-md-3"><h4 class="alert alert-warning"> Staff on Probation: <strong class="pull-right">71,814</strong></h4></div>
<div class="col-xs-6 col-md-3"><h4 class="alert alert-info"> Number of Pensioners: <strong class="pull-right">76,913</strong></h4></div>
<div class="col-xs-6 col-md-3"><h4 class="alert alert-danger"> Wage / LGs: <strong class="pull-right">UGX 2,012Bn /=</strong></h4></div>
<br><br><br><br>

<!-- /*  Dashboard Ends */ -->


<section id="widget-grid" class="">

    <!-- row -->
    <div class="row">

        <!-- NEW WIDGET START -->
        <article class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

            <!-- Widget ID (each widget will need unique ID)-->
            <div class="jarviswidget jarviswidget-color-teal" id="wid-id-3" data-widget-sortable="false" data-widget-editbutton="false" data-widget-togglebutton="false" data-widget-deletebutton="false">

                <header>
                    <span class="widget-icon"> <i class="fa fa-bar-chart"></i> </span>
                    <h2>List of <strong>HR Analytics Reports </strong> <i> by Category</i></h2>

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
<script>
    // Modal Sidebar Window Content for Help/info
    var x = document.getElementById("myModalLabel2");
    var y = document.getElementById("help_modal_window");
    x.innerHTML = "Welcome to the Public Service Smart Dashboard";
    y.innerHTML = '<span style="font-family: Verdana, Geneva, sans-serif; font-size: 16px;"><p>Smart Dashboard for the Public Service analyses and displays visual data on the following.</p><ol><li>Large Screens at key points for target audiences.</li><li>Mobile Devices like Ipads, Tablets and Phones.</li><li>Desktop Computers.</li></ol><p>The System has intelligence tools to generate the following presentation layers, that will be visually appealing and easily interpreted by all audiences.</p><ol><li>Graphs,</li><li>Charts,</li><li>Maps, and</li><li>Tabular Data</li></ol></span>';
</script>
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
