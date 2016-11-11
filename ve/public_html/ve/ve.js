/* eslint no-alert: 0 */

'use strict';

//
// Here is how to define your module
// has dependent on mobile-angular-ui
//
var app = angular.module('MobileAngularUiExamples', ['ngRoute', 'mobile-angular-ui', 'mobile-angular-ui.gestures']);

app.run(function($transform) {
    window.$transform = $transform;
});

//
// You can configure ngRoute as always, but to take advantage of SharedState location
// feature (i.e. close sidebar on backbutton) you should setup 'reloadOnSearch: false'
// in order to avoid unwanted routing.
//
app.config(['$routeProvider' , '$locationProvider', '$httpProvider', function($routeProvider, $locationProvider, $httpProvider) {
    $routeProvider.when('/', {templateUrl: '/ve/index?pg=home', reloadOnSearch: false});
    $routeProvider.when('/vehicle', {templateUrl: function(params){ return '/ve/index?pg=vehicle&c=' + params.ClaimID;   }, reloadOnSearch: false});
    $routeProvider.when('/damage', {templateUrl: '/ve/index?pg=damage', reloadOnSearch: false});
    $routeProvider.when('/damage2', {templateUrl: '/ve/index?pg=damage2', reloadOnSearch: false});
    $routeProvider.when('/photos', {templateUrl: '/ve/index?pg=photos', reloadOnSearch: false});
    $routeProvider.when('/thankyou', {templateUrl: '/ve/index?pg=thankyou', reloadOnSearch: false});
    $routeProvider.when('/help', {templateUrl: '/ve/index?pg=help', reloadOnSearch: false});
    $routeProvider.when('/disclaimer', {templateUrl: '/ve/index?pg=disclaimer', reloadOnSearch: false});
    $httpProvider.defaults.timeout = 5000;
}]);


