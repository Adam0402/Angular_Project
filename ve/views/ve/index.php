<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <base href="/ve2/" />
        <title>Virtual Evaluator - v2.4</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
        <meta name="apple-mobile-web-app-capable" content="yes" />
        <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimal-ui" />
        <meta name="apple-mobile-web-app-status-bar-style" content="yes" />
        <link rel="stylesheet" href="/ve/css/mobile-angular-ui-hover.min.css" />
        <link rel="stylesheet" href="/ve/css/mobile-angular-ui-base.min.css" />
        <link rel="stylesheet" href="/ve/css/mobile-angular-ui-desktop.min.css" />
        <link rel="stylesheet" href="/ve/ve.css" />
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.5.6/angular-route.min.js"></script>
        <script src="/ve/js/mobile-angular-ui.min.js"></script>
        <!-- Required to use $touch, $swipe, $drag and $translate services -->
        <script src="/ve/js/mobile-angular-ui.gestures.min.js"></script>
        <script src="/ve/ve.js"></script>
    </head>

    <body ng-app="MobileAngularUiExamples"  ng-controller="MainController"  ui-prevent-touchmove-defaults>
        <!-- Sidebars -->
        <div ng-include="'/ve/index?pg=sidebar'" ui-track-as-search-param="true" class="sidebar sidebar-left">
        </div>
        <div class="app"  ui-swipe-right="Ui.turnOn('uiSidebarLeft')" ui-swipe-left="Ui.turnOff('uiSidebarLeft')">
            <!-- Navbars -->
            <div class="navbar navbar-app navbar-absolute-top">
                <div class="navbar-brand navbar-brand-center" ui-yield-to="title">
                    <img src="/ve/img/logo_small.png" alt="Virtual Evaluator" style="max-height: 35px; margin: -9px auto;" />
                </div>
                <div class="btn-group pull-left">
                    <div ui-toggle="uiSidebarLeft" class="btn sidebar-toggle">
                        <i class="fa fa-bars"></i> Menu
                    </div>
                </div>
            </div>
            <div class="navbar navbar-app navbar-absolute-bottom">
                <div class="btn-group justified">
                    <a href="#/help" class="btn btn-navbar"><i class="fa fa-question-circle fa-navbar"></i> Help</a>
                    <a href="#/disclaimer" class="btn btn-navbar"><i class="fa fa-exclamation-circle fa-navbar"></i> Disclaimer</a>
                </div>
            </div>
            <!-- App Body -->
            <div class="app-body" ng-class="{loading: loading}">
                <div ng-show="loading" class="app-content-loading">
                    <i class="fa fa-spinner fa-spin loading-spinner"></i>
                </div>
                <div class="app-content">
                    <ng-view></ng-view>
                </div>
            </div>
        </div><!-- ~ .app -->
        <div ui-yield-to="modals"></div>
    </body>
</html>