app.directive('photos', function() {
    return {
        restrict: 'EA',
        replace: true,
        template: '<div class="panel panel-default" ng-repeat="photo in photos" ng-if="photos.length > 0">' +
        '<div class="panel-heading" ui-set="{\'myAccordion\': {{photo.id}}}">'+
        '<h4 class="panel-title">'+
        '{{photo.header}}' +
        '<i class="fa fa-spinner fa-spin pull-right" ng-show="photo.loading" id="loading_photo_{{photo.id}}" ></i>'+
        '<i class="fa fa-check pull-right" style="color: green;" ng-show="photo.loaded" id="done_photo_{{photo.id}}" ></i>'+
        '</h4>'+
        '</div>'+

        '<div ui-if="myAccordion == {{photo.id}}">'+
        '<div class="panel-body" style="text-align: center;">'+
        '<img ng-src="{{photo.img}}" alt="{{photo.header}}" class="{{photo.class}}" id="img_photo_{{photo.id}}" />'+
        '<div class="sample_text" id="sample_text_photo_{{photo.id}}">{{photo.text}}</div>'+
        '<input id="photo_{{photo.id}}" type="file" accept="image/*;capture=camera" data-my-Directive name="file_{{photo.id}}">'+
        '</div>'+
        '</div>'+
        '</div>',
    };
});
//
// For this trivial demo we have just a unique MainController
// for everything
//
app.controller('MainController', function($rootScope, $scope, $location) {

    // User agent displayed in home page
    $scope.userAgent = navigator.userAgent;

    if (angular.isUndefined($scope.ClaimID)){
        $scope.ClaimID = 194948;
    }

    $scope.selected_count = {
        count: 0,
        availableOptions: [
            {id: '1', name: 'Count 1'},
            {id: '2', name: 'Count 2'},
            {id: '3', name: 'Count 3'},
            {id: '4', name: 'Count 4'},
        ]
    };

    $scope.damage_selected = [];
    $scope.all_selected = false;

    $scope.photos = [
        {id: 1, img: '/ve/img/samples/front_left.png', class: 'sample_img', header: 'Front Left', text: 'Font Left Sample', desc: 'blah', loading: false, loaded: false},
        {id: 2, img: '/ve/img/samples/front_right.png', class: 'sample_img',  header: 'Front Right', text: 'Font Right Sample', desc: 'blah', loading: false, loaded: false},
        {id: 3, img: '/ve/img/samples/rear_left.png', class: 'sample_img',   header: 'Rear Left', text: 'Rear Left Sample', desc: 'blah', loading: false, loaded: false},
        {id: 4, img: '/ve/img/samples/rear_right.png', class: 'sample_img',  header: 'Rear Right', text: 'Font Rear Sample', desc: 'blah', loading: false, loaded: false},
        {id: 5, img: '/ve/img/samples/odo.png', class: 'sample_img',  header: 'Odometer', text: 'Font Rear Sample', desc: 'blah', loading: false, loaded: false},
        {id: 6, img: '/ve/img/samples/license.png', class: 'sample_img',  header: 'License', text: 'Font Rear Sample', desc: 'blah', loading: false, loaded: false},
    ];

    $scope.area_code = [
        {id: "area151", src: '/ve/img/templates/id3/ds-rear-tire.gif', coords : "19,169,29,172,34,181,34,189,29,196,18,200,8,196,4,186,8,174", title:'Left Rear Wheel'},
        {id: "area152", src: '/ve/img/templates/id3/ps-front-tire.gif', coords : "148,39,158,42,163,51,163,59,158,66,147,70,137,66,133,56,137,44", title:'Right Front Wheel'},
        {id: "area153", src: '/ve/img/templates/id3/front-bumper.gif', coords : "37,9,55,3,117,4,131,9,143,26,124,22,44,22,25,26", title:'Front Bumper'},
        {id: "area154", src: '/ve/img/templates/id3/ds-headlight.gif', coords : "43,23,47,36,65,32,70,24,43,23,96,23", title:'Left Headlight'},
        {id: "area155", src: '/ve/img/templates/id3/ps-headlight.gif', coords : "96,23,103,32,120,38,124,24,96,23", title:'Right Headlight'},
        {id: "area156", src: '/ve/img/templates/id3/grille.gif', coords : "68,30,99,31,95,24,71,24", title:'Grille'},
        {id: "area157", src: '/ve/img/templates/id3/ds-front-fender.gif', coords : "20,77,51,78,48,38,42,23,24,27,22,35,36,43,39,61,32,71", title:'Left Front Wing'},
        {id: "area158", src: '/ve/img/templates/id3/ps-front-fender.gif', coords : "147,77,116,77,120,38,124,25,143,27,144,35,131,43,128,58,134,71", title:'Right Front Wing'},
        {id: "area159", src: '/ve/img/templates/id3/hood.gif', coords : "51,77,115,77,119,38,101,32,67,32,48,37", title:'Bonnet'},
        {id: "area160", src: '/ve/img/templates/id3/ds-front-tire.gif', coords : "19,40,29,43,34,52,34,60,29,67,18,71,8,67,4,57,8,45", title:'Left Front Wheel'},
        {id: "area156", src: '/ve/img/templates/id3/ds-side-mirror.gif', coords : "50,82,43,84,31,95,31,103,47,95", title:'Left Mirror'},
        {id: "area162", src: '/ve/img/templates/id3/ps-side-mirror.gif', coords : "117,83,121,82,134,95,134,101,119,95,117,89", title:'Right Mirror'},
        {id: "area163", src: '/ve/img/templates/id3/windshield.gif', coords : "51,78,60,99,106,99,116,78", title:'Windscreen'},
        {id: "area164", src: '/ve/img/templates/id3/ds-front-door.gif', coords : "31,106,54,90,60,100,60,130,20,130,20,79,49,78,49,79,29,91", title:'Left Front Door'},
        {id: "area165", src: '/ve/img/templates/id3/ps-front-door.gif', coords : "117,78,138,95,135,104,111,90,107,100,106,129,146,130,147,78", title:'Right Front Door'},
        {id: "area166", src: '/ve/img/templates/id3/ds-rear-door.gif', coords : "40,184,51,183,60,171,60,132,20,132,20,165,37,173", title:'Left Rear Door'},
        {id: "area167", src: '/ve/img/templates/id3/ps-rear-door.gif', coords : "127,184,115,184,106,171,106,131,147,131,148,165,134,170", title:'Right Rear Door'},       
        {id: "area168", src: '/ve/img/templates/id3/roof.gif', coords : "61,170,105,170,105,99,59,99", title:'Roof'},
        {id: "area169", src: '/ve/img/templates/id3/rear-window.gif', coords : "53,185,114,185,104,171,61,171", title:'Rear Window'},
        {id: "area170", src: '/ve/img/templates/id3/ds-quarter.gif', coords : "23,224,51,226,51,185,42,184,36,196,23,203", title:'Left Quarter Panel'},
        {id: "area171", src: '/ve/img/templates/id3/ps-quarter.gif', coords : "116,226,144,223,144,204,131,196,128,186,116,186", title:'Right Quarter Panel'},
        {id: "area172", src: '/ve/img/templates/id3/trunk.gif', coords : "52,225,83,229,115,227,115,186,52,185", title:'Hatch'},
        {id: "area173", src: '/ve/img/templates/id3/ds-taillight.gif', coords : "37,226,50,236,61,235,69,229", title:'Left Taillight'},
        {id: "area174", src: '/ve/img/templates/id3/ps-taillight.gif', coords : "98,229,108,235,122,234,129,227", title:'Right Taillight'},
        {id: "area175", src: '/ve/img/templates/id3/rear-bumper.gif', coords : "23,226,26,233,59,244,99,246,133,238,145,225,131,227,120,237,103,237,95,230,73,230,64,235,51,237,40,233,37,227", title:'Rear Bumper'},
        {id: "area176", src: '/ve/img/templates/id3/ps-rear-tire.gif', coords : "148,169,158,172,163,181,163,189,158,196,147,200,137,196,133,186,137,174", title:'Right Rear Wheel'}
    ]

    $scope.selectPanel = function(AreaID, damage_id) {
        for (var i = $scope.area_code.length - 1; i >= 0; i--) {
            if($scope.area_code[i].id == AreaID){
                if(!$scope.damage_selected[damage_id].selected){
                    $scope.damage_selected[damage_id].src = $scope.area_code[i].src;                    
                    $scope.damage_selected[damage_id].selected = true;
                }else {
                    $scope.damage_selected[damage_id].src = "/ve/img/templates/id3/id3.gif";                    
                    $scope.damage_selected[damage_id].selected = false;
                }                
            }
        };

        if((AreaID == "area151") || (AreaID == "area152") || (AreaID == "area160") || (AreaID == "area176")) {
            $scope.damage_selected[damage_id].depth_src = 'dsfp';
        }else if((AreaID == "area153")){
            $scope.damage_selected[damage_id].depth_src = 'fbumper';
        }else if((AreaID == "area157") || (AreaID == "area158")){
            $scope.damage_selected[damage_id].depth_src = 'fender';
        }else if((AreaID == "area164") || (AreaID == "area165")){
            $scope.damage_selected[damage_id].depth_src = 'front_door';
        }else if((AreaID == "area159")){
            $scope.damage_selected[damage_id].depth_src = 'hood';
        }else if((AreaID == "area170") || (AreaID == "area171")){
            $scope.damage_selected[damage_id].depth_src = 'quarter_panel';
        }else if((AreaID == "area153") || (AreaID == "area175")){
            $scope.damage_selected[damage_id].depth_src = 'rbumper';
        }else if((AreaID == "area168")){
            $scope.damage_selected[damage_id].depth_src = 'roof';
        }else if((AreaID == "area172")){
            $scope.damage_selected[damage_id].depth_src = 'trunk';
        }

        $scope.all_selected = true;
        for (var i = $scope.damage_selected.length - 1; i >= 0; i--) {
            if($scope.damage_selected[i].selected == false){
                $scope.all_selected = false;
            }
        };
    }

    $scope.count_update = function() {
        $scope.damage_selected = [];
        for(var i = 0; i < $scope.selected_count.count; i++) {
            var damage_model = {
                select_id : i,
                src : "/ve/img/templates/id3/id3.gif",
                depth_level: 'level1',
                depth_src : '',
                selected : false,
                visible: false,
                usemap: 'car' + i,
            }
            $scope.damage_selected.push(damage_model);
        }
    }

    $scope.level_change = function(level, damage_id){
        $scope.damage_selected[damage_id].depth_level = level;
    }

    $scope.go = function ( path ) {
        if($scope.all_selected){
            $location.path( path );
        }
    };

    $scope.swiped = function(direction) {
        alert('Swiped ' + direction);
    };

    $rootScope.$on('$routeChangeStart', function() {
        $rootScope.loading = true;
    });

    $rootScope.$on('$routeChangeSuccess', function() {
        $rootScope.loading = false;
    });
});

app.directive('myDirective', function (httpPostFactory) {
    return {
        restrict: 'A',
        scope: true,
        link: function (scope, element, attr) {

            element.bind('change', function () {
                var formData = new FormData();
                
                console.log(scope);
                
                formData.append('data','{"code": "200", "data":{"ClaimID": "' + scope.ClaimID + '", "UserID": "0"}}');
                formData.append('file[]', element[0].files[0]);
                
                scope.photo.loading = true;
                scope.photo.loaded = false;
                
                httpPostFactory('http://losscapture.com/v1/data/fileupload', formData, function (callback) {
                   // recieve image name to use in a ng-src 
                   /*
                    document.getElementById("img_" + attr.id).src = callback.data.path;
                    document.getElementById("img_" + attr.id).className = 'user_img';
                    document.getElementById("sample_text_" + attr.id).style = "display: none;";
                    document.getElementById("done_" + attr.id).style = "color: green; display: block;"
                    document.getElementById("loading_" + attr.id).style = "display: none;"
                    */
                    scope.photo.loading = false;
                    scope.photo.loaded = true;
                    
                    scope.photo.img = 'http://www.losscapture.com' + callback.data.path;
                    scope.photo.class = 'user_img';
                    scope.photo.text = '';
                
                    console.log(scope);
                });
            });
        }
    };
});

app.factory('httpPostFactory', function ($http) {
    return function (file, data, callback) {
        $http({
            url: file,
            method: "POST",
            data: data,
                  transformRequest: angular.identity,
            headers: {'Content-Type': undefined}
        }).success(function (response) {
            callback(response);
        });
    };
});